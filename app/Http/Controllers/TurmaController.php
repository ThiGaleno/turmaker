<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use App\Professor;
use App\Horario;
use DB;
class TurmaController extends Controller
{
    public function preencherHorarios($id) //preenche todos os horários de uma nova TURMA com "<vazio>" para exibição correta na view horários 
    {
        $dias = array("segunda", "terça", "quarta", "quinta", "sexta");
        foreach ($dias as $dia){
            
            for ($ordem_aula = 1; $ordem_aula < 5 ; $ordem_aula++) 
            {
                DB::table('horarios')->insert([
                    ['dia' => $dia, 'ordem_aula' => $ordem_aula, 'turmas_id' => $id, 'professores_id' => 1, 'materia' => '<vazio>']
                ]);
            }
        }        
    }

    public function index($id = null)
    {        
        $professores = Professor::all();

        $turmas = DB::table('turmas')
        ->join('professors', 'turmas.professores_id', 'professors.id') 
        ->select('turmas.nome as turma','professors.nome as professor','periodo','turmas.id','professores_id')   
        ->get();

        if ($id)
        {           
         
            $turmaId = Turma::find($id);           
            return view('turmas',compact('turmaId','turmas','professores'));   
                   
        } else 
        {
          
            return view('turmas',compact('turmas','professores'));
            
        }

    }

    public function cadastrar(Request $request)
    {
        $turmas = $request->all();
        $id = Turma::create($turmas)->id;
        TurmaController::preencherHorarios($id);
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
