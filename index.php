<?php session_start();
include_once 'session.php';
include_once 'php/clinichistory.php';

$clinichistory = new ClinicHistoryTable();
$results = $clinichistory -> select($companyId);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pet City | Historias cl&iacute;nicas</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="skin-blue">
		<?php
		include 'header.php';
		?>
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<aside class="left-side sidebar-offcanvas">
				<section class="sidebar">
					<?php
					include 'user-panel.php';
                                        include 'menu.php';
					?>
				</section>
			</aside>
			<aside class="right-side">
				<section class="content-header">
					<h1> Historias cl&iacute;nicas </h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-medkit"></i> Pet City</a>
						</li>
						<li class="active">
							Historias cl&iacute;nicas
						</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<form action="paginas/historias/datosbasicos.php" method="post" role="form">
										<button type="submit" id="submit" name="submit" class="btn btn-primary">
											<i class="fa fa-plus"></i>
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="box box-primary">
								<div class="box-body table-responsive">
									<table id="tableData" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="text-align:center; width: 10%">Mascota</th>
												<th style="text-align:center; width: 15%">Especie</th>
												<th style="text-align:center; width: 20%">Raza</th>
												<th style="text-align:center; width: 10%">Documento</th>
												<th style="text-align:center; width: 25%">Propietario</th>
												<th style="text-align:center; width: 10%">Celular</th>
												<th style="text-align:center; width: 10%">Ver</th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($rows = mysqli_fetch_array($results)) {
												echo "<tr>";
												echo '<td>' . $rows["petname"] . '</td>';
												echo '<td>' . $rows["pettypename"] . '</td>';
												echo '<td>' . $rows["breedname"] . '</td>';
												echo '<td>' . $rows["document"] . '</td>';
												echo '<td>' . $rows["ownername"] . ' ' . $rows["lastname"] . '</td>';
												echo '<td>' . $rows["phone2"] . '</td>';
												echo '<td style="text-align:center"><form action="paginas/historias/historia.php" method="post" role="form"><input type="hidden" id="idclinichistory" name="idclinichistory" value="' . $rows["id"] . '" /><button type="submit" id="history" name="history" class="btn btn-warning"><i class="fa fa-folder-open-o"></i></button></form></td>';
												echo "</tr>";
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</section>
			</aside>
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="js/petcity.js" type="text/javascript"></script>
		<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
		<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	</body>
</html>
