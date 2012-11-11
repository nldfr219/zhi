<?php
class Comment {
	
	protected $tComment;
	
	function __construct() {
		$this->tComment = new Table_Comments();
	}
	
 
	public static function getComment($c_id){
		
		if(!($objects = Obj_Cache::read('comment_'.$c_id))){
			$tComment = new Table_Comments();
			$comments = $tComment->getComment($c_id);
			Obj_Cache::save('comment_'.$c_id, $comments);
			return $comments;
		}
		return $objects;
		
			
		
	}
	
}