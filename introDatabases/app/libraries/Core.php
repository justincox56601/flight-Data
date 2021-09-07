<?php
/**
 * Core class gets the ball rolling
 * 
 */

class Core{
	protected $_currentController = 'FlightApis';
	protected $_currentMethod = 'index';
	protected $_params = [];

	public function __construct(){
		require_once APP_ROOT . '/controllers/' . $this->_currentController . '.php';
		$this->_currentController = new $this->_currentController;

		call_user_func_array([$this->_currentController, $this->_currentMethod], $this->_params);
	}
}

