<?php require("menuOperaciones.php"); ?>

<?php //require('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 




<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventanaSecundaria1","width=650,height=700,scrollbars=YES")
}
</script>





<?php  
if($_POST['update'] and $_POST['descripcion']!=NULL and $_POST['codigoRol']!=NULL and $_POST['keyR']!=NULL){
$descripcion=$_POST['descripcion'];
$codigoRol=$_POST['$codigoRol'];
$keyR=$_POST['keyR'];




for($i=0;$i<=$_POST['flag'];$i++){
    
    
    if($tipo[$i]!=NULL and $keyRCT[$i]){
$sSQL1= "Select * From roles where 

keyR='".$keyR[$i]."' 
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);


if($myrow1['codigoRol']){
 $agrega = "UPDATE roles
    set
descripcion='".$descripcion[$i]."',
codigoRol='".$codigoRol[$i]."'
WHERE
keyR='".$keyR[$i]."'

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
    codigoRol='".$_POST['codigoRol1']."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);


if(!$myrow1['codigoRol']){
$agrega = "INSERT INTO roles (
codigoRol,descripcion,entidad
) values ('".$_POST['codigoRol1']."','".$_POST['descripcion1']."','".$entidad."')";
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
    $sSQL1= "Select * From roles where 
   keyR='".$_GET['keyR']."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
  
    
    
    
$agrega = "DELETE FROM roles 
WHERE

keyR='".$_GET['keyR']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega = "DELETE FROM usersmodules 
WHERE
entidad='".$entidad."'
    and
usuario='".$myrow1['codigoRol']."'
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
     
     
          <tr>
       <td  >
       
         <?php echo $a;?>         
       
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
           <input value="<?php echo $myrow['descripcion'];?>" size="60" type="text" name="descripcion[]"></input>
           <?php }else{?>
            <input value="<?php echo $myrow['descripcion'];?>" type="hidden" name="descripcion[]"></input>
       <?php echo $myrow['descripcion'];?>
       <?php }?>           
           
       </td>
         
         
         
     <td ><a href="javascript:ventanaSecundaria1('ventanaRolesModulos.php?entidades=<?php echo $entidad;?>&usuario=<?php echo $myrow['codigoRol'];?>&campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&numeroExpediente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_POST['seguro']; ?>')" >Add</a></td>    
       <td ><a href="roles.php?edit=yes&keyR=<?php echo $myrow['keyR'];?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>" onClick="this.form.submit();">Edit</a></td>
           <td ><a href="roles.php?del=yes&keyR=<?php echo $myrow['keyR'];?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>" onClick="this.form.submit();">X</a></td>

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
                <a href="roles.php?add=yes&keyR=<?php echo '';?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>" onClick="this.form.submit();">
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
<p>&nbsp;</p>


</form>
 <p align="center">&nbsp;</p>
</body>
</html>