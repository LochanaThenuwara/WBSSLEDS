

<?php 

                  

        global $dcerror;



require_once'core/init.php';
        $uname = 'Username';
        $pwd   = 'Password';
        $dcerror = "";
        
        
        if(isset($_POST['login'])){
       
if (Input::exists()) {
    //if (Token::check(Input::get('token'))) {
        
        $validate=new Validation();
        $validation=$validate->check($_POST, array(
            'uname'=>array('required'=>true),
            'pwd'=>array('required'=>true)
        ));
        if ($validation->passed()) {
            $surgeon=new Surgeon();
            
            $remember = (Input::get('remember')==='on')?TRUE:FALSE;
            $login=$surgeon->login(Input::get('uname'),Input::get('pwd'),$remember);
            if ($login) {
                
                Redirect::to('index.php');
            } else {
                echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Username or Password is incorrect !</strong> 
</div>';
                    
                 
                
               
                $uname="";
                $pwd='Invalid Log In.';
            }
        
        
            
        }else{
            
            echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Required data are missing!!</strong> 
</div>';
            
           
            $uname= "";
            
            
          /*  if(sizeof($validation->errors())==1){
                if($validation->errors()[0]=='username is required'){
                    echo $validation->errors()[0];
                    $uname = 'Username is required';
                    
                }  else {
                    $pwd = 'Password is required.';
                    
                }
                
                                
                
            }  else {
                
                $uname = 'Username is required.';
                $pwd = 'Password is required.';
                
            }*/
            
              
                
            
          
        }
    }
        
        }elseif (isset($_POST['register'])) {
            if(Input::exists()){
            
                if(!$_FILES['document']['size']>0){
            $dcerror = "Document is required.";
            
            
        }  else {
            
                  }
             $validate = new Validation();
    $validation = $validate->check($_POST,array(
        'username'=> array(
            'required' => TRUE,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password'=> array(
            'required'=> TRUE,
            'min' => 6
        ),
        'ConfirmPassword' => array(
            'required' => TRUE,
            'matches' => 'password'
        ),
        'name' => array(
            'required' => TRUE,
            'min' => 2,
            'max' => 100,
        ),
        'email' => array(
            'required' => TRUE,
            'evalidate'=> TRUE,
            
            
        ),
        'nic' => array(
            'required' => TRUE,
            'min' => 6,
            'max' => 10,
            
        ),
        'birthday' => array(
            'required' => TRUE,
            
        ),
        'address' => array(
            'required' => TRUE,
            
        ),
        'country' => array(
            'required' => TRUE,
            
        ),
        'gender' => array(
            'required' => TRUE,
            
        ),
        
        
        
        
        
    ));
    
    
   
    if ( $validation->passed()&& $_FILES['document']['size']>0){
        $surgeon = new Surgeon();
        $salt = Hash::salt(32);
        
        $fileName = $_FILES['document']['name'];
        $tmpName  = $_FILES['document']['tmp_name'];
        $fileSize = $_FILES['document']['size'];
        $fileType = $_FILES['document']['type'];

        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
         fclose($fp);

        if(!get_magic_quotes_gpc()){

        $fileName = addslashes($fileName);
        }
        
        
        try {
            $surgeon->create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'email'=> Input::get('email'),
                'nic'  => Input::get('nic'),
                'birthday' => Input::get('birthday'),
                'gender' => Input::get('gender'),
                'number' => Input::get('number'),
                'address' => Input::get('address'),
                'country' => Input::get('country'),
                'dname'   => $fileName,
                'dtype'   => $fileType,
                'dsize'   => $fileSize,
                'document'=> $content,
                'salt' => $salt,
                'name' => Input::get('name'),
                'joined' => date('Y-m-d H:i:s'),
                'group' => 1
            ));
            
            
            

            Session::flash('index','You have been registered and can now log in!');
            
            
            Redirect::to('index.php');
            
            
            
        } catch (Exception $e) {
            die($e->getMessage());
            
        }
    
    }  else {
        $error = $validation->errors();
        
        
        
    }
    
    }
            
        }
            
            
            

//}

