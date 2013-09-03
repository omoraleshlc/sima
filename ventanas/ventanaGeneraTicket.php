<?php require("/configuracion/ventanasEmergentes.php"); ?>


<?php
if($_POST['cambiar'] and $_POST['status'] and $_GET['keyR'] ){

$q1 = "UPDATE clientesInternos set 
ticket='".$_POST['ticket']."'
WHERE 
entidad='".$entidad."'
    and
ticket= '".$_GET['keyR']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();






//*******TRASPASO AL MODULO DE FACTURACION AUTOMATICO*******
$_GET['folioVenta'];

        $sSQLef= "SELECT
             *
             FROM
             cargosCuentaPaciente
             WHERE 
             entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
             and
             gpoProducto!=''
             and 
             cantidadParticular>0
             ";



 
$resultef=mysql_db_query($basedatos,$sSQLef);
$myrowef = mysql_fetch_array($resultef);

if($myrowef['cantidadParticular']>0){

if($myrow1d['statusDevolucion']!='si'){
//GENERO LA SOLICITUD
$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
contadorFacturas
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}
//asigno valor
$_GET['numSolicitud']=$n;

$agrega = "INSERT INTO contadorFacturas (
usuario,contador,entidad
) values (
'".$usuario."','".$n."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




//ACTUALIZAR ENCABEZA
$actualiza = "UPDATE facturaGrupos
set
numFactura='".$_POST['numFactura']."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
//mysql_db_query($basedatos,$actualiza);
echo mysql_error();
//CIERRA ACTUALIZA
    
  
$sSQL2= "Select * From RFC WHERE RFC like '%$rfc%'   ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

$sSQL2a= "Select * From datosfacturacion WHERE entidad='".$entidad."' and numSolicitud='".$_GET['numSolicitud']."'  ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);

if(!$myrow2a['numSolicitud'] ){
 $sql0 = "INSERT INTO datosfacturacion
(razonSocial,
		calle,
	 	colonia,
	 	ciudad,
	 	estado,
	 	cp,
	 	delegacion,
	 	pais,
	 	entidad,
	 	rfc,
	 	calle1,
	 	numFactura,numSolicitud
                )
values
(
'".$myrow2['razonSocial']."',
'".$myrow2['calle']."','".$myrow2['colonia']."',
    '".$myrow2['ciudad']."','".$myrow2['estado']."',
    '".$myrow2['cp']."','".$myrow2['delegacion']."',
        '".$myrow2['pais']."','".$entidad."','".$myrow2['RFC']."',
            '".$myrow2['calle1']."','".$_POST['numFactura']."','".$_GET['numSolicitud']."')

";

mysql_db_query($basedatos,$sql0);
echo mysql_error();
}

    
    
    
    
    
    
    
$_POST['flag1']=1;    
    
         
             $sSQL= "SELECT
             *
             FROM
             cargosCuentaPaciente
             WHERE 
             entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
             and
             gpoProducto!=''
             
             ";



 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){   
     $sql5da= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
folioVenta='".$_GET['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."'
    and
    keyCAP='".$myrow['keyCAP']."'

";
$result5da=mysql_db_query($basedatos,$sql5da);
$myrow5da= mysql_fetch_array($result5da);    
    






$agrega = "INSERT INTO facturasAplicadas (
numSolicitud,folioVenta,cantidad,
importe,iva,gpoProducto,descripcionArticulo,
descripcionGrupo,entidad,status,fecha,hora,numFactura,
codigo,naturaleza,keyCAP,usuario

)
values 
(

'".$_GET['numSolicitud']."','".$_GET['folioVenta']."','".$myrow['cantidad']."',
'".$myrow['cantidadParticular']."','".$myrow['ivaParticular']."','".$myrow['gpoProducto']."',
    '".$myrow['descripcionArticulo']."','".$myrow['descripcionGrupoProducto']."',
        '".$entidad."','request','".$fecha1."','".$hora1."','',
            '".$myrow['codProcedimiento']."','".$myrow['naturaleza']."',
                '".$myrow['keyCAP']."','".$usuario."'
        
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agregaron Folios de Venta';

} //cierra while




//TERMINA DE AGREGAR A FACTURAS APLICADAS

$sSQLab= "SELECT * FROM entidades where codigoEntidad='".$entidad."' ";
    $resultab=mysql_db_query($basedatos,$sSQLab);
    $myrowab = mysql_fetch_array($resultab); 
if($myrowab['digitosFactura']>0){
   
    $sSQLaa= "SELECT contador from contadorSeriesFacturas where 
    entidad='".$entidad."'
    and    
    numSolicitud='".$_GET['numSolicitud']."'   and tipoFactura='efectivo' ";
    $resultaa=mysql_db_query($basedatos,$sSQLaa);
    $myrowaa = mysql_fetch_array($resultaa);          
    
    
 if(!$myrowaa['contador']){
    //GENERAR FACTURA
    $q4 = "

    INSERT INTO contadorSeriesFacturas(contador, usuario,entidad,numSolicitud,tipoFactura)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorSeriesFacturas where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$_GET['numSolicitud']."','efectivo'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
    
    

    
    
    $sSQLac= "SELECT contador as topeMaximo from contadorSeriesFacturas where 
    entidad='".$entidad."'
    and    
    numSolicitud='".$_GET['numSolicitud']."' and tipoFactura='efectivo'   ";
    $resultac=mysql_db_query($basedatos,$sSQLac);
    $myrowac = mysql_fetch_array($resultac); 
    //echo $myrowac['topeMaximo'];
    //echo '<br>';
    $digitos= strlen($myrowac['topeMaximo']);
    $totalDigitos=$myrowab['digitosFactura']-$digitos;
    $totalDigitos='%0'.$totalDigitos.'s';
    $digtosCompilados = sprintf($totalDigitos, $var); 
    
    $numFactura= $myrowab['prefijoEfectivo'].$digtosCompilados.$myrowac['topeMaximo'];
    
    
    
   $actualiza = "UPDATE facturaGrupos
set
status='facturado',numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

 $actualiza1 = "UPDATE facturasAplicadas
set
status='facturado',numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza1);
echo mysql_error();


 $actualiza2 = "UPDATE datosfacturacion
set

numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza2);
echo mysql_error();

//echo '<script>';
//echo 'window.alert("SE GENERO LA FACTURA: '.$numFactura.'");';
//echo '</script>';
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='FOLIO(s) FACTURADOS..';

    //****GENERAR TICKET******
    $qTi = "

    INSERT INTO contadorTicket(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorTicket where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$myrow1d['keyClientesInternos']."'

    ";
    mysql_db_query($basedatos,$qTi);
    echo mysql_error();

    //************************
    
    $sSQLT= "SELECT contador as topeMaximo from contadorTicket where entidad='".$entidad."' and usuario='".$usuario."'order by keyCExt DESC   ";
    $resultT=mysql_db_query($basedatos,$sSQLT);
    $myrowT = mysql_fetch_array($resultT);
    $ticket= $myrowT['topeMaximo'];
    $tipoFacturacion='Auto';
    require("/configuracion/clases/generarFacturaElectronica.php");    
    
    
    
    
}else{
     echo '<script>window.alert("YA SE GENERO LA FACTURA!");</script>';
}

}else{
     echo '<script>window.alert("FAVOR  DE CONFIGURAR LA ENTIDAD PARA FACTURAR CORRECTAMENTE!");</script>';
}

}//solo entra aqui si no es devolucion
}//solo entra aqui si trae cantidad particular







