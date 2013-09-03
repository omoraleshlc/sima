<?php require("menuOperaciones.php");
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
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
                alert("Por Favor, escribe la descripción de este almacen!")   
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
   window.open(URL,"ventana1","width=600,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria511 (URL){ 
   window.open(URL,"ventanaSecundaria511","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA (URL){ 
   window.open(URL,"ventanaSecundariaA","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA2 (URL){ 
   window.open(URL,"ventanaSecundariaA2","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA1 (URL){ 
   window.open(URL,"ventanaSecundariaA1","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria5111(URL){ 
   window.open(URL,"ventanaSecundaria5111","width=800,height=600,scrollbars=YES") 
} 
</script>






<?php 



if($_POST['fv'] and !$_POST['resumen'] ){
 $random=rand(1,900000000);

$q = "insert into contador 
(
usuario,random)
values
('".$usuario."','".$random."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQL7ab="SELECT * 
FROM
contador
WHERE
usuario='".$usuario."'
and
random='".$random."'
order by keyConta DESC

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	
?>
<script>
//javascript:ventanaSecundaria511('despliegaxFVExternos.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $myrow7ab['random'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>');
//window.alert("Se genero el numero de reporte: <?php print $myrow7ab['random'];?>");

</script>
<?php 
}
?>













<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<br />
 <h1 align="center" class="titulos">Folios Cerrados Externos </h1>
 <form id="form2" name="form2" method="post" action="">


<div align="center">
         Fecha inicial: 
         <input name="fechaInicial" type="text" class="camposmid" id="campo_fecha1" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  />

         <input name="button" type="image" id="lanzador1" src="/sima/imagenes/btns/fecha.png" />

       </div>
       
       <div align="center">
         Fecha final: 
         <input name="fechaFinal" type="text" class="camposmid" id="campo_fecha2" size="11" maxlength="11" readonly="readonly"
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  />
   
         <input name="button1" type="image" id="lanzador2" src="/sima/imagenes/btns/fecha.png" />
         
       </div>
   

      


<p>&nbsp;</p>
   <p align="center">
     
     <?php if($random){ ?>
     <label>
<a href="javascript:ventanaSecundaria51('../ventanas/despliegaAcumuladoGPO.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $_POST['random'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>')"></a>     </label>
   </p>
   
   <p align="center"><a href="javascript:ventanaSecundariaA(../ventanas/'resumenGlobalCerradas.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>');"></a></p>
   
   <p align="center">
   
   <a href="javascript:ventanaSecundariaA1('../ventanas/resumenIVA.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>');"></a>   </p>
  
 
 
<div id="encabezado">
<p align="center">Folios Cerrados Externos </p>
</div>
<div id="contener"> 
<div id="liga1">
&nbsp; <br />
	   <a href="javascript:ventanaSecundariaA('../ventanas/reporteHonorariosExternos.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&entidad=<?php echo $entidad;?>');">
Honorarios</a><br />

<a href="javascript:ventanaSecundariaA('../ventanas/reporteVentasDirectas.php?entidad=<?php echo $entidad;?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>');">
Ventas directas</a>

<div id="liga2">
&nbsp; <br />
<a href="javascript:ventanaSecundariaA('../ventanas/reporteVentasExternos.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&amp;entidad=<?php echo $entidad;?>');">
Ventas externos</a><br />

<a href="javascript:ventanaSecundariaA('../ventanas/detalleVentasExternos.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&amp;entidad=<?php echo $entidad;?>');">

Detalles externos</a>
</div>


<div id="liga3">
&nbsp;<br />
<a href="javascript:ventanaSecundariaA('../ventanas/detallesFoliosVentaExternos.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&amp;entidad=<?php echo $entidad;?>');">
Folios de venta</a><br />

<a href="#" >
&nbsp;</a>
</div>

</div>
</div>
  

   <p>&nbsp;</p>
   <p align="center">
     <label></label>
     <?php } ?>
   </p>
   <p align="center">
     <input type="hidden" name="bandera" id="bandera" value="<?php echo $a;?>" />
     
     <input type="submit" name="fv" id="fv" value="Generar Reporte" />
     <input type="hidden" name="random" id="random" value="<?php echo $random;?>" />
   </p>
   <p align="center">
<a href="javascript:ventanaSecundaria5111('../ventanas/resumenGlobalCerradas.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $myrow7ab['random'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>')" ></a>   </p>
</form>
 
<p align="center">&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script> 
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha2",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador2"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>