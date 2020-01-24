<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static create(array $horarios)
 */
class Horario extends Model
{
    public $timestamps = false;
    protected $table = 'horarios';
    protected $primaryKey = 'id';
    protected $fillable = ['dia', 'ordem_aula', 'turmas_id', 'professores_id', 'materia'];

    /**
     * @param string $dia
     * @param int $id
     * @param array $turmas
     */
    public function salvarAulas($dia, $id, $turmas = [])
    {
        for ($ordemAula = 1; $ordemAula < 5 ; $ordemAula++) {
            DB::table('horarios')->insert([
                ['dia' => $dia, 'ordem_aula' => $ordemAula, 'turmas_id' => $id, 'professores_id' => $turmas['professores_id'], 'materias_id' => '9']
            ]);
        }
    }
}
