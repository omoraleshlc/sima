<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");$almacen=$ALMACEN=$_GET['datawarehouse']; ?>
<?php
$almacenDestino=$almacen;
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoDespliegaFecha=$_GET['campoDespliegaFecha'];
require("/configuracion/componentes/comboAlmacen.php"); 
?>
<?php  
if($_GET['numCliente'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
	
$sSQL1= "Select  * From pacientes WHERE keyPacientes = '".$_GET['keyPacientes']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$agrega = "INSERT INTO pacientesHistoria (
nombre1,nombre2,apellido1,apellido2,apellido3,
numCliente,ocupacion,fechaNacimiento,
pais1,telefono,calle,cp,
ciudad,estado,colonia,religion,ecivil,rfc,seguro,poliza,edad,ruta,sexo,nombreCompleto,numero,fechaCreacion,
observacionesSexo,nCuenta,entidad,usuario,transaccion
) values (

'".strtoupper($myrow1['nombre1'])."','".strtoupper($myrow1['nombre2'])."','".strtoupper($myrow1['apellido1'])."',
'".strtoupper($myrow1['apellido2'])."','".strtoupper($myrow1['apellido3'])."','".$myrow1['numCliente']."',
'".strtoupper($myrow1['ocupacion'])."','".$myrow1['fechaNacimiento']."',
'".strtoupper($myrow1['pais1'])."','".$myrow1['telefono']."','".strtoupper($myrow1['calle'])."','".$myrow1['cp']."',
'".strtoupper($myrow1['ciudad'])."',
'".strtoupper($myrow1['estado'])."','".strtoupper($myrow1['colonia'])."','".strtoupper($myrow1['religion'])."',
'".strtoupper($myrow1['ecivil'])."','".strtoupper($myrow1['rfc'])."','".strtoupper($myrow1['seguro'])."','".$myrow1['poliza']."','".$myrow1['edad']."','".$uploadfile."',
'".strtoupper($myrow1['sexo'])."','".$nombreCompleto."','".$myrow1['numero']."','".$fecha1."',
'".strtoupper($myrow1['observacionesSexo'])."','".$nCuenta."','".$entidad."','".$usuario."','eliminar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
	
	
$sql="DELETE FROM pacientes
where
keyPacientes='".$_GET['keyPacientes']."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();

$sql="DELETE FROM pacientesDuplicados
where
keyED='".$_GET['keyED']."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();
		
		echo 'Se elimino el expediente '.$myrow1['numCliente'].' '.' del paciente: '.$myrow1['nombreCompleto'];
	} 



}
?>
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
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
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
<h1 align="center">Eliminar  Expedientes </h1>
<?php echo $leyenda; ?>
<div align="center"></div>
<form name="form2" id="form2" method="post" action="">

  <table width="435" class="table-forma">
    <tr valign="middle"   >
      <th colspan="2" ><div align="center" class="style13">Datos del Paciente </div></th>
    </tr>
    <tr valign="middle" >
      <td height="26" >Nuevo</td>
      <td ><span ><span ><a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" /></a><a href="javascript:ventanaSecundaria1('modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span></span></td>
    </tr>
    <tr valign="middle"  >
      <td height="46" >Apellidos</td>
      <td ><label>
        <input name="nombres" type="text"  id="nombres" size="40" 
		value="<?php echo $_POST['nombres'];?>" />
        </label>
&nbsp;</td>
    </tr>
    <tr valign="middle"  >
      <td width="47" >&nbsp;</td>
      <td width="386" ><label>
        <input name="mostrar" type="submit" class="style71" id="mostrar2" value="Buscar" />
      </label></td>
    </tr>
  </table>

</form>
<div align="center">
  <p>&nbsp;</p>
</div>
<form id="form1" name="form1" method="post" action="" >
<?php


if($nombres=$_POST['nombres']){
$sSQL= "
SELECT * from pacientes where 
(concat(apellido1,' ',apellido2) like '%$nombres%' 
or 
concat(apellido1,' ',apellido2,' ',nombre1) like '%$nombres%')


or
numCliente ='".$nombres."'
order by nombre1 asc

";



$result=mysql_db_query($basedatos,$sSQL);

?>
<input name="nombrePaciente1" type="hidden" class="Estilo28" id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
<input name="nombrePaciente12" type="hidden" id="nombrePaciente122" value="<?php echo $_POST['numPaciente'];?>"/>
  <input name="nCuenta" type="hidden"  id="nCuenta3" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
  <input name="numeroE" type="hidden"  id="numeroE3" value="<?php echo $numeroEs= $_POST['numeroE']; ?>" readonly="" />
  <table width="531" border="0" align="center" cellpadding="4" cellspacing="0" class="enlace">
    <tr>
      <th width="75" height="19"  class="style13" scope="col"><div align="left"><span class="style111">Exp</span></div></th>
      <th width="373"  class="style13" scope="col"><div align="left"><span class="style111">Paciente</span></div></th>
      <th width="69"  class="style13" scope="col"><div align="left"><span class="style111">Eliminar</span></div></th>
    </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$numCliente=$myrow['numCliente'];
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']." ".$myrow['apellido1']." ".
$myrow['apellido2']." ".$myrow['apellido3'];
$bandera+="1";

$sSQL311= "Select  * From pacientes WHERE numCliente = '".$numCliente."' ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente']; 
$sSQL31= "Select  * From clientesInternos WHERE numeroE = '".$NUMEROE."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$keyClientesInternos=$myrow31['keyClientesInternos'];
$NC=$myrow['numCliente'];
?>

        <td height="20" bgcolor="#FFFFFF" class="Estilo24">
		 <span class="style12"><span class="Estilo30"><span class="style71"><a href="#" rel="htmltooltip" onClick="javascript:ventanaSecundaria('../ventanas/dxActuales.php?numeroE=<?php echo $myrow['numCliente']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $keyClientesInternos; ?>')">
		 
		 </a>
		 <?php echo $NC?>
		 </span></span></span> </td>
          <td bgcolor="#FFFFFF" class="Estilo24"><span class="Estilo31"><span class="style71"><span class="Estilo29">
            <?php 
		echo $myrow311['nombreCompleto']; 
		
		?></span></span></span></td>
        <td bgcolor="#FFFFFF" class="Estilo24"><span class="style12">
		
		
		</span>
          <div align="center"> <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&numCliente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_GET['seguro']; ?>&inactiva=<?php echo'inactiva'; ?>&keyED=<?php echo $myrow['keyED']; ?>&keyPacientes=<?php echo $myrow['keyPacientes']; ?>"> <img src="/sima/imagenes/borrar.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar a <?php echo $myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['nombre1']." ".$myrow1['nombre2'];?>?') == false){return false;}" /></a> </div>
        </td>
    </tr>

      <?php }}?>
  </table>
</form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
</body>
</html>
