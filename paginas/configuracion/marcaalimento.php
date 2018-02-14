<?php
session_start();
include_once '../session.php';
include_once '../../php/foodbrand.php';

$foodBrand = new FoodBrandTable();
if (isset($_POST['new'])) {
    $name = $_POST['name'];
    $saved = $foodBrand->insert($name, $companyId);
    if ($saved === FALSE) {
        $errorLog = new ErrorLogTable();
        $errorLog->insert($foodBrand->getError());
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['idtable'];
    $name = $_POST['name'];
    $updated = $foodBrand->update($id, $name);
    if ($updated === FALSE) {
        $errorLog = new ErrorLogTable();
        $errorLog->insert($foodBrand->getError());
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['idtable'];
    $deleted = $foodBrand->delete($id);
    if ($deleted === FALSE) {
        $errorLog = new ErrorLogTable();
        $errorLog->insert($foodBrand->getError());
    }
}
$results = $foodBrand->select($companyId);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Marca alimento</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                    ?>
                    <?php
                    include 'menu.php';
                    ?>
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1> Marca alimento de mascotas </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-gears"></i> Pet City</a>
                        </li>
                        <li>
                            <a href="#"> Configuraci&oacute;n</a>
                        </li>
                        <li class="active">
                            Marca alimento de mascotas
                        </li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Listado de marcas</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box">
                                                <br />
                                                <?php
                                                if (isset($updated)) {
                                                    if ($updated) {
                                                        echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Dato actualizado!</b> La marca de alimento ha sido actualizada.
</div>';
                                                    } else {
                                                        echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar actualizar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
                                                    }
                                                }
                                                if (isset($deleted)) {
                                                    if ($deleted) {
                                                        echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Dato eliminado!</b> La marca de alimento ha sido eliminada.
</div>';
                                                    } else {
                                                        echo '<div class="alert alert-danger alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Error!</b> Ocurri&oacute; un error al intentar eliminar los datos, contacte a Soin Software (3007200405 - 4620915 en Bogot&aacute;).
</div>';
                                                    }
                                                }
                                                ?>
                                                <div class="box-body table-responsive">
                                                    <table id="tableData" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center; width: 30%">Nombre</th>
                                                                <th style="text-align:center; width: 50%">Actualizaci&oacute;n</th>
                                                                <th style="text-align:center; width: 20%">Eliminar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            while ($rows = mysqli_fetch_array($results)) {
                                                                echo "<tr>";
                                                                echo '<td>' . $rows["name"] . '</td>';
                                                                if (is_null($rows["idcompany"])) {
                                                                    echo "<td></td><td></td>";
                                                                } else {
                                                                    echo '<td><form action="marcaalimento.php" method="post" role="form"><input type="hidden" id="idtable" name="idtable" value="' . $rows["id"] . '" /><div class="input-group input-group-sm"><input type="text" class="form-control" id="name" name="name" maxlength="100" required /><span class="input-group-btn"><button type="submit" id="update" name="update" class="btn btn-success"><i class="fa fa-edit"></i></button></span></div></form></td>';
                                                                    echo '<td style="text-align:center"><form action="marcaalimento.php" method="post" role="form"><input type="hidden" id="idtable" name="idtable" value="' . $rows["id"] . '" /><button type="submit" id="delete" name="delete" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
                                                                }
                                                                echo "</tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="marcaalimento.php" method="post" role="form">
                            <div class="col-xs-5">
                                <div class="box">
                                    <?php
                                    if (isset($saved)) {
                                        if ($saved) {
                                            echo '<div class="alert alert-success alert-dismissable">
<i class="fa fa-times"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<b>Datos guardados!</b> Una nueva marca de alimento ha sido creada.
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
                                        <h3 class="box-title">Nueva marca</h3>
                                    </div>
                                    <div class="box-body">
                                        <button type="submit" id="new" name="new" class="btn btn-primary">
                                            <i class="fa fa-save"></i>
                                        </button>
                                        <br />
                                        <br />
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Pedigree, Dog Chow, Ladrina..." maxlength="100" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </aside>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/petcity.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    </body>
</html>