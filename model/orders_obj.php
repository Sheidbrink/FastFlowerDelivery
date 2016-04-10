<?php
	class order {
		public $id = null;
		public $ordered_flowers = array();
		public $assigned_driver = '';
		public $completed = false;
		public $state = '';
		public $city = '';
		public $address = '';
		public $urgent = false;
		function __construct($f, $s, $c, $a)
		{
			$this->ordered_flowers = $f;
			$this->state = $s;
			$this->city = $c;
			$this->address = $a;
		}
	}
?>
