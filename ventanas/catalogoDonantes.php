<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php

if(!$_POST['numCliente2']){
$_POST['numCliente2']=$_GET['numCliente'];
}

//************contra Recibo****
if($_POST['contraRecibo']=='si'){
$contraRecibo='si';
} else {
$contraRecibo='no';
}
//************************************
//************TOMA PRECIO NIVEL 1****
if($_POST['baseParticular']=='si'){
$baseParticular='si';
} else {
$baseParticular='no';
}
//************************************

//************TOMA PRECIO NIVEL 1****
if($_POST['clientePrincipal']){
$subCliente='si';
} 
//************************************



if($_POST['actualizar'] AND $_POST['numCliente']){
$sSQL1= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);





















if($_POST['numCliente']!=$myrow1['numCliente']){


$agrega = "INSERT INTO clientes (
numCliente,nomCliente,usuario,fecha,nivel,ID_AUXILIAR,ID_CTAMAYOR,
ciudad,estado,cp,telCasa,telTrabajo,responsable,nombreCorto,
rfc,pais,calle,colonia,delegacion,banderaCXCT,tipoCliente,entidad,baseParticular,plazoPago,contraRecibo,
subCliente,clientePrincipal,tipo,pagoEfectivo,credenciales,razonSocial,convenioExclusivo,gpoProducto,requiereExpediente,requiereMatricula,
saldoInicial,facturacionPreconfigurada,permiteReferidos

) values ('".$_POST['numCliente']."','".strtoupper($_POST['nomCliente'])."',
'".$usuario."','".$fecha1."','".$_POST['nivel']."','".$_POST['ID_AUXILIAR']."','".$_POST['ID_CTAMAYOR']."',
'".$_POST['ciudad']."',
'".$_POST['estado']."',
'".$_POST['cp']."',
'".$_POST['telCasa']."',
'".$_POST['telTrabajo']."',
'".$_POST['responsable']."',
'".$_POST['nombreCorto']."',
'".$_POST['rfc']."',
'".$_POST['pais']."',
'".$_POST['calle']."',
'".$_POST['colonia']."',
'".$_POST['delegacion']."',
'".$_POST['banderaCXCT']."','".$_POST['tipoCliente']."','".$entidad."','".$baseParticular."','".$_POST['plazoPago']."','".$contraRecibo."','".$subCliente."','".$_POST['clientePrincipal']."','".$_POST['tipo']."','".$_POST['pagoEfectivo']."','".$_POST['credenciales']."','".$_POST['razonSocial']."',
'".$_POST['convenioExclusivo']."',
    '".$_POST['gpoProducto']."','".$_POST['requiereExpediente']."','".$_POST['requiereMatricula']."','".$_POST['saldoInicial']."'  ,'".$_POST['facturacionPreconfigurada']."',
        '".$_POST['permiteReferidos']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Se ingreso el cliente';
echo '<script >
window.alert( "SE DIO DE ALTA AL CLIENTE");
</script>';
echo '<script language="JavaScript" type="text/javascript">';
echo 'window.opener.document.forms["form2"].submit();';
echo 'close();';
echo '</script>';
} else { 
$q = "UPDATE clientes set
    
permiteReferidos='".$_POST['permiteReferidos']."',
    facturacionPreconfigurada='".$_POST['facturacionPreconfigurada']."',
    saldoInicial='".$_POST['saldoInicial']."',
gpoProducto='".$_POST['gpoProducto']."',
credenciales='".$_POST['credenciales']."',
pagoEfectivo='".$_POST['pagoEfectivo']."',
nomCliente='".strtoupper($_POST['nomCliente'])."',
nivel='".$_POST['nivel']."',
ciudad='".strtoupper($_POST['ciudad'])."',
estado='".strtoupper($_POST['estado'])."',
cp='".$_POST['cp']."',
telCasa='".$_POST['telCasa']."',
telTrabajo='".$_POST['telTrabajo']."',
responsable='".strtoupper($_POST['responsable'])."',
nombreCorto='".$_POST['nombreCorto']."',
rfc='".strtoupper($_POST['rfc'])."',
pais='".strtoupper($_POST['pais'])."',
calle='".strtoupper($_POST['calle'])."',
colonia='".strtoupper($_POST['colonia'])."',
delegacion='".strtoupper($_POST['delegacion'])."',
ID_AUXILIAR='".$_POST['ID_AUXILIAR']."',
ID_CTAMAYOR='".$_POST['ID_CTAMAYOR']."',
usuario='".$usuario."',
fecha='".$fecha1."',
banderaCXCT='".$_POST['banderaCXCT']."',
tipoCliente='".$_POST['tipoCliente']."',
baseParticular='".$baseParticular."',
plazoPago='".$_POST['plazoPago']."',
contraRecibo='".$_POST['contraRecibo']."',
subCliente='".$subCliente."',
clientePrincipal='".$_POST['clientePrincipal']."',
tipo='".$_POST['tipo']."',
razonSocial='".$_POST['razonSocial']."',
convenioExclusivo='".$_POST['convenioExclusivo']."',
requiereExpediente='".$_POST['requiereExpediente']."',
requiereMatricula='".$_POST['requiereMatricula']."'

WHERE entidad='".$entidad."' AND
numCliente='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Se actualizo el cliente';
echo '<script >
window.alert( "SE ACTUALIZO AL CLIENTE");
</script>';
echo '<script language="JavaScript" type="text/javascript">';
echo 'window.opener.document.forms["form2"].submit();';
echo '</script>';
}
/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=clientes.php">';
exit; */
}

