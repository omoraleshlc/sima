<?php



if($_POST['actualizar'] AND $_POST['particular']>-1 AND $_POST['aseguradora']>-1){





if($_GET['keyPA']){


  

if($_GET['keyPA']){
$q = "UPDATE articulosPrecioNivel set 
nivel1='".$_POST['particular']."', 
nivel3='".$_POST['aseguradora']."', 
usuario='".$usuario."'
WHERE 
entidad='".$entidad."'
and
keyPA='".$_GET['keyPA']."' 
and
keyPA!=0
";
mysql_db_query($basedatos,$q);
echo mysql_error();
}else if($_GET['codigo']){
$q = "UPDATE articulosPrecioNivel set 
nivel1='".$_POST['particular']."', 
nivel3='".$_POST['aseguradora']."', 
usuario='".$usuario."'
WHERE 
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."' and codigo!=0 ";
mysql_db_query($basedatos,$q);
echo mysql_error();

}

} 

echo $leyenda="Se actualizaron precios";
?>
<script language="JavaScript" type="text/javascript">
  <!--
window.opener.document.forms["form2"].submit();
    window.close();
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


<?php  
$sSQL6a="SELECT nivel1,nivel3
FROM
`articulosPrecioNivel`
WHERE
keyPA = '".$_GET['keyPA']."' ";
  $result6a=mysql_db_query($basedatos,$sSQL6a);
  $myrow6a = mysql_fetch_array($result6a);
  
?>

<?php if($myrow6a['nivel1']){ ?>

<form name="form1" method="post" >
  <p align="center" class="titulos">Actualizar Precios</p>
  <p align="center" class="titulomedio">[Todos los Almacenes que tienen Precio Solamente] </p>
  <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="2"><img src="../imagenes/bordestablas/borde1.png" width="250" height="18" /></td>
    </tr>
    
    <?php 
	if($_POST['codigo']){
	$code=$_POST['codigo'];
	} else {
	$code=$_GET['codigo'];
	}
	
$sSQL15="SELECT descripcion,generico
FROM
articulos
WHERE
keyPA = '".$_GET['keyPA']."'";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);

$sSQL6="SELECT nivel1,nivel3
FROM
`articulosPrecioNivel`
WHERE
keyPA = '".$_GET['keyPA']."' order by keyAPN DESC ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);

  $nivel1=$myrow6['nivel1'];
  $nivel3=$myrow6['nivel3'];
  
$sSQL6a="SELECT nivel1,nivel3
FROM
`articulosPrecioNivel`
WHERE
keyPA = '".$_GET['keyPA']."' and nivel1>'".$nivel1."'";
  $result6a=mysql_db_query($basedatos,$sSQL6a);
  $myrow6a = mysql_fetch_array($result6a);
  
  if($myrow6a['nivel1'] and $myrow6a['nivel3']){
  $nivel1=$myrow6a['nivel1'];
  $nivel3=$myrow6a['nivel3'];
  }
  
  
  ?>
    <tr>
      <td colspan="2" bgcolor="#FFFF00" align="center"><span class="negromid">
        <?php 

	  
	  echo $myrow15['descripcion']?>
      </span></td>
    </tr>
    <tr>
      <td width="100" height="26" class="normalmid"> Particular</td>
      <td width="151"><input name="particular" type="text" class="camposmid" value="" size="10" /></td>
    </tr>
    <tr>
      <td height="27" class="normalmid"> Aseguradora</td>
      <td><input name="aseguradora" type="text" class="camposmid"  value="" size="10" /></td>
    </tr>
    <tr>
      <td colspan="2"><span class="titulomedio"><img src="../imagenes/bordestablas/borde2.png" width="250" height="18" /></span></td>
    </tr>
  </table>
  <p align="center">
    <label>
    <input name="actualizar" type="submit" src="../../imagenes/btns/refresh.png" id="actualizar" value="Ajustar">
    </label>
    <input type="hidden" name="codigo" value="<?php echo $_GET['codigo'];?>">
	<input type="hidden" name="almacen" value="<?php echo $_GET['almacen'];?>">
	<input type="hidden" name="almacenPrincipal" value="<?php echo $_GET['almacenPrincipal'];?>">
    <input name="keyAPN" type="hidden" id="keyAPN" value="<?php echo $_GET['keyAPN'];?>" />
    <input name="opcion" type="hidden" class="style12" id="opcion" value="<?php echo $_POST['opcion'];?>" />
  </p>
  
  <?php } else{ ?>
  
 <span class="error">SE NECESITA QUE AL MENOS ALGUN ALMACEN TENGA PRECIOS ESTABLECIDOS <span>
  
  <?php } ?>
</form>

