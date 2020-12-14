<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('tweets.index',[
        // This command fetches all the tweets
        //    'tweets' => Tweet::all()

            'tweets' => auth()->user()->timeline()

        ]);
    }

    public function store(){
        // The validated information will be stored in the attributes variable
        $attributes = request()->validate(['body' => 'required | max:255']);
        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body']
        ]);

        return redirect('/home');
    }
}
