<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();

        // Filter po kategoriji
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Pretraga
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sortiranje
        $sort = $request->get('sort');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest(); // Podrazumevano najnovije
                break;
        }

        $products = $query->paginate(6);

        if ($request->ajax()) {
            return view('shop.partials.product_list', compact('products'))->render();
        }

        return view('shop.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // Povezani proizvodi
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
