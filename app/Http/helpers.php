<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Track_employees;
use App\Location;
use App\Salesection;
use App\Laboursection;
use App\PayrollCategory;
use App\PayrollEmployee;
use App\Laborheadersections;
use App\PayrollDepartment_location;

/*
* $action : 1: Insert, 2: Update
*/
function track_record($new_record, $action = 1, $old_record = false)
{
	if($action == 2) // Update
	{
		$string = '';
		if($old_record->name != $new_record->name)
			$string = 'Employee '.$old_record->name.': changed to '.$new_record->name;
		if($old_record->salary != $new_record->salary)
			$string = 'Employee '.$old_record->name.': salary changed to $'.number_format((Float)$new_record->salary, 2);
		if($old_record->rateperhour != $new_record->rateperhour)
			$string = 'Employee '.$old_record->name.': Rate per hour changed to '.$new_record->rateperhour;
		if($old_record->sorting_order != $new_record->sorting_order)
			$string = 'Employee '.$old_record->name.': Sorting order changed to '.$new_record->sorting_order;


		$locationId   = Session::get('location_id');
		$locationInfo = Location::where('id', '=', $locationId)->first();
		$insert_ary['employee_detail'] 	= $string; // serialize($employee_detail);
		$insert_ary['action'] 			= 'Update';
		$insert_ary['location'] 		= $locationInfo->location;
		$insert_ary['location_id'] 		= $locationId;
		$insert_ary['created_by'] 		= Auth::user()->name;
		if($insert_ary['employee_detail'] != '')
			Track_employees::create($insert_ary);
	}
	else // Insert
	{
		$locationId   = Session::get('location_id');
		$locationInfo = Location::where('id', '=', $locationId)->first();

		$insert_ary['employee_detail'] 	= $new_record; // serialize($employee_detail);
		$insert_ary['action'] 			= ($action == 1)?'Create':'Update';
		$insert_ary['location'] 		= $locationInfo->location;
		$insert_ary['location_id'] 		= $locationId;
		$insert_ary['created_by'] 		= Auth::user()->name;

		if($insert_ary['employee_detail'] != '')
			Track_employees::create($insert_ary);
	}
}

function getNetSale($location,$start_date,$end_date){
$result=	Salesection::where(['location_id'=>$location,'nameDep'=>'rec'])
	->whereBetween('dataDate', [$start_date,$end_date])
	->sum('amount');
	if($result == null){
		$result =0;
	}

	return $result;
}

function getLaberRateByCate($week,$cate)
{

		$locationId = Session::get('location_id');
		//$header 	= Laborheadersections::where('id', "=" , $headerid)->first();
		$total = 0;
	if($category = PayrollCategory::find($cate)){
		 if($category->name=='Salary'){
		return PayrollEmployee::whereIn('id',function($query) use($week){
				 $query->select('empId')->from('laboursections')->where(['weekNo'=>$week])->groupBy('empId');
			 })->sum('salary');
		 }
		 $result =	Laboursection::where(['weekNo'=>$week])->where('catId',$cate)->orderBy('empId','asc')->get();

		 foreach ($result as $key => $value) {

			 if($category = PayrollCategory::find($value->catId))
			 {
					if($emp = PayrollEmployee::find($value->empId)){
						$emp_payratehour = 	$emp->rateperhour;

					}
					$category_name = $category->name;
					if($category_name!='salary')
					if($category_name == 'Overtime'){
						$total= $total+($emp_payratehour + ($emp_payratehour/2))*$value->rate;
					}
					else{
						$total = $total+ ($value->rate*$emp_payratehour);
					}
				}

		 $value->catename = $category_name;
	 $value->total = $total;
	 }
	}

		return $total ;
}

function getLaberRate($locationId,$week){


	$header 	= Laborheadersections::where('location_id', "=" , $locationId)
				->where('laborheadersections.start_week','=',$week)
				->where('laborheadersections.end_week','=',$week)
				->first();
				$total = $salary = 0;
	if(!empty($header)){
		$header_week= $header->start_week;
	  $result =	Laboursection::where(['weekNo'=>$week,'header_id'=>$header->id])->orderBy('empId','asc')->get();


	  foreach ($result as $key => $value) {
			$category = PayrollCategory::Join('payroll_category_locations', 'payroll_categories.id', '=', 'payroll_category_locations.payrollcat_id')
			->where('payroll_categories.status', '=', '1')->where('payroll_category_locations.location', '=', $locationId)
			->where('payroll_categories.id',$value->catId)
			->select('payroll_categories.*')->orderBy('sorting_order','asc')->first();
           $category_name = '';
			if($category)
			{
				 if($emp = PayrollEmployee::find($value->empId)){
					 $emp_payratehour = 	$emp->rateperhour;

				 }
				 $category_name = $category->name;
				 if($category_name == 'Overtime'){
				     if($value->rate>0)
					    $total= $total+($emp_payratehour + ($emp_payratehour/2))*$value->rate;
				 }
				 else{
				        if($value->rate>0)
					         $total = $total+ ($value->rate*$emp_payratehour);
				 }
			}

		$value->catename = $category_name;
	$value->total = $total;
	}

	$salary = PayrollEmployee::whereIn('id',function($query) use($header_week){
		$query->select('empId')->from('laboursections')->where(['weekNo'=>$header_week])->groupBy('empId');
	})->sum('salary');

	}

	return $total+$salary;
}

