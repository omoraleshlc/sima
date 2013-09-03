<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); 
$numCliente=$_GET['numCliente'];
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
if($_POST['actualizar'] and $_POST['costo']){

$costo=$_POST['costo'];
$keyConvenios=$_POST['keyConvenios1'];
for($i=0;$i<=$_POST['flag'];$i++){

 $sql="Update convenios
set
costo = '".$costo[$i]."', 
usuario='".$usuario."'
where keyConvenios='".$keyConvenios[$i]."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();

}
 $leyenda='Se actualizaron Registros...';
}
?>





<?php 

if(!$_POST['actualizar'] and $_POST['keyConvenios'] and $_POST['eliminar']){

$keyConvenios=$_POST['keyConvenios'];


for($i=0;$i<$_POST['flag'];$i++){

if($keyConvenios[$i]){
$borrame = "DELETE FROM convenios WHERE keyConvenios='".$keyConvenios[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}

}
echo "Se eliminaron convenios";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
<span class="titulos">
<?php echo $_POST['almacenDestino'];
$sSQL23= "Select * From clientes WHERE numCliente ='".$numCliente."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'].'</br>';

?> </span></p>
<form id="form2" name="form2" method="post" action="" >
    <p align="center" class="titulomedio"><?php echo $leyenda; ?>Precios Especiales</p>
    <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td colspan="7"><img src="../../imagenes/bordestablas/borde1.png" width="710" height="25" /></td>
      </tr>
      <tr>
        <td width="238" bgcolor="#FFFF00" class="negromid">Grupo Prod</td>
        <td width="191" bgcolor="#FFFF00" class="negromid">Depto.</td>
        <td width="42" align="center" bgcolor="#FFFF00" class="negromid">Porc.</td>
        <td width="89" align="center" bgcolor="#FFFF00" class="negromid">F. Inicial</td>
        <td width="81" align="center" bgcolor="#FFFF00" class="negromid">F. Final</td>
        <td width="69" align="center" bgcolor="#FFFF00" class="negromid">Quitar</td>
      </tr>
<?php	

$sSQL= "SELECT 
 *
FROM
  convenios
   WHERE 
   entidad='".$entidad."'
   and
tipoConvenio='precioEspecial'
and

numCliente = '".$_GET['numCliente']."'


 ";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;

if($myrow['tipoConvenio']=='cantidad'){
$codigo=$myrow['codigo'];
$checaModuloScript2= "Select descripcion from articulos WHERE codigo = '".$codigo."' ";
$checaModuloScript24= "Select descripcion from almacenes WHERE almacen = '".$myrow['departamento']."' ";
$resScript24=mysql_db_query($basedatos,$checaModuloScript24);
$resulScripModulo24 = mysql_fetch_array($resScript24);
$descripcionAlmacen=$resulScripModulo24['descripcion'];

$resScript2=mysql_db_query($basedatos,$checaModuloScript2);
$resulScripModulo2 = mysql_fetch_array($resScript2);
$descripcion=$resulScripModulo2['descripcion'];
$descripcion=$descripcion.' ['.$descripcionAlmacen.']';
echo mysql_error();
} else if($myrow['tipoConvenio']=='grupoProducto') {

$codigo=$myrow['gpoProducto'];
$checaModuloScript2= "Select descripcionGP from gpoProductos WHERE codigoGP = '".$codigo."' ";
$resScript2=mysql_db_query($basedatos,$checaModuloScript2);
$resulScripModulo2 = mysql_fetch_array($resScript2);
$descripcion=$resulScripModulo2['descripcionGP'];
} else {
$descripcion='Convenio Global';
}

?>      
      
      <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
        <td height="40"><span class="normalmid">
          <?php if($myrow['gpoProducto']){
		  
$checaModuloScript2= "Select descripcionGP from gpoProductos WHERE codigoGP = '".$myrow['gpoProducto']."' ";
$resScript2=mysql_db_query($basedatos,$checaModuloScript2);
$resulScripModulo2 = mysql_fetch_array($resScript2);
echo $resulScripModulo2['descripcionGP'];
		  
		  }
		  ?>
          <br /></span>
        <span class="codigos"> <?php if($myrow['incluireferidos']=''){
		echo 'Incluye Referidos';

		} else {
        echo 'No incluye referidos';
        }
?>
</span></td>
        <td  class="normalmid">
          <?php 
if($myrow['departamento']=='*'){
echo $myrow['departamento']." [Todos] ";
} else if($myrow['departamento']){

$checaModuloScript24= "Select descripcion from almacenes WHERE almacen = '".$myrow['departamento']."' ";
$resScript24=mysql_db_query($basedatos,$checaModuloScript24);
$resulScripModulo24 = mysql_fetch_array($resScript24);
echo $resulScripModulo24['descripcion'];
} else {
echo "---";
}
?>
  </td>
        <td align="center">
          <input name="costo[]" type="text" class="camposmid" id="costo[]"  value="<?php 
if($myrow['costo']){
echo $myrow['costo'];
} else {
echo '0';
}
?>" size="3" maxlength="3"
<?php 
if($myrow['cantidadoPorcentaje']=='no'){
echo 'readonly=""';
}
?>
/>
        </span></span></td>
        <td align="center" class="precio1">
          <?php 
	  echo cambia_a_normal($myrow['fechaInicial']);
	 // echo $myrow2['existencias'];
	 
	  ?>
        </td>
        <td align="center" class="precio2"><?php echo cambia_a_normal($myrow['fechaFinal'],2);
	  ?> </td>
        <td align="center">
          <input name="keyConvenios[]" type="checkbox" id="keyConvenios[]" value="<?php echo $myrow['keyConvenios']; ?>" />
        </span></td>
      </tr>
       <?php  
	  $bandera+='1';
	  }  //cierra while
	  ?>
      <tr>
        <td colspan="7"><img src="../../imagenes/bordestablas/borde2.png" width="710" height="25" /></td>
      </tr>
    </table>
    <p align="center" class="titulomedio"><em> 
	
	
	<?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php 
	}else{
	echo "No se encontraron registros..!";
	}
	?>
    </em></p>





    <div align="center">

      <input name="almacenDestino" type="hidden" id="almacenDestino"  value="<?php echo $_POST['almacenDestino']; ?>" />
	 
	  
	  

	  <input name="almacenDestino1" type="hidden" id="almacenDestino1"  value="<?php echo $_POST['almacenDestino1']; ?>" />

	  

	  <input name="search" type="hidden" id="search"  value="search" />

	  
      <input name="flag" type="hidden"  value="<?php echo $bandera; ?>" />
      <?php if($bandera>=1){ ?>
      <input name="actualizar" type="submit" class="Estilo24" id="actualiza" value="Actualizar" />
      <input name="eliminar" type="submit" class="Estilo24" id="eliminar" value="Eliminar art&iacute;culos" />
	  <?php } ?>
   
    </div>
</form>
  <p></p>
  
  
</body>
</html>
