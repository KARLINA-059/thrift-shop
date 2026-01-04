<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')->take(8)->get();
        return view('home', compact('featuredProducts'));
    }

    public function about()
    {
        return view('about');
    }
}