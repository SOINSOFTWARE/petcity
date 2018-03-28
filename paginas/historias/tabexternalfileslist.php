<div class="tab-pane" id="tab_8">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Archivos externos</h3>
                </div>
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-xs-4">
                            <form action="externalfiles.php" method="post" role="form">
                                <input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php
                                if (isset($idclinichistory)) {
                                    echo $idclinichistory;
                                }
                                ?>" />
                                <input type="hidden" id="idexternalfile" name="idexternalfile" value="<?php
                                if (isset($idexternalfile)) {
                                    echo $idexternalfile;
                                }
                                ?>" />
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Nuevo
                                </button>
                            </form>
                        </div>
                    </div>
                    <table id="tableData7" class="table table-bordered table-hover">
                        <thead>
                            <tr>								
                                <th style="text-align:center; width: 85%">Nombre</th>								
                                <th style="text-align:center; width: 5%">Ver</th>
                                <th style="text-align:center; width: 5%">Descargar</th>
                                <th style="text-align:center; width: 5%">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $results = $externalfilestable->select($idclinichistory);
                            while ($rows = mysqli_fetch_array($results)) {
                                echo "<tr>";
                                echo '<td>' . $rows["name"] . '</td>';
                                echo '<td style="text-align:center"><form action="externalfiles.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idexternalfile" name="idexternalfile" value="' . $rows["id"] . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
                                echo '<td style="text-align:center"><a href="' . $rows["filepath"] . '" class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a></td>';
                                echo '<td style="text-align:center"><form action="historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $idclinichistory . '" /><input type="hidden" id="idexternalfile" name="idexternalfile" value="' . $rows["id"] . '" /><button type="submit" id="deleteextfile" name="deleteextfile" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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