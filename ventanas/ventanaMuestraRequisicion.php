<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?>








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
    
      <?php 
  $sSQL8= "Select * From contadorRequisiciones WHERE entidad='".$entidad."' and contador='".$_GET['nRequisicion']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
echo $myrow8['descripcionAlmacen'];
?>
    
    
    
<form id="form2" name="form2" method="post">
  <p  >REQUISICION #<?php echo $_GET['nRequisicion'];?></p>
  
  
  

  
  
  
  
  
  
   <p align="center">&nbsp;</p>
    <p align="center">&nbsp;</p>
  
  
  
  
  
  
  <table width="582" class="table table-striped">
    <tr>
      <th width="68"  scope="col"><div align="left" >
        <div align="left">Cantidad</div>
      </div></th>
      <th width="354" ><div align="left"><span >Descripcion</span></div></th>
      <th width="46" ><span >Status</span></th>
      
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
    nRequisicion='".$_GET['nRequisicion']."'

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
    <?php echo $myrow18['cantidad'];?>
        
        
        
        
      <td><?php echo $myrow18['descripcionArticulo'];?></td>
        
      
      <td  ><div align="left">
             <?php echo $myrow18['status'];?>   
             </div>
               <input name="keyReq[]" type="hidden" value="<?php echo $myrow18['keyReq'];?>" />
        </td>
      
      
    
    </tr>
    <?php  }} //cierra while ?>
  </table>
  
  
  
  
  
  
  
  
   
</form>

    
    <script>
        window.print();
    </script>
    
    
    
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
