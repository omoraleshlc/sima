<?php require('/configuracion/ventanasEmergentes.php');?>


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


<?php
if(!$_POST['codigoGP1']){
$_POST['codigoGP1']=$_GET['codigoGP1'];
}

if(!$_POST['coaseguro']){
$_POST['coaseguro']='no';
}

if(!$_POST['cargosDirectos']){
$_POST['cargosDirectos']='no';
}

if(!$_POST['impresionEspecial']){
$_POST['impresionEspecial']='no';
}


if($_POST['actualizar'] AND $_POST['codigoGP']){



 $sSQL1= "Select * From gpoProductos WHERE codigoGP = '".$_POST['codigoGP']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if($myrow1['codigoGP'] and $myrow1['entidad']!=$entidad){ ?>
<script>
window.alert("El codigo de grupo que estas cargando: <?php echo $_POST['codigoGP'];?> ya existe en la entidad: <?php echo $myrow1['entidad'];?>, escoje otro codigo, gracias!");
window.close();
</script>
<?php 
}





 $sSQL1= "Select * From gpoProductos WHERE entidad='".$entidad."' and codigoGP = '".$_POST['codigoGP']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoGP']){
if($_POST['codigoGP']!=$myrow1['codigoGP']){

 $agrega = "INSERT INTO gpoProductos (
codigoGP,descripcionGP,ctaContableCostoGP,ctaContableIngresoGP,tasaGP,activo,entidad,prefijo,coaseguro,
cargosDirectos,impresionEspecial,descripcionImpresion,afectaExistencias,medicos,rutaModifica,porcentajeParticular,porcentajeAseguradora,stock,precioPorAlmacen,tipoReporte,separadoAlmacen,honorarios
) values ('".$_POST['codigoGP']."','".$_POST['descripcionGP']."',
'".$_POST['ctaContableCostoGP']."','".$_POST['ctaContableIngresoGP']."',
'".$_POST['tasaGP']."','activo','".$entidad."','".$_POST['prefijo']."','".$_POST['coaseguro']."',
'".$_POST['cargosDirectos']."','".$_POST['impresionEspecial']."','".$_POST['descripcionImpresion']."','".$_POST['afectaExistencias']."','".$_POST['medicos']."','".$_POST['rutaModifica']."','".$_POST['porcentajeParticular']."','".$_POST['porcentajeAseguradora']."','".$_POST['stock']."','".$_POST['precioPorAlmacen']."','".$_POST['tipoReporte']."','".$_POST['separadoAlmacen']."','".$_POST['honorarios']."'    )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

?>
<script >
  <!--
window.opener.document.forms["form1"].submit();
window.alert( "SE AGREGO EL GRUPO DE PRODUCTO!");
    window.close();
  // -->
</script>

<?php 
}} else {
 $q = "UPDATE gpoProductos set 
 precioPorAlmacen='".$_POST['precioPorAlmacen']."',
porcentajeParticular='".$_POST['porcentajeParticular']."',
porcentajeAseguradora='".$_POST['porcentajeAseguradora']."', 

descripcionGP='".$_POST['descripcionGP']."',
ctaContableCostoGP='".$_POST['ctaContableCostoGP']."',
ctaContableIngresoGP='".$_POST['ctaContableIngresoGP']."',
medicos='".$_POST['medicos']."',
tasaGP='".$_POST['tasaGP']."',stock='".$_POST['stock']."',
coaseguro='".$_POST['coaseguro']."',
prefijo='".$_POST['prefijo']."',
cargosDirectos='".$_POST['cargosDirectos']."',
impresionEspecial='".$_POST['impresionEspecial']."',descripcionImpresion='".$_POST['descripcionImpresion']."',
afectaExistencias='".$_POST['afectaExistencias']."',
rutaModifica='".$_POST['rutaModifica']."',
tipoReporte='".$_POST['tipoReporte']."',
separadoAlmacen='".$_POST['separadoAlmacen']."',
honorarios='".$_POST['honorarios']."'

WHERE 
entidad='".$entidad."'
and
codigoGP='".$_POST['codigoGP']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();

?>
<script>
  <!--
window.opener.document.forms["form1"].submit();
window.alert( "SE ACTUALIZO EL GRUPO DE PRODUCTO!");
window.close();
  // -->
</script>
<?php 
}
}

if($_POST['borrar'] AND $_POST['codigoGP']){
$borrame = "DELETE FROM gpoProductos WHERE entidad='".$entidad."' AND codigoGP ='".$_POST['codigoGP']."'";
//mysql_db_query($basedatos,$borrame);
$borrame = "DELETE FROM articulos WHERE  entidad='".$entidad."' AND gpoProducto ='".$_POST['codigoGP']."'";
//mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script>
window.alert( "SE ELIMINO EL GRUPO DE  PRODUCTO!");
</script>';

}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['codigoGP1'] = "";
}
 if($_POST['codigoGP1'] AND !$_POST['nuevo']){
$sSQL2= "Select * From gpoProductos WHERE entidad='".$entidad."' AND codigoGP = '".$_POST['codigoGP1']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
} 
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.style12 {font-size: 10px}
-->
</style>
</head>

<body>
<h2 align="center">EDITAR</h2>
<form id="form1" name="form1" method="post" action="">
  <table width="512" border="0" align="center">
    <tr>
      <th width="103" class="style12" scope="col"><div align="left">C&oacute;digo GP </div>        <label></label></th>
      <th width="231" class="style12" scope="col"> 
        <div align="left">
          <input name="codigoGP" type="text" class="style12" id="codigoGP" value="<?php echo $myrow2['codigoGP'] ?>" <?php if( $myrow2['codigoGP']){ echo 'readonly';} ?>/>
        </div></th>
    </tr>
    <tr>
      <td class="style12"><div align="left">Descripci&oacute;n de GP:</div></td>
      <td class="style12"><div align="left">
        <input name="descripcionGP" type="text" class="style12" id="descripcionGP" value ="<?php echo $myrow2['descripcionGP'] ?>" size="60"/>
      </div></td>
    </tr>
    <tr>
      <td class="style12"><div align="left">Tasa: </div></td>
      <td class="style12"><label>
	<?php   
	  		  $sSQL7= "Select * From TASA  order by keyTasa ASC ";
