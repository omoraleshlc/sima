<?php include("/configuracion/ventanasEmergentes.php"); ?>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-green.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 

<script language="javascript" type="text/javascript">  
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
}   
   
</script> 
<?php
if($_POST['numMedico']){
$medico = $_POST['numMedico'];
} else if($_POST['numMedico1']){
$medico = $_POST['numMedico1'];
} else if($_POST['numMedico2']){
$medico = $_POST['numMedico2'];
} 
else{
$medico = $myrow11['numMedico'];
}

/* if(!$_POST['numMedico'] ){
no_hay_medico();
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaCitas.php">';
exit;

} */

if($_POST['hora']){
$hora = $_POST['hora'];
} else if($_POST['hora1']){
$hora = $_POST['hora1'];
} else if($_POST['hora2']){
$hora = $_POST['hora2'];
} 
else{
$hora = $myrow11['hora'];
}

$sSQL15= "Select * From clientesAmbulatorios,catCitas WHERE catCitas.hora = '".$hora."' 
and 
catCitas.keyHora=clientesAmbulatorios.cita
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15);
$_POST['numeroE']=$myrow15['numeroE'];


$sSQL11= "Select * From citas WHERE numMedico = '".$_POST['numMedico']."'
AND  hora = '".$hora."' ";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
?>
<?php
$sSQL14= "SELECT *
  FROM
clientesAmbulatorios
WHERE numeroE ='".$_POST['numeroE']."'
 ";

$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);
$ali=$myrow14['almacen'];
?>
<?php

$sSQL10= "SELECT *
  FROM
medicos
WHERE numMedico ='".$medico."'
 ";

$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);


/* if($_POST['numPaciente']){
echo "paso";
echo $q = "UPDATE citas set 
numPaciente='".$_POST['numPaciente']."'
WHERE 
hora ='".$hora."'
AND
numMedico = '".$medico."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
cita_insertado();
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaCitas.php">';
exit;
} */



if($_POST['borrar'] AND $_POST['numMedico']){
$borrame = "DELETE FROM medicos WHERE numMedico ='".$_POST['numMedico']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
dr_borrado();
$_POST['numMedico']="";
}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['numMedico']="";
/* $sSQL2= "Select max(numMedico) as tope From medicos";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
 $torpe = $myrow2['tope']; */
}

if($_POST['numeroE'] and $_POST['actualizarCita']){
$sSQL15= "SELECT *
FROM
clientesAmbulatorios
WHERE numeroE ='".$_POST['numeroE']."'
and
cita = '".$_POST['cita']."'
and
medico='".$_POST['numMedico']."'
and
fecha='".$_POST['fecha']."'
";

$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15);
$fechas=$myrow15['fecha'];

if(!$fechas){

$q1 = "UPDATE clientesAmbulatorios set 
cita = '".$_POST['cita']."'
WHERE 
medico='".$_POST['numMedico']."'

AND
almacen='".$ali."'
AND 
numeroE='".$_POST['numeroE']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE MODIFICO LA CITA PARA ESTE PACIENTE"
</script>';
} else {
echo '<script type="text/vbscript">
msgbox "ESA FECHA YA ESTA OCUPADA"
</script>';
} 

