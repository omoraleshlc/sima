<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); include('/configuracion/funciones.php');?>
<?php

$sSQLC= "Select status From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta'){ //*******************Comienzo la validación*****************
?>
<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventana111","width=800,height=700,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">

.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}


div.htmltooltip{
position: absolute; /*leave this and next 3 values alone*/
z-index: 1000;
left: -1000px;
top: -1000px;
background: #272727;
border: 10px solid black;
color: white;
padding: 3px;
width: 250px; /*width of tooltip*/
}
.style18 {color: #FFFFFF}
.style18 {color: #FFFFFF}
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<?php 

$sSQL2= "Select transacciones From almacenes WHERE almacen = '".$ALMACEN."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>
<form id="form1" name="form1" method="get" action="#">
  <h1 align="center">LISTA DE DEVOLUCIONES PENDIENTES </h1>
  <table width="703" border="0.2" align="center">
    <tr>
      <th width="93" bgcolor="#660066" class="style12" scope="col"><div align="left" class="style20"><span class="style18 style20"> FolioCancelaci&oacute;n</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="style20"><span class="style18">Nombre del paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="style20"><span class="style121"><span class="style18">Seguro</span></span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="style20"><span class="style18">Depto.</span></div></th>
      <?php if($myrow2['transacciones']=='si'){ ?>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="style20"><span class="style13">Trans</span></div></th>
	  	  <?php }?>
    </tr>
    <tr>
     
<?php	
	  
$cierreCuentaReporte=new articulosDetalles();
 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
AND
statusDevolucion='si'
and
(folioDevolucion!='' and folioDevolucion!='0')
order by paciente ASC

";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$seguro=$myrow['seguro'];
$nT=$myrow['keyClientesInternos'];

$sSQL1711= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$seguro."'

";
$result1711=mysql_db_query($basedatos,$sSQL1711);
$myrow1711 = mysql_fetch_array($result1711);
$seguro=$myrow1711['nomCliente'];

if($seguro){
$tipoCliente='aseguradora';
} else {
$tipoCliente='particular';
}

if(!$seguro)$seguro='particular';




	  ?>
	  
	  
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
	  
<?php echo $myrow['folioDevolucion'];?></span></td>


      <td width="216" bgcolor="<?php echo $color?>" class="style12"><span class="style7">

	  <?php 
	  if($myrow['nombreCliente']){
	  echo $myrow['nombreCliente'];
	  } else {
	  echo $myrow['paciente'];
	  }
	  
echo $cierreCuentaReporte->cierreCuentaReportes($entidad,$nT,$numeroE,$nCuenta,$basedatos);
	  ?>
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>
      </span></td>

      <td width="220" bgcolor="<?php echo $color?>" class="style12"><span class="style121"><span class="style71">
	  <?php echo $seguro;?></span></span></td>
      <td width="113" bgcolor="<?php echo $color?>" class="style12"><span class="style121"><span class="style71">
	  <?php echo $myrow['almacen'];?></span></span></td>
      <?php if($myrow2['transacciones']=='si'){ ?>  
      <td width="39" bgcolor="<?php echo $color?>" class="style12">




<a href="#" 
onclick="nueva('estadoCuentaE.php?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&almacen=<?php echo $ALMACEN; ?>&almacenFuente=<?php echo $ALMACEN; ?>&nT=<?php echo $nT; ?>&tipoCliente=<?php echo $tipoCliente;?>&tipoMovimiento=<?php echo 'transaccion';?>&entidad=<?php echo $entidad;?>&usuario=<?php echo $usuario;?>&devolucion=si&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>','ventanaSecundaria111','800','700','yes')">
<img src="/sima/imagenes/transfer1.jpeg" alt="" width="12" height="12" border="0" /></a></td>
    <?php  }//fin de transacciones?>
    </tr>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>



<?php 
$titulo='prueba';
$url=$ventana;
$abajo=70;
$izquierda=0;
$ancho=300;
$alto=200;
//$ventanas=new ventanasPrototype();
//$ventanas->despliegaVentana($titulo,$url,$abajo,$izquierda,$anchura,$altura);?>


  <p>&nbsp;</p>
</form>
</body>
</html>
<?php
} else { 
$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje('LA CAJA ESTA CERRADA');
}
?>