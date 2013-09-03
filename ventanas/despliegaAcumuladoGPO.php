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
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
-->
</style>
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
 <h1 align="center">Errores</h1>
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
 order by almacen
 ";
$result=mysql_db_query($basedatos,$sSQL); 

?>
  </div>
  <table width="794" border="0" align="center">
     <tr>
       <th width="26" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">#</span></div></th>
       <th width="55" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Folio</span></div></th>
       <th width="55" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Mov</span></div></th>
       <th width="301" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Descripcion</span></div></th>
       <th width="58" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Almacen</span></div></th>
       <th width="56" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Grupo</span></div></th>
       <th width="56" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Importe</span></div></th>
       <th width="34" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">iva</span></div></th>
       <th width="65" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">ImporteD</span></div></th>
       <th width="46" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">ivaD</span></div></th>
    </tr>
     <tr>

<?php	
while($myrow = mysql_fetch_array($result)){
$recorre+=1;



$sSQLu1= "Select codProcedimiento From cargosCuentaPaciente where keyCAP='".$myrow['keyCAP']."'";
$resultu1=mysql_db_query($basedatos,$sSQLu1); 
$myrowu1 = mysql_fetch_array($resultu1);

$sSQLu1= "Select descripcion From articulos where codigo='".$myrowu1['codProcedimiento']."'";
$resultu1=mysql_db_query($basedatos,$sSQLu1); 
$myrowu1 = mysql_fetch_array($resultu1);




$sSQLu1a= "Select descripcionGP,tasaGP From gpoProductos where codigoGP='".$myrow['gpoProducto']."'";
$resultu1a=mysql_db_query($basedatos,$sSQLu1a); 
$myrowu1a = mysql_fetch_array($resultu1a);


$sSQLu= "Select descripcion From almacenes where almacen='".$myrow['almacen']."'";
$resultu=mysql_db_query($basedatos,$sSQLu); 
$myrowu = mysql_fetch_array($resultu);

 if(($myrow['efectivo']*$myrow['porcentaje'])==0 and $myrowu1a['tasaGP']>0){
 $error=1;
 }else{
 $error=NULL;
 }








if($error){
$color='#FF0000';
$col="";


}else{
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
}
?>


       <td bgcolor="<?php echo $color;?>" class="normalmid"><?php print $recorre;?></td>
       <td bgcolor="<?php echo $color;?>" class="normalmid"><?php print $myrow['folioVenta'];?></td>
       <td bgcolor="<?php echo $color;?>" class="normalmid"><?php echo $myrow['keyCAP'];?></td>
       <td bgcolor="<?php echo $color;?>" class="normalmid">
	 
	   <?php 

	   echo $myrowu1['descripcion'];

	   ?>      </td>
       
       <td bgcolor="<?php echo $color;?>" class="normalmid"><?php print $myrowu['descripcion'];?></td>
       <td bgcolor="<?php echo $color;?>" class="normalmid"><?php print $myrowu1a['descripcionGP'];?></td>
       <td bgcolor="<?php echo $color;?>" class="normalmid">
	   <?php 
	   if($myrow['naturaleza']=='C'){
	   echo "$".number_format($myrow['efectivo'],2);
	   $sC=$myrow['efectivo'];
	   $efectivo[0]+=$myrow['efectivo'];
	   }else{
	   echo '$0.00';
	   //$efectivo[0]=NULL;
	   }
	   ?>       </td>
       
       <td bgcolor="<?php echo $color;?>" class="normalmid">
	   
	   <?php 
	   
	   
	   if($myrow['naturaleza']=='C'){
	   echo "$".number_format($myrow['efectivo']*$myrow['porcentaje'],2); 
	   $iva[0]+=($myrow['efectivo']*$myrow['porcentaje']);
	   }else{
	   echo '$0.00';
	   //$iva[0]=NULL;
	   }
	   
	   ?>       </td>
       <td bgcolor="<?php echo $color;?>" class="normalmid">
       <?php 
       if($myrow['naturaleza']=='A'){
	   echo "$".number_format($myrow['efectivo'],2);
	   $efectivoD[0]+=$myrow['efectivo'];
	   $sD=$myrow['efectivo'];
	   }else{
	   //$efectivoD[0]=NULL;
	   echo '$0.00';
	   $sD=NULL;
	   }
	   ?>       </td>
       <td bgcolor="<?php echo $color;?>" class="normalmid">
       <?php 
       if($myrow['naturaleza']=='A'){
	   echo "$".number_format($myrow['efectivo']*$myrow['porcentaje'],2);
	   $ivaD[0]+=($myrow['efectivo']*$myrow['porcentaje']);
	   }else{
	   //$ivaD[0]=NULL;
	   echo '$0.00';
	   }
	   ?>       </td>
     </tr>
     <?php }//cierra while?>
  </table>
  <p class="Estilo1">&nbsp;</p>
  <table width="200" border="1" align="center">
    <tr>
      <th colspan="2" scope="col">Subtotales Deptos.</th>
    </tr>
    <tr>
      <th width="97" scope="col"><div align="left">SubTotal</div></th>
      <th width="87" scope="col"><div align="left"><?php
	  print '$'.number_format($efectivo[0]-$efectivoD[0],2);?></div></th>
    </tr>
    <tr>
      <th scope="col"><div align="left">IVA</div></th>
      <th scope="col"><div align="left"><?php 
	  print '$'.number_format($iva[0]-$ivaD[0],2);?></div></th>
    </tr>
    <tr>
      <td><div align="left">TOTAL</div></td>
      <td><div align="left"><?php 
	  
	  print '$'.number_format(($efectivo[0]-$efectivoD[0])+($iva[0]-$ivaD[0]),2);?></div></td>
    </tr>
  </table>
  
  

  <p><hr /></p>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
