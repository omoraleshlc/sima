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
                alert("Por Favor, escribe la descripcion de este almacen!")   
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



<?php 



if($_POST['fv'] and !$_POST['resumen'] ){
if($_POST['fecha']<=$fecha1){
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
$s='si';
}else{
echo '<script>';
echo 'window.alert("La fecha debe ser menor a hoy..");';
echo '</script>';
$s='';
}
}
?>


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
<h1 align="center" >&nbsp;</h1>
<h1 align="center" >
POLIZA DE DIARIO
</h1>
 <form id="form2" name="form2" method="post" action="">

     
     
     
     

            <div align="center">Fecha:
                 <input name="fecha" type="text" class="camposmid" id="campo_fecha" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fecha']){
		 echo $_POST['fecha'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
                 <br />
             </div>
             
             <div align="center">
         <input name="button"type="image"src="/sima/imagenes/btns/fecha.png" />
       </div>
             
   <p align="center">
   
     <input type="submit" name="fv" id="fv" value="Generar Reporte" />
   </p>
   
</form>


 
 
 
 
 
<?php if($s!=NULL){?> 
<br>

<div id="encabezado" >
<p>Ventas y consumos por departamentos</p>
</div>



<div >
<p>
<a href="javascript:ventanaSecundaria51('../ventanas/agrupadoPolizaDiario.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >    
Poliza
</a>
</p>
</div>



<div id="contener" >
<div id="liga1" >

    
    
<span>Venta de Botiquin</span><br />


<a href="javascript:ventanaSecundaria51('../ventanas/agrupadoReposicion.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >
<span>
Agrupado
</span>
    
</a>
<br />



<a href="javascript:ventanaSecundaria51('../ventanas/detallesReposicion.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >
<span>Auxiliares</span></a>

<div id="liga2" >
Solicitudes Directas<br />

    
<a href="javascript:ventanaSecundaria51('../ventanas/agrupadoSolicitudes.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >    
Agrupado</a><br />

<a href="javascript:ventanaSecundaria51('../ventanas/detallesSolicitudes.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >
Auxiliares</a>
</div>


<div id="liga3" >

Consumo de Almacenes 
<br />
<a href="javascript:ventanaSecundaria51('../ventanas/agrupadoTraspasos.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >
Agrupado
</a>
<br />

<a href="javascript:ventanaSecundaria51('../ventanas/detallesTraspasos.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >
Auxiliares</a>
</div>


<div id="liga4" >

Consumo de Farmacia 
<br />
<a href="javascript:ventanaSecundaria51('../ventanas/agrupadoFarmacia.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >
Agrupado
</a>
<br />

<a href="javascript:ventanaSecundaria51('../ventanas/detallesFarmacia.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >
Auxiliares</a>
</div>


</div>
</div>



<div id="encabezado" >
<p>

    Registro de facturas

</p>
</div>

<div id="contener" >
<div id="liga1" >
<span>&nbsp;</span><br />
<a href="#" target="_new" >
<span>
&nbsp;</span></a><br />

<a href="#" target="_new" >
<span>&nbsp;</span></a>

<div id="liga2" >
Compras <br />
<a href="javascript:ventanaSecundaria51('../ventanas/detallesFacturaCompras.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >
Detalles</a><br />


</div>


<div id="liga3" >
&nbsp; <br />
<a href="#" target="_new">
&nbsp;</a><br />

<a href="#" target="_new" >
&nbsp;</a>
</div>
</div>
</div>



<div id="encabezado" >
<p>Reporte entrada de remisi&oacute;n</p>
</div>

<div id="contener" >
<div id="liga1" >
<span>&nbsp;</span><br />
<a href="#" target="_new" >
<span>
&nbsp;</span></a><br />

<a href="#" target="_new" >
<span>&nbsp;</span></a>

<div id="liga2" >
<a href="javascript:ventanaSecundaria51('../ventanas/detallesRemisionCompras.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >    
Consignaciones 
</a>
<br />



</div>


<div id="liga3" >
&nbsp; <br />
<a href="#" target="_new">
&nbsp;</a><br />

<a href="#" target="_new" >
&nbsp;</a>
</div>
</div>
</div>



<div id="encabezado" >
<p>Costo por venta de mercancias en consignacion</p>
</div>

<div id="contener" >
<div id="liga1" >
<span>&nbsp;</span><br />
<a href="#" target="_new" >
<span>
&nbsp;</span></a><br />

<a href="#" target="_new" >
<span>&nbsp;</span></a>

<div id="liga2" >
Consignaciones <br />
<a href="javascript:ventanaSecundaria51('../ventanas/detallesRemisionVentas.php?entidad=<?php echo $entidad;?>&fecha=<?php echo $_POST['fecha'];?>',800,500)"  >    
Detalles</a><br />


</div>


<div id="liga3" >
&nbsp; <br />
<a href="#" target="_new">
&nbsp;</a><br />

<a href="#" target="_new" >
&nbsp;</a>
</div>
</div>
</div>

<?php } ?>

 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
     </script>
</body>
</html>




