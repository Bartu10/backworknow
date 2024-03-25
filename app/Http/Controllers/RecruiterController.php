<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecruiterController extends Controller
{
    public function index()
    {
        return Recruiter::all();
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        // Buscar el usuario por su correo electrónico
        $recruiter = Recruiter::where('email', $email)->first();

        if ($recruiter && Hash::check($password, $recruiter->password)) {
            $token = $recruiter->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => 200,
                'message' => 'Recruiter autenticado exitosamente',
                'token' => $token,
                'data' => [
                    'recruiter' => $recruiter,
                ]


        ], 200);
        } else {
            return response()->json(['error' => 'Correo electrónico o contraseña incorrectos'], 401);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:recruiters,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $recruiter = Recruiter::create($request->all());

        return response()->json($recruiter, 201);
    }

    public function show($id)
    {
        $recruiter = Recruiter::findOrFail($id);
        return response()->json($recruiter);
    }

    public function update(Request $request, $id)
    {
        $recruiter = Recruiter::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:recruiters,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $recruiter->update($request->all());

        return response()->json($recruiter);
    }

    public function destroy($id)
    {
        $recruiter = Recruiter::findOrFail($id);
        $recruiter->delete();
        return response()->json(null, 204);
    }
}
