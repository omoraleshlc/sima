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
  <p align="center">Lista de M&eacute;dicos </p>
  <table width="533" border="1" align="center">
    <tr>
      <th class="style12" scope="col"><label>
        
        <div align="left">
          <input name="escoje" type="radio" value="nombre1" checked="checked" />
          </label>
      </div></th>
      <th class="style12" scope="col"><div align="left">Nombre 1  </div></th>
      <th class="style12" scope="col"><div align="left">
        <input name="nombre1" type="text" class="style12" id="nombre1" size="60" />
      </div></th>
    </tr>
    <tr>
      <th class="style12" scope="col">
        <div align="left">
          <input name="escoje" type="radio" value="nombre2" />
        </div></th><th class="style12" scope="col"><div align="left">Nombre 2</div></th>
      <th class="style12" scope="col"><div align="left">
        <input name="nombre2" type="text" class="style12" id="nombre2" size="60" />
      </div></th>
    </tr>
    <tr>
      <th class="style12" scope="col">
        <div align="left">
          <input name="escoje" type="radio" value="apellido1" />
        </div></th><th class="style12" scope="col"><div align="left">Apellido 1</div></th>
      <th class="style12" scope="col"><div align="left">
        <input name="apellido1" type="text" class="style12" id="apellido1" size="60" />
      </div></th>
    </tr>
    <tr>
      <th width="36" class="style12" scope="col">
        <div align="left">
          <input name="escoje" type="radio" value="apellido2" />
        </div></th><th width="115" class="style12" scope="col"><div align="left">Apellido 2 </div></th>
      <th width="360" class="style12" scope="col"><label>
        <div align="left">
          <input name="apellido2" type="text" class="style12" id="apellido2" size="60" />
        </div>
      </label></th>
    </tr>

    <tr>
      <td class="style12">
        <div align="left">
          <input name="escoje" type="radio" value="apellido3" />
        </div></td><td height="24" class="style12"><div align="left">Apellido 3 </div></td>
      <td class="style12"><div align="left">
        <input name="apellido3" type="text" class="style12" id="apellido3" size="60" />
      </div></td>
    </tr>
    <tr>
      <td height="40" colspan="2" class="style12"><div align="left"></div></td>
      <td class="style12"><div align="left">
        <input name="buscar" type="submit" class="style12" id="buscar" value="Buscar" />
      </div></td>
    </tr>
  </table>
  <p>
  <label>
  <div align="center">
  </label>
</form>
<form id="form1" name="form1" method="post" action="modificaMedicos.php">
  <table width="474" border="0" align="center">
    <tr>
      <th width="174" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">N&uacute;mero de M&eacute;dico </span></th>
      <th colspan="2" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Nombre del M&eacute;dico:</span></th>
    </tr>
    <tr>
      <?php	

$nombre1 = $_POST['nombre1'];
$nombre2 = $_POST['nombre2'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$apellido3 = $_POST['apellido3'];
if(($_POST['buscar']) AND ($_POST['nombre1'] OR $_POST['nombre2'] OR $_POST['apellido1']
OR $_POST['apellido2'] OR $_POST['apellido3'])){
if($_POST['escoje']=="nombre1" AND $_POST['nombre1']){
 $sSQL= "SELECT *
  FROM
medicos
WHERE nombre1 like '%$nombre1%'
 ";
} else if($_POST['escoje']=="nombre2" AND $_POST['nombre2']){
$sSQL= "SELECT *
  FROM
medicos
WHERE nombre2 like '%$nombre2%'
 ";
 } else if($_POST['escoje']=="apellido1" AND $_POST['apellido1']){
 $sSQL= "SELECT *
  FROM
medicos
WHERE apellido1 like '%$apellido1%'
 ";
 } else if($_POST['escoje']=="apellido2" AND $_POST['apellido2']){
 $sSQL= "SELECT *
  FROM
medicos
WHERE apellido2 like '%$apellido2%'
 ";
 } else if($_POST['escoje']=="apellido3" AND $_POST['apellido3']){
 $sSQL= "SELECT *
  FROM
medicos
WHERE apellido3 like '%$apellido3%'
 ";
 }
 
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];?>
      <td height="24" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <input name="numMedico" type="Submit" class="style12" id="numMedico" value="<?php echo $myrow['numMedico'];?>" 
		 />
     </span></td>
      <td width="226" bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];?></span></td>
      <td width="52" bgcolor="<?php echo $color;?>" class="style12"><div align="center"><img src="pregunta.png" alt="
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
    <?php  }}}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  </span></span>
</form>
<p>&nbsp; </p>
</body>
</html>