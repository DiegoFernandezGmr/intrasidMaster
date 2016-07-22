<?php

/*
 * Archivo de definicion de variables comunes a todo el sistema
 * constantes
 */

$aMensajes = array();
define("ADMINISTRADOR", 1);
define("VISITANTEWEB", 3);


define("EXITOADD", 1);
define("ERRORADD", 2);
define("EXITODEL", 3);
define("ERRORDEL", 4);

$aMensajes['EXITOADD'] = "Los datos fueron guardados con éxito!";
$aMensajes['ERRORADD'] = "Hubo un error al guardar los datos, reintente luego.";
$aMensajes['EXITODEL'] = "Los datos fueron eliminados con éxito!";
$aMensajes['ERRORDEL'] = "Hubo un error al eliminar los datos, reintente luego.";
$aMensajes['EXITOUPD'] = "Los datos fueron modificados con éxito!";
$aMensajes['ERRORUPD'] = "Hubo un error al modificar los datos, reintente luego.";

define("CCOSTOTVSATELITAL", 1);
define("CCOSTOCCTV", 2);

//ini_set("session.use_trans_sid",1);    

?>
