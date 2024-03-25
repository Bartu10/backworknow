<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        // Obtener todos los chats
        $chats = Chat::all();
        return response()->json($chats);
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'recruiter_id' => 'required|exists:recruiters,id'
        ]);

        // Crear un nuevo chat
        $chat = Chat::create($request->all());
        return response()->json($chat, 201);
    }

    public function show($id)
    {
        // Obtener un chat por su ID
        $chat = Chat::findOrFail($id);
        return response()->json($chat);
    }
}
