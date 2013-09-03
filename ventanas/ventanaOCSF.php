<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=900,height=800,scrollbars=YES") 
} 
</script> 




<?php 
if($_POST['aplicar'] ){

    
    
    
    
    
    
    
    
if($_POST['proveedor']!=NULL  and $_POST['fechaCaptura'] ){
    
    
    



//*********************************************
 $sSQL17= "Select * From compras WHERE entidad='".$entidad."' and
factura='".$_POST['id_factura']."'
    and
    proveedor='".$_POST['proveedor']."'
";
 $result17=mysql_db_query($basedatos,$sSQL17);
 $myrow17 = mysql_fetch_array($result17);


if(!$myrow17['factura']){
$agregaSaldo = "INSERT INTO compras ( 
proveedor,factura,importe,iva,gastos,tipoCambio,denominacion,status,usuario,hora,fecha,fechaCaptura,entidad,
descripcionProveedor,tipoEntrada,notaCredito
) values (
'".$_POST['proveedor']."','".$_POST['id_factura']."','".$_POST['importe']."','".$_POST['iva']."',
    '".$_POST['gastos']."','".$_POST['tipoCambio']."','".$_POST['denominacion']."',
        'standby','".$usuario."','".$hora1."','".$fecha1."','".$_POST['fechaCaptura']."','".$entidad."',
            '".$_POST['descripcionProveedor']."', '".$_POST['tipoEntrada']."','".$_POST['notaCredito']."'
)";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agrego la factura...';
} else {
    
    
    if($_GET['update']=='si'){
$q1 = "UPDATE compras
    set 
notaCredito='".$_POST['notaCredito']."',
tipoEntrada='".$_POST['tipoEntrada']."',
importe='".$_POST['importe']."',
    iva='".$_POST['iva']."',
    gastos='".$_POST['gastos']."',
        tipoCambio='".$_POST['tipoCambio']."',
            denominacion='".$_POST['denominacion']."',
                fechaCaptura='".$_POST['fechaCaptura']."',
                    descripcionProveedor='".$_POST['descripcionProveedor']."'
WHERE 
entidad='".$entidad."'
    and
proveedor = '".$_POST['proveedor']."'
and
factura='".$_POST['id_factura']."'
";
mysql_db_query($basedatos,$q1);
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizo la factura...';

}else{
        
$tipoMensaje='error';
$encabezado='Error';
$texto='YA EXISTE LA FACTURA...';
/*
?>
<script>
window.alert("YA EXISTE ESA FACTURA CON LA FECHA: <?php echo $myrow17['fecha'];?>");
</script>
<?php 
*/
     }   





}


//*****************************************************************************
$sSQL17= "Select * From compras WHERE entidad='".$entidad."' and
factura='".$_POST['id_factura']."'
    and
    proveedor='".$_POST['proveedor']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
?>
<script>
window.close();
</script>

<?php 

}else{
$tipoMensaje='error';
$encabezado='Error';
$texto='Te faltan campos por llenar...';
}
echo '<script>';
echo 'window.opener.document.forms["form1"].submit();';
echo  '</script>';
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
    
    
<form method="post" >
  <p  >Solicitudes sin OC</p>
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
          <select name="tipoEntrada" onChange="this.form.submit();" >
              <option
               <?php if( $myrow17a['tipoEntrada']=='factura' or $_POST['tipoEntrada']=='factura'){echo 'selected=""';}?>   
                  value="factura">Factura</option>
              
              <option
               <?php if( $myrow17a['tipoEntrada']=='remision' or $_POST['tipoEntrada']=='remision'){echo 'selected=""';}?>   
                  value="remision">Nota de Remision</option>
              
              <option
               <?php if( $myrow17a['tipoEntrada']=='donacion' or $_POST['tipoEntrada']=='donacion'){echo 'selected=""';}?>   
                  value="donacion">Articulos Donados</option>
              
              
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
    
    
    
    
    <tr>
      <td height="25" ><span >Fecha</span></td>
      <td ><span class="titulo">
        <label>
          <input  name="fechaCaptura" type="text"  id="campo_fecha" size="10" maxlength="9" readonly="readonly"
		value="<?php echo $myrow17a['fechaCaptura'];?>"/>
        </label>
        <input name="button" type="image" src="../imagenes/calendario.png"  id="lanzador" value="..." />
      </span></td>
    </tr>


      
<?php

if($_POST['tipoEntrada']=='donacion' or $myrow17['tipoEntrada']=='donacion')      {?>
      
      
      
      
      
      
      
<?php }else{?>      
<tr>
      <td height="23" ><span >#Factura/Remision</span></td>
      <td ><input name="id_factura" type="text" id="id_factura" size="10" value="<?php echo $myrow17a['factura'];?>" <?php if( $myrow17a['factura']!=''){echo 'readonly=""';}?> /></td>
    </tr>


    <tr>
      <td height="23" ><span >Importe (Cheque)</span></td>
      <td ><span >
        <input name="importe" type="text" id="importeFactura" size="10" value="<?php echo $myrow17a['importe'];?>" />
      </span></td>
    </tr>

    
    
    
    <tr>
      <td height="23" ><span >IVA</span></td>
      <td ><span >
        <input name="iva" type="text" id="ivaFactura" size="10" value="<?php echo $myrow17a['iva'];?>" />
      </span></td>
    </tr>
    
    
    
    <tr>
      <td height="23" ><span >Gastos</span></td>
      <td ><span >
        <input name="gastos" type="text" id="gastos" size="10" value="<?php echo $myrow17a['gastos'];?>" />
      </span></td>
    </tr>
    
    
    <tr>
      <td height="23" ><span >Denominacion</span></td>
     
      <td ><select name="denominacion"  id="tipoCambio" >
     
        <option 
			<?php if($myrow17a['denominacion']=='Pesos'){ ?>
			selected="selected" 
			<?php } ?>
			 value="Pesos">Pesos</option>
        <option 
			<?php if($myrow17a['denominacion']=='Dolares'){ ?>
			selected="selected" 
			 <?php } ?>
			value="Dolares">Dolares</option>
      </select></td>
    </tr>
    
    
    <tr>
      <td height="35" ><span >Tipo de cambio</span></td>
      <td ><span >
        <input name="tipoCambio" type="text" id="tipocambio" size="10" value="<?php echo $myrow17a['tipoCambio'];?>" />
      </span></td>
    </tr>
    
       
    
    
    
    
    <tr>
      <td height="35" ><span >Nota de Credito</span></td>
      <td ><span >
        <input name="notaCredito" type="text" id="notaCredito" size="10" value="<?php echo $myrow17a['notaCredito'];?>" />
      </span></td>
    </tr>

      
      
      
      
<?php }?>      
    
    
    
  </table>
  <p align="center" ><span >
    <input name="aplicar" type="submit" id="aplicar" value="Generar Orden" />
  </span></p>
  
  
  <p align="center">&nbsp;</p>
</form>
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
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
