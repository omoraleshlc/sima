<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); valida('CAJA','PA',$usuario,$basedatos); ?>
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
           
        if( vacio(F.importe.value) == false ) {   
                alert("Por Favor, escribe el importe!")   
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
		alert("Sólo Se aceptan Números!")
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



<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style19 {color: #000000; font-weight: bold; }
-->
</style>
</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
.style21 {color: #FF0000}
-->
</style>
<body>
<form name="form1" method="post" action="" />
  <h1 align="center">Anticipo, Devoluci&oacute;n, Pagos: </h1>
  <table width="554" border="0" align="center" class="style12">
    <tr>
      <th width="12" class="style12" scope="col">+</th>
      <th colspan="2" bgcolor="#660066" class="style14" scope="col">Captura a Cuenta Paciente Particular </th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th width="90" class="style12" scope="col"><div align="left"><strong>Cuenta: </strong></div></th>
      <th width="430" class="style12" scope="col"><div align="left"><strong>
          <label> </label>
          </strong>
          <input name="ctaMayor" type="text" class="style12" id="ctaMayor"   readonly=""
		value="<?php if($_POST['ctaMayor']){ echo $_POST['ctaMayor'];} else { echo "Escoje la Cuenta";}?>" 
		onchange="javascript:this.form.submit();" />
          <span class="Estilo24">
          <input name="cuentaSMayores" type="submit" class="Estilo24" id="cuentaSMayores"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/ctaMayor.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "ctaMayor"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="M" />
          </span>
          <label>
          <input name="campoDespliega" type="text" class="style12" id="campoDespliega" size="50" 
		  onChange="javascript:this.form.submit();"  value="<?php if($_POST['campoDespliega']){ echo $_POST['campoDespliega'];}?>"/>
          </label>
          <label></label>
      </div></th>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Auxiliar:</td>
      <td class="style12"><span class="Estilo24">
        <label>
        <input name="banderaAuxiliar" type="checkbox" id="banderaAuxiliar" value="aux" onClick="javascript:this.form.submit();"
		 <?php 
		 if($_POST['banderaAuxiliar'] and !$_POST['cuentaSMayores']){ 
		 echo 'checked="checked"';
		 } 
		 ?>/>
        </label>
		<?php if($_POST['banderaAuxiliar'] and !$_POST['cuentaSMayores']){?>
        <input name="auxiliar" type="text" class="style12" id="auxiliar" />
        <input name="auxiliares" type="submit" class="Estilo24" id="auxiliares"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/ctasAuxiliares.php?campoDespliega=<?php echo "campoDespliega2"; ?>&amp;forma=<?php echo "form1"; ?>&amp;ctaMayor=<?php echo $_POST['ctaMayor']; ?>&amp;campoSeguro=<?php echo "auxiliar"; ?>')" value="A" />
        <input name="campoDespliega2" type="text" class="Estilo24" id="campoDespliega2" size="50" 
		  onchange="javascript:this.form.submit();" value="<?php if($_POST['campoDespliega2']){ echo $_POST['campoDespliega2'];}?>"/>
        <?php }?>
      </span></td>
    </tr>
	


	
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Descripci&oacute;n:</td>
      <td class="style12">
<input name="descripcion" type="text" class="style12" id="descripcion"  size="90" /></td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Importe: </td>
      <td class="style12"><label>
        <input name="importe" type="text" class="style12" id="importe"  />
      </label></td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Autoriza:</td>
      <td class="style12"><span class="Estilo24">
        <?php
$cmdstr3 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$usuario."'";
$parsed3 = ociparse($db_conn, $cmdstr3);
ociexecute($parsed3);	 
$nrows3 = ocifetchstatement($parsed3,$resulta3);
for ($i = 0; $i < $nrows3; $i++ ){
$nombre = $resulta3['NOMBRE'][$i];
$apaterno= $resulta3['AP_PATERNO'][$i];
}
?>	
		<input name="autoriza" type="text" class="Estilo24" id="autoriza" 
value="<?php echo $usuario.":".$nombre." ".$apaterno; ?>" size="60" readonly=""/>
      </span></td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Fecha: </td>
      <td class="style12"><input name="fecha" type="text" class="style12" id="fecha" value="<?php 
	  echo $fecha1;
	 	   ?>" size="9" maxlength="9" readonly=""/>
        formato: A&ntilde;o-Mes-Dia </td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Hora:</td>
      <td class="style12"><input name="hora" type="text" class="style12" id="hora" value="<?php 
	  echo $hora1;
	 	   ?>" size="9" maxlength="9" readonly=""/>
        formato: 00:00 am </td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td colspan="2" bgcolor="#660066" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td height="33" colspan="3"><label>
        <div align="center">
            <input name="pagar" type="submit" class="style12" id="pagar" value="Efectuar Pago" />
            <label></label>
            <input name="imprimir" type="submit" class="Estilo24" id="imprimir" value="Imprimir Recibo" />
        </div>
        </label></td>
    </tr>
</table>
</form>
<h1 align="center">&nbsp;</h1>
<p>&nbsp;</p>
  <h1 align="center">&nbsp;</h1>
  <p align="center">&nbsp;</p>
</body>
</html>