<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Discount;
use App\Location;
use App\Http\Requests;
use Validator;
use App\Discount_location;
use App\Db;

class DiscountController extends Controller
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
        $discounts = \DB::table('discounts')->select('discounts.*')->orderBy('sorting_order', 'desc')->get();

	
        // $users = \DB::table('users')
        //     ->leftJoin('user_locations', 'users.id', '=', 'user_locations.user')
        //     ->leftJoin('locations', 'locations.id', '=', 'user_locations.location')
        //     ->select('users.*', 'locations.location')
        //     ->get();
        return view('discounts.index',compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
	{        
        $locations = $this->locations;
        return view('discounts.create',compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $discount = Discount::create([
            'name' => $request['name'],
			'sorting_order' => $request['sorting_order'],	
        ]);
		$locVal = $request['location'];
        if($locVal != '')
        {
            if(is_array($locVal))
            {
                foreach ($locVal as $locValue) {
                    Discount_location::create([
                        'discount' => $discount->id,
                        'location' => $locValue,
                    ]);
                }
            }else{
                Discount_location::create([
                    'discount' => $discount->id,
                    'location' => $locVal,
                ]);
            }
        }		
		return redirect()->route('discount.index')->with('message','Discount has been added successfully!');
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
    public function edit(Discount $discount)
    {       
        $locations = $this->locations;
        $selLocations = Discount_location::where('discount', '=', $discount->id)->lists('location', 'id')->toArray();		
        return view('discounts.edit',compact(['discount','locations','selLocations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        

        $discount->update([
            'name' => $request['name'],
			'sorting_order' => $request['sorting_order'],
        ]);

		$locVal = $request['location'];
		
		
        if($locVal != '')
        {
            if(is_array($locVal))
            {
                foreach ($locVal as $locValue) {
                    Discount_location::create([
                        'discount' => $discount->id,
                        'location' => $locValue,
                    ]);
                }
            }else{
                Discount_location::create([
                    'discount' => $discount->id,
                    'location' => $locVal,
                ]);
            }
        }
		
		
		
		return redirect()->route('discount.index')->with('message','Discount has been updated successfully!');
    }

	
	public function discountarchive($id , Request $request)
    {
		
		$statusCode = $request->st;
		if($statusCode == 1) {
		Discount::where('id', '=', $id)->update(['status'   => 0]);   
		return redirect()->route('discount.index')->with('message','Archived successfully!');			
		} else {
		Discount::where('id', '=', $id)->update(['status'   => 1]);   
		return redirect()->route('discount.index')->with('message','Unarchived successfully!');
		}
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
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

	 protected function removeSelectedLocation(Request $request, Discount $discount)
    {
        $SaleLocation = Discount_location::where('id', '=', $request->id)->get()->first();
        $SaleLocation->delete();
        return redirect()->action(
            'DiscountController@edit', $request->discount
        );
    }
   
}
