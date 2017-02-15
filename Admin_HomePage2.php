<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<link href='css/bootstrap.css' rel = 'stylesheet'>
<link href='css/Admin_HomePage2_CSS.css' rel = 'stylesheet'>
</head>
<body>

<div class='navbar navbar-default navbar-static-top'>
	<div class='container'>
	
		<a href='/' class='navbar-brand text-left title'>Faculty Management System</a>
		<ul class='nav navbar-nav navbar-right subtitle '>
			
			
			<li><a href="Logout.php" class="sign-out">Sign out</a></li>
		</ul>
		
	</div>
	
</div>


<?php session_start();
		
?>



<div class='container'>
		
		<div class = 'row'>
			<div class='col-md-offset-0 col-md-4'>
			
				<img src="bench.png"/>
			</div>
			
			<div class = 'col-md-5 col-md-offset-3 size'>
				
				<h3><strong>This is Faculty Management System for University Officials.</strong></h3>
				<div class='lead p-size'>
				<p>These are things you can do</p>
				<ul class="list-unstyled">
					<li>Create new faculty when new faculty enters to University</li>
					<li>Update faculty infomation</li>
					<li>Delete faculty profile from the System</li>
					<li>Search faculty by name, department or year</li>
				</ul>
				</div>
			</div>
			
		</div>
		
		<div class= 'row'>
			<div class='col-md-3'>
			<div class='panel panel-default panel-margin'>
				<div class='panel-heading'>
				
				<h2 class='panel-title text-center'><span class = 'glyphicon glyphicon-pencil'></span><strong>Create</strong></h2>
				</div>
				<div class='panel-body text-center'>
					<h5><a href='Admin_CreateFaculty.php' class='decoration'><strong>Create New Faculty</strong></a></h5>
				</div>
			</div>
			</div>
			
			<div class='col-md-3'>
			<div class='panel panel-default panel-margin'>
				<div class='panel-heading'>
				
				<h2 class='panel-title text-center'><span class = 'glyphicon glyphicon-edit'></span><strong>Update</strong></h2>
				</div>
				<div class='panel-body text-center'>
					<h5><a href='Admin_UpdateFaculty.php' class='decoration'><strong>Update Faculty</strong></a></h5>
				</div>
			</div>
			</div>
			
			<div class='col-md-3'>
			<div class='panel panel-default panel-margin'>
				<div class='panel-heading'>
				
				<h2 class='panel-title text-center'><span class = 'glyphicon glyphicon-trash'></span><strong>Delete</strong></h2>
				</div>
				<div class='panel-body text-center'>
					<h5><a href='Admin_DeleteFaculty.php' class='decoration'><strong>Delete Faculty</strong></a></h5>
				</div>
			</div>
			</div>
			
			<div class='col-md-3'>
			<div class='panel panel-default panel-margin'>
				<div class='panel-heading'>
				
				<h2 class='panel-title text-center'><span class = 'glyphicon glyphicon-list-alt'></span><strong>View</strong></h2>
				</div>
				<div class='panel-body text-center'>
					<h5><a href='Admin_ViewFacultyList.php' class='decoration'><strong>View Faculty List</strong></a></h5>
				</div>
			</div>
			</div>
		</div>	
		
		
		
</div>

		

<div class="footer">
<h4>University of Information Technology</h4> 
</div>
 





<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src = 'js/bootstrap.js'></script>


</body>
</html>