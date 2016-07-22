<?php
//cargar la clase de sesion
include('../model/sesion.class.php');
$sesion = new Sesion();
$sesion->iniciaSesion();
if($sesion->validarSesion()){
    include('../model/conn.php');
    include('../model/config.php');
    include('../model/categoria.class.php');
    $oCategoria = new categoria();
    if(isset($_POST['accionCRUD']) && $_POST['accionCRUD']=="add"){ //nuevo registro
        //verificar que el nombre no esté repetido       
        $nombre =  addslashes($_POST['nombre']);
        $ordenFormulario =  intval($_POST['ordenFormulario']);
        $idCCosto=intval($_POST['idCCosto']);
        if($oCategoria->existeNombre($db, $nombre)){
            header('Location: dashboard.php?accion=CRUDCategoria&msg=ERRORADD');
        }else{
            $oCategoria->addCategoria($db,$nombre,$ordenFormulario,$idCCosto);
            header('Location: dashboard.php?accion=CRUDCategoria&msg=EXITOADD');
        }
    }elseif(isset($_GET['accionCRUD']) && $_GET['accionCRUD']=="del" && isset($_GET['idCategoria']) ){
        //verificar que el parámetro sea un número
        $idCategoria=intval($_GET['idCategoria']);
        //verificar que no tenga datos dependientes
        if($oCategoria->tieneHijos($db,$idCategoria)){
            //si tiene hijos no se puede borrar
            header('Location: dashboard.php?accion=CRUDCategoria&msg=ERRORDEL');
        }else{
            if($oCategoria->delCategoria($db,$idCategoria)){
                header('Location: dashboard.php?accion=CRUDCategoria&msg=EXITODEL');
            }else{
                header('Location: dashboard.php?accion=CRUDCategoria&msg=ERRORDEL'.$idCategoria);
            }
        }
    }elseif(isset($_POST['accionCRUD']) && $_POST['accionCRUD']=="upd" ){
        //verificar que el parámetro sea un número
        print_r($_POST);
        $idCategoria=intval($_POST['idCategoria']);
        $nombre =  addslashes($_POST['nombre']);
        $ordenFormulario =  intval($_POST['ordenFormulario']);
        $idCCosto=intval($_POST['idCCosto']);
        
        if($oCategoria->existeNombreConOtroId($db,$idCategoria, $nombre)){
            header('Location: dashboard.php?accion=CRUDCategoria&msg=ERRORUPD');
        }else{
            if($oCategoria->updCategoria($db,$idCategoria,$nombre,$ordenFormulario,$idCCosto)){
                header('Location: dashboard.php?accion=CRUDCategoria&msg=EXITOUPD');
            }else{
                header('Location: dashboard.php?accion=CRUDCategoria&msg=ERRORUPD');
            }
            
        }
    }
    
}else{
	header('Location: ../index.html');
}


