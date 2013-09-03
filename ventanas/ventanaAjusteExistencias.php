<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=800,height=800,scrollbars=YES") 
} 
</script> 



<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>

<script>
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</script>

    
    
<?php 
/*
$_POST['almacenDestino']=$_GET['almacenDestino']; 
 
 
if($_GET['keyMedico']){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE medicos set 

		status='I'
		WHERE keyMedico='".$_GET['keyMedico']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else {
$q = "UPDATE medicos set 

		status='A'
		WHERE keyMedico='".$_GET['keyMedico']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
 */
?>   
    
    
  
    
    
    
    
    
    
    
    
    <?php






$_POST['porArticulo']=$_GET['porArticulo'];
$_POST['anaquel']=$_GET['anaquel'];


$hoy = date("d/m/Y");
$hora = date("g:i a");


















if($_POST['actualizar'] ){

//**************
//quien es el centro de distribucion?
    $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
centroDistribucion='si'

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);    
   $cendis=$myrow29p['almacen']; 
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$ct=$_POST['cantidad'];
$ci=$_POST['conceptoinventarios'];
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$cajaCon=$_POST['cajaCon'];
$existenciaCendis=$_POST['existenciaCendis'];
$costo=$_POST['costo'];






 $sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE
entidad='".$entidad."'
and
codigo='".$_POST['conceptoinventarios']."'";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);
$codigoInv=$myrow8acd['codigo'];

if($myrow8acd['naturaleza']=='A'){
    $tipoMov='entrada';
    $aly=$_POST['almacenDestino'];
    $alyMain=$_GET['almacenDestino'];
}elseif($myrow8acd['naturaleza']=='C'){
    $tipoMov='salida';
    
    $alyMain=$_POST['almacenDestino'];
    $aly=$_GET['almacenDestino'];
}
 $n=$myrow8acd['naturaleza'];
















