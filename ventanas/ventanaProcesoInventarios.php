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

$hoy = date("d/m/Y");
$hora = date("g:i a");


$sSQL3= "Select * From listas WHERE keylistas='".$_GET['keylistas']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);   
$_POST['almacenDestino']=$myrow3['almacen'];
$_POST['anaquel']=$myrow3['anaquel'];
























if($_POST['ajustarExistencias'] ){//ajustar existencias

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
$_GET['almacenDestino']=$_POST['almacenDestino1'];
$ct=$_POST['cantidadTotal'];



$_POST['conceptoinventarios']='04';
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
















if($_POST['conceptoinventarios']!='' ){


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

    
for($j=0;$j<=$_POST['pasoBandera'];$j++){
    
if($coder[$j]!=NULL){
    
//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA***********
//QUIEN SALE?
    
    
   
    
if($ct[$j]>0 ){
  
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


if($myrow8ac['keyPA']!=NULL){
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,numSolicitud)
values
('".$coder[$j]."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','".$ca."','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_POST['almacenDestino1']."','".$_GET['id_factura']."','".$_POST['conceptoInventarios']."','standby','".$numSolicitud."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}//validacion de coder
}        
}  


//**********conversion a unidades***********
$entrance=new entradas();
$entrance=$entrance->entradaInventarios($costo[$j],$numSolicitud,$codigoInv,"si",$_POST['almacenDestino1'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);
//******************************************



//DEPRECATED
//**********ACTUALIZA KARDEX**************
//$actualizaK=new ActualizaKardex();
//$actualizaK=$actualizaK-> updateKardex($usuario,$entidad,$basedatos);
//*******CIERRA ACTUALIZAR KARDEX*********





}else{//SE RESTA DEL ALMACEN
//quien sale?
   
    
    
    
for($j=0;$j<=$_POST['flag'];$j++){ 
$ct[$j];    
    
    
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
mysql_db_query($basedatos,$agrega);
echo mysql_error();
     
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
			
		
	
//echo count($ct[$j]).'<br>';

if($i<=$ct[$j]){
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
    




if($myrow8ac['cajaCon']>0){
    //$ct=$cantidad*$myrow8ac['cajaCon'];
}else{
    //$ct=$cantidad;
}
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


 echo '<div class="success">Existencias Ajustadas!</div>'; 
 echo '<script>
window.alert("Existencias Ajustadas, por seguridad se necesita cerrar la ventana");     
window.close();</script>';
}//cerrar ajuste de existencias




























if($_POST['actualizar']){
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$ct=$_POST['cantidadTotal'];
$keyPA=$_POST['keyPA'];




  $q = "DELETE FROM articulosExistencias WHERE 
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino1']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();


    
//**********GENERO EL NUMERO DE SOLICITUD ************//
    
        $q = "

    INSERT INTO solicitudes(numSolicitud,usuario,fecha,entidad,keyClientesInternos,hora)
    SELECT(IFNULL((SELECT MAX(numSolicitud)+1 from solicitudes where entidad='".$entidad."'), 1)), '".$usuario."',
    '".$fecha1."','".$entidad."','".$_GET['keyClientesInternos']."','".$hora1."' ";
    mysql_db_query($basedatos,$q);
    echo mysql_error();
    
    
    $sSQL333= "SELECT
    numSolicitud
    FROM solicitudes
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by keySolicitudes DESC
    ";

    $result333=mysql_db_query($basedatos,$sSQL333);
    $myrow333 = mysql_fetch_array($result333);
    $myrow333['NS']=$myrow333['numSolicitud'];
    if(!$myrow333['NS']){
    $myrow333['NS']=1;
    }
    
    //************************************







for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($coder[$i]  AND $alma and $ct[$i]>-1){


    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$coder[$i]."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
 
if($myrow8ac['cajaCon']>0){
    $existencia=$ct[$i];
    $cantidadTotal=$ct[$i]*$myrow8ac['cajaCon'];
}else{
    $existencia=$ct[$i];
    $cantidadTotal=$existencia;
}



$sSQL8a= "
SELECT *
FROM
listasinventarios
WHERE
entidad='".$entidad."'
and

almacen='".$_POST['almacenDestino1']."'
and
codigo='".$coder[$i]."'
    and
    keylistas='".$_GET['keylistas']."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);








if($myrow8a['codigo']){
$leyenda= 'Se actualizaron el registro';
 $q = "UPDATE listasinventarios set 
descripcion='".$myrow8ac['descripcion']."',
keylistas='".$_GET['keylistas']."',         
cantidadTotal='".$cantidadTotal."',
fechaA='".$hoy."', 
hora='".$hora."', 
existencia='".$existencia."',
razon='".$razon[$i]."',
         topeMayor=cantidadTotal-totalUnidades,
         topeMenor=totalUnidades

WHERE 
entidad='".$entidad."'
    AND
codigo='".$coder[$i]."' 
AND 
almacen = '".$_POST['almacenDestino1']."'
    and
    keylistas='".$_GET['keylistas']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda="Se actualizaron existencias";


//*****************************KARDEX**************************
$karticulos=new kardex();
$karticulos-> movimientoskardex($myrow333['NS'],'ENTRADA',$existencia,'AJUSTE MANUAL','ajuste',$usuario,$fecha1,$hora1,$_POST['almacenDestino1'],$_POST['almacenDestino1'],$myrow8a['keyPA'],$coder[$i],$entidad,$basedatos);
//*************************************************************

//public function movimientoskardex($numSolicitud,$io,$cantidad,$descripcionmov,$tipomov,$usuario,$fecha1,$hora1,$almacendestino,$almacensolicitante,$keypa,$codigo,$entidad,$basedatos){




//************************************************
} else {//insertar
//echo 'Se inserto en existencias un nuevo registro';
 $agrega = "INSERT INTO listasinventarios (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,almacenPrincipal,cantidadTotal,keylistas,existencia
) values (
'".$coder[$i]."' ,
'".$alma."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$_POST['almacenDestino1']."','".$cantidadTotal."','".$_GET['keylistas']."','".$existencia."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



}//innsertalo



}

}














$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron existencias...';
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




if($_POST['vaciar']){
$codigo=$_POST['codigo'];




if($_POST['anaquel'] and  $_POST['anaquel']!='*'){


 $sSQL8a= "
SELECT *
FROM
existencias
WHERE
entidad='".$entidad."'
and

almacen='".$_POST['almacenDestino']."'
and
anaquel='".$_POST['anaquel']."'    
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
while($myrow8a = mysql_fetch_array($result8a)){




  $q = "DELETE FROM articulosExistencias WHERE 
entidad='".$entidad."'
and
codigo='".$myrow8a['codigo']."'  
and
almacen='".$_POST['almacenDestino']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
}


}else{
  $q = "DELETE FROM articulosExistencias WHERE 
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();

}



?>
<script>
window.alert("Se quitaron articulos de este almacen");
</script>
<?php
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Almacen/Anaquel Vaciado!';
}





?>














<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['actualizar2']){  
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$descripcion=$_POST['descripcion'];
$cBarra=$_POST['cBarra'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){

if($keyPA[$i]!=NULL){
  $q1 = "UPDATE articulos set 
descripcion='".$descripcion[$i]."',
gpoProducto='".$gpoProducto[$i]."',
cbarra='".$cBarra[$i]."',
fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron datos!';
}?>


<script>

function confirmReset() {
    var r = confirm('Are you sure?');
    
    if (r == true) {
        this.form.submit();
    } else {
        alert('it didnt work');
    }
    return false;                       
}
</script>


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
<font size="1" face="Comic Sans MS,arial,verdana">
PROCESO DE INVENTARIOS
</font>
<br />

   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>

&nbsp;
<br>

</h1>
    
    
    <h4><font size="1" face="Comic Sans MS,arial,verdana">*En la cantidad de existencia son cajas unicamente que se ajustan!</font></h4>
    
<form name="form10" method="post" >
 
  <table width="600" class="table-forma">
      
      
      
   
      
     
      
      
      
      

      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
    <tr>
        
      <td height="41" scope="col">&nbsp;</td>
      <td scope="col"><label>
          <div align="left">
            <!--<input name="buscar" type="submit" src="../imagenes/btns/searchbutton.png" id="buscar" value="buscar" />-->
            <?php
	  if($_POST['porArticulo']=='*'){ echo "Este proceso puede demorar varios minutos..";}?>
          </div>
        </label></td>
    </tr>
  </table>

<p>&nbsp;</p>




<div id="divContainer">
  <table width="700" class="formatHTML5" >

      
      
    <tr >
<th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">#</font></th>

      <th width="200"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">Descripcion</font></th>
<th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">Maximo</font></th>
<th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">Minimo</font></th>
<th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">Reorden</font></th>
      <th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">Costo</font></th>
    <th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">Eq.Caja</font></th>
 <th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">ModoVenta</font></th>
      <th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">Ex</font></th>
            <th width="10"  align="left"><font size="1" face="Comic Sans MS,arial,verdana">Cantidad</font></th>
 
      

      <th width="10"  align="left"></th>
    </tr>
<?php	
$sSQL3= "Select * From listas WHERE keylistas='".$_GET['keylistas']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);   



    
    //filtrar por anaquel
if($myrow3['anaquel']=='*'){
    
    
    
$sSQL1= "SELECT 
*
FROM 

existencias
WHERE
entidad='".$entidad."' 
and
almacen='".$myrow3['almacen']."'


order by descripcion ASC
";

    
    
}   else{ 

$sSQL1= "SELECT 
*
FROM 

existencias
WHERE
entidad='".$entidad."' 
and
almacen='".$myrow3['almacen']."'
and
anaquel='".$myrow3['anaquel']."'
and
descripcion!=''

order by descripcion ASC
";

}










$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$a+=1;










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
";
$result8acb=mysql_db_query($basedatos,$sSQL8acb);
$myrow8acb = mysql_fetch_array($result8acb);


$sSQL2= "
SELECT * 
FROM
listasinventarios
WHERE
entidad='".$entidad."'
and
keylistas='".$_GET['keylistas']."'
and
codigo='".$myrow1['codigo']."'
    and
almacen='".$myrow3['almacen']."'
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);



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
    almacen='".$myrow3['almacen']."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();



//SOLO DEBE MOSTRAR LOS ARTICULOS ACTIVOS
if($myrow8ac['activo']=='A'){
?>
 <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />      
      
      
      
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr >
      
        <td  ><font size="1" face="Comic Sans MS,arial,verdana"><?php echo $a;?></font></td>
        
        


      <td ><input name="keyPA[]" type="hidden"  value="<?php echo $myrow1['keyPA']; ?>" />


<font size="1" face="Comic Sans MS,arial,verdana">
    <?php 

		echo ltrim($myrow1['descripcion']);
echo '<br>';
echo $myrow8ac['sustancia'].'  '.$myrow8ac['sustancia'];
echo '<br>';
echo '<span class="precio1">'.$myrow8ac['gpoProducto'].'</span>';

if($myrow1['anaquel']!=NULL){
//echo '<br>';
echo '<span >Anaquel: '.$myrow1['anaquel'].'</span>';
}

          
/*          
          
<a  href="javascript:ventanaSecundaria2('/sima/cargos/listaAlmacenesTodos.php?codigo=<?php echo $codigo; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow1['keyPA']; ?>&amp;gpoProducto=<?php echo $myrow8ac['gpoProducto'];?>')" onMouseover="showhint('Presiona aqui para asignar almacenes a este articulo...', this, event, '150px')">
Editar
</a>     	*/	?>     
</font>

      </td>
        
 <td  ><font size="1" face="Comic Sans MS,arial,verdana">_</font></td>
 <td  ><font size="1" face="Comic Sans MS,arial,verdana">_</font></td>
 <td ><font size="1" face="Comic Sans MS,arial,verdana">_</font></td>        
        
        
              <td >
<font size="1" face="Comic Sans MS,arial,verdana">
        
<?php 
	if($myrow8acb['costo']>0){
	  echo '$'.number_format($myrow8acb['costo'],2);
        }else{
            echo '<span class="informativo"><blink>???</blink></span>';
        }
	 
		?>
      </font>
</td>
        
        
        

        
        
      <td ><font size="1" face="Comic Sans MS,arial,verdana">
        
<?php 
	if($myrow8ac['cajaCon']>0){
	  echo $myrow8ac['cajaCon'];
        }else{
            echo 1;
        }
	 
		?>
</font>      
</td>

        
        





      <td ><font size="1" face="Comic Sans MS,arial,verdana">
        
<?php 
	if($myrow1['modoventa']!=NULL){
	  echo $myrow1['modoventa'];
        }else{
            echo '---';
        }
	 
		?>
      </font></td>








      <td ><font size="1" face="Comic Sans MS,arial,verdana">
     
<?php 
	  if($myrow8ac1e['entrada']>0){
	  echo $myrow8ac1e['entrada'];
	  } else {
	  echo "0.000";
	  }
	 
		?>
      </font></td>



      <td ><font size="1" face="Comic Sans MS,arial,verdana">
<input name="cantidadTotal[]" type="text" size="3"  value="<?php echo $myrow2['existencia'];?>" autocomplete="off"></input>
      </font></td>
        
        
        
        
      <td ><font size="1" face="Comic Sans MS,arial,verdana">
 <?php //echo $myrow2['cantidadTotal'];?>
      </font></td>
       
        
        
        
        
        
        
        
        


     
    </tr>
<?php  }}?>
    <tr>
     
    </tr>
  </table>
</div>    

<p align="center">&nbsp;</p>
  <div align="center" class="informativo"><strong>
    <?php if(!$codigo){ echo "No se encontraron datos..!!"; }?>
	<?php if($_POST['porArticulo'] AND $a>0){
	echo "Se encontraron $a registros..!"; 
	}
	?>
	</strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>"  />

    
   
    <?php if($a>0){?>
 <font size="1" face="Comic Sans MS,arial,verdana">
<input  name="ajustarExistencias" type="submit" value="Ajustar Existencias"	/>

<input  name="vaciar" type="submit" value="Vaciar Almacen"	onclick="return confirmReset();"/>
</font>
    <?php }
	?>

    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>
    <br>


</body>
</html>
