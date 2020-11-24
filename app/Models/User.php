<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        if($this->is_admin == 1){
            return true;
        }else{
            return false;
        }
        
    }
    public function isActive(){
        if($this->is_active == 1){
            return true;
        }else{
            return false;
        }
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Models\Wishlist');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
