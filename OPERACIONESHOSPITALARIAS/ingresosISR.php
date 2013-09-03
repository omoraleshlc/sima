<?php require("menuOperaciones.php");
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />

  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el almacen/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este almacen!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=600,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria511 (URL){ 
   window.open(URL,"ventanaSecundaria511","width=700,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria5111 (URL){ 
   window.open(URL,"ventanaSecundaria5111","width=700,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria51111 (URL){ 
   window.open(URL,"ventanaSecundaria51111","width=700,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariam (URL){ 
   window.open(URL,"ventanaSecundariam","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventanaSecundaria5","width=700,height=600,scrollbars=YES") 
} 
</script>









<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundariaA (URL){ 
   window.open(URL,"ventanaSecundariaA","width=700,height=600,scrollbars=YES") 
} 
</script>






<?php


if($_POST['fecha']){
		 $date= $_POST['fecha'];
		 } else {
		 $date= $fecha1;
		 }
                 
                 
?>                 





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>

 <h1 align="center" >Hoja de Auditoria </h1>
 <form id="form1" name="form1" method="post" >
 <!--

	   <a href="javascript:ventanaSecundaria51('imprimirHojaAuditoria.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&entidad=<?php echo $entidad;?>')">Grupos</a>
	   -->
     

<br />
             <div align="center">Fecha:
                 <input name="fecha" type="text"  id="campo_fecha" size="11" maxlength="11" readonly=""
		value="<?php
		 echo $date;
		 ?>" />
               
                 
                  <input name="button" type="image" src="/sima/imagenes/btns/fecha.png" id="lanzador"/>
             </div>
  





   


<p>&nbsp;</p>
   <p align="center">
   
     <input type="submit" name="fv" id="fv" value="Generar Reporte" />
     
     <?php if($_POST['fv']!=NULL){?>
     <input type="button" name="poliza" id="fv" value="Enviar a poliza" onClick="javascript:ventanaSecundariam('../ventanas/enviaraPoliza.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>')" />
     <?php } ?>
   </p>
   
   

   
   
   
   
   
   
   
   
   
   
   
   
   
   
<?php    

$sSQL3= "Select * From headingPolicies WHERE entidad='".$entidad."' and fecha='".$date."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


if($myrow3['numPoliza']!=''){?> 
   
  <div id="ventaPublico">
  <h1>Poliza Enviada, # Poliza: <?php echo $myrow3['numPoliza'];?>  </h1>
  </div>
    

   
  <div id="ventaPublicoContent"> <br />
  
 


 
<a href="javascript:ventanaSecundaria51('../ventanas/imprimirTransaccionesHojaPoliza.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>&numPoliza=<?php echo $myrow3['numPoliza'];?>')">&nbsp;Transacciones Hoja&nbsp;</a>|
  
 
<a href="javascript:ventanaSecundaria511('../ventanas/imprimirHojaAuditoriaPoliza.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>&numPoliza=<?php echo $myrow3['numPoliza'];?>')">&nbsp;Hoja de Auditoria&nbsp;</a>|
    
<a href="javascript:ventanaSecundaria5111('../ventanas/imprimirMovimientosHojaPoliza.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>&numPoliza=<?php echo $myrow3['numPoliza'];?>')">&nbsp;Movimientos&nbsp;</a>|
  
  
<a href="javascript:ventanaSecundaria51111('../ventanas/imprimirConsultaExternaPoliza.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>&numPoliza=<?php echo $myrow3['numPoliza'];?>')">&nbsp;Consulta Externa&nbsp;&nbsp;</a>|
    
    
<a href="javascript:ventanaSecundariam('../ventanas/imprimirVentasDirectasPoliza.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>&numPoliza=<?php echo $myrow3['numPoliza'];?>')">&nbsp;Ventas Directas&nbsp;&nbsp;</a>
  
<a href="javascript:ventanaSecundariam('../ventanas/imprimirHonorariosMedicosPoliza.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>&numPoliza=<?php echo $myrow3['numPoliza'];?>')">&nbsp;Honorarios Medicos&nbsp;&nbsp;</a>

    
    
     
  
  
</div> 
   
      </div>

   
   
   
   
   
   
<?php    
}



























if($_POST['fv'] and !$_POST['resumen'] ){
if($_POST['fecha']<$fecha1){   ?>
   
   
   
 
   
  
  
<div align="center">
   
   
     <div id="ventaPublico">
  <h1>Poliza no enviadas</h1>
  </div>

<div id="ventaPublicoContent"> <br />
  
 


 
Transacciones Hoja <a href="javascript:ventanaSecundaria51('../ventanas/imprimirTransaccionesHoja.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>')" img src="../imagenes/pdf.png"  > <img src="../imagenes/pdf.png"> </a> <img src="../imagenes/exel.png">  |
  
 
Hoja de Auditoria <a href="javascript:ventanaSecundaria511('../ventanas/imprimirHojaAuditoria.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>')"img src="../imagenes/pdf.png"  > <img src="../imagenes/pdf.png"> </a> <img src="../imagenes/exel.png">  |
    
Movimientos <a href="javascript:ventanaSecundaria5111('../ventanas/imprimirMovimientosHoja.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>')"img src="../imagenes/pdf.png"  > <img src="../imagenes/pdf.png"> </a> <img src="../imagenes/exel.png">  |
  
  
C. Externa <a href="javascript:ventanaSecundaria51111('../ventanas/imprimirConsultaExterna.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>')"img src="../imagenes/pdf.png"  > <img src="../imagenes/pdf.png"> </a> <img src="../imagenes/exel.png">  |
    
    
Ventas Directas <a href="javascript:ventanaSecundariam('../ventanas/imprimirVentasDirectas.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>')"img src="../imagenes/pdf.png"  > <img src="../imagenes/pdf.png"> </a> <img src="../imagenes/exel.png">  |  
  

Honorarios Medicos <a href="javascript:ventanaSecundariam('../ventanas/imprimirHonorariosMedicos.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>')"img src="../imagenes/pdf.png"  > <img src="../imagenes/pdf.png"> </a> <img src="../imagenes/exel.png">  
    
    
     
  
  
</div>
   
  </div> 
  
  
<div align="center">
   
   
     <div id="ventaPublico">
  <h1>&nbsp;</h1>
  </div>

<div id="ventaPublicoContent"> <br />
  
 

  

Notas de Credito<a href="javascript:ventanaSecundariam('../ventanas/imprimirHonorariosMedicos.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>')"img src="../imagenes/pdf.png"  > <img src="../imagenes/pdf.png"> </a> <img src="../imagenes/exel.png">  
    
    
     
  
  
</div>
   
  </div> 
  
   
<?php 
}else{
echo '<script>';
echo 'window.alert("La fecha debe ser menor a hoy..");';
echo '</script>';
}
}
 
?>

</form>
 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
     </script>
</body>
</html>