<?PHP require("/configuracion/ventanasEmergentes.php");  require("/configuracion/funciones.php"); ?>

<script language=javascript>
function ventanaSecundaria8 (URL){
   window.open(URL,"ventana8","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
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






$agrega2 = "DELETE FROM articulosExistencias
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
//articulosExistencias
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
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,nOrden)
values
('".$myrow8aa['codigo']."','".$_GET['keyPA']."','".$myrow8aa['gpoProducto']."','".$_GET['cantidadSurtir']."','Granel','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$cendis->cendis($entidad,$basedatos)."','".$n."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




//ENTRADA A ALMACEN SOLICITANTE
$agrega = "INSERT INTO articulosExistencias (
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





if($_GET['keyPA'] and $_GET['cantidadSurtir'] and $_GET['almacen']){
/*ESTE PROCESO HACE UNA SALIDA DE UNA CAJA SOLAMENTE DE CENDIS AL BOTIQUIN 
 * CORRESPONDIENTE, EL KARDEX SE ACTIVA PORQUE HUBO UNA VENTA DE UNA UNIDAD
 * 
 * 
 * 
 */    
    
    
//  echo $_GET['cantidadSurtir'].' -> '.$_GET['confExistencias'];  

if($_GET['cantidadSurtir']<=$_GET['confExistencias']) {   
    
$cantidadSurtida=$_POST['cantidadSurtida'];
$keyPA=$_POST['keyPA'];
$almacenSolicitante=$_POST['almacenSolicitante'];
$cantidadVendida=$_POST['cantidadVendida'];
$rand=rand(100,100000000);


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
$karticulos=new kardex();
$karticulos-> movimientoskardex('salida','1','SALIDA POR VENTA','venta',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$_GET['almacen'],$_GET['keyPA'],$_GET['codigo'],$entidad,$basedatos);


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


//SALE DE CENDIS 
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,keyClientesInternos,folioVenta,costo,keyAEVenta,tipo,factura,status)
values
('".$myrow8ac['codigo']."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','1','".$myrow['tipoVenta']."','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$aP."','".$keyClientesInternos."','".$folioVenta."','".$myrow3ac['costo']."','".$myrowy['keyAE']."','".$myrowy['tipo']."',
'".$myrowy['factura']."','sold'	)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



//ENTRA AL BOTIQUIN UTILIZAR CONVERSION
//ENTRADA
for($i=0;$i<=$_GET['cantidadSurtir'];$i++){
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,keyClientesInternos,folioVenta,costo,keyAEVenta,tipo,factura,status)
values
('".$myrow8ac['codigo']."','".$myrow8ac['keyPA']."','".$myrow8ac['gpoProducto']."','1','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_GET['almacen']."','".$keyClientesInternos."','".$folioVenta."','".$myrow3ac['costo']."','".$myrowy['keyAE']."','".$myrowy['tipo']."',
'".$myrowy['factura']."','ready'	)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}





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
  


if($ir<=$_GET['cantidadSurtir']){

$q1 = "UPDATE movSolicitudes set 
status='transferido'


WHERE 
keyMS='".$myrow['keyMS']."'";
mysql_db_query($basedatos,$q1);
}//solova atransferir la cantidada surtir

}//termina wwhile


}else{
echo '<span class="error">Error! Verifica la existencia!</span>';    
}
}






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

  <table width="700" class="table table-striped">
        <tr >
      <th width="5" >#</th>

      <th width="171"  align="left">Descripcion</th>
      <th   align="left">Disponible [CenDis]</th>
      <th   align="left">Disponible [<?php echo $myrow661['descripcion'];?>]</th>
    
      
      <th   align="left">CargadoPx</th>
      <th   align="left">Cant. p/ Surtir</th>
      <th   align="left">ConfExis</th>
            <th   align="left">Status</th>
      
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

$sSQLv1= "SELECT sum(cantidad) as c
FROM

articulosExistencias
where
entidad='".$entidad."'
and
keyPA='".$myrow['keyPA']."'
    and
    almacen='".$myrow['almacen']."'
        and
        tipoMov='entrada'
        and
        status='ready'
";
$resultv1=mysql_db_query($basedatos,$sSQLv1);
$myrowv1 = mysql_fetch_array($resultv1);


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
keyPA='".$myrow['keyPA']."'
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
	        <td bgcolor="<?php echo $color?>" ><?php echo $bandera;?></td>





<td height="24" bgcolor="<?php echo $color?>" >
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





?>

</td>
                
                
                
<td width="79" bgcolor="<?php echo $color?>" >
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
    tipoMov='entrada'
    and
    almacen='".$aP."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();


//SALIDAS
    $sSQL8ac1s= "
SELECT sum( cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and
    tipoMov='salida'
    and
    almacen='".$aP."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
echo $myrow8ac1e['entrada']-$myrow8ac1s['salida'];
?>
</td>





<td width="79" bgcolor="<?php echo $color?>" >
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
    tipoMov='entrada'
    and
  almacen='".$_GET['almacen']."'
      and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();


//SALIDAS
    $sSQL8ac1s= "
SELECT sum( cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and
    tipoMov='salida'
and
    almacen='".$_GET['almacen']."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);

echo $eB=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];
?>
</td>




	  

<td>
    <?php 
    if($myrowa['s']>0){
    echo  $cargadoPx=$myrowa['s'];
    }else{
        echo 0;
    }
    ?>
    
</td>







<td width="57" bgcolor="<?php echo $color?>" >

<label>
<?php 
//surtido
echo $myrow['cantidadSurtir'];
$cS=$myrow['cantidadSurtir'];
?></label>
</td>

          








<td width="57" bgcolor="<?php echo $color?>" >
<input name="cantidadSurtir[]" type="hidden" value="<?php echo $myrowve['cantidadSurtir'];?>" />
<label>
<?php 
echo $myrow['existencia'];
?></label>
</td>






          
          
          

<td width="52" bgcolor="<?php echo $color?>" >    
    


<label>
    
    
    
    <?php 
    
    if($cargadoPx>=$myrow['cantidadSurtir'] AND (($cargadoPx>=$myrow['cantidadSurtir'])<=$myrow['existencia'])){?>
    <a  href="surtirGranel.php?confExistencias=<?php echo $myrow['existencia']+$cargadoPx;?>&codigo=<?php echo $myrow['codigo'];?>&almacen=<?php echo $_GET['almacen'];?>&keyPA=<?php echo $myrow['keyPA'];?>&surtir=yes&cantidadSurtir=<?php echo $myrowve['cantidadSurtir'];?>" onclick="if(confirm('Esta seguro que deseas surtir este articulo?') == false){return false;}" >
    Surtir    
    </a>
        <?php } else{
        
            echo '<span class="error">Incompleto!</span>';
    }
?>

</label>
    
    
</td>






















          




                  
                  
                  
                  
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>

<p>&nbsp;</p>
  <p>&nbsp; </p>
  <div align="center">

  </div>
  <label>
      <br><?php //echo $trigger[0];?>
          
         
          
          </br>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>
</body>
</html>