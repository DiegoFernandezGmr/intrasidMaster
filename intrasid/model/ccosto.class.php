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
    
    function getCcosto($db,$idCcosto){
         $sql = "SELECT *"
                . " FROM ccosto "
                . "WHERE idCcosto=".$idCcosto;
        $res = $db->query($sql)->fetch();
        return $res;
    }
    
    function getCcostos($db){
         $sql = "SELECT idCcosto,nombre"
                . " FROM ccosto ";
        $res = $db->query($sql)->fetchAll();
        return $res;
    }
    
    function obtenerCosto($db,$idCCosto,$nombre){
        $sql = "SELECT idCcosto"
                . " FROM ccosto "
                . "WHERE idCCosto=".$idCCosto." AND nombre=".$nombre;
        //echo $sql;
        $res = $db->query($sql)->fetch();
        return $res[0];
        
    }
    
    function existeNombreCcosto($db,$nombre){
        $sql = "SELECT idCcosto"
                . " FROM ccosto "
                . "WHERE nombre='".$nombre."' ";
        $res = $db->query($sql)->fetch();
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    function existeNombreConOtroIdCcosto($db,$idCcosto,$nombre){
        $sql = "SELECT idCcosto"
                . " FROM ccosto "
                . "WHERE nombre='".$nombre."' AND idCcosto!=".$idCcosto;
        $res = $db->query($sql)->fetch();
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    function addCcosto($db,$nombre){
        // prepare sql and bind parameters
        $stmt = $db->prepare("INSERT INTO ccosto 
            (nombre,ordenFormulario,idCCosto) 
            VALUES (:nombre)");
        $stmt->bindParam(':nombre', $nombre);
        $res = $stmt->execute();
        return $res;
    }
    
    function updCcosto($db,$idCcosto,$nombre){
        // prepare sql and bind parameters
        $sql="UPDATE ccosto SET
            nombre=:nombre
             WHERE idCcosto=:idCcosto";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':idCategoria', $idCcosto);
        $res = $stmt->execute();
        return $res;
    }
      
    function delCcosto($db,$idCcosto){
        // prepare sql and bind parameters
        $stmt = $db->prepare("DELETE FROM ccosto WHERE idCcosto= :idCcosto");
        $stmt->bindParam(':idCcosto', $idCcosto);
        $res = $stmt->execute();
        return $res;
    }
    
    function tieneCcosto($db,$idCcosto){
        $sql = "SELECT idCcosto"
                . " FROM ccosto "
                . "WHERE idCcosto=".$idCcosto;
        $res = $db->query($sql)->fetchAll();
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    function existeNombreConOtroId($db,$idCcosto,$nombre){
        $sql = "SELECT idCcosto"
                . " FROM ccosto "
                . "WHERE nombre='".$nombre."' AND idCcosto!=".$idCcosto;
        $res = $db->query($sql)->fetch();
        if($res){
            return true;
        }else{
            return false;
        }
    }
}