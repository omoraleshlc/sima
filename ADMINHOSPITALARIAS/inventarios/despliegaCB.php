<?php include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<?php
$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
$almacen=$_GET['almacen'];
$nCuenta=$_GET['nCuenta'];
$tipoPaciente=$_GET['tipoPaciente'];


if($_GET['codigo']){

$checaModuloScript= "Select * From CB WHERE keyCB='".$_GET['codigo']."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
$ruta=$resulScripModulo['ruta'];

if($ruta){
$borraImagen='rm -rf /var/www/html/sima/ADMINHOSPITALARIAS/inventarios/'.$ruta;
shell_exec($borraImagen);
}



$borrame = "DELETE FROM CB WHERE keyCB ='".$_GET['codigo']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ELIMINO ESTE CODIGO DE BARRA"
</script>';

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
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label></p>
<form id="form2" name="form2" method="GET" action="#" >
<table width="562" border="0" align="center">
    <tr>
      <th width="112" bgcolor="#FFCCFF" scope="col"><div align="left"><span class="style12">Cargar Art&iacute;culos </span></div></th>
      <th width="378" bgcolor="#FFCCFF" scope="col"><div align="left"><span class="style12">
<input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="60" value="<?php echo $_GET['nomArticulo']?>"/>
      </span>
          <input name="buscar" type="submit" class="Estilo24" id="buscar" value="buscar" />
      </div></th>
    </tr>
  </table>
  <p align="center"><span class="Estilo24"><span class="style7">

  </span></span>

    <span class="style15"><?php echo $leyenda; ?></span>  </p>
    <div align="center">
      <?php	
if($_GET['nomArticulo']){
$nomArticulo=$_GET['nomArticulo'];
$sSQL= "SELECT 
* 
FROM CB
WHERE
entidad='".$entidad."' AND
descripcion like '%$nomArticulo%'

";



if($result=mysql_db_query($basedatos,$sSQL)){

?>
      
   
      
      
      
      
           
      
</div>
    <table width="509" border="0" align="center">
      <tr>
        <th width="63" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo  </span></div></th>
        <th width="458" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="53" bgcolor="#660066" scope="col"><span class="style11">Elimina</span></th>
        <th width="156" bgcolor="#660066" scope="col"><span class="style11">Imagen</span></th>
      </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$code=$myrow['keyCB'];

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



?>
        <td height="64" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label></label>
          <?php echo $myrow['codigoCB']; ?>
      
          <input name="codigoBeta[]" type="hidden" id="codigoBeta[]" value="<?php  echo $myrow['codigoCB']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['descripcion']; ?><?php //echo $myrow12['um'].$myrow13['umVentas']; ?></span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><a href="despliegaCB.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;usuario=<?php echo $E; ?>"><img src="/sima/imagenes/borrar.png" alt="Bot&oacute;n Eliminar" width="23" height="23" border="0" onclick="if(confirm('Esta seguro que deseas eliminar este código de barras?') == false){return false;}" /></a></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><label>
        <label><img src="<?php  echo $myrow['ruta']; ?>" width="156" height="43" /> </label>
        </label>
        </span></td>
      </tr>
      <?php }?>
  </table>
  
  
  
    <p>
      <?php 
 
 //*********************************************TERMINA TABLA**************************************************
 
 ?></p>
    <p>
      <label>
      <div align="center">
        <hr width="600" size="0" />
        <p align="center">
		<?php if($bandera){ ?>
		<?php echo "Se encontraron $bandera artículos con la palabra: $nomArticulo"?>
		<?php } else { ?>
		<?php echo "No se encontró $articulo"?>
		<?php } ?>
		&nbsp; </p>
    <?php }} ?>

    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
</form>
  <p></p>
 
  
</body>
</html>
