<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Create Faculty</title>
		  <link href='css/bootstrap.css' rel='stylesheet' />
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
if ( isset( $_POST["Upload_Photo"] ) ) {
  processForm();
} else {
  displayForm("");
}

function processForm() {
  if ( isset( $_FILES["photo"] ) and $_FILES["photo"]["error"] == UPLOAD_ERR_OK ) {
    //if ( $_FILES["photo"]["type"] != "image/jpeg" ) {
      //echo "<p>JPEG photos only, thanks!</p>";
   // } else
    	if ( !move_uploaded_file( $_FILES["photo"]["tmp_name"], "photos/" . basename( $_FILES["photo"]["name"] ) ) ) {
      		echo "<p>Sorry, there was a problem uploading that photo.</p>" . $_FILES["photo"]["error"] ;
    	} 
    } 
    
  else {
    switch( $_FILES["photo"]["error"] ) {
      case UPLOAD_ERR_INI_SIZE:
        $message = "The photo is larger than the server allows.";
        break;
      case UPLOAD_ERR_FORM_SIZE:
        $message = "The photo is larger than the script allows.";
        break;
      case UPLOAD_ERR_NO_FILE:
        $message = "No file was uploaded. Make sure you choose a file to upload.";
        break;
      default:
        $message = "Please contact your server administrator for help.";
    }
    echo "<p>Sorry, there was a problem uploading that photo. $message</p>";
  }
}

