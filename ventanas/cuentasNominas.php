<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include('/configuracion/funciones.php'); ?>
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
                alert("Por Favor, escribe la descripción de este clientePrincipal!")   
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
$sSQL7ab="SELECT medicos 
FROM
gpoProductos
WHERE
codigoGP='".$_GET['gpoProducto']."'

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
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
<?php
// The message
$message = "Line 1\nLine 2\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);

// Send
//mail('hlacarlota@', 'My Subject', $message);
?>
<br />
<br />
<form id="form2" name="form2" method="post"><div align="center">
     <h1 class="titulomedio">
Consumo de Aseguradoras</h1>
     <p class="titulomedio"><?php echo $_GET['nomSeguro'];?></p>
     <p class="titulomedio"> PACIENTES EXTERNOS</p>
     <table width="1500" class="table table-striped"	>

     <tr bgcolor="#FFFF00">
  <td width="207" bgcolor="#FFFF00" class="negromid"><div align="center">Empleado</div></td>
  <?php 
$sSQLgp="SELECT  *
FROM
gpoProductos
WHERE
entidad='".$entidad."'   
order by descripcionGP
";
$resultgp=mysql_db_query($basedatos,$sSQLgp);
while($myrowgp = mysql_fetch_array($resultgp)){
 ?>
       <td width="90" bgcolor="#FFFF00" class="normal">
         <p>
  <?php 
$sSQLgp1="SELECT  *
FROM
gpoProductos
WHERE
entidad='".$entidad."'  
and
codigoGP='".$myrowgp['codigoGP']."'  ";
$resultgp1=mysql_db_query($basedatos,$sSQLgp1);
$myrowgp1 = mysql_fetch_array($resultgp1);
echo $myrowgp1['descripcionGP'];
?>
           
  </p>
         <p>
  <?php


			?>
           
           </p>
         
        </td>
       <?php } ?>
       
       
       
       
       
       
       <td width="90" bgcolor="#FFFF00" class="normal" align="right">
         <p><span class="negromid"> PARTICULAR </span></p>
         
         
        </td>
       
       
       
       <td width="90" bgcolor="#FFFF00" class="normal" align="right">
         <p><span class="negromid"> ASEGURADORA </span></p>
         
         
        </td>
       
       
       
       
       
       
       
       
       
       <td width="90" bgcolor="#FFFF00" class="normal" align="right">
         <p><span class="negromid">TOTAL</span></p>
         
         
        </td>
       
       
       
       
       
       
       
     </tr>
<?php 


