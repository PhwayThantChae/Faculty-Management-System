<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<link href='css/bootstrap.css' rel='stylesheet'>
</head>
<body>


<?php
session_start();

if(isset($_POST["submit"])){

	ConnectDB();

}
else if(isset($_GET["login"])){
	echo "<br>";
	displayForm(0);
}
else{
	echo "<br><br><br><br><br><br><br><br>";
	displayForm(0);
}

function ConnectDB(){

	
	include 'DBConnection.php';
	
	$UserName = trim($_POST["inputName"]);
	$UserPassword = trim($_POST["inputPassword"]);

	$flagUser = 0;
	$flagAdmin = 0;
	$flagAdminName = 0;
	$flagUserName = 0;
	

	//$sql = "SELECT link_id, title, url, comment FROM link ORDER BY link_id";
	/////////////////////////////////////////////////////////////////////////////////////  Admin
	$sqlAdmin = "SELECT * FROM admin;";
	$sqlCheckAdmin = "SELECT * FROM admin WHERE name=\"$UserName\" AND password=\"$UserPassword\";";
	$sqlCheckAdminName = "SELECT * FROM admin WHERE name=\"$UserName\";";

	$resultsqlAdmin = $conn->query($sqlAdmin);
	$resultsqlCheckAdmin = $conn->query($sqlCheckAdmin);
	$resultsqlCheckAdminName = $conn->query($sqlCheckAdminName);
	////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////  User
	$sqlUser = "SELECT * FROM user_type;";
	$sqlCheckUser = "SELECT * FROM user_type WHERE user_type_name=\"$UserName\" AND user_type_password = \"$UserPassword\";";
	
	$sqlCheckUserName = "SELECT * FROM user_type WHERE user_type_name=\"$UserName\"";

	$resultsqlUser = $conn->query($sqlUser);
	$resultsqlCheckUser = $conn->query($sqlCheckUser);
	$resultsqlCheckUserName = $conn->query($sqlCheckUserName);


	////////////////////////////////////////////////////////////////////////////////////// Admin DB
	if($resultsqlAdmin->num_rows > 0){
			
		if($resultsqlCheckAdmin->num_rows > 0){

			while($rowAdmin = $resultsqlCheckAdmin->fetch_assoc()){

				
				header("Location: http://localhost/Faculty Management System/Faculty Management System/Admin_HomePage2.php");
				$_SESSION["name"] = $rowAdmin["name"];
				$flagAdmin = 1;

			}
		}
		else {
			if($resultsqlCheckAdminName->num_rows > 0){

				while($rowAdminName = $resultsqlCheckAdminName->fetch_assoc()){
					if($rowAdminName["name"] == $UserName){
						$flagAdminName = 1;
						displayForm(1);
					}

				}
			}
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////   User DB
	if($flagAdmin == 0){
		
		if($resultsqlCheckUser->num_rows > 0){
				$flagUser = 1;	
			while($row = $resultsqlCheckUser->fetch_assoc()){

			
				
				$tempID = $row["user_type_id"];
				$sqlID="SELECT staff_id FROM staff WHERE user_type_id=$tempID";
				$resultsqlID = $conn->query($sqlID);
				
				$sqlAuthorize = "SELECT status FROM staff WHERE user_type_id=$tempID";
				$resultsqlAuthorize = $conn->query($sqlAuthorize);
				
				if($resultsqlAuthorize->num_rows > 0){
					
				while($rowAuthorize= $resultsqlAuthorize->fetch_assoc()){
					
					if($rowAuthorize["status"]==1){
				
				$sqlstatus = "SELECT user_type_status FROM user_type WHERE user_type_id=$tempID";
				$resultsqlstatus = $conn->query($sqlstatus);
				
				if($resultsqlID->num_rows > 0){
					while($rowID = $resultsqlID->fetch_assoc()){
						
					
								$_SESSION["id"] = $rowID["staff_id"];
								//echo $_SESSION["id"];
								header("Location: http://localhost/Faculty Management System/Faculty Management System/FacultyUpdateProfile.php");
						
					}
				}
					}
					
				else{
						displayForm(6);
					}
				}
					}
				
				
			}
		}
		
			
		else {
			if($resultsqlCheckUserName->num_rows > 0){

				while($row = $resultsqlCheckUserName->fetch_assoc()){
					if($row["user_type_name"] == $UserName){
						$flagUserName =1;
						displayForm(1);
					}

				}
			}
		}

	}
	
	if($flagAdmin == 0 && $flagUser == 0 && $flagAdminName==0 && $flagUserName==0){
		displayForm(3);
	}

	$conn->close();
}
?>

<?php
function displayForm($a){

	
	
	echo "<div class='container'>";

	if($a == 1){
		echo "<br>";
		echo "<div class=\"alert alert-danger alert-dismissable\" role=\"alert\">
				 User name and password does not match.
					<a class=\"close\" data-dismiss=\"alert\" href=\"Login.php\">&times;</a>
      		</div>"; 
		echo "<br><br><br><br>";
	}
	if($a == 6){
		echo "<br>";
		echo "<div class=\"alert alert-danger alert-dismissable\" role=\"alert\">
				 You are not authorized to access this system.
					<a class=\"close\" data-dismiss=\"alert\" href=\"Login.php\">&times;</a>
      		</div>"; 
		echo "<br><br><br><br>";
	}
	
	
	if($a == 3){
		echo "<br>";
		echo "<div class=\"alert alert-danger alert-dismissable\" role=\"alert\">
				 You are not a registered member.  Please register.
					<a class=\"close\" data-dismiss=\"alert\" href=\"Login.php\">&times;</a>
      		</div>"; 
		echo "<br><br><br><br>";
	}
	
	//if($_POST["login"]){
	if(isset($_GET["login"])){
		 $new = $_GET["login"];
		if($new==2){
		//echo "<br>";
		echo "<div class=\"alert alert-danger alert-dismissable\" role=\"alert\">
				 You are already a registered member. Please log in.
					<a class=\"close\" data-dismiss=\"alert\" href=\"Login.php\">&times;</a>
      		</div>"; 
		echo "<br><br><br><br>";
		}
		
		if($new==4){
		//echo "<br>";
		echo "<div class=\"alert alert-success alert-dismissable\" role=\"alert\">
				 You have registered successfully.  Please log in.
					<a class=\"close\" data-dismiss=\"alert\" href=\"Login.php\">&times;</a>
      		</div>"; 
		echo "<br><br><br><br>";
	
		}
	}
	
	?>

<div class='row'>
<div class='col-md-7'><img class="img-responsive"
	src="UIT_Logo_Nero.jpg" /></div>
<div class='col-md-4 col-md-offset-1'>

<form class="form-signin" method="post" action="Login.php">
<h2 class="form-signin-heading">Please sign in</h2>

<label for="inputName" class="sr-only">Name</label> 
<input id="inputName" class="form-control" placeholder="Name" required=""
	autofocus="" type="text" name="inputName"> <br>
	
<label for="inputPassword" class="sr-only">Password</label> <input
	id="inputPassword" class="form-control" placeholder="Password"
	required="" type="password" name="inputPassword"> <br>
	
<button class="btn btn-md btn-primary btn-block" type="submit"
	name="submit">Sign in</button>
<p class="text-info">Not Registered? Register <a href="http://localhost/Faculty Management System/Faculty Management System/Registration.php">Here.</a></p>
</form>
</div>
</div>
</div>
	<?php
	}
	
	?>

<script>
	src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src='js/bootstrap.js'></script>
</body>
</html>
