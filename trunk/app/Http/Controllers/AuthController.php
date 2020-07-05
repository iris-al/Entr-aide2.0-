<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthController extends Controller
{
    /* Créer une nouvelle instance AuthController à partir de controller  qui contiendra des fct
     construisant les token avec jwt */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'update', 'delete']]);
    }

    /**
     * pour obtenir un jeton jwt via les infos d'identifications données.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    /* register est la fonction qui crée un nouvel utilisateur */
    public function register(Request $request)
    {
        info('This is some useful information.'. $request->name. ' - '. $request->email.' - '. $request->password  );
        info('This is some useful information.'. $request->longitude. ' - '. $request->latitude.' - '. $request->username  );
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'adresse' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ]);
        info('validation OK');
        $user = new User();
        $user->name = $request->name;
        info('get name OK');
        $user->username = $request->username;
        info('get username OK');
        $user->bio = $request->bio;
        info('get bio OK');
        $user->email = $request->email;
        info('get email OK');
        $user->password = bcrypt($request->password);
        info('get bcrypt password OK');
        $user->adresse = $request->adresse;
        $user->longitude = $request->longitude;
        $user->latitude = $request->latitude;

        $user->save();

        return response()->json(['user' => $user]);
    }
    
    public function update(Request $request)
    {  
        info('entree OK'); 
        $user=User::whereId($request->id)->first();
    
      $user->name = $request->name;
      $user->username = $request->username;
      $user->bio = $request->bio;
      $user->email = $request->email;
      
      $user->save();
        return response()->json(['user' => $user]);
    }
   

    public function delete(Request $request)
    {   
        $user = User::find($request);
        $user->delete();
  
        return response()->json(['user' => $user]);
    }
  


    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
     public function changePassword(Request $request){

        if (!(Hash::check($request->oldpassword, Auth::user()->password))) {
            // The passwords matches
            return response()->json("error","Your current password does not matches with the password you provided. Please try again.",405);
        }


        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->newpassword);
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    /*Refresh a token
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /** Get the token array structure.
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get  the guard to be used during authentication.
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()/*pas d'argument */
    {
        return \Auth::Guard('api');
    }
}
