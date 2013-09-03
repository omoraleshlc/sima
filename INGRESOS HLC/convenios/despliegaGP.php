<?php include("/configuracion/ventanasEmergentes.php");require("/configuracion/funciones.php") ?>
<?php
$numCliente=$_GET['seguro'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
?>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 
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
                alert("Por Favor, escoje como quieres agregar art�culos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 
if($_POST['actualizar'] and $_POST['cantidad']){

$cantidad=$_POST['cantidad'];
$capa=$_POST['capa'];
$fechaFinal=$_POST['fechaFinal'];
for($i=0;$i<=$_POST['flag'];$i++){
if($capa[$i]){
$sql="Update conveniosxPorcentaje
set
porcentaje = '".$cantidad[$i]."', 
usuario='".$usuario."',
fechaFinal='".$fechaFinal[$i]."',
fecha1='".$fecha1."'
where keyConvenios='".$capa[$i]."'";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}
echo "Se actualizo el convenio";
}
?>





<?php 

if($_POST['quitar'] and $_POST['elimina']){

$codigo=$_POST['elimina'];


for($i=0;$i<$_POST['flag'];$i++){
if($codigo[$i]!=null){
$borrame = "DELETE FROM convenios WHERE keyConvenios='".$codigo[$i]."'";
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
<?php
$estilo= new muestraEstilos();
$estilo->styles();

?>
</head>

<body>
<p align="center">


  <span class="normal"><?php
$sSQL23= "Select * From clientes WHERE entidad='".$entidad."' and numCliente ='".$numCliente."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'].'</br>';
echo $leyenda;
?> </span></p>
<form id="form2" name="form2" method="post" action="" >
    <span class="normal"><span class="normal">
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
    <span class="normal"><?php echo $leyenda; ?></span>
	
	
	
	
	
	
	
	
	
	
	
	
	
    <img src="/sima/imagenes/bordestablas/borde2.png" width="400" height="24" />
    <table width="400" border="0" align="center">
       <tr bgcolor="#FFFF00">
        <th width="100"  class="normal" scope="col"><div align="left"><span class="normal">Almacen</span></div></th>
        <th width="41"  class="normal" scope="col"><div align="left"><span class="normal">GPO</span></div></th>
        <th width="52"  class="normal" scope="col"><div align="left"><span class="normal">F. Inicial</span></div></th>
        <th width="51"  class="normal" scope="col"><div align="left"><span class="normal">F. Final </span></div></th>
        <th width="39"  class="normal" scope="col"><div align="left"><span class="normal">Elimina</span></div></th>
      </tr>
      <tr>
<?php	
$sSQL= "SELECT 
 *
FROM
  convenios

 WHERE 
 tipoConvenio='grupoProducto'
 and
 entidad='".$entidad."'
 and
 numCliente = '".$_GET['numCliente']."'

 ";
$result=mysql_db_query($basedatos,$sSQL);

if($_GET['numCliente']){
while($myrow = mysql_fetch_array($result)){ 

$gpoProducto=$myrow['gpoProducto'];

$sSQL2a= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$myrow['departamento']."' ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);



$sSQL2= "Select * From gpoProductos WHERE entidad='".$entidad."' AND codigoGP = '".$gpoProducto."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>


             <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
        <td height="24"  class="normal"><span class="normal">
          <?php 
if($myrow2a['descripcion']){
echo $myrow2a['descripcion'];
} else {
echo "---";
}
?>
        </span></td>
        <td  class="normal"><span class="normal">
   
        <?php 
if($myrow2['descripcionGP']){
echo $myrow2['descripcionGP'];
} else {
echo '---';
}
?>

         
        </span></td>
        <td  class="normal"><span class="normal">
          <?php 
	  echo cambia_a_normal($myrow['fechaInicial']);
	 // echo $myrow2['existencias'];
	 
	  ?>
          <input name="capa[]" type="hidden" id="capa[]" value="<?php echo $C; ?>" />
        </span></td>
        <td  class="normal"><label>
      <?php echo cambia_a_normal($myrow['fechaFinal']); ?>
</label></td>
        <td  class="normal"><input name="elimina[]" type="checkbox" id="elimina[]" value="<?php echo $myrow['keyConvenios']; ?>" /></td>
      </tr>
      <?php  
	  $bandera+='1';
	  }  //cierra while?>
  </table>
    <img src="/sima/imagenes/bordestablas/borde2.png" width="400" height="24" />
<p align="center"><em> <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php }
	else {
	echo "No se encontraron registros..!";
	}
	?></em></p>
    <p align="center">
      <label>
      <input name="quitar" type="submit" class="normal" id="quitar" value="Eliminar art&iacute;culos" />
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
