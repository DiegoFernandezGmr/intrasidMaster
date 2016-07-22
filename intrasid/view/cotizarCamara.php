<?php 
    include("funciones.php");
?>
<div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
			<img src="../view/images/logo_chico_100x78.png" />
            <h1 style="margin-top: -40px; margin-left: 100px; " >Escritorio <small>Cotizador Cámaras de Vigilancia</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-calculator"></i> Cotizador Cámaras de Vigilancia</li>
            </ol>
            
          </div>
        </div><!-- /.row -->
 
        
        <form  name="cotizador" 
               id="cotizador" 
               role="form" 
               action="../controller/grabaCotizacion.php"
               method="post">
         <input type="hidden" name="accion" value="grabaCotizacion">   
            
        <div class="row">
        
            <div class="col-lg-8">
                <!-- PANEL LISTA DECOS -->
                <?php html_lista_productos_form($db,CCOSTOCCTV,1); ?>
            </div> 
            <div class="col-lg-4">
                <!-- PANEL TOTAL -->
                <div class="panel panel-primary">
                    <div class="panel-heading">TOTAL</div>
                    <div class="panel-body"><h1><span class="label label-primary" id="respuesta" >0</span></h1></div>
                </div>
                
            </div> 
        </div><!-- /.row -->
    
        <div class="row">
            <div class="col-lg-6">
                <!-- PANEL LISTA MATERIALES -->
                <?php html_lista_productos_form($db,CCOSTOCCTV,2); ?>
            </div>
            <div class="col-lg-6">
                <!-- PANEL LISTA SERVICIOS -->
                <?php html_lista_servicios_form($db,CCOSTOCCTV); ?>
            </div>
        </div><!-- /.row -->
 
        <div class="row">
            <div class="col-lg-12">
                <a href="#" class="btn btn-lg btn-success" 
                   data-toggle="modal" 
                    data-target="#myModal">Enviar</a>
            <!--<button type="submit" class="btn btn-default">Submit</button>-->
        
        </div><!-- /.row -->

       
      
      
      <!-- VENTANA MODAL -->
      
      
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Datos cliente</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
            <div class="col-lg-6">
                <!-- PANEL LISTA DESPACHOS -->
                <?php html_lista_despachos_form($db); ?>
            </div>
            <div class="col-lg-6">
                <!-- PANEL LISTA FORMAS DE PAGO -->
                <?php html_lista_formasPago_form($db); ?>
            </div>
            </div><!-- /.row -->
            
            <div class="row">
            <div class="col-lg-2">
                
            </div>
                <div class="col-lg-8">
                <!-- PANEL TOTAL -->
                <div class="panel panel-primary">
                    <!--<div class="panel-heading">TOTAL FINAL</div>-->
                    <div class="panel-body"><h1><span class="label label-primary" id="valorFinal" >0</span></h1></div>
                </div>
                
            </div> 
            <div class="col-lg-2">
                
            </div>
            </div><!-- /.row -->
            
            
            
            
          <label for="correo">Correo:</label>
                <input type="email" 
                       class="form-control" 
                       id="correo"
                       name="correo" required />
           <label for="nombres">Nombre Apellido:</label>
                <input type="text" 
                       placeholder="nombres"
                       class="form-control" 
                       id="nombres"
                       name="nombres" />
                <input type="text" 
                       class="form-control" 
                       placeholder="apellidos"
                       id="apellidos"
                       name="apellidos" />
                
                
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-default" >Enviar cotizaci&oacute;n</button>
        </div>
      </div>
      
    </div>
  </div>
      
      <!-- FIN VENTANA MODAL -->
  </form>    
  </div><!-- /#page-wrapper -->    
      
<script>
$(function(){
   $("input").change(function(){
       //var nombre=this.val();
       var nomElemento = $(this).attr("name");
       if(nomElemento.indexOf("check")>=0){
         if(this.checked){
            if(nomElemento.indexOf("checkS")>=0){
                nomCantidad=nomElemento.replace("checkS", "cantS");
            }else{
                if(nomElemento.indexOf("checkP")>=0){
                    nomCantidad=nomElemento.replace("checkP", "cantP");
                }
            }
            nomCantidad="#"+nomCantidad;
            $(nomCantidad).val(1);
            $(nomCantidad).removeAttr('readonly');
          }else{
            if(nomElemento.indexOf("checkS")>=0){
                nomCantidad=nomElemento.replace("checkS", "cantS");
            }else{
                nomCantidad=nomElemento.replace("checkP", "cantP");
            }
            nomCantidad="#"+nomCantidad;
            $(nomCantidad).val(null);
            $(nomCantidad).prop("readonly", true);
          }
        }else{
            
        }
   
    var url = "../ajax/valoriza.php"; // El script a dónde se realizará la petición
    $.ajax({
           type: "POST",
           url: url,
           data: $("#cotizador").serialize(), // Adjuntar los campos del formulario enviado.
	           success: function(data)
	           {
	               
                       //alert(data);
                       var result = $.parseJSON(data);
                       var numFormato=new String();
                       
                       if(String(result.valor).length>3){
                           numFormato="$ "+String(result.valor).slice(0,String(result.valor).length-3)+"."+String(result.valor).slice(String(result.valor).length-3,String(result.valor).length);
                       }else{
                           numFormato=result.valor;
                       }
                       $("#respuesta").html(numFormato); // Mostrar la respuestas del script PHP.
                       var valorFinal = (parseInt(result.valor)+parseInt(result.valorDespacho))*(1+(parseInt(result.porcentajeCargo)/100));
                       
                       if(String(valorFinal).length>3){
                           numFormato="$ "+String(valorFinal).slice(0,String(valorFinal).length-3)+"."+String(valorFinal).slice(String(valorFinal).length-3,String(valorFinal).length);
                       }else{
                           numFormato=result.valorFinal;
                       }
                       $("#valorFinal").html(numFormato);
	           }
	         });
	    return false; // Evitar ejecutar el submit del formulario.
   
});


}); 
</script>
      
      
