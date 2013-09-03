<?php include("/configuracion/conf.php"); ?> 
 
 <SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-brown.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 



<?php
$modulo = 'altaConvenios.conv';
$checaModuloScript= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo = '".$modulo."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>

<?php require("conexion.php");  ?>

<?php

 $fechaInicio = $_POST['fechaInicial'];
 $fechaFinal = $_POST['fechaFinal'];
$fechaInicio1 = str_replace('/','',$fechaInicio);
$fechaFinal1 = str_replace('/','',$fechaFinal);
//echo $fechaInicio1=trim($fechaInicio1);
//echo "\n";
//echo $fechaFinal1=trim($fechaFinal1);
if($_POST['agregar']){
if(trim($fechaInicio1) < trim($fechaFinal1)){
if($_POST['numCliente'] AND $_POST['articulo'] AND $fechaInicio AND $fechaFinal){
$agrega = "INSERT INTO convenios (
numCliente,articulo,signo,cp,descuento,fechaInicial,fechaFinal,usuario,fecha1,ip) 
values ('".$_POST['numCliente']."','".$_POST['articulo']."','".$_POST['signo']."','".$_POST['cp']."',
'".$_POST['descuento']."',
'".$fechaInicio."','".$fechaFinal."','".$usuario."','".$fecha1."','".$ip."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
convenio_agregado();
} else {
campos_vacios();
}
} else {
no_coinciden();
}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <h1 align="center">ALTA DE CONVENIOS (Materiales) </h1>
  <table width="861" border="1" align="center" class="style12">
    <tr>
      <th width="1" rowspan="7" scope="col">&nbsp;</th>
      <th width="177" bgcolor="#660066" scope="col"><div align="left" class="style13">
          CCliente:
      
      </div></th>
      <th width="661" scope="col"> <div align="left">
        <?php 
	 
$sSQL1= "Select * From clientes ORDER BY nomCliente ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 

echo mysql_error();
	  ?>
        <select name="numCliente" class="style12" id="numCliente">
          
          <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
          <option value="<?php echo $myrow1['numCliente']; ?>"><?php echo $myrow1['numCliente']."-->".$myrow1['nomCliente']; ?></option>
          <?php } 
		
		?>
          </select>
      </div></th>
    </tr>
    <tr>
      <td height="34" bgcolor="#660066"><span class="style13">
          <label>
          <div align="left" class="style13">Art&iacute;culo:</div>
          <span class="style13">
          </label>
      </span></td>
      <td><div align="left">
        <?php 
	 
$sSQL2= "Select * From articulos ORDER BY descripcion ASC ";
$result2=mysql_db_query($basedatos,$sSQL2); 

echo mysql_error();
	  ?>
        <select name="articulo" class="style12" id="articulo">
         
          <?php  	 		 
		   while($myrow2 = mysql_fetch_array($result2)){ ?>
          <option value="<?php echo $myrow2['codigo']; ?>"><?php echo $myrow2['descripcion']; ?></option>
          <?php } 
		
		?>
          </select>
      </div></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#660066">&nbsp;</td>
 
    </tr>
    <tr>
      <td bgcolor="#660066"><div align="left" class="style13">
        <p>Descuento</p>
      </div></td>
      <td><label>
      <select name="signo" class="style12" id="signo">
        <option value="-">- (menos)</option>
        <option value="+">+ (mas)</option>
      </select>
      <select name="cp" class="style12" id="cp">
        <option value="porcentaje">Porcentaje</option>
        <option value="cantidad">cantidad</option>
        </select>
      <input name="descuento" type="text" class="style12" id="descuento" onKeyPress="return checkIt(event)" size="5" maxlength="5"/>
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Inicial (Optional):</div></td>
      <td><div align="left">
        <label>
        <input name="fechaInicial" type="text" class="style12" id="campo_fecha" size="20" readonly=""/>
        </label>
        <input name="button" type="button" class="style12" id="lanzador" value="..." />
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Final (Optional): </div></td>
      <td><div align="left">
          <label></label>
          <label></label>
          <label></label>
          <label>
          <input name="fechaFinal" type="text" class="style12" id="campo_fecha1" size="20" readonly=""/>
          </label>
          <input name="button1" type="button" class="style12" id="lanzador1" value="..." />
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#660066">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="55" colspan="3"><label>
        <div align="center">
          <input name="agregar" type="submit" class="style12" id="agregar" value="Agregar Convenio" />
          <input name="Submit2" type="reset" class="style12" value="Reset" />
        </div>
      </label></td>
    </tr>
  </table>
</form>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :       "%Y-%m-%d [%W] %H:%M",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :      "%Y-%m-%d [%W] %H:%M",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>
<?php } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/menuPrincipal.php">';
exit;

}
?>