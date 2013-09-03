<?php include("/configuracion/conf.php"); ?>
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.porcentajeCliente.value) == false ) {   
                alert("Por Favor, escribe el porcentaje del cliente que debe pagar!")   
                return false   
        } else if( vacio(F.porcentajeSeguro.value) == false ) {   
                alert("Por Favor, escribe el porcentaje del seguro!")   
                return false   
        } else if( vacio(F.fechaInicial.value) == false ) {   
                alert("Por Favor, escoje la fecha inicial!")   
                return false   
        } else if( vacio(F.fechaFinal.value) == false ) {   
                alert("Por Favor, escoje la fecha Final!")   
                return false   
        } else if( vacio(F.nombreConvenio.value) == false ) {   
                alert("Por Favor, escoje el nombre del convenio!")   
                return false   
        }           
}   
  
  
  
  
</script> 
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
$checaModuloScript= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo = '".$modulo."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>

<?php require("conexion.php");  ?>

<?php


if($_POST['agregar']){

$agrega = "INSERT INTO conveniosGenerales (
numCliente,porcentajeCliente,porcentajeSeguro,fechaInicial,fechaFinal,usuario,fecha1,nombreConvenio) 
values ('".$_POST['numCliente']."','".$_POST['porcentajeCliente']."','".$_POST['porcentajeSeguro']."',
'".$_POST['fechaInicial']."','".$_POST['fechaFinal']."',
'".$usuario."','".$fecha1."','".$_POST['nombreConvenio']."')";
mysql_db_query($basedatos,$agrega);
echo '<script type="text/vbscript">
msgbox "CONVENIO AGREGADO"
</script>';
}


