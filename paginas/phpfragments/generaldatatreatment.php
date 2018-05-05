<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label for="clinicaltreatment">Tratamiento cl&iacute;nica</label>
            <textarea class="form-control" id="clinicaltreatment" name="clinicaltreatment" rows="8" maxlength="400"><?php echo get_string_value($general_data->clinical_treatment); ?></textarea>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <label for="formulanumber">N&uacute;mero de f&oacute;rmula</label>
            <input type="text" class="form-control" id="formulanumber" name="formulanumber" placeholder="N&uacute;mero de f&oacute;rmula" maxlength="5" autocomplete="off"
                   value="<?php echo get_numeric_value($general_data->formula_number); ?>" />
        </div>
        <div class="form-group">
            <label for="formula">F&oacute;rmula</label>
            <textarea class="form-control" id="formula" name="formula" rows="4" maxlength="400"><?php echo get_string_value($general_data->formula); ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label for="recomendations">Recomendaciones</label>
            <textarea class="form-control" id="recomendations" name="recomendations" rows="5" maxlength="400"><?php echo get_string_value($general_data->recomendations); ?></textarea>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <label for="observations">Observaciones</label>
            <textarea class="form-control" id="observations" name="observations" rows="5" maxlength="400"><?php echo get_string_value($general_data->observations); ?></textarea>
        </div>
    </div>
</div>