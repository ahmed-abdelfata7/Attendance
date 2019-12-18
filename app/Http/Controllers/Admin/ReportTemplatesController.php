<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;
use App\ReportList;
class ReportTemplatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $names  = ReportList::all();
        return view('admin.reportTemplates.index',compact('names'));
    }
    public function store(Request $request)
    {
        $name = $request->all();
        $rules  =[
            'name'                 =>'required|unique:report_lists',
        ];
        $validator=Validator($name,$rules);
        if($validator->fails()){
              return redirect()->back()->withInput($name)->withErrors($validator);
        }else{
            $save['name']      = $name['name'];
            $save['created_at'] = Carbon::now();
            $save['updated_at'] = Carbon::now();
            DB::table('report_lists')->insert($save);
            return redirect()->back()->with('save','save');
        }
    }

    public function edit($id)
    {
        $name = ReportList::find($id);
        return view('admin.reportTemplates.edit',compact('name'));
    }
    public function update(Request $request, $id)
    {
        $name = request()->all();
        $rules    = [
            'name'                      => 'required|unique:report_lists,name',
        ];
        
        $validator = Validator::make($name,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($name)->withErrors($validator);
        }else{
            //saving account in database
            $save['name']                 = $name['name'];
            $save['updated_at']            = Carbon::now();
            DB::table('report_lists')->where('id',$id)->update($save);
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
        DB::table('report_lists')->where('id',$id)->delete();
        return redirect()->back()->with('delete','delete');
    }
}
