<?php require("/configuracion/ventanasEmergentes.php"); ?><?php require("/configuracion/funciones.php"); ?>
<?php 



if($_POST['cambiar'] AND $_GET['keyCAP']){ 

$iva=new articulosDetalles();
$iva=$iva->iva('1',$_POST['codigo'],$_POST['precioVenta'],$basedatos);  

$agrega = "UPDATE cargosCuentaPaciente set 
motivo='".$_POST['motivo']."',
precioVenta='".$_POST['precioVenta']."',iva='".$iva."',
cantidadParticular='".$_POST['precioVenta']."',ivaParticular='".$iva."',
usuarioModificaPV='".$usuario."'

where
keyCAP='".$_GET['keyCAP']."' ";

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
<style type="text/css">
<!--
.style72 {color: #0000FF}
-->
</style>
  <style type="text/css">
    .popup_effect1 {
      background:#11455A;
      opacity: 0.2;
    }
    .popup_effect2 {
      background:#FF0041;
      border: 3px dashed #000;
    }
    
  </style>	
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
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
      <table width="286" border="0" align="center">
        <tr>
          <td><span class="Estilo26 style72">Precio Actual </span></td>
          <td><span class="style72">
          <?php 
		  
		   $sSQL12= "
SELECT precioVenta
FROM
cargosCuentaPaciente
WHERE 

keyCAP='".$_GET['keyCAP']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
		  echo "$".number_format($myrow12['precioVenta'],2);
		  ?>
          &nbsp;</span></td>
        </tr>
        <tr>
          <td width="69"><span class="Estilo26">Precio Nuevo </span></td>
          <td width="207"><label>
            <input name="precioVenta" type="text" class="Estilo26" id="precioVenta">
          </label></td>
        </tr>
        <tr>
          <td><span class="Estilo26">Motivo</span></td>
          <td><label>
            <textarea name="motivo" id="motivo"></textarea>
          </label></td>
        </tr>
        <tr>
          <td><input name="cambiar" type="submit" class="Estilo26" id="cambiar" value="Cambiar" 
		 onclick="openDialog3(this)" /></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <p>
        <input name="keyCAP" type="hidden" id="keyCAP" value="<?php echo $_GET['keyCAP'];?>">
        <input name="codigo" type="hidden" id="codigo" value="<?php echo $_GET['codigo'];?>">
        <input name="keyCAP" type="hidden" id="keyCAP" value="<?php echo $_GET['keyCAP'];?>">
      </p>
    </form>

  <p>&nbsp;</p>

</body>
</html>
