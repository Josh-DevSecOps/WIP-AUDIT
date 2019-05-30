<?php 

namespace App\Http\Controllers;

use App\Menaces;
use App\StatusRisks;
use App\Vulnerabilites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class VulnerabilitesController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $vulnerabilites = DB::table('vulnerabilte')
          ->join('statusRisk','statusRisk.id','=','vulnerabilte.statusrisk_id')
          ->join('menace','menace.id','=','vulnerabilte.menace_id')
          ->get();

      return view('list_vulnerabilites', ['vulnerabilites'=>$vulnerabilites,'menaces'=>Menaces::all(),'statusrisks'=>StatusRisks::all()]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

     // dd($request->all());

      if($request->ajax())
      {

          $vulnerabilites = new Vulnerabilites();

          $vulnerabilites->nom_vulnerabilite = $request->nom_vulnerabilite;
          $vulnerabilites->description_vulnerabilite = $request->description_vulnerabilite;
          $vulnerabilites->methodetoutils_vulnerabilite = $request->methodetoutils_vulnerabilite;
          $vulnerabilites->impact_vulnerabilite=$request->impact_vulnerabilite;
          $vulnerabilites->solution_vulnerabilite=$request->solution;

          $vulnerabilites->probabilite_risk=$request->probabilite_risk;
          $vulnerabilites->impact_risk = $request->impact_risk;

         $vulnerabilites->value_risk_vulnerabilte = ($request->probabilite_risk * $request->impact_risk);

          $vulnerabilites->statusrisk_id = $request->riskstatus_id;
          $vulnerabilites->menace_id= $request->menace_id;

          $vulnerabilites->save();

          // $vulnerabilites =  Vulnerabilites::create($request->all());

          return response()->json($vulnerabilites);
      }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }

    public function chartjs()
    {
        $vulnerabilities = Vulnerabilites::all();
        $tableau = $vulnerabilities->toArray();


        $data = array_map(function($element){
            return $element["value_risk_vulnerabilte"];
        }, $tableau);

        $labels = array_map(function($element){
            return $element["nom_vulnerabilite"];
        }, $tableau);

        return view('list_Vulnerabilites_chartjs', ['data'=>json_encode($data), 'labels'=>json_encode($labels)]);
    }
  
}

?>