<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<? 
if($_POST['escoje'] =="poranaquel")
$_POST['nomArticulo'] ="1";

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
-->
</style>
</head>

<body>
<p><span class="style12">
  <label></label>
</span></p>
<p align="center"><span class="style12"></span><span class="style12">CONSULTAS</span></p>
<form id="form2" name="form2" method="post" action="">
  <label> </label>
  <table width="744" border="1" align="center">
    <tr>
      <th width="32" scope="col"><div align="center">
        <label>
        <input name="escoje" type="radio" value="porarticulo" checked="checked"  />
        </label>
      </div></th>
      <th width="193" scope="col"><div align="center"><span class="style12">Escribe el nombre del art&iacute;culo </span></div></th>
      <th scope="col"><div align="left"><span class="style12">
        <input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="60" />
      </span></div></th>
    </tr>
    <tr>
      <th scope="col"><label>
      <input name="escoje" type="radio" value="porcodigo" />
      </label></th>
      <th scope="col"><span class="style12">Escribe el c&oacute;digo </span></th>
      <th scope="col"><label>
        <div align="left">
          <input name="porcodigo" type="text" class="style12" id="porcodigo" />        
        </div>
      </label></th>
    </tr>
	
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col"><span class="style12">
        <input name="buscar" type="submit" class="style7" id="buscar" value="Buscar" />
      </span></th>
    </tr>
  </table>
</form>
<p align="center">
  <input name="articulo1" type="hidden" id="articulo1" value="<? echo $_POST['nomArticulo']; ?>" />
  <?   $articulo = $_POST['nomArticulo'];
if($_POST['buscar']){
if($_POST['escoje'] =="porarticulo" ){
if($_POST['almacen'] AND $_POST['nomArticulo']){

$sSQL= "Select all distinct * From articulos WHERE descripcion LIKE '%$articulo%' 
AND estacion = '".$_POST['estacion']."' order by descripcion ASC";
} else {

$sSQL= "Select all distinct * From articulos WHERE descripcion LIKE '%$articulo%' order by descripcion ASC";

} if($_POST['almacen'] AND !$_POST['nomArticulo']){
 $sSQL= "SELECT 
  `articulos`.`codigo`,
  `articulos`.`descripcion`,
  `articulos`.`um`,
  `articulos`.`estacion`,
  `articulos`.`cbarra`,
  `articulos`.`categoria`,
  `articulos`.`activo`,
  `articulos`.`tipoE`,
  `estacionAlmacen`.`numEstacion`,
  `estacionAlmacen`.`nomAlmacen`,
  `estacionAlmacen`.`codEstacion`,
  `estacionAlmacen`.`almacen`,
  `existencias`.`codigo` AS `codigo1`,
  `existencias`.`almacen` AS `almacen1`,
  `existencias`.`anaquel`,
  `existencias`.`fechaA`,
  `existencias`.`activo` AS `activo1`,
  `existencias`.`existencia`,
  `precioArticulos`.`codigo` AS `codigo2`,
  `precioArticulos`.`costo`,
  `precioArticulos`.`pmax`,
  `precioArticulos`.`reorden`,
  `precioArticulos`.`pmin`,
  `precioArticulos`.`precio`,
  `precioArticulos`.`iva`,
  `precioArticulos`.`Valida`
FROM
  `articulos`
  INNER JOIN `estacionAlmacen` ON (`articulos`.`estacion` = `estacionAlmacen`.`codEstacion`)
  INNER JOIN `existencias` ON (`estacionAlmacen`.`almacen` = `existencias`.`almacen`)
 
WHERE
`estacionAlmacen`.`codEstacion` = '".$_POST['almacen']."' ";
}
$result=mysql_db_query($basedatos,$sSQL);
} else if($_POST['escoje'] =="porcodigo"){
$sSQL= "Select all distinct * From articulos WHERE codigo = '".$_POST['porcodigo']."' order by descripcion ASC";
$result=mysql_db_query($basedatos,$sSQL);
$sSQL2= "Select all distinct existencias From existencias WHERE codigo = '".$_POST['porcodigo']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
} else if($_POST['escoje'] =="poranaquel"){
$sSQL= "SELECT 
  `articulos`.`codigo`,
  `articulos`.`descripcion`,
  `articulos`.`um`,
  `articulos`.`costo`,
  `articulos`.`pmax`,
  `articulos`.`reorden`,
  `articulos`.`pmin`,
  `articulos`.`precio`,
  `articulos`.`iva`,
  `existencias`.`codigo` AS `codigo1`,
  `existencias`.`existencias`,
  `existencias`.`fechaAjuste`,
  `existencias`.`usuario`,
  `existencias`.`almacen`,
  `existencias`.`tipoAjuste`,
  `existencias`.`Anaquel`
FROM
  `existencias`
  INNER JOIN `articulos` ON (`existencias`.`codigo` = `articulos`.`codigo`)
 WHERE almacen = '".$_POST['estacion']."'
AND Anaquel = '".$_POST['anaquel']."'";
$result=mysql_db_query($basedatos,$sSQL);
}

?></p>
<form action="existencias.php" method="post" name="form4">
  <table width="756" border="1" align="center">
    <tr>
      <th width="154" bgcolor="#333333" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="411" bgcolor="#333333" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="19" bgcolor="#333333" scope="col"><span class="style11">UM</span></th>
      <th width="49" bgcolor="#333333" scope="col"><span class="style11">Existencias</span></th>
      <th width="89" bgcolor="#333333" scope="col"><span class="style11">Gpo. Producto</span></th>
    </tr>
    <tr>

<?	while($myrow = mysql_fetch_array($result)){
if($_POST['escoje'] =="porarticulo"){
$codigo7 = $myrow['codigo'];
$sSQL2= "Select all distinct existencia From existencias WHERE codigo = '".$codigo7."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$sSQL8= "Select all distinct * From precioArticulos WHERE codigo = '".$codigo7."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
}
?>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7">
        <label>
	        <input name="codigo" type="submit" class="style12" value="<? echo $myrow['codigo'];?>" />
        </label>
      </span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['descripcion'];?>
        <input name="almacen2" type="hidden" id="almacen2" value="<? echo $myrow['almacen']; ?>" />
      </span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['um'];?></span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7">
        <? 
	  if($myrow2['existencias']){
	  echo $myrow2['existencias'];
	  } else {
	  echo "0";
	  
	  }
	  ?>
      </span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7">
        <? 
	  if($myrow['gpoProducto']){
	  echo $myrow['gpoProducto'];
	 } else {
	 echo "N/A";
	 }
	  ?>
      </span></td>
    </tr>

  <? }}?>
  </table>
</form>
</body>
</html>
