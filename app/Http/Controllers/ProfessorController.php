<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{
    
    public function index($id = null)
    {        
        
        if ($id)
        {     
            echo ("<script> alert('teste2'); </script>");        
            $professors = Professor::all();
            $prof = Professor::find($id);
            return view('professores',compact('prof','professors'));   
                   
        } else 
        {
            echo ("<script> alert('teste'); </script>");
            $professors = Professor::all();
            return view('professores',compact('professors'));
            
        }

    }

    public function cadastrar(Request $request)
    {
        $professors = $request->all();
        Professor::create($professors);
        return redirect()->route('professores');
    }

    /*public function editar($id)
    {

        $professors = Professor::find($id);
        return view('professores',compact($professors));
   

    public function editar($id)
    {
        $prof = Professor::find($id);
        return view('professores',compact($prof));
    }
     }*/
}


