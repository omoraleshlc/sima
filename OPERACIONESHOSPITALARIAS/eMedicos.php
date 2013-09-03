<?php require("menuOperaciones.php"); ?>
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
function ventanaSecundaria(URL){ 
   window.open(URL,"ventanaSecundaria","width=800,height=600,scrollbars=YES") 
} 
</script>


<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-system.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script> 




<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=500,height=500,scrollbars=YES") 
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>
<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>

 <div align="center"></div>
<form id="form2" name="form2" method="POST">
 <div align="center">
   
   <h1>Reporte estadistico de consultas por Medico</h1>

   <table width="500" class="table-forma">
    <tr >
       <td><span >Fecha Inicial </span></td>
       <td>
       <input name="fechaInicial" type="text"  id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaInicial']){
	  echo $fecha2=$_POST['fechaInicial'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" readonly="" />
       
       <span ><span >
         <input name="button" type="image"  id="lanzador" value="cargar"  src="../imagenes/btns/fechadate.png"/>
       </span></span>
       
       </td>
     </tr>
     
     
     
     <tr >
       <td><span >Fecha Final </span></td>
       <td>
      <input name="fechaFinal" type="text"  id="campo_fecha1"
	  value="<?php 
	  if($_POST['fechaFinal']){
	  echo $fecha2=$_POST['fechaFinal'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>"  readonly="" />
       
       <span >
         <input name="button2" type="image"  id="lanzador1" value="cargar"  src="../imagenes/btns/fechadate.png"/>
       </span>
       </td>
     </tr>

   </table>
   <br>
        <span >
         <input type="submit" name="mostrar" id="mostrar" value="Mostrar estadisticas" />
       </span> 
   
   
   <br>
   <br>
<?php if($_POST['mostrar']!=NULL){?>
   <table width="660" class="table table-striped">
     <tr >
         
                  <th width="2" >
         <div align="rigth">#</div>
      </th>
         

      
       
       
       <th width="350" >
           <div align="rigth">Medico</div>
  </th>
       
       
       <th width="50" >
           <div align="rigth">Especialidad</div>
       </th>        
       
       
       
       
       <th width="5"  ><div align="rigth" >Consultas</div></th>
           <th width="5"  ><div align="rigth" >Devoluciones</div></th>
       <th width="30" ><div align="rigth" >
          
           Ver
       
       </div></th>
      </tr>
<?php 	
$medico=$_POST['medico'];

    
    

 $ssql = "select * from cargosCuentaPaciente where 
     
 entidad='".$entidad."'  
    
 and
 medico!=''
 and
 (fechaCierre>= '".$_POST['fechaInicial']."'  and fechaCierre<='".$_POST['fechaFinal']."')
 and
 statusDevolucion!='si'
 and
 folioVenta!=''
 and
 tipoPaciente='externo'
 group by medico 
 order by descripcionMedico ASC
 ";


$result = mysql_db_query($basedatos,$ssql);

while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;

$codigo=$code = $myrow['codigo'];



  
$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "Select numRecibo From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and numRecibo!=0
group by numRecibo        
";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);



$sSQL1m= "Select * From medicos WHERE entidad='".$entidad."' and numMedico='".$myrow['medico']."' ";
$result1m=mysql_db_query($basedatos,$sSQL1m);
$myrow1m = mysql_fetch_array($result1m);  
?>
      
      
      
      
      
      
<tr >
    
    
    
              
<td  >
<?php 
	echo $totalRegistros;
	  ?>
</td>
              
              
              

              
              
 
         
<td  ><?php 

  

echo 'DR(a): '.$myrow1m['nombreCompleto'];




?>
</td>





<td  >
<?php 

$sSQL1e= "Select * From especialidades WHERE codigo='".$myrow1m['especialidad']."' 
";
$result1e=mysql_db_query($basedatos,$sSQL1e);
$myrow1e = mysql_fetch_array($result1e);  

echo $myrow1e['descripcion'];
	  ?>
</td>









       


<td   >
	   <?php 

$sSQLcargos="SELECT 
    sum(cantidad) as cargos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
 (fechaCierre>= '".$_POST['fechaInicial']."'  and fechaCierre<='".$_POST['fechaFinal']."')
and
naturaleza='C'
and
tipoPaciente='externo'
and
almacen='".$_GET['datawarehouse']."'
    and
    medico='".$myrow['medico']."'


";
$resultcargos=mysql_db_query($basedatos,$sSQLcargos);
$myrowcargos = mysql_fetch_array($resultcargos);



$consultas= $myrowcargos['cargos'];
	   
if($consultas>0){
    echo number_format($consultas);
    $totalConsultas[0]+=$myrowcargos['cargos'];
}else{
    echo '0';
}
?>
	   </td>
           
           
    
    
<td   >
	   <?php 

$sSQLdev="SELECT 
    sum(cantidad) as devoluciones

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
 (fechaCierre>= '".$_POST['fechaInicial']."'  and fechaCierre<='".$_POST['fechaFinal']."')
and
naturaleza='A'
and
tipoPaciente='externo'
and
almacen='".$_GET['datawarehouse']."'
    and
    medico='".$myrow['medico']."'


";
$resultdev=mysql_db_query($basedatos,$sSQLdev);
$myrowdev = mysql_fetch_array($resultdev);



$devoluciones= $myrowdev['devoluciones'];
	   
if($devoluciones>0){
    echo number_format($devoluciones);
    $totalDevoluciones[0]+=$myrowdev['devoluciones'];
}else{
    echo '0';
}
?>
	   </td>    
           
           
           
           

<td   align="rigth" >
 <?php if($consultas>0){?>   
<a href="javascript:ventanaSecundaria('../ventanas/auxiliaresMedicos.php?descripcionMedico=<?php echo $myrow1m['nombreCompleto'];?>&medico=<?php echo $myrow['medico'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&fechaInicial=<?php echo $_POST['fechaInicial']; ?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>')">
Detalles
</a>   
<?php }else{    
     echo 'SinDetalles';   
 } ?>    
    
</td>
        
        
        
        
        
    
      </tr>
     <?php }}?>
   </table>
      <br />
   <div align="center" class="precio1">
       <?php 
       echo 'Total Registros: '.$totalConsultas[0]-$totalDevoluciones[0];
       ?>
   </div>
   
   <br />
 </div>
</form>

  <script type="text/javascript"> 
    Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador"     // el id del boton que lanzara el calendario 
}); 
 </script>
   <script type="text/javascript"> 
    Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador1"     // el id del boton que lanzara el calendario 
}); 
 </script>
       <br />
</body>
</html>