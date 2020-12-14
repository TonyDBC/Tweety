<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilesController extends Controller
{
    public function show(User $user){
        // If only do return $user, then it will give a 404 not found
        // Instead need to enter the user_id, e.g. /profiles/1
        // However, need something more user-friendly such as /profiles/JohnDow
        // See User Model for the way to do this
        // return $user;

        // The compact() function creates an array from variables and their values.
        return view('profiles.show', compact('user'));
    }
}
