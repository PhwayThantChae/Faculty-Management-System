<html>
<head>
<title>Create Faculty</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<style type="text/css">
      .error { background:rgba(600,100,100,5.3); color: white; padding: 0.2em; }
</style>
</head>
<body>
<?php

if ( isset( $_POST["submitButton"] ) ) {
  processForm();
} else {
  displayForm( array() );
}

function validateField( $fieldName, $missingFields ) {
  if ( in_array( $fieldName, $missingFields ) ) {
    echo 'class="error"';
  }
}

function setValue( $fieldName ) {
  if ( isset( $_POST[$fieldName] ) ) {
    echo $_POST[$fieldName];
  }
}

function setChecked( $fieldName, $fieldValue ) {
  if ( isset( $_POST[$fieldName] ) and $_POST[$fieldName] == $fieldValue ) {
    echo ' checked="checked"';
  }
}

function setSelected( $fieldName, $fieldValue ) {
  if ( isset( $_POST[$fieldName] ) and $_POST[$fieldName] == $fieldValue ) {
    echo ' selected="selected"';
  }
}

function processForm() {
 $requiredFields = array("name","gender","department","duty","religion"
 						,"nationality","NRC","dob","nativetown","phone","email","address","city","state","country","status");
 $missingFields = array();

  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
      $missingFields[] = $requiredField;
    }
  }

  if ( $missingFields ) {
    displayForm( $missingFields );
  } else {
    displayThanks();
  }
}

