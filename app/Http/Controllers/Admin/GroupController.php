<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;
use App\Models\Group;

class GroupController extends Controller
{
    
    public function __construct(){
        $this->middleware(['auth','admin']);
    }

    public function index(){
        return View::make('admin.groups.index',[
            'groups'=>Group::where('status','>=',1)->orderBy('created_at','desc')->paginate(10)
        ])->with('title','Список классов');
    }

    
    public function create(){
        return View::make('admin.groups.create')->with('title','Добавление класса');
    }

    
    public function store(Request $request){
        if (isset($request->name)) {
            $request->validate([
                'name'=>'required'
            ]);
            $group = new Group;
            $group->name = $request->name;
            $group->head_id = $request->head_id;
            $group->user_id = Auth::user()->id;
            $group->save();
            return redirect()->route('admin.group.index')->with('success','Успешно добавлено!');
        }else{
            return redirect()->back()->with('info','Ошибка при добавлении!');
        }
    }

    
    public function show($id){
        
    }

    
    public function edit(Request $request){
        if (isset($request->id)) {
            $group = Group::getGroupByID($request->id);
            return View::make('admin.groups.edit',compact('group'))->with('title','Редактирование класса');
        }else{
            return redirect()->back()->with('info','Ошибка при редактировании!');
        }
    }

    
    public function update(Request $request){
        if (isset($request->id)) {
            $group = Group::getGroupByID($request->id);
            if (count($group)) {
                $request->validate([
                    'name'=>'required'
                ]);
                $group->name = $request->name;
                $group->head_id = $request->head_id;
                $group->user_id = Auth::user()->id;
                $group->status = $request->status;
                $group->save();
                return redirect()->route('admin.group.index')->with('success','Успешно добавлено!');
            }else{
                return redirect()->back()->with('info','Ошибка при редактировании!');    
            }
        }else{
            abort(404);
        }
    }

   
    public function destroy(Request $request){
        if (isset($request->id)) {
            $group = Group::getGroupByID($request->id);
            $group->status = -1;
            $group->save();
            return redirect()->route('admin.group.index')->with('success','Успешно удалено!');
        }else{
            return redirect()->back()->with('info','Ошибка при удаленный!');
        }
    }
}