if($_POST['conceptoinventarios']!='' and $_POST['costo']!=''){


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

$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE
    codigo='".$_POST['conceptoinventarios']."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);
$codigoInv=$myrow8acd['codigo'];
   
    
    
if( $myrow8acd['naturaleza']=='A'){    

    
for($j=0;$j<=$_POST['flag'];$j++){
    
if($coder[$j]!=NULL){
    
//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA***********
//QUIEN SALE?
    
    
   
    
if($ct[$j]>0 and $costo[$j]>0 ){
    
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$coder[$j]."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);

$q1a = "INSERT INTO precioArticulos 
(codigo,costo,usuario,fecha,hora,entidad,keyPA,ID_EJERCICIO,status,
cantidadParticular,cantidadAseguradora,descripcionArticulo,precioSugerido)
values
('".$coder[$j]."','".$costo[$j]."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keyPA[$i]."','".$ID_EJERCICIOM."' ,'request'  ,'".$porcentajeParticular."' ,
        '".$porcentajeAseguradora."' ,'".$myrow8ac['descripcion']."' ,'".$precioSugerido[$j]."' )";

mysql_db_query($basedatos,$q1a);
echo mysql_error();



//*******************ACTUALIZO EXISTENCIAS***********************

/*    
if($myrow8ac['cajaCon']>0){
    $ca=$ct[$j]*$myrow8ac['cajaCon'];
}else{
    $ca=$ct[$j];
}*/
$ca=$ct[$j];
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



//DEPRECATED
//$karticulos=new kardex();
//$karticulos-> movimientoskardex($numSolicitud,'entrada',$ca,'AJUSTE DE INVENTARIOS',$myrow8acd['tipoMovimiento'],$usuario,$fecha1,$hora1,$myrow3ae['almacen'],$myrow3ae['almacen'],$myrow8ac['keyPA'],$coder[$j],$entidad,$basedatos);



$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,numSolicitud)
values
('".$coder[$j]."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','".$ca."','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow3ae['almacen']."','".$_GET['id_factura']."','".$_POST['conceptoInventarios']."','standby','".$numSolicitud."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
    
}//validacion de coder
}        
}  


//**********conversion a unidades***********
$entrance=new entradas();
$entrance=$entrance->entradaInventarios($costo[$j],$numSolicitud,$codigoInv,"si",$myrow3ae['almacen'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);
//******************************************



//DEPRECATED
//**********ACTUALIZA KARDEX**************
//$actualizaK=new ActualizaKardex();
//$actualizaK=$actualizaK-> updateKardex($usuario,$entidad,$basedatos);
//*******CIERRA ACTUALIZAR KARDEX*********





}else{//SE RESTA DEL ALMACEN
//quien sale?
   
    

    
for($j=0;$j<count($ct);$j++){ 
//echo $ct[$j];    
    

 if( $coder[$j]!='' and $ct[$j]>0){   

$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$coder[$j]."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);





//*******************ACTUALIZO EXISTENCIAS***********************

/*    
if($myrow8ac['cajaCon']>0){
    $ca=$ct[$j]*$myrow8ac['cajaCon'];
}else{
    $ca=$ct[$j];
}
*/
//****************************************************************




/*deprecated
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
     $agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,numSolicitud)
values
('".$coder[$j]."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','".$ca."','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow3ae['almacen']."','".$_GET['id_factura']."','".$_POST['conceptoInventarios']."','standby','".$numSolicitud."')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
*/ 



//DEPRECATED
/*
$karticulos=new kardex();
$karticulos-> movimientoskardex($numSolicitud,'salida',$ca,'AJUSTE DE INVENTARIOS',$myrow8acd['tipoMovimiento'],$usuario,$fecha1,$hora1,$myrow3ae['almacen'],$myrow3ae['almacen'],$myrow8ac['keyPA'],$coder[$j],$entidad,$basedatos);
*/     
 
$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$coder[$j]."'
and

    
    almacen='".$_GET['almacenDestino']."'
    and
status='ready' 
order by keyAE ASC
limit 0,$ct[$j]
";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$i+=1;				
			

//AFECTO KARDEX  *******************************************
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    



/*deprecated
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad;
}*/
 $ct=$cantidad;




$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='".$codigoInv."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);

//******************CUANTO HABIA EN EXISTENCIAS***********
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
    and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();



     $sSQLd2= "
SELECT *
FROM
articulosExistencias
WHERE
keyAE='".$myrowy['keyAE']."'
  
";
$resultd2=mysql_db_query($basedatos,$sSQLd2);
$myrowd2 = mysql_fetch_array($resultd2);
echo mysql_error();
//***********************CIERRO EXISTENCIAS***************

  $q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrowy['codigo']."','".$codigoInv."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow8ac['keyPA']."','".$myrowd2['almacen']."',
        '".$myrowd2['almacen']."',
        '".$myrowd2['costo']."',
        1,1,'".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$myrow8acd['descripcion']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','SALIDA',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//CIERRO AFECTACION DE KARDEX************************************************

$q1a = "UPDATE articulosExistencias set 
status='sold',numSolicitud='".$numSolicitud."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	

    
}
}
}//cierra for




//DEPRECATED
//**********ACTUALIZA KARDEX**************
//$actualizaK=new ActualizaKardex();
//$actualizaK=$actualizaK-> updateKardex($usuario,$entidad,$basedatos);
//*******CIERRA ACTUALIZAR KARDEX*********
}//cierra 



}else{//cierra validacion del ajuste

   echo '<div class="error">El campo costo y el concepto de ajuste son obligatorios!</div>'; 
    
}



}
?>



