$sSQL2= "
Select * From cargosCuentaPaciente 
where 
entidad='".$entidad."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
group by folioVenta
order by folioVenta ASC
";
 

  
$result2=mysql_db_query($basedatos,$sSQL2); 
while($myrow2 = mysql_fetch_array($result2)){


$sSQL6= "Select * From clientesInternos where entidad='".$entidad."' and folioVenta='".$myrow2['folioVenta']."'";
$result6=mysql_db_query($basedatos,$sSQL6); 
$myrow6 = mysql_fetch_array($result6);
?>

     <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
       <td height="48" bgcolor="<?php echo $color;?>" class="normal"><div align="left">
         <?php 
/*  echo $myrow6['numCliente'];
 echo '<br>'; */
 echo $myrow6['paciente'];
  		   echo '<br>'; 
  echo $myrow6['tipoPaciente'];
 		   echo '<br>'; 
 echo '<span class="codigos">'.$myrow2['folioVenta'].'</span>';		
 		   echo '<br>'; 
 echo '<span class="codigos">Credencial: '.$myrow6['credencial'].'</span>';		
   
		  ?>
       </div></td>

<?php 
$sSQLgp2="SELECT  *
FROM
gpoProductos
WHERE
entidad='".$entidad."'   
order by descripcionGP
";
$resultgp2=mysql_db_query($basedatos,$sSQLgp2);
while($myrowgp2 = mysql_fetch_array($resultgp2)){?>
       <td bgcolor="<?php echo $color;?>" class="normal">
	     <p>
	       <?php 

$sSQLc2= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and

gpoProducto='".$myrowgp2['codigoGP']."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='C'


";
$resultc2=mysql_db_query($basedatos,$sSQLc2); 
$myrowc2 = mysql_fetch_array($resultc2);		   

	   
$sSQLa2= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
gpoProducto='".$myrowgp2['codigoGP']."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='A'


";
$resulta2=mysql_db_query($basedatos,$sSQLa2); 
$myrowa2 = mysql_fetch_array($resulta2);		   


echo '$'.number_format($myrowc2['c']-$myrowa2['a'],2);
?>



        </p>
        </td>
		
		
		
		
		
<?php } ?>









	          <td bgcolor="<?php echo $color;?>" class="informativo" align="right">
	     <p>
		 
<?php 
//***************************************PARTICULAR ***********************************
$sSQLc3= "
SELECT sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='C'
and
gpoProducto!=''


";
$resultc3=mysql_db_query($basedatos,$sSQLc3); 
$myrowc3 = mysql_fetch_array($resultc3);		   

	   
$sSQLa3= "
SELECT sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='A'
and
gpoProducto!=''

";
$resulta3=mysql_db_query($basedatos,$sSQLa3); 
$myrowa3 = mysql_fetch_array($resulta3);		   


//************************************************************************************	   
$totalParticular=$myrowc3['c']-$myrowa3['a'];
?>
		 
		 <?php echo '<span align="center">'.'$'.number_format($myrowc3['c']-$myrowa3['a'],2).'</span>';?>
        </p>
        </td>





	          <td bgcolor="<?php echo $color;?>" class="informativo" align="center">
	     <p>
		 
<?php 
//***************************************PARTICULAR ***********************************
$sSQLc4= "
SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='C'
and
gpoProducto!=''

";
$resultc4=mysql_db_query($basedatos,$sSQLc4); 
$myrowc4 = mysql_fetch_array($resultc4);		   

	   
$sSQLa4= "
SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='A'
and
gpoProducto!=''

";
$resulta4=mysql_db_query($basedatos,$sSQLa4); 
$myrowa4 = mysql_fetch_array($resulta4);		   


//************************************************************************************	   
$totalAseguradora=$myrowc4['c']-$myrowa4['a'];
?>

		 
		 <?php echo '<span align="center">'.'$'.number_format($myrowc4['c']-$myrowa4['a'],2).'</span>';?>
        </p>
        </td>




       <td bgcolor="<?php echo $color;?>" class="informativo" align="right">
	     <p>
		 <?php echo '$'.number_format($totalParticular+$totalAseguradora,2);?>
        </p>
        </td>


      </tr>

     <?php  


	 }//cierra while?>
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	      <tr>
		  
		  
		  
		  

		  
		  
	        <td bgcolor="<?php echo $color;?>" class="normal" align="left">
	     <p>
		 Total
        </p>
        </td>
	 
<?php 
$sSQLgp="SELECT  *
FROM
gpoProductos
WHERE
entidad='".$entidad."'   
order by descripcionGP
";
$resultgp=mysql_db_query($basedatos,$sSQLgp);
while($myrowgp = mysql_fetch_array($resultgp)){
 ?>
       <td bgcolor="<?php echo $color;?>" class="normal">
	     <p>
<?php 
$sSQLc5= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')

and
gpoProducto='".$myrowgp['codigoGP']."'
and
naturaleza='C'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'


";
$resultc5=mysql_db_query($basedatos,$sSQLc5); 
$myrowc5 = mysql_fetch_array($resultc5);		   

	   
$sSQLa5= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')

and
gpoProducto='".$myrowgp['codigoGP']."'
and
naturaleza='A'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'

";
$resulta5=mysql_db_query($basedatos,$sSQLa5); 
$myrowa5 = mysql_fetch_array($resulta5);	
?>
	 <?php echo '<span align="center">'.'$'.number_format($myrowc5['c']-$myrowa5['a'],2).'</span>';?>
	   </p>
	   
	   </td>
<?php } ?>	   
	   
	   
	   
	   
	   

	   
	   
	   
	   
	   
	          <td bgcolor="<?php echo $color;?>" class="informativo" align="right">
	     <p>
