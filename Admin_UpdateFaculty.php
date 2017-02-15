
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Search Faculty</title>
<link href='css/bootstrap.css' rel = 'stylesheet'/>
<link href='css/Admin_DeleteFaculty.css' rel = 'stylesheet'/>
</head>
<body>

<?php 

		session_start();


?>

<div class='navbar navbar-default navbar-static-top'>
	<div class='container'>
	
		<a href='/' class='navbar-brand text-left title'>Faculty Management System</a>
		<ul class='nav navbar-nav navbar-right subtitle '>
			
			<li><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_HomePage2.php">Main Menu</a></li>
			<li><a href="Logout.php">Sign out</a></li>
		</ul>
		
	</div>
	
</div>


<div class='container'>
	
	<form class="form-inline" role="form" method="post" action="Admin_UpdateFaculty.php">
	<div class="row">
		<div class="form-group">
			<label for="searchWays" class="control-label">How do you want to search:</label>
			<select name="searchWays" class="form-control input-sm" id="searchWays" size="1">
				<option value="name">Search By Name</option>
			<!--	<option value="year">Search By Year</option> -->
				<option value="department">Search By Department</option>
			</select>
		</div>
		<div class='form-group'>
					
						<label for = "department" class="control-label">Department</label>
						
						<select name="department" class="form-control input-sm">
							<option value="English" selected="selected">English</option>
							<option value="Myanmar">Myanmar</option>
							<option value="Information System">Information System</option>
							<option value="Computational Mathematic">Computational Mathematic</option>
							<option value="Software">Software</option>
							<option value="Hardware">Hardware</option>
							<option value="Physics">Physics</option>
	  					</select>
	  					
						</div>
  		<div class="form-group" class="control-label">
    		<label for="search">Search:</label>
    		<input class="form-control input-sm" id="search" type="text" name="search"/>
    	</div>
    	<div class="form-group">
  		<button class="btn btn-info btn-sm" type="submit" name="submitButton" id="submitButton"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	
</div>
	
