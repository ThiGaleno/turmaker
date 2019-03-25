<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{
    public function index()
    {     
        $professors = Professor::all();
        return view('professores',compact('professors'));        
    }

    public function cadastrar(Request $request)
    {
        $professors = $request->all();
        Professor::create($professors);
        return redirect()->route('professores');
    }
}


