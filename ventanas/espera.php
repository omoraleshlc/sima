<?php require("/configuracion/ventanasEmergentes.php"); ?>

<?php 

if($_POST['almacenDestino1']=='espera' or !$_POST['numeroE']){
$status='reservar';
$expediente='no';
}else{
$expediente='si';
$status='pendiente';
}


if($_POST['paciente'] and $_POST['actualizarCita']){

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

if(!$myrow102['numeroE']){
 $agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,almacenSolicitud,horaSolicitud,fechaSolicitud,telefono,expediente,paquete
) values (
'".$_POST['numeroE']."','".$nCuenta."',
'".$_POST['medico']."',
'".strtoupper($_POST['paciente'])."',
'".$_GET['seguro']."',
'".$_GET['autoriza']."',
'".$_GET['credencial']."',
'".$fecha1."',
'".$hora1."',
'reservar',
'".$_GET['cita']."',
'".$_GET['almacen']."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_GET['medicoForaneo']."','".strtoupper($_GET['observaciones'])."','".$_GET['edad']."','externo',
'".$nOrden."','reservar','".$_GET['dependencia']."','".$entidad."','".$_POST['almacenDestino1']."','".$_POST['codHora']."','".$_POST['fechaSolicitud']."','".$_POST['telefono']."','".$expediente."','no'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$sSQL1= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
usuario='".$usuario."'
order by keyClientesInternos Desc
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); 
$keyClientesI=$myrow1['keyClientesInternos']; ?>
<script>
alert("El paciente: <?php echo $_POST['paciente'];?> fue agregado");
window.close();
</script>
<?php 
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

echo '<script >
alert( "SE MODIFICO LA CITA PARA ESTE PACIENTE");

</script>';

} 
}




?>




    <?php 
	  if($_POST['fechaSolicitud']){
	   $fecha2=$_POST['fechaSolicitud'];
	  } else {
	   $fecha2=$fecha1; 
	  } ?>

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-win2k-2.css" title="win2k-cold-1" /> 
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 
  <script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=600,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
  <script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=660,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


  <script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventana9","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<?php 

$sSQL10= "SELECT *
FROM
clientesInternos
WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' or keyClientesInternos='".$_POST['keyClientesInternos']."'
";

$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

</head>

<?php 
$estilo= new muestraEstilos();
$estilo->styles();

?>


<body>


<form id="form1" name="form1" method="post" action="" class="form-horizontal">
  <p>&nbsp;</p>
  

    <div class="control-group">

  <h1><span >En lista de Espera</span></h1>
  
  <div class="control-group">

  <span ><?php echo $myrow10['horaSolicitud'];?></span>
 Paciente
     <input name="paciente" type="text"  id="paciente" value="<?php 
		
		  echo $myrow10['paciente'];
		
		  ?>" size="60" />
    
    </div>
    
<div class="control-group">
 Tel&eacute;fono
      <input name="telefono" type="text"  id="telefono" 
		  value="<?php 
		
		  echo $myrow10['telefono'];
	
		  ?>" />
  

    </div>
    
    
<div class="control-group">
   <span >Cita/Hora</span>
     <span >
        <input name="fechaSolicitud" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php 
	  echo $fecha2;
	  ?>" size="10" readonly="" onChange="javascript:this.form.submit();"/>
      </span><span >
      <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
      </span>



<br /><br />

    <input name="keyClientesInternos2" type="hidden" class="Estilo24" id="keyClientesInternos2" value="<?php echo $_GET['keyClientesInternos'];?>" />
    <input name="actualizarCita" type="submit" class="Estilo24" id="actualizarCita" value="Agregar/Modificar Cita " />
    <input name="keyClientesInternos" type="hidden" class="Estilo24" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
 

  </div>
</div>
</form>


</body>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script>
</html>