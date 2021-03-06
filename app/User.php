<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function bill(){
        return $this->hasMany('App\Bill','user_id','id');
    }
     public function comment(){
        return $this->hasMany('App\Comment','user_id','id');
    }
    public function wishlist(){
        return $this->hasMany('App\WishList','user_id','id');
    }
    public function oauthAcessToken(){
        return $this->hasMany('App\OauthAccessToken');
    }
}
