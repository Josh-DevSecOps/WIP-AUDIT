<?php 

namespace App\Http\Controllers;

use App\Experiences;
use App\Protocoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperiencesController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
       $protocoles = Protocoles::with(['menace' => function ($query) {
               $query->with('vulnerabilite');
           }])->get();

       $experience = Experiences::all();
           /*DB::select('SELECT
Experience.id as experiences_id,Experience.name,Experience.description,
vulnerabilte.nom_vulnerabilite,
GROUP_CONCAT(Experience.name SEPARATOR ", ") AS Experience
FROM experiencesvulnerabilites
JOIN vulnerabilte ON experiencesvulnerabilites.vulnerabiltes_id = vulnerabilte.id
JOIN Experience ON experiencesvulnerabilites.experiences_id = Experience.id
GROUP BY experiencesvulnerabilites.experiences_id' );*/

       return view('list_experiences',['protocoles'=>$protocoles,'experiences'=>$experience]);
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
    //dd($request->all());

      $experiences = new Experiences([
          'name' => $request['nom_experience'],
          'description' => $request['description'],
      ]);

      $experiences->save();

      foreach ($request->vulnerabilite as $vulnerabilite){
        $experiences->vulnerabilite()->attach($vulnerabilite);
      }

      return response()->json($experiences);
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
  public function destroy(Request $experience)
  {
      $experience = Experiences::find($experience->id);
      $experience->vulnerabilite()->detach();
      $experience->delete();
  }
  
}

?>