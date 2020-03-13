<?php

DEFINE('servername', "localhost");
DEFINE('username', "root");
DEFINE('password', ""); 
DEFINE('db', "test"); 

class DB{
	
	protected function __construct(){
		
	}
	
	static protected function connection(){
		
		// Create connection
		$conn = mysqli_connect(servername, username, password,db);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully";
		return $conn;
	}
}
?>