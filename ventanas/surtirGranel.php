<?PHP require("/configuracion/ventanasEmergentes.php");  require("/configuracion/funciones.php"); ?>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>


<script language=javascript>
function ventanaSecundaria8 (URL){
   window.open(URL,"ventanaSecundaria8","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>

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






<?php  
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
 $agrega = "DELETE FROM movSolicitudes
      where
      entidad='".$entidad."'
    and
    almacen='".$_GET['almacen']."'
and
keyPA='".$_GET['keyPA']."'


";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




$agrega1 = "DELETE FROM articulosExistencias
      where
      entidad='".$entidad."'
    and
    almacen='".$_GET['almacen']."'
and
keyPA='".$_GET['keyPA']."'


";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

$agrega = "INSERT INTO logs (cantidad,codigo,
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$_GET['cantidad']."','".$_GET['keyPA']."','El usuario reseteo este articulo','".$_GET['almacenDestino']."','".$_GET['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


##AFECTAR AL KARDEX
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
    
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
keyPA='".$_GET['keyPA']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
$codigoInv='02';
$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='".$codigoInv."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);

  $q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrow8ac['codigo']."','".$codigoInv."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow8ac['keyPA']."','".$myrowd2['almacen']."',
        '".$myrowd2['almacen']."',
        '".$myrowd2['costo']."',
        '".$_GET['cantidad']."',1,'".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$myrow8acd['descripcion']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','SALIDA',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$myrow333['NS']."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//CIERRO AFECTACION DE KARDEX************************************************





echo '<script>';
echo 'window.alert("ARTICULO EN RESET, POR SEGURIDAD ESTA VENTANA SE CERRARA!");';
echo 'window.close();';
echo '</script>';



        }



}
?>





















<?php  
$cendis=new whoisCendis();
$aP=$centroDistribucion=$cendis->cendis($entidad,$basedatos);  





/*
if($_GET['keyPA'] AND ($_GET['inactiva'] or $_GET['activa']) and $_GET['keyPA']!=NULL){

	if($_GET['activa']=="activa"){

$solicitado=$myrowv['c'];


$sSQL8aa= "
SELECT *
FROM
articulos
WHERE
    keyPA='".$_GET['keyPA']."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);
 




 $agrega = "DELETE FROM movSolicitudes
      where
      entidad='".$entidad."'
    and
    almacen='".$_GET['almacen']."'
and
keyPA='".$_GET['keyPA']."'


";
mysql_db_query($basedatos,$agrega);
echo mysql_error();






$agrega2 = "DELETE FROM articulosExistenciasGranel
      where
      entidad='".$entidad."'
    and
    almacen='".$_GET['almacen']."'
and
keyPA='".$_GET['keyPA']."'


";
mysql_db_query($basedatos,$agrega2);
echo mysql_error();



$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Articulo en Reset!';




//DETERMINAR EL COSTO				
$sSQL3ac="SELECT costo
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow8aa['costo']."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);

  $sSQL8aa3= "
SELECT max(nOrden)+1 as n
FROM
solicitudesDepartamentos
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}



$agrega = "INSERT INTO solicitudesDepartamentos (
usuario,almacen,entidad,fecha,hora,nOrden,status
) values (
'".$usuario."','".$_POST['almacenDestino']."','".$entidad."','".$fecha1."','".$hora1."'
    ,'".$n."','request'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error(); 
  
  
//ENTRADA
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,costo,factura,tipo,status,nOrden)
values
('".$myrow8aa['codigo']."','".$_GET['keyPA']."','".$myrow8aa['gpoProducto']."','".$_GET['cantidad']."','','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_GET['almacen']."','".$myrow3ac['costo']."',
    '','Normal','standby','".$n."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



//**********conversion a unidades***********
$entrance=new entradas();
$entrance=$entrance->entradaInventarios($_GET['almacen'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);
//******************************************

        }
        
       
        ?>
<script>
//window.alert("SE SURTIERON MEDICAMENTOS CON LA SOLICITUD #<?php echo $_GET['nOrden'];?>");
ventanaSecundaria8('imprimirTraspasoGranel.php?nOrden=<?php echo $n;?>&usuario=<?php echo $_GET['usuario'];?>','ventana7','800','600','yes');
//window.opener.document.forms["form1"].submit();
//window.close();
</script> 
<?php
}








if($_GET['keyPA'] and $_GET['cantidadSurtir'] and $_GET['almacen']){
    
$cantidadSurtida=$_POST['cantidadSurtida'];
$keyPA=$_POST['keyPA'];
$almacenSolicitante=$_POST['almacenSolicitante'];
$cantidadVendida=$_POST['cantidadVendida'];
$rand=rand(100,100000000);


$cendis=new whoisCendis();




    if($_GET['cantidadSurtir']>0){
    if($_GET['keyPA']){
 $sSQL= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
    and
    keyPA='".$_GET['keyPA']."'
        and
   tipoVenta='Granel'     
and
        status='request'
            and
    almacen='".$_GET['almacen']."'

";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

    
  
$sSQL8aa= "
SELECT *
FROM
articulos
WHERE
    keyPA='".$_GET['keyPA']."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);
    
    
    
$informacionExistencias=new existencias();$cendis=new whoisCendis();
$disponibleCendis=$informacionExistencias->informacionExistencias($myrow3115s['tipoPaciente'],$entidad,$myrow8aa['codigo'],$cendis->cendis($entidad,$basedatos),$usuario,$fecha,$basedatos);    

//$sSQLv1= "SELECT sum(cantidad) as c
//FROM
//
//articulosExistenciasGranel
//where
//entidad='".$entidad."'
//and
//    keyPA='".$_GET['keyPA']."'
//    and
//    almacen='".$_GET['almacen']."'
//        and
//        tipoMov='entrada'
//";
//$resultv1=mysql_db_query($basedatos,$sSQLv1);
//$myrowv1 = mysql_fetch_array($resultv1);
//$surtido=$myrowv1['c'];


    
$sSQLv= "SELECT sum(cantidad) as c
FROM

movSolicitudes
where
entidad='".$entidad."'
and
keyPA='".$_GET['keyPA']."'
    and
    almacen='".$_GET['almacen']."'
        and
        tipoVenta='Granel' ";
$resultv=mysql_db_query($basedatos,$sSQLv);
$myrowv = mysql_fetch_array($resultv);
$solicitado=$myrowv['c'];

//echo 'hay: '.$disponible.'solicitado: '.$solicitado.' cargando: '.$cantidadSurtida[$i];


//priemera condicion, lo solicitado menos lo surtido=0
$aIngresar=$solicitado-$surtido;

//Tiene existencias cendis?
$ee=$disponibleCendis-$cantidadSurtida[$i];





if($ee>=0  and $aIngresar>0){



//SCRIPT FINAL DE SURTIR A GRANEL
//la cantidad surtida es la que uunicamente se carga


  $sSQL8aa3= "
SELECT max(nOrden)+1 as n
FROM
solicitudesDepartamentos
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}



$agrega = "INSERT INTO solicitudesDepartamentos (
usuario,almacen,entidad,fecha,hora,nOrden,status
) values (
'".$usuario."','".$_GET['almacen']."','".$entidad."','".$fecha1."','".$hora1."'
    ,'".$n."','request'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();     
    
    
    
   $sSQL= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
    and
    keyPA='".$_GET['keyPA']."'
        and
   tipoVenta='Granel'     
and
        status='request'
    and
    almacen='".$_GET['almacen']."'

";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
    
    
$sSQL4= "SELECT sum(cantidad) as can
FROM

movSolicitudes
where
entidad='".$entidad."'
    and
    almacen='".$_GET['almacen']."'
    and    
    keyPA='".$myrow['keyPA']."'
    and
    tipoVenta='Granel'     
    and
    status='request'

";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
//echo $myrow4['can'].' '.$_GET['cantidadSurtir'];

if($myrow4['can']<=$_GET['cantidadSurtir']){

$q1 = "UPDATE movSolicitudes set 
status='transferido'


WHERE 
keyMS='".$myrow['keyMS']."'";
mysql_db_query($basedatos,$q1);
   




//KARDEX
//$karticulos=new kardex();
//$karticulos-> movimientoskardex('salida',$existencia,'TRASPASO ENTRE ALMACENES','ajusteResta',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$_GET['almacen'],$_GET['keyPA'],$myrow8aa['codigo'],$entidad,$basedatos);
//CIERRO KARDEX





//SALIDA DE ALMACEN CENDIS
$agrega = "INSERT INTO articulosExistenciasGranel (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,nOrden)
values
('".$myrow8aa['codigo']."','".$_GET['keyPA']."','".$myrow8aa['gpoProducto']."','".$_GET['cantidadSurtir']."','Granel','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$cendis->cendis($entidad,$basedatos)."','".$n."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




//ENTRADA A ALMACEN SOLICITANTE
$agrega = "INSERT INTO articulosExistenciasGranel (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,
usuario,almacen,nOrden)
values
('".$myrow8aa['codigo']."','".$myrow['keyPA']."','".$myrow8aa['gpoProducto']."',
    '".$_GET['cantidadSurtir']."','Granel','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_GET['almacen']."','".$n."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$ab+=1;

//KARDEX
//$karticulos=new kardex();
//$karticulos-> movimientoskardex('entrada',$cantidadSurtida[$i],'TRASPASO ENTRE ALMACENES','ajusteSuma',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$_GET['almacen'],$myrow['keyPA'],$myrow8aa['codigo'],$entidad,$basedatos);
//CIERRO KARDEX

$karticulos=new kardex();
$karticulos-> movimientoskardex('salida',$cantidadSurtida[$i],'SALIDA POR VENTA','venta',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$_GET['almacen'],$myrow['keyPA'],$myrow8aa['codigo'],$entidad,$basedatos);


}  else{
     $tipoMensaje='error';
$encabezado='Error';
$texto='La cantidad debe ser menor, favor de ajustar!';   
}  
}


//****************************
?>
<script>


</script>
<?php 
}else{
  $tipoMensaje='error';
$encabezado='Error';
$texto='Ya esta surtido, o No hay existencias disponibles, o estas tratando de cargar una cantidad mayor a la requerida!';  
}
}//cierra validacion
}




if($ab>0){
?>
<script>
window.alert("SE GENERO EL # ORDEN: <?php echo $_GET['nOrden'];?>");
nueva('imprimirTraspasoGranel.php?random=<?php echo $rand; ?>&orden=<?php echo $n;?>&usuario=<?php echo $_GET['usuario'];?>','ventana7','800','600','yes');
//window.opener.document.forms["form1"].submit();
//window.close();
</script>
<?php 

$tipoMensaje='exito';
$encabezado='Exitoso';
$texto='Se surtieron articulos!';  
}
}
*/
















/*
if($_POST['close']!=NULL){
    $q1 = "UPDATE solicitudesDepartamentos set 
status='transferido'


WHERE 
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'

";
mysql_db_query($basedatos,$q1);
echo mysql_error();?>
<script>
    window.alert("ORDEN CERRADA");
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php }*/?>








<?php





if(!$_GET['keyPA'] and $_GET['cantidadSurtir'] and $_GET['almacen']){

    
$codigoInv='02';
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

codigo='".$codigoInv."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);
/*ESTE PROCESO HACE UNA SALIDA DE UNA CAJA SOLAMENTE DE CENDIS AL BOTIQUIN 
 * CORRESPONDIENTE, EL KARDEX SE ACTIVA PORQUE HUBO UNA VENTA DE UNA UNIDAD
 * 
 * 
 * 
 */    
    
    
//  echo $_GET['cantidadSurtir'].' -> '.$_GET['confExistencias'];  

  
$caSur=(int) $_GET['cantidadSurtir'];    
$cantidadSurtida=$_POST['cantidadSurtida'];
$keyPA=$_POST['keyPA'];
$almacenSolicitante=$_POST['almacenSolicitante'];
$cantidadVendida=$_POST['cantidadVendida'];
$rand=rand(100,100000000);
//QUIEN ES CENTRO DE DISTRIBUCION DE ESTA ENTIDAD    
$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);  

//DETERMINAR EL COSTO				
$sSQL3ac="SELECT costo
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);
  
  
  

