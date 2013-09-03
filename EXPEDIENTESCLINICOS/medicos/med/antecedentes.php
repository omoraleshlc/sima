<?PHP include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
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
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
}   
  
  
  
  
</script> 
<script language=javascript> 
function ventanaSecundaria21 (URL){ 
   window.open(URL,"ventana21","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria22 (URL){ 
   window.open(URL,"ventana22","width=700,height=600,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria23 (URL){ 
   window.open(URL,"ventana23","width=700,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria24 (URL){ 
   window.open(URL,"ventana24","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria25 (URL){ 
   window.open(URL,"ventana25","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria26 (URL){ 
   window.open(URL,"ventana26","width=700,height=600,scrollbars=YES") 
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
<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script>




<?php //************************ACTUALIZO PRECIOS**********************

if($_POST['numeroOrden']){
$keyCAP=$_POST['numeroOrden'];
$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
keyCAP='".$keyCAP."' ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
} else {
if(!$_POST['numeroE']){
$_POST['numeroE']=$_GET['numeroE'];
}
}
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];

$q1 = "UPDATE cargosCuentaPaciente set 
statusCargo='cargado'

WHERE numeroE='".$numeroE."' and nCuenta='".$nCuenta."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
//*************************************************
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style13 {color: #FFFFFF}
.style7 {font-size: 9px}
-->
</style>
</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
.style23 {color: #0000FF}
.style24 {
	font-weight: bold;
	color: #990099;
}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
-->
</style>
<h1 align="center">Expediente Cl&iacute;nico</h1>
<form id="form2" name="form2" method="post" action="">
  <table width="513" border="0" align="center" class="Estilo24">
    <tr>
      <th width="12" class="Estilo24" scope="col">+</th>
      <th colspan="2" bgcolor="#660066" class="style14" scope="col">Datos Generales del Paciente</th>
    </tr>
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left">N&uacute;mero de Orden: </div></th>
      <th class="style12 style23 style24" scope="col"><div align="left"><?php 
		 echo $keyClientesInternos=$myrow3['keyClientesInternos'];
		  ?>
</label></div>      </th>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left">N&uacute;mero de Expediente: </div></th>
      <th class="Estilo24" scope="col"><div align="left" class="style24">
          <?php $existeNE=$myrow3['numeroE'];
		   $sSQL31= "Select * From pacientes WHERE numCliente = '".$existeNE."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
		 if($myrow31['numCliente']){
		 echo $nExpediente=$myrow31['numCliente'];
		 } else {
		 echo "Sin Expediente";
		 }
		  ?>
      </div></th>
    </tr>
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left"><strong>M&eacute;dico: </strong></div></th>
      <th class="Estilo24" scope="col"><div align="left" class="style24">
          <label> <?php echo $medico=$myrow3['medico']; ?> </label>
          <label> </label>
          <?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$medico."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php echo $dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?> </div></th>
    </tr>
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <th width="136" class="Estilo24" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="488" class="Estilo24" scope="col"><div align="left" class="style24">
          <label> </label>
          <?php echo $paciente=$myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Seguro: </td>
      <td class="Estilo24"><span class="style24">
        <label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
        <?php
$sSQL212= "SELECT *
FROM
clientes
WHERE 
numCliente='".$traeSeguro."'
 ";
 $result212=mysql_db_query($basedatos,$sSQL212);
$myrow212 = mysql_fetch_array($result212);

?>
        <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
        </label>
      </span></td>
    </tr>
<?php


?>
	
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">N&deg; Credencial: </td>
      <td class="Estilo24"><span class="style24"><?php echo $myrow3['credencial']; ?></span> </td>
    </tr>
    <tr>
      <td height="16" colspan="3" bgcolor="#660066">&nbsp;</td>
    </tr>
    <tr>
      <td height="33" colspan="3"><label>
        <div align="center">
            <label></label>
            <label>
			
          <a href="#"
onclick="javascript:ventanaSecundaria21('antecedentesAnteriores.php?numPaciente=<?php echo $nExpediente; ?>&keyCAP=<?php echo $keyCAP; ?>&medico=<?php echo $medico; ?>&almacen=<?php echo $bebeAli; ?>&seguro=<?php echo $traeSeguro; ?>&numeroE=<?php echo $numeroE; ?>')" >Antecedentes Anteriores</a>
          
      <a href="#"
onclick="javascript:ventanaSecundaria22('dxActuales.php?keyClientesInternos=<?php echo $keyClientesInternos; ?>&keyCAP=<?php echo $keyCAP; ?>&medico=<?php echo $medico; ?>&almacen=<?php echo $bebeAli; ?>&seguro=<?php echo $traeSeguro; ?>&numeroE=<?php echo $nCliente; ?>')" />Antecedentes Actuales</a>
          
       


          </label>
        </div>
        </label></td>
    </tr>
  </table>
  <p><input name="paso_bandera1" type="hidden" id="paso_bandera1" value="<?php echo $bandera; ?>" />
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>" />
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" />
    <input name="numeroE" type="hidden" id="numeroE" value="<?php echo $nCliente; ?>" />
  </p>
</form>
<h1 align="center">&nbsp;</h1>
</body>
</html>
