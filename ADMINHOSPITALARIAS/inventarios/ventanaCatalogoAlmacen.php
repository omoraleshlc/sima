<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
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

if($_POST['actualizar'] AND $_POST['almacen'] and $_POST['descripcion']){
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' and almacen = '".$_POST['almacen']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['almacen']){
if($_POST['almacen']!=$myrow1['almacen']){




$agrega = "INSERT INTO almacenes (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,medico,ventas,
altaPaciente,altaEspecial,cargosDirectos,numConsultorio,transacciones,contieneEmpleados,compras,ventasDirectas,modificarPrecios,cierreCuenta,registroUrgencias,credenciales,medicamentosSueltos,
permiteDevoluciones,almacenCargo,reporteSurtir,statusCitas,cambiarDescripcion,puntoVenta,actualizaPrecios,especialidad,almacenConsumo,maquila,beneficencia,
almacenExistencias
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','".$medico."','".$_POST['ventas']."','".$_POST['altaPaciente']."','".$_POST['altaEspecial']."',
    '".$cargosDirectos."','".$_POST['numConsultorio']."','".$_POST['transacciones']."','".$_POST['contieneEmpleados']."',
        '".$_POST['compras']."','".$_POST['ventasDirectas']."','".$_POST['modificarPrecios']."','".$_POST['cierreCuenta']."',
            '".$_POST['registroUrgencias']."','".$_POST['credenciales']."','".$_POST['medicamentosSueltos']."',
                '".$_POST['permiteDevoluciones']."','".$_POST['almacenCargo']."','".$_POST['reporteSurtir']."',
                    '".$_POST['statusCitas']."','".$_POST['cambiarDescripcion']."','".$_POST['puntoVenta']."',
    '".$_POST['actualizaPrecios']."','".$_POST['especialidad']."','".$_POST['almacenConsumo']."','".$_POST['maquila']."','".$_POST['beneficencia']."',
        '".$_POST['almacenExistencias']."'

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
    almacenExistencias='".$_POST['almacenExistencias']."',
beneficencia='".$_POST['beneficencia']."',    
maquila='".$_POST['maquila']."',
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
puntoVenta='".$_POST['puntoVenta']."',
almacenConsumo='".$_POST['almacenConsumo']."'
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
echo 'Almac�n Modificado';
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
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<form id="form2" name="form2" method="post" action="" >
   <p align="center" class="titulos">

     Crear/Modificar Almacen</p>
   <table width="544" border="0" cellspacing="0" cellpadding="0" align="center">
     <tr>
       <td colspan="5"><img src="../../imagenes/bordestablas/borde1.png" width="550" height="22" /></td>
     </tr>
     <tr>
       <td width="25" height="29" bgcolor="#CCCCCC">&nbsp;</td>
       <td width="117" bgcolor="#CCCCCC" class="negromid">Codigo Almacen</td>
       <td width="76" bgcolor="#CCCCCC"><input name="almacen" type="text" class="camposmid" id="almacen" value="<?php echo $myrow2['almacen']?>" 
size="15" <?php if($myrow2['almacen']){ echo 'readonly=""';}?>/></td>
       <td width="136" bgcolor="#CCCCCC" align="center" class="negromid">         Status <span class="style12">
       <select name="activo" class="camposmid" id="activo">
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
         </select>
       </span></td>
       <td width="196" bgcolor="#CCCCCC" class="negromid"><span class="style12">MiniAlmacen
         <select name="miniAlmacen" class="camposmid" id="miniAlmacen">
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
         </select>
       </span></td>
     </tr>
     <tr>
       <td height="27" bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Descripcion</td>
       <td colspan="3" bgcolor="#CCCCCC"><span class="style12">
         <input name="descripcion" type="text" class="camposmid" id="descripcion" 
	   value ="<?php echo $myrow2['descripcion']?>" size="60"/>
       </span></td>
     </tr>
     
     
     
     
     <tr>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC"><span class="negromid">Ctro. Costo</span></td>
       <td colspan="3" bgcolor="#CCCCCC"><span class="style12"><span class="Estilo24">
         <input name="ctaContable" type="text" class="camposmid" id="ctaContable" 
	   value ="<?php echo $myrow2['ctaContable']?>" />
       </span></span></td>
     </tr>
     
     
     
     
     
     <tr>
       <td height="43" bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Almacen Principal</td>
       <td colspan="3" bgcolor="#CCCCCC"><span class="style12"><span class="Estilo24">
         <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenSS($entidad,'style7',$myrow2['almacenPadre'],$almacenDestino,$basedatos);
?>
       </span></span></td>
     </tr>
     
     
     
     
     
     <tr>
       <td height="27" bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Cuartos</td>
       <td bgcolor="#CCCCCC"><span class="style12">
         <select name="tieneCuartos" class="camposmid" id="tieneCuartos">
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
       </span></td>
       <td colspan="2" bgcolor="#CCCCCC" class="negromid">N Consultorio<span class="style12">
         <input name="numConsultorio" type="text" class="camposmid" id="numConsultorio" value="<?php echo $myrow2['numConsultorio']; ?>" />
       </span></td>
     </tr>
     
     
     
     
     <tr>
       
         <td bgcolor="#CCCCCC">&nbsp;</td>
       
       
       
       <td bgcolor="#CCCCCC" class="negromid">Ventas<span class="style12">
       <input type="checkbox" name="ventas" value="si" <?php 
		 if($myrow2['ventas']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?>  />
       </span></td>
       
       
       <td bgcolor="#CCCCCC">&nbsp;</td>
       
       
       <td bgcolor="#CCCCCC" class="negromid">No surte, el cargo es directo<span class="style12"><span class="Estilo24">
         <input name="cargosDirectos" type="checkbox" id="cargosDirectos" value="si" <?php 
		 if($myrow2['cargosDirectos']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       
       
       
              <td bgcolor="#CCCCCC" class="negromid">Beneficencia<span class="style12"><span class="Estilo24">
         <input name="beneficencia" type="checkbox" id="cargosDirectos" value="si" <?php 
		 if($myrow2['beneficencia']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       
       
       
       <td bgcolor="#CCCCCC" class="negromid">El Almacen tiene Empleados <span class="style12"><span class="Estilo24">
         <input name="contieneEmpleados" type="checkbox" id="contieneEmpleados" value="si" <?php 
		 if($myrow2['contieneEmpleados']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       
       
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Transacciones<span class="style12"><span class="Estilo24">
         <input name="transacciones" type="checkbox" id="transacciones" value="si" <?php 
		 if($myrow2['transacciones']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Compras <span class="style12"><span class="Estilo24">
         <input name="compras" type="checkbox" id="compras" value="si" <?php 
		 if($myrow2['compras']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       <td bgcolor="#CCCCCC" class="negromid">Afecta Stock<span class="style12"><span class="Estilo24">
         <input name="stock" type="checkbox" id="stock" value="si" <?php 
		 if($myrow2['stock']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td colspan="2" bgcolor="#CCCCCC" class="negromid">Ventas Directas <span class="style12"><span class="Estilo24">
         <input name="ventasDirectas" type="checkbox" id="ventasDirectas" value="si" <?php 
		 if($myrow2['ventasDirectas']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       <td bgcolor="#CCCCCC" class="negromid">Servicios Modificables<span class="style12"><span class="Estilo24">
         <input name="modificarPrecios" type="checkbox" id="modificarPrecios" value="si" <?php 
		 if($myrow2['modificarPrecios']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       <td bgcolor="#CCCCCC" class="negromid">Cierre de Cuenta <span class="style12"><span class="Estilo24">
         <input name="cierreCuenta" type="checkbox" id="cierreCuenta" value="si" <?php 
		 if($myrow2['cierreCuenta']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Devoluciones <span class="style12"><span class="Estilo24">
         <input name="permiteDevoluciones" type="checkbox" id="permiteDevoluciones" value="si" <?php 
		 if($myrow2['permiteDevoluciones']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td colspan="2" bgcolor="#CCCCCC" class="negromid">Almacen de Consumo <span class="style12"><span class="Estilo24">
         <input name="almacenConsumo" type="checkbox" id="almacenConsumo" value="si" <?php 
		 if($myrow2['almacenConsumo']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
     </tr>
     <tr>
       <td height="34" bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Almacen Ingreso *opcional</td>

       <td colspan="3" bgcolor="#CCCCCC"><span class="style12">
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
         </select>


       </span></td>
     </tr>
     <tr>
       <td height="69" bgcolor="#CCCCCC">&nbsp;</td>
       <td valign="top" bgcolor="#CCCCCC" class="negromid">Reporte para Surtir</td>
       <td colspan="3" valign="top" bgcolor="#CCCCCC"><span class="style12">
         <input name="reporteSurtir" type="text" id="reporteSurtir" value="<?php echo $myrow2['reporteSurtir'];?>" size="30" />
         <br /><span class="codigos">
1.imprimirServiciosMuestra.php Lab,Rx<br />
2.imprimirServicios.php Cendis</span></td>
     </tr>
     <tr>
       <td height="29" bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Act. Precios 
         <input name="actualizaPrecios" type="checkbox" id="actualizaPrecios" value="si" <?php 
		 if($myrow2['actualizaPrecios']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> /></td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Maquila Articulos 
         <input name="maquila" type="checkbox" id="maquila" value="si" <?php 
		 if($myrow2['maquila']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
    </td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
     </tr>
     <tr>
       <td height="25" bgcolor="#CCCCCC">&nbsp;</td>
       <td colspan="2" bgcolor="#CCCCCC" class="negromid">Punto de Venta (Caja) <span class="style12"><span class="Estilo24">
         <input name="puntoVenta" type="checkbox" id="puntoVenta" value="si" <?php 
		 if($myrow2['puntoVenta']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       <td colspan="2" bgcolor="#CCCCCC" class="negromid"> Vende Material Suelto<span class="style12"><span class="Estilo24">
         <input name="medicamentosSueltos" type="checkbox" id="medicamentosSueltos" value="si" <?php 
		 if($myrow2['medicamentosSueltos']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
     </tr>





     <tr>
       <td height="34" bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="negromid">Almacen Existencias *opcional</td>

       <td colspan="3" bgcolor="#CCCCCC"><span class="style12">
         <?php 
       $aCombo= "Select * From almacenes where entidad='".$entidad."' 
 and activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
         <select name="almacenExistencias"  id="almacenCargo"/>
         
         <option value="">---</option>
         <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
         <option 
		<?php 
		if($myrow2['almacenExistencias']==$resCombo['almacen'] ){
		
		echo 'selected="selected"';		
			
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
         <?php } ?>
         </select>


       </span></td>
     </tr>




     <tr>
       <td bgcolor="#CCCCCC" >&nbsp;</td>
       <td colspan="2" bgcolor="#CCCCCC"><span class="negromid">Registro de Urgencias<span class="style12">
         <input name="registroUrgencias" type="checkbox" id="registroUrgencias" value="si" <?php 
		 if($myrow2['registroUrgencias']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></td>
       <td bgcolor="#CCCCCC"><span class="negromid">Status Citas <span class="style12"><span class="Estilo24">
         <input name="statusCitas" type="checkbox" id="statusCitas" value="A" <?php 
		 if($myrow2['statusCitas']=='A'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></span></td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td colspan="3" bgcolor="#CCCCCC"><span class="negromid">Cambia Descripcion en Citas <span class="style12"><span class="Estilo24">
         <input name="cambiarDescripcion" type="checkbox" id="cambiarDescripcion" value="si" <?php 
		 if($myrow2['cambiarDescripcion']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></span></span></td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
     </tr>
     <tr>
       <td height="33" colspan="2" align="center"><span class="style12"><span class="Estilo24">
         <input name="nuevo" type="submit" class="boton1" id="nuevo" value="Nuevo Almac&eacute;n" />
       </span></span></td>
       <td colspan="2" align="center"><span class="style12"><span class="Estilo24">
         <input name="actualizar" type="submit" class="boton1"  id="actualizar" value="Alta/Modificar Almac&eacute;n" />
       </span></span></td>
       <td align="center"><span class="style12"><span class="Estilo24">
         <input name="borrar" type="submit" class="boton2" id="borrar" value="Eliminar Almac&eacute;n" />
       </span></span></td>
     </tr>
     <tr>
       <td colspan="5"><img src="../../imagenes/bordestablas/borde2.png" width="550" height="22" /></td>
     </tr>
   </table>

     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
  </p>
</form>
</body>
</html>
