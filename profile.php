<?php

require_once 'core/init.php';

if(!$username = Input::get('user')){
    
    Redirect::to('index.php');
}  else {
    
    $surgeon = new Surgeon($username);
    if(!$surgeon->exists()){
        Redirect::to(404);
    }  else {
        $data = $surgeon->data();
        
        
    }
    
    
}
?>

<h3><?php echo escape($data->username);?></h3>
<p>Full name:<?php echo escape($data->name); ?></p>