<?php
	class store
	{
		public $id = '';
		public $name = '';
		public $state = '';
		public $city = '';
		public $orders = array();
		public $drivers = array();
		function __construct($n, $s, $c)
		{
			$this->name = $n;
			$this->state = $s;
			$this->city = $c;
		}
	}
?>
