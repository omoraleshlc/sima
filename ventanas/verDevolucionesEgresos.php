<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>
<?php  
if($_GET['keyR'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "delete from OC

		WHERE keyR='".$_GET['keyR']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>








<?php 
function noRound($val, $pre = 0) {
    $val = (string) $val;
    if (strpos($val, ".") !== false) {
        $tmp = explode(".", $val);
        $val = $tmp[0] .".". substr($tmp[1], 0, $pre);
    }
    return (float) $val;
} 
/*
echo round(0.164654651, 2); // 0.165
echo "\n";
echo noRound(0.164654651, 2); // 0.164
*/
?>








<?php 
if($_POST['update'] ){
$precioSugerido=$_POST['precioSugerido'];$costo=$_POST['costo'];
$keyR=$_POST['keyR'];$cantidad=$_POST['cantidad'];$notaCredito=$_POST['notaCredito'];$tipoEntrada=$_POST['tipoEntrada'];
$descuentoPorcentaje=$_POST['descuentoPorcentaje'];$descuentoPorcentajePP=$_POST['descuentoPorcentajePP'];$porcentajeOferta=$_POST['porcentajeOferta'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyR[$i]){

    
    
    
$sSQL12= "
	SELECT *
FROM
    OC

WHERE keyR='".$keyR[$i]."'";


$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
    

if($descuentoPorcentaje[$i]>0){
    $importeDescu=$costo[$i]-(($descuentoPorcentaje[$i]*0.01)*$costo[$i]);
}    else{
    $importeDescu=NULL;
}
    
    
$q = "UPDATE OC set 
porcentajeOferta='".$porcentajeOferta[$i]."',      
naturaleza='C',
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
    entidad,numFactura,keyPA,cantidadParticular,cantidadAseguradora,cantidad,descripcionArticulo,naturaleza

) values (

'".$_GET['req']."','".$_GET['departamento']."','".$usuario."','".$fecha1."','".$hora1."','request',
'".$_POST['prioridad']."','".$_GET['proveedor']."','".$entidad."','".$_GET['id_factura']."','".$_POST['keyPA']."' ,'0.00','0.00','0' ,'".$myrow12['descripcion']."','C' )";
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
    and
    proveedor='".$_GET['proveedor']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();


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
id_proveedor='".$_GET['proveedor']."'
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
    centroDistribucion='si'  ";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);





$karticulos=new kardex();
$karticulos-> movimientoskardex('entrada',$ct,'ENTRADA POR COMPRAS',$tipoEntrada[$i],$usuario,$fecha1,$hora1,$myrow3ae['almacen'],$_GET['departamento'],$keyPA[$i],$myrow3a['codigo'],$entidad,$basedatos);



$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status)
values
('".$myrow8ac['codigo']."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','".$ct."','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow3ae['almacen']."','".$_GET['id_factura']."','".$tipoEntrada[$i]."','standby')";
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


//**********conversion a unidades***********
$entrance=new entradas();
$entrance=$entrance->entradaInventarios($almacen,$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);
//******************************************
} 










echo '
<script>
window.alert("Factura Enviada");
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
<h1 align="center"><br />

    <?php echo 'Proveedor: '.$_GET['descripcionProveedor'];?>

</h1>

  <form id="form1" name="form1" method="post" >
   

    <table width="907" class="table table-striped">
      <tr >
        

                <th width="68" height="19"  scope="col">#</th>
          
          
          
          <th width="68" height="19"  scope="col">keyPA</th>
          
        
        <th width="283"  scope="col">Descripcion</th>
        
                <th width="91"  scope="col">TipoSalida</th>
        
        
        <th width="80"  scope="col">Cantidad</th>
    <th width="91"  scope="col">Costo</th>
     <th width="91"  scope="col">Iva</th>
        
                <!--th width="91"  scope="col">SubTotal</th>
      
        
                <th width="86"  scope="col">Sugerido</th>
        
                <th width="86"  scope="col">Oferta %</th>

        
        
        <th width="86"  scope="col">Desc %</th>
        
                <th width="86"  scope="col">Desc % PP</th>
        
                <th width="86"  scope="col">Desc Cant</th-->
        
        
        <th width="35"  scope="col">Total</th>
        	
    <!--th width="48"  scope="col">Eliminar</th-->
        
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
numFactura='".$_GET['id_factura']."'
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
     $tivaOferta[0]+=round($ivaOfertaD,2);
    
   }
   
   
