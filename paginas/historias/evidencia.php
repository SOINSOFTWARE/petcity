<?php
session_start();
include_once '../session.php';
include_once './php/evidence_files/before_load.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Evidencias</title>
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
                    <h1> Archivos de Evidencias </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-medkit"></i> Pet City</a>
                        </li>
                        <li>
                            <a href="../../">Historias cl&iacute;nicas</a>
                        </li>
                        <li>
                            <a href="../../">Consulta</a>
                        </li>
                        <li class="active">Evidencias</li>
                    </ol>
                    <br/>
                    <?php include_once '../phpfragments/backward_button_consultation.php'; ?>
                </section>
                <section class="content">
                    <div class="row">
                        <form action="evidencia.php" method="post" role="form" onsubmit="return validate()" enctype="multipart/form-data">
                            <div class="col-xs-12">
                                <div class="box">
                                    <?php
                                    if (isset($saved)) {
                                        if ($saved) {
                                            echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> La evidencia ha sido guardado exitosamente.
</div>';
                                        } else {
                                            echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar guardar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
                                        }
                                    }
                                    ?>
                                    <div class="box-header">
                                        <h3 class="box-title">Archivos de evidencias</h3>
                                    </div>
                                    <div class="box-body">
                                        <button type="submit" id="save" name="save" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Guardar
                                        </button>
                                        <br />
                                        <br />
                                        <input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo get_numeric_value($id_clinic_history); ?>" />
                                        <input type="hidden" id="idconsultation" name="idconsultation" value="<?php echo get_numeric_value($evidence_file->id_medical_consultation); ?>" />
                                        <input type="hidden" id="id" name="id" value="<?php echo get_numeric_value($evidence_file->id); ?>"/>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label for="name">Nombre</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la evidencia" 
                                                           maxlength="100" value="<?php echo get_string_value($evidence_file->name); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <?php if (intval($evidence_file->id) > 0) { ?>
                                                        <label>Archivo adjunto</label><br />
                                                        <a href="<?php echo $evidence_file->file_path; ?>" class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>
                                                    <?php } else { ?>
                                                        <label for="fileToUpload">Adjuntar archivo</label>
                                                        <input type="file" id="fileToUpload" name="fileToUpload" onchange="validateFile()" required>
                                                        <p class="help-block">
                                                            Solo se permite adjuntar archivos con extensi&oacute;n pdf, png, jpg, jpeg.
                                                        </p>
                                                    <?php } ?>
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
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>La fecha del ex&aacute;men no es valida.
            </p>
        </div>
        <div id="extension-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Solo se permite adjuntar archivos con extensi&oacute;n pdf, png, jpg, jpeg.
            </p>
        </div>
        <div id="browser-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Su navegador no soporta est&aacute; funcionalidad.
            </p>
        </div>
        <div id="one-file-dialog" title="Error" style="display: none">
            <p>
                <span class="ui-icon ui-icon-cancel" style="float:left; margin:2px 7px 20px 0;"></span>Seleccione solo un archivo
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
                                                                $("#datemask").inputmask("mm/yyyy", {
                                                                    "placeholder": "mm/yyyy"
                                                                });
                                                                $("[data-mask]").inputmask();
                                                            });




                                                            function validateFile() {
                                                                var countFiles = document.getElementById("fileToUpload").files.length;
                                                                if (countFiles === 1) {
                                                                    if (typeof (FileReader) !== "undefined") {
                                                                        var imgPath = document.getElementById("fileToUpload").value;
                                                                        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                                        if (extn !== "pdf" && extn !== "png" && extn !== "jpg" && extn !== "jpeg") {
                                                                            showDivDialog($("#extension-dialog"));
                                                                            document.getElementById("fileToUpload").value = null;
                                                                            return false;
                                                                        }
                                                                    } else {
                                                                        showDivDialog($("#browser-dialog"));
                                                                    }
                                                                } else {
                                                                    showDivDialog($("#one-file-dialog"));
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
        </script>
    </body>
</html>