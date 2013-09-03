<?php require("/configuracion/ventanasEmergentes.php"); require_once('/configuracion/funciones.php');?>



<?php
//***************************************
if($_GET['delete']=='yes' and $_GET['folioVenta']!=NULL){
$borrame = "DELETE FROM facturasAplicadas WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."' and random='".$_GET['random']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();


$borrame = "DELETE FROM facturaGrupos WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."' and random='".$_GET['random']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}
//************************************************************

?>

<script language=javascript> 
function ventanaSecundariaA (URL){ 
   window.open(URL,"ventanaSecundariaA","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=650,height=500,scrollbars=YES")
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript>
function ventanaSecundaria110 (URL){
   window.open(URL,"ventanaSecundaria110","width=600,height=600,scrollbars=YES")
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

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

  <script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sï¿½lo acepta nï¿½meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script>

<?php
if(($_POST['previzualizar'] or $_POST['aplicarFactura']) and $_POST['folioFactura']){
$sSQL3d= "Select * From facturasAplicadas WHERE 
entidad='".$entidad."'
and
numFactura = '".$_POST['folioFactura']."'
and
keyMov='".$_GET['keyMOV']."'
";
$result3d=mysql_db_query($basedatos,$sSQL3d);
$myrow3d = mysql_fetch_array($result3d);
}
?>
















<?php //************************ACTUALIZO **********************
//********************Llenado de datos


//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."'
and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
//***************aplicar pago**********************






















if(($_POST['aplicarFactura'] or $_POST['facturarResumen']) and is_numeric($_POST['folioFactura'])){
$keyCAP=$_POST['keyCAP'];
$importe=$_POST['importe'];
$folioVenta=$_POST['folioVenta'];

$importeFacturado=$_POST['importeFacturado'];






for($i=0;$i<=$_POST['bandera'];$i++){
//***********************VALIDACIONES*****************************



if($folioVenta[$i]){ 
  $sql1 = "UPDATE facturasAplicadas set 
numFactura='".$_POST['folioFactura']."',
usuario='".$usuario."',status='facturado'
where
entidad='".$entidad."'
and
numFactura='".$_POST['folioFactura']."'
and
random='".$_GET['random']."'
";

mysql_db_query($basedatos,$sql1);
echo mysql_error();




$sql2 = "UPDATE cargosCuentaPaciente set 
folioFactura='".$_POST['folioFactura']."',

usuarioFactura='".$usuario."'
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta[$i]."' 
and
statusFactura='request'
";

//mysql_db_query($basedatos,$sql2);
echo mysql_error();



$sql0 = "UPDATE clientesInternos set 

numeroFactura='".$_POST['folioFactura']."',

pagoFactura='".$usuario."'
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta[$i]."' 
";

//mysql_db_query($basedatos,$sql0);
echo mysql_error();


$sql3= "UPDATE facturaGrupos set

numFactura='".$_POST['folioFactura']."',
status='facturado'
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta[$i]."'
    and
    random='".$_GET['random']."'

        and
        status='request'
";

mysql_db_query($basedatos,$sql3);
echo mysql_error();
}
}






?>




<script>


window.alert("REGISTROS FACTURADOS");
//window.close();
</script> 


<?php }?>





















































<?php 

if($_POST['previzualizar'] and $_POST['folioFactura'] and $_POST['rfc']!=NULL){
$_POST['rfc']=trim($_POST['rfc']);

$folioVenta=$_POST['folioVenta'];





$sSQL2= "Select * From RFC WHERE  RFC ='".$_POST['rfc']."'  ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

$sSQL2a= "Select * From datosfacturacion WHERE entidad='".$entidad."'  and numfactura='".$_POST['folioFactura']."' and rfc ='".trim($_POST['rfc'])."'";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);


if(!$myrow2a['rfc'] and $myrow2['RFC']){
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
        '".$myrow2['pais']."','".$entidad."','".$myrow2['RFC']."',
            '".$myrow2['calle1']."','".$_POST['folioFactura']."')

";

mysql_db_query($basedatos,$sql0);
echo mysql_error();
}
//****************************

$folioVenta=$_POST['folioVenta'];


for($i=0;$i<=$_POST['bandera'];$i++){


if($folioVenta[$i]){



//INGRESAR A LOS MEDICOS**********
$sSQL7fd="SELECT almacenDestino,descripcionMedico,gpoProducto
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$folioVenta[$i]."'
and
gpoProducto!=''

";


  $result7fd=mysql_db_query($basedatos,$sSQL7fd);
    while($myrow7fd = mysql_fetch_array($result7fd)){

if($myrow7fd['gpoProducto']=='HONMED'){
    
    
 $sSQL7fd1="SELECT almacen
FROM
datosadicionalesfacturacion
WHERE
entidad='".$entidad."'
and
random='".$_GET['random']."'
and
almacen='".$myrow7fd['almacenDestino']."'
and
numfactura='".$_POST['folioFactura']."'
";


  $result7fd1=mysql_db_query($basedatos,$sSQL7fd1);
  $myrow7fd1 = mysql_fetch_array($result7fd1);


if(!$myrow7fd1['almacen']){
$agrega = "INSERT INTO datosadicionalesfacturacion (
entidad,numFactura,almacen,descripcion,random)
values ('".$entidad."','".$_POST['folioFactura']."','".$myrow7fd['almacenDestino']."',
'".$myrow7fd['descripcionMedico']."' , '".$_GET['random']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
  }}}
//********************************




$sql2 = "UPDATE cargosCuentaPaciente set
folioFactura='".$_POST['folioFactura']."',

usuarioFactura='".$usuario."'
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta[$i]."'
    and
    usuario='".$usuario."'
and
statusFactura='request'
";

//mysql_db_query($basedatos,$sql2);
echo mysql_error();



 $sql0 = "UPDATE clientesInternos set

numeroFactura='".$_POST['folioFactura']."',
pagoFactura='".$usuario."'
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta[$i]."' 
";

//mysql_db_query($basedatos,$sql0);
echo mysql_error();
//*************************************************


 $actualiza = "UPDATE facturaGrupos
set
numFactura='".$_POST['folioFactura']."'
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta[$i]."'
    and
random='".$_GET['random']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();


  $actualiza1 = "UPDATE facturasAplicadas
set
numFactura='".$_POST['folioFactura']."'

where
entidad='".$entidad."'
and
folioVenta='".$folioVenta[$i]."'  
    and
random='".$_GET['random']."'
";
mysql_db_query($basedatos,$actualiza1);
echo mysql_error();

}//cierra while

}//cierra for
echo 'Registros Agregados';

}//cierra previzualizar
?>



























<?php
if(isset($_POST['folioVenta'])){
$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_POST['folioVenta']."'   ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>

<?php } ?>










<?php if($_POST['delete'] and $_POST['keyAPF']){

$keyAPF=$_POST['keyAPF'];

//************************************
for($i=0;$i<=$_POST['bandera'];$i++){
if($keyAPF[$i]){
$sql5= "
SELECT *
FROM
facturasAplicadas
WHERE
keyAPF='".$keyAPF[$i]."'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
 $sqld = "DELETE FROM facturasAplicadas 
where
keyAPF='".$keyAPF[$i]."'  ";
mysql_db_query($basedatos,$sqld);
echo mysql_error();





$sqld1 = "DELETE FROM facturaGrupos 
where
entidad='".$entidad."'
and
folioVenta='".$myrow5['folioVenta']."' and
random='".$_GET['random']."'
";
mysql_db_query($basedatos,$sqld1);
echo mysql_error();



$sqld3 = "DELETE FROM datosadicionalesfacturacion
where
entidad='".$entidad."'
and
random='".$_GET['random']."'

";
mysql_db_query($basedatos,$sqld3);
echo mysql_error();
}

} ?>
<?php
}
?>



 
  
  
  
  
















  
  
  
  

  




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />






<?php
$estilo= new muestraEstilos();
$estilo->styles();
?>

<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF;
          background:#000066;

}
 