//APLICO SALIDA POR VENTA INDIVIDUAL
//$karticulos=new kardex();
//$karticulos-> movimientoskardex('salida','1','SALIDA POR VENTA','venta',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$_GET['almacen'],$_GET['keyPA'],$_GET['codigo'],$entidad,$basedatos);


$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);


/*
//SALIDA DE ALMACEN CENDIS INDIVIDUAL
$ajusteExistencias=new existencias();
$ajusteExistencias->ajusteExistencias($FV,$_GET['keyClientesInternos'],$aP,$myrow['keyCAP'],$entidad,$myrow8ac['gpoProducto'],1,$_GET['codigo'],$aP,$usuario,$fecha1,$error,$basedatos);
*/  





//VERIFICAR SI ES A GRANEL    
$sSQLy3= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and
almacen='".$centroDistribucion."'

";


$resulty3=mysql_db_query($basedatos,$sSQLy3);
$myrowy3 = mysql_fetch_array($resulty3);



if($myrowy3['granel']=='si'){
//ENtRADAS SOLO CUANDO ES A GRANEL
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistenciasGranel
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and

almacen='".$centroDistribucion."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();
}else{
//ENtRADAS 
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and

almacen='".$centroDistribucion."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();    
}

//SALIDAS DEPRECATED
/*
    $sSQL8ac1s= "
SELECT sum( cantidad) as salida
FROM
articulosExistenciasGranel
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and
    status='sold'
    and
almacen='".$centroDistribucion."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
*/
$ex= $myrow8ac1e['entrada']-$myrow8ac1s['salida'];




