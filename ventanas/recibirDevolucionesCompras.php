<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>































<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['send']){
$keyR=$_POST['keyR'];
$costo=$_POST['costo'];
$cantidad=$_POST['cantidad'];
$keyPA=$_POST['keyPA'];
$precioSugerido=$_POST['precioSugerido'];
$tipoEntrada=$_POST['tipoEntrada'];



$q1 = "UPDATE compras
    set 
statRecDev='request',    
status='sent'
WHERE 
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'

        
";
mysql_db_query($basedatos,$q1);
echo mysql_error();





echo '
<script>
window.alert("Solicitud Enviada");
window.opener.document.forms["form1"].submit();
window.close();
</script>';

}
?>







<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>











<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria17 (URL){ 
   window.open(URL,"ventanaSecundaria17","width=550,height=700,scrollbars=YES") 
} 
</script>







<?php

if($_POST['recibir']!=NULL and $_GET['numSolicitud']>0 and $_GET['proveedor']!=NULL){
    
    
//QUIEN ES CENTRO DE DISTRIBUCION DE ESTA ENTIDAD    
$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);    
    
//TRAER TODO LO QUE TRAE LA SOLICITUD    
$sSQL= "SELECT  
* 
FROM OC
WHERE
entidad='".$entidad."'
and
numSolicitud='".$_GET['numSolicitud']."'
and
id_proveedor='".$_GET['proveedor']."'
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
//BAJA DE EXISTENCIAS

    
//*************KARDEX*************
$ajusteExistencias=new existencias();
$ajusteExistencias->ajusteExistencias($FV,$_GET['keyClientesInternos'],$centroDistribucion,$myrow['keyCAP'],$entidad,$myrow['gpoProducto'],$myrow['cantidad'],$myrow['codigo'],$centroDistribucion,$usuario,$fecha1,$error,$basedatos);


$karticulos=new kardex();
$karticulos-> movimientoskardex('salida',$myrow['cantidad'],'NOTA DE CREDITO (DEVOLUCION A PROVEEDORES)','notaCredito',$usuario,$fecha1,$hora1,$centroDistribucion,$centroDistribucion,$myrow['keyPA'],$myrow['codigo'],$entidad,$basedatos);
//********************************
    
    
    
    
    
    
//INGRESARLO AL KARDEX    
    
    
    
}    


$q1 = "UPDATE compras
    set 
statRecDev='onTransfer'

WHERE 
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'

        
";
mysql_db_query($basedatos,$q1);
echo mysql_error();

echo '<script>

window.opener.document.forms["form1"].submit();
window.close();
</script>';    
    
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

</head>

<body>
<h1><br />

    <?php echo 'Proveedor: '.$_GET['descripcionProveedor'];?>

</h1>

  <form id="form1" name="form1" method="post" >
  
    <p align="center" >
        <a href="javascript:ventanaSecundaria17('ventanaAgregarArticulosDevolucion.php?numSolicitud=<?php echo $_GET['numSolicitud'];?>&descripcionProveedor=<?php echo $_GET['descripcionProveedor'];?>&proveedor=<?php echo $_GET['proveedor'];?>&id_factura=<?php echo $_GET['id_factura'];?>&departamento=<?php echo $_GET['departamento'];?>&req=<?php echo $_GET['req'];?>')">CARGAR ARTICULOS </a></p>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    <table width="950" class="table table-striped">
      <tr >
        

                <th width="68"   scope="col">
              <p>#</p>
         
        </th>
          
          
          
          <th width="68"   scope="col">
           
                   <p> keyPA     </p>       
            
       </th>
          
        
        <th width="283"  scope="col">
           
              <p>Descripcion</p>
           
       </th>
        

        
        
        <th width="80"  scope="col"><p><span >Cantidad</span></p></th>
    <th width="91"  scope="col"> 
      
              <p> Costo</p>
       
    </th>
        
           
       
        
        
        <th width="35"  scope="col">
            <p><span >Total</span>
        </p></th>
    
    
 

    
    
    
        
    <th width="48"  scope="col">
           
              <p>Eliminar</p>
    
        </th>
        
      </tr>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
