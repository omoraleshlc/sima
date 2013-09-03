<?PHP require("/configuracion/ventanasEmergentes.php"); 

if($_GET['tipoVenta']=='activado' and !$_POST['opcion']){
    $_POST['opcion']='tipoVenta';
}elseif($_GET['tipoVenta']=='asignarAlmacen' and !$_POST['opcion']){
    $_POST['opcion']='asignarAlmacen';
}


if($_GET['configurarExistencias']=='activado' and !$_POST['opcion']){
    $_POST['opcion']='configurarExistencias';
}elseif($_GET['configurarExistencias']=='asignarAlmacen' and !$_POST['opcion']){
    $_POST['opcion']='asignarAlmacen';
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


<script type="text/javascript">

/***********************************************
* Show Hint script- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var horizontal_offset="9px" //horizontal offset of hint box from anchor link

/////No further editting needed

var vertical_offset="0" //horizontal offset of hint box from anchor link. No need to change.
var ie=document.all
var ns6=document.getElementById&&!document.all

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=(whichedge=="rightedge")? parseInt(horizontal_offset)*-1 : parseInt(vertical_offset)*-1
if (whichedge=="rightedge"){
var windowedge=ie && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-30 : window.pageXOffset+window.innerWidth-40
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure+obj.offsetWidth+parseInt(horizontal_offset)
}
else{
var windowedge=ie && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetHeight
}
return edgeoffset
}

function showhint(menucontents, obj, e, tipwidth){
if ((ie||ns6) && document.getElementById("hintbox")){
dropmenuobj=document.getElementById("hintbox")
dropmenuobj.innerHTML=menucontents
dropmenuobj.style.left=dropmenuobj.style.top=-500
if (tipwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=tipwidth
}
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+obj.offsetWidth+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+"px"
dropmenuobj.style.visibility="visible"
obj.onmouseout=hidetip
}
}

function hidetip(e){
dropmenuobj.style.visibility="hidden"
dropmenuobj.style.left="-500px"
}

function createhintbox(){
var divblock=document.createElement("div")
divblock.setAttribute("id", "hintbox")
document.body.appendChild(divblock)
}

if (window.addEventListener)
window.addEventListener("load", createhintbox, false)
else if (window.attachEvent)
window.attachEvent("onload", createhintbox)
else if (document.getElementById)
window.onload=createhintbox

</script>


</head>

<body>



<form name="form1" method="post" >

  <p align="center">
    <label>
    <select name="opcion" id="opcion" onchange="this.form.submit();"  class="precio1" >
	<option
	<?php if($_POST['opcion']=="0")echo 'selected=""';?>
	 value="0">---</option>


      <option
	  <?php if($_POST['opcion']=="costo")echo 'selected=""';?>
	   value="costo" onMouseover="showhint('Esta opcion es para cambiar costos...', this, event, '150px')">Asignar Costo/PrecioSugerido</option>
        


      <option
	  <?php if($_POST['opcion']=="asignarAlmacen")echo 'selected=""';?>
	   value="asignarAlmacen" onMouseover="showhint('Sirve para agregar almacenes a este servicio', this, event, '150px')">Asignar Almacenes</option>
      <option
	  <?php if($_POST['opcion']=="asignarPrecioGeneral")echo 'selected=""';?>
	   value="asignarPrecioGeneral" onMouseover="showhint('Sirve para actualizar los precios solamente de los almacenes que tiene ya asignados, **OJO** todos los almacenes tendran este precio...', this, event, '150px')">Agregar Precio General</option>
      <option
	  <?php if($_POST['opcion']=="asignarPrecioIndividual")echo 'selected=""';?>
	   value="asignarPrecioIndividual" onMouseover="showhint('Sirve para asignar el precio individual, no se afectan todos los demas...', this, event, '150px')">Agregar Precio Individual</option>

            <option
	  <?php if($_POST['opcion']=="tipoVenta")echo 'selected=""';?>
	   value="tipoVenta" onMouseover="showhint('Esta opcion es para decirle al sistema que cada caja contiene determinado numero de articulos...', this, event, '150px')">Venta a Granel *Opcional</option>

  <option
	  <?php if($_POST['opcion']=="almacenConsumo")echo 'selected=""';?>
	   value="almacenConsumo" onMouseover="showhint('Esta opcion es exclusiva para almacenes de consumo...', this, event, '150px')">Almacenes de Consumo</option>

    <option
	  <?php if($_POST['opcion']=="configurarExistencias")echo 'selected=""';?>
	   value="configurarExistencias" onMouseover="showhint('Esta opcion es para configurar existencias...', this, event, '150px')">Configuracion Articulo</option>

        
    </select>
    </label>
  </p>

</form>

<span>

<?php

$sSQLa= "Select * From gpoProductos where


codigoGP='".$_GET['gpoProducto']."'";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);






switch ($_POST['opcion']) {

  case "asignarAlmacen" :
  require("../cargos/agregarArticulosAlmacenes.php");
  break;

  case "costo" :
  require("../ventanas/ventanitaCambiaCosto.php");
  break;

  case "asignarPrecioGeneral" :
  require("../ventanas/ventanitaCambiaPrecio.php");
  break;


  case "asignarPrecioIndividual" :
  require("../cargos/asignarArticulosAlmacenesPrecioIndividual.php");
  break;

  case "tipoVenta" :
  require("../cargos/tipoVenta.php");
  break;

  case "almacenConsumo" :
  require("../cargos/almacenConsumo.php");
  break;

  case "precioSugerido" :
  require("../ventanas/ventanitaCambiaPC.php");
  break;


  case "configurarExistencias" :
  require("../ventanas/configurarExistencias.php");
  break;

   default :
   echo "Escoje la opcion!";
   break;

   }
?> 

</span>

</body>
</html>
