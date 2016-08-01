<?php 
    include("funciones.php");    
    $oCcosto = new Ccosto();
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
        var url = "../ajax/dataCategoria.php?idCcosto="+this.id; // El script a dónde se realizará la petición   
        $.ajax({
           type: "GET",
           url: url,
           success: function(data){
                    //alert(data);
                    var result = $.parseJSON(data);
                    $("#accionCRUD").val("upd");
                    $("#idCcosto").val(result.idCcosto); 
                    $("#nombre").val(result.nombre);    
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
            <li class="active"><i class="fa fa-pencil-square-o"></i> CRUD Ccosto</li>
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
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php    
    $data = $oCcosto->getCcostos($db);
    foreach($data AS $value){ ?>
      <tr>
        <td><?php echo $value['idCcosto'] ?></td>
        <td><?php echo $value['nombre'] ?></td>        
        <td>
            <?php
            if($oCcosto->tieneCcosto($db, $value['idCcosto']) ){ ?>
                <i class="fa fa-trash"></i>
            <?php
            }else{ ?>
                <a data-toggle="confirmation" 
                   data-title="¿Eliminar ccosto?"
                   target="_self"
                   href="#"
                   data-href="CRUDCcosto.php?accionCRUD=del&idCcosto=<?php echo $value['idCcosto'] ?>" 
                   id="<?php echo $value['idCcosto'] ?>" >
                   
                    <i class="fa fa-trash" style="color: #d9534f"></i>
                </a>
            <?php    
            } ?>
        </td>
        <td>
            <a href="#" class="upd" id="<?php echo $value['idCcosto'] ?>">
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
               name="formCcosto" 
               id="formCategoria" 
               method="POST"
               action="../controller/CRUDCcosto.php">
            <input type="hidden" 
                     id="accionCRUD" 
                     name="accionCRUD" 
                     value="add" >
            <input type="hidden" 
                     id="idCcosto" 
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
                         placeholder="Ingrese nombre"
                         required >
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

      

 