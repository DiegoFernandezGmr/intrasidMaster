<?php

function html_mensajes(){  
    global $aMensajes;
    if(isset($_GET['msg'])){ ?>
       <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $("#msg").fadeOut(1500);
            },3000);
        }); 
        </script>
<?php
    }
    if(isset($_GET['msg']) && substr($_GET['msg'],0,5)=="ERROR"){ ?>

    <div class="alert alert-danger fade in" id="msg">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong>
        <?php echo $aMensajes[$_GET['msg']]; ?>
    </div>
<?php   
    }elseif(isset($_GET['msg']) && substr($_GET['msg'],0,5)=="EXITO"){ ?>

    <div class="alert alert-success fade in" id="msg">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Exito!</strong>
        <?php echo $aMensajes[$_GET['msg']]; ?>
    </div>
<?php
    }
}



function html_lista_productos_form($db,$idCCosto,$ordenFormulario){
    $oCategoria = new Categoria();
    $idCategoria = $oCategoria->obtenerCategoria($db, $idCCosto, $ordenFormulario);
    $oProducto = new Producto();
    $data = $oProducto->obtenerProductosCategoria($db,$idCategoria);
    ?>
    
     <div class="panel panel-info">
         <div class="panel-heading"><?php echo $oCategoria->getNombre($db, $idCategoria); ?></div>
        <div class="panel-body">
    <?php        
    foreach($data as $value){ ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="checkbox">
                    <label><input type="checkbox"
                                  name="checkP<?php echo $value['idProducto']; ?>"
                                  id="checkP<?php echo $value['idProducto']; ?>"
                                  value="<?php echo $value['idProducto']; ?>">
                        <?php echo $value['nombre']; ?>
                    </label>   
                </div>
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-4">
                <label class="sr-only" for="cant">Cantidad:</label>
                <input type="number" 
                       class="form-control" 
                       id="cantP<?php echo $value['idProducto']; ?>"
                       name="cantP<?php echo $value['idProducto']; ?>"
                       readonly
                       />
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
    <?php }      ?>          
                    
                    
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
    
}

function html_lista_servicios_form($db,$idCCosto){
    $oCCosto = new CCosto();
    $oServicio = new Servicio();
    $data = $oServicio->obtenerServiciosCCosto($db,$idCCosto);
    ?>
    
     <div class="panel panel-info">
         <div class="panel-heading">Servicios <?php echo trim($oCCosto->getNombre($db, $idCCosto)); ?></div>
        <div class="panel-body">
    <?php        
    foreach($data as $value){ ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="checkbox">
                    <label><input type="checkbox" 
                                  name="checkS<?php echo $value['idServicio']; ?>"
                                  id="checkS<?php echo $value['idServicio']; ?>"
                                  value="<?php echo $value['idServicio']; ?>">
                        <?php echo $value['nombre']; ?>
                    </label>   
                </div>
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-3">
                <input type="number" 
                       class="form-control" 
                       id="cantS<?php echo $value['idServicio']; ?>"
                       name="cantS<?php echo $value['idServicio']; ?>"
                       readonly
                       />
            </div><!-- /.col-lg-5> -->
            <div class="col-lg-3">
                <label><?php echo $value['uMedida']; ?></label>
            </div><!-- /.col-lg-1> -->
        </div><!-- /.row -->
    <?php }      ?>          
                    
                    
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
    
}

function html_lista_despachos_form($db){
    $oDespacho = new Despacho();
    $data = $oDespacho->obtenerDespachos($db);
    $flag=true;
    ?>
    
     <div class="panel panel-info">
         <div class="panel-heading">Despacho</div>
        <div class="panel-body">
    <?php        
    foreach($data as $value){ ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="radio">
                    <label><input type="radio"
                                  name="despacho"
                                  id="despacho"
                                  value="<?php echo $value['idDespacho']; ?>"
                                <?php if($flag){ echo "checked"; $flag=false; }; ?>  
                            >
                        <?php echo $value['nombre']; ?>
                    </label>
                    <input type="hidden" 
                           name="desp<?php echo $value['idDespacho']; ?>"
                           id="desp<?php echo $value['idDespacho']; ?>"
                           value="<?php echo $value['valor']; ?>">
                </div>
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-4">
                <label><?php echo $value['valor']; ?></label>
                
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
    <?php }      ?>          
                    
                    
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
    
}

