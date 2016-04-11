<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> IS448 hw#2 9.9 Kayoung Kim  </title>
<link rel = "stylesheet" href = "aki_style.css" />
</head>
<body class="right">

<div class=""><center> WELCOME <span class="textstyleRed">COMPUTER SCIENCE</span> STUDENT</center>


<?php

if (!empty($_POST))
{
	$valid = TRUE;
	$name = $_POST["studentName"];
	$CID = $_POST["campusID"];
	$email = $_POST["email"];
	$number = $_POST["contactNum"];

	if(preg_match('/[A-Z][a-z]* [A-Z][a-z]*/', $name) == 1){
		$name = test_input($name);
	}
	else{
		echo "Please enter your first and last name<br>";
		$valid = FALSE;
	}

	if(preg_match('/[A-Z][A-Z][0-9][0-9][0-9][0-9][0-9]/', $CID) == 1){
		$CID = test_input($CID);
	}
	else{
		echo "Please enter a valid campus ID<br>";
		$valid = FALSE;
	}

	if(preg_match('/.*@.*\..*/', $email) == 1 ){
		$email=trim($email);
		$email=stripslashes($email);
	}
	else{
		echo "Please enter a valid email<br>";
		$valid = FALSE;
	}
	$number = str_replace('-', '', $number);
	if(preg_match('/[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/', $number) == 1){
		$number = test_input($number);
	}
	else{
		echo "Please enter a valid phone number <br>";
		$valid = FALSE;
	}

	if($valid) {
		$dbHost = "localhost";
		$dbName = "scripting";
		$dbUser = "ikirk";
		$dbPassword = "umbc";
		$dbTable = "project1";

		// Create connection
		$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$name=$_POST["studentName"];
		$campusID=$_POST["campusID"];
		$email=$_POST["email"];
		$contactNum=$_POST["contactNum"];
		$classes = "";

		$checkIfInDB = "SELECT name, campusid FROM $dbTable";
		$inDB = FALSE;
		$result = $conn->query($checkIfInDB);

		if ($result->num_rows > 0) {
		    // output data of each row
	    	while($row = $result->fetch_assoc()) {
		        if ($name == $row["name"] || $campusID == $row["campusID"]) {
		        	echo 'Match!<br>';
		        	$inDB = TRUE;
		    	}
		    }
		}
		$classesTaken = array();

		if($inDB) {
			$checkClassesTaken = "SELECT name, classes FROM $dbTable";
			$result = $conn->query($checkClassesTaken);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if ($name == $row["name"]) {
						$classesTaken = explode(" ", $row["classes"]);
					}
				}
			} 
		} else {
			$cmsc2xx=$_POST["cmsc2xx"];
			$cmsc3xx=$_POST["cmsc3xx"];
			$cmsc4xx=$_POST["cmsc4xx"];

			for ($x = 0; $x <= 6 ; $x++) {
				if(sizeof($cmsc2xx[$x]) > 0){
					$classes .= $cmsc2xx[$x] . " ";
				}
			}

			for ($y = 0; $y <= 6 ; $y++) {
				if(sizeof($cmsc3xx[$y]) > 0){
					$classes .= $cmsc3xx[$y] . " ";
				}
			}
			
			for ($z = 0; $z <= 42 ; $z++) {
				if(sizeof($cmsc4xx[$z]) > 0){
					$classes .= $cmsc4xx[$z] . " ";
				}
			}
			
			
			$sql = "INSERT INTO $dbTable (name, campusid, email, contactnum, classes)
					VALUES ('$name', '$campusID', '$email', '$contactNum', '$classes')";

			if ($conn->query($sql) === TRUE) {
				// Success
			} else {
				// Fail
			}
		}

		// At this point the student's $classesTaken variable is correct
	}

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>

</body>
</html>
