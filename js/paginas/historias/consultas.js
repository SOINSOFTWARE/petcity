$(function () {
    $('#nextdate').datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true
    });
});
$(document).ready(function () {
    $("#nextdate").keydown(function (e) {
        return false;
    });
});
function changeVisibility(input, displayVal) {
    input.css("display", displayVal);
}

function validate() {
    if (!validateGeneralData()) {
        return false;
    }
}
