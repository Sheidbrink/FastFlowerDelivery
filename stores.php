<?php
	require('header.php');
	require_once('model/db.php');
	require_once('model/store_obj.php');
	// Add Store
	if(isset($_POST['addStoreName']) && isset($_POST['addStoreState']) && isset($_POST['addStoreCity'])) {
		$s = new store(filter_var($_POST['addStoreName'], FILTER_SANITIZE_STRING), 
				filter_var($_POST['addStoreState'], FILTER_SANITIZE_STRING),
				filter_var($_POST['addStoreCity'], FILTER_SANITIZE_STRING));
		$id = dbAddStore($s);
		if($id) {
			echo "$s->name Added with id $id";
		}
		else {
			echo "$s->name Already Exists";
		}
	}
	// Display selected store
	if(isset($_GET['store'])) {
		$store_name = filter_var($_GET['store'], FILTER_SANITIZE_STRING);
		$get_store = dbGetStore($store_name);
		if(isset($get_store)) {
			echo "<h1>$get_store->name</h1>";
			foreach($get_store->orders as $order) {
				echo "<br />Order for: ";
				foreach($order->ordered_flowers as $flower) {
					echo "$flower, ";
				}
			}
		}
		else {
			echo "$store_name Does not exist";
		}
	}
	// Display All stores
	else {
		require('store_form.php');
		foreach(dbGetStores() as $store) {
			echo "<h1>$store->name</h1>";
			echo "Id: $store->id <br />";
			echo "Location: $store->city, $store->state";
		}
		
	}
	require('footer.php');
?>
