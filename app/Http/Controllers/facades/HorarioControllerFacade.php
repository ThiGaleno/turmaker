<?php
namespace App\Http\Controllers\facades;

use DB;
class HorarioControllerFacade{
       
    function gerarHorarios(){

        $turmaSelects = [] ;            
            $dias = ["segunda", "terça", "quarta", "quinta", "sexta"];           
            $aulas = [1, 2, 3, 4];
            //$turmas = [1, 2, 3, 4];
            $periodos = ['matutino', 'vespertino'];

        foreach($periodos as $periodo){ 
            foreach($dias as $dia){
                foreach($aulas as $aula){
                    $ordemAula[$aula] = DB::select(
                        "SELECT materias.id as idMateria, materias.nome as materia FROM horarios 
                        inner join turmas on horarios.turmas_id = turmas.id
                        right join materias on horarios.materias_id = materias.id
                        and turmas.periodo = '$periodo'
                        and horarios.dia = '$dia'
                        and horarios.ordem_aula = '$aula'
                        WHERE turmas.nome is null"
                    );
                }
                $ordemDia[$dia] = $ordemAula;
            }
            $ordemPeriodo[$periodo] = $ordemDia;
        }
        $turmaSelects = $ordemPeriodo; 
        //dd($turmaSelects);  //<------------> Descubra o resultado/estrutura de array que essa bagaceira de cima monta
        return $turmaSelects;
    }
}
