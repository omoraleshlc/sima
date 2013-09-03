<?PHP require("/configuracion/funciones.php"); $ALMACEN=$_GET['datawarehouse'];?>
<?PHP require("/configuracion/clases/valida.php");?>
<?PHP require("/configuracion/baseDatos.php"); 
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();

$hora1=validator::hora1();
$fecha1=validator::fecha1();
$MEDICO=validator::medico($usuario,$basedatos);
$entidad=$_GET['entidad'];
$tipoUsuario=validator::tipoUsuario($usuario,$basedatos);
?>

<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=300,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
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


//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$nCliente5=$myrow3['numeroE'];
$nCuenta5=$myrow3['nCuenta'];
$nFolioV=$myrow3['folioVenta'];
$nhora=$myrow3['hora'];

$sSQL31= "Select * From pacientes WHERE entidad='".$entidad."' and numCliente = '".$nCliente5."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
//***************aplicar pago**********************

$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('ABRiO LA HOJA DE IMPRESION DE INTERNAMIENTO','".$myrow3['almacen']."','".$ALMACEN."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>




</head>

<BODY >
<table width="683" class="table-forma" align="center">
  <tr>
    <td width="162" rowspan="4" scope="col"><img src="../imagenes/bordestablas/logo_hojainterna.png" width="119" height="113" /></td>
    
  </tr>
  <tr>
    <td width="242" valign="bottom" scope="col" align="left"><span >Fecha de Admisi&oacute;n: <?php echo cambia_a_normal($fecha1); ?></span><br />
Hora  de Admisi&oacute;n: <?php echo $nhora; ?></td>
    <td width="130" height="38"  valign="bottom" scope="col"><span >Fecha de Alta: ____/____/______</span></td>
    <td width="190" valign="bottom"  scope="col"><span >Folio de Venta: <?php echo $myrow3['folioVenta']; ?></span><br />
    <span >Expediente: <?php echo $nCliente5; ?></span></td>
  </tr>
  <tr>
    <td height="27" colspan="2" align="left" valign="bottom"  scope="col"><span >Admitido en: _____Admisi&oacute;n  _____ Urgencias</span></td>
    <td width="190" valign="bottom"  scope="col"><span ><span >Usuario: <span ><span >
    <?php 

$sSQL6a= "Select nombre,apaterno,amaterno From usuarios WHERE entidad='".$entidad."' and usuario = '".$myrow3['autoriza']."' ";
$result6a=mysql_db_query($basedatos,$sSQL6a);
$myrow6a = mysql_fetch_array($result6a);

	  
	  echo $myrow6a['nombre']." ".$myrow6a['apaterno']." ".$myrow6a['amaterno']; 
	  
	    
	  ?>
    </span></span></span></span></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="bottom"  scope="col"><span >Camino al Vapor 209, Apdo. 51, Montemorelos N.L. Mexico 67500. Telf. 8262633502</span></span></td>
  </tr>
  <tr>
    <td colspan="4">
    <br />
    <img src="../imagenes/bordestablas/headmid.png" width="736" height="29" />
    </td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
<table width="698" align="center">

    <tr>
      <th height="18" colspan="3"  scope="col">
    <img src="../imagenes/bordestablas/datosgen_hojainterna.png" width="736" height="23" /></tr>
    <tr>
      <td colspan="2" ><strong>Paciente: </strong> <?php echo $myrow3['paciente']; ?></td>
      <td width="318" ><strong>L&iacute;mite de Cr&eacute;dito: </strong> <?php echo "$".number_format($myrow3['limiteCredito'],2); ?></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td colspan="2" ><strong>Cuarto:</strong> <?php echo $myrow3['cuarto'];?></td>
      <td ><strong>Dep&oacute;sito: </strong><?php echo "$".number_format($myrow3['deposito'],2); ?></span></td>
    </tr>
    <tr>
      <td colspan="2" ><strong>Edad:</strong> <?php 
	echo $myrow3['edad'];	
	  ?>

  </span></td>
      <td ><strong>Fecha de Nacimiento</strong><strong>:</strong> <?php echo cambia_a_normal($myrow31['fechaNacimiento']); ?></span></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td width="123" ><strong>Estado Civil</strong><strong>:</strong> <?php echo $myrow31['ecivil']; ?></td>
      <td width="287" >&nbsp;</td>
      <td ><strong>Sexo</strong><strong>:</strong> <?php echo $myrow31['sexo']; ?></span></td>
    </tr>
    <tr>
      <td colspan="3" ><strong>Calle y N&uacute;mero</strong><strong>:</strong>  <?php echo $myrow31['calle']; ?></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td colspan="2" ><strong>Colonia</strong><strong>:</strong> <?php echo $myrow31['colonia']; ?></td>
      <td ><strong>Ciudad</strong><strong>:</strong> <?php echo $myrow31['ciudad']; ?></span></td>
    </tr>
    <tr>
      <td colspan="2" ><strong>Estado</strong><strong>:</strong> <?php echo $myrow31['estado']; ?></td>
      <td ><strong>Pa&iacute;s: </strong> <?php echo $myrow31['pais1']; ?></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td colspan="2" bgcolor="#99CCFF" ><strong>C.P.: </strong> <?php echo $myrow31['cp']; ?></span></td>
      <td ><strong>Religi&oacute;n: </strong> <?php echo $myrow31['religion']; ?></td>
    </tr>
    <tr>
      <td colspan="2" ><strong>Tel&eacute;fono Fijo</strong><strong>:</strong> <?php echo $myrow31['telefono']; ?></td>
      <td >Tel&eacute;fono Celular:</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#99CCFF" >Correo Electr&oacute;nico:</td>
      <td bgcolor="#99CCFF" ><strong>Ocupaci&oacute;n: </strong> <?php echo $myrow31['ocupacion']; ?></span></td>
    </tr>
    <tr>
      <td colspan="2" >Tel&eacute;fono del Lugar de Trabajo:</td>
      <td >Direcci&oacute;n del lugar de trabajo:</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#99CCFF" >Tipo de Paciente:</td>
      <td bgcolor="#99CCFF" >Nombre del Seguro:</td>
    </tr>
    <tr>
      <td colspan="3"  align="center"><img src="../imagenes/bordestablas/datosmed_hojainterna.png" width="736" height="24" /></td>
    </tr>
    <?php
	$sSQL2= "Select nombre1,apellido1,apellido2 From medicos WHERE numMedico = '".$_GET['medico']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
	
	?>
    
    <?php
$sSQL6= "Select descripcion From especialidades WHERE codigo = '".$_GET['especialidad']."' ";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
	?>
    
    
    <tr>
      <td colspan="2" ><span class="negromid"><strong>M&eacute;dico responsable: </strong><?php echo $myrow2['nombre1']." ".$myrow2['apellido1']." ".$myrow2['apellido2']; ?></span></td>
      <td ><span class="normalmid"><strong>Especialidad: <?php echo $myrow6['descripcion']; ?></strong></span></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td colspan="3" ><span ><span class="normalmid"><strong>Tel&eacute;fono celular: </strong></span></span></td>
    </tr>
    <tr>
      <td colspan="3" >Direcci&oacute;n:</td>
    </tr>
    <tr>
      <td colspan="3" >Correo electr&oacute;nico</td>
    </tr>
    <tr>
      <td colspan="3" ><span class="normalmid"><strong>Lugar de trabajo:</strong></span></td>
    </tr>
    <tr>
      <td colspan="3" ><div align="center"><img src="../imagenes/bordestablas/datosres_hojainterna.png" width="736" height="24" /></div></td>
    </tr>
</table>
<table width="737"  align="center"  >
  <tr >
    <td colspan="3" class="negromid">Nombre del Responsable o Tutor: <span class="Estilo35 style12 Estilo39"><strong><?php echo $myrow3['nombreResponsable']." ".$myrow3['apaternoResponsable']." ".$myrow3['amaternoResponsable']; ?></strong></span></td>
  </tr>
  <tr bgcolor="#99CCFF" >
    <td width="548" class="normalmid">Parentesco: <?php echo $myrow3['parentescoResponsable']; ?></td>
    <td width="69" >&nbsp;</td>
    <td width="108" >&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" class="normalmid">Direcci&oacute;n: <?php echo $myrow3['direccionResponsable']; ?></td>
  </tr>
  <tr >
    <td colspan="3" bgcolor="#99CCFF" class="normalmid">Tel&eacute;fono fijo y celular: <?php echo $myrow3['telefonoResponsable']; ?></td>
  </tr>
  <tr >
    <td colspan="3" class="normalmid">Correo electr&oacute;nico</td>
  </tr>
  <tr >
    <td colspan="3" bgcolor="#99CCFF" class="normalmid">Nombre del Seguro:
      <?php
$sSQL6a= "Select nomCliente From clientes WHERE numCliente = '".$_GET['anomSeguro']."' ";
$result6a=mysql_db_query($basedatos,$sSQL6a);
$myrow6a = mysql_fetch_array($result6a);

echo $myrow6a['nomCliente'];
	?></td>
  </tr>
  
</table>

<table width="737" border="0" align="center"  cellpadding="2" cellspacing="0" bordercolor="#990099" >
    <tr>
      <td colspan="3" ><div align="center"><img  src="../imagenes/bordestablas/datosautoriza_hojainterna.png" width="736"   /></div></td>
    </tr>
  <tr>
    <td colspan="4" ><p><br />
      El (la) Suscrito (a)  <span ><?php echo $myrow3['paciente']; ?></span><br />
      autoriza al Hospital La Carlota <span ><?php 
		if ($myrow2['nombre1']) {
			echo $myrow2['nombre1']." ".$myrow2['apellido1']." ".$myrow2['apellido2'];;
		} else {
			echo $myrow3['medicoForaneo'];
		}
			 ?></span> para la recolecci&oacute;n, divulgaci&oacute;n y uso de los datos personales, incluso de terceros, exclusivamente para ser utilizados en la atenci&oacute;n al paciente/cliente; excepto en las circunstancias que marquen las leyes, reglamentaciones y normatividad aplicables.</p>
      <p >Hospital La Carlota se compromete a proteger su privacidad y confidencialidad de los datos personales que proporcion&oacute; conforme a las leyes, reglamentaciones y normatividad aplicables.</p>
      <p >&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="4" ><p align="center">_______________________________________<br />
      <span >Nombre y firma de autorizaci&oacute;n<br />
      </span>Nota: En caso de que el paciente est&eacute; incapacitado para firmar, el pariente mas cercano y/o su representante legal podr&aacute;n autorizar la atenci&oacute;n m&eacute;dica</p>
      <p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    
    <td colspan="4" >
      
      <div align="left">
        <p >Diagn&oacute;stico Final __________________________________________________________________________________________<br />
          ________________________________________________________________________________________________________<br />
          </p>
        </div>
  </td>
  </tr>
  <tr>
    <td colspan="4" ><div align="center">
      <p align="left" ><span >Observaciones:  ___________________________________________________________________________________________<br />
        ________________________________________________________________________________________________________<br />
        <br />
      </span></p>
      </div></td>
  </tr>
  <tr>
    <td colspan="4" bordercolor="#000000"  align="center"><img src="../imagenes/bordestablas/datosinter_hojainterna.png" width="736" height="24" /></td>
  </tr>
  <tr>
    <td colspan="4" bordercolor="#000000" ><span >________________________________________________________________________________________________________<br />
      ________________________________________________________________________________________________________<br />
    </span></td>
  </tr>
  <tr>
    <td colspan="4" bordercolor="#000000" ><img src="../imagenes/bordestablas/datosresulta_hojainterna.png" width="736" height="24" /></td>
  </tr>
  <tr>
    <td width="160" bordercolor="#000000" >_____ Recuperaci&oacute;n Total</td>
    <td width="147" bordercolor="#000000" >_____ Mejor&oacute;</td>
    <td width="104" bordercolor="#000000" ><span >_____ No Mejor&oacute;</span></td>
    <td width="313" align="center" valign="bottom" bordercolor="#000000" >&nbsp;</td>
  </tr>
  <tr>
    <td bordercolor="#000000" >_____ Alta Voluntaria</td>
    <td bordercolor="#000000" >_____ Defunci&oacute;n</td>
    <td bordercolor="#000000" ><span >_____ Autopsia</span></td>
    <td bordercolor="#000000"  align="center">&nbsp;</td>
  </tr>
  <tr>
    <td bordercolor="#000000" >_________________________ Firma del M&eacute;dico de ALTA</td>
    <td bordercolor="#000000" >&nbsp;</td>
    <td bordercolor="#000000" >&nbsp;</td>
    <td bordercolor="#000000"  align="center"><br /></td>
  </tr>
</table>
</form>


</body>
</html>
