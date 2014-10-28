<?php

require_once 'core/init.php';
$surgeon = new Surgeon();

if(!$surgeon->isLoggedIn()){
    
    Redirect::to('index.php');
    
    
}

if(Input::exists()){
    
    if(Token::check(Input::get('token'))){
        
        $validate = new Validation();
        $validation = $validate->check($_POST,array(
            
            'name'=> array(
                'required' => TRUE,
                'min'=> 2,
                'max'=> 50
            )
        ));
        
        if($validate->passed()){
            try {
                
                $surgeon->update(array(
                    'name' => Input::get('name')
                ));
                
                Session::flash('index','Your details have been updated.');
                Redirect::to('index.php');
                
            } catch (Exception $e) {
                
                die($e->getMessage()); 
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
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo escape($surgeon->data()->name); ?>">
        
        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </div>
</form>
