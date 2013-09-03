<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); 
$numCliente=$_GET['numCliente'];
$medico=$_GET['medico'];
?>

<?php
$sql5= "
SELECT nomCliente,numCliente,clientePrincipal
FROM
clientes
WHERE
entidad='".$entidad."' AND
numCliente='".$_GET['numCliente']."'";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
$aseguradora=$myrow5['clientePrincipal'];
$seguro=$myrow5['numCliente'];
?>


<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventanaSecundaria4","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language="Javascript" type="text/javascript">
function ir_al_final() {
        document.body.scrollTop = document.body.offsetHeight;
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
           
        if( vacio(F.escoje.value) == null ) {   
                alert("Por Favor, escoje como quieres agregar art�culos!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<?php

if(!$_POST['actualizar'] and !$_POST['elimina'] and !$_POST['continue']){
    include("/configuracion/clases/generarSolicitudFactura.php");
}


?>



<?php 
if($_POST['actualizar']  and $_POST['folioVenta']){
$folioVenta=$_POST['folioVenta'];
$_POST['cantidadAseguradora']='si';$_POST['trasladoNomina']='si';$_POST['otros']='si';$_POST['buscar']='si';


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


for($i=0;$i<=$_POST['flag1'];$i++){




if($folioVenta[$i]){



$sql5a= "
SELECT facturacionEspecial
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$folioVenta[$i]."'
and
facturacionEspecial='si'
group by folioVenta
";
$result5a=mysql_db_query($basedatos,$sql5a);
$myrow5a= mysql_fetch_array($result5a);


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
clientePrincipal='".$_GET['numCliente']."'
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
clientePrincipal='".$_GET['numCliente']."'
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

$cantidadAseguradora=(($myrowHaberA['haber'])-($myrowDebeA['debe']+$myrowdA['descuento']+$myrowncA['notaCredito']))+$myrowded['coaseguro']+$myrowdA['descuento'];
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
values ('".$entidad."','',
'','".$usuario."','".$fecha1."','".$hora1."','".$_POST['keyMOV']."','','".$importeaFacturar."','".$seguro."',
'".$folioVenta[$i]."','request' ,'".$myrow5a['facturacionEspecial']."' ,'".$porcentaje."')";
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
values ('".$entidad."','".$_POST['folioFactura']."','".$myrow5a['gpoProducto']."',1,'".$folioVenta[$i]."',
    'request' ,'".$it."' ,'".$ivT."','".$myrow5a['tipoPago']."' , '".$myrow5a['keyCAP']."'  ,'".$myrow5a['naturaleza']."',
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
//mysql_db_query($basedatos,$actualiza);
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























<?php 

if($_POST['elimina'] and $_POST['keyAPF']){

$keyAPF=$_POST['keyAPF'];


for($i=0;$i<$_POST['flag2'];$i++){

if($keyAPF[$i]){
$sql5= "
SELECT *
FROM
facturasAplicadas

WHERE keyAPF='".$keyAPF[$i]."'  ";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
//***************************************
$borrame1 = "DELETE FROM facturaGrupos WHERE entidad='".$myrow5['entidad']."' and folioVenta='".$myrow5['folioVenta']."' and keyCAPMov='".$_POST['keyMOV']."' ";
mysql_db_query($basedatos,$borrame1);
echo mysql_error();
//************************************************************




//***************************************
$borrame = "DELETE FROM facturasAplicadas WHERE keyAPF='".$keyAPF[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
//************************************************************




}

}
$tipoMensaje='error';
$encabezado='Exitoso';
$texto='Se desactivaron folios de venta';
}

?>







<?php if($_POST['continue']){ ?>

<script>
javascript:ventanaSecundaria4('escojerImporte.php?numCliente=<?php echo $_GET['numCliente'];?>&nombreCliente=<?php echo $_GET['nombreCliente'];?>&keyMOV=<?php echo $_POST['keyMOV'];?>');

//opener.location.reload();


window.close();
</script>

<?php 
}
?>





  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>

<body>
<p align="center" class="titulomedio">
  <label>
      <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>
  <?php
$sql5= "
SELECT nomCliente,numCliente,clientePrincipal
FROM
clientes
WHERE
entidad='".$entidad."' AND
clientePrincipal='".$_GET['numCliente']."'";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

?>
  Escoje los Folios de Venta que desees Facturar:<br />
  <label class="precio2">Compania: <?php echo $_GET['nombreCliente'];?></label></p>
  
<form name="dividirCuentas"  method="post">
  
    
<p align="center" class="negromid">
  <label>
  Tipo de Paciente
  <select name="tipoPaciente" class="camposmid" id="tipoPaciente" onChange="this.form.submit();" >
  <option value="">Escojer</option>
    <option
    <?php if($_POST['tipoPaciente']=='Interno')echo 'selected=""';?>
     value="Interno">Interno</option>
    <option
        <?php if($_POST['tipoPaciente']=='Externo')echo 'selected=""';?>
     value="Externo">Externo</option>
  </select>
  </label>
</p>


<p align="center" class="negromid">&nbsp;</p>
<?php /*?>
<table width="305" border="0" align="center" class="normal">

    <tr>
    <td>Cantidad Particular </td>
    <td><span class="negromid">
      <input name="cantidadParticular" type="checkbox" id="escoje" value="si" <?php if($_POST['cantidadParticular']=='si')echo 'checked=""';?> disabled="si"/>
    </span></td>
  </tr>


  <tr>
    <td>Cantidad Aseguradora </td>
    <td><span class="negromid">
      <label></label>
      <input name="cantidadAseguradora" type="checkbox" id="escoje" value="si" <?php if($_POST['cantidadAseguradora']=='si')echo 'checked=""';?> />
    </span></td>
  </tr>

    
  <tr>
    <td>&iquest;Incluir Traslados a Nomina?
        <label> </label></td>
    <td><span class="negromid">
      <input type="checkbox" name="trasladoNomina" value="si" <?php if($_POST['trasladoNomina']=='si')echo 'checked=""';?> />
    </span></td>
  </tr>



  <tr>
    <td>Otros</td>
    <td><span class="negromid">
      <input name="otros" type="checkbox" id="otros" value="si" <?php if($_POST['otros']=='si')echo 'checked=""';?> />
    </span></td>
  </tr>



    <tr>
    <td width="237"><input name="buscar" class="normal" type="submit" id="button2" value="Actualizar Datos" <?php //if(!$_POST['tipoPaciente'])echo 'disabled=""'; ?>/></td>
    <td width="58"><label>
      </label>
      <label>
      
        <div align="center"></div>        </label></td>

    </tr>


    
</table>
<?php */ 

$_POST['cantidadAseguradora']='si';$_POST['trasladoNomina']='si';$_POST['otros']='si';$_POST['buscar']='si';
?>



<?php if(($_POST['tipoPaciente'] and ($_POST['buscar'] or $_POST['continue'] or $_POST['actualizar'] or $_POST['elimina']))  and 
($_POST['cantidadParticular'] or $_POST['cantidadAseguradora'] or $_POST['trasladoNomina'] or $_POST['otros'])){ ?>
<img src="/sima/imagenes/bordestablas/borde1.png" alt="" width="1036" height="24" align="center"/>
<table width="1036" height="84" border="0" align="center" cellpadding="4" cellspacing="0">
      <tr bgcolor="#330099">
        <th width="75" height="20" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left" class="none">
          <div align="center">FV</div>
        </div></th>
        <th width="85" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left" class="none">
          <div align="center">Fecha</div>
        </div></th>
        <th width="273" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left" class="none">
          <div align="center">Paciente</div>
        </div></th>
   
   
   
        <th width="70" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left" class="none">
          <div align="center">total</div>
        </div></th>
        <th width="43" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left" class="none">
          <div align="center">TPX</div>
        </div></th>

        <th width="48" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left" class="none">
          <div align="center">Escoje</div>
        </div></th>
        <th width="57" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left" class="none">
          <div align="center">Elimina</div>
        </div></th>
    </tr>
      <tr bgcolor="#FFFF99">
<?php	
if($_POST['buscar'] or $_POST['tipoPaciente'] or $_POST['continue'] or $_POST['actualizar'] or $_POST['elimina'] ){



if($_POST['tipoPaciente']=='Interno'){
 $sSQL= "SELECT
 *
FROM
  cargosCuentaPaciente
   WHERE 
   entidad='".$entidad."'
   and
   (fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
   and
   clientePrincipal='".$_GET['numCliente']."'
   and
   (tipoPaciente='interno'  or tipoPaciente='urgencias')
   and
  statusCuenta='cerrada'

  group by folioVenta
order by fecha1 DESC
 ";
 } else {
 
 
$sSQL= "SELECT 
 *
FROM
  cargosCuentaPaciente
   WHERE 
   entidad='".$entidad."'
   and
(   fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
 and
   clientePrincipal='".$_GET['numCliente']."'
   
   and

   tipoPaciente='externo'


  group by folioVenta
order by fecha1 DESC
 ";
}


 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;


if(!$keyMOV){
   $keyMOV=$_POST['keyMOV'];
}

if($_POST['keyMOV']>0){
 $sql5= "
SELECT status,keyAPF
FROM
facturasAplicadas
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$myrow['folioVenta']."'
and
status='request'
and
keyMOV='".$keyMOV."'

";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
}


$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$myrow['folioVenta']."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" > 
        <td height="56" class="precio2">
          <label>
          <div align="center">
            <?php 
					echo $myrow['folioVenta'];
		?>
          </div>
          </label>
      </span></td>
      <td class="normalmid">
          <div align="center">
            <?php  
		
		
		
		
		  if($_POST['tipoPaciente']=='Interno'){
		  echo cambia_a_normal($myrow['fechaCierre']);
		  }else{
		  echo cambia_a_normal($myrow['fecha1']);
		  }
		?>
        </div>
        </span></td>
        <td class="normalmid">
                <div align="left">
                  <?php  echo $myrow3['paciente'];

                  if($myrow3['facturacionconfigurada']=='si'){
                      echo '<br>';
                      echo '<span class="precio1">-Facturacion Configurada-</span>';
                      echo '<br>';
                  }

                  ?>
                  
                  <?php if($myrow5['status']=='request'){ ?>
				  <br />
                  <span class="normal"> [en proceso para facturar..]</span>
                  <?php }?>
                  <br />





				  <?php 
				  	 $sSQLalm="SELECT 
descripcion
  FROM
almacenes
  WHERE
entidad='".$entidad."'
and
almacen='".$myrow3['almacen']."'
  ";
 
  $resultalm=mysql_db_query($basedatos,$sSQLalm);
  $myrowalm = mysql_fetch_array($resultalm);
				  echo '['.$myrowalm['descripcion'].']';?>
                </span></div></td>
		
<?php 



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


folioVenta =  '".$myrow['folioVenta']."'
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


folioVenta =  '".$myrow['folioVenta']."'
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

folioVenta =  '".$myrow['folioVenta']."'
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


folioVenta =  '".$myrow['folioVenta']."'
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
//CANTIDAD ASEGURADORA




$sSQLHaberP= "
SELECT 
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as haber
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta =  '".$myrow['folioVenta']."'
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

folioVenta =  '".$myrow['folioVenta']."'
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
folioVenta =  '".$myrow['folioVenta']."'
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
folioVenta =  '".$myrow['folioVenta']."'
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
folioVenta =  '".$myrow['folioVenta']."'
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
clientePrincipal='".$_GET['numCliente']."'
and

folioVenta =  '".$myrow['folioVenta']."'
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
clientePrincipal='".$_GET['numCliente']."'
and

folioVenta =  '".$myrow['folioVenta']."'
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
folioVenta =  '".$myrow['folioVenta']."'
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
folioVenta =  '".$myrow['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'
and
notaCredito='si'
";
$resultncA=mysql_db_query($basedatos,$sSQLncA);
$myrowncA = mysql_fetch_array($resultncA);

$cantidadAseguradora=($myrowHaberA['haber']-$myrowDebeA['debe'])+$myrowncA['notaCredito']+$myrowded['coaseguro']+$myrowdA['descuento'];
}
//************************************************************************
























$importeaFacturar= $cantidadAseguradora+$cantidadParticular+$nomina+$otros;
//
?>



		
    
     
        <td class="normalmid"><div align="left"><?php echo '$'.number_format($importeaFacturar,2);?></div></td>
		  <input name="importeaFacturar[]" type="hidden" id="importeaFacturar[]" value="<?php echo ($myrow14a['total']+$myrow14n['total'])-(($myrow14c['total']+$myrow14des['total'])-$myrownc['total']); ?>"  />
<?php // echo ($myrow14a['total']+$myrow14n['total'])-(($myrow14c['total']+$myrow14des['total'])-$myrownc['total']); 

?>

		    <input name="totalCuenta[]" type="hidden" id="totalCuenta[]" value="<?php echo $myrowic['cargos']-$myrowia['devoluciones']; ?>"  />
        <td class="normalmid">
          <div align="center">
            <?php  echo $myrow['tipoPaciente'];
		?>
          </div>
          </span></td>
      

        <td class="Estilo24">
          <div align="center">
            <?php if($importeaFacturar>0 && $myrow5['status']==''){$flag1+=1;?>        
            <input name="folioVenta[]" type="checkbox" id="folioVenta[]" value="<?php echo $myrow['folioVenta']; ?>" <?php echo $mensaje;?> />
            <?php } else{ echo '---';}?>        
          </div></td>
        <td class="Estilo24">
		  <div align="center">
		    <?php if($myrow5['status']=='request'){$teo+=1; ?>
		    <input name="foliosEscogidos[]" type="hidden" id="foliosEscogidos[]" value="<?php echo $myrow['folioVenta']; ?>"/>
		    <?php $flag2+=1;}?>
		    
		    
		    <input name="keyAPF[]" type="checkbox" id="keyAPF[]" value="<?php echo $myrow5['keyAPF']; ?>" <?php if($myrow5['status']==''){echo 'disabled=""';}?> />
	      </div></td>
    </tr>
      <?php  

	  }  //cierra while
	  ?>
  </table>
<img src="/sima/imagenes/bordestablas/borde2.png" alt="" width="1036" height="24" align="center"/>
<p align="center" class="error"><em> 
  
  
  <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php 
	}else{
	echo "No se encontraron registros..!";
	}
	?></em></p>





  <div align="center">

      <input name="almacenDestino" type="hidden" id="almacenDestino"  value="<?php echo $_POST['almacenDestino']; ?>" />
	 
	  
	  

	  <input name="almacenDestino1" type="hidden" id="almacenDestino1"  value="<?php echo $_POST['almacenDestino1']; ?>" />




	  <input name="search" type="hidden" id="search"  value="search" />


    <input name="flag" type="hidden"  value="<?php echo $flag2; ?>" />
      <?php if($bandera>=1){ ?>
      <input name="actualizar" type="submit" id="actualiza" value="Seleccionar Registros"  />
       <input name="elimina" type="submit" src="../../imagenes/btns/delregistro.png" id="actualiza2" value="Deseleccionar Registros" />
<input name="aseguradora" type="hidden"  value="<?php echo $seguro; ?>" />
      
    
      <?php }}} ?>
      <span class="Estilo24">
      <input name="flag1" type="hidden" id="flag1"  value="<?php echo $bandera; ?>" />
  </span><span class="Estilo24">
  <input name="flag2" type="hidden" id="flag2"  value="<?php echo $flag2; ?>" />
  </span><span class="Estilo24">
  <input name="clientePrincipal" type="hidden" id="clientePrincipal"  value="<?php echo $_GET['clientePrincipal']; ?>" />
  </span></div>
    <div align="center">
    
  </div>
    
    
    <?php if($bandera>=1){ ?>
    <label>



<div align="center">
      <input name="keyMOV" type="hidden" id="keyMOV"  value="<?php echo $keyMOV; ?>" />
      <input type="submit" name="continue" id="button" value="continuar" <?php if($teo<1 and !$_POST['continue'] )echo 'disabled=""';?> />
  </div>
    </label>
    <?php } ?>
    
</form>
<p></p>
      

</body>
</html>
