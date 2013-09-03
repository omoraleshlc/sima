<?php require('/configuracion/ventanasEmergentes.php');?>

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
  
<script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventana9","width=700,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<?php 
if($_POST['actualizar'] and $_POST['horaSolicitud'] and $_POST['fechaSolicitud']){ 
$q = "UPDATE cargosCuentaPaciente 
set 
horaSolicitud='".$_POST['horaSolicitud']."', 
fechaSolicitud='".$_POST['fechaSolicitud']."'



WHERE 
keyCAP='".$_GET['keyCAP']."' ";

mysql_db_query($basedatos,$q);
echo mysql_error();
?>

<script>

window.opener.document.forms["form1"].submit();
self.close();

</script>
<?php }?>

<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>


<?php 
$sSQL3= "SELECT 
horaSolicitud,fechaSolicitud
FROM cargosCuentaPaciente
WHERE keyCAP ='".$_GET['keyCAP']."'";

$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>
<body >
<form name="form1" method="post" action="">
  <h1 >Cambiar Fecha y Hora para Atenci&oacute;n ></h1>
  <table width="364"  class="table-forma">
    <tr>
      <td  scope="col"><div align="left"><span >Fecha del Estudio </span></div></td>
      <td  scope="col"><div align="left"><span >
        <?php 
	  if($_POST['fechaSolicitud']){
	  $fechaD= $_POST['fechaSolicitud'];
	  } else {
	  $fechaD= $fecha1; 
	  } ?>
        <input name="fechaSolicitud" type="text"  id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud']){
	  echo $_POST['fechaSolicitud'];
	  } else {
	  echo $fecha1; 
	  } ?>" size="10" readonly="" onChange="javascript:this.form.submit();"/>
        </span><span >
        <input name="button" type="button"  id="lanzador" value="..." />
      </span></div></td>
    </tr>
    <tr>
      <td width="152"  scope="col"><div align="left"><span >Hora de Estudio</span></div></td>
      <td width="195"  scope="col"><div align="left"><span >
          <label>
          <select name="horaSolicitud" class='style71' id="horaSolicitud" >
          <?php if($myrow3['horaSolicitud']){ ?>
		   <option value="<?php echo $myrow3['horaSolicitud']; ?>" ><?php echo $myrow3['horaSolicitud']; ?></option>
		   <option value="">---</option>
            <?php } ?>
            <option value="01:00 AM" >01:00 AM</option>
            <option value="02:00 AM" >02:00 AM</option>
            <option value="03:00 AM" >03:00 AM</option>
            <option value="04:00 AM" >04:00 AM</option>
            <option value="05:00 AM" >05:00 AM</option>
            <option value="06:00 AM" >06:00 AM</option>
            <option value="07:00 AM" >07:00 AM</option>
            <option value="08:00 AM" >08:00 AM</option>
            <option value="09:00 AM" >09:00 AM</option>
            <option value="10:00 AM" >10:00 AM</option>
            <option value="11:00 AM" >11:00 AM</option>
            <option value="12:00 AM" >12:00 AM</option>
            <option value="01:00 PM" >01:00 PM</option>
            <option value="02:00 PM" >02:00 PM</option>
            <option value="03:00 PM" >03:00 PM</option>
            <option value="04:00 PM" >04:00 PM</option>
            <option value="05:00 PM" >05:00 PM</option>
            <option value="06:00 PM" >06:00 PM</option>
            <option value="07:00 PM" >07:00 PM</option>
            <option value="08:00 PM" >08:00 PM</option>
            <option value="09:00 PM" >09:00 PM</option>
            <option value="10:00 PM" >10:00 PM</option>
            <option value="11:00 PM" >11:00 PM</option>
            <option value="12:00 PM" >12:00 PM</option>
          </select>
          </label>
      </span></div></td>
    </tr>
    <tr>
      <td scope="col">&nbsp;</td>
      <td scope="col"><span >
        <label></label>
        </span></td>
    </tr>
  </table>
 <p align="center" >
     <a href="javascript:ventanaSecundaria9('ventanaDespliegaPacientes.php?keyCAP=<?php echo $myrow['keyCAP']; ?>&almacenDestino=<?php echo $_GET['almacenDestino']; ?>&fechaSolicitud=<?php echo $fechaD; ?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&numeroExpediente=<?php echo $myrow112['numeroE']; ?>&seguro=<?php echo $_POST['seguro']; ?>&firstTime=<?php echo $firstTime;?>')">
  Ver lista de Pacientes 
  </a>
  </p>
  <p align="center"><label>
    <input name="actualizar" type="submit" class="style71" id="actualizar" value="Aplicar Fecha">
    </label></p>
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