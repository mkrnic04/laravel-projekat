<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::latest()->take(8)->get();

        return view('pages.index', compact('latestProducts'));
    }
}