//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA, SOLO CAMBIA DE ALMACEN
//QUIEN SALE?

			
			


   // echo $ir.' -> '.$cantidad[$i];echo '<br>';

    
    
    //GENERO # DE ENTREGA
    $q4 = "

    INSERT INTO contadorEntregaGranel(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorEntregaGranel where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT max(contador) as topeMaximo from contadorEntregaGranel where usuario='".$usuario."'    ";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
$tm=$myrow['topeMaximo'];    
    
    
    $sSQL7= "SELECT keySol from contadorEntregaGranel where entidad='".$entidad."' and contador='".$tm."'   ";
    $result7=mysql_db_query($basedatos,$sSQL7);
    $myrow7 = mysql_fetch_array($result7);
    

$keySol=$myrow7['keySol'];
    
 $sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and
   almacen='".$centroDistribucion."'
    and
status='ready' 


order by keyAE ASC
limit 0,1
";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$arr+=1;
//echo 'paso<br>';


if($arr<=$ex){
$q1a = "UPDATE articulosExistencias set 
almacen='".$_GET['almacen']."'


WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	

//**********************AFECTACION DE KARDEX************************
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
    '".$entidad."','".$myrow8ac['keyPA']."','".$almacen."',
        '".$almacen."',
        '".$myrowy['costo']."',
        '1','1','".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$mrow['codigoGP']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','salida',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//*****************************************************************



//**********EMPIEZO A HACER CONVERSIONES***********
	
$sSQLy3= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and
almacen='".$_GET['almacen']."'

";


$resulty3=mysql_db_query($basedatos,$sSQLy3);
$myrowy3 = mysql_fetch_array($resulty3);

if($myrowy3['ventaGranel']=='si' and $myrowy3['cantidadSurtir']>0){
    for($r=0;$r< $myrowy3['cantidadSurtir'];$r++){
        
$sSQL13= "
SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$coder[$j]."' order by keyC DESC";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);        
        
     
//INSERT
$agrega = "INSERT INTO articulosExistenciasGranel (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,costo,nOrden,keyAEMain,numOrdenEntrega)
values
('".$myrowy['codigo']."','".$myrowy['keyPA']."','".$myrowy['gpoProducto']."',1,'".$myrowy['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_GET['almacen']."','".$factura."','".$myrowy['tipo']."','ready','".$myrowy['costo']."',
'".$myrowy['nOrden']."','".$myrowy['keyAE']."','".$tm."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//SALIDA A GRANEL



    }
}

//*********TERMINO DE HACER CONVERSIONES***********






}//termina validacion de cantidad
}//termina FOR




