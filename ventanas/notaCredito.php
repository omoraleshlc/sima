<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>
<?php  
if($_GET['keyR'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
//  AQUI VA
           
$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);  



    $sSQL12= "
	SELECT *
FROM
  OC

WHERE keyR='".$_GET['keyR']."'";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);

if($myrow12['tipoEntrada']!='notaCredito'){
  $q = "UPDATE OC set 
      tipoEntrada='notaCredito'

		WHERE keyR='".$_GET['keyR']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();

                

//*******************ACTUALIZO EXISTENCIAS***********************
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow3a['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad[$i]*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad[$i];
}
//****************************************************************





$sSQL3ae= "
	SELECT 
almacen
FROM
almacenes
where
entidad='".$entidad."'
    and
    centroDistribucion='si'
";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);


$karticulos=new kardex();
$karticulos-> movimientoskardex('entrada',$myrow12['cantidad'],'NOTA DE CREDITO (DEVOLUCION A PROVEEDORES)','notaCredito',$usuario,$fecha1,$hora1,$myrow3ae['almacen'],$_GET['departamento'],$keyPA[$i],$myrow3a['codigo'],$entidad,$basedatos);


/*
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo)
values
('".$myrow8ac['codigo']."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','".$ct[$i]."','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow3ae['almacen']."','".$_GET['id_factura']."','".$tipoEntrada[$i]."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
*/

//DETERMINAR EL COSTO				
$sSQL3ac="SELECT costo
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow8ac['codigo']."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);	
  
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,costo,factura,tipo,status)
values
('".$myrow8ac['codigo']."','".$myrow8acd['keyPA']."','".$myrow8acd['gpoProducto']."','".$ct."','','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow3ae['almacen']."','".$myrow3ac['costo']."','','Normal','standby')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




$entrance=new entradas();
$entrance=$entrance->entradaInventarios($myrow3ae['almacen'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);



$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Articulos Actualizados...';      
	}
        }


}
?>


















<?php 
if($_POST['update'] ){
$precioSugerido=$_POST['precioSugerido'];$costo=$_POST['costo'];
$keyR=$_POST['keyR'];$cantidad=$_POST['cantidad'];$notaCredito=$_POST['notaCredito'];$tipoEntrada=$_POST['tipoEntrada'];
$descuentoPorcentaje=$_POST['descuentoPorcentaje'];$descuentoPorcentajePP=$_POST['descuentoPorcentajePP'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyR[$i]){

    
    
    
    $sSQL12= "
	SELECT *
FROM
  OC

WHERE keyR='".$keyR[$i]."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
    

if($descuentoPorcentaje[$i]>0){
    $importeDescu=$costo[$i]-(($descuentoPorcentaje[$i]*0.01)*$costo[$i]);
}    else{
    $importeDescu=NULL;
}
    
    
  $q = "UPDATE OC set 
      tipoEntrada='".$tipoEntrada[$i]."',
      notaCredito='".$notaCredito[$i]."',
    cantidad='".$cantidad[$i]."',
        importeDescuento='".$importeDescu."',
        descuentoPorcentaje='".$descuentoPorcentaje[$i]."',
            descuentoPorcentajePP='".$descuentoPorcentajePP[$i]."',
precioSugerido='".$precioSugerido[$i]."',
precioUnitario='".$costo[$i]."'

		WHERE keyR='".$keyR[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}

}




}












if($_POST['descripcion'] and $_POST['keyPA'] and !$_POST['update'] and !$_POST['send']){


$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
keyPA='".$_POST['keyPA']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


$agregaSaldo = "INSERT INTO OC ( id_requisicion,id_almacen,usuario,fecha,hora,status,prioridad,id_proveedor,
    entidad,numFactura,keyPA,cantidadParticular,cantidadAseguradora,cantidad,descripcionArticulo

) values (

'".$_GET['req']."','".$_GET['departamento']."','".$usuario."','".$fecha1."','".$hora1."','request',
'".$_POST['prioridad']."','".$_GET['proveedor']."','".$entidad."','".$_GET['id_factura']."','".$_POST['keyPA']."' ,'0.00','0.00','0' ,'".$myrow12['descripcion']."' )";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();

}
?>

























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
status='sent'
WHERE 
entidad='".$entidad."'
    and
factura='".$_GET['id_factura']."'
";
mysql_db_query($basedatos,$q1);



