<?php

// class Connection{

// 	//Properties
// 	private $servername  = 'localhost';
// 	private $username = 'root';
// 	private $password = '';
// 	private $dbname = 'account_manager';

// 	//Constructor
// 	// public function __construct(){
// 	// 	$this->servername = 'localhost';
// 	// 	$this->username = 'root';
// 	// 	$this->password = '';
// 	// 	$this->dbname = 'meme_jar';
// 	// }

// 	//Method
// 	public function connect(){
// 		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

// 		if($conn){
// 			return $conn;
// 		}
// 		else{
// 			die("Connection failed: " . mysqli_connect_error());
// 		}
// 	}
// }

function connect(){
	
	$servername  = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'account_manager';
	//$dbname = 'web_series_db';
	$con = new mysqli($servername, $username, $password, $dbname);

	if(mysqli_connect_error()){
		die("Connection failed: " . mysqli_connect_error());
	}else{
		return $con;
	}
}
?>