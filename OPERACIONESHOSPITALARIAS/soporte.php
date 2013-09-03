<?php 
require("menuOperaciones.php");
//require("/configuracion/ventanasEmergentes.php");
//require('/configuracion/funciones.php');

//$mostrarmenu=new menus();
//$mostrarmenu->menuTemplate($_GET['warehouse'],$_GET['datawarehouse'],$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,'principal',$rutaimagen,$basedatos);
$estilos=new muestraEstilos();
$estilos->styles();

?>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=800,height=800,scrollbars=YES") 
} 
</script> 

        

<?php  



if($_GET['keySOP'] AND $_GET['status']=='done'){

 $sSQL= "SELECT *
FROM
sis_ordenesSOP
where
keySOP='".$_GET['keySOP']."'
    and
    status='done'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenesSOP set 
status='ontransit'
		WHERE keySOP='".$_GET['keySOP']."'";
//$q=mysql_real_escape_string($q);
		mysql_db_query($basedatos,$q);
		echo mysql_error();
echo '
<script>                
	window.opener.document.forms["ontransit"].submit();
</script>';                
	}



}











$date=$_GET['fecha1'];$entidad=$_GET['entidad'];?>

<?php  





if($_GET['keySOP'] AND $_GET['status']=='request'){

 $sSQL= "SELECT *
FROM
sis_ordenesSOP
where
keySOP='".$_GET['keySOP']."'
    and
    status='request'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenesSOP set 
status='ontransit'
		WHERE keySOP='".$_GET['keySOP']."'";
//$q=mysql_real_escape_string($q);
		mysql_db_query($basedatos,$q);
		echo mysql_error();
echo '
<script>                
	window.opener.document.forms["ontransit"].submit();
</script>';	
	}



}


$date=$_GET['fecha1'];$entidad=$_GET['entidad'];?>



<?php 
if($_GET['keySOP'] AND $_GET['status']=='ontransit'){
$q=mysql_real_escape_string($q);
 $sSQL= "SELECT *
FROM
sis_ordenesSOP
where
keySOP='".$_GET['keySOP']."'
    and
    status='ontransit'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenesSOP set 
status='done'
		WHERE keySOP='".$_GET['keySOP']."'";
//$q=mysql_real_escape_string($q);
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                
echo '
<script>                
	window.opener.document.forms["done"].submit();
</script>';
}
}
?>

<script>
function wopen(url, name, w, h)
{
  // Fudge factors for window decoration space.
  // In my tests these work well on all platforms & browsers.
  w += 32;
  h += 96;
  wleft = (screen.width - w) / 2;
  wtop = (screen.height - h) / 2;
  // IE5 and other old browsers might allow a window that is
  // partially offscreen or wider than the screen. Fix that.
  // (Newer browsers fix this for us, but let's be thorough.)
  if (wleft < 0) {
    w = screen.width;
    wleft = 0;
  }
  if (wtop < 0) {
    h = screen.height;
    wtop = 0;
  }
  var win = window.open(url,
    name,
    'width=' + w + ', height=' + h + ', ' +
    'left=' + wleft + ', top=' + wtop + ', ' +
    'location=no, menubar=no, ' +
    'status=no, toolbar=no, scrollbars=no, resizable=no');
  // Just in case width and height are ignored
  win.resizeTo(w, h);
  // Just in case left and top are ignored
  win.moveTo(wleft, wtop);
  win.focus();
}

</script>












<?php
/*
$alturaMinima=400;

 $sSQL= "SELECT *
FROM
sis_ordenesSOP
where
entidad='".$entidad."'
and
status='request'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$totalRequest = mysql_num_rows($result);


$sSQL= "SELECT *
FROM
sis_ordenesSOP
where
entidad='".$entidad."'
and
status='ontransit'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$totalontransit = mysql_num_rows($result);

 $sSQL= "SELECT *
FROM
sis_ordenesSOP
where
entidad='".$entidad."'
and
status='done'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$totaldone = mysql_num_rows($result);

if($totaldone>0 || $totalRequest>0 || $totalontransit>0){
    $altura=NULL;
}else{
    $altura=$alturaMinima;
}
*/
?>












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--
-->
<link href="../js/styleTabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="../js/sprinkle.js"></script>
<script src="../js/jquery-1.7.2.min.js"></script>
<script>
    var $j = jQuery.noConflict();
$j(document).ready(function() {
    $j("#content div").hide(); // Initially hide all content
    $j("#tabs li:first").attr("id","current"); // Activate first tab
    $j("#content div:first").fadeIn(); // Show first tab content
    
    $j('#tabs a').mouseover(function(e) {
        e.preventDefault();
        if ($j(this).closest("li").attr("id") == "current"){ //detection for current tab
         return       
        }
        else{             
        $j("#content div").hide(); //Hide all content
        $j("#tabs li").attr("id",""); //Reset id's
        $j(this).parent().attr("id","current"); // Activate this
        $j('#' + $j(this).attr('name')).fadeIn(); // Show content for current tab
        }
    });
});
</script>































