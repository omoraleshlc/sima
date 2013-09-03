<?PHP include("/configuracion/ingresoshlcmenu/menuingresoshlc.php"); ?>
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

$fechaInicio = $_POST['fechaInicial'];
$fechaFin = $_POST['fechaFinal'];


if($_POST['actualizar'] and $_POST['codigo2']){

$sSQL1= "Select * From convenios WHERE articulo = '".$_POST['codigo2']."'
AND numCliente = '".$_POST['numCliente1']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$q = "UPDATE convenios set 
signo='".$_POST['signo']."', 
cp='".$_POST['cp']."', 
descuento='".$_POST['descuento']."', 
fechaInicial='".$_POST['fechaInicial']."', 
fechaFinal='".$_POST['fechaFinal']."'
WHERE 
gpoProducto='".$_POST['codigo2']."'
AND
numCliente = '".$_POST['numCliente1']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
convenio_actualizado();
}


if($_POST['borrar'] AND $_POST['codigo2']){
$borrame = "DELETE FROM convenios WHERE codigo ='".$_POST['codigo2']."' AND numCliente = '".$_POST['numCliente2']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
borrado();
}



if($_POST['gpoProducto']){ 
$sSQL12= "SELECT 
*
FROM
convenios
WHERE gpoProducto= '".$_POST['gpoProducto']."'
AND numCliente = '".$_POST['numCliente1']."'";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12); //cierro si es numerico
}


if($_POST['borrar'] || $_POST['actualizar']){
$sSQL= "SELECT 
*
FROM
  `articulos`
   WHERE gpoProducto = '".$_POST['codigo2']."'
  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
 $sSQL1= "SELECT 
*
FROM
  `convenios`
   WHERE gpoProducto = '".$_POST['gpoProducto']."'
 AND numCliente = '".$_POST['numCliente1']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); 
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
<form id="form3" name="form3" method="post" action=""/>
  <p>&nbsp;</p>
  <table width="523" border="1" align="center" class="style12">
    <tr>
      <th width="2" rowspan="8" scope="col">&nbsp;</th>
      <th bgcolor="#660066" scope="col"><span class="style13">N.Cliente</span></th>
      <th colspan="2" scope="col"><label>
        <div align="left">
          <input name="numCliente" type="text" class="style12" id="numCliente" 
		  value="<?php echo $myrow12['numCliente']; ?>" readonly="" />
        </div>
      </label></th>
    </tr>
    <tr>
      <th width="156" bgcolor="#660066" scope="col"><div align="left" class="style13">
          <?php if(!$_POST['nuevo']){ ?>
C&oacute;digo Producto:
<?php } ?>
      </div></th>
      <th colspan="2" scope="col"><label>
          <div align="left">
            <input name="codigo2" type="text" class="style12" id="codigo" value="<?php 
				 if($myrow['gpoProducto']){
				  echo $myrow['gpoProducto'];
				  $read = "readonly";
				  } else {
				  echo $_POST['gpoProducto'];
				  }
				  ?>" readonly=""/>
          </div>
        </label></th>
    </tr>
    <tr>
      <td height="95" bgcolor="#660066"><span class="style13">
          <label>
          <div align="left" class="style13">Descripci&oacute;n:</div>
        <span class="style13">
          </label>
      </span></td>
      <td width="177"><label>
          <div align="left">
<?php
$sSQL2= "SELECT 
*
FROM
gpoProductos
WHERE codigoGP = '".$_POST['gpoProducto']."'
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2); 
echo mysql_error();
$describe = $myrow2['descripcionGP'];

?>
            <textarea name="descripcion" cols="40" rows="6" class="style12" id="descripcion" readonly="readonly">
<?php echo $describe;?>			
    </textarea>
          </div>
      </label></td>
      <td width="160">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#660066">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#660066"><div align="left" class="style13">Descuento:</div></td>
      <td colspan="2"><label>
          <div align="left">
            <select name="signo" class="style12" id="signo">
			<option value="<?php echo $myrow12['signo'];?>"><?php echo $myrow12['signo']; ?></option>
              <option>Cantidad</option>
              <option value="+">+ (mas)</option>
              <option value="-">- (menos)</option>
            </select>
            <select name="cp" class="style12" id="cp">
			<option value="<?php echo $myrow12['cp'];?>"><?php echo $myrow12['cp']; ?></option>
              <option value="porcentaje">Porcentaje</option>
              <option value="cantidad">cantidad</option>
            </select>
            <input name="descuento" type="text" class="style12" id="descuento" value="<?php 
echo $myrow12['descuento']; ?>" size="5" maxlength="5" onKeyPress="return checkIt(event)"/>
          </div>
        </label></td>
    </tr>
	
	
    <tr>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Inicial :</div></td>
      <td colspan="2"><div align="left">
        <label>
        <input name="fechaInicial" type="text" class="style12" id="campo_fecha" size="20" readonly=""
		value="<?php echo $myrow12['fechaInicial'];?>"/>
        </label>
        <input name="button" type="button" class="style12" id="lanzador" value="..." />
