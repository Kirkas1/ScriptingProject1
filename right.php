<!DOCTYPE html PUBLIC "-//W3C//Dbr XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dbr/xhtml1-transitional.dbr">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel = "stylesheet" href = "aki_style.css" />
</head>
<body class="right">


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

	function beforeSubmit() {
        var boxes = document.getElementsByTagName('input');
        console.log("Called");
        for(var i = 0; i < boxes.length; i++) {
        	if(boxes[i].checked) {
        		boxes[i].disabled = false;
        	}
        }
    }

	function showMe (box) {

	    var show = document.getElementById(box);
	    var cbox = document.getElementById(box.replace(/\D/g,''));
		if (cbox.disabled == true){
			cbox.disabled = false;
			show.style.color = 'orange';
		}	
		else {
			//cbox.click();
			cbox.checked = false;
			cbox.disabled = true;
			show.style.color = 'grey';
		}   
	}

	function selected(box) {

		var show = document.getElementById(box);
		var cbox = document.getElementById(box.replace(/\D/g,''));

		if (cbox.disabled == false){
			if (show.style.color == 'orange'){
				show.style.color = 'green';
			}	
			else if(show.style.color == 'green'){
				show.style.color = 'orange';
			}   
		}
	}

	function lockprev(prev, box){
		var this_show = document.getElementById(box);
		var this_cbox = document.getElementById(box.replace(/\D/g,''));

		var prev_show = document.getElementById(prev);
		var prev_cbox = document.getElementById(prev.replace(/\D/g,''));

		var dep = prev_cbox.getAttribute('dependency');
		if(this_cbox.checked == true){
			prev_cbox.setAttribute('dependency', dep + 0);
		}
		else{
			dep = dep.substring(0, dep.length - 1);
			prev_cbox.setAttribute('dependency', dep);
		}

		
		if (prev_cbox.getAttribute('dependency').length != 1){
			prev_show.style.color = 'blue';
			prev_cbox.disabled = true;
		}
		else {
			prev_show.style.color = 'green';
			prev_cbox.disabled = false;
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
		$dbHost = "10.200.6.30";
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
			foreach($classesTaken as $class) {
				$classes .= $class . " ";
			}
		}

		$nameUpper = strtoupper($name);
		echo "<br><div><center> WELCOME <span class='textstyleRed'>$nameUpper</span></center><br>";
		session_start();
		// At this point the student's $classesTaken variable is correct
		$_SESSION["name"] = $name;
		$_SESSION["campusID"] = $campusID;
		$_SESSION["email"] = $email;
		$_SESSION["contactNum"] = $contactNum;
		$_SESSION["classes"] = $classes;
		$_SESSION["inDB"] = $inDB;
		
	}

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>


	<form method="post" action="after.php" class="formStyle1" onSubmit="beforeSubmit();">
 			
