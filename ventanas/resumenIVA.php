<?PHP require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
} 
</script> 



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>



<?php 
$sSQL7e="SELECT paciente
FROM
clientesInternos
WHERE
folioVenta='".$FV."'

";
$result7e=mysql_db_query($basedatos,$sSQL7e);
$myrow7e = mysql_fetch_array($result7e);
?>
<body>
 <h1 align="center"><?php //print $FV.' '.$myrow7e['paciente']; ?>Resumen Efectivo (Particular)</h1>
 <p align="center">DE LA FECHA <?php echo cambia_a_normal($_GET['fechaInicial']);?> a la fecha <?php echo cambia_a_normal($_GET['fechaFinal']);?>
 
 </p>
<p align="center"><br />
    </p>
<form id="form2" name="form2" method="post" action="">
  <div align="center">
   
 <?php   
 $sSQL= "Select * From reportesFinancieros 
 where random='".$_GET['random']."' 
 and
 usuario='".$usuario."'
 group by almacen";
$result=mysql_db_query($basedatos,$sSQL); 

?>
  </div>
  <table width="579" border="0" align="center">
     <tr>
       <th width="75" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Codigo</span></div></th>
       <th width="251" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Descripcion</span></div></th>
       <th width="60" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Importe</span></div></th>
       <th width="45" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">IVA</span></div></th>
       <th width="61" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Grupos</span></div></th>
       <th width="61" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Detalles</span></div></th>
    </tr>
     <tr>

<?php	
while($myrow = mysql_fetch_array($result)){
	
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}







//***********************I*************************
$sSQL7="SELECT  sum(cantidadParticular) as totalEfectivo,sum(cantidadParticular*porcentaje) as totalIVA

FROM
reportesFinancieros
WHERE
almacen='".$myrow['almacen']."'
and
random='".$_GET['random']."'
and
naturaleza='C'
";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


$sSQL7d="SELECT  sum(cantidadParticular) as totalEfectivo,sum(cantidadParticular*porcentaje) as totalIVA
FROM
reportesFinancieros
WHERE
almacen='".$myrow['almacen']."'
and
random='".$_GET['random']."'
and
naturaleza='A'";
$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);
//************************************************************







$sSQLu1= "Select descripcion From articulos where entidad='".$entidad."' and codigo='".$myrow['codProcedimiento']."'";
$resultu1=mysql_db_query($basedatos,$sSQLu1); 
$myrowu1 = mysql_fetch_array($resultu1);






$sSQLu= "Select descripcion From almacenes where almacen='".$myrow['almacen']."'";
$resultu=mysql_db_query($basedatos,$sSQLu); 
$myrowu = mysql_fetch_array($resultu);




$efectivo[0]+=$myrow7['totalEfectivo'];
$ivar[0]+=$myrow7['totalIVA'];

$efectivod[0]+=$myrow7d['totalEfectivo'];
$ivard[0]+=$myrow7d['totalIVA'];


?>


       <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo $myrow['almacen'];?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <span class="style71">
	   <?php 

	   print $myrowu['descripcion'];

	   ?>	   </span>         </td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <?php echo "$".number_format($myrow7['totalEfectivo']-$myrow7d['totalEfectivo'],2); ?>       </td>
       
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php 
	   if($myrow7['totalIVA']>0){
	   echo "$".number_format($myrow7['totalIVA']-$myrow7d['totalIVA'],2); 
	   }else{
	   echo '$'.'0.00';
	   }
	   ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><div align="center">
         <?php if($efectivo[0]){ ?>
         <a href="#" 
onclick="javascript:ventanaSecundaria1('resumenEfectivoxGrupos.php?fecha=<?php echo $_POST['fecha']; ?>&amp;gpoProducto=<?php echo $myrow['codigoGP']; ?>&amp;almacen=<?php echo $myrow['almacen']; ?>&amp;almacenFuente=<?php echo $myrow['almacenSolicitante']; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;fechaInicial=<?php echo $_GET['fechaInicial'];?>&amp;fechaFinal=<?php echo $_GET['fechaFinal'];?>&amp;random=<?php echo $_GET['random'];?>')"><img src="../../imagenes/btns/detailsbtn.png" width="18" height="18" border="0" /></a>
         <?php } else { 
		echo '---';
		}
		?>
       </div></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><div align="center">
         <?php if($efectivo[0]){ ?>
         <a href="#" 
onclick="javascript:ventanaSecundaria1('ivaParticular.php?fecha=<?php echo $_POST['fecha']; ?>&amp;gpoProducto=<?php echo $myrow['codigoGP']; ?>&amp;almacen=<?php echo $myrow['almacen']; ?>&amp;almacenFuente=<?php echo $myrow['almacenSolicitante']; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;fechaInicial=<?php echo $_GET['fechaInicial'];?>&amp;fechaFinal=<?php echo $_GET['fechaFinal'];?>&random=<?php echo $_GET['random'];?>')"><img src="../../imagenes/btns/detailsbtn.png" width="18" height="18" border="0" /></a>
         <?php } else { 
		echo '---';
		}
		?>
       </div></td>
     </tr>
     <?php }//cierra while?>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1" align="center">
    <tr>
      <th colspan="2" scope="col">Subtotales Deptos.</th>
    </tr>
    <tr>
      <th width="97" scope="col"><div align="left">SubTotal</div></th>
      <th width="87" scope="col"><div align="left"><?php print '$'.number_format($efectivo[0]-$efectivod[0],2);?></div></th>
    </tr>
    <tr>
      <th scope="col"><div align="left">IVA</div></th>
      <th scope="col"><div align="left"><?php print '$'.number_format($ivar[0]-$ivard[0],2);?></div></th>
    </tr>
    <tr>
      <td><div align="left">TOTAL</div></td>
      <td><div align="left"><?php 
	  
	  print '$'.number_format(($efectivo[0]+$ivar[0])-($efectivod[0]+$ivard[0]),2);?></div></td>
    </tr>
  </table>
  
  

  <p><hr /></p>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
