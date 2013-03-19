/*

INF 117 Start 


this method will be used when the button "add more guests" is clicked on. When that button
is clicked then the jquary will append more input tags the html form in the right containe
r. 
*/
var count = 0;
$(function(){
  $('p#add_field').click(function(){
    count += 1;
    $('#container').append(
        '<br /><br /><strong>First Name of Guest #' + count + '</strong><br />' 
        + '<input id="field_' + count + '"name="fields[]' + '" type="text" /><br />' 
        + '<br /><strong>Last Name of Guest #' + count + '</strong><br />' 
        + '<input id="field_' + count + '" name="fields[]' + '" type="text" /><br />' 
        + '<br /><strong>Cell Phone of Guest #' + count + '</strong><br />' 
        + '<input id="field_' + count + '" name="fields[]' + '" type="text" /><br />' 
		+ '<br /><strong>Email of Guest #' + count + '</strong><br />' 
        + '<input id="field_' + count + '" name="fields[]' + '" type="text" /><br />');
  });
});

/*
This method just shows the hidden element with the button is clicked. The button will be 
clicked from the rsvp form

$(document).ready(function() {
   $('#waiver_box').click(function(){
     $('.waiver').show();
   });
 });
 */
 
 $(document).ready(function() {
   $('#waiver_box').click(function(){
     $('.waiver').toggle('slow', function() {;
	 });
   });
 });

// INF 117 END