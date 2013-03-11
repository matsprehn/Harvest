<?php
if(isset($_GET["picallowed"])){
	$pic = $_GET["picallowed"];
}
if(isset($_GET["waiver_value"])){
	$waiver = $_GET["waive_value"];
}
if(isset($_GET["signature"])){
	$sign = $_GET["signature"];
}
if(isset($_GET["date_signed"])){
	$date = $_GET["date_signed"];
}
 
if($waiver = "yes"){
	$w_value = "&#x2713; Yes, I give my permission </br></br>";
}else {
	$w_value = "&#x2713; No, I do not want to appear in a photograph or videotape </br></br>";
} 
 
$message =  "<center>The Harvest Club Volunteer Form and Photo Release </br> </br>

VOLUNTEER ASSUMPTION OF RISK, </br>
RELEASE OF LIABILITY, AND INDEMNITY AGREEMENT FOR </br>
THE HARVEST CLUB </br>
of Orange County </br>
Orange County, CA </br>
www.theharvestclub.org </br> </br> </center>
Adult Volunteer(s): $sign </br>
Address______________City____________Zip_________    </br>
Telephone_____________________________________       </br>
Email_________________________________________       </br>
Group Affiliation _______________________________     </br> </br>
Please indicate if you give permission to appear in videos, 
photos, or audio recordings without compensation (e.g., as 
part of brochures, slide shows or program websites).  </br></br>
$w_value
&nbsp;&nbsp;&nbsp;&nbsp;I, the undersigned, an adult 18 years or over, and any minor(s) listed below, hereby request to participate in THE HARVEST 
CLUB Harvesting Project (THC). I am aware that participation in THC involves physical harvesting, which includes, among other 
things, exposure to the elements, gardening tools, plant contact, risks in climbing, lifting and agricultural chemicals. I understand that 
such participation presents a risk of injury, and I agree to assume any and all risk for injuries arising out of, or related to, participation 
in the THC project and understand that the Released Parties (as such term is defined below) shall NOT be responsible or liable for any 
injury, damage, loss or expense to me and/or my property incurred as a result of my participation in the THC Project. </br></br>

&nbsp;&nbsp;&nbsp;&nbsp;As a condition of participation in the THC Project, on behalf of myself, minors, and my successors and assigns, I hereby 
agree to forever release, discharge, acquit, hold harmless and indemnify, all individuals working with the THC Project, their affiliates 
and their respective members, produce donors, volunteers and representatives (including, without limitation, any donor growers or 
other participants and contributors who grant access to private property for purposes related to the THC Project) and their respective 
successors and assigns (“Released Parties”), from any and all charges, complaints, claims, demands, obligations, damages, actions, 
causes of action, suits, rights, costs, losses, debts expenses (including attorney’s fees and costs) liabilities, and indebtedness, of every 
type, kind, nature, description or character, whether known or unknown, suspected or unsuspected, liquidated or unliquidated arising 
from, under, or related to, any act or omission of any of the Released Parties , or otherwise in any way related to, or arising from, 
participation in THC Project (“Released Matters”). I acknowledge and agree that the releases made herein constitute final and 
complete releases of the Released Parties with respect to all Released Matters, and that by signing this Agreement, I am forever giving 
up the right to sue or attempt to recover money, damages or any other relief from the Released Parties for all claims I may have with 
respect to the Released Matters (even if any such claim is unforeseen as of the date hereof). I understand California Civil Code 
Section 1542, which provides as follows: </br></br>

&nbsp;&nbsp;&nbsp;&nbsp;“A GENERAL RELEASE DOES NOT EXTEND TO CLAIMS WHICH THE CREDITOR DOES NOT KNOW OR 
SUSPECT TO EXIST IN HIS FAVOR AT THE TIME OF EXECUTING THE RELEASE WHICH IF KNOWN BY HIM MUST
HAVE MATERIALLY AFFECTED HIS SETTLEMENT WITH THE DEBTOR.” </br></br>

&nbsp;&nbsp;&nbsp;&nbsp;I, being aware of Section 1542, hereby expressly waive any and all rights I may have thereunder and do so understanding and 
acknowledging the significance and consequence of such specific waiver. </br></br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Permission is also given to authorize emergency medical treatment if necessary. </br></br>
Please print minors names below: (or n/a) </br></br>
__________________________________ $date  _______________________________$date </br></br>
__________________________________ $date _______________________________ $date</br></br>
&nbsp;&nbsp;&nbsp;&nbsp;Adult Signature Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             Adult Signature Date";
echo $message;
?>