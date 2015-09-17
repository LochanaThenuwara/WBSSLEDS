<html lang="en">
    <?php $page = basename($_SERVER['SCRIPT_NAME']); ?>

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
        <link href="interface/css/DRegs.css" rel="stylesheet">

    </head>
    <body class="body">
        <div>
            <?php
            include 'interface/header.inc';
            //include 'interface/footer.inc';
            ?>
        </div>
        <div id="vertical">
            
        <ul class="nav nav-pills nav-stacked">
  <li><a href="DonateFirst.php" <?php if ($page == 'DonateFirst.php') { ?>class="active"<?php } ?>>Who Can Donate</a></li>
  <li><a href="HowtoRegister.php" <?php if ($page == 'HowtoRegister.php') { ?>class="active"<?php } ?>>How to Register</a></li>
  <li><a href="DonorRegistration.php">Eye/Tissue Donation</a></li>
  <li><a href="FinancialDonations.php">Financial Donations</a></li>
  <li><a href="Updateprofile.php">Update Information</a></li>
  <li><a href="#">FAQ</a></li>
</ul>
            </div>
        <div id="WhoCanDonate">
            <p>
            <p style="font-size: 20px ">Online Registration</p>

            <p> Click on <a href="DonorRegistration.php " style="color: #269abc;">  this</a> to register with us. Registering process will take approximately 60 seconds. </p>
                <p><br><br>
                <p style="font-size: 20px"> Manual Registration</p>
                <p>If you would like to register with us in person please visit our office at Vidya Mawatha.</p>


            </div>
        
        </body>
        </html>
