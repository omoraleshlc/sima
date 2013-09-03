<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); ?>


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



<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>

  <p align="center" >
  
    <h1>
    Reportes de &quot;Otros&quot; </h1>
  </p>
  <form id="form1" name="form1" method="post" action="">
    <p align="center" ><br />
        <div class="success">Presiona sobre el nombre del Paciente ...</div> </p>
    <table width="537" class="table table-striped">

      <tr >
        <th width="53" > F Venta</th>
        <th width="272" >Datos Paciente</th>
        <th width="215" >Aseguradora</th>
      </tr>
<?php	

$sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
statusOtros='standby'
and
folioVenta!=''

order by folioVenta DESC
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];


$nT=$myrow['keyClientesInternos'];
	  ?>
      <tr  >
        <td height="48" ><?php echo $myrow['folioVenta'];
?></td>
        <td ><a href="javascript:nueva('../../cargos/verSaldosOtros.php?numeroE=<?php echo $myrow['keyClientesInternos']; ?>
&amp;nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&amp;almacenSolicitante=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&amp;tipoVenta=<?php echo 'externo';?>&amp;devolucion=<?php echo $myrow['statusDevolucion'];?>','ventana1','800','600','yes')"> <?php echo $myrow['paciente'];
		  if($myrow['statusDevolucion']=='si'){
		  echo '</br>';
		  echo '<span class=codigos>'.' [Solicita Devolucion ]'.'</span>';
		  }
		  
		  ?></a></br>
            <span > Departamento: </span><span >
            <?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?>
              </span> </br>
			  
			  
			     <span > Fecha:  <?php echo cambia_a_normal($myrow['fecha']);?></span>


				 </br>
				

				 
			  
<span >Enviada por: </span><span >
<?php
echo $myrow['usuario'];
?>
            </span> </td>
        <td ><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "PARTICULAR";
		  }
?></td>
      </tr>
      <?php  }}?>

    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </form>
  <p align="center" >&nbsp;</p>
  <p align="center">&nbsp;</p>
  
  

</body>
</html>
