<?php include("/configuracion/operacioneshospitalariasmenu/consultaexterna/consultaexterna.php"); ?>

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
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="30; URL=pacientesAmbulatorios.php"> 
<body>


<form id="form1" name="form1" method="post" action="agregaCargos.php">
  <h1 align="center">Listado de &oacute;rdenes Pacientes Ambulatorios </h1>
  <table width="591" border="1" align="center">
    <tr>
      <th width="98" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">N&uacute;mero de Orden </span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Nombre del paciente:</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Seguro</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Status</span></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT distinct
*
  FROM
clientesAmbulatorios WHERE fecha = '".$fecha1."' 
and 
status='pendiente' 
ORDER BY numeroE DESC
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
$numeroE=$myrow['numeroE'];
$sSQL2= "SELECT *
FROM
clientesAmbulatorios
WHERE 
numeroE = '".$numeroE."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$numeroE=$myrow['numeroE'];


$sSQL4= "SELECT *
FROM
movimientos
WHERE 
RECIBO= '".$numeroE."' AND FECHA='".$fecha1."'
 ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];


$E=$myrow['numeroE'];
?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <input name="numeroE" type="submit" class="style12" id="numeroE" value="<?php echo $E?>" 
 <?php if($myrow['status']=='activo'){ echo 'disabled="disabled"';}?>>
      </span></td>
      <td width="376" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow2['paciente']
?></span></td>
      <td width="60" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow2['seguro']
?></span></td>
      <td width="29" bgcolor="<?php echo $color?>" class="style12"><div align="center">
<img src="<?php 
if($myrow['status']=="activo"){
echo $imagen = "permitido.png";
$razon = "SE EFECTUO EL PAGO EN CAJA";
} else {
echo $imagen = "pendiente.png";
$razon = "NO SE HA PAGADO TODAVIA";
}
?>" alt="<?php echo $razon ?>" width="16" height="16" /></div></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
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

