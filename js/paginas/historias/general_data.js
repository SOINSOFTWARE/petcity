$(function () {
    $('#generaldatadate').datepicker({
        dateFormat: 'dd/mm/yy',
        autoclose: true
    });
});
$(document).ready(function () {
    $("#generaldatadate").keydown(function (e) {
        return false;
    });
});
$(document).ready(function () {
    $("#weight").keydown(function (e) {
        validateDecimalInput(e);
    });
});
$(document).ready(function () {
    $("#heartrate").keydown(function (e) {
        validateIntegerInput(e);
    });
});
$(document).ready(function () {
    $("#breathingfrequency").keydown(function (e) {
        validateIntegerInput(e);
    });
});
$(document).ready(function () {
    $("#temperature").keydown(function (e) {
        validateDecimalInput(e);
    });
});
$(document).ready(function () {
    $("#trc").keydown(function (e) {
        validateIntegerInput(e);
    });
});
$(document).ready(function () {
    $("#dh").keydown(function (e) {
        validateIntegerInput(e);
    });
});
$(document).ready(function () {
    $("#formulanumber").keydown(function (e) {
        validateIntegerInput(e);
    });
});
function validateGeneralData() {
    if (isEmptyStringRequired($('#generaldatadate'))) {
        addErrorCss($("#divgeneraldatadate"), $("#date-dialog"));
        return false;
    } else {
        removeErrorCss($("#divgeneraldatadate"));
    }
    if (isEmptyNumberRequired($('#weight'))) {
        addErrorCss($("#divweight"), $("#weight-dialog"));
        return false;
    } else {
        removeErrorCss($("#divweight"));
    }
    if (isEmptyNumberRequired($('#heartrate'))) {
        addErrorCss($("#divheartrate"), $("#heartrate-dialog"));
        return false;
    } else {
        removeErrorCss($("#divheartrate"));
    }
    if (isEmptyNumberRequired($('#breathingfrequency'))) {
        addErrorCss($("#divbreathingfrequency"), $("#breathingfrequency-dialog"));
        return false;
    } else {
        removeErrorCss($("#divbreathingfrequency"));
    }
    if (isEmptyNumberRequired($('#temperature'))) {
        addErrorCss($("#divtemperature"), $("#temperature-dialog"));
        return false;
    } else {
        removeErrorCss($("#divtemperature"));
    }
    return true;
}