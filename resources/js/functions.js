// Change format for Number input when the ".currency" class is present
$(document).ready(function () {
    $(".currency").change(function() {
        $(this).val(parseFloat($(this).val()).toFixed(2));
    });
});

function timeoutAlert()
{
    document.getElementById("alert").style.display = 'none'
}
setTimeout('timeoutAlert()', 1000);



function reloadPage() {
    location.reload();
}

