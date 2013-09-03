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
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana2","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana2","width=700,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana2","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana2","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana2","width=700,height=600,scrollbars=YES") 
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




if(!$_POST['numeroE']){
$_POST['numeroE']=$_GET['numeroE'];
}

$sSQL3= "Select * From clientesInternos WHERE numeroE = '".$_POST['numeroE']."' ORDER BY keyClientesInternos DESC ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$keyClientesInternos=$myrow3['keyClientesInternos'];
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
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.style72 {font-size: 9px}
.style72 {font-size: 9px}
.style72 {font-size: 9px}
-->
</style>
          <?php $existeNE=$myrow3['numeroE'];
		   $sSQL31= "Select * From pacientes WHERE numCliente = '".$existeNE."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
		 
		  ?>
<h1 align="center">Expediente Cl&iacute;nico</h1>
<p align="center"><a href="/sima/movil/principal.php"><span class="style71">Regresar a Men&uacute;</span></a></p>
<form id="form2" name="form2" method="post" action="">
  <table width="530" border="0" align="center" class="style7">
    <tr class="style7">
      <th colspan="2" bgcolor="#660066" class="style14" scope="col"><span class="style14"><?php echo $paciente=$myrow3['paciente']; ?></span></th>
    </tr>
    <tr class="style7">
      <th width="81" class="Estilo24" scope="col"><div align="left"> Expediente: </div></th>
      <th width="173" class="Estilo24" scope="col"><div align="left" class="style24">
	  <?php 
if($myrow31['numCliente']){
		 echo $nExpediente=$myrow31['numCliente'];
		 } else {
		 echo "Sin Expediente";
		 }
?>
      </div></th>
    </tr>
    <tr>
      <td height="14" colspan="2" bgcolor="#660066">&nbsp;</td>
    </tr>
    <tr>
      <td height="33" colspan="2"><div align="center">
          <label></label>
          <label><input name="DatosP23" type="button" class="style7" id="DatosP233"  
onclick="javascript:ventanaSecundaria2('dxActuales.php?keyClientesInternos=<?php echo $keyClientesInternos; ?>&amp;medico=<?php echo $medico; ?>&amp;almacen=<?php echo $bebeAli; ?>&amp;seguro=<?php echo $traeSeguro; ?>&amp;numeroE=<?php echo $nCliente; ?>')" value="DX Actual" <?php if(!$nExpediente){ echo 'disabled=""';}?>/>
          <input name="DatosP22" type="button" class="style7" id="DatosP22"  
onclick="javascript:ventanaSecundaria5('/sima/cargos/agregaArticulos.php?numPaciente=<?php echo $nExpediente; ?>&amp;medico=<?php echo $medico; ?>&amp;almacen=<?php echo $bebeAli; ?>&amp;seguro=<?php echo $traeSeguro; ?>&amp;numeroE=<?php echo $nCliente; ?>')" value="Inter-consultas" <?php if(!$nExpediente){ echo 'disabled=""';}?>/>
          <input name="DatosP" type="button" class="style7" id="DatosP2"  onclick="javascript:ventanaSecundaria6('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $existeNE; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="Datos P."
		<?php if(!$nExpediente){ echo 'disabled=""';}?> />
          </label>
      </div></td>
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
<form id="form1" name="form1" method="get" action="">
  <table width="682" border="0" align="center">
    <tr>
      <th width="215" height="16" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style12"><span class="style11 style13">Fecha  </span></span></div></th>
      <th bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style12"><span class="style11 style13">Descripci&oacute;n</span></span></div></th>
      <th bgcolor="#660066" class="Estilo24" scope="col"><span class="style12"><span class="style11 style13">Depto.</span></span></th>
      <th bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style12"><span class="style11 style13">M&eacute;dico</span></span></div></th>
    </tr>
    <tr>
<?php	
$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
(numeroE='".$numeroE."' )
and
status!='transaccion'
and
statusCargo='cargado' 

ORDER BY fecha1,hora1 DESC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$numeroE=$myrow['numeroE'];
$alma=$myrow['almacen'];
$codigo=$myrow['codProcedimiento'];
?>
      <td height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">    <span class="style12">
<?php echo $myrow['hora1']?> <?php echo $myrow['fecha1']
?></span>  </span></td>
      <td width="303" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style12"><span class="style7">
	 
	  <span class="Estilo25"><span class="style7">
	  <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
	  </span></span>
	  </span></span></td>
      <td width="89" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style12"><span class="style7"><?php echo $myrow['almacen'];?></span></span></td>
      <td width="57" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
	  
	  <?php echo $myrow['medico'];?>

	  </span></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
</form>
  <p>&nbsp;</p>
<p align="center">&nbsp;</p>
</body>
</html>