<?php	
/*
$importe[0]=number_format($importe[0],2);
$precioDerivado=number_format($precioDerivado,2);
$a=number_format($a,2);
$oferta[0]=number_format($oferta[0],2);
$ivaOfertaD=number_format($ivaOfertaD,2);
$tivaOferta[0]=number_format($tivaOferta[0],2);
$tivaDescuentoD=number_format($tivaDescuentoD,2);
$descuentoD=number_format($descuentoD,2);
$ivaDescuentoR=number_format($ivaDescuentoR,2);
$descuentoPPD=number_format($descuentoPPD,2);
$b=number_format($b,2);
$descuentoD=number_format($descuentoD,2);
$c=number_format($c,2);
*/

$sSQL= "SELECT  
* 
FROM OC
WHERE
entidad='".$entidad."'
and
numSolicitud='".$_GET['numSolicitud']."'
and
id_proveedor='".$_GET['proveedor']."'
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
echo mysql_error();
$bandera+=1;
$bandera1+=1;
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
keyPA='".$myrow['keyPA']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL4= "
SELECT 
razonSocial
FROM
proveedores
WHERE
entidad='".$entidad."'
and

 id_proveedor = '".$myrow['id_proveedor']."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);



$um=$myrow12['um'];
$medico=$myrow['medico'];

$sSQL39d= "
	SELECT 
*
FROM
precioArticulos
WHERE keyPA='".$myrow['keyPA']."' order by keyC DESC";
$result39d=mysql_db_query($basedatos,$sSQL39d);
$myrow39d = mysql_fetch_array($result39d);

$sSQL39e1= "
	SELECT 
existencia,cantidadTotal
FROM
existencias
WHERE 
entidad='".$entidad."'
    and
almacen='".$_GET['departamento']."'
and
keyPA='".$myrow['keyPA']."' ";
$result39e1=mysql_db_query($basedatos,$sSQL39e1);
$myrow39e1= mysql_fetch_array($result39e1);


$sSQL39e= "
	SELECT 
*
FROM
gpoProductos
WHERE 

codigoGP='".$myrow12['gpoProducto']."'";
$result39e=mysql_db_query($basedatos,$sSQL39e);
$myrow39e = mysql_fetch_array($result39e);








//***************PRECIO ORIGINAL DERIVADO**************
if($myrow['porcentajeOferta']>0 or $myrow['descuentoPorcentaje']>0 or $myrow['descuentoPorcentaje']>0){
$precioDerivado=$myrow['precioUnitario']; 

//VALIDACION DE OFERTA
if($myrow['porcentajeOferta']>0){
$ofertaD=$precioDerivado*($myrow['porcentajeOferta']*0.01);
$a=$precioDerivado=$precioDerivado-$ofertaD;


   if($myrow39e['tasaGP']>0){ 
    $ivaOfertaD=($ofertaD*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01);
     $tivaOferta[0]+=$ivaOfertaD;
    
   }
   
   
$oferta[0]+=$ofertaD*$myrow['cantidad'];//este multiplica cantidades


}else{
$a=$myrow['precioUnitario'];
}//TERMINA VALIDACION DE OFERTA





//VALIDACION DE PORCENTAJE NORMAL
if($myrow['descuentoPorcentaje']>0){
$descuentoD=$precioDerivado*($myrow['descuentoPorcentaje']*0.01);
$precioDerivado=$precioDerivado-$descuentoD;
$descuento[0]+= ($a-$precioDerivado)*$myrow['cantidad'];
$ivaDescuentoR=($a-$precioDerivado);


   if($myrow39e['tasaGP']>0){ 
    $tivaDescuentoD=(($ivaDescuentoR)*($myrow39e['tasaGP']*0.01))*$myrow['cantidad'];     
    $tivaDescuento[0]+=$tivaDescuentoD;
   }else{
       $tivaDescuentoD=NULL;
   }



  $b=$descuentoD;
}else{  
  $b=$myrow['precioUnitario'];
}//TERMINA VALIDACION DE PORCENTAJE NORMAL
    





//DESCUENTO PORCENTAJE PP
if($myrow['descuentoPorcentajePP']>0){
$descuentoPPD=$precioDerivado*($myrow['descuentoPorcentajePP']*0.01);
$precioDerivado=$precioDerivado-$descuentoPPD;

$descuentoPP[0]+= ($a-$precioDerivado)*$myrow['cantidad'];
$ivaDescuentoPPR=($b-$precioDerivado);


   if($myrow39e['tasaGP']>0){ 
    $tivaDescuentoPPD=(($ivaDescuentoPPR)*($myrow39e['tasaGP']*0.01))*$myrow['cantidad']; 
    $tivaDescuentoPP[0]+=$tivaDescuentoPPD;
    
   }

}else{   
   $c=$myrow['precioUnitario'];
}//CIERRA VALIDACION DE PORCENTAJE PP

    
}else{//NO TRAE DESCUENTOS
 $precioDerivado=$myrow['precioUnitario'];    
}




