<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\PayrollEmployee;
use App\Location;
use App\PayrollDepartment;
use App\Http\Requests;
use Validator;
use App\PayrollCategory_location;
use App\PayrollEmployee_department;
use App\PayrollEmployee_location;
use App\Db;
use Session;


class PayrollEmployeeController extends Controller
{
    protected $roles;
    protected $locations;

    public function __construct()
    {
        $this->middleware('auth');
        $this->locations = Location::lists('location', 'id');
		$this->departments = PayrollDepartment::lists('name', 'id');
		
		
        $this->roles     = array('Owner' => 'Owner', 'Supervisor' => 'Supervisor', 'Employee' => 'Employee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {			
        $payrollemployees = \DB::table('payroll_employees')->select('payroll_employees.*')->orderBy('sorting_order', 'asc')->get();
        return view('payrollemployees.index',compact('payrollemployees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
	{        
        $departments  = $this->departments;
		$locations    = $this->locations;

        $locationId = Session::get('location_id'); 
        $queryData  = \DB::table('locations')->select('rate')->where('status', '=', 1)->where('id', '=', $locationId)->first();
        $rate       = $queryData->rate;

        return view('payrollemployees.create',compact('departments','locations','rate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		$locationId = Session::get('location_id'); 
        $queryData  = \DB::table('locations')->select('rate')->where('status', '=', 1)->where('id', '=', $locationId)->first();
        $employee = PayrollEmployee::create([
            'name' => $request['name'],            
			'rateperhour' => ($request['rateperhour'] == '')?$queryData->rate:$request['rateperhour'],
			'salary' => $request['salary'],
			'working_hour' => $request['working_hour'],
			'sorting_order' => $request['sorting_order'],
        ]);
				
		$locVal = $request['department'];
		$locationVal = $request['location'];
		
        if($locVal != '')
        {	
            if(is_array($locVal))
            {
                foreach ($locVal as $locValue) {
                    PayrollEmployee_department::create([
                        'payrollemp_id' => $employee->id,
						'payrollcat_depid' => $locValue,
                        'location' => $locationId,
                    ]);
                }
            }else{
                PayrollEmployee_department::create([
                    'payrollemp_id' => $employee->id,
					'payrollcat_depid' => $locVal['0'],					
                    'location' => $locationId,
                ]);
            }
        }	

		if($locationVal != '')
        {	
            if(is_array($locationVal))
            {
                foreach ($locationVal as $locationValue) {
                    PayrollEmployee_location::create([
                        'payrollemp_id' => $employee->id,
						'payrollcat_depid' => $locationValue
                    ]);
                }
            }else{
                PayrollEmployee_location::create([
                    'payrollemp_id' => $employee->id,
					'payrollcat_depid' => $locationVal['0']
                ]);
            }
        }	

        track_record("Employee ".$employee->name. " added");	
		return redirect()->route('payrollemployee.index')->with('message','Payroll Employee has been added successfully!');
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
    public function edit(PayrollEmployee $payrollemployee)
    {       
        $departments = $this->departments;
        $selDepartments = PayrollEmployee_department::where('payrollemp_id', '=', $payrollemployee->id)->lists('payrollcat_depid', 'id')->toArray();
		$locations = $this->locations;
        $sellocation = PayrollEmployee_location::where('payrollemp_id', '=', $payrollemployee->id)->lists('payrollcat_depid', 'id')->toArray();
        return view('payrollemployees.edit',compact(['payrollemployee','departments','selDepartments','locations','sellocation']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayrollEmployee $payrollemployee)
    {
        $locationId = Session::get('location_id'); 

        $old_record = $payrollemployee;
        $payrollemployee -> update([
            'name' => $request['name'], 
			'rateperhour' => $request['rateperhour'],
			'salary' => $request['salary'],
			'working_hour' => $request['working_hour'],
			'sorting_order' => $request['sorting_order'],	
        ]);
		$locVal = $request['department'];
		$locationVal = $request['location'];
        $new_record = $payrollemployee;

        track_record($new_record, 2, $old_record);

		$string = '';
        if($locVal != '')
        {
			$str = '';
            if(is_array($locVal))
            {
                foreach ($locVal as $locValue) {
					
                    PayrollEmployee_department::create([
                        'payrollemp_id' => $payrollemployee->id,
						'payrollcat_depid' => $locValue,
                        'location' => $locationId,
                    ]);

                    $departmentDe = PayrollDepartment::where('id', '=', $locValue)->first();
                    $str .= $departmentDe->name.", ";
                }
                $str = "Departments added ".rtrim($str, ", ");
            }else{
				
                PayrollEmployee_department::create([
                    'payrollemp_id' => $payrollemployee->id,
					'payrollcat_depid' => $locVal['0'],					
                    'location' => $locationId,
                ]);

                $departmentDe = PayrollDepartment::where('id', '=', $locValue)->first();
                $str = "Department added ".$departmentDe->name;
            }
            $string .= "Employee ".$payrollemployee->name.": ".$str;
        }
			
		if($locationVal != '')
        {
            $str = '';	
            if(is_array($locationVal))
            {
                foreach ($locationVal as $locationValue) {
					
                    PayrollEmployee_location::create([
                        'payrollemp_id' => $payrollemployee->id,
						'payrollcat_depid' => $locationValue
                    ]);

                    $locationDe = Location::where('id', '=', $locationValue)->first();
                    $str .= $locationDe->location.", ";
                }
                $str = "Locations added ".rtrim($str, ", ");
            }else{
                PayrollEmployee_location::create([
                    'payrollemp_id' => $payrollemployee->id,
					'payrollcat_depid' => $locationVal['0']
                ]);

                $locationDe = Location::where('id', '=', $locationVal['0'])->first();
                $str = "Location added ".$locationDe->location;
            }

            $string .= "<br />Employee ".$payrollemployee->name.": ".$str;
        }	
        
        track_record($string, 3);	
		
		return redirect()->route('payrollemployee.index')->with('message','Employee has been updated successfully!');
    }

	
	public function payrollemployeearchive($id , Request $request)
    {
		$locationId = Session::get('location_id');
		$statusCode = $request->st;
		if($statusCode == 1) {
		PayrollEmployee::where('id', '=', $id)->update(['status'   => 0]);   
		return redirect()->route('payrollemployee.index')->with('message','Archived successfully!');			
		} else {
		PayrollEmployee::where('id', '=', $id)->update(['status'   => 1]);   
		PayrollEmployee_department::where('payrollemp_id', '=', $id)->where('location', '=', $locationId)->update(['status'   => 0]); 
		PayrollEmployee_location::where('payrollemp_id', '=', $id)->where('payrollcat_depid', '=', $locationId)->update(['status'   => 0]); 	
		return redirect()->route('payrollemployee.index')->with('message','Unarchived successfully!');
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

	 protected function removeEmployeeLocation(Request $request, PayrollEmployee $payrollemployee)
    {
        // var_dump($payrollemployee); exit();
		
        $SaleLocation = PayrollEmployee_location::where('id', '=', $request->id)->get()->first();
        $departmentDetail = Location::where('id', '=', $SaleLocation->payrollcat_depid)->first();
        $emplyee = PayrollEmployee::where('id', '=', $departmentD->payrollemp_id)->first();
        $SaleLocation->delete();

        $string = "Employee ".$emplyee->name.": Removed Location ".$departmentDetail->location;
        track_record($string, 3);

        return redirect()->action(
            'PayrollEmployeeController@edit', $request->payrollemployee
        );
    }
	
	 protected function removeSelectedDepartment(Request $request, PayrollEmployee $payrollemployee)
    {

		
        $departmentD = PayrollEmployee_department::where('id', '=', $request->id)->get()->first();
        $departmentDetail = PayrollDepartment::where('id', '=', $departmentD->payrollcat_depid)->first();
        $emplyee = PayrollEmployee::where('id', '=', $departmentD->payrollemp_id)->first();
        $departmentD->delete();

        $string = "Employee ".$emplyee->name.": Removed Department ".$departmentDetail->name;
        track_record($string, 3);

        return redirect()->action(
            'PayrollEmployeeController@edit', $request->payrollemployee
        );
    }
	
	public function viewAllData (Request $request){
		$selectedValue = $request->selectedOption;
		
		if($selectedValue == 'archive'){
			$status = array(1);
		}
		if($selectedValue == 'unarchive'){
			$status = array(0);
		}
		if($selectedValue == 'all'){
			$status = array(0,1);
		}
		$payrollemployeesData = \DB::table('payroll_employees')->select('payroll_employees.*')
							->whereIn('status' , $status)
							->get();
		$html = '';
		$html.='<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">';
		$html.='<thead>';
		$html.='<tr>';
		$html.='<th>PAYROLL EMPLOYEE</th>';													
		$html.='<th>ACTION</th>';
		$html.='</tr>';
		$html.='</thead>';
		$html.='<tbody >';
		 foreach($payrollemployeesData as $payrollemp){
			$html.='<tr>';
				$html.='<td>'.$payrollemp->name.'</td>';
				$html.='<td>';
					$html.='<form method="POST" action="http://localhost/zips/payrollemployee/'.$payrollemp->id.'accept-charset="UTF-8" class="delete">';
						
						$html.='<a href="http://localhost/zips/payrollemployee/'.$payrollemp->id.'/edit" class="fa fa-pencil" data-toggle="tooltip" data-placement="left" title="edit"></a>';						
						$html.='|';
						if($payrollemp->status == 1){
							$html.='<a href="http://localhost/zips/payrollemployeearchive/'.$payrollemp->id.'?st='.$payrollemp->status.'">Archive</a>';
						}else if($payrollemp->status == 0){
							$html.='<a href="http://localhost/zips/payrollemployeearchive/'.$payrollemp->id.'?st='.$payrollemp->status.'">Unarchive</a>';
						}	
					$html.='</form>';
				$html.='</td>';
			$html.='</tr>';
		 }
			$html.='</tbody>';
			$html.='</table>';
								
		$html.='<script>';
			$html.='$("#example").DataTable();';
		$html.='</script>';		
		return $html;		
	}
	
   
}

 
			                                        
			                                        
													
													
			                                       

			                                    
