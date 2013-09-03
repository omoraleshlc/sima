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
                alert("Por Favor, escribe el dep�sito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el m�dico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el l�mite que desees asignar!")   
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
        status = "Este campo s�lo acepta n�meros."
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
var agree=confirm("Est� Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>

<?php


if($_GET['keyClientesInternos'] and $_POST['transferir']){

$q = "UPDATE clientesInternos set 
medico='".$_POST['medico']."',
autoriza='".$usuario."',

fecha='".$fecha1."',
hora='".$hora1."',
medicoForaneo='".strtoupper($_POST['medicoForaneo'])."',
especialidad='".strtoupper($_POST['especialidad'])."',
dx='".strtoupper($_POST['dx'])."',dxFinal='".strtoupper($_POST['dxFinal'])."',
edad='".$_POST['edad']."'
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
//*************************

//echo 'SE TRANSFIRIO LA CUENTA DEL PACIENTE';
?>
<script>
window.alert( "SE ACTUALIZARON DATOS");
opener.location.reload(true);
window.close();
</script>
<?php 
}







$sSQL7= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$NUMEROE=$myrow7['numeroE'];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>


<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>

<h1 align="center">Datos del Paciente</h1>

<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
    <table width="542" class="table-forma">

      <tr valign="middle"   >
        <th colspan="2" ><div align="center" ><b>Datos del Paciente</b> </div></th>
    </tr>
      <tr valign="middle"  >
        <td width="191" ><div align="left" ><b>Nombre del Paciente</b></div></td>
        <td width="451" ><label>
        <?php echo $myrow7['paciente'];?>
        </label>
          &nbsp;
          <input name="nombrePaciente1" type="hidden" id="nombrePaciente1" value="<?php echo $_POST['numPaciente'];?>"/>

          <input name="nCuenta" type="hidden"  id="nCuenta" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
        <input name="numeroE" type="hidden"  id="numeroE" value="<?php echo $numeroEs= $NUMEROE; ?>" readonly="" /></td>
      </tr>
	  
	  
      <tr >
        <td colspan="2"  ><div align="center"><b >M&eacute;dico Responsable del Internamiento </b></div></td>
      </tr>
      <tr >
      <tr valign="middle" >
        <td  ><label></label>
            </label>
            <label>
            <span >
            <div align="left" ><b >M&eacute;dico de Internamiento</b>
        </label>
        </div></td>
        <td  ><span ><label>
        <div align="left">
          <input name="medico" type="text"  id="medico"  value="<?php echo $myrow7['medico'];?>" size="60" />
        </div>
          </label>
          <div align="left"></div>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td  ><div align="left"><span >
        </span></div>          <span ><label></label>
          </label>
          <label> <span >
          <div align="left" ><b >M&eacute;dico For&aacute;neo </b></div>
        </label>
        </span></td>
        <td ><div align="left">
          <input name="medicoForaneo" type="text"  id="medicoForaneo"
		   value="<?php echo $myrow7['medicoForaneo'];?>" size="60" />
        </div></td>
      </tr>
      <tr valign="middle" >
        <td ><div align="left" ><b >Especialidad</b></div></td>
        <td ><div align="left">
          <input name="especialidad" type="text"  id="especialidad" value="<?php echo $myrow7['especialidad'];?>" size="60" />
        </div></td>
      </tr>
      <tr valign="middle" >
        <td height="47" ><div align="left" ><b >Diagn&oacute;stico Paciente </b></div></td>
        <td ><textarea name="dx" cols="57"  id="dx"><?php echo $myrow7['dx'];?></textarea></td>
      </tr>
      <tr valign="middle" >
        <td ><div align="left" ><b >Diagn&oacute;stico Final </b></div></td>
        <td ><div align="left">
          <p>
            <textarea name="dxFinal" cols="57"  id="dxFinal"><?php echo $myrow7['dxFinal'];?></textarea>
</p>
          </div></td>
      </tr>
	  
	  
	  
	  
	  
	  
	  
	  
	  

	  
	  
	  
	  


    </table><br />
<label>
          <input name="transferir" type="submit"  id="transferir" value="Actualizar" />
          <br />
        <br />
        </label>
<input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
</form>
  
<p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
      <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesTodosAjax.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>