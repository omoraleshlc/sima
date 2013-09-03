<?php require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php');?>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librera principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librera para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script>
function cerrarVentana(){
close();
}
</script>

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.lengtd; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.nombre1.value) == false ) {   
                alert("Por Favor, escoje el nombre del paciente!")   
                return false   
        } else if( vacio(F.apellido1.value) == false ) {   
                alert("Por Favor, escribe el apellido paterno del paciente!")   
                return false   
        } else if( vacio(F.apellido2.value) == false ) {   
                alert("Por Favor, escribe el apellido materno del paciente!")   
                return false   
        }            
}   
  
  
  
  
</script>

<!-- set focus to a field witd tde name "searchcontent" in my form -->
<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo slo acepta nmeros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>


<?php


if($_POST['add']  ){ 
    
if($_POST['observaciones']!=NULL){    
$sSQL455= "Select * from pacientesCandados where entidad='".$entidad."' and numeroEx='".$_GET['numeroExpediente']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if(!$myrow455['numeroEx']){
$agrega = "INSERT INTO pacientesCandados ( 
numeroEx,nombreCompleto,seguro,nomSeguro,fecha,hora,usuario,entidad,observaciones
) values (
'".$_GET['numeroExpediente']."','".$_POST['nombreCompleto']."',
'".$_POST['seguro']."','".$_POST['nomSeguro']."',
'".$fecha1."','".$hora1."','".$usuario."','".$entidad."' ,'".strtoupper($_POST['observaciones'])."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script>
window.alert("Se agrego un candado!");
window.close();
</script>';
} else{
echo '<script>
window.alert("Ya existe actualmente un candado para este paciente!");

</script>';
}
} else{
echo '<script>
window.alert("Favor de especificar en observaciones porque se esta bloqueando el expediente!");

</script>';
}


}
?>









<?php 

if($_POST['delete'] and $_POST['keyPC']){

$borrame = "DELETE FROM pacientesCandados WHERE keyPC ='".$_POST['keyPC']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script>
window.alert("Candado desbloqueado!");
window.close();
</script>';
}

?>








<?php
/*



if($_GET['numeroExpediente']){


} else {
echo '<script>
window.close();
</script>';
}
*/


$sSQL= "Select  * From pacientes WHERE entidad='".$entidad."' and numCliente = '".$_GET['numeroExpediente']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
?>





<script language=javascript> 
function ventanaSecundaria13 (URL){ 
   window.open(URL,"ventana13","widtd=500,height=500,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","widtd=450,height=390,scrollbars=YES") 
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


</head>

    
    
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","widtd=700,height=600,scrollbars=YES") 
} 
</script>

<body>
<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
        
        
<form  name="form1" method="post" >
<p align="center">&nbsp;</p>
<table class="table-forma" >
    

    <tr>
      
	  
	  <td   ><div align="left" >Expediente</div></td>
      <td  scope="col"><div align="left"  >
 <?php echo $myrow['numCliente']; ?>
      </div></td>

	  
      <td  align="center" ><p align="center">
        <?php if($myrow['ruta']!='images/' AND $myrow['ruta']){ ?>
        <a href="<?php 

echo $myrow['ruta']; 

?>" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>"><img src="<?php echo $myrow['ruta']; ?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" widtd="136" height="151" border="2" /></a><a href="<?php 

echo $myrow['ruta']; 

?>" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>"></a></p>
        <?php } ?></td>
    </tr>
    
    
    
    
    
    
    
    
    
    
    <tr>
<?php 
$sSQL455= "Select * from pacientesCandados where entidad='".$entidad."' and numeroEx='".$_GET['numeroExpediente']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
?>
        
        
     <tr>
      <td ><div align="left" > Nombre </div></td>
      <td ><label>
        <div align="left"  ><?php echo $myrow['nombreCompleto']; ?></div>
      </label></td>
    </tr>
	<input name="nombreCompleto" type="hidden" value="<?php echo $myrow['nombreCompleto'];?>" />


        <td >Seguro
        <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span></td>

        <td ><input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        <span >**Si no se escoje la aseguradora se bloquea el expediente totalmente!</span></td>
    </tr>
    
    
    
    
    
    
        <tr>
      <td  >Observaciones:</td>
      <td  ><label>
	  <?php if($myrow455['numeroEx']){ 
	  echo $myrow455['observaciones'];
	  }else{
	  echo '<textarea name="observaciones" cols="30" class="camposmid" id="observaciones"></textarea>';
	  }
	  ?>
        
      </label></td>
    </tr>
    
    
  </table>
  
<table widtd="578" >
</table>
  <br>
  <table widtd="266" border="0" align="center">
    <tr>
      <td widtd="127" align="center" valign="top"><input name="delete" type="submit" src="../../imagenes/btns/modifybutton.png" id="agregar" value="Quitar Candado" /></td>
      <td widtd="129" align="center" valign="top"><div align="center">
        <input name="add" type="submit" src="../../imagenes/btns/modifybutton.png" id="actualizar" value="Modificar/Grabar"  <?php if($myrow455['numeroEx']){ echo 'disabled=""';}?> />
      </div></td>
    </tr>
  </table>
  <p>
    <input name="keyPC" type="hidden" value="<?php echo $myrow455['keyPC'];?>" />
  </p>
  <p>&nbsp;</p>
</form>

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
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipalesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
    
</body>
 </html>
