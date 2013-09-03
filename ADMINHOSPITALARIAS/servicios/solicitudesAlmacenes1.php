<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include("/configuracion/funciones.php"); ?>


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
<?php
$requisicion=$_POST['nRequisicion'];
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




if($_POST['solicitar']  and $_POST['cantidad']){

$codigo=$_POST['request'];
$cantidad=$_POST['cantidad'];
$codigo=$code1=$_POST['codigoAlfa'];
$banderaCantidad=$_POST['banderaCantidad'];


for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($cantidad[$i]){
$sSQL6= "Select * From existencias WHERE codigo= '".$code1[$i]."' and almacen='HALM' ";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
$cantidadEnCendis=$myrow6['existencia'];
$myrow6['existencia']." ".$cantidad[$i];
if($myrow6['existencia']>=$cantidad[$i]){

$sSQL3= "Select * from requisiciones 
where  id_requisicion='".$_POST['nRequisicion']."' and codigo= '".$codigo[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$cantidadSolicitada=$myrow3['cantidad'];
$id_almacen=$myrow3['id_almacen'];

$sSQL11= "Select * from existencias
where  codigo= '".$code1[$i]."' and almacen='".$id_almacen."' ";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$cantidadEnAlmacen=$myrow11['existencia'];

if($cantidadSolicitada>=$cantidad[$i]){
$q1 = "UPDATE requisiciones set 
cantidad='".$cantidadSolicitada."'-'".$cantidad[$i]."'
WHERE codigo = '".$codigo[$i]."'
and
id_requisicion='".$_POST['nRequisicion']."' 
";
mysql_db_query($basedatos,$q1);
echo mysql_error();


$q4 = "UPDATE existencias set 
existencia='".$cantidadEnAlmacen."'+'".$cantidad[$i]."',
usuario='".$usuario."',
fechaA='".$fecha1."',
hora='".$hora1."',
ID_EJERCICIO='".$ID_EJERCICIOM."'
WHERE codigo = '".$codigo[$i]."'
and
almacen='".$id_almacen."'
";
mysql_db_query($basedatos,$q4);
echo mysql_error();

$q2 = "UPDATE existencias set 
existencia='".$cantidadEnCendis."'-'".$cantidad[$i]."',
usuario='".$usuario."',
fechaA='".$fecha1."',
ID_EJERCICIO='".$ID_EJERCICIOM."'
WHERE codigo = '".$codigo[$i]."'
and
almacen='HALM'
";
mysql_db_query($basedatos,$q2);
echo mysql_error();
} else {
$leyenda = "LA CANTIDAD QUE ESTAS SOLICITANDO EXCEDE EL MAXIMO PERMITIDO DE EXISTENCIAS DEL ALMACEN!!";
}

$sSQL1= "Select * from requisiciones where id_requisicion='".$_POST['nRequisicion']."' and codigo= '".$codigo[$i]."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$myrow1['cantidad']." ".$cantidad[$i];
if(!$myrow1['cantidad']){
$q6 = "UPDATE requisiciones set 
status='transferido'
WHERE codigo = '".$codigo[$i]."'
and
id_almacen='".$_POST['almacen']."'
and
id_requisicion='".$_POST['nRequisicion']."' 
";
mysql_db_query($basedatos,$q6);
echo mysql_error();
$q7 = "UPDATE faltantes set 
status='surtido'
WHERE 
numeroE='".$_POST['nRequisicion']."'
and
codigo = '".$codigo[$i]."'
and
almacen='".$id_almacen."'
";
mysql_db_query($basedatos,$q7);
echo mysql_error();
}






//ya no hay mas ordenes de requisiciones? 

$sSQL1= "Select * from listaRequisiciones,requisiciones where requisiciones.id_requisicion='".$_POST['nRequisicion']."' and
listaRequisiciones.nRequisicion=requisiciones.id_requisicion
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($myrow1['status']=='transferido'){
$q1 = "UPDATE listaRequisiciones set 
status='transferido'
WHERE nRequisicion = '".$_POST['nRequisicion']."' 

";
mysql_db_query($basedatos,$q1);
echo mysql_error();
//$leyenda = "LA REQUISICION FUE COMPLETADA EXITOSAMENTE, ARTICULOS TRANSFERIDOS..!!";
}
} else {//excede el maximo
$estado="";
$leyenda = "LA CANTIDAD QUE ESTAS SOLICITANDO EXCEDE EL MAXIMO PERMITIDO DE EXISTENCIAS DEL ALMACEN!!";
}//cierra cantidad > existencia

}//cierra validacion de cantidad
}//for
}//cierra final






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
.style13 {
	color: #000099;
	font-weight: bold;
}
.style14 {
	color: #000066;
	font-weight: bold;
}
.style15 {
	color: #CC0000;
	font-weight: bold;
	font-size: 9px;
}
-->
</style>
</head>



