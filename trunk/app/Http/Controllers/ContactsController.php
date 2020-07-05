<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Auth;


class ContactsController extends Controller
{
    public function get( $id){
        
       // $contacts= User::all();
        $contacts = User::where('id', '!=', $id)->get();
        return  response()->json($contacts);
        //$contacts= User::all();
        // response()->json($contacts);
    }
    //recuperer tous les messages envoyer par id et tous les messages qu'on lui envoie
    function getMessagesFor( $id,$contact){
        
       //  $messages = DB::table('messages')->where([
            // ['from', '==', $id],
           //  ['to', '==', $contact],
         //])->get();// ->Where([
           // ['from', '==', $request->contact_id],
           // ['to', '==', $request->id],
       // ])->get();
        
      //$messages=Message::where('from','==',$request->id, '&&', 'to','==',$request->contact_id) ->orWhere('from','==',$request->contact_id, '&&', 'to','==', $request->id)->get();
        $messages = Message::where(function($q) use ($id,$contact) {
         $q->where('from', $id);
         $q->where('to', $contact);
       })->orWhere(function($q) use ( $id,$contact) {
         $q->where('from',$contact);
         $q->where('to', $id);
     }) ->get();
        return  response()->json($messages);

    }
    //permet l'enregistrement d'un message dans la base de données
    public function send (Request $request){
       //  $authController = new AuthController();
       //  $s = $authController->me().id;
        
    
        
        
        $message=Message::create([
            'from'=> $request->from,
            'to' =>$request->contact_id,
            'text'=>$request->text
        ]);
        return response()->json($message);
    }

}
