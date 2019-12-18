<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App;
use App\User;
use Validator;
use Carbon\Carbon;

class ManualCheckController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user= Auth::user();
            if($user->role == 'engineer'){
                return redirect()->back();
            }
            return $next($request);
        });  
    }
    public function toggle_check(){
        $engineers = User::where('role','engineer')->orderBy('id','desc')->get();
        return view('admin.manualCheck.index',compact('engineers'));
    }
    public function toggleCheck($engineerId){
        $engineer = User::where('id',$engineerId)->first();
        if(!empty($engineer)){
            if($engineer->check_in==0){
                DB::table("users")->where('id',$engineer->id)->update(["check_in"=>1,"check_out"=>1]);
            }else{
                DB::table("users")->where('id',$engineer->id)->update(["check_in"=>0,"check_out"=>0]);
            }
            return redirect()->back()->with("update","update");
        }else{
            return redirect()->back();
        }

    }
    
}
