<?PHP include("/configuracion/administracionhospitalaria/medicos/medicosmenu.php"); ?>
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

<body>
<form id="form2" name="form2" method="post" action="">
  <h1 align="center"><strong>LISTADO DE MEDICOS </strong>FOR&Aacute;NEOS</h1>
  <p>
<label>
  <div align="center">
  </label>
</form>
<form id="form1" name="form1" method="post" action="modificaMedicos.php">
  <table width="613" border="1" align="center">
    <tr>
      <th width="99" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">N&uacute;mero de M&eacute;dico </span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Nombre del M&eacute;dico:</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Cuenta Contable</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Datos </span></th>
    </tr>
    <tr>
<?php	

$sSQL= "SELECT *
FROM
medicosForaneos
order by 
numMedico
ASC
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
$nombrePaciente =
	  $myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3']." ". $myrow['nombre1']." ".$myrow['nombre2'];
	  $N=$myrow['numMedico'];
	  ?>
      <td height="24" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <input name="numMedico" type="Submit" class="style12" id="numMedico" value="<?php echo $N?>" 
		 />
     </span></td>
      <td width="314" bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $nombrePaciente;?></span></td>
      <td width="122" bgcolor="<?php echo $color;?>" class="style12"><?php 
	  if($myrow['ctaContable']){
	  echo $myrow['ctaContable'];
	  } else {
	  echo "Sin Asignar";
	  }
	  ?>&nbsp;</td>
      <td width="50" bgcolor="<?php echo $color;?>" class="style12"><div align="center"><img src="pregunta.png" alt="
	  <?php echo "\n".
	  "DATOS PERSONALES"."\n".
	  "fechaNac: ".$myrow['fechaNacimiento']."\n".
	  "País: ".$myrow['pais']."\n".
	  "Núm. Teléfono: ".$myrow['telefono']."\n".
	  "Dirección: ".$myrow['direccion']."\n".
	  "CP: ".$myrow['cp']."\n".
	  "Ciudad: ".$myrow['ciudad']."\n".
	  "Estado: ".$myrow['estado']."\n".
 	  "Num. Cédula: ".$myrow['cedula']."\n".
	  "fecha Titulación: ".$myrow['fechaTitulacion']."\n".
	  "RFC: ".$myrow['rfc']."\n"
	  ;
	  ?>
	  " width="16" height="16" /></div></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  </span></span>
</form>
<p>&nbsp; </p>
</body>
</html>