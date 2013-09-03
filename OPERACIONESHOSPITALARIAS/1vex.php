<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");
$almacenDestino=$almacen;
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoDespliegaFecha=$_GET['campoDespliegaFecha'];
require("/configuracion/componentes/comboAlmacen.php"); 
$ALMACEN=$_GET['datawarehouse'];
?>




 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script> 
  
  
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 
  <script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=600,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
  <script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=660,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=700,scrollbars=YES") 
} 
</script> 



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>





<body>


</head>
<body>
<form id="form1" name="form1" method="GET" action="#">

  <h1 align="center">
    <?php 
  //**************VERIFICAR EL ESTADO DE LA CITA*****************

if(!$_GET['fechaSolicitud']){
$_GET['fechaSolicitud']=$fecha1;
}


if($myrow6['descripcion']){
echo $myrow6['descripcion'];
} 

//**************************************************************
?></h1>
	   <div align="center"><span >
        <input name="fechaInicial" type="text"  id="campo_fecha"
	  value="<?php 
	  if($_GET['fechaInicial']){
	  echo $fecha2=$_GET['fechaInicial'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="10" readonly="readonly" />
      </span>
      <span >
      <input name="fechaFinal" type="text"  id="campo_fecha1"
	  value="<?php 
	  if($_GET['fechaFinal']){
	  echo $fecha2=$_GET['fechaFinal'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="10" readonly="readonly" />
      </span></div>
      
      <div align="center"><span >
        <input name="button" type="image"  id="lanzador" value="cargar"  src="../imagenes/btns/fechadate.png" />
      </span>&nbsp;&nbsp;<span >
          <input name="button2"  type="image"  id="lanzador1" value="cargar"  src="../imagenes/btns/fechadate.png" />
      </span></div><p>&nbsp;
        </p>
        <p>
          <input name="Desplegar" type="submit"  id="Desplegar" value="Desplegar Registros" />
      </p>
<br /><br />

  <table class="table table-striped" width="775" >
    <tr >
        <th width="5"  scope="col"><div align="left"><span >#</span></div></th>
      <th width="85"  scope="col"><div align="left"><span >FechaCrea</span></div></th>
      <th width="50" height="19"  scope="col"><div align="left"><span ># Exp. </span></div></th>
      <th width="270"  scope="col"><div align="left"><span >Paciente</span></div></th>
      <th width="296"  scope="col"><div align="left"><span >M&eacute;dico</span></div></th>
      <th width="52"  scope="col"><div align="left"><span >Usuario</span></div></th>
    </tr>
    <tr >
    
<?php 

if($_GET['Desplegar']){ 	 
$sSQL11= "Select * from pacientes,clientesInternos WHERE 
pacientes.entidad='".$entidad."' 
and
pacientes.fechaCreacion between '".$_GET['fechaInicial']."' and '".$_GET['fechaFinal']."'
and
clientesInternos.almacen='".$ALMACEN."'
and
pacientes.numCliente=clientesInternos.numeroE
and
clientesInternos.primeraVez='si'
group by clientesInternos.numeroE

order by keyClientesInternos ASC
";

$result11=mysql_db_query($basedatos,$sSQL11);
	

while($myrow11 = mysql_fetch_array($result11)){ 
$totalRegistros+=1;

if($col){
$color = '#FFFFCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$sSQL1= "Select nombreCompleto From medicos WHERE entidad='".$entidad."' and numMedico='".$myrow11['medico']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>

        
        <td  ><?php echo $totalRegistros;?></td>
        <td  ><?php echo cambia_a_normal($myrow11['fechaCreacion']);?></td>
      <td  ><?php echo $myrow11['numCliente'];?>&nbsp;</td>
      <td  ><?php echo $myrow11['nombreCompleto'];?>&nbsp;</td>
      <td  ><?php echo $myrow1['nombreCompleto'];?></td>
      <td  ><?php echo $myrow11['usuario'];?></td>
    </tr>
    <?php }?>
  </table>

<p>&nbsp;</p>
  <tr>
    <td>
    
      <div align="center" class="style12">
	  
	  <?php 
	  if($totalRegistros>0){
	  echo 'Se encontraron '.$totalRegistros.' pacientes de 1era vez'; 
	  }}
	  ?>
	  </div>

                       
    
    <input name="main" type="hidden" value="<?php echo $_GET['main'];?>">
    <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>">
    <input name="datawarehouse" type="hidden" value="<?php echo $_GET['datawarehouse'];?>"> 
</form>


<p>&nbsp; </p>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script>
</body>
</html>
