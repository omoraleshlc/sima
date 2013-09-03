<?PHP include("/configuracion/ventanasEmergentes.php"); ?>

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



for($i=0;$i<=$_POST['bandera'];$i++){






$sSQLs1= "SELECT
sum(cantidad) as c
FROM
faltantes
where
entidad='".$entidad."'
and
usuario='".$_GET['usuario']."'
and
nOrden='".$_GET['solicitud']."'
and
keyPA='".$keyPA[$i]."'
";
$results1=mysql_db_query($basedatos,$sSQLs1);
$myrows1 = mysql_fetch_array($results1);
$sSQLs1a= "SELECT
sum(cantidadAcumulada) as c
FROM
faltantes
where
entidad='".$entidad."'
and
usuario='".$_GET['usuario']."'
and
nOrden='".$_GET['solicitud']."'
and
keyPA='".$keyPA[$i]."'
";
$results1a=mysql_db_query($basedatos,$sSQLs1a);
$myrows1a = mysql_fetch_array($results1a);


$tope=$myrows1['c']-$myrows1a['c'];



if($cantidadSurtida[$i]>0){//la cantidad debe ser mayor que cero
    //echo $cantidadSurtida[$i].'  '.$myrows1['cantidad'];

if($cantidadSurtida[$i]<=$tope){//valido que sea menor la cantidad a la que esta solicitando

    
if($keyPA[$i]!=NULL){

//****************ACTUALIIZO CENDIS*****************
$sSQL52a="SELECT almacen
FROM
almacenes
WHERE
entidad='".$entidad."'
and
centroDistribucion='si' ";
  $result52a=mysql_db_query($basedatos,$sSQL52a);
  $myrow52a = mysql_fetch_array($result52a);


//*****************PUEDO TRANSFERIR A ESTE ALMACEN, TENGO PARA TRANSFERIRLE?******************
$sSQL52="SELECT existencia
FROM
existencias
WHERE
entidad='".$entidad."'
and
keyPA = '".$keyPA[$i]."' and almacen='".$myrow52a['almacen']."' ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
//**************************************************************************************************
$cantidadEnStock=$myrow52['existencia'];
//**************************************************


//echo $cantidadEnStock.' '.$cantidadSurtida[$i];

if($cantidadEnStock>=$cantidadSurtida[$i]){









    
$sSQLs= "SELECT
*
FROM
faltantes
where
entidad='".$entidad."'
and
usuario='".$_GET['usuario']."'
and
nOrden='".$_GET['solicitud']."'
and
keyPA='".$keyPA[$i]."'
";
$results=mysql_db_query($basedatos,$sSQLs);
$myrows = mysql_fetch_array($results);



if($myrows['cantidad']==$myrows['cantidadAcumulada']){
    $status='transferido';
    $statusSolicitudes='transfered';
}else{
    $status='pendiente';
    $statusSolicitudes='standby';
    $pendiente='si';
}




//*********DESCUENTA DE CENDIS
 $q2 = "UPDATE existencias set
fechaA='".$fecha1."',
hora='".$hora1."',
existencia=existencia-'".$cantidadSurtida[$i]."'

WHERE
entidad='".$entidad."'
    AND
keyPA='".$keyPA[$i]."'
AND
almacen = '".$myrow52a['almacen']."'  ";

mysql_db_query($basedatos,$q2);
echo mysql_error();
//***************************************
//ACREDITA A DEPARTAMENTO SOLICITANTE

 $q2a = "UPDATE existencias set
fechaA='".$fecha1."',
hora='".$hora1."',
existencia=existencia+'".$cantidadSurtida[$i]."'

WHERE
entidad='".$entidad."'
    AND
keyPA='".$keyPA[$i]."'
AND
almacen = '".$myrows['almacenSolicitante']."'  ";

mysql_db_query($basedatos,$q2a);
echo mysql_error();
//***************************************

//************************************









   $q1 = "UPDATE
    faltantes

set
cantidadSurtida='".$cantidadSurtida[$i]."',cantidadAcumulada='".$cantidadSurtida[$i]."'+cantidadAcumulada,
status='".$status."',
random='".$rand."',
    usuarioCargo='".$usuario."',
        fechaCargo='".$fecha1."'
WHERE
entidad='".$entidad."'
    and
    usuario='".$_GET['usuario']."'
and
keyPA='".$keyPA[$i]."'
and
nOrden='".$_GET['solicitud']."'

";
mysql_db_query($basedatos,$q1);
echo mysql_error();
 $status='exito';


//************************************************

 $agrega1 = "INSERT INTO faltantesSub (
     nOrden,
codigo,
cantidad,
usuario,
fecha1,
hora1,
almacen,
ejercicio,
dia,
status,entidad,almacenSolicitante,folioVenta,
keyPA,gpoProducto,naturaleza,descripcion,keyClientesInternos,cantidadTotal,
cantidadSurtida,cantidadAcumulada,random,usuarioCargo,fechaCargo

) values (
'".$myrows['nOrden']."',
'".$myrows['codigo']."',
'".$myrows['cantidad']."',
'".$usuario."',
'".$fecha1."',
'".$hora1."',
'".$myrows['almacen']."',
'".$ID_EJERCICIOM."',
'".$dia."',
'".$status."','".$entidad."','".$myrows['almacenSolicitante']."',
    '".$myrows['folioVenta']."','".$myrows['keyPA']."',
        '".$myrows['gpoProducto']."','C',
    '".$myrows['descripcion']."','".$myrows['keyClientesInternos']."',
        '".$myrows['cantidadTotal']."',
'".$cantidadSurtida[$i]."','".$cantidadSurtida[$i]."'+cantidadAcumulada,

'".$rand."',
'".$usuario."',
'".$fecha1."' )";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

 //***********************************************













//*****************************************************************************
$sSQL333a= "SELECT
MAX(keyCVI)+1 as CVI
FROM contadorVentasInternas
WHERE entidad='".$entidad."'   ";

$result333a=mysql_db_query($basedatos,$sSQL333a);
$myrow333a = mysql_fetch_array($result333a);

if(!$myrow333a['CVI']){
$myrow333a['CVI']=1;
}

//********************************SE INCREMENTA EN 1***************************

$sSQLs1= "SELECT
*
FROM
articulosPrecioNivel
where
entidad='".$entidad."'
and
almacen='".$_GET['almacen']."'
and
keyPA='".$keyPA[$i]."'
";
$results1=mysql_db_query($basedatos,$sSQLs1);
$myrows1 = mysql_fetch_array($results1);


$agrega = "INSERT INTO contadorVentasInternas (
usuario,entidad
) values (
'".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();









//echo 'externo';
$agrega1 = "INSERT INTO transaccionesVentas (
numTransaccion,keyCAP,cantidad,descripcionArticulo,precioVenta,iva,
cantidadParticular,ivaParticular,
cantidadAseguradora,ivaAseguradora,usuario,hora,fecha,entidad,
keyClientesInternos,
folioVenta,almacen,status,gpoproducto,costo,tipomovimiento,keypa,codigo
) values (
'".$myrow333a['CVI']."','','".$myrows['cantidad']."',
    '".$myrows['descripcion']."',
    '".$myrow29['precioVenta']."','".$myrow29['iva']."',
        '".$myrow29['cantidadParticular']."',
'".$myrow29['ivaParticular']."','".$myrow29['cantidadAseguradora']."',
    '".$myrow29['ivaAseguradora']."','".$usuario."',
'".$hora1."','".$fecha1."','".$entidad."',
    '".$myrow29['keyClientesInternos']."',
'".$myrow29['folioVenta']."','".$_GET['almacen']."','venta',
    '".$myrows['gpoProducto']."','".$myrow29['costoHospital']."','salida',
        '".$keyPA[$i]."','".$myrows['codigo']."'

)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

//********************************************************************












}else{
 $info='Intenta cargar una cantidad menor...';
$status='fallo';
$q1 = "UPDATE faltantes
set
informacion='".$info."'
WHERE
entidad='".$entidad."'
        and
    usuario='".$_GET['usuario']."'
and
keyPA='".$keyPA[$i]."'
and
nOrden='".$_GET['solicitud']."'
    ";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}//validacion de cantidad mayor


}else{
 $info='Intenta cargar una cantidad menor...';
$status='fallo';
$q1 = "UPDATE faltantes
set
informacion='".$info."'
WHERE
entidad='".$entidad."'
        and
    usuario='".$_GET['usuario']."'
and
keyPA='".$keyPA[$i]."'
and
nOrden='".$_GET['solicitud']."'
    ";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$status='fallo';
}
}






}//cierra for

