<?php

namespace App\Http\Controllers\facades;

use Illuminate\Support\Facades\DB;

class HorarioControllerFacade
{
    const DIAS = ["segunda", "terça", "quarta", "quinta", "sexta"];
    const AULAS = [1, 2, 3, 4];
    const PERIODOS = ['matutino', 'vespertino'];

    function gerarHorarios()
    {
        $turmaSelects = [];

        foreach (self::PERIODOS as $periodo) {
            $ordemDia = $this->getOrdemDia($periodo);
            $ordemPeriodo[$periodo] = $ordemDia;
        }
        $turmaSelects = $ordemPeriodo;

        return $turmaSelects;
    }


    /**
     * Retorna a Ordem das Aulas por Dias
     *
     * @param string $periodo
     * @param string $dia
     * @return array
     */
    public function getOrdemAula($periodo, $dia)
    {
        $ordemAula = [];

        foreach (self::AULAS as $aula) {
            $ordemAula[$aula] = DB::select(
                "SELECT `materias`.`id` as `idMateria`, `materias`.`nome` as `materia` FROM `horarios`
                        inner join `turmas` on `horarios`.`turmas_id` = `turmas`.`id`
                        right join `materias` on `horarios`.`materias_id` = `materias`.`id`
                        and `turmas`.`periodo` = '{$periodo}'
                        and `horarios`.`dia` = '{$dia}'
                        and `horarios`.`ordem_aula` = '{$aula}'
                        WHERE turmas.nome is null"
            );
        }

        return $ordemAula;
    }
    
    public function getOrdemDia($periodo)
    {
        $ordemDia = [];
        
        foreach (self::DIAS as $dia) {
            $ordemAula = self::getOrdemAula($periodo, $dia);
            $ordemDia[$dia] = $ordemAula;
        }
        
        return $ordemDia;
    }
}
