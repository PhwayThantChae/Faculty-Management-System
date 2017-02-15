<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Create Faculty</title>
		  <link href='css/bootstrap.css' rel='stylesheet' />
		  <link href='css/Admin_DeleteFaculty.css' rel = 'stylesheet'/>
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
						include 'DBConnection.php';

						session_start();
						
						
			if(isset($_POST["personaladd"])){
				
				if(isset($_SESSION["staff"])){
						$currentUser = $_SESSION["staff"];
				}
							
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
							
							
							
				$sqlPersonalUpdate = "UPDATE staff SET name=\"$name\",gender=\"$gender\",marital_status=\"$marital\",duty=\"$duty\",religious=\"$religion\",nationality=\"$nationality\",
									native_town=\"$nativetown\",nrc=\"$nrc\",date_of_birth=\"$dob\",phone=\"$phone\",email=\"$email\",city=\"$city\",address=\"$address\",
									state=\"$state\",country=\"$country\",height=\"$height\",weight=\"$weight\",hair_color=\"$hair\",eye_color=\"$eye\",skin_color=\"$skin\",
									remark=\"$remark\",status=\"$status\" WHERE staff_id=$currentUser;";
							
								$resultsqlPersonal = $conn->query($sqlPersonalUpdate);
						
							echo $department;
						$sqlPersonalDepartment = "SELECT department_id from department WHERE department_name=\"$department\"";
							$resultsqlPersonalDepartment = $conn->query($sqlPersonalDepartment);
							
								if($resultsqlPersonalDepartment->num_rows >0){
									
										while($rowID = $resultsqlPersonalDepartment->fetch_assoc()){
									 			$d_id = $rowID["department_id"];
												//$sqlDP = "INSERT INTO staff(department_id) VALUES($department_id) WHERE staff_id=$personalid";
												$sqlDP = "UPDATE staff SET department_id=$d_id WHERE staff_id=$currentUser;";
												$resultsqlDP = $conn->query($sqlDP);
									
												}
							
							
				
										}
								
			if(getimagesize($_FILES['imageUpload']['tmp_name']) == TRUE){
								
							$image = addslashes($_FILES['imageUpload']['tmp_name']);
								$name = addslashes($_FILES['imageUpload']['name']);
								$image = file_get_contents($image);
								$image = base64_encode($image);
								
								$sqlImageInsert = "INSERT INTO image(image_data,image_name) VALUES ('$image','$name')";
								$resultsqlImageInsert = $conn->query($sqlImageInsert);
	
								$imageID = $conn->insert_id;
								
								$sqlImageUpdate = "UPDATE staff SET image_id=$imageID WHERE staff_id=$currentUser;";
								$resultsqlImageUpdate = $conn->query($sqlImageUpdate);
							
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
			}
				
						
						if(isset($_SESSION["staff"])){
						$currentUser = $_SESSION["staff"];
						echo $currentUser;
						$imgDisplay = "";
						
						$sqlGetCurrentUser = "SELECT * FROM staff WHERE staff_id=$currentUser";
						$resultsqlGetCurrentUser = $conn->query($sqlGetCurrentUser);
						
						$sqlDisplayImageUpdate = "SELECT * FROM image m, staff s WHERE s.image_id = m.image_id ";
									$resultsqlDisplayImageUpdate = $conn->query($sqlDisplayImageUpdate);
										if($resultsqlDisplayImageUpdate->num_rows > 0){
												while($rowImageDisplay = $resultsqlDisplayImageUpdate->fetch_assoc()){
													$imgDisplay =$rowImageDisplay["image_data"];
													
												}
										}
													
						
						if($resultsqlGetCurrentUser->num_rows > 0){
							while($row = $resultsqlGetCurrentUser->fetch_assoc()){
								
						
?>

	<div class='navbar navbar-default navbar-fixed-top'>
		<div class='container'>
	
			<a href='/' class='navbar-brand text-left title'>Faculty Management System</a>
			<ul class='nav navbar-nav navbar-right subtitle '>
			
				<li><a href="SessionDestroy.php">Back</a></li>
				<li><a href="Logout.php">Sign out</a></li>
			</ul>
		
		</div>
	</div>
	
	

	<div class='container'>
		
		<form action="Admin_UpdateFaculty_Profile.php" method="post" enctype="multipart/form-data" class="form-horizontal">
			
				<div class="form-group">
				<br><br><br>
				<?php echo '<img height="200" width="200" src = "data:image;base64,'.$imgDisplay.'">';?>
				<input type="file" name="imageUpload" accept="image/*"/><br/>
				
				</div>
			
		
		
		<!--          PERSONAL DETAIL                                      -->
		
		<legend><strong>Personal Detail</strong></legend>
		
			
				<div class = "form-group">
					<div class = 'row'>
						
						<div class= 'col-md-2 text-left'>
						<label for = "name" class="control-label">Name</label>
						</div>
						<div class= 'col-md-4'>

						<input type = "text" class="form-control input-sm" name="name" value="<?php echo $row["name"] ?>"/>
						</div>
						<div class='col-md-2 text-right'>
						<label for = "phone" class="control-label">Phone Number</label>
						</div>
						<div class='col-md-4'>
						<input type = "number" class="form-control input-sm" name="phone" value="<?php echo $row["phone"]  ?>"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "gender" class="control-label">Gender</label>
						</div>
						<div class='col-md-4'>
						<input type="radio" name="gender" value="Male" <?php if($row["gender"]== "Male") { echo 'checked="checked"';}?> />Male
						<input type="radio" name="gender" value="Female"  <?php if($row["gender"]== "Female") { echo 'checked="checked"';}?>  />Female
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "email" class="control-label">Email</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "email" class="form-control input-sm" name="email" value="<?php echo $row["email"]?>"/>
						</div>
					</div>
				
				
			</div>
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "marital" class="control-label">Marital Status</label>
						</div>
						<div class='col-md-4'>
						<input type="radio" name="marital" value="single" <?php if($row["marital_status"]== "single") { echo 'checked="checked"';}?>/>Single
						<input type="radio" name="marital" value="married" <?php if($row["marital_status"]== "married") { echo 'checked="checked"';}?>/>Married
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "address" class="control-label">Address</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="address" value="<?php echo $row["address"] ?>"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "department" class="control-label">Department</label>
						</div>
						<div class='col-md-4'>
						<select name="department" class="form-control">
						
						<?php 
								$tempDepartmentValue = $row["department_id"];
								$sqltempDepartmentValue = "SELECT department_name FROM department WHERE department_id=$tempDepartmentValue";
								$resultsqltempDepartmentValue = $conn->query($sqltempDepartmentValue);
								
								$sessionDepartment = "";
								if($resultsqltempDepartmentValue->num_rows > 0){
									while($rowtempDepartment = $resultsqltempDepartmentValue->fetch_assoc()){

										$sessionDepartment = $rowtempDepartment["department_name"];
										
									}
								}
						
						?>
							<option value="English" <?php if($sessionDepartment=="English") { echo 'selected="selected"';}?>>English</option>
							<option value="Myanmr" <?php if($sessionDepartment=="Myanmar") { echo 'selected="selected"';}?>>Myanmar</option>
							<option value="Information System" <?php if($sessionDepartment=="Information System") { echo 'selected="selected"';}?>>Information System</option>
							<option value="Computational Mathematic" <?php if($sessionDepartment=="Computational Mathematic") { echo 'selected="selected"';}?>>Computational Mathematic</option>
							<option value="Software" <?php if($sessionDepartment=="Software") { echo 'selected="selected"';}?>>Software</option>
							<option value="Hardware" <?php if($sessionDepartment=="Hardware") { echo 'selected="selected"';}?>>Hardware</option>
							<option value="Physics" <?php if($sessionDepartment=="Physics") { echo 'selected="selected"';}?>>Physics</option>
	  					</select>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "city" class="control-label">City</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="city" value="<?php echo $row["city"]?>"/>
						</div>
					</div>
				</div>
				
				
				
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "duty" class="control-label" >Duty</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="duty" value="<?php echo $row["duty"]?>"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "state" class="control-label">State</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="state" value="<?php echo $row["state"]?>"/>
						</div>
					</div>
				</div>
				
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "religion" class="control-label">Religion</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="religion" value="<?php echo $row["religious"]?>"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "country" class="control-label">Country</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="country" value="<?php echo $row["country"]?>"/>
						</div>
					</div>
				</div>
		
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "nationality" class="control-label">Nationality</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="nationality" value="<?php echo $row["nationality"]?>"/>
						</div>					
						<div class= 'col-md-1 text-right col-md-offset-1'>
						<label for = "height" class="control-label">Height</label>
						</div>
							<div class="form-group col-md-2">
  							<label><?php echo $row["height"];?></label>
    						
  							</div>
  							<div class="form-group col-md-1">
  							
    						<input type="number" class="form-control input-md col-md-offset-1" name="feet" placeholder="feet" min="1" max="9">
  							</div>
  							<div class="form-group col-md-1">
  							
    						<input type="number" class="form-control input-md col-md-offset-2" name="inch" id="text" placeholder="inch" min="0" max="12">
  							</div>
  						
						</div>
				</div>
			
		
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "NRC" class="control-label" pattern="/^([1|2|3|4|5|6|7|8|9]{1}|[1]{1}[0|1|2|3|4]{1})\/[a-zA-Z]{3,7}\([N]\)[0-9]{6}$/">NRC</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="NRC" value="<?php echo $row["nrc"]?>"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "hair" class="control-label">Hair Color</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="hair" value="<?php echo $row["hair_color"]?>"/>
						</div>
					</div>
				</div>
		
			
				<div class = "form-group">
					<div class = 'row'>
	
						<div class='col-md-2 text-left'>
						<label for = "dob" class="control-label">Date of Birth</label>
						</div>
						<div class='col-md-4'>
						<input type = "date" class="form-control input-sm" name="dob" value="<?php echo $row["date_of_birth"]?>"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "skin" class="control-label">Skin Color</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "text" class="form-control input-sm" name="skin" value="<?php echo $row["skin_color"]?>"/>
						</div>
					</div>
				</div>
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "weight" class="control-label">Weight</label>
						</div>
						<div class='col-md-4'>
						<input type = "number" class="form-control input-sm" name="weight" placeholder="lb" value="<?php echo $row["weight"]?>"/>
						</div>
						<div class= 'col-md-2 text-right'>
						<label for = "status" class="control-label">Status</label>
						</div>
						<div class= 'col-md-4'>
						<input type = "number" class="form-control input-sm" name="status"  min="0" max="1" value="<?php echo $row["status"]?>"/>
						</div>
					</div>
				</div>
			
			
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "nativetown" class="control-label">Native Town</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="nativetown" value="<?php echo $row["native_town"]?>" />
						</div>
						</div>
						</div>
						
						
			
				<div class = "form-group">
					<div class = 'row'>
	
						
						<div class='col-md-2 text-left'>
						<label for = "eye" class="control-label">Eye Color</label>
						</div>
						<div class='col-md-4'>
						<input type = "text" class="form-control input-sm" name="eye" value="<?php echo $row["eye_color"]?>"/>
						</div>
						</div>
						</div>
						
				
			
				<div class = "form-group">
					<div class = 'row'>
						<div class= 'col-md-2 text-left'>
						<label for = "remark" class="control-label">Remark</label>
						</div>
						<div class= 'col-md-4'>
						<textarea rows="7" cols="50" name="remark" class="form-control" value="<?php echo $row["remark"];?>"></textarea>
						</div>
						
					</div>
				</div>
			
			<div class="form-group">
					<button type="submit" class="btn btn-info center-block" name="personaladd" >Update</button>
				</div>
				
				
		</form>		
			<br><br>
			
			
				
		<legend><strong>Education Qualification</strong></legend>
		
			<form action="Admin_UpdateFaculty_Profile.php" method="post">
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
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-sm" name="eduadd">Update</button>
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
							
							
							$edugrade = trim($_POST["edugrade"]);
							$edustartdate = trim($_POST["edustartdate"]);
							$eduenddate = trim($_POST["eduenddate"]);
							$edulocation = trim($_POST["edulocation"]);
							
							$edustartdate = date('Y-m-d',strtotime($edustartdate));
							$eduenddate = date('Y-m-d',strtotime($eduenddate));
							
							
							
							$sqlEdu = "INSERT INTO education(grade,start_date,end_date,location,staff_id)
									  VALUES(\"$edugrade\",\"$edustartdate\",\"$eduenddate\",\"$edulocation\",$currentUser);";
							$resultsqlEdu = $conn->query($sqlEdu);
						
						$sqlEduSelectAdd = "SELECT edu_id,grade,start_date,end_date,location FROM education WHERE staff_id=$currentUser;";
						$resultsqlEduSelectAdd = $conn->query($sqlEduSelectAdd);
						
						if($resultsqlEduSelectAdd->num_rows>0){
									
							while($rowEduAdd = $resultsqlEduSelectAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowEduAdd["grade"]."</td>";
									echo "<td>".$rowEduAdd["start_date"]."</td>";
									echo "<td>".$rowEduAdd["end_date"]."</td>";
									echo "<td>".$rowEduAdd["location"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?edudelete=<?php echo $rowEduAdd["edu_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="eduDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					
					if((!isset($_POST["eduadd"])) && (!isset($_GET["edudelete"]))){
						$sqlSessionEdu = "SELECT * FROM education WHERE staff_id=$currentUser";
						$resultsqlSessionEdu = $conn->query($sqlSessionEdu);
						
						if($resultsqlSessionEdu->num_rows > 0){
							while($rowEduDis = $resultsqlSessionEdu->fetch_assoc()){
									
								echo "<tr>";
									echo "<td>".$rowEduDis["grade"]."</td>";
									echo "<td>".$rowEduDis["start_date"]."</td>";
									echo "<td>".$rowEduDis["end_date"]."</td>";
									echo "<td>".$rowEduDis["location"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?edudelete=<?php echo $rowEduDis["edu_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="eduDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
						if(isset($_GET["edudelete"])){
							
							//include 'DBConnection.php';
							$id = (int)$_GET["edudelete"];
							$sqlEduDelete = "DELETE FROM education WHERE edu_id=$id AND staff_id=$currentUser";
							$resultsqlEduDelete = $conn->query($sqlEduDelete);
							
						
						$sqlEduSelect = "SELECT edu_id,grade,start_date,end_date,location FROM education WHERE staff_id=$currentUser;";
						$resultsqlEduSelect = $conn->query($sqlEduSelect);
						
						if($resultsqlEduSelect->num_rows>0){
									
							while($rowEduSelect = $resultsqlEduSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowEduSelect["grade"]."</td>";
									echo "<td>".$rowEduSelect["start_date"]."</td>";
									echo "<td>".$rowEduSelect["end_date"]."</td>";
									echo "<td>".$rowEduSelect["location"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?edudelete=<?php echo $row["edu_id"]?>" 
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
		<form action ="Admin_UpdateFaculty_Profile.php" method="post">
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
					<button type="submit" class="btn btn-info btn-sm" name="familyadd">Update</button>
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
					
						
						$name = trim($_POST["familyname"]);
						$relationship = trim($_POST["familyrelationship"]);
						$gender = trim($_POST["familygender"]);
						$citizen = trim($_POST["familycitizen"]);
						$rank = trim($_POST["familyrank"]);
						$background_education = trim($_POST["familyeducation"]);
						$address = trim($_POST["familyaddress"]);
						
							
						
						$sqlFamily = "INSERT INTO membership(name,relationship,gender,citizen,rank,background_edu,address,staff_id)
									  VALUES(\"$name\",\"$relationship\",\"$gender\",\"$citizen\",\"$rank\",\"$background_education\",\"$address\",$currentUser);";
						$resultsqlFamily = $conn->query($sqlFamily);
						
						$sqlFamilyAdd = "SELECT membership_id,name,relationship,gender,citizen,rank,background_edu,address FROM membership WHERE staff_id=$currentUser;";
						$resultsqlFamilyAdd = $conn->query($sqlFamilyAdd);
						
						if($resultsqlFamilyAdd->num_rows>0){
									
							while($rowFamilyAdd = $resultsqlFamilyAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowFamilyAdd["name"]."</td>";
									echo "<td>".$rowFamilyAdd["relationship"]."</td>";
									echo "<td>".$rowFamilyAdd["gender"]."</td>";
									echo "<td>".$rowFamilyAdd["citizen"]."</td>";
									echo "<td>".$rowFamilyAdd["rank"]."</td>";
									echo "<td>".$rowFamilyAdd["background_edu"]."</td>";
									echo "<td>".$rowFamilyAdd["address"]."</td>";
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?familydelete=<?php echo $rowFamilyAdd["membership_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="familyDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					
					if((!isset($_POST["familyadd"])) && (!isset($_GET["familydelete"]))){
							$sqlSessionFamily = "SELECT * FROM membership WHERE staff_id=$currentUser";
						$resultsqlSessionFamily = $conn->query($sqlSessionFamily);
						
						if($resultsqlSessionFamily->num_rows > 0){
							while($rowFamilyDis = $resultsqlSessionFamily->fetch_assoc()){
									
								echo "<tr>";
									echo "<td>".$rowFamilyDis["name"]."</td>";
									echo "<td>".$rowFamilyDis["relationship"]."</td>";
									echo "<td>".$rowFamilyDis["gender"]."</td>";
									echo "<td>".$rowFamilyDis["citizen"]."</td>";
									echo "<td>".$rowFamilyDis["rank"]."</td>";
									echo "<td>".$rowFamilyDis["background_edu"]."</td>";
									echo "<td>".$rowFamilyDis["address"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?familydelete=<?php echo $rowFamilyDis["membership_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="eduDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
						if(isset($_GET["familydelete"])){
							
							
							$id = (int)$_GET["familydelete"];
							$sqlfamilyDelete = "DELETE FROM membership WHERE membership_id=$id";
							$resultsqlfamilyDelete = $conn->query($sqlfamilyDelete);
							
							$sqlFamilySelect = "SELECT membership_id,name,relationship,gender,citizen,rank,background_edu,address FROM membership WHERE staff_id=$currentUser;";
							$resultsqlFamilySelect = $conn->query($sqlFamilySelect);
							
							if($resultsqlFamilySelect->num_rows>0){
									
							while($rowFamilySelect = $resultsqlFamilySelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowFamilySelect["name"]."</td>";
									echo "<td>".$rowFamilySelect["relationship"]."</td>";
									echo "<td>".$rowFamilySelect["gender"]."</td>";
									echo "<td>".$rowFamilySelect["citizen"]."</td>";
									echo "<td>".$rowFamilySelect["rank"]."</td>";
									echo "<td>".$rowFamilySelect["background_edu"]."</td>";
									echo "<td>".$rowFamilySelect["address"]."</td>";
								?>
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?familydelete=<?php echo $rowFamilySelect["membership_id"]?>" 
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
		<form action ="Admin_UpdateFaculty_Profile.php" method="post">
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
					<button type="submit" class="btn btn-info btn-sm" name="foreignadd">Update</button>
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
							
							
							
							$sqlForeign = "INSERT INTO foreign_status(title,start_date,end_date,country,sponsorship,currency_amount,type,period,staff_id)
									  VALUES(\"$foreigntitle\",\"$foreignstartdate\",\"$foreignenddate\",\"$foreigncountry\",\"$foreignsponsorship\",\"$foreignamt\",\"$foreigntype\",\"$foreignperiod\",$currentUser);";
							$resultsqlForeign = $conn->query($sqlForeign);
						
						$sqlForeignAdd = "SELECT foreign_id,title,start_date,end_date,country,sponsorship,currency_amount,type,period FROM foreign_status WHERE staff_id=$currentUser;";
						$resultsqlForeignAdd = $conn->query($sqlForeignAdd);
						
						if($resultsqlForeignAdd->num_rows>0){
									
							while($rowForeignAdd = $resultsqlForeignAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowForeignAdd["title"]."</td>";
									echo "<td>".$rowForeignAdd["start_date"]."</td>";
									echo "<td>".$rowForeignAdd["end_date"]."</td>";
									echo "<td>".$rowForeignAdd["period"]."</td>";
									echo "<td>".$rowForeignAdd["country"]."</td>";
									echo "<td>".$rowForeignAdd["sponsorship"]."</td>";
									echo "<td>".$rowForeignAdd["currency_amount"]."</td>";
									echo "<td>".$rowForeignAdd["type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?foreigndelete=<?php echo $rowForeignAdd["foreign_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="foreignDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					if((!isset($_POST["foreignadd"])) && (!isset($_GET["foreigndelete"]))){
					$sqlSessionForeign = "SELECT * FROM foreign_status WHERE staff_id=$currentUser";
						$resultsqlSessionForeign = $conn->query($sqlSessionForeign);
						
						if($resultsqlSessionForeign->num_rows > 0){
							while($rowForeignDis = $resultsqlSessionForeign->fetch_assoc()){
									
								echo "<tr>";
									echo "<td>".$rowForeignDis["title"]."</td>";
									echo "<td>".$rowForeignDis["start_date"]."</td>";
									echo "<td>".$rowForeignDis["end_date"]."</td>";
									echo "<td>".$rowForeignDis["period"]."</td>";
									echo "<td>".$rowForeignDis["country"]."</td>";
									echo "<td>".$rowForeignDis["sponsorship"]."</td>";
									echo "<td>".$rowForeignDis["currency_amount"]."</td>";
									echo "<td>".$rowForeignDis["type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?foreigndelete=<?php echo $rowForeignDis["foreign_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="eduDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					
					}
						
						if(isset($_GET["foreigndelete"])){
							
							
							$id = (int)$_GET["foreigndelete"];
							$sqlForeignDelete = "DELETE FROM foreign_status WHERE foreign_id=$id";
							$resultsqlForeignDelete = $conn->query($sqlForeignDelete);
							
						
						$sqlForeignSelect = "SELECT foreign_id,title,start_date,end_date,country,sponsorship,currency_amount,type,period FROM foreign_status WHERE staff_id = $currentUser;";
						$resultsqlForeignSelect = $conn->query($sqlForeignSelect);
						
						if($resultsqlForeignSelect->num_rows>0){
									
							while($rowForeignSelect = $resultsqlForeignSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowForeignSelect["title"]."</td>";
									echo "<td>".$rowForeignSelect["start_date"]."</td>";
									echo "<td>".$rowForeignSelect["end_date"]."</td>";
									echo "<td>".$rowForeignSelect["period"]."</td>";
									echo "<td>".$rowForeignSelect["country"]."</td>";
									echo "<td>".$rowForeignSelect["sponsorship"]."</td>";
									echo "<td>".$rowForeignSelect["currency_amount"]."</td>";
									echo "<td>".$rowForeignSelect["type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?foreigndelete=<?php echo $rowForeignSelect["foreign_id"]?>" 
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
		<form action="Admin_UpdateFaculty_Profile.php" method="post">
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
					<button type="submit" class="btn btn-info btn-sm" name="serviceadd">Update</button>
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
					
					$count = 0;
					
						if(isset($_POST["serviceadd"])){
							$count=$count+1;
							$servicename = trim($_POST["servicename"]);
							$servicepayscale = trim($_POST["servicepayscale"]);
							$servicestartdate = trim($_POST["servicestartdate"]);
							$serviceenddate = trim($_POST["serviceenddate"]);
							$serviceheaddepartment = trim($_POST["serviceheaddepartment"]);
							$servicesubdepartment = trim($_POST["servicesubdepartment"]);
							$servicedepartment = trim($_POST["servicedepartment"]);
							$serviceremark = trim($_POST["serviceremark"]);
							
							
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
							
							//$fk_rank = $conn->insert_id;
							
							$fk_rank = 0;
							$fk_service_record =0;
							
						$sqlLast_fk_rank = "SELECT MAX(rank_id) as lastRankID FROM rank;";
							$resultsqlRankLastID = $conn->query($sqlLast_fk_rank);
							 
							if($resultsqlRankLastID->num_rows > 0){
										
									while($rowRankLast=$resultsqlRankLastID->fetch_assoc()){
											
										$fk_rank = $rowRankLast["lastRankID"];
									}
							}
							
							$sqlServiceRecord = "INSERT INTO service_record(start_date,end_date,head_department,sub_department,remark,department_id,staff_id)
												 VALUES(\"$servicestartdate\",\"$serviceenddate\",\"$serviceheaddepartment\",\"$servicesubdepartment\",\"$serviceremark\",$department_id,$currentUser);";
							
							$resultsqlServiceRecord =  $conn->query($sqlServiceRecord);
							
							
							
							//$fk_service_record = $conn->insert_id;
							
							
						$sqlLast_fk_record = "SELECT MAX(s_id) as lastRecordID FROM service_record;";
							$resultsqlServiceLastID = $conn->query($sqlLast_fk_record);
							 
							if($resultsqlServiceLastID->num_rows > 0){
										
									while($rowServiceLast=$resultsqlServiceLastID->fetch_assoc()){
											
										$fk_service_record = $rowServiceLast["lastRecordID"];
									}
							}
							
							$sqlServiceRank = "INSERT INTO service_rank VALUES($fk_service_record,$fk_rank);";
							$resultsqlServiceRank = $conn->query($sqlServiceRank);
							
							
					$sqlService = "SELECT  r.rank_id,s.s_id,r.rank_name,r.rank_scale,s.start_date,s.end_date,s.head_department,s.sub_department,s.remark,s.department_id FROM service_record s, rank r, service_rank a
										  WHERE s.s_id=a.s_id AND r.rank_id = a.rank_id AND s.staff_id=$currentUser";
						$resultsqlService = $conn->query($sqlService);
						
						if($resultsqlService->num_rows > 0){
							while($rowServiceDis = $resultsqlService->fetch_assoc()){
									
								echo "<tr>";
									echo "<td>".$rowServiceDis["rank_name"]."</td>";
									echo "<td>".$rowServiceDis["rank_scale"]."</td>";
									echo "<td>".$rowServiceDis["start_date"]."</td>";
									echo "<td>".$rowServiceDis["end_date"]."</td>";
									echo "<td>".$rowServiceDis["head_department"]."</td>";
									echo "<td>".$rowServiceDis["sub_department"]."</td>";
									echo "<td>".$rowServiceDis["department_id"]."</td>";
									echo "<td>".$rowServiceDis["remark"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?servicedelete1=<?php echo $rowServiceDis["s_id"]?>&rankdelete2=<?php echo $rowServiceDis["rank_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="serviceDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
						}
						
						
							if((!isset($_POST["serviceadd"])) && (!isset($_GET["servicedelete1"])) && (!isset($_GET["rankdelete2"])) && $count==0){
								
						$sqlSessionService = "SELECT r.rank_id,s.s_id,r.rank_name,r.rank_scale,s.start_date,s.end_date,s.head_department,s.sub_department,s.remark,s.department_id FROM service_record s, rank r, service_rank a
										  WHERE s.s_id=a.s_id AND r.rank_id = a.rank_id AND s.staff_id=$currentUser";
						$resultsqlSessionService = $conn->query($sqlSessionService);
						
						if($resultsqlSessionService->num_rows > 0){
							while($rowService = $resultsqlSessionService->fetch_assoc()){
									
								echo "<tr>";
									echo "<td>".$rowService["rank_name"]."</td>";
									echo "<td>".$rowService["rank_scale"]."</td>";
									echo "<td>".$rowService["start_date"]."</td>";
									echo "<td>".$rowService["end_date"]."</td>";
									echo "<td>".$rowService["head_department"]."</td>";
									echo "<td>".$rowService["sub_department"]."</td>";
									echo "<td>".$rowService["department_id"]."</td>";
									echo "<td>".$rowService["remark"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?servicedelete1=<?php echo $rowService["s_id"]?>&rankdelete2=<?php echo $rowService["rank_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="serviceDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
									
								}
					
						}
						}
						
						
						
						if(isset($_GET["servicedelete1"]) && (isset($_GET["rankdelete2"]))){
						
							
								include 'DBConnection.php';
							
							$sid1 = (int)$_GET["servicedelete1"];
							$rid2 = (int)$_GET["rankdelete2"];
							$sqlServiceRankDelete = "DELETE FROM service_rank WHERE s_id=$sid1 AND rank_id=$rid2";
							$resultsqlServiceRankDelete = $conn->query($sqlServiceRankDelete);
							
							$sqlServiceRecordDelete = "DELETE FROM service_record WHERE s_id=$sid1";
							$resultsqlServiceRecordDelete = $conn->query($sqlServiceRecordDelete);
							
							$sqlRankDelete= "DELETE FROM rank WHERE rank_id=$rid2;";
							$resultsqlRankDelete = $conn->query($sqlRankDelete);
							
							
						
						$sqlServiceSelect = "SELECT r.rank_name,r.rank_scale,s.start_date,s.end_date,s.head_department,s.sub_department,s.remark,s.department_id FROM service_record s, rank r, service_rank a
										  WHERE s.s_id=a.s_id AND r.rank_id = a.rank_id AND s.staff_id=$currentUser";
							$resultsqlServiceSelect = $conn->query($sqlServiceSelect);
						
							if($resultsqlServiceSelect->num_rows>0){
									
							while($rowServiceSelect = $resultsqlServiceSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowServiceSelect["rank_name"]."</td>";
									echo "<td>".$rowServiceSelect["rank_scale"]."</td>";
									echo "<td>".$rowServiceSelect["start_date"]."</td>";
									echo "<td>".$rowServiceSelect["end_date"]."</td>";
									echo "<td>".$rowServiceSelect["head_department"]."</td>";
									echo "<td>".$rowServiceSelect["sub_department"]."</td>";
									echo "<td>".$rowServiceSelect["department_id"]."</td>";
									echo "<td>".$rowServiceSelect["remark"]."</td>";
									
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?servicedelete1=<?php echo $rowServiceSelect["s_id"]?>&rankdelete2=<?php echo $rowServiceSelect["rank_id"]?>" 
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
		<form action ="Admin_UpdateFaculty_Profile.php" method="post">
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
							
							
							$researchtitle = trim($_POST["researchtitle"]);
							$researchstartdate = trim($_POST["researchstartdate"]);
							$researchenddate = trim($_POST["researchenddate"]);
							$researchstatus = trim($_POST["researchstatus"]);
							$researchtype = trim($_POST["researchtype"]);
							
							
							$researchstartdate = date('Y-m-d',strtotime($researchstartdate));
							$researchenddate = date('Y-m-d',strtotime($researchenddate));
							
							
							
							$sqlResearch = "INSERT INTO research(research_title,start_date,end_date,research_status,research_type,staff_id)
									  VALUES(\"$researchtitle\",\"$researchstartdate\",\"$researchenddate\",\"$researchstatus\",\"$researchtype\",$currentUser);";
							$resultsqlResearch = $conn->query($sqlResearch);
						
						$sqlResearchAdd = "SELECT research_id,research_title,start_date,end_date,research_status,research_type FROM research WHERE staff_id=$currentUser;";
						$resultsqlResearchAdd = $conn->query($sqlResearchAdd);
						
						if($resultsqlResearchAdd->num_rows>0){
									
							while($rowResearchAdd = $resultsqlResearchAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowResearchAdd["research_title"]."</td>";
									echo "<td>".$rowResearchAdd["start_date"]."</td>";
									echo "<td>".$rowResearchAdd["end_date"]."</td>";
									echo "<td>".$rowResearchAdd["research_status"]."</td>";
									echo "<td>".$rowResearchAdd["research_type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?researchdelete=<?php echo $rowResearchAdd["research_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="researchDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					
					if((!isset($_POST["researchadd"])) && (!isset($_GET["researchdelete"]))){
							$sqlSessionResearch = "SELECT * FROM research WHERE staff_id=$currentUser";
						$resultsqlSessionResearch = $conn->query($sqlSessionResearch);
						
						if($resultsqlSessionResearch->num_rows > 0){
							while($rowResearchDis = $resultsqlSessionResearch->fetch_assoc()){
									
								echo "<tr>";
									echo "<td>".$rowResearchDis["research_title"]."</td>";
									echo "<td>".$rowResearchDis["start_date"]."</td>";
									echo "<td>".$rowResearchDis["end_date"]."</td>";
									echo "<td>".$rowResearchDis["research_status"]."</td>";
									echo "<td>".$rowResearchDis["research_type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?researchdelete=<?php echo $rowResearchDis["research_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="researchDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
						}
					
						if(isset($_GET["researchdelete"])){
							
							$id = (int)$_GET["researchdelete"];
							$sqlResearchDelete = "DELETE FROM research WHERE research_id=$id";
							$resultsqlResearchDelete = $conn->query($sqlResearchDelete);
							
						
						$sqlResearchSelect = "SELECT research_id,research_title,start_date,end_date,research_status,research_type FROM research WHERE staff_id=$currentUser;";
						$resultsqlResearchSelect = $conn->query($sqlResearchSelect);
						
						if($resultsqlResearchSelect->num_rows>0){
									
							while($rowResearchSelect = $resultsqlResearchSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowResearchSelect["research_title"]."</td>";
									echo "<td>".$rowResearchSelect["start_date"]."</td>";
									echo "<td>".$rowResearchSelect["end_date"]."</td>";
									echo "<td>".$rowResearchSelect["research_status"]."</td>";
									echo "<td>".$rowResearchSelect["research_type"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?researchdelete=<?php echo $rowResearchSelect["research_id"]?>" 
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
		<form action ="Admin_UpdateFaculty_Profile.php" method="post">
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
						
						
						$papertitle = trim($_POST["papertitle"]);
						$papertype = trim($_POST["papertype"]);
						$paperpublication = trim($_POST["paperpublication"]);
						$papercountry = trim($_POST["papercountry"]);
						
						
						
						$sqlPaper = "INSERT INTO accepted_paper(paper_title,paper_type,publication,country,staff_id)
									  VALUES(\"$papertitle\",\"$papertype\",\"$paperpublication\",\"$papercountry\",$currentUser);";
						$resultsqlPaper = $conn->query($sqlPaper);
						
						$sqlPaperAdd = "SELECT paper_id,paper_title,paper_type,publication,country FROM accepted_paper WHERE staff_id=$currentUser;";
						$resultsqlPaperAdd = $conn->query($sqlPaperAdd);
						
						if($resultsqlPaperAdd->num_rows>0){
									
							while($rowPaperAdd = $resultsqlPaperAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowPaperAdd["paper_title"]."</td>";
									echo "<td>".$rowPaperAdd["paper_type"]."</td>";
									echo "<td>".$rowPaperAdd["publication"]."</td>";
									echo "<td>".$rowPaperAdd["country"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?paperdelete=<?php echo $row["paper_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="familyDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					if((!isset($_POST["paperadd"])) && (!isset($_GET["paperdelete"]))){
							$sqlSessionPaper = "SELECT * FROM accepted_paper WHERE staff_id=$currentUser";
						$resultsqlSessionPaper = $conn->query($sqlSessionPaper);
						
						if($resultsqlSessionPaper->num_rows > 0){
							while($rowPaperDis = $resultsqlSessionPaper->fetch_assoc()){
									
								echo "<tr>";
									echo "<td>".$rowPaperDis["paper_title"]."</td>";
									echo "<td>".$rowPaperDis["paper_type"]."</td>";
									echo "<td>".$rowPaperDis["publication"]."</td>";
									echo "<td>".$rowPaperDis["country"]."</td>";
									
								
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?researchdelete=<?php echo $rowPaperDis["paper_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="researchDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
						if(isset($_GET["paperdelete"])){
							
							$id = (int)$_GET["paperdelete"];
							$sqlfamilyDelete = "DELETE FROM accepted_paper WHERE paper_id=$id";
							$resultsqlPaperDelete = $conn->query($sqlfamilyDelete);
							
						$sqlPaperSelect = "SELECT paper_id,paper_title,paper_type,publication,country FROM accepted_paper WHERE staff_id=$currentUser;";
						$resultsqlPaperSelect = $conn->query($sqlPaperSelect);
						
						if($resultsqlPaperSelect->num_rows>0){
									
							while($rowPaperSelect = $resultsqlPaperSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowPaperSelect["paper_title"]."</td>";
									echo "<td>".$rowPaperSelect["paper_type"]."</td>";
									echo "<td>".$rowPaperSelect["publication"]."</td>";
									echo "<td>".$rowPaperSelect["country"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?paperdelete=<?php echo $rowPaperSelect["paper_id"]?>" 
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
		<form action ="Admin_UpdateFaculty_Profile.php" method="post">
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
							
							
							$passportnumber = trim($_POST["passportnumber"]);
							$passportissuedate = trim($_POST["passportissuedate"]);
							$passportexpirydate = trim($_POST["passportexpirydate"]);
							
							
							
							$passportissuedate = date('Y-m-d',strtotime($passportissuedate));
							$passportexpirydate = date('Y-m-d',strtotime($passportexpirydate));
							
							
							
							$sqlPassport = "INSERT INTO passport(pp_number,issue_date,expiry_date,staff_id)
									  VALUES(\"$passportnumber\",\"$passportissuedate\",\"$passportexpirydate\",$currentUser);";
							$resultsqlPassport = $conn->query($sqlPassport);
						
						$sqlPassportAdd = "SELECT pp_id,pp_number,issue_date,expiry_date FROM passport WHERE staff_id=$currentUser;";
						$resultsqlPassportAdd = $conn->query($sqlPassportAdd);
						
						if($resultsqlPassportAdd->num_rows>0){
									
							while($rowPPAdd = $resultsqlPassportAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowPPAdd["pp_number"]."</td>";
									echo "<td>".$rowPPAdd["issue_date"]."</td>";
									echo "<td>".$rowPPAdd["expiry_date"]."</td>";
								
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?ppdelete=<?php echo $rowPPAdd["pp_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="ppDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					if((!isset($_POST["passportadd"])) && (!isset($_GET["passportdelete"]))){
					
							$sqlSessionPP = "SELECT * FROM passport WHERE staff_id=$currentUser";
						$resultsqlSessionPP = $conn->query($sqlSessionPP);
						
						if($resultsqlSessionPP->num_rows > 0){
							while($rowPPDis = $resultsqlSessionPP->fetch_assoc()){
									
									echo "<tr>";
									echo "<td>".$rowPPDis["pp_number"]."</td>";
									echo "<td>".$rowPPDis["issue_date"]."</td>";
									echo "<td>".$rowPPDis["expiry_date"]."</td>";
									
								
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?ppdelete=<?php echo $rowPPDis["pp_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="researchDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					
						if(isset($_GET["ppdelete"])){
							
							
							$id = (int)$_GET["ppdelete"];
							$sqlPassportDelete = "DELETE FROM passport WHERE pp_id=$id";
							$resultsqlPassportDelete = $conn->query($sqlPassportDelete);
							
						
						$sqlPassportSelect = "SELECT pp_id,pp_number,issue_date,expiry_date FROM passport WHERE staff_id=$currentUser;";
						$resultsqlPassportSelect = $conn->query($sqlPassportSelect);
						
						if($resultsqlPassportSelect->num_rows>0){
									
							while($rowPPSelect = $resultsqlPassportSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowPPSelect["pp_number"]."</td>";
									echo "<td>".$rowPPSelect["issue_date"]."</td>";
									echo "<td>".$rowPPSelect["expiry_date"]."</td>";
								
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?ppdelete=<?php echo $rowPPSelect["pp_id"]?>" 
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
		<form action ="Admin_UpdateFaculty_Profile.php" method="post">
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
							
							
							$bondtitle = trim($_POST["bondtitle"]);
							$bondtype = trim($_POST["bondtype"]);
							$bondperiod = trim($_POST["bondperiod"]);
							$bondregisterdate = trim($_POST["bondregisterdate"]);
							$bondamount = trim($_POST["bondamount"]);
						
							
							
							$bondregisterdate = date('Y-m-d',strtotime($bondregisterdate));
							
							$sqlBond = "INSERT INTO bond(bond_title,bond_type,register_date,period,amount,staff_id)
									  VALUES(\"$bondtitle\",\"$bondtype\",\"$bondregisterdate\",\"$bondperiod\",\"$bondamount\",$currentUser);";
							$resultsqlBond = $conn->query($sqlBond);
						
						$sqlBondAdd = "SELECT bond_id,bond_title,bond_type,register_date,period,amount FROM bond WHRE staff_id=$currentUser;";
						$resultsqlBondAdd = $conn->query($sqlBondAdd);
						
						if($resultsqlBondAdd->num_rows>0){
									
							while($rowBondAdd = $resultsqlBondAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowBondAdd["bond_title"]."</td>";
									echo "<td>".$rowBondAdd["bond_type"]."</td>";
									echo "<td>".$rowBondAdd["register_date"]."</td>";
									echo "<td>".$rowBondAdd["period"]."</td>";
									echo "<td>".$rowBondAdd["amount"]."</td>";
									
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?bonddelete=<?php echo $rowBondAdd["bond_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="bondDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					if((!isset($_POST["bondadd"])) && (!isset($_GET["bonddelete"]))){
							$sqlSessionBond = "SELECT * FROM bond WHERE staff_id=$currentUser";
						$resultsqlSessionBond = $conn->query($sqlSessionBond);
						
						if($resultsqlSessionBond->num_rows > 0){
							while($rowBondDis = $resultsqlSessionBond->fetch_assoc()){
									
									echo "<tr>";
									echo "<td>".$rowBondDis["bond_title"]."</td>";
									echo "<td>".$rowBondDis["bond_type"]."</td>";
									echo "<td>".$rowBondDis["register_date"]."</td>";
									echo "<td>".$rowBondDis["period"]."</td>";
									echo "<td>".$rowBondDis["amount"]."</td>";
								
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?bonddelete=<?php echo $rowBondDis["bond_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="researchDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
						if(isset($_GET["bonddelete"])){
							
							
							$id = (int)$_GET["bonddelete"];
							$sqlBondDelete = "DELETE FROM bond WHERE bond_id=$id";
							$resultsqlBondDelete = $conn->query($sqlBondDelete);
							
						
						$sqlBondSelect = "SELECT bond_id,bond_title,bond_type,register_date,period,amount FROM bond WHERE staff_id=$currentUser;";
						$resultsqlBondSelect = $conn->query($sqlBondSelect);
						
						if($resultsqlBondSelect->num_rows>0){
									
							while($rowBondSelect = $resultsqlBondSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowBondSelect["bond_title"]."</td>";
									echo "<td>".$rowBondSelect["bond_type"]."</td>";
									echo "<td>".$rowBondSelect["register_date"]."</td>";
									echo "<td>".$rowBondSelect["period"]."</td>";
									echo "<td>".$rowBondSelect["amount"]."</td>";
									
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?bonddelete=<?php echo $rowBondSelect["bond_id"]?>" 
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
		<form action ="Admin_UpdateFaculty_Profile.php" method="post">
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
							
							
							$leavetitle = trim($_POST["leavetitle"]);
							$leaveuseddays = trim($_POST["leaveuseddays"]);
							$leavetype = trim($_POST["leavetype"]);
							$leavebalanceddays = trim($_POST["leavebalanceddays"]);
							$leavestartdate = trim($_POST["leavestartdate"]);
							$leaveenddate = trim($_POST["leaveenddate"]);
						
							
							$leavestartdate = date('Y-m-d',strtotime($leavestartdate));
							$leaveenddate = date('Y-m-d',strtotime($leaveenddate));
							
							
							
							
							
							$sqlLeave = "INSERT INTO leave_days(leave_title,used_days,balanced_days,leave_type,start_date,end_date,staff_id)
									  VALUES(\"$leavetitle\",\"$leaveuseddays\",\"$leavebalanceddays\",\"$leavetype\",\"$leavestartdate\",\"$leaveenddate\",$currentUser);";
							$resultsqlLeave = $conn->query($sqlLeave);
						
						$sqlLeaveAdd = "SELECT leave_id,leave_title,used_days,balanced_days,leave_type,start_date,end_date FROM leave_days WHERE staff_id=$currentUser;";
						$resultsqlLeaveAdd = $conn->query($sqlLeaveAdd);
						
						if($resultsqlLeaveAdd->num_rows>0){
									
							while($row = $resultsqlLeaveAdd->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowLeaveAdd["leave_title"]."</td>";
									echo "<td>".$rowLeaveAdd["leave_type"]."</td>";
									echo "<td>".$rowLeaveAdd["used_days"]."</td>";
									echo "<td>".$rowLeaveAdd["balanced_days"]."</td>";
									echo "<td>".$rowLeaveAdd["start_date"]."</td>";
									echo "<td>".$rowLeaveAdd["end_date"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?leavedelete=<?php echo $rowLeaveAdd["leave_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="leaveDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
					
					if((!isset($_POST["leaveadd"])) && (!isset($_GET["leavedelete"]))){
							$sqlSessionLeave = "SELECT * FROM leave_days WHERE staff_id=$currentUser";
						$resultsqlSessionLeave = $conn->query($sqlSessionLeave);
						
						if($resultsqlSessionLeave->num_rows > 0){
							while($rowLeaveDis = $resultsqlSessionLeave->fetch_assoc()){
									
									echo "<tr>";
									echo "<td>".$rowLeaveDis["leave_title"]."</td>";
									echo "<td>".$rowLeaveDis["leave_type"]."</td>";
									echo "<td>".$rowLeaveDis["used_days"]."</td>";
									echo "<td>".$rowLeaveDis["balanced_days"]."</td>";
									echo "<td>".$rowLeaveDis["start_date"]."</td>";
									echo "<td>".$rowLeaveDis["end_date"]."</td>";
								
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?leavedelete=<?php echo $rowLeaveDis["leave_id"]?>" 
												  class="btn btn-info btn-sm" role="button" name="researchDelete" >Delete</a></td>
								<?php 
								
									echo "</tr>";
							}
					
						}
					}
					
						if(isset($_GET["leavedelete"])){
							
							
							$id = (int)$_GET["leavedelete"];
							$sqlLeaveDelete = "DELETE FROM leave_days WHERE leave_id=$id";
							$resultsqlLeaveDelete = $conn->query($sqlLeaveDelete);
							
						
						$sqlLeaveSelect = "SELECT leave_id,leave_title,used_days,balanced_days,leave_type,start_date,end_date FROM leave_days WHERE staff_id=$currentUser;";
						$resultsqlLeaveSelect = $conn->query($sqlLeaveSelect);
						
						if($resultsqlLeaveSelect->num_rows>0){
									
							while($rowLeaveSelect = $resultsqlLeaveSelect->fetch_assoc()){

									echo "<tr>";
									echo "<td>".$rowLeaveSelect["leave_title"]."</td>";
									echo "<td>".$rowLeaveSelect["leave_type"]."</td>";
									echo "<td>".$rowLeaveSelect["used_days"]."</td>";
									echo "<td>".$rowLeaveSelect["balanced_days"]."</td>";
									echo "<td>".$rowLeaveSelect["start_date"]."</td>";
									echo "<td>".$rowLeaveSelect["end_date"]."</td>";
									
								?>
									
									<td><a href="http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php?leavedelete=<?php echo $rowLeaveSelect["leave_id"]?>" 
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
		


<?php 

	}
						}
}
					

?>

<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src = 'js/bootstrap.js'></script>

</body>
</html>
