<?php require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php"); ?>
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
   
   <h1>HONORARIOS MEDICOS</h1>
   <h3>Dr(a):  <?php echo $_GET['nomMedico'];?></h3>
   <h3>FechaInicial: <?php echo cambia_a_normal($_GET['fechaInicial']);?>, FechaFinal: <?php echo cambia_a_normal($_GET['fechaFinal']);?></h3>
   
   
   
   
   
   
   <p ><label for="enviar"></label>
 </p>
   <p >&nbsp;</p>

   <table width="830" class="table table-striped">
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
 <!--<th width="60" ><div align="left" >TipoPago</div></th>-->
 <!--th width="66" ><div align="left" >StatusCuenta</div></th-->
    <th width="60" ><div align="center" >ReciboCaja</div></th>
   
 <th width="60" ><div align="right" >Importe</div></th>   
   
      </tr>
<?php 	
$medico=$_POST['medico'];

    
 
$ssql = "select * from cargosCuentaPaciente where 
(   
entidad='".$entidad."'  
    
and
medico='".$_GET['medico']."'
and
(fechaCargo>= '".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')
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
medico='".$_GET['medico']."'
and
(fechaCierre>= '".$_GET['fechaInicial']."'  and fechaCierre<='".$_GET['fechaFinal']."')
    and

folioVenta!=''
and

tipoPaciente='externo' )




order by folioVenta,fechaCargo,fechaCierre ASC";


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
              
              
<td  >
<?php 
	echo $totalRegistros;
	  ?>
</td>
              
              
              
               <td  >
<?php 
if($myrow['fechaCargo']!=NULL){
	echo cambia_a_normal($myrow['fechaCargo']);
}else{
    echo '---';
}
	  ?>
</td>
              
              
         <td  ><?php 
	echo $myrow['folioVenta'];
	  ?></td>
         
       <td  ><?php 



echo utf8_decode($myrow1['paciente']);


//echo $myrow['almacenSolicitante'];
	  ?></td>

       
       
       <td>
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
}  else {
    
    $sSQL30= "Select * From clientes WHERE entidad='".$entidad."' and numCliente='".$myrow['seguro']."' ";
$result30=mysql_db_query($basedatos,$sSQL30);
$myrow30 = mysql_fetch_array($result30);
    
    if($myrow['cantidadAseguradora']>0 and $myrow['cantidadParticular']>0){
         echo 'Particular, '.$myrow30['nomCliente'];
    }else if($myrow['cantidadAseguradora']>0){
echo $myrow30['nomCliente'];
}
else
if($myrow['cantidadParticular']>0){
    
echo 'Particular';
}
}?>
       </td>
       
       
       
       
  <!--     
    <td>
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
        
        
        
        
          
        
        
        
        
        
       
       <td align="left">
<?php 
if($myrow['tipoPaciente']=='externo'){
echo 'R'.$myrow1a['numRecibo'];
}else{
echo 'M'.$myrow['keyCAP'];    
}
?>	   

	</td>

        
        
        
        
        <td   ><div align="right">
<?php



if($myrow['naturaleza']=='C'){
$imp[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);    

echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
}elseif($myrow['naturaleza']=='A'){
    echo '-$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2).'';
$devs[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);    
}

?>	   
            </div>
	</td>        
        


    
      </tr>
     <?php }?>
   </table>
      <br />
   <div align="center" class="precio1">
       <?php 
       echo '  Cargos $'.number_format($imp[0],2);
       echo '<br>';
       echo '  Devoluciones $'.number_format($devs[0],2);
       echo '<br>';
       echo '  Totales $'.number_format($imp[0]-$devs[0],2);
       echo '<br>';
       ?>
   </div>
   
   <br />
 </div>
</form>

 
 <script>
 window.print();
 </script> 
 
 
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
	if($totalRegistros>0){ 
	echo 'Se atendieron '.$totalRegistros.' pacientes!';
	}
	?>

</div>
</body>
</html>