$('#vaccineapplication').on("ifChecked", function (event) {
    changeVisibility($('#divappliednumber'), "block");
    changeVaccineVisibility("block", "none", "none", "none", "none");
});
$("#vaccineapplication").on("ifUnchecked", function (event) {
    changeVisibility($('#divappliednumber'), "none");
    changeVaccineVisibility("none", "none", "none", "none", "none");
    $('#appliednumberselector').val('1');
    resetVaccineDataInputs();
});
$('#appliednumberselector').change(function () {
    if ($('#appliednumberselector').val() === '1') {
        changeVaccineVisibility("block", "none", "none", "none", "none");
    } else if ($('#appliednumberselector').val() === '2') {
        changeVaccineVisibility("block", "block", "none", "none", "none");
    } else if ($('#appliednumberselector').val() === '3') {
        changeVaccineVisibility("block", "block", "block", "none", "none");
    } else if ($('#appliednumberselector').val() === '4') {
        changeVaccineVisibility("block", "block", "block", "block", "none");
    } else if ($('#appliednumberselector').val() === '5') {
        changeVaccineVisibility("block", "block", "block", "block", "block");
    }
});
function changeVaccineVisibility(cssTag1, cssTag2, cssTag3, cssTag4, cssTag5) {
    changeVisibility($('#divvaccinedata1'), cssTag1);
    changeVisibility($('#divvaccinedata2'), cssTag2);
    changeVisibility($('#divvaccinedata3'), cssTag3);
    changeVisibility($('#divvaccinedata4'), cssTag4);
    changeVisibility($('#divvaccinedata5'), cssTag5);
}
function resetVaccineDataInputs() {
    $('#vaccineselector1').val('0');
    $('#batch1').val('');
    $('#expiration1').val('');
    $('#vaccineselector2').val('0');
    $('#batch2').val('');
    $('#expiration2').val('');
    $('#vaccineselector3').val('0');
    $('#batch3').val('');
    $('#expiration3').val('');
    $('#vaccineselector4').val('0');
    $('#batch4').val('');
    $('#expiration4').val('');
    $('#vaccineselector5').val('0');
    $('#batch5').val('');
    $('#expiration5').val('');
}
function validate() {
    if (!validateGeneralData()) {
        return false;
    }
    if ($('#vaccineapplication').is(":checked")) {
        if (isEmptyNumberRequired($('#vaccineselector'))) {
            addErrorCss($("#divvaccine"), $("#vaccine-dialog"));
            return false;
        } else {
            removeErrorCss($("#divvaccine"));
        }
        if (isEmptyStringRequired($('#batch'))) {
            addErrorCss($("#divbatch"), $("#batch-dialog"));
            return false;
        } else {
            removeErrorCss($("#divbatch"));
        }
        if (isEmptyStringRequired($('#expiration'))) {
            addErrorCss($("#divexpiration"), $("#expiration-dialog"));
            return false;
        } else {
            removeErrorCss($("#divexpiration"));
        }
    }
}
