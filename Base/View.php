<?php

class View {
    protected $_module;
    
    public function __construct($module) {
        $this->_module = $module;
    }
    
    public function render($filename){
        require_once $this->_module . '/View/' . $filename;
    }
}