</head>
<body>
    
    
    
    
    
    <br></br>
<?php     
$q=mysql_real_escape_string($q);
?>
    <!--<div class="contenido_pagina">-->
    <div class="page_right">
        <div class="clearfix tabs">
            <ul id="tabs" class="tabs_navigation clearfix">
                <li ><a href="#1" name="tab1">Nueva Orden +</a></li>
                <li ><a href="#2" name="tab2">Pendientes</a></li>
                <li ><a href="#3" name="tab3">En Proceso</a></li>
                <li ><a href="#4" name="tab4">Terminadas</a></li>
            </ul>
        </div>
       <!--
        <div id="moving_tab">
            <ul id="tabs" >
                <li ><a href="#1" name="tab1">Nueva Orden +</a></li>
                <li ><a href="#2" name="tab2">Pendientes</a></li>
                <li ><a href="#3" name="tab3">En Proceso</a></li>
                <li ><a href="#4" name="tab4">Terminadas</a></li>  
            </ul>
        </div>
       -->
    
    
    
    
    
    
    































<div id="content"> 
    <div id="tab1">
        
<style>
    

/* 
    Document   : cssTab
    Created on : Feb 19, 2013, 4:27:15 PM
    Author     : wake
    Description:
        Purpose of the stylesheet follows.
*/

body
{
    width: 700px;
    margin: 0px auto 0 auto;
    font-family: Arial, Helvetica;
    font-size: small;
	background: #444;
}

/* ------------------------------------------------- */

#tabs{
  overflow: hidden;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
}

#tabs li{
  float: left;
  margin: 0 .5em 0 0;
}







#content
{
    background: #fff;
    padding: 2em;
    
	position: relative;
	z-index: 2;	
    -moz-border-radius: 0 5px 5px 5px;
    -webkit-border-radius: 0 5px 5px 5px;
    border-radius: 0 5px 5px 5px;
    -moz-box-shadow: 0 -2px 3px -2px rgba(0, 0, 0, .5);
    -webkit-box-shadow: 0 -2px 3px -2px rgba(0, 0, 0, .5);
    box-shadow: 0 -2px 3px -2px rgba(0, 0, 0, .5);
}










