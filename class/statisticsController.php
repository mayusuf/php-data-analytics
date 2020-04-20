<?php
/*
#title           :staticController.php
#description     :This class implements few statistics terms 
#author		 	 :Abu Yusuf
#date            :20200415
#version         :1.0.1    
#notes           :Install minimum PHP 7.2, MySQL.
#Github 		 :https://github.com/mayusuf/php-data-analytics
*/ 

class statisticsController{

	public $title;

	private $average;
	private $variance;
	private $standard_deviation;
	private $data;
	

	public function __construct($data){
		$this->title = "Statistics Term's Calculation";
		$this->data = $data; // set data, data of a column of a excel file.
	} 

	// Calculate average of data 
	public function average(){		

		try{
			if(!empty($this->data)){

				$i = 0;
				$sum = 0;
				$average = 0;
				
				foreach($this->data as $line){	
					
					if($i!= 0){
						$sum +=$line[0];	
					}
					$i++;
				}

				$this->average = $sum/($i-1);
			}
		}catch(Exception $e){
			echo "Exception Caught".$e->getMessage();
		}
				
		return number_format($this->average,3);
	}

	
	// calculate variance. Varian depends on average. 
	
	public function variance(){

		try{
			if(!empty($this->data)){

				$this->average();
				$this->variance = $this->squareDeviation();

			}
		}catch(Exception $e){
			echo "Exception Caught".$e->getMessage();
		}
		
		return number_format($this->variance,3);
	}

	// calculate variance. Varian depends on average. 

	private function squareDeviation(){

		$i = 0;
		$sum_square_deviation = 0;
			
		foreach($this->data as $line){	
					
			if($i!= 0){
				$sum_square_deviation += pow($line[0] - $this->average,2);
			}
			$i++;
		}

		$average_square_deviation = $sum_square_deviation/($i-1);
		return $average_square_deviation;
	}

	// Calculate Standard Deviation
	public function standardDeviation(){

		return number_format(sqrt($this->variance),3);
	}
}

?>