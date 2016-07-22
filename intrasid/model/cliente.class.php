<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cliente
 *
 * @author vpo
 */
class cliente {
    function getIdCliente($db,$correo){
        $correo=addslashes(strtolower(trim($correo)));
         $sql = "SELECT idCliente"
                . " FROM cliente "
                . "WHERE correo='".$correo."' ";
        $res = $db->query($sql)->fetch();
        return $res[0];
    }
    function addClienteCotizador($db,$correo,$nombres,$apellidos){
        $correo=addslashes(strtolower(trim($correo)));
        $nombres=addslashes(strtolower(trim($nombres)));
        $apellidos=addslashes(strtolower(trim($apellidos)));
        $sql= "INSERT INTO cliente (correo,nombres,apellidos) VALUES ("
          . "'".$correo."', '".$nombres."', '".$apellidos."' )";
        $res = $db->exec($sql);
        if($res){
            return $this->getIdCliente($db,$correo);
        }else{
            return false;
        }
    }
}
