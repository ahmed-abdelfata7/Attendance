<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App;
use App\Project;

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
    
}
