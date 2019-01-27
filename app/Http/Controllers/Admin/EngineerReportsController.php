<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App;
use App\Project;
use Carbon\Carbon;

class EngineerReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function engineer_reports(){
        $engineers = DB::table('users')
                    ->where('users.role', '=', 'engineer')
                    ->get();
             
        return view('admin.reports.index',compact('engineers'));
    }
    public function generate_report(){
        $engineers = DB::table('users')
                    ->where('users.role', '=', 'engineer')
                    ->get();
             
        return view('admin.reports.create',compact('engineers'));
    }
    public function do_generate_report(Request $request){
        $range = $request->all();
        $reports = DB::table('check_lists')->whereBetween('check_in', [$range['from'], $range['to']])
                                           ->orWhereBetween('check_out', [$range['from'], $range['to']])
                                           ->get();
        foreach($reports as $report){
            if($report->engineer_id == $range['engineer_id']){
                $_check_in   = new Carbon("$report->check_in");
                $_check_out  = new Carbon("$report->check_out");
                $_years      = $_check_in->diff($_check_out)->format('%Y');
                $_months     = $_check_in->diff($_check_out)->format('%M');
                $_days       = $_check_in->diff($_check_out)->format('%D');
                $_hours      = $_check_in->diff($_check_out)->format('%H');
                $_mintues    = $_check_in->diff($_check_out)->format('%I');
                $_seconds    = $_check_in->diff($_check_out)->format('%S');
                $total[]       = $_years * 365 * 24 + $_months * 30 * 24 + $_days * 24 + $_hours + ($_mintues / 60);    
            }
            
        }
        if(empty($total)){
            $total = 0;
        }else{
            $total = array_sum($total);
        }
        $engineer_name = DB::table('users')->where('id',$range['engineer_id'])->first()->name;
        $from = $range['from'];
        $to = $range['to'];
        return view('admin.reports.show',compact('total','reports','engineer_name','from','to'));        
    }
    
}
