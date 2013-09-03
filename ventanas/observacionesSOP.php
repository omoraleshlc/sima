<?php require("/configuracion/ventanasEmergentes.php");require("/configuracion/funciones.php");






if($_POST['ADDOS']!=NULL and $_GET['keySOP']>0 ){
    
$sSQL1=mysql_real_escape_string($sSQL1);   
$agrega=mysql_real_escape_string($agrega);   





    
    
 if( $_POST['descripcion']!=NULL){
$agrega = "INSERT INTO observacionesSOP (
descripcion,keySOP,usuario,fecha,hora,entidad
) values (
'".$_POST['descripcion']."','".$_GET['keySOP']."',
'".$usuario."','".$fecha1."','".$hora1."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
   
echo '<script>';
//echo 'window.opener.document.forms["form1"].submit();';
echo 'window.close();';
echo '</script>';
 }else{
echo '<script>';
//echo 'window.opener.document.forms["form1"].submit();';
echo 'window.close();';
echo '</script>';
     
 }

}
               


?>

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

    
    
    
    <br></br>
     
<form name="forma1" method="POST">

<table  width="450"  align="center">
    
      
      <td ><div align="left"></div></td>

    
     <td scope="col"><div align="center">
    
             <textarea name="descripcion" cols="50" rows="5"></textarea>
              
     
    </div></td>
      
      
      
            <td ><div align="left">
                        
                    

              <input type="submit" value="Agregar/Cerrar" name="ADDOS"></input>
             
                
                </div></td>
            
                  <td ><div align="left"></div></td>
      
      
    </tr>
              
              
              <?php 


if(!$_POST['update'] and !$_POST['ADDOS'] and $_GET['keyO']>0 and $_GET['del']=='si'){


$q = "DELETE FROM observacionesSOP
		
		WHERE 
 keyO='".$_GET['keyO']."'                

";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}


?>


    
    <br></br>
    
    
<?php	



$sSQL= "SELECT *
FROM
observacionesSOP
where keySOP='".$_GET['keySOP']."'
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
 
       <a href="observacionesSOP.php?keySOP=<?php echo $_GET['keySOP'];?>&keyO=<?php echo $myrow['keyO'];?>&del=si&solicitud=<?php echo $_GET['solicitud'];?>&codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> 
          X
          </a>
   </td>
  
    
      
      
      
      
      
      
    </tr><?php  }}?>
    </table>
    
    
</form>
    
</body>
</html>