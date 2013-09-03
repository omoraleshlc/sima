<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php
$numCliente=$_GET['seguro'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
?>

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.escoje.value) == null ) {   
                alert("Por Favor, escoje como quieres agregar artículos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 
if($_POST['actualizar'] and $_POST['cantidad']){

$cantidad=$_POST['cantidad'];
$capa=$_POST['capa'];
for($i=0;$i<=$_POST['flag'];$i++){

$sql="Update conveniosxCantidad
set
cantidad = '".$cantidad[$i]."', 
usuario='".$usuario."',
fecha1='".$fecha1."'
where codigo='".$capa[$i]."' and numCliente='".$numCliente."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();

}
}
?>





<?php 

if($_POST['quitar'] and $_POST['elimina']){

$codigo=$_POST['elimina'];


for($i=0;$i<$_POST['flag'];$i++){
if($codigo[$i]!=null){
$borrame = "DELETE FROM conveniosxCantidad WHERE codigo='".$codigo[$i]."' and numCliente='".$numCliente."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo "Se eliminaron convenios";
}
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style15 {color: #0000FF}
.style13 {color: #FFFFFF}
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
  <span class="style15"><?php 
$sSQL23= "Select * From clientes WHERE numCliente ='".$numCliente."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'].'</br>';
echo $leyenda;
?> </span></p>
<form id="form2" name="form2" method="post" action="" >
    <span class="Estilo24"><span class="style7">
    <input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
    </span></span>
    <input name="nombrePaciente3" type="hidden" id="nombrePaciente3" value="<?php 
echo $nombrePaciente1;
	 ?>" />
    <input name="medico1" type="hidden" id="medico1" value="<?php echo $medico1; ?>" />
    <input name="tipoSeguro1" type="hidden" id="tipoSeguro1" value="<?php echo $seguro; ?>" />
    <input name="almacenP1" type="hidden" id="almacenP1" value="<?php echo $almacenPrincipal; ?>" />
    <input name="numPoliza1" type="hidden" id="numPoliza1" value="<?php echo $numPoliza; ?>" />
    <input name="nCuenta1" type="hidden" id="nCuenta1" value="<?php echo $nCuenta; ?>" />
    <span class="style15"><?php echo $leyenda; ?></span>
    <table width="639" border="1" align="center">
      <tr>
        <th width="60" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">C&oacute;digo</span></th>
        <th width="219" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">Descripci&oacute;n</span></th>
        <th width="74" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">Almac&eacute;n</span></th>
        <th width="74" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">Cantidad</span></th>
        <th width="68" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">F. Inicial</span></th>
        <th width="63" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">F. Final </span></th>
        <th width="35" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">Elimina</span></th>
      </tr>
      <tr>
<?php	
$sSQL= "SELECT 
 *
FROM
  `conveniosxCantidad`

 WHERE numCliente = '".$numCliente."'

 ";
$result=mysql_db_query($basedatos,$sSQL);

if($numCliente){
while($myrow = mysql_fetch_array($result)){ 

$codigo=$myrow['codigo'];
$checaModuloScript2= "Select * from articulos WHERE codigo = '".$codigo."' ";
$resScript2=mysql_db_query($basedatos,$checaModuloScript2);
$resulScripModulo2 = mysql_fetch_array($resScript2);
echo mysql_error();


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
        <td height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <label> <span class="style11 style13">
          <?php 
	
		  $C=$myrow['codigo'];?>
       
		  </span>
          <?php echo $C?>          </label>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
	  if($resulScripModulo2['descripcion']){
	  echo $resulScripModulo2['descripcion'];
	  } else {
	  echo "El artículo existe en los convenios pero no en el inventario!!!";
	  }
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
if($myrow['almacen']){
echo $myrow['almacen'];
} else {
echo "---";
}
?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
   
          <input name="cantidad[]" type="text" class="style12"  value="<?php 
if($myrow['cantidad']){
echo $myrow['cantidad'];
} else {
echo '---';
}
?>" size="10"
<?php 
if($myrow['cantidadoPorcentaje']=='no'){
echo 'readonly=""';
}
?>
/>
         
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
	  echo $myrow['fechaInicial'];
	 // echo $myrow2['existencias'];
	 
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><label><span class="style7"><?php echo $myrow['fechaFinal'];
	 
	  ?>
          <input name="capa[]" type="hidden" id="capa[]" value="<?php echo $C; ?>" />
        </span></label></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><input name="elimina[]" type="checkbox" id="elimina[]" value="<?php echo $myrow['codigo']; ?>" /></td>
      </tr>
      <?php  
	  $bandera+='1';
	  }  //cierra while?>
    </table>
    <p align="center"><em> <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php }
	else {
	echo "No se encontraron registros..!";
	}
	?></em></p>
    <p align="center">
      <label>
      <input name="actualizar" type="submit" class="style12" id="actualiza" value="Actualizar" />
      <input name="quitar" type="submit" class="Estilo24" id="quitar" value="Eliminar art&iacute;culos" />
      </label>
    </p>
    <?php 
	
	
	} else {
	echo "No se encontraron convenios...";
	}
	
	?>

    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="flag" type="hidden"  value="<?php echo $bandera; ?>" />

</form>
  <p></p>
  
  
</body>
</html>