function html_lista_formasPago_form($db){
    $oFormaPago = new FormaPago();
    $data = $oFormaPago->obtenerFormasPago($db);
    $flag=true;
    ?>
    
     <div class="panel panel-info">
         <div class="panel-heading">Formas de Pago</div>
        <div class="panel-body">
    <?php        
    foreach($data as $value){ ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="radio">
                    <label><input type="radio"
                                  name="formaPago"
                                  id="formaPago"
                                  value="<?php echo $value['idFormaPago']; ?>"
                                <?php if($flag){ echo "checked"; $flag=false; }; ?>   
                                  >
                        <?php echo trim($value['nombre'])." ".$value['porcentaje']."%"; ?>
                    </label>
                    <input type="hidden" 
                           name="formaP<?php echo $value['idFormaPago']; ?>"
                           id="formaP<?php echo $value['idFormaPago']; ?>"
                           value="<?php echo $value['porcentaje']; ?>">
                </div>
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-6">
                <?php if(!empty($value['logo'])){ ?>
                <img src="../view/<?php echo $value['logo']; ?>" width="100" />
                <?php }      ?>
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
    <?php }      ?>          
                    
                    
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
    
}



function html_cotizacion($db,$idCotizacion){
    $oCotizacion= new Cotizacion();
    $data = $oCotizacion->getCotizacion($db, $idCotizacion);
    ?>
     <div class="panel panel-info">
         <div class="panel-heading">
             <?php echo "Cotizaci&oacute;n ".$data['nombreCCosto']." Nº ".$idCotizacion; ?>
         </div>
        <div class="panel-body">
    
        

        <div class="row">
            <div class="col-lg-6">
                <label>Fecha:</label>   
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-6">
                <label><?php echo $data['fecha']; ?></label>
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
        
        <div class="row">
            <div class="col-lg-6">
                <label>Cliente: </label>   
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-6">
                <label><?php echo $data['nombres'] ." ".$data['apellidos']; ?></label>
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
        
        <div class="row">
            <div class="col-lg-6">
                <label>Correo: </label>   
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-6">
                <label><?php echo $data['correo']; ?></label>
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
        
        <div class="row">
            <div class="col-lg-6">
                <label>Preparada por: </label>   
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-6">
                <label><?php echo $data['nombreUsuario']; ?></label>
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
        
        
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
    
}
function html_total_cotizacion($db,$idCotizacion){
    $oCotizacion= new Cotizacion();
    echo $oCotizacion->getTotal($db, $idCotizacion);
}

function html_lista_productos_cotizacion($db,$idCotizacion){
    $oCotizacion= new Cotizacion();
    $data = $oCotizacion->getProductos($db,$idCotizacion);
    ?>
    
     <div class="panel panel-info">
         <div class="panel-heading">Productos y Materiales</div>
        <div class="panel-body">
    <?php        
    foreach($data as $value){ ?>
        <div class="row">
            <div class="col-lg-10">
                <label>
                    <?php echo $value['nombreCategoria']; ?>
                </label>   
                <label>
                    <?php echo $value['nombreProducto']; ?>
                </label>
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-2">
                <label>
                    <?php echo $value['cantidad']; ?>
                </label>
                
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
    <?php }      ?>          
                    
                    
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
    
}
function html_lista_servicios_cotizacion($db,$idCotizacion){
    $oCotizacion= new Cotizacion();
    $data = $oCotizacion->getServicios($db,$idCotizacion);
    ?>
    
     <div class="panel panel-info">
         <div class="panel-heading">Servicios</div>
        <div class="panel-body">
    <?php        
    foreach($data as $value){ ?>
        <div class="row">
            <div class="col-lg-8">
                 
                <label>
                    <?php echo $value['nombreServicio']; ?>
                </label>
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-1">
                <label>
                    <?php echo $value['cantidad']; ?>
                </label>
            </div><!-- /.col-lg-6> -->
            <div class="col-lg-3">
                <label>
                    <?php echo $value['UMedida']; ?>
                </label>
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
    <?php }      ?>          
                    
                    
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
    
}

function html_despacho_cotizacion($db,$idCotizacion){
    $oCotizacion= new Cotizacion();
    ?>
     <div class="panel panel-info">
         <div class="panel-heading">Despacho</div>
        <div class="panel-body">
        <div class="row">
            <div class="col-lg-8">
                    <label>
                        <?php echo $oCotizacion->getNombreDespacho($db, $idCotizacion); ?>
                    </label>
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-4">
                <label><?php echo $oCotizacion->getValorDespacho($db, $idCotizacion); ?></label>
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
}
function html_formaPago_cotizacion($db,$idCotizacion){
    $oCotizacion= new Cotizacion();
    ?>
     <div class="panel panel-info">
         <div class="panel-heading">Forma de Pago</div>
        <div class="panel-body">
        <div class="row">
            <div class="col-lg-8">
                <label>
                    <?php echo $oCotizacion->getNombreFormaPago($db, $idCotizacion); ?>
                </label>
            </div><!-- /.col-lg-6> -->   
            <div class="col-lg-4">
                <label>
                    <?php echo $oCotizacion->getPorcentajeFormaPago($db, $idCotizacion)." %"; ?>
                </label>
            </div><!-- /.col-lg-6> -->
        </div><!-- /.row -->
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->   
<?php    
}