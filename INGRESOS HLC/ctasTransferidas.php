<?PHP require("menuOperaciones.php"); ?>
<?php
if(($_POST['previzualizar'] or $_POST['aplicarFactura']) and $_POST['folioFactura']){
$sSQL3d= "Select numFactura From facturasAplicadas WHERE numFactura = '".$_POST['folioFactura']."' ";
$result3d=mysql_db_query($basedatos,$sSQL3d);
$myrow3d = mysql_fetch_array($result3d);
}
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
function ventanaSecundaria20 (URL){
   window.open(URL,"ventanaSecundaria20","width=800,height=800,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES")
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
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES")
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







<?php 
$ventanaCenter=new windowCenter();
echo $ventanaCenter->mainmenu();
?>









<?php if($_POST['load'] ){

$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
contadorFacturas
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}



$agrega = "INSERT INTO contadorFacturas (
usuario,contador,entidad
) values (
'".$usuario."','".$n."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>

<script>
javascript:wopen('../ventanas/divideAseguradoras.php?numSolicitud=<?php echo $n;?>', 'popup', 800, 600);
window.opener.document.forms["form1"].submit();
//window.location = 'dividirCuentas.php'
self.close();
</script>
<?php 
}

?>









<!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" />

  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>

 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>



	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
    
<?php
$showStyles=new muestraEstilos();
$showStyles->styles();
?>    
</head>



<BODY  >

<h1 align="center" >Facturacion Aseguradoras</h1>
<p align="center" >&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
 <div align="center">
         <span >
          
        <input type="submit" name="load" id="button" value="Cargar Folio(s)" />
        </span>

  </form>

<p align="center">



</body>
</html>