<?php

namespace App\Http\Controllers;

use App\Ad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdStore;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\newsletter;


class AdController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['except' => ['index', 'nouveau', 'create', 'store', 'search', 'update', 'updateCount', 'get', 'delete']]);
  }
    
    use RegistersUsers;

    
    public function index(){
      //pour récuperer les annonces avec les coordonnées du user qui l'a créé
      $ads = DB::table('ads')
      ->join('users', 'users.id', '=', 'ads.user_id') 
      ->select('ads.*', 'users.latitude', 'users.longitude')
      ->orderBy('created_at','DeSC')->paginate(5);
      $user =  DB::table('users');
      foreach ($ads as $ad){
        info('field : '.$ad->title);
        info('field : '.$ad->description);
        info('field : '.$ad->localisation);
        info('field : '.$ad->categorie);
      }
      return response()->json(['success' =>true,'ads'=>$ads]);
    }


    public function create(){
     return view('create');
    }
   
    
    /**
     * function qui rajoute une annonce a la base de données
     */
    public function store(AdStore $request){
        $validated =$request ->validated();
        $request ->validated([
            'title'=> 'required',
            'description'=> 'required',
            'localisation'=> 'required',
            'categorie'=> 'required',
            'user_id'=> 'required',
         ]); 
        // info('store OK');
        // info('This is some useful information.'. $request->title. ' - '. $request->description.' - '. $request->categorie.' - '.$request->user_id);
        $ad=new Ad();
        $ad->title =$validated['title'];
        $ad->description =$validated['description'];
        $ad->localisation =$validated['localisation'];
        $ad->categorie =$request->categorie;
        $ad->user_id =$validated['user_id'];
        $ad->nbr_vue = 0;
        $ad->filename = $request->filename;
        $ad->count = 0;
        $ad->save();
        //return redirect()-> route('/')->with('success','votre annonce a été posté');    
        return response()->json(['ad' => $ad]);
    } 

    /**
     * function pour effectuer une annonce :
     * title, 
     * description
     * localisation
     * categorie
     * 
     */
  public function search(Request $request){
    $words=$request->words;
    info('request recherche : '. $request->words);
    //pour stocker les mots de la recherche
    $ads=DB::table('ads')
    ->where('title','LIKE',"%$words%")
    ->orwhere('description','LIKE',"%$words%")
    ->orwhere('localisation','LIKE',"%$words%")
    ->orwhere('categorie','LIKE',"%$words%")
    ->orderBy('created_at','DESC')
    ->paginate(5);
    info('fin recherche. '.count($ads));
    foreach ($ads as $ad){
      info('field : '.$ad->title);
      info('field : '.$ad->description);
      info('field : '.$ad->localisation);
      info('field : '.$ad->categorie);
    }

    return response()->json(['success' =>true,'ads'=>$ads]);
  }
  /**
   * function update annonce
   * prend en argument l'annonce et son identifiant 
   */
  public function update(AdStore $request, $id)
    {   
      $ads = Ad::whereId($id)->first();
      $ads->title = $request->title;
      $ads->description = $ads->description;
      $ads->categorie = $ads->categorie;
      $ads->localisation = $ads->localisation;
      $ads->filename = $request->filename;
      $ads->save();
      //$annonce=DB::table('ads')->where('id', $id)->update($ads->toArray());
      return response()->json(['ad' => $ads]);
    }
    /**
   * function updateCount 
   * prend en argument l'annonce et son identifiant et lui ajoute un like dans la BD
   */
    public function updateCount(AdStore $request, $id){    
    $ads = Ad::whereId($id)->first();
    $ads->count = $request->count;
    $ads->save();
    return response()->json(['ad' => $ads]);
    }
    /**
     * function get Annonce by ID
     * id number of identification of annonce.
     */
  public function get($id) {
    // je récupère l'annonce dans la variable $ads
    $ads = Ad::whereId($id)->first();
  
   if($ads !=null){
     // je récupère le user associé à cette annonce
      $user =  DB::table('users')->select('id','bio','email','name', 'username', 'latitude', 'longitude')->where('id','=',$ads->user_id)->get()->first();
      //on incrémente le nbr de vue
      $ads->nbr_vue +=1;
      $ads->save();
    
      return response()->json([ "ads" => $ads, "user" => $user ], 200);
    }else{
      return response()->json([ "message" => "Aucune annonce correspondante" ], 404);
    }
   }
  /**
     * function qui supprime une annonce
     *parametre: l'identifiant de l'annonce
     */

  public function delete($id)
  {
    info('delete id suivant  : '.$id);
    DB::table('ads')->where('id', $id)->delete();

  }
}
