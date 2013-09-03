<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); 
$sSQLC= "Select status From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta'){ //*******************Comienzo la validaci�n*****************
?>
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
           
        if( vacio(F.importe.value) == false ) {   
                alert("Por Favor, escribe el importe!")   
                return false   
        } 
           
}   
</script> 





<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=500,height=500,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=300,scrollbars=YES") 
} 
</script> 




<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
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
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.style122 {font-size: 10px}
.style122 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
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

<h1 align="center">&nbsp;</h1>
<h1 align="center">Pagos a CxC </h1>
<form id="form1" name="form1" method="post" action="">
    <p align="center"><img src="../../imagenes/imagenesModulos/medicos.gif" width="155" height="214" /></p>
    <p>&nbsp;</p>
    <p align="center">
      <input onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para hacer traslados a CxC..';?>&lt;/div&gt;')" onMouseOut="UnTip()" name="nuevo2" type="button" class="style7" id="nuevo2" value="Convenios"
	  onclick="nueva('ventanasTCxC.php?cargos=cargos&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','800','300','yes')" />
      <input onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para hacer traslados a Otros..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="others" type="button" class="style7" id="others" value="Otros"
	  onclick="nueva('ventanasTCxCOtros.php?cargos=cargos&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','800','300','yes')" />
      <input onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para ver las notas de cargo y su estado actual..';?>&lt;/div&gt;')" onMouseOut="UnTip()" name="nuevo22" type="button" class="style7" id="nuevo22" value="Listado de Pagos"
	  onclick="nueva('/sima/cargos/listadoVentasPacientes.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria10','500','500','yes')" />
    </p>
</form>
<h1 align="center">&nbsp;</h1>
</body>
</html>
<?php
} else { 
$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje('LA CAJA ESTA CERRADA');
}
?>