<br/><br/>
<div class="row">
	<table class='table table-bordered table-striped table-hover bg-info'>
		<thead>
			<th>Name</th>
			<th>Gender</th>
			<th>Marital Status</th>
			<th>Phone</th>
			<th>NRC</th>
			<th>Date of Birth</th>
			<th>Duty</th>
			<th>Email</th>
			<th>Department</th>
			<th class="size">Action</th>
		</thead>
		<tbody>
			
		<?php
		
		if(isset($_GET["staffupdate"])){
			$id = (int)$_GET["staffupdate"];
			$_SESSION["staff"] = $id;
			header("Location: Admin_UpdateFaculty_Profile.php");
		}

			if ( isset( $_POST["submitButton"] ) ) {
				
			
  					if( $_POST["searchWays"] == "name"){ 
			
	
				include 'DBConnection.php';
	
				$text = $_POST["search"];
				if($text!=""){
				$sqlNameStart = "SELECT * FROM staff WHERE name LIKE \"$text%\"";
				$resultsqlNameStart = $conn->query($sqlNameStart);
	
						if($resultsqlNameStart->num_rows >0){
							$flag = 0;
							while($row=$resultsqlNameStart->fetch_assoc()){
			
							$temp = $row["staff_id"];
							
							echo "<tr>";
							echo "<td>".$row["name"]."</td>";
							echo "<td>".$row["gender"]."</td>";
							echo "<td>".$row["marital_status"]."</td>";
							echo "<td>".$row["phone"]."</td>";
							echo "<td>".$row["nrc"]."</td>";
							echo "<td>".$row["date_of_birth"]."</td>";
							echo "<td>".$row["duty"]."</td>";
							echo "<td>".$row["email"]."</td>";
							$temp_user_type = $row["user_type_id"];
							$tempD = $row["department_id"];
							$nrc = $row["nrc"];
													
							
							if($tempD!=NULL){
							$sqlDepartment = "SELECT department_name FROM department WHERE department_id=$tempD";
							$resultsqlDepartment = $conn->query($sqlDepartment);
							      if($resultsqlDepartment == true){
									if($resultsqlDepartment->num_rows >0){
										while($rowD=$resultsqlDepartment->fetch_assoc()){
										echo"<td>".$rowD["department_name"]."</td>";
										}
									}	
							      }
							}
									else{
										echo "<td>".""."</td>";
									}
									
									
				$_SESSION["staff"] = $temp;
				
			?>
			
			<td><a href="Admin_Detail_Faculty_Button.php?staffdetail=<?php echo $temp?>" class="btn btn-info btn-sm" role="button" name="detail" >Detail</a>
			<a href="Admin_UpdateFaculty.php?staffupdate=<?php echo $temp?>" class="btn btn-info btn-sm" role="button" name="update" >Update</a></td>
			<?php
			echo "</tr>";
			
			
							}
  					}
  					
  				
			}
  					}
			}
			
			
			
  					
			if ( isset( $_POST["submitButton"] ) ) {		
  				
			if( $_POST["searchWays"] == "department"){ 
			
	
				include 'DBConnection.php';
	
				$department = $_POST["department"];
				$d_id = 0;
				
			$sqlPersonalDepartment = "SELECT department_id from department WHERE department_name=\"$department\"";
							$resultsqlPersonalDepartment = $conn->query($sqlPersonalDepartment);
							
								if($resultsqlPersonalDepartment->num_rows >0){
									
										while($row = $resultsqlPersonalDepartment->fetch_assoc()){
									 			$d_id = $row["department_id"];
												}
							
							
				
										}
				
				
				$sqlDepartmentSearch = "SELECT * FROM staff WHERE department_id =$d_id ";
				$resultsqlDepartmentSearch = $conn->query($sqlDepartmentSearch);
	
						if($resultsqlDepartmentSearch->num_rows >0){
							$flag = 0;
							while($rowDS=$resultsqlDepartmentSearch->fetch_assoc()){
			
							$temp = $rowDS["staff_id"];
							
							echo "<tr>";
							echo "<td>".$rowDS["name"]."</td>";
							echo "<td>".$rowDS["gender"]."</td>";
							echo "<td>".$rowDS["marital_status"]."</td>";
							echo "<td>".$rowDS["phone"]."</td>";
							echo "<td>".$rowDS["nrc"]."</td>";
							echo "<td>".$rowDS["date_of_birth"]."</td>";
							echo "<td>".$rowDS["duty"]."</td>";
							echo "<td>".$rowDS["email"]."</td>";
							$temp_user_type = $rowDS["user_type_id"];
							$tempD = $rowDS["department_id"];
							$nrc = $rowDS["nrc"];
													
							
							if($tempD!=NULL){
							$sqlDepartment = "SELECT department_name FROM department WHERE department_id=$tempD";
							$resultsqlDepartment = $conn->query($sqlDepartment);
							      if($resultsqlDepartment == true){
									if($resultsqlDepartment->num_rows >0){
										while($rowD=$resultsqlDepartment->fetch_assoc()){
										echo"<td>".$rowD["department_name"]."</td>";
										}
									}	
							      }
							}
									else{
										echo "<td>".""."</td>";
									}
									
					$_SESSION["staff"] = $temp;
			?>
			<td><a href="Admin_Detail_Faculty_Button.php?staffdetail=<?php echo $temp?>" class="btn btn-info btn-sm" role="button" name="detail" >Detail</a>
			<a href="Admin_UpdateFaculty.php?staffupdate=<?php echo $temp?>" class="btn btn-info btn-sm" role="button" name="update" >Update</a></td>
			<?php
			echo "</tr>";
			
							}
  					}
  					
  				
			}
  					}
  					
  				


//if(isset($_GET["staffupdate"])){
//	
//	include 'DBConnection.php';
//	$id_delete = (int)$_GET["staffdelete"];
//	$sqlDelete = "UPDATE staff SET status=0 WHERE staff_id=$id_delete;";
//	$resultsqlDelete = $conn->query($sqlDelete);
	
//	$id_user_type = "SELECT u.user_type_status FROM user_type u,staff s WHERE s.staff_id=$id_delete AND u.user_type_id=s.user_type_id";
//	$result_id_user_type = $conn->query($id_user_type);
//	
//	if($result_id_user_type->num_rows>0){
//		while($row = $result_id_user_type->fetch_assoc()){
//			$status = $row[user_type_status];
//		}
//	}
//	
//	$sqlUser_Type_Delete = "UPDATE user_type SET user_type_status=0 WHERE staff_id=$id_delete AND u.user_type_id=s.user_type_id";
//	$resultsqlUser_Type_Delete = $conn->query($sqlUser_Type_Delete);
//}
//?>
	
		</tbody>
	</table>

</div>
</form>
</div>
<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src = 'js/bootstrap.js'></script>
</body>
</html>

