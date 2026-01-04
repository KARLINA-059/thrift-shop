<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = 0;
        
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }
        
        return view('cart.index', compact('carts', 'total'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->stock,
        ]);

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}