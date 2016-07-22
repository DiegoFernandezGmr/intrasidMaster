<?php
class perfil{

	function getTodosLosPerfiles($db){
		$sql = "SELECT id,nombre FROM perfil";
		$aDatos=array();
		$aDatos = $db->query($sql)->fetchAll();
		return $aDatos;
	}
}
?>
