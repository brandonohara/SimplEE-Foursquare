<?php

	class Simplee_helper {
	
		public function is_assoc($array){
			if(!is_array($array))
				return FALSE;
			return (bool)count(array_filter(array_keys($array), 'is_string'));
		}
		
		public function flatten($object){
			$arr = array();
			
			foreach(get_object_vars($object) as $key => $subobject){
				if(is_object($subobject)){
					$arr[$key][0] = $this->flatten($subobject);
				} else if(is_array($subobject) && !isset($subobject[0])){
					$arr[$key] = array();
					array_push($arr[$key], $subobject);
				} else {
					$arr[$key] = $subobject;
				}
			}
			
			return $arr;
		}
		
		public function p($object){
			echo "<pre>";
			print_r($object);
			echo "</pre>";
		}
	}