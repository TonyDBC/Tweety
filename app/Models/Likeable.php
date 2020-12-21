<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait Likeable{

    public function scopeWithLikes(Builder $query){
        // leftJoinSub($query, $as, $first) are the parameters for this querybuilder
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function like($user = null, $liked = true){
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id()
        ],[
            'liked' => $liked
        ]);
    }

    public function dislike($user = null){
        return $this->like($user, false);
    }

    public function isLikedBy(User $user){
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', true)->count();
    }

    public function isDislikedBy(User $user){
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', false)->count();
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    
}