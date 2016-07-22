<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoria
 *
 * @author vpo
 */
class categoria {
    function obtenerCategoria($db,$idCCosto,$ordenFormulario){
        $sql = "SELECT idCategoria"
                . " FROM categoria "
                . "WHERE idCCosto=".$idCCosto." AND ordenFormulario=".$ordenFormulario;
        //echo $sql;
        $res = $db->query($sql)->fetch();
        return $res[0];
        
    }
    
    function getNombre($db,$idCategoria){
         $sql = "SELECT nombre"
                . " FROM categoria "
                . "WHERE idCategoria=".$idCategoria;
        $res = $db->query($sql, PDO::FETCH_ASSOC)->fetch();
        return $res['nombre'];
    }
    
    function getCategoria($db,$idCategoria){
         $sql = "SELECT *"
                . " FROM categoria "
                . "WHERE idCategoria=".$idCategoria;
        $res = $db->query($sql)->fetch();
        return $res;
    }
    
    function getCategorias($db){
         $sql = "SELECT idCategoria, "
                . " categoria.nombre, "
                . "ordenFormulario, "
                . "categoria.idCCosto, "
                . "ccosto.nombre AS nombreCCosto "
                . " FROM categoria "
                . "JOIN ccosto ON categoria.idCCosto=ccosto.idCCosto";
        // echo $sql;
        $res = $db->query($sql)->fetchAll();
        return $res;
    }
    
    function existeNombre($db,$nombre){
        $sql = "SELECT idCategoria"
                . " FROM categoria "
                . "WHERE nombre='".$nombre."' ";
        $res = $db->query($sql)->fetch();
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    function existeNombreConOtroId($db,$idCategoria,$nombre){
        $sql = "SELECT idCategoria"
                . " FROM categoria "
                . "WHERE nombre='".$nombre."' AND idCategoria!=".$idCategoria;
        $res = $db->query($sql)->fetch();
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    function addCategoria($db,$nombre,$ordenFormulario,$idCCosto){
        // prepare sql and bind parameters
        $stmt = $db->prepare("INSERT INTO categoria 
            (nombre,ordenFormulario,idCCosto) 
            VALUES (:nombre, :ordenFormulario, :idCCosto)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ordenFormulario', $ordenFormulario);
        $stmt->bindParam(':idCCosto', $idCCosto);
        $res = $stmt->execute();
        return $res;
    }
    
    function updCategoria($db,$idCategoria,$nombre,$ordenFormulario,$idCCosto){
        // prepare sql and bind parameters
        $sql="UPDATE categoria SET
            nombre=:nombre, ordenFormulario=:ordenFormulario, idCCosto=:idCCosto
             WHERE idCategoria=:idCategoria";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ordenFormulario', $ordenFormulario);
        $stmt->bindParam(':idCCosto', $idCCosto);
        $stmt->bindParam(':idCategoria', $idCategoria);
        $res = $stmt->execute();
        return $res;
    }
    
    function delCategoria($db,$idCategoria){
        // prepare sql and bind parameters
        $stmt = $db->prepare("DELETE FROM categoria WHERE idCategoria= :idCategoria");
        $stmt->bindParam(':idCategoria', $idCategoria);
        $res = $stmt->execute();
        return $res;
    }
    
    function getTooltip($db,$idCategoria){
        $sql = "SELECT tooltip"
                . " FROM categoria "
                . "WHERE idCategoria=".$idCategoria;
        $res = $db->query($sql)->fetch();
        return $res[0];
    }
    
    function tieneHijos($db,$idCategoria){
        $sql = "SELECT idProducto"
                . " FROM producto "
                . "WHERE idCategoria=".$idCategoria;
        $res = $db->query($sql)->fetchAll();
        if($res){
            return true;
        }else{
            return false;
        }
    }
}