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



if($_POST['surtir'] and $_POST['cantidadSurtida']){
$cantidadSurtida=$_POST['cantidadSurtida'];
$keyPA=$_POST['keyPA'];
$almacenSolicitante=$_POST['almacenSolicitante'];
$cantidadVendida=$_POST['cantidadVendida'];
$rand=rand(100,100000000);


$cendis=new whoisCendis();







for($i=0;$i<=$_POST['bandera'];$i++){
    if($cantidadSurtida[$i]>0){
    if($keyPA[$i]){
 $sSQL= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
    keyPA='".$keyPA[$i]."'

";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

    
  
$sSQL8aa= "
SELECT *
FROM
articulos
WHERE
    keyPA='".$keyPA[$i]."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);
    
    
    
$informacionExistencias=new existencias();$cendis=new whoisCendis();
$disponibleCendis=$informacionExistencias->informacionExistencias($myrow3115s['tipoPaciente'],$entidad,$myrow8aa['codigo'],$cendis->cendis($entidad,$basedatos),$usuario,$fecha,$basedatos);    

$sSQLv1= "SELECT sum(cantidad) as c
FROM

articulosExistencias
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
    keyPA='".$keyPA[$i]."'
    and
    almacen='".$myrow['almacen']."'
        and
        tipoMov='entrada'
";
$resultv1=mysql_db_query($basedatos,$sSQLv1);
$myrowv1 = mysql_fetch_array($resultv1);
$surtido=$myrowv1['c'];


    
$sSQLv= "SELECT sum(cantidad) as c
FROM

movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
keyPA='".$myrow['keyPA']."'
    and
    almacen='".$myrow['almacen']."'
";
$resultv=mysql_db_query($basedatos,$sSQLv);
$myrowv = mysql_fetch_array($resultv);
$solicitado=$myrowv['c'];

//echo 'hay: '.$disponible.'solicitado: '.$solicitado.' cargando: '.$cantidadSurtida[$i];


//priemera condicion, lo solicitado menos lo surtido=0
$aIngresar=$solicitado-$surtido;

//Tiene existencias cendis?
$ee=$disponibleCendis-$cantidadSurtida[$i];





if($ee>=0  and $aIngresar>0){



//KARDEX
$karticulos=new kardex();
$karticulos-> movimientoskardex($existencia,'TRASPASO ENTRE ALMACENES','traspaso',$usuario,$fecha1,$hora1,$cendis->cendis($entidad,$basedatos),$myrow['almacen'],$myrow['keyPA'],$myrow8aa['codigo'],$entidad,$basedatos);
//CIERRO KARDEX





//SALIDA DE ALMACEN CENDIS
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,nOrden)
values
('".$myrow8aa['codigo']."','".$myrow['keyPA']."','".$myrow8aa['gpoProducto']."','".$cantidadSurtida[$i]."','".$myrow['tipoVenta']."','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$cendis->cendis($entidad,$basedatos)."','".$_GET['nOrden']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




//ENTRADA A ALMACEN SOLICITANTE
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,nOrden)
values
('".$myrow8aa['codigo']."','".$myrow['keyPA']."','".$myrow8aa['gpoProducto']."','".$cantidadSurtida[$i]."','".$myrow['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow['almacen']."','".$_GET['nOrden']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$ab+=1;

}else{
  $tipoMensaje='Error';
$encabezado='Error';
$texto='Ya esta surtido, o No hay existencias disponibles, o estas tratando de cargar una cantidad mayor a la requerida!';  
}
}//cierra validacion
}//cierra for
}?>
<script>
//window.alert("SE SURTIERON MEDICAMENTOS CON LA SOLICITUD #<?php echo $_GET['nOrden'];?>");
//nueva('imprimirTraspaso.php?random=<?php echo $rand; ?>&orden=<?php echo $_GET['nOrden'];?>&usuario=<?php echo $_GET['usuario'];?>','ventana7','800','600','yes');
//window.opener.document.forms["form1"].submit();
//window.close();
</script>
<?php 
if($ab>0){
$tipoMensaje='Exito';
$encabezado='Exitoso';
$texto='Se surtieron articulos!';  
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

  <img src="../../imagenes/bordestablas/borde1.png" width="600" height="24" />
  <table width="600" border="0.2" align="center" cellpadding="4" cellspacing="0">
        <tr bgcolor="#FFFF00">
      <th width="19" class="negromid">#</th>
      <th width="38" class="negromid">Orden</th>
      <th width="171" class="negromid" >Descripcion</th>
      <th  class="negromid">Disponible</th>
      <th  class="negromid">Solicita</th>
      <th  class="negromid">Surtido</th>
      <th  class="negromid">Pendiente</th>
      <th  class="negromid">Cargar</th>
    </tr>
    <tr>


<?php


 $sSQL= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
group by keyPA
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
keyPA='".$myrow['keyPA']."'
";
$resultv=mysql_db_query($basedatos,$sSQLv);
$myrowv = mysql_fetch_array($resultv);

$sSQLv1= "SELECT sum(cantidad) as c
FROM

articulosExistencias
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
keyPA='".$myrow['keyPA']."'
    and
    almacen='".$myrow['almacen']."'
        and
        tipoMov='entrada'
";
$resultv1=mysql_db_query($basedatos,$sSQLv1);
$myrowv1 = mysql_fetch_array($resultv1);
?>




<tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
	        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $bandera;?></td>

                <td bgcolor="<?php echo $color?>" class="normal">
                	    <?php

echo   $_GET['orden'];

	  ?>
                </td>



<td height="24" bgcolor="<?php echo $color?>" class="normal">
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

if( $myrow['ventaGranel']=='si'){
    echo '<br>';
 echo '<span class="error"><blink>Articulo a Granel</blink></span>';   
}



?>

</td>
                
                
                
<td width="79" bgcolor="<?php echo $color?>" class="normal">
<?php 
$informacionExistencias=new existencias();$cendis=new whoisCendis();
echo $informacionExistencias->informacionExistencias($myrow3115s['tipoPaciente'],$entidad,$myrow['codigo'],$cendis->cendis($entidad,$basedatos),$usuario,$fecha,$basedatos);
?>
</td>
	  
          <input name="almacenSolicitante[]" type="hidden" value="<?php echo $myrow['almacenSolicitante'];?>" />
	  <input name="cantidadVendida[]" type="hidden" value="<?php echo $myrow['c'];?>" />
	  <input name="keyPA[]" type="hidden" value="<?php echo $myrow['keyPA'];?>" />
                  
                  
      <td width="54" bgcolor="<?php echo $color?>" class="normal">
<?php
echo $myrowv['c'];
?>
      </td>




<td width="57" bgcolor="<?php echo $color?>" class="normal">
	 <label>
<?php 
//surtido

echo $myrowv1['c'];

?>
	 </label>
</td>

          
          
          
<td width="66" bgcolor="<?php echo $color?>" class="normal">



	 <label>
<?php 

//pendiente




echo $myrowv['c']-$myrowv1['c'];
$trigger[0]+=$myrowv['c']-$myrowv1['c'];
?>
	 </label>
</td>
          
          
          

<td width="52" bgcolor="<?php echo $color?>" class="normal">
	 <a   href="javascript:ventanaSecundaria8('resurtirInventarios.php?nOrden=<?php echo $myrow['nOrden']; ?>')"></a>
      
	 <label>
	 <input name="cantidadSurtida[]" class="normal" type="text" size="5" maxlength="5" autocomplete="off" <?php //if( $total==0 ) echo 'readonly=""';?>/>
	 </label>
</td>
                  
                  
                  
                  
                  
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" width="600" height="24" />
<p>&nbsp;</p>
  <p>&nbsp; </p>
  <div align="center">
    <label>
	<?php if($bandera>=1){ ?>
    <input name="surtir" type="submit" id="surtir" value="Cargar"  />
	<?php } ?>
    </label>
  </div>
  <label>
      <br><?php //echo $trigger[0];?>
          
         
          <input name="close" type="button" id="surtir" value="Print" onClick="nueva('imprimirTraspaso.php?random=<?php echo $rand; ?>&orden=<?php echo $_GET['nOrden'];?>&usuario=<?php echo $_GET['usuario'];?>','ventana7','800','600','yes');" />
          <input name="close" type="submit" id="surtir" value="Cerrar Orden" <?php if($trigger[0]>0){echo 'disabled=""';}?>  />
          </br>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>
</body>
</html>