if($myrow39e['tasaGP']>0){
$iva[0]+=($myrow['precioUnitario']*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01);
if($myrow['notaCredito']=='si'){
$ivaNC=($precioDerivado*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01);
}//cierra nota de credito
}
//CIERRA TOTALES




if($myrow['notaCredito']=='si'){
$nCT[0]+= ($precioDerivado*$myrow['cantidad'])+$ivaNC;
    $notaCredito[0]+=($myrow['precioUnitario']*$myrow['cantidad'])+$ivaNC;
}
?>

    <tr  >
    




        

        <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
          <td height="21" bgcolor="<?php echo $color;?>" ><?php echo $bandera;?></td>
        
        <td height="21" bgcolor="<?php echo $color;?>" ><?php echo $myrow['keyPA'];?></td>
        <td bgcolor="<?php echo $color;?>" >
		<?php 
		echo $myrow['descripcionArticulo']; 
		echo '<br>';
		
		if($myrow['notaCredito']=='si'){
		echo '<span class="codigos">[Nota de Credito]</span>';		
		}
		
		if($myrow39e['descripcionGP']!=NULL){
		echo '<br>';
		echo '<span >['. 		$myrow39e['descripcionGP']      .']</span>';		
        }
        
        
if($myrow39e['tasaGP']>0){
    echo  '<br>';
    echo '<span class="success"><blink>IVA</blink></span>';
    
}
		?>
		  <input type="hidden" name="keyR[]"  value="<?php echo $myrow['keyR'];?>" />
          <input type="hidden" name="keyPA[]" value="<?php echo $myrow['keyPA'];?>" /></td>
          
        
         

        
        
        <td bgcolor="<?php echo $color;?>" >
	<?php echo $myrow['cantidad']; ?>	
        </td>
        
        <td bgcolor="<?php echo $color;?>" >
        <label>
        <?php echo $myrow['precioUnitario']; ?>
	</label>
        </td>
        



                
                

        


        <td bgcolor="<?php echo $color;?>" ><div align="center">
<?php echo $myrow['precioUnitario']*$myrow['cantidad']; ?>         
        </td>












        
        
        
        
        <td bgcolor="<?php echo $color;?>" ><div align="center">
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&amp;keyR=<?php echo $myrow['keyR'];?>&id_factura=<?php echo $_GET['id_factura'];?>&proveedor=<?php echo $_GET['proveedor'];?>&departamento=<?php echo $_GET['departamento'];?>&req=<?php echo $_GET['req'];?>&id_proveedor=<?php echo $_GET['proveedor'];?>&importeFactura=<?php echo $_GET['importeFactura'];?>&ivaFactura=<?php echo $_GET['ivaFactura'];?>&keyc=<?php echo $_GET['keyc'];?>&descripcionProveedor=<?php echo $_GET['descripcionProveedor'];?>"> <img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas activar la nota de credito?') == false){return false;}" /></a></div>
        </td>
        
        
        
      </tr>
      <?php } //cierra while
	
	  ?>
    </table>
    
    

<p>&nbsp;</p>
	
	

	
	<br>
	<br>
	
	
	
	
	

<?php if($bandera>0){?>
    
    <div align="center">

       <input name="recibir" type="submit" id="update" value="Recibir Solicitud" />
	
    </div>
        
        
     <?php }?>
        

  </form>
  <p>&nbsp;    </p>
  <p><script>
		new Autocomplete("descripcion", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("keyPA")[0].value = id;
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
			return "/sima/cargos/articulosx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</p>
</body>
</html>