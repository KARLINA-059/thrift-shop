<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }
        
        return view('orders.checkout', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:transfer_bank,e_wallet',
        ]);

        // Update user phone if provided
        if ($request->phone && $request->phone !== Auth::user()->phone) {
            Auth::user()->update(['phone' => $request->phone]);
        }

        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Calculate total
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        // Create order
        $order = Order::create([
            'order_code' => 'ORD-' . Str::random(10),
            'user_id' => Auth::id(),
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        // Clear cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.payment', $order)->with('success', 'Order created successfully!');
    }

    public function payment(Order $order)
    {
        return view('orders.payment', compact('order'));
    }

    public function processPayment(Request $request, Order $order)
    {
        $request->validate([
            'email' => 'required|email',
            'account_owner' => 'required|string',
            'amount' => 'required|numeric|min:' . $order->total_amount,
            'bank' => 'required|string',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('proof_image')->store('payment-proofs', 'public');

        Payment::create([
            'order_id' => $order->id,
            'email' => $request->email,
            'account_owner' => $request->account_owner,
            'amount' => $request->amount,
            'bank' => $request->bank,
            'proof_image' => $imagePath,
            'status' => 'pending',
        ]);

        $order->update(['status' => 'processing']);

        return redirect()->route('orders.status', $order)->with('success', 'Payment proof uploaded successfully!');
    }

    public function status(Order $order)
    {
        $order->load('payment');
        return view('orders.status', compact('order'));
    }

    public function history()
    {
        $orders = Order::with('items.product', 'payment')->where('user_id', Auth::id())->latest()->get();
        return view('orders.history', compact('orders'));
    }

    /**
     * Mark an order as completed (admin action) and finalize transaction recap.
     */
    public function markAsCompleted(Request $request, Order $order)
    {
        // Only allow if order is not already completed
        if ($order->status === 'completed') {
            return redirect()->back()->with('info', 'Order already completed.');
        }

        $order->update(['status' => 'completed']);

        // Finalize: create transaction and transaction_details
        $this->finalizeOrder($order);

        return redirect()->back()->with('success', 'Order marked as completed and transaction recorded.');
    }

    /**
     * Finalize order into transactions and transaction_details.
     * Uses Eloquent and respects existing table structures.
     */
    protected function finalizeOrder(Order $order)
    {
        DB::transaction(function () use ($order) {
            $user = $order->user;

            // Map or create customer using user's email (avoid schema change)
            $customer = Customer::firstOrCreate(
                ['email' => $user->email],
                [
                    'name' => $user->name ?? 'Unknown',
                    'phone' => $user->phone ?? null,
                    'address' => $user->address ?? null,
                ]
            );

            // Prevent duplicate recap: check existing transaction for same customer + total + date
            $exists = Transaction::where('customer_id', $customer->id)
                ->where('total', $order->total_amount)
                ->whereDate('created_at', $order->updated_at ? $order->updated_at->toDateString() : now()->toDateString())
                ->exists();

            if ($exists) {
                return; // already recorded
            }

            // Create transaction (created_at set to order updated time if available)
            $transaction = Transaction::create([
                'customer_id' => $customer->id,
                'total' => $order->total_amount,
                'status' => 'completed',
                'transaction_date' => $order->updated_at ?? now(),
                'created_at' => $order->updated_at ?? now(),
                'updated_at' => $order->updated_at ?? now(),
            ]);

            // Create transaction details from order items
            foreach ($order->items as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }
        });
    }

    public function updatePaymentStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,rejected',
        ]);

        $payment->update(['status' => $request->status]);

        // If verified, mark order as completed and create transaction recap
        if ($request->status === 'verified') {
            $payment->order->update(['status' => 'completed']);
            $this->finalizeOrder($payment->order);
        }

        return redirect()->back()->with('success', 'Payment status updated successfully!');
    }
}