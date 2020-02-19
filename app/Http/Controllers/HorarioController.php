<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\facades\HorarioControllerFacade;
use App\Horario;
use App\Turma;
use Exception;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    public function index($id = null)
    {
        $turmas = Turma::all();
        $dias = Horario::all();

        $horarios = DB::table('horarios') //Preenche os horários na página de horários
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
        }

        return view('horarios', compact('horarios', 'turmas'));
    }

    public function cadastrar(Request $request)
    {
        $horarios = $request->all();
        Horario::create($horarios);

        return redirect()->route('horarios');
    }

    public function atualizar(Request $request, $id)
    {


        collect($horarios = $request->all());

        $dia =  $horarios['dia'];
        $ordem_aula = $horarios['ordem_aula'];
        $turmas_id = $horarios['turma_id'];
        $periodo = $horarios['periodo'];
        $materias_id = $horarios['id_materia'];

        try {
            return $horarios = DB::table('horarios')
                ->where('turmas_id', $turmas_id)
                ->where('ordem_aula', $ordem_aula)
                ->where('dia', $dia)
                ->update([
                    'dia' => $dia,
                    'ordem_aula' => $ordem_aula,
                    'turmas_id' => $turmas_id,
                    'professores_id' => null,
                    'materia' => null,
                    'materias_id' => $materias_id,
                    'status' => null,
                ]);
        } catch (Exception $error) {
            return $error;
        }


        /*Horario::find($id)->update($horarios);
        return redirect()->route('horarios');
        */
    }

    public function deletar($id)
    {
        $horarios = DB::table('horarios')
            ->where('turmas_id', $id)
            ->delete();

        return route('turma.deletar', $id);
    }
}
