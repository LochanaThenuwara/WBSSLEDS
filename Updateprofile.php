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
        <link href="interface/css/DRegs.css" rel="stylesheet">

    </head>
    <body class="body">
        <div>
            <?php
            include 'interface/header.inc';
            //include 'interface/footer.inc';

            require_once 'core/init.php';
            $firstname='';
            $lastname = '';
            $errFirstname='';
            $errLastname='';
            $errnic='';

            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
                        'firstname' => array('required' => true),
                        'nic' => array('required' => true),
                        'lastname' => array('required'=> true)
                    ));
                    if ($validation->passed()) {
                        $user = new user();
                        $login = $user->login(Input::get('firstname'),Input::get('lastname'), Input::get('nic'));
                        if ($login) {
                         //  print_r($user->data());
                            
                       
                            
                         Header('Location: Updatedo.php');
                            
                        } else {
                            echo '<script type="text/javascript">alert(" Information you entered is incorrect ");</script>';
                        }
                    } else {
                          $ar[0] = $validation->errors();

                        foreach ($ar as $error => $error_vals) {
                            for ($x = 0; $x < sizeof($error_vals); $x++) {
                                $a = $ar[0][$x];
                                $arr = explode(' ', trim($a));
                                if ($arr[0] == 'firstname') {
                                    $errFirstname = str_replace('firstname', 'First Name', implode(" ", $arr));
                                   
                                } else if ($arr[0] == 'lastname') {
                                    $errLastname = str_replace('lastname', 'Last Name', implode(" ", $arr));
                                } else if ($arr[0] == 'nic') {
                                    $errnic = str_replace('nic', 'Identity Card Number', implode(" ", $arr));
                                }
                            }
                        }
                        $firstname=  Input::get('firstname');
                        $lastname = Input::get('lastname');
                       
                    }
                }else{
                    
                }
            }
            ?>

        </div>

        <div id="form" style="margin-top: 100px;">
            <div >
                <h2 id="Dtitle">UPDATE PROFILE</h2>
            </div>
            <form method="post">
                <table style="margin-left: 50px">
                    <tr>
                        <td id="lab">
                            <label for="firstname">First Name:</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="firstname" id="firstname"  value="<?php echo $firstname ?>"/>
                        </td>
                           <td id="error">
                            <label> <?php echo $errFirstname ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="lastname">Last Name :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="lastname" id="lastname"  value="<?php echo $lastname ?>"/>
                        </td>
                         <td id="error">
                            <label> <?php echo $errLastname ?></label>
                        </td>
                    </tr>

                    <tr>
                        <td id="lab">
                            <label for="nic">NIC :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="nic" id="nic"  value=""/>
                        </td>
                         <td id="error">
                            <label> <?php echo $errnic ?></label>
                        </td>
                    </tr>



                </table>
               <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
                <input id="submit" type="submit" value="Sign in"/>
            </form>
        </div>



    </body>

</html>