-->
</style>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>
<h1 align="center" class="titulos">Facturar </h1>
<form  name="escojerImporte" method="post">
  <p align="center">&nbsp;</p>
  <table width="697" border="3" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo1">
    <tr>
      <th width="77" class="blanco" scope="col">&nbsp;</th>
      <th width="256" class="blanco" scope="col">&nbsp;</th>
      <th width="8" bgcolor="#660066" class="blanco"  scope="col"></th>
      <th width="72" class="blanco"  scope="col">&nbsp;</th>
      <th width="252"  scope="col">&nbsp;</th>
    </tr>
    <tr>
      <th class="blanco" scope="col"><div align="left">Fecha Impresi&oacute;n</div></th>
      <th class="blanco" scope="col"><div align="left">
        <label></label>
        <input type="text" name="fechaImpresion" id="fechaImpresion" value="<?php echo $_POST['fechaImpresion'];?>" />
      </div>      </th>
      <th bgcolor="#660066" class="blanco"  scope="col">&nbsp;</th>
      <th  scope="col" class="blanco"><div align="left"><strong># Siniestro</strong></div></th>
      <th  scope="col"><div align="left">
        <input type="text" name="siniestro" id="siniestro" value="<?php echo $_POST['siniestro'];?>" />
      </div></th>
    </tr>
    <tr>
      <th class="blanco" scope="col">&nbsp;</th>
      <th class="blanco" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="blanco"  scope="col">&nbsp;</th>
      <th  scope="col" class="blanco"><div align="left">Compa&ntilde;&iacute;a</div></th>
      <th  scope="col"><div align="left"><span class="blanco">
        <?php $traeSeguro=$myrow3['seguro']; ?>
        <?php
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_GET['numCliente']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$sSQL455= "Select * from clientes where entidad='".$entidad."' and numCliente='".$_GET['numCliente']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
echo $myrow455['nomCliente'];


