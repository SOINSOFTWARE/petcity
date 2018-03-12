<div id="divappliednumberrow" class="row" style="display: <?php echo ($vaccine_array[0]->isApplyVaccine()) ? 'block;' : 'none;'; ?>">
    <div class="col-xs-4">
        <div id="divappliednumber" class="form-group">
            <label for="appliednumberselector"> N&uacute;mero de vacunas</label>
            <select id="appliednumberselector" name="appliednumberselector" class="form-control">
                <option value="1" 
                <?php
                if ($applied_number === 1) {
                    echo ' selected ';
                }
                ?>>1</option>
                <option value="2" 
                <?php
                if ($applied_number === 2) {
                    echo ' selected ';
                }
                ?>>2</option>
                <option value="3" 
                <?php
                if ($applied_number === 3) {
                    echo ' selected ';
                }
                ?>>3</option>
            </select>
        </div>
    </div>
</div>
<div id="divvaccinedata1" class="row" style="display: <?php echo ($vaccine_array[0]->isApplyVaccine()) ? 'block;' : 'none;'; ?>">
    <input type="hidden" id="idvaccineconsultation1" name="idvaccineconsultation1" value="<?php echo get_numeric_value($vaccine_array[0]->id); ?>"/>
    <div class="col-xs-4">
        <div id="divvaccine1" class="form-group">
            <label for="vaccineselector1">Vacuna aplicada</label>
            <select id="vaccineselector1" name="vaccineselector1" class="form-control">
                <option value="0">Seleccione uno...</option>
                <?php createVaccineOptions($results, $vaccine_array[0]->id_vaccine);
                ?>
            </select>
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divbatch1" class="form-group">
            <label for="batch1">Lote</label>
            <input type="text" class="form-control" id="batch1" name="batch1" placeholder="Lote" maxlength="40" value="<?php echo get_string_value($vaccine_array[0]->batch); ?>" />
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divexpiration1" class="form-group">
            <label for="expiration1">Fecha de expiraci&oacute;n</label>
            <input type="text" class="form-control" id="expiration1" name="expiration1" placeholder="Expiraci&oacute;n" maxlength="40" value="<?php echo get_string_value($vaccine_array[0]->expiration); ?>" />
        </div>
    </div>
</div>
<div id="divvaccinedata2" class="row" style="display: <?php echo ($vaccine_array[1]->isApplyVaccine()) ? 'block;' : 'none;'; ?>">
    <input type="hidden" id="idvaccineconsultation2" name="idvaccineconsultation2" value="<?php echo get_numeric_value($vaccine_array[1]->id); ?>"/>
    <div class="col-xs-4">
        <div id="divvaccine2" class="form-group">
            <label for="vaccineselector2">Vacuna aplicada</label>
            <select id="vaccineselector2" name="vaccineselector2" class="form-control">
                <option value="0">Seleccione uno...</option>
                <?php createVaccineOptions($results, $vaccine_array[1]->id_vaccine); ?>
            </select>
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divbatch2" class="form-group">
            <label for="batch2">Lote</label>
            <input type="text" class="form-control" id="batch2" name="batch2" placeholder="Lote" maxlength="40" value="<?php echo get_string_value($vaccine_array[1]->batch); ?>" />
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divexpiration2" class="form-group">
            <label for="expiration2">Fecha de expiraci&oacute;n</label>
            <input type="text" class="form-control" id="expiration2" name="expiration2" placeholder="Expiraci&oacute;n" maxlength="40" value="<?php echo get_string_value($vaccine_array[1]->expiration); ?>" />
        </div>
    </div>
</div>
<div id="divvaccinedata3" class="row" style="display: <?php echo ($vaccine_array[2]->isApplyVaccine()) ? 'block;' : 'none;'; ?>">
    <input type="hidden" id="idvaccineconsultation3" name="idvaccineconsultation3" value="<?php echo get_numeric_value($vaccine_array[2]->id); ?>"/>
    <div class="col-xs-4">
        <div id="divvaccine3" class="form-group">
            <label for="vaccineselector3">Vacuna aplicada</label>
            <select id="vaccineselector3" name="vaccineselector3" class="form-control">
                <option value="0">Seleccione uno...</option>
                <?php createVaccineOptions($results, $vaccine_array[2]->id_vaccine); ?>
            </select>
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divbatch3" class="form-group">
            <label for="batch3">Lote</label>
            <input type="text" class="form-control" id="batch3" name="batch3" placeholder="Lote" maxlength="40" value="<?php echo get_string_value($vaccine_array[2]->batch); ?>" />
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divexpiration3" class="form-group">
            <label for="expiration3">Fecha de expiraci&oacute;n</label>
            <input type="text" class="form-control" id="expiration3" name="expiration3" placeholder="Expiraci&oacute;n" maxlength="40" value="<?php echo get_string_value($vaccine_array[2]->expiration); ?>" />
        </div>
    </div>
</div>
