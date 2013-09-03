<?php



if($_POST['actualizar'] AND $_POST['particular']>-1 AND $_POST['aseguradora']>-1){





if($_GET['keyPA']){

      $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$_GET['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '".$_POST['particular']."','".$_POST['aseguradora']."', '".$id_medico[$i]."','".$_GET['keyPA']."','".$agregar[$i]."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
  


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

<?php if($myrow6a['nivel1']!=NULL){ ?>

<form name="form1" method="post" >
  <p align="center" >Actualizar Precios</p>
  <p align="center" >[Todos los Almacenes que tienen Precio Solamente] </p>
  <table width="200" class="table-forma">

    
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
      <td ><span >
        <?php 

	  
	  echo $myrow15['descripcion']?>
      </span></td>
    </tr>
    <tr>
      <td width="100" height="26"  > Particular</td>
      <td width="151" ><input name="particular" type="text"  value="" size="10" /></td>
    </tr>
    <tr>
      <td height="27"  > Aseguradora</td>
      <td ><input name="aseguradora" type="text"   value="" size="10" /></td>
    </tr>

  </table>
  <p align="center">
  <label>
        <?php
    $sSQLa= "Select * From gpoProductos where


codigoGP='".$_GET['gpoProducto']."'";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);?>


    <?php if($myrowa['afectaExistencias']!='si'){ ?>
              <?php if($tipoUsuario=='administrador'){?>    
    <input name="actualizar" type="submit" src="../../imagenes/btns/refresh.png" id="actualizar" value="Ajustar">
        <?php }else{ ?>
          <div align="center" class="normal">
              <blink>Solo Administrador puede hacer cambios...</blink>    
          </div>
              <?php }?>
    
        <?php }else{
     echo  'Esta opcion aplica solo para servicios!';

    }
        ?>
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
