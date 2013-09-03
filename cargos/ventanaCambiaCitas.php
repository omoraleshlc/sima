<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php

if($_POST['numeroE'] and $_POST['actualizarCita']){

$sSQL102= "SELECT *
FROM
clientesInternos
WHERE entidad='".$entidad."' and
almacenSolicitud='".$_POST['almacenDestino1']."'
and
horaSolicitud='".$_POST['codHora']."'
and
fechaSolicitud='".$_POST['fechaSolicitud']."'
and
status!='cancelado'
";

$result102=mysql_db_query($basedatos,$sSQL102);
$myrow102 = mysql_fetch_array($result102);

if($myrow102['numeroE']){
echo 'La fecha de reservacion ya esta asignada a otra persona';
} else {
$q1 = "UPDATE clientesInternos set 
horaSolicitud = '".$_POST['codHora']."',
fechaSolicitud='".$_POST['fechaSolicitud']."',
almacenSolicitud='".$_POST['almacenDestino1']."'
WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
echo 'SE MODIFICO LA CITA PARA ESTE PACIENTE';
echo '<script type="text/vbscript">
msgbox "SE MODIFICO LA CITA PARA ESTE PACIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
self.close();
  // -->
</script>';
} 
}



$sSQL10= "SELECT *
FROM
clientesInternos
WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' or keyClientesInternos='".$_POST['keyClientesInternos']."'
";

$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
?>

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-win2k-2.css" title="win2k-cold-1" /> 
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
<table width="502" border="0" align="center" class="style12">
    <tr>
      <th colspan="3" class="style12 style14" scope="col"><span class="style14 style15">HORA <?php echo $myrow10['horaSolicitud'];?></span></th>
    </tr>
    <tr>
      <th colspan="3" bgcolor="#660066" class="style12 style14" scope="col"><div align="left" class="style13">M&eacute;dico: </div>        <div align="left"></div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">+</th>
      <th width="228" class="style12" scope="col"><div align="left">Nombre</div></th>
      <th width="240" class="style12" scope="col"><label>
        <div align="left">
		
<?php 
$aCombo= "Select almacen,descripcion From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$_GET['almacen']."' 
and
medico='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
<select name="almacenDestino1" class="style12" id="almacenDestino1" onChange="javascript:this.form.submit();"/>        


	   
	   <option value="">EN LISTA DE ESPERA</option><option value="">------</option>
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
		
        <option 
		<?php if(($resCombo['almacen']==$_POST['almacenDestino1']) or ($resCombo['almacen']==$_GET['medico']))echo 'selected=""'; ?>
		
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
        </div>
      </label></th>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#660066" class="style16">Paciente:</td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td>N&uacute;mero de Expediente: </td>
      <td><input name="numeroE" type="text" class="Estilo24" id="numeroE" 
		  value="<?php 
		
		  echo $myrow10['numeroE'];
	
		  ?>" readonly=""/></td>
    </tr>
    <tr>
	
	
	
      <td class="style12">&nbsp;</td>
      <td>Nombre de la Persona: </td>
      <td>
      <?php 
		
		  echo $myrow10['paciente'];
		
		  ?>
      <input name="paciente" type="hidden" class="Estilo24" id="paciente" value="<?php 
		
		  echo $myrow10['paciente'];
		
		  ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td>Hora:</td>
      <td>
	  

	        <?php //*********HORAS
if($myrow10['fechaSolicitud']==$_POST['fechaSolicitud'] or !$_POST['fechaSolicitud']){
$fechaSol=$myrow10['fechaSolicitud'];
} else {
$fechaSol=$_POST['fechaSolicitud'];
}
	

$sSQL7= "Select distinct * From citas WHERE entidad='".$entidad."' order by idCita ASC";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();


	  ?>
          <select name="codHora" class="Estilo24" id="gpoProducto1" >
		  <option value="">---</option>
            <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ 
		   
	$sSQL101= "SELECT *
FROM
clientesInternos
WHERE 
almacenSolicitud='".$_POST['almacenDestino1']."'
and
 fechaSolicitud='".$fechaSol."'
and
 horaSolicitud='".$myrow7['codHora']."'

";

$result101=mysql_db_query($basedatos,$sSQL101);
$myrow101= mysql_fetch_array($result101);
		   if($myrow101['status']=='reservar' or $myrow101['status']=='pendiente'){
		   $stat=$myrow101['paciente'];
		   } else {
		   $stat='Disponible';
		   }
		   ?>
            <option 
		    <?php 		if($_POST['codHora']==$myrow7['codHora'] or $myrow7['codHora']==$myrow10['horaSolicitud'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codHora']; ?>"><?php echo $myrow7['codHora']." - ".$stat; ?></option>
            <?php } 
		
		?>
        </select>
	  </td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td><span class="Estilo24">Cita/Hora:</span></td>
      <td><span class="Estilo25">
        <input name="fechaSolicitud" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud']){
	  echo $fecha2=$_POST['fechaSolicitud'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="10" readonly="" onChange="javascript:this.form.submit();"/>
      </span><span class="Estilo25">
      <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
      </span></td>
    </tr>
    <tr>
      <td height="16" colspan="3"><label>
        <div align="center">
          <input name="actualizarCita" type="submit" class="Estilo24" id="actualizarCita" value="Modificar Cita " />
 <input name="keyClientesInternos" type="hidden" class="Estilo24" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
        </div>
      </label></td>
    </tr>
  </table>
<p>&nbsp;</p>
</form>

<p>&nbsp;</p>
</body>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
</html>