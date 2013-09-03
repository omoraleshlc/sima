<?php require("/configuracion/ventanasEmergentes.php");?>

<?php


if($_POST['agrega'] AND $_GET['almacen']){
$agregar=$_POST['agregar'];

for($i=0;$i<=$_POST['bandera'];$i++){





if($agregar[$i]){ 
 $sSQL1= "Select * From camposGrupos where gpoProducto='".$agregar[$i]."'
and id_almacen='".$_GET['almacen']."' 
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['gpoProducto']){
$sSQL455= "Select almacenPadre from almacenes where entidad='".$entidad."' and almacen='".$_GET['almacen']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$agrega = "INSERT INTO camposGrupos (
id_almacen,gpoProducto,entidad,almacenPrincipal
) values ('".$_GET['almacen']."','".$agregar[$i]."','".$entidad."','".$myrow455['almacenPadre']."'  )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}
}


$leyenda='Se Agregaron Registros';
}



if($_POST['borrar'] AND $_GET['almacen']){
$quitar=$_POST['quitar'];

for($i=0;$i<=$_POST['bandera'];$i++){

if($quitar[$i] and $_GET['almacen']){
 $borrame = "DELETE FROM camposGrupos WHERE gpoProducto ='".$quitar[$i]."' and id_almacen='".$_GET['almacen']."'";
mysql_db_query($basedatos,$borrame);

echo mysql_error();
}
$leyenda='Se eliminaron registros';
}
}
?>










<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>
<form id="form1" name="form1" method="post" action="" >

   <p align="center">Políticas de Precios por Rango</p>
   <div align="center">

   </div>
   <img src="../imagenes/bordestablas/borde1.png" width="258" height="24" />
   <table width="258" border="0" align="center" cellpadding="4" cellspacing="0">
     <tr>
       <th width="51" height="15" bgcolor="#FFFF00" scope="col"><div align="left"><span class="normal">Codigo </span></div></th>
       <th width="272" bgcolor="#FFFF00" scope="col"><div align="left"><span class="normal">Grupo</span></div></th>
       <th width="39" bgcolor="#FFFF00" class="normal" scope="col"><div align="left"></div></th>
       <th width="36" bgcolor="#FFFF00" scope="col">&nbsp;</th>
     </tr>
     <tr>
       <?php   

$sSQL= "Select * From gpoProductos


order by descripcionGP ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$a+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$A=$myrow['keyC'];

$sSQL1= "Select * From camposGrupos where
gpoProducto='".$myrow['codigoGP']."' and id_almacen='".$_GET['almacen']."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1); 
$B=$myrow1['keyCAG'];
?>
       <td bgcolor="<?php echo $color?>" class="normal"><span class="normal"> <?php echo $myrow['codigoGP']?> </span></td>
       <td bgcolor="<?php echo $color?>" class="normal"><span class="normal"><?php echo $myrow['descripcionGP']?></span></td>
       <td bgcolor="<?php echo $color;?>" class="normal"><label>
         <input type="checkbox" name="agregar[]" value="<?php echo $myrow['codigoGP']?>"
	   <?php 
	   if($myrow1['id_almacen']){
	   echo 'disabled';
	   }
	   ?> />
       </label></td>
       <td bgcolor="<?php echo $color?>" class="normal">
	     <label></label>
       </a>
       <label>
       <input type="checkbox" class="normal" name="quitar[]" value="<?php echo $myrow['codigoGP']?>" 
	   <?php 
	   if(!$myrow1['id_almacen']){
	   echo 'disabled';
	   }
	   ?>
	    />
       </label></td>
     </tr>
     <?php }}?>
   </table>
   <img src="../imagenes/bordestablas/borde2.png" width="258" height="24" />
   <p align="center">&nbsp;</p>
<table width="200" border="0" align="center">
  <tr>
    <td><input name="agrega" type="submit" class="normal" id="agrega" value="Agregar" /></td>
    <td><input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>" />
      <input name="bandera" type="hidden" id="bandera" value="<?php echo $a;?>" /></td>
    <td><input name="borrar" type="submit" class="normal" id="borrar" value="Quitar" /></td>
  </tr>
</table>
</form>
</body>
</html>
