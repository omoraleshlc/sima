<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>

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
function ventanaAgregar (URL){ 
   window.open(URL,"ventanaAgregar","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>


<?php
if($_GET['activar']=='si'){
      $q = "UPDATE listas set 
status='close'
WHERE 
keylistas='".$_GET['keylistas']."'

";

mysql_db_query($basedatos,$q);
echo mysql_error();

      $q1 = "UPDATE listasinventarios set 
status='close'
WHERE 
keylistas='".$_GET['keylistas']."'

";

mysql_db_query($basedatos,$q1);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Lista de inventario cerrada...';
}elseif($_GET['desactivar']=='si'){
         $q = "UPDATE listas set 
status='open'
WHERE 
keylistas='".$_GET['keylistas']."'

";

mysql_db_query($basedatos,$q);
echo mysql_error(); 

$q1 = "UPDATE listasinventarios set 
status='open'
WHERE 
keylistas='".$_GET['keylistas']."'

";

mysql_db_query($basedatos,$q1);
echo mysql_error(); 
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='La lista del inventario esta abierta...';
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
 <h1 align="center" class="titulos">Listas de Inventarios</h1>
 <form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
   <p>
       
   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>       
       
   </p>
   <img src="../../imagenes/bordestablas/borde1.png" width="500" height="24" />
   <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" class="style7">
     <tr bgcolor="#FFFF00">
       <th width="5" scope="col"><div align="left" class="none">
         <div align="left"># </div>
       </div></th>
<th width="20" height="15" scope="col"><div align="left" class="none">
  <div align="left">Fecha </div>
</div></th>
       <th width="200" scope="col"><div align="left" class="none">
         <div align="left">Descripcion</div>
       </div></th>
       <th width="30" scope="col"><div align="left" class="none">
         <div align="left">Status</div>
       </div></th>
            <th width="30" scope="col"><div align="left" class="none">
         <div align="left">Edit</div>
       </div></th>
       
     </tr>
     
     
     
     
        	    <?php   
				

$sSQL= "Select * From listas where
entidad='".$entidad."'
order by descripcion ASC";

 
 
 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$f+=1;
?> 





     <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
       <td class="codigos"><?php echo $f;?></td> 
       <td class="codigos"><span class="normal">

	   <?php echo cambia_a_normal($myrow['fecha']);?>	 
	   </span></td>
       
           <td class="style12"><span class="normal">
           <?php echo $myrow['descripcion'];?></span>
       </td>
       
                  <td class="style12">
                      <span class="normal">
           <?php echo $myrow['status'];?>
                      </span>
       </td>
       
       <td class="style12"><span class="normal">
<?php if( $myrow['status']=='open'){?>       
 <a href="#" onClick="javascript:ventanaSecundaria('ventanaProcesoInventarios.php?keylistas=<?php echo $myrow['keylistas']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&tipoPaciente=<?php echo "interno"; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>')">
 Cargar           
 </a>
<?php }else{ echo '---';}?>          

  </span>
       </td>
       
       
     </tr>
     <?php }}?>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" width="500" height="24" />
<p align="center">
  
</p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>