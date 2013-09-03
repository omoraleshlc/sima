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
Estadisticas por Seguros</h1>
 
           <p class="titulomedio">

       Mes  <?php echo $_GET['mes'];?>, del ano: <?php echo $_GET['year'];?>

   </p>
   
   <table width="500" align="center">

     
  
     
   
  <td width="5"  class="negromid"><div align="left">#</div></td>         
       <td width="100"  class="negromid"><div align="left">Seguro</div></td>
	    <td width="40"  class="precio1" align="left"><p>Cargos</p></td>
            <td width="40"  class="precio1" align="left"><p>Pagos</p></td>
            <td width="40"  class="precio1" align="left"><p>Saldos</p></td>



	


     
     
     
     
     
<?php 




  $sSQL2= "Select * From clientes
      where
      entidad='".$entidad."'
          and
          subCliente!='si'
          order by nomCliente ASC

 ";
$result2=mysql_db_query($basedatos,$sSQL2); 
while($myrow2 = mysql_fetch_array($result2)){
$a+=1;







$year=substr($_GET['year'],0,4);
$fechaInicial=$year.'-'.$_GET['mesNumerico'].'-'.'01';
$fechaFinal=$year.'-'.$_GET['mesNumerico'].'-'.'31';






//***************************CARGOS*********************
$sSQL1c="SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as traslados

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

$sSQL1cdev="SELECT 

sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devoluciones

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


$cargos=$myrow1c['traslados']-$myrow1cdev['devoluciones'];
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
$pagos=$myrow1abo['abonos']-($myrowdevAbo['devoluciones']-$myrownc['nc']);

//**************************************************
?>

     <tr >
         <td  class="normal"><div align="left"><?php echo $a;?></div></td>
             
         
         
         
       <td  class="normal"><div align="left">
         <?php 

         
 echo $myrow2['nomCliente'];
         	  ?>
       </div></td>














       <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaCargos[0]+=$cargos;
                echo '$'.number_format($cargos,2);?>
        </p>
        </td>


  <td  class="precio1" align="right">
	     <p>
		<?php 
                $sumaPagos[0]+=$pagos;
                echo '$'.number_format($pagos,2);?>
        </p>
        </td>

        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($cargos-$pagos,2);?>
        </p>
        </td>        
        
        

      </tr>

     <?php  


	 }//cierra while?>
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
<tr class="success">	      
    
  <td  class="precio1" align="right">
	<p>
	TOTALES
        </p>
        </td>	 
    

        
  <td  class="precio1" align="right">
	<p>

        </p>
        </td>
        
      
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargos[0],2);?>
        </p>
        </td>        
        
     
        
        
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaPagos[0],2);?>
        </p>
        </td>        
        
    
  <td  class="precio1" align="right">
	<p>
	<?php echo '$'.number_format($sumaCargos[0]-$sumaPagos[0],2);?>
        </p>
        </td>    
</tr>        
	 
	 
   
   </table>
   <p class="titulomedio">&nbsp;</p>
 </div>
</form>

 
</body>
</html>