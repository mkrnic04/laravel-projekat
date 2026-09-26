<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Prikaz tabele sa svim patikama
    public function index()
    {
        // sve proizvode sa njihovim kategorijama
        $products = \App\Models\Product::with('category')->get();

        return view('admin.products.index', compact('products'));
    }

    // za dodavanje novih patika
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // cuvanje novih patika u bazu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('img/product'), $imageName);
        $path = 'img/product/' . $imageName;

        \App\Models\Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $path
        ]);

        return redirect()->route('products.index')->with('success', 'Patike uspešno dodate!');
    }

    // Prikaz forme za izmenu postojećih patika
    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Čuvanje izmena u bazi
    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            if(file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img/product'), $imageName);
            $product->image = 'img/product/' . $imageName;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', 'Patike uspešno izmenjene!');
    }

    // brisanje patika
    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        // brisanje proizvoda iz baze
        $product->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Patike su uspešno obrisane iz baze!'
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Proizvod je obrisan.');
    }
}
