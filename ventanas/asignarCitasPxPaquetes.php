<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php




if($_POST['numeroE'] and $_POST['actualizarCita']){

$sSQL102a= "SELECT keyClientesInternos
FROM
almacenesPaquetes
WHERE 
id_almacen='".$_GET['medico']."'
and
horaSolicitud='".$_POST['codHora']."'
and
fechaSolicitud='".$_POST['date']."'
and
status!='cancelado'
";

$result102a=mysql_db_query($basedatos,$sSQL102a);
$myrow102a = mysql_fetch_array($result102a);


$sSQL102= "SELECT numeroE
FROM
clientesInternos
WHERE entidad='".$entidad."' and
 almacenSolicitud='".$_GET['medico']."'
 and
 horaSolicitud='".$_POST['codHora']."'
 and
 fechaSolicitud='".$_POST['date']."'
 and
 status!='cancelado'
";

$result102=mysql_db_query($basedatos,$sSQL102);
$myrow102 = mysql_fetch_array($result102);


if($myrow102['numeroE'] or $myrow102a['keyClientesInternos']){
echo '<blink>'.'La fecha de reservacion ya esta asignada a otra persona'.'</blink>';
} else {





//date='".$_POST['date']."'
$q1 = "UPDATE cargosCuentaPaciente set 
horaSolicitud = '".$_POST['codHora']."',
fechaSolicitud = '".$_POST['date']."'

WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'
and
almacenDestino='".$_GET['medico']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();

$q1a = "UPDATE clientesInternos set 
statusExpediente='request',expediente='si',confirmaCita='si',fechaSolicitud= '".$_POST['date']."',
almacenSolicitud='".$_GET['medico']."'
WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'
";
mysql_db_query($basedatos,$q1a);
echo mysql_error();

echo 'SE MODIFICO LA CITA PARA ESTE PACIENTE';
echo '<script type="text/vbscript">
window.alert("SE MODIFICO LA CITA PARA ESTE PACIENTE");
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
//self.close();
  // -->
</script>';
} 
}



$sSQL10= "SELECT * from clientesInternos where keyClientesInternos='".$_GET['keyClientesInternos']."' ";

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
<?php
$estilos= new muestraEstilos();
$estilos-> styles();
?>


<body>

<h1 align="center" >Agregar/Modificar Cita </h1>
<form id="form1" name="form1" method="post" action="">
<table width="502" border="0" align="center" >
    <tr>
      <td  colspan="3"  scope="col"><img src="../../imagenes/btns/clock.png" width="34" height="34" /><br />
      <?php echo 'Hora de la venta: '.$myrow10['horaSolicitud'];?></td>
    </tr>
    <tr>
      <td  colspan="3"   scope="col"><h1>M&eacute;dico:    </h1> <label>
        <div align="left">
		
<?php 
$aCombo= "Select almacen,descripcion From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacen='".$_GET['medico']."' 
and
medico='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo);
$resCombo = mysql_fetch_array($rCombo);

	
echo $resCombo['descripcion'];

?>
        </div>
      </label></td>
    </tr>
     <tr>
      <td colspan="3"  ><h1>Paciente:</h1></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >N&uacute;mero de Expediente: </td>
      <td><input name="numeroE" type="text" class="camposmid" id="numeroE" 
		  value="<?php 
		
		  echo $myrow10['numeroE'];
	
		  ?>" readonly=""/></td>
    </tr>
    <tr>
	
	
	
      <td >&nbsp;</td>
      <td >Nombre de la Persona: </td>
      <td><input name="paciente" type="text" class="camposmid" id="paciente" value="<?php 
		
		  echo $myrow10['paciente'];
		
		  ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td height="30" >&nbsp;</td>
      <td >Hora:</td>
      <td>
	  

<?php //*********HORAS






if($myrow10['fechaSolicitud']==$_POST['date'] or !$_POST['date']){
$fechaSol=$myrow10['fechaSolicitud'];
} else {
$fechaSol=$_POST['date'];
}
	

$sSQL7= "Select distinct * From citas WHERE entidad='".$entidad."' order by idCita ASC";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();




	  ?>
          <select name="codHora" class="camposmid" id="gpoProducto1" >
		  <option value="">---</option>
            <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ 
		   
$sSQL101a= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
almacenDestino='".$_GET['medico']."'
and
 fechaSolicitud='".$myrow10['fechaSolicitud']."'
and
 horaSolicitud='".$myrow7['codHora']."'

";

$result101a=mysql_db_query($basedatos,$sSQL101a);
$myrow101a= mysql_fetch_array($result101a);

	   
$sSQL101= "SELECT *
FROM
clientesInternos
WHERE 
status!='cancelado'
and
almacenSolicitud='".$_GET['medico']."'
and
 fechaSolicitud='".$fechaSol."'
and
 horaSolicitud='".$myrow7['codHora']."'

";

$result101=mysql_db_query($basedatos,$sSQL101);
$myrow101= mysql_fetch_array($result101);




           if($myrow101['status']=='reservar' or $myrow101['status']=='pendiente'){
		   $stat=$myrow101['paciente'];
		   } else if($myrow101a['status']){
		   $sSQL101b= "SELECT paciente
FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow101a['keyClientesInternos']."'

";

$result101b=mysql_db_query($basedatos,$sSQL101b);
$myrow101b= mysql_fetch_array($result101b);
		   $stat=$myrow101b['paciente'];
		   } else {
		   $stat='Disponible';
		   }
		
		   ?>
            <option 
		    <?php 		if($_POST['codHora']==$myrow7['codHora'] or $myrow7['codHora']==$myrow10['horaSolicitud'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codHora']; ?>"><?php echo $myrow7['codHora']." - ".$stat; ?></option>
            <?php } 
		
		?>
        </select>	  </td>
    </tr>
    <tr>
      <td height="47" >&nbsp;</td>
      <td valign="top" >&nbsp;</td>
      <td valign="top"><span class="Estilo25">
        <input name="date" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php 
	  if($_POST['date']){
	  echo $fecha2=$_POST['date'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="10" readonly="" onChange="javascript:this.form.submit();"/>
      </span><span class="Estilo25">
      <input name="button" type="button"  id="lanzador" value="..." />
      
      </span></td>
    </tr>
    <tr>
      <td height="65" colspan="3"><label>
        <div align="center">
          
          <input name="actualizarCita" type="submit" id="actualizarCita" value="Modificar Cita " />
 <input name="keyClientesInternos" type="hidden" class="Estilo24" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
  <input name="almacenDestino1" type="hidden" class="Estilo24" id="almacenDestino1" value="<?php echo  $_GET['medico'];?>" />
  <input name="almacenSolicitud" type="hidden" class="Estilo24" id="almacenSolicitud" value="<?php echo  $_GET['medico'];?>" />
        </div>
      </label></td>
    </tr>
  </table>
</form>

</body>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
</html>