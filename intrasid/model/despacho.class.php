<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of despacho
 *
 * @author vpo
 */
class despacho {
   function obtenerDespachos($db){
        $sql = "SELECT idDespacho,"
                . "nombre,valor "
                . " FROM despacho";
		$res = $db->query($sql)->fetchAll();
        //echo $sql;
        return $res;
    }
}
