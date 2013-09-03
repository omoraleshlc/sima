<?PHP require("menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>



<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>







<?php



if($_POST['actualizar']  and $_POST['folioVenta'] and $_POST['numfactura']){


$folioVenta=$_POST['folioVenta'];
$_POST['cantidadAseguradora']='si';$_POST['trasladoNomina']='si';$_POST['otros']='si';$_POST['buscar']='si';
$_POST['keyMOV']=1;

///**************FACTURAS APLICADAS**************
$quitar= "
DELETE
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
and
seguro='".$_GET['numCliente']."'
and
(status='standby'  or status='request')
and
usuario='".$usuario."'
";
//smysql_db_query($basedatos,$quitar);
echo mysql_error();
//*********************************************


for($i=0;$i<=$_POST['flag'];$i++){




if($folioVenta[$i]){



$sql5a= "
SELECT facturacionEspecial,clientePrincipal
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$folioVenta[$i]."'
and
clientePrincipal!=''
";
$result5a=mysql_db_query($basedatos,$sql5a);
$myrow5a= mysql_fetch_array($result5a);
$numCliente=$myrow5a['clientePrincipal'];

//***************************

$sSQL2= "Select * From clientes WHERE entidad='".$entidad."'  and numCliente ='".$numCliente." '  ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


$sSQL2a= "Select * From datosfacturacion WHERE entidad='".$entidad."' and numfactura='".$_POST['numfactura']."' and rfc ='".$myrow2['rfc']." '  ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);

if(!$myrow2a['RFC'] and $myrow2['rfc']){
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
	 	numFactura
                )
values
(
'".$myrow2['razonSocial']."',
'".$myrow2['calle']."','".$myrow2['colonia']."',
    '".$myrow2['ciudad']."','".$myrow2['estado']."',
    '".$myrow2['cp']."','".$myrow2['delegacion']."',
        '".$myrow2['pais']."','".$entidad."','".$myrow2['rfc']."',
            '".$myrow2['calle1']."','".$_POST['numfactura']."')

";

mysql_db_query($basedatos,$sql0);
echo mysql_error();
}
//****************************



$sql5= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$folioVenta[$i]."'
and
keyMOV='".$_POST['keyMOV']."'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);



if(!$myrow5['folioVenta']){

//******************************************************************


//***********************************************************************
//PARTICULAR SOLAMENTE
if($_POST['trasladoNomina']){


$sSQLHaberN= "
SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as haber
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and


folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='A'
and
gpoProducto=''
and
tipoPago='Nomina'
";
$resultHaberN=mysql_db_query($basedatos,$sSQLHaberN);
$myrowHaberN = mysql_fetch_array($resultHaberN);





$sSQLDebeN= "
SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as debe
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and


folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='C'
and
gpoProducto=''
and
tipoPago='Nomina'
";
$resultDebeN=mysql_db_query($basedatos,$sSQLDebeN);
$myrowDebeN = mysql_fetch_array($resultDebeN);

$nomina=$myrowHaberN['haber']-$myrowDebeN['debe'];
}

















  //***********************************************************************
//Otros SOLAMENTE
if($_POST['otros']){


$sSQLHaberO= "
SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as haber
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='A'
and
gpoProducto=''
and
tipoPago='Otros'
and
clientePrincipal='".$numCliente."'
";
$resultHaberO=mysql_db_query($basedatos,$sSQLHaberO);
$myrowHaberO = mysql_fetch_array($resultHaberO);





$sSQLDebeO= "
SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as debe
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='C'
and
gpoProducto=''
and
tipoPago='Otros'
and
clientePrincipal='".$numCliente."'
";
$resultDebeO=mysql_db_query($basedatos,$sSQLDebeO);
$myrowDebeO = mysql_fetch_array($resultDebeO);

$otros=$myrowHaberO['haber']-$myrowDebeO['debe'];
}














 //***********************************************************************
//PARTICULAR SOLAMENTE
if($_POST['cantidadParticular']){




$sSQLHaberP= "
SELECT
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as haber
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='A'
and
gpoProducto=''
and
(tipoPago!='Nomina' and tipoPago!='Cortesia' and tipoPago!='descuentoParticular' and tipoPago!='Beneficencia' and tipoPago!='Otros')
";
$resultHaberP=mysql_db_query($basedatos,$sSQLHaberP);
$myrowHaberP = mysql_fetch_array($resultHaberP);





$sSQLDebeP= "
SELECT
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as debe
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and


folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='C'
and
gpoProducto=''
and
(tipoPago!='Nomina' and tipoPago!='Cortesia' and tipoPago!='descuentoParticular' and tipoPago!='Beneficencia' and tipoPago!='Otros')
";
$resultDebeP=mysql_db_query($basedatos,$sSQLDebeP);
$myrowDebe = mysql_fetch_array($resultDebeP);


$sSQLdP= "
SELECT
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as descuento
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and


statusDescuento='si'   ";
$resultdP=mysql_db_query($basedatos,$sSQLdP);
$myrowdP = mysql_fetch_array($resultdP);



$sSQLncP= "
SELECT
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as notaCredito
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and
gpoProducto!=''
and
naturaleza='C'
and
notaCredito='si'
";
$resultncP=mysql_db_query($basedatos,$sSQLncP);
$myrowncP = mysql_fetch_array($resultncP);

$cantidadParticular=($myrowHaberP['haber'])-($myrowDebeP['debe']+$myrowdP['descuento']+$myrowncP['notaCredito']);
}
//************************************************************************

















//***********************************************************************

if($_POST['cantidadAseguradora']){
//CANTIDAD ASEGURADORA

$sSQLded= "
SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as coaseguro
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
    and
    (tipoTransaccion='pcoa1' or tipoTransaccion='pcoa2' or tipoTransaccion='pdedu1' or tipoTransaccion='pdedu2')
and
folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='A'

";
$resultded=mysql_db_query($basedatos,$sSQLded);
$myrowded = mysql_fetch_array($resultded);



$sSQLHaberA= "
SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as haber
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$numCliente."'
and

folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='A'
and
gpoProducto=''
and
(tipoPago='Cuentas por Cobrar' or tipoPago='Otros')
";
$resultHaberA=mysql_db_query($basedatos,$sSQLHaberA);
$myrowHaberA = mysql_fetch_array($resultHaberA);





$sSQLDebeA= "
SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as debe
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$numCliente."'
and

folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='C'
and
gpoProducto=''
and
(tipoPago='Cuentas por Cobrar' or tipoPago='Otros')
";
$resultDebeA=mysql_db_query($basedatos,$sSQLDebeA);
$myrowDebeA = mysql_fetch_array($resultDebeA);


$sSQLdA= "
SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as descuento
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and


statusDescuento='si'   ";
$resultdA=mysql_db_query($basedatos,$sSQLdA);
$myrowdA = mysql_fetch_array($resultdA);



$sSQLncA= "
SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as notaCredito
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and
gpoProducto!=''
and
naturaleza='C'
and
notaCredito='si'
";
$resultncA=mysql_db_query($basedatos,$sSQLncA);
$myrowncA = mysql_fetch_array($resultncA);

$cantidadAseguradora=(($myrowHaberA['haber'])-($myrowDebeA['debe']+$myrowdA['descuento']+$myrowncA['notaCredito']))+$myrowded['coaseguro'];
}
//************************************************************************
























$importeaFacturar= $cantidadAseguradora+$cantidadParticular+$nomina+$otros;
//************************************************************************





//************************IMPORTE TOTAL CUENTA ***********************
if($otros!=NULL){
$sSQLic= "
SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as cargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='C'
and
gpoProducto!=''
";
$resultic=mysql_db_query($basedatos,$sSQLic);
$myrowic = mysql_fetch_array($resultic);



$sSQLia= "
SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and
gpoProducto!=''
and
naturaleza='A'
";
$resultia=mysql_db_query($basedatos,$sSQLia);
$myrowia = mysql_fetch_array($resultia);
}else{
  $sSQLic= "
SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as cargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and
naturaleza='C'
and
gpoProducto!=''
";
$resultic=mysql_db_query($basedatos,$sSQLic);
$myrowic = mysql_fetch_array($resultic);



$sSQLia= "
SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta =  '".$folioVenta[$i]."'
and
gpoProducto!=''
and
naturaleza='A'
";
$resultia=mysql_db_query($basedatos,$sSQLia);
$myrowia = mysql_fetch_array($resultia);
}
//*******************************************************







$totalCuenta= $myrowic['cargos']-$myrowia['devoluciones'];
//********************************************************************************************************
//********************************************************************************************************

 $porcentaje=$importeaFacturar/$totalCuenta;

$agrega = "INSERT INTO facturasAplicadas (
entidad,numFactura,nT,usuario,fecha,hora,keyMov,keyCF,importe,seguro,folioVenta,status,facturacionEspecial,porcentaje)
values ('".$entidad."','".$_POST['numfactura']."',
'','".$usuario."','".$fecha1."','".$hora1."','".$_POST['keyMOV']."','','".$importeaFacturar."','".$numCliente."',
'".$folioVenta[$i]."','facturado' ,'".$myrow5a['facturacionEspecial']."' ,'".$porcentaje."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



//*************************AGREGAR DATOS DIRECTAMENTE*********************

$sql5a= "
SELECT *
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$folioVenta[$i]."'
and
gpoProducto!=''


";
$result5a=mysql_db_query($basedatos,$sql5a);
while($myrow5a= mysql_fetch_array($result5a)){










if($otros!=NULL){
$importeCP=($myrow5a['cantidadParticular']*$myrow5a['cantidad'])*$porcentaje;
//$total=($myrow5a['precioVenta']*$myrow5a['cantidad']);
$importe=$importeCP;
//echo '<br>';
//$iva=($myrow5a['iva']*$myrow5a['cantidad']);
$ivaCP=($myrow5a['ivaParticular']*$myrow5a['cantidad'])*$porcentaje;

}else{
$importeCP=($myrow5a['cantidadAseguradora']*$myrow5a['cantidad'])*$porcentaje;
//$total=($myrow5a['precioVenta']*$myrow5a['cantidad']);
$importe=$importeCP;
//echo '<br>';
//$iva=($myrow5a['iva']*$myrow5a['cantidad']);
$ivaCP=($myrow5a['ivaAseguradora']*$myrow5a['cantidad'])*$porcentaje;
}

$it=$importe;
$ivT=$ivaCP;




//***********VALIDA GRUPOS PARA INSERTAR
$sql5= "
SELECT *
FROM
facturaGrupos
WHERE
keyCAP='".$myrow5a['keyCAP']."'
    and
    keyCAPMOV='".$_POST['keyMOV']."'
 ";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
//CIERRA VALIDACION DE GRUPOS


if(!$myrow5['keyCAP']){

 $agrega = "INSERT INTO facturaGrupos (
entidad,numFactura,gpoProducto,extension,folioVenta,status,importe,iva,tipoTransaccion,keyCAP,naturaleza,keyCAPMov)
values ('".$entidad."','".$_POST['numfactura']."','".$myrow5a['gpoProducto']."',1,'".$folioVenta[$i]."',
    'facturado' ,'".$it."' ,'".$ivT."','".$myrow5a['tipoPago']."' , '".$myrow5a['keyCAP']."'  ,'".$myrow5a['naturaleza']."',
        '".$_POST['keyMOV']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{
 $actualiza = "UPDATE facturaGrupos
set
importe='".$it."',
iva='".$ivT."'
where

keyCAP='".$myrow5['keyCAP']."'

";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

}//insertar

}

//*****************************************************************************


}
}
}
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agregaron Folios de Venta';
?>
<script>
//window.close();
</script>
<?php

}




