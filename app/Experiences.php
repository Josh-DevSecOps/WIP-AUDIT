<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiences extends Model 
{

    protected $table = 'Experience';
    public $timestamps = true;
    protected $fillable = array('name', 'description');

    public function vulnerabilite()
    {
        return $this->belongsToMany('App\Vulnerabilites','experiencesvulnerabilites','experiences_id','vulnerabiltes_id');
    }

}