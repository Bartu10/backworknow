<?php

namespace App\Http\Controllers;

use App\Models\Experiencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExperienciaController extends Controller
{
    public function index()
    {
        return Experiencia::all();
    }

    public function store(Request $request)
    {
        return Experiencia::create($request->all());
    }

    public function show(Experiencia $experiencia)
    {
        return $experiencia;
    }

    public function update(Request $request, Experiencia $experiencia)
    {
        $experiencia->update($request->all());
        return $experiencia;
    }

    public function destroy(Experiencia $experiencia)
    {
        $experiencia->delete();
        return response()->json(null, 204);
    }
}
