<?php require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>
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
   
   <h1>Detalle 
   <?php echo 'Dr(a): '.$_GET['descripcionMedico'];?>
   </h1>
   

   <h5>
   <?php echo 'FechaInicial: '.cambia_a_normal($_GET['fechaInicial']).', FechaFinal: '.  cambia_a_normal($_GET['fechaFinal']);?>
   </h5> 
   
   
  


   <table width="700" class="table table-striped">
     <tr >
         
                  <th width="2" >
         <div align="left">#</div>
      </th>

       <th width="35" >
           <div align="left">FechaCargo</div>
       </th>
       
       
       <th width="35" >
           <div align="left">FolioVenta</div>
    </th>        

       
       <th width="250"  ><div align="left" >NombrePx</div></th>
       <th width="200" ><div align="left" >
          
           TipoPago
       
       </div></th>

       
      </tr>
<?php 	
$medico=$_POST['medico'];

    
    

 $ssql = "select * from cargosCuentaPaciente where 
     
 entidad='".$entidad."'  
    
 and
 medico='".$_GET['medico']."'
 and
 (fechaCierre>= '".$_GET['fechaInicial']."'  and fechaCierre<='".$_GET['fechaFinal']."')
 and
 statusDevolucion!='si'
 and
 folioVenta!=''
 and
 tipoPaciente='externo'
 and
 almacen='".$_GET['datawarehouse']."'
 
 order by fechaCierre ASC
 ";


$result = mysql_db_query($basedatos,$ssql);

while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;



  
$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);




 
?>
      
      
      
      
      
      
<tr >
    
    
    
              
<td  >
<?php 
	echo $totalRegistros;
	  ?>
</td>
              
              
              

              
              
 
         
<td  ><?php 

  
if($myrow['fechaCierre']!=NULL){
echo cambia_a_normal($myrow['fechaCierre']);
}



?>
</td>





<td  >
<?php 

 

echo $myrow['folioVenta'];
?>
</td>





<td  >
<?php 

 

echo $myrow1['paciente'];
	  ?>
</td>



       


<td   >
<?php 



if($myrow['clientePrincipal']!=''){
    $sSQL1m= "Select nomCliente From clientes WHERE entidad='".$entidad."' and numCliente='".$myrow['clientePrincipal']."' ";
$result1m=mysql_db_query($basedatos,$sSQL1m);
$myrow1m = mysql_fetch_array($result1m); 
    
    echo $myrow1m['nomCliente'];
    echo '<br>';
}


$sSQL1e= "Select tipoPago From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVenta']."'
and gpoProducto=''    group by tipoPago
";
$result1e=mysql_db_query($basedatos,$sSQL1e);
while ($myrow1e = mysql_fetch_array($result1e)){
    echo $myrow1e['tipoPago'];
    echo '<br>';
}


?>
	   </td>
           
           
           
           
           
           
           

        
        
     <?php }?>    
        
        
    
      </tr>

   </table>
      <br />
   <!--div align="center" class="precio1">
       <?php 
       //echo 'Total particular:  $'.number_format($totalP[0]-$totalPD[0],2).', total Aseguradora:  $'.number_format($totalA[0]-$totalAD[0],2).'; global:  $'.number_format(($totalP[0]-$totalPD[0])+($totalA[0]-$totalAD[0]),2);
       ?>
   </div>
   
   <br />
 </div-->
</form>



	<?php 
	if($totalRegistros>0){ 
	echo 'Se atendieron '.$totalRegistros.' pacientes!';
	}
	?>
 
 <br>
 <br>

 </body>
 </html>