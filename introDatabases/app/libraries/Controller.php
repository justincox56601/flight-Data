<?php
/**
 * This is the controller base class.  All controllers inherit from this
 */

class Controller{
	public function model(String $model){
		//check if model exists
		if(file_exists(APP_ROOT . '/models/' . $model . '.php')){
			//require the model
			require_once APP_ROOT . '/models/' . $model . '.php';

			//instantiate the model
			return new $model();
		}else{
			die('Model does not exist');
		}

	}

	public function view(String $view, Array $data=[]){
		//check if view exists
		if(file_exists(APP_ROOT . '/views/' . $view . '.php')){
			//require the model
			require_once APP_ROOT . '/views/' . $view . '.php';

		}else{
			die('View does not exist');
		}
	}

}