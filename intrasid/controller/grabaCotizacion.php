<?php
//cargar la clase de sesion
include('../model/sesion.class.php');
$sesion = new Sesion();
$sesion->iniciaSesion();
if($sesion->validarSesion()){
    if(isset($_POST['accion']) && $_POST['accion']=="grabaCotizacion"){
        //coneccion a la BD
        include('../model/conn.php');
        include('../model/config.php');
        include('../model/cliente.class.php');
        include('../model/producto.class.php');
        include('../model/servicio.class.php');
        include('../model/cotizacion.class.php');
        //print_r($_POST);
        
        $oProducto = new Producto();
        $oServicio = new Servicio();
        $oCotizacion=new Cotizacion();
        $correo=addslashes(strtolower(trim($_POST['correo'])));
        $nombres=addslashes(strtolower(trim($_POST['nombres'])));
        $apellidos=addslashes(strtolower(trim($_POST['apellidos'])));
        $oCliente = new Cliente();
        // evalúa si el cliente ya existe
        $idCliente = $oCliente->getIdCliente($db, $correo);
        //si no existe, lo crea
        if(!$idCliente) $idCliente = $oCliente->addClienteCotizador($db, $correo,$nombres,$apellidos);
        $detalle=Array();
        foreach ($_POST as $key => $value) {
            if(strpos($key, "check") !== false){
                $id=substr($key,6);
                if(strpos($key, "checkP") !== false){
                    $indice="cantP".$id;
                    $tipo="producto";
                    $valorU =  $oProducto->obtenerValorNeto($db, $id);
                }else{
                    $indice="cantS".$id;
                    $tipo="servicio";
                    $valorU =  $oServicio->obtenerValorNeto($db, $id); 
                }   
                $detalle[] = Array("tipo"=> $tipo, 
                                   "id" => $id,
                                   "cantidad" => $_POST[$indice],
                                   "valorU" => $valorU );
            }
        }
        
        $idCotizacion=$oCotizacion->addCotizacion($db,CCOSTOTVSATELITAL, $idCliente,$_SESSION['idUsuario'],$detalle);
        $idDespacho = $_POST['despacho'];
        $valorDespacho=$_POST['desp'.$idDespacho];
        $oCotizacion->updDespacho($db,$idCotizacion,$idDespacho,$valorDespacho);
        $idFormaPago=$_POST['formaPago'];
        $porcentajeFormaPago=$_POST['formaP'.$idFormaPago];
        $oCotizacion->updFormaPago($db,$idCotizacion,$idFormaPago,$porcentajeFormaPago);
        header('Location: dashboard.php?accion=verCotizacionDeco&idCotizacion='.$idCotizacion);
    }
}else{
	header('Location: ../index.html');
}

?>