<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = ['name','image','slug','user_id','status'];

    public function setSlugAttribute($value) {
      $this->attributes['slug'] = Str::slug( mb_substr($this->name, 0, 12) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }

    /*Выбор по slug */
    public static function getSubjectBySlug($slug){
    	return Subject::where('status',1)->where('slug',$slug)->first();
    }
}
