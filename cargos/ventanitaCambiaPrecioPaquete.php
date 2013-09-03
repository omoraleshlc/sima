<?php require("/configuracion/ventanasEmergentes.php");?>
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");

if($_GET['almacen']){
$almacen=$_GET['almacen'];
} else {
$almacen=$_POST['almacen'];
}


if($_POST['actualizar'] AND $_POST['particular'] AND $_POST['aseguradora']){


$alma=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$coder[$i];




$q = "UPDATE paquetes set 
precioPaquete1='".$_POST['precioPaquete1']."', 
precioPaquete3='".$_POST['precioPaquete3']."',

usuario='".$usuario."'

WHERE 
entidad='".$entidad."' AND
codigo='".$_POST['codigo']."' ";

//mysql_db_query($basedatos,$q);
echo mysql_error();


echo $leyenda="Se actualizo el precio de venta";
?>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<script type="text/javascript">
	

		close();
	
</script>


<?php
}





?>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
-->
</style>


</head>
<form name="form1" method="post" action="">
  <table width="274" border="0" align="center" class="style7">
    <tr>
	<?php 
	if($_POST['codigo']){
	$code=$_POST['codigo'];
	} else {
	$code=$_GET['codigo'];
	}
	
 $sSQL15="SELECT *
FROM
paquetes
WHERE
codigoPaquete = '".$code."'";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);

  ?>
      <td colspan="3" bgcolor="#660066"><div align="center" class="style13"><?php echo $myrow15['descripcion'];?></div></td>
    </tr>
	
	
	

	<tr>
      <td width="25" bgcolor="#FFCCFF">&nbsp;</td>
      <td width="110" bgcolor="#FFCCFF"><div align="left">Paquete Particular</div></td>
      <td width="125" bgcolor="#FFCCFF"><input name="precioPaquete1" type="text" class="style7" id="precioPaquete1" value="<?php echo $myrow15['precioVentaP'];?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="left">Paquete Aseguradora </div></td>
      <td><input name="precioPaquete3" type="text" class="style7" id="precioPaquete3"  value="<?php echo $myrow15['precioVentaA'];?>" /></td>
    </tr>
  </table>
  <p align="center">
    <label>
    <input name="actualizar" type="submit" class="style7" id="actualizar" value="Ajustar">
    </label>
    <input type="hidden" name="codigo" value="<?php echo $_GET['codigo'];?>">
	<input type="hidden" name="almacen" value="<?php echo $_GET['almacen'];?>">
	<input type="hidden" name="almacenPrincipal" value="<?php echo $_GET['almacenPrincipal'];?>">
  </p>
</form>
