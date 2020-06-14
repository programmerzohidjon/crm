<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tutorial extends Model
{
    protected $table = 'tutorials';

    protected $guarded = [];

    public function setSlugAttribute($value){
    	$this->attributes['slug'] = Str::slug(mb_substr($this->name, 0,12) . "-" .\Carbon\Carbon::now()->format('dmyHi'), '-');
    }
    

    /*Выбор по Slug*/
    public static function getBySlug($slug){
    	return Tutorial::where('status',1)->where('slug',$slug)->first();
    }

    /*Выбор по ID*/
    public static function getByID($id){
    	return Tutorial::where('status',1)->where('id',$id)->first();
    }


}
