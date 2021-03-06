var optionSelect = '<option value="" disabled="disabled" selected="selected"></option>';
function options(data) {
		var s = optionSelect; // first option is always select...
		for (var i=0; i<data.length; i++) {
			var o = data[i];
			s += '<option value="'+o.id+'">'+o.name+'</option>';
		}
		return s;
	}

function addTreeRow(tableID) {

	var table = document.getElementById(tableID);
	
	if(table.rows.length==0)
	{
	 var row = table.insertRow(0);
	 var cell1 = row.insertCell(0);
	 var label1 = document.createElement("label");
	 label1.style.width = "2em";
	 var txt1=document.createTextNode('');
	 label1.appendChild(txt1);
	 cell1.appendChild(label1);
	 
	 var cell2 = row.insertCell(1);
	 var label2 = document.createElement("label");
	 label2.style.width = "5em";
	 var txt2=document.createTextNode('Tree');
	 label2.style.fontWeight = 'bold';
	 label2.appendChild(txt2);
	 cell2.appendChild(label2);
	 
	 var cell3 = row.insertCell(2);
	 var label3 = document.createElement("label");
	 label3.style.width = "5em";
	 label3.style.fontWeight = 'bold';
	 var txt3=document.createTextNode('Number');
	 label3.appendChild(txt3);
	 cell3.appendChild(label3);
	 
	 var cell4 = row.insertCell(3);
	 var label4 = document.createElement("label");
	 label4.style.width = "5em";
	 label4.style.fontWeight = 'bold';
	 var txt4=document.createTextNode('lbs');
	 label4.appendChild(txt4);
	 cell4.appendChild(label4);
	}

	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);

	var cell1 = row.insertCell(0);
	var element1 = document.createElement("input");
	element1.type = "checkbox";
	cell1.appendChild(element1);

	var cell2 = row.insertCell(1);
	var element2 = document.createElement("select");
	element2.innerHTML = (options(treeNames));
	cell2.appendChild(element2);
	
	var cell3 = row.insertCell(2);
	var element3 = document.createElement("input");
	element3.type = "number";
	element3.style.width = "4em";
	cell3.appendChild(element3);
	
	var cell4 = row.insertCell(3);
	var element4 = document.createElement("input");
	element4.type = "number";
	element4.style.width = "4em";
	cell4.appendChild(element4);
	

}

function deleteTreeRow(tableID) {
	try {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;

	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			table.deleteRow(i);
			rowCount--;
			i--;
		}

	}
	}catch(e) {
		alert(e);
	}
}
		

