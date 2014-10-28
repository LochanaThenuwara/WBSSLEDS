<?php
require_once 'core/init.php';

$surgeon = new Surgeon();

if(!$surgeon->isLoggedIn()){
    
    Redirect::to('index.php');
    
}

if(Input::exists()){
    
    if (Token::check(Input::get('token'))){
        
        $validate = new Validation();
        $validation = $validate->check($_POST,array(
            
            'password_current' => array(
                'required' => TRUE,
                'min'=> 6
            ),
            'password_new' => array(
                'required' => TRUE,
                'min'=> 6
            ),
            'password_new_again' => array(
                'required' => TRUE,
                'min'=> 6,
                'matches'=> 'password_new'
            ),
            
        ));
        
        if($validation->passed()){
            
            if(Hash::make(Input::get('password_current'))!== $surgeon->data()->password){
                echo 'Your current password is wrong.';
            }  else {
                $surgeon->update(array(
                    'password' => Hash::make(Input::get('password_new'))
                ));
                
                Session::flash('index','Your password has been changed!');
                Redirect::to('index.php');
                
                
            }
            
            
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
        <label for="password_current"> Current password </label>
        <input type="password" name="password_current" id="password_current" >
    </div>
   
    <div class="field"> 
        <label for="password_new">New password</label>
        <input type="password" name="password_new" id="password_new">
    
    </div>
    
    <div class="field">
        <label for="password_new_again" >Enter your new password again</label>
        <input type="password" name="password_new_again" id="password_new_again" >
    </div>
    
    
   
    <input type="submit" value="change">
     <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    
</form>

