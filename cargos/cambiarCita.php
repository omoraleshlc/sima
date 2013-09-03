<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php 



if($_POST['cambiar'] AND $_POST['keyCAP']){ 

 $sSQL12= "
SELECT *
FROM
cargosCuentaPaciente
WHERE 

fechaSolicitud='".$_POST['fechaSolicitud']."' 
and
horaSolicitud='".$_POST['codHora']."'
and
almacen='".$_POST['almacen']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);

if(!$myrow12['numeroE']){
 $agrega = "UPDATE cargosCuentaPaciente set 
almacenDestino='".$_POST['almacen']."',
horaSolicitud='".$_POST['codHora']."',
fechaSolicitud='".$_POST['fechaSolicitud']."'

where
keyCAP='".$_POST['keyCAP']."' ";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

?>
<script>
close();
   </script>
   <script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<?php 
} else {
echo '<blink>'.'Ya está ocupada esa fecha'.'</blink>';
}

} ?>
<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.Estilo26 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
    </style>
</head>

<body>
    <p>&nbsp;</p>
    <form name="form1" id="form1" method="post" action="">
      <table width="200" border="0" align="center">
        <tr>
          <td><span class="Estilo26">Fecha</span></td>
          <td><span class="Estilo25">
            <input name="fechaSolicitud" type="text" class="Estilo25" id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud']){
	  echo $fecha2=$_POST['fechaSolicitud'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="10" readonly="" onchange="javascript:this.form.submit();"/>
          </span><span class="Estilo25">
          <input name="button" type="button" class="Estilo25" id="lanzador" value="..." />
          </span></td>
        </tr>
        <tr>
          <td width="55"><span class="Estilo26">Cambiar A</span></td>
          <td width="135"><span class="Estilo26">
            <?php 
$sqlNombre11 = "Select distinct * From citas order by idCita ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);
?>
            <select name="codHora" class="Estilo25" id="select4"  onChange="javascript:enviar();">
              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
              <option
 
   value="<?php echo $rNombre11["codHora"];?>"><?php echo $rNombre11['codHora'];?></option>
              <?php } ?>
            </select>
          </span></td>
        </tr>
        <tr>
          <td><input name="cambiar" type="submit" class="Estilo26" id="cambiar" value="Cambiar" /></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <p>
        <input name="keyCAP" type="hidden" id="keyCAP" value="<?php echo $_GET['keyCAP'];?>">
        <input name="fecha2" type="hidden" id="fecha2" value="<?php echo $_GET['fecha2'];?>">
        <input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>">
      </p>
    </form>
  <p>&nbsp;</p>
        <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
</body>
</html>
