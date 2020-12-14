<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // This fetches the avatar of the email
    public function getAvatarAttribute(){
        return "https://i.pravatar.cc/40?u=" .$this->email;
    }

    public function timeline(){
        // This only gets the timeline of the current user but not anyone else
        // Move this to another function called tweets
        // return Tweet::where('user_id', $this->id)->latest()->get();

        // Get all ids the current user follows
        $friends = $this->follows()->pluck('id');

        // Method 1:
        // Add the current user's id into the array
        // $ids -> push($this->id);
        // Finally get all the tweets which belong to the user_id in the array and sort in time order
        // return Tweet::whereIn('user_id', $ids)->latest()->get();

        //Method 2:
        // User orWhere function
        return Tweet::whereIn('user_id',$friends)
            ->orWhere('user_id', $this->id)
            ->latest()->get();
    }

    public function tweets(){
        return $this->hasMany(Tweet::class);
    }

    // Save this follow relationship
    public function follow(User $user){
        return $this->follows()->save($user);
    }

    // Check who a user follows
    public function follows(){
        // Check the 'follows' database. Then $foreignPivotKey and $relatedPivotKey
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }
}
