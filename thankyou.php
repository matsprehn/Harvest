<?php
//include 'sendmail/sendmail.ini';
require_once('include/auth.inc.php');
require_once('include/Database.inc.php');

	$fname=$_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$date = date("m/d/Y");
	$events; // is an array of events
	$guest; // is an array of guets
	$waiver_value = "no"; // Assume its not entered
	$picture_value = "no";
	$signature;
	
	$street = ""; 
	$city = "";
	$state = "";
	$zipcode = "";
	
	if(isset($_POST["events"])){
		$events = $_POST["events"];
		$N = count($events);
		for($i=0; $i < $N; $i++) {
		  echo "</br>";
		  echo "The events are";
		  echo "</br>";
		  echo($sEvents = $events[$i]);
		  $pieces = explode(" ", $sEvents);
		  $date = $pieces[0]; // gets the date
		   echo "</br>";
		  echo "date is ". $date;
		  echo "</br>";
		  $time = $pieces[1]." ".$pieces[2]; // gets the time
		  echo "</br>";
		  echo "time is ". $time;
		  echo "</br>";
		  echo "vid is ".$vid1 = $db->getV_id($fname, $lname, $email);
		  $vid = mysql_fetch_array($vid1);
		  echo "</br>";
		  echo "eid is ".$eid = $db->getE_id($date, $time);
		  echo "</br>";
		  echo $db->addUserToEvent($eid, $vid);
		}
		
		
	}
	
	if(isset($_POST["fields"])){
		$guest = $_POST["fields"];
		$N = count($guest);
		//echo("You selected $N door(s): ");
		for($i=0; $i < $N; $i++)
		{
		  echo($guest[$i] . " ");
		}
	} 
    
	if(isset($_POST["waiver_box"])){
			$waiver_value = $_POST["waiver_box"];
				
			if($waiver_value == "yes"){
			
			$waiver_value = "yes";
			
			}else{	
			
			$waiver_value = "no";
			}
		}

	

	if(isset($_POST["picture_box"])){
		$picture_value = $_POST["picture_box"];
		
		if($picture_value == "yes"){
			
			$picture_value = "yes";
			
			}else{	
			
			$picture_value = "no";
			}
	} 

	if(isset($_POST["signature"])){
	
		$signature = $_POST["signature"];
		
	} 

	if($waiver_value == "yes"){
	echo "</br>";
	echo "</br>";
	echo "ITS ABOUT TO BE INSERTED!";
	echo "</br>";
	$db->addUser($fname, $lname, $phone, $email, $street, $city, $state, $zipcode);
	echo "</br>";
	echo "ITS INSIDE!";
	}
	
	
	
$to = $email;
$subject = 'New User has signed the waiver form';
$message = "$fname $lname has signed the waiver form. 
His/Her phone number is $phone and signed the form at $date.
The generated link for printing out their waiver is here http://localhost/Harvest/generatewaiver.php?picallowed=$waiver_value&signature=$signature&date_signed=$date";
$headers = 'From: jaskaransingh3001@gmail.com' . "\r\n" .

	'Reply-To: $email' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	if(mail($to, $subject, $message, $headers)) {
	echo('Email sent successfully!');
	}else {
	die('Failure: Email was not sent!');
	}
	
echo "thank you for signing up with The Harvest Club";
	
?>
