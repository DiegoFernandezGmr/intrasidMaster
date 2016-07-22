<!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Tasklist</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li <?php if(!isset($_GET['accion'])) echo "class='active'"; ?> >
                <a href="dashboard.php"><i class="fa fa-dashboard"></i> Escritorio</a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calculator"></i> Cotizador <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li <?php if(isset($_GET['accion']) && $_GET['accion']=="cotizarDeco") echo "class='active'"; ?> >
                    <a href="dashboard.php?accion=cotizarDeco&<?php echo SID; ?>">TV Satelital </a>
                </li>
                <li><a href="dashboard.php?accion=cotizarCamara">Cámaras</a></li>
                <li><a href="#">Cit&oacute;fonos</a></li>
                <li><a href="#">Redes</a></li>
                <li><a href="#">Otros</a></li>
              </ul>
            </li>
            
            <li><a href="#"><i class="fa fa-history"></i> Cotizaciones</a></li>
            <li><a href="#"><i class="fa fa-smile-o"></i> Clientes</a></li>
            <li><a href="#"><i class="fa fa-area-chart"></i> Reportes</a></li>
           
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Mantenedores <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="dashboard.php?accion=CRUDCategoria&<?php echo SID; ?>">Categor&iacute;a </a></li>
                <li><a href="#">Centro de Costo</a></li>
                <li><a href="#">Cliente</a></li>
                <li><a href="#">Despacho</a></li>
                <li><a href="#">Forma de Pago</a></li>
                <li><a href="#">Perfil</a></li>
                <li><a href="#">Producto</a></li>
                <li><a href="#">Servicio</a></li>
                <li><a href="#">Usuario</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">

            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li>

            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-user"></i> <?php echo $_SESSION['nombreUsuario']; ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  
                  
  				
                  
                  
                <li><a href="../controller/dashboard.php?<?php echo SID; ?>&accion=editaMiPerfil" >
                        <i class="fa fa-user"></i> Profile</a></li>
                <li class="divider"></li>
                <li><a href="../index.php?accion=logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
