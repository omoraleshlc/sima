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
  <p align="center" class="titulos"><strong>Formulario para Control de Antibi&oacute;ticos</strong></p>
  
  <table width="200" border="0" align="center" cellspacing="0" cellpadding="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p align="center" class="Estilo25">&nbsp;</p>
 <p align="center" class="Estilo25">&nbsp;</p>
 <p align="center" class="Estilo25">&nbsp;</p>
  <p align="center"><label>
    <input name="actualizar" type="submit" class="style71" id="actualizar" value="Guardar Registro">
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