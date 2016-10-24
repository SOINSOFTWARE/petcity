<div class="tab-pane active" id="tab_1">
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
    		<div class="col-xs-6">
    			<div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Propietario</h3>
                    </div>
                    <div class="box-body">
                    	<div class="form-group">
                            <label for="ownerdocument">N&uacute;mero de documento</label>
                            <input type="text" class="form-control" id="ownerdocument" placeholder="N&uacute;mero de documento" data-inputmask='"mask": "9999999999"' required data-mask>
                        </div>
                        <div class="form-group">
                            <label for="ownername">Nombre(s)</label>
                            <input type="text" class="form-control" id="ownername" placeholder="Nombre(s)" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="ownerlastname">Apellido(s)</label>
                            <input type="text" class="form-control" id="ownerlastname" placeholder="Apellido(s)" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="owneremail">Email</label>
                        	<div class="input-group">
                            	<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            	<input type="email" class="form-control" id="owneremail" placeholder="email@email.com" maxlength="150" required>
                        	</div>
                        </div>
                        <div class="form-group">
                            <label for="owneraddress">Direcci&oacute;n</label>
                            <div class="input-group">
                            	<span class="input-group-addon"><i class="fa fa-home"></i></span>
                                <input type="text" class="form-control" id="owneraddress" placeholder="Direcci&oacute;n" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ownerphone2">Celular</label>
                            <div class="input-group">
                            	<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                <input type="text" class="form-control" id="ownerphone2" placeholder="Celular" data-inputmask='"mask": "9999999999"' required data-mask>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ownerphone">Tel&eacute;fono</label>
                            <div class="input-group">
                            	<span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" id="ownerphone" placeholder="Tel&eacute;fono" data-inputmask='"mask": "9999999"' data-mask>
                            </div>
                        </div>
                    </div>
                </div>
    		</div>
    		<div class="col-xs-6">
    			<div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Mascota</h3>
                    </div>
                    <div class="box-body">
                    	<div class="form-group">
                            <label for="petname">Nombre</label>
                            <input type="text" class="form-control" id="petname" placeholder="Nombre" maxlength="60" required>
                        </div>
                    	<div class="form-group">
                            <label for="pettype">Tipo</label>
                            <select id="pettype" class="form-control" required></select>
                        </div>
                        <div class="form-group">
                            <label for="petbreed">Raza</label>
                            <select id="petbreed" class="form-control" required></select>
                        </div>
                        <div class="form-group">
                            <label for="petreproduction">Estado reproductivo</label>
                            <select id="petreproduction" class="form-control" required></select>
                        </div>
                        <div class="form-group">
                            <label for="petcolor">Color</label>
                            <input type="text" class="form-control" id="petcolor" placeholder="Color" maxlength="45" required>
                        </div>
                        <div class="form-group">
                        	<div class="radio">
                                <label>
                                    <input type="radio" name="petsex" id="petsex1" value="M" checked> Macho
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="petsex" id="petsex2" value="F"> Hembra
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="petborndate">Fecha de nacimiento</label>
                            <input type="text" class="form-control" id="petborndate" placeholder="Fecha de nacimiento" data-inputmask="'alias': 'mm/yyyy'" required data-mask>
                        </div>
                        <div class="form-group">
                            <label for="petbornplace">Procedencia</label>
                            <input type="text" class="form-control" id="petbornplace" placeholder="Lugar en el cual se adquiri&oacute; la mascota"  maxlength="60" required>
                        </div>
                    </div>
                </div>
    		</div>
		</div>
	</form>
</div>