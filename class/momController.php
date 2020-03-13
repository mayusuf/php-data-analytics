<?php

DEFINE('DS', DIRECTORY_SEPARATOR); 

include './class/DB.php';

class MomController extends DB{
	
	public $view;
	public $data;
	public $conn;
	
	public $view_folder=".".DS."view";
	
	protected function __construct(){
		
		$this->view = "index";
		$this->conn = $this->connection();
		
	}
	
	protected function loadView($view_name ='',$data){
		
		$this->data=$data;
		extract($this->data);
		
		if($view_name == ''){
			require_once ($this->view_folder.DS.$this->view.'.php');			
		}else{
			
		}
			
		
	}
	
}
?>