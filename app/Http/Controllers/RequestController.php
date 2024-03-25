<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function index()
    {
        return Request::all();
    }

    public function showRequests($userId)
    {
        $request = Request::with('work', 'recruiter')->where('user_id', $userId)->get();

        return response()->json($request);
    }

    public function showWorks($recruiterId)
    {
        $request = Request::with('user', 'work')->where('recruiter_id', $recruiterId)->get();

        return response()->json($request);
    }

    public function changeStatus($id, $status)
    {
        $request = Request::findOrFail($id);
        $request->status = $status;
        $request->save();
        return response()->json($request);
    }


    public function store(HttpRequest $httpRequest)
    {
        $validator = Validator::make($httpRequest->all(), [
            // Define las reglas de validación aquí
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $request = Request::create($httpRequest->all());
        return response()->json($request, 201);
    }

    public function show($id)
    {
        $request = Request::findOrFail($id);
        return response()->json($request);
    }

    public function update(HttpRequest $httpRequest, $id)
    {
        $request = Request::findOrFail($id);

        $validator = Validator::make($httpRequest->all(), [
            // Define las reglas de validación aquí
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $request->update($httpRequest->all());
        return response()->json($request);
    }

    public function destroy($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();
        return response()->json(null, 204);
    }
}
