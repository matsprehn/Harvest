<?php
// Email Templates

$defaultPhoneNumber = "(714) 564-9525";

function growerResponse($first, $last) {
global $defaultPhoneNumber;
return<<<EOD
Hello $first $last,

Thank you for registering with The Harvest Club!

By sharing your harvest with us, you are strengthening our community by providing fresh, healthy food to our neighbors in need.

The Harvest Club could not exist without your generosity!

We will contact you during the harvest months you have listed to arrange for a harvest event.

If you do not hear from us, please call us at $defaultPhoneNumber or send an email to theharvestclub@gmail.com.

Thank you again, and welcome to The Harvest Club!
EOD;
}

function volunteerResponse($first, $last) {
return<<<EOD
Hello $first $last,

Thank you for registering with The Harvest Club!

With your help, we will harvest fresh, healthy fruits and vegetables for the underserved residents of Orange County.

We will notify you of upcoming harvests by email.

Thank you again, and welcome to The Harvest Club!
EOD;
}

function invitationEmail($p) {
return<<<EOD
Hello Harvesters!

Here are the upcoming Harvest Events with THC: 

$p[harvest_date] | $p[harvest_time] in $p[harvest_city]
Harvesting$p[fruit_list] We need [# of volunteers] volunteers.

Events last 1-2.5 hours. To RSVP, please reply to this email or send a note to volunteer@theharvestclub.org by Friday at 5pm, prior to the harvest event.

If you are a new volunteer, please complete our liability waiver at: http://www.theharvestclub.org/join-us/.

Hope to see you under the trees!

Christina Hall
Program Coordinator
OC Food Access & The Harvest Club
EOD;
}

function harvestDetailsEmail($p) {
return<<<EOD
Dear $p[me_f] $p[me_l],

Thank you for volunteering for the harvest at $p[harvest_time] this $p[harvest_date] in $p[harvest_city]. If this is your first time harvesting with us, please complete the attached Volunteer Liability Waiver, and bring it to $p[captain_first] $p[captain_last], your Harvest Captain, on $p[harvest_date].   

If you cannot make the harvest for any reason, kindly let us know in advance so we can fill your spot! 

HARVEST DETAILS 
Date: $p[harvest_date]
Time: $p[harvest_time]
Grower: $p[grower_first] $p[grower_last] 
Address:  $p[harvest_street], $p[harvest_city] $p[harvest_zip]
Harvesting: $p[fruit_list]

$p[captain_first] $p[captain_last] is your Harvest Captain.  If you are unable to make the harvest for any reason, or get lost on the way, please contact your captain directly at $p[captain_phone].  

Please bring harvesting tools such as clippers and picker poles and if you have them.  We recommend wearing long sleeves, long pants, eye protection such as sunglasses, and sunscreen.  Closed-toed shoes are a must!

Please let me know if you have any questions.  

Happy harvesting! 

Christina Hall
Program Coordinator
OC Food Access & The Harvest Club
EOD;
}

function reminderEmail($p) {
return<<<EOD
Dear $p[me_f] $p[me_l],
You are receiving this email because you have registered to volunteer at a Harvest Event with The Harvest Club!  This is a reminder that the Harvest will take place at $p[harvest_time] on $p[harvest_date] in the City of $p[harvest_city]. 

Your Harvest Captain is $p[captain_f] $p[captain_l].  You can reach him/her at $p[captain_phone] if you run into any problems on the day of the event.  

Please bring harvesting tools such as clippers and picker poles and if you have them.  We recommend wearing long sleeves, long pants, eye protection such as sunglasses, and sunscreen.  Closed-toed shoes are a must!

We look forward to seeing you soon!

Christina Hall
Program Coordinator
OC Food Access & The Harvest Club

EOD;
}

function thankYouVolunteerEmail($p) {
return<<<EOD
Dear $p[me_f] $p[me_l],

On behalf of The Harvest Club, and OC Food Access, thank you for harvesting with us on $p[harvest_date] in $p[harvest_city] Huntington Beach.  With your help The Harvest Club picked $p[total_lbs] pounds of fruit, providing nutritious food to $p[total_lbs_people] people in need in our community.  

We hope you’ll join us again soon!

Christina Hall
Program Coordinator
OC Food Access Coalition
chall@ocfoodaccess.org
EOD;
}

function thankYouGrowerEmail($p) {
return<<<EOD
Dear $p[grower_first] $p[grower_last],

On behalf of The Harvest Club, a program of OC Food Access, I would like to personally thank you for your recent donation of $p[fruit_list] your contribution is providing much needed nutrition to the underserved in Orange County.  

On $p[harvest_date] February 9, 2013, The Harvest Club picked $p[fruit_list_lbs] from your property and delivered it to: 
•	$p[distribution]



Your donation will provide nutritious food to approximately $p[total_lbs_people] people in our community!

If you are happy with our services and know of another backyard grower that could benefit from The Harvest Club, please refer them to us!  They can register their trees at www.theharvestclub.org. 

Once again, we thank you for your generosity and hope you will call us next harvest season!

Sincerely,

Christina Hall
Program Coordinator
OC Food Access Coalition
chall@ocfoodaccess.org

The Harvest Club is a program of the OC Food Access Coalition, a fiscally sponsored project of OneOC.     Tax ID 95-2021700  **Please speak with your tax advisor about the tax deductibility of your donation.

EOD;
}
?>