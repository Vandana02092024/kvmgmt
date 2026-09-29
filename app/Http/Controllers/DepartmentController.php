<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Http\Requests;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Facades\DB;


class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$categories = Category::all();
		 $departments = DB::table('departments')->get(); 
        return view('departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
		
        Department::create($request->all());
        return redirect()->route('department.index')->with('message','Depatment has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit',compact(['department']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        return redirect()->route('department.index')->with('message','Department has been updated successfully!');
    }
	
	public function depArchive($id , Request $request)
    {
		$statusCode = $request->st;
		
		
		if($statusCode == 1) {
		Department::where('id', '=', $id)->update(['status'   => 0]);   
		return redirect()->route('department.index')->with('message','Archived successfully!');
			
		} else {
		Department::where('id', '=', $id)->update(['status'   => 1]);   
		return redirect()->route('department.index')->with('message','Unarchived successfully!');
		}
		
		
		
		
    }
	
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('department.index')->with('message','Department has been deleted successfully!');
    }
}