//DAR DE BAJA LAS SOLICITUDS PENDIENTES
$sSQL= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
    and
    keyPA='".$_GET['keyPA']."'
        and
   tipoVenta='Granel'     
and
        status='request'
    and
    almacen='".$_GET['almacen']."'

";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$ir+=1;    
  



//ENtRADAS
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistenciasGranel
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and
   
almacen='".$_GET['almacen']."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();


//SALIDAS DEPRECATED
/*
    $sSQL8ac1s= "
SELECT sum( cantidad) as salida
FROM
articulosExistenciasGranel
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and
    status='sold'
    and
almacen='".$_GET['almacen']."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
 * 
 * 
 */
$ext= $myrow8ac1e['entrada']-$myrow8ac1s['salida'];

if($ext<=$_GET['cantidadSurtir']){
//VA?
$q1 = "UPDATE movSolicitudes set 
status='transferido'


WHERE 
keyMS='".$myrow['keyMS']."'";
//mysql_db_query($basedatos,$q1);
}//solova atransferir la cantidada surtir

}//termina wwhile

if($r>0){
    //echo 'imprimir';
$q1a = "UPDATE contadorEntregaGranel set 
status='entregado',
hora='".$hora1."',
fecha='".$fecha1."',
almacen='".$_GET['almacen']."',
descripcionAlmacen='".$_GET['descripcionAlmacen']."',
    codigo='".$_GET['codigo']."',
        descripcionArticulo='".$myrow8ac['descripcion']."',
            cantidad='".$r."'

WHERE
entidad='".$entidad."'
    and
contador='".$tm."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	?>
<script>
javascript:nueva('../ventanas/printEntregaGranel.php?keySol=<?php echo $keySol; ?>&codigo=<?php echo $myrow['codProcedimiento']; ?>&nCuenta=<?php echo $nCuenta ?>&paciente=<?php echo $_POST['paciente']; ?>&orden=<?php echo $E; ?>&hora1=<?php echo $hora1; ?>&almacen=<?php echo $_GET['almacenDestino']; ?>&folioVenta=<?php echo $_GET['folioVenta'];?>&rand=<?php echo $_POST['rand'];?>&usuario=<?php echo $_POST['usuarioSolicita'];?>&numSolicitud=<?php echo $_GET['numSolicitud'];?>',ventanaSecundaria,'800','800',true);
window.alert("SE SURTIO EL ARTICULO! SOLICITUD: <?php echo $keySol;?>");
window.close();
</script>
<?php 
}

}






