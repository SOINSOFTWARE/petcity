<?php
session_start();
include_once '../session.php';
include_once '../../php/pettype.php';
include_once '../phpfragments/message_dialog.php';
include_once './php/pet_type/before_load.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Especies</title>
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
                    <h1> Especies </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-gears"></i> Pet City</a>
                        </li>
                        <li>
                            <a href="#"> Configuraci&oacute;n</a>
                        </li>
                        <li class="active">
                            Especies
                        </li>
                    </ol>
                </section>
                <section class="content">
                    <?php include_once './php/pet_type/after_crud_operation_messages.php'; ?>
                    <div class="row">
                        <form action="tipo.php" method="post" role="form" onsubmit="return validate()">
                            <div class="col-xs-5">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Nueva especie</h3>
                                    </div>
                                    <div class="box-body">
                                        <button type="submit" name="new" name="new" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Guardar
                                        </button>
                                        <br />
                                        <br />
                                        <div id="divname" class="form-group">
                                            <label for="newname">Nombre</label>
                                            <input type="text" class="form-control" id="newname" name="newname" placeholder="Caninos..." maxlength="100" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Listado de especies</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box">
                                                <br />
                                                <div class="box-body table-responsive">
                                                    <table id="tableData" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center; width: 80%">Nombre</th>
                                                                <th style="text-align:center; width: 20%">Eliminar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php include_once './php/pet_type/list_to_table_rows.php'; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
        <?php load_prompt_dialog('name-dialog', 'Valores requeridos', 'El nombre de la especie es requerido.') ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/petcity.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script type="text/javascript">
                            $("#formupdate").contents().find(":checkbox").bind('change', function () {
                                val = this.checked;
                                alert("changed");
                            });
                            function validate() {
                                if ($.trim($("#newname").val()) === '') {
                                    $("#divname").addClass("has-error");
                                    showRequiredDialog($("#name-dialog"));
                                    return false;
                                }
                            }
                            function showRequiredDialog(divDialog) {
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