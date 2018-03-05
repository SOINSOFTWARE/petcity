<div class="row">
    <div class="col-lg-4">
        <div id="divgeneraldatadate" class="form-group">
            <label for="generaldatadate">Fecha</label>
            <div class="input-group date input-group-sm">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="generaldatadate" name="generaldatadate" value="<?php
                if (isset($generaldatadate)) {
                    echo $generaldatadate;
                }
                ?>" required />
            </div>
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divweight" class="form-group">
            <label for="weight">Peso de la mascota (Kg)</label>
            <input type="number" class="form-control" id="weight" name="weight" placeholder="KG" step="0.01" autocomplete="off" value="<?php
            if (isset($weight)) {
                echo $weight;
            }
            ?>" required />
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            <label for="corporalcondition">Condici&oacute;n corporal</label>
            <input type="text" class="form-control" id="corporalcondition" name="corporalcondition" placeholder="Condici&oacute;n corporal" maxlength="30" value="<?php
            if (isset($corporalcondition)) {
                echo $corporalcondition;
            }
            ?>" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <div id="divheartrate" class="form-group">
            <label for="heartrate">Frecuencia cardiaca (ppm)</label>
            <input type="text" class="form-control" id="heartrate" name="heartrate" placeholder="PPM" maxlength="3" autocomplete="off" value="<?php
            if (isset($heartrate)) {
                echo $heartrate;
            }
            ?>" required />
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divbreathingfrequency" class="form-group">
            <label for="breathingfrequency">Frecuencia respiratoria (rpm)</label>
            <input type="text" class="form-control" id="breathingfrequency" name="breathingfrequency" placeholder="rpm" maxlength="3" autocomplete="off" value="<?php
            if (isset($breathingfrequency)) {
                echo $breathingfrequency;
            }
            ?>" required />
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divtemperature" class="form-group">
            <label for="temperature">Temperatura (&#8728;C)</label>
            <input type="number" class="form-control" id="temperature" name="temperature" placeholder="Temperatura" step=".01" autocomplete="off" value="<?php
            if (isset($temperature)) {
                echo $temperature;
            }
            ?>" required />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label for="heartbeat">Pulso</label>
            <input type="text" class="form-control" id="heartbeat" name="heartbeat" placeholder="Pulso" maxlength="40" value="<?php
            if (isset($heartbeat)) {
                echo $heartbeat;
            }
            ?>" required>
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            <label for="linfonodulos">Linfon&oacute;dulos</label>
            <input type="text" class="form-control" id="linfonodulos" name="linfonodulos" placeholder="Linfon&oacute;dulos" maxlength="60" value="<?php
            if (isset($linfonodulos)) {
                echo $linfonodulos;
            }
            ?>" required>
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            <label for="mucous">Mucosas</label>
            <input type="text" class="form-control" id="mucous" name="mucous" placeholder="Mucosas" maxlength="60" value="<?php
            if (isset($mucous)) {
                echo $mucous;
            }
            ?>" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label for="trc">Tiempo de llenado capilar (Segundos)</label>
            <input type="text" class="form-control" id="trc" name="trc" placeholder="Segundos" maxlength="3" autocomplete="off" value="<?php
            if (isset($trc)) {
                echo $trc;
            }
            ?>" required />
        </div>
    </div>
    <div class="col-xs-4">
        <div id="divdh" class="form-group">
            <label for="dh">DH %</label>
            <input type="text" class="form-control" id="dh" name="dh" placeholder="DH %" maxlength="3" autocomplete="off" value="<?php
            if (isset($dh)) {
                echo $dh;
            }
            ?>" required />
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            <label for="mood">Actitud</label>
            <input type="text" class="form-control" id="mood" name="mood" placeholder="Actitud" maxlength="60" value="<?php
            if (isset($mood)) {
                echo $mood;
            }
            ?>" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label for="tusigo">Reflejo tus&iacute;geno</label>
            <input type="text" class="form-control" id="tusigo" name="tusigo" placeholder="Reflejo tus&iacute;geno" maxlength="60" value="<?php
                   if (isset($tusigo)) {
                       echo $tusigo;
                   }
                   ?>" required>
        </div>
    </div>
</div>
