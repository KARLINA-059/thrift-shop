<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total customers
        $totalCustomers = Customer::count();

        // Total transactions
        $totalTransactions = Transaction::count();

        // Total penjualan (SUM total dari transactions)
        $totalSales = Transaction::sum('total');

        // Transaksi per bulan (untuk bar chart)
        $transactionsPerMonth = Transaction::select(
            DB::raw('YEAR(transaction_date) as year'),
            DB::raw('MONTH(transaction_date) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        // Produk per kategori (untuk pie chart)
        $productsPerCategory = TransactionDetail::join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id') // Asumsi Product punya category_id
            ->select('categories.name as category', DB::raw('SUM(transaction_details.quantity) as total_quantity'))
            ->groupBy('categories.id', 'categories.name')
            ->get();

        // Recent payments
        $recentPayments = Payment::with('order.user')->latest()->take(10)->get();

        // Recent orders
        $recentOrders = Order::with('user')->latest()->take(10)->get();

        // REPORTS: Total penjualan per bulan
        $monthlySales = Transaction::select(
            DB::raw('YEAR(transaction_date) as year'),
            DB::raw('MONTH(transaction_date) as month'),
            DB::raw('SUM(total) as total_sales')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        // REPORTS: Produk terlaris (top 5)
        $topProducts = TransactionDetail::join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('products.name', 'products.brand', DB::raw('SUM(transaction_details.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name', 'products.brand')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        // REPORTS: Jumlah transaksi per kategori
        $transactionsPerCategory = TransactionDetail::join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->select('categories.name as category', DB::raw('COUNT(DISTINCT transactions.id) as transaction_count'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('transaction_count', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalTransactions',
            'totalSales',
            'transactionsPerMonth',
            'productsPerCategory',
            'recentPayments',
            'recentOrders',
            'monthlySales',
            'topProducts',
            'transactionsPerCategory'
        ));
    }
}