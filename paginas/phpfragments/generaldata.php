<div class="row">
	<div class="col-xs-4">
		<div id="divgeneraldatadate" class="form-group">
			<label for="generaldatadate">Fecha</label>
			<input type="text" class="form-control" id="generaldatadate" name="generaldatadate" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php
			if (isset($generaldatadate)) {
				echo $generaldatadate;
			}
			?>" required data-mask />
		</div>
	</div>
	<div class="col-xs-4">
		<div id="divweight" class="form-group">
			<label for="weight">Peso de la mascota (Kg)</label>
			<input type="text" class="form-control" id="weight" name="weight" placeholder="Peso de la mascota" data-inputmask='"mask": "999.99"' value="<?php
			if (isset($weight)) {
				echo $weight;
			} else {
				echo '000.00';
			}
			?>" required data-mask />
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
			<input type="text" class="form-control" id="heartrate" name="heartrate" placeholder="Frecuencia cardiaca (ppm)" data-inputmask='"mask": "999"' value="<?php
			if (isset($heartrate)) {
				echo $heartrate;
			} else {
				echo '000';
			}
			?>" required data-mask />
		</div>
	</div>
	<div class="col-xs-4">
		<div id="divbreathingfrequency" class="form-group">
			<label for="breathingfrequency">Frecuencia respiratoria</label>
			<input type="text" class="form-control" id="breathingfrequency" name="breathingfrequency" placeholder="Frecuencia respiratoria" data-inputmask='"mask": "999"' value="<?php
			if (isset($breathingfrequency)) {
				echo $breathingfrequency;
			} else {
				echo '000';
			}
			?>" required data-mask />
		</div>
	</div>
	<div class="col-xs-4">
		<div id="divtemperature" class="form-group">
			<label for="temperature">Temperatura (&#8728;C)</label>
			<input type="text" class="form-control" id="temperature" name="temperature" placeholder="Temperatura" data-inputmask='"mask": "99.99"' value="<?php
			if (isset($temperature)) {
				echo $temperature;
			} else {
				echo '00.00';
			}
			?>" required data-mask />
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
		<div id="divdh" class="form-group">
			<label for="dh">DH %</label>
			<input type="text" class="form-control" id="dh" name="dh" placeholder="DH %" data-inputmask='"mask": "999"' value="<?php
			if (isset($dh)) {
				echo $dh;
			} else {
				echo '000';
			}
			?>" data-mask />
		</div>
	</div>
	<div class="col-xs-4">
		<div class="form-group">
			<label for="mood">Estado de &aacute;nimo</label>
			<input type="text" class="form-control" id="mood" name="mood" placeholder="Estado de &aacute;nimo" maxlength="60" value="<?php
			if (isset($mood)) {
				echo $mood;
			}
			?>" required>
		</div>
	</div>
	<div class="col-xs-4">
		<div class="form-group">
			<label for="tusigo">Reflejo tusigeno</label>
			<input type="text" class="form-control" id="tusigo" name="tusigo" placeholder="Reflejo tusigeno" maxlength="60" value="<?php
			if (isset($tusigo)) {
				echo $tusigo;
			}
			?>" required>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<div class="form-group">
			<label for="anamnesis">Anamnesis</label>
			<textarea class="form-control" id="anamnesis" name="anamnesis" rows="5" maxlength="400" required><?php
			if (isset($anamnesis)) { echo $anamnesis;
			}
			?></textarea>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="form-group">
			<label for="findings">Hallazgos</label>
			<textarea class="form-control" id="findings" name="findings" rows="5" maxlength="400" required><?php
			if (isset($findings)) { echo $findings;
			}
			?></textarea>
		</div>
	</div>
</div>