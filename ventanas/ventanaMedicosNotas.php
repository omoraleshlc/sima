<?php include("/configuracion/ventanasEmergentes.php"); 
include("/configuracion/funciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 




<?php



if($_POST['aplicar'] and $_POST['descripcion'] ){


$agrega = "INSERT INTO medicosCitasCanceladas (
almacen,descripcion,fechaInicial,fechaFinal,usuario,fecha,entidad) 
values ('".$_POST['medico']."','".$_POST['descripcion']."',
'".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$usuario."','".$fecha1."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo '<script >
  <!--
window.alert( "Registro Agregado");
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>'; 

}

?>



<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-win2k-2.css" title="win2k-cold-1" /> 
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 


    <?php 
	  if($_POST['fechaInicial']){
	   $fecha2=$_POST['fechaInicial'];
	  } else {
	   $fecha2=$fecha1; 
	  } 
	  
	  if($_POST['fechaFinal']){
	   $fecha2=$_POST['fechaFinal'];
	  } else {
	   $fecha2=$fecha1; 
	  }
	  ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>


</head>

<body>

  <h1 align="center">Notas de Citas (S&oacute;lo Fecha Actual)</h1>
  <form id="form1" name="form1" method="post" action="">
    <p>&nbsp;</p>

    <table width="482" border="0" align="center" cellpadding="4" cellspacing="0" >
      <tr>
        <td width="75" height="37" bordercolor="1"  scope="col"><div align="left"><span class="normal">M&eacute;dico</span></div></td>
        <td width="392"  scope="col"><div align="left">
		
		<?php $sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_GET['id_medico']."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo $myrow1['descripcion'];
?>
          <input name="medico" type="hidden" class="Estilo24" id="medico" size="2" maxlength="2"
		 value="<?php echo $_GET['id_medico'];?>" />
      
          </div>
          <div align="left">
            <label></label>
          </div></td>
      </tr>
      <tr>
        <td ><span class="normal">Fecha Inicial</span></td>
        <td ><span class="Estilo25">
          <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php 
	  echo $fecha2;
	  ?>" size="10" readonly=""/>
        </span><span class="Estilo25">
        <input name="lanzador" type="button" class="Estilo24" id="lanzador" value="..." />
        </span></td>
      </tr>
      <tr>
        <td ><div align="left" class="normal">Fecha</div></td>
        <td ><span class="Estilo25">
          <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1"
	  value="<?php 
	  echo $fecha2;
	  ?>" size="10" readonly="" />
        </span><span class="Estilo25">
        <input name="button" type="button" class="Estilo24" id="lanzador1" value="..." />
        </span></td>
      </tr>
      <tr>
        <td ><div align="left" class="normal">Descripci&oacute;n:</div></td>
        <td ><label>
          <textarea name="descripcion" cols="40" class="Estilo24" id="descripcion"></textarea>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td height="33" >&nbsp;</td>
        <td ><input name="aplicar" type="submit" class="Estilo24" id="aplicar" value="Aplicar Nota" />
          <a href="javascript:ventanaSecundaria('despliegaGP.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="numCliente" type="hidden" class="Estilo24" id="numCliente" size="2" maxlength="2"
		 value="<?php echo $_GET['numCliente'];?>">
          </a></td>
      </tr>
    </table>

</form>

      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>

      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script>
 </body>
</html>