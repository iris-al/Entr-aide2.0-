<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body', 'user_id','ad_id','username', 'like','dislike'
    ];
    public function user() {
        $this->belongsTo('App\User');
    }
    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }
}
