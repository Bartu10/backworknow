<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los mensajes
        $messages = Message::all();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'sender_id' => 'required',
            'sender_type' => 'required|in:user,recruiter',
            'message_text' => 'required'
        ]);

        // Crear un nuevo mensaje
        $message = Message::create($request->all());
        return response()->json($message, 201);
    }

    public function show($id)
    {
        // Obtener un mensaje por su ID
        $message = Message::findOrFail($id);
        return response()->json($message);
    }

}
