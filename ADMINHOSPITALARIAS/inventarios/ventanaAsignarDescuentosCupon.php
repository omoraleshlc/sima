<?php include("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php'); ?>













<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>













<?php 
if($_POST['asignar'] ){ 
$porcentaje=$_POST['porcentaje'];
$tipoPaciente=$_POST['tipoPaciente'];
$gpoProducto=$_POST['gpoProducto'];





if( $porcentaje>-1){




$sSQL3a= "Select * From descuentosAutomaticos WHERE entidad='".$entidad."' and departamento = '".$_GET['almacen']."'  and statusCupon='si'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);


if($porcentaje=='0'){

 $sqld = "DELETE FROM descuentosAutomaticos 
where
keyDA='".$myrow3a['keyDA']."'";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
echo '<script>
window.alert("Se elimino el descuento");
</script>';

}else if($myrow3a['statusCupon']){
  $sqld = "UPDATE descuentosAutomaticos set 
porcentaje='".$porcentaje."',
usuario='".$usuario."'


where
keyDA='".$myrow3a['keyDA']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
echo '<script>
window.alert("Se actualizo el descuento");
</script>';


} else{
  $sqld = "INSERT INTO descuentosAutomaticos 
(entidad, 	porcentaje ,		usuario, 	 	departamento,statusCupon)
values
('".$entidad."',  '".$porcentaje."'   ,'".$usuario."','".$_GET['almacen']."'  ,'si')";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
echo '<script>
window.alert("Se agrego el descuento");
</script>';


} 





}





}
?>








<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  


  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF;
          background:#000066;

}
 
-->
</style>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
    
    
    
</head>



<BODY  >

<h1 align="center" class="titulos">Descuentos Automaticos por Cupones/Volantes </h1>
<p align="center" class="negro"><?php echo '<blink>'.$leyenda.'</blink>';?></p>
<form id="form1" name="form1" method="post" action="">
  <p align="center">&nbsp;</p>





  <label></label>  
  <div align="center">Porcentaje Global 
  
  <?php 
  $sSQL3a= "Select * From descuentosAutomaticos WHERE entidad='".$entidad."' and departamento = '".$_GET['almacen']."'  and statusCupon='si'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
?>
    <input name="porcentaje" type="text" value="<?php  echo $myrow3a['porcentaje'];?>" size="5" />
  </div>
  <p align="center">
    <label><span class="codigos">Se activa al presentar un cupon o un volante</span>..<br /> 
    <br />
    </label>
    <input type="submit" name="asignar" id="asignar" value="Efectuar Cambios"/>
  </p>
<p align="center"><input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera; ?>" />

  * si desea eliminar el porcentaje, escribir 0 o dejar vacio... </p>
</form>

<p align="center">
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
			return "/sima/cargos/clientesPrincipales.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
      <script>
		new Autocomplete("razonSocial", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("rfc")[0].value = id;
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
			return "/sima/cargos/rfcx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>