//*****************************************************************




//*****************************************************************


//cierra validacion
?>


<?php if($status=='fallo'){ ?>
<script>
window.alert("EL ARTICULO <?php echo   $articulo;?>ERROR AL ENVIAR, VERIFICA DATOS...!!");
</script>
<?php }else{





  $q1a = "UPDATE solicitudesDepartamentos
set
status='".$statusSolicitudes."'
    WHERE
entidad='".$entidad."'
    and
keySAL='".$_GET['solicitud']."'
";
mysql_db_query($basedatos,$q1a);
echo mysql_error();

  //****************************************


   // keyOrdenesR 	nOrden 	fecha 	hora 	usuario 	almacen 	entidad
    $agrega = "INSERT INTO ordenesResurtir (
nOrden,fecha,hora,usuario,almacen,entidad
) values (
'".$myrow52['keySol']."','".$fecha1."','".$hora1."',
'".$usuario."','".$_POST['almacenDestino']."','".$entidad."')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();

    ?>

<script>
window.alert("SE SURTIERON MEDICAMENTOS CON LA SOLICITUD #<?php echo $_GET['solicitud'];?>");
nueva('imprimirTraspaso.php?random=<?php echo $rand; ?>&orden=<?php echo $_GET['solicitud'];?>&usuario=<?php echo $_GET['usuario'];?>','ventana7','800','600','yes');
window.opener.document.forms["form1"].submit();
//window.close();
</script>
<?php } ?>


