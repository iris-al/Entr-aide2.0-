<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

class newletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:newletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'envoie des annonces par mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
      $ads = DB::table('ads')
      ->join('users', 'users.id', '=', 'ads.user_id') 
      ->select('ads.*', 'users.latitude', 'users.longitude')
      ->orderBy('created_at','DeSC')->paginate(5);
      $user =  DB::table('users')
      ->select('users.email')
      ->orderBy('created_at','DeSC')->paginate(100);
      $table = array(); 
      $i =0;
      foreach ($ads as $ad){
        info('field : '.$ad->title);
        info('field : '.$ad->description);
        info('field : '.$ad->localisation);
        info('field : '.$ad->categorie);

        $table[$i]['title'] = $ad->title;
        $table[$i]['description'] = $ad->description;
        $table[$i]['localisation'] =$ad->localisation;
        $table[$i]['categorie'] =$ad->categorie;

        $i++;
      }
      $mail = array();  
      $j =0;
      foreach ($user as $us){
        info('field : '.$us->email);
        $mail[$j]['email'] = $us->email;
        $j++;
      }
      Mail::to($mail)->send(new newsletter($table));
    }
}
