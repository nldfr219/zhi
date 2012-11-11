<?php
class SchoolList implements Iterator  {
		
	/*
	 * @access private
	 * @var object Table_School
	 */
    protected static $tSchool = null;
    
	/*
	 * @access private
	 * @var integer or false if empty
	 */
    private $position;
    
    /*
	 * @access private
	 * @var array
	 */
    protected static $array = array();  
    
    public static $totalCount;
	/*
     * Constructor for class
     * @access public
     */
    public function __construct() {
        $this->position = false;
        if (is_null(self::$tSchool)) self::$tSchool = new Table_Schools();
    }

    /*
     * set cursor in start position
     * @access public
     */
    function rewind() {
        reset(self::$array);
        $this->position = key(self::$array);
        if (is_null($this->position)) $this->position = false;
    }

    /*
     * get current element
     * @access public
     */
    function current() {
        return self::$array[$this->position];
    }
    
    /*
     * get current key
     * @access public
     */
    function key() {
        return $this->position;
    }

    /*
     * move cursor to next position
     * @access public
     */
   function next() {
        next(self::$array);
        $this->position = key(self::$array);
        if (is_null($this->position)) $this->position = false;
    }

    /*
     * check if element exists
     * @access public
     */
    function valid() {
        return $this->position !== false && isset(self::$array[$this->position]);
    }
    
 
  
    
	public static function get($id) {    	
    	if (!isset(self::$array[$id])) {
	    	$oSchool = new Table_Schools();
	    	return $oSchool->getSchool($id);
    	}
    	else {
    		return self::$array[$id];
    	}
    }
    
    public static function getnext($id) {
    	$next = $id +1 ;
    	$oSchool = new Table_Schools();
    	if($next> $oSchool->getlastid())
    	$next= $oSchool->getfirstid();
    	
    	if (!isset(self::$array[$next])) {
    		
    		while(!$oSchool->getSchool($next)){
    			$next++;
    			$result=$oSchool->getSchool($next);
    		}
    		return $result;
    	}
    	else {
    		return self::$array[$next];
    	}
    }
    
    public static function getcurrent($id) {

    	if (!isset(self::$array[$id])) {
    		$oSchool = new Table_Schools();
    		while(!$oSchool->getSchool($id)){
    			$id++;
    			$result=$oSchool->getSchool($id);
    		}
    		return $result;
    	}
    	else {
    		return self::$array[$id];
    	}
    }

    public static function getprevious($id) {
    	$next = $id - 1 ;
    	$oSchool = new Table_Schools();
    	if($next < $oSchool->getfirstid())
    		$next=  $oSchool->getlastid();
     
    	if (!isset(self::$array[$next])) {
 
    		while(!$oSchool->getSchool($next)){
    			$next--;
    			$result=$oSchool->getSchool($next);
    		}
    		return $result;
    	}
    	else {
    		return self::$array[$next];
    	}
    }
    
    
 
 	public static function load() {
 		if(!($objects = Obj_Cache::read('schools'))){ 				
	    	if (is_null(self::$tSchool)) self::$tSchool = new Table_Schools();
	    	$objects = self::$tSchool->getAllSchools();
	    	Obj_Cache::save('schools', $objects);	    	
 		} 
 		foreach ($objects as $o) {
	    	self::$array[$o['school_id']] = $o;
	    }	    
		
	    SchoolList::$totalCount = count(self::$array);
	    
    	return new self();
    }
}