<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function showEstudios($userId){

        $user = User::findOrFail($userId);
        $estudios = $user->estudios;
        return response()->json($estudios);
    }


    public function showExperiencias($userId){

        $user = User::findOrFail($userId);
        $experiencias = $user->experiencias;
        return response()->json($experiencias);
    }

    public function chatsWithMessages($userId)
    {
        // Verificar si el usuario existe
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Cargar los chats del usuario con los mensajes asociados
        $chatsWithMessages = $user->chats()->with('messages')->get();

        return response()->json($chatsWithMessages);

    }

    public function register(Request $request){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
    ]
);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    return response()->json(['message' => 'Usuario creado exitosamente', "status" => 201], 201);
    }


    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        // Buscar el usuario por su correo electrónico
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => 200,
                'message' => 'Usuario autenticado exitosamente',
                'token' => $token,
                'data' => [
                    'user' => $user,
                ]


        ], 200);
        } else {
            return response()->json(['error' => 'Correo electrónico o contraseña incorrectos'], 401);
        }
    }



    public function showUserProfile($userId)
{
    $user = User::with('estudios', 'experiencias')->findOrFail($userId);
    return $user;
}



   public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->fill($request->all());
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
