<?php require("/configuracion/ventanasEmergentes.php");require("/configuracion/funciones.php");?>
     



<?php 
if($_GET['keySOP'] AND $_GET['status']=='ontransit'){
$q=mysql_real_escape_string($q);
 $sSQL= "SELECT *
FROM
ordenesSOP
where
keySOP='".$_GET['keySOP']."'
    and
    status='ontransit'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE ordenesSOP set 
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








<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=800,height=800,scrollbars=YES") 
} 
</script>




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
ordenesSOP
where

status='ontransit'
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$r+=1;

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
  <td  ><p><?php echo $r;?></p></td>    
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
<a href="../ventanas/ontransit.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=ontransit"> 
      <?php echo $myrow['status'];?>    
</a>      
      </p>
      </td>
      
      
    </tr><?php  }}?>

  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />        
        
        
        
        
        
        
    </form>    