<?php require("/configuracion/ventanasEmergentes.php");?>
   <?php if($_POST['almacen']){
   $al=$_POST['almacen'];
   } else {
   $al=$_GET['almacen'];
   }

   ?>
<?php


if($_POST['agrega'] AND $al){
$agregar=$_POST['agregar'];

for($i=0;$i<=$_POST['bandera'];$i++){


if(!$myrow1['codigo'] and $agregar[$i]!=NULL){


if($agregar[$i]){ 
$sSQL1= "Select keyC From camposAlmacenes where keyC='".$agregar[$i]."'
and id_almacen='".$al."' 
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['keyC']){
$agrega = "INSERT INTO camposAlmacenes (
id_almacen,keyC
) values ('".$al."','".$agregar[$i]."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}


}
}
$leyenda='Se Agregaron Registros';
}



if($_POST['borrar'] AND $al){
$quitar=$_POST['quitar'];

for($i=0;$i<=$_POST['bandera'];$i++){

if($quitar[$i] and $al){
 $borrame = "DELETE FROM camposAlmacenes WHERE keyCAL ='".$quitar[$i]."'";
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
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<form id="form1" name="form1" method="post" action="" >

   <p align="center">   Relacionar Campos con Almacenes </p>
   <div align="center">
<?php echo $leyenda.' del almacen:'.$al;?>
   </div>

   <table width="416" class="table table-striped">
     <tr>
       <th width="51" height="15"  scope="col"><div align="left"><span >C&oacute;digo </span></div></th>
       <th width="272"  scope="col"><div align="left"><span >Almac&eacute;n</span></div></th>
       <th width="39"   scope="col"><div align="left"></div></th>
       <th width="36"  scope="col">&nbsp;</th>
     </tr>
     <tr>
       <?php   

$sSQL= "Select * From campos


order by descripcionCampo ASC";

 
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

$keyAlmacenes=$myrow['keyAlmacenes'];
$A=$myrow['keyC'];

 $sSQL1= "Select keyCAL,id_almacen From camposAlmacenes where
keyC='".$myrow['keyC']."' and id_almacen='".$al."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1); 
$B=$myrow1['keyCAL'];
?>
       <td bgcolor="<?php echo $color?>" ><span > <?php echo $myrow['codigoCampo']?> </span></td>
       <td bgcolor="<?php echo $color?>" ><span ><?php echo $myrow['descripcionCampo']?></span></td>
       <td bgcolor="<?php echo $color;?>" ><label>
         <input type="checkbox" name="agregar[]" value="<?php echo $A;?>"
	   <?php 
	   if($myrow1['id_almacen']){
	   echo 'disabled';
	   }
	   ?> />
       </label></td>
       <td bgcolor="<?php echo $color?>" >
	     <label></label>
       </a>
       <label>
       <input type="checkbox" name="quitar[]" value="<?php echo $B;?>" 
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
 
   <table width="200" >
     <tr>
       <td><input name="agrega" type="submit"  id="agrega" value="Agregar" /></td>
       <td><input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>" />
         <input name="bandera" type="hidden" id="bandera" value="<?php echo $a;?>" /></td>
       <td><input name="borrar" type="submit"  id="borrar" value="Quitar" /></td>
     </tr>
   </table>
  
   
   
   
   
   
   
</form>
</body>
</html>
