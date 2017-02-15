<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Create Faculty</title>
		  <link href='css/bootstrap.css' rel='stylesheet' />
		  <link href='css/Admin_Detail_Button.css' rel= 'stylesheet'>
		<meta name="author" content="AspireV5" />
		<!-- Date: 2015-07-05 -->
		<style type="text/css">
		.input-size{
		width : 10em;
		}
		
		</style>
	</head>
	
<body>
<?php 

					
					function validatedPersonalAdd(){
						if(isset($_POST["personaladd"])){
							
							include 'DBConnection.php';
	
						
							$name = trim($_POST["name"]);
							$gender = trim($_POST["gender"]);
							$marital = trim($_POST["marital"]);
							$department = trim($_POST["department"]);
							$duty = trim($_POST["duty"]);
							$religion = trim($_POST["religion"]);
							$nationality = trim($_POST["nationality"]);
							$nrc = trim($_POST["NRC"]);
							$nativetown = trim($_POST["nativetown"]);
							$dob = trim($_POST["dob"]);
							$weight = trim($_POST["weight"]);
							$remark = trim($_POST["remark"]);
							$phone = trim($_POST["phone"]);
							$email = trim($_POST["email"]);
							$personaladdress = trim($_POST["address"]);
							$city = trim($_POST["city"]);
							$state = trim($_POST["state"]);
							$country = trim($_POST["country"]);
							$feet = trim($_POST["feet"]);
							$inch = trim($_POST["inch"]);
							$hair = trim($_POST["hair"]);
							$skin = trim($_POST["skin"]);
							$eye = trim($_POST["eye"]);
							$status = trim($_POST["status"]);
							$address = trim($_POST["address"]);
							$height =$feet."feet ".$inch."inch";
							$dob = date('Y-m-d',strtotime($dob));
							
							$NRCMatch = preg_match("/^([1|2|3|4|5|6|7|8|9]{1}|[1]{1}[0|1|2|3|4]{1})\/[a-zA-Z]{3,7}\([N]\)[0-9]{6}$/",$nrc);
							if(!$NRCMatch){
								displayForm(array(), "nrcNM");
							}
							else{
							
						$sqlPersonalNRC = "SELECT nrc from staff WHERE nrc=\"$nrc\"";
							$resultsqlPersonalNRC = $conn->query($sqlPersonalNRC);
							
							
						if($resultsqlPersonalNRC->num_rows > 0){
							
							displayForm(array(),"nrc");	
				
							}
						else
						{
							
								$sqlPersonal = "INSERT INTO staff(name,gender,marital_status,duty,religious,nationality,native_town,nrc,date_of_birth,phone,email,city,address,state,country,height,weight,hair_color,eye_color,skin_color,remark,status) VALUES(\"$name\",\"$gender\",\"$marital\",\"$duty\",\"$religion\",\"$nationality\",\"$nativetown\",\"$nrc\",\"$dob\",\"$phone\",\"$email\",\"$city\",\"$address\",\"$state\",
												\"$country\",\"$height\",$weight,\"$hair\",\"$eye\",\"$skin\",\"$remark\",$status);";
							
								$resultsqlPersonal = $conn->query($sqlPersonal);
						 
							  $personalid = $conn->insert_id;

							
						$sqlPersonalUserType = "SELECT user_type_id from user_type WHERE user_type_nrc=\"$nrc\"";
							$resultsqlPersonalUserType = $conn->query($sqlPersonalUserType);
							if($resultsqlPersonalUserType->num_rows >0){
									
								while($row = $resultsqlPersonalUserType->fetch_assoc()){
									 $user_id = $row["user_type_id"];

									//$sqlPersonalID = "INSERT INTO staff(user_type_id) VALUES($user_id) WHERE staff_id=$personalid";
									$sqlPersonalID = "UPDATE staff SET user_type_id=$user_id WHERE staff_id=$personalid;";
									$resultsqlPersonalID = $conn->query($sqlPersonalID);
										}
								
							}
									
							
						$sqlPersonalDepartment = "SELECT department_id from department WHERE department_name=\"$department\"";
							$resultsqlPersonalDepartment = $conn->query($sqlPersonalDepartment);
							
								if($resultsqlPersonalDepartment->num_rows >0){
									
										while($row = $resultsqlPersonalDepartment->fetch_assoc()){
									 			$d_id = $row["department_id"];
												//$sqlDP = "INSERT INTO staff(department_id) VALUES($department_id) WHERE staff_id=$personalid";
												$sqlDP = "UPDATE staff SET department_id=$d_id WHERE staff_id=$personalid;";
												$resultsqlDP = $conn->query($sqlDP);
									
												}
					}
					
					
						if(getimagesize($_FILES['imageUpload']['tmp_name']) == FALSE){
								displayForm(array(), "image");
								}
							else{
							$image = addslashes($_FILES['imageUpload']['tmp_name']);
								$name = addslashes($_FILES['imageUpload']['name']);
								$image = file_get_contents($image);
								$image = base64_encode($image);
								
								$sqlImage = "INSERT INTO image(image_data,image_name) VALUES ('$image','$name')";
								$resultsqlImage = $conn->query($sqlImage);
	
								$imageID = $conn->insert_id;
							
							$sqlDisplayImage = "SELECT * FROM image WHERE image_id=$imageID";
									$resultsqlDisplayImage = $conn->query($sqlDisplayImage);
										if($resultsqlDisplayImage->num_rows > 0){
												while($rowImage = $resultsqlDisplayImage->fetch_assoc()){
													$img =$rowImage["image_data"];
													echo "<div class=\"container\">";
													echo "<br><br><br><br>";
													echo '<img height="200" width="200" src = "data:image;base64,'.$img.'">';
													echo "</div>";
					}
					}
								
						}
					
					
						
						$sqlImageUpload = "UPDATE staff SET image_id=$imageID WHERE staff_id=$personalid";
						$resultsqlImageUpload = $conn->query($sqlImageUpload);

						}
					 displayForm(array(),"");
						}
					}
					
					}		

 if(isset($_POST["personaladd"])){
	
	processPersonal();
	
}
else if(isset($_POST["eduadd"])){
	//displayForm(array(), "education");
	processEducation();
}
else if(isset($_POST["familyadd"])){
	processMembership();
}
else if(isset($_POST["foreignadd"])){
	processForeign();
}
else if(isset($_POST["serviceadd"])){
	processService();
}
else if(isset($_POST["researchadd"])){
	processResearch();
}
else if(isset($_POST["paperadd"])){
	processPaper();
}
else if(isset($_POST["passportadd"])){
	processPassport();
}
else if(isset($_POST["bondadd"])){
	processBond();
}
else if(isset($_POST["leaveadd"])){
	processLeave();
}
else {
	//echo "</br></br></br>";
  displayForm(array(),"");
}


////////////////////////////////////////////////////////////////////  Validation

function validateField( $fieldName, $missingFields ) {
if ( in_array( $fieldName, $missingFields ) ) {
		echo 'has-error';
	
}
}

function setValue( $fieldName ) {

if ( isset( $_POST[$fieldName] ) ) {
echo $_POST[$fieldName];
}
	
if($fieldName == "NRC"){
	if(isset( $_POST[$fieldName] )){
		$nrc = trim($_POST[$fieldName]);
		$NRCMatch = preg_match("/^([1|2|3|4|5|6|7|8|9]{1}|[1]{1}[0|1|2|3|4]{1})\/[a-zA-Z]{3,6}\([N]\)[0-9]{6}$/",$nrc);
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

///////////////////////////////////////////////////////////////////////////////////////////////////////// IMAGE SECTION





///////////////////////////////////////////////////////////////////////////////////////////////////    IMAGE

function processPersonal(){
$requiredFields = array("name","gender","department","duty","religion"
 						,"nationality","NRC","dob","nativetown","phone","email","address","city","state","country","status");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	 validatedPersonalAdd();
  	 
  }
}

function processEducation(){
$requiredFields = array("edugrade","edulocation","edustartdate","eduenddate");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	 displayForm(array(),"education");
  }
}

function processMembership(){
$requiredFields = array("familyname","familyrelationship","familygender","familycitizen","familyrank","familyeducation","familyaddress");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	 displayForm(array(),"family");
  }
}

