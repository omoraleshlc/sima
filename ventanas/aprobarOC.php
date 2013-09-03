<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php  include('/configuracion/funciones.php');?>

<?php 
if($_POST['send'] and !$_POST['modifica']){

$keyR=$_POST['keyR'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyR[$i]){

$q = "UPDATE OC set 

	status='pendiente'
		WHERE keyR='".$keyR[$i]."'";
		//mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}

}
$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje('Se hizo una solicitud de compra');


?>
<script>

window.close();
</script>

<?php 
}

?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=730,height=500,scrollbars=YES") 
} 
</script> 

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
  <h1 align="center" class="titulos">Lista de Materiales Solicitados </h1>
  <table width="683" border="0" align="center">
    <tr>
      <th width="60" height="21" bgcolor="#660066" scope="col"><div align="left" class="blanco">
        <div align="left">Cantidad</div>
      </div></th>
      <th width="453" bgcolor="#660066" scope="col"><div align="center">
        <div align="left" class="blanco">
          <div align="left">Descripci&oacute;n</div>
        </div>
      </div>
      </div></th>
      <th width="64" bgcolor="#660066" scope="col"><div align="left" class="blanco">
        <div align="left">Status</div>
      </div></th>
      <th width="88" bgcolor="#660066" scope="col"> <div align="left" class="blanco">
        <div align="left">Proveedores </div>
      </div></th>
    </tr>
    <?php	
$sSQL= "SELECT  
* 
FROM OC
WHERE
id_requisicion='".$_GET['id_requisicion']."'
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
$color = '#FFCCFF';
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
      <td height="25" bgcolor="<?php echo $color;?>" class="normal"><div align="left"><?php echo $myrow['cantidad']; ?></div></td>
      <input name="bandera1" type="hidden" id="bandera1" value="<?php echo $bandera1;?>" />
      <input name="keyR[]" type="hidden" id="keyR[]" value="<?php echo $myrow['keyR'];?>" />
      <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="left"><?php echo $myrow['descripcion']; ?></div></td>
      <td bgcolor="<?php echo $color;?>" class="abonos"><?php echo $myrow['statusProveedor']; ?></td>
      <td bgcolor="<?php echo $color;?>" class="abonos"><div align="center">
	  
	  <a href="javascript:ventanaSecundaria('listaOCxProveedores.php?keyR=<?php echo $myrow['keyR']; ?>&id_requisicion=<?php echo $_GET['id_requisicion']; ?>&usuario=<?php echo $usuario; ?>&almacen=<?php echo $ali; ?>')">
	  
	  <img src="../../imagenes/btns/printbtn.png" alt="Imprimir " width="22" height="20" border="0" /></a></div>    </td>
    </tr>
    <?php }
	
	  ?>
  </table>
  <p align="center">
    <label></label>
  </p>
</form>
</body>
</html>