<?php
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



 <?php require("/configuracion/componentes/comboAlmacen.php"); include("/configuracion/funciones.php"); ?>
<form id="form1" name="form1" method="post" >
  <h1 align="center">Surtir Solicitudes a Granel</h1>
  <div align="center">

      <?php //echo 'Usuario Solicitante: '.$_GET['usuario'];?>

  </div>

  <img src="../../imagenes/bordestablas/borde1.png" width="517" height="24" />
  <table width="517" border="0.2" align="center" cellpadding="4" cellspacing="0">
        <tr bgcolor="#FFFF00">
      <th width="53" class="negromid">#</th>
      <th width="53" class="negromid">Mov</th>
      <th width="265" class="negromid" >Descripcion</th>
      <th  class="negromid">Disponible</th>
      <th  class="negromid">SolicitaU</th>
      <th  class="negromid">SolicitaT</th>
      <th  class="negromid">Surtido</th>
      <th  class="negromid">Pendiente</th>
      <th  class="negromid">Cargar</th>
    </tr>
    <tr>


<?php


$sSQL= "SELECT *
FROM

faltantes
where
entidad='".$entidad."'

and
almacenSolicitante='".$_GET['almacenSolicitante']."'
and
    keyPA='".$_GET['keyPA']."'
    and
    tipoVenta='Granel'
and
status='request'
group by keyPA
order by descripcion ASC
";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){
$bandera+=1;






$sSQL1= "SELECT descripcion
FROM

articulos
where
entidad='".$entidad."'
and
keyPA='".$myrow['keyPA']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "SELECT descripcionGP
FROM

