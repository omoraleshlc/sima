<?php require('/configuracion/ventanasEmergentes.php');?>


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
cargosDirectos,impresionEspecial,descripcionImpresion,afectaExistencias,medicos,rutaModifica,porcentajeParticular,
porcentajeAseguradora,stock,precioPorAlmacen,tipoReporte,separadoAlmacen,honorarios,medicamento,
maximo,minimo,reorden,politicaPrecios
) values ('".$_POST['codigoGP']."','".$_POST['descripcionGP']."',
'".$_POST['ctaContableCostoGP']."','".$_POST['ctaContableIngresoGP']."',
'".$_POST['tasaGP']."','activo','".$entidad."','".$_POST['prefijo']."','".$_POST['coaseguro']."',
'".$_POST['cargosDirectos']."','".$_POST['impresionEspecial']."','".$_POST['descripcionImpresion']."',
    '".$_POST['afectaExistencias']."','".$_POST['medicos']."','".$_POST['rutaModifica']."','".$_POST['porcentajeParticular']."',
        '".$_POST['porcentajeAseguradora']."','".$_POST['stock']."','".$_POST['precioPorAlmacen']."',
            '".$_POST['tipoReporte']."','".$_POST['separadoAlmacen']."','".$_POST['honorarios']."' ,
                '".$_POST['medicamento']."','".$_POST['maximo']."','".$_POST['minimo']."','".$_POST['reorden']."','".$_POST['politicaPrecios']."'
                )";
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
 politicaPrecios='".$_POST['politicaPrecios']."',
     maximo='".$_POST['maximo']."',
         minimo='".$_POST['minimo']."',
             reorden='".$_POST['reorden']."',
      medicamento='".$_POST['medicamento']."',
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
$sSQL2= "Select * From gpoProductos WHERE  codigoGP = '".$_POST['codigoGP1']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
} 
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<h1 align="center">EDITAR</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="512" class="table-forma">
    <tr>
      <td width="103"  scope="col"><div align="left">C&oacute;digo GP </div>        <label></label></td>
      <td width="231"  scope="col"> 
        <div align="left">
          <input name="codigoGP" type="text"  id="codigoGP" value="<?php echo $myrow2['codigoGP'] ?>" <?php if( $myrow2['codigoGP']){ echo 'readonly';} ?>/>
        </div></td>
    </tr>
    <tr>
      <td ><div align="left">Descripci&oacute;n de GP:</div></td>
      <td ><div align="left">
        <input name="descripcionGP" type="text"  id="descripcionGP" value ="<?php echo $myrow2['descripcionGP'] ?>" size="60"/>
      </div></td>
    </tr>
    <tr>
      <td ><div align="left">Tasa: </div></td>
      <td ><label>
	<?php   
	  		  $sSQL7= "Select * From TASA  order by keyTasa ASC ";
$result7=mysql_db_query($basedatos,$sSQL7);