for($i=0;$i<=$_POST['bandera'];$i++){



if($keyR[$i]!=NULL){



$sSQL3a= "
	SELECT 
codigo,gpoProducto,descripcion
FROM
articulos
WHERE keyPA='".$keyPA[$i]."'";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);




$sSQLrd= "SELECT  
* 
FROM OC
WHERE
entidad='".$entidad."'
and
numFactura='".$_GET['id_factura']."'
and
codigo='".$myrow3a['codigo']."'";
$resultrd=mysql_db_query($basedatos,$sSQLrd);
$myrowrd = mysql_fetch_array($resultrd);


$_GET['departamento']=$myrowrd['id_almacen'];


//***************************************
if($cantidad[$i]>0 and  $costo[$i]>0 and $keyR[$i]  ){


$porcentajeParticular=($costo[$i]*$myrow3['porcentajeParticular'])/100;
$porcentajeAseguradora=($costo[$i]*$myrow3['porcentajeAseguradora'])/100;


if($keyPA[$i]!=NULL){
$q1a = "INSERT INTO precioArticulos 
(codigo,costo,usuario,fecha,hora,entidad,keyPA,ID_EJERCICIO,status,
cantidadParticular,cantidadAseguradora,descripcionArticulo,precioSugerido)
values
('".$myrow3a['codigo']."','".$costo[$i]."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keyPA[$i]."','".$ID_EJERCICIOM."' ,'request'  ,'".$porcentajeParticular."' ,
        '".$porcentajeAseguradora."' ,'".$myrow3a['descripcion']."' ,'".$precioSugerido[$i]."' )";

mysql_db_query($basedatos,$q1a);
echo mysql_error();



  


//*******************ACTUALIZO EXISTENCIAS***********************
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow3a['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad[$i]*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad[$i];
}
//****************************************************************





$sSQL3ae= "
	SELECT 
almacen
FROM
almacenes
where
entidad='".$entidad."'
    and
    centroDistribucion='si'
";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);


$karticulos=new kardex();
$karticulos-> movimientoskardex($cantidad[$i],'NOTA DE CREDITO','notaCredito',$usuario,$fecha1,$hora1,$myrow3ae['almacen'],$_GET['departamento'],$keyPA[$i],$myrow3a['codigo'],$entidad,$basedatos);



$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo)
values
('".$myrow8ac['codigo']."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','".$ct[$i]."','".$myrow['tipoVenta']."','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow3ae['almacen']."','".$_GET['id_factura']."','".$tipoEntrada[$i]."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//$q1a = "UPDATE existencias set 
//cantidadTotal=cantidadTotal+'".$ct."',
//existencia=existencia+'".$cantidad[$i]."'
//WHERE
//
//keyPA='".$keyPA[$i]."'
//and
//almacen='".$_GET['departamento']."'
//";
//mysql_db_query($basedatos,$q1a); 
//echo mysql_error();

}
}











}

} ?>
<script>
window.alert("Factura Enviada");
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php 
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
<h1 align="center" class="titulos"><br />
GENERAR NOTA DE CREDITO
<br>
</h1>
    
    
    <h2> 
    <?php echo 'Proveedor: '.$_GET['descripcionProveedor'];?>
    </h2>
    <br>
        
        
   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>  


  <form id="form1" name="form1" method="post" >

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    <table width="807" border="0" align="center" cellpadding="4" cellspacing="0" class="normal" style="border: 0px solid #000000;">
      <tr bgcolor="#FFFF00">
        
          
          <td width="68" height="19" class="Estilo5" scope="col"><div align="center" class="normal">
            <div align="left" class="normal">
              <div align="left">                keyPA              </div>
            </div>
        </div>
            <p>
              </div>
        </p></td>
          
        
        <td width="283" class="normal" scope="col"><div align="center" class="normal">
          <div align="left" class="normal">
            <div align="left">
              <p>Descripcion</p>
            </div>
          </div>
        </div></td>
        
                <td width="91" class="normal" scope="col"> <div align="left" class="normal">
            <div align="left">
              <p>TipoEntrada</p>
            </div>
        </div></td>
        
        
        <td width="80" class="normal" scope="col"><p><span class="normal">Cantidad</span></p></td>
    <td width="91" class="normal" scope="col"> <div align="left" class="normal">
            <div align="left">
              <p> Costo</p>
            </div>
        </div></td>
        
                <td width="91" class="normal" scope="col"> <div align="left" class="normal">
            <div align="left">
              <p> SubTotal</p>
            </div>
        </div></td>
      
        
                <td width="86" class="normal" scope="col"><div align="left" class="normal">
          <div align="left">
            <p>Sugerido</p>
          </div>
        </div></td>
        
        <td width="86" class="normal" scope="col"><div align="left" class="normal">
          <div align="left">
            <p> Desc %</p>
          </div>
        </div></td>
        
                <td width="86" class="normal" scope="col"><div align="left" class="normal">
          <div align="left">
            <p> Desc % PP</p>
          </div>
        </div></td>
        
                <td width="86" class="normal" scope="col"><div align="left" class="normal">
          <div align="left">
            <p> Desc Cant</p>
          </div>
        </div></td>
        
        
        <td width="35" class="normal" scope="col">
            <p><span class="normal">Total</span>
        </p></td>
        
    <td width="48" class="normal" scope="col"><div align="center" class="normal">
            <div align="center">
              <p>Enviar</p>
            </div>
        </div></td>
        
      </tr>
