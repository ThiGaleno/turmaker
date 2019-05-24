<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public $timestamps = false;
    protected $table = 'horarios';    
    protected $primaryKey = 'id';
    protected $fillable = ['dia', 'ordem_aula', 'turmas_id', 'professores_id', 'materia'];
    //const UPDATED_AT = null;
}