$sSQL455d= "Select rfc from clientes where numCliente='".$myrow455['clientePrincipal']."'";
$result455d=mysql_db_query($basedatos,$sSQL455d);
$myrow455d = mysql_fetch_array($result455d);

?>
      </span></div></th>
    </tr>
    <tr>
      <th colspan="5" class="blanco" scope="col">
        <div align="center"># Factura 
		
		
          <input autocomplete="off" name="folioFactura" type="text" <?php if($_POST['folioFactura']){ echo 'class="normal"';}?> id="folioFactura" value="<?php echo $_POST['folioFactura'];?>"  />
		</div>
      <div align="left"></div>        <div align="left"></div></th>
    </tr>
  </table>
  <p align="center">
  <?php if($_POST['folioFactussra']){ ?>
  <a href="javascript:ventanaSecundariaA('
     resumenCuentas.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>
     &numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>
     &keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $myrow7ab['random'];?>
     &fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>
     &folioFactura=<?php echo $_POST['folioFactura'];?>&rfc=<?php echo $_POST['rfc'];?>');">Ver Distribucion </a>
  <?php } ?>
  </p>

 
     <?php if($_POST['folioFactura'] and($_POST['previzualizar'] or $_POST['aplicarFactura'])){ ?>
  <table width="200" border="1" align="center">


<?php if($_POST['rfc']){ ?>
       <tr bgcolor="#FFFFFF">
           <td>---</td>
      <td>
	    <div align="center">
		
		<a href="#" onClick="javascript:ventanaSecundaria5('/sima/cargos/printDetailsGroup.php?random=<?php echo $_GET['random'];?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $_GET['numCliente'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_POST['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $_POST['rfc'];?>&tipoPaciente=<?php echo $_GET['tipoPaciente'];?>');"   />
	       Factura Agrupada
	      </a>
        </div></td>
    </tr>

     <tr bgcolor="#FFFFFF"><td>---</td>
      <td>
	  
        <div align="center"><a href="#" onClick="javascript:ventanaSecundaria2('/sima/cargos/imprimirFolioVentaFactura.php?random=<?php echo $_GET['random'];?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&entidad=<?php echo $entidad;?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $_GET['numCliente'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_POST['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $_POST['rfc'];?>&tipoPaciente=<?php echo $_GET['tipoPaciente'];?>');" >
          Factura por Folios</a>
          
        </div></td>
    </tr>
<?php } ?>




            <tr bgcolor="#FFFFFF">
      <td class="negro">RFC</td>
      <td class="style12"><input name="rfc" type="text" class="camposmid" id="rfc" readonly="readonly"
		value="<?php

		 echo $_POST['rfc'];

		?>"/></td>
    </tr>


          <tr bgcolor="#FFFFFF">
      <td class="negro">Razon Social:</td>
      <td class="style12"><span class="Estilo24">
        <input name="razonSocial" type="text" class="camposmid" id="razonSocial" value="<?php
		if($myrow2['razonSocial']){
		  echo $myrow2['razonSocial'];
		 }elseif($_POST['razonSocial']){
		 echo trim($_POST['razonSocial']);
		}
		?>" size="60" />




      </span></td>


 </tr>



      <tr>
          <td>---</td>
                <td>

                  <label>
                      <div class="normal">
                      <a href="#" onClick="ventanaSecundaria1('ventanaModificaRFC.php?folioFactura=<?php echo $_POST['folioFactura']; ?>
		&amp;random=<?php echo $_GET['random']; ?>&amp;almacen2=<?php echo $A; ?>&amp;codigoGP1=<?php echo $C?>&amp;codigosGP=<?php echo $C?>')">
               Nuevo RFC
            </a>
                      </div>
        </label>

      </td>

      </tr>

  </table>
      <?php } ?>
  
  
