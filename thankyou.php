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
	$hasevent = false;
	
	$street = ""; 
	$city = "";
	$state = "";
	$zipcode = "";
	
	$eventsString = "";
	
	if(isset($_POST["events"])){
		$eventIds = $_POST["events"];
		$N = count($eventIds);
		for($i=0; $i < $N; $i++) {
		  $hasEvent = true;
		  $eid = $eventIds[$i];
		 
		 $sql = "SELECT distinct v.id 
				FROM volunteers v
				WHERE v.first_name = '$fname'
				AND v.last_name = '$lname'
				AND v.email = '$email'";
				
		 $results = $db->q($sql);
		 if($row = $results->getAssoc()) 
		  {
				$vID = $row['id'];
				//echo "the vid is ". $vID;
		  }
		  $db->addUserToEvent($eid, $vID);
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
	$db->addUser($fname, $lname, $phone, $email, $street, $city, $state, $zipcode);
	
	$to = $email;
	$subject = 'New User has signed the waiver form';
	$message = "$fname $lname has signed the waiver form. 
His/Her phone number is $phone and signed the form at $date.
The generated link for printing out their waiver is here http://localhost/Harvest/generatewaiver.php?picallowed=$waiver_value&signature=$signature&date_signed=$date";
	$headers = 'From: jaskaransingh3001@gmail.com' . "\r\n" .

	'Reply-To: $email' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	if(mail($to, $subject, $message, $headers)) {
	//echo('Email sent successfully!');
	}else {
	//die('Failure: Email was not sent!');
	}
	
	}
	
	if($hasEvent == true){
	
	$to = $email;
	$subject = 'Conformation email for The Harvest Club';
	$message = "Hi $fname $lname, 
Thanks for signing up for some event";
	$headers = 'From: jaskaransingh3001@gmail.com' . "\r\n" .

	'Reply-To: $email' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	if(mail($to, $subject, $message, $headers)) {
	//echo('Email sent successfully!');
	}else {
	//die('Failure: Email was not sent!');
	}
}	
		
//echo "Thank you for signing up with The Harvest Club. A confirmation email will be sent to you soon";
	
?>

<html>
<head>
<link href="css/rsvpForm.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="form-container">
	<div class="form-heading"><h1 class="form-title" dir="ltr">Harvest Event RSVP Form &ndash; The Harvest Club</h1>
	<center>  Thank you for signing up with The Harvest Club. A confirmation email will be sent to you soon</center>
	</div>
</div>
</div>
</body>
</html>

