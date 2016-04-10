<?php
require('store_obj.php');
require('orders_obj.php');
require('vendor/autoload.php');
$mongo = new MongoDB\Client('mongodb://localhost:27017');
$db = $mongo->fastFlower;
$storeDB = $db->stores;
$driverDB = $db->drivers;

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
?>
