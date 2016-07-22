<?php 
    include("funciones.php");
?>
<div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
			<img src="../view/images/logo_chico_100x78.png" />
            <h1 style="margin-top: -40px; margin-left: 100px; " >Escritorio <small>Cotizador TV Satelital</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-calculator"></i> Ver cotización TV Satelital</li>
            </ol>
            
          </div>
        </div><!-- /.row -->
 
        
           
            
        <div class="row">
        
            <div class="col-lg-8">
                <!-- PANEL ENCABEZADO -->
                <?php html_cotizacion($db,$_GET['idCotizacion']); ?>
            </div> 
            <div class="col-lg-4">
                <!-- PANEL TOTAL -->
                <div class="panel panel-primary">
                    <div class="panel-heading">TOTAL</div>
                    <div class="panel-body">
                        <h1><span class="label label-primary" id="respuesta" >
                                <?php html_total_cotizacion($db,$_GET['idCotizacion']); ?>
                            </span></h1>
                    </div>
                </div>
                
            </div> 
        </div><!-- /.row -->
    
        <div class="row">
            <div class="col-lg-6">
                <!-- PANEL LISTA MATERIALES -->
                <?php html_lista_productos_cotizacion($db,$_GET['idCotizacion']); ?>
            </div>
            <div class="col-lg-6">
                <!-- PANEL LISTA SERVICIOS -->
                <?php html_lista_servicios_cotizacion($db,$_GET['idCotizacion']); ?>
            </div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <!-- PANEL DESPACHO -->
                <?php html_despacho_cotizacion($db,$_GET['idCotizacion']); ?>
            </div>
            <div class="col-lg-6">
                <!-- PANEL FORMA DE PAGO -->
                <?php html_formaPago_cotizacion($db,$_GET['idCotizacion']); ?>
            </div>
        </div><!-- /.row -->

        
        <div class="row">
            <div class="col-lg-8">
                <a href="dashboard.php?accion=listaCotizacionesDeco" class="btn btn-lg btn-success">Lista de cotizaciones</a>
                <a href="enviarCorreoCotizacion.php?idCotizacion=<?php echo $_GET['idCotizacion']; ?>" class="btn btn-lg btn-success"> Enviar Correo</a>
            <!--<button type="submit" class="btn btn-default">Submit</button>-->
            </div>
            <div class="col-lg-4">
                <!-- PANEL TOTAL FINAL -->
                <div class="panel panel-primary">
                    <div class="panel-heading">TOTAL FINAL</div>
                    <div class="panel-body">
                        <h1><span class="label label-primary" >
                                <?php 
                                $oCotizacion= new Cotizacion();
                                echo $oCotizacion->getTotalFinal($db,$_GET['idCotizacion']); ?>
                            </span></h1>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
   
  </div><!-- /#page-wrapper -->    
      

      
