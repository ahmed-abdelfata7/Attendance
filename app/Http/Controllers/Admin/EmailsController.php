<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App;
use App\AlertList;
use Carbon\Carbon;
use DB;
use View;
use Validator;
class EmailsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $emails  = AlertList::all();
        return view('admin.emails.index',compact('emails'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emails = $request->all();
        $rules  =[
            'email'                 =>'required|unique:alert_lists',
        ];
        $validator=Validator($emails,$rules);
        if($validator->fails()){
              return redirect()->back()->withInput($emails)->withErrors($validator);
        }else{
            $save['email']      = $emails['email'];
            $save['created_at'] = Carbon::now();
            $save['updated_at'] = Carbon::now();
            DB::table('alert_lists')->insert($save);
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
        $email = AlertList::find($id);
        return view('admin.emails.edit',compact('email'));
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
        $email = request()->all();
        $rules    = [
            'email'                      => 'required|email|unique:alert_lists,email',
        ];
        
        $validator = Validator::make($email,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($email)->withErrors($validator);
        }else{
            //saving account in database
            $save['email']                 = $email['email'];
            $save['updated_at']            = Carbon::now();
            DB::table('alert_lists')->where('id',$id)->update($save);
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
        DB::table('alert_lists')->where('id',$id)->delete();
        return redirect()->back()->with('delete','delete');
    }
}