<?php
if($_POST['folioFactura']!=NULL){
$sSQL2f= "Select * From facturasAplicadas WHERE entidad='".$entidad."' and numFactura='".$_POST['folioFactura']."' and keyMov='".$_GET['keyMOV']."' ";
$result2f=mysql_db_query($basedatos,$sSQL2f);
$myrow2f = mysql_fetch_array($result2f);
}
?>
  
  




<?php if($myrow2f['status']!='facturado'){ ?>  
  <p align="center">&nbsp;</p>
  <table width="499" border="0" align="center">
    <?php 

 $sSQL2= "Select * From clientes WHERE entidad='".$entidad."' and numCliente='".$_GET['numCliente']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
?>
    <?php 
	if(!$_POST['clientePrincipal'] AND !$myrow2['clientePrincipal']){

            //aqui iba el rfc
            } ?>
  </table>
  <p align="center" class="informativo">(Click en el Paciente o el Folio para ver su Estado de Cuenta)</p>
  
  
  
  <table width="579" height="0" border="0" align="center">
    <tr>
      <th width="77" height="14" bgcolor="#660066" scope="col"><div align="center" class="blanco">FVenta</div></th>
      <th width="334" bgcolor="#660066" scope="col"><div align="left" class="blanco">Paciente</div></th>
      <th width="20" bgcolor="#660066" scope="col"><div align="left" class="blanco">Editar</div></th>

    </tr>
	
<?php //traigo agregados

$sSQL81= "
SELECT 
*
FROM
facturasAplicadas
 WHERE 
 entidad='".$entidad."'
 and
random='".$_GET['random']."'
"
;


$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){







$a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];









//***********************A FACTURAR******************
$sSQL14c= "
SELECT 
sum((precioVenta*cantidad)+(iva*cantidad)) as total
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow81['folioVenta']."'
and
tipoCliente='coaseguro'
and
naturaleza='A'
";
$result14c=mysql_db_query($basedatos,$sSQL14c);
$myrow14c = mysql_fetch_array($result14c);


$sSQLtc= "
SELECT 
sum((precioVenta*cantidad)+(iva*cantidad)) as trasladoCxC
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow81['folioVenta']."'
and
tipoPago='Cuentas por Cobrar'
and
naturaleza='A'
and
gpoProducto=''
";
$resulttc=mysql_db_query($basedatos,$sSQLtc);
$myrowtc = mysql_fetch_array($resulttc);

$sSQLtcd= "
SELECT 
sum((precioVenta*cantidad)+(iva*cantidad)) as devolucionCxC
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow81['folioVenta']."'
and
tipoPago='Cuentas por Cobrar'
and
naturaleza='C'
and
gpoProducto=''
";
$resulttcd=mysql_db_query($basedatos,$sSQLtcd);
$myrowtcd = mysql_fetch_array($resulttcd);
$traslado=$myrowtc['trasladoCxC']-$myrowtcd['devolucionCxC'];
//*******************************************************





$sSQLcargos= "
SELECT 
sum((cantidadAseguradora*cantidad)+(iva*cantidad)) as cargos
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
clientePrincipal='".$_GET['numCliente']."'
and

folioVenta='".$myrow81['folioVenta']."'
and
naturaleza='C'
and
gpoProducto!=''
";
$resultcargos=mysql_db_query($basedatos,$sSQLcargos);
$myrowcargos = mysql_fetch_array($resultcargos);


$sSQLdevoluciones= "
SELECT 
sum((cantidadAseguradora*cantidad)+(iva*cantidad)) as devoluciones
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
clientePrincipal='".$_GET['numCliente']."'
and

folioVenta='".$myrow81['folioVenta']."'
and
naturaleza='A'
and
gpoProducto!=''
";
$resultdevoluciones=mysql_db_query($basedatos,$sSQLdevoluciones);
$myrowdevoluciones = mysql_fetch_array($resultdevoluciones);



