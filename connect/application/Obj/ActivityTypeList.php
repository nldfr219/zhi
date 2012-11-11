<?php
class ActivityTypeList implements Iterator  {
		
	/*
	 * @access private
	 * @var object Table_School
	 */
    protected static $tType = null;
    
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
    
	/*
     * Constructor for class
     * @access public
     */
    public function __construct() {
        $this->position = false;
        if (is_null(self::$tType)) self::$tType = new Table_ActivityTypes();
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
    		$tType = new Table_ActivityTypes();
    		return $tType->getActivityType($id);
    	}
    	else {
    		return self::$array[$id];
    	}
    }
 	public static function load() {
    	if (is_null(self::$tType)) self::$tType = new Table_ActivityTypes();
    	$objects = self::$tType->getAllSchools();    
    	foreach ($objects as $o) {
    		self::$array[$o['type_id']] = $o;
    	}
    	return new self();
    }
}