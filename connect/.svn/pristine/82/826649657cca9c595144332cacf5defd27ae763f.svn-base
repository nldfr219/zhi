<?php
class Table_Popularity extends Zend_Db_Table {
	protected $_name = "popularity";
	protected $_primary= array("object_type","class_year","school_id","object_id");
	
	public function  createPopularity($objecttype, $schoolid , $class, $myschool)
	{
		
 
		$where['object_type = ?'] = $objecttype;
		$where['object_id = ?']  = $schoolid;
		$where['class_year = ?']  = $class;
		//$where['school_id = ?']  = $myschool;
		$result = $this->update(array('num' => new Zend_Db_Expr('num + 1')),$where);

		if($result==0){
			$this->insert(array('object_type' => $objecttype, 'object_id' => $schoolid, 'class_year' => $class,'school_id' => $myschool ));
			return true;
		}
		
	}
	
 
		
  	public function getPopularity($objecttype, $object_id , $class, $myschool){
		 
		$select = " SELECT `num`
					FROM  `popularity` 
					WHERE  `object_type` =$objecttype
					AND  `object_id` =$object_id
				 	AND  `class_year` =$class
					AND  `school_id` =$myschool ";
  		$result = $this->_db->query($select);
  		if(isset($result))
  			$row = $result->fetch();
  		if( $row["num"] > 0)
  			return $row["num"];	
		else return 0;
	}  
}