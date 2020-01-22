<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    public $timestamps = false;

    protected $table = 'alunos';

    protected $primaryKey = 'id';

    protected $fillable = ['nome', 'data_nascimento', 'turno', 'categoria', 'turmas_id'];
}
