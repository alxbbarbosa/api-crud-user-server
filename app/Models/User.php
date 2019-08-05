<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Jobs\EmailVerificationJob;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable,
        HasApiTokens;
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

    public function AauthAcessToken()
    {
        return $this->hasMany(\App\OauthAccessToken::class);
    }

    public function sendApiEmailVerificationNotification()
    {
        try {
            EmailVerificationJob::dispatch($this);
        } catch (\Exception $e) {
            return response()->json(['Server_error'], 500);
        }
    }
}