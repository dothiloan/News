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
    
    public function AddFromCondition($table,array $arrayCondition)
    {
        
        $arrColumns = "(";
        $arrayParams = "(";
        foreach ($arrayCondition as $key => $value) {
            $arrColumns .="`{$key}`" . ', ';
            $arrayParams .=":{$key}" . ', ';
        }

        
        $itemLast = strlen($arrayParams) - 2;
        $arrayParams[$itemLast] = " ";
        $arrayParams .= ")";

        $itemLast1 = strlen($arrColumns) - 2;
        $arrColumns[$itemLast1] = " ";
        $arrColumns .= ")";
            

      $this->_sql = "INSERT INTO " . "`{$table}`" . $arrColumns ." VALUES " . $arrayParams ."";

        $pre = $this->_conn->prepare($this->_sql);
        foreach ($arrayCondition as $key => $value) {
           
          
            if(is_string($value) == true)
            {
                $pre->bindParam(":{$key}", $arrayCondition[$key], PDO::PARAM_STR);
            
                
            }else if(is_bool($value) == true)
            {
                $pre->bindParam(":{$key}", $arrayCondition[$key], PDO::PARAM_BOOLEAN);
            }
        }

        if($pre->execute())
        {
            return true;
        }else{
            return false;
        }
    }
    
    public function getAllData($table){
        $this->_sql = "SELECT * FROM {$table}";
        $pre = $this->_conn->prepare($this->_sql);
        $pre->execute();
        while($row = $pre->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }
    
    public function getOneData($table, $id){
        $this->_sql = "SELECT * FROM {$table} WHERE `id` = :id";
        $pre = $this->_conn->prepare($this->_sql);
        $pre->bindParam(":id", $id, PDO::PARAM_INT);
        while($row = $pre->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        if($pre->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteFromId($table, $id){
        $this->_sql = "DELETE FROM {$table} WHERE `id` = :id";
        $pre = $this->_conn->prepare($this->_sql);
        $pre->bindParam(":id", $id, PDO::PARAM_INT);
        if($pre->execute()){
            return true;
        }else{
            return false;
        }
    }
    
     public function editDataFromId($table ,$id , array $condition)
    {
        $txt = '';
        foreach($condition as $key => $value)
        {
            $txt .= "`{$key}`" . '=' . "'$value'" . ',';
        }

        $numberTxt = strlen($txt);
        $txt[$numberTxt - 1] = ' ';

        $this->_sql = "UPDATE `{$table}` SET $txt WHERE `id` = :id ";
        $pre = $this->_conn->prepare($this->_sql);
        $pre->bindParam(":id", $id, PDO::PARAM_INT);
        if($pre->execute())
        {
            return true;
        }else{
            return false;
        }
    }

}