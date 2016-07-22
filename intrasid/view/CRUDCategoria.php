<?php 
    include("funciones.php");
    $oCategoria = new Categoria();
    $oCCosto = new CCosto();
?>
 <script>
$(document).ready( function () {
    $('#tabla-de-datos').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    }),
    $('[data-toggle=confirmation]').confirmation({
        btnOkLabel : 'Eliminar',
        popout: true,
        singleton: true,
        copyAttributes : 'href target',
        btnCancelLabel: 'Cancelar'
    }),
    $(".upd").click(function(){
        var url = "../ajax/dataCategoria.php?idCategoria="+this.id; // El script a dónde se realizará la petición   
        $.ajax({
           type: "GET",
           url: url,
           success: function(data){
                    //alert(data);
                    var result = $.parseJSON(data);
                    $("#accionCRUD").val("upd");
                    $("#idCategoria").val(result.idCategoria); 
                    $("#nombre").val(result.nombre); 
                    $("#ordenFormulario").val(result.ordenFormulario); 
                    $("#idCCosto"+result.idCCosto).attr('checked', true);    
	        }
        });
    });
} );

 </script>
<div id="page-wrapper">
<?php  html_mensajes(); ?>
    <div class="row">
      <div class="col-lg-12">
        <img src="../view/images/logo_chico_100x78.png" />
        <h1 style="margin-top: -40px; margin-left: 100px; " >Escritorio <small>Mantenedores</small></h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-pencil-square-o"></i> CRUD Categor&iacute;a</li>
        </ol>

      </div>
    </div><!-- /.row -->
        
    <div class="row">
      <div class="col-lg-12">
    <table class="table table-striped table-bordered" id="tabla-de-datos">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Orden</th>
        <th>CCosto</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php    
    $data = $oCategoria->getCategorias($db);
    foreach($data AS $value){ ?>
      <tr>
        <td><?php echo $value['idCategoria'] ?></td>
        <td><?php echo $value['nombre'] ?></td>
        <td><?php echo $value['ordenFormulario'] ?></td>
        <td><?php echo $value['nombreCCosto'] ?></td>
        <td>
            <?php
            if($oCategoria->tieneHijos($db, $value['idCategoria']) ){ ?>
                <i class="fa fa-trash"></i>
            <?php
            }else{ ?>
                <a data-toggle="confirmation" 
                   data-title="¿Eliminar categoría?"
                   target="_self"
                   href="#"
                   data-href="CRUDCategoria.php?accionCRUD=del&idCategoria=<?php echo $value['idCategoria'] ?>" 
                   id="<?php echo $value['idCategoria'] ?>" >
                   
                    <i class="fa fa-trash" style="color: #d9534f"></i>
                </a>
            <?php    
            } ?>
        </td>
        <td>
            <a href="#" class="upd" id="<?php echo $value['idCategoria'] ?>">
                <i class="fa fa-pencil"></i>
            </a>
        </td>
      </tr>  
    <?php } ?>
      
    </tbody>
  </table>
    </div>
 </div><!-- /.row -->
 
 <div class="row">
    <div class="col-lg-12">
        <!-- FORMULARIO DE INGRESO NUEVO REGISTRO -->
         <form class="form-horizontal" 
               role="form" 
               name="formCategoria" 
               id="formCategoria" 
               method="POST"
               action="../controller/CRUDCategoria.php">
            <input type="hidden" 
                     id="accionCRUD" 
                     name="accionCRUD" 
                     value="add" >
            <input type="hidden" 
                     id="idCategoria" 
                     name="idCategoria" 
                     value="" >
            <div class="form-group">
                <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                <div class="col-sm-10">
                  <input type="text" 
                         class="form-control" 
                         id="nombre"
                         name="nombre"
                         value=""
                         placeholder="Ingrese nombre categoria"
                         required >
                </div>
            </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="ordenFormulario">Orden formulario:</label>
            <div class="col-sm-10">
              <input type="number" 
                     class="form-control" 
                     id="ordenFormulario" 
                     name="ordenFormulario" 
                     required >
            </div>
          </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="idCCosto">Centro de costo:</label>
                <div class="col-sm-10">
                  <?php    
                    $data = $oCCosto->getCCostos($db);
                    $flag=true;
                    foreach($data AS $value){ ?>  
                  <label class="radio-inline">
                      <input type="radio" 
                             name="idCCosto"
                             id="idCCosto<?php echo $value['idCCosto'] ?>"
                             value="<?php echo $value['idCCosto'] ?>"
                             <?php if($flag){ echo "checked"; $flag=false; }; ?> 
                             >
                      <?php echo $value['nombre'] ?>
                  </label>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Submit</button>
                </div>
              </div>
            </form>
    </div>
 </div><!-- /.row -->   

      

 