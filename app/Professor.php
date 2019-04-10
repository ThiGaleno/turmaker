<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    public $timestamps = false;
    protected $table = 'professors';    
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'materia'];
    const UPDATED_AT = null;

}
