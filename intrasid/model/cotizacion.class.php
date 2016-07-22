<?php

/**
 * Description of cotizacion
 *
 * @author vpo
 */
class cotizacion {
    function addCotizacion($db,$idCCosto, $idCliente,$idUsuario,$detalle){
        $sql= "INSERT INTO cotizacion (idCCosto,idCliente,idUsuario) VALUES ("
          . $idCCosto.",".$idCliente.", ".$idUsuario." )";
        //echo $sql;
        $res = $db->exec($sql);
        if($res){
            $idCotizacion=$db->lastInsertId();
            foreach($detalle as $value){
                $this->addDetalleCotizacion($db,
                                    $idCotizacion,
                                    $value['tipo'],
                                    $value['id'],
                                    $value['cantidad'],
                                    $value['valorU'] );
            }
        }
        $valorDetalle = $this->getTotal($db, $idCotizacion);
        $this->updValorDetalleCotizacion($db, $idCotizacion,$valorDetalle);
        
        return $idCotizacion;
    }
    
    function updValorDetalleCotizacion($db, $idCotizacion,$valorDetalle){
        $sql="UPDATE cotizacion SET valorDetalle=".$valorDetalle.""
          . " WHERE idCotizacion=".$idCotizacion;
        $res = $db->exec($sql);
    }
    
    function addDetalleCotizacion($db,$idCotizacion,$tipo,$id,$cantidad,$valorU){
        $sql="INSERT INTO detalleCotizacion (idCotizacion,"
          . "idProducto,idServicio,cantidad,valorU) VALUES ("
          . $idCotizacion.",";
        if($tipo=="producto"){
            $sql .= $id.",0,";
        }else{
            $sql .= "0,".$id.",";
        }
        $sql .= $cantidad.",".$valorU.")";
        echo $sql;
        $res = $db->exec($sql);
    }
    
    function getCotizacion($db,$idCotizacion){
        $sql="SELECT cotizacion.idCCosto, 
            ccosto.nombre AS nombreCCosto, 
            cotizacion.idCliente, 
            correo, 
            nombres, 
            apellidos, 
            fecha, 
            idUsuario, 
            usuario.nombre AS nombreUsuario
            FROM cotizacion
            JOIN ccosto ON cotizacion.idCCosto = ccosto.idCCosto
            JOIN usuario ON cotizacion.idUsuario = usuario.id
            JOIN cliente ON cotizacion.idCliente = cliente.idCliente
            WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetchAll();
        //echo $sql;
        return $res[0]; 
    }
    
    function getTotal($db, $idCotizacion){
        $sql="SELECT sum( cantidad * valorU ) AS total
                FROM detalleCotizacion
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0]; 
    }
    
    function getTotalFinal($db, $idCotizacion){
        $valorFinal = $this->getTotal($db, $idCotizacion);
        $valorDespacho = $this->getValorDespacho($db,$idCotizacion);
        $porcentaje = $this->getPorcentajeFormaPago($db, $idCotizacion);
        $valorFinal = ($valorFinal + $valorDespacho) * (1+ ($porcentaje/100));
        return $valorFinal; 
    }
    function getProductos($db, $idCotizacion){
        $sql="SELECT detalleCotizacion.idProducto,
                     producto.nombre AS nombreProducto,
                     producto.idCategoria,
                     categoria.nombre AS nombreCategoria,
                     ordenFormulario,
                     cantidad
                FROM detalleCotizacion
                JOIN producto ON detalleCotizacion.idProducto=producto.idProducto
                JOIN categoria ON producto.idCategoria=categoria.idCategoria
                WHERE idCotizacion =".$idCotizacion.""
          . "   ORDER BY idCategoria";
        $res = $db->query($sql)->fetchAll();
        //echo $sql;
        return $res;
    }
    
    function getServicios($db, $idCotizacion){
        $sql="SELECT detalleCotizacion.idServicio,
                     servicio.nombre AS nombreServicio,
                     servicio.idCCosto,
                     ccosto.nombre AS nombreCCosto,
                     cantidad,
                     UMedida
                FROM detalleCotizacion
                JOIN servicio ON detalleCotizacion.idServicio=servicio.idServicio
                JOIN ccosto ON servicio.idCCosto=ccosto.idCCosto
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetchAll();
        //echo $sql;
        return $res;
    }
    
    function updDespacho($db,$idCotizacion,$idDespacho,$valorDespacho){
        $sql="UPDATE cotizacion SET idDespacho=".$idDespacho.","
          . "valorDespacho=".$valorDespacho." "
          . " WHERE idCotizacion=".$idCotizacion;
        $res = $db->exec($sql);
    }
    
    function updFormaPago($db,$idCotizacion,$idFormaPago,$porcentajeFormaPago){
        $sql="UPDATE cotizacion SET idFormaPago=".$idFormaPago.","
          . "porcentajeFormaPago=".$porcentajeFormaPago." "
          . " WHERE idCotizacion=".$idCotizacion;
        $res = $db->exec($sql);
    }
    
    function getNombreDespacho($db,$idCotizacion){
        $sql="SELECT despacho.nombre AS nombreDespacho
                FROM cotizacion
                JOIN despacho ON cotizacion.idDespacho=despacho.idDespacho
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
    
    function getValorDespacho($db,$idCotizacion){
        $sql="SELECT valorDespacho
                FROM cotizacion
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
    
    function getNombreFormaPago($db,$idCotizacion){
        $sql="SELECT formaPago.nombre AS nombreFormaPago
                FROM cotizacion
                JOIN formaPago ON cotizacion.idFormaPago=formaPago.idFormaPago
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
    
    function getPorcentajeFormaPago($db,$idCotizacion){
        $sql="SELECT porcentajeFormaPago
                FROM cotizacion
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
    function getLogoFormaPago($db,$idCotizacion){
        $sql="SELECT formaPago.logo AS logo
                FROM cotizacion
                JOIN formaPago ON cotizacion.idFormaPago=formaPago.idFormaPago
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
    
    function getCorreo($db,$idCotizacion){
        $sql="SELECT correo
                FROM cliente
                JOIN cotizacion ON cotizacion.idCliente=cliente.idCliente
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
    
    function getFecha($db,$idCotizacion){
        $sql="SELECT DATE_FORMAT(fecha,'%d %b %y') AS fecha
                FROM cotizacion
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
    
    function getNombreApellido($db,$idCotizacion){
        $sql="SELECT CONCAT(nombres, ' ', apellidos) AS nombreCliente
                FROM cliente
                JOIN cotizacion ON cotizacion.idCliente=cliente.idCliente
                WHERE idCotizacion =".$idCotizacion;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0];
    }
    
    function getCantidadCotizacionesWeb($db){
        $sql="SELECT count(*) AS qCotizaciones
                FROM cotizacion
                WHERE idUsuario =".VISITANTEWEB;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0]; 
    }
    function getCantidadCotizacionesSIT($db){
        $sql="SELECT count(*) AS qCotizaciones
                FROM cotizacion
                WHERE idUsuario !=".VISITANTEWEB;
        $res = $db->query($sql)->fetch();
        //echo $sql;
        return $res[0]; 
    }
}
