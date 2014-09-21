<?php
require_once 'core/init.php';
require_once 'classes/validation.php';



if(Input::exists()){
    if(Token::check(Input::get('token'))){
    $validate = new Validation();
    $validation = $validate->check($_POST,array(
        'username'=> array(
            'required' => TRUE,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password'=> array(
            'required'=> TRUE,
            'min' => 6
        ),
        'password_again' => array(
            'required' => TRUE,
            'matches' => 'password'
        ),
        'name' => array(
            'required' => TRUE,
            'min' => 2,
            'max' => 50,
        )
    ));
    if ($validate->passed()){
        echo 'passed';
    }  else {
        foreach ($validate->errors() as $error){
            echo $error, '<br>';
        }
       
        
    }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="username"> Username </label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'));?>" autocomplete="off">
    </div>
    <div class="field"> 
        <label for="password">Choose a password</label>
        <input type="password" name="password" id="password">
    
    </div>
    
    <div class="field">
        <label for="password_again" >Enter your password again</label>
        <input type="password" name="password_again" id="password_again">
    </div>
    <div class="field">
        <label for="name"> Name </label>
        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" >
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="registered">
</form>
    