<?php
//***************************************PRIMERA VEZ***********************************
$sSQLc6= "
SELECT sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')

and

naturaleza='C'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
";
$resultc6=mysql_db_query($basedatos,$sSQLc6); 
$myrowc6 = mysql_fetch_array($resultc6);		   

	   
$sSQLa6= "

SELECT sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')

and
gpoProducto='".$myrowgp['codigoGP']."'
and
naturaleza='A'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
";
$resulta6=mysql_db_query($basedatos,$sSQLa6); 
$myrowa6 = mysql_fetch_array($resulta6);	
//************************************************************************************	   
?>

<?php echo '<span align="center">'.'$'.number_format($myrowc6['c']-$myrowa6['a'],2).'</span>';?>
        </p>
        </td>
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   	   	          <td bgcolor="<?php echo $color;?>" class="informativo" align="center">
	     <p>
<?php
//***************************************PRIMERA VEZ***********************************
$sSQLc7= "
SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')

and

naturaleza='C'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
";
$resultc7=mysql_db_query($basedatos,$sSQLc7); 
$myrowc7 = mysql_fetch_array($resultc7);		   

	   
$sSQLa7= "
SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')

and

naturaleza='A'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
";
$resulta7=mysql_db_query($basedatos,$sSQLa7); 
$myrowa7 = mysql_fetch_array($resulta7);	
//************************************************************************************	   
?>

<?php echo '<span align="center">'.'$'.number_format($myrowc7['c']-$myrowa7['a'],2).'</span>';?>       
</p>
        </td>
	   
	   
	   
	   
	   
	   
	   
	   
	          <td bgcolor="<?php echo $color;?>" class="informativo" align="right">
	     <p>
<?php
//***************************************PRIMERA VEZ***********************************
$sSQLc8= "Select sum(efectivo+iva) as c  From reportesFinancieros where random='".$_GET['random']."'    
and

naturaleza='C'
";
$resultc8=mysql_db_query($basedatos,$sSQLc8); 
$myrowc8 = mysql_fetch_array($resultc8);		   

	   
$sSQLa8= "Select sum(efectivo+iva) as a  From reportesFinancieros where random='".$_GET['random']."'    
and

naturaleza='A'
";
$resulta8=mysql_db_query($basedatos,$sSQLa8); 
$myrowa8 = mysql_fetch_array($resulta8);	
//************************************************************************************	   
?>

<?php echo '<span align="center">'.'$'.number_format($myrowc8['c']-$myrowa8['a'],2).'</span>';?>       
        </p>
        </td>
     </tr>
	 
	 
	 
	 
	 

   </table>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p>VENTAS INTERNOS </p>
     <table width="1500" class="table table-striped" >

       <tr bgcolor="#FFFF00">
         <td width="207" bgcolor="#FFFF00" class="negromid"><div align="center">Empleado</div></td>
         <?php 
$sSQLgp="SELECT  *
FROM
gpoProductos
WHERE
entidad='".$entidad."'   
order by descripcionGP
";
$resultgp=mysql_db_query($basedatos,$sSQLgp);
while($myrowgp = mysql_fetch_array($resultgp)){
 ?>
         <td width="90" bgcolor="#FFFF00" class="normal"><p>
             <?php 
$sSQLgp1="SELECT  *
FROM
gpoProductos
WHERE
entidad='".$entidad."'  
and
codigoGP='".$myrowgp['codigoGP']."'  ";
$resultgp1=mysql_db_query($basedatos,$sSQLgp1);
$myrowgp1 = mysql_fetch_array($resultgp1);
echo $myrowgp1['descripcionGP'];
?>
           </p>
             <p>
               <?php


			?>
           </p></td>
         <?php } ?>
         <td width="90" bgcolor="#FFFF00" class="normal" align="right"><p><span class="negromid"> PARTICULAR </span></p></td>
         <td width="90" bgcolor="#FFFF00" class="normal" align="right"><p><span class="negromid"> ASEGURADORA </span></p></td>
         <td width="90" bgcolor="#FFFF00" class="normal" align="right"><p><span class="negromid">TOTAL</span></p></td>
       </tr>
       <?php 


