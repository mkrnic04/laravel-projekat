<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class CartController extends Controller
{
    // Prikaz korpe
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }


    // Dodavanje u korpu
    public function addToCart($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        //log
        \App\Models\ActivityLog::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'action' => 'Dodavanje u korpu',
            'description' => 'Proizvod: ' . $product->name . ' je dodat u korpu.',
            'ip_address' => request()->ip()
        ]);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $product->name . ' su dodate u korpu!',
                'cartCount' => count($cart) // Šaljemo novi broj za ikonicu
            ]);
        }

        return redirect()->back()->with('success', 'Proizvod dodat u korpu!');
    }

    // Brisanje iz korpe
    // azuriranje kolicine
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            $subTotal = $cart[$request->id]['price'] * $request->quantity;

            // Računamo novo stanje cele korpe
            $total = 0;
            foreach(session('cart') as $details) {
                $total += $details['price'] * $details['quantity'];
            }

            return response()->json([
                'success' => true,
                'subTotal' => number_format($subTotal, 2) . ' RSD',
                'total' => number_format($total, 2) . ' RSD'
            ]);
        }
    }

    // brisanje iz korpe
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            // novo stanje cele korpe
            $total = 0;
            foreach((array) session('cart') as $details) {
                $total += $details['price'] * $details['quantity'];
            }

            return response()->json([
                'success' => true,
                'cartCount' => count((array) session('cart')),
                'total' => number_format($total, 2) . ' RSD'
            ]);
        }
    }
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart');

        if(!$cart) {
            return redirect()->route('shop.index')->with('error', 'Korpa je prazna!');
        }

        // Validacija podataka sa forme
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        // Ukupna cena
        $total_price = 0;
        foreach($cart as $details) {
            $total_price += $details['price'] * $details['quantity'];
        }

        // u tabelu orders
        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'message' => $request->message,
            'total_price' => $total_price,
            'status' => 'Na čekanju'
        ]);

        // order_items
        foreach($cart as $product_id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // isprazni korpu
        session()->forget('cart');

        return redirect()->route('shop.index')->with('success', 'Uspešno ste izvršili narudžbinu! Hvala na poverenju.');
    }

    public function checkout()
    {
        $cart = session()->get('cart');
        if(!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Vaša korpa je prazna!');
        }

        return view('shop.checkout', compact('cart'));
    }
}