function addVolunteerRow(tableID) {

	        var table = document.getElementById(tableID);					
			var rowCount = table.rows.length;

            var row = table.insertRow(rowCount);
			// New table
			var c = row.insertCell(0);
            var tbl = document.createElement("table");
			if (rowCount %2 ==0)
				tbl.style.backgroundColor = "#E3E4FA";
			else
				tbl.style.backgroundColor = "#C5C6DC";
				
            c.appendChild(tbl);
			
			 var row = tbl.insertRow(0);
			 var cell1 = row.insertCell(0);
			 var label1 = document.createElement("label");
			 label1.style.width = "2em";
			 var txt1=document.createTextNode('');
			 label1.appendChild(txt1);
			 cell1.appendChild(label1);
			 
			 var cell2 = row.insertCell(1);
			 var label2 = document.createElement("label");
			 label2.style.width = "5em";
			 var txt2=document.createTextNode('Volunteer '+(rowCount+1));
			 label2.style.fontWeight = 'bold';
			 label2.appendChild(txt2);
			 cell2.appendChild(label2);			 
			 
			 
			 var cell3 = row.insertCell(2);
			 var label3 = document.createElement("label");
			 label3.style.width = "5em";
			 label3.style.fontWeight = 'bold';
			 var txt3=document.createTextNode('Hours');
			 label3.appendChild(txt3);
			 cell3.appendChild(label3);
			 
			 var cell4 = row.insertCell(3);
			 var label4 = document.createElement("label");
			 label4.style.width = "5em";
			 label4.style.fontWeight = 'bold';
			 var txt4=document.createTextNode('Driver');
			 label4.appendChild(txt4);
			 cell4.appendChild(label4);
			 
			var row1 = tbl.insertRow(1);
		    var cell1 = row1.insertCell(0);
            var element1 = document.createElement("input");
            element1.type = "checkbox";
            cell1.appendChild(element1);
			
			element1.focus();
 
            var cell2 = row1.insertCell(1);
			var element2 = document.createElement("select");
			element2.innerHTML = (options(volunteerNames));
			cell2.appendChild(element2);
				
            var cell3 = row1.insertCell(2);
            var element3 = document.createElement("input");
            element3.type = "number";
			element3.style.width = "4em";
            cell3.appendChild(element3);
			
			var cell4 = row1.insertCell(3);
            var element4 = document.createElement("input");
            element4.type = "checkbox";
			element4.style.width = "4em";
            cell4.appendChild(element4);	

			var cell5 = row1.insertCell(4);
			var e5 = document.createElement("select");
			e5.innerHTML = (options(distributionNames));
			e5.style.visibility="hidden";
			cell5.appendChild(e5);	
					
			
			element4.checked = false;
			element4.onclick = function() { 
			  if (element4.checked)
			  {			  
			  			
				var row2 = tbl.insertRow(2);
				var cell5 = row2.insertCell(0);
				var element5 = document.createElement("input");
				element5.type = "checkbox";
				cell5.appendChild(element5);
				element5.style.visibility="hidden";
				  
				var cell6 = row2.insertCell(1);
				var label1 = document.createElement("label");
				label1.style.width = "5em";
				label1.style.color = 'black';
				label1.style.font='Arial';
				var txt1=document.createTextNode('Tree Types');
				label1.appendChild(txt1);
				cell6.appendChild(label1);
				
				var cell7 = row2.insertCell(2);
				var buttonnode= document.createElement('input');
				buttonnode.setAttribute('type','button');
				buttonnode.setAttribute('name','button'+1);
				buttonnode.setAttribute('value','+');
				buttonnode.onclick = function()
									{
										var rowCount = tbl.rows.length;
										var r = tbl.insertRow(rowCount);
										
										var c1 = r.insertCell(0);									
										var e1 = document.createElement("input");
										e1.type = "checkbox";
										c1.appendChild(e1);
										e1.focus();
										
										var c2 = r.insertCell(1);
										var e2 = document.createElement("select");
										e2.innerHTML = (options(treeNames));
										c2.appendChild(e2);
										
										var c3 = r.insertCell(2);
										var e3 = document.createElement("input");
										e3.type = "number";
										e3.style.width = "4em";
										e3.placeholder = "lbs";
										c3.appendChild(e3);
										
										var c4 = r.insertCell(3);									
										var e4 = document.createElement("label");
										var txt=document.createTextNode('sent to');
										e4.style.textAlign="center";										e4.appendChild(txt);		
										c4.appendChild(e4);
																				
										var c5 = r.insertCell(4);
										var e5 = document.createElement("select");										e5.innerHTML = (options(distributionNames));
										c5.appendChild(e5);
									};
				cell7.appendChild(buttonnode);				
				buttonnode.click();
				
				var cell8 = row2.insertCell(3);
				var buttonnode2= document.createElement('input');
				buttonnode2.setAttribute('type','button');
				buttonnode2.setAttribute('name','button'+2);
				buttonnode2.setAttribute('value','-');
				buttonnode2.onclick = function()
										{
											var rowCount = tbl.rows.length;
											for(var i=3; i<rowCount; i++) {
												var row = tbl.rows[i];
												var chkbox = row.cells[0].childNodes[0];
												if(null != chkbox && true == chkbox.checked) {
													tbl.deleteRow(i);
													rowCount--;
													i--;
												}
											}
											var rowCount = tbl.rows.length;
											if (rowCount == 3)											
											  element4.click();											
										
										};
				cell8.appendChild(buttonnode2);
			  }
			  else
			  {
			    var rowCount = tbl.rows.length;
				for(var i=2; i<rowCount; i++) {
					var row = tbl.rows[i];
					var chkbox = row.cells[0].childNodes[0];
					chkbox.checked = true;
				}
				deleteTreeTypeRow(tbl);
			  }				/* var ro = tbl.insertRow(rowCount);				var bo = ro.insertCell(0);				var buttonnode5 = document.createElement('input');				buttonnode5.setAttribute('type','button');				buttonnode5.setAttribute('name','Add Distribution');				buttonnode5.setAttribute('value','Add New Distribution Center');				bo.appendChild(buttonnode5);				buttonnode5.onclick = function addNewDistributionCenter(){					switchNClearForm('distribution');					$('#edit-dialog').dialog("option", "buttons", [addDistributionButton, cancelButton]);					$('#edit-dialog').dialog({ title: 'Add New Distribution Type' });					$('#edit-dialog').dialog('open') // show dialog				}	*/			}; 
        }				/* var addDistributionButton = {			text: 'Add Distribution Center',			click: function() {				var para = $('#distribution').serialize();				$.ajax({												'type': 'GET',					'url': 'ajax.php?cmd=add_distribution&'+para,					'success': function (data) {						if (!validResponse(data))							return false;						setInfo('Information Added');						$('#edit-dialog').dialog('close');						reloadTable("get_distribs");												// Reload drop down menus in forms so that added entities are viewable						event_id = 0;							grower_id = 0;							captain_id = 0;							$('#event-id').text('');						$('#event4').val('');											$('#event5').val('');											$('#event6').val('');											loadAllEventForm(0,0,0);							//Provide confirmation that information was added						setInfo('Information Added');						loadDistributionName();						$('#edit-dialog').dialog('close');						// Reset table to events						reloadTable("get_distribs");						//Switch back to event form						switchNClearForm('event');						$('#edit-dialog').dialog('open');						// Reset appropriate add button						$('#edit-dialog').dialog("option", "buttons", [addButton, cancelButton]);						//loadDistributionName();										},				'error': ajaxError			});		} 	} */	
        function deleteVolunteerRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var r = table.rows[i];
				var tbl = r.cells[0].childNodes[0];
                var chkbox = tbl.rows[1].cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }	
 
            }
			
			var rowCount = table.rows.length;
            for(var i=0; i<rowCount; i++) 
			{
				var r = table.rows[i];
				var tbl = r.cells[0].childNodes[0];
				var label = tbl.rows[0].cells[1].childNodes[0];
				label.innerHTML = "Volunteer "+(i+1);				
				if (i %2 ==0)
					tbl.style.backgroundColor = "#E3E4FA";
				else
					tbl.style.backgroundColor = "#C5C6DC";
					
			}
            }catch(e) {
                alert(e);
            }
        }
		
		function deleteTreeTypeRow(table) {
            try {
            var rowCount = table.rows.length;
			for(var i=2; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
            }
            }catch(e) {
                alert(e);
            }
        }