if($_POST['borrar'] AND $_POST['numCliente']){
$borrame = "DELETE FROM clientes WHERE entidad='".$entidad."' AND numCliente ='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

echo '<script type="text/vbscript">
msgbox "CLIENTE ELIMINADO"
</script>';
echo '<script>';
echo 'close();';
echo '</script>';
echo '<script language="JavaScript" type="text/javascript">';
echo 'opener.location.reload(true);';
echo 'self.close();';
echo '</script>';

}

if($_POST['nuevo']){
$_POST['numCliente2']='000000000';
$_POST['numCliente1']='000000000';

}


if($_POST['numCliente2'] ){
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
} else if($_GET['keyClientes']){
$sSQL2= "Select * From clientes WHERE keyClientes='".$_GET['keyClientes']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>
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
           
        if( vacio(F.numCliente.value) == false ) {   
                alert("Por Favor, escoje el numero del Cliente!")   
                return false   
        } else if( vacio(F.nomCliente.value) == false ) {   
                alert("Por Favor, escribe el nombre del cliente!")   
                return false   
        }           
}   
  
  
  
  
</script> 
<script>
function validar(obj){
	var d = document.formulario;
	
	if(obj.checked==true){


		d.subClientes.disabled = false;
	}else{


		d.subClientes.disabled= true;
	}
}
</script>

<script type="text/javascript">
<!--
onload = function () {
var e, i = 0;
while (e = document.forms[0].elements[['fie', 'foe', 'fum'][i++]]) {
e.disabled = true;
}
}
// -->
</script>

