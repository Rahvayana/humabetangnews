<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\News;
use App\NewsCategory;
use App\NewsUserComent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addComment(Request $request)
    {


        $request->validate(
            [
                'news_id' => 'required',
                'message' => 'required',
            ],

        );





        $user = Auth::guard('web')->user();
        $comment = new NewsUserComent([
            'users_id' => $user->id,
            'news_id' => $request->news_id,
            'text_coment' => $request->message,

        ]);

        if($comment->save()){
            return redirect()->back()->with('success', 'Success Add Comment');
        }else{
            return redirect()->back()->with('error', 'Failed Add Comment');

        }

    }


}
