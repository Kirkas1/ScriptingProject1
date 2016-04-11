<?php 
	session_start();
	$dbHost = "localhost";
	$dbName = "scripting";
	$dbUser = "ikirk";
	$dbPassword = "umbc";
	$dbTable = "project1";

	$name = $_SESSION["name"];
	$campusID = $_SESSION["campusID"];
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

	for ($x = 0; $x <= 6 ; $x++) {
		if(sizeof($cmsc2xx[$x]) > 0 && !in_array($cmsc2xx[$x], $classesTaken)){
			$classes .= $cmsc2xx[$x] . " ";
		}
	}

	for ($y = 0; $y <= 6 ; $y++) {
		if(sizeof($cmsc3xx[$y]) > 0 && !in_array($cmsc3xx[$x], $classesTaken)){
			$classes .= $cmsc3xx[$y] . " ";
		}
	}
	
	for ($z = 0; $z <= 42 ; $z++) {
		if(sizeof($cmsc4xx[$z]) > 0 && !in_array($cmsc4xx[$x], $classesTaken)){
			$classes .= $cmsc4xx[$z] . " ";
		}
	}

	$sql = "UPDATE $dbTable SET classes=\"$classes\" WHERE name=\"$name\"";
	if ($conn->query($sql) === TRUE) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . $conn->error;
	}
 ?>