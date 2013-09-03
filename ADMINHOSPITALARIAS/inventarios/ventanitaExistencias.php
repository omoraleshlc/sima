<?php require("/configuracion/ventanasEmergentes.php");?>
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar'] AND $_POST['cantidad']){


$alma=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$coder[$i];



$q = "UPDATE existencias set 

fechaA='".$hoy."', 
hora='".$hora."', 
existencia=existencia-'".$_POST['cantidad']."'

WHERE 
entidad='".$entidad."' AND
codigo='".$_POST['codigo']."' 
AND 
almacen = '".$_POST['almacenPrincipal']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();


$q = "UPDATE existencias set 

fechaA='".$hoy."', 
hora='".$hora."', 
existencia=existencia+'".$_POST['cantidad']."'

WHERE 
entidad='".$entidad."' AND
codigo='".$_POST['codigo']."' 
AND 
almacen = '".$_POST['almacen']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();


echo $leyenda="Se actualizaron existencias";
?>
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
  <table width="249" border="0" align="center" class="style7">
    <tr>
	<?php 
	  
$sSQL1= "SELECT 
* 
FROM 

`articulos`,existencias
WHERE
articulos.entidad='".$entidad."' AND
existencias.codigo='".$_GET['codigo']."'
and
articulos.codigo=existencias.codigo
and articulos.activo='A'
and
(articulos.um<>'s' or articulos.um<>'S')
and
existencias.almacen='".$_GET['almacenPrincipal']."'
";
	$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);  

	  ?>
      <td colspan="3" bgcolor="#660066"><div align="center" class="style13">
	  <?php echo $myrow1['descripcion'];?>  
	  </div>
	   </td>
    </tr>
    <tr>
      <td width="23" bgcolor="#FFCCFF">&nbsp;</td>
      <td width="152" bgcolor="#FFCCFF">Cantidad Actual </td>
      <td width="60" bgcolor="#FFCCFF"><label><?php  echo $myrow1['existencia'];?></label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Cantidad Vendida </td>
      <td><?php echo $_GET['cantidadVendida'];?>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF">&nbsp;</td>
      <td bgcolor="#FFCCFF">Ajuste Existencias </td>
      <td bgcolor="#FFCCFF"><input name="cantidad" type="text" class="style7" id="cantidad" size="3" maxlength="2"
	  autocomplete="off"></td>
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
