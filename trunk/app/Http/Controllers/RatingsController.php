<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth', ['except' => ['setRating', 'getrating']]);
  }

  public function setRating(Request $request) {

    $rate_db = Rating::where('user_id', $request->user_id)->where( 'ads_id', $request->ads_id)->first();
    
    // si l'utilisateur a deja voté pour la meme annonce, alors on doit updater
    if(!is_null($rate_db)){  
      
      $rate_db->update($request->toArray());
    }else{ // sinon enregristrer un nouvel enregistrement
     
      $rate = new Rating();

      $rate->user_id = $request->user_id;
      $rate->ads_id = $request->ads_id;
      $rate->rating = $request->rating;
      
      $rate->save();
    }      
  
    return response()->json(['success' =>true]);
}

public function getrating($id){
  return Rating::all()->where('ads_id', $id);
}
    
 
}
