<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Turma;
use DB;
class AlunoController extends Controller
{
    public function index($id = null)
    {        
        $turmas = Turma::all();

        if ($id)
        {               
            $alunos = Aluno::all();            
            $alunoId = Aluno::find($id);

            return view('alunos',compact('alunoId','alunos','turmas'));   
                   
        } else 
        {
            $alunos =  DB::table('alunos')
            ->join('turmas', 'alunos.turmas_id', 'turmas.id') 
            ->select('alunos.id','alunos.nome','alunos.data_nascimento','alunos.turno','alunos.categoria','turmas.nome as turmas')   
            ->get();
            
          //$alunos = Aluno::all();           
            return view('alunos',compact('alunos','turmas'));
            
        }

    }

    public function cadastrar(Request $request)
    {
        $alunos = $request->all();
        Aluno::create($alunos);
        return redirect()->route('alunos');
    }

    public function atualizar(Request $request, $id)
    {
        $alunos = $request->all();
        Aluno::find($id)->update($alunos);
        return redirect()->route('alunos');
        
    }

    public function deletar($id)
    {
        Aluno::destroy($id);
        return redirect()->route('alunos');
    }
    
}