function displayForm($a) {
?>

	<div class='navbar navbar-default navbar-static-top'>
		<div class='container'>
	
			<a href='/' class='navbar-brand text-left title'>Faculty Management System</a>
			<ul class='nav navbar-nav navbar-right subtitle '>
			
				<li><a href="">About</a></li>
				<li><a href="">Sign out</a></li>
			</ul>
		
		</div>
	</div>
	
	
	<div class='container'>
		
		<form action="Admin_CreateFaculty.php" method="post" enctype="multipart/form-data">
			<div class="form-horizontal">
				<div class="form-group">
				<input type="file" name="imageUpload" accept="image/*"/><br/>
				<button type="submit" class="btn btn-info btn-sm" name="Upload_Photo">Upload</button><br/>
				</div>
			</div>
		</form>
		
		<?php if($a=="nrc"){?>
			<div class="alert alert-danger">You have already created account for this faculty.</div>
		<?php }?>
		
		
		<!--          PERSONAL DETAIL                                      -->
		
		<legend><strong>PERSONAL DETAIL</strong></legend>
		<form action="Admin_CreateFaculty.php" method="post" class="form-horizontal"  method="post">
			
				<div class = "form-group">
					<div class = 'row'>
						
						<div class= 'col-md-2 text-left'>
						<label for = "name" class="control-label">Name</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="name"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "phone" class="control-label">Phone Number</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="phone"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "gender" class="control-label">Gender</label>
						</div>
						<div class='col-md-4'>
						<input type="radio" name="gender" value="Male"/>Male
						<input type="radio" name="gender" value="Female"/>Female
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "email" class="control-label">Email</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "email" class="form-control input-sm" name="email"/>
						</div>
					</div>
				
				
			</div>
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "marital" class="control-label">Maritial Status</label>
						</div>
						<div class='col-md-4'>
						<input type="radio" name="marital" value="single"/>Single
						<input type="radio" name="marital" value="married"/>Married
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "address" class="control-label">Address</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="address"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "department" class="control-label">Department</label>
						</div>
						<div class='col-md-4'>
						<select name="department">
							<option value="english" selected="selected">English</option>
							<option value="myanmr">Myanmar</option>
							<option value="informationsystem">Information System</option>
							<option value="computationalmathematic">Computational Mathematic</option>
							<option value="software">Software</option>
							<option value="hardware">Hardware</option>
							<option value="physics">Physics</option>
	  					</select>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "city" class="control-label">City</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="city"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "duty" class="control-label">Duty</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="duty"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "state" class="control-label">State</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="state"/>
						</div>
					</div>
				</div>
				
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "religion" class="control-label">Religion</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="religion"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "country" class="control-label">Country</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="country"/>
						</div>
					</div>
				</div>
		
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "nationality" class="control-label">Nationality</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="nationality"/>
						</div>					
						<div class= 'col-md-1 text-right col-md-offset-1'>
						<label for = "height" class="control-label">Height</label>
						</div>
						
  							<div class="form-group col-md-2">
    						<input type="number" class="form-control input-md col-md-offset-1" name="feet" placeholder="feet" min="1" max="9">
  							</div>
  							<div class="form-group col-md-2">
    						<input type="number" class="form-control input-md col-md-offset-2" name="inch" id="text" placeholder="inch" min="0" max="12">
  							</div>
  						
						</div>
				</div>
			
		
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "NRC" class="control-label" pattern="/^([1|2|3|4|5|6|7|8|9]{1}|[1]{1}[0|1|2|3|4]{1})\/[a-zA-Z]{3,6}\([N]\)[0-9]{6}$/">NRC</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="NRC"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "hair" class="control-label">Hair Color</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="hair"/>
						</div>
					</div>
				</div>
		
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "dob" class="control-label">Date of Birth</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="dob"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "skin" class="control-label">Skin Color</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="skin"/>
						</div>
					</div>
				</div>
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "weight" class="control-label">Weight</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="weight" placeholder="lb"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "status" class="control-label">Status</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "number" class="form-control input-sm" name="status"  min="0" max="1" />
						</div>
					</div>
				</div>
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "nativetown" class="control-label">Native Town</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="nativetown" />
						</div>
						</div>
						</div>
						
						
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "eye" class="control-label">Eye Color</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="eye" />
						</div>
						</div>
						</div>
						
				
			
				<div class = "form-group">
					<div class = 'row'>
						<div class= 'col-md-2 text-left'>
						<label for = "remark" class="control-label">Remark</label>
						</div>
						<div class= 'col-md-4'>
						<textarea rows="7" cols="50" name="remark" class="form-control"></textarea>
						</div>
						
					</div>
				</div>
			
			<div class="form-group">
					<button type="submit" class="btn btn-info center-block" name="personaladd" >Add</button>
				</div>
				
				<?php 
						
						if(isset($_POST["personaladd"])){
							include 'DBConnection.php';
							$flag =0;
						$register =0;
							
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
							$height =$feet."'".$inch."\"";
							
							$dob = date('Y-m-d',strtotime($dob));
							
						$sqlPersonalNRC = "SELECT nrc from staff WHERE nrc=\"$nrc\"";
							$resultsqlPersonalNRC = $conn->query($sqlPersonalNRC);
							if($resultsqlPersonalNRC->num_rows >0){
								 $flag = 1;
								
								
							}
							
						if($flag == 0){	
							
						$sqlPersonalUserType = "SELECT user_type_id from user_type WHERE user_type_nrc=\"$nrc\"";
							$resultsqlPersonalUserType = $conn->query($sqlPersonalUserType);
							if($resultsqlPersonalUserType->num_rows >0){
									$register = 1;
								while($row = $resultsqlPersonalUserType->fetch_assoc()){
									 $user_id = $row["user_type_id"];
									
										}
								
							}
									
							
						$sqlPersonalDepartment = "SELECT department_id from department WHERE department_name=\"$department\"";
							$resultsqlPersonalDepartment = $conn->query($sqlPersonalDepartment);
							if($resultsqlPersonalDepartment->num_rows >0){
									
								while($row = $resultsqlPersonalDepartment->fetch_assoc()){
									 $department_id = $row["department_id"];
									 //$sqlPersonalID = "INSERT INTO staff(user_type_id) VALUES($user_id)";
									//$resultsqlPersonalID = $conn->query($sqlPersonalID);
									
										}
								
							}
							
							
							
							$sqlPersonal = "INSERT INTO staff(name,gender,marital_status,duty,religious,nationality,native_town,nrc,date_of_birth,phone,email,city,address,state,country,height,weight,hair_color,eye_color,skin_color,remark,status)
									  VALUES(\"$name\",\"$gender\",\"$marital\",\"$duty\",\"$religion\",\"$nationality\",\"$nativetown\",\"$nrc\",\"$dob\",\"$phone\",\"$email\",\"$city\",\"$address\",\"$state\",
									  \"$country\",\"$height\",\"$weight\",\"$hair\",\"$eye\",\"$skin\",\"$remark\",$status);";
							$resultsqlPersonal = $conn->query($sqlPersonal);
							$personalid = $conn->insert_id;
							
							$sqlPersonalUserType = "SELECT user_type_id from user_type WHERE user_type_nrc=\"$nrc\"";
							$resultsqlPersonalUserType = $conn->query($sqlPersonalUserType);
							if($resultsqlPersonalUserType->num_rows >0){
									$register = 1;
								while($row = $resultsqlPersonalUserType->fetch_assoc()){
									 $user_id = $row["user_type_id"];
									$sqlPersonalID = "INSERT INTO staff(user_type_id) VALUES($user_id) WHERE staff_id=$personalid";
									$resultsqlPersonalID = $conn->query($sqlPersonalID);
										}
								
							}
									
							
						$sqlPersonalDepartment = "SELECT department_id from department WHERE department_name=\"$department\"";
							$resultsqlPersonalDepartment = $conn->query($sqlPersonalDepartment);
							if($resultsqlPersonalDepartment->num_rows >0){
									
								while($row = $resultsqlPersonalDepartment->fetch_assoc()){
									 $department_id = $row["department_id"];
									$sqlDP = "INSERT INTO staff(department_id) VALUES($department_id) WHERE staff_id=$personalid";
									$resultsqlDP = $conn->query($sqlDP);
									
										}
								
							}
							
							
							
							
						}
						else{
							
						 	displayForm("nrc");	
						}
						}
					?>
				
				</form>
			<br><br>
	
	
		
		<legend><strong>Education Qualification</strong></legend>
		<form action ="" method="post">
			<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "edugrade" class="control-label">Grade</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="edugrade"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "edulocation" class="control-label">Location</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="edulocation"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "edustartdate" class="control-label">Start Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="edustartdate"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "eduenddate" class="control-label">End Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="eduenddate"/>
						</div>
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
						if(isset($_POST["eduadd"])){
							include 'DBConnection.php';
							
							$edugrade = trim($_POST["edugrade"]);
							$edustartdate = trim($_POST["edustartdate"]);
							$eduenddate = trim($_POST["edustartdate"]);
							$edulocation = trim($_POST["edulocation"]);
							
							//str_replace("/", "-", $edustartdate);
							//str_replace("/", "-", $eduenddate);
							$edustartdate = date('Y-m-d',strtotime($edustartdate));
							$eduenddate = date('Y-m-d',strtotime($eduenddate));
							
							$sqlEdu = "INSERT INTO education(grade,start_date,end_date,location)
									  VALUES(\"$edugrade\",\"$edustartdate\",\"$eduenddate\",\"$edulocation\");";
							$resultsqlEdu = $conn->query($sqlEdu);
						
						$sqlEduSelect = "SELECT edu_id,grade,start_date,end_date,location FROM education;";
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
					
						if(isset($_GET["edudelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["edudelete"];
							$sqlEduDelete = "DELETE FROM education WHERE edu_id=$id";
							$resultsqlEduDelete = $conn->query($sqlEduDelete);
							
						
						$sqlEduSelect = "SELECT edu_id,grade,start_date,end_date,location FROM education;";
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
	
						<div class='col-md-2 text-left'>
						<label for = "familyname" class="control-label">Name</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="familyname"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "familyrelationship" class="control-label">Relationship</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="familyrelationship"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "familygender" class="control-label">Gender</label>
						</div>
						<div class='col-md-4'>
						<label for="familygender">Male</label>
						<input type="radio" name="familygender" value="Male">
						<label for="familygender">Female</label>
						<input type="radio" name="familygender" value="Female">
						</div>
						<div class='col-md-2 text-right'>
						<label for = "familycitizen" class="control-label">Citizen</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="familycitizen"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "familyrank" class="control-label">Rank</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="familyrank"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "familyeducation" class="control-label">Background Education</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="familyeducation"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "familyaddress" class="control-label">Address</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="familyaddress"/>
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
				
					if(isset($_POST["familyadd"])){
						
						include 'DBConnection.php';
						
						$name = trim($_POST["familyname"]);
						$relationship = trim($_POST["familyrelationship"]);
						$gender = trim($_POST["familygender"]);
						$citizen = trim($_POST["familycitizen"]);
						$rank = trim($_POST["familyrank"]);
						$background_education = trim($_POST["familyeducation"]);
						$address = trim($_POST["familyaddress"]);
						
						$sqlFamily = "INSERT INTO membership(name,relationship,gender,citizen,rank,background_edu,address)
									  VALUES(\"$name\",\"$relationship\",\"$gender\",\"$citizen\",\"$rank\",\"$background_education\",\"$address\");";
						$resultsqlFamily = $conn->query($sqlFamily);
						
						$sqlFamilyAdd = "SELECT membership_id,name,relationship,gender,citizen,rank,background_edu,address FROM membership;";
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
					
						if(isset($_GET["familydelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["familydelete"];
							$sqlfamilyDelete = "DELETE FROM membership WHERE membership_id=$id";
							$resultsqlfamilyDelete = $conn->query($sqlfamilyDelete);
							
							$sqlFamilyAdd = "SELECT membership_id,name,relationship,gender,citizen,rank,background_edu,address FROM membership;";
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
	
						<div class='col-md-2 text-left'>
						<label for = "foreigntitle" class="control-label">Title</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="foreigntitle"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "foreigntype" class="control-label">Type</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="foreigntype"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "foreignstartdate" class="control-label">Start Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="foreignstartdate"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "foreignenddate" class="control-label">End Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="foreignenddate"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "foreignperiod" class="control-label">Period</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="foreignperiod"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "foreigncountry" class="control-label">Country</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="foreigncountry"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "foreignsponsorship" class="control-label">Sponsorship</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="foreignsponsorship"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "foreignamt" class="control-label">Currency Amount</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="foreignamt"/>
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
							
							$sqlForeign = "INSERT INTO foreign_status(title,start_date,end_date,country,sponsorship,currency_amount,type,period)
									  VALUES(\"$foreigntitle\",\"$foreignstartdate\",\"$foreignenddate\",\"$foreigncountry\",\"$foreignsponsorship\",\"$foreignamt\",\"$foreigntype\",\"$foreignperiod\");";
							$resultsqlForeign = $conn->query($sqlForeign);
						
						$sqlForeignSelect = "SELECT foreign_id,title,start_date,end_date,country,sponsorship,currency_amount,type,period FROM foreign_status;";
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
					
						if(isset($_GET["foreigndelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["foreigndelete"];
							$sqlForeignDelete = "DELETE FROM foreign_status WHERE foreign_id=$id";
							$resultsqlForeignDelete = $conn->query($sqlForeignDelete);
							
						
						$sqlForeignSelect = "SELECT foreign_id,title,start_date,end_date,country,sponsorship,currency_amount,type,period FROM foreign_status;";
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
	
						<div class='col-md-2 text-left'>
						<label for = "servicename" class="control-label">Rank Name</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="servicename"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "servicepayscale" class="control-label">Pay Scale</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="servicepayscale"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "servicestartdate" class="control-label">Start Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="servicestartdate"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "serviceenddate" class="control-label">End Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="serviceenddate"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "serviceheaddepartment" class="control-label">Head Department</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="serviceheaddepartment"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "servicesubdepartment" class="control-label">Sub Department</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="servicesubdepartment"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "servicedepartment" class="control-label">Department</label>
						</div>
						<div class='col-md-4'>
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
						<input type = "text" class="form-control input-sm" name="serviceremark"/>
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
							
							
							$sqlServiceDepartment = "SELECT department_id from department WHERE department_name=\"$servicedepartment\"";
							$resultsqlServiceDepartment = $conn->query($sqlServiceDepartment);
							if($resultsqlServiceDepartment->num_rows >0){
									
								while($row = $resultsqlServiceDepartment->fetch_assoc()){
									 $department_id = $row["department_id"];
									 $GLOBALS['department_id'] = $row["department_id"];
										}
								
							}
							$servicestartdate = date('Y-m-d',strtotime($servicestartdate));
							$serviceenddate = date('Y-m-d',strtotime($serviceenddate));
							
							$sqlRank = "INSERT INTO rank(rank_scale,rank_name) VALUES(\"$servicepayscale\",\"$servicename\");";
							$resultsqlRank = $conn->query($sqlRank);
							
							$fk_rank = $conn->insert_id;
							
							$sqlServiceRecord = "INSERT INTO service_record(start_date,end_date,head_department,sub_department,remark,department_id)
												 VALUES(\"$servicestartdate\",\"$serviceenddate\",\"$serviceheaddepartment\",\"$servicesubdepartment\",\"$serviceremark\",$department_id);";
							
							$resultsqlServiceRecord =  $conn->query($sqlServiceRecord);
							
							
							
							$fk_service_record = $conn->insert_id;
							
							$sqlServiceRank = "INSERT INTO service_rank VALUES($fk_service_record,$fk_rank);";
							$resultsqlServiceRank = $conn->query($sqlServiceRank);
							
							$sqlSelect = "SELECT r.rank_id,s.s_id,r.rank_name,r.rank_scale,s.start_date,s.end_date,s.head_department,s.sub_department,s.remark,s.department_id FROM service_record s, rank r, service_rank a
										  WHERE s.s_id=a.s_id AND r.rank_id = a.rank_id";
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
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_CreateFaculty.php?servicedelete1=<?php echo $row["s_id"]?>& rankdelete2=<?php echo $row["rank_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="serviceDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					
						if(isset($_GET["servicedelete1"])) {
							if(isset($_GET["rankdelete2"])){
							
							include 'DBConnection.php';
							$sid1 = (int)$_GET["servicedelete1"];
							$rid2 = (int)$_GET["rankdelete2"];
							$sqlServiceRankDelete = "DELETE FROM service_rank WHERE s_id=$sid1 AND rank_id=$rid2";
							$resultsqlServiceRankDelete = $conn->query($sqlServiceRankDelete);
							
							$sqlServiceRecordDelete = "DELETE FROM service_record WHERE s_id=$sid1";
							$resultsqlServiceRecordDelete = $conn->query($sqlServiceRecordDelete);
							
							$sqlRankDelete= "DELETE FROM rank WHERE rank_id=$rid2";
							$resultsqlRankDelete = $conn->query($sqlRankDelete);
							
							
						
						$sqlSelect = "SELECT r.rank_name,r.rank_scale,s.start_date,s.end_date,s.head_department,s.sub_department,s.remark,s.department_id FROM service_record s, rank r, service_rank a
										  WHERE s.s_id=a.s_id AND r.rank_id = a.rank_id";
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
	
						<div class='col-md-2 text-left'>
						<label for = "researchtitle" class="control-label">Research Title</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="researchtitle"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "researchstartdate" class="control-label">Start Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="researchstartdate"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "researchenddate" class="control-label">End Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="researchenddate"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "researchstatus" class="control-label">Research Status</label>
						</div>
						<div class='col-md-4'>
						<input type = "number" class="form-control input-sm" name="researchstatus" min="0" max="1"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "researchtype" class="control-label">Research Type</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="researchtype"/>
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
						if(isset($_POST["researchadd"])){
							include 'DBConnection.php';
							
							$researchtitle = trim($_POST["researchtitle"]);
							$researchstartdate = trim($_POST["researchstartdate"]);
							$researchenddate = trim($_POST["researchenddate"]);
							$researchstatus = trim($_POST["researchstatus"]);
							$researchtype = trim($_POST["researchtype"]);
							
							
							$researchstartdate = date('Y-m-d',strtotime($researchstartdate));
							$researchenddate = date('Y-m-d',strtotime($researchenddate));
							
							$sqlResearch = "INSERT INTO research(research_title,start_date,end_date,research_status,research_type)
									  VALUES(\"$researchtitle\",\"$researchstartdate\",\"$researchenddate\",\"$researchstatus\",\"$researchtype\");";
							$resultsqlResearch = $conn->query($sqlResearch);
						
						$sqlResearchSelect = "SELECT research_id,research_title,start_date,end_date,research_status,research_type FROM research;";
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
					
						if(isset($_GET["researchdelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["researchdelete"];
							$sqlResearchDelete = "DELETE FROM research WHERE research_id=$id";
							$resultsqlResearchDelete = $conn->query($sqlResearchDelete);
							
						
						$sqlResearchSelect = "SELECT research_id,research_title,start_date,end_date,research_status,research_type FROM research;";
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
	
						<div class='col-md-2 text-left'>
						<label for = "papertitle" class="control-label">Paper Title</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="papertitle"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "papertype" class="control-label">Paper Type</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="papertype"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "paperpublication" class="control-label">Publication</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="paperpublication"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "papercountry" class="control-label">Country</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="papercountry"/>
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
				
					if(isset($_POST["paperadd"])){
						
						include 'DBConnection.php';
						
						$papertitle = trim($_POST["papertitle"]);
						$papertype = trim($_POST["papertype"]);
						$paperpublication = trim($_POST["paperpublication"]);
						$papercountry = trim($_POST["papercountry"]);
						
						
						$sqlPaper = "INSERT INTO accepted_paper(paper_title,paper_type,publication,country)
									  VALUES(\"$papertitle\",\"$papertype\",\"$paperpublication\",\"$papercountry\");";
						$resultsqlPaper = $conn->query($sqlPaper);
						
						$sqlPaperSelect = "SELECT paper_id,paper_title,paper_type,publication,country FROM accepted_paper;";
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
					
						if(isset($_GET["paperdelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["paperdelete"];
							$sqlfamilyDelete = "DELETE FROM accepted_paper WHERE paper_id=$id";
							$resultsqlPaperDelete = $conn->query($sqlfamilyDelete);
							
						$sqlPaperSelect = "SELECT paper_id,paper_title,paper_type,publication,country FROM accepted_paper;";
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
	
						<div class='col-md-2 text-left'>
						<label for = "passportnumber" class="control-label">Passport Number</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="passportnumber"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "passportissuedate" class="control-label">Issue Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="passportissuedate"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "passportexpirydate" class="control-label">Expiry Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="passportexpirydate"/>
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
						if(isset($_POST["passportadd"])){
							include 'DBConnection.php';
							
							$passportnumber = trim($_POST["passportnumber"]);
							$passportissuedate = trim($_POST["passportissuedate"]);
							$passportexpirydate = trim($_POST["passportexpirydate"]);
							
							
							
							$passportissuedate = date('Y-m-d',strtotime($passportissuedate));
							$passportexpirydate = date('Y-m-d',strtotime($passportexpirydate));
							
							$sqlPassport = "INSERT INTO passport(pp_number,issue_date,expiry_date)
									  VALUES(\"$passportnumber\",\"$passportissuedate\",\"$passportexpirydate\");";
							$resultsqlPassport = $conn->query($sqlPassport);
						
						$sqlPassportSelect = "SELECT pp_id,pp_number,issue_date,expiry_date FROM passport;";
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
					
						if(isset($_GET["ppdelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["ppdelete"];
							$sqlPassportDelete = "DELETE FROM passport WHERE pp_id=$id";
							$resultsqlPassportDelete = $conn->query($sqlPassportDelete);
							
						
						$sqlPassportSelect = "SELECT pp_id,pp_number,issue_date,expiry_date FROM passport;";
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
	
						<div class='col-md-2 text-left'>
						<label for = "bondtitle" class="control-label">Title</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="bondtitle"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "bondtype" class="control-label">Type</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="bondtype"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "bondregisterdate" class="control-label">Register Date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="bondregisterdate"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "bondperiod" class="control-label">Period</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="bondperiod"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "bondamount" class="control-label">Amount</label>
						</div>
						<div class='col-md-4'>
						<input type = "number" class="form-control input-sm" name="bondamount"/>
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
						if(isset($_POST["bondadd"])){
							include 'DBConnection.php';
							
							$bondtitle = trim($_POST["bondtitle"]);
							$bondtype = trim($_POST["bondtype"]);
							$bondperiod = trim($_POST["bondperiod"]);
							$bondregisterdate = trim($_POST["bondregisterdate"]);
							$bondamount = trim($_POST["bondamount"]);
						
							
							
							$bondregisterdate = date('Y-m-d',strtotime($bondregisterdate));
							
							
							$sqlBond = "INSERT INTO bond(bond_title,bond_type,register_date,period,amount)
									  VALUES(\"$bondtitle\",\"$bondtype\",\"$bondregisterdate\",\"$bondperiod\",\"$bondamount\");";
							$resultsqlBond = $conn->query($sqlBond);
						
						$sqlBondSelect = "SELECT bond_id,bond_title,bond_type,register_date,period,amount FROM bond;";
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
					
						if(isset($_GET["bonddelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["bonddelete"];
							$sqlBondDelete = "DELETE FROM bond WHERE bond_id=$id";
							$resultsqlBondDelete = $conn->query($sqlBondDelete);
							
						
						$sqlBondSelect = "SELECT bond_id,bond_title,bond_type,register_date,period,amount FROM bond;";
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
	
						<div class='col-md-2 text-left'>
						<label for = "leavetitle" class="control-label">Leave Title</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="leavetitle"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "leavetype" class="control-label">Leave Type</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="leavetype"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "leaveuseddays" class="control-label">Used days</label>
						</div>
						<div class='col-md-4'>
						<input type = "number" class="form-control input-sm" name="leaveuseddays"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "leavebalanceddays" class="control-label">Balanced days</label>
						</div>
						<div class='col-md-4'>
						<input type = "number" class="form-control input-sm" name="leavebalanceddays"/>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-horizontal">
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "leavestartdate" class="control-label">Start date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="leavestartdate"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "leaveenddate" class="control-label">End date</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="leaveenddate"/>
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
							
							
							$sqlLeave = "INSERT INTO leave_days(leave_title,used_days,balanced_days,leave_type,start_date,end_date)
									  VALUES(\"$leavetitle\",\"$leaveuseddays\",\"$leavebalanceddays\",\"$leavetype\",\"$leavestartdate\",\"$leaveenddate\");";
							$resultsqlLeave = $conn->query($sqlLeave);
						
						$sqlLeaveSelect = "SELECT leave_id,leave_title,used_days,balanced_days,leave_type,start_date,end_date FROM leave_days;";
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
					
						if(isset($_GET["leavedelete"])){
							
							include 'DBConnection.php';
							$id = (int)$_GET["leavedelete"];
							$sqlLeaveDelete = "DELETE FROM leave_days WHERE leave_id=$id";
							$resultsqlLeaveDelete = $conn->query($sqlLeaveDelete);
							
						
						$sqlLeaveSelect = "SELECT leave_id,leave_title,used_days,balanced_days,leave_type,start_date,end_date FROM leave_days;";
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
		


<?php }?>

<script src="js/bootstrap.js" ></script>

</body>
</html>
