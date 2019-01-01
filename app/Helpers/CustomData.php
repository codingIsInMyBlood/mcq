<?php

namespace App\Helpers;

class CustomData{

    private $datas = [];

    // add or update
    public function set($name, $value){
    	$this->datas[$name] = $value;
    }

    // erase
    public function remove($name){
    	if(isset($this->datas[$name]))
    		unset($this->datas[$name]);
    }

    // getValue
    public function get($name){
    	if(isset($this->datas[$name]))
    		return $this->datas[$name];
    	return null;
    }

}