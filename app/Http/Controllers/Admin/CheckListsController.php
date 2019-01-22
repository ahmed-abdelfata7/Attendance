<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;
class CheckListsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //check in 
    public function check_in(){
       
        $checkin = request()->all();
         //check if engineer has been check in project without check-out before
         $check = DB::table('check_lists')->where([
            ['engineer_id','=',session('user_id')],
            ['check_out','=',null]
        ])->first();
        if(!empty($check)){
            return redirect()->back()->with('check_out','check_out');
        }
        $rules    = [
            'project_id'                 => 'required|exists:projects,id',
        ];
        $validator = Validator::make($checkin,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($checkin)->withErrors($validator);
        }else{
            $save['project_id']         = $checkin['project_id'];
            $save['engineer_id']        = session('user_id');
            $save['check_in']           = Carbon::now();
            $save['created_at']         = Carbon::now();
            $save['updated_at']         = Carbon::now();
            DB::table('check_lists')->insert($save);
            return redirect()->back()->with('save','save');
        }
    }
    //check out
    public function check_out($id){
        $user  =Auth::user();
        $check=DB::table('check_lists')
                        ->select('check_lists.id','check_lists.check_in','projects.name')
                        ->join('projects','projects.id','=','check_lists.project_id')
                        ->where(['check_lists.id'=>$id,'check_lists.engineer_id'=>$user->id])
                        ->get();
                       
        if(empty($check[0])){
            return redirect()->back();
        }
        return view('admin.check_list.check_out',compact('check'));
    }
    //check out
    public function do_check_out(){
       
        $checkout = request()->all();
        $check_hours_num = DB::table('check_lists')->where('id',$checkout['check_id'])->first();
         //check if number of hours between check-in and check-out less than 12 hours
         $check_in     = new Carbon($check_hours_num->check_in);
         $check_out    = new Carbon(Carbon::now());
         $difference   = $check_in->diff($check_out)->format('%H');
        if($difference > 12 ){
            return redirect('admin/systemDashboard')->with('admin_check','admin_check');
        }
        $rules    = [
            'report'                 => 'required',
        ];
        $validator = Validator::make($checkout,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($checkout)->withErrors($validator);
        }else{
            $save['report']              = $checkout['report'];
            $save['check_out']           = Carbon::now();

            DB::table('check_lists')->where('id',$checkout['check_id'])->update($save);
            $this->check_engineer_exist($checkout['check_id']);
            return redirect('admin/my_reports')->with('save','save');
        }
    }
    //my reports
    public function my_reports(){
        $user = Auth::user();
        if($user->role !="engineer"){
            return redirect()->back();
        }
        $reports=DB::table('reports')
        ->where('engineer_id',session('user_id'))
        ->orderBy('reports.id','DESC')
        ->get();
        return view('admin.check_list.reports',compact('reports'));
    }
    //check if report exist
    public function check_engineer_exist($check_id){
        $check = DB::table("check_lists")->where([
            ['id','=',$check_id],
            ['engineer_id','=',session('user_id')]
        ])->first();
        if(!empty($check)){
            //check engineer reports
            $report =DB::table("reports")->where([
                ['engineer_id','=',$check->engineer_id],
                ['project_id','=',$check->project_id]
            ])->first();
            if(!empty($report)){
                //get old hours
                $old_hours    = $report->hours;
                //get number of check_out hours 
                $check_in     = new Carbon($check->check_in);
                $check_out    = new Carbon(Carbon::now());
                $difference   = $check_in->diff($check_out)->format('%H:%I:%S');

                $total = date("H:i:s", strtotime($difference) + strtotime($old_hours));
                //updating report hours
                DB::table("reports")->where('id',$report->id)->update(['hours'=>$total]);
            }else{
                $check_in     = new Carbon($check->check_in);
                $check_out    = new Carbon(Carbon::now());
                $difference   = $check_in->diff($check_out)->format('%H:%I:%S');

                //insert report in reports
                $saved['engineer_id'] = session('user_id');
                $saved['project_id']  = $check->project_id;
                $saved['hours']       = $difference;
                $saved['created_at']  = Carbon::now();
                $saved['updated_at']  = Carbon::now();
                DB::table("reports")->insert($saved);     
            }
            //project hours taken updates
            $project = DB::table('projects')->where('id',$check->project_id)->first();
            $project_old_hours    = $project->taken_hours;
            //get number of check_out hours 
            $_check_in     = new Carbon($check->check_in);
            $_check_out    = new Carbon(Carbon::now());
            $_difference   = $_check_in->diff($_check_out)->format('%H:%I:%S');
            $taken_hours   = date("H:i:s", strtotime($_difference) + strtotime($project_old_hours));
            //updating report hours
            DB::table("projects")->where('id',$check->project_id)->update(['taken_hours'=>$taken_hours]);
        }
    }
    //engineer report details
    public function engineer_report_details($project_id,$engineer_id){
        $details=DB::table('check_lists')->where([
            ['project_id','=',$project_id],
            ['engineer_id','=',$engineer_id]
        ])
        ->get();
        $project = DB::table("projects")->where('id',$project_id)->first()->name;
        $total   = DB::table("reports")->where([
           ['project_id','=',$project_id],
           ['engineer_id','=',$engineer_id]
        ])->first()->hours;
        return view('admin.check_list.details',compact('details','project','total'));
    }
    //admin report details
    public function admin_report_details($project_id){
        $details=DB::table('check_lists')->where('project_id',$project_id)
        ->get();
        $project = DB::table("projects")->where('id',$project_id)->first();
        $total   = $project->taken_hours;
        $project = $project->name;
        return view('admin.check_list.admin_details',compact('details','project','total'));
    }
    
}
