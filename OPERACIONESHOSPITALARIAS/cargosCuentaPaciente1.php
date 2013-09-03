<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php"); ?>

  <script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=650,height=700,scrollbars=YES") 
} 
</script> 
  

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.nombrePaciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.deposito.value) == false ) {   
                alert("Por Favor, escribe el dep�sito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el medico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el l�mite que desees asignar!")   
                return false   
        }   
}   
  
  
  
  
</script>

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=220,height=250,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Est� Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

 <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
 <script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />


<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>



</head>

<body>
<h1 >Internar Paciente  </h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
  
<table width="584" class="table-forma">

  <tr    >
        <td colspan="2" ><div align="center" >Datos del Paciente </div></td>
    </tr>
      <tr  >
        <td  >Nuevo Paciente <a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&almacen=<?php echo $ALMACEN;?>')"><img src="/sima/imagenes/btns/addpatient.png" alt="Datos Generales del Paciente" width="24" height="24" border="0" /></a></td>
        <td ><span class="Estilo26"><span class="style121"><a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span></span></td>
    </tr>
      <tr   >
        <td width="201" >Apellido Paterno, Materno </td>
        <td width="381" >
        <input name="paciente" type="text"  id="paciente" size="60" onChange="this.form.submit();">
        
            <input name="numeroEx" type="hidden"  id="numeroEx" value="<?php echo $_POST['numeroEx'];?>" />
   
        <a href="javascript:ventanaSecundaria10('../cargos/busquedaAvanzada.php?reload=si')" class="none">Busqueda Avanzada</a></td>
    </tr>
    
    
</table>

<?php 
$nombres=$_POST['paciente'];
if($_POST['numeroEx']){ 
$sSQL= "
SELECT * FROM 
pacientes 
where 
entidad='".$entidad."'
and
numCliente='".$_POST['numeroEx']."'

order by
apellido1 asc
";





?>
<p>&nbsp;</p>
<table width="385" border="0" align="center">
  <tr>
        <th width="96" height="19" bgcolor="#FFFF00" scope="col"><div align="left" class="none">Expediente</div></th>
      <th width="234" bgcolor="#FFFF00" scope="col"><div align="left" class="none">Paciente</div></th>
      <th width="41" bgcolor="#FFFF00" scope="col" class="none">Editar</th>
    </tr>
      <tr>
        <?php 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']." ".$myrow['apellido1']." ".
$myrow['apellido2']." ".$myrow['apellido3'];
$bandera+="1";


//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente']; 
$sSQL31= "Select  * From clientesInternos WHERE entidad ='".$entidad."' and numeroE = '".$NUMEROE."' and (tipoPaciente='interno' or 
tipoPaciente='urgencias') and 
statusCuenta='abierta' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

?>


        <td height="24" bgcolor="<?php echo $color;?>" class="codigosmid">
<?php if(!$myrow31['numeroE']){ ?>

        <?php 
			echo $myrow['numCliente'];
		
		  ?>        
		  </a>
		  <?php } else {?>
		   <?php echo $myrow31['numeroE']; ?>
<?php } ?>
	    </td>
		  
		  <td bgcolor="<?php echo $color;?>" class="normalmid">
		<?php if(!$myrow31['numeroE']){ ?>
		
		<?php echo $nombrePaciente;?>
		</a> 
		 <?php } else {?>
		 <?php echo $nombrePaciente." "."(Cliente Interno)".$myrow31['folioVenta']; ?>
<?php } ?>
		 
		<span class="style12"></span> </span></td>
        <td bgcolor="<?php echo $color;?>" ><div align="center"><span class="style12">
          
          <?php if(!$myrow31['numeroE']){ ?>
          <a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;reload=<?php echo 'si'; ?>&internar=si&ali=<?php echo $ALMACEN;?>')">
              <img src="../imagenes/btns/addbtn.png" alt="Datos Generales del Paciente" width="24" height="24" border="0" />          
          </a>
          <?php } else { 
		  
		  echo 'Activo';
		  }
		  ?>
          
          
          
        </span></div></td>
    </tr>

      <?php }}?>
    </table>
	<p>&nbsp;    </p>
	<p>&nbsp;</p>
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
      
     
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
			return "../cargos/clientesTodosAjax.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
  <script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("numeroEx")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "../cargos/pacientesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
