<?php require("menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
 window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>



<?php
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>
    <br></br>
    <br></br>
<form id="form10" name="form10" method="get" action="#">
  <h2 align="center" class="titulo"> <?php echo $TITULO; ?>Aplicar Descuento<label></label>
  Pacientes Internos</h2>
    <br></br>
    <h1>Aplica solamente para pacientes particulares!</h1>
  <table   class="table table-striped" >
    <tr >
      <th width="75" ><div align="left">Referencia</div></th>
      <th width= "233"><div align="left">Nombre del paciente:</div></th>
      <th ><div align="left">Departamento</div></th>
	  <th ><div align="left">EstCuenta</div></th>
	  <th ><div align="left">Usuario</div></th>
	  <th ><div align="left" class="blanco">Descuento</div></th>
    </tr>
    <tr >
      <?php	



$sSQL= "SELECT *
from clientesInternos
where 
entidad='".$entidad."'
and
(statusCuenta='final' or statusCuenta='revision' or statusCuenta='caja')
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
folioVenta!='0'
and
seguro=''
order by paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];


$nT=$myrow['keyClientesInternos'];
	  ?>
    <tr  > 
      <td height="23" ><?php echo $myrow['folioVenta'];
?></td>


  <td width="233" >


	  	  <?php 


if($myrow['paciente']){	  
?>

	  <?php echo $myrow['paciente'];?>
	  <?php }  else {?> 
	  <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
	  
	  <?php }  ?> 
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="118"><?php
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
?></td>


      <td width="63" ><span > <a href="javascript:ventanaSecundaria1('/sima/cargos/despliegaCargos.php?almacen=<?php echo $_GET['almacen']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=externo&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyCAP=<?php echo $keyCAP;?>')">Ver</a></span></td>
      <td width="54" ><?php
echo $myrow['usuario'];
?></td>


<td width="31" >

    <a href="javascript:ventanaSecundaria('/sima/cargos/aplicarDescuentos.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&amp;nT=<?php echo $myrow['keyClientesInternos'];?>&entidad=<?php echo $myrow['entidad'];?>')">
    Aplicar
    </a>
    </td>
    </tr> 
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>

  <p>&nbsp;</p>
</form>



</body>
</html>