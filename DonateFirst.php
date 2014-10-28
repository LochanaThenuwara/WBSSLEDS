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
            <p style="font-size: 20px ">Who can be an eye donor?</p>
Anyone. Cataracts, poor eye sight and age do not prohibit you from becoming a donor. Prospective donors should indicate their intention on donor cards and driver's licenses. Perhaps the most important single thing you can do is make your next of in aware of your wishes to make sure they are carried out.
                </p>
                <p><br><br>
                <p style="font-size: 20px"> Who can donate eyes?</p>
                Eye donors could be of any age group or sex.<br><br>
People who use spectacles-diabetics, patients with high blood pressure, asthma patients and those without communicable diseases can donate eyes.<br><br>
<p style="font-weight: bold">Persons with AIDS, Hepatitis B and C, Rabies, Septicaemia, Acute leukemia (Blood cancer), Tetanus, Cholera, and infectious diseases like Meningitis and Encephalitis cannot donate eyes.</p>
</p>
            </div>
        
        </body>
        </html>