//*******CIERRA MODULO DE FACTURACION********








?>
<script>
  <!--
    //window.opener.document.forms["form1"].submit();
    //window.close();
  // -->
</script>


<?php 
print 'Se hizo un movimiento...';
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


</head>

<body>
    <h1>
        Generar un ticket
    </h1>
<form id="form1" name="form1" method="post" action="">
  <table width="175" border="0" align="center">

    <tr>
<?php 
$sSQL11= "Select distinct * From cuartos
where entidad='".$entidad."' and departamento='".$_GET['almacen']."'
order by codigoCuarto ASC";



$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$b+=1;
$codCuarto=$myrow11['codigoCuarto'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



 $sSQL15="SELECT *
FROM
  `articulos`
WHERE
id_cuarto = '".$codCuarto."'  
  ";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);




//****************************Terminan las validaciones
?>
      <td ><label>
        <div align="center">Observaciones
        </div>
        <div align="center">
          <textarea name="observaciones" wrap="physical" id="observaciones" ></textarea>
        </div>
      </label></td>
    </tr>

  </table>
  <p align="center"><label>
  <input name="bandera" type="hidden" class="style7" value="<?php echo $b;?>" />
    <input name="cambiar" type="submit" class="style7" id="cambiar" value="Generar" />
  </label>
    <label></label>
  </p>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
