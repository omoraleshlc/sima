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
$sSQL17= "Select * From requisiciones WHERE codigo= '".$code1[$i]."' and almacen='".$_POST['almacen']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
if(!$myrow17['codigo']){
 $agregaSaldo = "INSERT INTO requisiciones ( codigo,almacen,usuario,fecha,hora,ID_EJERCICIO,cantidad,status
) values ('".$code1[$i]."','".$_POST['almacen']."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$cantidad[$i]."','comprar')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
} else {
$q1 = "UPDATE requisiciones set 
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


if($_POST['quitar'] AND $_POST['remover']){
$codigo=$_POST['remover'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){
$remover = "DELETE From requisiciones where codigo='".$codigo[$i]."' and almacen ='".$_POST['almacen']."'";
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

<h1 align="center">Recepci&oacute;n de Art&iacute;culos de Farmacia </h1>
<form id="form1" name="form1" method="post" action="">
  <table width="797" border="1" align="center">
    <tr>
      <th width="67" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="396" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="49" bgcolor="#660066" scope="col"><span class="style11">UM</span></th>
      <th width="55" bgcolor="#660066" scope="col"><span class="style11">Reorden</span></th>
      <th width="72" bgcolor="#660066" scope="col"><span class="style11">Anaquel</span></th>
      <th width="36" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
      <th width="35" bgcolor="#660066" scope="col"><span class="style11">Recibir</span></th>
      <th width="35" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
    </tr>
    <tr>
<?php	
if($_POST['almacen'] ){

$sSQL18= "
SELECT 
*
FROM
existencias,articulos
WHERE 
existencias.almacen='".$ali."' 
and

existencias.existencia <=existencias.reorden

and
articulos.codigo=existencias.codigo 
and
articulos.um<>'s'
and
articulos.activo='A'

order by articulos.descripcion ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$b+='1';
$a+='1';
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

$sSQL17= "Select * From requisiciones WHERE codigo= '".$code1."' and almacen='".$_POST['almacen']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

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
	  if($myrow18['reorden']){
	  echo $myrow18['reorden'];
	  } else {
	  echo "Sin Reorden";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow18['anaquel']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label>
        <input name="cantidad[]" type="text" class="style7" id="cantidad[]" value="<?php echo $myrow17['cantidad'];?>" size="3" maxlength="3" <?php if(	  $myrow17['codigo']){ 
	  echo 'readonly="readonly"'; 
	  } ?>/>
        <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
      </label></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <span class="Estilo24">
        <input name="request[]" type="checkbox" id="request[]" value="<?php echo $code1?>"
	  <?php if(	  $myrow17['codigo']){ 
	  echo 'disabled=""'; 
	  } ?>/>
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
        <input name="remover[]" type="checkbox" id="remover[]" value="<?php echo $code1?>"    <?php if(	  !$myrow17['codigo']){ 
	  echo 'disabled=""'; 
	  } ?>/>
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

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    <input name="solicitar" type="submit" class="style12" id="solicitar" value="Solicitar/Actualizar" />
    </label>
    <label>
    <input name="quitar" type="submit" class="style7" id="quitar" value="Quitar" />
    <input name="imprimeReq" type="submit" class="style7" id="imprimeReq"  onclick="javascript:ventanaSecundaria('imprimirRequisiciones.php?numeroE=<?php echo $numPaciente; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;almacen=<?php echo $_POST['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="Imprimir Requisiciones"
		  />
    </label>
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen']; ?>" />
  </p>
</form>
</body>
</html>