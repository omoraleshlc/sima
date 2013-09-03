<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php'); 
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
if($_GET['elimina']=='si' AND $_GET['almacen']){

	
$q = "DELETE FROM politicasPrecios 
    


		WHERE 
keyPP='".$_GET['keyPP']."'
";
		mysql_db_query($basedatos,$q);
		echo mysql_error();




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
 <h1 align="center" class="titulos">Mostrar Politicas de Precios</h1>
  <h5 align="center" class="titulomed"><?php echo $_GET['descripcion'];?></h5>
 <form id="form1" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

   

   
   <table width="350" border="0" align="center" class="style7">
     <tr bgcolor="#330099">
       <th width="26" scope="col"><div align="left" class="blanco">
         <div align="left"># </div>
       </div></th>

         

         
         
       <th width="200" scope="col"><div align="left" class="blanco">
         <div align="left">Grupo</div>
       </div></th>

         
        <th width="41" class="normal" scope="col"><div align="center" class="blanco">
         <div align="center">%</div>
       </div></th>
         
         
         <th width="41" class="normal" scope="col"><div align="center" class="blanco">
         <div align="center">---</div>
       </div></th>
         


     </tr>
     
     
     
     
<?php   

$sSQL= "Select * From politicasPrecios where
entidad='".$entidad."'
and
almacen='".$_GET['almacen']."'
";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$f+=1;



$sSQL7a= "Select * From gpoProductos where 
codigoGP='".$myrow['gpoProducto']."'";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
$myrow7a = mysql_fetch_array($result7a);
echo mysql_error();
?> 





     <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
       
         
         <td class="normal"><?php echo $f;?></td> 
       
       

       
       
       <td class="normal"><span class="normal"><?php echo $myrow7a['descripcionGP'];?></span></td>
       
       
        <td class="normal"><span class="normal"><?php echo $myrow['porcentaje'];?>%</span></td>
       
       
       
       
              <td class="normal">
	   
	   
         <div align="center">
           
             <a href="mostrarPoliticas?elimina=si&keyPP=<?php echo $myrow['keyPP'];?>&gpoProducto=<?php echo $myrow7a['codigoGP'];?>&almacen=<?php echo $_GET['almacen'];?>">
            Quitar

              
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