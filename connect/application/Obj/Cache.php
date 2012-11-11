<?php
class Obj_Cache {
	private static $instance;
	
	private $memcacheWrite;
	private $memcacheRead;
	
	public function __construct() {
		$this->memcacheWrite = array();
		$arSettings = Zend_Registry::get('memcached-settings');
		foreach ($arSettings['hosts'] as $k => $v) {
			$this->memcacheWrite[$k] = new Memcache;
			$this->memcacheWrite[$k]->connect($v, $arSettings['port']);
		}
		$this->memcacheRead = new Memcache;
		$this->memcacheRead->connect($arSettings['host'], $arSettings['port']);
	}
	
	public static function getInstance() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
	}
	
	public static function __callstatic($name, $arguments) {
		return call_user_func_array(array(self::getInstance(), '_'.$name), $arguments);
	}
	
	public function __call($name, $arguments) {
		return call_user_func_array(array($this, '_'.$name), $arguments);
	}
	
	public function _save($key, $val, $time = 3600) {
		$res = true;
		foreach ($this->memcacheWrite as $m) {
			$res = $res & $m->set($key, $val, 0, 100000);
		}
		return $res;
	}
	
	public function _clear($key) {
		foreach ($this->memcacheWrite as $m) {
			$m->delete($key);
		}
	}
	
	public function _flush() {
		foreach ($this->memcacheWrite as $m) {
			$m->flush();
		}
	}
	
	public function _read($key){
		return $this->memcacheRead->get($key);
	}
	
	public function _stat(){
		return $this->memcacheRead->getStats();
	}
}