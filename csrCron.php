<?php
    date_default_timezone_set('US/Eastern');
    error_reporting(E_ALL); 
	ini_set('display_errors', 1);
	
	// if($_SERVER['HTTP_HOST']=="www.actiknow-test.in"  || $_SERVER['HTTP_HOST']=="actiknow-test.in")
	// {
		// define('DB_HOST', 'localhost');
		// define('DB_USERNAME', 'actiknow_zips');
		// define('DB_PASSWORD', 'actiknow_zips');
		// define('DB_NAME', 'actiknow_zips@#');
	// } else
	// {	
		// define('DB_HOST', 'localhost');
		// define('DB_USERNAME', 'root');
		// define('DB_PASSWORD', '');
		// define('DB_NAME', 'zips');
	// }

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'kvmgmt_user');
define('DB_PASSWORD', 'Grw8a_41');
define('DB_NAME', 'kvmgmt_db');

$db_conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($db_conn)
	mysqli_select_db($db_conn, DB_NAME);
else
	echo 'database connection error!';

// Fetch all condo //
$s = "select cs.*, csf.*, ln.location_code, ln.location as location_name, u.name, u.email from `customer_services` cs  left join `customer_servicefollows` csf on `csf`.`customer_service_id` = `cs`.`id` 
left join locations ln on ln.id = csf.location left join users u on u.id = csf.followup_by 
where `csf`.`id` = (select max(customer_servicefollows.id) from customer_servicefollows where customer_service_id = `cs`.id) and csf.status = 1";

$q = mysqli_query($db_conn,$s);
while($d = mysqli_fetch_array($q))
{
	 $curent_date  = date("Y-m-d");
	 $curent_time  = date("h:i A");
	 $followUpdate = date("Y-m-d", strtotime($d['followup_date']));
	 
	 if($curent_date == $followUpdate && $curent_time == $d['followup_time'])
	 {
		$sub  = 'Pending CSR Notification for '.$d['location_code'].' '.$d['location_name'].'';
		$from = 'bvago@kvmgmt.com';
		$msg  = 'This is a reminder that you were to contact '.$d['customer_name'].' '.$d['customer_lastname'].'  on '.$d['followup_date'].' by '.$d['followup_time'].'. Follow Up
		with '.$d['customer_name'].' and then log into the Portal and update the status.';
		
		$headers1 = array("From: ZIPS CSR Notification<".$from.">","Content-Type: text/html");
		$myheaders1 = implode("\r\n",$headers1) . "\r\n";
		mail($d['email'], $sub, $msg, $myheaders1); 
	}
}
?>