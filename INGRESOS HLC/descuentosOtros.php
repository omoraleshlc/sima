<?PHP require("menuOperaciones.php"); 

?>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Ivan Nieto Perez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Codigo: www.elcodigo.com   
  
  
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
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>

<h1 align="center">&nbsp;</h1>
<h1 align="center">DESCUENTOS A OTROS CXC</h1>
<form id="form1" name="form1" method="post" action="">
<p align="center">

</p>
    <p>&nbsp;</p>
    <p align="center">
      <input onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para hacer descuentos a CxC..';?>&lt;/div&gt;')" onMouseOut="UnTip()" name="nuevo2" type="submit"  id="nuevo2" value="Aplicar Descuento Companias"
	  onclick="nueva('../ventanas/aplicarDescuentoCIAS.php?cargos=cargos&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','800','550','yes')" />
      <input onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para hacer traslados a Otros..';?>&lt;/div&gt;')" onMouseOut="UnTip()" name="others" type="submit"  id="others" value="Aplicar Descuento Otros"
	  onclick="nueva('../ventanas/ventanaDescuentoOtros.php?cargos=cargos&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','800','300','yes')" />
      <input onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para ver las notas de cargo y su estado actual..';?>&lt;/div&gt;')" onMouseOut="UnTip()" name="nuevo22" type="submit"  id="nuevo22" value="Listado de Pagos"
	  onclick="nueva('../cargos/listadoVentasPacientes.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria10','500','500','yes')" />
    </p>
</form>
<h1 align="center">&nbsp;</h1>
<br></br>
</body>
</html>
