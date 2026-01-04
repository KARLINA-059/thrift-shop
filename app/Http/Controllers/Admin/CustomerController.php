<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::withCount('transactions')->withSum('transactions', 'total');

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Sort
        $sortBy = $request->get('sort', 'name');
        if ($sortBy == 'transactions_count') {
            $query->orderBy('transactions_count', 'desc');
        } elseif ($sortBy == 'transactions_sum_total') {
            $query->orderBy('transactions_sum_total', 'desc');
        } else {
            $query->orderBy('name');
        }

        $customers = $query->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $customer->load(['transactions' => function($q) {
            $q->latest()->take(10);
        }]);

        return view('admin.customers.show', compact('customer'));
    }
}
