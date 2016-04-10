<?php
	require('header.php');
	require_once('model/db.php');
	// Add Store
	if(isset($_POST['addDriver']) && isset($_POST['driverState']) && isset($_POST['driverCity'])) {
		$d = new driver(filter_var($_POST['addDriver'], FILTER_SANITIZE_STRING), 
				filter_var($_POST['driverState'], FILTER_SANITIZE_STRING),
				filter_var($_POST['driverCity'], FILTER_SANITIZE_STRING));
		$id = dbAddDriver($d);
		echo "$d->name Added with id $id";
	}
	// Display selected store
	if(isset($_GET['driverID'])) {
		$driverID = filter_var($_GET['driverID'], FILTER_SANITIZE_STRING);
		$driver = dbGetDriver($driverID);
		if(isset($driver)) {
			echo "<h1>$driver->name</h1>";
			echo 'Deliveries: ';
			foreach($driver->deliveries as $id) {
				echo "<br /> $id";
			}
			echo "Location: $driver->city, $driver->state";
		}
		else {
			echo "$driverID not found";
		}
	}
	// Display All stores
	else {
		require('driver_form.php');
		foreach(dbGetDrivers() as $driver) {
			echo "<h1><a href=\"?driverID=$driver->id\">$driver->name</a></h1>";
			echo "id: $driver->id";
			echo '<br /> Deliveries: ';
			foreach($driver->deliveries as $id) {
				echo "<br /> $id";
			}
			echo "Location: $driver->city, $driver->state";
		}
		
	}
	require('footer.php');
?>
