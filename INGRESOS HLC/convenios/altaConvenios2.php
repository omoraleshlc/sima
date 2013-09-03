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
$modulo = 'altaConvenios1.conv';
$checaModuloScript= "Select distinct * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo = '".$modulo."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>


<?php

 $fechaInicio = $_POST['fechaInicial'];
 $fechaFinal = $_POST['fechaFinal'];
$fechaInicio1 = str_replace('/','',$fechaInicio);
$fechaFinal1 = str_replace('/','',$fechaFinal);
//echo $fechaInicio1=trim($fechaInicio1);
//echo "\n";
//echo $fechaFinal1=trim($fechaFinal1);




if($_POST['agregar']){

if(trim($fechaInicio) > trim($fechaFinal)){

$sql5= "
SELECT *
FROM
  `conveniosGenerales`  
WHERE
numCliente =  '".$_POST['numCliente']."'
AND codigooGP ='".$_POST['codigooGP']."'

";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

if($myrow5['numCliente'] !=$_POST['numCliente'] AND 
$myrow5['codigooGP']!=$_POST['codigooGP'] AND $fechaInicio AND $fechaFinal){
if($_POST['cantidadoPorcentaje']=='no'){
}

$agrega = "INSERT INTO conveniosGenerales (
numCliente,codigooGP,niveloCantidad,cantidadoPorcentaje,fechaInicial,fechaFinal,usuario,fecha1,ip) 
values ('".$_POST['numCliente']."','".$_POST['codigooGP']."','".$_POST['niveloCantidad']."',
'".$concatena."',
'".$fechaInicio."','".$fechaFinal."','".$usuario."','".$fecha1."','".$ip."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGÓ EL CONVENIO"
</script>';
} else {
echo '<script type="text/vbscript">
msgbox "ESE CONVENIO YA EXISTE!"
</script>';
}
} else {
echo '<script type="text/vbscript">
msgbox "REVISA BIEN TU FECHA FINAL, ES MENOR A LA FECHA INICIAL!"
</script>';
}
}



if($_POST['borrar'] AND $_POST['numCliente1']){
if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM conveniosGenerales WHERE keyConvenios = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}$leyenda = "Se eliminó el modulo ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['numCliente']){
$leyenda = "Por favor, escoja el nombre de numCliente que desee eliminar..!";
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL CONVENIO!"
</script>';
}

if($_POST['numCliente']){
$numCliente=$_POST['numCliente'];
} else if($_POST['numCliente1']){
$numCliente=$_POST['numCliente1'];
$_POST['numCliente']=$numCliente;
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
-->
</style>
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
  <h1 align="center">ALTA DE CONVENIOS (Grupo de Productos) </h1>
  <table width="672" border="1" align="center" class="style12">
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <th width="126" bgcolor="#660066" scope="col"><div align="left" class="style13">CCliente: </div></th>
      <th width="305" scope="col"><div align="left"><span class="Estilo24">
        <?php 
	 
$sSQL1= "Select distinct * From clientes ORDER BY nomCliente ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 

echo mysql_error();
	  ?>
        <select name="numCliente" class="Estilo24" id="numCliente" onChange="javascript:this.form.submit();"/>
        
       
        <?php 		if($_POST['numCliente']){ ?>
        <option value="<?php echo $_POST['numCliente']; ?>"><?php echo $_POST['numCliente']; ?></option>
        <?php } ?>
        <option value="">Escoje la Aseguradora/Cliente...</option>
        <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
        <option value="<?php echo $myrow1['numCliente']; ?>"><?php echo $myrow1['nomCliente']; ?></option>
        <?php } ?>
        </select>
      </span></div></th>
    </tr>
    <tr>
	<?php 
	 
