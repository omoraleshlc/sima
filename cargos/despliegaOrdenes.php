<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=730,height=500,scrollbars=YES") 
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
<?php
//***********************CAMBIAR ALMACEN****************************
if($_POST['almacen']){
$sSQL17= "Select * From sesionesAlmacen WHERE usuario = '".$usuario."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$ali=$myrow17['almacen'];
if(!$myrow17['usuario']){

$agrega = "INSERT INTO sesionesAlmacen ( usuario,almacen
) values (
'".$usuario."',
'".$_POST['almacen']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

} else {

$q1 = "UPDATE sesionesAlmacen set 
almacen='".$_POST['almacen']."'
WHERE usuario = '".$usuario."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
//paciente_actualizado();
}
}
//**********************CIERRO CAMBIAR ALMACEN******************************




if($_POST['solicitar'] AND $_POST['request'] and $_POST['cantidad']){
$codigo=$_POST['request'];
$cantidad=$_POST['cantidad'];
$code1=$_POST['codigoAlfa'];
$banderaCantidad=$_POST['banderaCantidad'];
for($i=0;$i<=$_POST['pasoBandera'];$i++){

$s=$banderaCantidad[$i]+1;
//echo $code1[$i].$cantidad[$i].'<br>';

if( $id_almacen=$_POST['id_almacen'] and $cantidad[$i] ){


if($code1[$i] and $cantidad[$i]){
$sSQL17= "Select * From OC WHERE codigo= '".$code1[$i]."' and id_almacen='".$_POST['almacen']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
if(!$myrow17['codigo']){
 $agregaSaldo = "INSERT INTO OC ( codigo,almacen,usuario,fecha,hora,ID_EJERCICIO,cantidad
) values ('".$code1[$i]."','".$_POST['id_almacen']."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$cantidad[$i]."')";
//mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
} else {
$q1 = "UPDATE OC set 
cantidad='".$cantidad[$i]."'
WHERE codigo = '".$code1[$i]."'
and
almacen='".$_POST['almacen']."'
";
//mysql_db_query($basedatos,$q1);
}
}
}}

}


if($_POST['quitar'] AND $_POST['remover']){
$codigo=$_POST['remover'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){
$remover = "DELETE From OC where codigo='".$codigo[$i]."' and almacen ='".$_POST['almacen']."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();


}
}

?>

<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-system.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<h1 align="center" class="titulos">Ordenes de Compra </h1>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="191" border="0" align="center">
    <tr valign="middle" class="style71">
      <th width="49" class="negro" scope="col"><span class="Estilo25">
        <input name="button" type="image"  id="lanzador" value="fecha"  src="/sima/imagenes/btns/fechadate.png"/>
      </span></th>
      <th width="283" scope="col"><div align="left">
          <input name="fechaSolicitud" type="text" class="camposmid" id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud']){
	  echo $fecha2=$_POST['fechaSolicitud'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" onchange="javascript:this.form.submit();"/>
      </div></th>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <table width="214" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <th width="58" scope="col"><div align="left" class="normal">Req.</div></th>
      <th width="58" scope="col"><div align="left" class="normal">Status </div></th>
      <th width="82" scope="col"><div align="left" class="normal">Imprimir</div></th>
    </tr>
    <tr>
<?php	


$sSQL18= "
SELECT 
*
FROM
requisiciones
where
fecha='".$fecha2."'


";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$id_proveedor=$myrow18['id_proveedor'];
$b+='1';
$a+='1';
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];

$requisicion=$myrow18['id_requisicion'];
$id_almacen=$myrow18['id_almacen'];
$id_proveedor=$myrow18['id_proveedor'];
if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL8= "Select * From existencias WHERE codigo= '".$code1."' and almacen='".$_POST['id_almacen']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

/* $sSQL2= "Select * From articulos WHERE codigo= '".$code1."' and almacen='".$_POST['id_almacen']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2); */

?>
      <td height="24" bgcolor="<?php echo $color?>" class="negromid">
        <label><?php echo $myrow18['id_requisicion'];?></label></span></td>
      <td bgcolor="<?php echo $color?>" class="negromid"><?php echo $myrow18['status']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label>
        <div align="center">
		
		<?php if( $myrow18['status']=='aprobado'){?>
		<a href="javascript:ventanaSecundaria('listadoOrdenesImpresion.php?keyR=<?php echo $myrow18['keyR']; ?>&amp;id_proveedor=<?php echo $id_proveedor; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"><img src="../../imagenes/btns/printbtn.png" alt="Imprimir " width="22" height="20" border="0" /></a>
		<?php } else {
		
		echo '---';
		}?>
		
		
		</div>
      </label></td>
    </tr>
    <?php  }} //cierra while ?>
  </table>
  <div align="center" class="codigos">
    <p><strong><br />
      <?php if($a){ 
	echo "Se encontraron $a Registros..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?>
    </strong></p>
  </div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>
    <label></label>
    <input name="id_almacen" type="hidden" id="id_almacen" value="<?php echo $_POST['id_almacen']; ?>" />
    <span class="Estilo24">
    <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
  </span></p>
  <p align="center"><a href="javascript:ventanaSecundaria('listadoOrdenesImpresion.php?id_requisicion=<?php echo $myrow1['numeroE']; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a><a href="javascript:ventanaSecundaria('listadoOrdenesImpresion.php?id_requisicion=<?php echo $_POST['nRequisicion']; ?>&amp;id_proveedor=<?php echo $id_proveedor; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a></p>
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