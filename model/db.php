<?php
require('store_obj.php');
require('orders_obj.php');
require('vendor/autoload.php');
$mongo = new MongoDB\Client('mongodb://localhost:27017');
$db = $mongo->fastFlower;
$storeDB = $db->stores;
$driverDB = $db->drivers;
$orderDB = $db->orders;

function dbAddStore($store) {
	global $storeDB;
	if($storeDB->findOne(array('name' => $store->name)) == NULL)
	{
		$result = $storeDB->insertOne($store);
		return $result->getInsertedID();
	}
	return False;
}

function dbGetStore($name) {
	global $storeDB;
	
	$query = array('name' => $name);
	$store = $storeDB->findOne($query);
	if(isset($store)) {
		return resultToStore($store);
	}
	return null;
}

function dbGetStores() {
	global $storeDB;
	$toReturn = array();
	$result = $storeDB->find();
	foreach($result as $store) {
		array_push($toReturn, resultToStore($store));
	}
	return $toReturn;
}

function resultToStore($result) {
	$toReturn = new store($result['name'], $result['state'], $result['city']);
	$toReturn->id = $result['_id'];
	$toReturn->orders = $result['orders'];
	$toReturn->drivers = $result['drivers'];
	return $toReturn;
}

function dbAddOrder($order) {
	global $orderDB;
	$result = $orderDB->insertOne($order);
	return $result->getInsertedID();
}

function dbGetOrder($id) {
	global $orderDB;
	$query = array('_id' => new MongoDB\BSON\ObjectId($id));
	$order = $orderDB->findOne($query);
	if(isset($order)) {
		return resultToOrder($order);
	}
	return null;
}

function dbGetOrders() {
	global $orderDB;
	$toReturn = array();
	$result = $orderDB->find();
	foreach($result as $order) {
		array_push($toReturn, resultToOrder($order));
	}
	return $toReturn;
}

function resultToOrder($result) {
	$toReturn = new order($result['ordered_flowers'], $result['state'], $result['city'], $result['address']);
	$toReturn->id = $result['_id'];
	$toReturn->assigned_driver = $result['assigned_driver'];
	$toReturn->urgent = $result['urgent'];
	$toReturn->completed = $result['completed'];
	return $toReturn;
}
	

?>
