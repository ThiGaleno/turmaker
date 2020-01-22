<?php

namespace App\Http\Controllers;

use App\Http\Controllers\facades\HorarioControllerFacade;
use Illuminate\Http\Request;
use App\Turma;
use App\Professor;
use App\Horario;
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
    public function preencherHorarios($id, $turmas)
    {
        $dias = HorarioControllerFacade::DIAS;

        if (empty($id)) {
            throw new \InvalidArgumentException('O Id selecionado é inválido');
        }

        if (empty($turmas)) {
            throw new \InvalidArgumentException('A Turma selecionada é inválida');
        }

        foreach ($dias as $dia){
            $this->horarioModel->salvarAulas($dia, $id, $turmas);
        }
    }

    public function index($id = null)
    {
        $professores = Professor::all();

        $turmas = DB::table('turmas')
        ->join('professors', 'turmas.professores_id', 'professors.id')
        ->select('turmas.nome as turma','professors.nome as professor','periodo','turmas.id','professores_id')
        ->get();

        if ($id) {
            $turmaId = Turma::find($id);

            return view('turmas',compact('turmaId','turmas','professores'));
        }

        return view('turmas',compact('turmas','professores'));
    }

    public function cadastrar(Request $request)
    {
        $turmas = $request->all();
        $id = Turma::create($turmas)->id;
        TurmaController::preencherHorarios($id, $turmas);

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
        Horario::where('turmas_id',"$id")
        ->delete();

        Turma::destroy($id);

        return redirect()->route('turmas');
    }

}
