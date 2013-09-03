<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php'); ?>
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.clientePrincipal.value) == false ) {   
                alert("Por Favor, escoje el clientePrincipal/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este clientePrincipal!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
	<?php 		
$sSQL7ab="SELECT descripcionGP
FROM
gpoProductos
WHERE

codigoGP='".$_GET['gpoProducto']."'

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);
echo $myrow7ab['descripcionGP'];
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 

<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){

LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>

<br />
<br />
<form id="form2" name="form2" method="post"><div align="center">
     <h1 class="titulomedio">
Reporte Global</h1>
 
           <p class="titulomedio">

       <?php echo "Ano: ".$_GET['year'];?>

   </p>
   
   <table width="500" align="center">

 <tr>
 <td width="40"  class="precio1" align="left"><p></p></td>
  <td width="40"  class="precio1" align="left"><p></p></td>
   
   
                 <td align="center" class="success" colspan="5">Enero</td>

           <td align="center" class="success" colspan="3">Febrero</td>
           
           <td align="center" class="success" colspan="3">Marzo</td>
           
           <td align="center" class="success" colspan="3">Abril</td>
           
           <td align="center" class="success" colspan="3">Mayo</td>
           
           <td align="center" class="success" colspan="3">Junio</td>
           
           <td align="center" class="success" colspan="3">Julio</td>
           
           <td align="center" class="success" colspan="3">Agosto</td>
           
           <td align="center" class="success" colspan="3">Septiembre</td>
           
           <td align="center" class="success" colspan="3">Octubre</td>
           
           <td align="center" class="success" colspan="3">Noviembre</td>
           
           <td align="center" class="success" colspan="3">Diciembre</td>
           
           
           
 </tr>

 
       
       
       
       
     
  
     
   
  <td width="5"  class="negromid"><div align="left">#</div></td>         
       <td width="100"  class="negromid"><div align="left">Seguro</div></td>
       	    
       
       
            <!-- ENERO -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>     
       
       
            <!-- FEBRERO -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>     
       
            
            <!-- MARZO -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            <!-- ABRIL -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>  
            
            
            <!-- MAYO -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            
            <!-- JUNIO -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            <!-- JULIO -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            
            <!-- AGOSTO -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            <!-- SEPTIEMBRE -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            
            <!-- OCTUBRE -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            
            <!-- NOVIEMBRE -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            
            <!-- DICIEMBRE -->
            <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>   
            
            
            
            
     
<?php 




  $sSQL2= "Select * From clientes
      where
      entidad='".$entidad."'
          and
          subCliente=''
          order by nomCliente ASC

 ";
$result2=mysql_db_query($basedatos,$sSQL2); 
while($myrow2 = mysql_fetch_array($result2)){
$a+=1;












?>

     <tr >
         <td  class="normal"><div align="left"><?php echo $a;?></div></td>
             
         
         
         
       <td  class="normal"><div align="left">
         <?php 

         
 echo $myrow2['nomCliente'];
         	  ?>
       </div></td>











<!-- COMIENZA ENERO -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'01'.'-'.'01';
$fechaFinal=$year.'-'.'01'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
and
gpoProducto!=''



";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosEnero=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosEnero=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosEnero[0]+=$cargosEnero;
                echo '$'.number_format($cargosEnero,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosEnero[0]+=$pagosEnero;
                echo '$'.number_format($pagosEnero,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosEnero-$pagosEnero,2);?>
        </p>
        </td>        
<!-- TERMINA ENERO -->  
        
        
        
        
        
        
        
        













<!-- COMIENZA FEBRERO -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'02'.'-'.'01';
$fechaFinal=$year.'-'.'02'.'-'.'28';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
and
gpoProducto!=''


";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosFebrero=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosFebrero=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosFebrero[0]+=$cargosFebrero;
                echo '$'.number_format($cargosFebrero,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosFebrero[0]+=$pagosFebrero;
                echo '$'.number_format($pagosFebrero,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosFebrero-$pagosFebrero,2);?>
        </p>
        </td>        
<!-- TERMINA FEBRERO -->  
        
        












<!-- COMIENZA MARZO -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'03'.'-'.'01';
$fechaFinal=$year.'-'.'03'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
AND
gpoProducto!=''
";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosMarzo=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosMarzo=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosMarzo[0]+=$cargosMarzo;
                echo '$'.number_format($cargosMarzo,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosMarzo[0]+=$pagosMarzo;
                echo '$'.number_format($pagosMarzo,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosMarzo-$pagosMarzo,2);?>
        </p>
        </td>        
<!-- TERMINA MARZOs -->  
        
        





















<!-- COMIENZA ABRIL -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'04'.'-'.'01';
$fechaFinal=$year.'-'.'04'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
AND
gpoProducto!=''


";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
and
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosAbril=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosAbril=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosAbril[0]+=$cargosAbril;
                echo '$'.number_format($cargosAbril,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosAbril[0]+=$pagosAbril;
                echo '$'.number_format($pagosAbril,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosAbril-$pagosAbril,2);?>
        </p>
        </td>        
<!-- TERMINA ABRIL -->  
        
   
















<!-- COMIENZA MAYO -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'05'.'-'.'01';
$fechaFinal=$year.'-'.'05'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
and
gpoProducto!=''  ";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosMayo=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosMayo=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosMayo[0]+=$cargosMayo;
                echo '$'.number_format($cargosMayo,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosMayo[0]+=$pagosMayo;
                echo '$'.number_format($pagosMayo,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosMayo-$pagosMayo,2);?>
        </p>
        </td>        
<!-- TERMINA MAYO -->  
        
   

















<!-- COMIENZA JUNIO -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'06'.'-'.'01';
$fechaFinal=$year.'-'.'06'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
AND
gpoProducto!=''


";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosJunio=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosJunio=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosJunio[0]+=$cargosJunio;
                echo '$'.number_format($cargosJunio,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosJunio[0]+=$pagosJunio;
                echo '$'.number_format($pagosJunio,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosJunio-$pagosJunio,2);?>
        </p>
        </td>        
<!-- TERMINA JUNIO -->  
        
   









        
        






<!-- COMIENZA JULIO -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'07'.'-'.'01';
$fechaFinal=$year.'-'.'07'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
and
gpoProducto!=''   ";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosJulio=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosJulio=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosJulio[0]+=$cargosJulio;
                echo '$'.number_format($cargosJulio,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosJulio[0]+=$pagosJulio;
                echo '$'.number_format($pagosJulio,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosJulio-$pagosJulio,2);?>
        </p>
        </td>        
<!-- TERMINA JULIO -->  
        
   














<!-- COMIENZA AGOSTO -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'08'.'-'.'01';
$fechaFinal=$year.'-'.'08'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
and
gpoProducto!=''
";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosAgosto=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosAgosto=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosAgosto[0]+=$cargosAgosto;
                echo '$'.number_format($cargosAgosto,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosAgosto[0]+=$pagosAgosto;
                echo '$'.number_format($pagosAgosto,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosAgosto-$pagosAgosto,2);?>
        </p>
        </td>        
<!-- TERMINA AGOSTO -->  
        
   













<!-- COMIENZA SEPTIEMBRE -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'09'.'-'.'01';
$fechaFinal=$year.'-'.'09'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
and
gpoProducto!=''

";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosSeptiembre=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosSeptiembre=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosSeptiembre[0]+=$cargosSeptiembre;
                echo '$'.number_format($cargosSeptiembre,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosSeptiembre[0]+=$pagosSeptiembre;
                echo '$'.number_format($pagosSeptiembre,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosSeptiembre-$pagosSeptiembre,2);?>
        </p>
        </td>        
<!-- TERMINA SEPTIEMBRE -->  




















<!-- COMIENZA OCTUBRE -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'10'.'-'.'01';
$fechaFinal=$year.'-'.'10'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
AND
gpoProducto!=''




";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosOctubre=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosOctubre=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosOctubre[0]+=$cargosOctubre;
                echo '$'.number_format($cargosOctubre,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosOctubre[0]+=$pagosOctubre;
                echo '$'.number_format($pagosOctubre,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosOctubre-$pagosOctubre,2);?>
        </p>
        </td>        
<!-- TERMINA OCTUBRE -->  




















<!-- COMIENZA NOVIEMBRE -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'11'.'-'.'01';
$fechaFinal=$year.'-'.'11'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
and
gpoProducto!=''



";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosNoviembre=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosNoviembre=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosNoviembre[0]+=$cargosNoviembre;
                echo '$'.number_format($cargosNoviembre,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosNoviembre[0]+=$pagosNoviembre;
                echo '$'.number_format($pagosNoviembre,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosNoviembre-$pagosNoviembre,2);?>
        </p>
        </td>        
<!-- TERMINA NOVIEMBRE -->  














<!-- COMIENZA DICIEMBRE -->  
<?php 
//***************************CARGOS*********************


$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.'12'.'-'.'01';
$fechaFinal=$year.'-'.'12'.'-'.'31';

$sSQL1c="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='C'
and
gpoProducto!=''



";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1cdev="SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
naturaleza='A'
AND
gpoProducto!=''

";
$result1cdev=mysql_db_query($basedatos,$sSQL1cdev);
$myrow1cdev = mysql_fetch_array($result1cdev);


$cargosDiciembre=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
//****************************************************


//**********************ABONOS DE ASEGURADORA***************
$sSQL1abo="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='abaseg'  ";
$result1abo=mysql_db_query($basedatos,$sSQL1abo);
$myrow1abo = mysql_fetch_array($result1abo);


$sSQLdevAbo="SELECT sum(precioVenta*cantidad)  as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$myrow2['numCliente']."'
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')
and
tipoTransaccion='DEVABOASEG' ";
$resultdevAbo=mysql_db_query($basedatos,$sSQLdevAbo);
$myrowdevAbo = mysql_fetch_array($resultdevAbo);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow2['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
(fecha1>='".$fechaInicial."' and fecha1<='".$fechaFinal."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
$pagosDiciembre=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>
       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargosDiciembre[0]+=$cargosDiciembre;
                echo '$'.number_format($cargosDiciembre,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagosDiciembre[0]+=$pagosDiciembre;
                echo '$'.number_format($pagosDiciembre,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargosDiciembre-$pagosDiciembre,2);?>
        </p>
        </td>        
<!-- TERMINA DICIEMBRE -->  



























        
        
        
        
        

      </tr>

     <?php  


	 }//cierra while?>
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
<tr class="success">	      
    
  <td  class="precio1" align="right">
	<p>
	
        </p>
        </td>	     
    
    
  <td  class="precio1" align="left">
	<p>
	TOTALES
        </p>
        </td>	 
    

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosEnero[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosEnero[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosEnero[0]-$sumaPagosEnero[0],2);?>
        </p>
        </td>   
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosFebrero[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosFebrero[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosFebrero[0]-$sumaPagosFebrero[0],2);?>
        </p>
        </td>   
        
        
        
        
        
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosMarzo[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosMarzo[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosMarzo[0]-$sumaPagosMarzo[0],2);?>
        </p>
        </td>   
  
        

  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosAbril[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosAbril[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosAbril[0]-$sumaPagosAbril[0],2);?>
        </p>
        </td>           
        
        
        
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosMayo[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosMayo[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosMayo[0]-$sumaPagosMayo[0],2);?>
        </p>
        </td>   
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosJunio[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosJunio[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosJunio[0]-$sumaPagosJunio[0],2);?>
        </p>
        </td>     
        
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosJulio[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosJulio[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosJulio[0]-$sumaPagosJulio[0],2);?>
        </p>
        </td>   
        
        
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosAgosto[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosAgosto[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosAgosto[0]-$sumaPagosAgosto[0],2);?>
        </p>
        </td>   
        
        
        
        
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosDiciembre[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosDiciembre[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosSeptiembre[0]-$sumaPagosSeptiembre[0],2);?>
        </p>
        </td>   
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosOctubre[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosOctubre[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosOctubre[0]-$sumaPagosOctubre[0],2);?>
        </p>
        </td>   
        
        
        
        
        
        
        
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosNoviembre[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosNoviembre[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosNoviembre[0]-$sumaPagosNoviembre[0],2);?>
        </p>
        </td>         
        
      
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosDiciembre[0],2);?>
        </p>
        </td>        
        
           
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagosDiciembre[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargosDiciembre[0]-$sumaPagosDiciembre[0],2);?>
        </p>
        </td>    
</tr>        
	 
	 
   
   </table>
   <p class="titulomedio">&nbsp;</p>
 </div>
</form>

 
</body>
</html>