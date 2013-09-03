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
   
   <h1>REPORTE DESCUENTOS</h1>
 
   <h3>Fecha Inicial: <?php echo cambia_a_normal($_GET['fechaInicial']);?>, Fecha Final: <?php echo cambia_a_normal($_GET['fechaFinal']);?></h3>
   
   
   
   
   
   
   <p ><label for="enviar"></label>
 </p>
   <p >&nbsp;</p>
   <table width="730" class="table table-striped">
     <tr >
         
                  <th width="2" >
         <div align="left">#</div>
    </th>
         
         
         <th width="60" >
         <div align="left">Fecha</div>
       </th>
         

       <th width="390" >
           <div align="left">Paciente</div>
    </th>

    
           <th width="52" >
         <div align="left">Folio</div>
      </th>
    
 <!--th width="400" ><div align="left" >TipoPago</div></th-->    
 <!--<th width="60" ><div align="left" >TipoCobro</div></th>-->
 <!--th width="66" ><div align="left" >StatusCuenta</div></th-->
    <!--th width="60" ><div align="left" >Rec/Mov</div></th-->
   
 <th width="60" ><div align="right" >Importe</div></th>   
   
      </tr>
<?php 	
//$medico=$_POST['medico'];

    
 
$ssql= "SELECT * FROM cargosCuentaPaciente
WHERE
(entidad='".$entidad."'  
and
fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."'
and

statusCuenta='cerrada'
and
statusDescuento='si'
)

OR

(entidad='".$entidad."'  
and
fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."'
and


statusDescuento='si'
and
(tipoPaciente='interno' or tipoPaciente='urgencias'))

group by folioVenta
order by folioVenta ASC
";


$result = mysql_db_query($basedatos,$ssql);

while($myrow = mysql_fetch_array($result)){

$totalRegistros3+=1;

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




$sSQL1ab= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as descuentos From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and
statusDescuento='si'
and
        naturaleza='A'
        and
        gpoProducto=''
        
";
$result1ab=mysql_db_query($basedatos,$sSQL1ab);
$myrow1ab = mysql_fetch_array($result1ab);

$sSQL1ad= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as devDescuentos From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and
        gpoProducto=''
        and
        naturaleza='C'
";
$result1ad=mysql_db_query($basedatos,$sSQL1ad);
$myrow1ad = mysql_fetch_array($result1ad);



 $sSQL1b1= "SELECT * FROM almacenes
WHERE
entidad='".$_GET['entidad']."'
and
almacen='".$myrow['almacen']."'  ";
 

$result1b1=mysql_db_query($basedatos,$sSQL1b1);
$myrow1b1 = mysql_fetch_array($result1b1);


?>
      
          <tr >
              
              
<td align="left" >
<?php 
	echo $totalRegistros3;
	  ?>
</td>
              
              
              
<td align="left" >
<?php 
if($myrow['fechaCierre']!=NULL){
	echo cambia_a_normal($myrow['fechaCierre']);
}else{
    echo '---';
}
	  ?>
</td>
              

<td align="left" >
           <?php 



echo utf8_decode($myrow1['paciente']);


//echo $myrow['almacenSolicitante'];
	  ?></td>



<td align="left" >
             
             <?php 
	echo $myrow['folioVenta'];
	  ?></td>
       
       

       
       
       
       
   
       
       
    
        
        
        
        
          
        
        
        
        
        
       


        
        
        
        
<td align="right" >
<?php


print '$'.number_format($myrow1ab['descuentos']-$myrow1ad['devDescuentos'],2);
$impDesc[0]+=$myrow1ab['descuentos'];
$devsDesc[0]+=$myrow1ab['devDescuentos'];


?>	   
           
	</td>        
        


    
      </tr>

      <?php }?>     
     <tr >
       
    <td colspan="4" width="2" >
    <div align="left"><b>Totales</b></div>
    </td>
        
    
    <td width="2" >
    <div align="right"><b><?php 

	 echo '$'.number_format($impDesc[0]-$devsDesc[0],2);

	  ?></b></div>
    </td>    
   
 </tr>
 
  
   </table>
       
   
            <table>
        <tr>
            <th>Total de Descuentos</th>
            <th align="left" >
<?php 
	echo $totalRegistros3;
	  ?>
</th>
<th>Total Importes</th>
<th>            <div align="right"><?php 

	 echo '$'.number_format($impDesc[0]-$devsDesc[0],2);

	  ?></div>
    </th>
        </tr>
        
    </table>
   
       </div>
    

       
      <br />

   
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
	if($totalRegistros3>0){ 
	echo 'Se atendieron '.$totalRegistros3.' pacientes!';
	}
	?>

</div>
  <br></br><br></br>
</body>
</html>