<?php 

	require_once('include/Database.inc.php');
	require_once('include/auth.inc.php');
	
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"export.csv\"");	
	header("Content-Transfer-Encoding: binary");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	date_default_timezone_set("America/Los_Angeles");
	
	$table = $_REQUEST['table'];
	$arrayID = $_REQUEST['arrayID'];
	$ids = join(',',$arrayID);
	
	function forbidden() {
		return "You do not have sufficient privileges!";
	}
 
	if (!isLoggedIn(false)) { // if we're not logged in, tell user
		exit('Unauthorized. Please login to complete your request.');
	}

	if (isExpired()) { // if session expired, tell user
		exit('Session expired. Please login to complete your request.');
	}

	updateLastReq(); // ajax req means user is active

	// try to get current user permissions
	$r = $db->q("SELECT p.*
			FROM volunteers v
			LEFT JOIN privileges p
			ON v.privilege_id = p.id
			WHERE v.id=$_SESSION[id]"
	);

	$priv_error = "An error occurred while checking your privileges.\nI cannot allow you to proceed.";
	if (!$r->isValid())
		die($priv_error);

	// global containing all this user's privileges
	$PRIV = $r->buildArray();
	$PRIV = array_key_exists(0, $PRIV) ? $PRIV[0] : null;

	if ($PRIV == null)
		die($priv_error);
	$filename = "export";
	$my_t=getdate(date("U"));
	//print("$my_t[weekday], $my_t[month] $my_t[mday], $my_t[year]");
 
		
	switch ($table)
	{
		case 1: //volunteer
			if (!$PRIV['exp_volunteer'])
				die(forbidden());
			$filename = "volunteers";		
			$res = mysql_query("SELECT first_name as 'First Name',
									   middle_name as 'Middle Name',
									   last_name as 'Last Name',
									   email as Email,
									   phone as Phone,
									   street as Street, 
									   city as City,
									   state as State,
									   zip as Zip,
									   signed_up as 'Signed Up',
									   notes as Notes
 							    FROM volunteers WHERE id IN($ids) ");
		break;
		
		case 2: // grower
			if (!$PRIV['exp_grower'])
				die(forbidden());
			$filename = "growers";
			$res = mysql_query("SELECT 	g.first_name AS First,
										g.middle_name AS Middle,
										g.last_name AS Last,
										g.phone AS Phone,
										g.email AS Email,
										g.preferred AS Preferred,
										g.street AS Street,
										g.city AS City,
										g.state AS state,
										g.zip AS Zip,
										g.tools AS Tools,
										s.name AS Source,
										g.notes AS Notes,
										IF(g.pending=1,'YES','NO') AS Pending,
										pt.name AS 'Property Type',
										pr.name AS 'Property Relationship'
								FROM	growers g	LEFT JOIN property_types pt ON g.property_type_id = pt.id
													LEFT JOIN property_relationships pr ON g.property_relationship_id = pr.id
													LEFT JOIN sources s ON g.source_id = s.id
								WHERE	g.id IN($ids)");										
		break;		
		case 3: // tree
			if (!$PRIV['exp_grower'])
				die(forbidden());
			$filename = "growers_trees";
			$res = mysql_query("SELECT 	g.first_name AS First,
										g.middle_name AS Middle,
										g.last_name AS Last,
										g.phone AS Phone,
										g.email AS Email,
										g.preferred AS Preferred,
										g.street AS Street,
										g.city AS City,
										g.state AS state,
										g.zip AS Zip,
										g.tools AS Tools,
										s.name AS Source,
										g.notes AS Notes,
										IF(g.pending=1,'YES','NO') AS Pending,
										pt.name AS 'Property Type',
										pr.name AS 'Property Relationship',
										tt.name AS 'Tree type',
										gt.varietal AS Varietal,
										gt.number AS Number,										
										IF(gt.chemicaled is null,'',(IF((gt.chemicaled=0),'No','Yes'))) AS Chemicaled,										
										th.name AS Height,
										(SELECT group_concat(m.name)
										FROM	month_harvests mh, months m
										WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months'										
								FROM	growers g 	LEFT JOIN sources s ON g.source_id = s.id
													LEFT JOIN property_types pt ON g.property_type_id = pt.id
													LEFT JOIN property_relationships pr ON g.property_relationship_id = pr.id
													LEFT JOIN grower_trees gt ON g.id = gt.grower_id 
													LEFT JOIN tree_types tt ON gt.tree_type = tt.id
													LEFT JOIN tree_heights th ON gt.avgHeight_id = th.id																							
								WHERE	g.id IN($ids)");
								break;		
		case 4: // distribution
			if (!$PRIV['exp_distrib'])
				die(forbidden());
			$filename = "distribs";
/*
			$res = mysql_query("SELECT name as 'Agency Name',
									   street as 'Street Address',
									   city as City,
									   state as State,
									   zip as 'Zip Code',
									   contact as 'Agency Contact',
									   phone as Phone,
									   contact2 as 'Secondary Contact',
									   phone2 as 'Secondary Phone',
									   email as Email,
									   notes as Notes,
									   (	SELECT group_concat(d.name)
										FROM	distribution_hours dh, days d
										WHERE dh.distribution_id = dis.id AND dh.day_id = d.id) Days
								FROM distributions dis WHERE id IN($ids) ");
*/
			$res = mysql_query("SELECT name as 'Agency Name',
									   street as 'Street Address',
									   city as City,
									   state as State,
									   zip as 'Zip Code',
									   contact as 'Agency Contact',
									   phone as Phone,
									   contact2 as 'Secondary Contact',
									   phone2 as 'Secondary Phone',
									   email as Email,
									   notes as Notes
								FROM distributions dis WHERE id IN($ids) ");
		break;
				
		case 6: // donation
			if (!$PRIV['exp_donor'])
					die(forbidden());
			$filename = "donors";
			$res = mysql_query("SELECT donation as Donation,
									   donor as Donor,
									   value as Value,
									   date as Date
								FROM donations WHERE id IN($ids) ");
		break;
		case 7: //volunteer with hours
			if (!$PRIV['exp_volunteer'])
				die(forbidden());
			$filename = "volunteers_hours";	
			
			$res = mysql_query("SELECT v.first_name as 'First Name',
									   v.middle_name as 'Middle Name',
									   v.last_name as 'Last Name',
									   v.email as Email,
									   v.phone as Phone,
									   v.street as Street, 
									   v.city as City,
									   v.state as State,
									   v.zip as Zip,
									   v.signed_up as 'Signed Up',
									   v.notes as Notes,
									   (v.surplus_hours +  IF(temp.hour is null,0,temp.hour)) as Hours
 							    FROM volunteers v LEFT JOIN (	SELECT v2.id AS id, SUM(ve.hour ) AS hour
																FROM volunteers v2, volunteer_events ve WHERE v2.id = ve.volunteer_id 
																GROUP BY v2.id
															) 	temp ON temp.id = v.id							
								WHERE v.id IN($ids);");
		break;
		case 8: // grower per event
			if (!$PRIV['exp_grower'])
				die(forbidden());
			$filename = "growers_per_event";
			$res = mysql_query("SELECT 	g.first_name AS First,
										g.middle_name AS Middle,
										g.last_name AS Last,
										g.phone AS Phone,
										g.email AS Email,
										g.preferred AS Preferred,
										g.street AS Street,
										g.city AS City,
										g.state AS state,
										g.zip AS Zip,
										g.tools AS Tools,
										s.name AS Source,
										g.notes AS Notes,
										IF(g.pending=1,'YES','NO') AS Pending,
										pt.name AS 'Property Type',
										pr.name AS 'Property Relationship',
										ev.date AS 'Event Date',
										ev.pounds AS 'Pounds'
								FROM	growers g	LEFT JOIN property_types pt ON g.property_type_id = pt.id
													LEFT JOIN property_relationships pr ON g.property_relationship_id = pr.id
													LEFT JOIN sources s ON g.source_id = s.id
													LEFT JOIN ( SELECT e.grower_id AS id, e.date AS date, SUM(h.pound) AS pounds
																FROM `harvests` h, `events` e
																WHERE e.id = h.event_id
																GROUP BY e.id) ev ON ev.id = g.id							
								WHERE	g.id IN($ids) ");										
		break;
		case 9: // grower per fruit
			if (!$PRIV['exp_grower'])
				die(forbidden());
			$filename = "growers_per_fruit";
			$res = mysql_query("SELECT 	g.first_name AS First,
										g.middle_name AS Middle,
										g.last_name AS Last,
										g.phone AS Phone,
										g.email AS Email,
										g.preferred AS Preferred,
										g.street AS Street,
										g.city AS City,
										g.state AS state,
										g.zip AS Zip,
										g.tools AS Tools,
										s.name AS Source,
										g.notes AS Notes,
										IF(g.pending=1,'YES','NO') AS Pending,
										pt.name AS 'Property Type',
										pr.name AS 'Property Relationship',
										tr.tree AS 'Tree Type',
										tr.pounds AS Pounds
								FROM	growers g	LEFT JOIN property_types pt ON g.property_type_id = pt.id
													LEFT JOIN property_relationships pr ON g.property_relationship_id = pr.id
													LEFT JOIN sources s ON g.source_id = s.id
													LEFT JOIN (	SELECT gt.grower_id AS id, gt.tree_type AS tree_type, tt.name AS tree, SUM(h1.pound) AS pounds
																FROM grower_trees gt, harvests h1, events e1, tree_types tt
																WHERE e1.id = h1.event_id AND gt.id = h1.tree_id AND tt.id=gt.tree_type
																GROUP BY gt.grower_id, gt.tree_type) tr ON tr.id = g.id									
								WHERE	g.id IN($ids)");										
		break;
		case 10: // tree by harvest months
			if (!$PRIV['exp_grower'])
				die(forbidden());
			$filename = "tree_by_months";
			$res = mysql_query("SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'JANUARY' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 1
								UNION								
									
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'FEBRUARY' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 2
								UNION								
										
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'MARCH' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 3
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'APRIL' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 4
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'MAY' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 5
								UNION
								
								SELECT		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'JUNE' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 6
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'JULY' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 7
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'AUGUST' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 8
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'SEPTEMBER' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 9
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'OCTOBER' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 10
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'NOVEMBER' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 11
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'DECEMBER' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt, month_harvests mh)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND mh.tree_id = gt.id AND mh.month_id = 12						
								UNION
								
								SELECT 		
											Concat(g.first_name,' ', g.last_name) AS Owner,
											gt.varietal AS Varietal, 
											tt.name AS 'Tree type',
											gt.number AS Number, 
											IF((gt.chemicaled=0),'No','Yes') AS 'Chemicals Used_id',
											th.name AS Height, 											
											(SELECT group_concat(m.name)
											FROM	month_harvests mh, months m
											WHERE mh.tree_id = gt.id AND mh.month_id = m.id) 'Harvest Months',										
											gt.lastdate AS 'Last harvested',
											'N/A' AS 'Harvest Month'
									FROM	(growers g, grower_trees gt)
												LEFT JOIN tree_types tt	ON gt.tree_type=tt.id 
												LEFT JOIN tree_heights th	ON gt.avgHeight_id = th.id 
									WHERE	g.id IN($ids) AND gt.grower_id = g.id AND NOT EXISTS (	SELECT mh.tree_id
																									FROM month_harvests mh
																									WHERE gt.id = mh.tree_id)
								");										
		break;
	}		
	
	header("Content-Disposition: attachment; filename=\"$filename($my_t[month]-$my_t[mday]-$my_t[year]).csv\"");
	
	// fetch a row and write the column names out to the file
	$row = mysql_fetch_assoc($res);
	$line = "";
	$comma = "";
	foreach($row as $name => $value) {
		$line .= $comma . '"' . str_replace('"', '""', $name) . '"';
		$comma = ",";
	}
	$line .= "\n";
//	fputs($fp, $line);
	echo ($line);

	// remove the result pointer back to the start
	mysql_data_seek($res, 0);

	// and loop through the actual data
	while($row = mysql_fetch_assoc($res)) {
	   
		$line = "";
		$comma = "";
		foreach($row as $value) {
			$line .= $comma . '"' . str_replace('"', '""', $value) . '"';
			$comma = ",";
		}
		$line .= "\n";
//		fputs($fp, $line);
		echo ($line);
	}

//	fclose($fp);	
	

?>