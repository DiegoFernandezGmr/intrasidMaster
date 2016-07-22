<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formaPago
 *
 * @author vpo
 */
class formaPago {
   function obtenerFormasPago($db){
        $sql = "SELECT idFormaPago,"
                . "nombre,porcentaje,logo "
                . " FROM formaPago";
		$res = $db->query($sql)->fetchAll();
        //echo $sql;
        return $res;
    }
}
