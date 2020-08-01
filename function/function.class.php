<?php include('mysql_function.class.php');
session_start();

function LocalHomeUrl(){
	return 'http://localhost/ALU/AccountManager/';
}

define("LOCAL_HOME_URL", "http://localhost/ALU/AccountManager/");

function ReDirect($location){
	header('location:'.$location);
}

function CheckLogin(){
	if(!empty($_SESSION["userid"])){
	    ReDirect(LOCAL_HOME_URL);
		// echo 'User is: '.$_SESSION["user_name"];
	}
}

function IndexCheckLogin(){
	if(empty($_SESSION["userid"])){
		//$home_url = LocalHomeUrl();
		ReDirect(LOCAL_HOME_URL.'login.php');
	}
}

//Status Option
function Status(){
    return array(
        "0" => "Inactive",
        "1" => "Active"
    );
}
//Get Status
function getStatus($s){
    $a = Status();
    return $a[$s];
}

//Gender Option
function Gender(){
    return array(
        "1" => "Male",
        "2" => "Female",
        "3" => "Other"
    );
}
//Get Gender
function getGender($g){
    $gender = Gender();
    return $gender[$g];
}

//Otp Option
function OtpOption(){
	return array(
		"0" => "No",
		"1" => "Yes"
	);
}
//Get Otp Option
function getOtpOption($g){
    $otp = OtpOption();
    return $otp[$g];
}
?>