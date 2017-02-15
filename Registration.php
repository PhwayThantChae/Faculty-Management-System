<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<style type="text/css">

.error ,.error-password { background-color:rgba(217,80,80,0.2);
		 border-top-right-radius:10px;
		 border-right-color:#CC3333;
		 border-left-color:#CC3333;
		 border:1px solid #CC3333;
		 border-right-width:1px;
		 border-left-width:1px;
		 padding-right : 540px;
}

.error_gender {
		 background-color:rgba(217,80,80,0.2);
		 border-top-right-radius:10px;
		 border-right-color:#CC3333;
		 border-left-color:#CC3333;
		 border:1px solid #CC3333;
		 border-right-width:1px;
		 border-left-width:1px;
		 padding-right : 1px;
}

#container1 {
    background-color:;
}

.centered-form {
    margin-top: 40px;
    margin-bottom: 10px;
}

.centered-form .panel {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: rgba(0, 0, 0, 0.1) 20px 20px 20px;
}

.margin-inner{
	margin-right : 5px;
	margin-left : 1px;
	}
	
.margin-inner-button{
        }

</style>
</head>
<body>

<?php

if ( isset( $_POST["submitButton"] ) ) {
processForm();
} else {
displayForm( array() ,0);
}

function validateField( $fieldName, $missingFields ) {
if ( in_array( $fieldName, $missingFields ) ) {
	if($fieldName == "gender" ){
		echo 'class="error_gender"';
	}
	 if($fieldName == "status"){
		echo 'class="error_gender"';
	}
	else{
		echo 'class="error"';
	}

}
}

function setValue( $fieldName ) {

if ( isset( $_POST[$fieldName] ) ) {
echo $_POST[$fieldName];
}
	
if($fieldName == "NRC"){
	if(isset( $_POST[$fieldName] )){
		$nrc = trim($_POST[$fieldName]);
		$NRCMatch = preg_match("/^([1|2|3|4|5|6|7|8|9]{1}|[1]{1}[0|1|2|3|4]{1})\/[a-zA-Z]{3,7}\([N]\)[0-9]{6}$/",$nrc);
	if(!$NRCMatch){
		echo "";
	}
	}
	}
}

function setChecked( $fieldName, $fieldValue ) {
if ( isset( $_POST[$fieldName] ) and $_POST[$fieldName] == $fieldValue ) {
	
echo 'checked="checked"';
}
}

function setSelected( $fieldName, $fieldValue ) {
if ( isset( $_POST[$fieldName] ) and $_POST[$fieldName] == $fieldValue ) {
echo 'selected="selected"';
}
}

function processForm() {
	$requiredFields = array( "UserName", "password1", "password2", "gender", "TelephoneNumber", "Email","NRC", "Address","status");
	$missingFields = array();

	//$flag = 0;
	$p1 = trim($_POST["password1"]);
	$p2 = trim($_POST["password2"]);
	
	$nrc = trim($_POST["NRC"]);
	$NRCMatch = preg_match("/^([1|2|3|4|5|6|7|8|9]{1}|[1]{1}[0|1|2|3|4]{1})\/[a-zA-Z]{3,7}\([N]\)[0-9]{6}$/",$nrc);

		foreach ( $requiredFields as $requiredField ) {
			if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
				$missingFields[] = $requiredField;
			}
		}

		if ( $missingFields ) {
				displayForm($missingFields,7);
				//$flag = 1;
			} 
			
		else if($p1 != $p2 && !$NRCMatch){
			displayForm(array(), 3);
		}
		else if($p1 != $p2 ){
				displayForm(array(),1);
		}
		else if(!$NRCMatch){
			displayForm(array(),2);
		}
		else{
					/////////////////////////////////////  Connect DB here
			DBConnect();
		}
		
	}

