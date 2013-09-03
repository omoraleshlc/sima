<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?>
<?php  
if($_GET['keyR'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE OC set 

	status='cancelado'
		WHERE keyR='".$_GET['keyR']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>











<?php 
if($_POST['send'] and !$_POST['modifica']){
$sSQL333= "SELECT 
MAX(id_requisicion)+1 as req
FROM OC
WHERE entidad='".$entidad."'";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333); 




$keyR=$_POST['keyR'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyR[$i]){

$q = "UPDATE OC set 
id_requisicion='".$myrow333['req']."',
	status='solicita'
		WHERE 
		status='request'
		";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}
$agregaSaldo = "INSERT INTO requisiciones ( id_requisicion,id_almacen,usuario,fecha,hora,status,entidad,proveedorSugerido
) values ('".$myrow333['req']."','".$_POST['id_almacen']."',
'".$usuario."','".$fecha1."','".$hora1."','request','".$entidad."','".$_POST['proveedor']."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();

}


?>
<script>
window.alert('Se genero la requisicion #<?php echo $myrow333['req'];?>');
window.close();
</script>

<?php 
}















if(!$_POST['send'] and $_POST['modifica']){

$keyR=$_POST['keyR'];
$cantidad=$_POST['cantidad'];
$precioUnitario=$_POST['precioUnitario'];
for($i=0;$i<=$_POST['bandera1'];$i++){

if($keyR[$i]){
 $q = "UPDATE OC set 
	cantidad='".$cantidad[$i]."',precioUnitario='".$precioUnitario[$i]."'
		WHERE keyR='".$keyR[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}

}

echo '<blink>'.'Se modificaron datos'.'</blink>';
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p align="center" class="titulos">Enviar Solicitud </p>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="542" height="24" />
  <table width="542" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#CCCCCC">
      <th width="1" height="68" class="Estilo24" scope="col">&nbsp;</th>
      <th width="152" class="style13" scope="col"><div align="left" class="normal">Proveedor Sugerido </div></th>
    <th colspan="3" class="style13" scope="col"><label></label>
          <div align="left">
            <label>
            <textarea name="proveedorSugerido" cols="60" class="camposmid" id="proveedorSugerido"></textarea>
            </label>
          </div>
        <div align="left" class="style18"></div></th>
    </tr>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="542" height="24" />
<p>&nbsp;</p>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="395" height="24" />
  <table width="395" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <th width="45" height="19" scope="col"><div align="left" class="normal">
        <div align="left">Cant</div>
      </div></th>
      <th width="280" scope="col"><div align="center">
        <div align="left" class="normal">
          <div align="left">Descripci&oacute;n</div>
        </div>
      </div>
          </div></th>
      <th width="56" scope="col"><div align="center" class="normal">
        <div align="center">Eliminar</div>
      </div></th>
    </tr>
    <?php	
$sSQL= "SELECT  
* 
FROM OC
WHERE
entidad='".$entidad."'
and
id_almacen='".$_GET['almacen']."'
and
status='request'
";


$result=mysql_db_query($basedatos,$sSQL);


while($myrow = mysql_fetch_array($result)){ 
$bandera1+=1;
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
codigo='".$code1."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL4= "
SELECT 
razonSocial
FROM
proveedores
WHERE id_proveedor = '".$myrow['id_proveedor']."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);



$um=$myrow12['um'];
$medico=$myrow['medico'];

?>
    <tr>
      <td height="21" bgcolor="<?php echo $color;?>" class="normal"><div align="left"><span class="cargos">
        <input name="cantidad[]" type="text" id="cantidad[]" size="4" value="<?php echo $myrow['cantidad']; ?>" />
      </span>

      </div></td>
      <input name="bandera1" type="hidden" id="bandera1" value="<?php echo $bandera1;?>" />
      <input name="keyR[]" type="hidden" id="keyR[]" value="<?php echo $myrow['keyR'];?>" />
      <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
      <td bgcolor="<?php echo $color;?>" class="normal"><?php echo $myrow['descripcion']; ?></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24">
          <div align="center">
         <a href="<?php echo $_SERVER['PHP_SELF'];?>?descripcionProveedor=<?php echo $_GET['descripcionProveedor'];?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacen=<?php echo $_GET['almacen'];?>&amp;keyR=<?php echo $myrow['keyR'];?>"> 
          <img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar <?php echo $myrow['descripcion']; ?>?') == false){return false;}" />
           </a>
          </div>
      </td>
    </tr>
    <?php }
	
	  ?>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="395" height="24" />
  <p align="center">
    <label>
	  <input type="hidden" name="id_almacen" value="<?php echo $_GET['almacen'];?>" />
    <?php if($bandera1>0){ ?>
      <input name="send" type="image" src="../../imagenes/btns/sendsolicitud.png" id="send" value="Enviar Solicitud" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas enviar la solicitud?') == false){return false;}" />
    </label>
    <label>
       <input name="modifica" type="image" id="modifica" src="../../imagenes/btns/modimporte.png" value="Modificar Importe" />
      <?php } ?>
    </label>
  </p>
</form>
</body>
</html>