if($_POST['trasladoNomina']){
$sSQL14n= "
SELECT 
sum((precioVenta*cantidad)+(iva*cantidad)) as trasladoNomina
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow81['folioVenta']."'
and
tipoPago='Nomina'
and
naturaleza='A'
";
$result14n=mysql_db_query($basedatos,$sSQL14n);
$myrow14n = mysql_fetch_array($result14n);
}


$coaseguro[0]+= $myrow14c['total'];
$fV[0]+=$traslado+$myrow14n['trasladoNomina'];


$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$myrow81['folioVenta']."'   ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);




$totalCargo[0]+=$myrowcargos['cargos']-$myrowdevoluciones['devoluciones'];


if($myrow81['naturaleza']=='C'){
$cargos[0]+=$myrow81['importe']+$myrow81['iva'];
}
if($myrow81['naturaleza']=='A'){
$devoluciones[0]+=$myrow81['importe']+$myrow81['iva'];
}

?>	

	
	
    <tr>


        <td height="21" bgcolor="<?php echo $color;?>" class="negromid">
	
	  <?php echo $myrow81['folioVenta'];?>
        
      </td>


      <td bgcolor="<?php echo $color;?>" class="negromid"><div align="left"><a href="#" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/despliegaCargoscxc.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow81['folioVenta'];?>')">
<?php echo $myrow3['paciente'];?>
              </a>
          </div>
      </td>



        <td bgcolor="<?php echo $color;?>" class="negromid">
            <div align="left">
<a href="#"
onclick="javascript:ventanaSecundaria110('editExtensionesParticular.php?random=<?php echo $_GET['random']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow81['folioVenta'];?>&keyMOV=<?php echo $_GET['keyMOV'];?>')">
Edit
</a>
            </div>
        </td>






    </tr>







 
	
	<input name="folioVenta[]" type="hidden" id="folioVenta[]" value="<?php echo $myrow81['folioVenta'];?>" />
	<input name="importeFactura[]" type="hidden" id="importeFactura[]" value="<?PHP echo number_format($traslado+$myrow14n['trasladoNomina'],2);?>" />
	
	
	
	
	
	<?php 
	
	$sSQL14n= "
SELECT 
sum((precioVenta*cantidad)+(iva*cantidad)) as total
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow81['folioVenta']."'
and
tipoPago='Nomina'
and
naturaleza='A'
";
$result14n=mysql_db_query($basedatos,$sSQL14n);
$myrow14n = mysql_fetch_array($result14n);
	
	?>

    
       <?php }?>
  </table>
  <div align="center"></div>
  <p>
  <p>&nbsp;</p>
  <label>
    <div align="center">
      <div align="center">
	
		<input name="totalCargos[]" type="hidden" id="totalCargos[]" value="<?PHP echo number_format($totalCargo[0],2);?>" />

	

  </div>
  </label>
  <label>
  
  <div align="center">
    <input type="submit" src="/sima/imagenes/btns/preview_btn.png"  name="previzualizar" id="previzualizar" value="Previsualizar" />

  </div>
  </label>
  
  
  
  
  <p>
  
  <?php if($_POST['previzualizar'] and $_POST['folioFactura']){ ?>
    <input type="submit" name="aplicarFactura" id="definitivo" value="Facturar Definitivo" />
	<?php } ?>
	
  </p>
  <p align="center">
    <label>

    </label>
  </p>
  

	
      
   
      
      <input name="bandera" type="hidden" value="<?php echo $a;?>" />
      
      <input name="paciente" type="hidden" value="<?php echo $myrow14['paciente'];?>" />
      <input name="keyClientesInternos" type="hidden" value="<?php echo $myrow14['keyClientesInternos'];?>" />
      
    </p>
  </div>
  
  <?php } else{ ?>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
	    <p>&nbsp;</p>
		  <p>&nbsp;</p>
		    <p>&nbsp;</p>
  <table width="500" border="0" align="center"  style="border: 1px solid #000000;">
  <tr>
    <td><div class="error" align="center">FOLIOS FACTURADOS</div></td>
  </tr>
</table>
  
  <?php } ?>
</form>

  <script>
		new Autocomplete("razonSocial", function() {
			this.setValue = function( id ) {
				document.getElementsByName("rfc")[0].value = id;
			}

			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");

			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick )
				return ;

			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/rfcx.php?entidad=<?php echo $entidad;?>&almacen=<?php echo $ALMACEN;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});
	</script>
</body>
</html>
