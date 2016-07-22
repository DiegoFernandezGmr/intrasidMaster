<?php
include('../model/conn.php');
include('../model/categoria.class.php');
$oCategoria = new categoria();
$idCategoria = intval($_GET['idCategoria']);
$aResult = $oCategoria->getCategoria($db, $idCategoria);
echo json_encode($aResult);
