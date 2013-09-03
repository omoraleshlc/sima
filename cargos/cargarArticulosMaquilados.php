<?PHP include("/configuracion/ventanasEmergentes.php"); ?>

<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<?php 



if($_POST['surtir'] and $_POST['cantidadSurtida']){
$cantidadSurtida=$_POST['cantidadSurtida'];
$keyPA=$_POST['keyPA'];
$almacenSolicitante=$_POST['almacenSolicitante'];
$cantidadVendida=$_POST['cantidadVendida'];
$keyR=$_POST['keyR'];



for($i=0;$i<=$_POST['bandera'];$i++){



if($keyPA[$i] and $cantidadSurtida[$i]>0){
//*****************PUEDO TRANSFERIR A ESTE ALMACEN, TENGO PARA TRANSFERIRLE?******************
$sSQL52="SELECT existencia
FROM
existencias
WHERE 
entidad='".$entidad."'
and
keyPA = '".$keyPA[$i]."' and almacen='".$_GET['almacenSolicitante']."' ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
//**************************************************************************************************
$cantidadEnStock=$myrow52['existencia'];
//**************************************************



if($cantidadEnStock>$cantidadSurtida[$i]){



$sSQL52a="SELECT existencia
FROM
existencias
WHERE 
entidad='".$entidad."'
and
keyPA = '".$keyPA[$i]."' and almacen='".$_GET['almacenSolicitante']."' ";
  $result52a=mysql_db_query($basedatos,$sSQL52);
  $myrow52a = mysql_fetch_array($result52a);


 $q2 = "UPDATE existencias set 
fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia-'".$cantidadSurtida[$i]."'

WHERE 
entidad='".$entidad."' AND
keyPA='".$keyPA[$i]."' 
AND 
almacen = '".$_GET['almacenSolicitante']."'  ";

mysql_db_query($basedatos,$q2);
echo mysql_error();
//***************************************
  
  
  
$q = "UPDATE articulosMaquilados set 
status='cargado'
WHERE 

keyR='".$_GET['keyR']."' 
and
keyPACOM=0
";

mysql_db_query($basedatos,$q);
echo mysql_error();
  



 $q = "UPDATE existencias set 

fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia+'".$cantidadSurtida[$i]."'

WHERE 
entidad='".$entidad."' AND
keyPA='".$keyPA[$i]."' 
AND 
almacen = '".$_GET['almacenSolicitante']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();



$q1 = "DELETE FROM faltantes 
WHERE 
entidad='".$entidad."'
and
keyPA='".$keyPA[$i]."'
and
almacenSolicitante='".$_GET['almacenSolicitante']."'
and
status='request'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$status='exito';
}else{ 
$info='Intenta cargar una cantidad menor...';
$status='fallo';
$q1 = "UPDATE faltantes 
set
informacion='".$info."'
WHERE 
entidad='".$entidad."'
and
keyPA='".$keyPA[$i]."'
and
almacenSolicitante='".$_GET['almacenSolicitante']."'
and
status='request'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}







}
?>

<script>
//window.opener.document.forms["form1"].submit();
//window.close();
</script>

<?php 
}

//*****************************************************************




//*****************************************************************


//cierra validacion
?>


<?php if($status=='fallo'){ ?>
<script>
window.alert("EL ARTICULO <?php echo   $articulo;?> NO TIENE SUFICIENTES EXISTENCIAS PARA TRANSFERIRSE...");
</script>
<?php }else{ ?>
<script>
window.alert("Se surtieron articulos");
</script>
<?php } ?>


<?php 
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>



 <?php require("/configuracion/componentes/comboAlmacen.php"); include("/configuracion/funciones.php"); ?>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center">Surtir articulos </h1>
  <p align="center"><?php echo $_GET['descripcionArticulo'];?></p>
  <table width="517" border="0.2" align="center">
        <tr bgcolor="#FFFF00">
      <th width="53" class="negromid">keyPA</th>
      <th width="265" class="negromid" >Descripcion</th>
      <th  class="negromid">Disponible</th>

      <th  class="negromid">Cargar</th>
    </tr>
    <tr>


	<?php	


 $sSQL= "SELECT * 
FROM

articulosMaquilados
where
entidad='".$entidad."'
and
keyPACOM='".$_GET['keyPA']."'
and
status='request'
";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;






$sSQL1= "SELECT descripcion,gpoProducto
FROM

articulos
where
keyPA='".$myrow['keyPA']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "SELECT descripcionGP
FROM

gpoProductos
where
entidad='".$entidad."'
and
codigoGP='".$myrow1['gpoProducto']."'  ";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);




$sSQL2= "SELECT sum(cantidad) as s
FROM

faltantes
where
entidad='".$entidad."'
and
almacenSolicitante='".$_POST['almacenDestino']."'
and
status='request' 
and
codigo='".$myrow['codigo']."'  ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


$sSQL52a="SELECT almacen
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
centroDistribucion='si' ";
  $result52a=mysql_db_query($basedatos,$sSQL52a);
  $myrow52a = mysql_fetch_array($result52a);
  
 $sSQL52aa="SELECT existencia
FROM
existencias
WHERE 
entidad='".$entidad."'
and
almacen='".$_GET['almacenSolicitante']."' 
and
keyPA='".$myrow['keyPA']."'
";
  $result52aa=mysql_db_query($basedatos,$sSQL52aa);
  $myrow52aa = mysql_fetch_array($result52aa);
?>
	  
	  

	  
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
	        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['keyPA'];?>
            <input name="keyR[]" type="hidden" value="<?php echo $myrow['keyR'];?>" /></td>
<td height="24" bgcolor="<?php echo $color?>" class="normal">
<?php 
if($myrow['descripcion']){
echo $myrow['descripcion'];
}else{
echo $myrow1['descripcion'];
}

echo '<br>';
echo '<span class="negro">'.'[ '.$myrow1a['descripcionGP'].' ]'.'</span>';


if($myrow['informacion']){
echo '<br>';
echo '<span class="codigos"><blink>'. $myrow['informacion'].'</blink></span>';
}
?>

</td>
	  <td width="59" bgcolor="<?php echo $color?>" class="normal">
	    <?php 
	  
echo   $myrow52aa['existencia'];

	  ?>
	  </td>
	  <input name="almacenSolicitante[]" type="hidden" value="<?php echo $myrow['almacenSolicitante'];?>" />
	   <input name="cantidadVendida[]" type="hidden" value="<?php echo $myrow['c'];?>" />
	  	  <input name="keyPA[]" type="hidden" value="<?php echo $myrow['keyPA'];?>" />

      <td width="59" bgcolor="<?php echo $color?>" class="normal">
	  
	  
	 <a   href="javascript:ventanaSecundaria8('resurtirInventarios.php?nOrden=<?php echo $myrow['nOrden']; ?>')"></a>
	 <label>
	 <input name="cantidadSurtida[]" type="text" id="cantidadSurtida[]" size="5" maxlength="5" />
	 </label>
</td>
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <div align="center">
    <label>
	<?php if($bandera>1){ ?>
    <input name="surtir" type="submit" id="surtir" value="cargar" />
	<?php } ?>
    </label>
  </div>
  <label>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>
</body>
</html>