<?php
session_start();
include_once '../session.php';
include_once '../../php/company.php';
include_once '../../php/clinichistory.php';
include_once '../../php/owner.php';
include_once '../../php/pet.php';
include_once '../../php/entity/clinichistory.php';
include_once '../../php/entity/owner.php';
include_once '../../php/entity/pet.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/custom_date.php';
include_once '../phpfragments/message_dialog.php';
include_once './php/owner_pet/before_load.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Datos b&aacute;sicos</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../../css/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="skin-blue">
        <?php include '../header.php'; ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <?php
                    include '../user-panel.php';
                    include 'menu.php';
                    ?>
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1> Datos b&aacute;sicos del propietario y la mascota </h1>                    
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-medkit"></i> Pet City</a>
                        </li>
                        <li>
                            <a href="../../">Historico</a>
                        </li>
                        <li class="active">
                            Datos b&aacute;sicos
                        </li>
                    </ol>
                    <br/>
                    <?php include_once '../phpfragments/backward_button.php'; ?>
                </section>
                <section class="content">
                    <?php include_once './php/owner_pet/after_crud_operation_messages.php'; ?>
                    <form action="datosbasicos.php" method="post" role="form" onsubmit="return validate()" enctype="multipart/form-data">
                        <input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo get_numeric_value($clinic_history->id); ?>" />
                        <input type="hidden" id="recordcustomid" name="recordcustomid" value="<?php echo get_string_value($clinic_history->record_custom_id); ?>" />
                        <input type="hidden" id="idowner" name="idowner" value="<?php echo get_numeric_value($clinic_history->pet->owner->id); ?>" />
                        <input type="hidden" id="idpet" name="idpet" value="<?php echo get_numeric_value($clinic_history->pet->id); ?>" />
                        <input type="hidden" id="petphoto" name="petphoto" value="<?php echo get_string_value($clinic_history->pet->photo); ?>" />
                        <input type="hidden" id="pettype" name="pettype" value="<?php echo get_numeric_value($clinic_history->pet->id_pet_type); ?>" />
                        <input type="hidden" id="petbreed" name="petbreed" value="<?php echo get_numeric_value($clinic_history->pet->id_breed); ?>" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="box">
                                                    <div class="box-header">
                                                        <h3 class="box-title">Historia</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div id="divclinichistory" class="form-group">
                                                                    <label for="recordcustomid">N&uacute;mero</label>
                                                                    <input type="number" class="form-control" placeholder="N&uacute;mero de historia" 
                                                                           value="<?php echo get_string_value($clinic_history->record_custom_id); ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="box">
                                                    <div class="box-header">
                                                        <h3 class="box-title">Propietario</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div id="divownerdocument" class="form-group">
                                                            <label for="ownerdocument">N&uacute;mero de documento</label>
                                                            <input type="number" class="form-control" id="ownerdocument" name="ownerdocument" 
                                                                   placeholder="N&uacute;mero de documento" 
                                                                   value="<?php echo get_string_value($clinic_history->pet->owner->document); ?>" required data-mask />
                                                        </div>
                                                        <div id="divownername" class="form-group">
                                                            <label for="ownername">Nombre(s)</label>
                                                            <input type="text" class="form-control" id="ownername" name="ownername" 
                                                                   placeholder="Nombre(s)" maxlength="50" 
                                                                   value="<?php echo get_string_value($clinic_history->pet->owner->name); ?>" required />
                                                        </div>
                                                        <div id="divownerlastname" class="form-group">
                                                            <label for="ownerlastname">Apellido(s)</label>
                                                            <input type="text" class="form-control" id="ownerlastname" name="ownerlastname" 
                                                                   placeholder="Apellido(s)" maxlength="50" 
                                                                   value="<?php echo get_string_value($clinic_history->pet->owner->last_name); ?>" required />
                                                        </div>
                                                        <div id="divowneremail" class="form-group">
                                                            <label for="owneremail">Email</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                                <input type="email" class="form-control" id="owneremail" name="owneremail" 
                                                                       placeholder="ejemplo@email.com" maxlength="150" 
                                                                       value="<?php echo get_string_value($clinic_history->pet->owner->email); ?>" required />
                                                            </div>
                                                        </div>
                                                        <div id="divowneraddress" class="form-group">
                                                            <label for="owneraddress">Direcci&oacute;n</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                                <input type="text" class="form-control" id="owneraddress" name="owneraddress" 
                                                                       placeholder="Direcci&oacute;n" maxlength="100" 
                                                                       value="<?php echo get_string_value($clinic_history->pet->owner->address); ?>" required />
                                                            </div>
                                                        </div>
                                                        <div id="divownerphone2" class="form-group">
                                                            <label for="ownerphone2">Celular</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                                                <input type="text" class="form-control" id="ownerphone2" name="ownerphone2"
                                                                       placeholder="Celular" data-inputmask='"mask": "9999999999"'
                                                                       value="<?php echo get_string_value($clinic_history->pet->owner->phone2); ?>" required data-mask />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ownerphone">Tel&eacute;fono</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                <input type="text" class="form-control" id="ownerphone" name="ownerphone"
                                                                       placeholder="Tel&eacute;fono" data-inputmask='"mask": "9999999"' 
                                                                       value="<?php echo get_string_value($clinic_history->pet->owner->phone1); ?>" data-mask />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="box">
                                                    <div class="box-header">
                                                        <h3 class="box-title">Mascota</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                                   <?php
                                                                   if (get_string_value($clinic_history->pet->photo) != '') {
                                                                       echo '<div class="form-group">';
                                                                       echo '<img src="';
                                                                       echo $clinic_history->pet->photo;
                                                                       echo '" class="img-rounded" alt="Foto de la mascota" width="250px" />';
                                                                       echo '</div>';
                                                                       echo '<label for="pet_photo_file">Cambiar foto</label>';
                                                                   } else {
                                                                       echo '<label for="pet_photo_file">Adjuntar foto</label>';
                                                                   }
                                                                   echo '<input type="file" id="pet_photo_file" name="pet_photo_file" onchange="validateFile()">';
                                                                   echo '<p class="help-block">Solo se permite adjuntar archivos con extensi&oacute;n png, jpg, jpeg</p>';
                                                                   ?>
                                                        </div>
                                                        <div id="divpetname" class="form-group">
                                                            <label for="petname">Nombre</label>
                                                            <input type="text" class="form-control" id="petname" name="petname" 
                                                                   placeholder="Nombre" maxlength="60" 
                                                                   value="<?php echo get_string_value($clinic_history->pet->name); ?>" required />
                                                        </div>
                                                        <div id="divpettype" class="form-group">
                                                            <button type="button" id="pettypebtn" name="pettypebtn" class="btn btn-warning" onclick="showPetType();">
                                                                <i class="fa fa-search"></i> Seleccione la especie y raza de la mascota
                                                            </button>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pettype">Especie</label>
                                                            <input type="text" class="form-control" id="pettypename" name="pettypename"
                                                                   placeholder="Caninos..." 
                                                                   value="<?php echo get_string_value($clinic_history->pet->type_name); ?>" readonly />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="petbreed">Raza</label>
                                                            <input type="text" class="form-control" id="petbreedname" name="petbreedname"
                                                                   placeholder="Raza de la mascota" 
                                                                   value="<?php echo get_string_value($clinic_history->pet->breed_name); ?>" readonly />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="petreproduction">Estado reproductivo</label>
                                                            <select id="petreproduction" name="petreproduction" class="form-control" required>
                                                                <?php include '../phpfragments/reproduction_select.php'; ?>
                                                            </select>
                                                        </div>
                                                        <div id="divpetcolor" class="form-group">
                                                            <label for="petcolor">Color</label>
                                                            <input type="text" class="form-control" id="petcolor" name="petcolor"
                                                                   placeholder="Color" maxlength="45" 
                                                                   value="<?php echo get_string_value($clinic_history->pet->color); ?>" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" id="petsex1" name="petsex" value="M" 
                                                                           <?php print_checked_if_needed($clinic_history->pet->sex, "M"); ?> />
                                                                    Macho</label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" id="petsex2" name="petsex" value="F" 
                                                                           <?php print_checked_if_needed($clinic_history->pet->sex, "F"); ?> />
                                                                    Hembra</label>
                                                            </div>
                                                        </div>
                                                        <div id="divborndate" class="form-group">
                                                            <label for="petborndate">Fecha de nacimiento</label>
                                                            <input type="text" class="form-control" id="petborndate" name="petborndate" 
                                                                   placeholder="Fecha de nacimiento" data-inputmask="'alias': 'mm/yyyy'"
                                                                   value="<?php echo get_string_value($clinic_history->pet->born_date); ?>" required data-mask />
                                                        </div>
                                                        <div id="divpetbornplace" class="form-group">
                                                            <label for="petbornplace">Procedencia</label>
                                                            <input type="text" class="form-control" id="petbornplace" name="petbornplace"
                                                                   placeholder="Lugar en el cual se adquiri&oacute; la mascota"  maxlength="60"
                                                                   value="<?php echo get_string_value($clinic_history->pet->born_place); ?>" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="history">Antecedentes - Enfermedades anteriores</label>
                                                            <textarea placeholder="Enfermedades anteriores, hospitalizaciones, propietarios anteriores, reacciones adversas, y todos los datos de importancia de la mascota"
                                                                      class="form-control" id="history" name="history" rows="8" maxlength="650"><?php echo get_string_value($clinic_history->pet->history); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" id="save" name="save" class="btn btn-primary pull-right">
                                                        <i class="fa fa-save"></i> Guardar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </aside>
        </div>
        <?php include_once './php/owner_pet/required_field_dialogs.php'; ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="../../js/petcity.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script type="text/javascript">
                                                                $(document).ready(function () {
                                                                    $("#ownerdocument").keydown(function (e) {
                                                                        validateIntegerInput(e);
                                                                    });
                                                                    $("#recordcustomid").keydown(function (e) {
                                                                        validateIntegerInput(e);
                                                                    });
                                                                    $("#datemask").inputmask("mm/yyyy", {
                                                                        "placeholder": "mm/yyyy"
                                                                    });
                                                                    $("[data-mask]").inputmask();
                                                                });

                                                                function validate() {
                                                                    if (!validateOwnerData() || !validatePetData()) {
                                                                        return false;
                                                                    }
                                                                }

                                                                function validateOwnerData() {
                                                                    if ($.trim($("#ownerdocument").val()) === ''
                                                                            || $.trim($("#ownerdocument").val()) === '0') {
                                                                        $("#divownerdocument").addClass("has-error");
                                                                        showDivDialog($("#ownerdocument-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divownerdocument").removeClass("has-error");
                                                                    }
                                                                    if ($.trim($("#ownername").val()) === '') {
                                                                        $("#divownername").addClass("has-error");
                                                                        showDivDialog($("#ownername-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divownername").removeClass("has-error");
                                                                    }
                                                                    if ($.trim($("#ownerlastname").val()) === '') {
                                                                        $("#divownerlastname").addClass("has-error");
                                                                        showDivDialog($("#ownerlastname-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divownerlastname").removeClass("has-error");
                                                                    }
                                                                    if ($.trim($("#owneremail").val()) === '') {
                                                                        $("#divowneremail").addClass("has-error");
                                                                        showDivDialog($("#owneremail-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divowneremail").removeClass("has-error");
                                                                    }
                                                                    if ($.trim($("#owneraddress").val()) === '') {
                                                                        $("#divowneraddress").addClass("has-error");
                                                                        showDivDialog($("#owneraddress-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divowneraddress").removeClass("has-error");
                                                                    }
                                                                    if ($.trim($("#ownerphone2").val()) === ''
                                                                            || $.trim($("#ownerphone2").val()) === '__________') {
                                                                        $("#divownerphone2").addClass("has-error");
                                                                        showDivDialog($("#ownerphone-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divownerphone2").removeClass("has-error");
                                                                    }
                                                                    return true;
                                                                }

                                                                function validatePetData() {
                                                                    if ($.trim($("#petname").val()) === '') {
                                                                        $("#divpetname").addClass("has-error");
                                                                        showDivDialog($("#petname-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divpetname").removeClass("has-error");
                                                                    }
                                                                    if (!validateTypeAndBreed()) {
                                                                        $("#divpettype").addClass("has-error");
                                                                        showDivDialog($("#breed-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divpettype").removeClass("has-error");
                                                                    }
                                                                    if ($.trim($("#petcolor").val()) === '') {
                                                                        $("#divpetcolor").addClass("has-error");
                                                                        showDivDialog($("#petcolor-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divpetcolor").removeClass("has-error");
                                                                    }
                                                                    if (!validateBornDate()) {
                                                                        $("#divborndate").addClass("has-error");
                                                                        showDivDialog($("#borndate-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divborndate").removeClass("has-error");
                                                                    }
                                                                    if ($.trim($("#petbornplace").val()) === '') {
                                                                        $("#divpetbornplace").addClass("has-error");
                                                                        showDivDialog($("#petbornplace-dialog"));
                                                                        return false;
                                                                    } else {
                                                                        $("#divpetbornplace").removeClass("has-error");
                                                                    }
                                                                    return true;
                                                                }

                                                                function validateTypeAndBreed() {
                                                                    return $.trim($('#pettype').val()) !== '0' && $.trim($('#petbreed').val()) !== '0';
                                                                }

                                                                function validateBornDate() {
                                                                    var borndate = $.trim($('#petborndate').val());
                                                                    var array = borndate.split("/");
                                                                    var arrayMonth = array[0].split("");
                                                                    var arrayYear = array[1].split("");
                                                                    return arrayMonth[0] !== 'm' && arrayMonth[1] !== 'm' && arrayYear[0] !== 'y' && arrayYear[1] !== 'y' && arrayYear[2] !== 'y' && arrayYear[3] !== 'y';
                                                                }

                                                                function showDivDialog(divDialog) {
                                                                    divDialog.dialog({
                                                                        autoOpen: false,
                                                                        width: 400,
                                                                        modal: true,
                                                                        resizable: false,
                                                                        buttons: [{
                                                                                text: "Volver",
                                                                                click: function () {
                                                                                    $(this).dialog("close");
                                                                                }
                                                                            }]
                                                                    });
                                                                    divDialog.dialog("open");
                                                                }

                                                                function validateFile() {
                                                                    var countFiles = document.getElementById("pet_photo_file").files.length;
                                                                    if (countFiles === 1) {
                                                                        if (typeof (FileReader) !== "undefined") {
                                                                            var imgPath = document.getElementById("pet_photo_file").value;
                                                                            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                                            if (extn !== "png" && extn !== "jpg" && extn !== "jpeg") {
                                                                                showDivDialog($("#extension-dialog"));
                                                                                document.getElementById("pet_photo_file").value = null;
                                                                                return false;
                                                                            }
                                                                        } else {
                                                                            showDivDialog($("#browser-dialog"));
                                                                        }
                                                                    } else {
                                                                        showDivDialog($("#one-file-dialog"));
                                                                    }
                                                                }
        </script>
    </body>
</html>