function DBConnect(){
	
	include 'DBConnection.php';
	
	$user_nrc = trim($_POST["NRC"]);
	$sqlNRC = "SELECT user_type_nrc from user_type WHERE user_type_nrc=\"$user_nrc\";";
	$user_name = trim($_POST["UserName"]);
	$user_password = trim($_POST["password2"]);
	$user_gender = trim($_POST["gender"]);
	$user_tel = trim($_POST["TelephoneNumber"]);
	$user_email = trim($_POST["Email"]);
	$user_status = trim($_POST["status"]);
	$user_nrc = trim($_POST["NRC"]);
	$user_address = trim($_POST["Address"]);
	$register_date = date("Y-m-d");
	
	$ResultsqlNRC = $conn->query($sqlNRC);
	
	if($ResultsqlNRC->num_rows > 0){
		
		
		header("Location: http://localhost/Faculty Management System/Faculty Management System/Login.php?login=2");
	
	}
	else{
		$sqlRegister= "INSERT INTO user_type(user_type_name,user_type_password,user_type_gender,user_type_status,user_type_telephone,user_type_email,user_type_nrc,user_type_last_access,user_type_address) 
					   VALUES (\"$user_name\",\"$user_password\",\"$user_gender\",\"$user_status\",\"$user_tel\",\"$user_email\",\"$user_nrc\",\"$register_date\",\"$user_address\");";
		$ResultsqlRegister = $conn->query($sqlRegister);
		
		$lastID = $conn->insert_id;
		

		$sqlConnectProfile = "UPDATE staff SET user_type_id=$lastID WHERE nrc=\"$user_nrc\"";
		$resultsqlConnectProfile = $conn->query($sqlConnectProfile);
		
		header("Location: http://localhost/Faculty Management System/Faculty Management System/Login.php?login=4");
	}
	
}

function displayForm( $missingFields,$a ) {
?>
<div class="container" id="container1">
<h1 align="center"><strong>Registration Form</strong></h1>

<?php  if ($a == 1){?>
	<div class="alert alert-danger">Please reconfirm your password.</div>
	
<?php }if ($a == 2){?>
	<div class="alert alert-danger">Your NRC number is wrong. Please check it again.</div>
<?php }if ( $missingFields ) { ?>
  <!-- <h4 class="error_gender" align="center">There were some problems with the form you submitted.</h4>  -->
  
	<div class="alert alert-danger">There were some problems with the form you submitted. Please complete the fields highlighted below and resend the form.
	</div>

<?php } if($a == 3){?>
	<div class="alert alert-danger">Please reconfirm your password.</br>Your NRC number is wrong. Please check it again.</div>
	
<?php } if($a != 1 && !$missingFields && $a !=2 && $a!=3){ 

		?>
<h4 align="center" class="lead">Thank you for joining our faculty system.  Please fill these form for your registration.</h4>
<?php } ?>
<div class="row centered-form">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-info">
<div class="panel-heading">
<h3 class="panel-title text-center"><strong>Please Register</strong></h3>
</div>

<div class="panel-body">
<form action="Registration.php" method="post">

<div class="form-group margin-inner">
<input <?php validateField( "UserName", $missingFields )?> type="text" name="UserName" id="UserName" value="<?php setValue( "UserName" ) ?>" class="form-control input-md " placeholder="User Name" />
</div>

<div class="form-group margin-inner">
<input <?php if ( $missingFields ) echo ' class="error"'?> class="form-control input-md" placeholder="Password" type="password" name="password1" id="password1" value="" />
</div>

<div class="form-group margin-inner">
<input  <?php if ( $missingFields ) echo' class="error"'?> class="form-control input-md" placeholder="Comfirm Password" type="password" name="password2" id="password2" value="" />
</div>

<div class="form-group margin-inner">
<label <?php validateField( "gender", $missingFields )?>>Gender :</label>
<label for="genderMale">Male</label>
<input type="radio" name="gender" id="genderMale" value="M" <?php setChecked( "gender","M" )?>/>

<label for="genderFemale">Female</label>
<input type="radio" name="gender" id="genderFemale" value="F" <?php setChecked( "gender","F" )?> />
</div>

<div class="form-group margin-inner">
<label <?php validateField( "status", $missingFields )?>>Status :</label>
<label for="staff">Staff</label>
<input type="radio" name="status" id="staff" value="1" <?php setChecked( "status","1" )?>/>

<label for="faculty">Faculty</label>
<input type="radio" name="status" id="faculty" value="2" <?php setChecked( "status","2" )?> />
</div>

<div class="form-group margin-inner">
<input name="TelephoneNumber" <?php validateField("TelephoneNumber",$missingFields )?> class="input-md form-control" placeholder="Telephone No." type="number" id="TelephoneNumber" value="<?php setValue("TelephoneNumber")?>" />
</div>

<div class="form-group margin-inner">
<input <?php validateField ("Email", $missingFields ) ?> class="form-control input-md" placeholder="E-mail address" type="email" name="Email" id="Email" value="<?php setValue("Email")?>" />
</div>

<div class="form-group margin-inner">
<input <?php validateField("NRC", $missingFields )?> class="form-control input-md" placeholder="NRC   Example : ##/###(N)######" type="text" name="NRC" id="NRC" value="<?php setValue("NRC") ?>" />
</div>

<div class="form-group margin-inner">
<input <?php validateField ("Address", $missingFields ) ?> class="form-control input-md" placeholder="Address" type="text" name="Address" id="Address" value="<?php setValue("Address")?>" />
</div>

<div class="form-group margin-inner">
<textarea name="comments" id="comments" rows="4" cols="50" placeholder="Any Comments?" class="form-control"><?php setValue( "comments" ) ?></textarea>
</div>

<input type="submit" name="submitButton" id="submitButton" value="Register" class="btn btn-info btn-block btn-md margin-inner-button" />
  

<?php 
}
?>

</form>
</div>
</div>
</div>
</div>
</div>



<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src = 'js/bootstrap.js'></script>

</body>
</html>