$sSQL4= "Select distinct * From clientesGP,gpoProductos 
WHERE
clientesGP.numCliente='".$_POST['numCliente']."'
and
clientesGP.codigoGP=gpoProductos.codigoGP
ORDER BY clientesGP.codigoGP ASC ";
$result4=mysql_db_query($basedatos,$sSQL4); 
$myrow4 = mysql_fetch_array($result4);
echo mysql_error();
	  
	  ?>
	<?php if($myrow4['codigoGP']){ ?>
      <th width="1" scope="col">&nbsp;</th>
      <td height="34" bgcolor="#660066"><span class="style13">Grupo de Producto: </span></td>
      <td><?php 
	 
$sSQL1= "Select distinct * From clientesGP 
where
numCliente='".$_POST['numCliente']."'


ORDER BY codigoGP ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 

echo mysql_error();
	  ?>
        <select name="codigooGP" class="style12" id="codigooGP">
        
          <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
<option value="<?php echo $myrow1['codigoGP']; ?>"><?php echo $myrow1['descripcionGP']." || ".$myrow1['codigoGP']; ?></option>
          <?php } 
		
		?>
        </select></td>
		
		
		<?php } ?>
		
		
    </tr>
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td colspan="2" bgcolor="#660066">&nbsp;</td>
    </tr>
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">
        <p>Descuento:</p>
      </div></td>
      <td><label>
      <select name="signo" class="style12" id="signo">
        <option value="-">- (menos)</option>
        <option value="+">+ (mas)</option>
      </select>
      <select name="cantidadoPorcentaje" class="style12" id="cantidadoPorcentaje">
        <option value="no">Porcentaje</option>
        <option value="yes">cantidad</option>
      </select>
      <input name="niveloCantidad" type="text" class="style12" id="niveloCantidad" value="-1.15"
	  />
      </label></td>
    </tr>
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Inicial :</div></td>
      <td><div align="left">
        <label>
        <input name="fechaInicial" type="text" class="style12" id="campo_fecha" size="9" maxlength="9" readonly=""/>
        </label>
        <input name="button" type="button" class="style12" id="lanzador" value="..." />
      </div></td>
    </tr>
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Final </div></td>
      <td><div align="left">
          <label></label>
          <label></label>
          <label></label>
          <label>
          <input name="fechaFinal" type="text" class="style12" id="campo_fecha1" size="9" maxlength="9" readonly=""/>
          </label>
          <input name="button1" type="button" class="style12" id="lanzador1" value="..." />
      </div></td>
    </tr>
    <tr>
      <th width="1" scope="col">&nbsp;</th>
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
  <p>
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
  </script> 
     <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
  </script> 
</p>


  <form id="form2" name="form2" method="post" action="">
    <table width="705" border="1" align="center">
      <tr>
        <th width="99" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">C&oacute;digo</span></th>
        <th width="238" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">Descripci&oacute;n</span></th>
        <th width="87" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">Nivel/Cantidad</span></th>
        <th width="86" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">Porcentaje</span></th>
        <th width="46" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">F. Inicial</span></th>
        <th width="46" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">F. Final </span></th>
        <th width="57" bgcolor="#660066" class="Estilo24" scope="col"><span class="style11 style13">Elimina</span></th>
      </tr>
      <tr>
        <?php	

$cliente = $_POST['nomCliente'];
$sSQL= "SELECT 
 *
FROM
  `conveniosGenerales`

 WHERE numCliente = '".$_POST['numCliente']."'

 ";
$result=mysql_db_query($basedatos,$sSQL);
?>
        <?php 
if($_POST['numCliente']){
while($myrow = mysql_fetch_array($result)){ 

$codigo=$myrow['codigooGP'];
$checaModuloScript2= "Select * from articulos WHERE codigo = '".$codigo."' and activo is not null ";
$resScript2=mysql_db_query($basedatos,$checaModuloScript2);
$resulScripModulo2 = mysql_fetch_array($resScript2);
echo mysql_error();


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <label> <span class="style11 style13">
          <?php $C=$myrow['codigooGP'];?>
          </span>
          <input name="Submit" type="submit" class="Estilo24" value="<?php echo $C?>" />
          </label>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
	  if($resulScripModulo2['descripcion']){
	  echo $resulScripModulo2['descripcion'];
	  } else {
	  echo "Grupo de Precio";
	  }
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
if($myrow['cantidadoPorcentaje']=='yes'){
echo "$".number_format($myrow['niveloCantidad'],2);
} else {
echo '---';
}
?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
if($myrow['cantidadoPorcentaje']=='no'){
echo $myrow['niveloCantidad'];
} else {
echo "---";
}
?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
	  echo $myrow['fechaInicial'];
	 // echo $myrow2['existencias'];
	 
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><label><span class="style7"><?php echo $myrow['fechaFinal'];
	 
	  ?></span></label></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><input name="elimina[]" type="checkbox" id="elimina[]" value="<?php echo $myrow['keyConveniosGenerales'];?>" />
        </td>
      </tr>
      <?php } }?>
    </table>
    <p align="center">
      <input name="borrar" type="submit" class="Estilo24" id="borrar" value="Eliminar/Borrar" />
      <input name="numCliente1" type="hidden" id="numCliente1" value="<?php echo $numCliente; ?>" />
    </p>
  </form>
  <p>&nbsp;  </p>
</body>
 </html>
<?php } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/medsys/menuPrincipal.php">';

exit;

}
?>