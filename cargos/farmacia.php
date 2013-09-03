<?php include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<?php
$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
$almacen=$_GET['almacen'];

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
  </label>
</p>
<form id="form2" name="form2" method="post" action="" onSubmit="return valida(this);">
  <table width="419" border="1" align="center">
    <tr>
      <th width="103" scope="col"><div align="center"><span class="style12">Cargar Materiales </span></div></th>
      <th width="300" scope="col"><div align="left"><span class="style12">
          <input name="nomArticulo"  autocomplete="off" type="text" class="style12" id="nomArticulo" size="60" value="<?php if($_POST['nomArticulo']) echo $_POST['nomArticulo']; ?>"/>
      </span></div></th>
    </tr>
    <tr>
      <th height="43" scope="col">&nbsp;</th>
      <th scope="col"><label>
          <div align="left">
            <input name="buscar" type="submit" class="style12" id="buscar" value="buscar" />
          </div>
        </label></th>
    </tr>
  </table>
  <p align="center"><span class="Estilo24"><span class="style7">
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
    <span class="style15"><?php echo $leyenda; ?></span>  </p>
    <?php	
	  $articulo=$_POST['nomArticulo'];
if(($_POST['buscar']) OR ($_POST['nomArticulo'] OR $_POST['cbarra'])){

$sSQL= "SELECT 
* 
FROM articulos,existencias
WHERE
articulos.activo='A' and
articulos.descripcion like '%$articulo%' and
articulos.codigo=existencias.codigo and
existencias.almacen='halm'
and
articulos.um<>'s'
";


if($_POST['nomArticulo']){
if($result=mysql_db_query($basedatos,$sSQL)){

?>
    <table width="330" border="0" align="center">
      <tr>
        <th width="45" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo  </span></div></th>
        <th width="181" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="49" bgcolor="#660066" scope="col"><span class="style11">Existencias</span></th>
        <th width="37" bgcolor="#660066" scope="col"><span class="style11">Anaquel</span></th>
      </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codigo'];


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$sSQL4= "
SELECT 
  *
FROM
existencias
WHERE codigo = '".$code1."'
and 
almacen='".$almacen."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

?>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label></label>
          <?php echo $myrow['codigo']; ?>
          <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codigo']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['descripcion']; ?></span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <?php 
	  if($myrow['existencia']){
	  echo $myrow['existencia'];
	  } else {
	  echo "N/A";
	  }
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <?php 
	  if($myrow['anaquel']){
	  echo $myrow['anaquel'];
	  } else {
	  echo "N/A";
	  }
	  ?>
        </span></td>
      </tr>
      <?php }}}?>
  </table>
    <p>&nbsp;    </p>
    <?php } ?>
    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
</form>
  <p></p>
  
  
</body>
</html>
