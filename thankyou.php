<?php
include 'include/Mailer.php';

echo "lol";
echo "</br>";
echo "name is ".$_POST["fname"];
echo "</br>";
echo "last name ".$_POST["lname"];
echo "</br>";
echo "Email name ".$_POST["email"];
echo "</br>";
echo "Phone is ".$_POST["phone"];
echo "</br>";


  $aDoor = $_POST["events"];
  if(empty($aDoor)) 
  {
    echo("You didn't select any buildings.");
  } 
  else
  {
    $N = count($aDoor);
 
    echo("You selected $N door(s): ");
    for($i=0; $i < $N; $i++)
    {
      echo($aDoor[$i] . " ");
    }
  }
echo "</br>";
echo "the guest b.s is down here";
echo "</br>";
$guest = $_POST["fields"];

echo "";
if(empty($guest)) 
  {
    echo("You didn't select any buildings.");
  } 
  else
  {
    $N = count($guest);
 
    echo("You selected $N door(s): ");
    for($i=0; $i < $N; $i++)
    {
      echo($guest[$i] . " ");
    }
  }
echo "</br>";
echo "fuuuu";

echo "</br>";
echo "THis is my first harvest";
echo "</br>";
echo "the value of the first harvest box is ". $_POST["waiver_box"];
echo "</br>";

$waiver_value = $_POST["waiver_box"];


if($waiver_value == "yes"){
		echo"</br>";
		echo " The checkbox was selected";
}else
{	
	echo "</br>";
	echo "The checkbox was not selected";
}

echo "I'd like to sign up my picture pls pls pls pls";

$picture_value = $_POST["picture_box"];

echo $picture_value;

if($picture_value == "yes"){
		echo"</br>";
		echo " The checkbox was selected";
}else
{	
	echo "</br>";
	echo "The checkbox was not selected";
}

echo "<br/>";
echo "the signature is ".$_POST["signature"];
echo "<br/>"

$mail = new Mailer("jazzy", "jaskaransingh3001@gmail.com", "fuckyou", "SUP :DDD");

/*
if($mail->sendOK()){
	echo "IT SENT YAA!";
}else
{
	echo "it didn't send ya noob";
}
*/


?>

<html>
<body>

THANKS FOR SIGNING UP!

</body>	
</html>