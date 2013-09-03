<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include('/configuracion/clases/validaModulos.php'); ?>
<?php $articulo = $_POST['nomArticulo']; ?>

<?php 
if($_POST['borrar'] AND $_POST['quitar']){
//echo "bandera".$_POST['bandera'];

$quitar=$_POST['quitar'];
for($i=0;$i<=$_POST['bandera'];$i++){
$banderita+=1;
if($quitar[$i]!=NULL){
$borrame = "DELETE FROM articulos WHERE entidad='".$entidad."' AND codigo ='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$borrame1 = "DELETE FROM precioArticulos WHERE entidad='".$entidad."' AND codigo ='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrame1);
echo mysql_error();
$borrame2 = "DELETE FROM existencias WHERE entidad='".$entidad."' AND codigo ='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrame2);
echo mysql_error();
$borrameNivel = "DELETE FROM articulosPrecioNivel WHERE entidad='".$entidad."' AND codigo ='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrameNivel);
}
}?>
<script type="text/vbscript">
msgbox "SE ELIMINARON <?php echo $banderita; ?> REGISTROS.."
</script>';
<?php 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {
	font-size: 9px;
	color: #FFFFFF;
}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.style14 {color: #0000FF}
.style18 {font-size: 10px; font-style: italic; }
-->
</style>
</head>

<body>
<h1 align="center">ELIMINAR SERVICIOS </h1>
<form id="form2" name="form2" method="post" action="">
  <table width="0" height="0" border="0" align="center">
    <tr>
      <th bgcolor="#FFCCFF" scope="col">&nbsp;</th>
      <th bgcolor="#FFCCFF" scope="col">&nbsp;</th>
      <th bgcolor="#FFCCFF" scope="col">&nbsp;</th>
    </tr>
    <tr>
      <th width="22" scope="col"><input name="escoje" type="radio" value="porarticulo" checked="checked" /></th>
      <th width="156" scope="col"><div align="center"><span class="style12">Escribe el nombre del art&iacute;culo </span></div></th>
      <th width="484" scope="col"><span class="style12">
        </span>
        <div align="left"><span class="style12">
          <input name="nomArticulo2" type="text" class="style12" id="nomArticulo" size="80" value="<?php
		  if($_POST['nomArticulo']){
		  echo $_POST['nomArticulo'];
		  }
		  ?>"/>
        </span></div>
        <span class="style12">
        </select></span></th>
    </tr>
    <tr>
      <th height="41" bgcolor="#FFCCFF" scope="col">&nbsp;</th>
      <th bgcolor="#FFCCFF" scope="col">&nbsp;</th>
      <th bgcolor="#FFCCFF" scope="col"><div align="left">
        <input name="buscar" type="submit" class="style12" id="buscar" value="buscar" />
        <?php if($_POST['nomArticulo']==='*'){ ?>
        <span class="style18">Este proceso puede demorar varios minutos...</span>
        <?php } ?>
      </div>        <label>      </label></th>
    </tr>
  </table>
</form>
<p align="center" class="style14">&nbsp;</p>
      <?php	
if(($_POST['nomArticulo2'] AND $_POST['buscar']) or $_POST['borrar']){	  
$articulo = $_POST['nomArticulo'];

	  
if($articulo==="*"){ 
$sSQL= "
SELECT * FROM articulos

 WHERE 
 entidad='".$entidad."' AND
 um='s'
 and
 codigo is not null
 order by descripcion ASC";


} else {
 
 $sSQL= "
SELECT * FROM articulos

 WHERE 
 entidad='".$entidad."' AND
 descripcion LIKE '%$articulo%' 
 and um='s'
  and
 codigo is not null
 order by descripcion ASC";

 }


if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
<form id="form1" name="form1" method="post" action="#">
  <p>&nbsp;</p>
  <table width="597" border="0" align="center">
    <tr>
      <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="270" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="73" bgcolor="#660066" scope="col"><span class="style11">Particular</span></th>
      <th width="91" bgcolor="#660066" scope="col"><span class="style11">Aseguradora</span></th>
      <th width="30" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
    </tr>
    <tr>

<?php
while($myrow = mysql_fetch_array($result)){
$code = $myrow['codigo'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);
  $sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE
codigo = '".$code."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 
$C=$myrow['codigo'];
 $sSQL7="SELECT *
FROM
  `clientesPrecios`
WHERE
codigo = '".$code."' and numCliente='".$_POST['seguro']."'  
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  if($myrow6['nivel1'] and $myrow6['nivel3']){
  $color='#0000FF';
  $estilo="style11";
  } else {
  $myrow6['nivel1']="Falta Precio";
  $myrow6['nivel3']="Falta Precio";
  $estilo="style12";
  }
  
  if($myrow6['nivel1']=="1" or $myrow6['nivel3']=="1"){
  $color='#FF0000';
  $estilo="style11";
  }
$totalRegistros+="1";
?>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style12">
       
      <?php echo $C?>
   
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="<?php echo $estilo;?>"><?php echo $myrow['descripcion']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="<?php echo $estilo;?>"><?php 
	  if($myrow6['nivel1']>"1"){
	  echo "$".number_format($myrow6['nivel1'],2); 
	  } else {
	  echo "No puede ser 1";
	  }
	  
	  ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="<?php echo $estilo;?>"><?php 
	  if($myrow6['nivel3']>"1"){
	  echo "$".number_format($myrow6['nivel3'],2); 
	  } else {
	  echo "No puede ser 1";
	  }
	  
	  ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label>
        <input name="quitar[]" type="checkbox" id="quitar[]" value="<?php echo $C; ?>" />
      </label></td>
    </tr>
    <?php }}}?>
  </table>
  <p align="center">
    <label>
    <?php if($totalRegistros){ ?>
    <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar" />
    </label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
	<input name="nomArticulo" type="hidden" id="bandera" value="<?php echo $_POST['nomArticulo']; ?>" />
    <?php } ?>
  </p>
</form>
<?php if($totalRegistros){ ?>
<p align="center"><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>