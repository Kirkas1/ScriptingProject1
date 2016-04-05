<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project 1</title>
<link rel = "stylesheet" href = "mar3_style.css" />
</head>
<body>

<?php
	echo '<div class="">';

	$name=$_POST["studentName"];
	$campusID=$_POST["campusID"];
	$email=$_POST["email"];
	$contactNum=$_POST["contactNum"];

	$cmsc2xx=$_POST["cmsc2xx"];
	$cmsc3xx=$_POST["cmsc3xx"];
	$cmsc4xx=$_POST["cmsc4xx"];

	echo 'Welcome <strong><span style="color:gold">';
	echo "$name";
	echo '</span></strong> !!!<br/><br/>';
	print "User campus ID : $campusID<br/>";
	print "User e-mail : $email<br/>";
	print "User contact number : $contactNum<br/><br/>";

	for ($x = 0; $x <= 6 ; $x++) {
		if(sizeof($cmsc2xx[$x]) > 0){
			echo "$cmsc2xx[$x]";
			echo '<br/>';
		}
	}

	for ($y = 0; $y <= 6 ; $y++) {
		if(sizeof($cmsc3xx[$y]) > 0){
			echo "$cmsc3xx[$y]";
			echo '<br/>';
		}
	}
	
	for ($z = 0; $z <= 42 ; $z++) {
		if(sizeof($cmsc4xx[$z]) > 0){
			echo "$cmsc4xx[$z]";
			echo '<br/>';
		}
	}

	echo '<br/>';
	echo '<br/>';

	print "Thank you.";

	echo '</div>';

	echo '<p>';
	echo '    <a href="https://validator.w3.org/check?uri=
	    	http://userpages.umbc.edu/~kayoung2/is448/1583-kayoung2-hw2/is448_hw2_totalCost.php">
	    <img src="http://www.w3.org/Icons/valid-xhtml10" 
	    	alt="Valid XHTML 1.0 Transitional" height="31" width="88" />
	    </a>
		</p>';



?>



</body>
</html>
