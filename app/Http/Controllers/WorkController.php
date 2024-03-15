<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::all();
        return response()->json($works);
    }
}

