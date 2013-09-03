<?PHP require("menuOperaciones.php"); ?>

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
   window.open(URL,"ventana10","width=1000,height=1000,scrollbars=YES") 
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
    <br>
 <h1 align="center" >Carga Final de Inventario</h1>
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

   <table width="500" class="table table-striped">
     <tr >
       <th width="5" scope="col"><div align="left" >
         <div align="left"># </div>
       </div></th>
<th width="20" height="15" scope="col"><div align="left" >
  <div align="left">Fecha </div>
</div></th>
       <th width="200" scope="col"><div align="left" >
         <div align="left">Almacen</div>
       </div></th>
          <th width="200" scope="col"><div align="left" >
         <div align="left">Anaquel</div>
       </div></th> 
       <th width="30" scope="col"><div align="left" >
         <div align="left">Status</div>
       </div></th>
            <th width="30" scope="col"><div align="left" >
         <div align="left">Edit</div>
       </div></th>
       
       <th width="30" scope="col"><div align="left" >
         <div align="left">Print</div>
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
$sSQL3= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow['almacen']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);  
?> 




<?php if($myrow['almacen']!=NULL){?>
     <tr>
       <td ><?php echo $f;?></td> 
       <td ><span >

	   <?php echo cambia_a_normal($myrow['fecha']);?>	 
	   </span></td>
       
           <td ><span >
           <?php echo $myrow3['descripcion'];?></span>
       </td>
       
      <td ><span >
           <?php echo $myrow['anaquel'];?></span>
       </td>       
       
                  <td >
                      <span >
           <?php echo $myrow['status'];?>
                      </span>
       </td>
       
       <td ><span >
<?php if( $myrow['status']=='open'){?>       
 <a href="#" onClick="javascript:ventanaSecundaria('../ventanas/ventanaProcesoInventarios.php?keylistas=<?php echo $myrow['keylistas']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&tipoPaciente=<?php echo "interno"; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>')">
 Cargar           
 </a>
<?php }else{ echo '---';}?>          

  </span>
       </td>
       
       
       
       
       
          <td>
   <p align="center">
     <label>
     
<a href="#grupos<?php echo $f;?>" name="grupos<?php echo $f;?>"  onClick="ventanaSecundaria10('../ventanas/ventanaListaInventarios.php?keylistas=<?php echo $myrow['keylistas'];?>')" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo $myrow['descripcion'];?>&lt;/div&gt;')" onMouseOut="UnTip()">
             <img src="../imagenes/printer1.jpg"  width="20" height="20" border="0"/> </a>     
     
     
     </label>
   </p>       
       
       
   </td>
       
       
       
       
       
       
       
     </tr>
 <?php }}}?>
   </table>

<p align="center">
  
</p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>