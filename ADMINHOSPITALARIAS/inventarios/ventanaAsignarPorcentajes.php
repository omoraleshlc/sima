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
if($_POST['actualizar'] ){






if( $_POST['porcentajeparticular']>-1 and $_POST['porcentajeaseguradora']>-1){




$sqld = "UPDATE almacenes set
porcentajeparticular='".$_POST['porcentajeparticular']."',
porcentajeaseguradora='".$_POST['porcentajeaseguradora']."'


where
entidad='".$entidad."'
    and
almacen='".$_GET['almacen']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
echo '<script>
window.alert("Se actualizo el porcentaje");
</script>';








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



<body>

<h1 align="center" class="titulos">Politicas de Precio, Porcentajes...</h1>
<p align="center" class="negro"><?php echo '<blink>'.$leyenda.'</blink>';?></p>
<form id="form1" name="form1" method="post" action="">
  <p align="center">&nbsp;</p>





  <label></label>  
  <div align="center">Porcentaje Particular
  
<?php 
$sSQL3a= "Select * From almacenes WHERE entidad='".$entidad."' and almacen = '".$_GET['almacen']."'   ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
?>

    <input name="porcentajeparticular" type="text" value="<?php  echo $myrow3a['porcentajeparticular'];?>" size="10" />
    </div>



    <div align="center">Porcentaje Aseguradora
    <input name="porcentajeaseguradora" type="text" value="<?php  echo $myrow3a['porcentajeaseguradora'];?>" size="10" />
  </div>


  <p align="center">
   <input name="actualizar" type="submit" value="Actualizar Cambios" size="10" />
   </p>

  
</form>



</body>
</html>



