<?php
session_start();
include_once '../session.php';
include_once '../../php/notification.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/custom_date.php';
include_once '../phpfragments/message_dialog.php';
include_once './php/edit/before_load.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Eventos</title>
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
                    <h1> Evento </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="../../"><i class="fa fa-medkit"></i> Pet City</a>
                        </li>
                        <li>
                            <a href="./listado.php"> Eventos</a>
                        </li>
                        <li class="active">
                            Editar
                        </li>
                    </ol>
                </section>
                <section class="content">
                    <?php include_once './php/edit/after_crud_operation_messages.php'; ?>
                    <div class="row">
                        <form action="editar.php" method="post" role="form" onsubmit="return validate()">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-body">
                                        <button type="submit" class="btn btn-primary"
                                                id="<?php if ($id == 0) { echo 'new'; } else { echo 'update'; } ?>"
                                                name="<?php if ($id == 0) { echo 'new'; } else { echo 'update'; } ?>">
                                            <i class="fa fa-save"></i> Guardar
                                        </button>
                                        <br />
                                        <br />
                                        <input type="hidden" id="id_record" name="id_record" value="<?php
                                        if (isset($id)) {
                                            echo $id;
                                        } else {
                                            '0';
                                        }
                                        ?>">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div id="divnotificationdate" class="form-group">
                                                    <label for="notification_date">Fecha:</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="notification_date" name="notification_date" value="<?php
                                                        if (isset($notification_date)) {
                                                            echo $notification_date;
                                                        }
                                                        ?>" required />
                                                    </div>
                                                </div>
                                                <div id="divpetsearch" class="form-group">
                                                    <button type="button" id="pet_search" name="pet_search" class="btn btn-warning" onclick="showPet();">
                                                        <i class="fa fa-search"></i> Seleccionar Mascota
                                                    </button>
                                                </div>
                                                <div id="divpetname" class="form-group">
                                                    <input type="hidden" id="id_pet" name="id_pet" value="<?php
                                                    if (isset($id_pet)) {
                                                        echo $id_pet;
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?>" />
                                                    <label for="pet_name">Mascota</label>
                                                    <input type="text" class="form-control" id="pet_name" name="pet_name" placeholder="Mascota" value="<?php
                                                    if (isset($pet_name)) {
                                                        echo $pet_name;
                                                    }
                                                    ?>" readonly />
                                                </div>
                                                <div id="divownername" class="form-group">
                                                    <label for="owner_full_name">Propietario</label>
                                                    <input type="text" class="form-control" id="owner_full_name" name="owner_full_name" placeholder="Propietario" value="<?php
                                                    if (isset($owner_full_name)) {
                                                        echo $owner_full_name;
                                                    }
                                                    ?>" readonly />
                                                </div>
                                                <div id="divtitle" class="form-group">
                                                    <label for="title">T&iacute;tulo</label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="T&iacute;tulo" maxlength="60" value="<?php
                                                    if (isset($title)) {
                                                        echo $title;
                                                    }
                                                    ?>" required>
                                                </div>
                                                <div id="divmessage" class="form-group">
                                                    <label for="name">Mensaje</label>
                                                    <br/>
                                                    <textarea class="form-control" id="message" name="message" rows="6" maxlength="400" placeholder="Mensaje" required><?php
                                                        if (isset($message)) {
                                                            echo $message;
                                                        }
                                                        ?></textarea>
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
        <?php
        include_once '../phpfragments/pet_dialog.php';
        load_prompt_dialog('notificationdate-dialog', 'Valores requeridos', 'La fecha de la notificaci&oacute;n es requerida.');
        load_prompt_dialog('title-dialog', 'Valores requeridos', 'El t&iacute;tulo de la notificaci&oacute;n es requerido.');
        load_prompt_dialog('message-dialog', 'Valores requeridos', 'El mensaje de la notificaci&oacute;n es requerido.');
        load_prompt_dialog('pet-dialog', 'Valores requeridos', 'Seleccione la mascota y propietario.');
        ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/petcity.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script type="text/javascript">
                                                        $(function () {
                                                            $('#notification_date').datepicker({
                                                                dateFormat: 'dd/mm/yy',
                                                                autoclose: true
                                                            });
                                                        });

                                                        $(document).ready(function () {
                                                            $("#notification_date").keydown(function (e) {
                                                                return false;
                                                            });
                                                        });

                                                        function validate() {
                                                            if ($.trim($('#notification_date').val()) === '') {
                                                                $("#divnotificationdate").addClass("has-error");
                                                                showRequiredDialog($("#notificationdate-dialog"));
                                                                return false;
                                                            } else {
                                                                $("#divnotificationdate").removeClass("has-error");
                                                            }
                                                            if ($.trim($('#id_pet').val()) === '0') {
                                                                $("#divpetsearch").addClass("has-error");
                                                                showRequiredDialog($("#pet-dialog"));
                                                                return false;
                                                            } else {
                                                                $("#divpetsearch").removeClass("has-error");
                                                            }
                                                            if ($.trim($('#title').val()) === '') {
                                                                $("#divtitle").addClass("has-error");
                                                                showRequiredDialog($("#title-dialog"));
                                                                return false;
                                                            } else {
                                                                $("#divtitle").removeClass("has-error");
                                                            }
                                                            if ($.trim($('#message').val()) === '') {
                                                                $("#divmessage").addClass("has-error");
                                                                showRequiredDialog($("#message-dialog"));
                                                                return false;
                                                            } else {
                                                                $("#divmessage").removeClass("has-error");
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