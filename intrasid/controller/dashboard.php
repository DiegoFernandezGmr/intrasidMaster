<?php
include('../model/config.php');
include('../model/sesion.class.php');
$sesion=new Sesion();
if($sesion->validarSesion()){
    include('../view/head.html'); 
    include('../view/sidebar.php');
    include('../model/conn.php');

    if(isset($_GET['accion']) && $_GET['accion']=="editaMiPerfil"){
        $aDatos = array();
        $aDatos['nombreUsuario'] = $sesion->getNombreUsuario();
        $aDatos['emailUsuario'] = $sesion->getEmailUsuario();
        //coneccion a la BD
        include('../model/conn.php');
        //cargar la clase de perfil
        include('../model/perfil.class.php');
        $perfil = new Perfil();
        $aPerfiles = $perfil->getTodosLosPerfiles($db);

        include('../view/formMiPerfil.php');
    }elseif(isset($_GET['accion']) && $_GET['accion']=="cotizarDeco"){
        include('../model/categoria.class.php');
        include('../model/producto.class.php');
        include('../model/ccosto.class.php');
        include('../model/servicio.class.php');
        include('../model/despacho.class.php');
        include('../model/formaPago.class.php');
        include('../view/cotizarDeco.php');
    }elseif(isset($_GET['accion']) && $_GET['accion']=="verCotizacionDeco"){
        include('../model/cotizacion.class.php');
        include('../view/verCotizacionDeco.php');
    }elseif(isset($_GET['accion']) && $_GET['accion']=="listaCotizacionesDeco"){
        include('../model/categoria.class.php');
        include('../model/producto.class.php');
        include('../model/ccosto.class.php');
        include('../model/servicio.class.php');
        include('../model/despacho.class.php');
        include('../model/formaPago.class.php');
        include('../model/cotizacion.class.php');
        include('../view/cotizarDeco.php');
    }elseif(isset($_GET['accion']) && $_GET['accion']=="cotizarCamara"){
        include('../model/categoria.class.php');
        include('../model/producto.class.php');
        include('../model/ccosto.class.php');
        include('../model/servicio.class.php');
        include('../model/despacho.class.php');
        include('../model/formaPago.class.php');
        include('../view/cotizarCamara.php');
    }elseif(isset($_GET['accion']) && $_GET['accion']=="CRUDCategoria"){
        include('../model/categoria.class.php');
        include('../model/ccosto.class.php');
        include('../view/CRUDCategoria.php');
    }else{
        include('../model/cotizacion.class.php');
        include('../view/center.php');
    //include('../view/formMiPerfil.php');
    //include('../view/modal.php');
    }

    include('../view/foot.html'); 

}else{
    header('Location: ../index.html?err=NOhaySesion');
    //print_r($_SESSION);
}



?>