<div class="title1"><span class="textstyleRed">2XX</span> Lv. CLASSES</div>

 		<div id='cmsc201' class='content1' style="color: orange;" >
		<input type="checkbox" dependency='0' name="cmsc201" value="cmsc201" id="201" onclick="selected('cmsc201');showMe('cmsc202');"><label for="201"></label>  CMSC201  <br>
		</div>
			
			<div id='cmsc202' class='content1' style="color: grey;">
				<input type="checkbox" dependency='0' disabled name="cmsc202" value="cmsc202" id="202" onclick="selected('cmsc202');lockprev('cmsc201', 'cmsc202');showMe('cmsc203');showMe('cmsc304');showMe('cmsc486');"><label for="202"></label>  CMSC202  <br> 
			</div>
			<div id='cmsc203' class='content1' style="color: grey;">
				<input type="checkbox" dependency='0' disabled name="cmsc203" value="cmsc203" id="203" onclick="selected('cmsc203');lockprev('cmsc202', 'cmsc203');showMe('cmsc313');showMe('cmsc331');showMe('cmsc457');showMe('cmsc452');showMe('cmsc451');showMe('cmsc341');"><label for="203"></label>  CMSC203  <br> 
			</div>

			<div id='cmsc232' class='content1' style="color: orange;">
			<input type="checkbox" dependency='0' name="cmsc232" value="cmsc232" id="232" onclick="selected('cmsc232');"><label for="232"></label>  CMSC232  <br>	</div>

			<div id='cmsc291' class='content1' style="color: orange;">
			<input type="checkbox" dependency='0' name="cmsc291" value="cmsc291" id="291" onclick="selected('cmsc291');"><label for="291"></label>  CMSC291  <br>	</div>

			<div id='cmsc299' class='content1' style="color: orange;">
			<input type="checkbox" dependency='0' name="cmsc299" value="cmsc299" id="299" onclick="selected('cmsc299');"><label for="299"></label>  CMSC299  <br> </div>


	<div class="title1"><span class="textstyleRed">3XX</span> Lv. CLASSES</div>
 		
 			<div id='cmsc304' class='content1' style="color: grey;">


				<input type="checkbox" dependency='0' disabled name="cmsc304" value="cmsc304" id="304" onclick="selected('cmsc304');lockprev('cmsc202', 'cmsc304');"><label for="304"></label>  CMSC304  <br> 

			</div>
			

 			<div id='cmsc313' class='content1' style="color: grey;">

				<input type="checkbox" dependency='0' disabled name="cmsc313" value="cmsc313" id="313" onclick="selected('cmsc313');lockprev('cmsc203', 'cmsc313');showMe('cmsc411');"><label for="313"></label>  CMSC313 (required) <br> 

			</div>
			

 			<div id='cmsc331' class='content1' style="color: grey;">

				<input type="checkbox" dependency='0' disabled name="cmsc331" value="cmsc331" id="331" onclick="selected('cmsc331');lockprev('cmsc203', 'cmsc331');showMe('cmsc433');showMe('cmsc432');showMe('cmsc473');showMe('cmsc431');"><label for="331"></label>  CMSC331  <br> 
			</div>

			<div id='cmsc341' class='content1' style="color: grey;">
			<input type="checkbox" dependency='0' disabled name="cmsc341" value="cmsc341" id="341" onclick="selected('cmsc341');lockprev('cmsc203', 'cmsc341'); showMe('cmsc427'); showMe('cmsc436');showMe('cmsc471'); showMe('cmsc437'); showMe('cmsc447'); showMe('cmsc441'); showMe('cmsc443'); showMe('cmsc453'); showMe('cmsc455'); showMe('cmsc456');showMe('cmsc435');showMe('cmsc476');showMe('cmsc475');showMe('cmsc421');showMe('cmsc461');showMe('cmsc481');"><label for="341"></label>  CMSC341 (required)(Needs Permission)  <br> </div>

			
			<div id='cmsc352' class='content1' style="color: orange;">
			<input type="checkbox" dependency='0' name="cmsc352" value="cmsc352" id="352" onclick="selected('cmsc352');"><label for="352"></label>  CMSC352  <br> </div>
			<div id='cmsc391' class='content1' style="color: orange;">
			<input type="checkbox" dependency='0' name="cmsc391" value="cmsc391" id="391" onclick="selected('cmsc391');"><label for="391"></label>  CMSC391  <br> </div> 

	


	
		<div class="title1"><span class="textstyleRed">4XX</span> Lv. CLASSES</div>

	

			
				<div id='cmsc411' class='content1' style="color: grey;">

				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc411" value="cmsc411" id="411" onclick="selected('cmsc411');lockprev('cmsc313', 'cmsc411');"><label for="411"></label>  CMSC411 (required)</br> </div> 

				<div id='cmsc421' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc421" value="cmsc421" id="421" onclick="selected('cmsc421');lockprev('cmsc313', 'cmsc421');lockprev('cmsc341', 'cmsc421');showMe('cmsc483');showMe('cmsc426');"><label for="421"></label>  CMSC421 (required)</br> </div> 

				<div id='cmsc426' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc426" value="cmsc426" id="426" onclick="selected('cmsc426');lockprev('cmsc421', 'cmsc426');"><label for="426"></label>  CMSC426</br> </div> 
				
				<div id='cmsc427' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc427" value="cmsc427" id="427" onclick="selected('cmsc427');lockprev('cmsc341', 'cmsc427');"><label for="427"></label>  CMSC427</br> </div> 
				
				<div id='cmsc431' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc431" value="cmsc431" id="431" onclick="selected('cmsc431');lockprev('cmsc331', 'cmsc431');lockprev('cmsc341', 'cmsc431');"><label for="431"></label>  CMSC431 *requires 341 as well</br> </div> 
				
				<div id='cmsc432' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc432" value="cmsc432" id="432" onclick="selected('cmsc432');lockprev('cmsc331', 'cmsc432');"><label for="432"></label>  CMSC432</br> </div> 
				
				<div id='cmsc433' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc433" value="cmsc433" id="433" onclick="selected('cmsc433');lockprev('cmsc331', 'cmsc433');"><label for="433"></label>  CMSC433</br> </div> 
				
				<div id='cmsc435' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc435" value="cmsc435" id="435" onclick="selected('cmsc435');lockprev('cmsc313', 'cmsc435');lockprev('cmsc341', 'cmsc435');"><label for="435"></label>  CMSC435 *requires 313 and 341<br> </div> 
				
				<div id='cmsc436' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc436" value="cmsc436" id="436" onclick="selected('cmsc436');lockprev('cmsc341', 'cmsc436');"><label for="436"></label>  CMSC436</br> </div> 
				
				<div id='cmsc437' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc437" value="cmsc437" id="437" onclick="selected('cmsc437');lockprev('cmsc341', 'cmsc437');"><label for="437"></label>  CMSC437</br> </div> 
				
				<div id='cmsc441' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc441" value="cmsc441" id="441" onclick="selected('cmsc441');lockprev('cmsc341', 'cmsc441');"><label for="441"></label>  CMSC441 (required)</br> </div> 
				
				<div id='cmsc442' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" dependency='0' name="cmsc442" value="cmsc442" id="442" onclick="selected('cmsc442');"><label for="442"></label>  CMSC442</br> </div>
				
				<div id='cmsc443' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc443" value="cmsc443" id="443" onclick="selected('cmsc443');lockprev('cmsc341', 'cmsc443');"><label for="443"></label>  CMSC443</br> </div> 
				
				<div id='cmsc444' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" dependency='0' name="cmsc444" value="cmsc444" id="444" onclick="selected('cmsc444');"><label for="444"></label>  CMSC444</br> </div> 
				
				<div id='cmsc446' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" dependency='0' name="cmsc446" value="cmsc446" id="446" onclick="selected('cmsc446');"><label for="446"></label>  CMSC446</br> </div> 
				
				<div id='cmsc447' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc447" value="cmsc447" id="447" onclick="selected('cmsc447');lockprev('cmsc341', 'cmsc447');showMe('cmsc448');"><label for="447"></label>  CMSC447 (required) *requires 341 and any 400 level class</br> </div> 
				
				<div id='cmsc448' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc448" value="cmsc448" id="448" onclick="selected('cmsc448');lockprev('cmsc447', 'cmsc448');"><label for="448"></label>  CMSC448</br> </div> 
				
				<div id='cmsc451' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc451" value="cmsc451" id="451" onclick="selected('cmsc451');lockprev('cmsc203', 'cmsc451');"><label for="451"></label>  CMSC451</br> </div> 

				<div id='cmsc452' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc452" value="cmsc452" id="452" onclick="selected('cmsc452');lockprev('cmsc203', 'cmsc452');"><label for="452"></label>  CMSC452</br> </div> 
				
				<div id='cmsc453' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc453" value="cmsc453" id="453" onclick="selected('cmsc453');lockprev('cmsc341', 'cmsc453');"><label for="453"></label>  CMSC453</br> </div> 
				
				<div id='cmsc455' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc455" value="cmsc455" id="455" onclick="selected('cmsc455');lockprev('cmsc341', 'cmsc455');"><label for="455"></label>  CMSC455</br> </div> 
				
				<div id='cmsc456' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc456" value="cmsc456" id="456" onclick="selected('cmsc456');lockprev('cmsc341', 'cmsc456');"><label for="456"></label>  CMSC456</br> </div> 
				
				<div id='cmsc457' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc457" value="cmsc457" id="457" onclick="selected('cmsc457');lockprev('cmsc203', 'cmsc457');"><label for="457"></label>  CMSC457</br> </div> 
				
				<div id='cmsc461' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc461" value="cmsc461" id="461" onclick="selected('cmsc461');lockprev('cmsc341', 'cmsc461');"><label for="461"></label>  CMSC461 </div> 
							
				<div id='cmsc465' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc465" value="cmsc465" id="465" onclick="selected('cmsc465');lockprev('cmsc481', 'cmsc465');lockprev('cmsc461', 'cmsc465');"><label for="465"></label>  CMSC465 *requires both 481 and 461</br> </div> 
				
				<div id='cmsc466' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc466" value="cmsc466" id="466" onclick="selected('cmsc466');lockprev('cmsc481', 'cmsc466');lockprev('cmsc461', 'cmsc466');"><label for="466"></label>  CMSC466</br> </div>

				<div id='cmsc471' class='content1' style="color: grey;"> 
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc471" value="cmsc471" id="471" onclick="selected('cmsc471');lockprev('cmsc341', 'cmsc471');showMe('cmsc493');showMe('cmsc479');showMe('cmsc478');showMe('cmsc477');"><label for="471"></label>  CMSC471</br> </div> 

	
				
				<div id='cmsc473' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc473" value="cmsc473" id="473" onclick="selected('cmsc473');lockprev('cmsc331', 'cmsc473');"><label for="473"></label>  CMSC473</br> </div> 
				
				<div id='cmsc475' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc475" value="cmsc475" id="475" onclick="selected('cmsc475');lockprev('cmsc341', 'cmsc475');"><label for="475"></label>  CMSC475</br> </div> 
				
				<div id='cmsc476' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc476" value="cmsc476" id="476" onclick="selected('cmsc476');lockprev('cmsc341', 'cmsc476');"><label for="476"></label>  CMSC476</br> </div> 
				
				<div id='cmsc477' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc477" value="cmsc477" id="477" onclick="selected('cmsc477');lockprev('cmsc471', 'cmsc477');"><label for="477"></label>  CMSC477</br> </div> 
				
				<div id='cmsc478' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc478" value="cmsc478" id="478" onclick="selected('cmsc478');lockprev('cmsc471', 'cmsc478');"><label for="478"></label>  CMSC478</br> </div> 
					
				<div id='cmsc479' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc479" value="cmsc479" id="479" onclick="selected('cmsc479');lockprev('cmsc471', 'cmsc479');"><label for="479"></label>  CMSC479</br> </div> 

				<div id='cmsc481' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc481" value="cmsc481" id="481" onclick="selected('cmsc481');lockprev('cmsc341', 'cmsc481');showMe('cmsc487');showMe('cmsc465');showMe('cmsc466');showme('cmsc487');"><label for="481"></label>  CMSC481</br> </div> 
				<div id='cmsc483' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc483" value="cmsc483" id="483" onclick="selected('cmsc483');lockprev('cmsc421', 'cmsc483');"><label for="483"></label>  CMSC483</br> </div> 
			
				<div id='cmsc484' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" dependency='0' name="cmsc484" value="cmsc484" id="484" onclick="selected('cmsc484');"><label for="484"></label>  CMSC484</br> </div> 

				<div id='cmsc486' class='content1' style="color: grey;">
					<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc486" value="cmsc486" id="486" onclick="selected('cmsc486');lockprev('cmsc202', 'cmsc486');"><label for="486"></label>  CMSC486</br> </div> 
				</div>
				
				<div id='cmsc487' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc487" value="cmsc487" id="487" onclick="selected('cmsc487');lockprev('cmsc421', 'cmsc487');lockprev('cmsc481', 'cmsc487');"><label for="487"></label>  CMSC487 *requires both 421 and 481</br> </div> 
			
				<div id='cmsc491' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" dependency='0' name="cmsc491" value="cmsc491" id="491" onclick="selected('cmsc491');"><label for="491"></label>  CMSC491</br> </div> 
				<div id='cmsc493' class='content1' style="color: grey;">
				<input class="400-level-box" type="checkbox" dependency='0' disabled name="cmsc493" value="cmsc493" id="493" onclick="selected('cmsc493');lockprev('cmsc471', 'cmsc491');lockprev('cmsc435', 'cmsc493');"><label for="493"></label>  CMSC493 *requires both 435 and 471</br> </div> 
			
				<div id='cmsc495' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" dependency='0' name="cmsc495" value="cmsc495" id="495" onclick="selected('cmsc495');"><label for="495"></label>  CMSC495</br> </div> 
			
				<div id='cmsc498' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" dependency='0' name="cmsc498" value="cmsc498" id="498" onclick="selected('cmsc498');"><label for="498"></label>  CMSC498</br> </div> 
		
				<div id='cmsc499' class='content1' style="color: orange;">
				<input class="400-level-box" type="checkbox" dependency='0' name="cmsc499" value="cmsc499" id="499" onclick="selected('cmsc499');"><label for="499"></label>  CMSC499</br> </div> 

		
	</div> <br/><br/><br/>

	<input type="submit" name="" value="submit">
	</form>

	<script>
       var classes = "<?php Print($classes); ?>";
       console.log(classes);
       var classArr = classes.split(" ");
       for(var i = 0; i < classArr.length; i++) {
           var cbox = document.getElementById(classArr[i].replace(/\D+/g,''));
           if(cbox) {
           cbox.click();
       		}
       }

       
	</script>


</body>

</html>