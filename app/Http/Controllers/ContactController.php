<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdminMail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $latestProducts = \App\Models\Product::orderBy('created_at', 'desc')->take(4)->get();

        return view('pages.contact', compact('latestProducts'));
    }

    // Prima podatke i šalje mejl
    public function send(Request $request)
    {
        // Validacija podataka
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|min:3|max:255',
            'message' => 'required|min:10',
        ], [
            'name.required' => 'Molimo unesite vaše ime.',
            'email.required' => 'Email adresa je obavezna.',
            'email.email' => 'Unesite validnu email adresu.',
            'message.required' => 'Molimo napišite poruku.',
            'message.min' => 'Poruka mora imati barem 10 karaktera.'
        ]);

        ContactMessage::create($data);

        \Illuminate\Support\Facades\Mail::to('milana.krnic.4.22@ict.edu.rs')->send(new \App\Mail\ContactAdminMail($data));

        return back()->with('success', 'Hvala! Vaša poruka je uspešno poslata administratoru.');
    }
}
