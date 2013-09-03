<?php require("/configuracion/ventanasEmergentes.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<body>

    
     
    
<form name="formato" method="post">

<table  width="450"  align="left">
    
      
      <td ><div align="left"></div></td>

    
    
      
      
      
            <td ><div align="left">
                        <?php if($_POST['keyOS']!=NULL){?>
                    

              <input type="search"  name="licenciaOS"  placeholder="LICENCIA"></input>
              <input type="submit" value="ADD" name="ADDOS"></input>
              
                  <?php } ?>     
                </div></td>
            
                  <td ><div align="left"></div></td>
      
      
    </tr>
              
              
              <?php 


if(!$_POST['update'] and !$_POST['ADDOS'] and $_GET['keyRO']>0 and $_GET['del']=='si'){


$q = "DELETE FROM sis_relacionOSEquipos
		
		WHERE 
 keyRO='".$_GET['keyRO']."'                

";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}


?>


    
    
    
    
<?php	



$sSQL= "SELECT *
FROM
sis_relacionOSEquipos
where solicitud='".$_GET['solicitud']."'
order by descripcion ASC
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$r+=1;


	  ?>
    
    
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" > 
  <td  class="codigos"><?php echo $r;?></td>    
   <td  class="codigos">
       <?php 
            echo $myrow['descripcion'];
       ?>
  
   </td>   
  
     <td  class="codigos">
       <?php 
            echo $myrow['licencia'];
       ?>
       
     
   </td>
  
  
  
     <td  class="codigos">
 
       <a href="fos.php?keyRO=<?php echo $myrow['keyRO'];?>&del=si&solicitud=<?php echo $_GET['solicitud'];?>&codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> 
          X
          </a>
   </td>
  
    
      
      
      
      
      
      
    </tr><?php  }}?>
    </table>
    
    
</form>
    
</body>
</html>