gpoProductos
where
entidad='".$entidad."'
and
codigoGP='".$myrow['gpoProducto']."'  ";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);




//$sSQL2= "SELECT sum(cantidad) as s
//FROM
//
//faltantes
//where
//entidad='".$entidad."'
//and
//usuario='".$_GET['usuario']."'
//and
//nOrden='".$_GET['solicitud']."'
//    and
//    keyPA='".$myrow['keyPA']."'
//";
//$result2=mysql_db_query($basedatos,$sSQL2);
//$myrow2 = mysql_fetch_array($result2);



$sSQL2a= "SELECT sum(cantidad) as s
FROM

faltantes
where
entidad='".$entidad."'
and
        almacenSolicitante='".$_GET['almacenSolicitante']."'
and
keyPA='".$myrow['keyPA']."'
and
status='request'
and
tipoVenta='Granel'
";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);







$sSQL52a="SELECT almacen
FROM
almacenes
WHERE
entidad='".$entidad."'
and
centroDistribucion='si' ";
  $result52a=mysql_db_query($basedatos,$sSQL52a);
  $myrow52a = mysql_fetch_array($result52a);

  
  
  
  $sSQL52aa="SELECT existencia,cantidadSurtir,tipoVenta,cantidadTotal
FROM
existencias
WHERE
entidad='".$entidad."'
and
almacen='".$myrow52a['almacen']."'
and
keyPA='".$_GET['keyPA']."'
   
";
  $result52aa=mysql_db_query($basedatos,$sSQL52aa);
  $myrow52aa = mysql_fetch_array($result52aa);

$ct= $myrow52aa['cantidadTotal'];
$st=$myrow52aa['tipoVenta']*$myrow2a['s'];
  //$total= $myrow2['s']-$myrow2a['s'];
?>




<tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
	        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $bandera;?></td>

                <td bgcolor="<?php echo $color?>" class="normal">
                	    <?php

echo   $myrow['keyF'];

	  ?>
                </td>



<td height="24" bgcolor="<?php echo $color?>" class="normal">
<?php
if($myrow['descripcion']){
echo $myrow['descripcion'];
}else{
echo $myrow1['descripcion'];
}


?>

</td>
	  <td width="59" bgcolor="<?php echo $color?>" class="normal">
	    <?php

echo   $ct;

	  ?>
	  </td>
                
                	  <td width="59" bgcolor="<?php echo $color?>" class="normal">
	    <?php

echo   $st;

	  ?>
	  </td>
                
	  <input name="almacenSolicitante[]" type="hidden" value="<?php echo $myrow['almacenSolicitante'];?>" />
	   <input name="cantidadVendida[]" type="hidden" value="<?php echo $myrow['c'];?>" />
	  	  <input name="keyPA[]" type="hidden" value="<?php echo $myrow['keyPA'];?>" />
                  
                  
      <td width="59" bgcolor="<?php echo $color?>" class="normal"><?php

echo $myrow2a['s'];

	  ?></td>




      <td width="59" bgcolor="<?php echo $color?>" class="normal">



	 <label>
	<?php echo $myrow2a['s'];?>
	 </label>
</td>

      <td width="59" bgcolor="<?php echo $color?>" class="normal">



	 <label>
	<?php echo $total;?>
	 </label>
</td>

      <td width="59" bgcolor="<?php echo $color?>" class="normal">


	 <a   href="javascript:ventanaSecundaria8('resurtirInventarios.php?nOrden=<?php echo $myrow['nOrden']; ?>')"></a>


         
	 <label>
	 <input name="cantidadSurtida[]" type="text" size="5" maxlength="5" autocomplete="off"
<?php if( $total==0) echo 'readonly=""';?>
                />
	 </label>
</td>
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" width="517" height="24" />
  <div align="center">
    <label><br />
	<?php if($bandera>=1){ ?>
    <input name="surtir" type="submit" id="surtir" value="cargar"  />
	<?php } ?>
    </label>
  </div>
  <label>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>
</body>
</html>