$result7=mysql_db_query($basedatos,$sSQL7);

?>
	  
        <select name="tasaGP" class="style12" id="tasaGP">
          <?php 		if($myrow2['tasaGP']!=null){ ?>
          <option value="<?php echo $myrow2['tasaGP']; ?>"><?php echo $myrow2['tasaGP']; ?></option>
          <?php } ?>
          <option></option>
          <?php  	 		 


		   while($myrow7 = mysql_fetch_array($result7)){ ?>
          <option value="<?php echo $myrow7['codTasa']; ?>"><?php echo $myrow7['codTasa']; ?></option>
          <?php } 
		
		?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td class="style12"><div align="left">Cta. Contable Ingreso </div></td>
      <td class="style12"><div align="left">
        <input name="ctaContableIngresoGP" type="text" class="style12" id="ctaContableIngresoGP" value="<?php echo $myrow2['ctaContableIngresoGP']; ?>" />
      </div></td>
    </tr>
    <tr>
      <td class="style12">Incluye Coaseguro </td>
      <td class="style12"><label>
        <input name="coaseguro" type="checkbox" id="coaseguro" value="si" <?php 
		if($myrow2['coaseguro']=='si'){
		echo 'checked=""';
		} 
		?> />
      </label></td>
    </tr>
    <tr>
      <td class="style12">Afecta Existencias </td>
      <td class="style12"><input name="afectaExistencias" type="checkbox" id="afectaExistencias" value="si" <?php 
		if($myrow2['afectaExistencias']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>
    <tr>
      <td class="style12">Cargos Directos </td>
      <td class="style12"><input name="cargosDirectos" type="checkbox" id="coaseguro2" value="si" <?php 
		if($myrow2['cargosDirectos']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>
    <tr>
      <td class="style12">Se considera como Honorarios</td>
      <td class="style12"><input name="honorarios" type="checkbox" id="honorarios" value="si" <?php 
		if($myrow2['honorarios']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>
    <tr>
      <td class="style12">Impresi&oacute;n Especial </td>
      <td class="style12"><input name="impresionEspecial" type="checkbox" id="cargosDirectos" value="si" <?php 
		if($myrow2['impresionEspecial']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>
    <tr>
      <td class="style12">Separado por almacen</td>
      <td class="style12"><input name="separadoAlmacen" type="checkbox" id="separadoAlmacen" value="si" <?php 
		if($myrow2['separadoAlmacen']=='si'){
		echo 'checked=""';
		} 
		?> />
        (afecta al imprimir la factura, desglosa por departamento)</td>
    </tr>
    <tr>
      <td class="style12">Tipo de Reportes</td>
      <td class="style12"><label>
        <select name="tipoReporte" class="style12" id="tipoReporte">
          <option value="">Escoje</option>
          <option
          <?php if($myrow2['tipoReporte']=='almacenDestino'){ print 'selected="selected"';} ?>
           value="almacenDestino">almacenDestino</option>
          <option
          <?php if($myrow2['tipoReporte']=='almacenSolicitante'){ print 'selected="selected"';} ?>
           value="almacenSolicitante">almacenSolicitante</option>
        </select>
      (afecta en hoja de auditor&iacute;a)</label></td>
    </tr>
    <tr>
      <td class="style12">&iquest;Contiene M&eacute;dicos?</td>
      <td class="style12"><input name="medicos" type="checkbox" id="medicos" value="si" <?php 
		if($myrow2['medicos']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>
    <tr>
      <td class="style12">Ruta  Modifica</td>
      <td class="style12"><input name="rutaModifica" type="text" class="style12" id="rutaModifica" size="60" value="<?php 
		echo $myrow2['rutaModifica'];?>" /></td>
    </tr>
    <tr>
      <td class="style12">Descripci&oacute;n Impresion </td>
      <td class="style12"><label>
        <input name="descripcionImpresion" type="text" class="style12" id="descripcionImpresion" size="60" value="<?php 
		echo $myrow2['descripcionImpresion'];?>" />
      </label></td>
    </tr>
    <tr>
      <td class="style12"><div align="left">Prefijo</div></td>
      <td class="style12"><input name="prefijo" type="text" class="style12" id="prefijo" value="<?php echo $myrow2['prefijo'];?>" size="5" /></td>
    </tr>
    <tr>
      <td class="style12">Porcentaje Particular</td>
      <td class="style12"><input name="porcentajeParticular" type="text" class="style12" id="porcentajeParticular" value="<?php echo $myrow2['porcentajeParticular'] ?>" size="3" maxlength="3" onKeyPress="return checkIt(event)"/></td>
    </tr>
    <tr>
      <td class="style12">Porcentaje Aseguradora</td>
      <td class="style12"><input name="porcentajeAseguradora" type="text" class="style12" id="porcentajeAseguradora" value="<?php echo $myrow2['porcentajeAseguradora'] ?>" size="3" maxlength="3" onKeyPress="return checkIt(event)"/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
	
	
	

    <tr>
      <td class="style12"><label></label></td>
    </tr>

    <tr>
      <td colspan="2" class="style12"><div align="left" class="style12">
        <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" /> 
        <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar " /> 
        <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar" />
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