<?php 
if($_POST['actualizar2'] || $_POST['actualizar'] || $_POST['delete']){
    if($_POST['actualizar2']){$descripcion='Presiono el boton actualizar articulos';
    }elseif($_POST['actualizar']){$descripcion='Presiono el boton actualizar existencias';
    }elseif($_POST['delete']){$descripcion='Presiono el boton de eliminar';}
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
?>




<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['delete'] ){
$codigo=$_POST['codec'];
$c=count($_POST['codec']);
if($c>0){

for($i=0;$i<$c;$i++){




$q4 = "DELETE FROM articulosExistencias WHERE 
      entidad='".$entidad."'
          and
codigo='".$codigo[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
 ";

mysql_db_query($basedatos,$q4);
echo mysql_error();

 $q3 = "DELETE FROM articulosExistencias WHERE 
      entidad='".$entidad."'
          and
codigo='".$codigo[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
 ";

//mysql_db_query($basedatos,$q3);
echo mysql_error();

$sSQLy3= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo[$i]."'
and
almacen='".$_POST['almacenDestino']."'

";


$resulty3=mysql_db_query($basedatos,$sSQLy3);
$myrowy3 = mysql_fetch_array($resulty3);

if($myrowy3['ventaGranel']=='si' and $myrowy3['cantidadSurtir']>0){
 $q2 = "DELETE FROM articulosExistenciasGranel WHERE 
      entidad='".$entidad."'
          and
codigo='".$codigo[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
 ";

mysql_db_query($basedatos,$q2);
echo mysql_error();   


}
}//cierra for

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
echo '<div class="success">Se quitaron articulos de este almacen!</div>';


}else{//validacion del array codigo
    echo '<div class="error">Escoje el articulo para remover existencias!</div>';
}





}





?>














<?php 
/*

$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['actualizar']){ 
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$descripcion=$_POST['descripcion'];
$cBarra=$_POST['cBarra'];
$cantidad=$_POST['cantidad'];
$costo=$_POST['costo'];


//echo print_r($_POST['cantidad']);
//echo count($_POST['cantidad']);

for($i=0;$i<=count($_POST['keyPA']);$i++){

if(is_numeric($keyPA[$i])!=NULL and is_numeric($cantidad[$i])>0 and $costo[$i]>0){
    
//EXISTE?    
    
$sSQL3ae= "
	SELECT 
*
FROM
inv_existencias
where
entidad='".$entidad."'
    and
    keyPA='".$keyPA[$i]."'  ";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);
    

    
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
keyPA='".$keyPA[$i]."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);

    

//NO EXISTE INSERTA
if(!$myrow3ae['keyPA']){


$q1a = "INSERT INTO precioArticulos 
(codigo,costo,usuario,fecha,hora,entidad,keyPA,ID_EJERCICIO,status,
cantidadParticular,cantidadAseguradora,descripcionArticulo,precioSugerido,fechaActualizacion)
values
('".$myrow8ac['codigo']."','".$costo[$i]."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keyPA[$i]."','".$ID_EJERCICIOM."' ,'final'  ,'".$porcentajeParticular."' ,
        '".$porcentajeAseguradora."' ,'".$myrow8ac['descripcion']."' ,'".$precioSugerido[$j]."','".$fecha1."' )";

mysql_db_query($basedatos,$q1a);
echo mysql_error();    
    
$agrega = "INSERT INTO inv_existencias (
keyPA,codigo,cantidad,almacen,almacenPrincipal,usuario,fecha,hora,entidad)
values
('".$keyPA[$i]."','".$myrow8ac['codigo']."','".$cantidad[$i]."','".$_GET['almacenDestino']."','',
'".$usuario."','".$fecha1."','".$hora1."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agregaron datos!';
}else{

//EXISTE ACTUALIZA
$q1 = "UPDATE inv_existencias set 
cantidad='".$cantidad[$i]."',

usuario='".$usuario."',
fecha='".$fecha1."',

hora='".$hora1."'


WHERE entidad='".$entidad."'
and
keyPA='".$keyPA[$i]."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron datos!';

$q1a = "INSERT INTO precioArticulos 
(codigo,costo,usuario,fecha,hora,entidad,keyPA,ID_EJERCICIO,status,
cantidadParticular,cantidadAseguradora,descripcionArticulo,precioSugerido,fechaActualizacion)
values
('".$myrow8ac['codigo']."','".$costo[$i]."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keyPA[$i]."','".$ID_EJERCICIOM."' ,'final'  ,'".$porcentajeParticular."' ,
        '".$porcentajeAseguradora."' ,'".$myrow8ac['descripcion']."' ,'".$precioSugerido[$j]."','".$fecha1."' )";

mysql_db_query($basedatos,$q1a);
echo mysql_error(); 
}
}
}

}
*/
  ?>
 
 





















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" >
    <br />