function displayForm( $missingFields ) {
?>

    <?php if ( $missingFields ) { ?>
    <p class="error">There were some problems with the form you submitted.
     Please complete the fields highlighted below and click Send Details to resend the form.</p>
    <?php } else { ?>
    <p>Thanks for choosing to join The Widget Club. To register, please fill in your details below and click Send Details. 
    Fields marked with an asterisk (:) are required.</p>
    <?php } ?>
    <div class='container'>
<fieldset><legend><strong>PERSONAL DETAIL</strong></legend>
<form action="createFaculty_modified.php" method="post">
<p> <em>Please upload your photo.</em></p>
<input type="file" name="imageUpload" accept="image/*"/><br/>
<button type="submit" name="submitButton" class="btn-info btn">Submit</button><br/>
 <table class="table">
 
 <form class="form-horizontal">
 <div class="form-group">
 <tr><td><label>Title:</label></td>
 <td>
 <select name="Title">
 		<option value="Mr" <?php setSelected("Title","Mr")?> selected="selected">Mr</option>
 		<option value="Ms" <?php setSelected("Title","Ms")?>>Ms</option>
		<option value="Mrs" <?php setSelected("Title","Mrs")?>>Mrs</option>
		<option value="Dr" <?php setSelected("Title","Dr")?>>Dr</option>
 </select>
 </td>
 </tr>
 </div>
 </form>
 
<form class="form-horizontal">
 <div class="form-group">
 <tr>
 	<td><label for="MyanmarName"<?php validateField("MyanmarName", $missingFields)?>>Myanmar Name:</label></td>
 	<td><input type="text" size="35" class="form-control" maxlength="250" name="MyanmarName" value="<?php setValue("MyanmarName")?>"/></td>
	<td><label for="EnglishName"<?php validateField("EnglishName", $missingFields)?>>English Name:</label></td>
	<td><input type="text" size="35"  maxlength="250" class="form-control"
	name="EnglishName" id="EnglishName" value="<?php setValue("EnglishName")?>"/></td>
 </tr>
 </div>
</form>
 
  
			<form class="form-horizontal">
			 <div class="form-group">
			 <tr>
				<td><label for="nrc" <?php validateField("nrc",$missingFields)?>> NRC:</label></td>
				<div class="col-sm-10">
				<td><input type="text" class="form-control" name="nrc" id="nrc" size="35" maxlength="250" 
				placeholder="12/****(NAING)******"/ value="<?php setValue("nrc")?>">
				</td>
				</div>
			 </tr>
			 </div>
			</form>
			
			<form class="form-horizontal">
			<div class="form-group">
			<tr>
			<td><label for="birth" name="birth" <?php validateField("birth", $missingFields)?>> Date of Birth:</label></td>
			    <div class="col-sm-10">
				<td><input type="text" class="form-control" id="birth" size="35" maxlength="250" placeholder="DD/MM/YYYY" value="<?php setValue("birth")?>"/>
				</td>
				</div>
			 </tr>
			</div>
			</form>
			
			<form class="form-horizontal">
			    <div class="form-group">
			    <tr>
				<td><label for="Gender"<?php validateField("Gender", $missingFields)?>>Gender:</label></td>
				<td><table><tr><td><input type="radio" name="Gender" value="Male" <?php setChecked("Gender","Male")?>/>Male </td></tr>
				<tr><td><input type="radio" name="Gender" value="Female" <?php setChecked("Gender","Female")?>/>Female</td></tr></table>
				</td>
			    </tr>
			    </div>
			    </form>
			    
			    <form class="form-horizontal">
			    <div class="form-group">
			   <tr>
				<td><label <?php validateField("status", $missingFields)?>>Marterial Status:</label></td>
				<td><select name="status">
		       <option value="s" selected="selected" <?php setSelected("status","s")?>>Single</option>
		       <option value="m" <?php setSelected("status","m")?>>Married</option>
	            </select></td>
			     </tr>
			    </div>
			    </form>
			    
			    <form class="form-horizontal">
			    <div class="form-group">
			    <tr>
				<td><label <?php validateField("Department", $missingFields)?>>Department:</label></td>
				<td><input type="text" name="Department" size="35" maxlength="250" class="form-control" value="<?php setValue("Department")?>"/></td>
				<td><label <?php validateField("Duty", $missingFields)?>>Duty:</label></td>
				<td><input type="text" name="Duty" size="35" maxlength="250"  class="form-control" value="<?php setValue("Duty")?>"/></td>
			    </tr>
			    </div>
			    </form>
		
			    
			    <form class="form-horizontal">
			    <div class="form-group">
			    <tr>
				<td> <label <?php validateField("Religious", $missingFields)?>>Religious:</label></td>
				<td><input type="text" name="Religious" size="35" maxlength="250" class="form-control" value="<?php setValue("Religious")?>"/></td>
				
			   	<td> <label <?php validateField("Nationality", $missingFields)?>>Nationality:</label> </td>
				<td>	<input type="text" name="Nationality" size="35" maxlength="250" class="form-control" value=" <?php setValue("Nationality")?>"/></td>
			    </tr>
			    </div>
			    </form>
			    
			    
			    <tr>
				<td><label <?php validateField("NativeTown", $missingFields)?>>Native Town:</label> </td>
				<td>	<input type="text" name="NativeTown" size="35" maxlength="250" class="form-control" value="<?php setValue("NativeTown")?>"/></td>
			    </tr>
			    
			    <tr>
				<td><label <?php validateField("Address", $missingFields)?>> Address: </label></td>
				<td><input type="text" name="Address" size="35" maxlength="250" class="form-control" value="<?php setValue("Address")?>"/></td>
			    </tr>
			    
			      
			    <form class="form-horizontal">
			    <div class="form-group">
			    <tr>
				<td> <label <?php validateField("state", $missingFields)?>>State:</label></td>
				<td><input type="text" name="state" size="35" maxlength="250" class="form-control" value="<?php setValue("state")?>"/></td>
				
			   	<td> <label <?php validateField("country", $missingFields)?>>Country:</label> </td>
				<td>	<input type="text" name="country" size="35" maxlength="250" class="form-control" value="<?php setValue("country")?>"/></td>
			    </tr>
			    </div>
			    </form>
			    
			    
			    <form class="form-horizontal">
			    <div class="form-group">
			    <tr>
				<td> <label>Height:</label></td>
				<td><input type="text" name="height" size="35" maxlength="250" class="form-control" value="<?php setValue("height")?>"/></td>
				
			   	<td> <label>Weight:</label> </td>
				<td>	<input type="text" name="weight" size="35" maxlength="250" class="form-control" value="<?php setValue("weight")?>"/></td>
			    </tr>
			    </div>
			    </form>
			    
			      
			    <form class="form-horizontal">
			    <div class="form-group">
			    <tr>
				<td> <label>Eye Color:</label></td>
				<td><input type="text" name="ecolor" size="35" maxlength="250" class="form-control" value="<?php setValue("ecolor")?>"/></td>
				
			   	<td> <label>Skin Color:</label> </td>
				<td>	<input type="text" name="scolor" size="35" maxlength="250" class="form-control" value="<?php setValue("scolor")?>"/></td>
			    </tr>
			    </div>
			    </form>
			    
			    
			      <tr>
				<td> <label>Remark:</label></td>
				<td><textarea rows="20" cols="50" name="remark" ><?php setValue("remark")?></textarea></td>
			    </tr>
			    </div>
 
 </table>
</form>
</fieldset>
</div>

<div class='container'>
<fieldset>
<legend>Education Qualification</legend>
<form action="" method="post">
<table class='table'>
<form class="form-horizontal">
<div class="form-group">
<tr> <td> <label <?php validateField("Grade", $missingFields)?>>Grade:</label> </td>
<td><input type="text" name="Grade" size="35" maxlength="250" class="form-control" value="<?php setValue("Grade")?>"/></td>
</tr>

<tr><td><label <?php validateField("StartDate", $missingFields)?>>Start Date: </td>
<td> 	<input type="text" name="StartDate" size="35" maxlength="250" class="form-control" value="<?php setValue("startDate")?>"/></td>
<td> <label <?php validateField("EndDate", $missingFields)?>>End Date:</label> </td>
<td><input type="text" name="EndDate" size="35" maxlength="250" class="form-control" value="<?php setValue("EndDate")?>"/></td>
</tr>

<tr><td><label <?php validateField("location", $missingFields)?>>Location:</label></td>
<td> 	<input type="text" name="location" size="35" maxlength="250" class="form-control" value="<?php setValue("location")?>"/></td>
</tr></div>
</form>
</table>
 <input type="button" name="btn" class="btn-info btn-sm" value="ADD" />
 
 <table class='table table-bordered table-striped'>
	<tr> <th> Grade </th>
		<th> Start Date </th>
		<th> End Date</th>
		<th>Location</th>
	</tr>
	<tbody>
	<tr> 
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		</tr>
	</tbody>
</table>
</form>
</fieldset>
</div>

<div class='container'>

<fieldset><legend>Membership(Family)</legend>
<form action="" method="post">
<table class='table'>
<form class="form-horizontal">
			<div class="form-group">
<tr> <td><label <?php validateField("MemberName", $missingFields)?>>Name:</label> </td>
    <td> <input type="text" name="MemberName" size="35" maxlength="250" class="form-control" value="<?php setValue("MemberName")?>"/></td>
   </tr>
   
   <tr> <td><label <?php validateField("MemberRelation", $missingFields)?>>Relationship:</label></td>
   <td><input type="text" name="MemberRelation" size="35" maxlength="250" class="form-control" value="<?php setValue("MemberRelation")?>"/></td>
     
   <td> <label <?php validateField("MemberCiti", $missingFields)?>>Citizen:</td>
   <td><input type="text" name="MemberCiti" size="35" maxlength="250" class="form-control" value="<?php setValue("MemberCiti")?>"/></td> 
   </tr>
   <tr>
				<td><label <?php validateField("Gender", $missingFields)?>>Gender:</td>
				<td><table><tr><td><input type="radio" name="Gender" value="Male" <?php setChecked("Gender","Male")?>/>Male </td></tr>
				<tr><td><input type="radio" name="Gender" value="Female" <?php setChecked("Gender","Female")?>/>Female</td></tr></table>
				</td>
			    </tr>
 
   <tr> <td><label <?php validateField("MemberRank",$missingFields)?>>Rank:</label> </td>
    <td> <input type="text" name="MemberRank" size="35" maxlength="250" class="form-control" value="<?php setValue("MemberRank")?>"/></td>
   </tr>
   
   <tr> <td><label <?php validateField("MemberEducation", $missingFields)?>>Background Education:</label></td>
   <td><input type="text" name="MemberEducation" size="35" maxlength="250" class="form-control" value="<?php setValue("MemberEducation")?>"/></td>
   </tr>

  <tr> <td><label <?php validateField("MemberAddress", $missingFields)?>>Address:</label></td>
   <td><input type="text" name="MemberAddress" size="35" maxlength="250" class="form-control" value="<?php setValue("MemberAddress")?>"/></td>
   </tr></div></form>
</table>


<button type="submit" class="btn-info btn-sm">ADD</button><br/>

<table class='table table-bordered table-striped'>
	<tr> <th> Name </th>
		<th> Relationship</th>
		<th> Gender</th>
		<th>Citizen</th>
		<th> Rank</th>
		<th>Background Education</th>
		<th> Address</th>
		
	</tr>
	
	<tbody>
	<tr> 
		<td> </td>
			<td>     </td>
				<td>    </td>
					<td>     </td>
					<td> </td>
			<td>     </td>
				<td>    </td>
		</tr>
	</tbody>
</table>
</form>
</fieldset>
</div>

<div class='container'>

<fieldset><legend>Training</legend>
<form action="" method="post">
<table class='table'>
<form class="form-horizontal">
			<div class="form-group">
<tr> <td> <label <?php validateField("trainingTitle", $missingFields)?>>Training Title: </td>
<td><input type="text" name="trainingTitle" size="35" maxlength="250" class="form-control" value="<?php setValue("trainingTitle")?>"/></td>
 <td> <label <?php validateField("trainingCentre", $missingFields)?>>Training Centre: </td>
<td><input type="text" name="trainingCentre" size="35" maxlength="250" class="form-control" value="<?php setValue("trainingCentre")?>"/></td>
</tr>

<tr> <td><label <?php validateField("trianingBatch", $missingFields)?>>Batch: </td>
<td><input type="text" name="trainingBatch" size="35" maxlength="250" class="form-control" value="<?php setValue("trianingBatch")?>"/></td>
 <td> <label <?php validateField("trianingspon", $missingFields)?>>Sponsorship: </td>
<td><input type="text" name="trainingspon" size="35" maxlength="250" class="form-control" value="<?php setValue("trianingspon")?>"/></td>
</tr>

<tr> <td> <label <?php validateField("trainingcountry", $missingFields)?>>Country: </td>
<td><input type="text" name="trainingcountry" size="35" maxlength="250" class="form-control" value="<?php setValue("trainingcountry")?>"/></td>
</tr>

<tr> <td> <label <?php validateField("trainingCity", $missingFields)?>>City: </td>
<td><input type="text" name="trainingCity" size="35" maxlength="250" class="form-control" value="<?php setValue("trainingCity")?>"/></td>
</tr>

<tr> <td> <label <?php validateField("trainingassess", $missingFields)?>>Assessment (Pass/ Fail): </td>
<td><input type="text" name="trainingassess" size="35" maxlength="250" class="form-control" value="<?php setValue("trainingassess")?>"/></td>
</tr></div></form>
</table>
<button type="submit" class="btn-info btn-sm">Add</button>
</br>

<table class='table table-bordered table-striped'>
	<tr> <th> Training Title</th>
		<th> Batch </th>
		<th> Training Centre </th>
		<th> Country</th>
		<th> City </th>
		<th> Sponsorship </th>
		<th> Assessment (Pass/Fail) </th>
	</tr>
	<tbody>
	<tr> 
		<td> </td>
			<td>     </td>
				<td>    </td>
					<td>     </td>
						<td>    </td>
							<td>     </td>
								<td>     </td>
								
		</tr>
	</tbody>
</table>
</form>
</fieldset>
 </div>
 
 <div class='container'>

<fieldset><legend>Foreign Status</legend>
<form action="" method="post">
<table class='table'>
 <form class="form-horizontal">
			<div class="form-group">
<tr> <td> Title: </td>
<td><input type="text" name="title" size="35" maxlength="250" class="form-control" value="<?php setValue("title")?>"/> </td>
</tr>


<tr> <td> Start Date: </td>
<td><input type="text" name="startDate" size="35" maxlength="250" class="form-control" value="<?php setValue("startDate")?>"/> </td>
<td>End Date: </td>
<td> <input type="text" name="endDate" size="35" maxlength="250" class="form-control" value="<?php setValue("endDate")?>"/></td>
</tr>

<tr> <td> Period: </td>
<td> <input type="text" name="period" size="35" maxlength="250" class="form-control" value="<?php setValue("period")?>"/></td>
</tr>

<tr> <td> Country: </td>
<td> <input type="text" name="country" size="35" maxlength="250" class="form-control" value="<?php setValue("country")?>"/></td>
</tr>

<tr> <td> Sponsorship: </td>
<td> <input type="text" name="sponsor" size="35" maxlength="250" class="form-control" value="<?php setValue("sponsor")?>"/></td>
</tr>

<tr> <td> Current Amount (you get amount for this foreign) : </td>
<td> <input type="text" name="ForeignCurrencyAmount" size="35" maxlength="250" class="form-control" value="<?php setValue("ForeignCurrencyAmount")?>"/></td>
</tr>

<tr> <td> Type: </td>
<td> <input type="text" name="ForeignType" size="35" maxlength="250" class="form-control" value="<?php setValue("ForeignType")?>"/></td>
</tr></div></form>
</table>
<button type="submit" class="btn-info btn-sm">Add</button>
</br>

<table class='table table-bordered table-striped'>
	<tr> <th> Title</th>
		<th> Start Date </th>
		<th> End Date</th>
		<th> Period</th>
		<th> Country </th>
		<th> Sponsorship </th>
		<th> Current Amount </th>
		<th> Type </th>
	</tr>
	<tbody>
	<tr> 
		<td> </td>
			<td>     </td>
				<td>    </td>
					<td>     </td>
						<td>    </td>
							<td>     </td>
								<td>     </td>
									<td>          </td>
								
		</tr>
	</tbody>
</table>
</form>
</fieldset>
</div>

<div class='container'>
<fieldset><legend>Service Record
         </legend>
		        <form action="" method="post">
		        	<table class='table'>
		       <form class="form-horizontal">
			<div class="form-group">
			     <tr>
				<td> Rank Name</td>
				<td><input type="text" name="record" size="35" class="form-control" maxlength="250" value="<?php setValue("record")?>"/></td>
			     </tr>
			    <tr>
				<td> Pay Scale</td>
				<td><input type="text" name="record" size="35" maxlength="250" class="form-control" value="<?php setValue("record")?>"/></td>
			    </tr>
			    
			    <tr>
			   	<td> Start Date </td>
				<td><input type="text" name="record" size="35" maxlength="250" class="form-control" value="<?php setValue("record")?>"/></td>
				<td> End Date </td>
				<td><input type="text" name="record" size="35" maxlength="250" class="form-control" value="<?php setValue("record")?>"/></td>
			    </tr>
			    
			    <tr>
				<td> Head Department </td>
				<td><input type="text" name="record" size="35" maxlength="250" class="form-control" value="<?php setValue("record")?>"/></td>
					<td> Sub Department </td>
				<td><input type="text" name="record" size="35" maxlength="250" class="form-control" value="<?php setValue("record")?>"/></td>
			    </tr>
			    
			    <tr>
				<td> Remark  </td>
				<td><input type="text" name="record"size="35" maxlength="250" class="form-control" value="<?php setValue("record")?>"/></td>
			    </tr></div></form>
</table>
		       <input type="button" name="btn" class="btn-info btn-sm" value="ADD" />
		     
<table class='table table-bordered table-striped'>
	<tr> <th> Rank Name</th>
		<th> Pay Scale </th>
		<th> Start Date</th>
		<th> End Date</th>
		<th> Head Department </th>
		<th> Sub Department </th>
		<th> Department </th>
		<th> Remark(eg.Transfer,Promotion,Start Service, Transfer and Promotion ) </th>
	</tr>
	<tbody>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	</tbody>
</table>
</form>
  </fieldset>
</div>

<div class='container'>
<fieldset><legend>Research

         </legend>
		        <form action="" method="post">
		        <table class='table'>
		        <form class="form-horizontal">
			<div class="form-group">
			     <tr>
				<td> Research Title:</td>
				<td><input type="text" name="research" size="35" maxlength="250" class="form-control" value="<?php setValue("research")?>"/></td>
			     </tr>
			
			    <tr>
				<td> Start Date: </td>
				<td><input type="text" name="research" size="35" maxlength="250" class="form-control" value="<?php setValue("research")?>"/></td>
				<td> End Date: </td>
				<td><input type="text" name="research" size="35" maxlength="250" class="form-control" value="<?php setValue("research")?>"/></td>
			    </tr>
			    
			    <tr>
				<td> Research Status: </td>
				<td><input type="text" name="research" size="35" maxlength="250" class="form-control" value="<?php setValue("research")?>"/></td>
				<td> Research Type: </td>
				<td><input type="text" name="research" size="35" maxlength="250" class="form-control" value="<?php setValue("research")?>"/></td>
			    </tr>
			    </div></form>
</table>
		       <input type="button" name="btn" class="btn-info btn-sm" value="ADD" />
		     
		       

<table class='table table-striped table-bordered'>
	<tr> <th> Research title </th>
		<th>Start Date  </th>
		<th> End Date</th>
		<th> Research Status </th>
		<th> Research Type </th>
		
	</tr>
	<tbody>
	<tr> 
		<td> </td>
			<td>     </td>
				<td>    </td>
					<td>     </td>
						<td>    </td>
</tr>
	</tbody>
</table>
		        </form>
  </fieldset>
</div>

<div class='container'>
<fieldset><legend>Accepted Paper: 

         </legend>
		        <form action="" method="post">
		        <table class='table'>
		      <form class="form-horizontal">
			<div class="form-group"> 
			     <tr>
				<td> Paper Title:</td>
				<td><input type="text" name="paper" size="35" maxlength="250" class="form-control" value="<?php setValue("paper")?>"/></td>
			     </tr>
			
			    <tr>
				<td> Type: </td>
				<td><input type="text" name="paper" size="35" maxlength="250" class="form-control" value="<?php setValue("paper")?>"/></td>
			    </tr>
			    
			    <tr>
			   	<td> Publication: </td>
				<td><input type="text" name="paper" size="35" maxlength="250" class="form-control" value="<?php setValue("paper")?>"/></td>
			    </tr>
			    
			    <tr>
				<td> Country: </td>
				<td><input type="text" name="paper" size="35" maxlength="250" class="form-control" value="<?php setValue("paper")?>"/></td>
			    </tr></div></form>
			    
</table>
		       <input type="button" name="btn" class="btn-info btn-sm" value="ADD" />
		    
		       
<table class='table table-bordered table-striped'>
	<tr> <th> Paper title (eg: conference paper) </th>
		<th> Type </th>
		<th> Publication(eg: 9th International Conference on Computer Applications(ICCA)) </th>
		<th> Country </th>
		
		
	</tr>
	<tbody>
	<tr> 
		<td> </td>
		<td> </td>
			<td>     </td>
				<td>    </td>
					
</tr>
	</tbody>
</table>
		        </form>
   </fieldset>
</div>

<div class='container'>
<fieldset><legend>Passport:

         </legend>
		       <form action="" method="post">
		        <table class='table'>
		        <form class="form-horizontal">
			<div class="form-group">
			     <tr>
				<td> Passport Number:</td>
				<td><input type="text" name="pass" size="35" maxlength="250" class="form-control" value="<?php setValue("pass")?>"/></td>
			     </tr>
			
			    <tr>
				<td> Issue Date: </td>
				<td><input type="text" name="pass" size="35" maxlength="250" class="form-control" value="<?php setValue("pass")?>"/></td>
				<td> Expiry Date: </td>
				<td><input type="text" name="pass" size="35" maxlength="250" class="form-control" value="<?php setValue("pass")?>"/></td>
			    </tr>
			    </div></form>
				    
</table>
		       <input type="button" name="btn" class="btn-info btn-sm" value="ADD" />
	
	<table class='table table-bordered table-striped'>
	<tr> 
		<th>Passport Number </th>
		<th> Issue Date </th>
		<th>Expiry Date  </th>
	
		
	</tr>
	<tbody>
<tr> 
		<td> </td>
			<td>     </td>
				<td>    </td>
				
</tr>
	</tbody>
</table>
		       </form>
	       </fieldset>

</div>
<br />

<div class='container'>
	<fieldset><legend>Bond: 
         </legend>
		        <form action="" method="post">
		        <table class='table'>
		        <form class="form-horizontal">
			<div class="form-group">
			     <tr>
				<td> Title:</td>
				<td><input type="text" name="bond" size="35" maxlength="250" class="form-control" value="<?php setValue("bond")?>"/></td>
			     </tr>
			
			    <tr>
				<td> Reason of Bond: </td>
				<td><input type="text" name="bond" size="35" maxlength="250" class="form-control" value="<?php setValue("bond")?>"/></td>
			    </tr>
			    
			    <tr>
			   	<td> Amount: </td>
				<td><input type="text" name="bond" size="35" maxlength="250" class="form-control" value="<?php setValue("bond")?>"/></td>
			    </tr>
				    
				<tr>
				<td> Register Date: </td>
				<td><input type="text" name="bond" size="35" maxlength="250" class="form-control" value="<?php setValue("bond")?>"/></td>
			    </tr>
			    
			    <tr>
			   	<td>Period: </td>
				<td><input type="text" name="bond" size="35" maxlength="250" class="form-control" value="<?php setValue("bond")?>"/></td>
			    </tr></div></form>
</table>
		       <input type="button" name="btn" class="btn-info btn-sm" value="ADD" />
		     
<table class='table table-bordered table-striped'>
	<tr> <th>Title </th>
		<th>Type </th>
		<th> Register Date </th>
		<th> Period </th>
		<th> Amount </th>
		
	</tr>
	<tbody>
	<tr> 
		<td> </td>
			<td>     </td>
				<td>    </td>
					<td>     </td>
						<td>    </td>
</tr>
	</tbody>
</table>
		        </form>
  </fieldset>
</div>

<br />

<div class='container'>
	<fieldset><legend>Leave: 

         </legend>
		        <form action="" method="post">
		        <table class='table'>
		        <form class="form-horizontal">
			<div class="form-group">
			     <tr>
				<td>Leave title:</td>
				<td><input type="text" name="leave" size="35" maxlength="250" class="form-control" value="<?php setValue("leave")?>"/></td>
			     </tr>
			
			    <tr>
				<td> Used Days: </td>
				<td><input type="text" name="leave" size="35" maxlength="250" class="form-control" value="<?php setValue("leave")?>"/></td>
				<td> Balanced Days: </td>
				<td><input type="text" name="leave" size="35" maxlength="250" class="form-control" value="<?php setValue("leave")?>"/></td>
			    </tr>
			    
				    
				<tr>
				<td> Leave Type: </td>
				<td><input type="text" name="leave" size="35" maxlength="250" class="form-control" value="<?php setValue("leave")?>"/></td>
			    </tr>
			    
			    <tr>
			   	<td>Start Date: </td>
				<td><input type="text" name="leave" size="35" maxlength="250" class="form-control" value="<?php setValue("leave")?>"/></td>
				<td>End Date:</td>
				<td><input type="text" name="leave" size="35" maxlength="250" class="form-control" value="<?php setValue("leave")?>"/></td>
			    </tr>
</div></form>
			</table>
		       <input type="button" name="btn" class="btn-info btn-sm" value="ADD" />
		   
<table class='table table-bordered table-striped'>
	<tr> <th>Leave title </th>
		<th>Used Days </th>
		<th> Balance Days </th>
		<th>Leave type (eg- Casual Leave, Long service leave,Leave without pay, Medical leave,Casual Leave)</th>
		<th> Start Date  </th>
		<th>End Date  </th>
		
		
	</tr>
	<tbody>
	<tr> 
		<td> </td>
			<td>     </td>
				<td>    </td>
					<td>     </td>
						<td>    </td>
						<td>    </td>
</tr>
	</tbody>
</table>
		        </form>
    </fieldset>
</div>
<br /> 

<div class='container'>
<button type="button" class="btn-info btn" > Create new Faculty</button>
<button type="button" class="btn-info btn" > BACK</button>
</div>

 <?php 
}
 ?>   
<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script src = 'js/bootstrap.js'></script>
</body>
</html>