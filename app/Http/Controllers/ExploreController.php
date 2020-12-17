<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ExploreController extends Controller
{
    // Can either use index() or __invoke() if there is only one function in the controller
    public function __invoke(){
        return view('explore',[
            'users' => User::paginate(5)
        ]);
    }
}
