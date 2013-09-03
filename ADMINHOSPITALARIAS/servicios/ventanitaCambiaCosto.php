<?php require("/configuracion/ventanasEmergentes.php");?>
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar'] AND $_POST['costo']){


$alma=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$coder[$i];

//*********************SECCION DE COSTOS***********************************

$sSQL31= "Select  * From precioArticulos WHERE codigo = '".$_POST['codigo']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
//***compruebo si existe en la DB
if($myrow31['codigo']){
$q = "UPDATE precioArticulos set 

costo='".$_POST['costo']."',
usuario='".$usuario."'

WHERE 
entidad='".$entidad."' AND
codigo='".$_POST['codigo']."' ";

mysql_db_query($basedatos,$q);
echo mysql_error();
} else {
$agregaSaldo = "INSERT INTO precioArticulos ( codigo,usuario,fecha,hora,ID_EJERCICIO,costo,entidad
) values ('".$_POST['codigo']."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$_POST['costo']."','".$entidad."')";
mysql_db_query($basedatos,$agregaSaldo);
}
//*****************************CIERRA SECCION DE COSTOS***********************




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
  <table width="260" border="0" align="center" class="style7">
    <tr>
	<?php 
	if($_POST['codigo']){
	$code=$_POST['codigo'];
	} else {
	$code=$_GET['codigo'];
	}
	
$sSQL15="SELECT descripcion
FROM
`articulos`
WHERE
entidad='".$entidad."' AND
codigo = '".$code."'";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);
   $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);
  ?>
      <td colspan="2" bgcolor="#660066"><span class="style13"><?php echo $myrow15['descripcion'];?></span></td>
    </tr>
    <tr>
      <td width="87">Actual: <?php echo if(!$myrow5['costo']){ echo '0.00';} else{ echo "$".number_format($myrow5['costo'],2);}?></td>
      <td width="163">Nuevo
      <input name="costo" type="text" class="style7" id="costo"></td>
    </tr>
  </table>
  <p align="center">
    <label>
    <input name="actualizar" type="submit" class="style7" id="actualizar" value="Ajustar">
    </label>
	<input type="hidden" name="costo" value="<?php echo $_GET['costo'];?>">
    <input type="hidden" name="codigo" value="<?php echo $_GET['codigo'];?>">
	<input type="hidden" name="almacen" value="<?php echo $_GET['almacen'];?>">
	<input type="hidden" name="almacenPrincipal" value="<?php echo $_GET['almacenPrincipal'];?>">
  </p>
</form>
