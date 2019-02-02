<?php 

namespace App\Http\Controllers;

use App\StatusRisks;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions;
use Illuminate\Http\JsonResponse;

class StatusRisksController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $riskstatus =StatusRisks::all();
      return view('list_riskstatus', compact('riskstatus'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request)
  {
      //return "sfs";
     // dd($request->all());

      if($request->ajax())
      {
          $riskstatus =  StatusRisks::create($request->all());

          return response()->json($riskstatus);
      }
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
          $riskstatus =  StatusRisks::create($request->all());

          return response()->json($riskstatus);
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
          $riskstatus =  StatusRisks::find($request->id);
          return Response($riskstatus);
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
      StatusRisks::destroy($request->id);

  }

    public function UpdateStatusRisks(Request $request)
    {

        if($request->ajax())
        {

            //recuperation de la clé d'un enregistrement
            $riskstatus =  StatusRisks::find($request->id);

            // recuperation de champ modifier
            $riskstatus->libelle = $request->libelle;

            $riskstatus->valeur = $request->valeur;


            //enregistrement des modifications
            $riskstatus->save();

            return Response($riskstatus);
        }
    }


  
}

?>