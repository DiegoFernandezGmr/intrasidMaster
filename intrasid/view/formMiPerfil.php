      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
			<img src="../view/images/logo_chico_100x78.png" />
            <h1 style="margin-top: -40px; margin-left: 100px; " >Mi Perfil <small>Actualiza Datos</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-user"></i> Mi Perfil - <?php echo $_SESSION['nombreUsuario']; ?></li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Bienvenido al Sistema de Lista de Tareas. Aqui encontrara las tareas que le han sido asignadas y que requieren su atencion. Tambien podra mirar las tareas sin asignar para solicitar al administrador que se las asigne si esta interesado en realizarlas.
            </div>
          </div>
        </div><!-- /.row -->


 
        <div class="row">
            <div class="col-lg-12">
         <div class="panel panel-primary">
            <div class="panel-heading">
                Perfil <?php echo $aDatos['nombreUsuario']; ?>
            </div>
            <div class="panel-body">

            <form class="form-horizontal" 
                  role="form" 
                  name="editaUsuario" 
                  action="../controller/actualizaUsuario.php"
                  method="POST" >

                <div class="form-group">
                    <label for="inputNombre3" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" 
                            name="nombre"
                            value="<?php if(isset($aDatos['nombreUsuario'])) echo $aDatos['nombreUsuario']; ?>"
                            class="form-control" 
                            id="inputNombre3" 
                            placeholder="Nombre" >
                    </div>
                </div>

              <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" 
                            name="email"
                            value="<?php if(isset($aDatos['emailUsuario'])) echo $aDatos['emailUsuario']; ?>"
                            class="form-control" 
                            id="inputEmail3" 
                            placeholder="Email">
                    </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" 
                         name="password1"
                         class="form-control" 
                         id="inputPassword3" 
                         placeholder="Nueva Password">
                </div> 
              </div>

              <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Re-Password</label>
                    <div class="col-sm-10">
                      <input type="password" 
                             name="password2"
                             class="form-control" 
                             id="inputPassword3" 
                             placeholder="Repita password">
                    </div>
              </div>

            <div class="form-group">
                <label for="inputNombre3" class="col-sm-2 control-label">Perfil</label>
                <div class="col-sm-10">
                
                  <select class="form-control" 
                  <?php if($_SESSION['perfilUsuario']!= ADMINISTRADOR) echo " id=\"disabledSelect\" "; ?>
                  >
                    <?php foreach($aPerfiles AS $aP){
                            echo "<option value='".$aP['id']."'";
                            if($_SESSION['perfilUsuario']==$aP['id']) echo "selected";
                            echo ">".$aP['nombre']."</option>";
                    }?>

                  </select>
                
                </div>
            </div>

            <input type="hidden" name="idUsuario" value="<?php if(isset($aDatos['idUsuario'])) echo $aDatos['idUsuario']; ?>" >
            <input type="hidden" name="accion" value="editaUsuario" >
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Grabar</button>
            </div>
          </div>
        </form>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->
