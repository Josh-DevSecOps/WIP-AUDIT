<?php 

namespace App\Http\Controllers;

use App\Menaces;
use App\Protocoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions;
use Illuminate\Http\JsonResponse;




class MenacesController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $menaces = DB::table('menace')
          ->join('protocole','protocole.id','=','menace.protocole_id')
          ->get();

    /*  $moyonnevaluerisk = DB::table('menace')
                 ->join('vulnerabilte', 'menace.id', '=', 'vulnerabilte.menace_id')
                 ->avg('value_risk_vulnerabilte')
                  ->get();*/



      return view('list_menaces', ['menaces'=>$menaces,'protocoles'=>Protocoles::all()]);
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
      if($request->ajax())
      {
          $menaces =  Menaces::create($request->all());

          return response()->json($menaces);
      }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Request $request)
  {

      if($request->ajax())
      {
          $menaces =  Menaces::find($request->id);
          return Response($menaces);
      }
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
  public function destroy(Request $request)
  {
      Menaces::destroy($request->id);

  }

  //update information

    public function UpdateMenaces(Request $request)
    {
   //dd($request->all());
        if($request->ajax())
        {

            //recuperation de la clé d'un enregistrement
            $menaces =  Menaces::find($request->id);

            // recuperation de champ modifier
            $menaces->nom_menace = $request->nom_menace;
            $menaces->description_menace = $request->description_menace;
            $menaces->solution_menace = $request->solution_menace;
            $menaces->protocole_id = $request->protocole_id;


            //enregistrement des modifications
            $menaces->save();

            return Response($menaces);
        }
    }
  
}

?>