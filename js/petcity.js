$(function () {
    $('#tableData').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData1').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData2').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData3').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData4').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData5').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData6').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData7').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData8').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
$(function () {
    $('#tableData9').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
});
function validateIntegerInput(e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1
            || (e.keyCode === 65 && e.ctrlKey === true)
            || (e.keyCode === 67 && e.ctrlKey === true)
            || (e.keyCode === 88 && e.ctrlKey === true)
            || (e.keyCode >= 35 && e.keyCode <= 39)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57))
            && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}
function validateDecimalInput(e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1
            || (e.keyCode === 65 && e.ctrlKey === true)
            || (e.keyCode === 67 && e.ctrlKey === true)
            || (e.keyCode === 88 && e.ctrlKey === true)
            || (e.keyCode >= 35 && e.keyCode <= 39)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57))
            && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}
function addErrorCss(divFormGroup, divDialog) {
    divFormGroup.addClass("has-error");
    showRequiredDialog(divDialog);
}
function removeErrorCss(divFormGroup) {
    divFormGroup.removeClass("has-error");
}
function changeVisibility(divFormGroup, displayVal) {
    divFormGroup.css("display", displayVal);
}
function showRequiredDialog(divDialog) {
    divDialog.dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        resizable: false,
        buttons: [{
                text: "Volver",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    });
    divDialog.dialog("open");
}
function isEmptyNumberRequired(inputField) {
    return $.trim(inputField.val()) === '0' || $.trim(inputField.val()) === '';
}
function isEmptyStringRequired(inputField) {
    return $.trim(inputField.val()) === '';
}