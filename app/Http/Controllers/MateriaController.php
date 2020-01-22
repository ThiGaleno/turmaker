<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;

class MateriaController extends Controller
{
    public function index($id = null)
    {
        $materias = Materia::all();
        if ($id) {
            $materiaId = Materia::find($id);
            return view('materias',compact('materiaId','materias'));
        }

        return view('materias',compact('materias'));
    }

    public function cadastrar(Request $request)
    {
        $materias = $request->all();
        Materia::create($materias);

        return redirect()->route('materias');
    }

    public function atualizar(Request $request, $id)
    {
        $materias = $request->all();
        Materia::find($id)->update($materias);

        return redirect()->route('materias');

    }

    public function deletar($id)
    {
        Materia::destroy($id);

        return redirect()->route('materias');
    }
}
