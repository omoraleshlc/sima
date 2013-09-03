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

if($_GET['add']=='yes' and $_POST['tipo1']!=NULL and $_POST['descripcion1']!=NULL){
  

    

//AGREGAR MANUALMENTE
    $sSQL1= "Select * From relacionClientesTipo where 
    entidad='".$entidad."'
    and
    tipo='".$_POST['tipo1']."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);


if(!$myrow1['tipo']){
$agrega = "INSERT INTO relacionClientesTipo (
descripcion,tipo,entidad
) values ('".$_POST['descripcion1']."','".$_POST['tipo1']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{
 echo '<div class="error">Ya existe este tipo!</div>';     
}
  //echo '<div class="success">Se agregaron registros</div>';  
    //*******************
  $_GET['add']  =NULL;
}










if($_GET['del']=='yes' and $_GET['keyRCT']!=NULL ){
  
//DELETE
    $sSQL1= "Select tipo From relacionClientesTipo where 
   keyRCT='".$_GET['keyRCT']."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
    
    
$agrega = "DELETE FROM relacionClientesTipo 
WHERE
keyRCT='".$_GET['keyRCT']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega = "DELETE FROM relacionCliente
WHERE
entidad='".$entidad."'
    and
tipo='".$myrow1['tipo']."'
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



	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php 
$sSQL3= "SELECT 
laboratorioReferido
FROM cargosCuentaPaciente
WHERE keyCAP ='".$_GET['keyCAP']."'";

$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



$sSQL31= "SELECT 
*
FROM cargosCuentaPaciente
WHERE keyCAP ='".$_GET['keyCAP']."'";

$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>

<body >
<form name="form1" method="post">
    <p>&nbsp;</p>
    <h2>
       Cat&aacute;logo de Tipo de Clientes
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


$sSQL= "Select * From relacionClientesTipo where entidad='".$entidad."' order by keyRCT ASC";
$result=mysql_db_query($basedatos,$sSQL); 
       
while($myrow = mysql_fetch_array($result)){
$a+=1;
$C=$myrow['codigo'];



?>
       <td  >
       
         <?php echo $a?>         
       
       </td>
         
         
       <td >
       <?php if($_GET['edit']=='yes' && $_GET['keyRCT']==$myrow['keyRCT']){?>
           <input value="<?php echo $myrow['tipo'];?>" name="tipo[]" type="text"></input>
           <?php }else{?>
            <input value="<?php echo $myrow['tipo'];?>" type="hidden" name="tipo[]"></input>
      <?php echo $myrow['tipo'];?>
       <?php }?>
       </td>
       
       
<td >
       <?php if($_GET['edit']=='yes' && $_GET['keyRCT']==$myrow['keyRCT']){?>
           <input value="<?php echo $myrow['descripcion'];?>" type="text" name="descripcion[]"></input>
           <?php }else{?>
            <input value="<?php echo $myrow['descripcion'];?>" type="hidden" name="descripcion[]"></input>
       <?php echo $myrow['descripcion'];?>
       <?php }?>           
           
       </td>
         
         
         
         
       <td ><a href="catalogoTipoClientes.php?edit=yes&keyRCT=<?php echo $myrow['keyRCT'];?>" onClick="this.form.submit();">Edit</a></td>
           <td ><a href="catalogoTipoClientes.php?del=yes&keyRCT=<?php echo $myrow['keyRCT'];?>" onClick="this.form.submit();">X</a></td>
     </tr>
       
       <input type="hidden" name="keyRCT[]" value="<?php echo $myrow['keyRCT'];?>"></input>
     <?php }?>
       
       <tr>
       
       
       
       
       
       
       
       
       
         <td ></td>
       
       
       <td >
       <?php if($_GET['add']=='yes'){?>
           <input type="text" size="4" name="tipo1"></input>
       <?php }?>
       </td>
       
        <td >
            <?php if($_GET['add']=='yes'){?>
            <input type="text" name="descripcion1"></input>
        <?php }?>
        </td>
      
        <td ><div align="left">
                <a href="catalogoTipoClientes.php?add=yes&keyRCT=<?php echo '';?>" onClick="this.form.submit();">
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