<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ccosto
 *
 * @author vpo
 */
class ccosto {
    function getNombre($db,$idCCosto){
         $sql = "SELECT nombre"
                . " FROM ccosto "
                . "WHERE idCCosto=".$idCCosto;
        $res = $db->query($sql)->fetch();
        return $res[0];
    }
    
    function getCCostos($db){
         $sql = "SELECT idCCosto,nombre"
                . " FROM ccosto ";
        $res = $db->query($sql)->fetchAll();
        return $res;
    }
}