?>


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
        <body style="background: #fff; margin-top: 0px;padding-top: 0px" >
            <!-- header -->
     <nav class="navbar navbar-static" >
    <a class="navbar-brand " href="http://localhost/netbeans/Eyee/index.php" target="ext"><b><image src="interface/images/eye.png"></b></a>
   <div class="container">
    <div class="navbar-header" >
      
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
    </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">  
            <li ><a href="index.php"  >Home</a></li>
          <li><a href="#" class="active">Surgeons</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Donate</a>
            <ul class="dropdown-menu">
              <li><a href="#">Cash</a></li>
              <li><a href="#">Tissues</a></li>
              
              
            </ul>
            <li><a href="#">Eyes</a></li>
            <li><a href="#">Tissues</a></li>
             <li><a href="#">Reservations</a></li>
            <li><a href="#">Lens Lab</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
          
          
        </ul>
         <b id="topname">Sri Lanka Eye Donation Society</b>
         
        
      </div>
       
       
       
    </div>
     </nav>
            
            <form action="" method="post" style="margin-bottom: 0px" >
            <div class="login">
                <table style="alignment-adjust: central;border-width: 0px;float: right" >
                    <tr>
                        <td>
                             <div class="input-group input-group-sm">
                             <span class="input-group-addon">@</span>
                             <input type="text" class="form-control"  placeholder="<?php echo $uname;?>" name="uname" id="username" value="<?php echo escape(Input::get('uname')); ?>"autocomplete="off">
                             
                              </div>
                        </td>
                        <td>
                             <div class="input-group input-group-sm">
                             <span class="input-group-addon">*</span>
                             <input type="password" class="form-control" placeholder="<?php echo $pwd;?>" name="pwd" id="password" autocomplete="off">
                        </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="input-group input-group-sm">
                                <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                                <input type="submit" value="log In" class="btn btn-default navbar-btn" style="background:#428bca;color: #fff" name="login">
                                
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group input-group-sm">
                            <label for="remember">
                             <input type="checkbox" name="remember" id="remember"> Remember me 
                             </label>
                            </div>
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                            <label for="remember">
                                <a href="#">Forgot your password?</a>  
                             </label>
                            </div>
                        </td>
                        
                    </tr>
                </table>
                </div>
                
            
        </form>
            <!--register-->
            

<?php




require_once 'core/init.php';
global $error;
global $fail;












    






//if(Input::exists()){
    
    
    
    //if(Token::check(Input::get('token'))){
     /*   if(!$_FILES['document']['size']>0){
            $dcerror = "Please upload the document.";
            
        }  else {
            
                  }*/
    
    /*

    $validate = new Validation();
    $validation = $validate->check($_POST,array(
        'username'=> array(
            'required' => TRUE,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password'=> array(
            'required'=> TRUE,
            'min' => 6
        ),
        'ConfirmPassword' => array(
            'required' => TRUE,
            'matches' => 'password'
        ),
        'name' => array(
            'required' => TRUE,
            'min' => 2,
            'max' => 100,
        ),
        'email' => array(
            'required' => TRUE,
            'evalidate'=> TRUE,
            
            
        ),
        'nic' => array(
            'required' => TRUE,
            
        ),
        'birthday' => array(
            'required' => TRUE,
            
        ),
        'address' => array(
            'required' => TRUE,
            
        ),
        'country' => array(
            'required' => TRUE,
            
        ),
        'gender' => array(
            'required' => TRUE,
            
        ),
        
        
        
        
    ));
    
    
   
    if ( $validation->passed()&& $_FILES['document']['size']>0){
        $surgeon = new Surgeon();
        $salt = Hash::salt(32);
        
        $fileName = $_FILES['document']['name'];
        $tmpName  = $_FILES['document']['tmp_name'];
        $fileSize = $_FILES['document']['size'];
        $fileType = $_FILES['document']['type'];

        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
         fclose($fp);

        if(!get_magic_quotes_gpc()){

        $fileName = addslashes($fileName);
        }
        
        
        try {
            $surgeon->create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'email'=> Input::get('email'),
                'nic'  => Input::get('nic'),
                'birthday' => Input::get('birthday'),
                'gender' => Input::get('gender'),
                'number' => Input::get('number'),
                'address' => Input::get('address'),
                'country' => Input::get('country'),
                'dname'   => $fileName,
                'dtype'   => $fileType,
                'dsize'   => $fileSize,
                'document'=> $content,
                'salt' => $salt,
                'name' => Input::get('name'),
                'joined' => date('Y-m-d H:i:s'),
                'group' => 1
            ));
            
            
            

            Session::flash('index','You have been registered and can now log in!');
            
            
            Redirect::to('index.php');
            
            
            
        } catch (Exception $e) {
            die($e->getMessage());
            
        }
    
    }  else {
        $error = $validation->errors();
        
        
        
    }
    
    }*/
    
    //}

   
