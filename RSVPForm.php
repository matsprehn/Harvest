<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- saved from url=(0085)https://docs.google.com/forms/d/1zvS8beJH6EeSxzlPGBR8R0xLPFRkkaCfou0DCPqxQ-o/viewform -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link rel="shortcut icon" href="https://ssl.gstatic.com/docs/spreadsheets/forms/favicon_jfk2.png" type="image/x-icon">

<meta http-equiv="X-UA-Compatible" content="IE=10; chrome=1;">
<meta name="fragment" content="!">
<!--<base target="_blank">--><base href="." target="_blank">
<title>Harvest Event RSVP Form</title>

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

<div class="form-heading"><h1 class="form-title" dir="ltr">Harvest Event RSVP Form</h1>
<p></p>
<div class="ss-form-desc ss-no-ignore-whitespace">Please RSVP for the Harvest Club upcoming events by filling out the form. If you have any questions please contact us at <a href="mailto:volunteer@theharvestclub.org">volunteer@theharvestclub.org</a>.</div>

<div class="">* Required</div>
</div>
	<form  class="cmxform" action="thankyou.php" method="POST" id="form">
		<div class="errorbox-good">
			<div>
				<div class="form-entry">
					<label>
						<div> First Name
							<span class="ss-required-asterisk">*</span>
						</div>
					</label>
						<input type="text" name="name" class="ss-q-short" id="fname" required> 
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
						<div> E-mail
							<span class="ss-required-asterisk">*</span>
						</div>
					</label>
						<input type="text" name="email" class="ss-q-short" id="email" required> 
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

<br/>
<div class="errorbox-good">
	<div>
		<div class="form-entry">
			<label>
				<div>Choose any Event that you want to participate in.</br> <p>Events typically last 1-2.5 hours.</p>
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
$future_events = array();

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
  
$temp1 = array_shift($all);
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
	echo "<form> <input type=\"checkbox\" name=\"sex\" value=\"male\">".$type." Harvest in ".$city." [ ".$date." , ".$time." ] "."<br> </form>"; // Haven'st added the full info yet
	echo "</br>";
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
	echo "<form> <input type=\"checkbox\" name=\"sex\" value=\"male\">".$type." Harvest in ".$city." [ ".$date." , ".$time." ] "."<br> </form>"; // Haven'st added the full info yet
	echo "</br>";
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

<div id="container">
          </br>
           <button type="button"> <p id="add_field"><span>&raquo; I'd like to bring a guests</span></p> </button>
</div>
<br>
<input type="checkbox" id="waiver_box"> This is my first harvest! </br>
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
		<input type="checkbox" id="waiver_box"> I allow my picture to be taken</br>
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





