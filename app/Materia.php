<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public $timestamps = false;
    protected $table = 'materias';    
    protected $primaryKey = 'id';
    protected $fillable = ['nome'];
    //const UPDATED_AT = null;
}
