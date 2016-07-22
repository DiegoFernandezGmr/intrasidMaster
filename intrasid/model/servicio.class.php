<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicio
 *
 * @author vpo
 */
class servicio {
    function obtenerServiciosCCosto($db,$idCCosto){
        $sql = "SELECT idServicio,"
                . "nombre,uMedida,"
                . "valorNeto"
                . " FROM servicio WHERE idCCosto=".$idCCosto;
		$res = $db->query($sql)->fetchAll();
        //echo $sql;
        return $res;
    }
    function obtenerValorNeto($db,$idServicio){
        $sql = "SELECT valorNeto"
                . " FROM servicio WHERE idServicio=".$idServicio;
		$res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
}