<?php	
$sSQL= "SELECT  
* 
FROM OC
WHERE
entidad='".$entidad."'
and
numFactura='".$_GET['id_factura']."'

";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
    $a+=1;
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
tasaGP,descripcionGP
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$myrow12['gpoProducto']."'";
$result39e=mysql_db_query($basedatos,$sSQL39e);
$myrow39e = mysql_fetch_array($result39e);

if($myrow39e['tasaGP']>0){
$iva[0]+=($myrow['precioUnitario']*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01);
$iv=($myrow['precioUnitario']*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01);
}


if($myrow['keyPA']){
$importeFactura[0]+=$myrow['precioUnitario']*$myrow['cantidad'];
}






if($myrow['notaCredito']=='si'){
$notaCredito[0]+=$myrow['precioUnitario']*$myrow['cantidad'];
}
//***************************
//descuento sin iva, normal
$descuento=($myrow['precioUnitario']*$myrow['cantidad'])*($myrow['descuentoPorcentaje']*0.01);





//*************
$importes[0]+=($myrow['precioUnitario']*$myrow['cantidad']);
$subTotal=($myrow['precioUnitario']*$myrow['cantidad']);
$subTotalNeto[0]+=($myrow['precioUnitario']*$myrow['cantidad']);
$t=($myrow['precioUnitario']*$myrow['cantidad'])-$descuento;

//descuento sin iva, por pronto pago
$td= $descuentoPP=$t*($myrow['descuentoPorcentajePP']*0.01);
?>

    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor='#ffffff'" >
      <tr>




        

        <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
        <td height="21" bgcolor="<?php echo $color;?>" class="normal"><?php echo $myrow['keyPA'];?></td>
        <td bgcolor="<?php echo $color;?>" class="normal">
		<?php 
		echo $myrow['descripcionArticulo']; 
		echo '<br>';
		
		if($myrow['status']=='notaCredito'){
		echo '<span class="codigos">[Nota de Credito]</span>';		
		}
		
		if($myrow39e['descripcionGP']!=NULL){
		echo '<br>';
		echo '<span class="normal">['. 		$myrow39e['descripcionGP']      .']</span>';		
        }
        
        if($myrow['descuentoPorcentaje']>0){
   
		echo '<span class="codigos">Tiene un '.$myrow['descuentoPorcentaje'].'% de descuento</span>';	
        }
		?>
		  <input type="hidden" name="keyR[]"  value="<?php echo $myrow['keyR'];?>" />
          <input type="hidden" name="keyPA[]" value="<?php echo $myrow['keyPA'];?>" /></td>
          
        
        <td bgcolor="<?php echo $color;?>" class="normal">

      <?php echo 
     
 $myrow['tipoEntrada'];?>
        </td>  

        
        
        <td bgcolor="<?php echo $color;?>" class="normal">
<?php echo $myrow['cantidad']; ?>	
        </td>
        
        <td bgcolor="<?php echo $color;?>" class="normal">
        <label>
<?php echo $myrow['precioUnitario']; ?>
	</label>
        </td>
        

<td bgcolor="<?php echo $color;?>" class="normal">
<?php //aqui va el subtotal
echo '$'.number_format($subTotal,2);

?>	

        </td>

                
                
        <td bgcolor="<?php echo $color;?>" class="normal">
		
<?php echo $myrow['precioSugerido']; ?>
        </td>

                        
        <td bgcolor="<?php echo $color;?>" class="normal">
		
