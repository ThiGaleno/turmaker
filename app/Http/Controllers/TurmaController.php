<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Turma;
use App\Professor;
use App\Horario;
use App\Http\Requests\CadastroTurmaRequest;
use App\Jobs\PreencherHorarios;
use Illuminate\Support\Facades\DB;

class TurmaController extends Controller
{
    /** @var Horario $horarioModel */
    private $horarioModel;

    /**
     * TurmaController constructor.
     * @param Horario $horarioModel
     */
    public function __construct(Horario $horarioModel)
    {
        $this->horarioModel = $horarioModel;
    }

    /**
     * @param int $id
     * @param array $turmas
     */


    public function index($id = null)
    {
        $professores = Professor::all();

        $turmas = DB::table('turmas')
            ->join('professors', 'turmas.professores_id', 'professors.id')
            ->select('turmas.nome as turma', 'professors.nome as professor', 'periodo', 'turmas.id', 'professores_id')
            ->get();

        if ($id) {
            $turmaId = Turma::find($id);

            return view('turmas', compact('turmaId', 'turmas', 'professores'));
        }

        return view('turmas', compact('turmas', 'professores'));
    }

    public function cadastrar(CadastroTurmaRequest $request)
    {
        $turmas = $request->all();
        $id = Turma::create($turmas)->id;
        PreencherHorarios::dispatch($id, $turmas);

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
        Horario::where('turmas_id', "$id")
            ->delete();

        Turma::destroy($id);

        return redirect()->route('turmas');
    }
}
