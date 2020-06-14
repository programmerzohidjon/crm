<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password','address','phone','avatar','birthday','role_id','status'
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


    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    /*Вывод списка учителей*/
    public static function getTeachersList(){
        return User::where('role_id',2)->where('status',1)->paginate(10);
    }

    /*Вывод списка учителей 2*/
    public static function getTeacherList(){
        return User::where('role_id',2)->where('status',1)->get();
    }
}
