<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <!-- Header Links-->
        <title>Sri Lanka Eye Donation Society</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="interface/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="interface/css/styles.css" rel="stylesheet">
        <link href="interface/css/Financialdons.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>

    </head>
    <body class="body">
        <div>
            <?php
            include 'interface/header.inc';
            require_once 'core/init.php';
            $firstname = '';
            $middlename = '';
            $lastname = '';
            $address1 = '';
            $address2 = '';
            $address3 = '';
            $email = '';
            $amount = '';
            $errFirstname = '';
            $errLastname = '';
            $erraddress = '';
            $errcountry = '';
            $erremail = '';
            $erramount = '';
            if (Input::exists()) {

                if (Token::check(Input::get('token'))) {

                    $validate = new ValidateCdonor();
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
                        'amount' => array(
                            'required' => true
                            
                        ),
                        'email' => array(
                            'required' => true,
                            'check' => true,
                        ),
                        'country' => array(
                            'required' => true
                        )
                    ));

                    if ($validation->passed()) {
                        //if statement here for check actually transaction happeed or not

                        $query = array();
                        $query['notify_url'] = 'http://google.lk';
                        $query['cmd'] = '_donations';
                        $query['business'] = 'gts@gmail.com';

                        $query['item_name'] = 'Sri Lanka Eye Donation Society';
                        $query['item_number'] = 'Make Your Donation';
                        $query['amount'] = Input::get('amount');
                        $query_string = http_build_query($query);
                        header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
////////////////        //////////////
                        $user = new UserCdonor();
                        try {

                            $user->create(array(
                                'cd_firstname' => Input::get('firstname'),
                                'cd_middlename' => Input::get('middlename'),
                                'cd_lastname' => Input::get('lastname'),
                                'cd_country' => Input::get('country'),
                                'cd_address1' => Input::get('address'),
                                'cd_address2' => Input::get('addressline2'),
                                'cd_address3' => Input::get('addressline3'),
                                'cd_email' => Input::get('email'),
                                'amount' => Input::get('amount')
                            ));
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } else {
                        $firstname = Input::get('firstname');
                        $middlename = Input::get('middlename');
                        $lastname = Input::get('lastname');
                        $address1 = Input::get('address');
                        $address2 = Input::get('addressline2');
                        $address3 = Input::get('addressline3');
                        $email = Input::get('email');
                        $amount = Input::get('amount');

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
                                } else if ($arr[0] == 'country') {
                                    $errcountry = str_replace('country', 'Country', implode(" ", $arr));
                                } else if ($arr[0] == 'email') {
                                    $erremail = str_replace('email', 'E-mail', implode(" ", $arr));
                                } else if ($arr[0] == 'amount') {
                                    $erramount = str_replace('amount', 'Amount', implode(" ", $arr));
                                }
                            }
                        }
                    }
                }
            }
            ?>
        </div>
        <div id="ydonate">
            <div>
                <label id="ydon">Why Donate?</label>
                <hr id="hline">
            </div>
        </div>
        <div id="formdonate">
            <form  method="post" >

                <label id="AmountSelect"> Select an Amount</label>
                <hr id="hline">

                <div id="Amountbtn">
                    <button type="button" id="a1" class="btn btn-primary" >RS 100 </button>
                    <button type="button" id="a2" class="btn btn-primary">RS 200 </button>
                    <button type="button" id="a3" class="btn btn-primary">RS 500 </button>
                    <button type="button" id="a4" class="btn btn-primary">RS 1000</button>
                    <button type="button" id="a5" class="btn btn-primary">Other </button>
                    <script>
                        $("button").click(function () {
                            $a = this.id;
                            if ($a === "a1") {
                                //var text =100;
                                $("#vals").val(100);
                            }
                            else if ($a === "a2") {
                                $("#vals").val(200);
                            }
                            else if ($a === "a3") {
                                $("#vals").val(500);
                            }
                            else if ($a === "a4") {
                                $("#vals").val(1000);
                            }
                            else {
                                $("#vals").val("");
                            }
                        });
                    </script>
                </div>
                <div id="amnt">
                    <label><span>*</span>Rs </label>
                    <input id="vals" type="text" name="amount" value="<?php echo $amount; ?>"   maxlength="8" >
                    <label>LKR</label> 
                    <label id="error"> <?php echo $erramount ?></label>


                </div>
                <div>
                    <label id="AmountSelect">Your Information</label>
                    <hr id="hline">
                    <table id="tbldonate">
                        <tr>
                            <td id="lab">
                                <label for="firstname"><span>*</span>First Name:</label>
                            </td>
                            <td id="textbox">
                                <input type="text" name="firstname" id="firstname"  value="<?php echo $firstname; ?>"/>
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
                                <input type="text" name="middlename" id="middlename"  value="<?php echo $middlename; ?>"/>
                            </td>                          

                        </tr>
                        <tr>
                            <td id="lab">
                                <label for="lastname"><span>*</span>Last Name :</label>
                            </td>
                            <td id="textbox">
                                <input type="text" name="lastname" id="lastname"  value="<?php echo $lastname; ?>"/>
                            </td>
                            <td id="error">
                                <label> <?php echo $errLastname ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td id="lab">
                                <label for="country"><span>*</span>Country :</label>
                            </td>
                            <td>
                                <select name="country" id="droplist">
                                    <option value="">Country</option>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AG">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AG">Antigua &amp; Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AA">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia</option>
                                    <option value="BL">Bonaire</option>
                                    <option value="BA">Bosnia &amp; Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BR">Brazil</option>
                                    <option value="BC">British Indian Ocean Ter</option>
                                    <option value="BN">Brunei</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="IC">Canary Islands</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CD">Channel Islands</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CI">Christmas Island</option>
                                    <option value="CS">Cocos Island</option>
                                    <option value="CO">Colombia</option>
                                    <option value="CC">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CT">Cote D'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CB">Curacao</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="TM">East Timor</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FA">Falkland Islands</option>
                                    <option value="FO">Faroe Islands</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="GF">French Guiana</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="FS">French Southern Ter</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GB">Great Britain</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HW">Hawaii</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IA">Iran</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IR">Ireland</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="NK">Korea North</option>
                                    <option value="KS">Korea South</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Laos</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macau</option>
                                    <option value="MK">Macedonia</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="ME">Mayotte</option>
                                    <option value="MX">Mexico</option>
                                    <option value="MI">Midway Islands</option>
                                    <option value="MD">Moldova</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Nambia</option>
                                    <option value="NU">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="AN">Netherland </option>
                                    <option value="NV">Nevis</option>
                                    <option value="NC">New Caledonia</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NW">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau Island</option>
                                    <option value="PS">Palestine</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PO">Pitcairn Island</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="ME">Republic of Montenegro</option>
                                    <option value="RS">Republic of Serbia</option>
                                    <option value="RE">Reunion</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russia</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="NT">St Barthelemy</option>
                                    <option value="EU">St Eustatius</option>
                                    <option value="HE">St Helena</option>
                                    <option value="KN">St Kitts-Nevis</option>
                                    <option value="LC">St Lucia</option>
                                    <option value="MB">St Maarten</option>
                                    <option value="PM">St Pierre &amp; Miquelon</option>
                                    <option value="VC">St Vincent &amp; Grenadines</option>
                                    <option value="SP">Saipan</option>
                                    <option value="SO">Samoa</option>
                                    <option value="AS">Samoa American</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome &amp; Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="OI">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syria</option>
                                    <option value="TA">Tahiti</option>
                                    <option value="TW">Taiwan</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad &amp; Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TU">Turkmenistan</option>
                                    <option value="TC">Turks &amp; Caicos Is</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States of America</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VS">Vatican City State</option>
                                    <option value="VE">Venezuela</option>
                                    <option value="VN">Vietnam</option>
                                    <option value="VB">Virgin Islands (Brit)</option>
                                    <option value="VA">Virgin Islands (USA)</option>
                                    <option value="WK">Wake Island</option>
                                    <option value="WF">Wallis &amp; Futana Is</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZR">Zaire</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>
                            </td>
                            <td id="error">
                                <label> <?php echo $errcountry ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td id="lab">
                                <label for="address"><span>*</span>Address :</label>
                            </td>
                            <td id="textbox">
                                <input type="text" name="address" id="address"  value="<?php echo $address1; ?>" />
                            </td>
                            <td id="error">
                                <label> <?php echo $erraddress ?></label>
                            </td>

                        </tr>
                        <tr>
                            <td id="lab">

                            </td>
                            <td id="textbox">
                                <input type="text" name="addressline2" id="addressline2"  value="<?php echo $address2; ?>" />
                            </td>

                        </tr>
                        <tr>
                            <td id="lab">

                            </td>
                            <td id="textbox">
                                <input type="text" name="addressline3" id="addressline3" value="<?php echo $address3; ?>" />
                            </td>

                        </tr>
                        <tr>
                            <td id="lab">
                                <label for="email"><span>*</span>E-Mail :</label>
                            </td>
                            <td id="textbox">
                                <input type="text" name="email" id="email"  value="<?php echo $email; ?>"/>
                            </td>
                            <td id="error">
                                <label> <?php echo $erremail ?></label>
                            </td>
                        </tr>

                    </table>
                    <div id="donationbtn">
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <input type="submit" id="donatebtn" value="Donate"  >
                    </div> 
                </div>
            </form>
        </div>

    </body>

</html>

