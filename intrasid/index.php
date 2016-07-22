<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//cargar la clase de sesion
include('model/sesion.class.php');
$sesion = new Sesion();
$sesion->iniciaSesion();
$sesion->cierraSesion();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SIT Soluciones Tasklist</title>

    <!-- Bootstrap core CSS -->
    <link href="view/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="view/css/signin.css" rel="stylesheet">

	<!-- Estilos personalizados de SIT Soluciones de Informatica y Telecomunicaciones Ltda. -->
    <link href="view/css/sit.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="view/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="view/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="view/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	
	<div  class="center-block text-center" >
		<img src="view/images/logo_con_nombre_transparente.png" border="0" />
	</div>
    <div class="container">

      <form class="form-signin" role="form" action="controller/valida.php" method="POST" >
        <h2 class="form-signin-heading">Ingresar</h2>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" name="pass" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recordarme
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block color-sit" type="submit">Entrar</button>
		<input type="hidden" name="ingresar" value="1">
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
