<html>
<body>

<?php


$name = $_POST["studentName"];
$CID = $_POST["campusID"];
$email = $_POST["email"];
$number = $_POST["contactNum"];

if(preg_match('/[A-Z][a-z]* [A-Z][a-z]*/', $name) == 1){
	$name = test_input($name);
}
else{
	echo "Please enter your first and last name<br>";
}

if(preg_match('/[A-Z][A-Z][0-9][0-9][0-9][0-9][0-9]/', $CID) == 1){
	$CID = test_input($CID);
}
else{
	echo "Please enter a valid campus ID<br>";
}

if(preg_match('/.*@.*\..*/', $email) == 1 ){
	$email=trim($email);
	$email=stripslashes($email);
}
else{
	echo "Please enter a valid email<br>";
}
$number = str_replace('-', '', $number);
if(preg_match('/[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/', $number) == 1){
	$number = test_input($number);
}
else{
	echo "Please enter a valid phone number <br>";
}



echo "Name: $name<br>Campus ID: $CID<br>Email: $email<br>Phone Number: $number<br>";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
</body>
</html>