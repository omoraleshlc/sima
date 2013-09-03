<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=430,height=700,scrollbars=YES") 
} 
</script> 



<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=430,height=700,scrollbars=YES") 
} 
</script> 


<?php



if($_POST['grabar'] AND $_POST['codigoPaquete']  and $_POST['descripcionPaquete']){
$sSQL1= "Select * From paquetes WHERE entidad='".$entidad."' and codigoPaquete = '".$_POST['codigoPaquete']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();


if(!$myrow1['codigoPaquete']){

$agrega = "INSERT INTO paquetes (
codigoPaquete,descripcionPaquete,usuario,fecha,hora,entidad,seguro,fechaInicial,fechaFinal,infinito) 
values ('".$_POST['codigoPaquete']."','".$_POST['descripcionPaquete']."','".$usuario."','".$fecha1."','".$hora1."',
'".$entidad."','".$_POST['seguro']."','".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$_POST['infinito']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

echo 'Se agrego el art�culo al paquete';
echo '<script >
window.alert( "SE AGREGO EL ARTICULO AL PAQUETE... ");
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
self.close();
  // -->
</script>';
} else {

$sql="UPDATE paquetes
set
fechaInicial='".$_POST['fechaInicial']."',
    fechaFinal='".$_POST['fechaFinal']."',
        infinito='".$_POST['infinito']."',
descripcionPaquete='".$_POST['descripcionPaquete']."',
seguro='".$_POST['seguro']."',
usuario='".$usuario."',
fecha='".$fecha1."',

hora='".$hora1."'
where 
entidad='".$entidad."' and codigoPaquete = '".$_POST['codigoPaquete']."'  ";
mysql_db_query($basedatos,$sql);
echo mysql_error();
echo '<script >
  <!--
    opener.location.reload(true);

  // -->
</script>';

echo '<script >
window.alert( "YA EXISTE ESTE PAQUETE, SE ACTUALIZO");
</script>';

}
}
?>

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<h1 align="center" class="style11">NUEVO/MODIFICAR PAQUETE	   </h1>
   <table width="500" class="table-forma">

     <tr>
       <td width="13"  scope="col">&nbsp;</td>
       <td width="75"  scope="col"><div align="left">C&oacute;digo </div>         
       <label></label></td>
	   
	   
<?php   
$sSQL= "Select * From paquetes where keyPAQ='".$_GET['keyPAQ']."'";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow2 = mysql_fetch_array($result);
?>
	   
       <td width="386"  scope="col"><div align="left">
         <input name="codigoPaquete" type="text"  id="codigoPaquete" 
		 value="<?php echo $myrow2['codigoPaquete']; ?>"/>
       </div></td>
     </tr>
     <tr>
       <td width="13"  scope="col">&nbsp;</td>
       <td  ><div align="left">Descripci&oacute;n  </div></td>
       <td  >
	   <input name="descripcionPaquete" type="text"  id="descripcionPaquete" 
	   value ="<?php echo $myrow2['descripcionPaquete']; ?>" size="30"/></td>
     </tr>
       

       
 
<tr >
    <td width="1" scope="col">&nbsp;</td>
    <td><div align="left" >Fecha Inicial</div></td>
    <td><div align="left">
      <label>
        <input name="fechaInicial" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 
		 echo $myrow2['fechaInicial'];
		
		 ?>"/>
        </label>
      <input name="button" type="image"  id="lanzador" value="..." src="/sima/imagenes/btns/fecha.png" />
    </div></td>
  </tr>
  <tr >
    <td scope="col">&nbsp;</td>
    <td><div align="left" >Fecha Final </div></td>
    <td><label>
      <input name="fechaFinal" type="text"  id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 
		 echo $myrow2['fechaInicial'];
		
		 ?>"/>
    </label>
      <input name="button1" type="image"  id="lanzador1" value="..." src="/sima/imagenes/btns/fechadate.png"/></td>
  </tr>
       
       
       
       
       
     <tr>
       <td  scope="col"></td>
       <td >Infinito</td>
       <td ><input type="checkbox" name="infinito" value="si" <?php if($myrow2['infinito']=='si'){echo 'checked=""';}?></td>
     </tr>
     <tr>
       <td width="13"  scope="col"></td>
       <td >&nbsp;</td>
       <td ><input name="grabar" type="submit"  id="grabar" value="Agregar Paquete" /></td>
     </tr>
   </table>
   <p>&nbsp;</p>
</form>
    
    
    
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
    </script>    
</body>
</html>
