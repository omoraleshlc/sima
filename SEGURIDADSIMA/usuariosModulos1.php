<? //include("/configuracion/conf.php"); ?>
<? 
//*********************************ABRIR INGRESO EN ARRAY***************************************
$mod[0]='catalogoAlmacen.inv';
$mod[1]='modificaA.inv';
$mod[2]='articulos-anaquel.inv';
$mod[3]='anaquel.inv';
$mod[4]='um.inv';
$mod[5]='articulos-almacen.inv';
$mod[6]='existencias.inv';
$mod[7]='gpoProductos.inv';
$mod[8]='precios.inv';
$mod[9]='altaConvenios.conv';
$mod[10]='altaConvenios1.conv';
$mod[11]='listaConvenios.conv';
$mod[12]='listaOrdenes.caja';
$mod[13]='CrgCnPac.caja';   //////    Falta Cargos Cuenta Paciente
$mod[14]='AplicPag.caja';   //////    Falta Aplicar Pago
$mod[15]='CuentXCob.cont';   //////    Falta Cuent por Cobrar
$mod[16]='movtosCaja.cont';
$mod[17]='catTasa.cont';
$mod[18]='clientes.cont';
$mod[19]='listaOrdenes.ccp';
$mod[20]='ambulatorioParticular.ccp';
$mod[21]='menu.ccp';          /////// Menu pagina de ISSTELEON
$mod[22]='cargosCuentaPaciente1.ccp';
$mod[23]='listaPacientes.adm';
$mod[24]='caja.adm';
$mod[25]='modificaPacientes.adm';
$mod[26]='AplicaDescuento.adm';    //////    Falta Aplicar Descuento en Admiciones
$mod[27]='CerrarCuenta.adm';    //////    Falta Cerrar Cuenta en Admiciones
$mod[28]='asignaCuarto.adm';
$mod[29]='salas.adm';
$mod[30]='habitaciones.adm';
$mod[31]='camas.adm';
$mod[32]='salas-cuartos.adm';
$mod[33]='cuartos-camas.adm';
$mod[34]='actualizaSeguros.adm';


//*********************************CERRAR INGRESO EN ARRAY**************************************
/* if($_POST['nuevo']){
$_POST['usuario1']="";
$leyenda = "Ingrese los datos correctamente";
}
//actualizar ******************************************************************************************************
if($_POST['actualizar'] AND $_POST['usuario1'] ){ 
//********abro lista
//********cierro lista
//if($myrow1['usuario'] !=$_POST['usuario']){ //checo que no haya un usuario igual
//******************** INSERTAR Y ACTUALIZAR ************************************
if($agregar = $_POST["codModulo"]){ //paso arreglo de agregar modulos a agregar

foreach($agregar as $i => $agregar_articulo){
$sSQL3= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."'
AND modulo = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['usuario']!= $_POST['usuario1'] AND $agregar[$i] != $myrow3['modulo']){
$agrega = "INSERT INTO usuariosModulos (
usuario,modulo
) values (
'".$_POST['usuario1']."',
'".$agregar[$i]."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se ingresó el usuario: ".$_POST['usuario1'];
}}}
//*****************cierro INSERTAR Y ACTUALIZAR **********************************
/* } else {
ya_existe();
$leyenda = "EL  USUARIO QUE ESCOGISTE YA ESTA EN EXISTENCIA..!!!";
}  //cierro verificacion de existencia de usuario
} else if($_POST['actualizar']){
$leyenda = "Te Faltan Campos por Rellenar..!!!";
} */
//****************************************************************************************************************************

