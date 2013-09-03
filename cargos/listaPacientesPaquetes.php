<?php include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<?php
$numCliente=$_GET['seguro'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
?>











<?php 




if($_POST['actualizar']){

$codigo=$_POST['codigo'];
$precioPaquete1=$_POST['precioPaquete1'];
$precioPaquete3=$_POST['precioPaquete3'];
$almacen=$_POST['almacen'];
$cantidad=$_POST['cantidad'];		
		
		
for($i=0;$i<=$_POST['flag'];$i++){



if($codigo[$i] and $precioPaquete1[$i] and $precioPaquete3[$i]){

$sql="Update articulosPaquetes
set
precioPaquete1='".$precioPaquete1[$i]."',
precioPaquete3='".$precioPaquete3[$i]."',
usuario='".$usuario."',
fecha='".$fecha1."',
cantidad='".$cantidad[$i]."',
hora='".$hora1."'
where 

almacen='".$almacen[$i]."'
and
codigo='".$codigo[$i]."' and entidad='".$entidad."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();
$leyenda='Registro Actualizado';

}
}//cierra if
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
  // -->
</script>';
}//cierra for

?>












<?php 
if($usuario AND $entidad AND $_GET['keyPPaq']!=NULL){
$borrame = "DELETE FROM paquetesPacientes WHERE 
keyPPaq ='".$_GET['keyPPaq']."'

";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$yes='si';
}else{
$yes='no';
}
?>



<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=900,height=800,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>


</head>

<body>

<p align="center">
  <label></label><label>
  </label>
</p>
<h3 align="center" > Historial del Paciente</h3>
<form id="form2" name="form2" method="post" action="#" >
  <table width="537" class="table table-striped">

    <tr >
      <th width="81" >CodigoP</th>
      <th width="319"  >Descripcion</th>
      <th  >Fecha </th>
    </tr>
<?php	
$sSQL= "SELECT 
 *
FROM
 paquetesPacientes

 WHERE entidad='".$entidad."' AND numeroE = '".$_GET['numeroE']."'
and
(status='standby' or status='activo')
 ";
$result=mysql_db_query($basedatos,$sSQL);

if($result){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQL4= "Select * from clientesInternos where keyClientesInternos='".$myrow['keyClientesInternos']."' ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
?>
    <tr >
      <td height="48" ><span >
        <?php 
echo $myrow['codigoPaquete'];
	  ?>
      </span></td>
      <td ><a href="javascript:ventanaSecundaria2('/sima/cargos/despliegaCargos.php?codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&numeroE=<?php echo $_GET['numeroE']; ?>&numeroExpediente=<?php echo $E; ?>&seguro=<?php echo $_POST['seguro']; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&folioVenta=<?php echo $myrow4['folioVenta'];?>')">
        <?php 

if($myrow['descripcionPaquete']){
echo $myrow['descripcionPaquete'];
}else{
echo 'El paquete fue cancelado';
}
	  ?>
      </a></td>
      <td  ><span >
        <?php 
echo cambia_a_normal($myrow['fecha']);
	  ?>
     </span></td>
    </tr>
    <?php  }}?>

  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
  <p></p>
  
  
</body>
</html>
