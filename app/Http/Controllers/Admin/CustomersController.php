<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\User;
use App\Customer;
use DB;
use Validator;
use Carbon\Carbon;
use Auth;
class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user= Auth::user();
            if($user->role == 'engineer' ){
                return redirect()->back();
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('customers')->orderBy('id','DESC')->get();
        return view('admin.customers.index',compact('users'));
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
            'name'                       => 'required|unique:customers',
            'email'                      => 'required|email|unique:customers',
            'phone'                      => 'required|unique:customers',
            'address'                   => 'required',
        ];
        $validator = Validator::make($register,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($register)->withErrors($validator);
        }else{
            //saving account in database
            $save['name']                  = $register['name'];
            $save['email']                 = $register['email'];
            $save['phone']                 = $register['phone'];
            $save['address']                =$register['address'];
            $save['created_at']            = Carbon::now();
            $save['updated_at']            = Carbon::now();
            
            DB::table('customers')->insert($save);
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
        $user = Customer::find($id);
        return view('admin.customers.edit',compact('user'));
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
        $profile = request()->all();
        $rules    = [
                'name'                       => 'required|unique:customers,id,'.$id,
                'email'                      => 'required|email|unique:customers,id,'.$id,
                'phone'                      => 'required|unique:customers,id,'.$id,
                'address'                    =>'required'
        ];
        $validator = Validator::make($profile,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($profile)->withErrors($validator);
        }else{
            
            $save['name']                  = $profile['name'];
            $save['email']                 = $profile['email'];
            $save['phone']                 = $profile['phone'];
            $save['address']               = $profile['address'];
            $save['updated_at']            = Carbon::now();
            DB::table('customers')->where('id',$id)->update($save);
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
        AdminsController::checkRole();
        DB::table('projects')->where('customer_id',$id)->delete();
        DB::table('customers')->where('id',$id)->delete();
        return redirect()->back()->with('delete','delete');
    
    }
    public function CustomerDetails($customerId){
        return view('admin.customers.CustomerDetails');
    }
}
