<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordReset;
use App\Notifications\EmailConfirm;
use Illuminate\Support\Str;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailConfirm());
    }
    public function userfavoritproduct()
    {
        
        return $this->hasMany(Usersproductsfavorit::class,'idUser','id');
    } 
    public function userboughts()
    {
        
        return $this->hasMany(Bought::class,'idUser','id');
    } 
    public function specialpass()
    {
        return $this->password;
    }
    public function generateToken()
    {
        $this->api_token = Str::random(80);
        $this->save();

        return $this->api_token;
    }
}
