<?php

namespace App\Repositories;

use App\Http\Controllers\facades\HorarioControllerFacade;
use App\Horario;

class TurmaRepository
{
    private $horarioModel;
    public function __construct(Horario $horarioModel)
    {
        $this->horarioModel = $horarioModel;
    }

    public function preencherHorarios($id, $turmas)
    {

        $dias = HorarioControllerFacade::DIAS;

        if (empty($id)) {
            throw new \InvalidArgumentException('O Id selecionado é inválido');
        }

        if (empty($turmas)) {
            throw new \InvalidArgumentException('A Turma selecionada é inválida');
        }

        foreach ($dias as $dia) {
            $this->horarioModel->salvarAulas($dia, $id, $turmas);
        }
    }
}