if($_POST['borrar2'] AND $_POST['elimina']){
$elimina=$_POST['elimina'];
foreach($elimina as $i=>$eliminando){
$borrame = "DELETE FROM conveniosGenerales WHERE keyConveniosGenerales = '".$elimina[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL CONVENIO"
</script>';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
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
<form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);">
  <h1 align="center">ALTA DE CONVENIOS (Globales) </h1>
  <table width="615" border="1" align="center" class="style12">
    <tr>
      <th width="3" scope="col">&nbsp;</th>
      <th width="327" bgcolor="#660066" scope="col"><div align="left" class="style13">
          CCliente:
      
      </div></th>
      <th width="263" scope="col"><div align="left"><span class="Estilo24">
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
      <th width="3" scope="col">&nbsp;</th>
	  <?php 
	 
$sSQL12= "Select distinct * From clientes Where numCliente='".$_POST['numCliente']."' ";
$result12=mysql_db_query($basedatos,$sSQL12); 
$myrow12 = mysql_fetch_array($result12);
echo mysql_error();
	  ?>
      <td colspan="2" bgcolor="#660066"><div align="center" class="style13"><?php echo $myrow12['nomCliente']; ?></div></td>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style13">% a pagar por el Cliente:</span></td>
      <td><input name="porcentajeCliente" type="text" class="style12" id="porcentajeCliente" size="2" maxlength="2" value="<?php
	  if($_POST['porcentajeCliente']>0 and $_POST['porcentajeCliente'] <100){
	  echo $_POST['porcentajeCliente'];
	  }
	  ?>"
	  onkeypress="return checkIt(event)"
	  onchange="javascript:this.form.submit();"
	  /></td>
    </tr>
    <tr>
      <th width="3" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">
        <p>% a pagar por el Seguro:</p>
      </div></td>
      <td><label>
	  <?php
	  $diferiencia=100-$_POST['porcentajeCliente'];
	  ?>
        <input name="porcentajeSeguro" type="text" class="style12" id="porcentajeSeguro" size="2" maxlength="2" value="<?php echo $diferiencia; ?>"
	  onKeyPress="return checkIt(event)" />
      </label></td>
    </tr>
    <tr>
      <th width="3" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Inicial del Convenio:</div></td>
      <td><div align="left">
        <label>
        <input name="fechaInicial" type="text" class="style12" id="campo_fecha" size="20" readonly="" value="<?php
		if($_POST['fechaInicial']){
		echo $_POST['fechaInicial'];
		}
		?>"/>
        </label>
        <input name="button" type="button" class="style12" id="lanzador" value="..." />
      </div></td>
    </tr>
    <tr>
      <th width="3" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Final del Convenio: </div></td>
      <td><div align="left">
          <label></label>
          <label></label>
          <label></label>
          <label>
          <input name="fechaFinal" type="text" class="style12" id="campo_fecha1" size="20" readonly="" value="<?php 
		  if($_POST['fechaFinal']){
		echo $_POST['fechaFinal'];
		}
		  ?>"/>
          </label>
          <input name="button1" type="button" class="style12" id="lanzador1" value="..." />
      </div></td>
    </tr>
    <tr>
      <th width="3" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style13">Nombre del Convenio: </span></td>
      <td><label>
        <input name="nombreConvenio" type="text" class="style12" id="nombreConvenio" size="50" />
      </label></td>
    </tr>
    <tr>
      <td height="55" colspan="3"><label>
        <div align="center">
          <input name="agregar" type="submit" class="style12" id="agregar" value="Agregar Convenio" />
          <label></label>
          <input name="Submit2" type="reset" class="style12" value="Reset" />
        </div>
      </label></td>
    </tr>
  </table>
</form>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :       "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :       "%Y-%m-%d",    // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script> 
 <form id="form2" name="form2" method="post" action="">
   <table width="705" border="1" align="center">
     <tr>
       <th width="99" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">C&oacute;digo</span></th>
       <th width="238" bgcolor="#660066" class="style12" scope="col"><span class="Estilo24"><span class="style11 style13">Descripci&oacute;n</span></span></th>
       <th width="87" bgcolor="#660066" class="style12" scope="col"><span class="Estilo24"><span class="style11 style13">Nivel/Cantidad</span></span></th>
       <th width="86" bgcolor="#660066" class="style12" scope="col"><span class="Estilo24"><span class="style11 style13">Porcentaje</span></span></th>
       <th width="46" bgcolor="#660066" class="style12" scope="col"><span class="Estilo24"><span class="style11 style13">F. Inicial</span></span></th>
       <th width="46" bgcolor="#660066" class="style12" scope="col"><span class="Estilo24"><span class="style11 style13">F. Final </span></span></th>
       <th width="57" bgcolor="#660066" class="style12" scope="col"><span class="Estilo24"><span class="style11 style13">Elimina</span></span></th>
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

if($_POST['numCliente']){
while($myrow = mysql_fetch_array($result)){ 

$codigo=$myrow['codigooGP'];
$checaModuloScript2= "Select * from articulos WHERE codigo = '".$codigo."' ";
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
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
         <label>
         <span class="Estilo24"><span class="style11 style13">
         <?php $C=$myrow['codigooGP'];?>
         </span></span>
         <input name="Submit" type="submit" class="style12" value="<?php echo $C?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
	  <?php 
	  if($resulScripModulo2['descripcion']){
	  echo $resulScripModulo2['descripcion'];
	  } else {
	  echo "Grupo de Precio";
	  }
	  ?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
<?php 
if($myrow['cantidadoPorcentaje']=='yes'){
echo "$".number_format($myrow['niveloCantidad'],2);
} else {
echo '---';
}
?></span></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
<?php 
if($myrow['cantidadoPorcentaje']=='no'){
echo $myrow['niveloCantidad'];
} else {
echo "---";
}
?></span></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
         <?php 
	  echo $myrow['fechaInicial'];
	 // echo $myrow2['existencias'];
	 
	  ?>
       </span></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><label><span class="Estilo24"><span class="style7"><?php echo $myrow['fechaFinal'];
	 
	  ?></span></span></label></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
         <input name="elimina[]" type="checkbox" id="elimina[]" value="<?php echo $myrow['keyConveniosGenerales'];?>" />
       </span></td>
     </tr>
     <?php } }?>
   </table>
   <p align="center">
     <input name="borrar2" type="submit" class="style12" id="borrar2" value="Eliminar Convenio" />
   </p>
 </form>
</body>
</html>
<?php } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/menuPrincipal.php">';
exit;

}
?>