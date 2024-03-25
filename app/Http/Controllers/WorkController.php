<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    public function index()
    {
        return Work::all();
    }

    public function getMyWorks($recruiterId){
        $works = Work::where('recruiter_id', $recruiterId)->get();
        return response()->json($works);
    }

    public function getWorkRequests($workId)
    {
        $work = Work::findOrFail($workId);
        $requests = $work->requests; // Obtén todas las solicitudes asociadas al trabajo
        return response()->json($requests);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'contract_type' => 'required|string',
            'specialization' => 'required|string',
            'salary' => 'required|numeric',
            'recruiter_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $work = Work::create($request->all());

        return response()->json($work, 201);
    }

    public function show($id)
    {
        $work = Work::findOrFail($id);
        return response()->json($work);
    }

    public function update(Request $request, $id)
    {
        $work = Work::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'contract_type' => 'required|string',
            'specialization' => 'required|string',
            'salary' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $work->update($request->all());

        return response()->json($work);
    }

    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();
        return response()->json(null, 204);
    }
}
