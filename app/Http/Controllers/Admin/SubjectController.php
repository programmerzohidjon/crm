<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;
use Image;
use App\Models\Subject;

class SubjectController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','admin']);
    }

    public function index(){
        return View::make('admin.subject.index',[
            'subjects'=>Subject::where('status','>=',1)->orderBy('created_at','desc')->paginate(10)
        ])->with('title','Список предметов');
    }

    
    public function create(){
        return View::make('admin.subject.create')->with('title','Добавление предмета');
    }

    
    public function store(Request $request){
        if (isset($request->name)) {
            $subject = new Subject;

            $request->validate([
                'name'=>'required',
                'file'=>'image|mimes:jpg,png,jpeg|max:2048'
            ]);

            $path_img = 'assets/images/subject/';
            
            if($request->hasFile('file')){
                $image = $request->file('file');
                if ($image) {
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $path = public_path($path_img . $filename);
                    $img = Image::make($image->getRealPath());
                    $img->resize(300,300, function($constrainat){
                        $constrainat->aspectRatio();
                    })->save($path);
                    if($subject->image) file_exists($subject->image)??unlink(public_path($subject->image));
                    $subject->image = $path_img.$filename;
                }
            }
            $subject->name = $request->name;
            $subject->slug = $request->slug;
            $subject->user_id = Auth::user()->id;
            $subject->save();
            return redirect()->route('admin.subject.index')->with('success','Успешно добавлено!');
        }else{
            return redirect()->back()->with('info','Ошибка при добавлении!');
        }
    }

    
    public function show($id){
        //
    }

    
    public function edit(Request $request){
        if (isset($request->slug)) {
            $subject = Subject::getSubjectBySlug($request->slug);
            return View::make('admin.subject.edit',compact('subject'))->with('title','Редактирование предмета');
        }else{
            return redirect()->back()->with('info','Ошибка при редактировании!');
        }
    }

    
    public function update(Request $request){
        if (isset($request->id)) {
            $subject = Subject::find($request->id);
            $request->validate([
                'name'=>'required',
                'file'=>'image|mimes:jpg,png,jpeg|max:2048'
            ]);
            $path_img = 'assets/images/subject/';
            if($request->hasFile('file')){
                $image = $request->file('file');
                if ($image) {
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $path = public_path($path_img . $filename);
                    $img = Image::make($image->getRealPath());
                    $img->resize(300,300, function($constrainat){
                        $constrainat->aspectRatio();
                    })->save($path);
                    if ($subject->image != null) {
                        unlink(public_path().'/'.$subject->image);
                    }
                }
                $subject->image = $path_img.$filename;
            }
            $subject->name = $request->name;
            $subject->user_id = Auth::user()->id;
            $subject->status = $request->status;
            $subject->save();
            return redirect()->route('admin.subject.index')->with('success','Успешно измененно!');
        }else{
            return redirect()->back()->with('info','Ошибка при измененный!');
        }
    }

    
    public function destroy(Request $request){
        if (isset($request->id)) {
            $subject = Subject::find($request->id);
            $subject->status = -1;
            $subject->save();
            return redirect()->route('admin.subject.index')->with('success','Успешно удалено!');
        }else{
            return redirect()->back()->with('info','Ошибка при удаленный!');
        }
    }
}
