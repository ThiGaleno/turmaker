<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $professors = Professor::all();
            $prof = Professor::find($id);

            return view('professores',compact('prof','professors'));
        }

        $professors = Professor::all();

        return view('professores',compact('professors'));
    }

    public function cadastrar(Request $request)
    {
        $professors = $request->all();
        Professor::create($professors);

        return redirect()->route('professores');
    }

    public function atualizar(Request $request, $id)
    {
        $professors = $request->all();
        Professor::find($id)->update($professors);

        return redirect()->route('professores');
    }

    public function deletar($id)
    {
        Professor::destroy($id);

        return redirect()->route('professores');
    }


}


