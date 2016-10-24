<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Historia cl&iacute;nica</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="skin-blue">
        <?php include '../header.php'; ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <?php include '../user-panel.php'; ?>
                    <?php include 'menu.php'; ?>
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Historia cl&iacute;nica
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Pet City</a></li>
                        <li><a href="../../index.php">Historias cl&iacute;nicas</a></li>
                        <li class="active">Historia cl&iacute;nica</li>
                    </ol>
                </section>
                <section class="content">
                	<div class="row">
                		<div class="col-md-12">
                			<div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Datos b&aacute;sicos</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Consulta m&eacute;dica</a></li>
                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-table"></i></a></li>
                                </ul>
                                <div class="tab-content">
                                    <?php include 'tabbasicdata.php'; ?>
                                    <?php include 'tabmedicalconsultation.php'; ?>
                                </div>
                            </div>
                		</div>
                	</div>
                </section>
            </aside>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $("#datemask").inputmask("mm/yyyy", {"placeholder": "mm/yyyy"});
                $("[data-mask]").inputmask();
            });
        </script>
    </body>
</html>