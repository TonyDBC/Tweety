<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Followable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    // An equivalent way is:
    // protected $fillable = ['username', 'avatar', 'name', 'email', 'password'];
    protected $guarded = [];

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
    public function getAvatarAttribute($value){
        // Getting avatar from this external link
        // return "https://i.pravatar.cc/200?u=" .$this->email;

        // Getting customised avatar (for more solutions check the screenshot in the google doc):
        if($value){
            return asset('storage/'. $value);
        }
            return asset('images/default-avatar.jpeg');
    }

    // This is another way to encrypt the password
    // public function setPasswordAttribute($value){
    //     return $this->attributes['password'] = bcrypt($value);
    // }

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
        return $this->hasMany(Tweet::class)->latest();
    }

    // In Laravel 6 and below, need this to fetch the user's name instead of id
    // public function getRouteKeyName(){
    //    return 'name';
    // }


    // If there is no parameter, then it is the same as path() function and fetches the path
    // If there is some parameter, then it will get the requested as the $append variable
    public function path($append = ''){
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }
}
