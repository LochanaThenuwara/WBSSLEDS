<?php

require_once 'core/init.php';
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validation();
        $validation = $validate->check(array(
           'username' => array('required' => TRUE) ,
            'password'=> array('required' => TRUE)
        ));
        
        if($validation->passed()){
            header('Location:index.php');
            
        }  else {
            foreach ($validation->errors() as $error){
                echo $error,'<br>';
            }
                
        }
    }
}

?>
<form action="" method="post">
    
    <div class="field">
        <label for="username" >Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
    </div>
    
    <div class="field">
        
        <label for="password">Password</label>
        <input type="text" name="password" id="password" autocomplete="off">
             
    </div>
    
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input type="submit" value="login">
</form> 