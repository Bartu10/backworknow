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

    public function recibir()
    {
        $works = Work::with('recruiter')->get();
        return response()->json($works);
    }


    public function recibirConFiltros(Request $request)
    {
        $query = Work::query();

        // Verifica si se proporcionó la especialización como filtro
        if ($request->has('especializacion')) {
            $query->where('specialization', $request->input('especializacion'));
        }

        // Verifica si se proporcionó el tipo de contrato como filtro
        if ($request->has('tipo_contrato')) {
            $query->where('contract_type', $request->input('tipo_contrato'));
        }

        // Verifica si se proporcionó el salario mínimo como filtro
        if ($request->has('salario_min')) {
            $query->where('salary', '>=', $request->input('salario_min'));
        }

        // Verifica si se proporcionó el salario máximo como filtro
        if ($request->has('salario_max')) {
            $query->where('salary', '<=', $request->input('salario_max'));
        }

        // Puedes agregar más filtros según tus necesidades

        // Ejecuta la consulta y carga los reclutadores relacionados
        $works = $query->with('recruiter')->get();

        return response()->json($works);
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
