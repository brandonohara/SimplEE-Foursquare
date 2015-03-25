<?php
	class Foursquare_venue {
		function __construct($row){
			foreach($row as $key => $value)
				$this->$key = $value;
		}
	}