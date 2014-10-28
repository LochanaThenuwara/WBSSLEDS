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
            $errFirstname='';
            $errLastname='';           
            $erraddress='';
            $errdob='';
            $errtNo='';
            $errwname1='';
            $errwname2='';
            $user = new User();
         if($user->isLoggedIn()){
            
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
                        )
                       
                        
                    ));
                    if ($validation->passed()) {
                        
                        


                        try {
                            $user->update(array(
                              // 'd_id' => Input::get('nic'),
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
                           
                            echo "<script>alert(' Successfully Updated '); window.location.href='DonateFirst.php' ;</script>";
                             $user->logout();
                            
                            //header('Location: DonateFirst.php');
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                   
                    }
                    else {
                     
                        
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
                                }  else if ($arr[0] == 'tNo') {
                                    $errtNo =  str_replace('tNo', 'Telephone Number', implode(" ", $arr));
                                } else if ($arr[0] == 'wname1' ) {
                                    $errwname1 = str_replace('wname1', 'Witness Name', implode(" ", $arr));
                                }else if ($arr[0] ==  'wname2') {
                                     $errwname2 = str_replace('wname2', 'Witness Name', implode(" ", $arr));
                                }
                            }
                        }

                        
                       // echo '<script type="text/javascript">alert(" ' . $validation->errors() . '");</script>';
                      
                    }
                }
            }
         }
            ?>
        </div>

        <div id="form" >
            <div >
                <h2 id="Dtitle">DONOR DETAILS UPDATE</h2>
            </div>
            <form method="post">
                <table>
                    <tr>
                        <td id="lab">
                            <label for="firstname"><span>*</span>First Name:</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="firstname" id="firstname"  value="<?php echo $user->data()->d_firstname;?>"/>
                        </td>
                        <td id="error">
                            <label> <?php echo $errFirstname  ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="middlename">Middle Name :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="middlename" id="middlename"  value="<?php echo $user->data()->d_middlename;?>"/>
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="lastname"><span>*</span>Last Name :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="lastname" id="lastname"  value="<?php echo $user->data()->d_lastname?>"/>
                        </td>
                        <td id="error" >
                            <label > <?php echo $errLastname ?></label>
                        </td>
                    </tr>

                    <tr>
                        <td id="lab">
                            <label for="address"><span>*</span>Address :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="address" id="address" style="width: 300px" value="<?php echo $user->data()->d_address_l1; ?>" />
                        </td>
                        <td id="error">
                            <label> <?php echo $erraddress  ?></label>
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="addressline2" id="addressline2" style="width: 300px" value="<?php echo $user->data()->d_address_l2; ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="addressline3" id="addressline3" style="width: 300px" value="<?php echo $user->data()->d_address_l3; ?>" />
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
                            <input type="date" name="dob" id="dob" style="width: 150px;height: 40px;" value="<?php echo $user->data()->dob; ?>" />
                        </td>
                        <td id="error">
                            <label> <?php echo $errdob  ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="nic">NIC Number :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="nic" id="nic" readonly="true" style="width: 120px" value="<?php echo $user->data()->d_id; ?>"/>
                        </td>
                       
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="tNo"><span>*</span>Telephone Number :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="tNo" id="tNo" style="width: 120px" value="<?php echo $user->data()->d_tel; ?>"/>
                        </td>
                        <td id="error">
                            <label> <?php echo $errtNo ?></label>
                        </td>
                    </tr>

                    <tr>
                        <td id="lab">
                            <label for="email">E-Mail :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="email" id="email" style="width: 250px" value="<?php echo $user->data()->d_email; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="nationality">Nationality :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="nationality" id="nationality" style="width: 150px" value="<?php echo $user->data()->d_nationality; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="religion">Religion :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="religion" id="religion" style="width: 150px" value="<?php echo $user->data()->d_religion; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="district">District :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="district" id="district" style="width: 150px"  value="<?php echo $user->data()->d_district;?>" />
                        </td>
                    </tr>

                    <tr>
                        <td id="lab">
                            <label for="electorate">Electorate :</label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="electorate" id="electorate" style="width: 150px" value="<?php echo $user->data()->d_electorate; ?>" />
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
                            <input type="text" name="wname1" id="wname1" value="<?php  echo $user->data()->w1_name; ?>" />
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
                            <input type="text" name="wadd1" id="wadd1" style="width: 300px" value="<?php echo $user->data()->w1_address_l1;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="waddressline2" id="waddressline2" style="width: 300px" value="<?php echo $user->data()->w1_address_l2; ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="waddressline3" id="waddressline3" style="width: 300px" value="<?php echo $user->data()->w1_address_l3; ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wrelation1">Relationship : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wrelation1" id="wrelation1" style="width: 150px" value="<?php echo $user->data()->w1_relationship;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wnic1">NIC Number : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wnic1" id="wnic1" style="width: 150px" value="<?php echo $user->data()->w1_nic;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wtno1">Telephone Number : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wtno1" id="wtno1" style="width: 150px" value="<?php if($user->data()->w1_tel >0){echo $user->data()->w1_tel;} ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wemail1">E-Mail : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wemail1" id="wemail1" style="width: 250px" value="<?php echo $user->data()->w1_email; ?>" />
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
                            <input type="text" name="wname2" id="wname2" value="<?php echo $user->data()->w2_name; ?>" />
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
                            <input type="text" name="wadd2" id="wadd2" style="width: 300px" value="<?php echo $user->data()->w2_address_l1;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="wwaddressline2" id="wwaddressline2" style="width: 300px" value="<?php echo $user->data()->w2_address_l2; ?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">

                        </td>
                        <td id="textbox">
                            <input type="text" name="wwaddressline3" id="wwaddressline3" style="width: 300px" value="<?php echo $user->data()->w2_address_l3;?>" />
                        </td>

                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wrelation2">Relationship : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wrelation2" id="wrelation2" style="width: 150px" value="<?php echo $user->data()->w2_relationship;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wnic2">NIC Number : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wnic2" id="wnic2" style="width: 150px" value="<?php echo $user->data()->w2_nic; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td id="lab">
                            <label for="wtno2">Telephone Number : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wtno2" id="wtno2" style="width: 150px" value="<?php if($user->data()->w2_tel >0){echo $user->data()->w2_tel;}?>" />
                        </td>
                    </tr>

                    <tr>

                        <td id="lab">
                            <label for="wemail2">E-Mail : </label>
                        </td>
                        <td id="textbox">
                            <input type="text" name="wemail2" id="wemail2" style="width: 250px" value="<?php echo $user->data()->w2_email;?>" />
                        </td>
                    </tr>

                </table>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
               
                <input id="submit" type="submit" value="Submit"/>
            </form>
        </div>



    </body>

</html>
