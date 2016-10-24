<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pet City | </title>
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
                        Titulo
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Pet City</a></li>
                        <li class="active">Menu</li>
                    </ol>
                </section>
                <section class="content">
                </section>
            </aside>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>