<?php

class User{
    private $_db,
            $_data,
            $_sessionName;


    public function __construct($user = NULL) {
         $this->_db = DB::getInstance();
         $this->_sessionName = Config::get('session/session_name');
     }
     
     public function create($fields = array()){
         if(!$this->_db->insert('users',$fields)){
             throw new Exception('There was a problem');
         }
     }
     public function find($user = NULL){
         if ($user){
             $field = (is_numeric($user)) ? 'id' : 'username';
             $data = $this->_db->get('users',array($field,'=',$user));
             
             if($data->count()){
                 $this->_data = $data->first();
                 return TRUE;
                 
             }
         }
         return FALSE;
     }
     
     public function login($username = NULL ,$password = NULL){
         $user = $this->find($username);
         
         
         if($user){
             if($this->data()->password === Hash::make($password, $this->data()->salt)){
                 Session::put($this->_sessionName,  $this->data()->id);
                 return TRUE;
                 
             }
         }
         return FALSE;
     }
     
     private function data(){
         return $this->_data;
     }
}