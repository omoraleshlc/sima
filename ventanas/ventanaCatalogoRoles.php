<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 


<?php  
if($_POST['update'] and $_POST['descripcion']!=NULL and $_POST['tipo']!=NULL and $_POST['keyRCT']!=NULL){
$descripcion=$_POST['descripcion'];
$tipo=$_POST['tipo'];
$keyRCT=$_POST['keyRCT'];




for($i=0;$i<=$_POST['flag'];$i++){
    
    
    if($tipo[$i]!=NULL and $keyRCT[$i]){
$sSQL1= "Select * From relacionClientesTipo where 

keyRCT='".$keyRCT[$i]."' 
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);


if($myrow1['tipo']){
 $agrega = "UPDATE relacionClientesTipo
    set
descripcion='".$descripcion[$i]."',
tipo='".$tipo[$i]."'
WHERE
keyRCT='".$keyRCT[$i]."'

";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
//echo '<div class="success">Se actualizaron registros</div>';
}
}
$_GET['edit']=NULL;
}




?>















<?php 

if($_GET['add']=='yes' and $_POST['codigoRol1']!=NULL and $_POST['descripcion1']!=NULL){
  

    

//AGREGAR MANUALMENTE
    $sSQL1= "Select * From roles where 
    entidad='".$entidad."'
    and
    codigoRol='".$_POST['codigoRol']."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);


if(!$myrow1['tipo']){
$agrega = "INSERT INTO roles (
codigoRol,descripcion,entidad
) values ('".$_POST['codigoRol']."','".$_POST['descripcion1']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{
 echo '<div class="error">Ya existe este tipo!</div>';     
}
  //echo '<div class="success">Se agregaron registros</div>';  
    //*******************
  $_GET['add']  =NULL;
}










if($_GET['del']=='yes' and $_GET['keyR']!=NULL ){
  
//DELETE
//    $sSQL1= "Select * From roles where 
//   keyRCT='".$_GET['keyRCT']."'";
//$result1=mysql_db_query($basedatos,$sSQL1); 
//$myrow1 = mysql_fetch_array($result1);
//    
//    
    
    
    
$agrega = "DELETE FROM roles 
WHERE

keyR='".$_GET['keyR']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



    //echo '<div class="success">Se eliminaron registros</div>';
    //*******************
    
}

?>











<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>


</head>

<body>



     

<body >
<form name="form1" method="post">
    <p>&nbsp;</p>
    <h2>
       Cat&aacute;logo de Roles
    </h2>
    
  


    
    
    
    
    
    
    






   <p align="center">&nbsp;</p>
   <table width="500" class="table table-striped">
     <tr>
       <th width="10" ><div align="left">#</div></th>
       <th width="150" ><div align="left">Clave</div></th>
       <th width="400" >Descripci&oacute;n</th>
       <th>&nbsp;</th>
       <th>&nbsp;</th>
     </tr>
     <tr>
<?php
if($_GET['edit']!=NULL or $_GET['add']!=NULL){
$v=1;
}


$sSQL= "Select * From roles where entidad='".$entidad."' order by descripcion ASC";
$result=mysql_db_query($basedatos,$sSQL); 
       
while($myrow = mysql_fetch_array($result)){
$a+=1;
$C=$myrow['codigo'];



?>
       <td  >
       
         <?php echo $myrow['codigoRol'];?>         
       
       </td>
         
         
       <td >
       <?php if($_GET['edit']=='yes' && $_GET['keyR']==$myrow['keyR']){?>
           <input value="<?php echo $myrow['codigoRol'];?>" name="codigoRol[]" type="text"></input>
           <?php }else{?>
            <input value="<?php echo $myrow['codigoRol'];?>" type="hidden" name="codigoRol[]"></input>
      <?php echo $myrow['codigoRol'];?>
       <?php }?>
       </td>
       
       
<td >
       <?php if($_GET['edit']=='yes' && $_GET['keyR']==$myrow['keyR']){?>
           <input value="<?php echo $myrow['descripcion'];?>" type="text" name="descripcion[]"></input>
           <?php }else{?>
            <input value="<?php echo $myrow['descripcion'];?>" type="hidden" name="descripcion[]"></input>
       <?php echo $myrow['descripcion'];?>
       <?php }?>           
           
       </td>
         
         
         
         
       <td ><a href="ventanaCatalogoRoles.php?edit=yes&keyR=<?php echo $myrow['keyR'];?>" onClick="this.form.submit();">Edit</a></td>
           <td ><a href="ventanaCatalogoRoles.php?del=yes&keyR=<?php echo $myrow['keyR'];?>" onClick="this.form.submit();">X</a></td>
     </tr>
       
       <input type="hidden" name="keyR[]" value="<?php echo $myrow['keyR'];?>"></input>
     <?php }?>
       
       <tr>
       
       
       
       
       
       
       
       
       
         <td ></td>
       
       
       <td >
       <?php if($_GET['add']=='yes'){?>
           <input type="text" size="4" name="codigoRol1"></input>
       <?php }?>
       </td>
       
        <td >
            <?php if($_GET['add']=='yes'){?>
            <input type="text" name="descripcion1"></input>
        <?php }?>
        </td>
      
        <td ><div align="left">
                <a href="ventanaCatalogoRoles.php?add=yes&keyR=<?php echo '';?>" onClick="this.form.submit();">
               +
                </a>
            </div></td>
        
        <td>&nbsp;</td>
    </tr>    
        
   </table>


   <div align="center">
        <input type="hidden" name="flag"  value="<?php echo $a;?>"></input>
        <?php if($v>0 AND ($a>0 or $_GET['add']=='yes')){?>
       <input type="submit" name="update"  value="Grabar"></input>
       <?php } ?>
       
   </div>
   </form>
</body>        
</html> 