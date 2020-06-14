<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Auth;
use App\Models\Menu;
use App\User;
use Image;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return View::make('layouts.index');
    }

    public function myProfile(Request $request){
        if (isset($request->id)) {
            if (Auth::check()) {
                $user = User::find(base64_decode($request->id));
                if (count($user)) {
                    if ($user->role_id==Auth::user()->role_id) {
                       return View::make('blocks.myprofile',compact('user'));
                    }else{
                        return redirect()->back()->with('success','Данный пользователь не найден!');
                    }
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }
    }

    public function editProfile(Request $request){
        if (isset($request->id)) {
            if($request->check){
                $user = User::find($request->id);
                if (count($user)) {
                    if ($user->role_id==Auth::user()->role_id) {
                        $request->validate([
                            'name'=>'required',
                            'email' => ['string', 'email', 'max:255',\Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
                            'password' => 'nullable|string|min:8|confirmed',
                            'file'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);
                        $path_img = 'assets/images/avatar/';
                        $image = $request->file('file');
                        if ($image) {
                            $filename = time() . '.' . $image->getClientOriginalExtension();
                            $path = public_path($path_img . $filename);
                            $img = Image::make($image->getRealPath());
                            $img->resize(160,160, function($constrainat){
                                $constrainat->aspectRatio();
                            })->save($path);
                            if($user->avatar !=null){
                                unlink(public_path().'/'.$user->avatar);   
                            }
                            $user->avatar = $path_img.$filename;
                        }
                        $user->name = $request->name;
                        $request['password'] == null ?: $user->password =  bcrypt($request['password']);
                        $user->email = $request->email;
                        $user->phone = $request->phone;
                        $user->address = $request->address;
                        $user->birthday = $request->birthday;
                        $user->save();
                        $id = $request->id;
                        return redirect()->route('profile',base64_encode($id))->with('success','Form is successfully submitted!');
                    }
                }
            }else{
                return redirect()->back()
                ->with('info','При измененный данных вы должны соглашаться!');
            }
        }
    }
}

     