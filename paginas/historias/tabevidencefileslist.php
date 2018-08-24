<?php if (isset($id) && intval($id) > 0) { ?>
    <div class="tab-pane" id="tab_3">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Archivos de evidencias</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-xs-4">
                                <form action="evidencia.php" method="post" role="form">
                                    <input type="hidden" id="idclinichistory" name="idclinichistory" value="<?php echo get_numeric_value($id_clinic_history); ?>" />
                                    <input type="hidden" id="idconsultation" name="idconsultation" value="<?php echo get_numeric_value($medical_consultation->id); ?>"/>
                                    <input type="hidden" id="idevidencefile" name="idevidencefile" value="0" />
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Nuevo
                                    </button>
                                </form>
                            </div>
                        </div>
                        <table id="tableData8" class="table table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th style="text-align:center; width: 25%">Nombre</th>								
                                    <th style="text-align:center; width: 5%">Ver</th>
                                    <th style="text-align:center; width: 5%">Archivo</th>
                                    <th style="text-align:center; width: 5%">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $evidencefiles_array = $evidencefilestable->selectByMedicalConsultation($id);
                                foreach ($evidencefiles_array as $evidence_file) {
                                    echo "<tr>";
                                    echo '<td>' . $evidence_file->name . '</td>';
                                    echo '<td style="text-align:center"><form action="evidencia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . get_numeric_value($id_clinic_history) . '" /><input type="hidden" id="idconsultation" name="idconsultation" value="' . $evidence_file->id_medical_consultation . '" /><input type="hidden" id="idevidencefile" name="idevidencefile" value="' . $evidence_file->id . '" /><button type="submit" id="view" name="view" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
                                    echo '<td style="text-align:center"><a href="' . $rows["filepath"] . '" class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a></td>';
                                    echo '<td style="text-align:center"><form action="consulta.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . get_numeric_value($id_clinic_history) . '" /><input type="hidden" id="idconsultation" name="idconsultation" value="' . $evidence_file->id_medical_consultation . '" /><input type="hidden" id="idevidencefile" name="idevidencefile" value="' . $evidence_file->id . '" /><button type="submit" id="deleteevidence" name="deleteevidence" class="btn btn-danger"><i class="fa fa-times"></i></button></form></td>';
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
<?php } ?>