?>















<?php 



if($_POST['surtir']){
$codigo=$_POST['codec'];
$cantidad=$_POST['cantidad'];
$limite=$_POST['limite'];







//GENERAMOS LA SOLICITUD
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
//CERRAMOS 









for($i=0;$i<=$_POST['bandera'];$i++){









//la cantidad no puede ser mayor al limite
if($cantidad[$i]>0){

/*
echo $cantidad[$i].'-'.$codigo[$i];
echo '<br>';
echo $limite[$i];
*/

$limit=$cantidad[$i]*$limite[$i];



//conversion 1
$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo[$i]."'
and
   almacen='".$centroDistribucion."'
    and
status='ready' 


order by keyAE ASC
limit 0,$cantidad[$i]
";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){





//ELIMINO LA CANTIDAD ENTERA
 $q1a = "DELETE FROM articulosExistencias 

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	










//conversion2
for($j=0;$j<$limit;$j++){

//INSERT
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,costo,nOrden,keyAEMain,numSolicitud,numSolicitudI)
values
('".$myrowy['codigo']."','".$myrowy['keyPA']."','".$myrowy['gpoProducto']."',1,'Granel','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_GET['almacen']."','".$factura."','".$myrowy['tipo']."','ready','".$myrowy['costo']."',
'".$myrowy['nOrden']."','".$myrowy['keyAE']."','".$numSolicitud."','".$numSolicitud."')";
//echo $j. '<br>';

mysql_db_query($basedatos,$agrega);
echo mysql_error();	

//**********************AFECTACION DE KARDEX************************
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







#ACTUALIZAR ORDENES DE SOLICITUDES
$sSQLmv= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
    and
    codigo='".$myrowy['codigo']."'
        and
   tipoVenta='Granel'     
and
        status='request'
    and
    almacen='".$_GET['almacen']."'
limit 0,$cantidad[$i]

";
$resultmv=mysql_db_query($basedatos,$sSQLmv);
while($myrowmv = mysql_fetch_array($resultmv)){
$qmv = "UPDATE movSolicitudes set 
status='transferido'


WHERE 
keyMS='".$myrowmv['keyMS']."'
";
mysql_db_query($basedatos,$qmv);
echo mysql_error();


}








/*
$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
and
   almacen='".$_GET['almacen']."'
    and
status='ready' 


order by keyAE ASC
limit 0,$cantidad[$i]
";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
###BAJA A EXISTENCIAS
$qbe = "DELETE FROM 

WHERE 
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$qbe);
echo mysql_error();
}*/











$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='04';
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
codigo='".$codigo[$j]."' order by keyC DESC";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);   

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
    '".$entidad."','".$myrow8ac['keyPA']."','".$almacen."',
        '".$almacen."',
        '".$myrowy['costo']."',
        '1','1','".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$mrow['codigoGP']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','salida',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//*****************************************************************
}











}




}










}//cierra for
?>
<script>
//window.alert("SE SURTIERON ARTICULOS");
ventanaSecundaria8('../ventanas/printTraspasosGranel.php?numSolicitud=<?php echo $numSolicitud;?>&nOrden=<?php echo $_GET['nOrden'];?>&departamentoSolicitante=<?php echo $_GET['almacen'];?>&entidad=<?php echo $entidad;?>&random=<?php echo $rand; ?>&usuarioCargo=<?php echo $usuario;?>&usuarioSolicitante=<?php echo $myrow['usuario'];?>&fecha=<?php echo $fecha1;?>&hora=<?php echo $hora1;?>&fechaSolicitud=<?php echo $myrow['fecha'];?>&horaSolicitud=<?php echo $myrow['hora'];?>','ventana7','800','600','yes');
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php
}//cierra surtir

