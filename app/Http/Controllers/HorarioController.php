<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horario;
use App\Turma;
use DB;
class HorarioController extends Controller
{
    public function index($id = null)
    {        
        $turmas = Turma::all();

        /*$horarios =  DB::table('horarios')
            ->join('turmas', 'horarios.turmas_id', 'turmas.id') 
            ->select('horarios.id','horarios.nome','horarios.data_nascimento','horarios.turno','horarios.categoria','turmas.nome as turmas')   
            ->get();
        */
        $horarios = Horario::all();

        if ($id)
        {                       
            $horarioId = Horario::find($id);

            return view('horarios',compact('horarioId','horarios','turmas'));   
                   
        } 
        else
        {
            return view('horarios',compact('horarios','turmas'));            
        }

    }

    public function cadastrar(Request $request)
    {
        $horarios = $request->all();
        Horario::create($horarios);
        return redirect()->route('horarios');
    }

    public function atualizar(Request $request, $id)
    {
        $horarios = $request->all();
        Horario::find($id)->update($horarios);
        return redirect()->route('horarios');
        
    }

    public function deletar($id)
    {
        Horario::destroy($id);
        return redirect()->route('horarios');
    }
    
}
