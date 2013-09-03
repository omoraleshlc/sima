<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=900,height=800,scrollbars=YES") 
} 
</script> 




<?php 
if($_POST['aplicar'] ){

if($_POST['proveedor']!=NULL ){
    

    
    $transport=date('l jS \of F Y h:i:s A');
    $q4 = "

    INSERT INTO solicitudesDevoluciones(contador, usuario,entidad,transport)
    SELECT(IFNULL((SELECT MAX(contador)+1 from solicitudesDevoluciones where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$transport."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT contador as topeMaximo from solicitudesDevoluciones where transport='".$transport."'    ";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
        
    

$agregaSaldo = "INSERT INTO compras ( 
proveedor,factura,importe,iva,gastos,tipoCambio,denominacion,status,usuario,hora,fecha,fechaCaptura,entidad,
descripcionProveedor,tipoEntrada,notaCredito,statusDevolucion,numSolicitud,statRecDev
) values (
'".$_POST['proveedor']."','".$_POST['id_factura']."','".$_POST['importe']."','".$_POST['iva']."',
    '".$_POST['gastos']."','".$_POST['tipoCambio']."','".$_POST['denominacion']."',
        'standby','".$usuario."','".$hora1."','".$fecha1."','".$_POST['fechaCaptura']."','".$entidad."',
            '".$_POST['descripcionProveedor']."', '".$_POST['tipoEntrada']."','".$_POST['notaCredito']."','si','".$myrow['topeMaximo']."','standby'
)";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agrego la factura...';


echo '<script>';
echo 'window.alert("SE GENERO LA ORDEN'.$myrow['topeMaximo'].'");';
echo 'window.opener.document.forms["form1"].submit();';
echo 'window.close();';
echo  '</script>';

} else{
    echo '<div class="error">Favor de llenar el proveedor!</div>';
}  


}
?>



 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
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
    
    
<form id="form2" name="form2" method="post" action="#">
  <p  >Generar Orden de Devolucion</p>
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
      <td width="122" height="25" >
          <span >Tipo de Entrada
          </span>
         </td>
         
         
         
      <td width="308"  >
          <select name="tipoEntrada" >
              <option
               <?php if( $myrow17a['tipoEntrada']=='Caducidad'){echo 'selected=""';}?>   
                  value="Caducidad">Caducidad</option>
              
              <option
               <?php if( $myrow17a['tipoEntrada']=='Merma'){echo 'selected=""';}?>   
                  value="Merma">Merma</option>
              
               <option
               <?php if( $myrow17a['tipoEntrada']=='Mercancia Danada'){echo 'selected=""';}?>   
               value="Mercancia Danada">Mercancia Danada</option>
               
              
               <option
               <?php if( $myrow17a['bajoMovimiento']=='Bajo Movimiento'){echo 'selected=""';}?>   
               value="Mercancia Danada">Bajo movimiento</option>               
              
          </select>
    </tr>    
    
    
    
    
    <tr>
      <td width="122" height="25" ><span >Proveedor
          <input name="proveedor" type="hidden"  id="proveedor"   
		value="<?php echo $myrow17a['proveedor'];?>" 
	 />
      </span></td>
      <td width="308"  >
<?php if( !$myrow17a['descripcionProveedor']){?>
          <input name="descripcionProveedor" type="text"  id="descripcionProveedor" value="<?php echo $myrow17a['descripcionProveedor'];?>" size="50"/>
      </td>
      <?php }else{ echo $myrow17a['descripcionProveedor'];?>    
      <input name="descripcionProveedor" type="hidden"  id="descripcionProveedor" value="<?php echo $myrow17a['descripcionProveedor'];?>" size="50"/>
      <?php } ?>
    </tr>
    
    
    
    




    
    


    
       
    
    
    
  
    
    
    
    
  </table>
  <p align="center" ><span >
    <input name="aplicar" type="submit" id="aplicar" value="Generar Orden" />
  </span></p>
  
  
  <p align="center">&nbsp;</p>
</form>

    
    
    
    
    
    
<script>
		new Autocomplete("descripcionProveedor", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("proveedor")[0].value = id;
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
			return "/sima/cargos/proveedoresx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
