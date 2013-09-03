<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");
$ventana1='ventanaCatalogoAlmacen.php';
?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
<?php 
if($_GET['tipoAlmacen'] AND $_GET['almacen']){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE almacenes set 

		activo='I'
		WHERE entidad='".$entidad."' AND
		almacen='".$_GET['almacen']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else {
$q = "UPDATE almacenes set 

		activo='A'
		WHERE entidad='".$entidad."' AND
		almacen='".$_GET['almacen']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}

$_POST['tipoAlmacen']=$_GET['tipoAlmacen'];

}
?>

<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title></title>
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>
    <p>&nbsp;</p>
 <h1 align="center" >Politicas de Precios</h1>
 <form id="form1" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

   

   

   <table width="478" class="table table-striped" >
     <tr >
       <th width="26" scope="col"><div align="left" >
         <div align="left"># </div>
       </div></th>

         

         
         
       <th width="200" scope="col"><div align="left" >
         <div align="left">Descripcion</div>
       </div></th>

         
         <th width="41"  scope="col"><div align="center" >
         <div align="center">---</div>
       </div></th>
         

       <th width="41"  scope="col"><div align="center" >
         <div align="center">---</div>
       </div></th>
     </tr>
     
     
     
     
<?php   

$sSQL= "Select * From gpoProductos 
order by descripcionGP ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$f+=1;



$sSQL7a= "Select * From politicasPrecios where entidad='".$entidad."' and 
almacen='".$myrow['almacen']."'";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
$myrow7a = mysql_fetch_array($result7a);
echo mysql_error();
?> 





   <tr >
       
         
         <td ><?php echo $f;?></td> 
       
       

       
       
       <td ><span ><?php echo $myrow['descripcionGP'];?></span></td>
       
       
       
       
       
       
       
              <td >
	   
	   <?php if($myrow7a['almacen']!=NULL){  ?>
         <div align="center">
           
             <a href="#editar<?php echo $f;?>" name="editar<?php echo $f;?>" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo $myrow['descripcion'];?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria1('/sima/ventanas/mostrarPoliticas.php?gpoProducto=<?php echo $myrow['codigoGP']; ?>
		&descripcionGP=<?php echo $myrow['descripcionGP']; ?>&amp;almacen=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')">
            Editar
                <?php 
             }
                 ?>
              
             </a>
         
       </div></td>
       
       
       

		
		
       <td >
	   
	    
         <div align="center">
           
             <a href="#editar<?php echo $f;?>" name="editar<?php echo $f;?>" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo $myrow['descripcion'];?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria1('/sima/ventanas/ventanaAsignarPoliticas.php?gpoProducto=<?php echo $myrow['codigoGP']; ?>
		&descripcionGP=<?php echo $myrow['descripcionGP']; ?>')">
            
            Agregar
              
             </a>

             
       </div></td>
       
       
       
       
       
       
     </tr>
     <?php }}?>
   </table>

   <p align="center">
     <label></label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>