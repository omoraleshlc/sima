<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?>




<?php  
if($_GET['keyReq']>0 AND ($_GET['inactiva'] or $_GET['activa'])){

    
    
    
$sSQL12= "
	SELECT *
FROM
    listaRequisiciones

WHERE keyReq='".$_GET['keyReq']."'";


$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);    
    
	if($_GET['inactiva']=="inactiva"){
if($myrow12['keyReq']!=NULL){            
$q = "delete from listaRequisiciones

		WHERE keyReq='".$_GET['keyReq']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                 echo '<div class="error">Se elimino el articulo!</div>';   
	}

        }

}
?>


<?php 
if($_POST['agregar']  and $_GET['almacen']!=NULL and $_GET['solicitud']>0){

if($_POST['descripcion']!=NULL ){
    
    
 


$agregaSaldo = "INSERT INTO listaRequisiciones ( 
numSolicitud,cantidad,descripcionArticulo,id_almacen,usuario,hora,fecha,status,entidad

) values (
'".$_GET['solicitud']."','1','".$_POST['descripcion']."','".$_GET['almacen']."',
    '".$usuario."','".$hora1."','".$fecha1."','request','".$entidad."'
)";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agrego el articulo...';
}else{
 echo '<div class="error">Favor de llenar el campo Descripcion!</div>';   
}
}










if($_POST['update']!=NULL ){
    
$cantidad=$_POST['cantidad'];    
$keyReq=$_POST['keyReq'];    
$counter=count($_POST['keyReq']);


for($i=0;$i<$counter;$i++){

$q1 = "UPDATE listaRequisiciones
    set 
cantidad='".$cantidad[$i]."'

WHERE keyReq='".$keyReq[$i]."'
";
mysql_db_query($basedatos,$q1);



$encabezado='Exitoso';
$texto='Se actualizaron cantidades';
$tipoMensaje='exito';


}

     }   



?>








<?php

if($_POST['send']!=NULL){
    
    

  $sSQL8a= "Select * From listaRequisiciones WHERE entidad='".$entidad."' and numSolicitud='".$_GET['solicitud']."'";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);

if($myrow8a['numRequisicion']==''){
    
    
$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
contadorRequisiciones
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}


  $sSQL8= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$_GET['almacen']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

	
$agrega = "INSERT INTO contadorRequisiciones (
usuario,contador,entidad,id_almacen,fecha,hora,descripcionAlmacen,numSolicitud,status
) values (
'".$usuario."','".$n."','".$entidad."','".$_GET['almacen']."',
'".$fecha1."','".$hora1."',
'".$myrow8['descripcion']."','".$_GET['solicitud']."','standby'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$q1 = "UPDATE listaRequisiciones
    set 
status='standby',
nRequisicion='".$n."'

WHERE 
entidad='".$entidad."'
    and
numSolicitud='".$_GET['solicitud']."'

";
mysql_db_query($basedatos,$q1);
?>


<script>
window.alert("SE GENERO EL # DE REQUISICION: <?php echo $n;?>");
window.opener.document.forms["form1"].submit();
window.close();
</script>

<?php     
}else{
    echo '<div class="error">Ya existe la requisicion!</div>';
}   
}


?>










<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />



    
</head>

<body>
    
    
     <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>  
    
    
<form id="form2" name="form2" method="post">
  <p  >NUEVA ORDEN DE COMPRA</p>
  
  
  
  <?php 
  $sSQL8= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$_GET['almacen']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
echo $myrow8['descripcion'];
?>
  
  
  
  
  <table width="430" class="table-forma">
  
  <?php 
  if($_POST['id_factura']!=NULL  or $_GET['id_factura']!=NULL){
 $sSQL17a= "Select * From compras WHERE entidad='".$entidad."' and
(factura='".$_POST['id_factura']."' or factura='".$_GET['id_factura']."')
    and
    (proveedor='".$_POST['proveedor']."'  or proveedor='".$_GET['proveedor']."')
";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);
  }
  ?>

    
    
    
    
    
    
    
    
    
    <tr>
      <td width="122" height="25" ><span >Articulo
         
      </span></td>
      
        
        
        
        <td width="308"  >
  <input name="codigo" type="hidden"  id="codigo" />
          <input name="descripcion" type="text"  id="descripcion"  size="50"/>
      </td>

    </tr>
    
    
        <tr>
        <td width="122" height="25" ></td>
        <td width="308"  >
  <input name="agregar" type="Submit"  id="codigo" value="Agregar" />
         
      </td>

    </tr>
    
    
    
    
    
    
  </table>
  
  
  
   <p align="center">&nbsp;</p>
    <p align="center">&nbsp;</p>
  
  
  
  
  
  
  <table width="582" class="table table-striped">
    <tr>
      <th width="68"  scope="col"><div align="left" >
        <div align="left">Cantidad</div>
      </div></th>
      <th width="354" ><div align="left"><span >Descripcion</span></div></th>
      <th width="46" ><span ></span></th>
      
    </tr>
    <tr>
<?php	


$sSQL18= "
SELECT 
*
FROM
listaRequisiciones
where
entidad='".$entidad."'
    and
    numSolicitud='".$_GET['solicitud']."'

";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$id_proveedor=$myrow18['id_proveedor'];
$b+='1';
$a+='1';
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];

$requisicion=$myrow18['id_requisicion'];
$id_almacen=$myrow18['id_almacen'];
$id_proveedor=$myrow18['id_proveedor'];



if(!$descripcion){
$descripcion="No existen estos articulos o estan inactivos";
}

$sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);



/* $sSQL2= "Select * From articulos WHERE codigo= '".$code1."' and almacen='".$_POST['id_almacen']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2); */
$bandera1+=1;
?>
      <td  >
      <input name="cantidad[]" type="text" size="3" value="<?php echo $myrow18['cantidad'];?>"></input></td>
        
        
        
        
      <td><?php echo $myrow18['descripcionArticulo'];?></td>
      
      
      
         <td  ><div align="center">
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?keyReq=<?php echo $myrow18['keyReq']; ?>&seguro=<?php echo $_POST['seguro']; ?>&inactiva=<?php echo'inactiva'; ?>&almacen=<?php echo $_GET['almacen'];?>&solicitud=<?php echo $_GET['solicitud'];?>"> 
                    <img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas activar la nota de credito?') == false){return false;}" />
                </a></div>
               <input name="keyReq[]" type="hidden" value="<?php echo $myrow18['keyReq'];?>" />
        </td>
    </tr>
    <?php  }} //cierra while ?>
  </table>
  
  
  
  
  
  
  
  
  <?php if($b>0){?>
  <p align="center">&nbsp;</p>
  
  <input name="update" type="submit" src="../imagenes/btns/sendsolicitud.png" id="send" value="ACTUALIZAR CAMBIOS" />
    <p align="center">&nbsp;</p>
      <p align="center">
<input name="send" type="submit" src="../imagenes/btns/sendsolicitud.png" id="send" value="GENERAR REQUISICION" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas generar la requisicion?') == false){return false;}"  <?php if($total>1 ){ echo 'disabled=""';}?>/>
</p>
<?php } ?>    
</form>

<script>
		new Autocomplete("descripcion", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("codigo")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/articulosCodigox.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
