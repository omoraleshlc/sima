<?php 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=preciosAlmacen.xls"); 
?> 


<?php //require("/configuracion/funciones.php"); 
$usuario="omorales";
$passwd='wolf3333';
$servidor='localhost';
$basedatos='sima';
mysql_connect($servidor,$usuario,$passwd); 		


//******************************************************************
//clases fuera
?>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style72 {color: #000000}
.style73 {font-weight: bold; font-size: 10px;}
-->
</style>
<p align="center">LISTADO DE PRECIO x ALMACEN </p>
<p>&nbsp;</p>
  <?php 	
//inicializo el criterio y recibo cualquier cadena que se desee buscar
$criterio = "";

$ALMACEN=$_GET['almacen'];
$entidad=$_GET['entidad'];
$gpoProducto=$_GET['gpoProducto'];







if ($_GET["criterio"]!="" and $_GET["criterio"]!='*'){
	$txt_criterio = $_GET["criterio"];
	$criterio = " where articulos.entidad='".$entidad."'
	AND
	existencias.almacen='".$ALMACEN."'
	AND
	articulos.codigo=existencias.codigo
	AND
	articulos.gpoProducto='".$gpoProducto."' 
	AND
	(articulos.descripcion like '%" . $txt_criterio . "%' or articulos.descripcion1 like '%" . $txt_criterio . "%') order by articulos.descripcion ASC";
} else if($_GET["criterio"]=='*'){
$criterio = "order by articulos.descripcion ASC";
}



if($_GET['criterio']){
$ssql = "select *,articulos.activo as active from articulos,existencias " . $criterio;
} else {
$ssql = "select *,articulos.activo as active from articulos,existencias where 

	existencias.almacen='".$ALMACEN."'
	AND
	articulos.codigo=existencias.codigo
	AND
articulos.entidad='".$entidad."' and articulos.gpoProducto='".$gpoProducto."' order by articulos.descripcion ASC";
}

$result = mysql_db_query($basedatos,$ssql);
$num_total_registros = mysql_num_rows($result);

//Limito la busqueda
if($_GET['registros']==NULL){
$TAMANO_PAGINA = 30;
} else {
$TAMANO_PAGINA=$_GET['registros'];
}
//examino la página a mostrar y el inicio del registro a mostrar
$pagina = $_GET["pagina"];
if (!$pagina) {
		$inicio = 0;
		$pagina=1;
}
else {
	$inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

//miro a ver el número total de campos que hay en la tabla con esa búsqueda

//calculo el total de páginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);




if($_GET['criterio'] ){
$ssql = "select *,articulos.activo as active from articulos,existencias " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
} else {
$ssql = "select *,articulos.activo as active from articulos,existencias 
where
articulos.entidad='".$entidad."'
and
articulos.codigo=existencias.codigo
and
existencias.almacen='".$ALMACEN."'
and
articulos.gpoProducto='".$gpoProducto."'";
}


if($_GET['referido']=='si'){
$ssql = "select *,articulos.activo as active from articulos,existencias 
where
articulos.entidad='".$entidad."'
and
articulos.codigo=existencias.codigo
and
existencias.almacen='".$ALMACEN."'
and
articulos.gpoProducto='".$gpoProducto."'
and
referido='si'
";
}


$result = mysql_db_query($basedatos,$ssql);
if($num_total_registros ){

?>
<table width="715" border="0" align="center">
  <tr>
    <th width="114" class="Estilo24" scope="col"><div align="left" class="style72"><span class="style73">C&oacute;digo</span></div></th>
    <th width="459" class="Estilo24" scope="col"><div align="left" class="style72"><span class="style73">Descripci&oacute;n</span></div></th>
    <th width="59" class="Estilo24" scope="col"><div align="left" class="style72"><span class="style73">Particular</span></div></th>
    <th width="65" class="Estilo24" scope="col"><div align="left" class="style72"><span class="style73">Aseguradora</span></div></th>
  </tr>
  <tr>
    <?php
while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;

$codigo=$code = $myrow['codigo'];
$sSQL52="SELECT count(*) as totalRegedit
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
  
$i=$myrow52['totalRegedit'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

$sSQL51="SELECT *
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result51=mysql_db_query($basedatos,$sSQL51);
  $myrow51 = mysql_fetch_array($result51);
$bali=$myrow51['almacen'];

  
  $sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE entidad='".$entidad."' AND
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
articulosPrecioNivel
WHERE entidad='".$entidad."' AND
codigo = '".$code."' 
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  
$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);



?>
    <td bgcolor="<?php echo $color;?>" height="24" class="style71"><span class="">
      <label><?php echo $myrow39['prefijo'].$C?></label>
      <input name="keyPA[]" type="hidden" id="codigo" value="<?php echo $myrow['keyPA'];?>" />
    </span></td>
    <td bgcolor="<?php echo $color;?>" class="style71"><span class=""><?php echo $myrow['descripcion']; ?>
          <?php 
	  if(!$bali){
	   echo '<img src="/sima/imagenes/stop.png" alt="NO TIENE ASIGNADO NINGUN PRECIO O ALMACEN" width="13" height="13" border="0" />';
	   }
	  ?>
          <?php if($myrow['generico']=='si'){?>
          <blink> <img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" /> </blink>
          <?php } else { echo '';}?>
    </span></td>
    <td bgcolor="<?php echo $color;?>" class="style71" >
	<div align="left"><span class=""> </span>
	
	<?php echo "$".number_format($myrow6['nivel1'],2); ?>
	</div></td>
    <td bgcolor="<?php echo $color;?>" class="style71" >
	<div align="left"><span class="">  </span>
	<?php echo "$".number_format($myrow6['nivel3'],2); ?>
	</div></td>
  </tr>
  <?php }}//cierra while?>
</table>
<p>&nbsp;</p>










