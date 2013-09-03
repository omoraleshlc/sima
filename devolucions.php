<?php require("/configuracion/operacioneshospitalariasmenu/urgencias/urgencias.php"); 
require('/configuracion/funciones.php');?>
<script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsación de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar la cuenta de este paciente a admisiones? ya no podras hacer cargos, y la operación es irreversible')) return true;
return false;
}
-->
</script>

<?php  
if(is_numeric($_GET['rand']) AND $_GET['cierre']=='si' ){

if($_GET['tipoCierre']=='revision'){

$q = "UPDATE clientesInternos set 
statusCuenta='revision' WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
} else if($_GET['tipoCierre']=='caja'){
$q = "UPDATE clientesInternos set 
statusCuenta='caja' WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}


}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>
<META HTTP-EQUIV="Refresh"
CONTENT="100"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos">Devoluciones</h1>
  <p align="center" class="titulos"></p>
  <span class="style12"></span>
  <img src="../../imagenes/bordestablas/borde1.png" alt="bo1" width="678" height="21" align="center" />
  <table width="678" border="0.2" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#330099">
      <th width="56" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Folio </div>
      </div></th>
      <th bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Nombre del paciente</span></div>
      </div></th>
      <th bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Seguro</div>
      </div></th>
      <th bgcolor="#FFFF00" class="none" scope="col"><div align="center" class="none">
        <div align="center">Cuarto</span></div>
      </div></th>
      

      <th bgcolor="#FFFF00" class="none" scope="col"><div align="center" class="none">
        <div align="center">Devolucion</div>
      </div></th>
    </tr>
    <tr>
<?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
(status='activa' or status='ontransfer' )
and 

(statusCuenta = 'abierta' or statusCuenta='revision')
and
tipoPaciente='urgencias'
and
(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY keyClientesInternos ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);






$sSQL31c= "SELECT keyCAP FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'
and
statusCargo!='cargado'
";
$result31c=mysql_db_query($basedatos,$sSQL31c);
$myrow31c = mysql_fetch_array($result31c);

$sSQL31cd= "SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['seguro']."' 
";
$result31cd=mysql_db_query($basedatos,$sSQL31cd);
$myrow31cd = mysql_fetch_array($result31cd);
?>
	<tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >   
<td height="24" bgcolor="<?php echo $color?>" class="codigos"><div align="left"><?php echo $myrow['folioVenta'];
?></span></div></td>
      <td width="222" bgcolor="<?php echo $color?>" class="normal">

	  <?php echo $myrow['paciente'];
	  if($myrow['status']=='ontransfer'){
	  echo '   [Se solicitó la transferencia de éste paciente]';
	  }
	  ?>
      </span></td>
      <td width="238" bgcolor="<?php echo $color?>" class="normal"><?php 
	  if($myrow31cd['nomCliente']){
	  echo $myrow31cd['nomCliente'];
	  } else {
	  echo 'particular';
	  }
?></td>
      <td width="65" bgcolor="<?php echo $color?>" class="normal"><div align="center"><?php echo $myrow['cuarto']
?></span></div></td>
    
	
	  
      
    
      <td width="75" bgcolor="<?php echo $color?>" class="style12"><div align="center">
      
      <a href="#" onClick="javascript:ventanaSecundaria1('/sima/cargos/aplicarDevoluciones.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')">
      <img src="/sima/imagenes/btns/devolution.png" alt="Pacientes Activos" width="22" height="22" border="0" />      </a></div></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <div align="center"><img src="../../imagenes/bordestablas/borde2.png" alt="bo2" width="678" height="20" /></div>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  </span></span>

</form>
</body>
</html>