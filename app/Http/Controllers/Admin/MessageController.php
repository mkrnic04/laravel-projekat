<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Lista svih poruka
    public function index()
    {
        // najnovije prve
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    // Prikaz jedne poruke i menjanje statusa u pročitano
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        // Čim se otvori poruka, označavamo je kao pročitanu
        if(!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    // Brisanje poruke
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Poruka je obrisana.');
    }
}