$oferta[0]+=round($ofertaD,2)*round($myrow['cantidad'],2);//este multiplica cantidades


}else{
$a=$myrow['precioUnitario'];
}//TERMINA VALIDACION DE OFERTA





//VALIDACION DE PORCENTAJE NORMAL
if($myrow['descuentoPorcentaje']>0){
$descuentoD=$precioDerivado*($myrow['descuentoPorcentaje']*0.01);
$precioDerivado=$precioDerivado-$descuentoD;
$descuento[0]+= round(($a-$precioDerivado)*$myrow['cantidad'],2);
$ivaDescuentoR=($a-$precioDerivado);


   if($myrow39e['tasaGP']>0){ 
    $tivaDescuentoD=(($ivaDescuentoR)*($myrow39e['tasaGP']*0.01))*$myrow['cantidad'];     
    $tivaDescuento[0]+=round($tivaDescuentoD,2);
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

$descuentoPP[0]+= round(($a-$precioDerivado)*$myrow['cantidad'],2);
$ivaDescuentoPPR=($b-$precioDerivado);


   if($myrow39e['tasaGP']>0){ 
    $tivaDescuentoPPD=(($ivaDescuentoPPR)*($myrow39e['tasaGP']*0.01))*$myrow['cantidad']; 
    $tivaDescuentoPP[0]+=round($tivaDescuentoPPD,2);
    
   }

}else{   
   $c=$myrow['precioUnitario'];
}//CIERRA VALIDACION DE PORCENTAJE PP

    
}else{//NO TRAE DESCUENTOS
 $precioDerivado=$myrow['precioUnitario'];    
}




