<?php

class Model {
    protected $_conn;
    protected $_sql;
    
    public function __construct() {
        if(!$this->_conn) {
            $this->_conn = new PDO ("mysql:host=localhost;dbname=news", "root", "");
        }else{
           die('Can not connect to database');
        
        }
    }
    
    public function Add(){
        
    }
}