function processForeign(){
$requiredFields = array("foreigntitle","foreigntype","foreignstartdate","foreignenddate","foreignperiod","foreigncountry","foreignsponsorship");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	 displayForm(array(),"foreign");
  }
}


function processService(){
$requiredFields = array("servicename","servicepayscale","servicestartdate","serviceenddate","serviceheaddepartment","servicesubdepartment","servicedepartment");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	 displayForm(array(),"service");
  }
}

function processResearch(){
$requiredFields = array("researchtitle","researchstartdate","researchenddate","researchstatus","researchtype");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	displayForm(array(),"research");
  }
}

function processPaper(){
$requiredFields = array("papertitle","papertype","paperpublication","papercountry");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	displayForm(array(),"paper");
  }
}



function processPassport(){
$requiredFields = array("passportnumber","passportissuedate","passportexpirydate");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	displayForm(array(),"passport");
  }
}

function processBond(){
$requiredFields = array("bondtitle","bondtype","bondregisterdate","bondperiod","bondamount");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	 displayForm(array(),"bond");
  }
}

function processLeave(){
$requiredFields = array("leavetitle","leavetype","leaveuseddays","leavebalanceddays","leavestartdate","leaveenddate");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields,"");
  } 
  else{
  	 displayForm(array(),"leave");
  }
}


