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
                        ->select('check_lists.id','check_lists.check_in','check_lists.report','projects.name')
                        ->join('projects','projects.id','=','check_lists.project_id')
                        ->where(['check_lists.id'=>$id,'check_lists.engineer_id'=>$user->id])
                        ->get();
                       
        if(empty($check[0])){
            return redirect()->back();
        }
        return view('admin.check_list.check_out',compact('check','user'));
    }
    //check out
    public function do_check_out(){
        $checkout = request()->all();
        $check_hours_num = DB::table('check_lists')->where('id',$checkout['check_id'])->first();
        
        $rules    = [
            'report'                 => 'required',
        ];
        $validator = Validator::make($checkout,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($checkout)->withErrors($validator);
        }else{
            $save['report']    = $checkout['report'];
            if(!empty($checkout["checkout_date"]) && !empty($checkout['checkout_time'])){
                //get check in date
                $checkInDate = $check_hours_num->check_in;
                $date_of_checkout   = $checkout['checkout_date']." ".$checkout['checkout_time'].":00";
                $in = strtotime($checkInDate);
                $out = strtotime($date_of_checkout);
                if($in > $out){
                    return redirect()->back()->with("outError","out");
                }
                $save['check_out']  = new Carbon("$date_of_checkout");
                $save['manually']   = 1;
                
            }else{
                $save['check_out']  = Carbon::now();
            }
                //check if number of hours between check-in and check-out less than 12 hours
                $difference   = $this->number_of_hours($check_hours_num->check_in,$save['check_out']);

                if($difference > 12 ){
                    //updating alert
                    DB::table('check_lists')->where('id',$checkout['check_id'])->update(['alert'=>1]);
                    return redirect('admin/systemDashboard')->with('admin_check','admin_check');
                }
            
            DB::table('check_lists')->where('id',$checkout['check_id'])->update($save);
            $this->check_engineer_exist($checkout['check_id'],$save['check_out']);
            return redirect('admin/systemDashboard')->with('check_out_ok','save');
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
    //check in manually
    public function checkIn_manually(){
        $user = Auth::user();
        if($user->check_in==1){
            $projects = DB::table("projects")->where("active",1)->get();
            return view('admin.check_list.manually_checkin',compact("projects"));
        }else{
            return redirect("");
        }
    }
    //do manually check in
    public function do_manually_checkin(){
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
            'checkin_date'               =>'required|before:tomorrow'
        ];
        $validator = Validator::make($checkin,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($checkin)->withErrors($validator);
        }else{
            $save['project_id']         = $checkin['project_id'];
            $save['report']             = $checkin['report'];
            $save['engineer_id']        = session('user_id');
            $date_of_checkin           = $checkin['checkin_date']." ".$checkin['checkin_time'].":00";
            $_check_in  = new Carbon("$date_of_checkin");
            $save['check_in']           = $_check_in;
            $save['created_at']         = Carbon::now();
            $save['updated_at']         = Carbon::now();
            $save["manually"] =1;
            DB::table('check_lists')->insert($save);
            return redirect()->back()->with('save','save');
        }
    }
    //check out manually
    public function checkOut_manually(){
        return view('admin.check_list.admin_checkOut',compact('check'));
    }
    //check if report exist
    public function check_engineer_exist($check_id,$checkOut){
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
                $total   = $this->number_of_hours($check->check_in,$checkOut) + $old_hours;
                //updating report hours
                DB::table("reports")->where('id',$report->id)->update(['hours'=>$total]);
            }else{
                $difference   = $this->number_of_hours($check->check_in,$checkOut);
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
            
            $taken_hours   = $this->number_of_hours($check->check_in,$checkOut) + $project_old_hours;
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
        $check= DB::table("reports")->where([
            ['project_id','=',$project_id],
            ['engineer_id','=',$engineer_id]
         ])->first();
         if(!empty($check)){
            $total   = DB::table("reports")->where([
                ['project_id','=',$project_id],
                ['engineer_id','=',$engineer_id]
             ])->first()->hours;
         }else{
             $total=0;
         }
       
        return view('admin.check_list.details',compact('details','project','total'));
    }
    //admin report details
    public function admin_report_details($project_id){
        $details=DB::table('check_lists')->where([
            ['project_id','=',$project_id],
            ['check_in','<>',null],
            ['check_out','<>',null],
            ])
        ->get();
        $project = DB::table("projects")->where('id',$project_id)->first();
        $total   = $project->taken_hours;
        $project = $project->name;
        return view('admin.check_list.admin_details',compact('details','project','total'));
    }
    public function number_of_hours($checkInDate,$checkOutDate){
        $_check_in   = new Carbon("$checkInDate");
        $_check_out  = new Carbon("$checkOutDate");
        $_years      = $_check_in->diff($_check_out)->format('%Y');
        $_months     = $_check_in->diff($_check_out)->format('%M');
        $_days       = $_check_in->diff($_check_out)->format('%D');
        $_hours      = $_check_in->diff($_check_out)->format('%H');
        $_mintues    = $_check_in->diff($_check_out)->format('%I');
        $_seconds    = $_check_in->diff($_check_out)->format('%S');
        $total       = $_years * 365 * 24 + $_months * 30 * 24 + $_days * 24 + $_hours + ($_mintues / 60);
        return $total;
    }
    public function admin_check_out($id){
        $check = DB::table("check_lists")->where('id',$id)->first();
        if(empty($check)){
            return redirect()->back();
        }
        return view('admin.check_list.admin_checkOut',compact('check'));
    }
    public function do_admin_check_out(){
        $user     = Auth::user();
        $checkout = request()->all();
        $check_hours_num = DB::table('check_lists')->where('id',$checkout['check_id'])->first();
        //check the difference between two dates
        $date_of_checkout = $checkout['checkout_date']." ".$checkout['checkout_time'].":00";
        $_check_in   = new Carbon("$check_hours_num->check_in");
        $_check_out  = new Carbon("$date_of_checkout");
        $_years      = $_check_in->diff($_check_out)->format('%Y');
        $_months     = $_check_in->diff($_check_out)->format('%M');
        $_days       = $_check_in->diff($_check_out)->format('%D');
        $_hours      = $_check_in->diff($_check_out)->format('%H');
        $_mintues    = $_check_in->diff($_check_out)->format('%I');
        $_seconds    = $_check_in->diff($_check_out)->format('%S');
        $total       = $_years * 365 * 24 + $_months * 30 * 24 + $_days * 24 + $_hours + ($_mintues / 60);
        //updating dates in database
        $project = DB::table('projects')->where('id',$check_hours_num->project_id)->first();
        $project_hours = $project->taken_hours + $total;
        DB::table('projects')->where('id',$check_hours_num->project_id)->update(['taken_hours'=>$project_hours]);
        //updating reports for engineer also
        $report = DB::table('reports')->where([
            ['engineer_id','=',$check_hours_num->engineer_id],
            ['project_id','=',$check_hours_num->project_id]
        ])->first();
        if(!empty($report)){
            DB::table("reports")->where('id',$report->id)->update(['hours'=>$report->hours + $total]);
        }else{
            $saved['engineer_id'] = $check_hours_num->engineer_id;
            $saved['project_id']  = $check_hours_num->project_id;
            $saved['hours']       = $total;
            $saved['created_at']  = Carbon::now();
            $saved['updated_at']  = Carbon::now();
            DB::table("reports")->insert($saved);
        }
        $rules    = [
            'report'                 => 'required',
            'checkout_date'          => 'required',
            'checkout_time'          => 'required'
            ];
            $validator = Validator::make($checkout,$rules);
            if ($validator->fails()){
                return redirect()->back()->withInput($checkout)->withErrors($validator);
            }else{
                $save['report']              = $checkout['report'];
                $checkDate                   = $checkout['checkout_date']." ".$checkout['checkout_time'].":00";
                $save['check_out']           = $checkDate;
                $save['alert']               = 0;
                $save['editBy']              = $user->id;
                DB::table('check_lists')->where('id',$checkout['check_id'])->update($save);
                $this->check_engineer_exist($checkout['check_id'],$checkDate);
                return redirect('admin/systemDashboard')->with('save','save');
        }
    }
}
