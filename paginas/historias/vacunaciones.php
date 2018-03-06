<?php
session_start();
include_once '../session.php';
include_once '../../php/vaccine.php';
include_once '../../php/generaldata.php';
include_once '../../php/vaccineconsultation.php';
include_once '../../php/entity/vaccineconsultation.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/vaccine_select.php';
include_once '../phpfragments/custom_date.php';
include_once '../phpfragments/message_dialog.php';
include_once './php/vaccine/before_load.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Vacunaci&oacute;n por mascota</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../../css/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="skin-blue">
        <?php
        include '../header.php';
        ?>
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
                    <h1> Vacunaci&oacute;n por mascota </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-medkit"></i> Pet City</a>
                        </li>
                        <li>
                            <a href="../../">Historias cl&iacute;nicas</a>
                        </li>
                        <li>
                            Historia cl&iacute;nica por mascota
                        </li>
                        <li class="active">
                            Vacunaci&oacute;n por mascota
                        </li>
                    </ol>
                    <br/>
                    <?php include_once '../phpfragments/backward_button.php'; ?>
                </section>
                <section class="content">
                    <?php include_once './php/vaccine/after_crud_operation_messages.php'; ?>
                    <div class="row">
                        <form action="vacunaciones.php" method="post" role="form" onsubmit="return validate()">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-body">
                                        <input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo get_numeric_value($id_clinic_history); ?>" />
                                        <input type="hidden" id="idvaccineconsultation" name="idvaccineconsultation" value="<?php echo get_numeric_value($vaccine_consultation->id); ?>"/>
                                        <input type="hidden" id="idgeneraldata" name="idgeneraldata" value="<?php echo get_numeric_value($vaccine_consultation->id_general_data); ?>"/>
                                        <input type="hidden" id="idpet" name="idpet" value="<?php echo get_numeric_value($vaccine_consultation->id_pet); ?>"/>
                                        <?php include_once '../phpfragments/generaldata.php'; ?>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label for="anamnesis">Anamnesis</label>
                                                    <textarea class="form-control" id="anamnesis" name="anamnesis" rows="5" maxlength="400" required><?php echo get_string_value($anamnesis); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label for="findings">Hallazgos</label>
                                                    <textarea class="form-control" id="findings" name="findings" rows="5" maxlength="400" required><?php echo get_string_value($findings); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label> &iquest;Apta para vacunaci&oacute;n?
                                                            <input type="checkbox" id="vaccineapplication" name="vaccineapplication" value="1"
                                                            <?php
                                                            if ($vaccine_consultation->isApplyVaccine()) {
                                                                echo "checked";
                                                            }
                                                            ?> />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div id="divappliednumber" class="form-group" style="display: <?php
                                                if ($vaccine_consultation->isApplyVaccine()) {
                                                    echo 'block;';
                                                } else {
                                                    echo 'none;';
                                                }
                                                ?>">
                                                    <label for="appliednumberselector">N&uacute;mero de vacunas</label>
                                                    <select id="appliednumberselector" name="appliednumberselector" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="divvaccinedata1" class="row" style="display: <?php
                                        if ($vaccine_consultation->isApplyVaccine()) {
                                            echo 'block;';
                                        } else {
                                            echo 'none;';
                                        }
                                        ?>">
                                            <div class="col-xs-4">
                                                <div id="divvaccine1" class="form-group">
                                                    <label for="vaccineselector1">Vacuna aplicada</label>
                                                    <select id="vaccineselector1" name="vaccineselector1" class="form-control">
                                                        <option value="0">Seleccione uno...</option>
                                                        <?php createVaccineOptions($results, $vaccine_consultation->id_vaccine); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div id="divbatch1" class="form-group">
                                                    <label for="batch1">Lote</label>
                                                    <input type="text" class="form-control" id="batch1" name="batch1" placeholder="Lote" maxlength="40" value="<?php echo get_string_value($vaccine_consultation->batch); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div id="divexpiration1" class="form-group">
                                                    <label for="expiration1">Fecha de expiraci&oacute;n</label>
                                                    <input type="text" class="form-control" id="expiration1" name="expiration1" placeholder="Expiraci&oacute;n" maxlength="40" value="<?php echo get_string_value($vaccine_consultation->expiration); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div id="divvaccinedata2" class="row" style="display: <?php
                                        if ($vaccine_consultation->isApplyVaccine()) {
                                            echo 'block;';
                                        } else {
                                            echo 'none;';
                                        }
                                        ?>">
                                            <div class="col-xs-4">
                                                <div id="divvaccine2" class="form-group">
                                                    <label for="vaccineselector2">Vacuna aplicada</label>
                                                    <select id="vaccineselector2" name="vaccineselector2" class="form-control">
                                                        <option value="0">Seleccione uno...</option>
                                                        <?php createVaccineOptions($results, $vaccine_consultation->id_vaccine); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div id="divbatch1" class="form-group">
                                                    <label for="batch2">Lote</label>
                                                    <input type="text" class="form-control" id="batch2" name="batch2" placeholder="Lote" maxlength="40" value="<?php echo get_string_value($vaccine_consultation->batch); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div id="divexpiration2 class="form-group">
                                                    <label for="expiration2">Fecha de expiraci&oacute;n</label>
                                                    <input type="text" class="form-control" id="expiration2" name="expiration2" placeholder="Expiraci&oacute;n" maxlength="40" value="<?php echo get_string_value($vaccine_consultation->expiration); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <?php include_once '../phpfragments/generaldatatreatment.php'; ?>
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
                        </form>
                    </div>
                </section>
            </aside>
        </div>
        <?php include_once './php/vaccine/required_field_dialogs.php'; ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/petcity.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../../js/paginas/historias/general_data.js" type="text/javascript"></script>
        <script src="../../js/paginas/historias/vacunaciones.js" type="text/javascript"></script>
    </body>
</html>
