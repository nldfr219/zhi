<?php
class Popularity {
	
	protected $tPopularity;
	
	function __construct() {
		$this->tPopularity = new Table_Popularity();
	}
	
 
	public static function getPopularity($objecttype, $object_id, $class, $myschool){
		
			$tPopularity = new Table_Popularity();
			$Popularity = $tPopularity->getPopularity($objecttype, $object_id, $class, $myschool);

			return $Popularity;
	}
	
}