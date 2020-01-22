<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\facades\HorarioControllerFacade;
use App\Horario;
use App\Turma;
use App\Materia;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{


    public function index($id = null)
    {
        $turmas = Turma::all();
        $dias = Horario::all();

        $horarios =  DB::table('horarios') //Preenche os horários na página de horários
            ->join('turmas', 'horarios.turmas_id', 'turmas.id')
            ->join('materias', 'horarios.materias_id', 'materias.id')
            ->select(
                'horarios.id',
                'horarios.dia',
                'horarios.ordem_aula',
                'horarios.professores_id',
                'horarios.turmas_id',
                'turmas.nome as nome',
                'turmas.periodo as periodo',
                'materias.nome as materia',
                'materias.id as idMateria'
            )
            ->orderBy('ordem_aula')
            ->get();

        if ($id) {
            $horarioId = Turma::find($id);
            $horarioUnico = new HorarioControllerFacade(); //Preenche os campos SELECT no MODAL de EDIÇÃO de horários
            $turmaSelects = $horarioUnico->gerarHorarios();
            //dd($horarioId);
            return view('horarios', compact('horarioId', 'horarios', 'turmas', 'turmaSelects'));
        } else {
            return view('horarios', compact('horarios', 'turmas'));
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
        echo "testa de marfim";
        $horarios = $request->all();
        Horario::find($id)->update($horarios);
        return redirect()->route('horarios');
    }

    public function deletar($id)
    {
        $horarios = DB::table('horarios')
            ->where('turmas_id', "$id")
            ->delete();
        return route('turma.deletar', $id);
        //return redirect()->route('horarios');
    }
}
