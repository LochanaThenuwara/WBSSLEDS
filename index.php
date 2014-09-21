
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
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            
            <section >
    <?php
    require_once 'core/init.php';
    
    $user = DB::getInstance()->update('users',2,array(
        'username'=> 'Dale Barrel',
        'password'=> 'pwd'
           
    ));
   
    include 'interface/header.inc';
    
    ?>
    <?php 
    
    include 'interface/slider.php';
   include 'interface/footer.inc';
    ?>
            </section>
            
            
           
<!-- Go to www.addthis.com/dashboard to customize your tools
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54145d6f1e826127"></script>

 -->
		
	</body>
</html>