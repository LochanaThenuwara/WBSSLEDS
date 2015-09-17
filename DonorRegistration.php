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
            $firstname = '';
            $middlename = '';
            $lastname = '';
            $nic = '';
            $address = '';
            $addressline2 = '';
            $addressline3 = '';
            $dob = '';
            $sex = '';
            $tNo = '';
            $email = '';
            $nationality = '';
            $religion = '';
            $district = '';
            $electorate = '';
            $wname1 = '';
            $wadd1 = '';
            $waddressline2 = '';
            $waddressline3 = '';
            $wrelation1 = '';
            $wnic1 = '';
            $wtno1 = '';
            $wemail1 = '';
            $wname2 = '';
            $wadd2 = '';
            $wwaddressline2 = '';
            $wwaddressline3 = '';
            $wrelation2 = '';
            $wnic2 = '';
            $wtno2 = '';
            $wemail2 = '';
            $errFirstname = '';
            $errLastname = '';
            $errnic = '';
            $erraddress = '';
            $errdob = '';
            $errtNo = '';
            $errwname1 = '';
            $errwname2 = '';
            $erremail = '';
            if (Input::exists()) {

                if (Token::check(Input::get('token'))) {

                    $validate = new Validate();

                    $validation = $validate->check($_POST, array(
                        'firstname' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 20,
                        ),
                        'lastname' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 20,
                        ),
                        'address' => array(
                            'required' => true,
                            'min' => 2,
                        ),
                        'dob' => array(
                            'required' => true,
                        ),
                        'd_id' => array(
                            'required' => true,
                            'unique'=> true,
                            'checkno' => true,
                            'min' => 10,
                            'max' => 10,
                        ),
                        'tNo' => array(
                            'required' => true,
                            'min' => 10,
                        ),
                        'wname1' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 20,
                        ),
                        'wname2' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 20,
                        ),
                        'email' => array(
                            'check' => true,
                        )
                    ));
                    if ($validation->passed()) {
                        if (Input::get('agreement')) {
                            $user = new User();


                            try {
                                $user->create(array(
                                    'd_id' => Input::get('d_id'),
                                    'd_firstname' => Input::get('firstname'),
                                    'd_middlename' => Input::get('middlename'),
                                    'd_lastname' => Input::get('lastname'),
                                    'd_address_l1' => Input::get('address'),
                                    'd_address_l2' => Input::get('addressline2'),
                                    'd_address_l3' => Input::get('addressline3'),
                                    'd_gender' => Input::get('sex'),
                                    'dob' => Input::get('dob'),
                                    'd_tel' => Input::get('tNo'),
                                    'd_email' => Input::get('email'),
                                    'd_nationality' => Input::get('nationality'),
                                    'd_religion' => Input::get('religion'),
                                    'd_district' => Input::get('district'),
                                    'd_electorate' => Input::get('electorate'),
                                    'w1_name' => Input::get('wname1'),
                                    'w1_address_l1' => Input::get('wadd1'),
                                    'w1_address_l2' => Input::get('waddressline2'),
                                    'w1_address_l3' => Input::get('waddressline3'),
                                    'w1_relationship' => Input::get('wrelation1'),
                                    'w1_nic' => Input::get('wnic1'),
                                    'w1_tel' => Input::get('wtno1'),
                                    'w1_email' => Input::get('wemail1'),
                                    'w2_name' => Input::get('wname2'),
                                    'w2_address_l1' => Input::get('wadd2'),
                                    'w2_address_l2' => Input::get('wwaddressline2'),
                                    'w2_address_l3' => Input::get('wwaddressline3'),
                                    'w2_relationship' => Input::get('wrelation2'),
                                    'w2_nic' => Input::get('wnic2'),
                                    'w2_tel' => Input::get('wtno2'),
                                    'w2_email' => Input::get('wemail2'),
                                ));
                                echo '<script type="text/javascript">alert(" Thank You For Registering ");</script>';
                            } catch (Exception $e) {
                                die($e->getMessage());
                            }
                        } else {
                            echo '<script type="text/javascript">alert(" Please tick the checkbox");</script>';
                            $firstname = Input::get('firstname');
                            $middlename = Input::get('middlename');
                            $lastname = Input::get('lastname');
                            $nic = Input::get('d_id');
                            $address = Input::get('address');
                            $addressline2 = Input::get('addressline2');
                            $addressline3 = Input::get('addressline3');
                            $dob = Input::get('dob');
                            $sex = Input::get('sex');
                            $tNo = Input::get('tNo');
                            $email = Input::get('email');
                            $nationality = Input::get('nationality');
                            $religion = Input::get('religion');
                            $district = Input::get('district');
                            $electorate = Input::get('electorate');
                            $wname1 = Input::get('wname1');
                            $wadd1 = Input::get('wadd1');
                            $waddressline2 = Input::get('waddressline2');
                            $waddressline3 = Input::get('waddressline3');
                            $wrelation1 = Input::get('wrelation1');
                            $wnic1 = Input::get('wnic1');
                            $wtno1 = Input::get('wtno1');
                            $wemail1 = Input::get('wemail1');
                            $wname2 = Input::get('wname2');
                            $wadd2 = Input::get('wadd2');
                            $wwaddressline2 = Input::get('wwaddressline2');
                            $wwaddressline3 = Input::get('wwaddressline3');
                            $wrelation2 = Input::get('wrelation2');
                            $wnic2 = Input::get('wnic2');
                            $wtno2 = Input::get('wtno2');
                            $wemail2 = Input::get('wemail2');
                        }
                    } else {
                        /* if (!Input::get('agreement')=='on') {
                          echo '<script type="text/javascript">alert(" Please tick the checkbox");</script>';
                          } */
                        $ar[0] = $validation->errors();

                        foreach ($ar as $error => $error_vals) {
                            for ($x = 0; $x < sizeof($error_vals); $x++) {
                                $a = $ar[0][$x];
                                $arr = explode(' ', trim($a));
                                if ($arr[0] == 'firstname') {
                                    $errFirstname = str_replace('firstname', 'First Name', implode(" ", $arr));
                                } else if ($arr[0] == 'lastname') {
                                    $errLastname = str_replace('lastname', 'Last Name', implode(" ", $arr));
                                } else if ($arr[0] == 'address') {
                                    $erraddress = str_replace('address', 'Address', implode(" ", $arr));
                                } else if ($arr[0] == 'dob') {
                                    $errdob = str_replace('dob', 'Date Of Birth', implode(" ", $arr));
                                } else if ($arr[0] == 'd_id') {
                                    $errnic = str_replace('d_id', 'Identity Card Number', implode(" ", $arr));
                                } else if ($arr[0] == 'tNo') {
                                    $errtNo = str_replace('tNo', 'Telephone Number', implode(" ", $arr));
                                } else if ($arr[0] == 'wname1') {
                                    $errwname1 = str_replace('wname1', 'Witness Name', implode(" ", $arr));
                                } else if ($arr[0] == 'wname2') {
                                    $errwname2 = str_replace('wname2', 'Witness Name', implode(" ", $arr));
                                }else if ($arr[0] == 'email') {
                                    $erremail = str_replace('email', 'E-mail', implode(" ", $arr));
                                }
                            }
                        }

                        // echo '<script type="text/javascript">alert(" ' . $validation->errors() . '");</script>';
                        $firstname = Input::get('firstname');
                        $middlename = Input::get('middlename');
                        $lastname = Input::get('lastname');
                        $nic = Input::get('d_id');
                        $address = Input::get('address');
                        $addressline2 = Input::get('addressline2');
                        $addressline3 = Input::get('addressline3');
                        $dob = Input::get('dob');
                        $sex = Input::get('sex');
                        $tNo = Input::get('tNo');
                        $email = Input::get('email');
                        $nationality = Input::get('nationality');
                        $religion = Input::get('religion');
                        $district = Input::get('district');
                        $electorate = Input::get('electorate');
                        $wname1 = Input::get('wname1');
                        $wadd1 = Input::get('wadd1');
                        $waddressline2 = Input::get('waddressline2');
                        $waddressline3 = Input::get('waddressline3');
                        $wrelation1 = Input::get('wrelation1');
                        $wnic1 = Input::get('wnic1');
                        $wtno1 = Input::get('wtno1');
                        $wemail1 = Input::get('wemail1');
                        $wname2 = Input::get('wname2');
                        $wadd2 = Input::get('wadd2');
                        $wwaddressline2 = Input::get('wwaddressline2');
                        $wwaddressline3 = Input::get('wwaddressline3');
                        $wrelation2 = Input::get('wrelation2');
                        $wnic2 = Input::get('wnic2');
                        $wtno2 = Input::get('wtno2');
                        $wemail2 = Input::get('wemail2');
                    }
                }
            }
            ?>
        </div>

        <div id="form" >
            <div >
                <h2 id="Dtitle">DONOR REGISTRATION FORM</h2>
            </div>
            <form method="post">
                <table>
                    <tr>
                        <td id="lab">
                            <label for="firstname"><span>*</span>First Name:</label>
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
                            <label for="middlename">Middle Name :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="middlename" id="middlename"  value="<?php echo $middlename ?>"/>
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="lastname"><span>*</span>Last Name :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="lastname" id="lastname"  value="<?php echo $lastname ?>"/>
                        </td>
                        <td id="error" >
                            <label id="error" > <?php echo $errLastname ?></label>
                        </td>
                    </tr>

                    <tr>
                        <td id="lab">
                            <label for="address"><span>*</span>Address :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="address" id="address" style="width: 300px" value="<?php echo $address ?>" />
                        </td>
                        <td id="error">
                            <label style="margin-right: 50px"> <?php echo $erraddress ?></label>
                        </td>


                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="addressline2" id="addressline2" style="width: 300px" value="<?php echo $addressline2 ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="addressline3" id="addressline3" style="width: 300px" value="<?php echo $addressline3 ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="sex">Sex :</label>
                        </td>
                        <td id="drop">
                            <select name="sex" id="sex" style="width: 100px"  >

                                <option name="sex"  value="Male" >Male</option>
                                <option name="sex" value="Female">Female</option>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td id="lab" >
                            <label for="dob"><span>*</span>Date of Birth :</label>
                        </td>
                        <td id="textbox">

                            <input type="date" name="dob" id="dob" style="width: 150px;height: 40px;" value="<?php echo $dob ?>" />
                        </td>
                        <td id="error">
                            <label> <?php echo $errdob ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="d_id"><span>*</span>NIC Number :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="d_id" id="d_id" style="width: 120px" value="<?php echo $nic ?>"/>
                        </td>
                        <td id="error">
                            <label > <?php echo $errnic ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="tNo"><span>*</span>Telephone Number :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="tNo" id="tNo" style="width: 120px" value="<?php echo $tNo ?>"/>
                        </td>
                        <td id="error">
                            <label > <?php echo $errtNo ?></label>
                        </td>
                    </tr>

                    <tr>
                        <td id="lab">
                            <label for="email">E-Mail :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="email" id="email" style="width: 250px" value="<?php echo $email ?>"/>
                        </td>
                         <td id="error" >
                            <label id="error" > <?php echo $erremail ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="nationality">Nationality :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="nationality" id="nationality" style="width: 150px" value="<?php echo $nationality ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="religion">Religion :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="religion" id="religion" style="width: 150px" value="<?php echo $religion ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="district">District :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="district" id="district" style="width: 150px"  value="<?php echo $district ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td id="lab">
                            <label for="electorate">Electorate :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="electorate" id="electorate" style="width: 150px" value="<?php echo $electorate ?>" />
                        </td>
                    </tr>
                </table><br>

                <h3>Details of Witnesses</h3>



                <h5>First Witness</h5><br><br>


                <table>
                    <tr>
                        <td id="lab">

                            <label for="wname1"><span>*</span>Name : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wname1" id="wname1" value="<?php echo $wname1 ?>" />
                        </td>
                        <td id="error">
                            <label> <?php echo $errwname1 ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wadd1">Address : </label>
                        </td>

                        <td id="textbox"> 
                            <input type="text" name="wadd1" id="wadd1" style="width: 300px" value="<?php echo $wadd1 ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="waddressline2" id="waddressline2" style="width: 300px" value="<?php echo $waddressline2 ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="waddressline3" id="waddressline3" style="width: 300px" value="<?php echo $waddressline3 ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wrelation1">Relationship : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wrelation1" id="wrelation1" style="width: 150px" value="<?php echo $wrelation1 ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wnic1">NIC Number : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wnic1" id="wnic1" style="width: 150px" value="<?php echo $wnic1 ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wtno1">Telephone Number : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wtno1" id="wtno1" style="width: 150px" value="<?php echo $wtno1 ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wemail1">E-Mail : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wemail1" id="wemail1" style="width: 250px" value="<?php echo $wemail1 ?>" />
                        </td>
                    </tr>
                </table>



                <h5>Second Witness</h5><br>
                <br>



                <table>
                    <tr>
                        <td id="lab">
                            <label for="wname2"><span>*</span>Name : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wname2" id="wname2" value="<?php echo $wname2 ?>" />
                        </td>
                        <td id="error">
                            <label> <?php echo $errwname2 ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wadd2">Address : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wadd2" id="wadd2" style="width: 300px" value="<?php echo $wadd2 ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="wwaddressline2" id="wwaddressline2" style="width: 300px" value="<?php echo $wwaddressline2 ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="wwaddressline3" id="wwaddressline3" style="width: 300px" value="<?php echo $wwaddressline3 ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wrelation2">Relationship : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wrelation2" id="wrelation2" style="width: 150px" value="<?php echo $wrelation2 ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wnic2">NIC Number : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wnic2" id="wnic2" style="width: 150px" value="<?php echo $wnic2 ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wtno2">Telephone Number : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wtno2" id="wtno2" style="width: 150px" value="<?php echo $wtno2 ?>" />
                        </td>
                    </tr>

                    <tr>

                        <td id="lab">
                            <label for="wemail2">E-Mail : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wemail2" id="wemail2" style="width: 250px" value="<?php echo $wemail2 ?>" />
                        </td>
                    </tr>

                </table>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input id='check' type="checkbox" name='agreement' style="float: left; margin-top: 20px; width: 20px ;height: 20px ; margin-left: 20% ; " /><label style="width: 70% ;color: #000000; margin-top: 18px; padding-left: 50px ; font-weight: bold" >I, the undersigned here by consent to donate my eyes/body parts or the body for clinical use and medical research, in accordance with the Cornea Graft Act No. 38 of 1995 and Human Tissue Transplantation Act No.48 of 1987.</label>
                <input id="submit" type="submit" value="Submit"/>
            </form>
        </div>



    </body>

</html>