<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use App\Professor;
use DB;
class TurmaController extends Controller
{
    public function index($id = null)
    {        
        $professores = Professor::all();

        if ($id)
        {           
           $turmas =  DB::table('turmas')
            ->join('professors', 'turmas.professores_id', 'professors.id') 
            ->select('turmas.nome as turma','professors.nome as professor','periodo','turmas.id')   
            ->get();
            
            $turmaId = Turma::find($id);
            return view('turmas',compact('turmaId','turmas','professores'));   
                   
        } else 
        {
          // $turmas = Turma::all();
           $turmas = DB::table('turmas')
           ->join('professors', 'turmas.professores_id', 'professors.id') 
           ->select('turmas.nome as turma','professors.nome as professor','periodo','turmas.id','professores_id')   
           ->get();
            
           
            return view('turmas',compact('turmas','professores'));
            
        }

    }

    public function cadastrar(Request $request)
    {
        $turmas = $request->all();
        Turma::create($turmas);
        return redirect()->route('turmas');
    }

    public function atualizar(Request $request, $id)
    {
        $turmas = $request->all();
        Turma::find($id)->update($turmas);
        return redirect()->route('turmas');
    }

    public function deletar($id)
    {
        Turma::destroy($id);
        return redirect()->route('turmas');
    }
    
}
