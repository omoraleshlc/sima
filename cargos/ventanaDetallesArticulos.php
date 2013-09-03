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


echo $leyenda="Se actualizó el precio de venta";
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
  <table width="346" border="0" align="center" class="style7">
    <tr>
	<?php 
	if($_POST['codigo']){
	$code=$_POST['codigo'];
	} else {
	$code=$_GET['codigo'];
	}
	
 $sSQL15="SELECT *
FROM
articulos
WHERE
entidad='".$entidad."' 
and
codigo = '".$code."'";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);

  ?>
      <td colspan="3" bgcolor="#660066"><div align="center" class="style13"><?php echo $myrow15['descripcion'];?></div></td>
    </tr>
	
	
	

	<tr>
      <td width="11" bgcolor="#FFCCFF">&nbsp;</td>
      <td width="105" bgcolor="#FFCCFF">Grupo de Producto </td>
      <td width="216" bgcolor="#FFCCFF"><span class="normal">
        <?php //*********gpoProductos
	 
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="gpoProducto" class="Estilo24" id="gpoProducto">
        
          <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
          <option 
		   <?php if($myrow7['codigoGP']==$myrow15['gpoProducto']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
          <?php } 
		
		?>
        </select>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Unidad de Medida </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF">&nbsp;</td>
      <td bgcolor="#FFCCFF">&nbsp;</td>
      <td bgcolor="#FFCCFF"><span class="normal">


      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
