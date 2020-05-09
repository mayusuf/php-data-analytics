<?php
    
/*
#title           :api.php
#description     :This script provides data as needed.
#author		 	 :Abu Yusuf
#date            :20200509
#version         :1.0.0  
#notes           :Install minimum PHP 7.2, MySQL.
#Github 		 :https://github.com/mayusuf/php-data-analytics
*/ 
	
	
	class apiController{
		
		function __construct(){
			# code...
		}

		public function getApi($key){

			header("Content-Type: application/json; charset=UTF-8");
			header("Access-Control-Allow-Origin:*");

			if($key=="1234567890"){
				
			    $login_info = [
				    "items"=>[["uname"=>"yusuf api","password"=>"123456"],["uname"=>"nadim","password"=>"12345678"]]
				    ];

				echo json_encode($login_info);	

				}
		}
	}

if($_SERVER['PATH_INFO']){

	//print_r($_SERVER);
	$obj  = new apiController();

	$func = substr($_SERVER['PATH_INFO'],1);

	$obj->$func($_GET['key']);	

}

	// header("Content-Type: application/json; charset=UTF-8");
	// header("Access-Control-Allow-Origin:*");

	// if($_GET['key']=="1234567890"){
		
	//     $login_info = [
	// 	    "items"=>[["uname"=>"yusuf","password"=>"123456"],["uname"=>"nadim","password"=>"12345678"]]
	// 	    ];

	// 	echo json_encode($login_info);	

	// }
?>