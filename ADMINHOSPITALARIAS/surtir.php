<?PHP require("/configuracion/ventanasEmergentes.php");  require("/configuracion/funciones.php"); ?>


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

$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);  

if($_POST['surtir'] and $_POST['cantidadSurtida']){
$cantidadSurtida=$_POST['cantidadSurtida'];
$keyPA=$_POST['keyPA'];
$almacenSolicitante=$_POST['almacenSolicitante'];
$cantidadVendida=$_POST['cantidadVendida'];
$rand=rand(100,100000000);




$codigoInv='04';
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





for($i=0;$i<=$_POST['bandera'];$i++){


//echo $cantidadSurtida[$i].' -> '.$keyPA[$i];
//echo '<br>';

    if($cantidadSurtida[$i]>0 AND $keyPA[$i]){
 
$sSQL8aa= "
SELECT *
FROM
articulos
WHERE
    keyPA='".$keyPA[$i]."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);



//solicitado
$sSQL= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
    keyPA='".$keyPA[$i]."'
and
status='request'
and
tipoVenta!='Granel'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$solicitar= $myrow['solicitado'];
    
  
$sSQL8aa= "
SELECT *
FROM
articulos
WHERE
    keyPA='".$keyPA[$i]."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);
    
    
    





//cuanto tengo en cendis
$sSQLv1= "SELECT sum(cantidad) as c
FROM

articulosExistencias
where
entidad='".$entidad."'
and
    codigo='".$myrow8aa['codigo']."'
    and
    almacen='".$centroDistribucion."'
        and
        status='ready'
";
$resultv1=mysql_db_query($basedatos,$sSQLv1);
$myrowv1 = mysql_fetch_array($resultv1);
$tengoenCendis=$myrowv1['c'];


    
$sSQLv= "SELECT sum(cantidad) as c
FROM

movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
    codigo='".$myrow8aa['codigo']."'
    and
    almacen='".$myrow['almacen']."'
and
tipoVenta!='Granel'
";
$resultv=mysql_db_query($basedatos,$sSQLv);
$myrowv = mysql_fetch_array($resultv);
$solicitado=$myrowv['c'];







if($solicitado>=$cantidadSurtida[$i] AND ($tengoenCendis>0 and $tengoenCendis>=$solicitado)){


    
$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow8aa['codigo']."'
and

    
    almacen='".$cendis->cendis($entidad,$basedatos)."'
    and
status='ready' 
order by keyAE ASC
limit 0,$cantidadSurtida[$i]
";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$ia+=1;				
			
		    
    

$q1a = "UPDATE articulosExistencias set 
status='ready',numSolicitud='".$numSolicitud."',nOrden='".$_GET['nOrden']."',
    almacen='".$_GET['almacenSolicitante']."',tag=1

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();







$sSQLvmm= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
    codigo='".$myrowy['codigo']."'
and
status='request'
and
tipoVenta!='Granel'
limit 0,1
";
$resultvmm=mysql_db_query($basedatos,$sSQLvmm);
while($myrowvmm = mysql_fetch_array($resultvmm)){
$q1a1 = "UPDATE movSolicitudes set 

status='transferido',numSolicitud='".$numSolicitud."',usuarioCargo='".$usuario."'
WHERE

    keyMS='".$myrowvmm['keyMS']."'

";
mysql_db_query($basedatos,$q1a1); 
echo mysql_error();		
    $r[0]+=1;
}    
}



//DEPRECATED
//
//KARDEX
//$karticulos=new kardex();
//$karticulos-> movimientoskardex('entrada',$cantidadSurtida[$i],'TRASPASO ENTRE ALMACENES','traspaso',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$myrow['almacen'],$myrow['keyPA'],$myrow8aa['codigo'],$entidad,$basedatos);
//CIERRO KARDEX





//SALIDA DE ALMACEN CENDIS
/*$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,nOrden)
values
('".$myrow8aa['codigo']."','".$myrow['keyPA']."','".$myrow8aa['gpoProducto']."','".$cantidadSurtida[$i]."','".$myrow['tipoVenta']."','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$cendis->cendis($entidad,$basedatos)."','".$_GET['nOrden']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
 */



//DEPRECATED
 //ENTRADA ARTICULO
/*    
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,nOrden)
values
('".$myrow8aa['codigo']."','".$myrow['keyPA']."','".$myrow8aa['gpoProducto']."','".$cantidadSurtida[$i]."','".$myrow['tipoVenta']."','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$cendis->cendis($entidad,$basedatos)."','','".$tipoEntrada[$i]."','standby','".$_GET['nOrden']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//**********conversion a unidades***********
$entrance=new entradas();
$entrance=$entrance->entradaInventarios($costo,$numSolicitud,$codigoInv,$flag,$cendis->cendis($entidad,$basedatos),$fecha1,$hora1,'',$usuario,$entidad,$basedatos);
//******************************************
*/
    
//KARDEX
//DEPRECATED
//$karticulos=new kardex();
//$karticulos-> movimientoskardex('salida',$cantidadSurtida[$i],'TRASPASO ENTRE ALMACENES','traspaso',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$myrow['almacen'],$myrow['keyPA'],$myrow8aa['codigo'],$entidad,$basedatos);
//CIERRO KARDEX
 



/*
//ENTRADA A ALMACEN SOLICITANTE
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,
usuario,almacen,nOrden)
values
('".$myrow8aa['codigo']."','".$myrow['keyPA']."','".$myrow8aa['gpoProducto']."',
    '".$cantidadSurtida[$i]."','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow['almacen']."','".$_GET['nOrden']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();*/



$ab+=1;


//ENTRADA ARTICULO
//DEPRECATED
/*
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,nOrden)
values
('".$myrow8aa['codigo']."','".$myrow['keyPA']."','".$myrow8aa['gpoProducto']."','".$cantidadSurtida[$i]."','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow['almacen']."','".$_GET['nOrden']."','".$tipoEntrada[$i]."','standby','".$_GET['nOrden']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
*/
//KARDEX
//DEPRECATED
//$karticulos=new kardex();
//$karticulos-> movimientoskardex('entrada',$cantidadSurtida[$i],'TRASPASO ENTRE ALMACENES','traspaso',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$myrow['almacen'],$myrow['keyPA'],$myrow8aa['codigo'],$entidad,$basedatos);
//CIERRO KARDEX




//DEPRECATED
//**********conversion a unidades***********
//$entrance=new entradas();
//$entrance=$entrance->entradaInventarios($costo,$numSolicitud,$codigoInv,$flag,$myrow['almacen'],$fecha1,$hora1,'',$usuario,$entidad,$basedatos);
//******************************************

}else{

echo '<div class="error">Ya esta surtido, o No hay existencias disponibles, o estas tratando de cargar una cantidad mayor a la requerida!</div>';  
}

}//cierra for
}?>
<script>
window.alert("SE SURTIERON MEDICAMENTOS DE LA ORDEN #<?php echo $_GET['nOrden'];?>");
ventanaSecundaria8('../ventanas/printTraspasosS.php?numSolicitud=<?php echo $numSolicitud;?>&nOrden=<?php echo $_GET['nOrden'];?>&departamentoSolicitante=<?php echo $_GET['almacenSolicitante'];?>&entidad=<?php echo $entidad;?>&random=<?php echo $rand; ?>&usuarioCargo=<?php echo $usuario;?>&usuarioSolicitante=<?php echo $myrow['usuario'];?>&fecha=<?php echo $fecha1;?>&hora=<?php echo $hora1;?>&fechaSolicitud=<?php echo $myrow['fecha'];?>&horaSolicitud=<?php echo $myrow['hora'];?>','ventana7','800','600','yes');
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php 
if($ab>0 or $r[0]>0){
echo '<div class="success">Se cargaron articulos!</div>';
}
}


















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
<?php }
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
  <h1 align="center">Surtir Solicitudes</h1>
    <h2 align="center"># Solicitud del Sistema: <?php echo $_GET['nOrden'];?></h2>
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


  <table width="900" class="table table-striped">
        <tr >
      <th  >#</th>

      <th   align="left">Descripcion</th>
