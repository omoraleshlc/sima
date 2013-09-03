<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php $articulo = $_POST['nomArticulo']; ?>
          <?php
//***********************CAMBIAR ALMACEN****************************
if($_POST['almacen']){
$sSQL17= "Select * From sesionesAlmacen WHERE usuario = '".$usuario."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$ali=$myrow17['almacen'];
if(!$myrow17['usuario']){

$agrega = "INSERT INTO sesionesAlmacen ( usuario,almacen
) values (
'".$usuario."',
'".$_POST['almacen']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

} else {

$q1 = "UPDATE sesionesAlmacen set 
almacen='".$_POST['almacen']."'
WHERE usuario = '".$usuario."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
//paciente_actualizado();
}
}
//**********************CIERRO CAMBIAR ALMACEN******************************

?>
<?php
$hoy = date("d/m/Y");
$hora = date("g:i a");

if($_POST['almacen1']){
$alm = $_POST['almacen1'];
$alma = $_POST['almacen1'];
} else if($_POST['almacen2']) {
$alm = $_POST['almacen2'];
$alma = $_POST['almacen2'];
}
if($_POST['anaquel']){
$ana = $_POST['anaquel'];
} else if($_POST['anaquel1']) {
$ana = $_POST['anaquel1'];
}

if($_POST['nomArticulo']){
$nombredeArticulo = $_POST['nomArticulo'];
} else if($_POST['nomArticulo1']) {
$nombredeArticulo = $_POST['nomArticulo1'];
}
if($_POST['actualizar']){
$sSQL1= "Select * From existencias WHERE codigo = '".$_POST['codigo1']."' AND almacen = '".$_POST['almacen']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
//$almacenes = $myrow1['almacen'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){
$existencias = $_POST['existencias'];

if($coder= $_POST['codigoAlfa'] AND $almacen=$_POST['almacen']){

 $q = "UPDATE existencias set 
almacen='".$almacen[$i-1]."', 
fechaA='".$hoy."', 
hora='".$hora."', 
existencia='".$existencias[$i-1]."'
WHERE 
codigo='".$coder[$i-1]."'
AND 
almacen = '".$almacen[$i-1]."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
}}
}
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
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.style13 {
	color: #0000FF;
	font-weight: bold;
}
.Estilo24 {font-size: 10px}
-->
</style>
</head>
<body>
<p align="center">Asignar anaquel a art&iacute;culo </p>
<form id="form3" name="form3" method="post" action="">
  <table width="420" border="1" align="center">
    <tr>
      <th width="29" scope="col">&nbsp;</th>
      <th width="174" scope="col">DEPARTAMENTO:</th>
      <th width="195" scope="col"><div align="left"><span class="Estilo24">
          <?php
		  
		  	$sqlNombre16= "SELECT * From sesionesAlmacen
			WHERE 
			usuario = '".$usuario."'
			ORDER BY almacen ASC";
$resultaNombre16=mysql_db_query($basedatos,$sqlNombre16);
$rNombre16=mysql_fetch_array($resultaNombre16);
$ali = $rNombre16['almacen'];
$sqlNombre17= "SELECT * From almacenes
			WHERE 
			almacen = '".$ali."' and (ventas='Si' or ventas='si') 
			and
			activo='A'
			ORDER BY almacen ASC";
$resultaNombre17=mysql_db_query($basedatos,$sqlNombre17);
$rNombre17=mysql_fetch_array($resultaNombre17);

?>
          <select name="almacen" class="Estilo24" id="almacen"  onchange="javascript:this.form.submit();" />          
 
          <option value="<?php echo $ali;?>"><?php echo $rNombre17['descripcion'];?></option>
          <option value="">---</option>
          <?php
		     $sqlNombre1= "SELECT almacen From usuariosAlmacenes 
			WHERE 
			usuario = '".$usuario."' 
			ORDER BY almacen ASC";
			$resultaNombre1=mysql_db_query($basedatos,$sqlNombre1);
            while ($rNombre1=mysql_fetch_array($resultaNombre1)){ 
			$ali18 = $rNombre1['almacen'];
   			$sqlNombre18= "SELECT * From almacenes
			WHERE 
			almacen = '".$ali18."' and ventas='Si' 
			ORDER BY almacen ASC";
$resultaNombre18=mysql_db_query($basedatos,$sqlNombre18);
$rNombre18=mysql_fetch_array($resultaNombre18); 

  ?>
          <?php if($rNombre18['descripcion']){ ?>
          <option value="<?php echo $rNombre1['almacen'];?>"><?php echo $rNombre18['descripcion'];?></option>
          <?php } ?>
          <?php } ?>
          </select>
          </span>
              <label></label>
      </div></th>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="523" border="1" align="center">
    <tr>
      <th width="28" scope="col"><input name="escoje" type="radio" value="porarticulo" checked="checked" /></th>
      <th width="182" scope="col"><div align="center"><span class="style12">Escribe el nombre del art&iacute;culo </span></div></th>
      <th width="291" scope="col"><div align="left"><span class="style12">
          <input name="nomArticulo" type="text" class="style12" id="nomArticulo" value="<?php echo $nombredeArticulo; ?>" size="60" />
      </span></div></th>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col"><label>
        <div align="left">
          <input name="buscar" type="submit" class="style12" id="buscar" value="buscar" />
        </div>
      </label></th>
    </tr>
  </table>
</form>
   <label>&nbsp;</label>
   <?php	
	  $articulo = $_POST['nomArticulo'];
if($_POST['buscar'] AND $_POST['nomArticulo']){
if($_POST['escoje'] =="porarticulo" ){
 
$sSQL= "
SELECT * FROM articulos,existencias

 WHERE articulos.descripcion LIKE '%$articulo%' 
and
(articulos.um<>'s' or articulos.um<>'S')
and
articulos.codigo=existencias.codigo
and
existencias.almacen ='".$ali."'
 order by articulos.descripcion ASC";

 } else if($_POST['escoje'] =="porcodigo"){
 $sSQL= "SELECT 
*
FROM
  `articulos`
  INNER JOIN `existencias` ON (`articulos`.`codigo` = `existencias`.`codigo`)

WHERE articulos.codigo = '".$_POST['porcodigo']."' ";
}
if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
   <form id="form2" name="form2" method="post" action="articulos-anaquel2.php">
     <table width="572" border="1" align="center">
       <tr>
         <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
         <th width="398" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
         <th width="53" bgcolor="#660066" scope="col"><span class="style11">Costo</span></th>
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
  if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['codigo'];
?>
         <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
           <label>
           <input name="codigo" type="submit" class="style12" value="<?php echo $C?>" readonly=""/>
           </label>
         </span></td>
         <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descripcion']; ?>
           <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen1']; ?>" />
           <input name="cod" type="hidden" id="cod" />
         </span></td>
         <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
           <?php 
	  if($myrow5['costo']){
	  echo number_format($myrow5['costo'],"2");
	  } else {
	  echo "N/A";
	  }
	  ?>
         </span></td>
       </tr>
       <?php }}}?>
     </table>
</form>
<p>&nbsp;</p>
</body>
</html>