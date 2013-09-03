<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 
<?php
$numeroE=$_GET['numeroE'];
$nCuenta=$_GET['nCuenta'];
?>


<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
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
<title></title>

<?php
$estilo= new muestraEstilos();
$estilo-> styles();
?>
</head>

<body>
 <h1 align="center" >Reporte de Transacciones </h1>
 <form id="form2" name="form2" method="post" >
 <p align="center">

   <label>
   <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
   </label>
   <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" />
   <label>
   <input name="search" type="submit"  id="button" value="Buscar" />
   </label>
 </p>

 <table width="754" class="table table-striped">
     <tr >
       <th width="27"   scope="col">&nbsp;</th>
       
       

       


	   

       <th width="30"   scope="col"><div align="left" >
         <div align="center">Recibo</div>
       </div></th>
       <th width="344"   scope="col"><div align="left" >
         <div align="left">Descripcion</div>
       </div></th>
       <th width="78"   scope="col"><div align="left" >
         <div align="center">Cajero</div>
       </div></th>

       
       <th width="48"   scope="col"><div align="left" >
         <div align="center">Debe</div>
       </div></th>
       <th width="98"   scope="col"><div align="left" >
         <div align="center">Haber</div>
       </div></th>
   </tr>
     <?PHP if($_POST['search']!=NULL){?>
     <tr >
<?php   
$sSQL= "Select * From cargosCuentaPaciente where entidad='".$entidad."'
and
gpoProducto=''
and
fecha1='".$_POST['fechaInicial']."'
    and
    naturaleza!='-'
    and
    numRecibo!=0
   and tipoTransaccion!=''
   and
   precioVenta>0
order by numRecibo ASC

;
";
$result=mysql_db_query($basedatos,$sSQL); 

	

while($myrow = mysql_fetch_array($result)){
$a+=1;



$sSQL22b= "Select nomCliente From clientes WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['seguro']."'

";
$result22b=mysql_db_query($basedatos,$sSQL22b);
$myrow22b = mysql_fetch_array($result22b);


if($myrow['naturaleza']=='A'){
$abonos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$signo=NULL;
}else if($myrow['naturaleza']=='C'){
$cargos[0]+=$myrow['precioVenta']*$myrow['cantidad'];

}



if($myrow['clientePrincipal']){
$sSQL22b1= "Select nomCliente From clientes WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['clientePrincipal']."'

";
$result22b1=mysql_db_query($basedatos,$sSQL22b1);
$myrow22b1 = mysql_fetch_array($result22b1);

}


if($myrow['tipoCuenta']=='D'){
$debe[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}


if($myrow['tipoCuenta']=='H'){
$haber[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}



?>
<tr >
 <td bgcolor="<?php echo $color;?>" ><?php echo $a; ?></td> 


 

 
       <td bgcolor="<?php echo $color;?>" >
	   
	   
	   
	   
	   
	   <span >
          
<a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>
		  
	  
	
	   
	   

	   </span></td>
       <td bgcolor="<?php echo $color;?>" ><div align="left"><?php 
	   echo $myrow['descripcionArticulo'];
	   if($myrow22b1['nomCliente']){
	   echo '</br>';
	   echo '<span class="codigos">';
	   echo '[ '.$myrow22b1['nomCliente'].' ]';
	   echo '</span>';
	   }
	   ?></div></td>
       <td bgcolor="<?php echo $color;?>" >
         <div align="center">
           <?php 
	 
	   echo $myrow['usuario'];
	 
	   ?>
       </span></span></div></td>



       
       
       

       <td bgcolor="<?php echo $color;?>" ><div align="right">
         <?php 
	 if($myrow['naturaleza']=='C'){
	   echo $signo."$".number_format($myrow['precioVenta']*$myrow['cantidad'],2);
	 }
	   ?>
         </span></span></div></td>
       <td bgcolor="<?php echo $color;?>" ><div align="right">
         <?php 
		 if($myrow['naturaleza']=='A'){
	   echo $signo."$".number_format($myrow['precioVenta']*$myrow['cantidad'],2);
	 }
	   ?>
       </span></span></div></td>
    </tr>
	
	<?php 

	switch ($myrow['tipoPago']) {

   case "Efectivo" :
	 $efectivo[0]+=$myrow['precioVenta']*$myrow['cantidad'];
   break;

   case "Tarjeta de Credito" :
 	$tarjetaCredito[0]+=$myrow['precioVenta']*$myrow['cantidad'];
   break;

   case "Transferencia Electronica" :
   
 	$transferencia[0]+=$myrow['precioVenta']*$myrow['cantidad'];
   break;

   case "Cheque" :
 	$cheque[0]+=$myrow['precioVenta']*$myrow['cantidad'];
   break;
   
   case "Nomina" :
   $nomina[0]+=$myrow['precioVenta']*$myrow['cantidad'];
   break;

   case "Cuentas por Cobrar" :
 	$cxc[0]+=$myrow['precioVenta']*$myrow['cantidad'];
   break;
}


  /*  default :
    return 'Sin Transaccion';
   break; */

   }	 
   

     }
   ?>
   </table>

<p>&nbsp;</p>
<div >
  <div align="center">Importe total: <?php echo '$'.number_format($debe[0]-$haber[0],2);?></div>
</div></p>
 </form>
<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 

</body>
</html>