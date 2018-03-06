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
                                        <?php if (isset($_POST['idclinichistory'])) {
                                            ?>
                                            <input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo $_POST['idclinichistory']; ?>" />
                                        <?php } ?>
                                        <input type="hidden" id="idvaccineconsultation" name="idvaccineconsultation" value="<?php
                                        if (isset($id)) {
                                            echo $id;
                                        } else {
                                            0;
                                        }
                                        ?>"/>
                                        <input type="hidden" id="idgeneraldata" name="idgeneraldata" value="<?php
                                        if (isset($idgeneraldata)) {
                                            echo $idgeneraldata;
                                        } else {
                                            0;
                                        }
                                        ?>">
                                        <input type="hidden" id="idpet" name="idpet" value="<?php
                                        if (isset($idpet)) {
                                            echo $idpet;
                                        }
                                        ?>"/>
                                               <?php
                                               include_once '../phpfragments/generaldata.php';
                                               ?>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label for="anamnesis">Anamnesis</label>
                                                    <textarea class="form-control" id="anamnesis" name="anamnesis" rows="5" maxlength="400" required><?php
                                                        if (isset($anamnesis)) {
                                                            echo $anamnesis;
                                                        }
                                                        ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label for="findings">Hallazgos</label>
                                                    <textarea class="form-control" id="findings" name="findings" rows="5" maxlength="400" required><?php
                                                        if (isset($findings)) {
                                                            echo $findings;
                                                        }
                                                        ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="checkbox">
                                                    <label> &iquest;Apta para vacunaci&oacute;n?
                                                        <input type="checkbox" id="vaccineapplication" name="vaccineapplication"
                                                        <?php
                                                        if (isset($vaccineapplication) && ($vaccineapplication || $vaccineapplication === TRUE)) {
                                                            echo "checked";
                                                        }
                                                        ?>
                                                               />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="divvaccinedata" class="row" style="display: <?php
                                        if (isset($vaccineapplication) && ($vaccineapplication || $vaccineapplication === TRUE)) {
                                            echo 'block;';
                                        } else {
                                            echo 'none;';
                                        }
                                        ?>">
                                            <div class="col-xs-4">
                                                <div id="divvaccine" class="form-group">
                                                    <label for="vaccine">Vacuna aplicada</label>
                                                    <select id="vaccine" name="vaccine" class="form-control">
                                                        <option value="0">Seleccione uno...</option>
                                                        <?php createVaccineOptions($results, $vaccine); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div id="divbatch" class="form-group">
                                                    <label for="batch">Lote</label>
                                                    <input type="text" class="form-control" id="batch" name="batch" placeholder="Lote" maxlength="40" value="<?php
                                                    if (isset($batch)) {
                                                        echo $batch;
                                                    }
                                                    ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div id="divexpiration" class="form-group">
                                                    <label for="expiration">Fecha de expiraci&oacute;n</label>
                                                    <input type="text" class="form-control" id="expiration" name="expiration" placeholder="Expiraci&oacute;n" maxlength="40" value="<?php
                                                    if (isset($expiration)) {
                                                        echo $expiration;
                                                    }
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        include_once '../phpfragments/generaldatatreatment.php';
                                        ?>
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
        <div id="date-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha de la vacunaci&oacute;n no es valida.
            </p>
        </div>
        <div id="weight-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique el peso de la mascota.
            </p>
        </div>
        <div id="heartrate-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique la frecuencia cardiaca de la mascota.
            </p>
        </div>
        <div id="breathingfrequency-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique la frecuencia respiratoria de la mascota.
            </p>
        </div>
        <div id="temperature-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique la temperatura de la mascota.
            </p>
        </div>
        <div id="vaccine-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Seleccione un producto de vacunaci&oacute;n.
            </p>
        </div>
        <div id="batch-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique el lote del producto de vacunaci&oacute;n.
            </p>
        </div>
        <div id="expiration-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Indique la fecha de expiraci&oacute;n del producto de vacunaci&oacute;n.
            </p>
        </div>
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
        <script type="text/javascript">
                            $(function () {
                                $('#generaldatadate').datepicker({
                                    dateFormat: 'dd/mm/yy',
                                    autoclose: true
                                });
                            });
                            $(document).ready(function () {
                                $("#generaldatadate").keydown(function (e) {
                                    return false;
                                });
                            });

                            $('#vaccineapplication').on("ifChecked", function (event) {
                                changeVisibility($('#divvaccinedata'), "block");
                            });

                            $("#vaccineapplication").on("ifUnchecked", function (event) {
                                changeVisibility($('#divvaccinedata'), "none");
                                $('#vaccine').val('0');
                                $('#batch').val('');
                                $('#expiration').val('');
                            });

                            function changeVisibility(input, displayVal) {
                                input.css("display", displayVal);
                            }

                            function validate() {
                                if ($.trim($('#generaldatadate').val()) === '') {
                                    $("#divgeneraldatadate").addClass("has-error");
                                    showDivDialog($("#date-dialog"));
                                    return false;
                                } else {
                                    $("#divgeneraldatadate").removeClass("has-error");
                                }
                                if ($.trim($('#weight').val()) === '0' || $.trim($('#weight').val()) === '') {
                                    $("#divweight").addClass("has-error");
                                    showDivDialog($("#weight-dialog"));
                                    return false;
                                } else {
                                    $("#divweight").removeClass("has-error");
                                }
                                if ($.trim($('#heartrate').val()) === '0' || $.trim($('#heartrate').val()) === '') {
                                    $("#divheartrate").addClass("has-error");
                                    showDivDialog($("#heartrate-dialog"));
                                    return false;
                                } else {
                                    $("#divheartrate").removeClass("has-error");
                                }
                                if ($.trim($('#breathingfrequency').val()) === '0' || $.trim($('#breathingfrequency').val()) === '') {
                                    $("#divbreathingfrequency").addClass("has-error");
                                    showDivDialog($("#breathingfrequency-dialog"));
                                    return false;
                                } else {
                                    $("#divbreathingfrequency").removeClass("has-error");
                                }
                                if ($.trim($('#temperature').val()) === '0' || $.trim($('#temperature').val()) === '') {
                                    $("#divtemperature").addClass("has-error");
                                    showDivDialog($("#temperature-dialog"));
                                    return false;
                                } else {
                                    $("#divtemperature").removeClass("has-error");
                                }
                                if ($('#vaccineapplication').is(":checked")) {
                                    if ($.trim($('#vaccine').val()) === '0') {
                                        $("#divvaccine").addClass("has-error");
                                        showDivDialog($("#vaccine-dialog"));
                                        return false;
                                    } else {
                                        $("#divvaccine").removeClass("has-error");
                                    }
                                    if ($.trim($('#batch').val()) === '') {
                                        $("#divbatch").addClass("has-error");
                                        showDivDialog($("#batch-dialog"));
                                        return false;
                                    } else {
                                        $("#divbatch").removeClass("has-error");
                                    }
                                    if ($.trim($('#expiration').val()) === '' || !validateDate($('#expiration').val())) {
                                        $("#divexpiration").addClass("has-error");
                                        showDivDialog($("#expiration-dialog"));
                                        return false;
                                    } else {
                                        $("#divexpiration").removeClass("has-error");
                                    }
                                }
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

                            $(document).ready(function () {
                                $("#weight").keydown(function (e) {
                                    validateDecimalInput(e);
                                });
                            });

                            $(document).ready(function () {
                                $("#heartrate").keydown(function (e) {
                                    validateIntegerInput(e);
                                });
                            });

                            $(document).ready(function () {
                                $("#breathingfrequency").keydown(function (e) {
                                    validateIntegerInput(e);
                                });
                            });

                            $(document).ready(function () {
                                $("#temperature").keydown(function (e) {
                                    validateDecimalInput(e);
                                });
                            });

                            $(document).ready(function () {
                                $("#trc").keydown(function (e) {
                                    validateIntegerInput(e);
                                });
                            });

                            $(document).ready(function () {
                                $("#dh").keydown(function (e) {
                                    validateIntegerInput(e);
                                });
                            });

                            $(document).ready(function () {
                                $("#formulanumber").keydown(function (e) {
                                    validateIntegerInput(e);
                                });
                            });
        </script>
    </body>
</html>
