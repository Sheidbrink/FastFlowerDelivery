<?php
	class driver {
		public $id = null;
		public $name = '';
		public $city = '';
		public $state = '';
		public $rating = '';
		public $deliveries = array();
		function __construct($n, $s, $c)
		{
			$this->name = $n;
			$this->state = $s;
			$this->city = $c;
		}
	}
?>
