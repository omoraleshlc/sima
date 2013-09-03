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

$keyAPN=$_POST['keyAPN'];
$alma=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$coder[$i];


$q = "UPDATE precioArticulos set 

costo='".$_POST['costo']."',
usuario='".$usuario."'

WHERE 
entidad='".$entidad."' AND
codigo='".$_POST['codigo']."' ";

//mysql_db_query($basedatos,$q);
echo mysql_error();

if($keyAPN){
$q = "UPDATE articulosPrecioNivel set 

nivel1='".$_POST['particular']."', 
nivel3='".$_POST['aseguradora']."', 
usuario='".$usuario."'

WHERE 
keyAPN='".$keyAPN."'";
} else {
$q = "UPDATE articulosPrecioNivel set 

nivel1='".$_POST['particular']."', 
nivel3='".$_POST['aseguradora']."', 
usuario='".$usuario."'

WHERE 
entidad='".$entidad."' AND
codigo='".$_POST['codigo']."'
and
almacen='".$almacen."'
 ";
}






//mysql_db_query($basedatos,$q);
echo mysql_error();


echo $leyenda="Se actualizaron precios";
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
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="517" border="0" align="center" class="style7">
    <tr>
	<?php 
	if($_POST['codigo']){
	$code=$_POST['codigo'];
	} else {
	$code=$_GET['codigo'];
	}
	
$sSQL15="SELECT *
FROM
clientesInternos
WHERE

keyClientesInternos = '".$_GET['nT']."'";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);


  ?>
      <td colspan="3" bgcolor="#660066"><div align="center" class="style13">
	  <?php
	  echo $myrow15['paciente'];
	  ?>
	  </div></td>
    </tr>
	
	
	

	
	<tr>
	  <td bgcolor="#FFCCFF">&nbsp;</td>
	  <td bgcolor="#FFCCFF"><div align="left"></div></td>
	  <td bgcolor="#FFCCFF">&nbsp;</td>
    </tr>
	<tr>
      <td width="20" bgcolor="#FFCCFF">&nbsp;</td>
      <td width="139" bgcolor="#FFCCFF"><div align="left">Particular</div></td>
      <td width="344" bgcolor="#FFCCFF"><input name="particular" type="text" class="style7" value="<?php echo $myrow6['nivel1'];?>" /></td>
    </tr>
    <tr>
      <td><div align="left"></div></td>
      <td><div align="left">Compa&ntilde;&iacute;a / Aseguradora </div></td>
      <td><input name="aseguradora"  value="<?php echo $myrow6['nivel3'];?>" type="text" class="style7">        &nbsp;</td>
    </tr>
  </table>
  <p align="center">
    <label>
    <input name="actualizar" type="submit" class="style7" id="actualizar" value="Correr Proceso">
    </label>
    <input type="hidden" name="codigo" value="<?php echo $_GET['codigo'];?>">
	<input type="hidden" name="almacen" value="<?php echo $_GET['almacen'];?>">
	<input type="hidden" name="almacenPrincipal" value="<?php echo $_GET['almacenPrincipal'];?>">
    <input name="keyAPN" type="hidden" id="keyAPN" value="<?php echo $_GET['keyAPN'];?>" />
  </p>
</form>
