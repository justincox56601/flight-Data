<?php
/**
 * This is the class that will handle all database interaction
 * this is a singleton
 */

 class Database{
	private static $_instance;

	private $_dbHost = DB_HOST;
	private $_dbUser = DB_USER;
	private $_dbPass = DB_PASS;
	private $_dbName = DB_NAME;
	private $_conn;
	private $_statement;
	private $_types = '';
	private $_values = [];

	private function __construct(){
		$this->_conn = new mysqli($this->_dbHost, $this->_dbUser, $this->_dbPass, $this->_dbName);
	}

	public static function getInstance(){
		if(self::$_instance == null){
			self::$_instance = new Database();
		}

		return self::$_instance;
	}

	//Query, Bind, Execute
	public function query(String $sql){
		$this->_statement = $this->_conn->prepare($sql);
		if(!$this->_statement){
			echo "Query: " . $this->_conn->error;
		}
	}

	public function bind($value, $type){
		$this->_types .= $type;
		$this->_values[] = $value;
	}

	private function execute(){
		//bind params
		if(!empty($this->_values)){
			$this->_statement->bind_param($this->_types, ...$this->_values);
		}

		//reset params
		$this->_types = '';
		$this->_values = [];

		//execute
		return $this->_statement->execute();
	}

	//CRUD operations
	
	public function getResults(){
		$this->execute();
		$results = $this->_statement->get_result();
		
		$data = [];
		if($results->num_rows > 0){
			while($row = $results->fetch_object()){
				$data[] = $row;
			}
		}else{
			echo $this->_conn->error;
		}

		return $data;
	}

	public function insert(){
		//returns the insert ID on success, else error message on failure
		if($this->execute()){
			return $this->_statement->insert_id;
		}else{
			return $this->_conn->error;
		}

	}

 }