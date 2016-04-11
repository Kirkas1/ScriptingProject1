<!DOCTYPE html PUBLIC "-//W3C//Dbr XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dbr/xhtml1-transitional.dbr">
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

}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>


	<form method="post" action="mar3_php.php">
    




	
		2XX Classes<br>
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
			<input type="checkbox" name="cmsc2xx[0]" value="CMSC 201" onclick="showMe('cmsc201');">  CMSC 201  <br>
			<div id='cmsc201' style="visibility: hidden;"><input type="checkbox" name="cmsc202" value="CMSC 202">  CMSC 202  <br>
			<input type="checkbox" name="cmsc203" value="CMSC 203" >  CMSC 203  <br> </div>
			<input type="checkbox" name="cmsc2xx[3]" value="CMSC 232">  CMSC 232  <br>
			<input type="checkbox" name="cmsc2xx[4]" value="CMSC 291">  CMSC 291  <br>
			<input type="checkbox" name="cmsc2xx[5]" value="CMSC 299">  CMSC 299  <br>

	3XX Classes<br>
 		
			<input type="checkbox" name="cmsc3xx[0]" value="CMSC 304">  CMSC 304  <br> 
			<input type="checkbox" name="cmsc3xx[1]" value="CMSC 313">  CMSC 313  <br> 
			<input type="checkbox" name="cmsc3xx[2]" value="CMSC 331">  CMSC 331  <br> 
			<input type="checkbox" name="cmsc3xx[3]" value="CMSC 341">  CMSC 341  <br> 
			<input type="checkbox" name="cmsc3xx[4]" value="CMSC 352">  CMSC 352  <br> 
			<input type="checkbox" name="cmsc3xx[5]" value="CMSC 391">  CMSC 391  <br> 
	


	
		4XX Classes<br>
	

			
				<input class="400-level-box" type="checkbox" name="cmsc4xx[0]" value="CMSC 411">  CMSC 411</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[1]" value="CMSC 421">  CMSC 421</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[2]" value="CMSC 426">  CMSC 426</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[3]" value="CMSC 427">  CMSC 427</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[4]" value="CMSC 431">  CMSC 431</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[5]" value="CMSC 432">  CMSC 432</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[6]" value="CMSC 433">  CMSC 433</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[7]" value="CMSC 435">  CMSC 435</br> 
				
				
				<input class="400-level-box" type="checkbox" name="cmsc4xx[8]" value="CMSC 436">  CMSC 436</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[9]" value="CMSC 437">  CMSC 437</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[10]" value="CMSC 441">  CMSC 441</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[11]" value="CMSC 442">  CMSC 442</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[12]" value="CMSC 443">  CMSC 443</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[13]" value="CMSC 444">  CMSC 444</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[14]" value="CMSC 446">  CMSC 446</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[15]" value="CMSC 447">  CMSC 447</br> 
				
				
				<input class="400-level-box" type="checkbox" name="cmsc4xx[16]" value="CMSC 448">  CMSC 448</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[17]" value="CMSC 451">  CMSC 451</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[18]" value="CMSC 452">  CMSC 452</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[19]" value="CMSC 453">  CMSC 453</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[20]" value="CMSC 455">  CMSC 455</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[21]" value="CMSC 456">  CMSC 456</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[22]" value="CMSC 457">  CMSC 457</br> 
				<input class="400-level-box" type="checkbox" name="cmsc4xx[23]" value="CMSC 461">  CMSC 461</br> 
				
				
			<input class="400-level-box" type="checkbox" name="cmsc4xx[25]" value="CMSC 466">  CMSC 466</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[26]" value="CMSC 471">  CMSC 471</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[24]" value="CMSC 465">  CMSC 465</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[27]" value="CMSC 473">  CMSC 473</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[28]" value="CMSC 475">  CMSC 475</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[29]" value="CMSC 476">  CMSC 476</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[30]" value="CMSC 477">  CMSC 477</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[31]" value="CMSC 478">  CMSC 478</br> 
				
				
			<input class="400-level-box" type="checkbox" name="cmsc4xx[32]" value="CMSC 479">  CMSC 479</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[33]" value="CMSC 481">  CMSC 481</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[34]" value="CMSC 483">  CMSC 483</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[35]" value="CMSC 484">  CMSC 484</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[36]" value="CMSC 486">  CMSC 486</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[37]" value="CMSC 487">  CMSC 487</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[38]" value="CMSC 491">  CMSC 491</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[39]" value="CMSC 493">  CMSC 493</br> 
				
				
			<input class="400-level-box" type="checkbox" name="cmsc4xx[40]" value="CMSC 495">  CMSC 495</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[41]" value="CMSC 498">  CMSC 498</br> 
			<input class="400-level-box" type="checkbox" name="cmsc4xx[42]" value="CMSC 499">  CMSC 499</br> 
		
	</div> <br/><br/><br/>

	</form>



</body>
</html>
