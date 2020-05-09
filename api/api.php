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
	
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Origin:*");

	if($_GET['key']=="1234567890"){
		
	    $login_info = [
		    "items"=>[["uname"=>"yusuf","password"=>"123456"],["uname"=>"nadim","password"=>"12345678"]]
		    ];

		echo json_encode($login_info);	

	}
?>