<?php
session_start();
include_once '../session.php';
include_once '../../php/clinichistory.php';
include_once '../../php/generaldata.php';
include_once '../../php/medicalconsultation.php';
include_once '../../php/medicalcontrol.php';
include_once '../../php/medicalexam.php';
include_once '../../php/notification.php';
include_once '../../php/evidencefiles.php';
include_once '../../php/errorlog.php';
include_once '../../php/entity/medicalconsultation.php';
include_once '../../php/entity/notification.php';
include_once '../phpfragments/custom_date.php';
include_once '../phpfragments/message_dialog.php';
include_once './php/consultation/before_load.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Consulta m&eacute;dica</title>
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
                    <h1> Consulta m&eacute;dica </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-medkit"></i> Pet City</a>
                        </li>
                        <li>
                            <a href="../../">Historias cl&iacute;nicas</a>
                        </li>
                        <li class="active">
                            Consulta m&eacute;dica
                        </li>
                    </ol>
                    <br/>
                    <?php include_once '../phpfragments/backward_button.php'; ?>
                </section>
                <section class="content">
                    <?php include_once './php/consultation/after_crud_operation_messages.php'; ?>
                    <form action="consulta.php" method="post" role="form" onsubmit="return validate()">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="box">
                                            <input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo get_numeric_value($id_clinic_history); ?>" />
                                            <input type="hidden" id="id" name="id" value="<?php echo get_numeric_value($medical_consultation->id); ?>"/>
                                            <input type="hidden" id="idgeneraldata" name="idgeneraldata" value="<?php echo get_numeric_value($general_data->id); ?>">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="form-group">
                                                        <label for="motive">Motivo</label>
                                                        <textarea class="form-control" id="motive" name="motive" rows="4" maxlength="900" placeholder="&iquest;Cu&aacute;l es el motivo de la consulta?" required><?php echo get_string_value($medical_consultation->motive); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            include_once '../phpfragments/generaldata.php';
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="anamnesis">Anamnesis</label>
                                                        <textarea class="form-control" id="anamnesis" name="anamnesis" rows="5" maxlength="900" required><?php echo get_string_value($general_data->anamnesis); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="findings">Hallazgos</label>
                                                        <textarea class="form-control" id="findings" name="findings" rows="5" maxlength="500" required><?php echo get_string_value($general_data->findings); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="presumptivediagnosis">Diagn&oacute;stico presuntivo</label>
                                                        <textarea class="form-control" id="presumptivediagnosis" name="presumptivediagnosis" rows="4" maxlength="400"><?php echo get_string_value($medical_consultation->presumptive_diagnosis); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="differentialdiagnosis">Diagn&oacute;stico diferencial</label>
                                                        <textarea class="form-control" id="differentialdiagnosis" name="differentialdiagnosis" rows="4" maxlength="400"><?php echo get_string_value($medical_consultation->differential_diagnosis); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label for="diagnosisrecomendations">Recomendaciones (Ayuda diagn&oacute;stico)</label>
                                                        <textarea class="form-control" id="diagnosisrecomendations" name="diagnosisrecomendations" rows="4" maxlength="400"><?php echo get_string_value($medical_consultation->diagnosis_recomendations); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label for="diagnosissamples">Muestras tomadas (Ayuda diagn&oacute;stico)</label>
                                                        <textarea class="form-control" id="diagnosissamples" name="diagnosissamples" rows="4" maxlength="400"><?php echo get_string_value($medical_consultation->diagnosis_samples); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label for="diagnosisexams">Examenes a practicar (Ayuda diagn&oacute;stico)</label>
                                                        <textarea class="form-control" id="diagnosisexams" name="diagnosisexams" rows="4" maxlength="400"><?php echo get_string_value($medical_consultation->diagnosis_exams); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            include_once '../phpfragments/generaldatatreatment.php';
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label for="definitivediagnosis">Diagn&oacute;stico definitivo</label>
                                                        <textarea class="form-control" id="definitivediagnosis" name="definitivediagnosis" rows="4" maxlength="400"><?php echo get_string_value($medical_consultation->definitive_diagnosis); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label for="forecast">Pron&oacute;stico</label>
                                                        <textarea class="form-control" id="forecast" name="forecast" rows="4" maxlength="400"><?php echo get_string_value($medical_consultation->forecast); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div id="divnextdate" class="form-group">
                                                        <label for="nextdate">Pr&oacute;ximo control</label>
                                                        <div class="input-group date input-group-sm">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" class="form-control pull-right" id="nextdate" name="nextdate" 
                                                                   value="<?php echo format_string_date(get_string_value($medical_consultation->next_date), "d/m/Y"); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <button type="submit" id="save" name="save" class="btn btn-primary pull-right"> 
                                                <i class="fa fa-save"></i> Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php if (isset($id) && intval($id) > 0) {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1" data-toggle="tab">Controles</a>
                                        </li>
                                        <li>
                                            <a href="#tab_2" data-toggle="tab">Ex&aacute;menes</a>
                                        </li>
                                        <li>
                                            <a href="#tab_3" data-toggle="tab">Evidencias</a>
                                        </li>
                                        <li class="pull-right">
                                            <a href="#" class="text-muted"><i class="fa fa-table"></i></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <?php
                                        include_once 'tabmedcontrollist.php';
                                        include_once 'tabmedexamlist.php';
                                        include_once 'tabevidencefileslist.php';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </section>
            </aside>
        </div>
        <?php include_once './php/consultation/required_field_dialogs.php'; ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="../../js/petcity.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../../js/paginas/historias/general_data.js" type="text/javascript"></script>
        <script src="../../js/paginas/historias/consultas.js" type="text/javascript"></script>
        <script type="text/javascript">
                        $(function () {
                            $('#generaldatadate').datepicker({
                                dateFormat: 'dd/mm/yy',
                                autoclose: true
                            });
                            $('#nextdate').datepicker({
                                dateFormat: 'dd/mm/yy',
                                autoclose: true
                            });
                        });
                        $(document).ready(function () {
                            $("#generaldatadate").keydown(function (e) {
                                return false;
                            });
                        });
                        $(document).ready(function () {
                            $("#nextdate").keydown(function (e) {
                                if ($.inArray(e.keyCode, [8, 46]) !== -1) {
                                    return true;
                                } else {
                                    return false;
                                }
                            });
                        });
                        function changeVisibility(input, displayVal) {
                            input.css("display", displayVal);
                        }

                        function validate() {
                            if (!validateDate($('#generaldatadate').val())) {
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
                            if ($.trim($('#nextdate').val()) !== '' && !validateDate($('#nextdate').val())) {
                                $("#divnextdate").addClass("has-error");
                                showDivDialog($("#nextdate-dialog"));
                                return false;
                            } else {
                                $("#divnextdate").removeClass("has-error");
                            }
                        }

                        function validateDate(date) {
                            var dateWithoutSpace = $.trim(date);
                            var array = dateWithoutSpace.split("/");
                            var arrayDay = array[0].split("");
                            var arrayMonth = array[1].split("");
                            var arrayYear = array[2].split("");
                            return arrayDay[0] !== 'd' && arrayDay[1] !== 'd' && arrayMonth[0] !== 'm' && arrayMonth[1] !== 'm' && arrayYear[0] !== 'y' && arrayYear[1] !== 'y' && arrayYear[2] !== 'y' && arrayYear[3] !== 'y';
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
