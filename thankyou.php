<?php
//include 'sendmail/sendmail.ini';
require_once('include/auth.inc.php');
require_once('include/Database.inc.php');

	$fname=$_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$rsvpAddress = $_POST["address"];
	$rsvpCity = $_POST["city"];
	$rsvpZipCode = $_POST["zipcode"];
	
	//echo $rsvpAddress;
	echo "</br>";
	//echo $rsvpCity;
	echo "</br>";
	//echo $rsvpZipCode;
	echo "</br>";
	
	$date = date('M-d-Y');
	$events; // is an array of events
	$guest; // is an array of guets
	$waiver_value = "no"; // Assume its not entered
	$picture_value = "no";
	$signature;
	$hasEvent = false;
	$fullString = "";
	$eventArray = array();
	
	$street = ""; 
	$city = "";
	$state = "";
	$zipcode = "";
	
	$eventsString = "";
	
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
		
		$signature = str_replace(' ', '', $signature); // removed the space because the url will fuck up
		
	} 

	if(isset($_POST["events"])){
		$eventIds = $_POST["events"];
		$N = count($eventIds);
		for($i=0; $i < $N; $i++) {
		  $hasEvent = true;
		  $eid = $eventIds[$i];
		 
		 $sql1 = " SELECT e.date, e.time
				   FROM events e
				   where e.id = '$eid'";
		 
		 $sql = "SELECT distinct v.id 
				FROM volunteers v
				WHERE v.first_name = '$fname'
				AND v.last_name = '$lname'
				AND v.email = '$email'";
				
		 $results = $db->q($sql);
		 $results1 = $db->q($sql1);
		 if($row = $results->getAssoc()) 
		  {
				$vID = $row['id'];
				//echo "the vid is ". $vID;
		  }
		  if($row = $results1->getAssoc()) 
		  {
				 $dDate = $row['date'];
				 $dTime = $row['time'];
				//echo "the vid is ". $vID;
				
				$ts = strtotime($dDate);
				$dDate = Date('M-d-Y', $ts);
				
				$eString = "On $dDate at $dTime";  
				array_push($eventArray, $eString); 
		  }
		  
		  $db->addUserToEvent($eid, $vID);
		}
		
		
	}
	
	if($waiver_value == "yes"){
	$db->addUser($fname, $lname, $phone, $email, $street, $city, $state, $zipcode);
	
	$to = $email;
	$subject = 'New User has signed the waiver form';
	$message = "$fname $lname has signed the waiver form. 
His/Her phone number is $phone and signed the form at $date.
The generated link for printing out their waiver is here http://localhost/Harvest/generatewaiver.php?picallowed=$picture_value&waiver_value=$waiver_value&signature=$signature&date_signed=$date&address=$rsvpAddress&city=$rsvpCity&zipcode=$rsvpZipCode&email=$email&phone=$phone";
	$headers = 'From: jaskaransingh3001@gmail.com' . "\r\n" .

	'Reply-To: $email' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	
	$messageStart =" $fname $lname has filled out their waiver form. 
	
He/She has checked $picture_value on giving their permission to appear in photos/videos.
	
To print this form for the OCFAC files, click http://localhost/Harvest/generation.php?fname=$fname&lname=$lname&picallowed=$picture_value&waiver_value=$waiver_value&signature=$signature&date_signed=$date&address=$rsvpAddress&city=$rsvpCity&zipcode=$rsvpZipCode&email=$email&phone=$phone 
	
For any questions, their email address is $email  and his/her phone number is $phone.";
	
	if(mail($to, $subject, $messageStart, $headers)) {
	//echo('Email sent successfully!');
	}else {
	//die('Failure: Email was not sent!');
	}
	}
	
	if($hasEvent == true){
	
	$to = $email;
	$subject = 'Conformation email from The Harvest Club';
	$messageStart = "Hello $fname $lname,

You have RSVP'd for the following harvests:\r\n\r\n";

foreach($eventArray as $eve) {
		  $stringe = $eve."\r\n\r\n";
		  $fullString = $fullString . $stringe;
	}

$messageEnd = "\r\nYou will receive an email from our coordinator shortly to confirm your spot on a harvest team. Details regarding this harvest will be sent to you a day or two prior to the harvest date. If you have any questions, you can email us at info@theharvestclub.org or call us at 714-564-9525. 

Happy Harvesting!

Christina
__
Christina Hall
Program Coordinator
714.564.9525 (o) 909.225.5911 (c)
www.ocfoodaccess.org";

	
	$headers = 'From: jaskaransingh3001@gmail.com' . "\r\n" .

	'Reply-To: $email' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	$message = $messageStart . $fullString . $messageEnd;
	
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

