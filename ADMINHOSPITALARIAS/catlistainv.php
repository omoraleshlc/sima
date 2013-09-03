<?PHP require("menuOperaciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=750,height=500,scrollbars=YES") 
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

if($_GET['delete']=='si'){
        $q = "DELETE FROM listas 

WHERE 
keylistas='".$_GET['keylistas']."'

";

mysql_db_query($basedatos,$q);
echo mysql_error();  


        $q = "DELETE FROM listasinventarios 

WHERE 
keylistas='".$_GET['keylistas']."'

";

mysql_db_query($basedatos,$q);
echo mysql_error();  
}


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
 <h1 align="center" >Catalogo de Listas de Inventarios</h1>
 <form id="form2" name="form2" method="post" >
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
 
     
     
   <div id="divContainer">     
   <table width="300" class="formatHTML5">
     <tr >
       <th ><div align="left" >
         <div align="left"># </div>
       </div></th>
<th ><div align="left" >
  <div align="left">Fecha </div>
</div></th>
        <th ><div align="left" >
        <div align="left">Departamento</div>
       </div></th>  
       <th  ><div align="left" >
         <div align="left">Anaquel</div>
       </div></th>         
       <th  ><div align="left" >
         <div align="left">Status</div>
       </div></th>
            <th ><div align="left" >
         <div align="left"></div>
       </div></th>
       
     </tr>
     
     
     
     
        	    <?php   
				

$sSQL= "Select * From listas where
entidad='".$entidad."'
order by descripcion ASC";

 
 
 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$sSQL3= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow['almacen']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);    
$f+=1;
?> 





     <tr  >
       <td ><?php echo $f;?></td> 
       <td ><span >

	   <?php echo cambia_a_normal($myrow['fecha']);?>	 
	   </span></td>
       
           <td ><span >

                   


<?php if($myrow3['descripcion']!=NULL){
    echo $myrow3['descripcion'];
}else{
    echo '???';
    
}


if($myrow['descripcion']!=NULL){
    echo '<br>';
    echo $myrow['descripcion'];
}

    ?>

               
               </span>
       </td>
       
                <td ><span >
           <?php echo $myrow['anaquel'];?></span>
       </td>
       
       
                  <td ><span >
           <?php echo $myrow['status'];?></span>
       </td>
       
       <td ><span >
       
  <?php if( $myrow['status']=='open'){?>
<a href="catlistainv.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&keylistas=<?php echo $myrow['keylistas']; ?>&activar=si&desactivar=no&update=si">
  Cerrar
</a>               
   <?php }else{ ?>
          <a href="catlistainv.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&keylistas=<?php echo $myrow['keylistas']; ?>&activar=no&desactivar=si&update=si">
Abrir	
</a>       
               <?php }?>
  </span>
       </td>
       
       
       
       <td>
       <a href='#' onclick="ventanaSecundaria1('../ventanas/ventanalistainv.php?keylistas=<?php echo $myrow['keylistas']; ?>&seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&anaquel=<?php echo $myrow['anaquel'];?>')" />
Edit
       </a>
       </td>       
       
       
       <td ><span >
<a href="catlistainv.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&keylistas=<?php echo $myrow['keylistas']; ?>&activar=no&desactivar=si&delete=si">
X
</a>       

  </span>
       </td>       
       
       
       
       
       
       
     </tr>
     <?php }}?>
   </table>
   </div>

   <p align="center">
     <label>
     <input name="nuevo" type="button"  id="nuevo" value="Nueva Lista"
	  onclick="ventanaSecundaria1('../ventanas/ventanalistainv.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&departamento=<?php echo $_POST['departamento'];?>')" />
     </label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>