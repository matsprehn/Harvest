$('input').blur(function() {
    if ($('#fname').attr('value') == $('#lname').attr('value')) {
    alert('Same Value'); return false;
    } else { return true; }
});