<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    public $timestamps = false;
    protected $table = 'turmas';    
    protected $primaryKey = 'id';
    protected $fillable = ['periodo', 'nome', 'professores_id'];
    //const UPDATED_AT = null;
}
