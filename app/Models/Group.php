<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $guarded = [];

    /*Связь с таблицой users*/
    public function user(){
    	return $this->belongsTo('App\User','head_id');
    }

    /*Выбор по ID*/
    public static function getGroupByID($id){
    	return Group::where('status',1)->where('id',$id)->first();
    }

}
