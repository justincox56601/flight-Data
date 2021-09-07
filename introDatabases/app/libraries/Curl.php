<?php
/**
 * The curl object is responsible for making API calls
 */

class Curl{
	private $_ch;
	private $_agent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

	public function __construct(){}

	private function init($url){
		$this->_ch = curl_init($url);
		curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->_ch, CURLOPT_USERAGENT, $this->_agent);
	}

	private function setheader(String $header){
		curl_setopt($this->_ch, CURLOPT_HEADER, $header);
	}

	public function post(String $url, String $fields, Array $header){
		$this->init($url);
		$header[] = 'Content-Length: ' . strlen($fields);
		//$this->setHeader($header);
		curl_setopt($this->_ch, CURLOPT_POST, true);
		curl_setopt($this->_ch,CURLOPT_HTTPHEADER, $header);
		curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $fields);

		$result = curl_exec($this->_ch);

		if(curl_errno($this->_ch)){
			$result = '{Curl Error: ' . curl_error($this->_ch) .'}';
		}

		//clean up
		curl_close($this->_ch);
		$this->_ch = NULL;

		return $result;
	}

	public function get(String $url, String $fields, Array $header){
		$this->init($url . '?' . $fields);
		
		curl_setopt($this->_ch,CURLOPT_HTTPHEADER, $header);
		
		$result = curl_exec($this->_ch);

		if(curl_errno($this->_ch)){
			$result = '{Curl Error: ' . curl_error($this->_ch) .'}';
		}

		//clean up
		curl_close($this->_ch);
		$this->_ch = NULL;

		return $result;
	}
	
}