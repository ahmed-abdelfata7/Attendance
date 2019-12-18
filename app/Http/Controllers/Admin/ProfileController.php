<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App;
use App\User;
use Validator;
use Session;
use DB;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user=Auth::user();
        return view('admin.editProfile',compact('user'));
    }
    //update profile
    public function updateProfile(){
        if(session('role') !='admin' || session('role') !='developer'){
            return redirect()->back()->with('notAllowed','notAllowed');
        }
        $profile = request()->all();
        $rules    = [
                'name'                       => 'required|unique:users,id,'.session('user_id'),
                'email'                      => 'required|email|unique:users,id,'.session('user_id'),
        ];
        $validator = Validator::make($profile,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($profile)->withErrors($validator);
        }else{
            $save['name']                  = $profile['name'];
            $save['email']                 = $profile['email'];
            $save['remember_token']        = $profile['_token'];
            $save['updated_at']            = Carbon::now();
            DB::table('users')->where('id',session('user_id'))->update($save);
            return redirect()->back()->with('update','update');
        }
    }
    //=============================
    //change password
    public function changePassword(){
        $change = request()->all();
        $rules  = [
            'newPassword'    =>'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/',
            'cnewPassword'   =>'required|same:newPassword'
        ];
        $validator =Validator::make($change, $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $user = Auth::user();
            DB::table('users')->where('id',$user->id)->update(['password'=>bcrypt($change['newPassword'])]);
            return redirect()->back()->with('update','update');
        }
    }
    //============================

}
