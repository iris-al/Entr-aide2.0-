<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*API Routes where you can register API routes for your application.
 These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "auth" middleware group.
*/
/*classe authController dans  app Http Controller */
Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register','AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('meId', 'AuthController@meId');
    Route::post('updateuser','AuthController@update');
    Route::post('deleteuser','AuthController@delete');
    Route::post('changePassword','AuthController@changePassword');

});

Route::group(['prefix' => 'ads'], function ($router) {
        
    Route::get('annonces', 'AdController@index');
    Route::get('annonce/{id}', 'AdController@get');
    Route::get('annonce','AdController@create');
    Route::post('annonce', 'AdController@store');
    Route::post('search', 'AdController@search');
    Route::put('updateannonce/{id}', 'AdController@update');
    Route::get('deleteannonce/{id}', 'AdController@delete');
    Route::put('updateCount/{id}', 'AdController@updateCount');
   
    Route::post('image',function(Request $request){

        $uploadedFiles=$request->pics;
        foreach ($uploadedFiles as $file){
            $filename = $file->store('dummy');
            info("LE FICHIER ".$filename);
    
        }
        
        return response(['status'=>'success', 'filename'=>$filename],200);
    
    });
});
Route::group(['prefix' => 'coms'], function ($router) {
    Route::post('comments', 'CommentsController@store');

    Route::get('comments/{id}', 'CommentsController@get');
    
    Route::delete('deletecomments/{id}', 'CommentsController@delete');
    
    Route::put('likecomment/{id}','CommentsController@likecomment');
    Route::put('dislikecomment/{id}','CommentsController@dislikecomment');
});

Route::group(['prefix' => 'rating'], function ($router) {
    Route::post('setRating', 'RatingsController@setRating');
    Route::get('getrating/{id}', 'RatingsController@getrating');
});

//routes pour les messages

Route::get('contacts/{id}', 'ContactsController@get');

Route::get('/conversation/{id}{contact}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');