<?PHP require("/configuracion/ventanasEmergentes.php"); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

<style type="text/css">

#hintbox{ /*CSS for pop up hint box */
position:absolute;
top: 0;
background-color: lightyellow;
width: 150px; /*Default width of hint.*/
padding: 3px;
border:1px solid black;
font:normal 11px Verdana;
line-height:18px;
z-index:100;
border-right: 3px solid black;
border-bottom: 3px solid black;
visibility: hidden;
}

.hintanchor{ /*CSS for link that shows hint onmouseover*/
font-weight: bold;
color: navy;
margin: 3px 8px;
}

</style>

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



<form id="form1" name="form1" method="post" action="">

  <p align="center">
    <label>
    <select name="opcion" id="opcion" onchange="this.form.submit();"  class="precio1" >
	
        
        <option
	<?php if($_POST['opcion']=="0")echo 'selected=""';?>
	 value="0">---</option>


      <option
	  <?php if($_POST['opcion']=="Servicios")echo 'selected=""';?>
	   value="Servicios" onMouseover="showhint('Esta opcion es para agregar servicios...', this, event, '150px')">Agregar Servicios</option>
        
        
        <option
	  <?php if($_POST['opcion']=="Modificar")echo 'selected=""';?>
	   value="Modificar" onMouseover="showhint('Esta opcion es para modificar al medico...', this, event, '150px')">Editar Medico</option>
      
    </select>
    </label>
  </p>

</form>

<span class="negromid">

<?php



switch ($_POST['opcion']) {

   case "Servicios" :
  include("serviciosMedicos.php");
   break;

   case "Modificar" :
  include("catmedicosE.php");
   break;

   case "asignarPrecioGeneral" :
      // if($myrowa['afectaExistencias']!='si'){
    include("../ADMINHOSPITALARIAS/inventarios/ventanitaCambiaPrecio.php");
       //}else{
         //  echo 'Solo son articulos con stock..';
       //}
   break;


   case "asignarPrecioIndividual" :
       //if($myrowa['afectaExistencias']!='si'){
    include("../cargos/asignarArticulosAlmacenesPrecioIndividual.php");
       //}else{
    //echo 'Solo son articulos con stock..';
      // }
   break;

   case "tipoVenta" :
    include("../cargos/tipoVenta.php");
   break;

   case "almacenConsumo" :
    include("../cargos/almacenConsumo.php");
   break;

   default :
   echo "Escoje la opcion!";
   break;

   }
?> 

</span>

</body>
</html>
