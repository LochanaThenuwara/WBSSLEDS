
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
                <!-- Header Links-->
		<title>SriLanka Eye Donation Society</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                <link href="interface/css/bootstrap.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
                <link href="interface/css/styles.css" rel="stylesheet">
                
	</head>
	<body>
            <!-- Go to www.addthis.com/dashboard to customize your tool this cause to crash the headers-->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54145d6f1e826127"></script>

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            
            <section >
    <?php
    require_once 'core/init.php';
    //echo Config::get('mysql/host');
   /* //DB query TEST
    * $user =DB::getInstance()->get('users', array('username','=','billy '));
    if(!$user->count()){
        echo 'no user';
    }  else {
        
            echo $user->first()->username;
        
      
    *  
}
    $userUpdate = DB::getInstance()->update('users',4,array(
        
        'password' => 'newpassword',
        'name'     => 'Dale Steyn'
        
        
    ));*/
    if(Session::exists('index')){
        echo '<p>'.Session::flash('index').'</p>';
    }
    $surgeon = new Surgeon();
    if($surgeon->isLoggedIn()){
        ?>
    
                <p>Hello <a href="profile.php?user=<?php echo escape($surgeon->data()->username); ?>"><?php echo escape($surgeon->data()->username); ?> </a></p>
        <ul>
            <li><a href="logout.php">Log out</a></li>
            <li><a href="update.php">Update profile</a></li>
            <li><a href="changepassword.php">Change password</a></li>
        </ul>
        <?php
        
        if($surgeon->hasPermission('admin')){
            echo '<p>You are an administrator</p>';
        }
    }  else {
        echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</a>!</p>';
        
    }
    //echo $surgeon->data()->username;
  
    
   
    
    ?>
    <?php 
    include 'interface/header.inc';
    
    include 'interface/slider.php';
   include 'interface/footer.inc';
    ?>
            </section>
            
            
           

 
		
	</body>
</html>