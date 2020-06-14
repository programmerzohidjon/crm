<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';
	
    protected $fillable = ['name','user_id','status'];

    /*Связь*/
    public function user(){
    	return $this->hasMany('App\User');
    }

    /*Вывод всех ролей*/
    public static function getRole(){
    	return Role::where('status',1)->get();
    }
}
