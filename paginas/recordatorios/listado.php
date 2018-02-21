<?php
session_start();
include_once '../session.php';
include_once '../../php/notification.php';
include_once '../../php/errorlog.php';
include_once '../phpfragments/message_dialog.php';
include_once '../phpfragments/custom_date.php';
include_once './php/list/before_load.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Recordatorios</title>
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
                    <h1> Recordatorios </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="../../"><i class="fa fa-gears"></i> Pet City</a>
                        </li>
                        <li class="active">
                            <a href="#"> Recordatorios</a>
                        </li>
                    </ol>
                </section>
                <section class="content">
                    <?php include_once './php/list/after_crud_operation_messages.php'; ?>
                    <div class="row">
                        <div class="box">
                            <div class="box-body">
                                <div>
                                    <form action="editar.php" method="post" role="form">
                                        <button type="submit" id="new" name="new" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="box box-primary">
                            <div class="box-body table-responsive">
                                <table id="table-notes" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; width: 16%">T&iacute;tulo</th>
                                            <th style="text-align:center; width: 29%">Mensaje</th>
                                            <th style="text-align:center; width: 13%">Mascota</th>
                                            <th style="text-align:center; width: 16%">Propietario</th>
                                            <th style="text-align:center; width: 11%">Celular</th>
                                            <th style="text-align:center; width: 5%">Ver</th>
                                            <th style="text-align:center; width: 5%">Enviar</th>
                                            <th style="text-align:center; width: 5%">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include_once './php/list/list_to_table_rows.php'; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
    <script src="../../js/petcity.js" type="text/javascript"></script>
    <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
</html>