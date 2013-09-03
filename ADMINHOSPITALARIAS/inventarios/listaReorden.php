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


if( $almacen=$_POST['almacen'] and $cantidad[$i] ){


if($code1[$i] and $cantidad[$i]){
$sSQL17= "Select * From OC WHERE codigo= '".$code1[$i]."' and almacen='".$_POST['almacen']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
if(!$myrow17['codigo']){
 $agregaSaldo = "INSERT INTO OC ( codigo,almacen,usuario,fecha,hora,ID_EJERCICIO,cantidad,status
) values ('".$code1[$i]."','".$_POST['almacen']."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$cantidad[$i]."','comprar')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
} else {
$q1 = "UPDATE OC set 
cantidad='".$cantidad[$i]."'
WHERE codigo = '".$code1[$i]."'
and
almacen='".$_POST['almacen']."'
";
mysql_db_query($basedatos,$q1);
}
}
}}

}


if($_POST['quitar'] AND $_POST['borrar']){
$codigo=$_POST['quitar'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){

$remover = "update listaOC
set
status='cancelado'
where nRequisicion='".$codigo[$i]."' and id_almacen ='".$ali."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();
$remover = "update OC
set
status='cancelado'
where id_requisicion='".$codigo[$i]."' and id_almacen ='".$ali."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();


}
}

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
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="30"> 
<body>
<h1 align="center">Ordenes de Compra </h1>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="listadoOrdenes.php">
  <table width="556" border="1" align="center">
    <tr>
      <th width="90" bgcolor="#660066" scope="col"><span class="style11"># REQUISICION </span></th>
      <th width="225" bgcolor="#660066" scope="col"><span class="style11">ALMACEN DE ORIGEN </span></th>
      <th width="53" bgcolor="#660066" scope="col"><span class="style11">FECHA</span></th>
      <th width="51" bgcolor="#660066" scope="col"><span class="style11">HORA</span></th>
      <th width="57" bgcolor="#660066" scope="col"><span class="style11">PRIORIDAD</span></th>
      <th width="40" bgcolor="#660066" scope="col"><span class="style11">STATUS</span></th>
    </tr>
    <tr>
<?php	

$sSQL18= "
SELECT 
*
FROM
listaOC
where 
status ='solicita'
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
?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label>
        <input name="nRequisicion" type="submit" class="style7" id="nRequisicion" value="<?php echo $R?>" />
      </label></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow7['descripcion'] ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow18['fecha'] ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow18['hora'] ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <?php 
		if($myrow18['prioridad']){
		echo $myrow18['prioridad'];
		} else {
		echo "---";
		}
		?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow18['status'] ?></span></td>
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
    <label></label>
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen']; ?>" />
  </p>
</form>
</body>
</html>