function displayForm($missingFields,$a) {
	
	
	
if ( $a == "image" ) { ?>
  <!-- <h4 class="error_gender" align="center">There were some problems with the form you submitted.</h4>  -->
  	</br></br></br>
	<div class="alert alert-danger alert-dismissable" role="role">Please select an image.<a href="Admin_CreateFaculty.php" data-dismiss="alert" class="close">&times;</a></div>
	</div>
	
	<?php } 
	
	
	if ( $missingFields ) { ?>
  <!-- <h4 class="error_gender" align="center">There were some problems with the form you submitted.</h4>  -->
  	</br></br></br>
	<div class="alert alert-danger">There were some problems with the form you submitted. Please complete the fields highlighted below and resend the form.
	</div>
	
	<?php } if($a=="nrc"){?>
	</br></br></br>
	<div class="alert alert-danger alert-dismissable" role="role">You have already created account for this faculty.<a href="Admin_CreateFaculty.php" data-dismiss="alert" class="close">&times;</a></div>
	<?php }
	if($a=="nrcNM"){?>
	</br></br></br>
	<div class="alert alert-danger alert-dismissable" role="role">The NRC Number is not in a correct format.<a href="Admin_CreateFaculty.php" data-dismiss="alert" class="close">&times;</a></div>
	<?php }?>
		
	
	<div class='navbar navbar-default navbar-fixed-top'>
		<div class='container'>
	
			<a href='/' class='navbar-brand text-left title'>Faculty Management System</a>
			<ul class='nav navbar-nav navbar-right subtitle '>
			
				
				<li><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_HomePage2.php">Main Menu</a></li>
				<li><a href="Logout.php">Sign out</a></li>
			</ul>
		
		</div>
	</div>
	

	
	
	<div class='container'>
		
		<form action="Admin_CreateFaculty.php" method="post" enctype="multipart/form-data" class="form-horizontal">
			
				<div class="form-group">
				</br></br></br></br></br>
				<input type="file" name="imageUpload" /><br/>
				
				
				</div>
			
		

		
		
		<!--          PERSONAL DETAIL                                      -->
		
		<legend><strong>Personal Detail</strong></legend>
	<!-- 	<form action="Admin_CreateFaculty.php" method="post" > 	  -->
			
				<div class = "form-group">
					<div class = 'row'>
						
						<div class= 'col-md-2 text-left <?php validateField("name",$missingFields)?>'>
						<label for = "name" class="control-label">Name</label>
						</div>
						<div class= 'col-md-4 <?php validateField("name",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="name" value="<?php setValue("name")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("phone",$missingFields)?>'>
						<label for = "phone" class="control-label">Phone Number</label>
						</div>
						<div class='col-md-4 <?php validateField("phone",$missingFields)?>'>
						<input type = "number" class="form-control input-sm" name="phone" value="<?php setValue("phone")?>"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left <?php validateField("gender",$missingFields)?>'>
						<label for = "gender" class="control-label">Gender</label>
						</div>
						<div class='col-md-4 <?php validateField("gender",$missingFields)?>'>
						<input type="radio" name="gender" value="Male" <?php setChecked( "gender","Male" )?>/>Male
						<input type="radio" name="gender" value="Female" <?php setChecked( "gender","Female" )?>/>Female
						</div>
						<div class= 'col-md-2 text-right <?php validateField("email",$missingFields)?>'>
						<label for = "email" class="control-label">Email</label>
						</div>
						<div class= 'col-md-4 <?php validateField("email",$missingFields)?>'>
						<input type = "email" class="form-control input-sm" name="email" value="<?php setValue("email")?>"/>
						</div>
					</div>
				
				
			</div>
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "marital" class="control-label">Marital Status</label>
						</div>
						<div class='col-md-4'>
						<input type="radio" name="marital" value="single" <?php setChecked( "marital","single" )?> />Single
						<input type="radio" name="marital" value="married" <?php setChecked( "marital","married" )?>/>Married
						</div>
						<div class= 'col-md-2 text-right <?php validateField("address",$missingFields)?>'>
						<label for = "address" class="control-label">Address</label>
						</div>
						<div class= 'col-md-4 <?php validateField("address",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="address" value="<?php setValue("address")?>"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("department",$missingFields)?>'>
						<label for = "department" class="control-label">Department</label>
						</div>
						<div class='col-md-4 <?php validateField("department",$missingFields)?>'>
						<select name="department" class="form-control">
							<option value="English">English</option>
							<option value="Myanmr">Myanmar</option>
							<option value="Information System">Information System</option>
							<option value="Computational Mathematic">Computational Mathematic</option>
							<option value="Software">Software</option>
							<option value="Hardware">Hardware</option>
							<option value="Physics">Physics</option>
	  					</select>
						</div>
						<div class= 'col-md-2 text-right <?php validateField("city",$missingFields)?>'>
						<label for = "city" class="control-label">City</label>
						</div>
						<div class= 'col-md-4 <?php validateField("city",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="city" value="<?php setValue("city")?>"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("duty",$missingFields)?>'>
						<label for = "duty" class="control-label">Duty</label>
						</div>
						<div class='col-md-4 <?php validateField("duty",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="duty" value="<?php setValue("duty")?>"/>
						</div>
						<div class= 'col-md-2 text-right <?php validateField("state",$missingFields)?>'>
						<label for = "state" class="control-label">State</label>
						</div>
						<div class= 'col-md-4 <?php validateField("state",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="state" value="<?php setValue("state")?>"/>
						</div>
					</div>
				</div>
				
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("religion",$missingFields)?>'>
						<label for = "religion" class="control-label">Religion</label>
						</div>
						<div class='col-md-4 <?php validateField("religion",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="religion" value="<?php setValue("religion")?>"/>
						</div>
						<div class= 'col-md-2 text-right <?php validateField("country",$missingFields)?>'>
						<label for = "country" class="control-label">Country</label>
						</div>
						<div class= 'col-md-4 <?php validateField("country",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="country" value="<?php setValue("country")?>"/>
						</div>
					</div>
				</div>
		
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("nationality",$missingFields)?>'>
						<label for = "nationality" class="control-label">Nationality</label>
						</div>
						<div class='col-md-4 <?php validateField("nationality",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="nationality" value="<?php setValue("nationality")?>"/>
						</div>					
						<div class= 'col-md-1 text-right col-md-offset-1'>
						<label for = "height" class="control-label">Height</label>
						</div>
						
  							<div class="form-group col-md-2">
    						<input type="number" class="form-control input-md col-md-offset-1" name="feet" placeholder="feet" min="1" max="9" value="<?php setValue("feet")?>"/>
  							</div>
  							<div class="form-group col-md-2">
    						<input type="number" class="form-control input-md col-md-offset-2" name="inch" id="text" placeholder="inch" min="0" max="12" value="<?php setValue("inch")?>"/>
  							</div>
  						
						</div>
				</div>
			
		
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("NRC",$missingFields)?>'>
						<label for = "NRC" class="control-label" pattern="/^([1|2|3|4|5|6|7|8|9]{1}|[1]{1}[0|1|2|3|4]{1})\/[a-zA-Z]{3,7}\([N]\)[0-9]{6}$/">NRC</label>
						</div>
						<div class='col-md-4 <?php validateField("NRC",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="NRC" value="<?php setValue("NRC")?>"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "hair" class="control-label">Hair Color</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="hair" value="<?php setValue("hair")?>"/>
						</div>
					</div>
				</div>
		
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("dob",$missingFields)?>'>
						<label for = "dob" class="control-label">Date of Birth</label>
						</div>
						<div class='col-md-4 <?php validateField("dob",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="dob" value="<?php setValue("dob")?>"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "skin" class="control-label">Skin Color</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="skin" value="<?php setValue("skin")?>"/>
						</div>
					</div>
				</div>
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "weight" class="control-label">Weight</label>
						</div>
						<div class='col-md-4'>
						<input type = "number" class="form-control input-sm" name="weight" placeholder="lb" value="<?php setValue("weight")?>"/>
						</div>
						<div class= 'col-md-2 text-right <?php validateField("status",$missingFields)?>'>
						<label for = "status" class="control-label">Status</label>
						</div>
						<div class= 'col-md-4 <?php validateField("city",$missingFields)?>'>
						<input type = "number" class="form-control input-sm" name="status"  min="0" max="1" value="<?php setValue("status")?>"/>
						</div>
					</div>
				</div>
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left <?php validateField("nativetown",$missingFields)?>'>
						<label for = "nativetown" class="control-label">Native Town</label>
						</div>
						<div class='col-md-4 <?php validateField("nativetown",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="nativetown" value="<?php setValue("nativetown")?>" />
						</div>
						</div>
						</div>
						
						
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "eye" class="control-label">Eye Color</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="eye" value="<?php setValue("eye")?>"/>
						</div>
						</div>
						</div>
						
				
			
				<div class = "form-group">
					<div class = 'row'>
						<div class= 'col-md-2 text-left'>
						<label for = "remark" class="control-label">Remark</label>
						</div>
						<div class= 'col-md-4'>
						<textarea rows="7" cols="50" name="remark" class="form-control" value="<?php setValue("remark")?>"></textarea>
						</div>
						
					</div>
				</div>
			
			<div class="form-group">
					<button type="submit" class="btn btn-info center-block" name="personaladd" >Add</button>
				</div>
				
			<br><br>
				
				
				
		<legend><strong>Education Qualification</strong></legend>
		
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("edugrade",$missingFields)?>'>
						<label for = "edugrade" class="control-label">Grade</label>
						</div>
						<div class='col-md-4 <?php validateField("edugrade",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="edugrade" value="<?php setValue("edugrade")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("edulocation",$missingFields)?>'>
						<label for = "edulocation" class="control-label">Location</label>
						</div>
						<div class='col-md-4 <?php validateField("edulocation",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="edulocation" value="<?php setValue("edulocation")?>"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("edustartdate",$missingFields)?>'>
						<label for = "edustartdate" class="control-label">Start Date</label>
						</div>
						<div class='col-md-4 <?php validateField("edustartdate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="edustartdate" value="<?php setValue("edustartdate")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("eduenddate",$missingFields)?>'>
						<label for = "eduenddate" class="control-label">End Date</label>
						</div>
						<div class='col-md-4 <?php validateField("eduenddate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="eduenddate" value="<?php setValue("eduenddate")?>"/>
						</div>
					</div>
				</div>
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="eduadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Grade</strong></td>
							<td class="bg-info tb-header-bg"><strong>Start Date</strong></td> 
							<td class="bg-info tb-header-bg"><strong>End Date</strong></td>
							<td class="bg-info tb-header-bg"><strong>Location</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
						</tr>
					</thead>
					<tbody>
					<?php 
					
			if($a=="education"){
						if(isset($_POST["eduadd"])){
							
							include 'DBConnection.php';
							$edugrade = trim($_POST["edugrade"]);
							$edustartdate = trim($_POST["edustartdate"]);
							$eduenddate = trim($_POST["eduenddate"]);
							$edulocation = trim($_POST["edulocation"]);
							
							$edustartdate = date('Y-m-d',strtotime($edustartdate));
							$eduenddate = date('Y-m-d',strtotime($eduenddate));
							
							
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							
							
							$sqlEdu = "INSERT INTO education(grade,start_date,end_date,location,staff_id)
									  VALUES(\"$edugrade\",\"$edustartdate\",\"$eduenddate\",\"$edulocation\",$lastID);";
							$resultsqlEdu = $conn->query($sqlEdu);
						
						$sqlEduSelect = "SELECT edu_id,grade,start_date,end_date,location FROM education WHERE staff_id=$lastID;";
						$resultsqlEduSelect = $conn->query($sqlEduSelect);
						
						if($resultsqlEduSelect->num_rows>0){
									
							while($row = $resultsqlEduSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["grade"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									echo "<td>".$row["location"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?edudelete=<?php echo $row["edu_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="eduDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
			}
					
						if(isset($_GET["edudelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["edudelete"];
							$sqlEduDelete = "DELETE FROM education WHERE edu_id=$id";
							$resultsqlEduDelete = $conn->query($sqlEduDelete);
							
						$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
						
						$sqlEduSelect = "SELECT edu_id,grade,start_date,end_date,location FROM education WHERE staff_id=$lastID;";
						$resultsqlEduSelect = $conn->query($sqlEduSelect);
						
						if($resultsqlEduSelect->num_rows>0){
									
							while($row = $resultsqlEduSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["grade"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									echo "<td>".$row["location"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?edudelete=<?php echo $row["edu_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="eduDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
			 
					
					?>
					
					</tbody>
				</table>
			</div>
		</div>
		</form>		
		<br><br>
<!-- 										MEMBERSHIP (FAMILY)														 -->		
		<legend><strong>Membership(Family)</strong></legend>
		<form action ="Admin_CreateFaculty.php" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("familyname",$missingFields)?>'>
						<label for = "familyname" class="control-label">Name</label>
						</div>
						<div class='col-md-4 <?php validateField("familyname",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="familyname" value="<?php setValue("familyname")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("familyrelationship",$missingFields)?>'>
						<label for = "familyrelationship" class="control-label">Relationship</label>
						</div>
						<div class='col-md-4 <?php validateField("familyrelationship",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="familyrelationship" value="<?php setValue("familyrelationship")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("familygender",$missingFields)?>'>
						<label for = "familygender" class="control-label">Gender</label>
						</div>
						<div class='col-md-4 <?php validateField("familygender",$missingFields)?>'>
						<label for="familygender">Male</label>
						<input type="radio" name="familygender" value="Male" <?php setChecked( "familygender","Male" )?> >
						<label for="familygender">Female</label>
						<input type="radio" name="familygender" value="Female" <?php setChecked( "familygender","Female" )?>>
						</div>
						<div class='col-md-2 text-right <?php validateField("familycitizen",$missingFields)?>'>
						<label for = "familycitizen" class="control-label">Citizen</label>
						</div>
						<div class='col-md-4 <?php validateField("familycitizen",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="familycitizen" value="<?php setValue("familycitizen")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("familyrank",$missingFields)?>'>
						<label for = "familyrank" class="control-label">Rank</label>
						</div>
						<div class='col-md-4 <?php validateField("familyrank",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="familyrank" value="<?php setValue("familyrank")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("familyeducation",$missingFields)?>'>
						<label for = "familyeducation" class="control-label">Background Education</label>
						</div>
						<div class='col-md-4 <?php validateField("familyeducation",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="familyeducation" value="<?php setValue("familyeducation")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("familyaddress",$missingFields)?>'>
						<label for = "familyaddress" class="control-label">Address</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="familyaddress" value="<?php setValue("familyaddress")?>"/>
						</div>
						
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="familyadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Name</strong></td>
							<td class="bg-info tb-header-bg"><strong>Relationship</strong></td> 
							<td class="bg-info tb-header-bg"><strong>Gender</strong></td>
							<td class="bg-info tb-header-bg"><strong>Citizen</strong></td>
							<td class="bg-info tb-header-bg"><strong>Rank</strong></td>
							<td class="bg-info tb-header-bg"><strong>Background Education</strong></td>
							<td class="bg-info tb-header-bg"><strong>Address</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
						</tr>
					</thead>
					<tbody>
					<?php 
				
					if($a == "family"){
					if(isset($_POST["familyadd"])){
						
						include 'DBConnection.php';
						
						$name = trim($_POST["familyname"]);
						$relationship = trim($_POST["familyrelationship"]);
						$gender = trim($_POST["familygender"]);
						$citizen = trim($_POST["familycitizen"]);
						$rank = trim($_POST["familyrank"]);
						$background_education = trim($_POST["familyeducation"]);
						$address = trim($_POST["familyaddress"]);
						
							
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
						
						$sqlFamily = "INSERT INTO membership(name,relationship,gender,citizen,rank,background_edu,address,staff_id)
									  VALUES(\"$name\",\"$relationship\",\"$gender\",\"$citizen\",\"$rank\",\"$background_education\",\"$address\",$lastID);";
						$resultsqlFamily = $conn->query($sqlFamily);
						
						$sqlFamilyAdd = "SELECT membership_id,name,relationship,gender,citizen,rank,background_edu,address FROM membership WHERE staff_id=$lastID;";
						$resultsqlFamilyAdd = $conn->query($sqlFamilyAdd);
						
						if($resultsqlFamilyAdd->num_rows>0){
									
							while($row = $resultsqlFamilyAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["name"]."</td>";
									echo "<td>".$row["relationship"]."</td>";
									echo "<td>".$row["gender"]."</td>";
									echo "<td>".$row["citizen"]."</td>";
									echo "<td>".$row["rank"]."</td>";
									echo "<td>".$row["background_edu"]."</td>";
									echo "<td>".$row["address"]."</td>";
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?familydelete=<?php echo $row["membership_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="familyDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					}
					
						if(isset($_GET["familydelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["familydelete"];
							$sqlfamilyDelete = "DELETE FROM membership WHERE membership_id=$id";
							$resultsqlfamilyDelete = $conn->query($sqlfamilyDelete);
							
						
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							$sqlFamilyAdd = "SELECT membership_id,name,relationship,gender,citizen,rank,background_edu,address FROM membership WHERE staff_id=$lastID;";
							$resultsqlFamilyAdd = $conn->query($sqlFamilyAdd);
							
							if($resultsqlFamilyAdd->num_rows>0){
									
							while($row = $resultsqlFamilyAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["name"]."</td>";
									echo "<td>".$row["relationship"]."</td>";
									echo "<td>".$row["gender"]."</td>";
									echo "<td>".$row["citizen"]."</td>";
									echo "<td>".$row["rank"]."</td>";
									echo "<td>".$row["background_edu"]."</td>";
									echo "<td>".$row["address"]."</td>";
								?>
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?familydelete=<?php echo $row["membership_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="familyDelete">Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
					
					
					?>
					
					
			</tbody>
				</table>
			</div>
		</div>
		</form>		
		<br><br>
		
		<legend><strong>Foreign Status</strong></legend>
		<form action ="" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("foreigntitle",$missingFields)?>'>
						<label for = "foreigntitle" class="control-label" >Title</label>
						</div>
						<div class='col-md-4 <?php validateField("foreigntitle",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="foreigntitle" value="<?php setValue("foreigntitle")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("foreigntype",$missingFields)?>'>
						<label for = "foreigntype" class="control-label">Type</label>
						</div>
						<div class='col-md-4 <?php validateField("foreigntype",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="foreigntype" value="<?php setValue("foreigntype")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("foreignstartdate",$missingFields)?>'>
						<label for = "foreignstartdate" class="control-label">Start Date</label>
						</div>
						<div class='col-md-4 <?php validateField("foreignstartdate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="foreignstartdate" value="<?php setValue("foreignstartdate")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("foreignenddate",$missingFields)?>'>
						<label for = "foreignenddate" class="control-label">End Date</label>
						</div>
						<div class='col-md-4 <?php validateField("foreignenddate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="foreignenddate" value="<?php setValue("foreignenddate")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("foreignperiod",$missingFields)?>'>
						<label for = "foreignperiod" class="control-label">Period</label>
						</div>
						<div class='col-md-4 <?php validateField("foreignperiod",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="foreignperiod" value="<?php setValue("foreignperiod")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("foreigncountry",$missingFields)?>'>
						<label for = "foreigncountry" class="control-label">Country</label>
						</div>
						<div class='col-md-4 <?php validateField("foreigncountry",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="foreigncountry" value="<?php setValue("foreigncountry")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("foreignsponsorship",$missingFields)?>'>
						<label for = "foreignsponsorship" class="control-label">Sponsorship</label>
						</div>
						<div class='col-md-4 <?php validateField("foreignsponsorship",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="foreignsponsorship" value="<?php setValue("foreignsponsorship")?>"/>
						</div>
						<div class='col-md-2 text-right '>
						<label for = "foreignamt" class="control-label">Currency Amount</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="foreignamt" value="<?php setValue("foreignamt")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="foreignadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Title</strong></td>
							<td class="bg-info tb-header-bg"><strong>Start Date</strong></td> 
							<td class="bg-info tb-header-bg"><strong>End Date</strong></td>
							<td class="bg-info tb-header-bg"><strong>Period</strong></td>
							<td class="bg-info tb-header-bg"><strong>Country</strong></td>
							<td class="bg-info tb-header-bg"><strong>Sponsorship</strong></td>
							<td class="bg-info tb-header-bg"><strong>Currency Amount</strong></td>
							<td class="bg-info tb-header-bg"><strong>Type</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
						</tr>
					</thead>
					<tbody>
					<?php 
					
						if($a == "foreign"){
						if(isset($_POST["foreignadd"])){
							include 'DBConnection.php';
							
							$foreigntitle = trim($_POST["foreigntitle"]);
							$foreignstartdate = trim($_POST["foreignstartdate"]);
							$foreignenddate = trim($_POST["foreignenddate"]);
							$foreignperiod = trim($_POST["foreignperiod"]);
							$foreigncountry = trim($_POST["foreigncountry"]);
							$foreignsponsorship = trim($_POST["foreignsponsorship"]);
							$foreignamt = trim($_POST["foreignamt"]);
							$foreigntype = trim($_POST["foreigntype"]);
							
							
							$foreignstartdate = date('Y-m-d',strtotime($foreignstartdate));
							$foreignenddate = date('Y-m-d',strtotime($foreignenddate));
							
							$lastID = 0;
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							$sqlForeign = "INSERT INTO foreign_status(title,start_date,end_date,country,sponsorship,currency_amount,type,period,staff_id)
									  VALUES(\"$foreigntitle\",\"$foreignstartdate\",\"$foreignenddate\",\"$foreigncountry\",\"$foreignsponsorship\",\"$foreignamt\",\"$foreigntype\",\"$foreignperiod\",$lastID);";
							$resultsqlForeign = $conn->query($sqlForeign);
						
						$sqlForeignSelect = "SELECT foreign_id,title,start_date,end_date,country,sponsorship,currency_amount,type,period FROM foreign_status WHERE staff_id=$lastID;";
						$resultsqlForeignSelect = $conn->query($sqlForeignSelect);
						
						if($resultsqlForeignSelect->num_rows>0){
									
							while($row = $resultsqlForeignSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["title"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									echo "<td>".$row["period"]."</td>";
									echo "<td>".$row["country"]."</td>";
									echo "<td>".$row["sponsorship"]."</td>";
									echo "<td>".$row["currency_amount"]."</td>";
									echo "<td>".$row["type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?foreigndelete=<?php echo $row["foreign_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="foreignDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
						}
					
						if(isset($_GET["foreigndelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["foreigndelete"];
							$sqlForeignDelete = "DELETE FROM foreign_status WHERE foreign_id=$id";
							$resultsqlForeignDelete = $conn->query($sqlForeignDelete);
							
						
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
						
						$sqlForeignSelect = "SELECT foreign_id,title,start_date,end_date,country,sponsorship,currency_amount,type,period FROM foreign_status WHERE staff_id=$lastID;";
						$resultsqlForeignSelect = $conn->query($sqlForeignSelect);
						
						if($resultsqlForeignSelect->num_rows>0){
									
							while($row = $resultsqlForeignSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["title"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									echo "<td>".$row["period"]."</td>";
									echo "<td>".$row["country"]."</td>";
									echo "<td>".$row["sponsorship"]."</td>";
									echo "<td>".$row["currency_amount"]."</td>";
									echo "<td>".$row["type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?foreigndelete=<?php echo $row["foreign_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="foreignDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
					
					
					?>
					
					</tbody>
				</table>
			</div>
		</div>
		</form>	
		<br><br>
		
		
			<legend><strong>Service Record</strong></legend>
		<form action ="" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("servicename",$missingFields)?>'>
						<label for = "servicename" class="control-label">Rank Name</label>
						</div>
						<div class='col-md-4 <?php validateField("servicename",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="servicename" value="<?php setValue("servicename")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("servicepayscale",$missingFields)?>'>
						<label for = "servicepayscale" class="control-label">Pay Scale</label>
						</div>
						<div class='col-md-4 <?php validateField("servicepayscale",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="servicepayscale" value="<?php setValue("servicepayscale")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("servicestartdate",$missingFields)?>'>
						<label for = "servicestartdate" class="control-label">Start Date</label>
						</div>
						<div class='col-md-4 <?php validateField("servicestartdate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="servicestartdate" value="<?php setValue("servicestartdate")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("serviceenddate",$missingFields)?>'>
						<label for = "serviceenddate" class="control-label">End Date</label>
						</div>
						<div class='col-md-4 <?php validateField("serviceenddate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="serviceenddate" value="<?php setValue("serviceenddate")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("serviceheaddepartment",$missingFields)?>'>
						<label for = "serviceheaddepartment" class="control-label">Head Department</label>
						</div>
						<div class='col-md-4 <?php validateField("serviceheaddepartment",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="serviceheaddepartment" value="<?php setValue("serviceheaddepartment")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("servicesubdepartment",$missingFields)?>'>
						<label for = "servicesubdepartment" class="control-label">Sub Department</label>
						</div>
						<div class='col-md-4 <?php validateField("servicesubdepartment",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="servicesubdepartment" value="<?php setValue("servicesubdepartment")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("servicedepartment",$missingFields)?>'>
						<label for = "servicedepartment" class="control-label">Department</label>
						</div>
						<div class='col-md-4 <?php validateField("servicedepartment",$missingFields)?>'>
						<select name="servicedepartment">
							<option value="english" selected="selected">English</option>
							<option value="myanmr">Myanmar</option>
							<option value="informationsystem">Information System</option>
							<option value="computationalmathematic">Computational Mathematic</option>
							<option value="software">Software</option>
							<option value="hardware">Hardware</option>
							<option value="physics">Physics</option>
	  					</select>
	  					</div>
						<div class='col-md-2 text-right'>
						<label for = "serviceremark" class="control-label">Remark</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="serviceremark" value="<?php setValue("serviceremark")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="serviceadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Rank Name</strong></td>
							<td class="bg-info tb-header-bg"><strong>Pay Scale</strong></td>
							<td class="bg-info tb-header-bg"><strong>Start Date</strong></td> 
							<td class="bg-info tb-header-bg"><strong>End Date</strong></td>
							<td class="bg-info tb-header-bg"><strong>Head Department</strong></td>
							<td class="bg-info tb-header-bg"><strong>Sub Department</strong></td>
							<td class="bg-info tb-header-bg"><strong>Department</strong></td>
							<td class="bg-info tb-header-bg"><strong>Remark</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
							
						</tr>
					</thead>
					<tbody>
					<?php 
						if($a=="service"){
						if(isset($_POST["serviceadd"])){
							include 'DBConnection.php';
							
							$servicename = trim($_POST["servicename"]);
							$servicepayscale = trim($_POST["servicepayscale"]);
							$servicestartdate = trim($_POST["servicestartdate"]);
							$serviceenddate = trim($_POST["serviceenddate"]);
							$serviceheaddepartment = trim($_POST["serviceheaddepartment"]);
							$servicesubdepartment = trim($_POST["servicesubdepartment"]);
							$servicedepartment = trim($_POST["servicedepartment"]);
							$serviceremark = trim($_POST["serviceremark"]);
							
							
							
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							$department_id = 0;
							$sqlServiceDepartment = "SELECT department_id from department WHERE department_name=\"$servicedepartment\"";
							$resultsqlServiceDepartment = $conn->query($sqlServiceDepartment);
							if($resultsqlServiceDepartment->num_rows >0){
									
								while($rowD = $resultsqlServiceDepartment->fetch_assoc()){
									 $department_id = $rowD["department_id"];
									$GLOBALS['department_id'] = $rowD["department_id"];
										}
								
							}
							$servicestartdate = date('Y-m-d',strtotime($servicestartdate));
							$serviceenddate = date('Y-m-d',strtotime($serviceenddate));
							
							$sqlRank = "INSERT INTO rank(rank_scale,rank_name) VALUES(\"$servicepayscale\",\"$servicename\");";
							$resultsqlRank = $conn->query($sqlRank);
							
							$fk_rank = $conn->insert_id;
							
							$sqlServiceRecord = "INSERT INTO service_record(start_date,end_date,head_department,sub_department,remark,department_id,staff_id)
												 VALUES(\"$servicestartdate\",\"$serviceenddate\",\"$serviceheaddepartment\",\"$servicesubdepartment\",\"$serviceremark\",$department_id,$lastID);";
							
							$resultsqlServiceRecord =  $conn->query($sqlServiceRecord);
							
							
							
							$fk_service_record = $conn->insert_id;
							
							$sqlServiceRank = "INSERT INTO service_rank VALUES($fk_service_record,$fk_rank);";
							$resultsqlServiceRank = $conn->query($sqlServiceRank);
							
							$sqlSelect = "SELECT DISTINCT r.rank_id,s.s_id,r.rank_name,r.rank_scale,s.start_date,s.end_date,s.head_department,s.sub_department,s.remark,s.department_id FROM service_record s, rank r, service_rank a
										  WHERE s.s_id=a.s_id AND r.rank_id = a.rank_id AND s.staff_id=$lastID";
							$resultsqlSelect = $conn->query($sqlSelect);
						
							if($resultsqlSelect->num_rows>0){
									
							while($row = $resultsqlSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["rank_name"]."</td>";
									echo "<td>".$row["rank_scale"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									echo "<td>".$row["head_department"]."</td>";
									echo "<td>".$row["sub_department"]."</td>";
									echo "<td>".$row["department_id"]."</td>";
									echo "<td>".$row["remark"]."</td>";
									
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?servicedelete1=<?php echo $row["s_id"]?>&rankdelete2=<?php echo $row["rank_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="serviceDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
						}
					
					
						if((isset($_GET["servicedelete1"])) && (isset($_GET["rankdelete2"])) ){
							
							
							include 'DBConnection.php';
								
							$sid1 = (int)$_GET["servicedelete1"];
							$rid2 = (int)$_GET["rankdelete2"];
							
							
							$sqlServiceRankDelete = "DELETE FROM service_rank WHERE s_id=$sid1 AND rank_id=$rid2";
							$resultsqlServiceRankDelete = $conn->query($sqlServiceRankDelete);
							
							$sqlServiceRecordDelete = "DELETE FROM service_record WHERE s_id=$sid1";
							$resultsqlServiceRecordDelete = $conn->query($sqlServiceRecordDelete);
							
							$sqlRankDelete= "DELETE FROM rank WHERE rank_id=$rid2";
							$resultsqlRankDelete = $conn->query($sqlRankDelete);
							
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
						
						$sqlSelect = "SELECT DISTINCT r.rank_name,r.rank_scale,s.start_date,s.end_date,s.head_department,s.sub_department,s.remark,s.department_id FROM service_record s, rank r, service_rank a
										  WHERE s.s_id=a.s_id AND r.rank_id = a.rank_id AND s.staff_id=$lastID";
							$resultsqlSelect = $conn->query($sqlSelect);
						
							if($resultsqlSelect->num_rows>0){
									
							while($row = $resultsqlSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["rank_name"]."</td>";
									echo "<td>".$row["rank_scale"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									echo "<td>".$row["head_department"]."</td>";
									echo "<td>".$row["sub_department"]."</td>";
									echo "<td>".$row["department_id"]."</td>";
									echo "<td>".$row["remark"]."</td>";
									
						
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?servicedelete1=<?php echo $row["s_id"]?>&rankdelete2=<?php echo $row["rank_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="serviceDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
				
					
					?>
					
					
					</tbody>
				</table>
			</div>
		</div>
		</form>	
		
			<legend><strong>Research</strong></legend>
		<form action ="" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("researchtitle",$missingFields)?>'>
						<label for = "researchtitle" class="control-label">Research Title</label>
						</div>
						<div class='col-md-4 <?php validateField("researchtitle",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="researchtitle" value="<?php setValue("researchtitle")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("researchstartdate",$missingFields)?>'>
						<label for = "researchstartdate" class="control-label">Start Date</label>
						</div>
						<div class='col-md-4 <?php validateField("researchstartdate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="researchstartdate" value="<?php setValue("researchstartdate")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("researchenddate",$missingFields)?>'>
						<label for = "researchenddate" class="control-label">End Date</label>
						</div>
						<div class='col-md-4 <?php validateField("researchenddate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="researchenddate" value="<?php setValue("researchenddate")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("researchstatus",$missingFields)?>'>
						<label for = "researchstatus" class="control-label">Research Status</label>
						</div>
						<div class='col-md-4 <?php validateField("researchstatus",$missingFields)?>'>
						<input type = "number" class="form-control input-sm" name="researchstatus" min="0" max="1" value="<?php setValue("researchstatus")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("researchtype",$missingFields)?>'>
						<label for = "researchtype" class="control-label">Research Type</label>
						</div>
						<div class='col-md-4 <?php validateField("researchtype",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="researchtype" value="<?php setValue("researchtype")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="researchadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Research Title</strong></td>
							<td class="bg-info tb-header-bg"><strong>Start Date</strong></td> 
							<td class="bg-info tb-header-bg"><strong>End Date</strong></td>
							<td class="bg-info tb-header-bg"><strong>Research Status</strong></td>
							<td class="bg-info tb-header-bg"><strong>Research Type</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						if($a == "research"){
						
						if(isset($_POST["researchadd"])){
							include 'DBConnection.php';
							
							$researchtitle = trim($_POST["researchtitle"]);
							$researchstartdate = trim($_POST["researchstartdate"]);
							$researchenddate = trim($_POST["researchenddate"]);
							$researchstatus = trim($_POST["researchstatus"]);
							$researchtype = trim($_POST["researchtype"]);
							
							
							$researchstartdate = date('Y-m-d',strtotime($researchstartdate));
							$researchenddate = date('Y-m-d',strtotime($researchenddate));
							
							$lastID = 0;
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							$sqlResearch = "INSERT INTO research(research_title,start_date,end_date,research_status,research_type,staff_id)
									  VALUES(\"$researchtitle\",\"$researchstartdate\",\"$researchenddate\",\"$researchstatus\",\"$researchtype\",$lastID);";
							$resultsqlResearch = $conn->query($sqlResearch);
						
						$sqlResearchSelect = "SELECT research_id,research_title,start_date,end_date,research_status,research_type FROM research WHERE staff_id=$lastID;";
						$resultsqlResearchSelect = $conn->query($sqlResearchSelect);
						
						if($resultsqlResearchSelect->num_rows>0){
									
							while($row = $resultsqlResearchSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["research_title"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									echo "<td>".$row["research_status"]."</td>";
									echo "<td>".$row["research_type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?researchdelete=<?php echo $row["research_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="researchDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
						}
						
						if(isset($_GET["researchdelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["researchdelete"];
							$sqlResearchDelete = "DELETE FROM research WHERE research_id=$id";
							$resultsqlResearchDelete = $conn->query($sqlResearchDelete);
							
						$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
						
						$sqlResearchSelect = "SELECT research_id,research_title,start_date,end_date,research_status,research_type FROM research WHERE staff_id=$lastID;";
						$resultsqlResearchSelect = $conn->query($sqlResearchSelect);
						
						if($resultsqlResearchSelect->num_rows>0){
									
							while($row = $resultsqlResearchSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["research_title"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									echo "<td>".$row["research_status"]."</td>";
									echo "<td>".$row["research_type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?researchdelete=<?php echo $row["research_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="researchDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
						
					?>
					
					</tbody>
				</table>
			</div>
		</div>
		</form>	
		<br><br>
		
		<legend><strong>Accepted Paper</strong></legend>
		<form action ="" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("papertitle",$missingFields)?>'>
						<label for = "papertitle" class="control-label">Paper Title</label>
						</div>
						<div class='col-md-4 <?php validateField("papertitle",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="papertitle" value="<?php setValue("papertitle")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("papertype",$missingFields)?>'>
						<label for = "papertype" class="control-label">Paper Type</label>
						</div>
						<div class='col-md-4 <?php validateField("papertype",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="papertype" value="<?php setValue("papertype")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("paperpublication",$missingFields)?>'>
						<label for = "paperpublication" class="control-label">Publication</label>
						</div>
						<div class='col-md-4 <?php validateField("paperpublication",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="paperpublication" value="<?php setValue("paperpublication")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("papercountry",$missingFields)?>'>
						<label for = "papercountry" class="control-label">Country</label>
						</div>
						<div class='col-md-4 <?php validateField("papercountry",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="papercountry" value="<?php setValue("papercountry")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="paperadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Paper Title</strong></td>
							<td class="bg-info tb-header-bg"><strong>Paper Type</strong></td>
							<td class="bg-info tb-header-bg"><strong>Publication</strong></td> 
							<td class="bg-info tb-header-bg"><strong>Country</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
							
						</tr>
					</thead>
					<tbody>
						<?php 
				
						if($a == "paper"){
					if(isset($_POST["paperadd"])){
						
						include 'DBConnection.php';
						
						$papertitle = trim($_POST["papertitle"]);
						$papertype = trim($_POST["papertype"]);
						$paperpublication = trim($_POST["paperpublication"]);
						$papercountry = trim($_POST["papercountry"]);
						
						
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
						
						$sqlPaper = "INSERT INTO accepted_paper(paper_title,paper_type,publication,country,staff_id)
									  VALUES(\"$papertitle\",\"$papertype\",\"$paperpublication\",\"$papercountry\",$lastID);";
						$resultsqlPaper = $conn->query($sqlPaper);
						
						$sqlPaperSelect = "SELECT paper_id,paper_title,paper_type,publication,country FROM accepted_paper WHREE staff_id=$lastID;";
						$resultsqlPaperSelect = $conn->query($sqlPaperSelect);
						
						if($resultsqlPaperSelect->num_rows>0){
									
							while($row = $resultsqlPaperSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["paper_title"]."</td>";
									echo "<td>".$row["paper_type"]."</td>";
									echo "<td>".$row["publication"]."</td>";
									echo "<td>".$row["country"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?paperdelete=<?php echo $row["paper_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="familyDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
						}
					
						if(isset($_GET["paperdelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["paperdelete"];
							$sqlfamilyDelete = "DELETE FROM accepted_paper WHERE paper_id=$id";
							$resultsqlPaperDelete = $conn->query($sqlfamilyDelete);
							
						$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
						$sqlPaperSelect = "SELECT paper_id,paper_title,paper_type,publication,country FROM accepted_paper WHERE staff_id=$lastID;";
						$resultsqlPaperSelect = $conn->query($sqlPaperSelect);
						
						if($resultsqlPaperSelect->num_rows>0){
									
							while($row = $resultsqlPaperSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["paper_title"]."</td>";
									echo "<td>".$row["paper_type"]."</td>";
									echo "<td>".$row["publication"]."</td>";
									echo "<td>".$row["country"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?paperdelete=<?php echo $row["paper_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="familyDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
						
					?>
					
					</tbody>
				</table>
			</div>
		</div>
		</form>	
		<br><br>
		
		<legend><strong>Passport</strong></legend>
		<form action ="" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("passportnumber",$missingFields)?>'>
						<label for = "passportnumber" class="control-label">Passport Number</label>
						</div>
						<div class='col-md-4 <?php validateField("passportnumber",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="passportnumber" value="<?php setValue("passportnumber")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("passportissuedate",$missingFields)?>'>
						<label for = "passportissuedate" class="control-label">Issue Date</label>
						</div>
						<div class='col-md-4 <?php validateField("passportissuedate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="passportissuedate" value="<?php setValue("passportissuedate")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("passportexpirydate",$missingFields)?>'>
						<label for = "passportexpirydate" class="control-label">Expiry Date</label>
						</div>
						<div class='col-md-4 <?php validateField("passportexpirydate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="passportexpirydate" value="<?php setValue("passportexpirydate")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="passportadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Passport Number</strong></td>
							<td class="bg-info tb-header-bg"><strong>Issue Date</strong></td> 
							<td class="bg-info tb-header-bg"><strong>Expiry Date</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
							
						</tr>
					</thead>
					<tbody>
					<?php 
						if($a == "passport"){
						if(isset($_POST["passportadd"])){
							include 'DBConnection.php';
							
							$passportnumber = trim($_POST["passportnumber"]);
							$passportissuedate = trim($_POST["passportissuedate"]);
							$passportexpirydate = trim($_POST["passportexpirydate"]);
							
							
							
							$passportissuedate = date('Y-m-d',strtotime($passportissuedate));
							$passportexpirydate = date('Y-m-d',strtotime($passportexpirydate));
							
							
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							$sqlPassport = "INSERT INTO passport(pp_number,issue_date,expiry_date,staff_id)
									  VALUES(\"$passportnumber\",\"$passportissuedate\",\"$passportexpirydate\",$lastID);";
							$resultsqlPassport = $conn->query($sqlPassport);
						
						$sqlPassportSelect = "SELECT pp_id,pp_number,issue_date,expiry_date FROM passport WHERE staff_id=$lastID;";
						$resultsqlPassportSelect = $conn->query($sqlPassportSelect);
						
						if($resultsqlPassportSelect->num_rows>0){
									
							while($row = $resultsqlPassportSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["pp_number"]."</td>";
									echo "<td>".$row["issue_date"]."</td>";
									echo "<td>".$row["expiry_date"]."</td>";
								
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?ppdelete=<?php echo $row["pp_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="ppDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
						}
					
						if(isset($_GET["ppdelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["ppdelete"];
							$sqlPassportDelete = "DELETE FROM passport WHERE pp_id=$id";
							$resultsqlPassportDelete = $conn->query($sqlPassportDelete);
							
						$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
						$sqlPassportSelect = "SELECT pp_id,pp_number,issue_date,expiry_date FROM passport WHERE staff_id=$lastID;";
						$resultsqlPassportSelect = $conn->query($sqlPassportSelect);
						
						if($resultsqlPassportSelect->num_rows>0){
									
							while($row = $resultsqlPassportSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["pp_number"]."</td>";
									echo "<td>".$row["issue_date"]."</td>";
									echo "<td>".$row["expiry_date"]."</td>";
								
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?ppdelete=<?php echo $row["pp_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="ppDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
					
					
					?>
					
					
					</tbody>
				</table>
			</div>
		</div>
		</form>	
		<br><br>
		
		<legend><strong>Bond</strong></legend>
		<form action ="" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("bondtitle",$missingFields)?>'>
						<label for = "bondtitle" class="control-label">Title</label>
						</div>
						<div class='col-md-4 <?php validateField("bondtitle",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="bondtitle" value="<?php setValue("bondtitle")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("bondtype",$missingFields)?>'>
						<label for = "bondtype" class="control-label">Type</label>
						</div>
						<div class='col-md-4 <?php validateField("bondtype",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="bondtype" value="<?php setValue("bondtype")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("bondregisterdate",$missingFields)?>'>
						<label for = "bondregisterdate" class="control-label">Register Date</label>
						</div>
						<div class='col-md-4 <?php validateField("bondregisterdate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="bondregisterdate" value="<?php setValue("bondregisterdate")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("bondperiod",$missingFields)?>'>
						<label for = "bondperiod" class="control-label">Period</label>
						</div>
						<div class='col-md-4 <?php validateField("bondperiod",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="bondperiod" value="<?php setValue("bondperiod")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("bondamount",$missingFields)?>'>
						<label for = "bondamount" class="control-label">Amount</label>
						</div>
						<div class='col-md-4 <?php validateField("bondamount",$missingFields)?>'>
						<input type = "number" class="form-control input-sm" name="bondamount" value="<?php setValue("bondamount")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="bondadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Title</strong></td>
							<td class="bg-info tb-header-bg"><strong>Type</strong></td> 
							<td class="bg-info tb-header-bg"><strong>Register Date</strong></td>
							<td class="bg-info tb-header-bg"><strong>Period</strong></td>
							<td class="bg-info tb-header-bg"><strong>Amount</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
						</tr>
					</thead>
					<tbody>
					<?php 
					if($a == "bond"){
						if(isset($_POST["bondadd"])){
							include 'DBConnection.php';
							
							$bondtitle = trim($_POST["bondtitle"]);
							$bondtype = trim($_POST["bondtype"]);
							$bondperiod = trim($_POST["bondperiod"]);
							$bondregisterdate = trim($_POST["bondregisterdate"]);
							$bondamount = trim($_POST["bondamount"]);
						
							
							
							$bondregisterdate = date('Y-m-d',strtotime($bondregisterdate));
							
							$lastID = 0;
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							$sqlBond = "INSERT INTO bond(bond_title,bond_type,register_date,period,amount,staff_id)
									  VALUES(\"$bondtitle\",\"$bondtype\",\"$bondregisterdate\",\"$bondperiod\",\"$bondamount\",$lastID);";
							$resultsqlBond = $conn->query($sqlBond);
						
						$sqlBondSelect = "SELECT bond_id,bond_title,bond_type,register_date,period,amount FROM bond WHERE staff_id=$lastID;";
						$resultsqlBondSelect = $conn->query($sqlBondSelect);
						
						if($resultsqlBondSelect->num_rows>0){
									
							while($row = $resultsqlBondSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["bond_title"]."</td>";
									echo "<td>".$row["bond_type"]."</td>";
									echo "<td>".$row["register_date"]."</td>";
									echo "<td>".$row["period"]."</td>";
									echo "<td>".$row["amount"]."</td>";
									
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?bonddelete=<?php echo $row["bond_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="bondDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					}
					
						if(isset($_GET["bonddelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["bonddelete"];
							$sqlBondDelete = "DELETE FROM bond WHERE bond_id=$id";
							$resultsqlBondDelete = $conn->query($sqlBondDelete);
							
						$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
						
						$sqlBondSelect = "SELECT bond_id,bond_title,bond_type,register_date,period,amount FROM bond WHERE staff_id=$lastID;";
						$resultsqlBondSelect = $conn->query($sqlBondSelect);
						
						if($resultsqlBondSelect->num_rows>0){
									
							while($row = $resultsqlBondSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["bond_title"]."</td>";
									echo "<td>".$row["bond_type"]."</td>";
									echo "<td>".$row["register_date"]."</td>";
									echo "<td>".$row["period"]."</td>";
									echo "<td>".$row["amount"]."</td>";
									
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?bonddelete=<?php echo $row["bond_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="bondDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
				
					?>
					
					</tbody>
				</table>
			</div>
		</div>
		</form>	
		<br><br>
		
		<legend><strong>Leave</strong></legend>
		<form action ="" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("leavetitle",$missingFields)?>'>
						<label for = "leavetitle" class="control-label">Leave Title</label>
						</div>
						<div class='col-md-4 <?php validateField("leavetitle",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="leavetitle" value="<?php setValue("leavetitle")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("leavetype",$missingFields)?>'>
						<label for = "leavetype" class="control-label">Leave Type</label>
						</div>
						<div class='col-md-4 <?php validateField("leavetype",$missingFields)?>'>
						<input type = "text" class="form-control input-sm" name="leavetype" value="<?php setValue("leavetype")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("leaveuseddays",$missingFields)?>'>
						<label for = "leaveuseddays" class="control-label">Used days</label>
						</div>
						<div class='col-md-4 <?php validateField("leaveuseddays",$missingFields)?>'>
						<input type = "number" class="form-control input-sm" name="leaveuseddays" value="<?php setValue("leaveuseddays")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("leavebalanceddays",$missingFields)?>'>
						<label for = "leavebalanceddays" class="control-label">Balanced days</label>
						</div>
						<div class='col-md-4 <?php validateField("leavebalanceddays",$missingFields)?>'>
						<input type = "number" class="form-control input-sm" name="leavebalanceddays" value="<?php setValue("leavebalanceddays")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left <?php validateField("leavestartdate",$missingFields)?>'>
						<label for = "leavestartdate" class="control-label">Start date</label>
						</div>
						<div class='col-md-4 <?php validateField("leavestartdate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="leavestartdate" value="<?php setValue("leavestartdate")?>"/>
						</div>
						<div class='col-md-2 text-right <?php validateField("leaveenddate",$missingFields)?>'>
						<label for = "leaveenddate" class="control-label">End date</label>
						</div>
						<div class='col-md-4 <?php validateField("leaveenddate",$missingFields)?>'>
						<input type = "date" class="form-control input-sm" name="leaveenddate" value="<?php setValue("leaveenddate")?>"/>
						</div>
					</div>
				</div>
				</div>
				
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="leaveadd">Add</button>
				</div>
				
				<div class='row'>
				<div class='col-md-12'>
					<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr class='education_table'>
							<td class="bg-info tb-header-bg"><strong>Leave Title</strong></td>
							<td class="bg-info tb-header-bg"><strong>Leave Type</strong></td>
							<td class="bg-info tb-header-bg"><strong>Used days</strong></td> 
							<td class="bg-info tb-header-bg"><strong>Balanced days</strong></td>
							<td class="bg-info tb-header-bg"><strong>Start date</strong></td>
							<td class="bg-info tb-header-bg"><strong>End date</strong></td>
							<td class="bg-info tb-header-bg"><strong>Action</strong></td>
						</tr>
					</thead>
					<tbody>
					<?php 
					if($a == "leave"){
						if(isset($_POST["leaveadd"])){
							include 'DBConnection.php';
							
							$leavetitle = trim($_POST["leavetitle"]);
							$leaveuseddays = trim($_POST["leaveuseddays"]);
							$leavetype = trim($_POST["leavetype"]);
							$leavebalanceddays = trim($_POST["leavebalanceddays"]);
							$leavestartdate = trim($_POST["leavestartdate"]);
							$leaveenddate = trim($_POST["leaveenddate"]);
						
							
							$leavestartdate = date('Y-m-d',strtotime($leavestartdate));
							$leaveenddate = date('Y-m-d',strtotime($leaveenddate));
							
							
					
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							
							$sqlLeave = "INSERT INTO leave_days(leave_title,used_days,balanced_days,leave_type,start_date,end_date,staff_id)
									  VALUES(\"$leavetitle\",\"$leaveuseddays\",\"$leavebalanceddays\",\"$leavetype\",\"$leavestartdate\",\"$leaveenddate\",$lastID);";
							$resultsqlLeave = $conn->query($sqlLeave);
						
						$sqlLeaveSelect = "SELECT leave_id,leave_title,used_days,balanced_days,leave_type,start_date,end_date FROM leave_days WHERE staff_id=$lastID;";
						$resultsqlLeaveSelect = $conn->query($sqlLeaveSelect);
						
						if($resultsqlLeaveSelect->num_rows>0){
									
							while($row = $resultsqlLeaveSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["leave_title"]."</td>";
									echo "<td>".$row["leave_type"]."</td>";
									echo "<td>".$row["used_days"]."</td>";
									echo "<td>".$row["balanced_days"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?leavedelete=<?php echo $row["leave_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="leaveDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					}
					
						if(isset($_GET["leavedelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["leavedelete"];
							$sqlLeaveDelete = "DELETE FROM leave_days WHERE leave_id=$id";
							$resultsqlLeaveDelete = $conn->query($sqlLeaveDelete);
							
							$sqlLastID = "SELECT MAX(staff_id) as lastID FROM staff;";
							$resultsqlLastID = $conn->query($sqlLastID);
							 
							if($resultsqlLastID->num_rows > 0){
										
									while($row=$resultsqlLastID->fetch_assoc()){
											
										$lastID = $row["lastID"];
									}
							}
							
							
						
						$sqlLeaveSelect = "SELECT leave_id,leave_title,used_days,balanced_days,leave_type,start_date,end_date FROM leave_days WHERE staff_id=$lastID;";
						$resultsqlLeaveSelect = $conn->query($sqlLeaveSelect);
						
						if($resultsqlLeaveSelect->num_rows>0){
									
							while($row = $resultsqlLeaveSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$row["leave_title"]."</td>";
									echo "<td>".$row["leave_type"]."</td>";
									echo "<td>".$row["used_days"]."</td>";
									echo "<td>".$row["balanced_days"]."</td>";
									echo "<td>".$row["start_date"]."</td>";
									echo "<td>".$row["end_date"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?leavedelete=<?php echo $row["leave_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="leaveDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
							
						}
					
					
					?>
					
					</tbody>
				</table>
			</div>
		</div>
		</form>	
		<br><br>
		
		<!--  <button type="submit" class="btn btn-info center-block" name = "submitAll">Create</button>	-->
	
		
		</div>
		


<?php }

?>

<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src = 'js/bootstrap.js'></script>

</body>
</html>
