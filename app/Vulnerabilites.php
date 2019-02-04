<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vulnerabilites extends Model 
{

    protected $table = 'vulnerabilte';
    public $timestamps = true;
    protected $fillable = array('nom_vulnerabilite', 'description_vulnerabilite', 'methodetoutils_vulnerabilite', 'impact_vulnerabilite', 'solution_vulnerabilite', 'probabilite_risk', 'impact_risk', 'statusrisk_id', 'menace_id');

    public function menace()
    {
        return $this->belongsTo('App\Menaces');
    }

    public function StatusRisk()
    {
        return $this->belongsTo('StatusRisks');
    }

}