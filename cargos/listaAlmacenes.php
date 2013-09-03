<?PHP include("/configuracion/ventanasEmergentes.php"); ?>



<?php 
//actualizar ******************************************************************************************************
if(!$_POST['keyPA']){
$_POST['keyPA']=$_GET['keyPA'];
}
	

$sSQL6="SELECT descripcion,servicio,medico,codigo,gpoProducto
FROM
  articulos
WHERE
keyPA = '".$_POST['keyPA']."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  

if(!$_GET['gpoProducto'])  {
 $_GET['gpoProducto']=$myrow6['gpoProducto'];
 }

if($_POST['actualizar'] AND $_POST['keyPA'] ){ 
$agregar = $_POST["codAlmacen"];
 $precioPaquete1=$_POST['precioPaquete1'];
 $precioPaquete3=$_POST['precioPaquete3'];
 $nivel1=$_POST['nivel1'];
 $nivel3=$_POST['nivel3'];
 $id_medico=$_POST['id_medico'];
$costo=$_POST['costo'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){

if($agregar[$i]){
$sSQL3= "Select keyPA From articulosPrecioNivel WHERE keyPA='".$_POST['keyPA']."'
AND almacen = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$sSQL33= "Select keyPA From existencias WHERE keyPA='".$_POST['keyPA']."'
AND almacen = '".$agregar[$i]."'";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
if(!$myrow33['keyPA']){

$agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,keyPA,descripcion
) values (
'".$myrow6['codigo']."',
'".$agregar[$i]."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$_POST['keyPA']."','".$myrow6['descripcion']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}


$leyenda = "Se ingresó el almacén para el artículo: ".$_POST['codigo'];
} //cierra validacion



}
} 
//****************************************************************************************************************************























if($_POST['borrar'] AND $_POST['keyPA']){
$quitar = $_POST['quitar'];
for($i=0;$i<=$_POST['pasoBandera'];$i++){

if($quitar[$i]){
  $borrame = "DELETE FROM existencias WHERE keyPA ='".$_POST['keyPA']."' 
AND almacen = '".$quitar[$i]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
 $borrameNivel = "DELETE FROM articulosPrecioNivel WHERE keyPA='".$_POST['keyPA']."' AND almacen='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrameNivel);
}
}$leyenda = "Se eliminó del almacén ".$quitar[$i];
} else if($_POST['borrar'] AND !$_POST['usuario']){
$leyenda = "Por favor, escoja el nombre de almacén que desee quitar.!";
}




?>


<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>

<form id="form2" name="form2" method="POST" >

    <p align="center" class="titulos">
	<?php 
	$sSQL6="SELECT descripcion,servicio,medico,gpoProducto
FROM
  `articulos`
WHERE
keyPA = '".$_POST['keyPA']."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  echo $myrow6['descripcion'];
  
  	 $sSQL6b="SELECT *
FROM
gpoProductos
WHERE
entidad='".$entidad."' and
codigoGP='".$myrow6['gpoProducto']."'  ";
  $result6b=mysql_db_query($basedatos,$sSQL6b);
  $myrow6b = mysql_fetch_array($result6b);
  ?>
    
      <input name="keyPA" type="hidden" class="style12" id="codigo" readonly="" value="<?php echo $_POST['keyPA']; ?>" />
</p>
<table width="546" border="0" align="center">
      <tr>
        <th width="41" bgcolor="#660066" scope="col"><div align="left" class="blancomid">#</span></div></th>
        <th width="51" bgcolor="#660066" scope="col"><div align="left" class="blancomid">C&oacute;digo </span></div></th>
        <th width="332" bgcolor="#660066" scope="col"><div align="left" class="blancomid">Descripci&oacute;n</span></div></th>
        <th width="30" bgcolor="#660066" scope="col"><div align="left" class="blancomid"></div></th>
        <th width="33" bgcolor="#660066" scope="col">&nbsp;</th>
        <th width="33" bgcolor="#660066" scope="col"><div align="left" class="blancomid"></span></div></th>
    </tr>
      
<?php  

if( $myrow6b['afectaExistencias']=='si'){
 
 $sSQL= "Select * From almacenes
 where entidad='".$entidad."' 
 AND
stock='si' order by descripcion ASC";
}else{
$sSQL= "Select * From almacenes
 where entidad='".$entidad."' 
 AND
stock!='si' order by descripcion ASC";

}
 
 
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){

$bandera += 1;
$codigoModulo = $myrow['codModulo'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$alma=$myrow['almacen'];
$code=$myrow['codigo'];
$sSQL6="SELECT codigo,nivel1,nivel3,almacen
FROM
  articulosPrecioNivel
WHERE keyPA='".$_POST['keyPA']."'  and almacen = '".$alma."'
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);


 
 
  
$sSQL61="SELECT almacen
FROM
  existencias
WHERE keyPA='".$_POST['keyPA']."'  and almacen = '".$myrow6['almacen']."'
  ";
  $result61=mysql_db_query($basedatos,$sSQL61);
  $myrow61 = mysql_fetch_array($result61);
  

  
 if(($myrow6['nivel1'] and $myrow6['nivel3']) and !$myrow61['almacen']){

$agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,keyPA
) values (
'".$myrow6['codigo']."',
'".$myrow6['almacen']."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$_POST['keyPA']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
  

  if($myrow61['almacen'] and ($myrow6['nivel1'] and $myrow6['nivel3'])){ 
  $estilo='negro';
  $color='#CCFF00';
  } else  {
  $color = '#FFFFFF';
  $estilo='style12';
  }
    $sSQL661="SELECT id_medico
FROM
  almacenes
WHERE entidad='".$entidad."' AND almacen = '".$alma."'
  ";
  $result661=mysql_db_query($basedatos,$sSQL661);
  $myrow661 = mysql_fetch_array($result661);
  
 $sSQL6="SELECT codigo,nivel1,nivel3,almacen
FROM
  articulosPrecioNivel
WHERE keyPA='".$_POST['keyPA']."'  and almacen = '".$alma."'
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
?>
	  <tr>
	  
<?php     
$sSQL6f="SELECT *
FROM
camposGrupos
WHERE gpoProducto='".$_GET['gpoProducto']."'  and id_almacen = '".$alma."'";
$result6f=mysql_db_query($basedatos,$sSQL6f);
$myrow6f = mysql_fetch_array($result6f);
  
  ?>
        <td bgcolor="<?php echo $color?>" class="style12"><div align="center" class="normal"><?php echo $bandera;?></div></td>

        <td bgcolor="<?php echo $color?>" class="style12"><div align="left" class="normal"><?php echo $myrow['almacen'];?></div>
            
            <label></label>
        
            <div align="center"></div></td>
        <td bgcolor="<?php echo $color?>" class="normal">
		
		
		<?php 
		if($myrow['medico']=='si'){
		echo $myrow['descripcion'].'<img src="../imagenes/simboloMedico.jpg" alt="ES UN MEDICO" width="12" height="12" />';
		} else {
		echo $myrow['descripcion'];
		}
		?>
		</span>
            <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
            <input name="id_medico[]" type="hidden" id="id_medico[]" value="<?php echo $myrow661['id_medico']; ?>" /></td>
        <td bgcolor="<?php echo $color?>" class="<?php echo $estilo?>">

        <label><span class="normal">
        
        <?php if($myrow6f['gpoProducto']){ ?>
          <input name="codAlmacen[]" type="checkbox" id="codAlmacen[]" value="<?php echo $myrow['almacen']; ?>" <?php if($myrow61['almacen'] and ($myrow6['nivel1'] and $myrow6['nivel3'])){
		echo 'disabled="disabled"';
		}
		?>/>
        <?php }else{ ?>
        ---
        <?php } ?>
        </span></label></td>
        <td bgcolor="<?php echo $color?>" class="style12"><?php if($myrow6f['gpoProducto']){ ?>
          <input name="quitar[]" type="checkbox" class="style12" id="quitar" 
		value="<?php echo $myrow['almacen'];?>" 
		<?php if(!$myrow61['almacen'] and (!$myrow6['nivel1'] and !$myrow6['nivel3'])){
		echo 'disabled="disabled"';
		}
		?>
		/>
          <?php }else{ ?>
---
<?php } ?></td>
        <td bgcolor="<?php echo $color?>" class="style12">&nbsp;</td>
      </tr>
      <?php }?>
  </table>
<p align="center">
      <label>
      <input name="actualizar" type="submit" class="style12" id="actualizar" value="Efectuar Cambios" />
      </label>
      <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar/Borrar" />
      <input name="keyPA" type="hidden" class="style12" id="actualizar" value="<?php echo $_GET['keyPA'];?>" />
  </p>
</form>
  <p></p>
  
  
</body>
</html>
