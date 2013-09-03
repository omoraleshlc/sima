<?php require("menuOperaciones.php");?> 

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>




 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>



<?php
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>

<form id="form10" name="form10" method="post" >
  <h1 align="center" > <?php echo $TITULO; ?>Reporte de Folios Pacientes Internos
    <label></label></h1>
  <p>
   
  </p>
  <p align="center"><span >
    <label></label>
    <label></label>
  </span> </p>
  
  
   <table width="200" class="table-forma">
     <tr>
       <td scope="col"><div align="left">De la fecha</div></td>
       <td scope="col">         <div align="left">
         <input name="fechaInicial" type="text"  id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaInicial']){
	  echo $_POST['fechaInicial'];
	  } else {
	  if($myrow3['hoy']){
	  echo $myrow3['hoy'];
	  } else {
	  echo $fecha1; }} ?>" size="10" readonly="" />       
       </div></td>
       <td scope="col">         <div align="left">
         <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" id="lanzador" />       
       </div></td>
     </tr>
     <tr>
       <td><div align="left"></div></td>
       <td>         <div align="left">
         <input name="fechaFinal" type="text"  id="campo_fecha1"
	  value="<?php 
	  if($_POST['fechaFinal']){
	  echo $_POST['fechaFinal'];
	  } else {
	  if($myrow3['hoy']){
	  echo $myrow3['hoy'];
	  } else {
	  echo $fecha1; }} ?>" size="10" readonly="" />       
       </div></td>
       <td>         <div align="left">
         <input name="button2" type="image"src="/sima/imagenes/btns/fecha.png" id="lanzador1"/>       
       </div></td>
     </tr>
     <tr>
       <td><div align="left"></div></td>
       <td>         <div align="left">
         &nbsp;      
       </div></td>
       <td><div align="left"></div></td>
     </tr>
   </table>
  
  <input name="show" type="submit" class="style7" id="show" value="mostrar" />
  <p align="center" >
    <?php if($_POST['show'] ){?>
  </p>

  <table width="756" class="table table-striped">
    <tr>
      <th width="44"   scope="col"><div align="left">Folio</div></th>
      <th width= "134"   scope="col"><div align="left">Paciente</div></th>
      <th width= "208"   scope="col"><div align="left">Particular/Compa&ntilde;&iacute;a</div></th>
	  <th   scope="col"><div align="left">Departamento</div></th>
	  <th   scope="col"><div align="left">Status</div></th>
	  <th   scope="col"><div align="left">Usuario Cierre</div></th>
	  <th   scope="col">E/C</th>
	  <th   scope="col"><div align="left" ><span class="style11 style13">N/V</span></div></th>
    </tr>
    <tr>
      <?php	


$sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
fecha between '".$_POST['fechaInicial']."' and '".$_POST['fechaFinal']."'
and
folioVenta!='' and folioVenta!='0'
order by folioVenta asc
 ";
 

 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$a+=1;
$nT=$myrow['keyClientesInternos'];
	  ?>
      <td height="24" bgcolor="<?php echo $color?>" ><?php echo $myrow['folioVenta'];
?></td>


      <td width="134" bgcolor="<?php echo $color?>" class="normal">


	  	  <?php 

$verificaCargos=new acumulados();
$verificaCargos->verificaCargos($basedatos,$usuario,$numeroE,$nCuenta);
if($myrow['paciente']){	  
?>

	  <?php echo $myrow['paciente'];?>
	  <?php }  else {?> 
	  <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
	  
	  <?php }  
	  ?> 
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="208" bgcolor="<?php echo $color?>" class="normal"><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "PARTICULAR";
		  }
?></span></td>

<td width="128" bgcolor="<?php echo $color?>" class="normal"><?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></td>

<td width="44" bgcolor="<?php echo $color?>" ><?php echo $myrow['status'];?></td>
<td width="108" bgcolor="<?php echo $color?>" ><?php 
if($myrow['usuarioCierre']==''){
echo '---';
}else{

echo $myrow['usuarioCierre'];
}
?></td>
<td width="25" bgcolor="<?php echo $color?>" >

<div align="center"><a href="#" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>')"><img src="/sima/imagenes/listado.jpg" alt="Pacientes Activos" width="12" height="12" border="0" /></a></div></td>
<td width="31" bgcolor="<?php echo $color?>" >
    <a href="javascript:ventanaSecundaria('/sima/INGRESOS HLC/caja/imprimirEstadoCuenta.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')"> <img src="../imagenes/printer.jpg" alt="" width="20" height="18" border="0" /></a></td>
    </tr> 
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
  

  <?php } ?>
  <?php if($_POST['show'] and $a==0){
print ' No hay registros para mostrar!';
}
?>
<p>&nbsp;</p>
</form>

  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script>

</body>

</html>