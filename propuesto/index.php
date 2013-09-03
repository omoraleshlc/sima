<?php 
if($_SERVER['SERVER_NAME']=='10.2.1.201' or $_SERVER['SERVER_NAME']=='201.134.41.78'){
$imagen= 'imagenes/real.jpg';
} else {
$imagen= 'imagenes/desarrollo.jpg';
}
?>
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
           
        if( vacio(F.username.value) == false ) {   
                alert("Por Favor, introduce el nombre de usuario!")   
                return false   
        } else if( vacio(F.password.value) == false ) {   
                alert("Por Favor, escribe tu contraseña!")   
                return false   
        } 
           
}   
  
  
  
  
</script> 
<script> 
	<!-- Begin
	window.open('propuesto.php','ventana','scrollbars=no,status=no,menubar=no,left=0,top=0,resizable=no,width=790,height=535');
// End -->
</script>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:92px;
	height:111px;
	z-index:1;
	left: 305px;
	top: 249px;
	background-color: #FFFFFF;
}
body {
	background-image: url(<?php echo $imagen;?>);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-repeat: no-repeat;
}
-->

</style>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {
	color: #FFFFFF;
	font-weight: bold;
}
#usuario {
	font-family: Tahoma, Geneva, sans-serif;
}
#contraseña {
	font-family: Tahoma, Geneva, sans-serif;
}
.contraseña {
	font-family: Tahoma, Geneva, sans-serif;
}
.password {
	font-family: Tahoma, Geneva, sans-serif;
}
.contras {
	font-family: Tahoma, Geneva, sans-serif;
}
.contras {
	color: #FFF;
}
.usuraio {
	color: #FFF;
}
-->
</style>
<table width="949" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="323">&nbsp;</td>
    <td width="95">&nbsp;</td>
    <td width="231">&nbsp;</td>
    <td width="300">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="2" align="right" valign="top"><p><img src="../imagenes/iconomedico.png" width="102" height="123" align="right" /></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td align="right" valign="top"><h5 align="right"><span class="usuraio" id="usuario"><strong>Usuario</strong><strong></strong></span><span id="usuario"><strong><br />
        <br />
        <br />
      </strong></span><strong class="contras">Contrase&ntilde;a  </strong></h5>
<p align="right">&nbsp;</p>
    <p align="right">&nbsp;</p></td>
	
    <td align="left" valign="top"><form id="form1" name="form1" method="post" action="propuesto.php" onSubmit="return valida(this);">
      <p>
        <label>
          <input type="text" name="username" id="username" />
        </label>
      </p>
      <p>
        <label>
          <input type="password" name="password" id="password" />
        </label>
      </p>
      <p>
        <label>
          <input type="submit" name="ingresar" id="ingresar" value="Iniciar Sesi&oacute;n" />
        </label>
      </p>
      .
    </form></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<center>
</center>
