<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>



<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>











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








 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.Estilo24 {font-size: 14px}
-->
</style>
<head>

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

<form id="form10" name="form10" method="post" >
  <h1 align="center" class="titulo">Kardex de Articulos</h1>
  
  
  
  
  
  
  
  

  <img src="../../imagenes/bordestablas/borde1.png" width="500" height="24" />
  <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" class="normal">






      <tr>






      <td width="250" bgcolor="#CCCCCC"><label>
          <label>
              Fecha Inicial
   <input name="fechaInicial" type="text" class="none" id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
   </label>
   <input name="button" type="button" class="none" id="lanzador" value="..." />

      </label></td>



    </tr>







          <tr>

      <td width="250" bgcolor="#CCCCCC"><label>
          <label>
              Fecha Final
   <input name="fechaFinal" type="text" class="none" id="campo_fecha1" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
   </label>
   <input name="button" type="button" class="none" id="lanzador1" value="..." />

      </label></td>

    </tr>





      



          <tr><td width="250" height="40" bgcolor="#CCCCCC"><label>
       
              Descripcion Articulo
   <input name="descripcion" type="text" class="none"  size="60" value="<?php echo $_POST['descripcion']; ?>" />
      </label></td>

    </tr>
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" width="500" height="24" />
  
  
  
  
  
  
  
  <p align="center" class="titulo">
    <input name="buscar" type="submit" class="normal" id="button" value="Buscar" />
  </p>
  <p align="center" class="titulo">&nbsp; </p>
  
  

  
  
  <?php if($_POST['buscar'] and $_POST['descripcion']!=NULL ){ ?>
  

  
  
  
  
  
  
  
  <table width="700" border="0.2" align="center" cellpadding="4" cellspacing="0" class="normal">
<tr bgcolor="#FFFF00">
         <th width="5" class="normal" scope="col"><div align="left">#</div></th>
        <th width="5" class="normal" scope="col"><div align="left">KEY</div></th>
      <th width="100" class="normal" scope="col"><div align="left">Descripcion</div></th>
       <th width="20" class="normal" scope="col"><div align="left">Sustancia</div></th>
        <th width="10" class="normal" scope="col"><div align="left">Grupo</div></th>
      <th width= "3" class="normal" scope="col"><div align="left">---</div></th>
      
    </tr>
   


<?php	
$desc=$_POST['descripcion'];

  $sSQL= "SELECT *
FROM
articulos
where
(entidad='".$entidad."'
and
(descripcion like '%$desc%'
or sustancia like '%$desc%' or descripcion1 like '%$desc%')
    and
    (gpoProducto='MAT' or gpoProducto='PAT' or gpoProducto='MEDC' or gpoProducto='GEN'))
          
          
or
          
          
          (entidad='".$entidad."' and cbarra='".$desc."')
              
or

(entidad='".$entidad."' and keyPA='".$desc."')
          
order  by descripcion ASC
 ";

 
 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$a+=1;





	  ?>


      <tr bgcolor="#ffffff"  onMouseOut="bgColor='#ffffff'" >


      <td   class="normal">
          <div align="left"><?php echo $a;?>
          </div>
      </td>

      
            <td   class="normal">
          <div align="left"><?php echo $myrow['keyPA'];?>
          </div>
      </td>
      

      <td  class="normal">
          <div align="left">
          <?php echo $myrow['descripcion'];
          echo  '<br>';
          echo $myrow['cbarra'];
          ?>
              
          </div>
      </td>




 <td width="10"  class="normal">



  <div align="left">
    <?php
    echo $myrow['sustancia'];
    ?>
  </div>

 </td>




           <td width="3"  class="normal">



  <div align="left">

      <?php 
      
      $sSQL39="	SELECT 
*
FROM
gpoProductos
WHERE codigoGP='".$myrow['gpoProducto']."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

      echo $myrow39['descripcionGP'];?>

  </div>

 </td>
















<td width="10"  class="normal">

<a href="javascript:ventanaSecundaria5('verkardex.php?keyPA=<?php echo $myrow['keyPA']; ?>&descripcion=<?php echo ltrim($myrow['descripcion']); ?>
&cbarra=<?php echo $myrow['cbarra'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>&gpoProducto=<?php echo $myrow39['descripcionGP'];?>
&fechaCreacion=<?php echo $myrow['fecha'];?>&fechaActualizacion=<?php echo $myrow['fechaActualizacion'];?>&usuarioCreacion=<?php echo $myrow['usuario'];?>');"   />
VER
</a>

</td>

    

    </tr>



      
    <?php  }}}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>

</form>


<?php if($a>0){?>
  <p align="center" class="titulo"><?php echo 'Se encontraron '.$a.' registros';?></p>
<?php }?>


<script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario
});
</script>
    <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
</body>

</html>
