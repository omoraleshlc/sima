<?php 
//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');require('/configuracion/funciones.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

?><?php  $date=$_GET['fecha1'];$entidad=$_GET['entidad'];?>

<br>
  <table width="650"  cellspacing="0" cellpadding="0" align="center" >
 
    <tr >
        <td ><p>#</p></td>
        <td ><p>Fecha/Hora</p></td>
      <td ><p>TipoSoporte</p></td>
      <td ><p>Departamento</p></td>
      <td ><p>RegistroPC</p></td>
<td >Status</td>
    </tr>
<?php	


 $sSQL= "SELECT *
FROM
ordenesSOP
where
entidad='".$entidad."'
and
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
          <?php 
	  	  echo $myrow['status'];
?></p>
      </td>
      
      
    </tr><?php  }}?>

  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />