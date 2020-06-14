<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;
use App\Models\Menu;

class MenuController extends Controller
{
    
    public function __construct(){
        $this->middleware(['auth','admin']);
    }

    public function index(){
        return View::make('admin.menu.index',[
            'menus'=>Menu::where('status','>=',0)->orderBy('created_at','desc')->paginate(10)
        ]);
    }

    
    public function create(){
        return View::make('admin.menu.create');
    }

  
    public function store(Request $request){
        $request->validate([
            'name'=>'required','url'=>'required','icon'=>'required'
        ]);
        
        if (isset($request->name)) {
            $menu = new Menu;
            $menu->name = $request->name;
            $menu->parent_id = $request->parent_id;
            $menu->role_id = $request->role_id;
            $menu->url = $request->url;
            $menu->icon = $request->icon;
            $menu->status = $request->status;
            $menu->user_id = Auth::user()->id;
            $menu->slug = $request->slug;
            $menu->save();
            return redirect()->route('admin.menu.index')->with('success', 'Новый пункт меню успешно добавлено!');
        }else{
            return redirect()->back()->with('success','При добавлении произошло ошибка!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        if (isset($request->slug)) {
            $menu = Menu::getSlugMenu($request->slug);
            if (count($menu)) {
                return View::make('admin.menu.edit',compact('menu'));
            }else{
                return redirect()->back();
            }
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        if (isset($request->slug)) {
            $menu = Menu::getSlugMenu($request->slug);
            if (count($menu)) {
                $menu->name = $request->name;
                $menu->parent_id = $request->parent_id;
                $menu->role_id = $request->role_id;
                $menu->url = $request->url;
                $menu->icon = $request->icon;
                $menu->status = $request->status;
                $menu->user_id = Auth::user()->id;
                $menu->save();
                return redirect()->route('admin.menu.index')->with('success', 'Пункт меню успешно редактирован!');
            }else{
                return redirect()->back()->with('success','Ошибка во время редактирование!');
            }
        }else{
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        if(isset($request->id)){
            $menu = Menu::find($request->id);
            $menu->status = -1;
            $menu->save();
            return redirect()->route('admin.menu.index')->with('success', 'Успешно удаленно!');
        }
    }
}
