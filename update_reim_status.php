<?php 
//$conn = mysqli_connect('localhost','root', '', 'zips');
$conn = mysqli_connect('127.0.0.1','kvmgmt_user', 'Grw8a_41', 'kvmgmt_db');
$qry = "select rm.*, u.role, u.claim from reimbursements rm left join users u on rm.user_id = u.id";
$res  = mysqli_query($conn, $qry);

while($v = mysqli_fetch_array($res)) {
		$originalClaimValue = ($v['claim'])?($v['claim']):0;	
		/****condition start for status****/
		if(($originalClaimValue < $v['proof_purchase']) && $v['approved_amount'] == '') {
				$status = 'Approval Pending';
		} else if(($originalClaimValue < $v['proof_purchase']) && isset($v['approved_amount']) && $v['approved_amount'] != '') {
				$status = 'Payment Pending';
				if($v['resolution'] == 'check' && ($v['credit_amount']) != '' && ($v['resolution_check']) != ''){
						$status = 'Paid';
				} elseif($v['resolution'] == 'storeCredit' && ($v['resolution_store_credit_added']) != '' && ($v['resolution_store_credit_check_date']) != ''){
						$status = 'Paid';
				} elseif($v['resolution'] == 'checkstorecredit' && ($v['resolution_check_store_credit_added']) != '' && ($v['resolution_check_store_credit_check']) != '' && $v['resolution_check_store_credit_check_date'] != '' && $v['resolution_check_store_credit_check_credit_number'] != '' ){
						$status = 'Paid';
				} elseif($v['resolution'] == 'cash' && $v['resolution_cash_paid'] != '' && $v['resolution_cash_paid_date'] != '') {
						$status = 'Paid';
				}
		} else if(($originalClaimValue > $v['proof_purchase']) || $v['role'] == 'Owner') {
			if($v['resolution'] == '') {
					$status = 'Pending';
			} elseif($v['resolution'] == 'check' && ($v['credit_amount']) != '' && ($v['resolution_check']) != ''){
					$status = 'Paid';
			} elseif($v['resolution'] == 'storeCredit' && ($v['resolution_store_credit_added']) != '' && ($v['resolution_store_credit_check_date']) != ''){
					$status = 'Paid';
			} elseif($v['resolution'] == 'checkstorecredit' && ($v['resolution_check_store_credit_added']) != '' && ($v['resolution_check_store_credit_check']) != '' && $v['resolution_check_store_credit_check_date'] != '' && $v['resolution_check_store_credit_check_credit_number'] != '' ){
					$status = 'Paid';
			} elseif($v['resolution'] == 'cash' && $v['resolution_cash_paid'] != '' && $v['resolution_cash_paid_date'] != '') {
					$status = 'Paid';
			} else {
				$status = 'Pending';
			}
		} 
		$upQry = "update reimbursements set status = '".$status."' where id = ".$v['id']."";
		mysqli_query($conn, $upQry); 
}
mysqli_close($conn);
?>