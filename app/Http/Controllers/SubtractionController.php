<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subtraction;
use App\Http\Requests;
use App\Http\Requests\SubtractionRequest;


class SubtractionController extends Controller
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
		$subtractions = Subtraction::all();
        return view('subtractions.index', compact('subtractions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subtractions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubtractionRequest $request)
    {
        Subtraction::create($request->all());
        return redirect()->route('subtraction.index')->with('message','Subtraction field has been added successfully!');
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
    public function edit(Subtraction $subtraction)
    {
		/* echo "<pre>";
		print_r($subtraction);
		exit; */
        return view('subtractions.edit',compact(['subtraction']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtraction $subtraction)
    {
        $subtraction->update($request->all());
        return redirect()->route('subtraction.index')->with('message','Subtaction field has been updated successfully!');
    }
	
	public function subtArchive($id , Request $request)
    {
		$statusCode = $request->st;
		
		
		if($statusCode == 1) {
		Subtraction::where('id', '=', $id)->update(['status'   => 0]);   
		return redirect()->route('subtraction.index')->with('message','Archived successfully!');
			
		} else {
		Subtraction::where('id', '=', $id)->update(['status'   => 1]);   
		return redirect()->route('subtraction.index')->with('message','Unarchived successfully!');
		}
		
		
		
		
    }
	
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtraction $subtraction)
    {
        $subtraction->delete();
        return redirect()->route('subtraction.index')->with('message','Subtraction field has been deleted successfully!');
    }
}
