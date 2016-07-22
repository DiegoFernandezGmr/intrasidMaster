<?php
//cargar la clase de sesion
include('../model/config.php');
include('../model/sesion.class.php');
$sesion=new Sesion();
if(isset($_POST['ingresar']) && $_POST['ingresar']==1){
	//coneccion a la BD
	include('../model/conn.php');
	//cargar la clase de usuario
	include('../model/usuario.class.php');
	$usuario = new Usuario();
	
	if($_POST['email'] && $_POST['pass']){
            if($usuario->validarUsuario($db,$_POST['email'],$_POST['pass'])){
                $datosUsuario = $usuario->getUsuarioPorEmail($db,$_POST['email']);
                $sesion->iniciaDatosSesion($datosUsuario);
                header('Location: dashboard.php?'.SID);
                exit();
            }else{
                header('Location: ../index.html');
            }
	}else{
            header('Location: ../index.html');
	}
}else{
    header('Location: ../index.html');
}
	

?>