$sSQL2= "
Select * From cargosCuentaPaciente 
where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
statusCargo='cargado'
group by folioVenta
order by folioVenta ASC
";
 

  
$result2=mysql_db_query($basedatos,$sSQL2); 
while($myrow2 = mysql_fetch_array($result2)){


$sSQL6= "Select * From clientesInternos where entidad='".$entidad."' and folioVenta='".$myrow2['folioVenta']."'";
$result6=mysql_db_query($basedatos,$sSQL6); 
$myrow6 = mysql_fetch_array($result6);
?>
       <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
         <td height="48" bgcolor="<?php echo $color;?>" class="normal"><div align="left">
             <?php 
/*  echo $myrow6['numCliente'];
 echo '<br>'; */
 echo $myrow6['paciente'];
  		   echo '<br>'; 
  echo $myrow6['tipoPaciente'];
 		   echo '<br>'; 
 echo '<span class="codigos">'.$myrow2['folioVenta'].'</span>';		
 		   echo '<br>'; 
 echo '<span class="codigos">Credencial: '.$myrow6['credencial'].'</span>';		
   
		  ?>
         </div></td>
         <?php 
$sSQLgp2="SELECT  *
FROM
gpoProductos
WHERE
entidad='".$entidad."'   
order by descripcionGP
";
$resultgp2=mysql_db_query($basedatos,$sSQLgp2);
while($myrowgp2 = mysql_fetch_array($resultgp2)){?>
         <td bgcolor="<?php echo $color;?>" class="normal"><p>
             <?php 

$sSQLc2= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and

gpoProducto='".$myrowgp2['codigoGP']."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='C'
and
statusCargo='cargado'

";
$resultc2=mysql_db_query($basedatos,$sSQLc2); 
$myrowc2 = mysql_fetch_array($resultc2);		   

	   
$sSQLa2= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
gpoProducto='".$myrowgp2['codigoGP']."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='A'
and
statusCargo='cargado'

";
$resulta2=mysql_db_query($basedatos,$sSQLa2); 
$myrowa2 = mysql_fetch_array($resulta2);		   


echo '$'.number_format($myrowc2['c']-$myrowa2['a'],2);
?>
         </p></td>
         <?php } ?>
         <td bgcolor="<?php echo $color;?>" class="informativo" align="right"><p>
             <?php 
//***************************************PARTICULAR ***********************************
$sSQLc3= "
SELECT sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='C'
and
gpoProducto!=''
and
statusCargo='cargado'

";
$resultc3=mysql_db_query($basedatos,$sSQLc3); 
$myrowc3 = mysql_fetch_array($resultc3);		   

	   
$sSQLa3= "
SELECT sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='A'
and
gpoProducto!=''
and
statusCargo='cargado'

";
$resulta3=mysql_db_query($basedatos,$sSQLa3); 
$myrowa3 = mysql_fetch_array($resulta3);		   


//************************************************************************************	   
$totalParticular=$myrowc3['c']-$myrowa3['a'];
?>
             <?php echo '<span align="center">'.'$'.number_format($myrowc3['c']-$myrowa3['a'],2).'</span>';?> </p></td>
         <td bgcolor="<?php echo $color;?>" class="informativo" align="center"><p>
             <?php 
//***************************************PARTICULAR ***********************************
$sSQLc4= "
SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='C'
and
gpoProducto!=''
and
statusCargo='cargado'

";
$resultc4=mysql_db_query($basedatos,$sSQLc4); 
$myrowc4 = mysql_fetch_array($resultc4);		   

	   
$sSQLa4= "
SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow2['folioVenta']."'
and
naturaleza='A'
and
gpoProducto!=''
and
statusCargo='cargado'

";
$resulta4=mysql_db_query($basedatos,$sSQLa4); 
$myrowa4 = mysql_fetch_array($resulta4);		   


//************************************************************************************	   
$totalAseguradora=$myrowc4['c']-$myrowa4['a'];
?>
             <?php echo '<span align="center">'.'$'.number_format($myrowc4['c']-$myrowa4['a'],2).'</span>';?> </p></td>
         <td bgcolor="<?php echo $color;?>" class="informativo" align="right"><p> <?php echo '$'.number_format($totalParticular+$totalAseguradora,2);?> </p></td>
       </tr>
       <?php  


	 }//cierra while?>
       <tr>
         <td bgcolor="<?php echo $color;?>" class="normal" align="left"><p> Total </p></td>
         <?php 