#tabs a{
  position: relative;
  background: #ddd;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ddd));
  background-image: -webkit-linear-gradient(top, #fff, #ddd);
  background-image: -moz-linear-gradient(top, #fff, #ddd);
  background-image: -ms-linear-gradient(top, #fff, #ddd);
  background-image: -o-linear-gradient(top, #fff, #ddd);
  background-image: linear-gradient(to bottom, #fff, #ddd); 
  padding: .7em 3.5em;
  float: left;
  text-decoration: none;
  color: #444;
  text-shadow: 0 1px 0 rgba(255,255,255,.8);
  -webkit-border-radius: 5px 0 0 0;
  -moz-border-radius: 5px 0 0 0;
  border-radius: 5px 0 0 0;
  -moz-box-shadow: 0 2px 2px rgba(0,0,0,.4);
  -webkit-box-shadow: 0 2px 2px rgba(0,0,0,.4);
  box-shadow: 0 2px 2px rgba(0,0,0,.4);
}

#tabs a:hover,
#tabs a:hover::after,
#tabs a:focus,
#tabs a:focus::after{
  /*background: #fff;*/
}

#tabs a:focus{
  outline: 0;
}

#tabs a::after{
  content:'';
  position:absolute;
  z-index: 1;
  top: 0;
  right: -.5em;  
  bottom: 0;
  width: 1em;
  background: #ddd;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ddd));
  background-image: -webkit-linear-gradient(top, #fff, #ddd);
  background-image: -moz-linear-gradient(top, #fff, #ddd);
  background-image: -ms-linear-gradient(top, #fff, #ddd);
  background-image: -o-linear-gradient(top, #fff, #ddd);
  background-image: linear-gradient(to bottom, #fff, #ddd);  
  -moz-box-shadow: 2px 2px 2px rgba(0,0,0,.4);
  -webkit-box-shadow: 2px 2px 2px rgba(0,0,0,.4);
  box-shadow: 2px 2px 2px rgba(0,0,0,.4);
  -webkit-transform: skew(10deg);
  -moz-transform: skew(10deg);
  -ms-transform: skew(10deg);
  -o-transform: skew(10deg);
  transform: skew(10deg);
  -webkit-border-radius: 0 5px 0 0;
  -moz-border-radius: 0 5px 0 0;
  border-radius: 0 5px 0 0;  
}

#tabs #current a{
  background: #fff;
  z-index: 3;
}

#tabs #current a::after{
  background: #fff;
  z-index: 3;
}

/* ------------------------------------------------- */












#content h2, #content h3, #content p
{
    margin: 0 0 15px 0;
}

/* ------------------------------------------------- */

#about
{
    color: #999;
}

#about a
{
    color: #eee;
}

    
    
    
</style>        
        
           
        
        
        
 <style type="text/css">
      .content .left{
        float:left;
        width:100px;
        background-color:green;
      }
      .content .right{
        margin-left:100px;
        background-color:red;
      }

    </style>         
        
        
        
        
        
        
        
        
  
        
        
        
        
        
        
        
        
        
        
<iframe src="resSoporte.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>"  
        frameborder="0" width="100%" height="400">
    Si ves este mensaje, significa que tu navegador no tiene soporte para marcos o el mismo está deshabilitado.
    </iframe>
 
    </div>
    
     
        <?php //cierra div 1?>
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              




    

    <div id="tab2">
<?php //PENDIENTES?>


<form name="request">
<br>
  <table width="600"  cellspacing="0" cellpadding="0" align="center" >
 
    <tr >
        <td ><p>#</p></td>
        <td ><p>Fecha/Hora</p></td>
      <td ><p>TipoSoporte</p></td>
      <td ><p>Departamento</p></td>
      <td ><p>RegistroPC</p></td>
<td ><p>Status</p></td>
    </tr>
<?php	


$sSQL= "SELECT *
FROM
sis_ordenesSOP
where

status='request'
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$a[0]+=1;

$nT=$myrow['keyClientesInternos'];


/*
$sSQL17d= "
SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioDevolucion = '".$myrow['folioVenta']."'
";
$result17d=mysql_db_query($basedatos,$sSQL17d);
$myrow17d = mysql_fetch_array($result17d);*/
	  ?>
    
    
      <tr>
  <td  ><p><?php echo $a[0];?></p></td>    
   <td  ><p>
       <?php 
     
		 
		  echo cambia_a_normal($myrow['fecha']);
                   echo '</br>';
	
       echo $myrow['hora'];
       ?></p>
   </td>  
   
   
   
   
   
      <td ><p><?php echo $myrow['descripcionSoporte'];
      echo '<br>';echo $myrow['keySOP'];
?></p>
      </td>
   
      
      
      
      
      <td >
<p> 
<?php


 echo $myrow['descripcionAlmacen'];
?>
          </br>
         <?php
echo $myrow['usuario'];
?></p>
          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
          <?php 
	  	 
	
		 echo $myrow['registro'];
	?></p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request"> 
      <?php echo $myrow['status'];?>    
</a>      
      </p>
      </td>
      
      </tr> 
    <?php  
    
    }
 
    if($a[0]<6){
   
        
        
        if($a[0]>0){
        for($i=0;$i<=$a[0]+6.9;$i++){?>

      <tr>
  <td  ><p></p></td>    
   <td  >
   </td>  
   
   
   
   
   
      <td >
         
      </td>
   
      
      
      
      
      <td >

          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
   </p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
      
      </p>
      </td>
      </tr>
  
  <?php }}else{
      for($i=0;$i<14;$i++){?>

      <tr>
  <td  ><p></p></td>    
   <td  >
   </td>  
   
   
   
   
   
      <td >
         
      </td>
   
      
      
      
      
      <td >

          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
   </p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
      
      </p>
      </td>
      </tr>
      <?php
  }
  }
    }}
    
    
    ?>

  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />        
        
        
        
        
        
        
    </form>  

 
    </div>

              
              
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 
    
           
<div id="tab3" >

    

    <form name="ontransit">
        




<?php  $date=$_GET['fecha1'];$entidad=$_GET['entidad'];?>

<br>
  <table width="600"  cellspacing="0" cellpadding="0" align="center" >
 
    <tr >
        <td ><p>#</p></td>
        <td ><p>Fecha/Hora</p></td>
      <td ><p>TipoSoporte</p></td>
      <td ><p>Departamento</p></td>
      <td ><p>RegistroPC</p></td>
<td ><p>Status</p></td>

    </tr>
<?php	


 $sSQL= "SELECT *
FROM
sis_ordenesSOP
where

status='ontransit'
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$r[0]+=1;

$nT=$myrow['keyClientesInternos'];


/*
$sSQL17d= "
SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioDevolucion = '".$myrow['folioVenta']."'
";
$result17d=mysql_db_query($basedatos,$sSQL17d);
$myrow17d = mysql_fetch_array($result17d);*/
	  ?>
    
    
    <tr  > 
  <td  ><p><?php echo $r[0];?></p></td>    
   <td  ><p>
       <?php 
     
		 
		  echo cambia_a_normal($myrow['fecha']);
                   echo '</br>';
	
       echo $myrow['hora'];
       ?></p>
   </td>  
   
   
   
   
   
      <td ><p><?php echo $myrow['descripcionSoporte'];
      echo '<br>';echo $myrow['keySOP'];
?>
          
<a  href="javascript:wopen('../ventanas/observacionesSOP.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>','ye', '500', '800')" onMouseover="showhint('...', this, event, '150px')">
    Observaciones
</a>   
          </p>
      </td>
   
      
      
      
      
      <td >
<p> 
<?php


 echo $myrow['descripcionAlmacen'];
?>
          </br>
         <?php
echo $myrow['usuario'];
?></p>
          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
          <?php 
	  	 
	
		 echo $myrow['registro'];
	?></p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=ontransit"> 
      <?php echo $myrow['status'];?>    
</a>      
      </p>
      </td>
      
      
    </tr><?php  }}?>
      
    <?php  
    
  