<script language=javascript> 
function ventanaSecundaria14 (URL){ 
   window.open(URL,"ventana14","width=430,height=700,scrollbars=YES") 
} 
</script>
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
<form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);">
  <p align="center">&nbsp;  </p>
  <h1 align="center" >
    <label>EDITAR DONANTES</label>
  </h1>
  <p>
    <label></label>
  </p>

  <table width="771" class="table-forma">
    <tr >
      <th colspan="3"   scope="col"><p align="center"> DATOS PRINCIPALES</p></th>
    </tr>
    

	

	
    
    	
		
		
		
		
		
		
		
		
		
		
		
		

    <tr >
      <td width="1"   scope="col">&nbsp;</td>
      <td  >Nombre del Donante</td>
      <td  ><input name="nomCliente" type="text"  id="nomCliente" value ="<?php echo $myrow2['nomCliente']; ?>" size="100"/></td>
    </tr>
	
	
	

      
	
	
	
	
	<?php 
	if(!$_POST['clientePrincipal'] AND !$myrow2['clientePrincipal']){ ?>
    <tr>
      <th colspan="3"   scope="col"><div align="center" >INFORMACION ADICIONAL, CLIENTES PRINCIPALES</div></th>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Requiere Matricula </td>
      <td  ><input name="requiereMatricula" type="checkbox" id="requiereMatricula" value="si" <?php if($myrow2['requiereMatricula']=='si'){ echo 'checked=""';}?>/></td>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Requieren Contrarecibo?</td>
      <td  ><input name="contraRecibo" type="checkbox" id="contraRecibo" value="si" <?php if($myrow2['contraRecibo']=='si'){ echo 'checked=""';}?>/></td>
    </tr>
    
        <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Permite Ventas Referidas?</td>
      <td  ><input name="permiteReferidos" type="checkbox" id="contraRecibo" value="si" <?php if($myrow2['permiteReferidos']=='si'){ echo 'checked=""';}?>/></td>
    </tr>
    
    
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Requiere Expediente </td>
      <td  ><span >
        <input name="requiereExpediente" type="checkbox" id="requiereExpediente" value="si" <?php if($myrow2['requiereExpediente']=='si'){ echo 'checked=""';}?>/>
      </span> (Debe crearse el numero de Expediente si no existe) </td>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Plazo de pago (Facturas) </td>
      <td  ><span >
        <input name="plazoPago" type="text"  id="plazoPago" value ="<?php echo $myrow2['plazoPago']; ?>" size="6"/>
[N&uacute;mero de D&iacute;as] </span></td>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Tel&eacute;fono Casa: </td>
      <td  ><span >
        <input name="telCasa" type="text"  id="telCasa" value ="<?php echo $myrow2['telCasa']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Tel&eacute;fono Trabajo: </td>
      <td  ><span >
        <input name="telTrabajo" type="text"  id="telTrabajo" value ="<?php echo $myrow2['telTrabajo']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Responsable:</td>
      <td  ><span >
        <input name="responsable" type="text"  id="responsable" value ="<?php echo $myrow2['responsable']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >RFC:</td>
      <td  ><span >
        <input name="rfc" type="text"  id="rfc" value ="<?php echo $myrow2['rfc']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr   >
      <td   scope="col">&nbsp;</td>
      <td   scope="col"><div align="left" >Raz&oacute;n Social</div></td>
      <td   scope="col"><div align="left" >
<textarea name="razonSocial" cols="40" wrap="virtual" id="razonSocial" autocomplete="off"  ><?php if($myrow2['razonSocial']){echo $myrow2['razonSocial'];} else if(!$myrow455['razonSocial']){echo $_POST['razonSocial'];	} ?></textarea>
      </span></div></td>
    </tr>
    <tr   >
      <td   scope="col">&nbsp;</td>
      <td   scope="col"><div align="left">Calle</div></td>
      <td   scope="col"><div align="left"><span >
          <input name="calle" type="text"  id="calle" value="<?php 
		if($myrow2['calle']){
echo $myrow2['calle'];
} else if(!$myrow2['calle'] ) {
		echo $_POST['calle'];
		}
		  ?>" size="40" autocomplete="off" <?php if($myrow2['calle']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr   >
      <td   scope="col">&nbsp;</td>
      <td   scope="col"><div align="left" >Colonia</div></td>
      <td   scope="col"><div align="left"><span >
          <input name="colonia" type="text"  id="colonia" value="<?php 
		if($myrow2['colonia']){
echo $myrow2['colonia'];
} else if(!$myrow2['colonia'] ) {
		echo $_POST['colonia'];
		}
		  ?>" size="40" autocomplete="off" <?php if($_POST['colonia']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr   >
      <td   scope="col">&nbsp;</td>
      <td   scope="col"><div align="left" >Ciudad</div></td>
      <td   scope="col"><div align="left"><span >
          <input name="ciudad" type="text"  id="ciudad" value="<?php 
		if($myrow2['ciudad']){
echo $myrow2['ciudad'];
} else if(!$myrow2['ciudad'] ) {
		echo $_POST['ciudad'];
		}
		  ?>" size="40" autocomplete="off" <?php if($_POST['ciudad']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr   >
      <td   scope="col">&nbsp;</td>
      <td   scope="col"><div align="left" >Estado</div></td>
      <td   scope="col"><div align="left"><span >
          <input name="estado" type="text"  id="rfc6" value="<?php 
		if($myrow2['estado']){
echo $myrow2['estado'];
} else if(!$myrow2['estado'] ) {
		echo $_POST['estado'];
		}
		  ?>" size="40" autocomplete="off" <?php if($_POST['estado']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr   >
      <td   scope="col">&nbsp;</td>
      <td   scope="col"><div align="left" >CP</div></td>
      <td   scope="col"><div align="left"><span >
          <input name="cp" type="text" id="cp" value="<?php 
		if($myrow2['cp']){
echo $myrow2['cp'];
} else if(!$myrow2['cp'] ) {
		echo $_POST['cp'];
		}
		  ?>" size="40" autocomplete="off" <?php if($_POST['cp']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Pa&iacute;s:</td>
      <td  ><span >
        <input name="pais" type="text"  id="pais" value="<?php echo trim($myrow2['pais']); ?>" />
      </span></td>
    </tr>
    <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Delegaci&oacute;n:</td>
      <td  ><span >
        <input name="delegacion" type="text"  id="delegacion" value ="<?php echo $myrow2['delegacion']; ?>" size="60"/>
      </span></td>
    </tr>

          <tr >
      <td   scope="col">&nbsp;</td>
      <td  >Saldo Inicial</td>
      <td  ><span >
        <input name="saldoInicial" type="text"  id="delegacion" value ="<?php echo $myrow2['saldoInicial']; ?>" size="60"/>
      </span></td>
    </tr>
<?php } ?>
  </table>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <br />
  <table width="64%" >
    <tr align="center">
      <td width="34%"><div align="center">
        <input name="nuevo" type="submit" src="/sima/imagenes/btns/newbutton.png"  id="nuevo" value="Nuevo" />
      </div></td>
      <td width="32%"><div align="center">
        <input name="borrar" type="submit"  src="/sima/imagenes/btns/deletebutton.png" id="borrar" value="Eliminar Cliente" />
      </div></td>
      <td width="34%"><div align="center">
        <input name="actualizar" type="submit" src="/sima/imagenes/btns/modifybutton.png" id="actualizar" value="Modificar/Grabar Cliente" />
      </div></td>
    </tr>
  </table>
  <div align="center"></div>
  <p>&nbsp;</p>
  <p>
    <input name="numCliente1" type="hidden" id="numCliente1" value="<?php echo $myrow2['numCliente']; ?>" />
  </p>
</form>
</body>
</html>


