<?php
include("session.php");
include("includes.php");
?>

<title>Universal EMR</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php include("view/banner.php"); ?>

<?php
include("dbconnect.php");
include("Validate.php");

$con = new dbconnect();
$con->connect();

$val= new Validate();

if(($val->checkName($_POST['fname'])) && ($val->checkName($_POST['lname'])) && ($val->checkCity($_POST['city'])) && ($val->checkZip($_POST['zip'])) && ($val->validateEmail($_POST['email'])) && 
	($val->checkPass($_POST['regid'])) && ($val->checkPhone($_POST['phone'])) && ($val->checkAddress($_POST['address'])) && ($val->checkState($_POST['state']))) {

	if (!isset($_POST['type'])) {
		$type = "patient";
	
		$sSql = "INSERT INTO patient
					(fname, lname, gender, dob, email, phone, address, city, state, zipcode, insured, inscomp, insid, insphone)
					VALUES ('".$_POST['fname']."', '".$_POST['lname']."', '".$_POST['gender']."', '".$_POST['birthmonth']."-".$_POST['birthday']."-".$_POST['birthyear']."'
					, '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['address']."', '".$_POST['city']."', '".$_POST['state']."'
					, '".$_POST['zip']."', ".intval($_POST['ins']).", '".$_POST['inscomp']."', '".$_POST['insid']."'    
					, '".$_POST['insphone']."')";
	} else {
		$type = $_POST['type'];

		if ($_POST['type'] == "doctor") {

			$sSql = "INSERT INTO ".$_POST['type'].
						" (fname, lname, gender, dob, email, phone, address, city, state, zipcode, facilityId, schedule)
						VALUES ('".$_POST['fname']."', '".$_POST['lname']."', '".$_POST['gender']."', '".$_POST['birthmonth']."-".$_POST['birthday']."-".$_POST['birthyear']."'
						, '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['address']."', '".$_POST['city']."', '".$_POST['state']."'
						, '".$_POST['zip']."', '".$_POST['facid']."', '')";
		} else {

			$sSql = "INSERT INTO ".$_POST['type'].
						" (fname, lname, gender, dob, email, phone, address, city, state, zipcode, facilityId)
						VALUES ('".$_POST['fname']."', '".$_POST['lname']."', '".$_POST['gender']."', '".$_POST['birthmonth']."-".$_POST['birthday']."-".$_POST['birthyear']."'
						, '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['address']."', '".$_POST['city']."', '".$_POST['state']."'
						, '".$_POST['zip']."', '".$_POST['facid']."')";
		}
	}
	
	mysql_query($sSql);

	$sSql = "INSERT INTO user
				(email, pass, type)
				VALUES ('".$_POST['email']."', sha1(\"".$_POST['regid']."\"), '".$type."')";

	$result = mysql_query($sSql);
	
	if($result) {		
		$subject = "Welcome to Universal EMR";
		$message = "Welcome to Universal EMR. ";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: Universal EMR <noreply@universals.com>" . "\r\n";

		mail($_POST['email'], $subject, $message, $headers);
		echo "<br><br><h2><center><font color=green>The patient was successfully registered.</font></center></h2>";
		echo "<center></b><br><h5><a href=\"index.php\" style=\"text-decoration:none; color:#0489B1\">Back to Home</a></h5></center><br>";
	}
	else {
		echo "<br><br><center></b><h4><font color=red>Error! Email address already exist. Please try a different one.</center></b></h4></font>";
		echo "<center></b><br><h5><a href=\"register.php\" style=\"text-decoration:none; color:#0489B1\">Try Again Here</a></h5></center><br>";
	}
}
else {
	echo "<center><h4><font color=red >Error! Invalid Input!</font></h4></center>";
	if (!$val->checkPass($_POST['regid'])) {
		echo "<center><h4><font color=red >Registration ID must be between 6 to 16 characters.</font></h4></center>";
	}
	echo "<center></b><br><h5><a href=\"register.php\" style=\"text-decoration:none; color:#0489B1\">Try Again Here</a></h5></center><br>";
}
?>

<?php include("view/footer.php"); ?>
