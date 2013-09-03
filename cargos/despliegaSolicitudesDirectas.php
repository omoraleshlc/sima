<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); ?>
<?php
$numeroE=$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
$almacenSolicitante=$_GET['almacen'];
$nCuenta=$_GET['nCuenta'];
$tipoCargo=$_GET['tipoCargo'];
$almacenDestino=$_GET['almacenDestino'];

?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=650,height=400,scrollbars=YES") 
} 
</script> 






<?php  
if(!$_POST['insertarArticulos'] and $_GET['keyCAP'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
            $sSQLs= "SELECT
folioDevolucion
FROM
cargosCuentaPaciente
where
keyCAP='".$_GET['keyCAP']."'
";
$results=mysql_db_query($basedatos,$sSQLs);
$myrows = mysql_fetch_array($results);
            
      $q1 = "UPDATE cargosCuentaPaciente
set
statusDevolucion=''
		WHERE 
		keyCAP='".$myrows['folioDevolucion']."'
		";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();      
            
$q = "DELETE FROM cargosCuentaPaciente

		WHERE 
		keyCAP='".$_GET['keyCAP']."'
		";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}
        
        $agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('ESTA ELIMINANDO LA DEVOLUCION EN VEZ DE CARGARLA','".$_GET['almacenDestino']."','".$_GET['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
?>



<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES") 
} 
</script> 

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el departamento!")   
                return false   
        } else if( vacio(F.tipoUM.value) == false ) {   
                alert("Por Favor, escoje si es un servicio o si son art�culos lo que vas a cargar!")   
                return false   
        } else if( vacio(F.nomArticulo.value) == false ) {   
                alert("Por Favor, escoje el articulo o servicio para solicitar!")   
                return false   
        }            
}   
  
  
  
  
</script> 







<?php

$sSQL31cd= "SELECT 
reporteSurtir
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$_GET['almacenDestino']."' 
";
$result31cd=mysql_db_query($basedatos,$sSQL31cd);
$myrow31cd = mysql_fetch_array($result31cd);

if($myrow31cd['reporteSurtir']){
$ruta=$myrow31cd['reporteSurtir'];
}else{ ?>
<script>
window.alert("No existe la ruta! favor de ir a almacenes y activar la ruta para surtir,  gracias");
window.close();
</script>
<?php } ?>

























<?php 



//************************* AGREGAR PACIENTE AMBULATORIO **************************



