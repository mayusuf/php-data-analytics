<?php

/*
#title           :index.php
#description     :This script is the entry point of the application. Upload the excel file.
#author		 	 :Abu Yusuf
#date            :20200313
#version         :1.1.1   
#usage		     :Show landing page and form. 
#notes           :Install minimum PHP 7.2, MySQL.
#Github 		 :https://github.com/mayusuf/php-data-analytics
*/ 

include './class/momController.php';
include './lib/SimpleXLSX.php';


class indexController extends momController{
	
	public $title = "Excel File Uploader";
	public $stat;

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){

		$data['title'] = $this->title;
		$this->loadView('',$data);
	}
	
	public function file_upload($post,$files){
		
		//print_r($post);
		//print_r($files);
		
		try {
			if($files['file_upload']){
				
					$is_uploaded = move_uploaded_file($files['file_upload']['tmp_name'],'uploads/'.$files['file_upload']['name']);

					if($is_uploaded){

						if ( $xlsx = SimpleXLSX::parse('uploads/'.$files['file_upload']['name']) ) {
								
								//print_r($xlsx->rows()[][]);

								echo '<table><tbody>';
								
								$i = 0;

								foreach ($xlsx->rows() as $elt) {
									if ($i == 0) {
										echo "<tr><th>" . $elt[0] . "</th></tr>";
									}else {
										echo "<tr><td>" . $elt[0] . "</td></tr>";
									}      

								  $i++;
								}

								echo "</tbody></table>";
								
								$this->stat= $this->loadStatistic($xlsx->rows());
								
								$average = $this->stat->average();

								$variance = $this->stat->variance();

								$sd = $this->stat->standardDeviation();

								//$average = $this->saveData($xlsx->rows());

								echo "Average:". $average;
								echo "<br>";
								echo "Variance:".$variance;
								echo "<br>";
								echo "Standard Deviation:".$sd;

							} else {
								throw new Exception('Excel Parse Error'); 
								echo SimpleXLSX::parseError();
						}
					}
			}
		}catch(Exception $e){
			echo "Exception Caught".$e->getMessage();			
		}
		
	}
	
	private function saveData($rows){
		
		$i = 0;
		$sum = 0;
		$average = 0;
		
		foreach($rows as $line){	
			
			if($i!= 0){
				$sql = "INSERT INTO fb(fb_friends) VALUES (".$line[0].")";
				mysqli_query($this->conn,$sql);		
				$sum +=$line[0];	
			}
			$i++;
		}
		$average = $sum/($i-1);
		return $average;
		
	}

	public function getApi($key){

	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Origin:*");

	if($key=="1234567890"){
		
	    $login_info = [
		    "items"=>[["uname"=>"yusuf hasan","password"=>"123456"],["uname"=>"nadim","password"=>"12345678"]]
		    ];

		echo json_encode($login_info);	

		}
	}

	
}

$obj  = new indexController();

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action']){    

	$func  = $_POST['action'];
	
	$obj->$func($_POST,$_FILES);

}
else if($_SERVER['PATH_INFO']){

	//print_r($_SERVER);
	
	$func = substr($_SERVER['PATH_INFO'],1);

	$obj->$func($_GET['key']);	

}
else{

	$obj->index();	
}


?>