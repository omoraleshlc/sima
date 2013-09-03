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

if($_POST['porcentajePE']>0 and $_POST['horaPE']){
$_POST['precioEspecial']='si';  
}else{
$_POST['precioEspecial']=NULL;   
}




if($_POST['actualizar'] AND $_POST['almacen'] and $_POST['descripcion']){
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' and almacen = '".$_POST['almacen']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['almacen']){
if($_POST['almacen']!=$myrow1['almacen']){


echo $agrega = "INSERT INTO almacenes (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,medico,ventas,
altaPaciente,altaEspecial,cargosDirectos,numConsultorio,transacciones,contieneEmpleados,compras,ventasDirectas,
modificarPrecios,cierreCuenta,registroUrgencias,credenciales,medicamentosSueltos,
permiteDevoluciones,almacenCargo,reporteSurtir,statusCitas,cambiarDescripcion,puntoVenta,actualizaPrecios,especialidad,
precioEspecial,tipoBeneficencia,porcentajePE,horaPE,llenadoEspecial,ventaBotiquinExternos,imprimeTicket
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
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
                            '".$_POST['actualizaPrecios']."','".$_POST['especialidad']."',
                                '".$_POST['precioEspecial']."','".$_POST['tipoBeneficencia']."','".$_POST['porcentajePE']."',
                                   '".$_POST['horaPE']."','".$_POST['llenadoEspecial']."','".$_POST['ventaBotiquinExternos']."',
                                       '".$_POST['imprimeTicket']."')";
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







//*************************SI NO EXISTE EN EXISTENCIAS DALOS DE ALTA********************

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
window.close();
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
     imprimeTicket='".$_POST['imprimeTicket']."',
     ventaBotiquinExternos='".$_POST['ventaBotiquinExternos']."',
llenadoEspecial='".$_POST['llenadoEspecial']."',
horaPE='".$_POST['horaPE']."',   
porcentajePE='".$_POST['porcentajePE']."',     
precioEspecial='".$_POST['precioEspecial']."',
tipoBeneficencia='".$_POST['tipoBeneficencia']."',
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
id_medico='".$_POST['medico']."',medico='".$medico."',numConsultorio='".$_POST['numConsultorio']."',
contieneEmpleados='".$_POST['contieneEmpleados']."',
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
    window.close();
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
$sSQL2= "Select * From almacenes WHERE entidad='".$entidad."' and almacen = '".$_GET['almacen2']."' ";
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
   <img src="../imagenes/bordestablas/borde1.png" alt="bo1" width="787" height="21" align="center" />
   <table width="726" border="0" align="center" cellpadding="4" cellspacing="0">
<tr bgcolor="#CCCCCC" onMouseOver="bgColor='#FFCCFF'" onMouseOut="bgColor='#ffffff'" >
      <th width="134" class="style12" scope="col">
      <div align="left" class="negro">C&oacute;digo Almac&eacute;n: </div></th>
       <th width="180" class="style12" scope="col">
         <div align="left">
           <input name="almacen" type="text" class="campos" id="almacen" value="<?php echo $myrow2['almacen']?>" 
size="10" <?php if($myrow2['almacen']){ echo 'readonly=""';}?>/>
     </div></th>
       <th width="141" align="left" class="style12" scope="col"><span class="negro">Descripci&oacute;n Almacen:</span></th>
       <th width="239" class="style12" scope="col"><input name="descripcion" type="text" class="campos" id="descripcion" 
	   value ="<?php echo $myrow2['descripcion']?>" size="40"/></th>
</tr>
     <tr bgcolor="#CCCCCC">
       <td class="negro">Cto. Costo: </td>
       <td class="style12"><span class="Estilo24">
         <input name="ctaContable" type="text" class="campos" id="ctaContable" 
	   value ="<?php echo $myrow2['ctaContable']?>" size="30" />
       </span></td>
       <td class="style12"><span class="negro">Activo:</span></td>
       <td class="style12"><select name="activo" class="campos" id="activo">
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
     <tr bgcolor="#CCCCCC">
       <td class="negro">Es un miniAlmac&eacute;n?</td>
       <td class="style12"><select name="miniAlmacen" class="campos" id="miniAlmacen">
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
       </select></td>
       <td class="style12"><span class="negro">Almac&eacute;n Padre</span></td>
       <td class="style12"><span class="Estilo24">
         <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenSS($entidad,'style7',$myrow2['almacenPadre'],$almacenDestino,$basedatos);
?>
       </span></td>
     </tr>
     <tr bgcolor="#CCCCCC">
       <td class="negro">Tiene Cuartos/Internar ? </td>
       <td class="style12"><select name="tieneCuartos" class="campos" id="tieneCuartos">
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
       </select></td>
       <td class="style12"><span class="negro">Numero Consultorio </span></td>
       <td class="style12"><input name="numConsultorio" type="text" class="campos" id="numConsultorio" value="<?php echo $myrow2['numConsultorio']; ?>" /></td>
     </tr>
     <tr bgcolor="#CCCCCC">
	 

       <td class="negro">Permite Ventas?</td>
       <td class="style12"><input type="checkbox" name="ventas" value="si" <?php 
		 if($myrow2['ventas']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?>  /></td>
       <td class="style12"><span class="negro">Contiene Empleados </span></td>
       <td class="style12"><span class="Estilo24">
         <input name="contieneEmpleados" type="checkbox" id="contieneEmpleados" value="si" <?php 
		 if($myrow2['contieneEmpleados']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
	 
	 

	
	 

     <tr bgcolor="#CCCCCC">
       <td class="negro">Medico (En caso de ser) </td>
      <td class="style12"><?php 
	   if($myrow2['id_medico']){
	   $medico=$myrow2['id_medico'];
	   } else {
	   $medico=$_POST['medico'];
	   }
	   
require("/configuracion/componentes/comboMedicos.php");
$listaMedicos=new despliegaMedicosSS();
$listaMedicos->listaMedicosSS($entidad,$medico,$basedatos);
	   ?></td>
      <td class="style12"><span class="negro">Especialidad (solo medicos) </span></td>
      <td class="style12"><span class="Estilo24">
        <?php 
$aCombo= "Select * From especialidades where 
entidad='".$entidad."'  
and
subEspecialidad='no'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); 

?>
        <select name="especialidad" class="<?php echo $estilo;?>" id="especialidad"  />

        <option value="" >Escoje</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		?>
        <option 
		<?php 
if($myrow2['especialidad']==$resCombo['codigo'] or $id_especialidad==$resCombo['codigo']){
		
		echo 'selected="selected"';		
		}  ?>
		value="<?php echo $resCombo['codigo']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
      </span></td>
     </tr>
	
     
     
     
     

     <tr bgcolor="#CCCCCC">
       <td class="negro">Permite Transacciones </td>
     <td class="style12"><span class="Estilo24">
       <input name="transacciones" type="checkbox" id="transacciones" value="si" <?php 
		 if($myrow2['transacciones']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
     </span></td>
     <td class="style12"><span class="negro">Permite Compras</span></td>
     <td class="style12"><span class="Estilo24">
       <input name="compras" type="checkbox" id="compras" value="si" <?php 
		 if($myrow2['compras']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
     </span></td>
     </tr>
     
     
     
     
     
     <tr bgcolor="#CCCCCC">
       <td class="negro">Afecta Stock</td>
      <td class="style12"><span class="Estilo24">
        <input name="stock" type="checkbox" id="stock" value="si" <?php 
		 if($myrow2['stock']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
      <td class="style12"><span class="negro">Ventas Directas </span></td>
      <td class="style12"><span class="Estilo24">
        <input name="ventasDirectas" type="checkbox" id="ventasDirectas" value="si" <?php 
		 if($myrow2['ventasDirectas']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
     </tr>
     
     
     
     
     <tr bgcolor="#CCCCCC">
       <td class="negro">Permite Modificar Precios</td>
      <td class="style12"><span class="Estilo24">
        <input name="modificarPrecios" type="checkbox" id="modificarPrecios" value="si" <?php 
		 if($myrow2['modificarPrecios']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
      <td class="style12"><span class="negro">Registro de Urgencias</span></td>
      <td class="style12"><input name="registroUrgencias" type="checkbox" id="registroUrgencias" value="si" <?php 
		 if($myrow2['registroUrgencias']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       <span class="codigos">(Si deseas datos de hoja de internamiento de urgencias)</span></td>
     </tr>

     
     
     
     <tr bgcolor="#CCCCCC">
       <td class="negro">Cierre de Cuenta Directa</td>
      <td class="style12"><span class="Estilo24">
        <input name="cierreCuenta" type="checkbox" id="cierreCuenta" value="si" <?php 
		 if($myrow2['cierreCuenta']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
      <td class="style12"><span class="negro">Permite Devoluciones</span></td>
      <td class="style12"><span class="Estilo24">
        <input name="permiteDevoluciones" type="checkbox" id="permiteDevoluciones" value="si" <?php 
		 if($myrow2['permiteDevoluciones']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
     </tr>
     
     
     
     
     <tr bgcolor="#CCCCCC">
       <td class="negro">Almac&eacute;n Cargo</td>
       <td class="style12"><?php 
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
       </select></td>
       <td class="style12">Reporte para surtir</td>
       <td class="style12"><input name="reporteSurtir" type="text" id="reporteSurtir" value="<?php echo $myrow2['reporteSurtir'];?>" size="30" /></td>
     </tr>
     <tr bgcolor="#CCCCCC">
       <td class="negro">Status Citas (medicos solamente)</td>
       <td class="style12"><span class="Estilo24">
         <input name="statusCitas" type="checkbox" id="statusCitas" value="A" <?php 
		 if($myrow2['statusCitas']=='A'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
       <td class="style12"><span class="negro">Cambia Descripcion (en citas se puede cambiar el concepto)</span></td>
       <td class="style12"><span class="Estilo24">
         <input name="cambiarDescripcion" type="checkbox" id="cambiarDescripcion" value="si" <?php 
		 if($myrow2['cambiarDescripcion']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
       </span></td>
     </tr>
     <tr bgcolor="#CCCCCC">
       <td class="negro">Punto de Venta (Modulo de Caja)</td>
      <td class="style12"><span class="Estilo24">
        <input name="puntoVenta" type="checkbox" id="puntoVenta" value="si" <?php 
		 if($myrow2['puntoVenta']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
      <td class="style12"><span class="negro">Actualiza Precios </span></td>
      <td class="style12"><span class="Estilo24">
        <input name="actualizaPrecios" type="checkbox" id="actualizaPrecios" value="si" <?php 
		 if($myrow2['actualizaPrecios']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
     </tr>
     <tr bgcolor="#CCCCCC">
       <td class="negro">Vende Materiales Sueltos?</td>
      <td class="style12"><span class="Estilo24">
        <input name="medicamentosSueltos" type="checkbox" id="medicamentosSueltos" value="si" <?php 
		 if($myrow2['medicamentosSueltos']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
      <td class="style12"><span class="negro">Precio Especial</span></td>
      <td class="style12"><span class="Estilo24">
        <input class="normal" name="porcentajePE" size="7" type="text" id="precioEspecial2" value="<?php 
		 if($myrow2['porcentajePE']>0){
		 echo $myrow2['porcentajePE'];
		 } 		 
		 ?>" />
      </span></td>
     </tr>
     <tr bgcolor="#CCCCCC">
       <td class="negro">Porcentaje: aplicar despues de esta hora</td>
      <td class="style12"><span class="Estilo24">
        <input class="normal" name="horaPE" size="10" type="text" id="precioEspecial3" value="<?php 
		 if($myrow2['horaPE']>0){
		 echo $myrow2['horaPE'];
		 } 		 
		 ?>" />
      </span></td>
      <td class="style12"><span class="negro">Beneficencia Especial</span></td>
      <td class="style12"><span class="Estilo24">
        <input name="tipoBeneficencia" type="checkbox" id="precioEspecial4" value="si" <?php 
		 if($myrow2['tipoBeneficencia']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
     </tr>
     <tr bgcolor="#CCCCCC">
       <td class="negro">Requiere llenado Especial, escriba la ruta: </td>
      <td class="style12"><span class="Estilo24">
        <input class="normal" name="llenadoEspecial" type="text" id="precioEspecial" value="<?php 
		 if($myrow2['llenadoEspecial']!=NULL){
		 echo $myrow2['llenadoEspecial'];
		 } 		 
		 ?>" />
      </span></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
     </tr>
     
     
     
     <tr bgcolor="#CCCCCC">
       <td class="negro">Permite Venta de Botiquin a Px Externos</td>
      <td class="style12"><span class="Estilo24">
        <input name="ventaBotiquinExternos" type="checkbox" id="ventaBotiquinExternos" value="si" <?php 
		 if($myrow2['ventaBotiquinExternos']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
     </tr>
     
     
     
     
     
     
          
     <tr bgcolor="#CCCCCC">
       <td class="negro">Impresion de Ticket</td>
      <td class="style12"><span class="Estilo24">
        <input name="imprimeTicket" type="checkbox" id="ventaBotiquinExternos" value="si" <?php 
		 if($myrow2['imprimeTicket']=='si'){
		 echo 'checked=""';
		 } 		 
		 ?> />
      </span></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
     </tr>
     
     
     
     
     
     
     <tr bgcolor="#CCCCCC">
       
     </tr>
     <tr bgcolor="#CCCCCC">
              
       
     </tr>
     
     
     
     
  </table>
   <img src="../imagenes/bordestablas/borde2.png" alt="bo1" width="787" height="21" align="center" /> <br />
   <table width="611" align="center" cellpadding="4" cellspacing="0">
     <tr>
       <td width="148" align="center"><span class="Estilo24">
         <input name="actualizar" type="submit" src="../../imagenes/btns/modialma.png"  id="actualizar" value="Guardar Cambios" />
       </span></td>



       <td width="156" align="center">&nbsp;</td>



       <td width="148" align="center"><div align="center"><span class="style12"><span class="Estilo24">
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
