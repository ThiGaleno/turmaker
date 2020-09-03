<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Http\Requests\CadastroAlunosRequest;
use App\Turma;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function index($id = null)
    {
        $turmas = Turma::all();

        $alunos =  DB::table('alunos')
            ->join('turmas', 'alunos.turmas_id', 'turmas.id')
            ->select('alunos.id', 'alunos.nome', 'alunos.data_nascimento', 'alunos.turno', 'alunos.categoria', 'turmas.nome as turmas')
            ->get();

        if ($id) {
            $alunoId = Aluno::find($id);
            return view('alunos', compact('alunoId', 'alunos', 'turmas'));
        }

        return view('alunos', compact('alunos', 'turmas'));
    }

    public function cadastrar(CadastroAlunosRequest $request) //request de validação do formulário de cadastro
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
