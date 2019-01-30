<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menaces extends Model 
{

    protected $table = 'menace';
    public $timestamps = true;
    protected $fillable = array('nom_menace', 'description_menace', 'solution_menace', 'protocole_id');

    public function Protocole()
    {
        return $this->hasOne('Protocoles');
    }

    public function vulnerabilite()
    {
        return $this->belongsToMany('Vulnerabilites');
    }

}