?>




 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>





<form id="form10" name="form10" method="post" action="#">
  <h1 align="center" >FOLIOS *NO* FACTURADOS</h1>
  <table width="275" class="table-forma">

    <tr>
      <td width="94" height="45"><label>
      <label> Fecha Inicial</label></td>
  
      <td width="171"><label>
        <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
 </label>
   <input name="button" type="button"  id="lanzador" value="..." />

      </label></td>
    </tr>


          <tr>
            <td width="94"><label>
            <label> Fecha Final</label></td>

      <td width="171"><label>
        <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
  </label>
   <input name="button" type="button"  id="lanzador1" value="..." />

      </label></td>
    </tr>

  </table>
<br />
   <label>
   <input name="buscar" type="submit"  id="button" value="Buscar" />
   </label>





     
     
     
     
     
     
     
     <?php if($_POST['buscar'] ){ ?>

  <p align="center" >&nbsp;</p>

  <table width="716" class="table table-striped" >
    <tr >
      <th width="10"  scope="col"><div align="left">#</div></th>
     <th width="20"  scope="col"><div align="left">Fecha</div></th>
      <th width="20"  scope="col"><div align="left">Folio</div></th>
  <th width= "233"  scope="col"><div align="left">Aseguradora</div></th>
   	  <th  scope="col"><div align="left">Importe</div></th>
	  <th  scope="col"><div align="left">IVA</div></th>
	  

    </tr>
    <tr>



<?php	


$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
fechaCierre>='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."'
and
clientePrincipal!=''
and
statusDevolucion!='si'
and

statusCuenta='cerrada'
and
descripcionClientePrincipal!=''

group by folioVenta
order by folioVenta ASC

 ";

 
 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$nT=$myrow['keyClientesInternos'];





//*************************OPERACIONES*****************************



//
// $sSQL71="SELECT
//sum(precioVenta*cantidad) as acumulado,sum(iva*cantidad) as ivaa
//  FROM
//cargosCuentaPaciente
//  WHERE
//entidad='".$entidad."'
//and
//folioVenta='".$myrow['folioVenta']."'
//and
//naturaleza='C'
// and
// gpoProducto!=''
//  ";
//
//  $result71=mysql_db_query($basedatos,$sSQL71);
//  $myrow71 = mysql_fetch_array($result71);
//
//
//
//
//  $sSQL7d1="SELECT
//sum(precioVenta*cantidad) as acumulado,sum(iva*cantidad) as ivaa
//  FROM
//cargosCuentaPaciente
//  WHERE
//entidad='".$entidad."'
//and
//folioVenta='".$myrow['folioVenta']."'
//and
//naturaleza='A'
//and
// gpoProducto!=''
//  ";
//
//  $result7d1=mysql_db_query($basedatos,$sSQL7d1);
//  $myrow7d1 = mysql_fetch_array($result7d1);
//
//
//
//
$sSQL7a="SELECT
*
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."'
and
status='facturado'
";

  $result7a=mysql_db_query($basedatos,$sSQL7a);
  $myrow7a = mysql_fetch_array($result7a);








// $sSQL7d="SELECT
//SUM(facturaGrupos.importe) as acumulado,sum(facturaGrupos.iva) as ivaa
//  FROM
//facturasAplicadas,facturaGrupos
//  WHERE
//facturasAplicadas.entidad='".$entidad."'
//and
//  facturasAplicadas.folioVenta='".$myrow['folioVenta']."'
//and
//  facturaGrupos.naturaleza='A'
//  and
//  facturaGrupos.numFactura=facturasAplicadas.numFactura
//  ";
//
//  $result7d=mysql_db_query($basedatos,$sSQL7d);
//  $myrow7d = mysql_fetch_array($result7d);
//********************************************************************
	  ?>
      <td height="24" bgcolor="<?php echo $color?>" ><div align="left"><?php echo $a;?></div></td>
      <td height="24" bgcolor="<?php echo $color?>" ><div align="left"><?php echo cambia_a_normal($myrow['fechaCierre']);?></div></td>

<td height="24" bgcolor="<?php echo $color?>" ><div align="left"><?php echo $myrow['folioVenta'];?></div></td>


      <td width="233" bgcolor="<?php echo $color?>" >
        <div align="left">
          <?php 
//	  	  if($myrow['seguro']){
//		   $numCliente= $myrow['seguro'];
//		   $sSQL17= "
//	SELECT
//*
//FROM
//clientes
//WHERE
//entidad='".$entidad."'
//    and
//numCliente = '".$numCliente."'
//";
//$result17=mysql_db_query($basedatos,$sSQL17);
//$myrow17 = mysql_fetch_array($result17);
//		 echo $myrow17['nomCliente'];
//		  } else {
//		  echo "Sin Seguro";
//		  }

                  echo $myrow['descripcionClientePrincipal'];
                  echo '</br>';
                   echo $myrow['statusFactura'];
?>
      </span></div></td>











<td width="91" bgcolor="<?php echo $color?>" >




<div align="center" >
  <div align="left">
    <?php
echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
?>
  </div>
</div></td>













<td width="64" bgcolor="<?php echo $color?>" ><div align="center" >
  <div align="left">
    <?php
echo '$'.number_format($myrow['iva']*$myrow['cantidad'],2);
?>
  </div>
</div></td>

















    </tr> 
    <?php  }}}?>
    <input name="flag" type="hidden" value="<?php echo $a;?>" />
  </table>


  <p>&nbsp;</p>


      <input type="submit" name="actualizar" value="Enviar Datos"></input>


</form>


<script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario
});
</script>
    <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
</body>

</html>