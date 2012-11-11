<?php
class Table_Schools extends Zend_Db_Table {
	protected $_name = "schools";
	protected $_primary = "school_id";
	
	public function getAllSchools()
	{
		$select = $this->select()->from($this);		
		return $this->fetchAll()->toArray();
	}
	public function getSchool($id)
	{
		$select = $this->select()->from($this)->where("school_id=?", $id)->setIntegrityCheck(false);
		 
		//var_dump($this->fetchRow($select));
		if(($this->fetchRow($select)))
			return $this->fetchRow($select)->toArray();
		else
			return false;
	}
	
	public function getSchoolByState($id)
	{
		$select = $this->select()->from($this)->where("state_id=?", $id)->order("name")->setIntegrityCheck(false);
 
		if(($this->fetchAll($select)))
		return $this->fetchAll($select)->toArray();
		else
		return false;
	}
	
	
	public function getfirstid()
	{
		$select = $this->select()->from($this)->order("school_id")->limit(1)->setIntegrityCheck(false);
			
		
		//var_dump($this->fetchRow($select)); 
		//$select="select school_id from schools order by school_id limit 1";
		if($this->fetchRow($select))
			return $this->fetchRow($select)->school_id;
		else
			return false;
	}
	public function getlastid()
	{
		//$select = $this->select()->from($this)->order("school_id DESC")->limit(1)->setIntegrityCheck(false);
		$select = $this->select()->from($this, array(new Zend_Db_Expr("MAX(school_id) AS maxID")));
		if($this->fetchRow($select))
		return $this->fetchRow($select)->maxID;
	
/* 		//var_dump($this->fetchRow($select));
		//$select="select school_id from schools order by school_id limit 1";
		if($this->fetchRow($select))
		return $this->fetchRow($select)->school_id; */
		else
		return false;
	}	
	public function getSchoolName($id)
	{
		$name=$this->getSchool($id);
		return $name["name"];
	}
	
}