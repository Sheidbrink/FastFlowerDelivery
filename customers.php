<?php
	require('header.php');
	require_once('model/db.php');
	require_once('model/store_obj.php');
	// Add Store
	if(isset($_POST['addOrder']) && 
		isset($_POST['orderState']) && 
		isset($_POST['orderCity']) && 
		isset($_POST['orderAddress'])) {
		$o = new order(explode(',',filter_var($_POST['addOrder'], FILTER_SANITIZE_STRING)), 
				filter_var($_POST['orderState'], FILTER_SANITIZE_STRING),
				filter_var($_POST['orderCity'], FILTER_SANITIZE_STRING),
				filter_var($_POST['orderAddress'], FILTER_SANITIZE_STRING));
		if($_POST['urgent'] == 'true') {
			$o->urgent = TRUE;
		}
		$id = dbAddOrder($o);
		echo implode($o->ordered_flowers) . "Order Placed: $id";
		// TODO email confimation
		// TODO assign driver
		// TODO text driver
	}
	// Display order status
	if(isset($_GET['orderID'])) {
		$orderID = filter_var($_GET['orderID'], FILTER_SANITIZE_STRING);
		$order = dbGetOrder($orderID);
		if(isset($order)) {
			echo "<h1>$order->id</h1>";
			echo "Flowers: ";
			foreach($order->ordered_flowers as $flower) {
				echo "$flower, ";
			}
			echo "<br /> Delivery Completed: ";
			if($order->completed) {
				echo " $order->completed";
				echo "<br /> Delivered By: $order->assigned_driver";
			}
			else {
				echo ' False';
				echo "<br /> Will Be Delivered By: $order->assigned_driver";
				if(!$order->assigned_driver) {
					echo 'Waiting for Driver pickup.';
				}
				echo '<br /> Urgent Status: ';
				if($order->urgent) {
					echo 'True';
				} 
				else {
					echo 'False';
				}
			}
			echo "<br /> To: $order->address, $order->city, $order->state";
		}
		else {
			echo "$orderID not found";
		}
	}
	// Display All Orders
	else {
		require('order_form.php');
		foreach(dbGetOrders() as $order) {
			echo "<h1>$order->id</h1>";
			echo "Flowers: ";
			foreach($order->ordered_flowers as $flower) {
				echo "$flower, ";
			}
		}
	}
	require('footer.php');
?>
