<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 




<?php





if($_POST['actualizar'] and $_POST['tipoPago']){




//**************************************SI NO EXISTE EN EXISTENCIAS DALOS DE ALTA********************

$sSQL3= "Select * From tipoPagoClientes WHERE
    entidad='".$entidad."' and clientePrincipal='".$_GET['seguro']."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


if(!$myrow3['clientePrincipal'] ){

$agrega = "INSERT INTO tipoPagoClientes (
clientePrincipal,descripcionClientePrincipal,tipoPago,cuenta,entidad
) values (
'".$_GET['seguro']."',
'".$_GET['nomCliente']."',
    '".$_POST['tipoPago']."',
    '".$_POST['cuenta']."',
'".$entidad."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




 //cierra validacion
//*********************************************

echo '<script>
//window.alert( "REGISTRO AGREGADO ");
   window.opener.document.forms["form2"].submit();
    //self.close();
</script>';
$tipoMensaje='agregarRegistros';
$encabezado='Exitoso!';
$texto='Se insertaron Registros...';
} else {



$q = "UPDATE tipoPagoClientes set
tipoPago='".$_POST['tipoPago']."',
cuenta=    '".$_POST['cuenta']."'
WHERE 
entidad='".$entidad."'
    and
clientePrincipal='".$_GET['seguro']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();

echo '<script language="JavaScript" type="text/javascript">
  <!--
  //window.alert( "REGISTRO ACTUALIZADO ");
   window.opener.document.forms["form2"].submit();
    //self.close();
  // -->
</script>';
$tipoMensaje='agregarRegistros';
$encabezado='Exitoso!';
$texto='Se actualizaron Registros...';
}


}








if($_GET['elimina'] AND $_GET['keyTPC']){




$borrame = "DELETE FROM tipoPagoClientes WHERE keyTPC='".$_GET['keyTPC']."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();


echo '<script language="JavaScript" type="text/javascript">
  <!--
  //window.alert( "REGISTRO ELIMINADO ");
   window.opener.document.forms["form2"].submit();
    //self.close();
  // -->
</script>';
$tipoMensaje='error';
$encabezado='Exito!';
$texto='Se desactivaron folios de venta';
}



$sSQL3= "Select * From tipoPagoClientes WHERE   keyTPC='".$_GET['keyTPC']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
    
    
    
    
    
<form id="form1" name="form1" method="post"  >

    
    
    
    
    

    
    
    
   <p>      <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?></p>
   <p>&nbsp;</p>
   <div align="center">
     <p>Aseguradoras</p>
     <p><?php echo $_GET['nombreCliente'];?></p>
   </div>

   <table width="442" class="table-forma"
     <tr>
           <td width="144" >
               Tipo de Pago

     </td>



   <td width="360" >

        <select name="tipoPago"  id="tipoPago" onChange="this.form.submit();"/>

  <option value="" >Escoje la Opcion</option>
       
        <option
            <?php if($_POST['tipoPago']=='Efectivo'){echo 'selected=""';}?> 
            value="Efectivo">Efectivo</option>
         <option
           <?php if($_POST['tipoPago']=='Transferencia'){echo 'selected=""';}?>   
             value="Transferencia">Transferencia</option>
         <option
         <?php if($_POST['tipoPago']=='Tarjeta de Credito'){echo 'selected=""';}?>
             value="Tarjeta de Credito">Tarjeta de Credito</option>
         <option
         <?php if($_POST['tipoPago']=='Cheque'){echo 'selected=""';}?>
             value="Cheque">Cheque</option>
        </select>
   </td>
       </tr>    
        
       <tr>  
        <?php if($_POST['tipoPago']=='Transferencia'){?> 
       <td width="144" >Cuenta</td>
       <td width="360" >
           <input name="cuenta" type="text" ></input>
       </td>
       <?php } else if($_POST['tipoPago']=='Cheque'){?> 
       <td width="144" >Cuenta</td>
       <td width="360" >
           <input name="cuenta" type="text" ></input>
       </td>
       <?php }else if($_POST['tipoPago']=='Tarjeta de Credito'){?> 
       <td width="144" >Cuenta</td>
       <td width="360" >
           <input name="cuenta" type="text" ></input>
       </td>
       </tr>
           <?php } ?>   
       
       
       
  
  </table>
   
   
   
   
   
<?php if($_POST['tipoPago']){?>   
 <p>&nbsp;</p>
<span ><span >
         <input name="actualizar" type="submit" src="../imagenes/btns/modialma.png"  id="actualizar" value="Agregar/Modificar" />
       </span></span>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
<p>
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
  </p>


  
    
    
    
    
    
   <p>&nbsp;</p>

   <table width="605" class="table table-striped">
     <tr >
       <th width="24" scope="col"><div align="left" >
         <div align="left"># </div>
       </div></th>
    
         
        
         
<th width="100"  scope="col"><div align="left" >
  <div align="left">Tipo de Pago </div>
</div></th>
       <th width="59" scope="col"><div align="left" >
         <div align="left">Cuenta</div>
       </div></th>

  

       <th width="59" scope="col"><div align="left" >
         <div align="left">Elimina</div>
       </div></th>
     </tr>




        	    <?php


$sSQL= "Select * From tipoPagoClientes where
entidad='".$entidad."'
    and
    clientePrincipal='".$_GET['seguro']."'
order by descripcionClientePrincipal ASC";




 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$f+=1;

$sSQL3= "Select * From clientes WHERE entidad='".$entidad."' and numCliente='".$myrow['clientePrincipal']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>





     <tr >
       <td ><?php echo $f;?></td>
       
       
       
       <td ><span >

	   <?php echo $myrow['tipoPago'];?>
	   </span></td>
       
       
       
       <td ><span ><?php echo $myrow['cuenta'];?></span></td>
  
       


       <td >
	   <div align="center" >	    <span >

	   <a name="status<?php echo $f;?>" href="ventanaCatalogoReportes.php?keyTPC=<?php echo $myrow['keyTPC']; ?>&elimina=si"><img src="../imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este reporte?') == false){return false;}" /></a>


	   </span></div></td>
     </tr>
     <?php }}}?>
   </table>

</form>


</body>
</html>
