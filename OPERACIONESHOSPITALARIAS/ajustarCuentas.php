<?PHP require("menuOperaciones.php"); ?>


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventana111","width=900,height=700,scrollbars=YES,resizable=YES, maximizable=YES") 
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

<?php   
 if($_POST['fechaInicial']){
		 $date= $_POST['fechaInicial'];
		 }else{
                 $date= $fecha1;
                 }
         
                 
                  if($_POST['fechaFinal']){
		 $date1= $_POST['fechaFinal'];
		 }else{
                 $date1= $fecha1;
                 }
?>                 
  

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
<table width="570" class="table-striped">   
    
        <tr>
        <td  >&nbsp;</td>
        <td  ></td>
       
          <label>
            <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		echo $date;
		 ?>" />
          </label>
        <input name="button" type="image" src="../imagenes/calendario.png" id="lanzador" value="..." /> 

      </tr>
    
    
    <tr>
        <td  >&nbsp;</td>
        <td  ></td>
       
          <label>
            <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="10" readonly=""
		value="<?php
		echo $date1;
		 ?>" />
          </label>
        <input name="button" type="image" src="../imagenes/calendario.png" id="lanzador1" value="..." /> 

      </tr>    
      
      
      
         <tr>
        <td >&nbsp;</td>
        <td  ></td>
       
          <label>
            <input name="ir" type="submit" value="Buscar" />
          </label>
        

      </tr> 
    </table>
    </h4>
    
<?php if($_POST['ir']!=NULL){?>  
  <table width="570" class="table-striped">

    <tr >
         <th width="40" >#</th>

      <th width="40" >Folio</th>
      <th width="100" >Datos del Paciente</th>
      <th width="100" >Aseguradora</th>
      <th width="50" >Actual</th>
      <th width="50" >Historial</th>
    </tr>
<?php	
	  

 $sSQL= "SELECT *
FROM
historialCuentas 
WHERE 
entidad='".$entidad."'
and
(fechaCargo>='".$date."' and fechaCargo<='".$date1."')
group by folioVenta
ORDER BY folioVenta ASC";

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
	  ?>    
    
    
   <tr  > 
       
             <td height="40"><span ><?php echo $a;
?></span></td>
             
       
       
       
      <td height="40"><span ><?php echo $myrow['folioVenta'];
?></span></td>
      
      

      
      
      
      
      <td>
    
	  <?php echo $myrowf['paciente'];

	  ?>

        <br /><span >Departamento: 
      <?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></td>
        
        
     
        
        
        
      <td ><?php echo $myrow40['nomCliente'];?><br />
	<span >  Cuarto: 
	  <?php 
	  if($myrow['cuarto']){
	  echo $myrow['cuarto'];
	  }else{
	  echo '---';
	  }
?></span></td>    
   

      
      
      
      
      
        <td>
            <a href="#abonos<?php echo $a;?>" name="abonos<?php echo $a;?>" id="abonos<?php echo $a;?>" 
onclick="javascript:ventanaSecundaria11('../ventanas/verDetallesHistorial.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>')">
	  Ver
          </a>    
        </td>       
        
        
        
        
 <td >
         
<a href="#abonos<?php echo $a;?>" name="abonos<?php echo $a;?>" id="abonos<?php echo $a;?>" 
onclick="javascript:ventanaSecundaria11('../ventanas/verHistorialPaginado.php?paciente=<?php echo $myrowf['paciente'];?>&numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>')">
Ver
</a>    
         
    </td>    
    
    
    <?php  }}?>
    
     </tr>
</table>
<?php } ?> 
    
    
    
    
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