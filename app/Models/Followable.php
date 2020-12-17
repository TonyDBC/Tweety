<?php

namespace App\Models;

trait Followable{

    // Save this follow relationship
    public function follow(User $user){
        return $this->follows()->save($user);
    }

    // Use detach method to delete the relationship
    public function unfollow(User $user){
        return $this->follows()->detach($user);
    }

    public function following(User $user){
        // This code would work but it fetches a collection of everyone the user follows
        // This is vulnerable to attacks so we don't use this approach
        // return $this->follows->contains($user);
        return $this->follows()->where('following_user_id',$user->id)->exists();
    }

    // Check who a user follows
    public function follows(){
        // Check the 'follows' database. Then $foreignPivotKey and $relatedPivotKey
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    public function toggleFollow(User $user){
        // The logic is that if the user is following the other user, then click to unfollow. Otherwise click to follow.
        // if ($this->following($user)){
        //     return $this->unfollow($user);
        // }
        // return $this->follow($user);

        // The equivalent (neater) way to do the same thing is as follows:
        return $this->follows()->toggle($user);
    }
}