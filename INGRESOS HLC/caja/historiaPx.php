<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); include('/configuracion/funciones.php');?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
-->
</style>
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

<form id="form10" name="form10" method="get" action="#">
  <h1 align="center" class="titulo"> <?php echo $TITULO; ?>REPORTE DE FOLIOS DE VENTA</h1>
  <p align="center" class="titulo">
    <label>
    <input onChange="this.form.submit();" name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 echo $date;
		 ?>"/>
    </label>
    <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
</p>
  <table width="864" border="0.2" align="center">
    <tr>
      <th width="74" bgcolor="#660066" class="blanco" scope="col"><div align="left">Referencia</div></th>
      <th width= "214" bgcolor="#660066" class="blanco" scope="col"><div align="left">Nombre del paciente:</div></th>
      <th width= "270" bgcolor="#660066" class="blanco" scope="col"><div align="left">Aseguradora</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Departamento</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Usuario</div></th>
	  <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco"><span class="style11 style13">N/V</span></div></th>
    </tr>
    <tr>
      <?php	



$sSQL= "SELECT *

from clientesInternos
where
entidad='".$entidad."'
AND
statusCaja='pagado' 
and
fecha1='".$date."'
ORDER BY paciente ASC
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

$nT=$myrow['keyClientesInternos'];
	  ?>
      <td height="24" bgcolor="<?php echo $color?>" class="codigos"><?php echo $myrow['folioVenta'];
?></td>


      <td width="214" bgcolor="<?php echo $color?>" class="normal">


	  <?php echo $myrow['paciente'];?>

          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="270" bgcolor="<?php echo $color?>" class="normal"><?php 
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
		  echo "Sin Seguro";
		  }
?></span></td>

<td width="184" bgcolor="<?php echo $color?>" class="normal"><?php
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

<td width="71" bgcolor="<?php echo $color?>" class="codigos"><?php
echo $myrow['usuario'];
?></td>

<td width="20" bgcolor="<?php echo $color?>" class="style12">
    <a href="javascript:ventanaSecundaria('imprimirEstadoCuenta.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')"> <img src="/sima/imagenes/printer.jpg" alt="" width="20" height="18" border="0" /></a>
  
</td>
    </tr> 
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>






  <p>&nbsp;</p>
</form>

    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
    </script> 

</body>
</html>