$sSQLgp="SELECT  *
FROM
gpoProductos
WHERE
entidad='".$entidad."'   
order by descripcionGP
";
$resultgp=mysql_db_query($basedatos,$sSQLgp);
while($myrowgp = mysql_fetch_array($resultgp)){
 ?>
         <td bgcolor="<?php echo $color;?>" class="normal"><p>
             <?php 
$sSQLc5= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')

and
gpoProducto='".$myrowgp['codigoGP']."'
and
naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
statusCargo='cargado'

";
$resultc5=mysql_db_query($basedatos,$sSQLc5); 
$myrowc5 = mysql_fetch_array($resultc5);		   

	   
$sSQLa5= "
SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')

and
gpoProducto='".$myrowgp['codigoGP']."'
and
naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
statusCargo='cargado'
";
$resulta5=mysql_db_query($basedatos,$sSQLa5); 
$myrowa5 = mysql_fetch_array($resulta5);	
?>
             <?php echo '<span align="center">'.'$'.number_format($myrowc5['c']-$myrowa5['a'],2).'</span>';?> </p></td>
         <?php } ?>
         <td bgcolor="<?php echo $color;?>" class="informativo" align="right"><p>
             <?php
//***************************************PRIMERA VEZ***********************************
$sSQLc6= "
SELECT sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')

and

naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
and
statusCargo='cargado'
";
$resultc6=mysql_db_query($basedatos,$sSQLc6); 
$myrowc6 = mysql_fetch_array($resultc6);		   

	   
$sSQLa6= "

SELECT sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')

and
gpoProducto='".$myrowgp['codigoGP']."'
and
naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
statusCargo='cargado'
";
$resulta6=mysql_db_query($basedatos,$sSQLa6); 
$myrowa6 = mysql_fetch_array($resulta6);	
//************************************************************************************	   
?>
             <?php echo '<span align="center">'.'$'.number_format($myrowc6['c']-$myrowa6['a'],2).'</span>';?> </p></td>
         <td bgcolor="<?php echo $color;?>" class="informativo" align="center"><p>
             <?php
//***************************************PRIMERA VEZ***********************************
$sSQLc7= "
SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')

and

naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
and
statusCargo='cargado'
";
$resultc7=mysql_db_query($basedatos,$sSQLc7); 
$myrowc7 = mysql_fetch_array($resultc7);		   

	   
$sSQLa7= "
SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')

and

naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
and
statusCargo='cargado'
";
$resulta7=mysql_db_query($basedatos,$sSQLa7); 
$myrowa7 = mysql_fetch_array($resulta7);	
//************************************************************************************	   
?>
             <?php echo '<span align="center">'.'$'.number_format($myrowc7['c']-$myrowa7['a'],2).'</span>';?> </p></td>
         <td bgcolor="<?php echo $color;?>" class="informativo" align="right"><p>
             <?php
//***************************************PRIMERA VEZ***********************************
$sSQLc8= "

SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as c  
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')

and

naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
and
statusCargo='cargado'

";
$resultc8=mysql_db_query($basedatos,$sSQLc8); 
$myrowc8 = mysql_fetch_array($resultc8);		   

	   
$sSQLa8= "

SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as a
FROM
cargosCuentaPaciente where 
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')

and

naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
ventasDirectas!='si'
and
clientePrincipal='".$_GET['seguro']."'
and
gpoProducto!=''
and
statusCargo='cargado'
";
$resulta8=mysql_db_query($basedatos,$sSQLa8); 
$myrowa8 = mysql_fetch_array($resulta8);	
//************************************************************************************	   
?>
             <?php 
			 //echo '<span align="center">'.'$'.number_format($myrowc8['c']-$myrowa8['a'],2).'</span>';
			 ?> </p></td>
       </tr>

     </table>
     <p>&nbsp;</p>
    <p>&nbsp;</p>
   </div>
</form>

 
</body>
</html>