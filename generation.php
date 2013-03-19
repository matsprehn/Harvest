<html>
<head> 
<link href="css/generation.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class = "header"><center>
<strong><u><div id="title">The Harvest Club Volunteer Form and Photo Release</div></u></br>
<div class = "title1">VOLUNTEER ASSUMPTION OF RISK, </br>
RELEASE OF LIABILITY, AND INDEMNITY AGREEMENT FOR </br>
THE HARVEST CLUB</div> </br>
<div class="title2">of Orange County </br>
Orange County, CA </br>
www.theharvestclub.org</div> </strong> </br></center>
</div>

<div class ="form">
<?php   
$pic;
$waiver;
$sign;
$date = ''; 
$address;
$city;
$zipcode;

if(isset($_GET["picallowed"])){
	$pic = $_GET["picallowed"];
}
if(isset($_GET["waiver_value"])){
	$waiver = $_GET["waiver_value"];
}
if(isset($_GET["signature"])){
	$sign = $_GET["signature"];
}
if(isset($_GET["date_signed"])){
	$date = $_GET["date_signed"];
}
if(isset($_GET["address"])){
	$address = $_GET["address"];
}
if(isset($_GET["city"])){
	$city = $_GET["city"];
}
if(isset($_GET["zipcode"])){
	$zipCode = $_GET["zipcode"];
}
if(isset($_GET["phone"])){
	$phone = $_GET["phone"];
}
if(isset($_GET["email"])){
	$email = $_GET["email"];
}
?>


Adult Volunteer(s)&nbsp;&nbsp;&nbsp;<?php $fname; $lname; if(isset($_GET["fname"])){ $fname = $_GET["fname"];} if(isset($_GET["lname"])){ $lname = $_GET["lname"];} echo "<u>".$fname." ".$lname."</u>"; ?> <br></br>
Address:&nbsp;&nbsp;&nbsp;<?php if(isset($_GET["address"])){ $address = $_GET["address"]; echo "<u>".$address."</u>";}  ?>  <br></br>
City:&nbsp;&nbsp;&nbsp;<?php if(isset($_GET["city"])){ $city = $_GET["city"]; echo "<u>".$city."</u>";}  ?>&nbsp;&nbsp;&nbsp;ZipCode:&nbsp;&nbsp;&nbsp;<?php if(isset($_GET["zipcode"])){ $zipcode = $_GET["zipcode"]; echo "<u>".$zipcode."</u>";}  ?>       <br></br>
Telephone:&nbsp;&nbsp;&nbsp;<?php if(isset($_GET["phone"])){ $phone = $_GET["phone"]; echo "<u>".$phone."</u>";}  ?> </br></br>
Email:&nbsp;&nbsp;&nbsp;<?php if(isset($_GET["email"])){ $email = $_GET["email"]; echo "<u>".$email."</u>";}  ?> </br></br></br>


<div>
<strong>Please</strong> indicate if you give permission to appear in videos, </br>
photos, or audio recordings without compensation (e.g., as  </br>
part of brochures, slide shows or program websites). </br></br>
<?php 

if(isset($_GET["picallowed"])){
	$pic = $_GET["picallowed"];
}
if($pic == "yes"){
	echo $w_value = "&#x2713; Yes, I give my permission </br></br>";
}else {
	echo $w_value = "&#x2713; No, I do not want to appear in a photograph or videotape </br></br>";
} 
?>
</div>
</br>

<div class="paragraphs">I, the undersigned, an adult 18 years or over, and any minor(s) listed below, hereby request to participate in THE HARVEST 
CLUB Harvesting Project (THC). I am aware that participation in THC involves physical harvesting, which includes, among other 
things, exposure to the elements, gardening tools, plant contact, risks in climbing, lifting and agricultural chemicals. I understand that 
such participation presents a risk of injury, and I agree to assume any and all risk for injuries arising out of, or related to, participation 
in the THC project and understand that the Released Parties (as such term is defined below) shall NOT be responsible or liable for any 
injury, damage, loss or expense to me and/or my property incurred as a result of my participation in the THC Project.
</div>

</br>

<div class="paragraphs">
As a condition of participation in the THC Project, on behalf of myself, minors, and my successors and assigns, I hereby 
agree to forever release, discharge, acquit, hold harmless and indemnify, all individuals working with the THC Project, their affiliates 
and their respective members, produce donors, volunteers and representatives (including, without limitation, any donor growers or 
other participants and contributors who grant access to private property for purposes related to the THC Project) and their respective 
successors and assigns (&#34;Released Parties&#34;), from any and all charges, complaints, claims, demands, obligations, damages, actions, 
causes of action, suits, rights, costs, losses, debts expenses (including attorney’s fees and costs) liabilities, and indebtedness, of every 
type, kind, nature, description or character, whether known or unknown, suspected or unsuspected, liquidated or unliquidated arising 
from, under, or related to, any act or omission of any of the Released Parties , or otherwise in any way related to, or arising from, 
participation in THC Project (&#34;Released Matters&#34;). I acknowledge and agree that the releases made herein constitute final and 
complete releases of the Released Parties with respect to all Released Matters, and that by signing this Agreement, I am forever giving 
up the right to sue or attempt to recover money, damages or any other relief from the Released Parties for all claims I may have with 
respect to the Released Matters (even if any such claim is unforeseen as of the date hereof). I understand California Civil Code 
Section 1542, which provides as follows:
</div>
<br>
<div id="itaparagraph">
&#34;A GENERAL RELEASE DOES NOT EXTEND TO CLAIMS WHICH THE CREDITOR DOES NOT KNOW OR 
SUSPECT TO EXIST IN HIS FAVOR AT THE TIME OF EXECUTING THE RELEASE WHICH IF KNOWN BY HIM MUST
HAVE MATERIALLY AFFECTED HIS SETTLEMENT WITH THE DEBTOR.&#34;
</div>

<br>

<div class="paragraphs">
I, being aware of Section 1542, hereby expressly waive any and all rights I may have thereunder and do so understanding and 
acknowledging the significance and consequence of such specific waiver.
</div>

<br>

<div id="permission">
* <strong><u>Permission is also given to authorize emergency medical treatment if necessary.</u></strong>
</div>
<br>

Please Sign below:
<br>
<br>
<br>

Signature: <?php 
if(isset($_GET["signature"])){
	$sign = $_GET["signature"];
	echo "<u>".$sign."</u>";
}
?> &nbsp;&nbsp;&nbsp; Date:<?php 
if(isset($_GET["date_signed"])){
	$date = $_GET["date_signed"];
	echo "<u>".$date."</u>";
} ?>
</div>
</body>
</html>