/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaCitas.php">';
exit; */

} 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style14 {
	color: #0000FF;
	font-weight: bold;
}
.style15 {font-size: 36px}
.Estilo24 {font-size: 10px}
-->
</style>
</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
.style16 {
	font-size: 10px;
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<body>
<h1 align="center">Agregar/Modificar Cita </h1>
<form id="form1" name="form1" method="post" action="">
<table width="502" border="1" align="center" class="style12">
    <tr>
      <th colspan="3" class="style12 style14" scope="col"><span class="style14 style15">HORA <?php echo $hora;?></span></th>
    </tr>
    <tr>
      <th colspan="2" bgcolor="#660066" class="style12 style14" scope="col"><div align="left" class="style13">M&eacute;dico: </div></th>
      <th class="style12" scope="col"><div align="left">
        <input name="numMedico" type="text" class="style12" id="numMedico" value="<?php echo $medical=$myrow10['numMedico']; ?>" size="60" 
	  readonly=""/>
      </div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">+</th>
      <th width="228" class="style12" scope="col"><div align="left">Nombre1 :</div></th>
      <th width="240" class="style12" scope="col"><label>
        <div align="left">
          <input name="nombre1" type="text" class="style12" id="nombre1" value="<?php echo $myrow10['nombre1']; ?>" size="60"  readonly=""/>
        </div>
      </label></th>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Apellido1:</td>
      <td class="style12"><input name="apellido1" type="text" class="style12" id="apellido1" value="<?php echo $myrow10['apellido1']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Apellido2:</td>
      <td class="style12"><input name="apellido2" type="text" class="style12" id="apellido2" value="<?php echo $myrow10['apellido2']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">C&eacute;dula:</td>
      <td class="style12"><input name="cedula" type="text" class="style12" id="cedula" value="<?php echo $myrow10['cedula']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#660066" class="style16">Paciente:</td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td>N&uacute;mero de Expediente: </td>
      <td><input name="numeroE" type="text" class="Estilo24" id="numeroE" 
		  value="<?php 
		 if($_POST['numeroE']){  
		  echo $_POST['numeroE'];
		}
		  ?>" readonly=""/></td>
    </tr>
    <tr>
	
	
	
      <td class="style12">&nbsp;</td>
      <td>Nombre de la Persona: </td>
      <td><input name="paciente" type="text" class="Estilo24" id="paciente" value="<?php 
		  if($myrow14['paciente']){
		  echo $myrow14['paciente'];
		  } 
		  ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td>Fecha:</td>
      <td><span class="Estilo24">
        <input name="fecha" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php 
	  if($_POST['fecha']){
	  echo $_POST['fecha'];
	  } else if($myrow14['fecha']){
	  echo $myrow14['fecha'];
	  }
	  ?>" size="9" readonly="" onChange="javascript:this.form.submit();"/>
        <label>
        <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
        </label>
      </span></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td><span class="Estilo24">Cita/Hora:</span></td>
      <td><strong>
        <?php

if($_POST['numMedico'] OR $_POST['fecha']!=$fecha1){

/* $sqlNombre21= "SELECT distinct * FROM `MedicosCitas`
where
codMedico = '".$_POST['medico']."'
AND
fecha ='".$hoy."'
and
codhora ='".$_POST['cita']."'
and
status ='ocupada' ";
$resultaNombre21=mysql_db_query($basedatos,$sqlNombre21);
$rNombre21=mysql_fetch_array($resultaNombre21);
$fecha_hoy=$rNombre21['fecha']; */


$sSQL19= "
SELECT distinct * FROM `MedicosCitas`
where
codMedico = '".$_POST['numMedico']."'

order by
codHora ASC
";
} 
$resultaNombre19=mysql_db_query($basedatos,$sSQL19);
?>
        <select name="cita" class="Estilo24" id="cita" />
     
<?php
while ($myrow19 = mysql_fetch_array($resultaNombre19)){
$cita=$myrow19['codHora'];
if($_POST['fecha']){
$sqlNombre21= "SELECT distinct * FROM clientesAmbulatorios
where
medico = '".$_POST['numMedico']."'
AND
almacen ='".$ali."'
and
cita ='".$cita."'
and
fecha='".$_POST['fecha']."'
";
} else {
$sqlNombre21= "SELECT distinct * FROM clientesAmbulatorios
where
medico = '".$_POST['numMedico']."'
AND
almacen ='".$ali."'
and
cita ='".$cita."'
and
fecha='".$fecha1."'
";

}
$resultaNombre21=mysql_db_query($basedatos,$sqlNombre21);
$rNombre21=mysql_fetch_array($resultaNombre21);
$fecha_hoy=$rNombre21['codHora'];
?>
        <option value="<?php echo $myrow19["codHora"];?>">
        <?php
if($myrow19['hora']){
if($rNombre21['paciente']){
echo $myrow19['hora']." || ".$rNombre21['paciente'];
//echo $sqlNombre21;
} else {
//echo $sqlNombre21;
echo $myrow19['hora']." || "."Disponible";
}} else {
echo 'No tiene ninguna hora definida!';
}
//echo $presto;
?>
        </option>
        <?php } ?>
        <input name="hora" type="hidden" id="hora" value="<?php echo $hora; ?>" />
      </strong></td>
    </tr>
    <tr>
      <td height="16" colspan="3"><label>
        <div align="center">
          <input name="actualizarCita" type="submit" class="Estilo24" id="actualizarCita" value="Modificar Cita " />
        </div>
      </label></td>
    </tr>
  </table>
<p>&nbsp;</p>
</form>
<p>&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
<p>&nbsp;</p>
</body>
</html>