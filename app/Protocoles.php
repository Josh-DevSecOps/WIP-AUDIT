<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocoles extends Model 
{

    protected $table = 'protocole';
    public $timestamps = true;
    protected $fillable = array('nom_protocole', 'description_protocole');

    public function menace()
    {
        return $this->belongsToMany('Menaces');
    }

}