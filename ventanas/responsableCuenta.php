<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?PHP include("/configuracion/funciones.php"); ?>
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
           
        if( vacio(F.nombrePaciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.deposito.value) == false ) {   
                alert("Por Favor, escribe el depósito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el médico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el límite que desees asignar!")   
                return false   
        }   
}   
  
</script>

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=220,height=250,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
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
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Está Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>

<?php


if($_GET['keyClientesInternos'] and $_POST['transferir'] ){













$q = "UPDATE clientesInternos set 

tipoResponsable='Familiar',

nombreResponsable='".strtoupper($_POST['nombreResponsable'])."',
apaternoResponsable='".strtoupper($_POST['apaternoResponsable'])."',
amaternoResponsable='".strtoupper($_POST['amaternoResponsable'])."',
direccionResponsable='".strtoupper($_POST['direccionResponsable'])."',
telefonoResponsable='".$_POST['telefonoResponsable']."',
ocupacionResponsable='".strtoupper($_POST['ocupacionResponsable'])."',

parentescoResponsable='".strtoupper($_POST['parentescoResponsable'])."'

WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
//*************************

//echo 'SE TRANSFIRIO LA CUENTA DEL PACIENTE';
?>
<script>
window.alert( "ACTUALIZARON DATOS");
opener.location.reload(true);
window.close();
</script>
<?php 
}







$sSQL7= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$NUMEROE=$myrow7['numeroE'];

 $sSQL32= "Select * From pacientes WHERE numCliente = '".$NUMEROE."'";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);

$nombrePaciente = $myrow32['nombre1']." ".$myrow32['nombre2']." ".$myrow32['apellido1']." ".
$myrow32['apellido2']." ".$myrow32['apellido3'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>

<h1 align="center">Responsable del Paciente</h1>

<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
<table width="500" class="table-forma">

      <tr valign="middle" >
        <th colspan="2" ><div align="center" >Datos del Paciente </div></th>
      </tr>
      <tr valign="middle"  >
        <td width="153" ><div align="left" >Nombre del Paciente</div></td>
        <td width="487" ><label>
       <?php echo $myrow7['paciente'];?>
        </label></td>
      </tr>
	  
	 
	  
	  
	  
	  
	  
	  
	  

      <tr valign="middle" >
        <td >Parentesco </td>
        <td ><input name="parentescoResponsable" type="text"  id="parentescoResponsable" size="60" 
		value="<?php echo $myrow7['parentescoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr valign="middle" >
        <td >Nombre</td>
        <td ><input name="nombreResponsable" type="text"  id="nombreResponsable" size="60" 
		value="<?php echo $myrow7['nombreResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr valign="middle" >
        <td >Apellido Paterno</td>
        <td ><input name="apaternoResponsable" type="text"  id="apaternoResponsable" size="60" 
		value="<?php echo $myrow7['apaternoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr valign="middle" >
        <td >Apellido Materno</td>
        <td ><input name="amaternoResponsable" type="text"  id="amaternoResponsable" size="60" 
		value="<?php echo $myrow7['amaternoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr valign="middle" >
        <td >Direcci&oacute;n</td>
        <td ><textarea name="direccionResponsable" cols="57"   id="direccionResponsable"><?php echo $myrow7['direccionResponsable'];?></textarea></td>
      </tr>
      <tr valign="middle" >
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr valign="middle" >
        <td >Tel&eacute;fono</td>
        <td ><input name="telefonoResponsable" type="text"  id="telefonoResponsable" size="60" 
		value="<?php echo $myrow7['telefonoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr valign="middle" >
        <td >Ocupaci&oacute;n</td>
        <td ><input name="ocupacionResponsable" type="text"  id="ocupacionResponsable" size="60" 
		value="<?php echo $myrow7['ocupacionResponsable'];?>"/></td>
      </tr>
	 
	  
	  
	  
	  
	  
	  
	  
	  

	  
	  
	  
	


    </table><br />
<label>
          <input name="transferir" type="submit"  id="transferir" value="Actualizar Datos" />
          <br />
        <br />
        </label>
</form>
  <p align="center" >&nbsp;</p>
<p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
     
</body>
</html>