AJUSTE DE EXISTENCIAS<br />

<h4>
    <?php echo $_GET['porArticulo'];?>
</h4>

   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>

&nbsp;</h1>
    
    
    
    
    
    <form id="form1" name="form1" method="post" >
    
    
    
    
    
    
<table border = "1">

    
<tr>
<td>Concepto</td>

<td><?php     
        $aCombo1= "Select * From conceptoinventarios where entidad='".$entidad."'  order by descripcion ASC";
        $rCombo1=mysql_db_query($basedatos,$aCombo1); ?>
          <br>
      
          <select name="conceptoinventarios"  class="normal" onChange="this.form.submit();"/>        
     <option value="">---</option>
  
        <?php while($resCombo1 = mysql_fetch_array($rCombo1)){ ?>
        
     <option 
		<?php 
	 if($_POST['conceptoinventarios'] ==$resCombo1['codigo']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo1['codigo']; ?>">
                <?php echo $resCombo1['descripcion']; ?>
                </option>
                
        <?php } ?>
        </select></td>
</tr>    
    
  
</table>
    
    
    
    
    
        
        
    <br></br>
        
        
        
    
    

 
<?php if($_POST['conceptoinventarios']!=NULL){?>
  <table width="600" class="table table-striped">
   

      
      
    <tr >
      <th width="10"  align="left">#</th>
      <th width="400"  align="left">Descripcion</th>

  

      <th width="10"  align="left">Max</th>
      <th width="10"  align="left">Min</th>
      <th width="10"  align="left">Reorden</th>
      <th width="10"  align="left">Existencia</th>
      <th width="10"  align="left">Cantidad</th>
<th width="10"  align="left">Costo</th>
       <th width="10"  align="left">CostoActual</th>
    </tr>
<?php	
$_POST['almacenDestino']=$_GET['almacenDestino'];
$sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino']."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){    
    $_POST['almacenDestino']=$myrow29p['almacenExistencias'];    
}

$articulo=$_POST['porArticulo'];


    
/*  
 $sSQL1= "SELECT 
*,articulos.codigo as codec
FROM 

existencias,articulos
WHERE
(
articulos.activo='A'
and
existencias.entidad='".$entidad."' AND
articulos.descripcion like '%$articulo%' 
and
existencias.almacen='".$_POST['almacenDestino']."'
and

existencias.codigo=articulos.codigo
) 
OR
(
articulos.activo='A'
and
existencias.entidad='".$entidad."'
    and
    existencias.codigo='".$articulo."'
and
existencias.almacen='".$_POST['almacenDestino']."'
    and
    existencias.codigo=articulos.codigo
)
order by articulos.descripcion ASC
";
*/
    
$articulo=$_GET['porArticulo'];

$sSQL1="
select * from articulos where entidad='".$entidad."'
and
articulos.activo='A'

and
descripcion like '%$articulo%' 

order by descripcion ASC
limit 0,5        
";
 






$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$a+=1;






$sSQL3ae= "
	SELECT 
*
FROM
precioArticulos
where
entidad='".$entidad."'
    and
    codigo='".$myrow1['codigo']."'  
order by keyC DESC        
";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);


$sSQL3a= "
	SELECT 
*
FROM
inv_conf_articulos
where
entidad='".$entidad."'
    and
    keyPA='".$myrow1['keyPA']."'  
      
";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);

//$myrow3a['keyPA'].' -- '.$myrow1['keyPA'];

    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);

    $sSQL8acb= "
