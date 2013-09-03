<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php 
include("/configuracion/funciones.php"); 
?>
<?php 
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];

$cargosCia=new acumulados();

$UserType=new tipoUsuario();
$UserType=$UserType->tipoDeUsuario($usuario,$basedatos,$ALMACEN);
?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=350,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
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



 <?php

if($_POST['aplicar']  ){

//*********************** coaseguro 1**********************************
$sSQL31= "Select * From avisos WHERE entidad='".$entidad."' AND numeroE = '".$numeroE."' AND nCuenta='".$nCuenta."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if(!$myrow31['statusAviso']){
$agrega = "INSERT INTO avisos (
numeroE,nCuenta,tipoAviso,usuario,fecha,hora,statusAviso,keyCI,
porcentajeDeducible1,
porcentajeCoaseguro1,
porcentajeDeducible2,
porcentajeCoaseguro2,
importeDeducible1,
importeCoaseguro1,
importeDeducible2,
importeCoaseguro2,
entidad
) 
values 
('".$numeroE."','".$nCuenta."','caja',
'".$usuario."','".$fecha1."','".$hora1."','standby','".$_GET['nT']."',
'".$_POST['porcentajeDeducible1']."',
'".$_POST['porcentajeCoaseguro1']."',
'".$_POST['porcentajeDeducible2']."',
'".$_POST['porcentajeCoaseguro2']."',

'".$_POST['importeDeducible1']."',
'".$_POST['importeCoaseguro1']."',
'".$_POST['importeDeducible2']."',
'".$_POST['importeCoaseguro2']."',
'".$entidad."'
)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda= "Se solicit&oacute; la transacci&oacute;n de cargo de Coaseguro a Paciente";

}else{
$agrega = "UPDATE avisos set 
porcentajeDeducible1='".$_POST['porcentajeDeducible1']."',
porcentajeCoaseguro1='".$_POST['porcentajeCoaseguro1']."',
porcentajeDeducible2='".$_POST['porcentajeDeducible2']."',
porcentajeCoaseguro2='".$_POST['porcentajeCoaseguro2']."',

importeDeducible1='".$_POST['importeDeducible1']."',
importeCoaseguro1='".$_POST['importeCoaseguro1']."',
importeDeducible2='".$_POST['importeDeducible2']."',
importeCoaseguro2='".$_POST['importeCoaseguro2']."'

where
entidad='".$entidad."' AND
numeroE='".$numeroE."' AND
nCuenta='".$nCuenta."'

";

//mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda= "Se actualizaron registros";
}//********************************CIERRA COASEGURO 1



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>




<BODY >

<h1 align="center"> Coaseguro / Deducible</h1>
<form id="form1" name="form1" method="post" action="">

    <?php include('/configuracion/clases/encabezado.php');?>

  <p>&nbsp;</p>
    <?php include('/configuracion/clases/mostrarDatosCuenta.php');?>
   <?php include('/configuracion/clases/mostrarEfectuarTransacciones.php');?> 
  <p>&nbsp;</p>
  <div align="center">
    
    <input name="nuevo" type="button" class="style7" id="nuevo" value="Cargar Deducible/Coaseguro"
	  onclick="ventanaSecundaria10('aplicarDeducibleVentana.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&almacen=<?php echo $_GET['almacen']; ?>&almacenFuente=<?php echo $_GET['almacen']; ?>&nT=<?php echo $_GET['nT'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>')" />
    
    
    
  </div>
</form>

<p align="center">&nbsp;</p>

</body>
</html>