/* if($_POST['borrar'] AND $_POST['usuario1']){

if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM usuariosModulos WHERE usuario ='".$_POST['usuario1']."' 
AND modulo LIKE '%$quitar[$is]%' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda = "Se eliminó el modulo ".$quitar[$i];
}}} else if($_POST['borrar'] AND !$_POST['usuario1']){
$leyenda = "Por favor, escoja el nombre de usuario que desee eliminar..!";
} */
/* $nCliente1= $_POST['nCliente'];
if(!$_POST['actualizar']){
$s = "select max(nCLiente) as maximo from usuarios";
$r1=mysql_db_query($basedatos,$s);
$m = mysql_fetch_array($r1);
$nCliente = $m['maximo'];
$nCliente+=1;
}
if($_POST['actualizar']){
$nCliente = $_POST['tope']+1;
$password = $_POST['pwd1'];
if($_POST['actualizar'] AND $nCliente AND $_POST['nombre']
AND $_POST['usuario'] AND $password
AND $_POST['aPaterno'] AND $_POST['aMaterno']
){

echo $sSQL5= "Select all distinct * From usuarios-modulos WHERE usuario = '".$_POST['usuario']."'";
$result5=mysql_db_query($basedatos,$sSQL5);
$myrow5 = mysql_fetch_array($result5);

if($agregar = $_POST["codModulo"]){
foreach($agregar as $i => $agregar_articulo){
if($myrow5['usuario']== $_POST['usuario']){
$q = "UPDATE usuarios-modulos set 
modulo='".$agregar[$i]."'
WHERE 
usuario='".$_POST['usuario']."' AND modulo='".$agregar[$i]."'
";
mysql_db_query($basedatos,$q);
$leyenda = "Se actualizó el usuario: ".$_POST['usuario'];
echo mysql_error();
} else {
$agrega = "INSERT INTO usuarios-modulos (
usuario,modulo
) values (
$nCliente,
'".$_POST['usuario']."'
'".$agregar[$i]."'
)";
mysql_db_query($basedatos,$agrega);
$leyenda = "Se insertó el usuario: ".$_POST['usuario'];
echo mysql_error();
//$nCliente-=1;
//echo '<META HTTP-EQUIV="Refresh"
//      CONTENT="0; URL=listaUsuarios.php">';

}}
}}
} else if($_POST['pwd1'] !=$_POST['pwd2'] ){
no_coinciden();
}
if($_POST['borrar'] AND $_POST['nCliente']){
$borrame = "DELETE FROM usuarios WHERE nCliente ='".$_POST['nCliente']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda = "Se eliminó el usuario: ".$_POST['usuario'];
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
}
if($_POST['borrar'] || $_POST['actualizar']){
$sSQL1= "Select all distinct * From usuarios WHERE nCliente = '".$nCliente."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
-->
</style>
</head>
<body>
<p align="center">
  <label></label> 
Permisos Usuario &lt;--&gt; Modulos</p>
<form id="form" name="form" method="post" action="" />
  <label>
  <div align="center">
    <input name="textfield" type="text" class="style12" size="60" value="<? echo $leyenda; ?>"/>
  </div>
  </label>
  <table width="323" border="1" align="center" class="style12">
    <tr>
      <th colspan="2" bgcolor="#000066" scope="col"><strong><span class="style13">Usuario y Password </span></strong></th>
    </tr>
    <tr>
      <th scope="col">Usuario: </th>
      <th width="152" scope="col"><label>
        <? //*********TRAE USUARIOS
	   $sSQL7= "Select all distinct * From usuarios ORDER BY usuario ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="usuario1" class="style12" id="usuario1" onChange="javascript:this.form.submit();">
          <? if($_POST['usuario1']){ ?>
          <option value="<? echo $_POST['usuario1']; ?>"><? echo  $_POST['usuario1']; ?></option>
          <? } else {?>
          <option></option>
          <? } ?>
		   <option></option>
          <? 		 
		   while($myrow7 = mysql_fetch_array($result7)){ 
		echo '<option>'.$myrow7['usuario']; 
		} 
		?>
        </select>
&nbsp;</label></th>
    </tr>
  </table>
  <p>
  </p>
  <table width="643" border="2" align="center" class="style12">
    <tr>
      <th colspan="8" bgcolor="#000066" scope="col"><span class="style11">Inventarios</span><span class="style11"></span></th>
    </tr>
    <tr>
      <td width="113" bgcolor="#FFFFFF" class="style12">Almacenes</td>
      <td width="24" bgcolor="#FFFFFF" class="style12"><label>
<?	  
$s0= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$_POST['almacenes']."'";
$rs0=mysql_db_query($basedatos,$s0);
$mr0 = mysql_fetch_array($rs0); 
if(!$mr0['modulo'] AND $_POST['almacenes'] AND $_POST['actualizar']){
$a0 = "INSERT INTO usuariosModulos (
usuario,modulo
) values (
'".$_POST['usuario1']."',
'".$_POST['almacenes']."'
)";
mysql_db_query($basedatos,$a0);
echo mysql_error();
} else if(!$_POST['almacenes'] AND $_POST['actualizar']){
$b0 = "DELETE FROM usuariosModulos WHERE usuario ='".$_POST['usuario1']."' AND
modulo = '".$mod[0]."'";
mysql_db_query($basedatos,$b0);
echo mysql_error();
}
$s01= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[0]."'";
$rs01=mysql_db_query($basedatos,$s01);
$mr01 = mysql_fetch_array($rs01); 
?>
      <input name="almacenes" type="checkbox" id="almacenes" value="<? echo $mod[0];?>" 
	  <? if($mr01['modulo']){ 
	   echo ' '."checked";
	  }
	  ?>
	  />
      </label></td>
      <td width="69" bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td width="141" bgcolor="#FFFFFF" class="style12">Anaqueles</td>
      <td width="20" bgcolor="#FFFFFF" class="style12">
<?	  
$s3= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$_POST['Anaqueles']."'";
$rs3=mysql_db_query($basedatos,$s3);
$mr3 = mysql_fetch_array($rs3); 
if(!$mr3['modulo'] AND $_POST['Anaqueles'] AND $_POST['actualizar']){
$a3 = "INSERT INTO usuariosModulos (
usuario,modulo
) values (
'".$_POST['usuario1']."',
'".$_POST['Anaqueles']."'
)";
mysql_db_query($basedatos,$a3);
echo mysql_error();
} else if(!$_POST['Anaqueles'] AND $_POST['actualizar']){
 $b3 = "DELETE FROM usuariosModulos WHERE usuario ='".$_POST['usuario1']."' AND
modulo = '".$mod[3]."'";
mysql_db_query($basedatos,$b3);
echo mysql_error();
}
$s03= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[03]."'";
$rs03=mysql_db_query($basedatos,$s03);
$mr03 = mysql_fetch_array($rs03); 

?>

	  <input name="Anaqueles" type="checkbox" id="Anaqueles" value="<? echo $mod[03];?>" 
	  <? if($mr03['modulo']){ 
	   echo ' '."checked";
	  }
	  ?> /></td>
      <td width="71" bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td width="131" bgcolor="#FFFFFF" class="style12">Ajuste a Existencias </td>
      <td width="20" bgcolor="#FFFFFF" class="style12">

<?	  
$s6= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[6]."'";
$rs6=mysql_db_query($basedatos,$s6);
$mr6 = mysql_fetch_array($rs6); 
?>

<input name="Existencias" type="checkbox" id="Existencias" value="
	  <? echo $mod[6]; ?>" 
	  <? if($mr6['modulo']=="$mod[6]"){ 
	  echo "checked";
	  }
	  ?> /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style12">Inventarios/Altas</td>
      <td bgcolor="#FFFFFF" class="style12">
<?	  
$s1= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[1]."'";
$rs1=mysql_db_query($basedatos,$s1);
$mr1 = mysql_fetch_array($rs1); 
?>
<input name="inventariosAltas" type="checkbox" id="inventariosAltas" value="
	  <? echo $mod[1]; ?>" 
	  <? if($mr1['modulo']=="$mod[1]"){ 
	  echo "checked";
	  }
	  ?>></td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">Unidad Medida </td>
      <td bgcolor="#FFFFFF" class="style12">
<?	  
$s4= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[4]."'";
$rs4=mysql_db_query($basedatos,$s4);
$mr4 = mysql_fetch_array($rs4); 
?>

<input name="UnidadMed" type="checkbox" id="UnidadMed" value="
	  <? echo $mod[4]; ?>" 
	  <? if($mr4['modulo']=="$mod[4]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">Grupo Productos </td>
      <td bgcolor="#FFFFFF" class="style12">
<?	  
$s7= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[7]."'";
$rs7=mysql_db_query($basedatos,$s7);
$mr7 = mysql_fetch_array($rs7); 
?>
<input name="GProductos" type="checkbox" id="GProductos" value="
	  <? echo $mod[7]; ?>" 
	  <? if($mr7['modulo']=="$mod[7]"){ 
	  echo "checked";
	  }
	  ?> /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style12">Art&iacute;culos&lt;-&gt;Anaquel </td>
      <td bgcolor="#FFFFFF" class="style12"><?	  
$s2= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[2]."'";
$rs2=mysql_db_query($basedatos,$s2);
$mr2 = mysql_fetch_array($rs2); 
?>
      <input name="ArticulosAnaq" type="checkbox" id="ArticulosAnaq" value="
	  <? echo $mod[2]; ?>" 
	  <? if($myrow1['modulo']=="$mod[2]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">Art&iacute;culos&lt;-&gt; Almac&eacute;n </td>
      <td bgcolor="#FFFFFF" class="style12">
<?	  
$s5= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[5]."'";
$rs5=mysql_db_query($basedatos,$s5);
$mr5 = mysql_fetch_array($rs5); 
?>
<input name="ArticulosAlma" type="checkbox" id="ArticulosAlma" value="
	  <? echo $mod[5]; ?>" 
	  <? if($myrow1['modulo']=="$mod[5]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">Lista de Precios </td>
      <td bgcolor="#FFFFFF" class="style12">
<?	  
$s8= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[8]."'";
$rs8=mysql_db_query($basedatos,$s8);
$mr8 = mysql_fetch_array($rs8); 
?>
<input name="LPrecios" type="checkbox" id="LPrecios" value="
	  <? echo $mod[8]; ?>" 
	  <? if($mr8['modulo']=="$mod[8]"){ 
	  echo "checked";
	  }
	  ?> /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" bgcolor="#000066" class="style12"><div align="center" class="style13">Convenios</div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style12">Alta convenios (Materiales) </td>
      <td bgcolor="#FFFFFF" class="style12">
<?	  
$s9= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[9]."'";
$rs9=mysql_db_query($basedatos,$s9);
$mr9 = mysql_fetch_array($rs9); 
?>
<input name="AltConveniosMater" type="checkbox" id="AltConveniosMater" value="
	  <? echo $mod[9]; ?>" 
	  <? if($mr9['modulo']=="$mod[9]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">Alta convenios(procedimientos)</td>
      <td bgcolor="#FFFFFF" class="style12">
<?	  
$s10= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."' AND
modulo = '".$mod[10]."'";
$rs10=mysql_db_query($basedatos,$s10);
$mr10 = mysql_fetch_array($rs10); 
?>
<input name="AltConveniosProce" type="checkbox" id="AltConveniosProce" value="
	  <? echo $mod[10]; ?>" 
	  <? if($myrow1['modulo']=="$mod[10]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">Lista convenios </td>
      <td bgcolor="#FFFFFF" class="style12"><input name="ListConvenios" type="checkbox" id="ListConvenios" value="
	  <? echo $mod[11]; ?>" 
	  <? if($myrow1['modulo']=="$mod[11]"){ 
	  echo "checked";
	  }
	  ?> /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" bgcolor="#000066" class="style12"><div align="center" class="style13">Caja</div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style12">Lista de ordenes </td>
      <td bgcolor="#FFFFFF" class="style12"><input name="LstOrdenesCaja" type="checkbox" id="LstOrdenesCaja" value="
	  <? echo $mod[12]; ?>" 
	  <? if($myrow1['modulo']=="$mod[12]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      <blockquote>&nbsp;	</blockquote>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">Cargos cuenta paciente </td>
      <td bgcolor="#FFFFFF" class="style12"><input name="CuentaPacienCaja" type="checkbox" id="CuentaPacienCaja" value="
	  <? echo $mod[13]; ?>" 
	  <? if($myrow1['modulo']=="$mod[13]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">Aplicar Pago </td>
      <td bgcolor="#FFFFFF" class="style12"><input name="AplicaPagoCaja" type="checkbox" id="AplicaPagoCaja" value="
	  <? echo $mod[14]; ?>" 
	  <? if($myrow1['modulo']=="$mod[14]"){ 
	  echo "checked";
	  }
	  ?> /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" bordercolor="#FFFFFF" bgcolor="#000066" class="style12"><div align="center" class="style13">contabilidad</div></td>
    </tr>
      <tr>
        <td height="24" bgcolor="#FFFFFF" class="style12">Cuenta por cobrar </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="CuentaXCobrar" type="checkbox" id="CuentaXCobrar" value="
	  <? echo $mod[15]; ?>" 
	  <? if($myrow1['modulo']=="$mod[15]"){ 
	  echo "checked";
	  }
	  ?> /></td>

        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Movimientos caja </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="MovimientCaja" type="checkbox" id="MovimientCaja" value="
	  <? echo $mod[16]; ?>" 
	  <? if($myrow1['modulo']=="$mod[16]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Catalogos tasa </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="CatalogoTasa" type="checkbox" id="CatalogoTasa" value="
	  <? echo $mod[17]; ?>" 
	  <? if($myrow1['modulo']=="$mod[17]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Catalogos clientes </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="CatalogoClient" type="checkbox" id="CatalogoClient" value="
	  <? echo $mod[18]; ?>" 
	  <? if($myrow1['modulo']=="$mod[18]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" bgcolor="#000066" class="style12"><div align="center"><span class="style13">Cargos cuenta paciente </span></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Listado de ordenes </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="LstOrdnCargPaci" type="checkbox" id="LstOrdnCargPaci" value="
	  <? echo $mod[19]; ?>" 
	  <? if($myrow1['modulo']=="$mod[19]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Ambulatorio</td>
        <td bgcolor="#FFFFFF" class="style12"><input name="AmbulatCargPaci" type="checkbox" id="AmbulatCargPaci" value="
	  <? echo $mod[20]; ?>" 
	  <? if($myrow1['modulo']=="$mod[20]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Issteleon</td>
        <td bgcolor="#FFFFFF" class="style12"><input name="IssteleonCargPaci" type="checkbox" id="IssteleonCargPaci" value="
	  <? echo $mod[21]; ?>" 
	  <? if($myrow1['modulo']=="$mod[21]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Cargo cta. Paciente interno </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="CargoPaciInterno" type="checkbox" id="CargoPaciInterno" value="
	  <? echo $mod[22]; ?>" 
	  <? if($myrow1['modulo']=="$mod[22]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" bgcolor="#000066" class="style12 style13"><div align="center">Admisiones</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Lista de pacientes </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="LstPaciAdminiciones" type="checkbox" id="LstPaciAdminiciones" value="
	  <? echo $mod[23]; ?>" 
	  <? if($myrow1['modulo']=="$mod[23]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">E. Cuenta paciente </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="EstaCuentPaciAdminiciones" type="checkbox" id="EstaCuentPaciAdminiciones" value="
	  <? echo $mod[24]; ?>" 
	  <? if($myrow1['modulo']=="$mod[24]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Alta de paciente </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="AltaPaciAdminiciones" type="checkbox" id="AltaPaciAdminiciones" value="
	  <? echo $mod[25]; ?>" 
	  <? if($myrow1['modulo']=="$mod[25]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Aplicar descuento </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="AplicDescAdminiciones" type="checkbox" id="AplicDescAdminiciones" value="
	  <? echo $mod[26]; ?>" 
	  <? if($myrow1['modulo']=="$mod[26]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Cerrar cuenta </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="CerrarCuentAdminiciones" type="checkbox" id="CerrarCuentAdminiciones" value="
	  <? echo $mod[27]; ?>" 
	  <? if($myrow1['modulo']=="$mod[27]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Asignar Habitaci&oacute;n </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="AsigHabAdminiciones" type="checkbox" id="AsigHabAdminiciones" value="
	  <? echo $mod[28]; ?>" 
	  <? if($myrow1['modulo']=="$mod[28]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Catalogo Salas </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="CatagSalAdminiciones" type="checkbox" id="CatagSalAdminiciones" value="
	  <? echo $mod[29]; ?>" 
	  <? if($myrow1['modulo']=="$mod[29]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Catalogo habitaci&oacute;n </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="CatagHabAdminiciones" type="checkbox" id="CatagHabAdminiciones" value="
	  <? echo $mod[30]; ?>" 
	  <? if($myrow1['modulo']=="$mod[30]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Catalogo cama </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="CatagCamAdminiciones" type="checkbox" id="CatagCamAdminiciones" value="
	  <? echo $mod[31]; ?>" 
	  <? if($myrow1['modulo']=="$mod[31]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Sala &lt;-&gt;cuartos </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="SalaCuarAdminiciones" type="checkbox" id="SalaCuarAdminiciones" value="
	  <? echo $mod[32]; ?>" 
	  <? if($myrow1['modulo']=="$mod[32]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Habitaci&oacute;n &lt;-&gt; camas </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="HabitCamAdminiciones" type="checkbox" id="HabitCamAdminiciones" value="
	  <? echo $mod[33]; ?>" 
	  <? if($myrow1['modulo']=="$mod[33]"){ 
	  echo "checked";
	  }
	  ?> /></td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Actualizar seguros </td>
        <td bgcolor="#FFFFFF" class="style12"><input name="ActuSegAdminiciones" type="checkbox" id="ActuSegAdminiciones" value="
	  <? echo $mod[34]; ?>" 
	  <? if($myrow1['modulo']=="$mod[34]"){ 
	  echo "checked";
	  }
	  ?> /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" bgcolor="#000066" class="style12"><div align="center"><span class="style13">M&eacute;dicos</span></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Lista de m&eacute;dicos </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Catalogo procedimientos </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">M&eacute;dicos&lt;-&gt; costo P </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">M&eacute;dicos &lt;-&gt; almacen </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">M&eacute;dicos &lt;-&gt; procedimientos </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Alta m&eacute;dicos </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" bgcolor="#000066" class="style12 style13"><div align="center">Control de citas </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Lista de citas </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>

        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Catalogo de citas </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Relaci&oacute;n m&eacute;dico &lt;-&gt; citas </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Alta citas </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" bgcolor="#000066" class="style12 style13"><div align="center">Usuario &lt;-&gt; Modulo </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Lista de usuarios </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Alta de usuarios </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Usuarios &lt;-&gt; Ip </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">Usuarios &lt;-&gt; almacen </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Usuario &lt;-&gt; modulo </td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">Modulos</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
      </tr>

	      <?   
$sSQL= "Select all distinct * From modulos order by modulo ASC";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result);
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
?>
</table>
  <p align="center">
  
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar M&oacute;dulos" />
    <label></label>
  </p>
  <p>
    <? //*********ANAQUELES
	   $sSQL8= "Select all distinct * From usuariosModulos WHERE usuario ='".$_POST['usuario1']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
echo mysql_error();


	  ?>
  </p>
  <hr />

  <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</body>
</html>