<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;
use Image;
use App\Models\Tutorial;

class TutorialController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','admin']);
    }

    public function index(){
        return View::make('admin.tutorial.index',[
            'tutorials'=>Tutorial::where('status','>=',1)->orderBy('created_at','desc')->paginate(10)
        ])->with('title','Список учебников');
    }


    public function create(){
        return View::make('admin.tutorial.create')->with('title','Добавление учебника');
    }

    
    public function store(Request $request){
        if (isset($request->name)) {
            $tutorial = new Tutorial;

            $request->validate([
                'name'=>'required','author'=>'required',
                'file'=>'image|mimes:jpg,png,jpeg|max:2048',
                'filepath'=>'file|mimes:pdf,docx,xlsx,rtf'
            ]);

            $path_img = '/assets/images/tutorial/';
            if($request->hasFile('file')){
                $image = $request->file('file');
                if ($image) {
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $path = public_path($path_img . $filename);
                    $img = Image::make($image->getRealPath());
                    $img->resize(300,300, function($constrainat){
                        $constrainat->aspectRatio();
                    })->save($path);
                    if($tutorial->image) file_exists($tutorial->image)??unlink(public_path($tutorial->image));
                    $tutorial->image = $path_img.$filename;
                }
            }
            $pathfiles = 'assets/files/tutorial/';
            if ($request->hasFile('filepath')) {
                $pathfile = $request->file('filepath');
                $newfile = time().'.'.$pathfile->getClientOriginalExtension();
                $pathfile->move(public_path('assets/files/tutorial/'),$newfile);
                if($tutorial->filepath) file_exists($tutorial->filepath)?unlink(public_path($tutorial->filepath)):'Not file';
                $tutorial->filepath = $pathfiles.$newfile;
            }
            $tutorial->name = $request->name;
            $tutorial->author = $request->author;
            $tutorial->class = $request->class;
            $tutorial->user_id = Auth::user()->id;
            $tutorial->slug = $request->slug;
            $tutorial->save();
            return redirect()->route('admin.tutorial.index')->with('success','Успешно добавлено!');
        }else{
            return redirect()->back()->with('info','Ошибка при добавлении');
        }
    }


    public function show($id){

    }

    
    public function edit(Request $request){
        if (isset($request->slug)) {
            $tutorial = Tutorial::getBySlug($request->slug);
            return View::make('admin.tutorial.edit',compact('tutorial'))->with('title','Редактирование учебника');
        }else{
            return redirect()->back()->with('info','Ошибка при редактировании!');
        }
    }


    public function update(Request $request){
        if (isset($request->slug)) {
            $tutorial = Tutorial::getBySlug($request->slug);
            $request->validate([
                'name'=>'required','author'=>'required',
                'file'=>'image|mimes:jpg,png,jpeg|max:2048',
                'filepath'=>'file|mimes:pdf,docx,xlsx,rtf'
            ]);

            $path_img = '/assets/images/tutorial/';
            if($request->hasFile('file')){
                $image = $request->file('file');
                if ($image) {
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $path = public_path($path_img . $filename);
                    $img = Image::make($image->getRealPath());
                    $img->resize(300,300, function($constrainat){
                        $constrainat->aspectRatio();
                    })->save($path);
                    if ($tutorial->image != null) {
                        unlink(public_path().'/'.$tutorial->image);
                    }
                    $tutorial->image = $path_img.$filename;
                }
            }
            $pathfiles = 'assets/files/tutorial/';
            if ($request->hasFile('filepath')) {
                $pathfile = $request->file('filepath');
                $newfile = time().'.'.$pathfile->getClientOriginalExtension();
                $pathfile->move(public_path('assets/files/tutorial/'),$newfile);
                if ($tutorial->filepath != null) {
                    unlink(public_path().'/'.$tutorial->filepath);
                }
                $tutorial->filepath = $pathfiles.$newfile;
            }
            $tutorial->name = $request->name;
            $tutorial->author = $request->author;
            $tutorial->class = $request->class;
            $tutorial->user_id = Auth::user()->id;
            $tutorial->status = $request->status;
            $tutorial->save();
            return redirect()->route('admin.tutorial.index')->with('success','Успешно добавлено!');
        }else{
            return redirect()->back()->with('info','Ошибка при добавлении');
        }
    }



    public function destroy(Request $request){
        if (isset($request->id)) {
            $tutorial = Tutorial::getByID($request->id);
            $tutorial->status = -1;
            $tutorial->save();
             return redirect()->route('admin.tutorial.index')->with('success','Успешно удалено!');
         }else{
            return redirect()->back()->with('info','Ошибка при удаленный!');
        }
    }

}