<?php echo $myrow['descuentoPorcentaje']; ?>		
        </td>
        
        
        
                <td bgcolor="<?php echo $color;?>" class="normal">
		
<?php echo $myrow['descuentoPorcentajePP']; ?>		
        </td>
        
        
        
        
                <td bgcolor="<?php echo $color;?>" class="normal">
<?php //aqui va el descuento en cantidad
echo '$'.number_format($td,2);
$descuentoCantidad[0]+=$td;
?>	

        </td>
        
        
        <td bgcolor="<?php echo $color;?>" class="normal">
            <div align="center">
                <span class="normal"> 
<?php //aqui va el total

echo '$'.number_format($t-$td,2);
$totalLinea[0]+=$t-$td;
$importeNeto[0]+=$t-$td;
?>
                </span></div>
        </td>
        
        
        <td bgcolor="<?php echo $color;?>" class="normal"><div align="center">
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?codigo=<?php echo $myrow['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&amp;keyR=<?php echo $myrow['keyR'];?>&id_factura=<?php echo $_GET['id_factura'];?>&proveedor=<?php echo $_GET['proveedor'];?>&departamento=<?php echo $_GET['departamento'];?>&req=<?php echo $_GET['req'];?>&id_proveedor=<?php echo $_GET['proveedor'];?>&importeFactura=<?php echo $_GET['importeFactura'];?>&ivaFactura=<?php echo $_GET['ivaFactura'];?>&keyc=<?php echo $_GET['keyc'];?>&descripcionProveedor=<?php echo $_GET['descripcionProveedor'];?>"> 
Aplicar NC                    
                </a>
            </div>
        </td>
        
      </tr>
      <?php } //cierra while
	
	  ?>
    </table>
   
<p>&nbsp;</p>
	
	
	
	
	
	
	
	
	
	
	
	
	
  <?php 
  if($_GET['id_factura']!=NULL){
 $sSQL17a= "Select * From compras WHERE entidad='".$entidad."' and factura='".$_GET['id_factura']."'
";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);
  }
  ?>
	
	 
    
    
    
    
    
    
    
    <table width="682" border="0" align="center" cellpadding="4" cellspacing="0" class="normal" style="border: 1px solid #000000;">
      
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td bgcolor="#FFFF00">I FACTURA</td>
          <td bgcolor="#FFFF00">&nbsp;</td>
          <td bgcolor="#FFFF00">DESCUENTO</td>
          <td bgcolor="#FFFF00">&nbsp;</td>
          <td bgcolor="#FFFF00">NETO</td>
          <td bgcolor="#FFFF00">&nbsp;</td>
          <td bgcolor="#FFFF00">GASTOS</td>
        </tr>
        <tr>
        <td width="24">&nbsp;</td>
        <td width="101">Importe</td>
        <td width="93"><?php echo '$'.number_format($myrow17a['importe'],2);?></td>
        <td width="19">&nbsp;</td>
        <td width="130"></td>
        <td width="20">&nbsp;</td>
        <td width="115"><?php echo '$'.number_format($importeNeto[0],2);?></td>
        <td width="23"></td>
        <td width="117"></td>
        
      </tr>
      
      
      <tr>
        <td>&nbsp;</td>
        <td>Iva </td>
        <td><?php echo '$'.number_format($myrow17a['iva'],2);?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo '$'.number_format($iva[0],2);?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      
      <tr>
        <td>&nbsp;</td>
        <td>Total </td>
        <td><?php echo '$'.number_format($myrow17a['importe']+$myrow17a['iva'],2);?></td>
        <td>&nbsp;</td>
        <td><?php echo '$'.number_format($descuentoCantidad[0],2);?></td>
        <td>&nbsp;</td>
        <td><?php echo '$'.number_format($importeNeto[0]+$iva[0],2);?></td>
        <td>&nbsp;</td>
       <td><?php echo '$'.number_format($myrow17a['gastos'],2);?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        
      </tr>
        
          <tr>
        <td>&nbsp;</td>
       
        <td><?php 
        
        ?></td>
        
        
        <td>

        </td>
        
        
      </tr>    
        
        
      <tr>
        <td colspan="9">
		<div align="center">
            <?php         
          //aqui van los totales          
                  ?>  
		</div></td>
      </tr>
    </table>
    <p align="center">&nbsp;</p>
    <p align="center"><label></label>
    </p>

    <div align="center">

    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
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
