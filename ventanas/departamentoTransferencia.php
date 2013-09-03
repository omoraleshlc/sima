<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?PHP require("/configuracion/funciones.php"); ?>
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


if($_GET['keyClientesInternos'] and $_POST['transferir'] and $_POST['almacenDestino2'] and $_POST['cuarto'] ){
if($_POST['almacenDestino2']=='HURG'){
$tipoPaciente='urgencias';
}else{
$tipoPaciente='interno';
}





//******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);



$sSQL7d= "Select * From cargosCuentaPaciente WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'  and
 statusCargo='standbyR'

";
$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);

if($myrow7d[0]!=NULL){
    
    echo '<script>
window.alert( "IMPOSIBLE TRANSFERIR! DEBES DE TERMINAR EL PROCESO EN ENVIAR ARTICULOS...");
//window.opener.document.forms["form1"].submit();

</script>';
    
    
}else{//continua
$NUMEROE=$myrow7['numeroE'];
$descripcion='Transferencia de Departamento';
$as=$myrow7['almacen'];
$ad=$_POST['almacenDestino2'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$as."','".$ad."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow7['folioVenta']."',
'".$myrow7['cuarto']."','".$_POST['cuarto']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***************************************


 $q = "UPDATE clientesInternos set 

solicitaTransferencia='si',

cuarto='".$_POST['cuarto']."',

almacen='".$_POST['almacenDestino2']."',
tipoPaciente='".$tipoPaciente."'

WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
//*************************

//echo 'SE TRANSFIRIO LA CUENTA DEL PACIENTE';

echo '<script>
window.alert( "SE TRANSFIRIO LA CUENTA DEL PACIENTE");
window.opener.document.forms["form1"].submit();
window.close();
</script>';

}
}






$sSQL7= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$NUMEROE=$myrow7['numeroE'];

 $sSQL32= "Select * From pacientes WHERE entidad='".$entidad."' and numCliente = '".$NUMEROE."'";
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


<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>

<h1 align="center">A donde lo quieres Transferir?</h1>

<?php echo $leyenda; ?>
<form id="form1" name="form1" method="post" action="#" >
<table width="367" class="table-forma">
	  
	 
      <tr valign="middle"  >
        <th colspan="2" ><div align="center"><span >Asignaci&oacute;n de Cuarto</span></div></th>
      </tr>
      <tr valign="middle" >
        <td width="137" >Departamento</td>
        <td width="571">
        			
                    
                    <?php 
  $aCombo= "Select * From almacenes where 
 almacen!='".$myrow7['almacen']."'
 and
 activo='A' and tieneCuartos='si' and medico='no' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino2"  id="almacenDestino2" />        
					<option value="">Escoje</option>
					
   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino2']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino2'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     
        </td>
      </tr>
      <tr valign="middle" >
        <td>Cuarto</td>
        <td><span >
          <input name="cuarto" type="text"  id="cuarto" 
		value="<?php echo $myrow7['cuarto'];?>" />
        </span></td>
      </tr>
	  
	  
	  
	  
	  
	  
	  
	  
	
      <tr valign="middle" >
        <td><div align="left"></div></td>
        <td><label>
          <input name="transferir" type="submit"  id="transferir" value="Transferir" />
          <br />
        <br />
        </label></td>
		
		
      </tr>
    </table>
	<input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
</form>
  <p align="center" >&nbsp;</p>
<p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>

</body>
</html>