<?php
	class driver {
		public $id = null;
		public $name = '';
		public $city = '';
		public $state = '';
		public $rating = '';
		public $deliveries = array();
		public $phone = '';
		function __construct($n, $s, $c, $p)
		{
			$this->name = $n;
			$this->state = $s;
			$this->city = $c;
			$this->phone = $p;
		}
	}
?>
