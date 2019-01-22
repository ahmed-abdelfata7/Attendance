<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App;
use Validator;
use Carbon\Carbon;
use Session;
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if(Auth::guard('web')->check()){
            return redirect()->route('system.dashboard');
        }else{
            return view('login');
        }
    }
    //check login
    public function check_login(){
        $login = request()->all();
        $rules = [
            'email'    =>'required|email',
            'password' =>'required'
        ];
        $validator =Validator::make($login, $rules);
        if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
            }else{
                if(Auth::guard('web')->attempt(['email'=>$login['email'],'password'=>$login['password']])){
                    $user = Auth::user();     
                    session(['login'  =>true]);
                    session(['user_id'=>$user->id]);
                    session(['role'=>$user->role]);
                    return redirect()->route('system.dashboard')->with('login_success','login_success');
                }else{
                    return redirect()->route('login')->with('loginError','loginError');
                }
        }
    }
    //logout
    public function logout($msg="log_out"){
        Session::flush();
        $this->destroy_session();
        auth('web')->logout();
        return redirect()->route('login')->with($msg,$msg);
    }
    //===========================
    //destroying session
    public function destroy_session(){
        Session::forget('login');
        Session::forget('user_id');
        Session::forget('role');
    }
    //===========================


}
