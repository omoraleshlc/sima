<?PHP require("menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language="javascript" type="text/javascript">

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



 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>


	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>
<?php $sSQL1= "SELECT *
FROM
facturaGrupos
WHERE
entidad='".$entidad."'
    and
numFactura='".$_POST['numFactura']."'


";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($_POST['numFactura']!=NULL){
 if($_POST['tipoBusqueda']!=NULL and !$myrow1['numFactura'] ){
$tipoMensaje='error';
$encabezado='ERROR';
$texto='NO SE ENCONTRO LA FACTURA...!';
}
}
?>


<form id="form10" name="form10" method="post">
      <br>
      
  </br>
  <h1 align="center" ><?php echo $TITULO; ?>REPORTE DE FACTURACION</h1>
  
     <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label> 
  <br>
      
  </br>
  <br>
      
  
  Escoje la Opcion
  <select name="tipoBusqueda" onChange="this.form.submit();">
      <option value="">Tipo de Busqueda</option>
      <option
          <?php if($_POST['tipoBusqueda']=='factura')echo 'selected=""';?>
          value="factura">Por #Factura</option>
      <option
          <?php if($_POST['tipoBusqueda']=='fecha')echo 'selected=""';?>
          value="fecha">Rango de Fechas</option>
      
  </select>
  
  
  
  
  <?php if($_POST['tipoBusqueda']!=NULL ){?>
  <table width="522" class="table-forma">
    
      
      <?php  if($_POST['tipoBusqueda']=='factura'){?>
      <tr>
      <td >Introduce el Numero de Factura</td>
      <td ><span >
        
        <label>
        <input name="numFactura" type="text"  id="numFactura" value="<?php echo $_POST['numFactura'];?>" autocomplete="off" />
        </label>
      </span></td>
    </tr>
      <?php } ?>
      
      
          
      <tr>
      <?php  if($_POST['tipoBusqueda']=='fecha'){?>
    <td  >Fecha desde</td>
    <td ><label>
      <input name="fechaInicial" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
    </label>
      <input name="button" type="image" src="../imagenes/calendario.png" id="lanzador" value="..." /></td>
  </tr>
  
  
  
  <tr>

    <td  >Hasta</td>
    <td ><label>
      <input name="fechaFinal" type="text"  id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
    </label>
      <input name="button1" type="image" src="../imagenes/calendario.png" id="lanzador1" value="..." /></td>
  </tr>
<?php }?>


  </table><br />
  
  <label>
        <input type="submit" name="buscar" id="button" value="Buscar" />
      </label>
        <input type="submit" name="nuevo" id="nuevo" value="Nueva Busqueda" />
  <?php } ?>
  
  
  
  

  <p align="center" >
    <label></label>
   
  </p>

  
  
  
  
  
  
  
   <?php if($_POST['buscar'] ){ ?>
  <table width="808" class="table table-striped">
    <tr>
         <th  scope="col"><div align="left">#</div></th>
        <th  scope="col"><div align="left">#Factura</div></th>
   <th  scope="col"><div align="left">Fecha</div></th>
      <th width="74"  scope="col"><div align="left">Referencia</div></th>
      <th width= "181"  scope="col"><div align="left">Seguro</div></th>
      <th  scope="col"><div align="left">Departamento</div></th>
	  <th width="160"  scope="col"><div align="left">Paciente</div>	    <div align="left"></div></th>

	  <th  scope="col"><div align="left" >FAgrup</div></th>
  <th  scope="col"><div align="left" >FDetalle</div></th>
	  <th  scope="col"><div align="left" ><span >ECuenta</span></div></th>
    </tr>
    <tr>
      <?php	


if($_POST['numFactura']!=NULL){
$sSQL= "SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
numFactura='".$_POST['numFactura']."'
and
status='facturado'
group by numFactura
order by numSolicitud ASC
";
}else{
$sSQL= "SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
(fecha>='".$_POST['fechaInicial']."' and fecha<='".$_POST['fechaFinal']."')  
and
status='facturado'    
group by numFactura
order by numSolicitud ASC
";    
}


if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
    $numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQL17ab= "
	SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
    and
folioVenta = '".$myrow['folioVenta']."'
";
$result17ab=mysql_db_query($basedatos,$sSQL17ab);
$myrow17ab = mysql_fetch_array($result17ab);



$sSQL17abc= "
	SELECT 
*
FROM
facturasAplicadas
WHERE 
entidad='".$entidad."'
    and
numFactura = '".$myrow['numFactura']."'
";
$result17abc=mysql_db_query($basedatos,$sSQL17abc);
$myrow17abc = mysql_fetch_array($result17abc);



?>
        
      <td ><?php 
	
  echo $myrow['numSolicitud'];
	  ?></td>            
        
        
      <td ><?php 
	
  echo $myrow['numFactura'];
	  ?></td>        
        
            <td  ><?php 
	if($myrow['fecha']!=NULL){
  echo cambia_a_normal($myrow17abc['fecha']);
        }else{
            echo '---';
        }
	  ?></td>    
      
      
      <td ><?php echo $myrow17abc['folioVenta'];
?></td>


      <td  >



		  <?php 
 $sSQL17a= "
SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
    and
numCliente = '".$myrow17abc['seguro']."'
";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);
if($myrow17ab['clientePrincipal']){
 echo $myrow17a['nomCliente'];
 }else{
 echo 'Particular';
 }
	  ?> 
          
      </span></td>
      
      
      
      

      <td  ><?php
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
    and
almacen = '".$myrow17ab['almacen']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

 echo $myrow17['descripcion'];
?></td>

      
      
      
      <td  >
<?php 
if($myrow17ab['clientePrincipal']){
 echo '---';
}else{
 echo $myrow17ab['paciente'];   
}
?>          
     </td>
     
     
     
     
     
      

      
      <td  ><a href="javascript:ventanaSecundaria('/sima/cargos/printDetailsGroup.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;numFactura=<?php echo $_POST['numFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&numFactura=<?php echo $myrow['numFactura'];?>&seguro=<?php echo $myrow['seguro'];?>&entidad=<?php echo $entidad;?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>')">
       Print</a></td>
      
       
         <td ><a href="javascript:ventanaSecundaria('/sima/cargos/imprimirFolioVentaFactura.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;numFactura=<?php echo $_POST['numFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&numFactura=<?php echo $myrow['numFactura'];?>&seguro=<?php echo $myrow['seguro'];?>&entidad=<?php echo $entidad;?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>')">
       <img src="../imagenes/printer.png" alt="" width="20" height="18" border="0" /></a></td>
       
       
       <td  >
<?php if($myrow17ab['clientePrincipal']){
echo '---';           
}else{
?>   
           <a href="javascript:ventanaSecundaria('../ventanas/imprimirEstadoCuenta.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>')"> <img src="../imagenes/printer.png" alt="" width="20" height="18" border="0" /></a>
<?php   } ?>        
       </td>
    </tr> 
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
 
  <div align="center">
  
    
    
    
    <p>&nbsp;</p>
    
  </div>
    <?php } ?>
</form>
    
    
        <?php  if($_POST['tipoBusqueda']=='fecha'){?>
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
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
    <?php }?>
  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
    

</body>
</html>