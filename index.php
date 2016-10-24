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
        <?php include 'header.php'; ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <?php include 'user-panel.php'; ?>
                    <?php include 'menu.php'; ?>
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Historias cl&iacute;nicas
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Pet City</a></li>
                        <li class="active">Historias cl&iacute;nicas</li>
                    </ol>
                </section>
                <section class="content">
            		<div class="row">
						<div class="col-xs-12">
                            <div class="box">
                        		<div class="box-body">
	                            	<form method="post" role="form">
		                                <button type="submit" name="submit" name="submit" class="btn btn-primary">
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
                                                <th>Mascota</th>
                                                <th># Documento</th>
                                                <th>Propietario</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
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