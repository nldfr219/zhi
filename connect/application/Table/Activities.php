<?php
class Table_Activities extends Zend_Db_Table {
	protected $_name = "activities";
	protected $_primary = "activity_id";
	
	public function  createActivity($creatorid, $type, $receiverid, $schoolid , $object1=null)
	{
		$this->insert(array('creator_id' => $creatorid, 'type' => $type, 'receiver_id'=> $receiverid,'object1'=> $object1, 'school_id' => $schoolid));
	}
	
	public function getActivity($creatorid, $type, $receiverid, $schoolid){
		$select = $this->select()->from($this);
		if($creatorid != NULL)
		$select->where("creator_id=?", $creatorid);
		if($type != NULL)
		$select->where("type=?",$type);
		if($receiverid != NULL)
		$select->where("receive_id?=",$receiverid);
		if($schoolid != NULL)
		$select->where("school_id",$schoolid);
		$select->order("activity_date DESC");
		$select->setIntegrityCheck(false);
		return $this->fetchAll($select);	
		
	}
}