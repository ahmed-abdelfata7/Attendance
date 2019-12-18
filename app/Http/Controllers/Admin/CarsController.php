<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;
use App\Car;
class CarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $cars  = Car::all();
        return view('admin.cars.index',compact('cars'));
    }
    public function store(Request $request)
    {
        $car = $request->all();
        $rules  =[
            'number'                 =>'required|unique:cars',
        ];
        $validator=Validator($car,$rules);
        if($validator->fails()){
              return redirect()->back()->withInput($car)->withErrors($validator);
        }else{
            $save['number']      = $car['number'];
            $save['created_at'] = Carbon::now();
            $save['updated_at'] = Carbon::now();
            DB::table('cars')->insert($save);
            return redirect()->back()->with('save','save');
        }
    }

    public function edit($id)
    {
        $car = Car::find($id);
        return view('admin.cars.edit',compact('car'));
    }
    public function update(Request $request, $id)
    {
        $car = request()->all();
        $rules    = [
            'number'                      => 'required|unique:cars,number',
        ];
        
        $validator = Validator::make($car,$rules);
        if ($validator->fails()){
            return redirect()->back()->withInput($car)->withErrors($validator);
        }else{
            //saving account in database
            $save['number']                 = $car['number'];
            $save['updated_at']            = Carbon::now();
            DB::table('cars')->where('id',$id)->update($save);
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
        DB::table('cars')->where('id',$id)->delete();
        return redirect()->back()->with('delete','delete');
    }
}
