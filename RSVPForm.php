<!--

INF 117 START

Purpose of this code is that it creates an form that the client can use to help automate the process for registering for a harvest event. the code first starts by using the basic 
html css elements to style and display the form. I then use php to dynamically pull all the future events that are going to happen. I'm just reading values from the database with the standard methods.
 I also used the jquery in form to validate. It validates by making sure all the required fields have some value in them. I also used jquery to create a fuction in a javascript file that creates more guests fields if a button is pressed.
This form then will post onto another page called "thankyou.php" when submit is clicked. 


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- saved from url=(0085)https://docs.google.com/forms/d/1zvS8beJH6EeSxzlPGBR8R0xLPFRkkaCfou0DCPqxQ-o/viewform -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link rel="shortcut icon" href="https://ssl.gstatic.com/docs/spreadsheets/forms/favicon_jfk2.png" type="image/x-icon">

<meta http-equiv="X-UA-Compatible" content="IE=10; chrome=1;">
<meta name="fragment" content="!">
<!--<base target="_blank">--><base href="." target="_blank">
<title>Harvest Event RSVP Form – The Harvest Club </title>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/addingGuests.js"></script>
<script type="text/javascript" src="js/validate.js"></script>
<link href="css/rsvpForm.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$(".form").validate();
})

</script>
</head>
<div class="form-container">

<div class="form-heading"><h1 class="form-title" dir="ltr">Harvest Event RSVP Form &ndash; The Harvest Club</h1>
<p></p>
<div class="ss-form-desc ss-no-ignore-whitespace">To register for upcoming events, please submit a completed RSVP no later than the Friday, prior to the harvest event. </br> If you have any questions, you can contact us at info@theharvestclub.com or by phone at 714-564-9525. </br></br>

Please provide a phone number below where you can be reached the day of the event, should we need to contact you </br> with updated event details. 
</a>.</div>

<div class="">* Required</div>
</div>
	<form  class="cmxform" action="thankyou.php" method="post" id="form">
		<div class="errorbox-good">
			<div>
				<div class="form-entry">
					<label>
						<div> First Name
							<span class="ss-required-asterisk">*</span>
						</div>
					</label>
						<input type="text" name="fname" class="ss-q-short" id="fname" required> 
				</div>
			</div>
		</div> 

<div class="errorbox-good">
			<div>
				<div class="form-entry">
					<label>
						<div> Last Name
							<span class="ss-required-asterisk">*</span>
						</div>
					</label>
						<input type="text" name="lname" class="ss-q-short" id="lname" required> 
				</div>
			</div>
		</div> 

<div class="errorbox-good">
			<div>
				<div class="form-entry">
					<label>
						<div> Phone Number
							<span class="ss-required-asterisk">*</span>
						</div>
					</label>
						<input type="text" name="phone" class="ss-q-short" id="phone" required> 
				</div>
			</div>
		</div> 
		
<div class="errorbox-good">
			<div>
				<div class="form-entry">
					<label>
						<div> E-mail
							<span class="ss-required-asterisk">*</span>
						</div>
					</label>
						<input type="text" name="email" class="ss-q-short" id="email" required> 
				</div>
			</div>
		</div> 
	
My Guest&#39;s Information:
	
<div id="container">
     </br>
     To register additional guests, please click here <button type="button"> <p id="add_field"><span>&raquo; I'd like to bring a guests</span></p> </button>
</div>
<br>

<div class="errorbox-good">
	<div>
		<div class="form-entry">
			<label>
				<div><strong>Current Harvest Events</strong> </br></br> To reserve your volunteer spot on a team, select from the dates below.  
Event details will be emailed to the team prior</br> to the harvest.  We will reschedule in the event of rain, and will send an email notification.  

</br></br>Events last 1-2.5 hours, depending on the size of the trees and amount of fruit.
</p>
					<span class="ss-required-asterisk"></span>
				</div>
			</label>
<?php   
require_once('include/auth.inc.php');
require_once('include/Database.inc.php');

$sql = "SELECT Distinct growers.city, tree_types.name, events.date, events.time
FROM `events` 
	join growers on events.grower_id = growers.id 
        join grower_trees on grower_trees.grower_id = growers.id 
        join tree_types on grower_trees.tree_type = tree_types.id
WHERE events.date >= curDate() and growers.id = events.grower_id
order by events.date";
//echo $sql;

