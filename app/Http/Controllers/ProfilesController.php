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

    public function edit(User $user){
        // This if function provents editing the profiles of other users
        // if($user->isNot(current_user())){
        //    abort(404);
        // }
        
        // The shorter way of the if function above is:
        // abort_if($user->isNot(current_user()),403);

        // Can also use a user policy
        // $this -> authorize('edit',$user);

        return view('profiles.edit', compact('user'));
    }
}
