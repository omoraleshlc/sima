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
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=700,height=600,scrollbars=YES") 
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
 <h1 align="center" >
 <div align="center"></div>
<form id="form2" name="form2" method="POST">
 <div align="center">
   
   <h1>REPORTE HONORARIOS MEDICOS</h1>
   
   <h3><?php echo $_POST['medico'];?></h3>
   

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
     
     
     
          
    <tr >
       <td><span >Nombre Medico</span></td>
       <td><span >
      <input name="nomMedico" type="text"  
	  value="<?php 
	  
	  echo $_POST['nomMedico'];
	  ?>" size="40" />
       </span>
      <input name="medico" type="hidden"  
	  value="<?php 
	  
	  echo $_POST['medico'];
	  ?>" size="40" /></td>
     </tr>
     
     
        </table>
   
   <br>
   
      <span >
         <input type="submit" name="mostrar" id="mostrar" value="Buscar" />
       </span>

   
       <span >
<input type="button" name="Print" id="mostrar" value="Print" onClick="javascript:ventanaSecundaria1('../ventanas/printHonorariosCO.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>&nomMedico=<?php echo $_POST['nomMedico'];?>&medico=<?php echo $_POST['medico'];?>')"/>
       </span>
   

   
   
   
   
   
   <br>
   <br>
<?php if($_POST['mostrar']!=NULL){ ?>
   <table width="730" class="table table-striped">
     <tr >
         
                  <th width="2" >
         <div align="left">#</div>
    </th>
         
         
         <th width="60" >
         <div align="left">FechaCargo</div>
       </th>
         
       <th width="52" >
         <div align="left">Folio</div>
      </th>
       <th width="320" >
           <div align="left">Paciente</div>
    </th>
    
 <th width="200" ><div align="left" >TipoPago</div></th>    
 <!--<th width="60" ><div align="left" >TipoCobro</div></th>-->
 <!--th width="66" ><div align="left" >StatusCuenta</div></th-->
    <th width="60" ><div align="left" >Rec/Mov</div></th>
   
 <th width="60" ><div align="left" >Importe</div></th>   
   
      </tr>
<?php 	
$medico=$_POST['medico'];

    
 
$ssql = "select * from cargosCuentaPaciente where 
(   
entidad='".$entidad."'  
    
and
medico='".$_POST['medico']."'
and
(fechaCargo>= '".$_POST['fechaInicial']."' and fechaCargo<='".$_POST['fechaFinal']."')
    and

folioVenta!=''
and
fechaCargo!=''
and
(tipoPaciente='interno' or tipoPaciente='urgencias'))
OR
(   
entidad='".$entidad."'  
    
and
medico='".$_POST['medico']."'
and
(fechaCierre>= '".$_POST['fechaInicial']."'  and fechaCierre<='".$_POST['fechaFinal']."')
and
tipoPaciente='externo' )




order by folioVenta ASC";


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






?>
      
          <tr >
              
              
<td align="left" >
<?php 
	echo $totalRegistros;
	  ?>
</td>
              
              
              
<td align="left" >
<?php 

	echo cambia_a_normal($myrow['fechaCargo']);

	  ?>
</td>
              
              
<td align="left" >
             
             <?php 
	echo $myrow['folioVenta'];
	  ?></td>
         





<td align="left" >
           <?php 



echo $myrow1['paciente'];


//echo $myrow['almacenSolicitante'];
	  ?></td>

       
       
<td align="left" >
        <?php    
if($myrow['tipoPaciente']=='externo'){        
  $sSQLtp= "Select tipoPago,numRecibo From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and gpoProducto=''
        and
        tipoPago!=''
group by tipoPago        
";
$resulttp=mysql_db_query($basedatos,$sSQLtp);
$aa=NULL;
while($myrowtp = mysql_fetch_array($resulttp)){        
    
        echo $myrowtp['tipoPago'];
        echo '<br>';
}  
} ?>
       </td>
       
       
       
       
    <!--    
<td align="left" >
<?php
if($myrow['cantidadAseguradora']>0){
echo 'CxC';
}

if($myrow['cantidadParticular']>0){
    

if($myrow['cantidadAseguradora']>0){    
echo ','; 
}
echo 'Particular';
}
?>	   

	</td>       
   </td-->      
       
       
    <!--td   align="left" >
<?php
if($myrow['naturaleza']=='C'){
echo 'Normal';
}elseif($myrow['naturaleza']=='A'){
echo 'Devolucion'    ;
}
?>	   

	</td-->        
        
        
        
        
          
        
        
        
        
        
       
<td align="left" >
<?php 
if($myrow['tipoPaciente']=='externo'){
echo 'R'.$myrow1a['numRecibo'];
}else{
echo 'M'.$myrow['keyCAP'];    
}
?>	   

	</td>

        
        
        
        
<td align="left" >
<?php



if($myrow['naturaleza']=='C'){
$imp[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);    

echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
}elseif($myrow['naturaleza']=='A'){
    echo '<div class="error">$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2).'</div>';
$devs[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);    
}

?>	   
            </div>
	</td>        
        


    
      </tr>
     <?php }}?>
   </table>
      <br />
      
      
      
      
 <table width="200" class="table table-striped">
    <tr >
       
    <th width="2" >
    <div align="left">Cargos</div>
    </th>
        
    
    <th width="2" >
    <div align="right"><?php 

	 echo '$'.number_format($imp[0],2);

	  ?></div>
    </th>    
   
 </tr>
 
 

 
 
    <tr >
       
    <th width="2" >
    <div align="left">Devoluciones</div>
    </th>
        
    
    <th width="2" >
    <div align="right"><?php 

	 echo '$'.number_format($devs[0],2);

	  ?></div>
    </th>    
   
 </tr> 
 
 
 
 
     <tr >
       
    <th width="2" >
    <div align="left">Totales</div>
    </th>
        
    
    <th width="2" >
    <div align="right"><?php 

	 echo '$'.number_format($imp[0]-$devs[0],2);

	  ?></div>
    </th>    
   
 </tr>
 
 
 </table>
      
      
      
      
   
   
   
 </div>
</form>

<div align="center">
  <script>
		new Autocomplete("nomMedico", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("medico")[0].value = id;
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
			return "../cargos/medicosCedulax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
	<?php 
        echo '<br>';
	if($totalRegistros>0){ 
	echo 'Se atendieron '.$totalRegistros.' pacientes!';
	}
	?>
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
</div>
</body>
</html>