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


 $sSQL33= "Select keyPA From existencias WHERE keyPA='".$_POST['keyPA']."'
AND almacen = '".$agregar[$i]."'";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
if(!$myrow33['keyPA']){

$agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,keyPA,descripcion,tipoVenta
) values (
'".$myrow6['codigo']."',
'".$agregar[$i]."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$_POST['keyPA']."','".$myrow6['descripcion']."','1'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}


$leyenda = "Se ingreso el almacen para el articulo: ".$_POST['codigo'];
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
}$leyenda = "Se elimino del almacen ".$quitar[$i];
} else if($_POST['borrar'] AND !$_POST['usuario']){
$leyenda = "Por favor, escoja el nombre de almacen que desee quitar.!";
}




?>


<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
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

    <p align="center" >
	<?php 
	$sSQL6="SELECT descripcion,servicio,medico,gpoProducto
FROM
  `articulos`
WHERE
keyPA = '".$_GET['keyPA']."'  
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
  echo '</br>';
  echo $myrow6b['descripcionGP'];
  ?>
    
      <input name="keyPA" type="hidden"  id="codigo" readonly="" value="<?php echo $_POST['keyPA']; ?>" />
</p>
    <table width="500" class="table table-striped">

      <tr >
        <th width="30" >N&deg;</th>
        <th width="312" >Descripcion</th>
        <th width="66"  align="center">Agregar</th>
        <th width="62"  align="center">Quitar</th>
      </tr>
      <?php  

  $sSQL= "Select * From almacenes
 where entidad='".$entidad."' 
 and
 almacenConsumo='si'
order by descripcion ASc
";

 
 
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){

$bandera += 1;
$codigoModulo = $myrow['codModulo'];

  
 $sSQL61="SELECT almacen
FROM
  existencias
WHERE 
entidad='".$entidad."'
and
keyPA='".$_POST['keyPA']."'  and almacen = '".$myrow['almacen']."'

  ";
  $result61=mysql_db_query($basedatos,$sSQL61);
  $myrow61 = mysql_fetch_array($result61);
  


  

?>
      <?php     
 $sSQL6f="SELECT *
FROM
camposGrupos
WHERE
entidad='".$entidad."'
and
 gpoProducto='".$_GET['gpoProducto']."'  and id_almacen = '".$myrow['almacen']."'  ";
$result6f=mysql_db_query($basedatos,$sSQL6f);
$myrow6f = mysql_fetch_array($result6f);

  ?>
      <tr >
        <td height="41"><span ><?php echo $bandera;?></span></td>
        <td><span >
          <?php 
		if($myrow['medico']=='si'){
		echo $myrow['descripcion'].'<img src="../imagenes/simboloMedico.jpg" alt="ES UN MEDICO" width="12" height="12" />';
		} else {
		echo $myrow['descripcion'];
		}
		?>
        </span>
          <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
        <input name="id_medico[]" type="hidden" id="id_medico[]" value="<?php echo $myrow61a['id_medico']; ?>" />
        <span class="normal"><br />
        <span class="negro">Cod. Almacen: </span><span ><?php echo $myrow['almacen'];?></span></td>
        <td align="center"><span >
          <?php if(!$myrow61['almacen']){ ?>
          <input name="codAlmacen[]" type="checkbox" id="codAlmacen[]" value="<?php echo $myrow['almacen']; ?>" <?php if($myrow61['almacen'] ){		echo 'disabled="disabled"';		}		?>/>
          <?php }else{ ?>
---
<?php } ?>
        </span></td>
        <td align="center" >
          <?php if( $myrow61['almacen']){ ?>
          <input name="quitar[]" type="checkbox"  id="quitar" 		value="<?php echo $myrow['almacen'];?>" 		<?php if(!$myrow61['almacen'] ){		echo 'disabled="disabled"';		}		?>		/>
          <?php }else{ ?>
---
<?php } ?></td>
      </tr>
      <?php }?>

    </table>
    <p align="center" >
      <label>
        <input name="actualizar" type="submit"  id="actualizar" value="Efectuar Cambios" <?php if($bandera<1)echo 'disabled=""';?> />
      </label>
      <input name="borrar" type="submit"  id="borrar" value="Eliminar/Borrar" <?php if($bandera<1)echo 'disabled=""';?>/>
      <input name="keyPA" type="hidden"  id="actualizar" value="<?php echo $_GET['keyPA'];?>" />
	  	        <input name="opcion" type="hidden"  id="opcion" value="<?php echo $_POST['opcion'];?>" />
  </p>
</form>
  <p></p>
  
  
</body>
</html>
