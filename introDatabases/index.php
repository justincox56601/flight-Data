<?php
/**
 * this is the main view for the Intro to Databases Web Scraper
 * we wont be using a full MVC framework but close
 */

//require files
require_once 'app/require.php';


/*
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Intro To Databases</title>
</head>
<body>
	<h1>Intro To Databases</h1>
	<h2>Airfare web scraper</h2>
	
	<pre>
		<?php
		$json = json_decode(file_get_contents('data.json'));

	echo "MSP TO JFK on 11-11-2021<br>";

	$filtered = [];
	foreach($json->data as $d){
		$temp = [
			'start' => $d->itineraries[0]->segments[0]->departure->iataCode,
			'dest' => $d->itineraries[0]->segments[0]->arrival->iataCode,
			'depAir' => $d->itineraries[0]->segments[0]->carrierCode,
			'depFlight' => $d->itineraries[0]->segments[0]->number,
			'retAir' => $d->itineraries[1]->segments[0]->carrierCode,
			'retFlight' => $d->itineraries[1]->segments[0]->number,
			'fare' => $d->price->total,
		];

		$filtered[] = $temp;
	}
	//print_r($filtered);

	?>
	</pre>

	<?php foreach($filtered as $f):?>
		<div style="display:grid; grid-auto-flow: column; gap:1rem; justify-content:start;">
			<span>Date<br><input type="date" name="date" id="date" value="<?php echo date('Y-m-d')?>" disabled></span>
			<span>Time<br><input type="time" name="time" id="time" value="<?php echo date('H:i:00', strtotime('now - 5 hours'))?>" disabled></span>

			<?php foreach($f as $key=>$val): ?>
				<span><?php echo $key?><br><input type="text" name="dest-<?php echo $key . '-' . $val?>" id="<?php echo $key . '-' . $val?>" value="<?php echo $val?>" disabled></span>
			<?php endforeach;?>
			
			
		</div>

	<?php endforeach;?>
	

<script src="script.js"></script>	 
</body>
</html>*/