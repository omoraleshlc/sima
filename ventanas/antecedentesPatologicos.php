<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?>
<?php 
$sSQL= "SELECT *
FROM
pacientes
WHERE 
entidad='".$entidad."'
    and
numCliente='".$_GET['numCliente']."'
 ";
 $result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];
	  $N=$myrow['numCliente'];
	  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>
</head>

<body>
<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="7"><img src="../imagenes/borderhistory.png" width="800" height="127" /></td>
  </tr>
  <tr>
    <td height="23" colspan="7" class="negromid"><img src="../imagenes/datoshistoria.png" width="800" height="28" /></td>
  </tr>
  <tr>
    <td height="23" bgcolor="#E9E9E9" class="negromid" >&nbsp;</td>
    <td height="23" colspan="4" bgcolor="#E9E9E9" class="negromid" >Paciente: <span class="normalmid"><?php echo $nombrePaciente; ?></span></td>
    <td colspan="2" bgcolor="#E9E9E9" class="negromid">N&deg; Expediente: <span class="normalmid"><?php echo $myrow['numCliente'];?></span></td>
  </tr>
  <tr>
    <td width="23" height="24" bgcolor="#E9E9E9">&nbsp;</td>
    <td width="155" bgcolor="#E9E9E9" class="negromid">Sexo:<span class="normalmid"> <?php echo $myrow['sexo'];?></span></td>
    <td width="86" bgcolor="#E9E9E9" class="negromid">Edad:<span class="normalmid">
        <?php 

	  if ($myrow['fechaNacimiento']); { 
	  
	  edad($myrow['fechaNacimiento']);?>
        
		<?php }
	  ?>
    </span></td>
    <td width="217" bgcolor="#E9E9E9" class="negromid">Estado Civil: <span class="normalmid"><?php echo $myrow['ecivil'];?></span></td>
    <td colspan="3" bgcolor="#E9E9E9" class="negromid">Nacionalidad: <span class="normalmid"><?php echo $myrow['pais1'];?></span></td>
  </tr>
  <tr>
    <td height="25" bgcolor="#E9E9E9">&nbsp;</td>
    <td height="25" colspan="4" bgcolor="#E9E9E9" class="negromid">Domicilio: <span class="normalmid"><?php echo $myrow['calle'];?></span></td>
    <td colspan="2" bgcolor="#E9E9E9">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" bgcolor="#E9E9E9">&nbsp;</td>
    <td height="24" colspan="2" bgcolor="#E9E9E9" class="negromid">Colonia: <span class="normalmid"><?php echo $myrow['colonia'];?></span></td>
    <td height="24" colspan="2" bgcolor="#E9E9E9" class="negromid">Ciudad: <span class="normalmid"> <?php echo $myrow['ciudad'];?></span></td>
    <td width="169" bgcolor="#E9E9E9" class="negromid">Estado: <span class="normalmid"><?php echo $myrow['estado'];?></span></td>
    <td width="43" bgcolor="#E9E9E9">&nbsp;</td>
  </tr>
  <tr>
    <td height="23" bgcolor="#E9E9E9">&nbsp;</td>
    <td height="23" bgcolor="#E9E9E9" class="negromid">Tel&eacute;fono:<span class="normalmid"> <?php echo $myrow['telefono'];?></span></td>
    <td height="23" bgcolor="#E9E9E9">&nbsp;</td>
    <td height="23" bgcolor="#E9E9E9" class="negromid">Fecha Nac.: <span class="normalmid"><?php echo cambia_a_normal($myrow['fechaNacimiento']);?></span></td>
    <td colspan="3" bgcolor="#E9E9E9" class="negromid">Religi&oacute;n: <span class="normalmid"><?php echo $myrow['religion'];?></span></td>
  </tr>
  <tr>
    <td height="24" bgcolor="#E9E9E9">&nbsp;</td>
    <td height="24" colspan="2" bgcolor="#E9E9E9" class="negromid">CURP: <span class="normalmid"><?php echo $myrow['curp'];?></span></td>
    <td height="24" bgcolor="#E9E9E9" class="negromid">&nbsp;</td>
    <td width="107" bgcolor="#E9E9E9">&nbsp;</td>
    <td colspan="2" bgcolor="#E9E9E9" class="negromid">Fecha: <span class="normalmid"><?php echo cambia_a_normal($fecha1);?></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><img src="../imagenes/page1history.png" width="800" height="671" /></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><img src="../imagenes/page2history.png" width="800" height="1000" /></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
</table>
</body>
</html>
