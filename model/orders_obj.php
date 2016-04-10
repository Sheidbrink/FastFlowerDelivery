<?php
	class order {
		public $id = null;
		public $ordered_flowers = array();
		public $assigned_driver = '';
		public $completed = false;
		public $state = '';
		public $city = '';
		public $address = '';
		public $email = '';
		public $urgent = false;
		function __construct($f, $s, $c, $a, $e)
		{
			$this->ordered_flowers = $f;
			$this->state = $s;
			$this->city = $c;
			$this->address = $a;
			$this->email = $e;
		}
	}
?>
