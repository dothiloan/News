<?php

class Controller {
    protected $_view;
    public function __construct($module) {
        $this->_view = new View($module);
    }
    
}

