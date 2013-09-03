<?php require("/configuracion/ventanasEmergentes.php");?>

<?php


if($_POST['agrega'] AND $_GET['numCliente'] and $_POST['clientePrincipal']){
$agregar=$_POST['agregar'];

for($i=0;$i<=$_POST['bandera'];$i++){



if($agregar[$i]){ 
 $sSQL1= "Select * From clientesGrupos where gpoProducto='".$agregar[$i]."'
and seguro='".$_GET['numCliente']."'  and clientePrincipal='".$_POST['clientePrincipal']."'
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['gpoProducto']){
$agrega = "INSERT INTO clientesGrupos (
seguro,gpoProducto,entidad,clientePrincipal
) values ('".$_GET['numCliente']."','".$agregar[$i]."','".$entidad."','".$_POST['clientePrincipal']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}
}


$leyenda='Se Agregaron Registros';
}











if($_POST['borrar'] AND $_GET['numCliente']){
$quitar=$_POST['quitar'];

for($i=0;$i<=$_POST['bandera'];$i++){

if($quitar[$i] and $_GET['numCliente']){
 $borrame = "DELETE FROM clientesGrupos WHERE gpoProducto ='".$quitar[$i]."' and seguro='".$_GET['numCliente']."'  and clientePrincipal='".$_POST['clientePrincipal']."'";
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
<form id="form1" name="form1" method="post" >

   <p align="center">&nbsp;   </p>
   <p align="center">Esta Aseguradora factura a esta empresa, con estos grupos </p>
   <p align="center"><span >
     <?php 
 $sqlNombre11 = "SELECT * from clientes 
 where

subCliente='' and clientePrincipal=''
ORDER BY nomCliente ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);

$sSQL24= "Select * From clientesGrupos where seguro='".$_GET['numCliente']."'  ";
$result24=mysql_db_query($basedatos,$sSQL24);
$myrow24 = mysql_fetch_array($result24);
?>
     <select name="clientePrincipal"  id="clientePrincipal" onChange="this.form.submit();" />     

     <option value="">Escoje el Cliente (Si es subCliente)</option>
     <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
     <option
    <?php   if($myrow24['seguro']==$rNombre11["numCliente"] or $_POST['clientePrincipal']==$rNombre11["numCliente"] )echo 'selected'; ?>
   value="<?php echo $rNombre11["numCliente"];?>"> <?php echo $rNombre11["nomCliente"];?></option>
     <?php } ?>
     </select>
   </span></p>
  
  
  
  <?php if($_POST['clientePrincipal']){ ?>
  <br />

   <table width="398" class="table table-striped">
     <tr>
       <th width="51" height="15"  scope="col"><div align="left"><span >C&oacute;digo </span></div></th>
       <th width="272"  scope="col"><div align="left"><span >Grupo</span></div></th>
       <th width="39"   scope="col"><div align="left"></div></th>
       <th width="36"  scope="col">&nbsp;</th>
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

$sSQL1= "Select * From clientesGrupos where
gpoProducto='".$myrow['codigoGP']."' and seguro='".$_GET['numCliente']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1); 
$B=$myrow1['keyCAG'];
?>
       <td bgcolor="<?php echo $color?>" ><span > <?php echo $myrow['codigoGP']?> </span></td>
       <td bgcolor="<?php echo $color?>" ><span ><?php echo $myrow['descripcionGP']?></span></td>
       <td bgcolor="<?php echo $color;?>" ><label>
         <input type="checkbox" name="agregar[]" value="<?php echo $myrow['codigoGP']?>"
	   <?php 
	   if($myrow1['gpoProducto']){
	   echo 'disabled';
	   }
	   ?> />
       </label></td>
       <td bgcolor="<?php echo $color?>" >
	     <label></label>
       </a>
       <label>
       <input type="checkbox" name="quitar[]" value="<?php echo $myrow['codigoGP']?>" 
	   <?php 
	   if(!$myrow1['gpoProducto']){
	   echo 'disabled';
	   }
	   ?>
	    />
       </label></td>
     </tr>
     <?php }}?>
   </table>
   
<p align="center">
  <input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>" />
     <input name="bandera" type="hidden" id="bandera" value="<?php echo $a;?>" />
	 
     <label>
     <input name="agrega" type="submit"  id="agrega" value="Agregar" />
     </label>
     <label>
     <input name="borrar" type="submit"  id="borrar" value="Quitar" />
     </label>
  </p>
  <?php } ?>
  
  
</form>
</body>
</html>
