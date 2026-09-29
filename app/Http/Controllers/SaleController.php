<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sale;
use App\Location;
use App\Http\Requests;
use Validator;
use App\Sale_location;
use App\User_email_location;
use App\Db;

class SaleController extends Controller
{
    protected $roles;
    protected $locations;

    public function __construct()
    {
        $this->middleware('auth');
        $this->locations = Location::lists('location', 'id');
        $this->roles     = array('Owner' => 'Owner', 'Supervisor' => 'Supervisor', 'Employee' => 'Employee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = \DB::table('sales')->select('sales.*')->orderBy('sorting_order', 'asc')->get();
        // $users = \DB::table('users')
        //     ->leftJoin('user_locations', 'users.id', '=', 'user_locations.user')
        //     ->leftJoin('locations', 'locations.id', '=', 'user_locations.location')
        //     ->select('users.*', 'locations.location')
        //     ->get();
        return view('sales.index',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
	{        
        $locations = $this->locations;
        return view('sales.create',compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = Sale::create([
            'name' => $request['name'],  
			'sorting_order' => $request['sorting_order'],	
        ]);
		$locVal = $request['location'];
        if($locVal != '')
        {
            if(is_array($locVal))
            {
                foreach ($locVal as $locValue) {
                    Sale_location::create([
                        'sale' => $sale->id,
                        'location' => $locValue,
                    ]);
                }
            }else{
                Sale_location::create([
                    'sale' => $sale->id,
                    'location' => $locVal,
                ]);
            }
        }		
		return redirect()->route('sale.index')->with('message','Sale has been added successfully!');
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
    public function edit(Sale $sale)
    {       
        $locations = $this->locations;
        $selLocations = Sale_location::where('sale', '=', $sale->id)->lists('location', 'id')->toArray();		
        return view('sales.edit',compact(['sale','locations','selLocations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        

        $sale->update([
            'name' => $request['name'],
			'sorting_order' => $request['sorting_order'],
        ]);

		$locVal = $request['location'];
		
		
        if($locVal != '')
        {
            if(is_array($locVal))
            {
                foreach ($locVal as $locValue) {
                    Sale_location::create([
                        'sale' => $sale->id,
                        'location' => $locValue,
                    ]);
                }
            }else{
                Sale_location::create([
                    'sale' => $sale->id,
                    'location' => $locVal,
                ]);
            }
        }
		
		
		
		return redirect()->route('sale.index')->with('message','Sale has been updated successfully!');
    }

	
	public function salearchive($id , Request $request)
    {
		
		$statusCode = $request->st;
		if($statusCode == 1) {
		Sale::where('id', '=', $id)->update(['status'   => 0]);   
		return redirect()->route('sale.index')->with('message','Archived successfully!');			
		} else {
		Sale::where('id', '=', $id)->update(['status'   => 1]);   
		return redirect()->route('sale.index')->with('message','Unarchived successfully!');
		}
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $patient = Patient::where('agent', '=', $user->id)->get()->first();

        // if($patient){
        //     return redirect()->route('user.index')->with('message','User can not be deleted, as He/She is already assigned to a patient');
        // }else{
        //     $user->delete();
        //     return redirect()->route('user.index')->with('message','User has been deleted successfully!');
        // }
    }

   /* protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role'  => 'required|max:255',
            'location'  => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    }*/

   /* protected function edit_validator(array $data)
    {
        $messsages = array(
            'npassword.min'=>'The password must be at least 6 characters.',
            'npassword.confirmed'=>'The password confirmation does not match.',
        );

        return Validator::make($data, [
            'name'  => 'required|max:255',
            'role'  => 'required|max:255',
            // 'location'  => 'required',
            'npassword' => 'min:6|confirmed',
        ], $messsages);
    }*/

	 protected function removeSelectedLocation(Request $request, Sale $sale)
    {
        $SaleLocation = Sale_location::where('id', '=', $request->id)->get()->first();
        $SaleLocation->delete();
        return redirect()->action(
            'SaleController@edit', $request->sale
        );
    }
   
}
