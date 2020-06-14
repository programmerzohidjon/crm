<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
	protected $table = 'menu';
	protected $fillable = ['name','parent_id','role_id','url','slug','icon','user_id','status'];

	public function setSlugAttribute($value) {
      $this->attributes['slug'] = Str::slug( mb_substr($this->name, 0, 12) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }

    /*Связь с таблицой Роль*/
    public function role(){
        return $this->belongsTo('App\Models\Role');
    
    }

    public function parent(){
        return $this->belongsTo('App\Models\Menu','parent_id');
    }
    
    /*No comment*/
    public function child() {
        return $this->hasMany('App\Models\Menu','parent_id');
    }

     /*Вывод меню*/
    public static function getMenu($role_id){
        return Menu::where('status',1)->where('parent_id',0)->where('role_id',$role_id)->get();
    }

    /*Вывод меню 2 parents*/
    public static function getMenuParents(){
        return Menu::where('status',1)->where('parent_id',0)->get();
    }

    /*Выбор меню по slug*/
    public static function getSlugMenu($slug){
        return Menu::where('status',1)->where('slug',$slug)->first();
    }
}
