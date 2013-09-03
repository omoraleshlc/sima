<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria101 (URL){ 
   window.open(URL,"ventanaSecundaria101","width=900,height=700,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 




             
  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">

<head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
    
    
    
    
    
    

<form name="form1" method="post">
  
  <h1 align="center" > <br />
  Cuentas Recalculadas
  </h1>
    
    
    
<h4>
Paciente: <?php echo $_GET['paciente'];?>, folio: <?php echo $_GET['folioVenta'];?>
    </h4>
    

  <table width="570" class="table-striped">

    <tr >
         <th width="40" >#</th>

      <th width="40" >Fecha</th>
      <th width="100" >Aseguradora</th>
      <th width="100" >Importe</th>
      <th width="50" >ECuenta</th>
    </tr>
<?php	
	  

$sSQL= "SELECT *
FROM
historialHeading 
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
group by numSolicitud


";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
 $sSQLf= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
AND
folioVenta='".$myrow['folioVenta']."'";

$resultf=mysql_db_query($basedatos,$sSQLf);
$myrowf = mysql_fetch_array($resultf);

if($myrow['seguro']){
$sSQL40= "SELECT nomCliente
FROM
clientes
where 
numCliente='".$myrow['seguro']."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
}else{
$myrow40['nomCliente']='Particular';
}








   $sSQL7="SELECT 
sum((precioVenta*cantidad)+(iva*cantidad)) as importe
  FROM
historialCuentas
  WHERE
entidad='".$entidad."'
and
  folioVenta='".$_GET['folioVenta']."'
  and
  naturaleza='C'
  and
  numSolicitud='".$myrow['numSolicitud']."'
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




 $sSQL7d="SELECT 
sum((precioVenta*cantidad)+(iva*cantidad)) as dev
  FROM
historialCuentas
  WHERE
entidad='".$entidad."'
and
  folioVenta='".$_GET['folioVenta']."'
 
    and
  naturaleza='A'
  and
  numSolicitud='".$myrow['numSolicitud']."'
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
  
  $importe=$myrow7['importe']-$myrow7d['dev'];
?>    
    
    
   <tr  > 
       
             <td height="40"><span ><?php echo $a;
?></span></td>
             
       
       
       
      <td height="40"><span ><?php echo cambia_a_normal($myrow['fecha1']);
?></span></td>
      
      

      
      
      
      
     
      <td ><?php print $myrow40['nomCliente']?>
</td> 
        
        
     
        
        
        
      <td ><?php echo '$'.number_format($importe,2);?>
</td>    
   

      
      
      
      
      
        <td>
            <a href="#abonos<?php echo $a;?>" name="abonos<?php echo $a;?>" id="abonos<?php echo $a;?>" 
onclick="javascript:ventanaSecundaria101('../ventanas/verDetallesHistorial.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>')">
	  Ver
          </a>    
        </td>       
        
        
        
        
  
    
    
    <?php  }}?>
    
     </tr>
</table>

    
    
    
    
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