if($_POST['insertarArticulos'] ){ //*************************PRESIONO INSERTAR ARTICULOS******************

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



$codigo=$_POST['codigoArt'];
$cantidad=$_POST['cantidad'];
$agregarA=$_POST['agregarA'];
$codigoBeta=$_POST['codigoBeta'];
$codigoGamma=$_POST['codigoGamma'];
$um=$_POST['um'];
$codigoLC=$_POST['coder'];



for($i=0; $i<$_POST['bandera'];$i++){ //********************FOR
$b+=1;
$codigo[$i]=$codigoBeta[$i];


//********************ACTUALIZO EXISTENCIAS***********************
    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$codigo[$i]."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad[$i]*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad[$i];
}
//****************************************************************

$sSQL29= "SELECT *
FROM
cargosCuentaPaciente
where
keyCAP='".$codigoGamma[$i]."' 

";
$result29=mysql_db_query($basedatos,$sSQL29);
$myrow29 = mysql_fetch_array($result29);
$cm=$myrow29['cantidad'];

if($myrow29['almacenTraspaso']!=NULL){
$myrow29['almacenDestino']=$myrow29['almacenTraspaso'];
}




if( is_numeric($cantidad[$i]) and $cantidad[$i] >0 AND $myrow29['cantidad']>=$cantidad[$i] ){
    
    
    
    
    

    
    
    
    
    
    
    
    
    
$faltantes=$myrow29['cantidad'];
$cc=$myrow29['cantidad'];
$ccT=$cantidad[$i]-$cc;
if($ccT=='0'){

$statusCargo='cargado';
} else {
$cc-=$cantidad[$i];
$statusCargo='standby';
}
//***************************ajuste de existencias**************************

//*************************GENERAR NUMERO DE TRANSACCION***********************
if($statusCargo=='cargado'){
$sSQL333a= "SELECT 
MAX(keyCVI)+1 as CVI
FROM contadorVentasInternas
WHERE entidad='".$entidad."'   ";

$result333a=mysql_db_query($basedatos,$sSQL333a);
$myrow333a = mysql_fetch_array($result333a); 

if(!$myrow333a['CVI']){
$myrow333a['CVI']=1;
}

//********************************SE INCREMENTA EN 1*****************************

$agrega = "INSERT INTO contadorVentasInternas (
usuario,entidad
) values (
'".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


//echo 'externo';
$agrega1 = "INSERT INTO transaccionesVentas (
numTransaccion,keyCAP,cantidad,descripcionArticulo,precioVenta,iva,cantidadParticular,ivaParticular,
cantidadAseguradora,ivaAseguradora,usuario,hora,fecha,entidad,keyClientesInternos,folioVenta,almacen,status,gpoproducto,costo,tipomovimiento,
codigo,keypacantidad
) values (
'".$myrow333a['CVI']."','".$myrow29['keyCAP']."','".$myrow29['cantidad']."','".$myrow29['descripcionArticulo']."',
    '".$myrow29['precioVenta']."','".$myrow29['iva']."','".$myrow29['cantidadParticular']."',
'".$myrow29['ivaParticular']."','".$myrow29['cantidadAseguradora']."','".$myrow29['ivaAseguradora']."','".$usuario."',
'".$hora1."','".$fecha1."','".$entidad."','".$myrow29['keyClientesInternos']."',
'".$myrow29['folioVenta']."','".$myrow29['almacen']."','venta','".$myrow29['gpoProducto']."','".$myrow29['costoHospital']."','salida',
'".$myrow29['codProcedimiento']."','".$myrow29['keyPA']."'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();
}
//***************************************************



$informacionExistencias=new existencias();
$existenciasAjuste=$informacionExistencias->informacionExistencias($myrow29['tipoPaciente'],$entidad,$myrow29['codProcedimiento'],$myrow29['almacenDestino'],$usuario,$fecha,$basedatos);




if($existenciasAjuste!='exento'){
    

if($myrow29['statusDevolucion']=='si'){
$cendis=new whoisCendis();




//SOLAMENTE LOS ARTICULOS DEVUELTOS A GRANEL PROCEDEN AL ALMACEN ORIGINAL
$sSQLy3= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow29['codProcedimiento']."'
and
almacen='".$myrow29['almacenSolicitante']."'

";


$resulty3=mysql_db_query($basedatos,$sSQLy3);
$myrowy3 = mysql_fetch_array($resulty3);

if($myrowy3['ventaGranel']!='si' ){
    

$myrow29['almacenSolicitante']=$cendis->cendis($entidad,$basedatos); 
$myrow29['almacenDestino']=$cendis->cendis($entidad,$basedatos);

}











//AJUSTE DE EXISTENCIAS MANUAL
$cm=(int) $cm;

$sSQLam= "
SELECT * 
FROM
articulosExistencias
WHERE
keyCAP='".$myrow29['keyE']."'
    order by keyAE ASC
limit 0,$cm    
";


$resultam=mysql_db_query($basedatos,$sSQLam);
while($myrowam = mysql_fetch_array($resultam)){
    
//AFECTO KARDEX  *******************************************
    $codigoInv='03';
    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow29['codProcedimiento']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    





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
codigo='".$myrow29['codProcedimiento']."'
    and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();
//***********************CIERRO EXISTENCIAS***************


$q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud,keyCAP)
values
('".$myrow29['codProcedimiento']."','".$codigoInv."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow29['keyPA']."','".$myrow29['almacenDestino']."',
        '".$myrow29['almacenDestino']."',
        '".$myrowam['costo']."',
        '1','1','".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$myrow8ac['gpoProducto']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','ENTRADA',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."','".$myrow29['keyE']."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//CIERRO AFECTACION DE KARDEX************************************************ 

//********AJUSTE A EXISTENCIAS CON EL ANTIGUO COSTO*************
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,costo,nOrden,numSolicitud)
values
('".$myrow29['codProcedimiento']."','".$myrow29['keyPA']."','".$myrow29['gpoProducto']."',1,'".$myrowy['tipoVenta']."','".$entidad."','ENTRADA',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow29['almacenDestino']."','".$factura."','".$myrowy['tipo']."','ready','".$myrowam['costo']."',
'".$myrowy['nOrden']."','".$numSolicitud."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//********CIERRO AJUSTE DE EXISTENCIAS CON ANTIGUO COSTO*********

}
//CIERRA AJUSTE MANUAL**************












//ENTRADA A FAVOR DEL ALMACEN
//DEPRECATED
/*
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,folioVenta,keyClientesInternos,nOrden,tipo,status)
values
('".$myrow29['codProcedimiento']."','".$myrow29['keyPA']."','".$myrow29['gpoProducto']."','".$myrow29['cantidad']."','devolucion','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow29['almacenDestino']."',
        '".$myrow29['folioVenta']."','".$myrow29['keyClientesInternos']."','".$_GET['numSolicitud']."','Normal','standby')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$next='si';
*/


$q = "UPDATE cargosCuentaPaciente set 
    numSolicitud='".$_GET['numSolicitud']."',
numMovimiento='".$myrow333a['CVI']."',
transferencia='si',
random='".$_POST['rand']."',
statusImpresion='standby',usuarioImpresion='".$usuario."',
cantidad='".$cc."', 
statusCargo='".$statusCargo."',
horaCargo='".$hora1."',
fechaCargo='".$fecha1."',
usuarioCargo='".$usuario."'



WHERE keyCap = '".$codigoGamma[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();


$noErrors=TRUE;




/*****************************CIERRO AFECTA KARDEX******************************

/*
//DEPRECATED
//*****************************KARDEX**************************
$karticulos=new kardex();
$karticulos-> movimientoskardex('entrada',$cantidad[$i],'ENTRADA POR DEVOLUCION','devolucionVenta',$usuario,$fecha1,$hora1,$myrow29['almacenSolicitante'],$myrow29['almacenDestino'],$myrow29['keyPA'],$codigo[$i],$entidad,$basedatos);
//*************************************************************
*/



}elseif(  $existenciasAjuste>0){ //aqui van los maximos y minimos

$ajusteExistencias=new existencias();
$error=$ajusteExistencias->ajusteExistencias('si','02',$numSolicitud,$myrow29['folioVenta'],$myrow29['keyClientesInternos'],$myrow29['almacenSolicitante'],$myrow29['keyCAP'],$entidad,$myrow29['gpoProducto'],$myrow29['cantidad'],$myrow29['codProcedimiento'],$myrow29['almacenDestino'],$usuario,$fecha1,$error,$basedatos);

$noErrors=TRUE;

$q = "UPDATE cargosCuentaPaciente set 
    numSolicitud='".$_GET['numSolicitud']."',
numMovimiento='".$myrow333a['CVI']."',
transferencia='si',
random='".$_POST['rand']."',
statusImpresion='standby',usuarioImpresion='".$usuario."',
cantidad='".$cc."', 
statusCargo='".$statusCargo."',
horaCargo='".$hora1."',
fechaCargo='".$fecha1."',
usuarioCargo='".$usuario."'



WHERE keyCap = '".$codigoGamma[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();


/*DEPRECATED
$karticulos=new kardex();
$karticulos-> movimientoskardex($numSolicitud,'SALIDA',$cantidad[$i],'SALIDA POR VENTA','venta',$usuario,$fecha1,$hora1,$myrow29['almacenSolicitante'],$myrow29['almacenDestino'],$myrow29['keyPA'],$codigo[$i],$entidad,$basedatos);



$karticulos=new kardex();
$karticulos-> movimientoskardex('salida',$cantidad[$i],'SALIDA POR VENTA','venta',$usuario,$fecha1,$hora1,$myrow29['almacenSolicitante'],$myrow29['almacenDestino'],$myrow29['keyPA'],$codigo[$i],$entidad,$basedatos);
*/

$next='si';
}else{
$tipoMensaje='error';
$encabezado='Error';
$texto='No hay existencias...!';
$next='no';
$error='faked';
echo '<script>window.alert("NO HAY EXISTENCIAS!");</script>';
}




}else{//son exentos o son farmacia

$noErrors=TRUE;
$q = "UPDATE cargosCuentaPaciente set
numMovimiento='".$myrow333a['CVI']."',
transferencia='si',
random='".$_POST['rand']."',
statusImpresion='standby',usuarioImpresion='".$usuario."',
cantidad='".$cc."',
statusCargo='".$statusCargo."',
horaCargo='".$hora1."',
fechaCargo='".$fecha1."',
usuarioCargo='".$usuario."'



WHERE keyCap = '".$codigoGamma[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();






}


/*DEPRECATED
//**********ACTUALIZA KARDEX**************
$actualizaK=new ActualizaKardex();
$actualizaK=$actualizaK-> updateKardex($usuario,$entidad,$basedatos);
//*******CIERRA ACTUALIZAR KARDEX*********s
 * 
 */


}
?>
<?php if($noErrors==TRUE){?>
<script>
javascript:ventanaSecundaria("../ventanas/printTraspasosSD.php?almacenDestino=<?php echo $_GET['almacenDestino'];?>&usuarioSolicitante=<?php echo $_GET['usuarioSolicitante'];?>&departamentoSolicitante=<?php echo $_GET['departamentoSolicitante'];?>&medico=<?php echo $_GET['medico'];?>&paciente=<?php echo $_GET['paciente'];?>&keyCAP=<?php echo $myrow['keyCAP'];?>&nOrden=<?php echo $myrow['nOrden'];?>&entidad=<?php echo $entidad;?>&random=<?php echo $rand; ?>&usuarioCargo=<?php echo $usuario;?>&fecha=<?php echo $fecha1;?>&hora=<?php echo $hora1;?>&fechaSolicitud=<?php echo $_GET['fechaSolicitud'];?>&horaSolicitud=<?php echo $_GET['horaSolicitud'];?>&numSolicitud=<?php echo $_GET['numSolicitud'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>");
window.opener.document.forms["form1"].submit();    
window.close();
</script>
<?php } 


}













