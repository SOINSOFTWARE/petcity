<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Pet City | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">Inicio de sesi&oacute;n</div>
            <form action="index.html" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" id="userid" name="userid" class="form-control" placeholder="Usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a"/>
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Ingresar</button>                    
                    <p><a href="#" class="text-center">Olvide mi contrase&ntilde;a</a></p>
                	<a href="register.php" class="text-center">Nuevo usuario</a>
                </div>
            </form>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>