SELECT * 
FROM
precioArticulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    order by keyC DESC
";
$result8acb=mysql_db_query($basedatos,$sSQL8acb);
$myrow8acb = mysql_fetch_array($result8acb);



//ENtRADAS
 $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    and
    almacen='".$_GET['almacenDestino']."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();



$existenciaCendis=$myrow8ac1e['entrada']-$myrow8ac1s['salida']
 
?>
      
      
      
      
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr  >
      
        
        
        <td  ><?php echo $a; ?>
          <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />
    </td>
      <td >
          <input type="hidden" name="codigo[]" value="<?php echo $myrow3a['codigo'];?>"></input>
          <input name="keyPA[]" type="hidden" value="<?php echo $myrow1['keyPA']; ?>" />
          <input name="gpoProducto[]" type="hidden" value="<?php echo $myrow8ac['gpoProducto']; ?>" />
          <input name="cajaCon[]" type="hidden" value="<?php echo $myrow8ac['cajaCon']; ?>" />
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
    <?php 

		echo ltrim($myrow1['descripcion']);
                echo '<br>';
echo '<span class="precio1">'.$myrow1['codigo'].'</span>';
echo '<br>';
echo '<span class="precio1">'.$myrow8ac['gpoProducto'].'</span>';

?> 
          
          
          
          
<?php           
     if($myrow1['anaquel']!=NULL){
echo '<br>';
echo '<span >Anaquel: '.$myrow1['anaquel'].'</span>';
}
		


if($myrow3a['maximos']<1){
 echo ' -Sin Configuracion- ';   
}
?>
 
 
          
          
          
          
      </td>
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        

        
        

        

        
<td ><span >
        <?php
        
echo $myrow3a['maximos'];      
       
       ?>
</span></td> 
        

        
        
<td ><span >
        <?php
        
echo $myrow3a['minimos']; 
      
       ?>
</span></td> 
        

        
<td ><span >
        <?php
        
echo $myrow3a['reorden'];       
       
       ?>
</span></td>    
        
        
<td ><span >
        <?php
        
echo $existenciaCendis;       
       
       ?>
</span></td>         
        

<td ><span >
<?php //if($myrow3a['keyPA']){?>
<input type="text" name="cantidad[]" size="3" value="<?php echo $myrow3a['cantidad'];?>"></input>
<?php /* }else{?>
<input type="text" name="cantidad[]" size="3" readonly=""></input>
<?php } */?>
</span></td>         
        
        
        
        
 <td ><span >
<input type="text" name="costo[]" size="3" ></input>

</span></td>
        


        
    <td ><span >

<?php echo '$'.number_format($myrow3ae['costo'],2); 

if($myrow3ae['fechaActualizacion']!=NULL){
echo '<br>';
echo '<div style="font-family: Arial Black; 
font-size: 9px; color: black">'.cambia_a_normal($myrow3ae['fechaActualizacion'],2).'</div>';
}
?>
</span></td>     
        
        
        
       
      
    </tr>
    <?php  

    
    
}?>
    <tr>
     
    </tr>
  </table>
 
<p align="center">&nbsp;</p>
  <div align="center" ><strong>
    <?php if(!$codigo){ echo "No se encontraron datos..!!"; }?>
	<?php if($_POST['porArticulo'] AND $a>0){
	echo "Se encontraron $a registros..!"; 
	}
	?>
	</strong></div>
  <p align="center">
    <label>

    <input name="flag" type="hidden"  value="<?php echo $a; ?>"  />

    <?php if($a>0){?>
    <input  name="actualizar" type="submit" src="../imagenes/btns/refresh.png" id="actualizar" 
    value="Efectuar Cambios" />
    

        
  
	<?php }else{
            
        }
	?> 
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
<?php } ?>
</form>


<br></br>


</body>
</html>