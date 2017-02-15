<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<link href='css/bootstrap.css' rel = 'stylesheet'>
<link href='css/Admin_Detail_Button.css' rel= 'stylesheet'>
</head>
<body>

	

<div class='navbar navbar-default navbar-staic-top'>
	<div class='container'>
	
		<a href='/' class='navbar-brand text-left title'>Faculty Management System</a>
		<ul class='nav navbar-nav navbar-right subtitle '>
			<li><a href="http://localhost/Faculty Management System/Faculty Management System/Admin_HomePage2.php">Back</a></li>
			<li><a href="Logout.php">Sign out</a></li>
		</ul>
		
	</div>
	
</div>

<div class='container background-color'>

	<form action="Admin_Detail_Faculty_Button.php" method="post" >
	
	
	<?php 
	if(isset($_GET["staffdetail"])){
		
		include 'DBConnection.php';
		
		$staffID = $_GET["staffdetail"];
		
		$ID = 0;
		$department_name="";
		$sqlStaff = "SELECT * FROM staff WHERE staff_id=$staffID";
		$resultsqlStaff = $conn->query($sqlStaff);
		
		if($resultsqlStaff->num_rows>0){
			while($row=$resultsqlStaff->fetch_assoc()){
				$ID = $row["staff_id"];
				$department = $row["department_id"];
				
				if(isset($row["department_id"])){
				$sqlDepartment = "SELECT department_name FROM department WHERE department_id=$department";
							$resultsqlDepartment = $conn->query($sqlDepartment);
									if($resultsqlDepartment->num_rows >0){
										while($rowD=$resultsqlDepartment->fetch_assoc()){
										$department_name=$rowD["department_name"];
								}
							}
				}	
				
				$imageID = $row["image_id"];
				$imgDisplay = "";
				if(isset($row["image_id"])){
				$sqlDisplayImageUpdate = "SELECT * FROM image WHERE image_id=$imageID";
									$resultsqlDisplayImageUpdate = $conn->query($sqlDisplayImageUpdate);
										if($resultsqlDisplayImageUpdate->num_rows > 0){
												while($rowImageDisplay = $resultsqlDisplayImageUpdate->fetch_assoc()){
													$imgDisplay =$rowImageDisplay["image_data"];
													
												}
										}
				}							
						
	?>
	
				<?php echo '<img height="200" width="200" src = "data:image;base64,'.$imgDisplay.'">';?>
	
	<h4><strong>Personal Details</strong></h4>						
	<div class = 'row'>
	
		<div class='col-md-2 text-left'>
			<p><strong>Name</strong></p>
		</div>
		<div class='col-md-3 text-left'>
			<?php echo"<p>".$row["name"]."</p>"?>
			
		</div>
		
		<div class= 'col-md-3'>
			<p class= 'text-left'><strong>Phone Number</strong></p>
		</div>
		<div class= 'col-md-4'>
			<p class = 'text-left'></p>
			<?php echo"<p>".$row["phone"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class='col-md-2 text-left'>
			<p><strong>Gender</strong></p>
		</div>
		<div class='col-md-3 text-left'>
			<?php echo"<p>".$row["gender"]."</p>"?>
			
		</div>
		
		<div class= 'col-md-3'>
			<p class= 'text-left'><strong>Email</strong></p>
		</div>
		<div class= 'col-md-4'>
			<?php echo"<p>".$row["email"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class='col-md-2 text-left'>
			<p><strong>Marital Status</strong></p>
		</div>
		<div class='col-md-3 text-left'>
			<?php echo"<p>".$row["marital_status"]."</p>"?>
			
		</div>
		<div class= 'col-md-3'>
			<p class= 'text-left'><strong>Address</strong></p>
		</div>
		<div class= 'col-md-4 text-left'>
			
			<?php echo"<p>".$row["address"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class='col-md-2 text-left'>
			<p><strong>Department</strong></p>
		</div>
		<div class='col-md-3 text-left'>
			<?php echo"<p>".$department_name."</p>"?>
		</div>
		<div class= 'col-md-3 text-left'>
			<p class= 'text-left'><strong>City</strong></p>
		</div>
		<div class= 'col-md-4 text-left'>
			<?php echo"<p>".$row["email"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class='col-md-2 text-left'>
			<p><strong>Duty</strong></p>
		</div>
		<div class='col-md-3 text-left'>
		<?php echo"<p>".$row["duty"]."</p>"?>
		</div>
		<div class= 'col-md-3'>
			<p class= 'text-left'><strong>State</strong></p>
		</div>
		<div class= 'col-md-4'>
			<?php echo"<p>".$row["state"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class='col-md-2 text-left'>
			<p><strong>Religion</strong></p>
		</div>
		<div class='col-md-3 text-left'>
			<?php echo"<p>".$row["religious"]."</p>"?>
		</div>
		<div class= 'col-md-3'>
			<p class= 'text-left'><strong>Country</strong></p>
		</div>
		<div class= 'col-md-4'>
			<?php echo"<p>".$row["country"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class='col-md-2 text-left'>
			<p><strong>Nationality</strong></p>
		</div>
		<div class='col-md-3 text-left'>
			<?php echo"<p>".$row["nationality"]."</p>"?>
		</div>
		<div class= 'col-md-3'>
			<p class= 'text-left'><strong>Height</strong></p>
		</div>
		<div class= 'col-md-4'>
		<?php echo"<p>".$row["height"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class='col-md-2 text-left'>
			<p><strong>NRC</strong></p>
		</div>
		<div class='col-md-3 text-left'>
			<?php echo"<p>".$row["nrc"]."</p>"?>
		</div>
		<div class= 'col-md-3'>
			<p class= 'text-left'><strong>Hair Color</strong></p>
		</div>
		<div class= 'col-md-4'>
			<?php echo"<p>".$row["hair_color"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class='col-md-2 text-left'>
			<p><strong>Date of Birth</strong></p>
		</div>
		<div class='col-md-3 text-left'>
			<?php echo"<p>".$row["date_of_birth"]."</p>"?>
		</div>
		<div class= 'col-md-3'>
			<p class= 'text-left'><strong>Skin Color</strong></p>
		</div>
		<div class= 'col-md-4'>
			<?php echo"<p>".$row["skin_color"]."</p>"?>
		</div>
	</div>
	
	<div class = 'row'>
		<div class='col-md-2 text-left'>
			<p><strong>Weight</strong></p>
		</div>
		<div class='col-md-4 text-left'>
			<p>110 lb</p>
		</div>
	</div>
	
	<div class = 'row'>
		
		<div class= 'col-md-2'>
			<p class= 'text-left'><strong>Remark</strong></p>
		</div>
		<div class= 'col-md-3'>
			<?php echo"<p>".$row["remark"]."</p>"?>
		</div>
	</div>
	
	<?php 	}
		}
	?>
	</br></br>
	
	
	
	<h4><strong>Education Qualification</strong></h4>	
	<div class='row'>
		<div class='col-md-12'>
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr class='education_table'>
						<td class="bg-info tb-header-bg"><strong>Grade</strong></td>
						<td class="bg-info tb-header-bg"><strong>Start Date</strong></td>
						<td class="bg-info tb-header-bg"><strong>End Date</strong></td>
						<td class="bg-info tb-header-bg"><strong>Location</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php 
					
				$sqlEducation = "SELECT * FROM education WHERE staff_id=$ID";
				$resultsqlEducation = $conn->query($sqlEducation);
	
					if($resultsqlEducation->num_rows>0){
							while($rowEducation = $resultsqlEducation->fetch_assoc()){
			
	
								echo "<tr>";
									echo "<td>".$rowEducation["grade"]."</td>";
									echo "<td>".$rowEducation["start_date"]."</td>";
									echo "<td>".$rowEducation["end_date"]."</td>";
									echo "<td>".$rowEducation["location"]."</td>";
					
								echo "</tr>";
						}
	}
							?>
					
					
				</tbody>
			</table>
		</div>
	</div>
	
	
	</br></br>
	
	<h4><strong>Membership(Family)</strong></h4>	
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
					</tr>
				</thead>
				<tbody>
					<?php 
					
				$sqlMembership = "SELECT * FROM membership WHERE staff_id=$ID";
				$resultsqlMembership = $conn->query($sqlMembership);
	
					if($resultsqlMembership->num_rows>0){
							while($rowMembership = $resultsqlMembership->fetch_assoc()){
			
	
								echo "<tr>";
									echo "<td>".$rowMembership["name"]."</td>";
									echo "<td>".$rowMembership["relationship"]."</td>";
									echo "<td>".$rowMembership["gender"]."</td>";
									echo "<td>".$rowMembership["citizen"]."</td>";
									echo "<td>".$rowMembership["rank"]."</td>";
									echo "<td>".$rowMembership["background_edu"]."</td>";
									echo "<td>".$rowMembership["address"]."</td>";
					
								echo "</tr>";
						}
	}
							?>
					
				</tbody>
			</table>
		</div>
	</div>
	</br></br>
	
	<h4><strong>Foreign Status</strong></h4>	
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
					</tr>
				</thead>
				<tbody>
					<?php 
					
				$sqlForeign = "SELECT * FROM foreign_status WHERE staff_id=$ID";
				$resultsqlForeign = $conn->query($sqlForeign);
	
					if($resultsqlForeign->num_rows>0){
							while($rowForeign = $resultsqlForeign->fetch_assoc()){
			
	
								echo "<tr>";
									echo "<td>".$rowForeign["title"]."</td>";
									echo "<td>".$rowForeign["start_date"]."</td>";
									echo "<td>".$rowForeign["end_date"]."</td>";
									echo "<td>".$rowForeign["period"]."</td>";
									echo "<td>".$rowForeign["country"]."</td>";
									echo "<td>".$rowForeign["sponsorship"]."</td>";
									echo "<td>".$rowForeign["currency_amount"]."</td>";
									echo "<td>".$rowForeign["type"]."</td>";
					
								echo "</tr>";
						}
	}
							?>
					
				</tbody>
			</table>
		</div>
	</div>
	</br></br>
	
	<h4><strong>Service Record</strong></h4>	
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
					</tr>
				</thead>
				<tbody>
					<?php 
					
				$sqlService = "SELECT  r.rank_id,s.s_id,r.rank_name,r.rank_scale,s.start_date,s.end_date,s.head_department,s.sub_department,s.remark,s.department_id FROM service_record s, rank r, service_rank a
										  WHERE s.s_id=a.s_id AND r.rank_id = a.rank_id AND s.staff_id=$ID";
						$resultsqlService = $conn->query($sqlService);
						
						if($resultsqlService->num_rows > 0){
							while($rowService = $resultsqlService->fetch_assoc()){
									
								echo "<tr>";
									echo "<td>".$rowService["rank_name"]."</td>";
									echo "<td>".$rowService["rank_scale"]."</td>";
									echo "<td>".$rowService["start_date"]."</td>";
									echo "<td>".$rowService["end_date"]."</td>";
									echo "<td>".$rowService["head_department"]."</td>";
									echo "<td>".$rowService["sub_department"]."</td>";
									echo "<td>".$rowService["department_id"]."</td>";
									echo "<td>".$rowService["remark"]."</td>";
								echo "</tr>";
							}
						}
							?>
					
				</tbody>
			</table>
		</div>
	</div>
	</br></br>
	
	<h4><strong>Research</strong></h4>	
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
					</tr>
				</thead>
				<tbody>
	
					<?php 
					
				$sqlResearch = "SELECT * FROM research WHERE staff_id=$ID";
				$resultsqlResearch = $conn->query($sqlResearch);
	
					if($resultsqlResearch->num_rows>0){
							while($rowResearch = $resultsqlResearch->fetch_assoc()){
			
	
								echo "<tr>";
									echo "<td>".$rowResearch["research_title"]."</td>";
									echo "<td>".$rowResearch["start_date"]."</td>";
									echo "<td>".$rowResearch["end_date"]."</td>";
									echo "<td>".$rowResearch["research_status"]."</td>";
									echo "<td>".$rowResearch["research_type"]."</td>";
					
								echo "</tr>";
						}
	}
							?>
				</tbody>
			</table>
		</div>
	</div>
	</br></br>
	
	<h4><strong>Accepted Paper</strong></h4>	
	<div class='row'>
		<div class='col-md-12'>
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr class='education_table'>
						<td class="bg-info tb-header-bg"><strong>Paper Title</strong></td>
						<td class="bg-info tb-header-bg"><strong>Paper Type</strong></td>
						<td class="bg-info tb-header-bg"><strong>Publication</strong></td>
						<td class="bg-info tb-header-bg"><strong>Country</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php 
					
				$sqlPaper = "SELECT * FROM accepted_paper WHERE staff_id=$ID";
				$resultsqlPaper = $conn->query($sqlPaper);
	
					if($resultsqlPaper->num_rows>0){
							while($rowPaper = $resultsqlPaper->fetch_assoc()){
			
	
								echo "<tr>";
									echo "<td>".$rowPaper["paper_title"]."</td>";
									echo "<td>".$rowPaper["paper_type"]."</td>";
									echo "<td>".$rowPaper["publication"]."</td>";
									echo "<td>".$rowPaper["country"]."</td>";
					
								echo "</tr>";
						}
	}
							?>
					
				</tbody>
			</table>
		</div>
	</div>
	</br></br>

	<h4><strong>Passport</strong></h4>	
	<div class='row'>
		<div class='col-md-12'>
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr class='education_table'>
						<td class="bg-info tb-header-bg"><strong>Passport Number</strong></td>
						<td class="bg-info tb-header-bg"><strong>Issue Date</strong></td>
						<td class="bg-info tb-header-bg"><strong>Expiry Date</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php 
					
				$sqlPP= "SELECT * FROM passport WHERE staff_id=$ID";
				$resultsqlPP = $conn->query($sqlPP);
	
					if($resultsqlPP->num_rows>0){
							while($rowPP = $resultsqlPP->fetch_assoc()){
			
	
								echo "<tr>";
									echo "<td>".$rowPP["pp_number"]."</td>";
									echo "<td>".$rowPP["issue_date"]."</td>";
									echo "<td>".$rowPP["expiry_date"]."</td>";
					
								echo "</tr>";
						}
	}
							?>
					
				</tbody>
			</table>
		</div>
	</div>
	</br></br>
	
	<h4><strong>Bond</strong></h4>	
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
					</tr>
				</thead>
				<tbody>
					<?php 
					
				$sqlBond= "SELECT * FROM bond WHERE staff_id=$ID";
				$resultsqlBond = $conn->query($sqlBond);
	
					if($resultsqlBond->num_rows>0){
							while($rowBond = $resultsqlBond->fetch_assoc()){
			
	
								echo "<tr>";
									echo "<td>".$rowBond["bond_title"]."</td>";
									echo "<td>".$rowBond["bond_type"]."</td>";
									echo "<td>".$rowBond["register_date"]."</td>";
									echo "<td>".$rowBond["period"]."</td>";
									echo "<td>".$rowBond["amount"]."</td>";
					
								echo "</tr>";
						}
	}
				else{
					echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "</tr>";
				}
							?>
					
				</tbody>
			</table>
		</div>
	</div>
	</br></br>
	
	<h4><strong>Leave</strong></h4>	
	<div class='row'>
		<div class='col-md-12'>
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr class='education_table'>
						<td class="bg-info tb-header-bg"><strong>Leave Title</strong></td>
						<td class="bg-info tb-header-bg"><strong>Leave Type</strong></td>
						<td class="bg-info tb-header-bg"><strong>Used Days</strong></td>
						<td class="bg-info tb-header-bg"><strong>Balanced Days</strong></td>
						<td class="bg-info tb-header-bg"><strong>Start Date</strong></td>
						<td class="bg-info tb-header-bg"><strong>End Date</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php 
					
				$sqlLeave= "SELECT * FROM leave_days WHERE staff_id=$ID";
				$resultsqlLeave = $conn->query($sqlLeave);
	
					if($resultsqlLeave->num_rows>0){
							while($rowLeave = $resultsqlLeave->fetch_assoc()){
			
	
								echo "<tr>";
									echo "<td>".$rowLeave["leave_title"]."</td>";
									echo "<td>".$rowLeave["leave_type"]."</td>";
									echo "<td>".$rowLeave["used_days"]."</td>";
									echo "<td>".$rowLeave["balanced_days"]."</td>";
									echo "<td>".$rowLeave["start_date"]."</td>";
									echo "<td>".$rowLeave["end_date"]."</td>";
					
								echo "</tr>";
						}
	}
				else{
					echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "</tr>";
				}
							?>
					
				</tbody>
			</table>
		</div>
	</div>
	
	</br></br>
	
</form>	

</div>
<?php 
}?>
<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src = 'js/bootstrap.js'></script>


</body>
</html>
