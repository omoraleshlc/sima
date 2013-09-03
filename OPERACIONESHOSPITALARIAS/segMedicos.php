<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php"); $ALMACEN=$_GET['datawarehouse'];?>
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
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
	<?php 		
$sSQL7ab="SELECT medicos 
FROM
gpoProductos
WHERE
entidad='".$entidad."'
    and
codigoGP='".$_GET['gpoProducto']."'

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
 <h1 align="center" class="titulomedio">
 <div align="center"></div>
<form id="form2" name="form2" method="get">
 <div align="center">
   <p><br />
     (Este proceso puede demorar algunos minutos)<br />
   </p>
   Fecha Inicial
   <table width="205" border="0" align="center">


        <tr>
       
       <td width="49" class="negro" scope="col"><span class="Estilo25">
         <input name="button" type="image"  id="lanzador" value="cargar"  src="../imagenes/btns/fechadate.png" />
       </span></td>
       <td width="283" scope="col"><div align="left">
           <input name="fechaInicial" type="text" class="campos" id="campo_fecha"
	  value="<?php 
	  if($_GET['fechaInicial']){
	  echo $fecha2=$_GET['fechaInicial'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" />
       </div></td>
     </tr>
   </table>
   <h1 class="titulomedio">a</h1>
   <p class="titulomedio">Fecha Final </p>
   <table width="205" border="0" align="center">


    <tr>
       <td width="49" class="negro" scope="col"><span class="normal">
         <input name="button2" type="image"  id="lanzador1" value="cargar"  src="../imagenes/btns/fechadate.png" />
       </span></td>
       <td width="283" scope="col"><div align="left">
           <input name="fechaFinal" type="text" class="campos" id="campo_fecha1"
	  value="<?php 
	  if($_GET['fechaFinal']){
	  echo $fecha2=$_GET['fechaFinal'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" />
       </div></td>
     </tr>
   </table>
   <p class="titulomedio">Escoge el Seguro:  
   <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_GET['seguro']){ echo $_GET['seguro'];} else { echo "0";}?>" 
	/>
   
   <input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="80"
		value="<?php echo $_GET['nomSeguro'];?>"/>
   </p>
   <p class="titulomedio">
     <label for="enviar"></label>
     <input type="submit" name="enviar" id="enviar" value="Mostrar Estadisticas" />
   </p>
   <p class="titulomedio">&nbsp;</p>

   <table class="table table-striped" width="929"  >
     <tr bgcolor="#FFFF00">
       <th width="54" scope="col"><div align="left" class="normal">
           <div align="left">Exp</div>
       </div></th>
       <th width="71"  scope="col"><div align="left" class="normal">
         <div align="left">Fecha</div>
       </div></th>
       <th width="220"  scope="col"><div align="left" class="normal">
           <div align="left">Px</div>
       </div></th>
       <th width="87"  scope="col"><div align="left" class="normal">
           <div align="left">Cred/Nom</div>
       </div></th>
       <th width="43" scope="col"><div align="left" class="normal">Tipo </div></th>
       <th width="248"  scope="col"><div align="left" class="normal">Medico</div></th>
       <th width="166"  scope="col"><div align="left" class="normal">Dx</div></th>
       <th width="166"  scope="col"><div align="left" class="normal">Incapacidades</div></th>
      </tr>
<?php 	
if( $_GET['seguro']){
$ssql = "select * from clientesInternos where entidad='".$entidad."'  
and
clientePrincipal='".$_GET['seguro']."'
and
fechaSolicitud between '".$_GET['fechaInicial']."'  and '".$_GET['fechaFinal']."'
and
statusDevolucion!='si'
and
statusCaja='pagado'
and
tipoPaciente='externo'
and
almacen='".$ALMACEN."'
and
(status not like '%canc%' or status not like '%dev%')
order by fechaSolicitud,almacenSolicitud ASC
";


$result = mysql_db_query($basedatos,$ssql);
?>

       <?php
while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;

$codigo=$code = $myrow['codigo'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 
$color1='#FF3300';


  

$sSQL39= "
	SELECT 
descripcion
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$myrow['almacenSolicitud']."'  ";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

?>



        <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
       <td class="normal"><?php 
	echo $myrow['numeroE'];
	  ?></td>
       <td  class="normal"><?php 
	echo cambia_a_normal($myrow['fechaSolicitud']);
	  ?></td>
       <td  class="normal"><?php 
echo $myrow['paciente'];
echo '</br>';
echo $myrow['folioVenta'];
	  ?></td>
       <td  class="normal"><?php 
	echo $myrow['credencial'];
	  ?></td>
       <td  class="normal" ><?php 
	  
	 echo $myrow['statusPaciente'];
	  ?></td>

       <td  class="normal" ><?php 
	  
echo	$myrow39['descripcion'];
	  ?></td>




       <td  class="normal" >
	   

	<div align="center" class="normal">
	 <a  href="javascript:ventanaSecundaria2('../ventanas/agregarDX.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $myrow39['descripcion']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>')">
	 	   <?php 
	if($myrow['dx']){
	echo $myrow['dx']; 
	}else{?>
	 ?
	 <?php } ?>
	 </a>
	 </div>
	 
	</td>








                <td  class="normal" >


	<div align="center" class="normal">
	 <a  href="javascript:ventanaSecundaria2('../ventanas/agregarI.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $myrow39['descripcion']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>')">
	 	   <?php
	if($myrow['incapacidad']){
	echo $myrow['incapacidad'];
	}else{?>
	 ?
	 <?php } ?>
	 </a>
	 </div>

	</td>






      </tr>
     <?php }}?>
   </table>
 <br />
 </div>
    
    
    <input name="main" type="hidden" value="<?php echo $_GET['main'];?>">
    <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>">
    <input name="datawarehouse" type="hidden" value="<?php echo $_GET['datawarehouse'];?>">
</form>

<div align="center">
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
			return "../cargos/clientesPrincipalesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
	<?php 
	if($totalRegistros>0){ 
	echo 'Se atendieron '.$totalRegistros.' pacientes!';
	}
	?>
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
</div>
</body>
</html>