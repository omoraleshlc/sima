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

-->

</style>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {
	color: #FFFFFF;
	font-weight: bold;
}
body,td,th {
	font-size: 9px;
}
-->
</style>
<body >
<form name="form1" method="post" action="MenuIndex.php" onSubmit="return valida(this);"/>
  <p><center>
    <h1>HOSPITAL LA CARLOTA </h1>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    </center> 
<table width="230" height="111" border="1"   align="center" cellpadding="1" cellspacing="1" class="style12">
            <tr>
              <td width="187"><div align="center">
                <p>Usuario <span class="style13">
                <input name="username" type="text" class="style12" id="username" autocomplete="off" />
                </span><br />
Password
<input name="password" type="password" class="style12" id="password"  autocomplete="off"/>
</p>
                <p>
                  <input name=ingresar type=submit class="style12" id="ingresar" value=Entrar />
                  <input name="Submit2" type="reset" class="style12" onClick="window.close()" value="Cerrar" />
                  </p>
              </div></td>
    </tr>
</table>
</form>


<p align="center">&nbsp;</p>