<th   align="left">Cendis</th>
      <th   align="left">DispBot</th>
      <th   align="left">Solicita</th>
      <th   align="left">Surtido</th>
  <th   align="left">Pendiente</th>
      <th   align="left">Cargar</th>
<th   align="left"></th>
    </tr>
    <tr>


<?php
//QUIEN ES CENTRO DE DISTRIBUCION DE ESTA ENTIDAD    


$sSQL= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
and
tipoVenta!='Granel'
group by codigo
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
nOrden='".$_GET['nOrden']."'
    and
codigo='".$myrow['codigo']."'
and
status='request'
and
tipoVenta!='Granel'
";
$resultv=mysql_db_query($basedatos,$sSQLv);
$myrowv = mysql_fetch_array($resultv);


//Surtido?
$sSQLv1= "SELECT sum(cantidad) as c
FROM

movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
codigo='".$myrow['codigo']."'
and
status='transferido'
and
tipoVenta!='Granel'
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
?>




<tr>
	        <td  ><?php echo $bandera;?></td>





<td  >
<?php
$total=$myrowv['c']-$myrowv1['c'];
echo $myrow['descripcion'];


echo '<br>';
echo 'Code: '.$myrow['codigo'];
echo '<br>';
echo '<span class="negro">'.'[ '.$myrow['gpoProducto'].' ]'.'</span>';