if($r[0]<6){
   
    
    if($r[0]>0){
    
    for($i=0;$i<=$r[0]+6.9;$i++){?>

      <tr>
  <td  ><p></p></td>    
   <td  >
   </td>  
   
   
   
   
   
      <td >
         
      </td>
   
      
      
      
      
      <td >

          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
   </p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
      
      </p>
      </td>
      </tr>
     <?php }}
      for($i=0;$i<=14;$i++){?>

      <tr>
  <td  ><p></p></td>    
   <td  >
   </td>  
   
   
   
   
   
      <td >
         
      </td>
   
      
      
      
      
      <td >

          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
   </p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
      
      </p>
      </td>
      </tr>
      <?php
}
}
?>
      

  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />        
        
        
        
        
        
        
    </form>    
    
    
    
</div>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
<div id="tab4" >



<form name="done">
<br>
  <table width="600"  cellspacing="0" cellpadding="0" align="center" >
 
    <tr >
        <td ><p>#</p></td>
        <td ><p>Fecha/Hora</p></td>
      <td ><p>TipoSoporte</p></td>
      <td ><p>Departamento</p></td>
      <td ><p>RegistroPC</p></td>
<td ><p>Status</p></td>

    </tr>
<?php	


 $sSQL= "SELECT *
FROM
sis_ordenesSOP
where
status='done'
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$b[0]+=1;

$nT=$myrow['keyClientesInternos'];


/*
$sSQL17d= "
SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioDevolucion = '".$myrow['folioVenta']."'
";
$result17d=mysql_db_query($basedatos,$sSQL17d);
$myrow17d = mysql_fetch_array($result17d);*/
	  ?>
    
    
    <tr  > 
  <td  ><p><?php echo $b[0];?></p></td>    
   <td  ><p>
       <?php 
     
		 
		  echo cambia_a_normal($myrow['fecha']);
                   echo '</br>';
	
       echo $myrow['hora'];
       ?></p>
   </td>  
   
   
   
   
   
      <td ><p><?php echo $myrow['descripcionSoporte'];
      echo '<br>';echo $myrow['keySOP'];
?></p>
      </td>
   
      
      
      
      
      <td >
<p> 
<?php


 echo $myrow['descripcionAlmacen'];
?>
          </br>
         <?php
echo $myrow['usuario'];
?></p>
          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
          <?php 
	  	 
	
		 echo $myrow['registro'];
	?></p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=done"> 
      <?php echo $myrow['status'];?>    
</a>      
      </p>
      </td>
      
  
  
   
  
      
    </tr><?php  }}?>
 <?php  if( $b[0]<6){
        
  if($b[0]>0){
  
      
      for($i=0;$i<=$b[0]+6.9;$i++){?>

      <tr>
  <td  ><p></p></td>    
   <td  >
   </td>  
   
   
   
   
   
      <td >
         
      </td>
   
      
      
      
      
      <td >

          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
   </p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
      
      </p>
      </td>
      </tr>
     <?php }
     
     
     }else{
         
      for($i=0;$i<=14;$i++){?>

      <tr>
  <td  ><p></p></td>    
   <td  >
   </td>  
   
   
   
   
   
      <td >
         
      </td>
   
      
      
      
      
      <td >

          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td >
          <p>
   </p>
      </td>
      
      
      
      
      
      <td >
          
          
          
      <p>    
      
      </p>
      </td>
      </tr>   
         
     <?php
     }
     
     }
     
     }
     
     
     
     ?>
  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />        
        
        
        
        
        
        
    </form>        
        
        
        
</div>
</div>
</div>
<?php
$mostrarFooter=new menus();
$mostrarFooter->footerTemplate($usuario,$entidad,$basedatos);
?> 
</body>
</html>