$results = $db->q($sql);
echo "</br>";
//echo "</br>";
if($results === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

/*
This section of the code finds all the future events from the database and enters them into an array that will be used in the next section. I'm just running through a basic
while loop to get all the information. I only take the last index for the array because thats the only index that holds all the values.
*/
$event = array();
$all_Events = array();
$type_Of_Fruit = null;
$visted = false;
while ($row = $results->getAssoc()) {
  $city = $row['city'];
  $name = $row['name'];
  $date = $row['date'];
  $time = $row['time'];
  

  array_push($event, $city, $name, $date, $time);
  array_push($all_Events, $event);
}
//echo "count is ". $count1;

$count = count($all_Events);
$count1 = count($all_Events[$count-1]);
//echo "count is ". $count1;
$all_Events[$count-1];
$all = $all_Events[$count-1];
$future_events = array(); // THIS method is going to be used to populate the future events

$x = 0;
while(!empty($all))
{
$city = $all[$x];
$x++;
$type = $all[$x];
$x++;
$date = $all[$x];
$x++;
$time = $all[$x];
$x++;
  
$x = 0;
  
$temp1 = array_shift($all);  // Deleting the entries in the array because that value will be called in the next few lines
$temp2 = array_shift($all);
$temp3 = array_shift($all);
$temp4 = array_shift($all);


if(isset($all[0])){
	if(!($all[0] == $city)){
		if($visted){
			$type = $type_Of_Fruit;
		}else{
	
		}
		$visted = false;
	echo "<input type=\"checkbox\" name=\"events[]\" value=\"$date $time </br>\">".$type." Harvest in ".$city." [ ".$date." , ".$time." ] "."<br>"; 
	echo "</br>";
	
	//echo "<input type=\"checkbox\" name=\"events[]\" value=\"$type Harvest in $city [$date , $time] </br>\">".$type." Harvest in ".$city." [ ".$date." , ".$time." ] "."<br>"; 
	
  $harvest  = $type." Harvest in ".$city." [ ".$date." , ".$time; // Going to use to create a drop down menu
  array_push($future_events, $harvest);
	$type=null;
	}
}else {
	if($visted){
			$type = $type_Of_Fruit;
		}else{
	
		}
		$visted = false;
	echo "<input type=\"checkbox\" name=\"events[]\" value=\"$date $time </br>\">".$type." Harvest in ".$city." [ ".$date." , ".$time." ] "."<br>"; // Haven'st added the full info yet
	echo "</br>";
	
	//echo "<input type=\"checkbox\" name=\"events[]\" value=\"$type Harvest in $city [$date , $time] </br>\">".$type." Harvest in ".$city." [ ".$date." , ".$time." ] "."<br>";
	
  $harvest  = $type." Harvest in ".$city." [ ".$date." , ".$time; // Going to use to create a drop down menu
  array_push($future_events, $harvest);
	$type=null;
}
if(isset( $all[0])){
	if($all[0] == $city && $all[2] == $date && $all[3] == $time)
	{
		if($visted){
			$type = $type_Of_Fruit;
		}		
		$type = $type." and ".$all[$x+1];   // combines multiple trees if listed in the events
	  $type_Of_Fruit = $type;
	  $visted = true;
	}
	else{
	  //echo "This is the only event";
	  if(isset($all[$x+1])){
	  $type = $all[$x+1];   // gets the type of tree
	  }
	}
  }
  else{
	  if(isset($all[$x+1])){
	  $type = $all[$x+1];   // gets the type of tree
	  }   
  }
}
?>
</br>

<input type="checkbox" name="waiver_box" id="waiver_box" value="yes"> This is my first harvest! </br>
<div class ="waiver">
	<div>
		<div class="form-entry"><h2 class="section-title">Waiver Form</h2>
			<div class="section-description no-ignore-whitespace">Please read the following waiver and sign electronically below:
				<a href="2012 THC Liability Form and Photo Release copy.pdf">http://goo.gl/BmxHG</a>

			</div>
		</div>
	</div>
</div>
</div> 

<div class ="waiver">
	<div class="errorbox-good">
		<input type="checkbox" name= "picture_box" id="picture_box" value="yes"> I allow my picture to be taken</br>
			</br>
				<div>
					<div class="form-entry">
						<label class=>
							<div>I agree to the terms and conditions
								<span class="ss-required-asterisk">*</span>
							</div>

							<div>Sign electronically with your full name. </div>
						</label>
					<input type="text" name="signature" value="" class="ss-q-short" id="signature" >
					</div>
				</div>
			</div>
		</div>


<input type="hidden" name="draftResponse" value="[]">
<input type="hidden" name="pageHistory" value="0">


<div class="form-entry">
<input type="submit" name="submit" value="Submit" id="ss-submit">

</div></form></div>
</div></div>


<!-- INF 117 END  ******************************************************************-->


