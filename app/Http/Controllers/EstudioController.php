<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudio::all();
    }

    public function store(Request $request)
    {
        return Estudio::create($request->all());
    }

    public function show(Estudio $estudio)
    {
        return $estudio;
    }

    public function update(Request $request, Estudio $estudio)
    {
        $estudio->update($request->all());
        return $estudio;
    }

    public function destroy(Estudio $estudio)
    {
        $estudio->delete();
        return response()->json(null, 204);
    }
}
