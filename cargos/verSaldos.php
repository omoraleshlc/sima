<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<script language=javascript>
function ventanaSecundaria2 (URL){
   window.open(URL,"ventana2","width=800,height=800,scrollbars=YES")
}
</script>
<?php


if($_POST['numCliente2']){
$sSQL2= "Select * From clientes WHERE numCliente = '".$_POST['numCliente2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}





if($_POST['solicita'] and $_POST['agregar'] and !$_POST['quitar']){
$keyClientesInternos=$_POST['agregar'];

for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL21= "Select pagoFactura From clientesInternos WHERE keyClientesInternos = '".$keyClientesInternos[$i]."' ";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);

if($keyClientesInternos[$i] AND $myrow21['pagoFactura']==''){
 $q = "UPDATE clientesInternos set
pagoFactura='request'
WHERE keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
}
}



if(!$_POST['solicita'] and $_POST['quitare'] and $_POST['quitar']){
$keyClientesInternos=$_POST['quitar'];

for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL21= "Select pagoFactura From clientesInternos WHERE keyClientesInternos = '".$keyClientesInternos[$i]."' ";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);

if($keyClientesInternos[$i] AND $myrow21['pagoFactura']=='request'){
 $q = "UPDATE clientesInternos set
pagoFactura=''
WHERE keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
}
}



if($_POST['aplicarPago']  and $_POST['registrosActivados']){
$keyClientesInternos=$_POST['registrosActivados'];

for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL21= "Select pagoFactura From clientesInternos WHERE keyClientesInternos = '".$keyClientesInternos[$i]."' ";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);

if($keyClientesInternos[$i] AND $myrow21['pagoFactura']=='request'){
$q = "UPDATE clientesInternos set
pagoFactura='pagado'
WHERE keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
}
echo '<script language="JavaScript" type="text/javascript">
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>';
}
?>


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

        if( vacio(F.medico.value) == false ) {
                alert("Por Favor, escoje un m�dico que va a atender a este paciente!")
                return false
        } else if( vacio(F.paciente.value) == false ) {
                alert("Por Favor, escribe el nombre del paciente!")
                return false
        } else if( vacio(F.seguro.value) == false ) {
                alert("Por Favor, escoje alg�n tipo de seguro, o tambi�n si es particular!")
                return false
        }
}




</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 14px}
.style11 {color: #FFFFFF; font-size: 14px; font-weight: normal; }
.style12 {font-size: 14px}
.Estilo24 {font-size: 14px}
.Estilo25 {color: #000000; font-size: 14px; font-weight: normal; }
-->
</style>
</head>

<body>

 <h1 align="center">&nbsp;</h1>
 <p align="center">&nbsp;</p>
 <p align="center">&nbsp;</p>
<h1 align="center">Movimientos <?php echo $myrow24['nomCliente'];?></h1>
<p>
   <?php
$sSQL= "Select * from clientesInternos where entidad='".$entidad."'
and

seguro='".$_GET['seguro']."'


";
$result=mysql_db_query($basedatos,$sSQL);

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <img src="/sima/imagenes/bordestablas/borde1.png" width="750" height="24" />
   <table width="750" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000" class="Estilo24">
     <tr>
       <td width="181" bgcolor="#FFFF00" class="Estilo25">&nbsp;</td>
       <td colspan="3" bgcolor="#FFFF00" class="Estilo25"><div align="center">Cargos</div></td>
       <td colspan="3" bgcolor="#FFFF00" class="Estilo25"><div align="center">Abonos</div></td>
       <td width="36" bgcolor="#FFFF00" class="Estilo25">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF" class="Estilo25"><span class="style12">Nombre Compa&ntilde;&iacute;a</span></td>
       <td width="95" bgcolor="#FFFFFF" class="Estilo25">No facturado</td>
       <td width="87" bgcolor="#FFFFFF" class="Estilo25">Facturado</td>
       <td width="38" bgcolor="#FFFFFF" class="Estilo25">Total</td>
       <td width="113" bgcolor="#FFFFFF" class="Estilo25">Pagos no aplicados</td>
       <td width="106" bgcolor="#FFFFFF" class="Estilo25">Pagos aplicados</td>
       <td width="30" bgcolor="#FFFFFF" class="Estilo25">Total</td>
       <td bgcolor="#FFFFFF" class="Estilo25">Saldo</td>
     </tr>
     <tr>
       <td class="style12"><?php

$sSQL24= "Select nomCliente From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_GET['seguro']."' ";
$result24=mysql_db_query($basedatos,$sSQL24);
$myrow24 = mysql_fetch_array($result24);
echo $myrow24['nomCliente'];
?></td>
       <td class="style12">
<?php
$sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
naturaleza='C'
and
statusFactura='standby'
and
statusCaja='pagado'
and
folioVenta!=''
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$noFacturado=$myrow['acumulado'];
?>

<?php if($noFacturado>0){ ?>
 <a  href="javascript:ventanaSecundaria2('noFacturado.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
        <?php
        echo '$'.number_format($myrow['acumulado'],2);?>
        </a>
        <?php } else {
		echo '$'.number_format($myrow['acumulado'],2);
		}?>


</td>
       <td class="style12">
<?php
$sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
naturaleza='C'
and
statusFactura='facturado'
and
statusCaja='pagado'
and
folioVenta!=''
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
//echo '$'.number_format($myrow['acumulado'],2);
$facturado=$myrow['acumulado'];
$cargos=$noFacturado+$facturado;
?>


<?php if($facturado>0){ ?>
 <a  href="javascript:ventanaSecundaria2('mostrarFacturado.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
        <?php
        echo '$'.number_format($myrow['acumulado'],2);?>
        </a>
        <?php } else {
		echo '$'.number_format($myrow['acumulado'],2);
		}?>



</td>
       <td class="style12"><?php echo '$'.number_format($cargos,2);?></td>
       <td class="style12"><?php
$sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
naturaleza='A'
and
statusFactura='standby'
and

descripcionTransaccion='pagosCxC'
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQLd= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
    and
naturaleza='C'
and
statusFactura='standby'
and

descripcionTransaccion='pagosCxC'
";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);



//echo '$'.number_format($myrow['acumulado'],2);
$noAplicados=$myrow['acumulado']-$myrowd['acumulado'];
?>
<?php if($noAplicados>0){ ?>
 <a  href="javascript:ventanaSecundaria2('mostrarsinAplicar.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
        <?php
        echo '$'.number_format($noAplicados,2);?>
        </a>
        <?php } else {
		echo '$'.number_format($noAplicados,2);
		}?>

</td>
       <td class="style12"><?php
$sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
statusFactura='pagado'
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
//echo '$'.number_format($myrow['acumulado'],2);
$aplicados=$myrow['acumulado'];
$abonos=$aplicados+$noAplicados;
?>


<?php if($aplicados>0){ ?>
 <a  href="javascript:ventanaSecundaria2('mostrarAplicados.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
        <?php
        echo '$'.number_format($myrow['acumulado'],2);?>
        </a>
        <?php } else {
		echo '$'.number_format($myrow['acumulado'],2);
		}?>

</td>
       <td class="style12"><?php echo '$'.number_format($noAplicados-$aplicados,2);?></td>
       <td class="style12"><?php echo '$'.number_format($cargos-$abonos,2);?></td>
     </tr>
   </table>
   <img src="/sima/imagenes/bordestablas/borde2.png" width="750" height="24" />
   <p align="center"><label></label>
 </p>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>