<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=860,scrollbars=YES") 
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


if(!$_POST['almacen']){
    $_POST['almacen']=rand(1,40000).$fecha1.$hora1;
}


if($_POST['actualizar'] AND $_POST['almacen'] and $_POST['descripcion']){
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' and almacen = '".$_POST['almacen']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


$sSQL1a= "Select * From medicos WHERE entidad='".$entidad."' and numMedico = '".$_POST['medico']."' ";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);
$_POST['especialidad']=$myrow1a['especialidad'];

if(!$myrow1['almacen']){
if($_POST['almacen']!=$myrow1['almacen']){

//********************SOLO STOCK*****************
    $sSQL333a= "SELECT
MAX(keyconta)+1 as CVI
FROM contadoralmacenes
WHERE entidad='".$entidad."'   ";

$result333a=mysql_db_query($basedatos,$sSQL333a);
$myrow333a = mysql_fetch_array($result333a);

if(!$myrow333a['CVI']){
$myrow333a['CVI']=1;
}



//********************************SE INCREMENTA EN 1*****************************
$agrega = "INSERT INTO contadoralmacenes (
usuario,entidad
) values (
'".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$agrega = "INSERT INTO almacenes (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,medico,ventas,
altaPaciente,altaEspecial,cargosDirectos,numConsultorio,transacciones,contieneEmpleados,compras,ventasDirectas,modificarPrecios,cierreCuenta,
registroUrgencias,credenciales,medicamentosSueltos,
permiteDevoluciones,almacenCargo,reporteSurtir,statusCitas,cambiarDescripcion,puntoVenta,actualizaPrecios,especialidad,manejaexpedientes,beneficencia
) values ('".$myrow333a['CVI']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','".$medico."','".$_POST['ventas']."','".$_POST['altaPaciente']."',
    '".$_POST['altaEspecial']."','".$cargosDirectos."','".$_POST['numConsultorio']."',
        '".$_POST['transacciones']."','".$_POST['contieneEmpleados']."','".$_POST['compras']."',
            '".$_POST['ventasDirectas']."','".$_POST['modificarPrecios']."','".$_POST['cierreCuenta']."',
                '".$_POST['registroUrgencias']."','".$_POST['credenciales']."','".$_POST['medicamentosSueltos']."',
                    '".$_POST['permiteDevoluciones']."','".$_POST['almacenCargo']."','".$_POST['reporteSurtir']."',
                        '".$_POST['statusCitas']."','".$_POST['cambiarDescripcion']."','".$_POST['puntoVenta']."',
                            '".$_POST['actualizaPrecios']."','".$_POST['especialidad']."','".$_POST['manejaexpedientes']."',
                                '".$_POST['beneficencia']."'

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







//**************************************SI NO EXISTE EN EXISTENCIAS DALOS DE ALTA********************

$sSQL3= "Select * From existencias WHERE entidad='".$entidad."' AND codigo = '".$_POST['codigo']."'
AND almacen = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if(!$myrow3['codigo'] and $nivel1[$i] and $nivel3[$i]){

$agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad
) values (
'".$_POST['codigo']."',
'".$agregar[$i]."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



$leyenda = "Se ingreso el almacen para el articulo: ".$_POST['codigo'];
} //cierra validacion
//*********************************************

echo '<script>
window.alert( "ALMACEN AGREGADO EXITOSAMENTE ");
   window.opener.document.forms["form2"].submit();
    self.close();
</script>';
echo 'Almacen o mini-Almacen agregado..';
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
    beneficencia='".$_POST['beneficencia']."',
manejaexpedientes='".$_POST['manejaexpedientes']."',    
especialidad='".$_POST['especialidad']."',
actualizaPrecios='".$_POST['actualizaPrecios']."',
almacenCargo='".$_POST['almacenCargo']."',
credenciales='".$_POST['credenciales']."',
modificarPrecios='".$_POST['modificarPrecios']."', 
descripcion='".$_POST['descripcion']."', 
tieneCuartos='".$_POST['tieneCuartos']."',
ctaContable='".$_POST['ctaContable']."',
cierreCuenta='".$_POST['cierreCuenta']."',
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
id_medico='".$_POST['medico']."',medico='".$medico."',numConsultorio='".$_POST['numConsultorio']."',contieneEmpleados='".$_POST['contieneEmpleados']."',
compras='".$_POST['compras']."',
ventasDirectas='".$_POST['ventasDirectas']."',
registroUrgencias='".$_POST['registroUrgencias']."',
medicamentosSueltos='".$_POST['medicamentosSueltos']."',
permiteDevoluciones='".$_POST['permiteDevoluciones']."',
reporteSurtir='".$_POST['reporteSurtir']."',
statusCitas='".$_POST['statusCitas']."',
cambiarDescripcion='".$_POST['cambiarDescripcion']."',
puntoVenta='".$_POST['puntoVenta']."'

WHERE 
entidad='".$entidad."'
and
almacen='".$_POST['almacen']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Se Modifico el almacen';

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
echo 'Almacen Modificado';
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
$sSQL2= "Select * From almacenes WHERE  entidad='".$entidad."' and almacen = '".$_GET['almacen2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>

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
<form id="form2" name="form2" method="post" action="" >
   <p>
     <label></label></p>
   <img src="../../imagenes/bordestablas/borde1.png" alt="bo1" width="690" height="24" />
   <table width="690" border="0" align="center" cellpadding="1" cellspacing="0">
<tr>


        <input name="almacen" type="hidden" class="campos" id="almacen" value="<?php echo $myrow2['almacen']?>"
size="10" <?php if($myrow2['almacen']){ echo 'readonly=""';}?>/>


      <td width="268" bgcolor="#CCCCCC" class="negro">Descripcion</td>
      <td width="360" bgcolor="#CCCCCC" class="style12"><input name="descripcion" type="text" class="campos" id="descripcion" 
	   value ="<?php echo $myrow2['descripcion']?>" size="50"/></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC" class="negro">Cta Contable </td>
       <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="ctaContable" type="text" class="campos" id="ctaContable" 
	   value ="<?php echo $myrow2['ctaContable']?>" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC" class="negro">Status</td>
       <td bgcolor="#CCCCCC" class="style12"><select name="activo" class="campos" id="activo">
        
         <option
		 <?php if($myrow2['activo']=="A"){ ?>
		 selected="selected"
		 <?php } ?>
		  value="A">A</option>
         <option
		  <?php if($myrow2['activo']=="I"){ ?>
		  selected="selected"
		  <?php } ?>
		  value="I">I</option>
       </select></td>
     </tr>
     <tr>
	 

       <td bgcolor="#CCCCCC" class="negro">Es un miniAlmacen?</td>
       <td bgcolor="#CCCCCC" class="style12"><select name="miniAlmacen" class="campos" id="miniAlmacen">
         

	    <option
		  <?php if( $myrow2['miniAlmacen']=='Si' ){ ?>
		  selected="selected"
		  <?php } ?>
		   value="Si">Si</option>
         <option
		   <?php if( $myrow2['miniAlmacen']=='No'  ){ ?>
		  selected="selected"
		  <?php } ?>
		    value="No">No</option>
       </select>	      </td>
     </tr>
	 
	 

	
	 

     <tr>
       <td bgcolor="#CCCCCC" class="negro">Cto Costo[Cta. Mayor]</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenSS($entidad,'style7',$myrow2['almacenPadre'],$almacenDestino,$basedatos);
?>
       </span></td>
     </tr>
		

     <tr>
       <td bgcolor="#CCCCCC" class="negro">Tiene Cuartos/Internar ?	   </td>
     <td bgcolor="#CCCCCC" class="style12"><label>
         <select name="tieneCuartos" class="campos" id="tieneCuartos">
	
		  <option
		  <?php if($myrow2['tieneCuartos']=='si' or $myrow2['tieneCuartos']=='si'){ ?>
		  selected="selected"
		  <?php } ?>
		   value="si">si</option>
           <option
		   <?php if($myrow2['tieneCuartos']=='no' or $myrow2['tieneCuartos']=='no'){ ?>
		  selected="selected"
		  <?php } ?>
		    value="no">no</option>
        </select>
       </label></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC" class="negro">Numero Consultorio </td>
      <td bgcolor="#CCCCCC" class="style12"><label>
         <input name="numConsultorio" type="text" class="campos" id="numConsultorio" value="<?php echo $myrow2['numConsultorio']; ?>" />
       </label></td>
     </tr>
     <tr>
       <td height="32" bgcolor="#CCCCCC" class="negro">Permite Ventas?</td>
      <td bgcolor="#CCCCCC" class="style12"><label>
         <input type="checkbox" name="ventas" value="si" <?php 
		 if($myrow2['ventas']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?>  />
       </label></td>
     </tr>
     <tr>
       <td height="31" bgcolor="#CCCCCC" class="negro">Permite Cargos Directos </td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="cargosDirectos" type="checkbox" id="cargosDirectos" value="si" <?php 
		 if($myrow2['cargosDirectos']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
         (No necesita &quot;SURTIR&quot;)</span></td>
     </tr>
     <tr>
       <td height="28" bgcolor="#CCCCCC" class="negro">Contiene Empleados </td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="contieneEmpleados" type="checkbox" id="contieneEmpleados" value="si" <?php 
		 if($myrow2['contieneEmpleados']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="27" bgcolor="#CCCCCC" class="negro">Medico (En caso de ser) </td>
       <td bgcolor="#CCCCCC" class="style12">
	   <?php 
	   if($myrow2['id_medico']){
	   $medico=$myrow2['id_medico'];
	   } else {
	   $medico=$_POST['medico'];
	   }
	   
require("/configuracion/componentes/comboMedicos.php");
$listaMedicos=new despliegaMedicosSS();
$listaMedicos->listaMedicosSS($entidad,$medico,$basedatos);
	   ?>
	   &nbsp;</td>
     </tr>
     
          
          
          
          
         






     <tr>
       <td height="30" bgcolor="#CCCCCC" class="negro">Permite Transacciones </td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="transacciones" type="checkbox" id="transacciones" value="si" <?php 
		 if($myrow2['transacciones']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="25" bgcolor="#CCCCCC" class="negro">Permite Compras</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="compras" type="checkbox" id="compras" value="si" <?php 
		 if($myrow2['compras']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="29" bgcolor="#CCCCCC" class="negro">Afecta Stock</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="stock" type="checkbox" id="stock" value="si" <?php 
		 if($myrow2['stock']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="28" bgcolor="#CCCCCC" class="negro">Ventas Directas </td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="ventasDirectas" type="checkbox" id="ventasDirectas" value="si" <?php 
		 if($myrow2['ventasDirectas']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="29" bgcolor="#CCCCCC" class="negro">Permite Modificar Precios</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="modificarPrecios" type="checkbox" id="modificarPrecios" value="si" <?php 
		 if($myrow2['modificarPrecios']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="29" bgcolor="#CCCCCC" class="negro">Registro de Urgencias</td>
      <td bgcolor="#CCCCCC" class="style12">
         <input name="registroUrgencias" type="checkbox" id="registroUrgencias" value="si" <?php 
		 if($myrow2['registroUrgencias']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       <span class="codigos">(Si deseas datos de hoja de internamiento de urgencias)</span></td>
     </tr>
    
     
     <tr>
       <td height="27" bgcolor="#CCCCCC" class="negro">Utiliza Expedientes</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="manejaexpedientes" type="checkbox" id="manejaexpedientes" value="si" <?php 
		 if($myrow2['manejaexpedientes']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     
     
     
     
     
     <tr>
       <td bgcolor="#CCCCCC" class="negro">Permite Devoluciones</td>
       <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="permiteDevoluciones" type="checkbox" id="permiteDevoluciones" value="si" <?php 
		 if($myrow2['permiteDevoluciones']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="34" bgcolor="#CCCCCC" class="negro">Almacen Cargo [El ingreso se va a este almacen]</td>
       <td bgcolor="#CCCCCC" class="style12">
       
       <?php 
       $aCombo= "Select * From almacenes where entidad='".$entidad."' 
and ventas='si' and activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenCargo"  id="almacenCargo"/>        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($myrow2['almacenCargo']!='' and ($myrow2['almacenCargo']==$resCombo['almacen'] )){
		
		echo 'selected="selected"';		
			
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>       </td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC" class="negro"><p>Reporte para surtir</p>       </td>
       <td bgcolor="#CCCCCC" class="style12"><label>
      

<input name="reporteSurtir" type="text" id="reporteSurtir" value="<?php echo $myrow2['reporteSurtir'];?>" size="30" />
<br />
1.imprimirServiciosMuestra.php Lab,Rx<br />
2.imprimirServicios.php Cendis<br />
       </label></td>
     </tr>
     <tr>
       <td height="30" bgcolor="#CCCCCC" class="negro">Status Citas (medicos solamente)</td>
       <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="statusCitas" type="checkbox" id="statusCitas" value="A" <?php 
		 if($myrow2['statusCitas']=='A'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="46" bgcolor="#CCCCCC" class="negro">Cambia Descripci&oacute;n (en citas se puede cambiar el concepto)</td>
       <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="cambiarDescripcion" type="checkbox" id="cambiarDescripcion" value="si" <?php 
		 if($myrow2['cambiarDescripcion']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr>
       <td height="30" bgcolor="#CCCCCC" class="negro">Punto de Venta (M&oacute;dulo de Caja)</td>
       <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="puntoVenta" type="checkbox" id="puntoVenta" value="si" <?php 
		 if($myrow2['puntoVenta']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     
     
     
     <tr>
       <td height="30" bgcolor="#CCCCCC" class="negro">Actualiza Precios </td>
       <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="actualizaPrecios" type="checkbox" id="actualizaPrecios" value="si" <?php 
		 if($myrow2['actualizaPrecios']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     
     
     
     <tr>
       <td height="37" bgcolor="#CCCCCC" class="negro">Beneficencia</td>
       <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="beneficencia" type="checkbox" id="actualizaPrecios" value="si" <?php 
		 if($myrow2['beneficencia']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     
     
     
     
     <tr>
       <td bgcolor="#CCCCCC" class="negro">Vende Materiales Sueltos?</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
         <input name="medicamentosSueltos" type="checkbox" id="medicamentosSueltos" value="si" <?php 
		 if($myrow2['medicamentosSueltos']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
  </table>
<img src="../../imagenes/bordestablas/borde2.png" alt="bo2" width="690" height="24" /><br />
   <table width="611" align="center">
     <tr>
       <td width="130" align="center"><div align="center"></div></td>



       <td width="269" align="center"><span class="style12"><span class="Estilo24">
         <input name="actualizar" type="submit" src="../../imagenes/btns/modialma.png"  id="actualizar" value="Guardar Cambios" />
       </span></span></td>



       <td width="196" align="center"><div align="center"><span class="style12"><span class="Estilo24">
         <input name="borrar" type="submit" src="../../imagenes/btns/deletebutton.png" id="borrar" value="Eliminar Almac&eacute;n" />
       </span></span></div></td>


       
     </tr>
   </table>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
<p>
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
  </p>
</form>
</body>
</html>