function loadGrowerDropList(grower_id){
	$('#tree-grower').empty();		
		$.ajax( {
						'dataType': 'json', 
						'type': 'GET', 
						'url': 'ajax.php?cmd=get_grower_name', 
						'success': function (data) {							
							var str = '<select id="tree3" name="grower_id">';
							str += '<option value=0 selected="selected">Select a grower...</option>';
							if( data.datatable != null) 							
								for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )
								{
									str += '<option value="'+data.datatable.aaData[i][0]+'">'+data.datatable.aaData[i][1]+'</option>';
								}
								str += '</select>';	
								$('#tree-grower').append(str);
								$('#tree3').val(grower_id).attr('selected',true);
						},
						'error': function (e) {
							alert('Ajax Error!\n' + e.responseText);
						}
					});
}function loadTreeTypes(tree_type_id){	$('#treee').empty();				$.ajax( {						'dataType': 'json', 						'type': 'GET', 						'url': 'ajax.php?cmd=get_tree_type', 						'success': function (data) {														var str = '<select id="tree4" name="tree_type_id">';							if( data.datatable != null) 															for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )								{									str += '<option value="'+data.datatable.aaData[i][0]+'">'+data.datatable.aaData[i][1]+'</option>';								}								str += '</select>';									$('#treee').append(str);								$('#tree4').val(tree_type_id).attr('selected',true);						},						'error': function (e) {							alert('Ajax Error!\n' + e.responseText);						}					});}
function loadGrowerToForm(grower_id)
	{
		$('#event-grower').empty();
		growerPhone.length = 0;
		growerAddress.length = 0;
		growerCity.length = 0;
		$.ajax( {
						'dataType': 'json', 
						'type': 'GET', 
						'url': 'ajax.php?cmd=get_grower_name', 
						'success': function (data) {	
							console.log(data);
							var str = '<select id="event-grower-name" name="event-grower-name">';
							str += '<option value=0 selected="selected">Select a grower...</option>';
							if( data.datatable != null) 	
							{
								for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )
								{
									var temp;
									growerPhone.push(temp);
									growerAddress.push(temp);
									growerCity.push(temp);
								}
								for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )
								{
									str += '<option value="'+data.datatable.aaData[i][0]+'">'+data.datatable.aaData[i][1]+'</option>';
									growerPhone[data.datatable.aaData[i][0] -1] = data.datatable.aaData[i][2];
									growerAddress[data.datatable.aaData[i][0] -1] = data.datatable.aaData[i][3];
									growerCity[data.datatable.aaData[i][0] -1] = data.datatable.aaData[i][4];
								}
								str += '</select>';	
								$('#event-grower').append(str);
								// get grower
								$('#event-grower-name').val(grower_id).attr('selected',true);
								$('#event7').val(growerCity[(grower_id)-1]);
								$('#event8').val(growerPhone[(grower_id)-1]);
								$('#event9').val(growerAddress[(grower_id)-1]);
							}
						},
						'error': function (e) {
							alert('Ajax Error!\n' + e.responseText);
						}
					});
	}
	
	function loadVolunteerToForm(formName, captain_id)
	{
		formName.empty();
		$.ajax( {
						'dataType': 'json', 
						'type': 'GET', 
						'url': 'ajax.php?cmd=get_volunteer_name', 
						'success': function (data) {
							var str = '<select id="event-captain-name" name="event-captain-name">';							
							str += '<option value=0 selected="selected">Select a Captain...</option>';							
							if( data.datatable != null) 							
								for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )								
									str += '<option value="'+data.datatable.aaData[i][0]+'">'+data.datatable.aaData[i][1]+'</option>';
								
								str += '</select>';		

								formName.append(str);
								getCaptain(captain_id);
						},
						'error': function (e) {
							alert('Ajax Error!\n' + e.responseText);
						}
					});	
	}
	
	function getCaptain(captain_id)
	{	
	  $('#event-captain-name').val(captain_id).attr('selected',true);	
	}
	
	function deleteAllTreeRows()
	{
		var table = document.getElementById("eventTree");
		var rowCount = table.rows.length;	
 		for(var i=0; i<rowCount; i++) 
		{
            table.deleteRow(i);
			rowCount--;
			i--;
		}
		loadTreeType = 0;
	}
	
	function deleteAllVolunteerRows()
	{		
		var table = document.getElementById("eventVolunteer");		
        var rowCount = table.rows.length;
		
		for(var i=0; i<rowCount; i++) {
			var r = table.rows[i];
			var tbl = r.cells[0].childNodes[0];
			var chkbox = tbl.rows[1].cells[0].childNodes[0];
			chkbox.click();
			if(null != chkbox && true == chkbox.checked) {
				table.deleteRow(i);
				rowCount--;
				i--;
			}	
		}
		loadVolunteer = 0;		
	}
				
	function loadTree(id, event_id)
	{
		$.ajax({
							'dataType': 'json', 
							'type': 'GET', 
							'url': 'ajax.php?cmd=get_tree_name&grower_id='+ id, 
							'success': function (data) {
								var str = '<select id="event-grower-name" name="event-grower-name">';
								if( data.datatable != null) 	
								{								
									for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )
									{
										var v = {
											"id": data.datatable.aaData[i][0],
											"name": data.datatable.aaData[i][1]
										};
										treeNames.push(v);								
									}
									getTreeType(id,event_id);
								}										
							},
							'error': function (e) {
								alert('Ajax Error!\n' + e.responseText);
							}
						});
		//console.log(treeNames);
	}
	
	function getTreeType(grower_id, event_id){		
		$.ajax({
						'dataType': 'json', 
						'type': 'GET', 
						'url': 'ajax.php?cmd=get_event_tree&id='+grower_id+'&event_id='+event_id, 
						'success': function (data) {
							var table = document.getElementById("eventTree");
							if( data.datatable != null) 							
								for (var i=0, len = data.datatable.aaData.length; i< len; ++i )
									{
										addTreeRow('eventTree');
										table.rows[i+1].cells[1].childNodes[0].value = data.datatable.aaData[i][0];
										table.rows[i+1].cells[2].childNodes[0].value = data.datatable.aaData[i][1];	
										table.rows[i+1].cells[3].childNodes[0].value = data.datatable.aaData[i][2];										
									}
						},
						'error': function (e) {
							alert('Ajax Error!\n' + e.responseText);
						}
				});	
	}
	
	function loadVolunteerName(event_id){
		$.ajax( {
				'dataType': 'json', 
				'type': 'GET', 
				'url': 'ajax.php?cmd=get_volunteer_name', 
				'success': function (data) {
					//var str = '<select id="event-volunteer-name" name="event-volunteer-name">';
					if( data.datatable != null) 	
					{								
						for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )
						{
							var v = {
								"id": data.datatable.aaData[i][0],
								"name": data.datatable.aaData[i][1]
							};
							volunteerNames.push(v);								
						}
					
						getEventVolunteer(event_id);
					}
							
				},
				'error': function (e) {
					alert('Ajax Error!\n' + e.responseText);
				}
			});
	}
	
	function getEventVolunteer(event_id){
		$.ajax( {
						'dataType': 'json', 
						'type': 'GET', 
						'url': 'ajax.php?cmd=get_event_volunteer_name&event_id='+event_id, 
						'success': function (data) {
							var tbl = document.getElementById("eventVolunteer");
							
							if( data.datatable != null) 							
								for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )
									{
										addVolunteerRow('eventVolunteer');										
										var r = tbl.rows[i];
										var table = r.cells[0].childNodes[0];										
										table.rows[1].cells[1].childNodes[0].value = data.datatable.aaData[i][0];	
										table.rows[1].cells[2].childNodes[0].value = data.datatable.aaData[i][3];	
										if (data.datatable.aaData[i][2] == 1)
										{											
											table.rows[1].cells[3].childNodes[0].click();											
										    getDriverData(data.datatable.aaData[i][0], table, event_id);										
										}
									}
						},
						'error': function (e) {
							alert('Ajax Error!\n' + e.responseText);
						}
					});	
	}
	
	function getDriverData(volunteer_id, tbl, event_id){
		$.ajax( {
						'dataType': 'json', 
						'type': 'GET', 
						'url': 'ajax.php?cmd=get_driver&id='+volunteer_id+'&event_id='+event_id, 
						'success': function (data) {							
							
							if( data.datatable != null) 	
							{							
								for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )
									{											
										var r = tbl.insertRow(i+3);
										
										var c1 = r.insertCell(0);									
										var e1 = document.createElement("input");
										e1.type = "checkbox";
										c1.appendChild(e1);
										e1.focus();
										
										var c2 = r.insertCell(1);
										var e2 = document.createElement("select");
										e2.innerHTML = (options(treeNames));
										c2.appendChild(e2);
										
										var c3 = r.insertCell(2);
										var e3 = document.createElement("input");
										e3.type = "text";
										e3.style.width = "4em";
										e3.placeholder = "lbs";
										c3.appendChild(e3);
										
										var c4 = r.insertCell(3);									
										var e4 = document.createElement("label");
										var txt=document.createTextNode('sent to');
										e4.style.textAlign="center";
										e4.appendChild(txt);		
										c4.appendChild(e4);
										
										var c5 = r.insertCell(4);
										var e5 = document.createElement("select");
										e5.innerHTML = (options(distributionNames));
										c5.appendChild(e5);		
										
										tbl.rows[i+3].cells[1].childNodes[0].value = data.datatable.aaData[i][1];
										tbl.rows[i+3].cells[2].childNodes[0].value = data.datatable.aaData[i][4];
										tbl.rows[i+3].cells[4].childNodes[0].value = data.datatable.aaData[i][3];
									}
								var r = tbl.rows.length;
								tbl.deleteRow(r-1);
							}
						},
						'error': function (e) {
							alert('Ajax Error!\n' + e.responseText);
						}
					});
	}
	
	function loadDistributionName(){
		$.ajax( {
				'dataType': 'json', 
				'type': 'GET', 
				'url': 'ajax.php?cmd=get_distribution_name', 
				'success': function (data) {
					var str = '<select id="event-distribution-name" name="event-distribution-name">';
					if( data.datatable != null) 	
					{								
						for ( var i=0, len = data.datatable.aaData.length; i< len; ++i )
						{
							var v = {
								"id": data.datatable.aaData[i][0],
								"name": data.datatable.aaData[i][1]
							};
							distributionNames.push(v);								
						}
					
						//getEventVolunteer(event_id);
					}
							
				},
				'error': function (e) {
					alert('Ajax Error!\n' + e.responseText);
				}
			});
	}
	
	function updateEvent(){
		var event_id =  row[1];				
		var event_date =  $('#event4').val();		
		var event_time =  $('#event5').val();
		var event_notes =  $('#event6').val();
		var grower_id =  $('#event-grower option:selected').val();
		var captain_id = $('#event-captain option:selected').val();
		var tree_type = [];
		var volunteers = [];
		
		var table = document.getElementById("eventTree");
		var rowCount = table.rows.length;
		for(var i=1; i<rowCount; i++)
			if (table.rows[i].cells[1].childNodes[0].value !="") 
			{
				var data = {
							"tree_id": table.rows[i].cells[1].childNodes[0].value,
							"number": table.rows[i].cells[2].childNodes[0].value,
							"pound": table.rows[i].cells[3].childNodes[0].value
							};
				
				tree_type.push(data); 
			}
		
		var table = document.getElementById("eventVolunteer");
		var rowCount = table.rows.length;
		for(var i=0; i<rowCount; i++) 
			{
				var r = table.rows[i];
				var tbl = r.cells[0].childNodes[0];
                var drv = tbl.rows[1].cells[3].childNodes[0].checked;
				if (tbl.rows[1].cells[1].childNodes[0].value !="") 
				if (drv == true) 
				{
					var distributedTree = [];
					for(var j=3; j< tbl.rows.length; j++)
					{
						var data = {					
									"tree_id": tbl.rows[j].cells[1].childNodes[0].value,
									"pound": tbl.rows[j].cells[2].childNodes[0].value,
									"distribution_id": tbl.rows[j].cells[4].childNodes[0].value
									};
						
						distributedTree.push(data); 
					}
					var data = {
									"volunteer_id": tbl.rows[1].cells[1].childNodes[0].value,
									"hour": tbl.rows[1].cells[2].childNodes[0].value,
									"driver": tbl.rows[1].cells[3].childNodes[0].checked,
									"distributedTree": distributedTree,									
								};
						
						volunteers.push(data); 
				}
				else // driver not checked
					{
						var data = {
									"volunteer_id": tbl.rows[1].cells[1].childNodes[0].value,
									"hour": tbl.rows[1].cells[2].childNodes[0].value,
									"driver": tbl.rows[1].cells[3].childNodes[0].checked,									
									};
						
						volunteers.push(data); 
					
					}
			}			
		
		
		var data = {
					event_id: event_id,					
					event_date: event_date,
					event_time: event_time,
					event_notes: event_notes,					
					grower_id : grower_id,
					captain_id : captain_id,
					treeType : tree_type,
					volunteers : volunteers
					};
					
		$.ajax( {
						type: 'post', 
						url: 'ajax.php?cmd=update_event', 
						data: data,
						'success': function (data) {
							setInfo('Information Updated');
							$('#edit-dialog').dialog('close');
						},
						'error': function (e) {
							alert('Ajax Error!\n' + e.responseText);
						}
					});	
		
	}
	
	function createNewEvent(){			
		var event_date =  $('#event4').val();
		var event_time =  $('#event5').val();
		var event_notes =  $('#event6').val();
		var grower_id =  $('#event-grower option:selected').val();
		var captain_id = $('#event-captain option:selected').val();
		var tree_type = [];
		var volunteers = [];
		
		var table = document.getElementById("eventTree");
		var rowCount = table.rows.length;
		for(var i=1; i<rowCount; i++)
			if(table.rows[i].cells[1].childNodes[0].value !="") 
			{
				var data = {
							"tree_id": table.rows[i].cells[1].childNodes[0].value,
							"number": table.rows[i].cells[2].childNodes[0].value,
							"pound": table.rows[i].cells[3].childNodes[0].value
							};
				
				tree_type.push(data); 
			}
		
		var table = document.getElementById("eventVolunteer");
		var rowCount = table.rows.length;
		for(var i=0; i<rowCount; i++) 
			{
				var r = table.rows[i];
				var tbl = r.cells[0].childNodes[0];
                var drv = tbl.rows[1].cells[3].childNodes[0].checked;
				if((tbl.rows[1].cells[1].childNodes[0].value !="") && (drv == true) )
				{
					var distributedTree = [];
					for(var j=3; j< tbl.rows.length; j++)
					{
						var data = {					
									"tree_id": tbl.rows[j].cells[1].childNodes[0].value,
									"pound": tbl.rows[j].cells[2].childNodes[0].value,
									"distribution_id": tbl.rows[j].cells[4].childNodes[0].value
									};
						
						distributedTree.push(data); 
					}
					var data = {
									"volunteer_id": tbl.rows[1].cells[1].childNodes[0].value,
									"hour": tbl.rows[1].cells[2].childNodes[0].value,
									"driver": tbl.rows[1].cells[3].childNodes[0].checked,
									"distributedTree": distributedTree,									
								};
						
						volunteers.push(data); 
				}
				else // driver not checked
					{
						var data = {
									"volunteer_id": tbl.rows[1].cells[1].childNodes[0].value,
									"hour": tbl.rows[1].cells[2].childNodes[0].value,
									"driver": tbl.rows[1].cells[3].childNodes[0].checked,									
									};
						
						volunteers.push(data); 
					
					}
			}			
		
		
		
		var data = {
					event_id: event_id,					
					event_date: event_date,
					event_time: event_time,
					event_notes: event_notes,					
					grower_id : grower_id,
					captain_id : captain_id,
					treeType : tree_type,
					volunteers : volunteers
					};
		$.ajax( {
						type: 'post', 
						url: 'ajax.php?cmd=create_event', 
						data: data,
						'success': function (data) {
							setInfo('Information Updated');
							$('#edit-dialog').dialog('close');
						},
						'error': function (e) {
							alert('Ajax Error!\n' + e.responseText);
						}
					});	
	
	}
	
	function checkEventForm(){	
	
		if( $("#event-grower-name option:selected").text() == "Select a grower...")
		{
			alert("Please select a grower!");
			return -1;
		}		
		if( $("#event-captain-name option:selected").text() == "Select a Captain...")
		{
			alert("Please select a captain!");
			return -1;
		}
		
		if ($('#event4').val() =="")
		{
			alert("Date can't be empty!");
			return -1;
		}
		
		var table = document.getElementById("eventTree");
		var rowCount = table.rows.length;
		var set = {};
		for(var i=1; i<rowCount; i++)
			if(table.rows[i].cells[1].childNodes[0].value !="")
			{
				if (table.rows[i].cells[1].childNodes[0].value in set)
				{
					alert("Tree Type are duplicated!");
					return -1;
				}
				else   
					set[""+table.rows[i].cells[1].childNodes[0].value] = true;
			}
		for(var i=1; i<rowCount; i++)
		{
			if(table.rows[i].cells[1].childNodes[0].value =="")
			{
				alert("Tree Type can't be empty!");
				return -1;
			}			
			
			if ( (table.rows[i].cells[2].childNodes[0].value !="") && (isNaN(parseFloat(table.rows[i].cells[2].childNodes[0].value))) )
			{
				alert("Number of Tree must be a number!");
				return -1;
			}
			
			if ( (table.rows[i].cells[2].childNodes[0].value !="") && (parseFloat(table.rows[i].cells[2].childNodes[0].value) < 0) )
			{
				alert("Number of Tree must be greater than zero!");
				return -1;
			}
			if ( (table.rows[i].cells[3].childNodes[0].value !="") && (isNaN(parseFloat(table.rows[i].cells[2].childNodes[0].value))) )
			{
				alert("Tree Pound  must be a number!");
				return -1;
			}
			
			if ( (table.rows[i].cells[3].childNodes[0].value !="") && (parseFloat(table.rows[i].cells[2].childNodes[0].value) < 0) )
			{
				alert("Tree Pound must be greater than zero!");
				return -1;
			}
			
			
		}
								
		
		var tbl = document.getElementById("eventVolunteer");
		var rowCount = tbl.rows.length;
		var set = {};
		for(var i=0; i<rowCount; i++) 
		{
			var r = tbl.rows[i];
			var table = r.cells[0].childNodes[0];
			if((table.rows[1].cells[1].childNodes[0].value !=""))
			if (table.rows[1].cells[1].childNodes[0].value in set)
				{
					alert("Volunteers are duplicated!");
					return -1;
				}
				else   
					set[""+table.rows[1].cells[1].childNodes[0].value] = true;
		}	
		
		
		
		for(var i=0; i<rowCount; i++) 
		{
			var r = tbl.rows[i];
			var table = r.cells[0].childNodes[0];
			if((table.rows[1].cells[1].childNodes[0].value ==""))
			{
				alert("Volunteer Name can't be empty!");
				return -1;
			}
						
			
			if ((table.rows[1].cells[2].childNodes[0].value !="") &&  (isNaN(parseFloat(table.rows[1].cells[2].childNodes[0].value))))
			{
				alert("Hours must be a number!");
				return -1;
			}
			
			if ((table.rows[1].cells[2].childNodes[0].value !="") &&  (parseFloat(table.rows[1].cells[2].childNodes[0].value) < 0))
			{
				alert("Hours must be greater than zero!");
				return -1;
			}	
			
			var set = {};
			for(var k=3; k<table.rows.length; k++)
				if(table.rows[k].cells[1].childNodes[0].value!="")				//INF 117 Start				// Commented out user-created constraint to allow drivers to send shipments of the same type of fruit to multiple locations.
				{
					/* if (table.rows[k].cells[1].childNodes[0].value in set)
					{
						alert("Volunteer "+(i+1)+" has duplicated Tree Type!");
						return -1;
					}
					else   */				//INF 117 End
						set[""+table.rows[k].cells[1].childNodes[0].value] = true;
				}
			if (table.rows[1].cells[3].childNodes[0].checked) 
			{
				var r = table.rows.length;						
				for(var j=3; j<r; j++) 
				{
					if(table.rows[j].cells[1].childNodes[0].value =="")
					{
						alert("Volunteer "+(i+1)+" - Tree Type can't be empty!");
						return -1;
					}	
					
					if(table.rows[j].cells[4].childNodes[0].value =="")
					{
						alert("Distribution Site can't be empty!");
						return -1;
					}	
					
					
				}
			}
		}
			
		return 0;
	}
	
	function loadAllEventForm(event_id, grower_id, captain_id)
	{		
		deleteAllTreeRows();
		treeNames.length = 0;
		deleteAllVolunteerRows();
		volunteerNames.length = 0;		
		loadDistribution = 0;
		switchForm('event');		
		$('#event4').not('.hasDatePicker').datepicker({dateFormat: 'yy-mm-dd'});				
		$('#event5').timepicker({ampm: true});		
						
		if (loadDistribution == 0)
		{
			distributionNames.length = 0;
			loadDistributionName();
			loadDistribution++;
		}
			
		
		loadGrowerToForm(grower_id);
		
		loadVolunteerToForm($('#event-captain'), captain_id);
		
				
		if (loadTreeType ==0)
		{
			loadTree(grower_id,event_id);
			loadTreeType++;
		}
		else
			getTreeType(grower_id, event_id);
		
		if (loadVolunteer == 0)
		{
			volunteerNames.length = 0;
			loadVolunteerName(event_id);
			loadVolunteer++;
		}
		else
			getEventVolunteer(event_id);
		
					
		
	}

