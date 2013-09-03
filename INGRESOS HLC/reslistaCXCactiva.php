<?PHP require("menuOperaciones.php"); ?>

<script language=javascript>
function ventanaSecundaria2 (URL){
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES")
}
</script>
<?php
function noRound($val, $pre = 0) {
    $val = (string) $val;
    if (strpos($val, ".") !== false) {
        $tmp = explode(".", $val);
        $val = $tmp[0] .".". substr($tmp[1], 0, $pre);
    }
    return (float) $val;
} 

if($_POST['numCliente2']){
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' and numCliente = '".$_POST['numCliente2']."' ";
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



 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>


</head>

<body>

 <h1 align="center">&nbsp;</h1>

<h1 align="center">Saldo de Aseguradoras</h1>
<p>
   Fecha de Apertura: <?php 
   $sSQLp= "Select fechaApertura from entidades
WHERE
codigoEntidad='".$entidad."'


";


$resultp=mysql_db_query($basedatos,$sSQLp);
$myrowp = mysql_fetch_array($resultp);
echo cambia_a_normal($myrowp['fechaApertura']);


$_POST['fechaInicial']=$myrowp['fechaApertura'];

   ?>
</p>






 <form id="form2" name="form2" method="post" action="">
 <p align="center" >

     <label>
     
     </label>
   
     <label></label>
  <span >
     Fecha
</span>
     <label>
     <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
     </label>
     <input name="button2" type="button"  id="lanzador1" value="..." />
     <label> <br />
     <br />
     <input name="buscar" type="submit"  id="search" value="Buscar" />
     </label>

</p>





<?php if($_POST['buscar']!=NULL and $_POST['fechaInicial']<=$_POST['fechaFinal']){?>

  
   <table width="900" class="table table-striped">
     <tr>
       <td colspan="4"  ><div align="center">Cargos</div></td>
       <td colspan="3"  ><div align="center">Abonos</div></td>
       <td width="55" colspan="9" >&nbsp;</td>
     </tr>
     <tr>
         <th width="25"  >#</th>
       <th width="209"  ><span >Nombre Compania</span></th>
       <th width="108"  >No facturado</th>
       <th width="89"  >Facturado</th>
       <th width="48"  >Total</th>
       <th width="148"  >Pagos no aplicados</th>
       <th width="124"  >Pagos aplicados</th>
       <th width="54"  >Total</th>
       <th  >Saldo</th>
              <th width="65"  >E Cuenta</th>

     </tr>
        <?php




 $sSQL24= "
select clientePrincipal from
cargosCuentaPaciente
where entidad='".$entidad."'
    and
    fecha1>='".$_POST['fechaInicial']."' and
        fecha1<='".$_POST['fechaFinal']."'
            and
            clientePrincipal!=''
            and
            tipoTransaccion!=''
            group by clientePrincipal
            order by clientePrincipal ASC

";
$result24=mysql_db_query($basedatos,$sSQL24);
while($myrow24 = mysql_fetch_array($result24)){
$_GET['seguro']=$myrow24['clientePrincipal'];
$a+=1;

$sSQLps= "Select nomCliente from clientes
WHERE
entidad='".$entidad."'
and
numCliente='".$myrow24['clientePrincipal']."'

";


$resultps=mysql_db_query($basedatos,$sSQLps);
$myrowps = mysql_fetch_array($resultps);
?>



<tr  onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" > 
       <td >
<?php

echo $a;
?></td>    
    
       <td >
<?php

echo $myrowps['nomCliente'];
?></td>
       <td >
<?php

//SALDOS INICIALES
$sSQLcp="SELECT saldoInicial
FROM
clientes
WHERE
entidad='".$entidad."'
and

numCliente='".$_GET['seguro']."'
 ";
$resultcp=mysql_db_query($basedatos,$sSQLcp);
$myrowcp = mysql_fetch_array($resultcp);



$sSQL1c="SELECT sum(precioVenta*cantidad) as cargos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$_GET['seguro']."'
and
tipoTransaccion='taseg'
and   
fecha1>'".$_POST['fechaInicial']."' 
    and 
    fecha1<'".$_POST['fechaInicial']."'
";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1a="SELECT sum(precioVenta*cantidad)  as devs

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$_GET['seguro']."'
and
tipoTransaccion='devxaseg'
and   
fecha1>'".$_POST['fechaInicial']."' and fecha1<'".$_POST['fechaInicial']."'

";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);


$c=(float) ($myrow1c['cargos']-$myrow1a['devs']);


//************************************************











$sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
tipoTransaccion='taseg'
and
(fecha1>='".$_POST['fechaInicial']."' and fecha1<='".$_POST['fechaFinal']."')

";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQLdev= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as devolucion From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
tipoTransaccion='devxaseg'
and
 
(fecha1>='".$_POST['fechaInicial']."' and fecha1<='".$_POST['fechaFinal']."')

";


$resultdev=mysql_db_query($basedatos,$sSQLdev);
$myrowdev = mysql_fetch_array($resultdev);

 $sSQL8= "Select sum((importe*cantidad)+(iva*cantidad)) as facturado From facturasAplicadas
WHERE
entidad='".$entidad."'
and
seguro='".$_GET['seguro']."'
and

status='facturado'
and
  
(fecha>='".$_POST['fechaInicial']."' and fecha<='".$_POST['fechaFinal']."')
";


$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
//echo '$'.noRound($myrow['acumulado']-$myrowdev['devolucion'],2);
//echo '<br>';
//echo $c.' +  '.$myrow['acumulado'].' - '.$myrowdev['devolucion'].' - '.$myrow8['facturado'];


$noFacturado=(float) (noRound($c,2)+noRound(($myrow['acumulado']-$myrowdev['devolucion']),2)-noRound($myrow8['facturado'],2));
?>

<?php if($noFacturado>0){?>
           <a  href="javascript:ventanaSecundaria2('../ventanas/foliosNoFacturados.php?nombre=<?php echo $myrowps['nomCliente'];?>&numCliente=<?php echo $_GET['seguro']; ?>&seguro=<?php echo $_GET['seguro']; ?>&nombreCliente=<?php echo $myrow['nomCliente']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
        <?php
        echo '$'.noRound($noFacturado,2);?>
           </a>
<?php }else{ 
        echo '$'.noRound($noFacturado,2); } ?>          
</td>
       <td >
<?php

//echo '$'.noRound($myrow['acumulado'],2);


//facturados
 $sSQLcp="SELECT saldoInicial
FROM
clientes
WHERE
entidad='".$entidad."'
and

numCliente='".$_GET['seguro']."'
 ";
$resultcp=mysql_db_query($basedatos,$sSQLcp);
$myrowcp = mysql_fetch_array($resultcp);

$facturado=(float) $myrow8['facturado'];
$cargos=(float) $noFacturado+$facturado;
?>



 
        <?php
        echo '$'.noRound($facturado,2);?>
 



</td>
      



<td ><?php echo '$'.noRound($cargos,2);?></td>





       <td ><?php
 $sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
naturaleza='A'
and


tipoTransaccion='abaseg'
and
 
(fecha1>='".$_POST['fechaInicial']."' and fecha1<='".$_POST['fechaFinal']."')
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQLd= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
    and

tipoTransaccion='DEVABOASEG'
and
  
(fecha1>='".$_POST['fechaInicial']."' and fecha1<='".$_POST['fechaFinal']."')
";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);



//echo '$'.noRound($myrow['acumulado'],2);
$noAplicados=(float) $myrow['acumulado']-$myrowd['acumulado'];
?>
<?php if($noAplicados>0){ ?>
 <a  href="javascript:ventanaSecundaria2('mostrarsinAplicar.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
        <?php
        echo '$'.noRound($noAplicados,2);?>
        </a>
        <?php } else {
		echo '$'.noRound($noAplicados,2);
		}?>

</td>
<td ><?php
$sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
statusFactura='pagado'
and
   
(fechaCierre>='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."')
    and
    gpoProducto!=''
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
//echo '$'.noRound($myrow['acumulado'],2);
$aplicados=(float) $myrow['acumulado'];
$abonos=(float) $aplicados+$noAplicados;
?>


<?php		echo '$'.noRound($myrow['acumulado'],2);
		
//echo 'ss'.$cargos-$abonos;
?>

</td>
    
       <td ><?php echo '$'.noRound($noAplicados-$aplicados,2);?></td>
       <td ><?php echo '$'.noRound($cargos-$abonos,2);?></td>
      <td >
<a  href="javascript:ventanaSecundaria2('../cargos/detallesClientes.php?nombre=<?php echo $myrowps['nomCliente'];?>&numCliente=<?php echo $_GET['seguro']; ?>&seguro=<?php echo $_GET['seguro']; ?>&nombreCliente=<?php echo $myrow['nomCliente']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
Ver
</a>

      </td>
     </tr>     <?php } ?>
   </table>
   <img src="../imagenes/bordestablas/borde2.png" width="900" height="24" />
   <p align="center"><label></label>
 </p>
</form>
<?php }?>


 <p align="center">&nbsp;</p>


<script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
</body>
</html>