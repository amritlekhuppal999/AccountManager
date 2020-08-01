<?php include('function/function.class.php'); 

//to read JSON data sent and convert it into an array.
//$mySER = json_decode(file_get_contents('php://input'));
//print_r($mySER);
//here mySER is a class and not an array so we cannot access its properties like $mySER["action"] but like this $mySER->action;
//echo $mySER->action;

$mySER = json_decode(file_get_contents('php://input'));

if(!empty($mySER->action) && $mySER->action == 'search-accounts' ){
	$userid = $mySER->userid;
	$ser_key = $mySER->ser_key;

	$data = array();
	$retHtml = '';

	if(strlen($ser_key) == 0){
		$LIMIT = '';
	}else{ $LIMIT = ' LIMIT 10 '; }

	$acc = new RecordSet('SELECT * FROM `account_list` WHERE user_id='.$userid.' AND account_name LIKE "%'.$ser_key.'%"'.$LIMIT);
	if($acc->totalRows){
		while($rowData = $acc->result->fetch_assoc()){
			$lastModified = date("d-M-Y h:i:s", strtotime($rowData["last_modified"]));
			$retHtml .= '
			<tr>
				<td>'.$rowData["id"].'</td>

				<td><span class="badge badge-primary">'.$rowData["account_name"].'</span></td>

				<td><span class="badge badge-secondary">'.$rowData["username"].'</span></td>

				<td><span class="badge badge-secondary">'.$rowData["linked_email"].'</span></td>

				<td><span class="badge badge-secondary">'.$rowData["linked_phone"].'</span></td>

			    <td><span class="badge badge-secondary">'.$rowData["password"].'</span></td>';

			    if($rowData["otp_based"]==1){
			    	$retHtml .= '<td><span class="badge badge-success">'.getOtpOption($rowData["otp_based"]).'</span></td>';
			    }else{
			    	$retHtml .= '<td><span class="badge badge-danger">'.getOtpOption($rowData["otp_based"]).'</span></td>';
			    }

			    $retHtml .= '<td><span class="badge badge-secondary">'.$lastModified.'</span></td>';

			    if($rowData["status"]==1){
			    	$retHtml .= '<td><span class="badge badge-success">'.getStatus($rowData["status"]).'</span></td>';
			    }else{
			    	$retHtml .= '<td><span class="badge badge-danger">'.getStatus($rowData["status"]).'</span></td>';
			    }

			    $retHtml .= '<td><a href="?add-accounts&id='.$rowData["id"].'" class="badge badge-info">Modify</a></td>
			</tr>';
		}
	}
	else{
		$retHtml .= '
		<tr>
			<td colspan="10">No match found.</td>
		</tr>';
	}

	$data["dat"] = $retHtml;
	echo json_encode($data, JSON_PRETTY_PRINT);
}


?>