?>












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>



 <?php require("/configuracion/componentes/comboAlmacen.php");  ?>
<form id="form1" name="form1" method="post" action="#">
<br>
    
    <h1>   <p>
<?php 
$sSQL12= "
SELECT descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
    and
almacen='".$_GET['almacen']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
echo $myrow12['descripcion'];
?>
    </p>    
    </h1>    
        
        
        
  <h1 align="center">Surtir Solicitudes a Granel</h1>
    <h5 align="center">
        
           <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>  
        
    </h5>
  <div align="center">

      <?php //echo 'Usuario Solicitante: '.$_GET['usuario'];?>

  </div>
<?php

    $sSQL661="SELECT id_medico,descripcion,stock
FROM
  almacenes
WHERE entidad='".$entidad."' AND almacen = '".$_GET['almacen']."'
  ";
  $result661=mysql_db_query($basedatos,$sSQL661);
  $myrow661 = mysql_fetch_array($result661);

?>

  <table width="900" class="table table-striped">

<tr >
      <th >#</th>

      <th  align="left">Descripcion</th>
      <th   align="left">ExCenDis</th>
      <th   >ExBotiq</th>

            
             <th  >Cargado</th>
      


            <th >Cantidad</th>
            <th >Reset</th>
</tr>






<tr>


<?php


$sSQL= "SELECT *
FROM

existencias
where
entidad='".$entidad."'
and
almacen='".$_GET['almacen']."'
    and
    ventaGranel='si'
    and 
    cantidadSurtir>0
";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$bandera+=1;


 $sSQLv= "SELECT sum(cantidad) as c
FROM

movSolicitudes
where
entidad='".$entidad."'
and

keyPA='".$myrow['keyPA']."'
    and
    almacen='".$myrow['almacen']."'
    and
tipoVenta='Granel'
and
status='request'
";
$resultv=mysql_db_query($basedatos,$sSQLv);
$myrowv = mysql_fetch_array($resultv);





/*
$sSQLv1= "SELECT sum(cantidad) as c
FROM

articulosExistenciasGranel
where
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and
    almacen='".$myrow['almacen']."'
        and
        
        status='ready'
";
$resultv1=mysql_db_query($basedatos,$sSQLv1);
$myrowv1 = mysql_fetch_array($resultv1);
*/

$sSQLve= "SELECT *
FROM

existencias
where
entidad='".$entidad."'
and
almacen='".$myrow['almacen']."'
and
codigo='".$myrow['codigo']."'
";
$resultve=mysql_db_query($basedatos,$sSQLve);
$myrowve = mysql_fetch_array($resultve);


 $sSQLa= "
SELECT sum(cantidad) as s
FROM
movSolicitudes
WHERE
entidad='".$entidad."'
    and
    almacen='".$_GET['almacen']."'
and
codigo='".$myrow['codigo']."'
and
status='request'
and
tipoVenta='Granel'
";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);




            $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
 codigo='".$myrow['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);



 $sSQL12= "
SELECT *
FROM
almacenes
WHERE 
entidad='".$entidad."'
    and
almacen='".$myrow['almacen']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


//echo $myrow['cantidadSurtir'];

?>




<tr  >
	        <td ><?php echo $bandera;?></td>





