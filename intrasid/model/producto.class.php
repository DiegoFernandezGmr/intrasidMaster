<?php


/**
 * Description of producto
 *
 * @author vpo
 */
class producto {
    //put your code here
    function obtenerProductosCategoria($db,$idCategoria){
        $sql = "SELECT idProducto,"
                . "nombre,"
                . "valorNeto"
                . " FROM producto WHERE idCategoria=".$idCategoria;
		$res = $db->query($sql)->fetchAll();
        //echo $sql;
        return $res;
        
    }
    
    function obtenerValorNeto($db,$idProducto){
        $sql = "SELECT valorNeto"
                . " FROM producto WHERE idProducto=".$idProducto;
		$res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
}