</div></td>
    </tr>
    <tr>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Final </div></td>
      <td colspan="2"><div align="left">
          <label></label>
          <label></label>
          <label>
          <input name="fechaFinal" type="text" class="style12" id="campo_fecha1" size="20" readonly=""
		  value="<?php echo $myrow12['fechaFinal'];?>"/>
</label>
          <input name="button1" type="button" class="style12" id="lanzador1" value="..." />
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#660066"><div align="left"><span class="style13"></span></div></td>
      <td colspan="2"><div align="left">
          <label>
          <div align="right">
            <label>
            <div align="center">
              <input name="borrar" type="submit" class="style12" id="borrar" value="Borrar" />
              <input name="actualizar" type="submit" class="style12" id="actualizar" value="Actualizar/Grabar" />
            </div>
            </label>
            <div align="center"></div>
          </div>
        </label>
      </div></td>
    </tr>
    <tr>
      <td height="55" colspan="4"><span class="style7">
        <input name="numCliente1" type="hidden" id="numCliente1" value="<?php echo $_POST['numCliente1']; ?>" />
      </span></td>
    </tr>
</table>
  <p align="center">&nbsp;</p>
  <form id="form1" name="form1" method="post" action="">
    <table width="449" border="1" align="center">
    <tr>
      <th width="193" class="style12" scope="col"> N&uacute;mero de Cliente </th>
      <th width="355" scope="col"><label>
        <div align="left"><span class="style12">
          <?php 
	 $sqlNombre = "SELECT  * From clientes ORDER BY numCliente ASC";
$resultaNombre=mysql_db_query($basedatos,$sqlNombre);
	  
	  
	  
	  ?>
          <select name="numCliente" class="style12" id="numCliente"  onChange="javascript:this.form.submit();" />
          
          <?php if($_POST['numCliente']){ ?>
          <option value="<?php echo $_POST['numCliente']; ?>"><?php echo $_POST['numCliente']; ?></option>
          <?php } else { ?>
          <option></option>
          <?php } ?>
          <?php
			  while ($rNombre=mysql_fetch_array($resultaNombre)){ ?>
          <option value="<?php echo $rNombre['numCliente']; ?>"><?php echo $rNombre['numCliente']."-->".$rNombre['nomCliente']; ?></option>
          <?php } ?>
          </span></div>
      </label></th>
    </tr>
    <tr>
      <th height="42" scope="col">&nbsp;</th>
      <th scope="col"><div align="left"><span class="style12">
        </select>
        </span>
          <?php 
	 $sqlNombre1 = "SELECT  * From clientes WHERE numCliente = '".$_POST['numCliente']."' ORDER BY numCliente ASC";
$resultaNombre1=mysql_db_query($basedatos,$sqlNombre1);
	  $rNombre1=mysql_fetch_array($resultaNombre1);
	    
	  ?>
          <input name="nomCliente" type="text" class="style12" id="nomCliente" size="60" value="<?php 
	  if($_POST['numCliente']){
	  echo $rNombre1['nomCliente']; }?>" readonly=""/>
</div>
      <label></label></th>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<form id="form2" name="form2" method="post" action="" >
  <table width="570" border="1" align="center">
    <tr>
      <th width="200" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Grupo de Productos </span></th>
      <th width="170" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Descuento</span></th>
      <th width="90" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Fecha Inicial</span></th>
      <th width="82" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Fecha Final </span></th>
    </tr>
    <tr>
      <?php	

$cliente = $_POST['nomCliente'];
$sSQL= "SELECT 
*
FROM
  convenios
WHERE
 gpoProducto IS NOT NULL
 AND
 numCliente = '".$_POST['numCliente']."'
 ";
$result=mysql_db_query($basedatos,$sSQL);
?>

<?php 
if($_POST['numCliente']){
while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
if($myrow['gpoProducto']){

?>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label>
        <input name="gpoProducto" type="submit" class="style12" id="gpoProducto" value="<?php echo $myrow['gpoProducto'];?>" />
        </label>
        <input name="numCliente1" type="hidden" id="numCliente1" value="<?php echo $_POST['numCliente']; ?>" />
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descuento'];?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
       
	    <?php  
	  echo $myrow['fechaInicial'];
	 // echo $myrow2['existencias'];
	 
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php echo $myrow['fechaFinal'];
	 
	  ?>
      </span></td>
    </tr>
    <?php }} }?>
  </table>
</form>
<p>&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :      "%Y-%m-%d [%W] %H:%M",    // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :       "%Y-%m-%d [%W] %H:%M",    // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>