if( $total==0){
echo '<span class="codigos">'.'Transferido '.'</span>';

}else{
if($myrow['informacion']){
echo '<br>';
echo '<span class="error"><blink>'. $myrow['informacion'].'</blink></span>';
}
}

if( $myrowve['ventaGranel']=='si'){
    echo '<br>';
 echo '<span class="precio1">Articulo a Granel! </span>';   
}



?>
<?php echo $myrow['keyPA'];?>

</td>



















<td  >
<?php
$sSQLvce= "SELECT sum(cantidad) as c
FROM

articulosExistencias
where
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and
    almacen='".$centroDistribucion."'
        and
        status='ready'
";
$resultvce=mysql_db_query($basedatos,$sSQLvce);
$myrowvce = mysql_fetch_array($resultvce);

if($myrowvce['c']>0){
echo $myrowvce['c'];
$ce=NULL;
}else{
echo '0';
$ce=TRUE;
}
?>

</td>












                
                
                
<td  >
<?php 
$sSQLvbot= "SELECT sum(cantidad) as c
FROM

articulosExistencias
where
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
    and
    almacen='".$myrow['almacen']."'
        and
        status='ready'
";
$resultvbot=mysql_db_query($basedatos,$sSQLvbot);
$myrowvbot = mysql_fetch_array($resultvbot);

if($myrowvbot['c']>0){
echo $myrowvbot['c'];
}else{
echo '0';
}
?> 



      <input name="almacenSolicitante[]" type="hidden" value="<?php echo $myrow['almacenSolicitante'];?>" />
	  <input name="cantidadVendida[]" type="hidden" value="<?php echo $myrow['c'];?>" />
	  <input name="keyPA[]" type="hidden" value="<?php echo $myrow['keyPA'];?>" />
</td>
	  
    
               







   
                  
      <td  >
<?php
$sSQLvcc= "SELECT count(*) as c
FROM
movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
codigo='".$myrow['codigo']."'
and
tipoVenta!='Granel'
";
$resultvcc=mysql_db_query($basedatos,$sSQLvcc);
$myrowvcc = mysql_fetch_array($resultvcc);
echo $myrowvcc['c'];
?>
      </td>







<td  >
	 <label>
<?php 
//surtido
if($myrowv1['c']>0){
echo $myrowv1['c'];
$v[0]+=1;
}else{
echo '0';
}
?>
	 </label>
</td>

          
      
<td  >
<?php 
echo $myrowvcc['c']-	$myrowv1['c'];
?>
</td>










    
          

          
          
    















      

<td   >
	
<?php 
//MAXIMOS Y MINIMOS
$diff=($myrowvcc['c']-$myrowv1['c']);
if( $diff>0 and $ce==NULL){?>
      
	 <label>
             
             
     


<?php //DEPRECATED if( $myrowve['ventaGranel']=='si'){ $vG[0]+=1;}?>
             <input name="cantidadSurtida[]"  type="text" size="3"  autocomplete="off" >

	 </label>
<?php }    else{$vG[0]+=1;
   //echo '0'; 
echo '<input name="cantidadSurtida[]"  type="hidden" size="3"  autocomplete="off" >';
}?>
</td>















                  
                  
                  
<td  >
	

</td>
                  
    </tr>




















    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
    
    
  </table>

<p>&nbsp;</p>
  <p>&nbsp; </p>

  
  
  <div align="center">
      <?php 
          $tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
//$texto='SE CERRO LA ORDEN!';  
             $q1 = "UPDATE movSolicitudes set 
status='transferido'


WHERE 
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
and
tipoVenta!='Granel'

";
//mysql_db_query($basedatos,$q1);
echo mysql_error(); 





     if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    } 
    
echo '<script>
    
window.opener.document.forms["form1"].submit();

</script>';
    
    
     // }else{ ?>
  </div>
  
    <div align="center">
    <label>
	<?php if($bandera>=1 ){ ?>
    <input name="surtir" type="submit" id="surtir" value="Cargar"  />
	<?php } ?>
    </label>
  </div>
  
  <label>
      <br>
         <?php //}?> 
         
          <!--<input name="closed" type="button" id="surtir" value="Print" onClick="nueva('imprimirTraspaso.php?random=<?php echo $rand; ?>&orden=<?php echo $_GET['nOrden'];?>&usuario=<?php echo $_GET['usuario'];?>','ventana7','800','600','yes');" />-->
         
          </br>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>
<br>
</body>
</html>

