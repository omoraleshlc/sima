<?php require("menuOperaciones.php"); ?>
<?php require("/configuracion/clases/internarPaciente.php"); ?>

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
 <script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />


<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>



</head>

<body>
<h1>Agregar Alumnos</h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
<table width="500" class="table-forma">

  <tr valign="middle"   >
        <th colspan="2" ><div align="center" >Datos</div></th>
    </tr>
      <tr valign="middle" >
        <td width="291" >Nuevo Alumno <a href="javascript:ventanaSecundaria1('../ventanas/modificarAlumnos.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="../imagenes/btns/addpatient.png" alt="Datos Generales del Paciente" width="24" height="24" border="0" /></a></td>
        <td width="200"><span class="Estilo26"><span class="style121"><a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span></span></td>
    </tr>
      <tr valign="middle"  >
        <td width="191" ><div align="left" >Matricula</div></td>
        <td width="300" ><label><span >
        <input name="paciente" type="text"  id="paciente" size="60" onChange="this.form.submit();">
        </span>
            <input name="numeroEx" type="hidden"  id="numeroEx" value="<?php echo $_POST['numeroEx'];?>" />
        </label>
        <a href="javascript:ventanaSecundaria10('/sima/cargos/busquedaAvanzadaAlumnos.php?reload=si')" >Busqueda Avanzada</a></td>
    </tr>
    </table>

<?php 
$nombres=$_POST['paciente'];
if($nombres){
 $sSQL= "
SELECT * FROM ALUMNOSINSCRITOS
where
entidad='".$entidad."'
    AND
    MATRICULA='".$_POST['numeroEx']."'
 
";





?>
<p>&nbsp;</p>

<table width="385" class="table table-striped">
  <tr>
        <th width="96"   scope="col"><div align="left" >Matricula</div></th>
      <th width="234"  scope="col"><div align="left" >Paciente</div></th>
      <th width="41"  scope="col" >Editar</th>
    </tr>
      <tr>
        <?php 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$nombrePaciente = $myrow['NOMBRE']." ".$myrow['APATERNO']." ".
$myrow['AMATERNO'];
$bandera+="1";


//cierro descuento

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente']; 




?>


        <td height="24" bgcolor="<?php echo $color;?>" >
<?php if(!$myrow31['numeroE']){ ?>

        <?php 
			echo $myrow['MATRICULA'];
		
		  ?>        
		  </a>
		  <?php } else {?>
		   <?php echo $myrow31['numeroE']; ?>
<?php } ?>
	    </td>
		  
		  <td bgcolor="<?php echo $color;?>" >
		<?php if(!$myrow31['numeroE']){ ?>
		
		<?php echo $nombrePaciente;?>
		</a> 
		 <?php } else {?>
		 <?php echo $nombrePaciente." "."(Cliente Interno)"; ?>
<?php } ?>
		 
		<span ></span> </span></td>
        <td bgcolor="<?php echo $color;?>" ><div align="center"><span >
          
          <?php if(!$myrow31['numeroE']){ ?>
          <a href="javascript:ventanaSecundaria1('../ventanas/modificarAlumnos.php?MATRICULA=<?php echo $myrow['MATRICULA'];?>')">
              <img src="../imagenes/btns/addbtn.png" alt="Datos Generales del Paciente" width="24" height="24" border="0" />          </a>
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
			return "/sima/cargos/clientesTodosAjax.php?q=" + this.value;
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
			return "/sima/cargos/alumnosx.php?entidad=<?php echo $entidad;?>&almacen=<?php echo $ALMACEN;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
