<?php require("/configuracion/ventanasEmergentes.php");require("/configuracion/funciones.php");?>

        
        
        

<?php  





if($_GET['keySOP'] AND $_GET['status']=='request'){

 $sSQL= "SELECT *
FROM
ordenesSOP
where
keySOP='".$_GET['keySOP']."'
    and
    status='request'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE ordenesSOP set 
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
ordenesSOP
where

status='request'
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
      
      
    </tr><?php  }}?>

  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />        
        
        
        
        
        
        
    </form>    