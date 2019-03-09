<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Auth;
use DB;
use Validator;
use Carbon\Carbon;
use App\Project;
use App\Customer;
class ProjectsController extends Controller
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
        $projects = DB::table('projects')->orderBy('id','DESC')->get();
        $customers = DB::table('customers')->orderBy('id','DESC')->get();
        return view('admin.projects.index',compact('projects','customers'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = request()->all();
        $rules    = [
            'name'               => 'required|unique:projects',
            'so_number'          => 'required|unique:projects',
            'customer_id'        => 'required|exists:customers,id',
            'hours_number'       => 'required|numeric',
            'project_start'      => 'required|date|date_format:Y-m-d|before:project_end',
            'project_end'        => 'required|date|date_format:Y-m-d|after:project_start',
        ];
        $validator = Validator::make($project,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($project)->withErrors($validator);
        }else{
            //saving account in database
            $save['name']                  = $project['name'];
            $save['so_number']             = $project['so_number'];
            $save['customer_id']           = $project['customer_id'];
            $save['hours_number']          = $project['hours_number'];
            $save['project_start']         = $project['project_start'];
            $save['project_end']           = $project['project_end'];
            $save['created_at']            = Carbon::now();
            $save['updated_at']            = Carbon::now();
            DB::table('projects')->insert($save);
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
        $project = Project::find($id);
        $customers = Customer::all();
        return view('admin.projects.edit',compact('project','customers'));
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
        $project = request()->all();
        $rules    = [
                'name'               => 'required|unique:projects,id,'.$id,
                'so_number'          => 'required|unique:projects,id,'.$id,
                'customer_id'        =>'required|exists:customers,id',
                'hours_number'       => 'required|numeric',
                'project_start'      => 'required|date|date_format:Y-m-d|before:project_end',
                'project_end'        => 'required|date|date_format:Y-m-d|after:project_start',
        ];
        $validator = Validator::make($project,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($project)->withErrors($validator);
        }else{
            
            //saving account in database
            $save['name']                  = $project['name'];
            $save['so_number']             = $project['so_number'];
            $save['customer_id']           = $project['customer_id'];
            $save['hours_number']          = $project['hours_number'];
            $save['project_start']         = $project['project_start'];
            $save['project_end']           = $project['project_end'];
            $save['updated_at']            = Carbon::now();
            
            DB::table('projects')->where('id',$id)->update($save);
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
        DB::table('projects')->where('id',$id)->delete();
        return redirect()->back()->with('delete','delete');
    }
    public function generate_report(){
        $projects = DB::table('projects')
                    ->get();
        return view('admin.projects.createReport',compact('projects'));
    }
    public function projects_report(){
        $projects = DB::table('projects')
            ->get();
        return view('admin.projects.showall',compact('projects'));
    }
    public function generate_project_report(Request $request){
        $range = $request->all();
        $from = $range['from'];
        $to = $range['to'];
        $reports = DB::table('check_lists')->whereDate('check_in','>=', $range['from'])
            ->WhereDate('check_out', '<=',$range['to'])
            ->where('project_id','=',$range['project_id'])
            ->get();
        foreach($reports as $report){
                if($report->project_id == $range['project_id']){
                    $_check_in   = new Carbon("$report->check_in");
                    $_check_out  = new Carbon("$report->check_out");
                    $_years      = $_check_in->diff($_check_out)->format('%Y');
                    $_months     = $_check_in->diff($_check_out)->format('%M');
                    $_days       = $_check_in->diff($_check_out)->format('%D');
                    $_hours      = $_check_in->diff($_check_out)->format('%H');
                    $_mintues    = $_check_in->diff($_check_out)->format('%I');
                    $_seconds    = $_check_in->diff($_check_out)->format('%S');
                    $total[]     = $_years * 365 * 24 + $_months * 30 * 24 + $_days * 24 + $_hours + ($_mintues / 60);    
                }
        }
        if(empty($total)){
            $total = 0;
        }else{
            $total = array_sum($total);
        }
               
        $project = DB::table('projects')->where('id',$range['project_id'])->first();
        return view('admin.projects.show',compact('total','project','reports','from','to'));  
    }
}
