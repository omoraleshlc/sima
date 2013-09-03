<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); //valida('CAJA','LOPI',$usuario,$basedatos);?>
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
<?php
if($_POST['almacen']){
$al = $_POST['almacen'];
} else if($_POST['almacen1']){
$al = $_POST['almacen1'];
} else if($_POST['almacen2']){
 $al = $_POST['almacen2'];
} else if($_POST['almacen3']){
$al = $_POST['almacen3'];
} 


?>
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=500,scrollbars=YES") 
} 
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}
.Estilo24 {font-size: 10px}
body {
	background-image: url(../../imagenes/imagenesModulos/screen_caja.jpg);
	background-repeat: no-repeat;
	background-attachment:fixed;
}
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="30; URL=listaOrdenesInternos.php"> 
<body>


<form id="form1" name="form1" method="post" action="">
  <h1 align="center">Transacciones de Pacientes </h1>
  
        <div align="center">
          <?php	

$sSQL= "SELECT *
FROM
clientesInternos
Where
entidad='".$entidad."'
AND
(status='activa' or status='standby')
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
ORDER BY numeroE DESC
 ";

 
if($result=mysql_db_query($basedatos,$sSQL)){ ?>
          
  </div>
        <span class="style12"></span>
        <table width="599" border="0" align="center">
    <tr>
      <th width="46" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13"># Folio </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cuarto</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Depto.</span></div></th>
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
$numeroE=$myrow['numeroE'];
$sSQL2= "SELECT *
FROM
pacientes
WHERE 
numCliente = '".$numeroE."'

 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$nombrePaciente = $myrow2['nombre1']." ".$myrow2['nombre2']
	  ." ".$myrow2['apellido1']." ".$myrow2['apellido2']." ".$myrow2['apellido3'];
	  $E=$myrow['keyClientesInternos'];

$tipoTransaccion=$myrow['tipoTransaccion'];

if($tipoTransaccion){
$sSQL22= "Select * From catTTCaja WHERE codigoTT = '".$tipoTransaccion."' ";
$result22=mysql_db_query($basedatos,$sSQL22);
$myrow22 = mysql_fetch_array($result22);
$sSQL4= "Select * From clientesInternos WHERE keyClientesInternos = '".$E."' ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

}



$tipoCliente='particular';

?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php echo $E?>
      </a></span></td>
      <td width="425" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><a href="#" rel="htmltooltip" onClick="javascript:ventanaSecundaria3(
		'ventanaAplicaPagoInternos.php?campoDespliega=<?php echo "despliegaMedico"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "medico"; ?>&amp;depositos=<?php echo "si"; ?>&amp;nCuenta=<?php echo $E; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;almacenFuente=<?php echo $ALMACEN;?>')">
		<?php 
		if($myrow4['statusDeposito']=='pendiente' AND $tipoTransaccion){
		echo  $myrow['paciente']." (".$myrow22['descripcion'].")";
		} else {
		echo  $myrow['paciente'];
		}
		?>
		</a></span></td>
      <td width="55" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['cuarto']
?></span></td>
      <td width="55" bgcolor="<?php echo $color?>" class="style12"><div align="center">
        </button>
        <span class="style7"><?php echo $myrow['almacen']
?></span> </div></td>
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  
  <?php } else { 
  echo "NO HAY REGISTROS";
  }
  ?>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  </span></span>
  <input name="almacen1" type="hidden" id="almacen1" value="<?php echo $_POST['almacen']; ?>" />
  <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_POST['almacen1']; ?>" />
  <input name="almacen3" type="hidden" id="almacen3" value="<?php echo $_POST['almacen2']; ?>" />
  <input name="almacen" type="hidden" id="almacen3" value="<?php echo $_POST['almacen3']; ?>" />
</form>
<p>&nbsp; </p>
</body>
</html>

