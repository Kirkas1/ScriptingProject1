<!DOCTYPE html PUBLIC "-//W3C//Dbr XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dbr/xhtml1-transitional.dbr">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> IS448 hw#2 9.9 Kayoung Kim  </title>
<link rel = "stylesheet" href = "aki_style.css" />
</head>
<body class="right">

<div class=""><center> WELCOME <span class="textstyleRed">COMPUTER SCIENCE</span> STUDENT</center>

<script type="text/javascript">
	function isChecked(elem){
		if (elem.checked)
    {
        alert("Im Checked");
    }
    else
    {
        alert("Im not checked");
    }
	}

	function showMe (box) {

	    var show = document.getElementById(box);
	    if(   show.style.visibility == "visible" ){
	    	show.style.visibility = "hidden";
	    }
	    else{
	    	show.style.visibility = "visible";
		}
}

</script>


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
		session_start();
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

		$_SESSION["name"] = $name;
		$_SESSION["campusID"] = $campusID;
		$_SESSION["classes"] = $classes;
	}



}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>


	<form method="post" action="after.php">
		
 			2XX Classes<br>
			<input type="checkbox" name="cmsc2xx[0]" value="CMSC201" onclick="showMe('cmsc201');">  CMSC201  <br>
			<div id='cmsc201' style="visibility: hidden;">
				<input type="checkbox" name="cmsc202" value="CMSC202" onclick="showMe('cmsc304');showMe('cmsc486');">  CMSC202  <br>
				<input type="checkbox" name="cmsc203" value="CMSC203" onclick="showMe('cmsc331');showMe('cmsc313');showMe('cmsc457');showMe('cmsc452');showMe('cmsc451');showMe('cmsc341');">  CMSC203  <br> 
			</div>

			<input type="checkbox" name="cmsc2xx[3]" value="CMSC232">  CMSC232  <br>
			<input type="checkbox" name="cmsc2xx[4]" value="CMSC291">  CMSC291  <br>
			<input type="checkbox" name="cmsc2xx[5]" value="CMSC299">  CMSC299  <br>

	3XX Classes<br>
 		
 			<div id='cmsc304' style="visibility: hidden;">
				<input type="checkbox" name="cmsc3xx[0]" value="CMSC304">  CMSC304  <br> 
			</div>
			

 			<div id='cmsc313' style="visibility: hidden;">
				<input type="checkbox" name="cmsc3xx[1]" value="CMSC313" onclick="showMe('cmsc411');">  CMSC313 (required) <br> 
			</div>
			

 			<div id='cmsc331' style="visibility: hidden;">
				<input type="checkbox" name="cmsc3xx[2]" value="CMSC331" onclick="showMe('cmsc433');showMe('cmsc432');showMe('cmsc473');showMe('cmsc431');">  CMSC331  <br> 
			</div>

			<div id='cmsc341' style="visibility: hidden;">
			<input type="checkbox" name="cmsc3xx[3]" value="CMSC341" onclick="showMe('cmsc471'); showMe('cmsc427'); showMe('cmsc436'); showMe('cmsc437'); showMe('cmsc447'); showMe('cmsc441'); showMe('cmsc443'); showMe('cmsc453'); showMe('cmsc455'); showMe('cmsc456');showMe('cmsc435');showMe('cmsc476');showMe('cmsc475');showMe('cmsc421');showMe('cmsc461');showMe('cmsc481');">  CMSC341 (required)(Needs Permission)  <br> </div>

			
			<input type="checkbox" name="cmsc3xx[4]" value="CMSC352">  CMSC352  <br> </div>
			<input type="checkbox" name="cmsc3xx[5]" value="CMSC391">  CMSC391  <br> </div> 
	


	
		4XX Classes<br>
	

			
				<div id='cmsc411' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[0]" value="CMSC411">  CMSC411 (required)</br> </div> 

				<div id='cmsc421' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[1]" value="CMSC421" onclick="showMe('cmsc487');showMe('cmsc483');showMe('cmsc426');">  CMSC421 (required)</br> </div> 

				<div id='cmsc426' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[2]" value="CMSC426">  CMSC426</br> </div> 
				
				<div id='cmsc427' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[3]" value="CMSC427">  CMSC427</br> </div> 
				
				<div id='cmsc431' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[4]" value="CMSC431">  CMSC431 *requires 341 as well</br> </div> 
				
				<div id='cmsc432' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[5]" value="CMSC432">  CMSC432</br> </div> 
				
				<div id='cmsc433' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[6]" value="CMSC433">  CMSC433</br> </div> 
				
				<div id='cmsc435' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[7]" value="CMSC435">  CMSC435 *requires 313 and 341<br> </div> 
				
				<div id='cmsc436' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[8]" value="CMSC436">  CMSC436</br> </div> 
				
				<div id='cmsc437' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[9]" value="CMSC437">  CMSC437</br> </div> 
				
				<div id='cmsc441' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[10]" value="CMSC441">  CMSC441 (required)</br> </div> 
				
				
				<input class="400-level-box" type="checkbox" name="cmsc4xx[11]" value="CMSC442">  CMSC442</br> 
				
				<div id='cmsc443' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[12]" value="CMSC443">  CMSC443</br> </div> 
				
				
				<input class="400-level-box" type="checkbox" name="cmsc4xx[13]" value="CMSC444">  CMSC444</br> </div> 
				
			
				<input class="400-level-box" type="checkbox" name="cmsc4xx[14]" value="CMSC446">  CMSC446</br> </div> 
				
				<div id='cmsc447' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[15]" value="CMSC447" onclick="showMe('cmsc448');">  CMSC447 (required) *requires 341 and any 400 level class</br> </div> 
				
				<div id='cmsc448' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[16]" value="CMSC448">  CMSC448</br> </div> 
				
				<div id='cmsc451' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[17]" value="CMSC451">  CMSC451</br> </div> 

				<div id='cmsc452' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[18]" value="CMSC452">  CMSC452</br> </div> 
				
				<div id='cmsc453' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[19]" value="CMSC453">  CMSC453</br> </div> 
				
				<div id='cmsc455' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[20]" value="CMSC455">  CMSC455</br> </div> 
				
				<div id='cmsc456' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[21]" value="CMSC456">  CMSC456</br> </div> 
				
				<div id='cmsc457' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[22]" value="CMSC457">  CMSC457</br> </div> 
				
				<div id='cmsc461' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[23]" value="CMSC461" >  CMSC461</br> </div> 
							
				<div id='cmsc465' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[24]" value="CMSC465">  CMSC465 *requires both 481 and 461</br> </div> 
				
				<div id='cmsc466' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[25]" value="CMSC466">  CMSC466</br> </div>

				<div id='cmsc471' style="visibility: hidden;"> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[26]" value="CMSC471" onclick="showMe('cmsc493');showMe('cmsc479');showMe('cmsc478');showMe('cmsc477');">  CMSC471</br> </div> 
				
	
				
				<div id='cmsc473' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[27]" value="CMSC473">  CMSC473</br> </div> 
				
				<div id='cmsc475' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[28]" value="CMSC475">  CMSC475</br> </div> 
				
				<div id='cmsc476' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[29]" value="CMSC476">  CMSC476</br> </div> 
				
				<div id='cmsc477' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[30]" value="CMSC477">  CMSC477</br> </div> 
				
				<div id='cmsc478' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[31]" value="CMSC478">  CMSC478</br> </div> 
					
				<div id='cmsc479' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[32]" value="CMSC479">  CMSC479</br> </div> 

				<div id='cmsc481' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[33]" value="CMSC481" onclick="showMe('cmsc465');showMe('cmsc466');showme('cmsc487');">  CMSC481</br> </div> 
				<div id='cmsc483' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[34]" value="CMSC483">  CMSC483</br> </div> 
			
				<input class="400-level-box" type="checkbox" name="cmsc4xx[35]" value="CMSC484">  CMSC484</br> </div> 

				<div id='cmsc486' style="visibility: hidden;">
					<input class="400-level-box" type="checkbox" name="cmsc4xx[36]" value="CMSC486">  CMSC486</br> </div> 
				</div>
				
				<div id='cmsc487' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[37]" value="CMSC487">  CMSC487 *requires both 421 and 481</br> </div> 
			

				<input class="400-level-box" type="checkbox" name="cmsc4xx[38]" value="CMSC491">  CMSC491</br> </div> 
				<div id='cmsc493' style="visibility: hidden;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[39]" value="CMSC493">  CMSC493</br> </div> 
			
				<input class="400-level-box" type="checkbox" name="cmsc4xx[40]" value="CMSC495">  CMSC495</br> </div> 
			
				<input class="400-level-box" type="checkbox" name="cmsc4xx[41]" value="CMSC498">  CMSC498</br> </div> 
		
				<input class="400-level-box" type="checkbox" name="cmsc4xx[42]" value="CMSC499">  CMSC499</br> </div> 
		
	</div> <br/><br/><br/>

	<input type="submit" name="" value="Submit">
	</form>



</body>
</html>