?>
<div class="regout">
    <form action="surgeon.php" method="post" style="margin-bottom: 0px;margin-top: 0px" enctype="multipart/form-data">
                
                
                
                
                <div class="regs">
                    <span style="color: #000d69;font-family:'verdana';margin-top: 0px;margin-bottom: 0px;text-align: center"><h1>REGISTER</h1><h5><span style='color: red'><p>You should be a certified doctor in any state to register here. Our administrators will verify your data and decide weather approve or not.<br><br>* Marked fields are required.</p></span>  </h5></span>
                    <table >
                        <tr>
                            <td>
                                <div class="labl">
                                    <label for="name"><span style="color: red">*</span> Full Name : </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name'));?>" autocomplete="off"><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['name']))  echo '<span style="color:red;font-size:15px;">'.$error['name'].'</span>'; ?><br><br>
                            </td>
                            
                            
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="email"><span style="color: red">*</span> Email Address :  </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="text" name="email" id="email" value="<?php echo escape(Input::get('email'));?>" autocomplete="off"><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['email']))  echo '<span style="color:red;font-size:15px;">'.$error['email'].'</span>'; ?><br><br>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="nic"> <span style="color: red">*</span>NIC/ Passport Number :  </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="text" name="nic" id="nic" value="<?php echo escape(Input::get('nic'));?>" autocomplete="off"><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['nic']))  echo '<span style="color:red;font-size:15px;">'.$error['nic'].'</span>'; ?><br><br>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="dob"><span style="color: red">*</span>  Date of Birth : </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="date" name="birthday" id="birthday" style="height: 30px" value="<?php echo Input::get('birthday'); ?>" ><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['birthday']))  echo '<span style="color:red;font-size:15px;">'.$error['birthday'].'</span>'; ?><br><br>
                            </td>
                            
                        </tr>
                        <tr>
                             <td>
                                <div class="labl">
                                <label for="gender"> <span style="color: red">*</span> Gender : </label> 
                                
                                </div>
                             </td>
                            <td>
                                <div class="field">                                
                                     
	                        <input type="radio" name="gender" value="male" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'male')  echo ' checked="checked"';?> >
	                           Male 
	                        <input type="radio" name="gender" value="female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'female')  echo ' checked="checked"';?> > 
	                           Female<br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['gender']))  echo '<span style="color:red;font-size:15px;">'.$error['gender'].'</span>'; ?><br><br>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="number"> Contact Number :  </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="text" name="number" id="number" value="<?php echo escape(Input::get('number'));?>" autocomplete="off"><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['number']))  echo '<span style="color:red;font-size:15px;">'.$error['number'].'</span>'; ?><br><br>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="address"> <span style="color: red">*</span> Permanent Address : </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="text" name="address" id="address" value="<?php echo escape(Input::get('address'));?>" autocomplete="off"><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['address']))  echo '<span style="color:red;font-size:15px;">'.$error['address'].'</span>'; ?><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="country"><span style="color: red">*</span>Country : </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <select name="country" style="width: 58%" id="country" value="<?php echo escape(Input::get('country'));?>">
<option value="">Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
                                    </select><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['country']))  echo '<span style="color:red;font-size:15px;">'.$error['country'].'</span>'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="doc"> <span style="color: red">*</span>Any document can prove you are a certified doctor :  </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                    <input type="file" name="document" id="document" value="document"><br>
                                    
                                </div>
                            </td>
                            <td>
                                <?php if (isset($dcerror))  echo '<span style="color:red;font-size:15px;">'.$dcerror.'</span>'; ?><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="uname"> <span style="color: red">*</span>Username :  </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'));?>" autocomplete="off"><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['username']))  echo '<span style="color:red;font-size:15px;">'.$error['username'].'</span>'; ?><br><br>
                            </td>
                        </tr>
                        <tr>
                        <span></span>
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="pwd"> <span style="color: red">*</span>Password : </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="password" name="password" id="password" value="<?php echo escape(Input::get('password'));?>" autocomplete="off"><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['password']))  echo '<span style="color:red;font-size:15px;">'.$error['password'].'</span>'; ?><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="labl">
                                <label for="cpwd"><span style="color: red">*</span>Confirm Password :</label>                                
                                </div>
                            </td>
                            <td>
                                <div class="field">                                
                                    <input type="password" name="ConfirmPassword" id="ConfirmPassword" value="<?php echo escape(Input::get('ConfirmPassword'));?>" autocomplete="off"><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($error['ConfirmPassword']))  echo '<span style="color:red;font-size:15px;">'.$error['ConfirmPassword'].'</span>'; ?><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
                                <input type="submit" value="register" id="sreg" name="register" >
                                
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
</div>
            <?php
            //include 'register.inc.php';
            ?>
            
            <?php 
            include 'interface/footer.inc';
            
           
            ?>
            