?>
	  
        <select name="tasaGP"  id="tasaGP">
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
      <td ><div align="left">Cta. Contable Ingreso </div></td>
      <td ><div align="left">
        <input name="ctaContableIngresoGP" type="text"  id="ctaContableIngresoGP" value="<?php echo $myrow2['ctaContableIngresoGP']; ?>" />
      </div></td>
    </tr>
    <tr>
      <td >Incluye Coaseguro </td>
      <td ><label>
        <input name="coaseguro" type="checkbox" id="coaseguro" value="si" <?php 
		if($myrow2['coaseguro']=='si'){
		echo 'checked=""';
		} 
		?> />
      </label></td>
    </tr>
    <tr>
      <td >Afecta Existencias </td>
      <td ><input name="afectaExistencias" type="checkbox" id="afectaExistencias" value="si" <?php 
		if($myrow2['afectaExistencias']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>
    <tr>
      <td >Cargos Directos </td>
      <td ><input name="cargosDirectos" type="checkbox" id="coaseguro2" value="si" <?php 
		if($myrow2['cargosDirectos']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>
    <tr>
      <td >Se considera como Honorarios</td>
      <td ><input name="honorarios" type="checkbox" id="honorarios" value="si" <?php 
		if($myrow2['honorarios']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>


      <tr>
      <td >Impresi&oacute;n Especial </td>
      <td ><input name="impresionEspecial" type="checkbox" id="cargosDirectos" value="si" <?php 
		if($myrow2['impresionEspecial']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>



    <tr>
      <td >Es un Medicamento</td>
      <td ><input name="medicamento" type="checkbox" id="cargosDirectos" value="si" <?php
		if($myrow2['medicamento']=='si'){
		echo 'checked=""';
		}
		?> /></td>
    </tr>



      <tr>
      <td >Maximo(Solo Medicamentos)</td>
      <td ><input name="maximo" type="text" size="5" value="<?php echo $myrow2['maximo'];?>" /></td>
      </tr>


      <tr>
      <td >Minimo(Solo Medicamentos)</td>
      <td ><input name="minimo" type="text" size="5"  value="<?php echo $myrow2['minimo'];?>" /></td>
      </tr>


      <tr>
      <td >Reorden(Solo Medicamentos)</td>
      <td ><input name="reorden" type="text" size="5" value="<?php echo $myrow2['reorden'];?>" /></td>
      </tr>



    <tr>
      <td >Separado por almacen</td>
      <td ><input name="separadoAlmacen" type="checkbox" id="separadoAlmacen" value="si" <?php 
		if($myrow2['separadoAlmacen']=='si'){
		echo 'checked=""';
		} 
		?> />
        (afecta al imprimir la factura, desglosa por departamento)</td>
    </tr>
    <tr>
      <td >Tipo de Reportes</td>
      <td ><label>
        <select name="tipoReporte"  id="tipoReporte">
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
      <td >&iquest;Contiene M&eacute;dicos?</td>
      <td ><input name="medicos" type="checkbox" id="medicos" value="si" <?php 
		if($myrow2['medicos']=='si'){
		echo 'checked=""';
		} 
		?> /></td>
    </tr>
    <tr>
      <td >Ruta  Modifica</td>
      <td ><input name="rutaModifica" type="text"  id="rutaModifica" size="60" value="<?php 
		echo $myrow2['rutaModifica'];?>" /></td>
    </tr>
    <tr>
      <td >Descripci&oacute;n Impresion </td>
      <td ><label>
        <input name="descripcionImpresion" type="text"  id="descripcionImpresion" size="60" value="<?php 
		echo $myrow2['descripcionImpresion'];?>" />
      </label></td>
    </tr>
    <tr>
      <td ><div align="left">Prefijo</div></td>
      <td ><input name="prefijo" type="text"  id="prefijo" value="<?php echo $myrow2['prefijo'];?>" size="5" /></td>
    </tr>

      
    <tr>
      <td >Precio x Almacen </td>
      <td ><input name="precioPorAlmacen" type="checkbox" id="precioPorAlmacen" value="si" <?php 
		if($myrow2['precioPorAlmacen']=='si'){
		echo 'checked=""';
		} 
		?> /> 
        *Asignar precio individual si esta la casilla activa.. </td>
    </tr>
	
	
	    <tr>
      <td >Incluye Politica de Precios</td>
      <td ><input name="politicaPrecios" type="checkbox" id="politicaPrecios" value="si" <?php 
		if($myrow2['politicaPrecios']=='si'){
		echo 'checked=""';
		} 
		?> /> 
        *Afecta la politica de precios.. </td>
    </tr>



  </table><br />
  <div align="center" >
        <input name="nuevo" type="submit"  id="nuevo" value="Nuevo" /> 
        <input name="actualizar" type="submit"  id="actualizar" value="Modificar/Grabar " /> 
        <input name="borrar" type="submit"  id="borrar" value="Eliminar" />
      </div>
  
  
</form>
 <br>
 
<p>&nbsp;</p>
</body>
</html>
