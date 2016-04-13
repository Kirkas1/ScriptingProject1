<?php 
	session_start();
	$dbHost = "10.200.6.30";
	$dbName = "scripting";
	$dbUser = "ikirk";
	$dbPassword = "umbc";
	$dbTable = "project1";

	$name = $_SESSION["name"];
	$campusID = $_SESSION["campusID"];
	$email = $_SESSION["email"];
	$contactNum = $_SESSION["contactNum"];
	$classesTaken = $_SESSION["classes"];

	// Create connection
	$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$classes = $classesTaken;
	$cmsc2xx=$_POST["cmsc2xx"];
	$cmsc3xx=$_POST["cmsc3xx"];
	$cmsc4xx=$_POST["cmsc4xx"];
	


	foreach($_POST as $class) {
		if($class != "submit") {
			if(!(strpos($classes, $class) !== false)) {
				$classes .= $class . " ";
			}
		}
	}

	if($_SESSION["inDB"]) {
		$sql = "UPDATE $dbTable SET classes=\"$classes\" WHERE name=\"$name\"";
	} else {
		$sql = "INSERT INTO $dbTable (name, campusid, email, contactnum, classes)
				VALUES (\"$name\", \"$campusID\", \"$email\", \"$contactNum\", \"$classes\")";
	}
	if ($conn->query($sql) === TRUE) {
	    echo "<center><h3 style='color: grey;'>Record updated successfully</h3></center>";
	} else {
	    echo "Error updating record: " . $conn->error;
	}

	session_unset();
	session_destroy();

	header( "refresh:4; url=right.php" ); /* Redirect browser */
	exit();
 ?>