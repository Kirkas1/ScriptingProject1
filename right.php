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
		if (show.style.color == 'grey'){
			show.style.color = 'orange';

		}	
		else {
			show.style.color = 'grey';
		}   
	}

	function selected(box) {

		var show = document.getElementById(box);
		if (show.style.color == 'orange'){
			show.style.color = 'green';
		}	
		else if(show.style.color == 'green'){
			show.style.color = 'orange';
		}   
		else if(show.style.color == 'red'){
			show.style.color = 'grey';
		}
		else{
			show.style.color = 'red';
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

	/*
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
		*/
		// At this point the student's $classesTaken variable is correct
	


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>


	<form method="post" action="mar3_php.php" class="formStyle1">
    




	
		
 			
<div class="title1"><span class="textstyleRed">2XX</span> Lv. CLASSES</div>

 			<div id='cmsc201' class='content1' class='content1' style="color: orange;" >
			<input type="checkbox" name="cmsc2xx[0]" value="CMSC201" id="201" onclick="selected('cmsc201');showMe('cmsc202');"><label for="201"></label>  CMSC201  <br></div>
			
			<div id='cmsc202' class='content1' style="color: grey;">
				<input type="checkbox" name="cmsc202" value="CMSC202" id="202" onclick="selected('cmsc202');showMe('cmsc203');showMe('cmsc486');"><label for="202"></label>  CMSC202  <br> </div>
			<div id='cmsc203' class='content1' style="color: grey;">
				<input type="checkbox" name="cmsc203" value="CMSC203" id="203" onclick="selected('cmsc203');showMe('cmsc313');showMe('cmsc457');showMe('cmsc452');showMe('cmsc451');showMe('cmsc341');"><label for="203"></label>  CMSC203  <br> 
			</div>

			<div id='cmsc232' class='content1' style="color: orange;">
			<input type="checkbox" name="cmsc2xx[3]" value="CMSC232" id="232" onclick="selected('cmsc232');"><label for="232"></label>  CMSC232  <br>	</div>

			<div id='cmsc291' class='content1' style="color: orange;">
			<input type="checkbox" name="cmsc2xx[4]" value="CMSC291" id="291" onclick="selected('cmsc291');"><label for="291"></label>  CMSC291  <br>	</div>

			<div id='cmsc299' class='content1' style="color: orange;">
			<input type="checkbox" name="cmsc2xx[5]" value="CMSC299" id="299" onclick="selected('cmsc299');"><label for="299"></label>  CMSC299  <br> </div>

	<div class="title1"><span class="textstyleRed">3XX</span> Lv. CLASSES</div>
 		
 			<div id='cmsc304' class='content1' style="color: grey;">
				<input type="checkbox" name="cmsc3xx[0]" value="CMSC304" id="304" onclick="selected('cmsc304');"><label for="304"></label>  CMSC304  <br> 
			</div>
			

 			<div id='cmsc313' class='content1' style="color: grey;">
				<input type="checkbox" name="cmsc3xx[1]" value="CMSC313" id="313" onclick="selected('cmsc313');"><label for="313"></label>  CMSC313 (required) <br> 
			</div>
			

 			<div id='cmsc331' class='content1' style="color: grey;">
				<input type="checkbox" name="cmsc3xx[2]" value="CMSC331" id="331" onclick="selected('cmsc331');showMe('cmsc432');showMe('cmsc473');showMe('cmsc431');"><label for="331"></label>  CMSC331  <br> 
			</div>

			<div id='cmsc341' class='content1' style="color: grey;">
			<input type="checkbox" name="cmsc3xx[3]" value="CMSC341" id="341" onclick="selected('cmsc341'); showMe('cmsc427'); showMe('cmsc436'); showMe('cmsc437'); showMe('cmsc447'); showMe('cmsc441'); showMe('cmsc443'); showMe('cmsc453'); showMe('cmsc455'); showMe('cmsc456');showMe('cmsc435');showMe('cmsc476');showMe('cmsc475');showMe('cmsc421');showMe('cmsc461');showMe('cmsc481');"><label for="341"></label>  CMSC341 (required)(Needs Permission)  <br> </div>

			
			<div id='cmsc352' class='content1' style="color: orange;">
			<input type="checkbox" name="cmsc3xx[4]" value="CMSC352" id="352" onclick="selected('cmsc352');"><label for="352"></label>  CMSC352  <br> </div>
			<div id='cmsc391' class='content1' style="color: orange;">
			<input type="checkbox" name="cmsc3xx[5]" value="CMSC391" id="391" onclick="selected('cmsc391');"><label for="391"></label>  CMSC391  <br> </div> 
	


	
		<div class="title1"><span class="textstyleRed">4XX</span> Lv. CLASSES</div>

	

			
				<div id='cmsc411' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[0]" value="CMSC411" id="411" onclick="selected('cmsc411');"><label for="411"></label>  CMSC411 (required)</br> </div> 

				<div id='cmsc421' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[1]" value="CMSC421" id="421" onclick="selected('cmsc421');showMe('cmsc483');showMe('cmsc426');"><label for="421"></label>  CMSC421 (required)</br> </div> 

				<div id='cmsc426' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[2]" value="CMSC426" id="426" onclick="selected('cmsc426');"><label for="426"></label>  CMSC426</br> </div> 
				
				<div id='cmsc427' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[3]" value="CMSC427" id="427" onclick="selected('cmsc427');"><label for="427"></label>  CMSC427</br> </div> 
				
				<div id='cmsc431' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[4]" value="CMSC431" id="431" onclick="selected('cmsc431');"><label for="431"></label>  CMSC431 *requires 341 as well</br> </div> 
				
				<div id='cmsc432' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[5]" value="CMSC432" id="432" onclick="selected('cmsc432');"><label for="432"></label>  CMSC432</br> </div> 
				
				<div id='cmsc433' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[6]" value="CMSC433" id="433" onclick="selected('cmsc433');"><label for="433"></label>  CMSC433</br> </div> 
				
				<div id='cmsc435' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[7]" value="CMSC435" id="435" onclick="selected('cmsc435');"><label for="435"></label>  CMSC435 *requires 313 and 341<br> </div> 
				
				<div id='cmsc436' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[8]" value="CMSC436" id="436" onclick="selected('cmsc436');"><label for="436"></label>  CMSC436</br> </div> 
				
				<div id='cmsc437' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[9]" value="CMSC437" id="437" onclick="selected('cmsc437');"><label for="437"></label>  CMSC437</br> </div> 
				
				<div id='cmsc441' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[10]" value="CMSC441" id="441" onclick="selected('cmsc441');"><label for="441"></label>  CMSC441 (required)</br> </div> 
				
				<div id='cmsc442' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[11]" value="CMSC442" id="442" onclick="selected('cmsc442');"><label for="442"></label>  CMSC442</br> </div>
				
				<div id='cmsc443' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[12]" value="CMSC443" id="443" onclick="selected('cmsc443');"><label for="443"></label>  CMSC443</br> </div> 
				
				<div id='cmsc444' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[13]" value="CMSC444" id="444" onclick="selected('cmsc444');"><label for="444"></label>  CMSC444</br> </div> 
				
				<div id='cmsc446' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[14]" value="CMSC446" id="446" onclick="selected('cmsc446');"><label for="446"></label>  CMSC446</br> </div> 
				
				<div id='cmsc447' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[15]" value="CMSC447" id="447" onclick="selected('cmsc447');"><label for="447"></label>  CMSC447 (required) *requires 341 and any 400 level class</br> </div> 
				
				<div id='cmsc448' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[16]" value="CMSC448" id="448" onclick="selected('cmsc448');"><label for="448"></label>  CMSC448</br> </div> 
				
				<div id='cmsc451' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[17]" value="CMSC451" id="451" onclick="selected('cmsc451');"><label for="451"></label>  CMSC451</br> </div> 

				<div id='cmsc452' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[18]" value="CMSC452" id="452" onclick="selected('cmsc452');"><label for="452"></label>  CMSC452</br> </div> 
				
				<div id='cmsc453' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[19]" value="CMSC453" id="453" onclick="selected('cmsc453');"><label for="453"></label>  CMSC453</br> </div> 
				
				<div id='cmsc455' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[20]" value="CMSC455" id="455" onclick="selected('cmsc455');"><label for="455"></label>  CMSC455</br> </div> 
				
				<div id='cmsc456' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[21]" value="CMSC456" id="456" onclick="selected('cmsc456');"><label for="456"></label>  CMSC456</br> </div> 
				
				<div id='cmsc457' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[22]" value="CMSC457" id="457" onclick="selected('cmsc457');"><label for="457"></label>  CMSC457</br> </div> 
				
				<div id='cmsc461' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[23]" value="CMSC461" id="461" onclick="selected('cmsc461');"><label for="461"></label>  CMSC461 </div> 
							
				<div id='cmsc465' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[24]" value="CMSC465" id="465" onclick="selected('cmsc465');"><label for="465"></label>  CMSC465 *requires both 481 and 461</br> </div> 
				
				<div id='cmsc466' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[25]" value="CMSC466" id="466" onclick="selected('cmsc466');"><label for="466"></label>  CMSC466</br> </div>

				<div id='cmsc471' class='content1' style="color: grey;"> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[26]" value="CMSC471" id="471" onclick="selected('cmsc471');showMe('cmsc479');showMe('cmsc478');showMe('cmsc477');"><label for="471"></label>  CMSC471</br> </div> 
				
	
				
				<div id='cmsc473' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[27]" value="CMSC473" id="473" onclick="selected('cmsc473');"><label for="473"></label>  CMSC473</br> </div> 
				
				<div id='cmsc475' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[28]" value="CMSC475" id="475" onclick="selected('cmsc475');"><label for="475"></label>  CMSC475</br> </div> 
				
				<div id='cmsc476' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[29]" value="CMSC476" id="476" onclick="selected('cmsc476');"><label for="476"></label>  CMSC476</br> </div> 
				
				<div id='cmsc477' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[30]" value="CMSC477" id="477" onclick="selected('cmsc477');"><label for="477"></label>  CMSC477</br> </div> 
				
				<div id='cmsc478' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[31]" value="CMSC478" id="478" onclick="selected('cmsc478');"><label for="478"></label>  CMSC478</br> </div> 
					
				<div id='cmsc479' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[32]" value="CMSC479" id="479" onclick="selected('cmsc479');"><label for="479"></label>  CMSC479</br> </div> 

				<div id='cmsc481' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[33]" value="CMSC481" id="481" onclick="selected('cmsc481');showMe('cmsc466');showme('cmsc487');"><label for="481"></label>  CMSC481</br> </div> 
				<div id='cmsc483' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[34]" value="CMSC483" id="483" onclick="selected('cmsc483');"><label for="483"></label>  CMSC483</br> </div> 
			
				<div id='cmsc484' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[35]" value="CMSC484" id="484" onclick="selected('cmsc484');"><label for="484"></label>  CMSC484</br> </div> 

				<div id='cmsc486' class='content1' style="color: grey;">
					<input class="400-level-box" type="checkbox" name="cmsc4xx[36]" value="CMSC486" id="486" onclick="selected('cmsc486');"><label for="486"></label>  CMSC486</br> </div> 
				</div>
				
				<div id='cmsc487' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[37]" value="CMSC487" id="487" onclick="selected('cmsc487');"><label for="487"></label>  CMSC487 *requires both 421 and 481</br> </div> 
			
				<div id='cmsc491' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[38]" value="CMSC491" id="491" onclick="selected('cmsc491');"><label for="491"></label>  CMSC491</br> </div> 
				<div id='cmsc493' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[39]" value="CMSC493" id="493" onclick="selected('cmsc493');"><label for="493"></label>  CMSC493</br> </div> 
			
				<div id='cmsc495' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[40]" value="CMSC495" id="495" onclick="selected('cmsc495');"><label for="495"></label>  CMSC495</br> </div> 
			
				<div id='cmsc498' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[41]" value="CMSC498" id="498" onclick="selected('cmsc498');"><label for="498"></label>  CMSC498</br> </div> 
		
				<div id='cmsc499' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" name="cmsc4xx[42]" value="CMSC499" id="499" onclick="selected('cmsc499');"><label for="499"></label>  CMSC499</br> </div> 
		
	</div> <br/><br/><br/>

	</form>



</body>
</html>