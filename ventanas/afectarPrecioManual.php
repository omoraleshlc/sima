<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>
<?php  
if($_GET['keyR'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
//  AQUI VA
           
$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);  

   
//cantidades
$sSQL= "SELECT  
* 
FROM OC
WHERE
keyR='".$_GET['keyR']."'
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$acc= $myrow['cantidad'];
//CANTIDAD


if($myrow['cargaManual']==''){


$agrega = "UPDATE OC set
cargaManual='si'
where
keyR='".$_GET['keyR']."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();







  $q4 = "

    INSERT INTO contadorTransaccionesKardex(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorTransaccionesKardex where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT max(contador) as topeMaximo from contadorTransaccionesKardex where entidad='".$entidad."' and usuario='".$usuario."'";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $numSolicitud=$myrow['topeMaximo'];














$sSQL1= "SELECT
* 
FROM 
precioArticulos
where
entidad='".$entidad."'
   and
   codigo='".$_GET['codigo']."'
and
    status='request'

";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){
$codigo+=1;
$a+=1;


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

//QUIERO SABER EL GRUPO
$sSQL1a= "SELECT
* 
FROM 
articulos
where
entidad='".$entidad."'
    and
codigo='".$myrow1['codigo']."'
";

$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);
$grupo=$myrow1a['gpoProducto'];









//SI TRAE PRECIO SUGERIDO LO RESPETO
if($myrow1['precioSugerido']>0){


    
//QUIERO SABER EL GRUPO
$sSQL1ar= "SELECT
* 
FROM 
articulosPrecioNivel
where
entidad='".$entidad."'
    and
codigo='".$myrow1['codigo']."'
";

$result1ar=mysql_db_query($basedatos,$sSQL1ar);
$myrow1ar = mysql_fetch_array($result1ar);


if(!$myrow1ar['nivel1']){
     $q = "insert into articulosPrecioNivel
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow1['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."','".$myrow1['precioSugerido']."',
    '".$myrow1['precioSugerido']."', '".$id_medico[$i]."','".$myrow1a['keyPA']."',
    '".$centroDistribucion."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
}    
    
    
    
    
    
    
    
$sSQL7a= "Select * From articulosPrecioNivel where entidad='".$entidad."' 
and
codigo='".$myrow1['codigo']."'
";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
while($myrow7a = mysql_fetch_array($result7a)){
    
    //actualizar todo************************************


$porcentajePS=1-round(($myrow7a['nivel1']/$myrow7a['nivel3']),2);
$nivel1=$myrow1['precioSugerido'];
$nivel3=$nivel1+($nivel1*$porcentajePS);


$agrega = "UPDATE precioArticulos set
status='final'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."'
and
status='request'
order by  keyC DESC
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();



    $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$_GET['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '".$nivel1."','".$nivel3."', '".$id_medico[$i]."','".$_GET['keyPA']."','".$myrow7a['almacen']."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();




$agrega1 = "UPDATE articulosPrecioNivel set
nivel1='".$nivel1."',
    nivel3='".$nivel3."'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."' 
and
almacen='".$myrow7a['almacen']."'
";

mysql_db_query($basedatos,$agrega1);
echo mysql_error();

//****************************************************
}



}else{ //NO TRAE PRECIO SUGERIDO
    

//verificar si tiene politicas de precio
$sSQL1b= "SELECT
* 
FROM 
politicasPrecios
where 
entidad='".$entidad."'    
and
gpoProducto='".$grupo."' 
";

$result1b=mysql_db_query($basedatos,$sSQL1b);
$myrow1b = mysql_fetch_array($result1b);






if( $myrow1b['rangoInicial']>0){
    
    
    
    
//QUIERO SABER EL GRUPO
$sSQL1ar= "SELECT
* 
FROM 
articulosPrecioNivel
where
entidad='".$entidad."'
    and
codigo='".$myrow1['codigo']."'
";

$result1ar=mysql_db_query($basedatos,$sSQL1ar);
$myrow1ar = mysql_fetch_array($result1ar);


if(!$myrow1ar['nivel1']){
     $q = "insert into articulosPrecioNivel
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow1['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."','1',
    '1', '".$id_medico[$i]."','".$myrow1['keyPA']."',
    '".$centroDistribucion."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
}       
    
    
    
    
    
    
    
    
    
    
//AHORA ME TRAIGO EL CODIGO QUE ESTA EN LOS ALMACENES

    $sSQL7a= "Select * From articulosPrecioNivel where entidad='".$entidad."' 
and
codigo='".$myrow1['codigo']."'

";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
while($myrow7a = mysql_fetch_array($result7a)){
    

    
    


$sSQL1bd= "SELECT
* 
FROM 
politicasPrecios
where 
entidad='".$entidad."'    
and
gpoProducto='".$grupo."' 
    and
     '".$myrow1['costo']."' 
         between rangoInicial and rangoFinal
        
";

$result1bd=mysql_db_query($basedatos,$sSQL1bd);
$myrow1bd = mysql_fetch_array($result1bd);
    

    
    //actualizar todo************************************
    if($myrow1bd['porcentaje']>0 and $myrow1['costo']>0){



        
        
$porcentajePS=1-round(($myrow7a['nivel1']/$myrow7a['nivel3']),2);
$nivel1=($myrow1['costo']+($myrow1['costo']*$myrow1bd['porcentaje'])/100);
$nivel3=$nivel1+($nivel1*$porcentajePS);


$agrega = "UPDATE precioArticulos set
status='final'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."'
and
status='request'
order by  keyC DESC
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();



    $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow7a['codigo']."','','',
    '".$nivel1."','".$nivel3."', '','".$myrow7a['keyPA']."','".$myrow7a['almacen']."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();






//QUIERO SABER EL GRUPO
$sSQL1ar= "SELECT
* 
FROM 
articulosPrecioNivel
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."'
";

$result1ar=mysql_db_query($basedatos,$sSQL1ar);
$myrow1ar = mysql_fetch_array($result1ar);


if($myrow1ar['nivel1']>0){
$agrega1 = "UPDATE articulosPrecioNivel set
nivel1='".$nivel1."',
    nivel3='".$nivel3."'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."' 
and
almacen='".$myrow7a['almacen']."'
";

mysql_db_query($basedatos,$agrega1);
echo mysql_error();
}else{
     $q = "insert into articulosPrecioNivel
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow7a['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."','".$nivel1."','".$nivel3."', '".$id_medico[$i]."','".$myrow7a['keyPA']."',
    '".$myrow7a['almacen']."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
//****************************************************
}
}  
}



}//no trae precio sugerido
}





//AFECTAR EXISTENCIAS

for($j=0;$j<$acc;$j++){
//QUIERO SABER EL GRUPO
$sSQL1ay= "SELECT
* 
FROM 
articulos
where
entidad='".$entidad."'
    and
codigo='".$_GET['codigo']."'
";

$result1ay=mysql_db_query($basedatos,$sSQL1ay);
$myrow1ay = mysql_fetch_array($result1ay);



$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='01'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);


$sSQL13= "
SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."' order by keyC DESC";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);      	   


$c=$myrow13['costo'];




$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,costo,nOrden,numSolicitud)
values
('".$_GET['codigo']."','".$myrow1ay['keyPA']."','".$myrow1ay['gpoProducto']."',1,'".$myrow['tipoVenta']."','".$entidad."','entrada',
        '".$fecha1."','".$hora1."','".$usuario."','".$centroDistribucion."','".$_GET['id_factura']."','compra','ready','".$myrow13['costo']."',
'".$myrowy['nOrden']."','".$numSolicitud."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


  $q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrow1['codigo']."','01',
    'compra',
    'ENTRADA','A',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow8ac['keyPA']."','".$centroDistribucion."',
        '".$centroDistribucion."',
        '".$c."',
        1,1,'".$myrow1a['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$myrow8acd['descripcion']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','ENTRADA',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//
}






$tipoMensaje='exito';
$encabezado='Exitoso';
$texto='Precios Actualizados de acuerdo a la politica del almacen...';



        }//lo dejo pasar por si trae carga manual no activada
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
$karticulos-> movimientoskardex($cantidad[$i],'ENTRADA POR COMPRAS','entrada',$usuario,$fecha1,$hora1,$myrow3ae['almacen'],$_GET['departamento'],$keyPA[$i],$myrow3a['codigo'],$entidad,$basedatos);



$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo)
values
('".$myrow8ac['codigo']."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','".$ct[$i]."','".$myrow['tipoVenta']."','".$entidad."','entrada',
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
<h1 align="center" >
AFECTAR PRECIOS INMEDIATAMENTE

</h1>
    
    
    
  <?php echo 'Proveedor: '.$_GET['descripcionProveedor'];?>
   <label>
    <span class="success">
  <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?></span>
  </label>  


  <form id="form1" name="form1" method="post" >

	

    <table width="807" class="table table-striped">
      <tr >
        
          
          <th width="68" scope="col">
               keyPA           
</th>
          
        
        <th width="283"  scope="col">
              <p>Descripcion</p>
</th>
        
                <th width="91"  scope="col"> 
              <p>TipoEntrada</p>
</th>
        
        
        <th width="80"  scope="col"><p>Cantidad</p></th>
    <th width="91"  scope="col"> 
              <p> Costo</p>
  </th>
        
                <th width="91"  scope="col"> 
              <p> SubTotal</p>
 </th>
      
        
                <th width="86"  scope="col">
            <p>Sugerido</p>
</th>
        
        <th width="86"  scope="col">
            <p> Desc %</p>
</th>
        
                <th width="86"  scope="col">
            <p> Desc % PP</p>
</th>
        
                <th width="86"  scope="col">
            <p> Desc Cant</p>
</th>
        
        
        <th width="35"  scope="col">
            <p><span >Total</span>
        </p></th>
        
    <th width="48"  scope="col">
              <p>Enviar</p>
</th>
        
      </tr>
<?php	

 $sSQL= "
SELECT 
*
FROM
compras
where
entidad='".$entidad."'
and
factura='".$_GET['id_factura']."'
and
proveedor='".$_GET['proveedor']."'
and
statusDevolucion!='si'
";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
//echo $myrow['status'];

if($myrow['status']!='sent'){
    $step=TRUE;
}else{
    $step=FALSE;
}





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

  
      <tr>




        

        <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
        <td height="21" bgcolor="<?php echo $color;?>" ><?php echo $myrow['keyPA'];?></td>
        <td bgcolor="<?php echo $color;?>" >
		<?php 
		echo $myrow['descripcionArticulo']; 
		echo '<br>';
		
		if($myrow['status']=='notaCredito'){
		echo '<span class="codigos">[Nota de Credito]</span>';		
		}
		
		if($myrow39e['descripcionGP']!=NULL){
		echo '<br>';
		echo '<span >['. 		$myrow39e['descripcionGP']      .']</span>';		
        }
        
        if($myrow['descuentoPorcentaje']>0){
   
		echo '<span class="codigos">Tiene un '.$myrow['descuentoPorcentaje'].'% de descuento</span>';	
        }
		?>
		  <input type="hidden" name="keyR[]"  value="<?php echo $myrow['keyR'];?>" />
          <input type="hidden" name="keyPA[]" value="<?php echo $myrow['keyPA'];?>" /></td>
          
        
        <td bgcolor="<?php echo $color;?>" >

      <?php echo 
     
 $myrow['tipoEntrada'];?>
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
<?php //aqui va el subtotal
echo '$'.number_format($subTotal,2);

?>	

        </td>

                
                
        <td bgcolor="<?php echo $color;?>" >
		
<?php echo $myrow['precioSugerido']; ?>
        </td>

                        
        <td bgcolor="<?php echo $color;?>" >
		
<?php echo $myrow['descuentoPorcentaje']; ?>		
        </td>
        
        
        
                <td bgcolor="<?php echo $color;?>" >
		
<?php echo $myrow['descuentoPorcentajePP']; ?>		
        </td>
        
        
        
        
                <td bgcolor="<?php echo $color;?>" >
<?php //aqui va el descuento en cantidad
echo '$'.number_format($td,2);
$descuentoCantidad[0]+=$td;
?>	

        </td>
        
        
        <td bgcolor="<?php echo $color;?>" >
            <div align="center">
                <span > 
<?php //aqui va el total

echo '$'.number_format($t-$td,2);
$totalLinea[0]+=$t-$td;
$importeNeto[0]+=$t-$td;
?>
                </span></div>
        </td>
        
        
        <td bgcolor="<?php echo $color;?>" ><div align="center">
<?php

if($step==TRUE){
    if($myrow['cargaManual']!='si'){?>                
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?codigo=<?php echo $myrow['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&amp;keyR=<?php echo $myrow['keyR'];?>&id_factura=<?php echo $_GET['id_factura'];?>&proveedor=<?php echo $_GET['proveedor'];?>&departamento=<?php echo $_GET['departamento'];?>&req=<?php echo $_GET['req'];?>&id_proveedor=<?php echo $_GET['proveedor'];?>&importeFactura=<?php echo $_GET['importeFactura'];?>&ivaFactura=<?php echo $_GET['ivaFactura'];?>&keyc=<?php echo $_GET['keyc'];?>&descripcionProveedor=<?php echo $_GET['descripcionProveedor'];?>"> 
Afectar Precio                    
                </a>
<?php }else{ echo '---';}}?>
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
