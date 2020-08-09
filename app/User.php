<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relationship for files
    public function files(){
        return $this->hasMany('App\File');
    }

    // Relationship for folders
    public function folders(){
        return $this->hasMany('App\Folder');
    }

    //Relationshipfor posts
    public function posts(){
        return $this->hasMany('App\Post');
    }

    //For resetting passwords
    public function passreset(){
        return $this->hasMany('App\PassReset');
    }

    // // Relationship for User
    // public function friends(){
    //     return $this->belongsToMany('App\User','users','id');
    // }

    // //User to User
    // public function addFriend(User $user){
    //     $this->friends()->attach($user->id);
    // }
}

