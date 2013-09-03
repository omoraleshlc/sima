<?php require("/configuracion/ventanasEmergentes.php");



if($_POST['ADDSW']!=NULL and $_GET['solicitud']>0){
    
    
    
$sSQL1= "Select * From sis_relacionSWEquipos WHERE entidad='".$entidad."'
    and
    solicitud='".$_GET['solicitud']."'
    and licencia = '".$_POST['licenciaSW']."' and keySWF='".$_POST['keySW']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

 $sqlNombre11 = "SELECT * from sis_SW

where
keySW='".$_POST['keySW']."'";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);
$rNombre11=mysql_fetch_array($resultaNombre11);   

if(!$myrow1['solicitud']){
    
    
 
$agrega = "INSERT INTO sis_relacionSWEquipos (
solicitud,licencia,usuario,fecha,hora,entidad,keySWF,descripcion
) values (
'".$_GET['solicitud']."','".$_POST['licenciaSW']."',
'".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$_POST['keySW']."','".$rNombre11['descripcion']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
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

    
    
  
<form name="form1" method="post" >

<table width="450" align="left">
    
      
      <td ><div align="left"></div></td>

    
     <td ><div align="left">
             

    <select name="keySW"  id="keySW" onChange="this.form.submit();" >

          <option value="">---</option>
<?php


$sqlNombre11a = "SELECT * from sis_SW

ORDER BY descripcion ASC";
$resultaNombre11a=mysql_db_query($basedatos,$sqlNombre11a);


  while ($rNombre11a=mysql_fetch_array($resultaNombre11a)){ 
  echo mysql_error();?>
            <option
                  <?php   if($_POST["keySW"]==$rNombre11a['keySW']){echo 'selected=""';}?>
                value="<?php echo $rNombre11a["keySW"];?>"><?php echo $rNombre11a["descripcion"];?></option>
            <?php } ?>
            </select>
              
      
    </div></td>
       
      
      
      
      
      
      
      
      
      
      
      
      
      <td ><div align="left">
             <?php if($_POST['keySW']!=NULL){?>
             
              <input type="text"  name="licenciaSW" placeholder="Licencia"></input>
              <input type="submit" value="ADD" name="ADDSW"></input>
              
                  <?php } ?>       
               
           </div></td>
      
      
      
      
      
      
<td ><div align="left"></div></td>
    </tr>
              
              
              <?php 


if(!$_POST['update'] and !$_POST['ADDSW'] and $_GET['keySW']>0 and $_GET['del']=='si'){


 $q = "DELETE FROM sis_relacionSWEquipos
		
		WHERE 
 keySW='".$_GET['keySW']."'                

";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}


?>


    
    
    
    
<?php	



$sSQL= "SELECT *
FROM
sis_relacionSWEquipos
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
      
       <a href="c1.php?keySW=<?php echo $myrow['keySW'];?>&del=si&solicitud=<?php echo $_GET['solicitud'];?>&descripcion=<?php echo $myrow['descripcion'].$myrow['licencia'];?>&seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> 
          X
          </a>
   </td>  
      
      
      
      
      
    </tr><?php  }}?>
    </table>
    
    
</form>
    
</body>
</html>