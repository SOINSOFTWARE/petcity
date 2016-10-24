<div class="tab-pane" id="tab_2">
	<form method="post" role="form">
    	<div class="row">
			<div class="col-xs-12">
                <div class="box">
            		<div class="box-body">
                        <button type="submit" name="submit" name="submit" class="btn btn-primary">
                        	<i class="fa fa-save"></i>
                    	</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
			<div class="col-xs-12">
                <div class="box">
                	<div class="box-header">
                        <h3 class="box-title">Consulta</h3>
                    </div>
            		<div class="box-body">
            			<div class="row">
	        				<div class="col-xs-4">
	                        	<label for="consultationdate">Fecha</label>
	                        	<input type="text" class="form-control" id="consultationdate" placeholder="Fecha de la consulta" data-inputmask="'alias': 'dd/mm/yyyy'" required data-mask>
	                        </div>
                        </div>
        			</div>
    			</div>
			</div>
			<div class="col-xs-4">
    			<div class="box">
                    <div class="box-body">
                    	<div class="form-group">
                            <label for="weight">Peso (Kg)</label>
                            <input type="text" class="form-control" id="weight" placeholder="Peso de la mascota" value="000.00" data-inputmask='"mask": "999.99"' required data-mask>
                        </div>
                    	<div class="form-group">
                            <label for="foodbrand">Marca de alimento</label>
                            <select id="foodbrand" class="form-control" required></select>
                        </div>
                        <div class="form-group">
                            <label for="corporalcondition">Condici&oacute;n corporal</label>
                            <input type="text" class="form-control" id="corporalcondition" placeholder="Condici&oacute;n corporal" maxlength="30" required>
                        </div>
                	</div>
            	</div>
        	</div>
        	<div class="col-xs-4">
    			<div class="box">
                    <div class="box-body">
                    	<div class="form-group">
                            <label for="motive">Motivo</label>
                            <textarea class="form-control" id="motive" rows="3" maxlength="200" placeholder="&iquest;Cu&aacute;l es el motivo de la visita?" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="diagnosis">Diagn&oacute;stico</label>
                            <textarea class="form-control" id="diagnosis" rows="2" maxlength="100"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="illness">Enfermedad</label>
                            <input type="text" class="form-control" id="illness" placeholder="Posible enfermedad" maxlength="60">
                        </div>
                        <div class="form-group">
                            <label for="treatment">Tratamiento</label>
                            <textarea class="form-control" id="treatment" rows="4" maxlength="400"></textarea>
                        </div>
                	</div>
            	</div>
        	</div>
        	<div class="col-xs-4">
    			<div class="box">
                    <div class="box-body">
                    	<div class="form-group">
                            <label for="anamnesis">Anamnesis</label>
                            <textarea class="form-control" id="anamnesis" rows="4" maxlength="400"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="findings">Hallazgos</label>
                            <textarea class="form-control" id="findings" rows="3" maxlength="200"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="control">Control</label>
                            <textarea class="form-control" id="control" rows="3" maxlength="200"></textarea>
                        </div>
                	</div>
            	</div>
        	</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
                <div class="box">
                	<div class="box-header">
                        <h4 class="box-title">Vacunaci&oacute;n</h4>
                    </div>
            		<div class="box-body">
            			<div class="row">
	        				<div class="col-xs-2">
	                            <div class="checkbox">
	                                <label>
	                                	&iquest;Se aplicaron vacunas?
	                                    <input type="checkbox" id="vaccineapplication" />
	                                </label>
	                            </div>
                            </div>
                            <div class="col-xs-2">
                        		<label for="vaccinenumber">&iquest;Cu&aacute;ntos?</label>
		                        <select id="vaccinenumber" class="form-control">
		                        	<option id="1" selected>1</option>
		                        	<option id="2">2</option>
		                        	<option id="3">3</option>
		                        	<option id="4">4</option>
		                        	<option id="5">5</option>
		                        	<option id="6">6</option>
		                        	<option id="7">7</option>
		                        	<option id="8">8</option>
		                        </select>
                        	</div>
                        </div>
                        <br />
                        <div class="row">
	        				<div class="col-xs-3">
	        					<label for="vaccine1">Vacuna #1</label>
	        					<select id="vaccine1" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="vaccine2">Vacuna #2</label>
	        					<select id="vaccine2" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="vaccine3">Vacuna #3</label>
	        					<select id="vaccine3" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="vaccine4">Vacuna #4</label>
	        					<select id="vaccine4" class="form-control"></select>
        					</div>
    					</div>
    					<br />
    					<div class="row">
	        				<div class="col-xs-3">
	        					<label for="vaccine5">Vacuna #5</label>
	        					<select id="vaccine5" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="vaccine6">Vacuna #6</label>
	        					<select id="vaccine6" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="vaccine7">Vacuna #7</label>
	        					<select id="vaccine7" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="vaccine8">Vacuna #8</label>
	        					<select id="vaccine8" class="form-control"></select>
        					</div>
    					</div>
        			</div>
    			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
                <div class="box">
                	<div class="box-header">
                        <h4 class="box-title">Antiparasitarios</h4>
                    </div>
            		<div class="box-body">
            			<div class="row">
	        				<div class="col-xs-2">
	                            <div class="checkbox">
	                                <label>
	                                	&iquest;Se aplicaron antiparasitarios?
	                                    <input type="checkbox" id="drenchingapplication" />
	                                </label>
	                            </div>
                            </div>
                            <div class="col-xs-2">
                        		<label for="drenchingnumber">&iquest;Cu&aacute;ntos?</label>
		                        <select id="drenchingnumber" class="form-control">
		                        	<option id="1" selected>1</option>
		                        	<option id="2">2</option>
		                        	<option id="3">3</option>
		                        	<option id="4">4</option>
		                        	<option id="5">5</option>
		                        	<option id="6">6</option>
		                        	<option id="7">7</option>
		                        	<option id="8">8</option>
		                        </select>
                        	</div>
                        </div>
                        <br />
                        <div class="row">
	        				<div class="col-xs-3">
	        					<label for="drenching1">Antiparasitario #1</label>
	        					<select id="drenching1" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="drenching2">Antiparasitario #2</label>
	        					<select id="drenching2" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="drenching3">Antiparasitario #3</label>
	        					<select id="drenching3" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="drenching4">Antiparasitario #4</label>
	        					<select id="drenching4" class="form-control"></select>
        					</div>
    					</div>
    					<br />
    					<div class="row">
	        				<div class="col-xs-3">
	        					<label for="drenching5">Antiparasitario #5</label>
	        					<select id="drenching5" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="drenching6">Antiparasitario #6</label>
	        					<select id="drenching6" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="drenching7">Antiparasitario #7</label>
	        					<select id="drenching7" class="form-control"></select>
        					</div>
        					<div class="col-xs-3">
	        					<label for="drenching8">Antiparasitario #8</label>
	        					<select id="drenching8" class="form-control"></select>
        					</div>
    					</div>
        			</div>
    			</div>
			</div>
		</div>
	</form>
</div>