<?php
//cargar la clase de sesion
include('../model/sesion.class.php');
$sesion = new Sesion();
$sesion->iniciaSesion();
if($sesion->validarSesion()){
    if(isset($_POST['accion']) && $_POST['accion']=="editaUsuario"){
        //coneccion a la BD
        include('../model/conn.php');
        //cargar la clase de usuario
        include('../model/usuario.class.php');
        $usuario = new Usuario();
        $usuario->setNombre($db,$_POST['idUsuario'],$_POST['nombre']);
        $usuario->setEmail($db,$_POST['idUsuario'],$_POST['email']);
        if(strlen($_POST['password1'])>0 && ($_POST['password1']==$_POST['password2']) ){
            $usuario->setPassword($db,$_POST['idUsuario'],$_POST['password1']);
        }
    }
}else{
	header('Location: ../index.html');
}

?>
