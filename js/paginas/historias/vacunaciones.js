$('#vaccineapplication').on("ifChecked", function (event) {
    changeVisibility();
});
$("#vaccineapplication").on("ifUnchecked", function (event) {
    changeVisibility($('#divappliednumber'), "none");
    changeVisibility($('#divvaccinedata1'), "none");
    changeVisibility($('#divvaccinedata2'), "none");
    $('#appliednumberselector').val('1');
    $('#vaccineselector1').val('0');
    $('#batch1').val('');
    $('#expiration1').val('');
    $('#vaccineselector2').val('0');
    $('#batch2').val('');
    $('#expiration2').val('');
});
$('#appliednumberselector').change(function() {
    $('#appliednumberselector').val('1')
});
function changeVisibility() {
    changeVisibility($('#divappliednumber'), "block");
    changeVisibility($('#divvaccinedata1'), "block");
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
