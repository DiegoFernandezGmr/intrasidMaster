<?php
include('../model/conn.php');
include('../model/producto.class.php');
include('../model/servicio.class.php');

$oProducto = new Producto();
$oServicio = new Servicio();
//print_r($_POST);
$valor=0;
foreach ($_POST as $key => $value) {
    if(strpos($key, "check") !== false){
        $id=substr($key,6);
        if(strpos($key, "checkP") !== false){
           $indice="cantP".$id;
           $valor +=  $oProducto->obtenerValorNeto($db, $id)*$_POST[$indice];
        }else{
           $indice="cantS".$id;
           $valor +=  $oServicio->obtenerValorNeto($db, $id)*$_POST[$indice]; 
        }
    }
}

$idDespacho = $_POST['despacho'];
$valorDespacho=$_POST['desp'.$idDespacho];
$idFormaPago=$_POST['formaPago'];
$porcentajeCargo=$_POST['formaP'.$idFormaPago];
//$valor = round($valor * 1.19 , 0);

$aResult=Array("valor" => $valor,
                "valorDespacho" => $valorDespacho,
                "porcentajeCargo"=>$porcentajeCargo);

echo json_encode($aResult);



