<?php
//cargar la clase de sesion
include('../model/sesion.class.php');
$sesion = new Sesion();
$sesion->iniciaSesion();
if($sesion->validarSesion()){
    include('../model/conn.php');
    include('../model/config.php');
    include('../model/ccosto.class.php');
    $oCcosto = new ccosto();
    if(isset($_POST['accionCRUD']) && $_POST['accionCRUD']=="add"){ //nuevo registro
        //verificar que el nombre no esté repetido       
        $nombre =  addslashes($_POST['nombre']);
        if($oCcosto->existeNombreCcosto($db, $nombre)){
            header('Location: dashboard.php?accion=CRUDCcosto&msg=ERRORADD');
        }else{
            $oCcosto->addCcosto($db,$nombre);
            header('Location: dashboard.php?accion=CRUDCcosto&msg=EXITOADD');
        }
    }elseif(isset($_GET['accionCRUD']) && $_GET['accionCRUD']=="del" && isset($_GET['idCcosto']) ){
        //verificar que el parámetro sea un número
        $idCcosto=intval($_GET['idCcosto']);
        //verificar que no tenga datos dependientes
        if($oCcosto->tieneCcosto($db,$idCcosto)){
            //si tiene hijos no se puede borrar
            header('Location: dashboard.php?accion=CRUDCcosto&msg=ERRORDEL');
        }else{
            if($oCcosto->delCcosto($db,$idCcosto)){
                header('Location: dashboard.php?accion=CRUDCcosto&msg=EXITODEL');
            }else{
                header('Location: dashboard.php?accion=CRUDCcosto&msg=ERRORDEL'.$idCcosto);
            }
        }
    }elseif(isset($_POST['accionCRUD']) && $_POST['accionCRUD']=="upd" ){
        //verificar que el parámetro sea un número
        print_r($_POST);
        $idCcosto=intval($_POST['idCcosto']);
        $nombre =  addslashes($_POST['nombre']);
        
        if($oCcosto->existeNombreConOtroId($db,$idCcosto, $nombre)){
            header('Location: dashboard.php?accion=CRUDCcosto&msg=ERRORUPD');
        }else{
            if($oCcosto->updCcosto($db,$idCcosto,$nombre)){
                header('Location: dashboard.php?accion=CRUDCcosto&msg=EXITOUPD');
            }else{
                header('Location: dashboard.php?accion=CRUDCcosto&msg=ERRORUPD');
            }
            
        }
    }
    
}else{
	header('Location: ../index.html');
}


