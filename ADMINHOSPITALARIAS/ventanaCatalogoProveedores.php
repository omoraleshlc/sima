<?php include('/configuracion/ventanasEmergentes.php');?>
<?php 

if(!$_POST['id_proveedor2']){

$_POST['id_proveedor2']=$_GET['id_proveedor2'];
}

if($_POST['actualizar'] AND $_POST['id_proveedor'] ){

$sSQL1= "Select * From proveedores WHERE id_proveedor = '".$_POST['id_proveedor']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['id_proveedor']){

$agrega = "INSERT INTO proveedores (
id_proveedor,razonSocial,tipoPersona,rfc,curp,calle,status,usuario,fecha,telefono,id_fiscal,codigoPostal,ctaContable,ciudad,
estado,copiaCedula,copiaActa,copiaHacienda,comprobanteDomicilio,retenciones,tipoProveedor,procedenciaProveedor,entidad,
limite1,limite2,limite3,limite4
) values ('".$_POST['id_proveedor']."','".$_POST['razonSocial']."',
'".$_POST['tipoPersona']."','".$_POST['rfc']."',
'".$_POST['curp']."',
'".$_POST['calle']."','".$_POST['status']."','".$usuario."','".$fecha1."','".$_POST['telefono']."',
'".$_POST['id_fiscal']."','".$_POST['codigoPostal']."','".$_POST['ctaContable']."','".$_POST['ciudad']."',
'".$_POST['estado']."','".$_POST['copiaCedula']."','".$_POST['copiaActa']."',
'".$_POST['copiaHacienda']."','".$_POST['comprobanteDomicilio']."','".$_POST['retenciones']."',
'".$_POST['tipoProveedor']."','".$_POST['procedenciaProveedor']."','".$entidad."',
    '".$_POST['limite1']."','".$_POST['limite2']."','".$_POST['limite3']."','".$_POST['limite4']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Proveedor Agregado...';

} else {
    
$q = "UPDATE proveedores set 
limite1='".$_POST['limite1']."',
limite2='".$_POST['limite2']."',
limite3='".$_POST['limite3']."',
limite4='".$_POST['limite4']."',    
razonSocial='".$_POST['razonSocial']."',
tipoPersona='".$_POST['tipoPersona']."',
usuario='".$usuario."',
fecha='".$fecha1."',
rfc='".$_POST['rfc']."',
curp='".$_POST['curp']."',
calle='".$_POST['calle']."',
status='".$_POST['status']."',

cp='".$_POST['codigoPostal']."',
ctaContable='".$_POST['ctaContable']."',
ciudad='".$_POST['ciudad']."',
estado='".$_POST['estado']."',
copiaCedula='".$_POST['copiaCedula']."',
copiaActa='".$_POST['copiaActa']."',
copiaHacienda='".$_POST['copiaHacienda']."',
comprobanteDomicilio='".$_POST['comprobanteDomicilio']."',
retenciones='".$_POST['retenciones']."',
tipoProveedor='".$_POST['tipoProveedor']."',
procedenciaProveedor='".$_POST['procedenciaProveedor']."'
WHERE
entidad='".$entidad."'
    and
id_proveedor='".$_POST['id_proveedor']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Proveedor Modificado...';


}
?>
<script>
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php
}





if($_POST['borrar'] AND $_POST['id_proveedor']){
$borrame = "DELETE FROM proveedores WHERE entidad='".$entidad."' and id_proveedor ='".$_POST['id_proveedor']."'";
mysql_db_query($basedatos,$borrame);


echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Proveedor Eliminado...';

}

if($_POST['agregar']){
/** checo si existe**/
$_POST['id_proveedor'] = "";
}


