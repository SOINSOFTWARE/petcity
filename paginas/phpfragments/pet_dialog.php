<div id="pet_dialog" title="Mascotas y propietarios" style="display: none">
    <table id="tableData" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="text-align:center; width: 20%">Cedula</th>
                <th style="text-align:center; width: 40%">Propietario</th>
                <th style="text-align:center; width: 30%">Mascota</th>
                <th style="text-align:center; width: 10%">Seleccionar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../../php/pet.php';
            $pet = new PetTable();
            $results = $pet->select($companyId);
            while ($rows = mysqli_fetch_array($results)) {
                echo "<tr>";
                echo '<td>' . $rows["document"] . '</td>';
                echo '<td>' . $rows["ownername"] . ' ' . $rows["lastname"] . '</td>';
                echo '<td>' . $rows["petname"] . '</td>';
                echo '<td style="text-align:center"><button type="button" id="select" name="select" class="btn btn-info" onclick="selectPet(' . $rows["id"] . ',\'' . $rows["petname"] . '\',\'' . $rows["ownername"] . ' ' . $rows["lastname"] .'\');"><i class="fa fa-check"></i></button></td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function showPet() {
        showPetDialog($("#pet_dialog"));
    }

    function selectPet(idPet, petName, ownerFullName) {
        $("#id_pet").val(idPet);
        $("#pet_name").val(petName);
        $("#owner_full_name").val(ownerFullName);
        $("#pet_dialog").dialog("close");
    }

    function showPetDialog(divDialog) {
        divDialog.dialog({
            autoOpen: false,
            width: 800,
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