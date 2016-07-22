<?php
$oCotizacion=new Cotizacion();

?>
    <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
			<img src="../view/images/logo_chico_100x78.png" />
            <h1 style="margin-top: -40px; margin-left: 100px; " >Escritorio <small>Lista de Tareas</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Escritorio</li>
            </ol>
            
          </div>
        </div><!-- /.row -->


 
        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-globe fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $oCotizacion->getCantidadCotizacionesWeb($db); ?></div>
                                <div>Nuevas cotizaciones web</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-keyboard-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $oCotizacion->getCantidadCotizacionesSIT($db); ?></div>
                                <div>Nuevas cotizaciones SIT</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3"></div>

        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->