if($myrow39e['tasaGP']>0){
$iva[0]+=round(($myrow['precioUnitario']*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01),2);
if($myrow['notaCredito']=='si'){
$ivaNC=($precioDerivado*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01);
}
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
		
		if($myrow['status']=='notaCredito'){
		echo '<span class="notice">[Nota de Credito]</span>';		
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
<?php echo $myrow['tipoSalida'];?>
        </td>  

        
        
        <td bgcolor="<?php echo $color;?>" >
<?php echo $myrow['cantidad']; ?>	
        </td>
        
        <td bgcolor="<?php echo $color;?>" >
        <label>
        <?php echo $myrow['precioUnitario']; ?>
	</label>
        </td>
        
<td bgcolor="<?php echo $color;?>" >
<?php echo '$'.number_format($iva[0],2);?>	

        </td>
<!--td bgcolor="<?php echo $color;?>" >
<?php //aqui va el subtotal

echo '$'.number_format($myrow['precioUnitario']*$myrow['cantidad'],2);
?>	

        </td>

                
                

        <td bgcolor="<?php echo $color;?>" >


		<?php if($myrow39e['politicaPrecios']=='si' and $myrow['precioSugerido']<1){
			$ob[0]+=1;
			 echo $ed='<div id="subDiv2" name="subDiv2" title="Subdivision Div Element" style="color: #FF00FF;border: 1px dashed red;">';
		}else{
			echo  $ed='<div >';
			
		}
			?>
			
            		
            
            
            
            
<?php echo $myrow['precioSugerido']; ?>

</td>



<td bgcolor="<?php echo $color;?>" >
	
<?php echo $myrow['porcentajeOferta']; ?>	
        
<?php //aqui va la oferta

if($myrow['porcentajeOferta']>0){

echo number_format($ofertaD,2); 
echo '<br>';
echo number_format($ivaOfertaD,2);    
}
?>

</td>



                
        <td bgcolor="<?php echo $color;?>" >

            
<?php echo $myrow['descuentoPorcentaje']; ?>


<?php 
//DESCUENTO PORCENTAJE
if($myrow['descuentoPorcentaje']>0){
echo number_format($descuentoD,2); 
echo '<br>';
echo number_format($tivaDescuentoD,2); 
}
?>
        </td>
        
        
        
                <td bgcolor="<?php echo $color;?>" >

<?php echo $myrow['descuentoPorcentajePP']; ?>

<?php
//DESCUENTO PORCENTAJE PP
if($myrow['descuentoPorcentajePP']>0){
echo number_format($descuentoPPD+$ivaDescuentoPPD,2); 
}

?>
</td-->
        
        
        
        
                <!--td bgcolor="<?php echo $color;?>" >
<?php //aqui va el descuento en cantidad
echo '$'.number_format($precioDerivado,2); 
?>	

        </td-->
        
        
        <td bgcolor="<?php echo $color;?>" >
            <div align="center">
                <span > 
<?php 
if($myrow['tipoEntrada']!='regalo' and $myrow['tipoEntrada']!='donacion'){

//TOTALES******
$importe[0]+=round($myrow['precioUnitario']*$myrow['cantidad'],2);

$st[0]+=round($precioDerivado*$myrow['cantidad'],2);
echo '$'.number_format($precioDerivado*$myrow['cantidad'],2);   
}else{
echo '$'.number_format("0.00",2);    
}

?>
                </span></div>
        </td>
        
        
        <!--td bgcolor="<?php echo $color;?>" ><div align="center">
              </div>
        </td-->
        
        
        
      </tr>
      <?php } //cierra while
	
	  ?>
    </table>
    


    

	
	<br>
	<br>
	
	
	
	
	
	
	
	
  <?php 
  if($_GET['id_factura']!=NULL){
 $sSQL17a= "Select * From compras WHERE entidad='".$entidad."' and  proveedor='".$_GET['proveedor']."' and factura='".$_GET['id_factura']."'
";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);
$descuentoPP[0]=$myrow17a['descuentoPP'];
  }
  ?>
	
	 
    

 
    
<!--table class="table-forma">
<tr>
<th>Total Factura</th>
<td><?php echo '$'.number_format($myrow17a['importe'],2);?></td>
</tr>
</table>
<br /><br>
<table class="table-forma">
<tr>
<th>Iva facturado</th>
<td><?php echo '$'.number_format($myrow17a['iva'],2);?></td>
</tr>


<tr>
<th>Total</th>
<th><?php echo '$'.number_format($myrow17a['importe']+$myrow17a['iva'],2);?></th>
</tr>

</table-->


</br></br></br></br></br>
<div align="center" >
    
<table class="table-forma">
<tr>
<th>Captura</th>
<th></th>
</tr>


<!--tr>
<td>*Referencia Sistema (Control Interno)</td>
<td><?php echo '$'.number_format($st[0],2);?></td>
</tr-->



<tr>
<td>Importe</td>
<td><?php echo '$'.number_format($importe[0],2);?></td>
</tr>


<!--tr>
<td>(-)Oferta</td>
<td><?php echo '$'.number_format($oferta[0],2);?></td>
</tr>



<tr>
<td>(-)Descuento</td>
<td><?php echo '$'.number_format($descuento[0],2);?></td>
</tr>

<tr>
<td>(-)Descuento PP</td>
<td><?php echo '$'.number_format($descuentoPP[0],2);?></td>
</tr-->







<tr>
<td>+IVA Captura</td>
<td><?php echo '$'.number_format($iva[0],2);?></td>
</tr>





<!--tr>
<td>-IVA Oferta</td>
<td><?php echo '$'.number_format($tivaOferta[0],2);?></td>
</tr>


<tr>
<td>-IVA Descuento</td>
<td><?php echo '$'.number_format($tivaDescuento[0],2);?></td>
</tr>

<tr>
<td>-IVA Descuento PP</td>
<td><?php echo '$'.number_format($tivaDescuentoPP[0],2);?></td>
</tr>

<tr>
<td>Gasto (no incluye IVA)</td>
<td><?php echo '$'.number_format($myrow17a['gastos'],2);?></td>
</tr>



<tr>
<td>IVA TOTAL</td>
<?php
if($myrow17a['gastos']>0){
$sSQL39e= "
	SELECT 
*
FROM
TASA
WHERE 

valorTasa>0";
$result39e=mysql_db_query($basedatos,$sSQL39e);
$myrow39e = mysql_fetch_array($result39e);
$ivaGasto= $myrow17a['gastos']*($myrow39e['valorTasa']*0.01); 
}
$ivaT=($iva[0]+$ivaGasto)-($tivaOferta[0]+$tivaDescuento[0]+$tivaDescuentoPP[0]);
?>
<td>
<?php 
echo '$'.number_format($ivaT,2);

?>

</td>
</tr>





<tr>
<td>(-) Nota de Credito</td>
<td><?php echo '$'.number_format($nCT[0],2);?></td>
</tr-->








<tr>
<th>Total</th>
<th>
<?php 

$subTotalCaptura=($importe[0]+$ivaT+$myrow17a['gastos']);
$subTotalCaptura=$subTotalCaptura-($oferta[0]+$descuento[0]+$descuentoPP[0]);




$subTotal=$myrow17a['importe']+$myrow17a['iva']+$myrow17a['gastos'];
$total=$subTotal-($subTotalCaptura);
$TOTAL=$subTotal-$subTotalCaptura;

/*
 if($total>-1 and $total<1){           
     
     if($subTotal>$subTotalCaptura){
$total=$subTotal-$subTotalCaptura;
     $total=$subTotalCaptura-$total;    
     }else{
   $total=$subTotalCaptura-$subTotal;
     $total=$subTotalCaptura-$total;
     }//es menor la cantidad
     }*/
//echo '<br>';




$tt=($myrow17a['importe']+$myrow17a['gastos'])-$t;
$tare= (float) noRound($myrow17a['notaCredito']+($importe[0]+$myrow17a['gastos']+($iva[0]+$ivaGasto-($tivaOferta[0]+$tivaDescuento[0]+$myrow17a['ivaDescuentoPP'])))-($oferta[0]+$descuento[0]+$myrow17a['descuentoPP']),2);
 
$c= (float) ($myrow17a['importe']-$tare);
if(($c>=-0.96 and $c<=0.03 )or ($c>0 and $c<=0.30)){
    $subt=($myrow17a['importe']-$tare);
    $total=$myrow17a['importe'];
}else{
    $total=(float) $tare;
}

echo '$'.noRound($total,2);

//echo '$'.number_format($subTotalCaptura,2);    

?>        
</th>
</tr>


</table>

</div>
 
<br /><br />
<div id="cont3">
<table class="table-forma">
<tr>

<td>
<?php 


/*
 if($total>-1 and $total<1){           
     
     if($subTotal>$subTotalCaptura){
$total=$subTotal-$subTotalCaptura;
     $total=$subTotalCaptura-$total;    
     }else{
   $total=$subTotalCaptura-$subTotal;
     $total=$subTotalCaptura-$total;
     }//es menor la cantidad
     }*/
//echo '<br>';
/*

$total=$myrow17a['importe'];

$c= (float) ($myrow17a['importe']-$tare);
if(($c>=-0.96 and $c<=0.03 )or ($c>0 and $c<=0.30)){
    $subt=($myrow17a['importe']-$tare);
    $total=$myrow17a['importe'];
}else{
    $total=(float) $tare;
}


echo '$'.noRound( $total);

*/

//echo '$'.number_format($total,2);
?>        
</td>
</tr>

</table> 
       
        <br></br>        
                <p>&nbsp;</p>          <p>&nbsp;</p>  
        
        
        
        
        
        <p>&nbsp;</p>  
        

    
    <div align="center">
      <label>

      
      <br />
      <?php 

      //echo '<br>';
      //echo '<span >Total Factura: '.'$'.number_format($totalInvoice,2).'</span>';
      //echo '<br>';
      //echo '<span >Total Captura: '.'$'.number_format($totalCapturado,2).'</span>';
      //echo '<br>';
      //echo '<span >Diferencia: '.'$'.number_format($totalInvoice-$totalCapturado,2).'</span>';

	  if( $total==0){ ?>
	  <br>
     
       </br>
       <?php } ?>
	  </label>
      <label>
    
      </label>
    </div>
        
        
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
