<?php include("/configuracion/ventanasEmergentes.php"); 
include("/configuracion/funciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<?php

$sSQL99= "
SELECT precioVenta
FROM
cargosCuentaPaciente
WHERE 
(keyCAP='".$_GET['keyCAP']."' or keyCAP='".$_POST['keyCAP']."' )
";
$result99=mysql_db_query($basedatos,$sSQL99);
$myrow99 = mysql_fetch_array($result99); 






if($_POST['facturar']){ 

if($_POST['cantidadSolicitada']){

if( $_POST['cantidadSolicitada']<=$myrow99['precioVenta']){

$resta= $_POST['cantidadSolicitada']-$myrow99['precioVenta'];

$porcentaje=$_POST['cantidadSolicitada']/$myrow99['precioVenta'];



$agrega = "INSERT INTO cargosFacturados (numFactura,cantidadFacturada,porcentaje,usuario,fecha,tipoCliente,seguro,nT,keyClientesInternos,status,statusImpresion) values('".$_POST['folioFactura']."','".$_POST['cantidadSolicitada']."','".$porcentaje."','".$usuario."','".$fecha1."','aseguradora','".$_POST['seguro']."','".$_POST['keyCAP']."','".$_POST['keyClientesInternos']."','standby','standby')";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script>
window.opener.document.forms["form1"].submit();
self.close();

</script>';


} else {
 $leyenda= 'La cantidad no debe ser mayor a la q existe!';
}
} else {
 $leyenda='Escribe la cantidad!';
}
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style18 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>

  <h1 align="center"> Importe a Facturar </h1>
  <form id="form1" name="form1" method="post" action="">
    <p>&nbsp;</p>
    <table width="325" border="2" align="center" bordercolor="#660033" class="Estilo24">
      <tr>
        <td width="75" bgcolor="#660066"><div align="left" class="style13">Importe </div></td>
        <td width="392"><label>
<?php 
 $sSQL341= "Select sum(cantidadFacturada) as cantidadF From cargosFacturados WHERE numFactura='".$_GET['folioFactura']."' and
nt='".$_GET['keyCAP']."' ";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);


  ?>
  

          <input name="cantidadSolicitada" type="text" class="Estilo24" id="cantidadSolicitada" value="<?php echo $myrow99['precioVenta']-$myrow341['cantidadF'];?>" size="40" autocomplete="off" />
          <div align="left"></div></td>
      </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td><input name="facturar" type="submit" class="Estilo24" id="facturar" value="Facturar Importe" />
         </td>
      </tr>
    </table>

      <label>
    <input name="keyCAP" type="hidden" id="keyCAP" value="<?php echo $_GET['keyCAP'];?>" />
	    <input name="seguro" type="hidden" id="seguro" value="<?php echo $_GET['seguro'];?>" />
    </label>
      <input name="folioFactura" type="hidden" id="folioFactura" value="<?php echo $_GET['folioFactura'];?>" />
	       <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
  </form>
</body>
</html>