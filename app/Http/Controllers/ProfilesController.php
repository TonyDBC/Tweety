<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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

    public function update(User $user){
        $attributes = request()->validate([
            // Need to ignore the current user
            'username' => ['string', 'required', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)],
            'name' => ['string', 'required', 'max:255'],
            'avatar' => ['file'],
            'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            // 'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed']
        ]);

        if(request('avatar')){
            $attributes['avatar'] = request('avatar')->store('avatars');
        }
        
        // Make the password encrypted again
        // $attributes['password'] = Hash::make($attributes['password']);
        
        $user->update($attributes);

        return redirect($user->path());
    }
}
