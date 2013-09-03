<?php include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<?php
$campo=$_GET['campoSeguro'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$tipoPago=$_GET['tipoPago'];
$campo1=$_GET['campo1'];
$ALMACEN=$_GET['almacen'];
$tipoCliente=$_GET['tipoCliente'];
?>
<script type="text/javascript">
	function regresar(strCuenta,campoDespliega,campo1){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = strCuenta;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = campoDespliega;
				
						close();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
</head>

<body>
<p align="center">&nbsp;</p>
<?php 
 $sSQL3= "Select * From clientesInternos WHERE numeroE = '".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$statusAlta= $myrow3['statusAlta'];
?>

<form id="form1" name="form1" method="post" action="">
  <table width="298" border="0" align="center">
    <tr>
      <th width="72" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Cuenta Mayor </span></div></th>
      <th width="216" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
    </tr>
    <tr>
  

   <?php   
if(!$statusAlta){
$sSQL= "Select * From catTTCaja where entidad='".$entidad."' and almacen='".$_GET['almacenFuente']."' AND naturaleza!='Credito' 
AND tipoPago='".$tipoPago."'
order by codigoTT ASC";

} else {   
$sSQL= "Select * From catTTCaja where 
 entidad='".$entidad."' and almacen='".$ALMACEN."' AND
  tipoPago='".$tipoPago."' order by codigoTT ASC";
}


$result=mysql_db_query($basedatos,$sSQL); 

?>
 <?php	while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['codigoTT'];


?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <label></label>
<?php 

$convenioParticular=new acumulados(); $convenioAseguradora=new acumulados(); 
$convenioParticular->convenioParticular($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']); 
$convenioAseguradora->convenioAseguradora($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);
$cargosAseguradora=new acumulados();
$cargosParticulares=new acumulados();
$otros=new acumulados();


if($_GET['tipoVenta']=='interno'){
if($tipoCliente=='otros'){

 
		
		$cargoxPagar=$otros->otros($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);


} else if($tipoCliente=='aseguradora') {



$cargoxPagar=$cargosAseguradora->cargosAseguradora($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);


} else if($tipoCliente=='particular'){

	  		
				
		$cargoxPagar=$cargosParticulares->cargosParticulares($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);

} else if($tipoCliente=='coaseguro'){

	  		$coaseguro=new  acumulados();	
			$cargoxPagar=$coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);	
			
}




if($_GET['tipoVenta']!='interno'){
if($convenioAseguradora->convenioAseguradora($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta'])){
$cargoxPagar=$convenioAseguradora->convenioAseguradora($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);
} 
}//solo casos de externos entran a convenios
}else{
//el tipo de venta es externo





if($_GET['tipoPago']=='Credito' and $convenioAseguradora->convenioAseguradora($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta'])){

$cargoxPagar=$convenioAseguradora->convenioAseguradora($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);
} else if($_GET['tipoPago']=='Efectivo' and $convenioParticular->convenioParticular($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta'])){
$cargoxPagar=$convenioParticular->convenioParticular($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);
}




}
//cierra venta externos
$cargoxPagar=number_format($cargoxPagar,2,'.','');
if($cargoxPagar<0){
$cargoxPagar*=-1;
}
?>	
	
<a href="javascript:regresar('<?php echo $myrow['codigoTT'];  ?>','<?php echo $myrow['descripcion'];  ?>');">
	   <?php 
	
	   echo $myrow['codigoTT'];  ?>
	   </a>

	   </span></td>
      
	  
	  
	  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['descripcion'];  ?></span></td>
     
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
