$('#vaccineapplication').on("ifChecked", function (event) {
    changeVisibility($('#divappliednumberrow'), "block");
    changeVaccineVisibility("block", "none", "none");
});
$("#vaccineapplication").on("ifUnchecked", function (event) {
    changeVisibility($('#divappliednumberrow'), "none");
    changeVaccineVisibility("none", "none", "none");
    $('#appliednumberselector').val('1');
    resetVaccineDataInputs();
});
$('#appliednumberselector').change(function () {
    if ($('#appliednumberselector').val() === '1') {
        changeVaccineVisibility("block", "none", "none");
    } else if ($('#appliednumberselector').val() === '2') {
        changeVaccineVisibility("block", "block", "none");
    } else if ($('#appliednumberselector').val() === '3') {
        changeVaccineVisibility("block", "block", "block");
    }
});
function changeVaccineVisibility(cssTag1, cssTag2, cssTag3) {
    changeVisibility($('#divvaccinedata1'), cssTag1);
    changeVisibility($('#divvaccinedata2'), cssTag2);
    changeVisibility($('#divvaccinedata3'), cssTag3);
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
}
function validate() {
    if (!validateGeneralData()) {
        return false;
    }
    if ($('#vaccineapplication').is(":checked")) {
        vaccineCount = parseInt($('#appliednumberselector').val());
        for (i = 1; i <= vaccineCount; i++) {
            if (!validateVaccineData(i)) {
                return false;
            }
        }

    }
}
function validateVaccineData(idVaccine) {
    if (isEmptyNumberRequired($('#vaccineselector' + idVaccine))) {
        addErrorCss($("#divvaccine" + idVaccine), $("#vaccine-dialog"));
        return false;
    } else {
        removeErrorCss($("#divvaccine" + idVaccine));
    }
    if (isEmptyStringRequired($('#batch' + idVaccine))) {
        addErrorCss($("#divbatch" + idVaccine), $("#batch-dialog"));
        return false;
    } else {
        removeErrorCss($("#divbatch" + idVaccine));
    }
    if (isEmptyStringRequired($('#expiration' + idVaccine))) {
        addErrorCss($("#divexpiration" + idVaccine), $("#expiration-dialog"));
        return false;
    } else {
        removeErrorCss($("#divexpiration" + idVaccine));
    }
    return true;
}