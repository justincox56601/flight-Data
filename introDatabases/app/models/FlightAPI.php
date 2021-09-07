<?php
/**
 * Fliights API model
 */

 require_once APP_ROOT . '/libraries/Curl.php';

class FlightAPI{
	private $_db;

	public function __construct(){
		$this->_db = Database::getInstance();
	}

	public function getJsonData(){
		return json_decode(file_get_contents(APP_ROOT . '/data.json'));
	}

	public function filterData(Array $data){
		$results = [];
		foreach($data as $loc){
			foreach($loc->data as $d){
				$temp = [
					'date' => 			date('Y-m-d'),
					'time' => 			date('H:i:00', strtotime('now - 5 hours')), //change GMT to local time
					'start' => 			$d->itineraries[0]->segments[0]->departure->iataCode,
					'dest' => 			$d->itineraries[0]->segments[0]->arrival->iataCode,
					'depAirline' => 	$d->itineraries[0]->segments[0]->carrierCode,
					'depFlightNo' => 	$d->itineraries[0]->segments[0]->number,
					'returnAirline' => 	$d->itineraries[1]->segments[0]->carrierCode,
					'returnFlightNo' => $d->itineraries[1]->segments[0]->number,
					'fare' =>			$d->price->total,
				];
	
				$results[] = $temp;
			}
			
		}
		
		return $results;
	}

	public function insertData(Array $data){
		$results = [];
		$this->_db->query('INSERT INTO flights VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL)');
		foreach($data as $d){
			foreach($d as $key=>$val){
				$this->_db->bind($val, 's');

			}
			$results[] = $this->_db->insert();
			
		}

		return $results;
	}

	public function getRawData(){
		$locations = ['JFK', 'DFW', 'BOS'];
		$results = [];
		$token = $this->getToken();

		$url = API_ROOT . API_FLIGHT_OFFER_ENDPOINT;
		$header = [];
		$header[] = 'Authorization: ' . $token->token_type . ' ' . $token->access_token;
		$header[] = 'Content-Type:application/json';

		foreach($locations as $l){
			$fields = http_build_query([
				'originLocationCode' => 'MSP',
				'destinationLocationCode' => $l,
				'departureDate' => '2021-11-16',
				'returnDate' => '2021-11-21',
				'adults' => '1',
				'nonStop' => 'true',
			]);
	
			$curl = new Curl();
			$data = $curl->get($url, $fields, $header);
			$results[$l] = json_decode($data);

			//memory management and safety
			unset($curl);
		}
		

		return $results;
		
	}

	private function getToken(){
		$url = API_ROOT . API_TOKEN_ENDPOINT;
		$fields = http_build_query([
			'grant_type' => 'client_credentials',
			'client_id' => API_CLIENT_ID,
			'client_secret' => API_CLIENT_SECRET,
		]);

		$header = ['Content-Type: application/x-www-form-urlencoded'];
		$curl = new Curl();
		$data = $curl->post($url, $fields, $header);

		
		//memory management and safety
		unset($curl);

		return json_decode($data);
	}
}