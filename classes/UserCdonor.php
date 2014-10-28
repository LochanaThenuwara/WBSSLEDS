<?php

class UserCdonor{
    private $_db;
     public function __construct() {
         $this->_db = DB::getInstance();
     }
     
     public function create($fields = array()){
         if(!$this->_db->insert('cash_donation',$fields)){
             throw new Exception('There was a problem');
         }
     }
}
?>

