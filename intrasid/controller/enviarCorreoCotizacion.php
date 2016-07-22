<?php
include('../model/conn.php');
include('../model/config.php');
include('../model/cotizacion.class.php');
$oCotizacion= new Cotizacion();
$idCotizacion = intval($_GET['idCotizacion']);
// Varios destinatarios
$para  = $oCotizacion->getCorreo($db,$idCotizacion );


// título
$titulo = 'Cotizacion TV satelital';

// mensaje
$mensaje = "<html>
<head>
  <title>Cotizacion TV satelital</title>
</head>
<body style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif;'>";

//LOGO
$mensaje .= "<table width='600' style='border: 1px solid #48335A;'>"
  . "<tr><td><img src='http://sitsoluciones.cl/sub/decos/img/decodificadores-satelitales-logo-1462467218.jpg' /></td></tr>";
$mensaje .= "</table><br/>";

$mensaje .= "<table width='600' style='border-collapse: collapse;
    border: 1px solid #BCE8F1;
    padding: 10px 15px;'>"
  . "<tr><th style='color: #31708F;"
  . "               background-color: #D9EDF7;"
  . "               ' >Cotizaci&oacute;n No. ".$idCotizacion." Fecha: ".$oCotizacion->getFecha($db,$idCotizacion )."</th></tr>"
  . "<tr><td>Cliente: ".$oCotizacion->getNombreApellido($db,$idCotizacion)."</td></tr>"
  . "</table><br/>";

//PRODUCTOS
$mensaje .= "<table width='600' style='border-collapse: collapse;
    border: 1px solid #BCE8F1;
    padding: 10px 15px;'>"
  . "<tr><th colspan='2' style='color: #31708F;"
  . "               background-color: #D9EDF7;"
  . "               '>Productos y Materiales</th></tr>";
$data = $oCotizacion->getProductos($db,$idCotizacion);
foreach($data as $value){
    $mensaje .= "<tr><td>".$value['nombreCategoria']." - ".$value['nombreProducto']."</td>"
        . "<td>".$value['cantidad']."</td></tr>";           
} 
$mensaje .= "</table><br/>";

//SERVICIOS
$data = $oCotizacion->getServicios($db,$idCotizacion);
if($data){
    $mensaje .= "<table width='600' style='border-collapse: collapse;
        border: 1px solid #BCE8F1;
        padding: 10px 15px;'>"
      . "<tr><th colspan='3' style='color: #31708F;"
      . "               background-color: #D9EDF7;"
      . "               '>Servicios</th></tr>";

    foreach($data as $value){
        $mensaje .= "<tr><td>".$value['nombreServicio']."</td>"
            . "<td>".$value['cantidad']."</td>"
            . "<td>".$value['UMedida']."</td></tr>";
    }
    $mensaje .= "</table><br/>";
}
//TOTAL
$mensaje .= "<table width='600' style='border-color: #48335A;'>"
  . "<tr><th style='color: #FFF;
background-color: #48335A;
border-color: #48335A;'>TOTAL</th>"
  . "<th style='color: #FFF;
background-color: #48335A;
border-color: #48335A;'> $ ".number_format($oCotizacion->getTotal($db,$idCotizacion),0,',','.')."</td></tr>";
$mensaje .= "</table><br/>";

//CARGOS ADICIONALES
$mensaje .= "<table width='600' style='border-collapse: collapse;
    border: 1px solid #BCE8F1;
    padding: 10px 15px;'>"
  . "<tr><th colspan='2' style='color: #31708F;"
  . "               background-color: #D9EDF7;"
  . "               '>Cargos adicionales</th></tr>"
  . "<tr><td>Despacho: ".$oCotizacion->getNombreDespacho($db,$idCotizacion)."</td>"
  . "<td>".$oCotizacion->getValorDespacho($db,$idCotizacion)."</td></tr>"
  . "<tr><td>Forma de Pago: ".$oCotizacion->getNombreFormaPago($db,$idCotizacion)."</td>"
  . "<td>".$oCotizacion->getPorcentajeFormaPago($db,$idCotizacion)."% </td></tr>";
$mensaje .= "</table><br/>";
//TOTAL FINAL
$mensaje .= "<table width='600' style='border-color: #48335A;'>"
  . "<tr style='color: #FFF;
background-color: #48335A;
border-color: #48335A;'><th >TOTAL FINAL</th>"
  . "<th> $ ".number_format($oCotizacion->getTotalFinal($db,$idCotizacion),0,',','.')."</th></tr>";
$mensaje .= "</table><br/>";


// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

// Cabeceras adicionales
$cabeceras .= "To: ".$oCotizacion->getNombreApellido($db,$idCotizacion)."<".$oCotizacion->getCorreo($db,$idCotizacion).">" . "\r\n";
$cabeceras .= 'From: Decos SIT Soluciones <decos@sitsoluciones.cl>' . "\r\n";
$cabeceras .= 'Cc: carlos@sitsoluciones.cl' . "\r\n";
$cabeceras .= 'Bcc: victoria@sitsoluciones.cl' . "\r\n";

// Enviarlo
if(mail($para, $titulo, $mensaje, $cabeceras)){
    echo "mensaje enviado";
}else{
    echo "no se pudo enviar el mensaje";
    echo $mensaje;
}


?>