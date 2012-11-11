<?php
class Activity {
	
	protected $tActivity;
	
	function __construct() {
		$this->tActivity = new Table_Activities();
	}
	
	static function getActivity($creatorid, $type, $receiverid, $schoolid) {
		if(!($objects = Obj_Cache::read('activity_'.$creatorid."_".$type."_".$receiverid."_".$schoolid))){
			$tActivity = new Table_Activities();
		    $activity= $tActivity->getActivity( $creatorid, $type, $receiverid, $schoolid );	
			Obj_Cache::save('activity_'.$creatorid."_".$type."_".$receiverid."_".$schoolid, $activity);
			return $activity;
		}
		return $objects;
		
		 
	}	
	

}