//TRANSACCIONES FINALES
//**********conversion a unidades***********

$entrance=new entradas();
$entrance=$entrance->entradaInventarios($costo,$numSolicitud,$codigoInv,$flag,$myrow29['almacenDestino'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);
$next='si';


//*****************************************************CIERRO ALMA**************************************************


        $agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('SE SURTIERON ARTICULOS','".$_GET['almacenDestino']."','".$_GET['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
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
<h1>
  <label>
<?php echo $_GET['paciente'];?>  </label>
</h1>

    <h1 >
  <label>
       <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
    </label>
</h1>

<h1>Usuario Surte: <?php echo $usuario;?></h1>
<br />
<form name="form2" method="post" onSubmit="return valida(this);">

  
  
<table width="900" class="table table-striped">

  <tr >
    <th width="65" >#</th>
    <th width="95" >Fecha Muestra </th>
    <th width="250" >Descripcion</th>	
    <th width="130" >Almacen 	Solicita </th>
    <th width="58" >Usuario</th>
    <th width="77" >Precio U </th>
    
    <th width="90" >Cantidad</th>
    <th width="64" >Cancelar</th>
  </tr>
<?php	
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
numSolicitud='".$_GET['numSolicitud']."'
and
(almacenDestino='".$_GET['almacenDestino']."' or almacen='".$_GET['almacenDestino']."')
and
statusCargo='standby'";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;
if($myrow['statusDevolucion']=='si'){
 $r[0]+=1;   
}


if( $myrow['statusDevolucion']!='si'){
$informacionExistencias=new existencias();
$existenciasAjuste=$informacionExistencias->informacionExistencias($myrow['tipoPaciente'],$entidad,$myrow['codProcedimiento'],$myrow['almacenDestino'],$usuario,$fecha,$basedatos);


if($existenciasAjuste>=$myrow['cantidad']){ 
$existencias='si';

} else {
$existencias=NULL;
}
}
?>
  <tr >
    <td height="48" ><?php 
    echo $bandera;echo '<br>';
		  print $myrow['keyCAP'];
		
		  ?></td>
    <td ><span >
      <?php 
		  print cambia_a_normal($myrow['fechaSolicitud']). " ".$myrow['horaSolicitud'];
		
		  ?>
    </span></td>
    <td ><span >
      <div align="left" ><a href="#"  onclick="javascript:ventanaSecundaria('/sima/cargos/cambiarArticulos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;almacenDestino=<?php echo $bali; ?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&amp;paciente=<?php echo $myrow8a['paciente'];?>&amp;usuario=<?php echo $myrow['usuario'];?>&amp;numSolicitud=<?php echo $myrow['numSolicitud'];?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;keyCAP=<?php echo $myrow['keyCAP'];?>&amp;codigo=<?php echo $myrow['codProcedimiento'];?>   ')">
        <?php 
		  
					echo $myrow['descripcionArticulo'];
		?>
      </a></div>
      <?php 
	  if($myrow['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '   [Se solicito devolucion para este articulo]';
	  }
?>
      <?php 
$sSQL2s= "Select descripcionGP From gpoProductos
 where
codigoGP='".$myrow['gpoProducto']."'
";
$result2s=mysql_db_query($basedatos,$sSQL2s);
$myrow2s = mysql_fetch_array($result2s);

	  echo ' ['.$myrow2s['descripcionGP'].']';
	  ?>
      </span></td>
    <td ><span >
      <?php 
		$sSQL8ab= "
SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."'
    and
almacen='".$myrow['almacenSolicitante']."'";
$result8ab=mysql_db_query($basedatos,$sSQL8ab);
$myrow8ab = mysql_fetch_array($result8ab);
echo $myrow8ab['descripcion'];
?>
    </span></td>
    <td ><span >
      <?php 
		  print $myrow['usuario'];
		
		  ?>
    </span></td>
    <td ><span ><?php echo '$'.number_format($myrow['precioVenta']+$myrow['iva'],2);?></span></td>
    
    
    
    
    

    
    
    
    
    <td ><span >

      <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />
      <input name="codigoBeta[]" type="hidden" id="codigoBeta[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />
      <input name="codigoGamma[]" type="hidden" id="codigoGamma[]" value="<?php  echo $myrow['keyCAP']; ?>" />
      <span>
      <input name="cantidad[]" type="hidden"  id="cantidad" value="<?php echo $myrow['cantidad']; ?>"/>
      <?php echo $myrow['cantidad']; ?>
      </span>    </span></td>
    <td ><div align="center">
<a   href="despliegaSolicitudesDirectas.php?codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>&amp;keyCAP=<?php print $myrow['keyCAP'];?>&amp;folioVenta=<?php echo $_GET['folioVenta'];?>&amp;almacenDestino=<?php echo $_GET['almacenDestino'];?>&amp;numSolicitud=<?php echo $_GET['numSolicitud'];?>"><img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar <?php echo $myrow['descripcionArticulo'];?>?') == false){return false;}" /></a></div></td>
  </tr>
  <?php  }?>

</table>

<p>
      <?php 
 
 //*********************************************TERMINA TABLA**************************************************
 
 ?>
</p>
  
      <label>
 
        <hr width="600" size="0" />
  <div align="center">
          
    </label>
<?php if($bandera>0){ ?>
    
    
    <?php #TRAE DEVOLUCION
    if($r[0]>0){
        
        echo '<input name="insertarArticulos" type="submit"  id="insertarArticulos" value="SURTIR SERVICIOS/ARTICULOS" />';
        echo '<input name="update" type="submit"  id="insertarArticulos" value="Cerrar Orden" />';
        
    }else{
    if($existencias!=NULL){?>
    <blink>
        

        <input name="insertarArticulos" type="submit"  id="insertarArticulos" value="SURTIR SERVICIOS/ARTICULOS" />



        <input name="update" type="submit"  id="insertarArticulos" value="Cerrar Orden" />



    </blink>
    <?php }else{
        echo '<div class="error">Favor de verificar existencias!</div>';
    }}?>
    
<?php } else{?>
    No hay Articulos para surtir...
    <?php }?>
</div>
        <p align="center">&nbsp; </p>
		  <input name="rand" type="hidden" id="rand" value="<?php echo rand(10000,100000000); ?>"/>
        <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
        <input name="usuarioSolicita" type="hidden" id="numPaciente" value="<?php echo $_GET['usuario']; ?>" />
</form>
<p></p>
  
  
</body>
</html>
