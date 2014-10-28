<?php

class User{
    private $_db,
             $_data,
             $_sessionName,
             $_isLoggedin;
    
     public function __construct($user = null) {
         $this->_db = DB::getInstance();
         $this->_sessionName = Config::get('session/session_name');
         if(!$user){
             if(Session::exists($this->_sessionName)){
                 $user = Session::get($this->_sessionName);
                  //print($user);
                  //print($this->find($user));
                 if($this->find($user)){
                     $this->_isLoggedin = true;
                    
                 }else{
                     
                 }
             }
         }
     }
     
     public function create($fields=array()){
         if(!$this->_db->insert('donors',$fields)){
             throw new Exception('There was a problem');
         }
     }
     
     public function find($user = null){
          
         if($user){
             $field = 'd_id';
             $data = $this->_db->get('donors',array($field,'=',$user));
             if($data->count()){
                 $this->_data = $data-> first();
                 return true;
             }
         }
     }
     
     public function login($firstname=null,$lastname=null,$nic=null){
         
         $user = $this->find($nic);
         if($user){
             if(($this->data()-> d_firstname===$firstname) &&($this->data()->d_lastname===$lastname) && $this->data()->d_id===$nic){
                 Session::put($this->_sessionName,  $this->data()->d_id);
                 return true;
             }
         }
        
         return false;
             
         
     }
     
     public function data(){
         return $this->_data;
     }
     public function isLoggedIn(){
         return $this->_isLoggedin;
     }
     public function logout(){
         Session::delete($this->_sessionName);
     }
     public function update($fields = array(),$id=null){
         
         if(!$id && $this->isLoggedIn()){
             $id = $this->data()->d_id;
            
         }
         
         if(!$this->_db->update('donors',$id,$fields)){
             throw new Exception('Error');
         }
     }
}
?>
