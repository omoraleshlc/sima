<?php require("/configuracion/ventanasEmergentes.php");?>
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");

if($_GET['almacen']){
$almacen=$_GET['almacen'];
} else {
$almacen=$_POST['almacen'];
}


if($_POST['actualizar'] AND  $_POST['aseguradora']){

$keyAPN=$_POST['keyAPN'];
$alma=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];










$sSQL3= "Select keyPA From articulosPrecioNivel WHERE keyPA='".$_GET['keyPA']."'
AND almacen = '".$almacen."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


if($myrow3['keyPA']){


$q = "UPDATE articulosPrecioNivel set 

nivel3='".$_POST['aseguradora']."',
usuario='".$usuario."'


WHERE
keyPA='".$_GET['keyPA']."' AND almacen='".$almacen."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda = "SE ACTUALIZARON DATOS ";
}else{
$q = "insert into articulosPrecioNivel 
(
codigo,nivel3,
keyPA,almacen,entidad)
values
('".$_POST['codigo']."','".$_POST['aseguradora']."','".$_GET['keyPA']."','".$almacen."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda="SE AGREGARON DATOS";
} 





?>
<script language="JavaScript" type="text/javascript">
window.opener.document.forms["form2"].submit();
    close();
  // -->
</script>



<?php
}






?>

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>
<form name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="350" border="0" align="center" class="style7">
    <tr>
	<?php 
	if($_POST['codigo']){
	$code=$_POST['codigo'];
	} else {
	$code=$_GET['codigo'];
	}
	
			if($_POST['almacen']){
	$almacen=$_POST['almacen'];
	} else {
	$almacen=$_GET['almacen'];
	}
	
$sSQL15="SELECT descripcion,generico
FROM
`articulos`
WHERE
codigo = '".$code."'";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);

$sSQL6="SELECT *
FROM
`articulosPrecioNivel`
WHERE
codigo = '".$code."' AND almacen='".$almacen."'";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  
  ?>
      <td colspan="3" bgcolor="#660066"><div align="center" class="blancomid"><?php 
	  $sSQL415="select descripcion
FROM
almacenes
WHERE
almacen = '".$almacen."'";
  $result415=mysql_db_query($basedatos,$sSQL415);
  $myrow415 = mysql_fetch_array($result415);
	  
	  echo $myrow415['descripcion']?></div></td>
    </tr>
	
	
	
	<?php if($myrow15['generico']=='si'){ ?>
    <?php } ?>
    <tr valign="bottom">
      <td width="5" height="35" valign="middle"><div align="left"></div></td>
      <td width="164" valign="middle"><div align="left" class="normalmid">Compa&ntilde;&iacute;a / Aseguradora </div></td>
      <td width="167" valign="middle"><input name="aseguradora"  value="<?php echo $myrow6['nivel3'];?>" type="text" class="negromid">        &nbsp;</td>
    </tr>
  </table>
  <p align="center">
    <label>
    <input name="actualizar" type="image" src="../../imagenes/btns/refresh.png"  id="actualizar" value="Ajustar">
    </label>
    <input type="hidden" name="codigo" value="<?php echo $_GET['codigo'];?>">
	<input type="hidden" name="almacen" value="<?php echo $_GET['almacen'];?>">
	<input type="hidden" name="almacenPrincipal" value="<?php echo $_GET['almacenPrincipal'];?>">
    <input name="keyAPN" type="hidden" id="keyAPN" value="<?php echo $_GET['keyAPN'];?>" />
  </p>
</form>
