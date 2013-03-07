var count = 0;
$(function(){
  $('p#add_field').click(function(){
    count += 1;
    $('#container').append(
        '<br /><strong>First Name of Guest #' + count + '</strong><br />' 
        + '<input id="field_' + count + '" firstname="fields[]' + '" type="text" /><br />' 
        + '<br /><strong>Last Name of Guest #' + count + '</strong><br />' 
        + '<input id="field_' + count + '" lastname="fields[]' + '" type="text" /><br />' 
        + '<br /><strong>Email of Guest #' + count + '</strong><br />' 
        + '<input id="field_' + count + '" email="fields[]' + '" type="text" /><br />' );
  
  });
});


$(document).ready(function() {
   $('#waiver_box').click(function(){
     $('.waiver').show();
   });
 });


