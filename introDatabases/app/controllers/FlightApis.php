<?php
/**
 * This is the controller for the main page / control
 */

class FlightApis extends Controller{
	private $_userModel;
	private $_data = [];

	public function __construct(){
		$this->_userModel = $this->model('FlightAPI');
	}

	public function index(Array $params=[]){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST['data']=='checked'){
				//get raw data and filter it
				$this->_data['jsonData'] = $this->_userModel->getRawData();
				$this->_data['jsonData'] = $this->_userModel->filterData($this->_data['jsonData']);

				//add the data to the database
				$this->_data['sql'] = $this->_userModel->insertData($this->_data['jsonData']);
			}
		}
		


		$this->view('flights/index', $this->_data);

	}


}