function deleteDuplicateData ($week,$location_id,$start_date,$end_date){
//echo $week.'---'.$location_id.'===='.$start_date.'====='.$end_date; die;
//if($week == 17){
//	DB::enableQueryLog();

$result = 	DB::table('salesections')
			->whereBetween('dataDate', [$start_date,  $end_date])
	    ->where('storeNo', '!=',$week)
	    ->where('location_id', $location_id)
		//	->get();
	    // ->where('nameDep', 'LIKE', 'sale')
	    // ->where('location_id', $location_id)
	    // ->where('storeNo', $week)
	    // ->where('dataDate', '<', $start_date)
	    // ->where('dataDate', '<', $end_date)
	    ->delete();
		//	dd(DB::getQueryLog());
//}

  getDuplicate($start_date,$end_date,$location_id);

}

function getDuplicate($start_date,$end_date,$location_id){
    $result = DB::select("SELECT * FROM `salesections` where location_id =$location_id and nameDep != 'sale' and dataDate BETWEEN '".$start_date."' and '".$end_date."' ORDER BY `salesections`.`dataDate` DESC");

  $duplicateObjects = findDuplicateObjects($result);

  foreach ($duplicateObjects as $value) {
    	DB::table('salesections')
          ->where('id', $value->id)
          ->delete();
  }

}


function findDuplicateObjects($array) {
    $keys = [];
    $duplicates = [];

    foreach ($array as $object) {
        $key = $object->nameId . '|' . $object->nameDep . '|' . $object->dataDate . '|' . $object->dataDay;

        // If the key is already encountered, it's a duplicate
        if (isset($keys[$key])) {
            $duplicates[] = $object;
        } else {
            $keys[$key] = true;
        }
    }

    return $duplicates;
}



// function getStartAndEndDatebyweek($week,$year) {
// 		$dateTime = new DateTime();
// 		$dateTime->setISODate($year, $week);
// 		$timestamp = mktime( 0, 0, 0, 1, 1,  $year ) + ( $week * 7 * 24 * 60 * 60 );
// 		$timestampForMonday = $timestamp - 86400 * ( date( 'N', $timestamp ) +1 );
// 		$dateForMonday = date( 'Y-m-d', $timestampForMonday );
// 		$result['start_date'] = $dateForMonday;
// 		$dateTime->modify('+4 days');
// 		$result['end_date'] = $dateTime->format('Y-m-d');
// 		return $result;
// 		}


    function getStartAndEndDatebyweek($week,$date) {
		$result['start_date'] = date('Y-m-d', strtotime($date . " -" . (date('w', strtotime($date)) == 6 ? 0 : date('w', strtotime($date)) + 1) . " days"));
		$result['end_date'] = date('Y-m-d', strtotime($result['start_date'] . " +6 days"));
		return $result;
	}

	function getWeekByDate($date){
		$week=date('W', strtotime($date));
		if(date('N', strtotime($date)) == '6' || date('N', strtotime($date))=='7'){
				$week=$week+1;
		}
		return $week;
	}

	function getSaleTax($locationId,$sDate,$eDate) {
			$adjSum = DB::select("select `adjustments`.`name`, IFNULL(sum(salesections.unit),0) as unit, IFNULL(sum(salesections.amount),0) as amount from `adjustments` left join `salesections` on `salesections`.`nameId` = `adjustments`.`id` and (`salesections`.`dataDate` between '".$sDate."' and '".$eDate."' and `salesections`.`location_id` = '".$locationId."' and `salesections`.`nameDep` = 'adj') where adjustments.status = '1' and adjustments.id = 9  group by `adjustments`.`name` order by `sorting_order` asc");
			if(!empty($adjSum)){
				return $adjSum[0]?$adjSum[0]->amount:0;
			}
			return 0;
	}

	// Add by kajal

	// function correctWeekUpdate($date,$week_update,$start_date,$store_id,$location_id) {

	// 	$result = DB::table('location_daterange')
	// 		->where('location_id', $location_id)
	// 		->whereRaw('? between start_date and end_date', [$date])
	// 		->first();

	// 	$week = 0;
	// 	if ($result) {
	// 		if ($date == $result->end_date) {
	// 			$weeksArray = explode(',', $result->week);
	// 			$week = isset($weeksArray[1]) ? $weeksArray[1] : 0;
	// 		} elseif ($date < $result->end_date) {
	// 			$weeksArray = explode(',', $result->week);
	// 			$week = isset($weeksArray[0]) ? $weeksArray[0] : 0;
	// 		}

	// 		$store_update = $week;

	// 		// Update the salesections table
	// 		if ($week > 0) {
	// 			DB::table('salesections')
	// 				->whereBetween('dataDate', [$start_date, $date])
	// 				->where('location_id', $location_id)
	// 				->update(['weekNo' => $week_update]);
	// 				//, 'storeNo' => $store_update
	// 		}
	// 	}

	// 	return $week;
	// }
	// End

 ?>
