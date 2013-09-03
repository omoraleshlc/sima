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
  <table width="650"  cellspacing="0" cellpadding="0" align="center">
 
    <tr >
        <td >#</td>
        <td  >Fecha/Hora</td>
      <td > TipoSoporte</td>
      <td >Departamento</td>
      <td >RegistroPC</td>
<td >Status</td>
    </tr>
<?php	

$_GET['ordenesPendientes']='ordenesPendientes';
$_GET['tipoOrden']=1;
if($_GET['tipoOrden']!=NULL){ 
if($_GET['tipoOrden']=='ordenesPendientes'){
 $sSQL= "SELECT *
FROM
ordenesSOP
where
entidad='".$entidad."'
and
status='standby'
 ";
}else{
 $sSQL= "SELECT *
FROM
ordenesSOP
where
entidad='".$entidad."'
and
status='standby'
 ";
}



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
  <td  ><?php echo $r;?></td>    
   <td  >
       <?php 
     
		 
		  echo cambia_a_normal($myrow['fecha']);
                   echo '</br>';
	
       echo $myrow['hora'];
       ?>
   </td>     
      <td >  <?php echo $myrow['descripcionSoporte'];
?></td>
      <td >
 
<?php


 echo $myrow['descripcionAlmacen'];
?>
          </br>
          <span ></span><span class="codigos"><?php
echo $myrow['usuario'];
?></span>
          	 
		  
		  
      </td>
     
      
      
      
      
      
      <td ><?php 
	  	 
	
		 echo $myrow['registro'];
	?>
      </td>
      
      
      
      
      
      <td ><?php 
	  	  echo $myrow['status'];
?>
      </td>
      
      
    </tr><?php  }}}?>

  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />