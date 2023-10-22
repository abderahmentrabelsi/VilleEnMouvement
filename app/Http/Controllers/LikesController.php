<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Auth;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function store(Request $request)
    {$user_id = Auth::id();
        $post_id = $request->post_id;
    
        $like = Likes::where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->first();
    
        if ($like) {
            $like->delete();
        } else {
            $like = new Likes;
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->save();
        }
    
        return redirect()->back();
    }
}
