<?php include("/configuracion/ventanasEmergentes.php"); include("/configuracion/funciones.php"); ?>

<?php
$almacen=$_GET['almacenDestino'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoDespliegaFecha=$_GET['campoDespliegaFecha'];
$numeroE=$_GET['numeroE'];
$nCuenta=$_GET['nCuenta'];

?>
<script type="text/javascript">
	function regresar(horaSolicitud,fechaSolicitud){
		
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = horaSolicitud;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliegaFecha;?>.value = fechaSolicitud;
		close();
	}
</script>
<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
-->
</style>
</head>

<body>
<p align="center">
<?php 
$sSQL112= "
SELECT descripcion
FROM
almacenes
WHERE entidad='".$entidad."' AND
almacen='".$almacen."'";
$result112=mysql_db_query($basedatos,$sSQL112);
$myrow112 = mysql_fetch_array($result112); 
echo $myrow112['descripcion'];
?>
&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="224" border="0" align="center">
    <tr>
      <th width="83" scope="col"><div align="left"><span class="Estilo25">Fecha</span></div></th>
      <th width="131" scope="col"><span class="Estilo25">
        <label></label>
        </span>
          <div align="left"><span class="Estilo25">
      <input name="fechaSolicitud" type="text" class="Estilo25" id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud']){
	  echo $_POST['fechaSolicitud'];
	  } else {
	  echo $fecha1; 
	  } ?>" size="10" readonly="" onChange="javascript:this.form.submit();"/>
            </span><span class="Estilo25">
            <input name="button" type="button" class="Estilo25" id="lanzador" value="..." />
        </span></div></th>
    </tr>
  </table>
  
  
  
  <table width="330" border="0" align="center">
    <tr>
      <th width="57" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Hora</span></div></th>
      <th width="201" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Paciente</span></div></th>
      <th width="58" bgcolor="#660066" scope="col"><div align="left"><span class="style11">StatusCargo</span></div></th>
    </tr>
    <tr>
<?php 

	 
$sSQL11= "Select distinct * From citas order by idCita ASC";

$result11=mysql_db_query($basedatos,$sSQL11);
	

while($myrow11 = mysql_fetch_array($result11)){ 
$horaSolicitud=$myrow11['codHora'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
if(!$_POST['fechaSolicitud'])$_POST['fechaSolicitud']=$fecha1;
$sSQL12= "
SELECT horaSolicitud,fechaSolicitud,numeroE,statusCargo
FROM
cargosCuentaPaciente
WHERE 
almacen='".$almacen."'
AND
fechaSolicitud='".$_POST['fechaSolicitud']."' 
and
horaSolicitud='".$horaSolicitud."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$numeroE=$myrow12['numeroE'];

if($numeroE){
$sSQL112= "
SELECT paciente,tipoPaciente
FROM
clientesInternos
WHERE 
numeroE='".$numeroE."'";
$result112=mysql_db_query($basedatos,$sSQL112);
$myrow112 = mysql_fetch_array($result112); 
if($myrow112['paciente']){
if($myrow112['tipoPaciente']=='externo'){
$paciente=$myrow112['paciente'];
} else {
$sSQL121= "
SELECT *
FROM
pacientes
WHERE 
numCliente='".$numeroE."' 
";
$result121=mysql_db_query($basedatos,$sSQL121);
$myrow121 = mysql_fetch_array($result121);
$paciente=$myrow121['nombre1']." ".$myrow121['nombre2']." ".$myrow121['apellido1']." ".$myrow121['apellido2']." ".$myrow121['apellido3'];
}} else { $paciente='';}

} else {
$paciente='';
}
//****************************Terminan las validaciones
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24">
	  <span class="style12">
	  <span class="style7">
	  <?php 
	  if($paciente){
	  echo $myrow11['codHora'];
	  } else { ?>
	  <a href="javascript:regresar('<?php echo $myrow11['codHora']; ?>','<?php echo $_POST['fechaSolicitud']; ?>');"><?php echo $myrow11['codHora'];  ?></a>
	 <?php } ?>
	  </span></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24">
      <?php 
	  if($paciente){
	  echo $paciente; 
	  } else {
	  echo 'Libre';
	  }
	  ?>&nbsp;</td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">

	  <?php echo $myrow12['statusCargo'] ?>
      </span></td>
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>
