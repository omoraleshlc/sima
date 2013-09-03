<?php require("menuOperaciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=800,height=800,scrollbars=YES") 
} 
</script> 

        

<?php  



if($_GET['keySOP'] AND $_GET['status']=='done'){

 $sSQL= "SELECT *
FROM
sis_ordenes
where
keySOP='".$_GET['keySOP']."'
    and
    status='done'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenes set 
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













if($_GET['keySOP'] AND $_GET['status']=='request'){

 $sSQL= "SELECT *
FROM
sis_ordenes
where
keySOP='".$_GET['keySOP']."'
    and
    status='request'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenes set 
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


?>



<?php 
if($_GET['keySOP'] AND $_GET['status']=='ontransit'){
$q=mysql_real_escape_string($q);
 $sSQL= "SELECT *
FROM
sis_ordenes
where
keySOP='".$_GET['keySOP']."'
    and
    status='ontransit'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenes set 
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
sis_ordenes
where
entidad='".$entidad."'
and
status='request'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$totalRequest = mysql_num_rows($result);


$sSQL= "SELECT *
FROM
sis_ordenes
where
entidad='".$entidad."'
and
status='ontransit'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$totalontransit = mysql_num_rows($result);

 $sSQL= "SELECT *
FROM
sis_ordenes
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





<?php  
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "DELETE FROM sis_inventarioEqComputo WHERE solicitud='".$_GET['solicitud']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>



<?php 
$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
sis_contadorEquipos
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}



$agrega = "INSERT INTO sis_contadorEquipos (
usuario,contador,entidad
) values (
'".$usuario."','".$n."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../js/styleTabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="../js/sprinkle.js"></script>
<script src="../js/jquery-1.7.2.min.js"></script>
<script>
$(document).ready(function() {
    $("#content div").hide(); // Initially hide all content
    $("#tabs li:first").attr("id","current"); // Activate first tab
    $("#content div:first").fadeIn(); // Show first tab content
    
    $('#tabs a').mouseover(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return       
        }
        else{             
        $("#content div").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('name')).fadeIn(); // Show content for current tab
        }
    });
});
</script>































</head>
<body>


    
    
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
    width: 800px;
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
    
    
    
    
    
    
    
    
    
    <br></br>
<?php     
$q=mysql_real_escape_string($q);
?>
   <div id="moving_tab">

 <ul id="tabs" >
    
    
    <li ><a href="#1" name="tab1">Marca</a></li>
    <li ><a href="#2" name="tab2">Plan</a></li>
    <li ><a href="#3" name="tab3"><?php echo utf8_decode("Compañia");?></a></li>
</ul>
        </div>
    
    
    
    
    
    
    































              
              
              
              
              
              
              
              
              
              
              
              
              
<div id="content"> 
<div id="tab1">   
<?php 
#REVISAR LA CANTIDAD DE REGISTROS
############RETRIEVE CAMPO LLAVE############
$sSQLhei= "Select count(*) as height From sis_marcasCell  ";
$resulthei=mysql_db_query($basedatos,$sSQLhei);
$myrowhei = mysql_fetch_array($resulthei);

if($myrowhei[0]>=11){
echo $altura=500+$myrowhei[0];
    }else{
$altura=500;        
    }
###################################

?>
<iframe src="../ventanas/ventanaCatalogoMarcasCelular.php?solicitud=<?php echo $n; ?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&solicitud=<?php echo $n;?>&test=10" frameborder="0" width="100%" height="<?php echo $altura;?>">
    Si ves este mensaje, significa que tu navegador no tiene soporte para marcos o el mismo está deshabilitado.
    </iframe>        
    </div>
    
     
        <?php //cierra div 1?>              
              
              
              
              

              
              
    <div id="tab2">    
<iframe src="../ventanas/ventanaCatalogoPlanCell.php?solicitud=<?php echo $n; ?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&solicitud=<?php echo $n;?>&test=10"  
        frameborder="0" width="100%" height="500">
    Si ves este mensaje, significa que tu navegador no tiene soporte para marcos o el mismo está deshabilitado.
    </iframe>        
    </div>
    
     
        <?php //cierra div 3?>     
    
    
    
    
        <div id="tab3">    
<iframe src="../ventanas/ventanaCatalogoCompany.php?solicitud=<?php echo $n; ?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&solicitud=<?php echo $n;?>&test=10"  
        frameborder="0" width="100%" height="500">
    Si ves este mensaje, significa que tu navegador no tiene soporte para marcos o el mismo está deshabilitado.
    </iframe>        
    </div>
    
     
        <?php //cierra div 3?>   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 
    
        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   

</div>

        
        

 
</body>
</html>