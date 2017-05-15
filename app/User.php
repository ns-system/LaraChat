<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Carbon\Carbon;
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        // ① 追加
        'confirmation_token', 'confirmed_at', 'confirmation_sent_at'
    ];
 
    protected $dates = [  // ② 追加
        'confirmed_at',
        'confirmation_sent_at',
    ];
 
    public function makeConfirmationToken($key) { // ③ 追加
        $this->confirmation_token = hash_hmac(
            'sha256',
            str_random(40).$this->email,
            $key
        );
 
        return $this->confirmation_token;
    }
 
    public function confirm() { // ④ 追加
        $this->confirmed_at = Carbon::now();
        $this->confirmation_token = '';
    }
 
    public function isConfirmed() { // ⑤ 追加
        return ! empty($this->confirmed_at);
    }
     //リレーション
    public function tweets() {
        return $this->hasMany('App\Tweet');
    }
    public function tweets_participant() {
        return $this->hasMany('App\Tweet');
    }

}