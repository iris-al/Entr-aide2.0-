<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Http\Notifications\newads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CommentsController extends Controller
{
   

    public function get($id)
    {   

        $comments = Comment::where('ad_id','=',$id)->orderBy('created_at', 'desc')->get();
        
        
        
        return response()->json(['success' =>true,'comments'=>$comments]);
    }

    


    public function store(Request $request)
    {
        info('This is some useful information.'. $request->body. ' - '. $request->user_id.' - '. $request->ad_id.' - '. $request->username );
 
        $this->validate($request, [
            'body' => 'required',
            'username' => 'required',
            'user_id' => 'required',
            'ad_id' => 'required',
        ]);
        info('validation OK');
        $comment = new Comment();
        $comment->body = $request->body;
        info('get body OK');
        $comment->username = $request->username;
        info('get username OK');
        $comment->user_id = $request->user_id;
        info('get user_id OK');
        $comment->ad_id = $request->ad_id;
        info('get ad_id OK');
        $comment->like = 0;
        $comment->dislike=0;

        $comment->save();
        return response()->json($comment);
        
    }
    public function likecomment(Request $request, $id){
        $comment= Comment::whereId($id)->first();
        $comment->like = $request->like;
        $comment->save();
        return response()->json(['comment' => $comment]);
        }

        public function dislikecomment(Request $request, $id){
            $comment= Comment::whereId($id)->first();
            $comment->dislike = $request->dislike;
            $comment->save();
            return response()->json(['comment' => $comment]);
            }

    public function delete($id)
    {
        Comment::destroy($id);

        return response()->json("ok");
    }
}

