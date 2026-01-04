<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get unique products by name and brand (keep the first occurrence)
        $subQuery = Product::selectRaw('MIN(id) as id')
            ->groupBy('name', 'brand')
            ->toSql();

        $query = Product::with('category')
            ->whereIn('id', function($q) use ($subQuery) {
                $q->selectRaw('MIN(id)')
                  ->from('products')
                  ->groupBy('name', 'brand');
            });

        // Filter kategori
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter harga
        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->get();

        // Get categories for filter
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function search(Request $request)
    {
        // Get unique products by name and brand (keep the first occurrence)
        $query = Product::with('category')
            ->whereIn('id', function($q) {
                $q->selectRaw('MIN(id)')
                  ->from('products')
                  ->groupBy('name', 'brand');
            });

        $search = $request->input('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter harga
        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->get();

        // Get categories for filter
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }
}