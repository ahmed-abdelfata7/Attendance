<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App;
use App\Project;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function systemDashboard(){
        $user     = Auth::user();
        $projects = DB::table('projects')
                    ->get();
        
        $alerts   = DB::table('check_lists')
                    ->select('check_lists.id','check_lists.check_in','projects.name','users.name AS userName')
                      ->join('projects','projects.id','=','check_lists.project_id')
                      ->join('users','users.id','check_lists.engineer_id')
                      ->where('check_lists.alert','=', 1)
                      ->get();

        switch($user->role){
            case "developer":
                return view("admin.developerDashboard",compact('projects','alerts'));
            break;
            case "admin":
                return view("admin.adminDashboard",compact('projects','alerts'));
            break;
            default:
                $user = Auth::user();
                $pending=DB::table('check_lists')
                        ->select('check_lists.id','check_lists.check_in','projects.name')
                        ->join('projects','projects.id','=','check_lists.project_id')
                        ->where([
                            ['check_out' ,'=', null],
                            ['engineer_id','=',$user->id]
                            ])
                        ->get();
                
                return view("admin.engineerDashboard",compact('projects','pending'));
            break;
        }
        
        
    }
}
