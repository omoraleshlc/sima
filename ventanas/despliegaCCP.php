<?PHP require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php'); ?>




<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES"); 
} 
</script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo2 {color: #006600}
-->
</style>
</head>

<body>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


<h1 align="center">Folios de Venta con Problemas
<?php   
 $sSQL= "Select * From clientesInternos where entidad='".$entidad."' 

and
(tipoPaciente='interno' or tipoPaciente='urgencias')
 and
 (fecha1 between '".$_GET['fechaInicial']."' and '".$_GET['fechaFinal']."')
 and
( folioVenta!=0 or folioVenta!='')
 order by fecha1 ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
</h1>
<p align="center"><?php print 'De la Fecha: '.cambia_a_normal($_GET['fechaInicial']).' a '.cambia_a_normal($_GET['fechaFinal']);?></p>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="1038" class="table table-striped">
    <tr >
      <th width="47"   scope="col"><div align="left" class="blancomid">
          <div align="center">Folio</div>
      </div></th>
      <th width="113"  scope="col"><div align="left" class="blancomid">
          <div align="center">Fecha</div>
      </div></th>
      <th width="262"  scope="col">Paciente</th>
      <th width="97"  scope="col"><div align="left" class="blancomid">
          <div align="center">Status</div>
      </div></th>
      <th width="97"  scope="col"><div align="left" class="blancomid">
          <div align="center">StatusCuenta</div>
      </div></th>
      <th width="97" scope="col"><div align="left" class="blancomid">
        <div align="center">tipo Px </div>
      </div></th>
      <th width="97"  scope="col"><div align="left" class="blancomid">
          <div align="center">Cargos</div>
      </div></th>
      <th width="97"  scope="col"><div align="left" class="blancomid">
          <div align="center">Abonos</div>
      </div></th>
      <th width="93"  scope="col"><div align="left" class="blancomid">
          <div align="center">Diferencia</div>
      </div></th>
    </tr>
<?php 
while($myrow = mysql_fetch_array($result)){
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codProcedimiento'];
//*************************************CONVENIOS**************************************
$sSQL12= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as C
FROM
cargosCuentaPaciente
WHERE 
folioVenta='".$myrow['folioVenta']."'
and
naturaleza='C'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


$sSQL12a= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as A
FROM
cargosCuentaPaciente
WHERE 
folioVenta='".$myrow['folioVenta']."'
and
naturaleza='A'

";
$result12a=mysql_db_query($basedatos,$sSQL12a);
$myrow12a = mysql_fetch_array($result12a);


$cargos=$myrow12['C'];
$abonos=$myrow12a['A'];
$STotal=$myrow12['C']-$myrow12a['A'];







?>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td bgcolor="<?php echo $color;?>" class="codigos"><div align="center"><span class="normalmid">
	  
	  <a href="#" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>')">  
	  <?php echo $myrow['folioVenta']; ?>	  </a>
	  
	  </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class="normalmid"><?php echo cambia_a_normal($myrow['fecha1']); ?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class="normalmid"><?php echo $myrow['paciente']; ?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class="normalmid"><?php echo $myrow['status']; ?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class="normalmid"><?php echo $myrow['statusCuenta']; ?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class="normalmid"><?php echo $myrow['tipoPaciente']; ?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><?php echo '$'.number_format($cargos,3);?></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><?php echo '$'.number_format($abonos,3);?></div></td>
      <td height="24" bgcolor="<?php echo $color;?>" class="normal"><div align="center">
	  <?php 
	  if($STotal>1 or $STotal<-1){
	  echo '<span class="codigos"><blink>'.'$'.number_format($STotal,2).'</blink></span>';
	  }else{
	  echo '$'.money_format($STotal,2);
	  }
	  ?>
	  </div></td>
    </tr>
    <?php }?>
  </table>
  <p>&nbsp;</p>
  <p align="center">Se encontraron <?php echo $bandera;?> registros...!</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>