<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',  'email_verified_at'
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



    public function audioDVD()
    {
        return $this->hasMany(AudioDVD::class, 'audio_d_v_d_id');
    }
    public function videoDVD()
    {
        return $this->hasMany(VideoDVD::class, 'video_d_v_d_id');
    }


    // public function generateToken()
    // {
    //     $this->api_token = str_random(60);
    //     $this->save();

    //     return $this->api_token;
    // }

}
