<?php

include './class/momController.php';
include './lib/SimpleXLSX.php';

class IndexController extends MomController{
	
	public $title = "Excel File Uploader";
	
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
				
					move_uploaded_file($files['file_upload']['tmp_name'],'uploads/'.$files['file_upload']['name']);
					
					if ( $xlsx = SimpleXLSX::parse('uploads/'.$files['file_upload']['name']) ) {
						
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
						
						$average = $this->save_data($xlsx->rows());
						echo "Average:". number_format($average, 3);

					} else {
						throw new Exception('Excel Parse Error'); 
						echo SimpleXLSX::parseError();
						
					}
			}
		}catch(Exception $e){
			echo "Exception Caught".$e->getMessage();			
		}
		
	}
	
	private function save_data($rows){
		
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
}

$obj  = new IndexController();

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action']){    

	$func  = $_POST['action'];
	
	$obj->$func($_POST,$_FILES);
}

$obj->index();
?>