<td  >
<?php
$total=$myrowv['c']-$myrowv1['c'];
echo $myrow['descripcion'];


echo '<br>';
echo 'Code1: '.$myrow['codigo'];
echo '<br>';
echo '<span class="negro">'.'[ '.$myrow8ac['gpoProducto'].' ]'.'</span>';

if( $total==0){
echo '<span class="codigos">'.'Transferido '.'</span>';

}else{
if($myrow['informacion']){
echo '<br>';
echo '<span class="error"><blink>'. $myrow['informacion'].'</blink></span>';
}
}

echo '<br>';
echo '1 = '.$myrow['cantidadSurtir'];





?>

</td>
                
                
                
<td >
<?php 
//ENtRADAS
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and

    almacen='".$aP."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();


//SALIDAS DEPRECATED
/*
    $sSQL8ac1s= "
SELECT sum( cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and
    status='sold'
    and
    almacen='".$aP."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
 * 
 */
echo $cantidadCendis= $myrow8ac1e['entrada']-$myrow8ac1s['salida'];
?>
</td>





<td >
<?php 
//ENtRADAS
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and
  almacen='".$_GET['almacen']."'
      and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();


//SALIDAS DEPRECATED
/*
    $sSQL8ac1s= "
SELECT sum( cantidad) as salida
FROM
articulosExistenciasGranel
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and
    status='sold'
and
    almacen='".$_GET['almacen']."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
*/
echo $eB=$myrow8ac1e['entrada'];
?>
</td>

                
                
                
                
                
                

<?php 
//surtido
//echo $myrow['cantidadSurtir'];
$cS=$myrow['cantidadSurtir'];
?>                
                
                
                
                
                
<td>

<?php 

echo $Eactual=$myrowv['c'];?>

</td>







	  










          








<input name="cantidadSurtir[]" type="hidden" value="<?php echo $myrowve['cantidadSurtir'];?>" />







          
          
          

<td   >    
    <?php  //if($myrow['existencia']>0 AND $myrow['cantidadSurtir']>0 ){?>


<label>
    
    <?php //echo $eB.' ->'.$myrow['existencia'];?>
    
    <?php 
    $t1=$eB+$cS;
    //echo ;
   // echo $eB.'  '.$cS.' '.$cantidadCendis;
            
$ttt=$cS-$eB;
    //echo $ttt.'  '.$cS;




/*
        if($Eactual>=$cS and $cS>0 ){   ?>
    <a  href="surtirGranel.php?descripcionAlmacen=<?php echo $myrow661['descripcion'];?>&confExistencias=<?php echo $myrow['existencia']+$cargadoPx;?>&codigo=<?php echo $myrow['codigo'];?>&almacen=<?php echo $_GET['almacen'];?>&keyPA=<?php echo $myrow['keyPA'];?>&surtir=yes&cantidadSurtir=<?php echo $myrowve['cantidadSurtir'];?>" onclick="if(confirm('Esta seguro que deseas surtir este articulo?') == false){return false;}" >
    Surtir    
    </a>
        <?php } else{
        
           echo '<span >---</span>';
    }
  */ 
    
?>

<?php  if($Eactual>=$cS and $cS>0 ){ ?>

<input name="cantidad[]" size="3" value="" type="text">

<?php } else{ ?>
<input name="cantidad[]" size="3" value="" type="hidden">

<?php  }?>


</label>


</td>

















<td>
    
    <span>
<?php if( $eB>0){?>
<a href="surtirGranel.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&gpoProductos=<?php echo $_GET['gpoProductos'];?>&codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&cantidad=<?php echo $eB; ?>&amp;codigo=<?php echo $myrow['codigo']; ?>&almacen=<?php echo $_GET["almacen"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas reset este articulo?') == false){return false;}">
    
Reset
</a>        
<?php }else {echo '---';}?>        
    </span>    
    
</td>




          




                  
                  
                  
                  
    </tr>
<input name="limite[]" type="hidden" value="<?php echo $cS;?>" />
<input name="codec[]" type="hidden" value="<?php echo $myrow['codigo'];?>" />
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>


  <div align="center">

  </div>
  <label>
      <br><?php //echo $trigger[0];?>
          
         
          
          </br>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />


<input type="submit" name="surtir" value="SURTIR">
<p>&nbsp;</p>
  <p>&nbsp; </p>
</form>
</body>
</html>