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
class AdminsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user= Auth::user();
            if($user->role != 'developer'){
                return redirect()->back();
            }
            return $next($request);
        });  
    }
    //check role to prevent deletion
    static function checkRole(){
        if(session('role') == 'engineer' || session('role') == 'admin'){
            return redirect()->back();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all admins 
       $admins = User::where('role','<>','developer')->orderBy('id','desc')->get();
       return view('admin.admins.index',compact('admins'));
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $register = request()->all();
        $rules    = [
            'name'                       => 'required|unique:users',
            'email'                      => 'required|email|unique:users',
            'password'                   => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/',
        ];
        $validator = Validator::make($register,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($register)->withErrors($validator);
        }else{
            //saving account in database
            $save['name']                  = $register['name'];
            $save['email']                 = $register['email'];
            $save['password']              = bcrypt($register['password']);
            $save['remember_token']        = $register['_token'];
            $save['created_at']            = Carbon::now();
            $save['updated_at']            = Carbon::now();
            $save['role']                  = $register['role'];
            DB::table('users')->insert($save);
            return redirect()->back()->with('save','save');

        }
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::find($id);
        return view('admin.admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checkRole();
        $register = request()->all();
        $rules    = [
            'name'                       => 'required|unique:users,id,'.session('user_id'),
            'email'                      => 'required|email|unique:users,id,'.session('user_id'),
        ];
        if(!empty($register['password'])){
            $rules['password']              = 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/';
        }
        $validator = Validator::make($register,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($register)->withErrors($validator);
        }else{
            //saving account in database
            $save['name']                  = $register['name'];
            $save['email']                 = $register['email'];
            if(!empty($register['password'])){
                $save['password']              = bcrypt($register['password']);
            }
            $save['remember_token']        = $register['_token'];
            $save['updated_at']            = Carbon::now();
            $save['role']                  = $register['role'];
            DB::table('users')->where('id',$id)->update($save);
            return redirect()->back()->with('update','update');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkRole();
        DB::table('users')->where('id',$id)->delete();
        return redirect()->back()->with('delete','delete');
    }
}
