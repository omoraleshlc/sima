<?php require("menuOperaciones.php"); ?>

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>
<br>
<META HTTP-EQUIV="Refresh"
CONTENT="30"> 
<body>
<h1 align="center">Ajustar recepci&oacute;n de Art&iacute;culos Posteriores </h1>
<form id="form2" name="form2" method="post" action="">
  <label>
  <div align="center"><span ><span >
  <input name="fecha" type="text"  id="campo_fecha"
	  value="<?php echo $fecha1;?>" size="10" readonly="" />
  <span >
  <input name="button" type="image"  id="lanzador" value="fecha"  src="/sima/imagenes/btns/fechadate.png"/>
  </span>  </span></span>
    <input name="busca" type="submit"  id="busca" value="Buscar" />
  </div>
  </label>
</form>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="recepcionArticulosPosteriores2.php">
 
  <table width="383" class="table table-striped">
    <tr>
      <th width="142"  scope="col"><span ># REQUISICION </span></th>
      <th width="231"  scope="col"><span >PROVEEDOR</span></th>
    </tr>
    <tr>
<?php	
if(!$_POST['fecha']){
$_POST['fecha']=$fecha1;
}

$sSQL18= "
SELECT 
*
FROM
listaOC
where 
status ='facturado'
and 
fecha='".$_POST['fecha']."'
order by keyREQ DESC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$b+='1';
$as+='1';
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];
$descripcion=descripcion($code=$code1,$basedatos);

if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$a=$myrow18['id_almacen'];
$sSQL7= "Select * From almacenes WHERE almacen= '".$a."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$R=$myrow18['nRequisicion'];
$P=$myrow18['id_proveedor'];
$sSQL2= "Select * From proveedores WHERE id_proveedor= '".$P."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
?>
      <td height="24" bgcolor="<?php echo $color?>" ><span >
        <label>
        <input name="nRequisicion" type="submit"  id="nRequisicion" value="<?php echo $R?>" />
      </label></span></td>
      <td bgcolor="<?php echo $color?>" ><span >
        <label></label>
        <?php 
		if($myrow2['razonSocial']){
		echo $myrow2['razonSocial'];
		} else {
		echo "---";
		}
		?></span></td>
    </tr>
    <?php }} //cierra while ?>
  </table>

<div align="center"><strong>
    <?php if($as){ 
	echo "Se encontraron $as Registros..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>

    <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen']; ?>" />
  </p>
</form>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>