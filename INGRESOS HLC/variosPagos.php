<?PHP require("menuOperaciones.php"); 
$descripcionTransaccion="paquetes";

$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);


if(!$ALMACEN){
$ALMACEN=$_GET['almacen'];
}

if($myrowC['status']=='abierta' ){ //*******************Comienzo la validaci�n*****************
?>







<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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
<script src="/sima/js/jquery.js" type="text/javascript"></script>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>


<meta http-equiv="refresh" content="120" >

<script>
var timeLimit = 1; //t15iempo en minutos
var conteo = new Date(timeLimit * 30000);

function inicializar(){
document.getElementById('cuenta').childNodes[0].nodeValue =
conteo.getMinutes() + ":" + conteo.getSeconds();
}

function cuenta(){
intervaloRegresivo = setInterval("regresiva()", 1000);
}

function regresiva(){
if(conteo.getTime() > 0){
conteo.setTime(conteo.getTime() - 1000);
}else{
clearInterval(intervaloRegresivo);
//alert("Fin");
document.encuesta.submit();
//document.getElementById('encuesta').submit();
}

document.getElementById('cuenta').childNodes[0].nodeValue =
conteo.getMinutes() + ":" + conteo.getSeconds();
}

onload = inicializar;

</script>


<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>



<?php 
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>

<form id="form10" name="form10" method="get" action="#">
  <h1 align="center" >Ordenes paquetes pendientes </h1>
  <p align="center" >
    <span class="negromid">Escoge la Fecha </span>
      <input onChange="this.form.submit();" name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 echo $date;
		 ?>"/>
    </label>
    <input name="button" type="button"  id="lanzador" value="..." />
</p>
      <div id="contentLoading" class="contentLoading">
<img src="/sima/imagenes/barras/loading30.gif" alt="Loading data, please wait...">
</div>
<div id="contentArea">
</div>






  <p>&nbsp;</p>
</form>

    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
<script type="text/javascript">
<!--
jQuery(function($) {
$("#contentArea").load("listaPxPaquetes.php?warehouse=<?php echo $_GET['warehouse'];?>&almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&fecha2=<?php echo $fecha2;?>&fecha1=<?php echo $date;?>&almacen=<?php echo $ALMACEN;?>&tipoOrden=<?php echo $_GET['tipoOrden'];?>&descripcionTransaccion=paquetes");
});

$().ajaxSend(function(r,s){
$("#contentLoading").show();
});

$().ajaxStop(function(r,s){
$("#contentLoading").fadeOut("fast");
});

//-->
</script>
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