<?php 
$sSQL7= "Select * From listaRequisiciones,almacenes WHERE listaRequisiciones.nRequisicion= '".$requisicion."' 
and
almacenes.almacen=listaRequisiciones.id_almacen
";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$id_almacen=$myrow7['almacen'];
?>
<h1 align="center">Traspaso #<?php echo $traspaso=$myrow7['keyReq'];?> </h1>
<p align="center" class="style15"><?php echo $leyenda;?></p>
<p align="center">Requisici&oacute;n <span class="style14">#<?php echo $requisicion;?></span> en el almac&eacute;n: <span class="style13"><?php echo $myrow7['descripcion'];?></span></p>
<form id="form1" name="form1" method="post" action="">
  <table width="561" border="1" align="center">
    <tr>
      <th width="47" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="283" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="25" bgcolor="#660066" scope="col"><span class="style11">UM</span></th>
      <th width="45" bgcolor="#660066" scope="col"><span class="style11">Existencia</span></th>
      <th width="35" bgcolor="#660066" scope="col"><span class="style11">Solicita</span></th>
      <th width="36" bgcolor="#660066" scope="col"><span class="style11">Reorden</span></th>
      <th width="44" bgcolor="#660066" scope="col"><span class="style11">Traspaso</span></th>
    </tr>
    <tr>
<?php	
if($requisicion){
$sSQL18= "
SELECT 
*
FROM
requisiciones
WHERE 
id_requisicion='".$requisicion."'

order by codigo ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$requi=$myrow18['id_requisicion'];
$id_proveedor=$myrow18['id_proveedor'];
$id_almacen=$myrow18['id_almacen'];
$b+='1';
$a+='1';
if($col){
$color = '#FFCCFF';
$col = "";
} else if(!$myrow18['cantidad']){
$color = '#00FF00';
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];
$descripcion=descripcion($code=$code1,$basedatos);

if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}



$sSQL7= "Select * From existencias WHERE codigo= '".$code1."' and almacen='HALM'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


$sSQL1= "Select * From tarjetaAlmacen WHERE codigo= '".$code1."' order by keyTA DESC";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label><?php echo $code1?>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
      </label></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $descripcion; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
 
       
<?php 
	  if($myrow7['um']){
	  echo $myrow7['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow7['existencia']){
	  echo $myrow7['existencia'];
	  } else {
	  echo "Sin Existencia";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow18['cantidad']){
	  echo $myrow18['cantidad'];
	  } else {
	  echo $surtido="Surtido";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow7['reorden']){
	  echo $myrow7['reorden'];
	  } else {
	  echo "Sin Reorden";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <span class="Estilo24">
        <input name="cantidad[]" type="text" class="style12" id="cantidad[]" value="0" size="3" maxlength="3" onKeyPress="return checkIt(event)"/>
        <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
      </span></span></td>
    </tr>
    <?php  }}} //cierra while ?>
  </table>
  <div align="center"><strong>
    <?php if($a){ 
	echo "Se encontraron $a Registros..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>
  <p align="center">
    <label>
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $id_almacen;?>" />

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    <input name="solicitar" type="submit" class="style12" id="solicitar" value="Solicitar/Actualizar" />
    </label>
    <label></label>
    <input name="nRequisicion" type="hidden" id="nRequisicion" value="<?php echo $requisicion; ?>" />
  </p>
  <p align="center">    <a href="javascript:ventanaSecundaria('/sima/cargos/imprimirFaltantes.php?numeroE=<?php echo $myrow1['numeroE']; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"><img src="/sima/cargos/printer.jpg" alt="Imprimir " width="48" height="48" border="0" /></a><a href="javascript:ventanaSecundaria('/sima/cargos/imprimirSurtidos.php?numeroE=<?php echo $myrow1['numeroE']; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a></p>
</form>
</body>
</html>