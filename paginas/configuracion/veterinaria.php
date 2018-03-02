<?php
session_start();
include_once '../session.php';
include_once '../phpfragments/message_dialog.php';
include_once '../../php/company.php';
include_once '../../php/entity/company.php';
include_once './php/company/before_load.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Veterinaria</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
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
                    <h1> Veterinaria </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-gears"></i> Pet City</a>
                        </li>
                        <li>
                            <a href="#"> Configuraci&oacute;n</a>
                        </li>
                        <li class="active"> Veterinaria</li>
                    </ol>
                </section>
                <section class="content">
                    <?php include_once './php/company/after_crud_operation_messages.php'; ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="veterinaria.php" method="post" role="form" enctype="multipart/form-data" onsubmit="return validate();">
                                <div class="box">
                                    <div class="box-body">                                    
                                        <input type="hidden" class="form-control" id="recordid" name="recordid" value="<?php echo $veterinary->getId(); ?>">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <?php
                                                    if ($veterinary->getPhoto() !== NULL && $veterinary->getPhoto() !== '') {
                                                        echo '<div>';
                                                        echo '<img src="';
                                                        echo $veterinary->getPhoto();
                                                        echo '" class="img-rounded" alt="logo veterinaria" width="250px" />';
                                                        echo '</div>';
                                                        echo '<label for="photo_file">Cambiar Logo</label>';
                                                    } else {
                                                        echo '<label for="photo_file">Adjuntar Logo</label>';
                                                    }
                                                    echo '<input type="file" id="photo_file" name="photo_file" onchange="validateFile()">';
                                                    echo '<p class="help-block">Solo se permite adjuntar archivos con extensi&oacute;n png, jpg, jpeg</p>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label for="document">NIT</label>
                                                    <input type="text" class="form-control" id="document" name="document" value="<?php echo $veterinary->getDocument(); ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">N&uacute;mero de historia inicial</label>
                                                    <input type="number" class="form-control" id="initialcustomid" name="initialcustomid" value="<?php echo $veterinary->getInitialCustomId(); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label for="name">Nombre</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $veterinary->getName(); ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">N&uacute;mero de historia actual</label>
                                                    <input type="number" class="form-control" id="actualcustomid" name="actualcustomid" value="<?php echo $veterinary->getActualCustomId(); ?>">
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
                        </div>
                    </div>
                </section>
            </aside>
        </div>
        <?php
        load_prompt_dialog('actual-custom-dialog', 'Error', 'Solo se permite ingresar el n&uacute;mero de historia actual si se registra el inicial.');
        load_prompt_dialog('initial-custom-dialog', 'Error', 'El n&uacute;mero de historia actual debe ser mayor o igual al inicial.');
        load_prompt_dialog('extension-dialog', 'Error', 'Solo se permite adjuntar archivos con extensi&oacute;n png, jpg, jpeg.');
        load_prompt_dialog('browser-dialog', 'Error', 'Su navegador no soporta est&aacute; funcionalidad.');
        load_prompt_dialog('one-file-dialog', 'Error', 'Seleccione solo un archivo');
        ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/petcity.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#initialcustomid").keydown(function (e) {
                    validateIntegerInput(e);
                });
            });
            $(document).ready(function () {
                $("#actualcustomid").keydown(function (e) {
                    validateIntegerInput(e);
                });
            });
            function validate() {
                if ($("#actualcustomid").val() !== '' && $("#initialcustomid").val() === '') {
                    showErrorDialog($("#actual-custom-dialog"));
                    return false;
                } else if ($("#actualcustomid").val() !== '' && $("#initialcustomid").val() !== '') {
                    if (parseInt($("#actualcustomid").val()) < parseInt($("#initialcustomid").val())) {
                        showErrorDialog($("#initial-custom-dialog"));
                        return false;
                    }
                }
            }
            function validateFile() {
                var countFiles = document.getElementById("photo_file").files.length;
                if (countFiles === 1) {
                    if (typeof (FileReader) !== "undefined") {
                        var imgPath = document.getElementById("photo_file").value;
                        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                        if (extn !== "png" && extn !== "jpg" && extn !== "jpeg") {
                            showErrorDialog($("#extension-dialog"));
                            document.getElementById("photo_file").value = null;
                            return false;
                        }
                    } else {
                        showErrorDialog($("#browser-dialog"));
                    }
                } else {
                    showErrorDialog($("#one-file-dialog"));
                }
            }
            function showErrorDialog(divDialog) {
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
