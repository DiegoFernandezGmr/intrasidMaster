<?php
include('../model/conn.php');
include('../model/ccosto.class.php');
$oCcosto = new ccosto();
$idCcosto = intval($_GET['idCcosto']);
$aResult = $oCosto->getCcosto($db, $idCcosto);
echo json_encode($aResult);
?>