if($_POST['id_proveedor2']){
$sSQL2= "Select * From proveedores WHERE entidad='".$entidad."' and id_proveedor = '".$_POST['id_proveedor2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>


</head>

<body>
 <h1 align="center">Cat&aacute;logo de Proveedores </h1>
 <h2 align="center">

         <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
     

 </h2>
<form id="form1" name="form1" method="post" >

<div id="divContainer">
   <table width="644" class="formatHTML5">
     <tr>
       <td width="12"   >&nbsp;</td>
       <td width="130"    ><div align="left">ID_PROVEEDOR</div>
       </td>
       <td width="580"    >
         <div align="left" >
           <input name="id_proveedor" type="text"  id="id_proveedor" value="<?php echo $myrow2['id_proveedor']?>"
size="60" <?php if($myrow2['id_proveedor']){ echo 'readonly=""';}?>/>
       </div></td>
     </tr>
     <tr>
       <td width="12"   scope="col">&nbsp;</td>
       <td  >Raz&oacute;n Social </td>
       <td  ><textarea name="razonSocial" cols="80"  id="razonSocial"><?php echo $myrow2['razonSocial']?></textarea></td>
     </tr>
     <tr>
       <td width="12"    scope="col">&nbsp;</td>
       <td   >F&iacute;sica/Moral </td>
       <td   ><select name="tipoPersona"  id="tipoPersona">
         <?php 
		 if($myrow2['tipoPersona']){ ?>
         <option value="<?php echo $myrow2['tipoPersona'];?>"><?php echo $myrow2['tipoPersona'];?></option>
         <option value="">----</option>
         <?php }
		 ?>
		        <option value="F">F</option>
         <option value="M">M</option>
  
       </select></td>
     </tr>
     <tr>
       <td   scope="col">&nbsp;</td>
       <td  >Tipo de Proveedor</td>
       <td  ><span >
         <select name="tipoProveedor"  id="tipoProveedor">
           <?php 
		 if($myrow2['tipoProveedor']){ ?>
           <option value="<?php echo $myrow2['tipoProveedor'];?>"><?php echo $myrow2['tipoProveedor'];?></option>
           <option value="">----</option>
           <?php }
		 ?>
           
           <option value="productos">productos</option>
		              <option value="servicios">servicios</option>
					  <option value="ambos">ambos</option>
         </select>
       </span></td>
     </tr>
     <tr>
       <td    scope="col">&nbsp;</td>
       <td   >Procedencia</td>
       <td   ><span >
         <select name="procedenciaProveedor"  id="procedenciaProveedor">
           <?php 
		 if($myrow2['procedenciaProveedor']){ ?>
           <option value="<?php echo $myrow2['procedenciaProveedor'];?>"><?php echo $myrow2['procedenciaProveedor'];?></option>
           <option value="">----</option>
           <?php }
		 ?>
           <option value="nacional">nacional</option>
           <option value="extranjero">extranjero</option>
         </select>
       </span></td>
     </tr>
     <tr>
       <td width="12"   scope="col">&nbsp;</td>
       <td  >Activo</td>
       <td  ><select name="status"  id="status">
         <?php 
		 if($myrow2['status']){ ?>
         <option value="<?php echo $myrow2['status'];?>"><?php echo $myrow2['status'];?></option>
         <option value="">----</option>
         <?php }
		 ?>
         <option value="A">A</option>
         <option value="I">I</option>
       </select></td>
     </tr>
     <tr>
       <td width="12"    scope="col">&nbsp;</td>
       <td   >RFC</td>
       <td   ><span >
         <input name="rfc" type="text"  id="rfc"
	   value ="<?php echo $myrow2['rfc']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <td width="12"   scope="col">&nbsp;</td>
       <td  >CURP</td>
       <td  ><span >
         <input name="curp" type="text"  id="curp"
	   value ="<?php echo $myrow2['curp']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <td   scope="col">&nbsp;</td>
       <td   >&nbsp;</td>
       <td   >&nbsp;</td>
     </tr>
     <tr>
       <td   scope="col">&nbsp;</td>
       <td  >RFC Copia de C&eacute;dula </td>
       <td  >
	   <input name="copiaCedula" type="checkbox" id="copiaCedula" 
	   <?php if($myrow2['copiaCedula']){echo 'checked="checked"';}?>/> 
	   Archivo Expediente </td>
     </tr>
     <tr>
       <td   scope="col">&nbsp;</td>
       <td   >Copia de Acta Constitutiva </td>
       <td   ><input name="copiaActa" type="checkbox" id="copiaActa" <?php if($myrow2['copiaActa']){echo 'checked="checked"';}?>/> <span class="Estilo24">Archivo Expediente</span></td>
     </tr>
     <tr>
       <td   scope="col">&nbsp; </td>
       <td  >Copia de alta de Hacienda </td>
       <td  ><input name="copiaHacienda" type="checkbox" id="copiaHacienda"
	   <?php if($myrow2['copiaHacienda']){echo 'checked="checked"';}?>
	    /> <span >Archivo Expediente</span></td>
     </tr>
     <tr>
       <td    scope="col">&nbsp;</td>
       <td   >Comprobante de Domicilio </td>
       <td   ><label>
         <input name="comprobanteDomicilio" type="checkbox" id="comprobanteDomicilio" 
		 <?php if($myrow2['comprobanteDomicilio']){echo 'checked="checked"';}?>
		  />
       <span >Archivo Expediente</span></label></td>
     </tr>
     <tr>
       <td   scope="col">&nbsp;</td>
       <td  >Retenciones</td>
       <td  ><input name="retenciones" type="checkbox" id="retenciones"
	   <?php if($myrow2['retenciones']){echo 'checked="checked"';}?>
	    />
       <span >Aplica </span></td>
     </tr>
     <tr>
       <td width="12"    scope="col">&nbsp;</td>
       <td  >Ciudad</td>
       <td  ><span >
         <input name="ciudad" type="text"  id="ciudad"
	   value ="<?php echo $myrow2['ciudad']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <td width="12"   scope="col">&nbsp;</td>
       <td  >Calle</td>
       <td  ><span >
         <textarea name="calle" cols="80"  id="calle"><?php echo $myrow2['calle']?></textarea>
       </span></td>
     </tr>
     <tr>
       <td width="12"    scope="col">&nbsp;</td>
       <td   >Estado</td>
       <td   ><span >
         <input name="estado" type="text"  id="estado"
	   value ="<?php echo $myrow2['estado']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <td width="12"   scope="col">&nbsp;</td>
       <td  >CodigoPostal</td>
       <td  ><span >
         <input name="codigoPostal" type="text"  id="codigoPostal"
	   value ="<?php echo $myrow2['codigoPostal']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <td width="12"    scope="col">&nbsp;</td>
       <td   >Tel&eacute;fono</td>
       <td  ><span >
         <input name="telefono" type="text"  id="telefono"
	   value ="<?php echo $myrow2['telefono']?>" size="60"/>
       </span></td>
     </tr>

       
       <tr>
       <td width="12"    scope="col">&nbsp;</td>
       <td width="12"    scope="col">&nbsp;</td>
       <td width="12"    scope="col">&nbsp;</td>
       </tr>
       
     <tr>
         
   <td width="12"    scope="col">&nbsp;</td>
         <td   >Vencimiento</td>
         <td width="12"   ><input type="text" size="2" name="limite1" value="<?php echo $myrow2['limite1'];?>"></input>Dias</td>
         
     </tr>       
       
       
   
       
       
       
   </table>
</div>   
    
    
    
    
    
    
    
    
    
    
    
    
    
    <br />
	   <input name="id_proveedor2" type="hidden" value="<?php echo $_GET['id_proveedor2'];?>">
       <input name="actualizar" type="submit"  id="actualizar" value="Alta/Modificar Proveedor" />
         
<input name="borrar" type="submit"  id="borrar" value="Eliminar Proveedor"/>
<label>
<input name="Nuevo" type="submit"  id="Nuevo" value="Nuevo" />
</label>
<p>&nbsp;</p>
 </form>
</body>
</html>
