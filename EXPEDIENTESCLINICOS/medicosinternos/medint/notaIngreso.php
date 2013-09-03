<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<?php
if($_GET['almacen2']){
$alma=$_GET['almacen2'];
} else {
$alma=$_POST['almacen'];
}

if($_POST['medico']){
$medico='si';
} else {
$medico='no';
}


if($_POST['transacciones']){
$transacciones='si';
} else {
$transacciones='no';
}


if($_POST['cargosDirectos']){
$cargosDirectos='si';
} else {
$cargosDirectos='no';
}

if($_POST['id_medico']=='---'){
$_POST['id_medico']=NULL;
}

if(!$_POST['ventas']){
$_POST['ventas']='no';
}

if(!$_POST['altaPaciente']){
$_POST['altaPaciente']='no';
}

if(!$_POST['altaEspecial']){
$_POST['altaEspecial']='no';
}

if($_POST['actualizar'] AND $_POST['almacen'] ){
$sSQL1= "Select * From almacenes WHERE almacen = '".$_POST['almacen']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['almacen']){
if($_POST['almacen']!=$myrow1['almacen']){




$agrega = "INSERT INTO almacenes (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,medico,ventas,
altaPaciente,altaEspecial,cargosDirectos,numConsultorio,transacciones
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','".$medico."','".$_POST['ventas']."','".$_POST['altaPaciente']."','".$_POST['altaEspecial']."','".$cargosDirectos."','".$_POST['numConsultorio']."','".$_POST['transacciones']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega = "INSERT INTO almacenesHistoria (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,tipoTransaccion
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','insertar'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo '<script type="text/vbscript">
msgbox "ALMACEN AGREGADO EXITOSAMENTE "
</script>';
echo 'Almacén o mini-Almacén agregado..'; 
}} else {

$agrega = "INSERT INTO almacenesHistoria (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,tipoTransaccion
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','actualizar'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



$q = "UPDATE almacenes set 
descripcion='".$_POST['descripcion']."', 
tieneCuartos='".$_POST['tieneCuartos']."',
ctaContable='".$_POST['ctaContable']."',
usuario='".$usuario."',
fecha1='".$fecha1."',
ID_CCOSTO='".$_POST['ctaContable']."',
modulo='".$_POST['modulo']."',
activo='".$_POST['activo']."',
ventas='".$_POST['ventas']."',
altaPaciente='".$_POST['altaPaciente']."',altaEspecial='".$_POST['altaEspecial']."',
miniAlmacen='".$_POST['miniAlmacen']."',almacenPadre='".$_POST['almacenDestino']."',
stock='".$_POST['stock']."',
transacciones='".$_POST['transacciones']."',
cargosDirectos='".$cargosDirectos."',
id_medico='".$_POST['medico']."',medico='".$medico."',numConsultorio='".$_POST['numConsultorio']."'

WHERE 
almacen='".$_POST['almacen']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Se Modificó el almacén';

} 

echo '<script language="JavaScript" type="text/javascript">
  <!--
   window.opener.document.forms["form2"].submit();
    self.close();
  // -->
</script>';
}








if($_POST['borrar'] AND $_POST['almacen']){

$agrega = "INSERT INTO almacenesHistoria (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,tipoTransaccion
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','eliminar'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$borrame = "DELETE FROM almacenes WHERE almacen ='".$_POST['almacen']."' and entidad='".$entidad."'";
mysql_db_query($basedatos,$borrame);

echo mysql_error();
echo 'Almacén Modificado';
echo '<script type="text/vbscript">
msgbox "ALMACEN ELIMINADO "
</script>';
?>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>

<?php }









if($_POST['agregar']){
/** checo si existe**/
$_POST['almacen'] = "";
}


if($_GET['almacen2'] AND !$_POST['nuevo']){
$sSQL2= "Select * From almacenes WHERE almacen = '".$_GET['almacen2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.Estilo24 {font-size: 10px}
.style13 {font-size: 10px; font-weight: bold; }
-->
</style>
</head>

<body>
<form id="form2" name="form2" method="post" action="" >
   <p>
     <label></label></p>
   <div align="center">
     <h1><strong>NOTA DE INGRESO </strong></h1>
   </div>
   <table width="709" border="0" align="center">
     <tr>
       
       <th colspan="2" bgcolor="#FFCCFF" class="style12" scope="col">
	       <div align="center">Datos B&aacute;sicos           </div>         </th>
       </tr>
     <tr>
       <td width="131" class="style12"><strong>Problema</strong></td>
       <td width="568" class="style12"><label>
         <textarea name="problema" cols="80" wrap="virtual" class="style12" id="problema">Secundigesta de + cesárea previa + DCP</textarea>
       </label></td>
     </tr>
     <tr>
	 

       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
     </tr>
	 
	 

	
	 

     <tr>
       <td class="style12"><strong>Subjetivo</strong></td>
       <td class="style12"><textarea name="subjetivo" cols="80" wrap="virtual" class="Estilo24" id="subjetivo">Embarazo de SDG en prodrómodos de trabajo de Parto. Se programa para cesárea por cesárea previa.</textarea></td>
     </tr>
		

     <tr>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12"><label></label></td>
     </tr>
     <tr>
       <td class="style12"><strong>Objetivo</strong></td>
       <td class="style12"><label></label></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Signos Vitales</td>
       <td bgcolor="#FFCCFF" class="style12"><label></label></td>
     </tr>
     <tr>
       <td class="style12">Tensi&oacute;n Arterial </td>
       <td class="style12"><input name="tensionArterialSV" type="text" class="Estilo24" id="tensionArterialSV" /></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Frecuencia Card&iacute;aca </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="frecuenciaCardiacaSV" type="text" class="Estilo24" id="frecuenciaCardiacaSV" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Frecuencia Respiratoria </td>
       <td class="style12"><span class="Estilo24">
         <input name="frecuenciaRespiratoriaSV" type="text" class="Estilo24" id="frecuenciaRespiratoriaSV" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Temperatura</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="temperaturaSV" type="text" class="Estilo24" id="temperaturaSV" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Exploracion Fisica </td>
       <td class="style12"><span class="Estilo24">
         <textarea name="exploracionFisica" cols="80" wrap="virtual" class="Estilo24" id="exploracionFisica"></textarea>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Cabeza</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <textarea name="cabeza" cols="80" wrap="virtual" class="Estilo24" id="cabeza"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Cuello</td>
       <td class="style12"><span class="Estilo24">
         <textarea name="cuello" cols="80" wrap="virtual" class="Estilo24" id="cuello"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style13">Analisis</td>
       <td class="style12"><textarea name="analisis" cols="80" wrap="virtual" class="Estilo24" id="analisis"></textarea></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td class="style13"> Pronostico</td>
       <td class="style12"><span class="Estilo24">
         <label></label>
         Bueno 
         <label>
         <input name="pronostico" type="radio" value="bueno" />
         </label>
       || Malo 
         <label></label>
         <input name="pronostico" type="radio" value="malo" />
        || Reservado 
        <label>
        <input name="pronostico" type="radio" value="reservado" />
        </label>
       </span></td>
     </tr>
     <tr>
       <td class="style13">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td class="style13">Plan y Manejo </td>
       <td class="style12"><span class="Estilo24">
         <textarea name="planManejo" cols="80" wrap="virtual" class="Estilo24" id="planManejo"></textarea>
       </span></td>
     </tr>
  </table>
   <p align="center">
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
     <label>
     <input name="Submit" type="submit" class="style12" value="Submit" />
     </label>
   </p>
</form>
</body>
</html>
