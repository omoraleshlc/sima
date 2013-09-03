<?php require("/configuracion/ventanasEmergentes.php");?>

<?php


if($_POST['agrega']!=NULL AND $_GET['almacen']!=NULL and $_POST['klista']!=NULL){ 
$klista=$_POST['klista'];

for($i=0;$i<=$_POST['bandera'];$i++){





if($klista[$i]){ 
    $sSQL= "Select * From catalogoexpedientes
where
klista='".$klista[$i]."'";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result);
  $sSQL1= "Select * From ccostoExpedientes where entidad='".$entidad."'
and almacen='".$_GET['almacen']."' 
    and
    klista='".$klista[$i]."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['klista']){
$sSQL455= "Select * from almacenes where entidad='".$entidad."' and almacen='".$_GET['almacen']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$agrega = "INSERT INTO ccostoExpedientes (
klista,descripcion,almacen,descripcionAlmacen,entidad
) values ('".$klista[$i]."','".$myrow['descripcion']."','".$_GET['almacen']."','".$myrow455['descripcion']."','".$entidad."'  )";
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
 $borrame = "DELETE FROM ccostoExpedientes WHERE entidad='".$entidad."' and klista='".$quitar[$i]."' and almacen='".$_GET['almacen']."'";
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
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 14px}
.style11 {font-size: 14px; font-weight: bold; }
.style12 {font-size: 14px}
.style15 {color: #FFCCFF}
.Estilo24 {font-size: 14px}
.style71 {font-size: 14px}
.style71 {font-size: 14px}
.style71 {font-size: 14px}
-->
</style>
</head>

<body>
<form  name="form1" method="post"  >

   <p align="center">  Relacionar lista de expedientes con almacenes</p>
   <div align="center">

   </div>
   <img src="../../imagenes/bordestablas/borde1.png" alt="bo1" width="258" height="21" />
   <table width="258" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <th width="51" height="15" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style11">#</span></div></th>
       <th width="272" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style11">Catalogo</span></div></th>
       <th width="39" bgcolor="#FFFF00" class="none" scope="col"><div align="left"></div></th>
       <th width="36" bgcolor="#FFFF00" scope="col">&nbsp;</th>
     </tr>
     <tr>
       <?php   

$sSQL= "Select * From catalogoexpedientes


order by descripcion ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$A=$myrow['keyC'];

$sSQL1= "Select * From ccostoExpedientes where
entidad='".$entidad."' and klista='".$myrow['klista']."' and almacen='".$_GET['almacen']."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1); 
$B=$myrow1['keyCAG'];
?>
         
  
       <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71"> <?php echo $myrow['klista']?> </span></td>
       <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71"><?php echo $myrow['descripcion']?></span></td>
       
       <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
         <input type="checkbox" name="klista[]" value="<?php echo $myrow['klista']?>"
                   <?php 
	   if($myrow1['klista']){
	   echo 'disabled';
	   }
	   ?>
	   />
       </label></td>
       
       
       <td bgcolor="<?php echo $color?>" class="Estilo24">
	     <label></label>
       </a>
       <label>
       <input type="checkbox" name="quitar[]" value="<?php echo $myrow['klista']?>" 
	   <?php 
	   if(!$myrow1['klista']){
	   echo 'disabled';
	   }
	   ?>
	    />
       </label></td>
       
       
     </tr>
     <?php }}?>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" alt="bo2" width="258" height="21" />
<p align="center">
<input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>" />
     <input name="bandera" type="hidden" id="bandera" value="<?php echo $a;?>" />
	 
     <label>
     <input name="agrega" type="submit" class="Estilo24" id="agrega" value="Agregar" />
     </label>
     <label>
     <input name="borrar" type="submit" class="Estilo24" id="borrar" value="Quitar" />
     </label>
 </p>
</form>
</body>
</html>