// This  is for distribution form

function pad2(n) {
	n += ''; //cast to str
	while (n.length < 2)
		n = '0' + n;
	return n;
}function totalDialog() {						$("#totals").dialog({title: "Choose Date Range", buttons: {OK: chooseOption}, autoOpen: false, modal: true, draggable: false});		$("#totals").dialog("open");		$("#beginDate").datepicker({dateFormat: 'yy-mm-dd'});		$("#endDate").datepicker({dateFormat: 'yy-mm-dd'});		function chooseOption() {			$("#totals").dialog("close");			//var selectedOption=$("#diagDropdown option:selected").val().toLowerCase();			$beginDate = 	$('#beginDate').val();			$endDate = 		$('#endDate').val();			reloadTable("get_totals&beginDate=" + $beginDate + "&endDate=" + $endDate);		}	}
	
function initHours() {	
	var t = [];
	for (var i=0;i<24; ++i) {
		var n = pad2(i);
		t.push({
			"id": n,
			"name": n
		});
	}

	var hString=options(t);
	for (var i=24;i< 60; ++i) {
		t.push({
			"id": i,
			"name": i
		});
	}

	var mString=options(t);

	for (var i = 1; i<8; i++) {
		var selectTab = document.getElementById('distributionHour'+i+'-OpenHour');
		selectTab.innerHTML = (hString);
		selectTab = document.getElementById('distributionHour'+i+'-CloseHour');
		selectTab.innerHTML = (hString);
		selectTab = document.getElementById('distributionHour'+i+'-OpenMin');
		selectTab.innerHTML = (mString);
		selectTab = document.getElementById('distributionHour'+i+'-CloseMin');
		selectTab.innerHTML = (mString);
	}
}

	
 
