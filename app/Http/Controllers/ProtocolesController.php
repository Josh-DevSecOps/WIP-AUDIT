<?php 

namespace App\Http\Controllers;

use App\Http\Requests\ProtocolsRequest;
use App\Protocoles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;



class ProtocolesController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

     $protocols =Protocoles::all();
      return view('list_protocols', compact('protocols'));
    // return view('modals');
  }



    /***
     * Fonction permettant d'enregistrer un nouveau Protocole
     */

    public function NewProtocoles(ProtocolsRequest $request)
    {

        if($request->ajax())
        {
            $protocols =  Protocoles::create($request->all());
            return Response()->json($protocols);
            // return response()->json($domaines);
        }
    }

    /***
     * Fin de la Fonction permettant d'enregistrer un nouveau Protocole
     */
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request)
  {
      if($request->ajax())
      {
          $protocols =  Protocoles::create($request->all());
          return response()->json($protocols);
      }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
     /*$prot = new Protocoles();
     $prot->nom_protocole = $request->input('nom_protocole');
     $prot->description_protocole = $request->input('description_protocole');
     $prot->save();*/

     //dd($request);

      if($request->ajax())
      {
          //dd($request->all());
          $protocols =  Protocoles::create($request->all());
          return Response()->json($protocols);

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
      ///dd($request);
      if($request->ajax())
      {
          $protocols =  Protocoles::find($request->id);
          return Response($protocols);
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
    Protocoles::destroy($request->id);
  }


    public function UpdateProtocoles(Request $request)
    {

        if($request->ajax())
        {

            //recuperation de la clé d'un enregistrement
            $protocols =  Protocoles::find($request->id);

            // recuperation de champ modifier
            $protocols->nom_protocole = $request->nom_protocole;

            $protocols->description_protocole = $request->description_protocole;


            //enregistrement des modifications
            $protocols->save();

            return Response($protocols);
        }
    }




    public function chartjs()
    {
        /*$protocols = DB::select('   SELECT COUNT(menace.id) AS numbermenace,protocole.nom_protocole as nomprot
                                    FROM `menace` 
                                    INNER JOIN protocole ON menace.protocole_id=protocole.id
                                    GROUP BY protocole.nom_protocole ');*/

        // Cette requête renvoi le nombre de menace d'un protocole donné (statistique qui montre le protocole ayant le plus de menaces)
        $protocols = DB::table('menace')
                     ->join('protocole','menace.protocole_id','=','menace.protocole_id')
                     ->select(DB::raw('COUNT(menace.id) AS numbermenace,protocole.nom_protocole as nomprot'))
                     ->GroupBy('nomprot')
                     ->get();
    dd($protocols);

        $tableau = json_decode($protocols, true);

        //$tableau = $protocols->toArray();


        $data = array_map(function($element){
            return $element["numbermenace"];
        }, $tableau);

        $labels = array_map(function($element){
            return $element["nomprot"];
        }, $tableau);

        return view('list_Protocols_chartjs', ['data'=>json_encode($data), 'labels'=>json_encode($labels)]);
    }





  
}

?>