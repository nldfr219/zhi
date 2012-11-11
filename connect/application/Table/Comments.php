<?php
class Table_Comments extends Zend_Db_Table {
	protected $_name = "comments";
	protected $_primary = "c_id";
	
	public function  createComment($schoolid , $comment)
	{
		$this->insert(array('school_id' => $schoolid, 'content' => $comment));
		$select = $this->select(mysql_insert_id())->from($this);
		$select->setIntegrityCheck(false);
		return $this->_db->lastInsertId("comments","c_id");
		
	}
	
 
		
	public function getComment($c_id){
		$select = $this->select()->from($this)->where('c_id=?',$c_id)->setIntegrityCheck(false);
		$temp=$this->fetchRow($select);
		
		return $temp['content'];	
		
	}
}