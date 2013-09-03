<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php
$_POST['codigo']=$_GET['codigo'];
?>



<?php 
if($_POST['nuevo']){
$_POST['usuario']="";
$leyenda = "Ingrese los datos correctamente";
}



if($_POST['actualizar'] AND $_POST['codigo'] ){ 
$agregar = $_POST["codAlmacen"];
 $maximo=$_POST['maximo'];
 $minimo=$_POST['minimo'];
 $reorden=$_POST['reorden'];
 
for($i=0;$i<=$_POST['pasoBandera'];$i++){
if($maximo[$i] and $minimo[$i] and $reorden[$i]){//cierra validacion
$q = "UPDATE existencias set 
maximo='".$maximo[$i]."',
minimo='".$minimo[$i]."',
reorden='".$reorden[$i]."'
WHERE 
codigo='".$_POST['codigo']."' AND almacen='".$agregar[$i]."'
";
mysql_db_query($basedatos,$q);
$leyenda = "Se actualizó el usuario: ".$_POST['usuario'];
echo mysql_error();
}

$leyenda = "Se ingresó el almacén para el artículo: ".$_POST['codigo'];
} //cierra validacion
}







if($_POST['borrar'] AND $_POST['codigo']){
if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
 $borrame = "DELETE maximo,minimo,reorden FROM existencias WHERE codigo ='".$_POST['codigo']."' 
AND almacen = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

//mysql_db_query($basedatos,$borrameNivel);
/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
 */
}$leyenda = "Se eliminó del almacén ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['usuario']){
$leyenda = "Por favor, escoja el nombre de almacén que desee quitar.!";
}






if($_POST['usuario']){
$sSQL1= "Select distinct * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
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
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.style15 {color: #0000FF}
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label></p>
<form id="form2" name="form2" method="post" action="">
<table width="323" border="0" align="center" class="style12">
      <tr>
        <th colspan="2" bgcolor="#660066" scope="col"><strong><span class="style13">Asignar art&iacute;culo -&gt; Almac&eacute;n </span></strong></th>
      </tr>
      <tr>
        <th scope="col">C&oacute;digo: </th>
        <th width="152" scope="col"><label>
          <input name="codigo" type="text" class="style12" id="codigo" readonly="" value="<?php echo $_POST['codigo']; ?>" />
        </label></th>
      </tr>
  </table>
    <p align="center">
	<?php 
	$sSQL6="SELECT *
FROM
  `articulos`
WHERE
codigo = '".$_POST['codigo']."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  echo $myrow6['descripcion'];
  ?>
    </p>
    <table width="537" border="0" align="center">
      <tr>
        <th width="112" height="16" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo del Almac&eacute;n </span></th>
        <th width="270" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="40" bgcolor="#660066" scope="col"><span class="style11">M&aacute;ximos</span></th>
        <th width="41" bgcolor="#660066" scope="col"><span class="style11">M&iacute;nimos </span></th>
        <th width="40" bgcolor="#660066" scope="col"><span class="style11">Reorden</span></th>
        <th width="40" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
      </tr>
      <tr>
        <?php   
 $sSQL= "Select distinct * From almacenes 
 where ventas='si' and activo='A'
 and
 almacen='HALM'
 order by almacen ASC";
$result=mysql_db_query($basedatos,$sSQL); 
?>
        <?php	while($myrow = mysql_fetch_array($result)){
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
	  $sSQL6="SELECT *
FROM
 existencias
WHERE
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  
  if($myrow6['almacen']){
  $estilo='style13';
  $color='#0000FF';
  } else {
  $estilo='style12';
  }
?>
        <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
  <label></label>
          </span>
          <div align="center"><span class="<?php echo $estilo?>"><?php echo $myrow['almacen'];?></span></div></td><td bgcolor="<?php echo $color?>" class="<?php echo $estilo?>"><span class="style12"><?php echo $myrow['descripcion'];?></span>
            <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
            <input name="codAlmacen[]" type="hidden" id="codAlmacen[]" value="<?php echo $myrow['almacen']; ?>" /></td>
        <td bgcolor="<?php echo $color?>" class="style12"><label>
          <input name="maximo[]" type="text" class="style12" id="maximo[]" value="<?php echo $myrow6['maximo']; ?>" size="3" maxlength="3" <?php 
		if(!$myrow6['almacen']){ echo 'readonly=""';}?> onKeyPress="return checkIt(event)"/>
        </label></td>
        <td bgcolor="<?php echo $color?>" class="style12"><input name="minimo[]" type="text" class="style12" id="minimo[]"  value="<?php echo $myrow6['minimo']; ?>" size="3" maxlength="3"  <?php 
		if(!$myrow6['almacen']){ echo 'readonly=""';}?> onKeyPress="return checkIt(event)"/></td>
        <td bgcolor="<?php echo $color?>" class="style12"><input name="reorden[]" type="text" class="style12" id="reorden[]"  value="<?php echo $myrow6['reorden']; ?>" size="3" maxlength="3" <?php 
		if(!$myrow6['almacen']){ echo 'readonly=""';}?> onKeyPress="return checkIt(event)"/></td>
        <td bgcolor="<?php echo $color?>" class="style12"><input name="quitar[]" type="checkbox" class="style12" id="quitar[]" 
		value="<?php 
		
		echo $myrow6['almacen'];
		
		?>" 
		<?php if(!$myrow6['almacen']){
		echo 'disabled="disabled"';
		}
		?>></td>
      </tr>
      <?php }?>
  </table>
    <p align="center">
      <label>
      <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar M&aacute;ximos, Min, R." />
      </label>
      <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar/Borrar" />
    </p>
</form>
  <p></p>
  
  
</body>
</html>
