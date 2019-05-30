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
        $dias = Horario::all();
        //->select('horarios.id','horarios.nome','horarios.data_nascimento','horarios.turno','horarios.categoria','turmas.nome as turmas')
       
       
        $numero = 0;
        $horarios =  DB::table('horarios')
            ->join('turmas', 'horarios.turmas_id', 'turmas.id')            
            ->get();


        if ($id)
        {    
            $horarioId = Horario::find($id);
            return view('horarios',compact('horarioId','horarios','turmas','numero'));                    
        } 
        else
        {
            return view('horarios',compact('horarios','turmas','numero'));            
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
