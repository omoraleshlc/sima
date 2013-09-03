<?php require("/configuracion/ventanasEmergentes.php");




if($_POST['tipoConexion']!=NULL and $_POST['ADDTC'] and $_GET['solicitud']>0){
    

    
$sSQL1= "Select * From relacionTCEquipos WHERE entidad='".$entidad."'
    and
    solicitud='".$_GET['solicitud']."'
    and IP = '".$_POST['ip']."' and MAC='".$_POST['mac']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

  

if(!$myrow1['solicitud']){
    
    
 
$agrega = "INSERT INTO relacionTCEquipos (
solicitud,IP,usuario,fecha,hora,entidad,MAC,tipoConexion
) values (
'".$_GET['solicitud']."','".$_POST['ip']."',
'".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$_POST['mac']."','".$_POST['tipoConexion']."'
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

    
    
    
    
<form name="forma1" method="POST">

<table width="500"  align="left">
    
      
      <td ><div align="left"></div></td>

    
     <td scope="col"><div align="left">
    <select name="tipoConexion"  id="entidad" onChange="this.form.submit();">
        <option value="">Escoje</option>
        <option
            <?php if($_POST['tipoConexion']=='orientada'){echo 'selected=""';}?>
            value="orientada">Orientada</option>
        <option
            <?php if($_POST['tipoConexion']=='wireless'){echo 'selected=""';}?>
            value="wireless">Wireless</option>
            </select>
              
      
    </div></td>
      
      
      
      
      
      
      
       <td ><div align="left">
                <?php if($_POST['tipoConexion']!=NULL){?>
              <input type="search"  name="ip" value="" placeholder="IP"></input>
             
              
           </div></td>
      
      
      
      
      
      
      
      
      
      <td ><div align="left">
              
 <input type="search"  name="mac" value="" placeholder="DIRECCION MAC"></input>              
              
          </div></td> 
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
  <td ><div align="left">
         
      </div></td>
      
        <td ><div align="left">
  
                <input type="submit" value="ADD" name="ADDTC"></input>                
      </div></td>
      
          <?php } ?> 
    </tr>
              
              
              <?php 


if(!$_POST['update'] and !$_POST['ADDIP'] and $_GET['keyTC']>0 and $_GET['del']=='si'){


 $q = "DELETE FROM relacionTCEquipos
		
		WHERE 
 keyTC='".$_GET['keyTC']."'                

";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}


?>
    
    
    
    


    
    
    
    
<?php	



$sSQL= "SELECT *
FROM
relacionTCEquipos
where solicitud='".$_GET['solicitud']."'
order by keyTC ASC
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$r+=1;


	  ?>
    
    
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" > 
  <td  class="codigos"><?php echo $r;?></td>   
  
    <td  class="codigos">
       <?php 
            echo $myrow['tipoConexion'];
       ?>
     
   </td>   
  
  
   <td  class="codigos">
       <?php 
            echo $myrow['IP'];
       ?>
  
   </td>   
  
  <td  class="codigos">
       <?php 
            echo $myrow['MAC'];
       ?>
     
   </td>
  
  
  
  
  <td  class="codigos">
   </td>
  
  
    
        <td  class="codigos">
            <div align="center">
       <a href="ctipoConexion.php?keyTC=<?php echo $myrow['keyTC'];?>&del=si&solicitud=<?php echo $_GET['solicitud'];?>&descripcion=<?php echo $myrow['descripcion'].$myrow['licencia'];?>&seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> 
          X
          </a>
            </div>
   </td>  
      
      
      
      
      
    </tr><?php  }}?>
    </table>
    
    
</form>
    
</body>
</html>