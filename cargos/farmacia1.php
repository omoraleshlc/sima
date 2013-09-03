<?php include("/configuracion/conf.php"); ?>


<script src="prototype.js" type="text/javascript"></script>
<!-- set focus to a field with the name "searchcontent" in my form -->
<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>




<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<?php
//echo "cbarra".$_POST['cBarra'];
//onchange="javascript:this.form.submit();"

$sqlNombre12="SELECT * From sesionesAlmacen
			WHERE 
			usuario = '".$usuario."'
			ORDER BY almacen ASC";
$resultaNombre12=mysql_db_query($basedatos,$sqlNombre12);
$rNombre12=mysql_fetch_array($resultaNombre12);
$traeteAlmacen='hfarvp';
  
$modulo = 'farmacia.ccp';
$checaModuloScript= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo = '".$modulo."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>

<?php require("conexion.php"); $articulo = $_POST['nomArticulo']; ?>
<?php 
$ali='HFAR';
$Alma='HFAR';
if($cita1){
		 $cita = $cita1;
		} 

if($credencial1){
		 $credencial = $credencial1;
		} 

$nombreDelPaciente1=$_POST['nombrePaciente'];
$numPaciente1= $_POST['numeroPaciente']; 
$segu1=$_POST['tipoSeguro'];
$extension1=$_POST['extension']; 
$medico1=$_POST['medico']; 
$nCuenta1=$_POST['nCuenta']; 
if($nombreDelPaciente1){
		 $nombreDelPaciente = $nombreDelPaciente1;
		} else if($_POST['nombreDelPaciente1']){
		 $nombreDelPaciente =$_POST['nombreDelPaciente1'];
		}else if($_POST['nombreDelPaciente2']){
		 $nombreDelPaciente =$_POST['nombreDelPaciente2'];
		} else if($_POST['nombreDelPaciente3']){
          $nombreDelPaciente=$_POST['nombreDelPaciente3'];
        } else if($_POST['nombreDelPaciente4']){
          $nombreDelPaciente=$_POST['nombreDelPaciente4'];
        }
		
		
     if($autoriza1){
		 $autoriza = $autoriza1;
		} 


if($almacenPrincipal){
		 $Alma = $almacenPrincipal;
		}
		
if($nCuenta1){
		$nCuenta = $nCuenta1;
		} else if($_POST['nCuenta1']){
		 $nCuenta =$_POST['$nCuenta1'];
		}else if($_POST['$nCuenta2']){
		 $nCuenta =$_POST['$nCuenta2'];
		} else if($_POST['$nCuenta3']){
         $nCuentan=$_POST['$nCuenta3'];
        }				
		
if($extension1){
		$extension = $extension1;
		} else if($_POST['extension2']){
		 $extension =$_POST['extension2'];
		}else if($_POST['extension3']){
		 $extension =$_POST['extension3'];
		} else if($_POST['extension4']){
          $extension=$_POST['extension4'];
        }		
		
if($segu1){
		$segu = $segu1;
		} else if($_POST['segu1']){
		$segu = $_POST['segu1'];
		} else if($_POST['segu2']){
		$segu = $_POST['segu2'];
		} else if($_POST['segu3']){
		$segu = $_POST['segu3'];
		}


if($medico1){
		$numeroMedico = $medico1;
		} else if( $_POST['numeroMedico1']){
		$numeroMedico = $_POST['numeroMedico1'];
		} else if( $_POST['numeroMedico2']){
		$numeroMedico  = $_POST['numeroMedico2'];
		} else if( $_POST['numeroMedico3']){
		$numeroMedico  = $_POST['numeroMedico1'];
		}
		



	if($numpoliza){
	 $numPoliza = $numpoliza;
	} else if($_POST['numPoliza1']){
	  $numPoliza = $_POST['numPoliza1'];
	} else if($_POST['numPoliza2']){
	 $numPoliza = $_POST['numPoliza2'];
	} else if($_POST['numPoliza3']){
	 $numPoliza = $_POST['numPoliza3'];
	}
	
		if($numPaciente1){
		$numPaciente = $numPaciente1;
		} else if($_POST['numPaciente2']){
		$numPaciente = $_POST['numPaciente2'];
		} else if($_POST['numPaciente3']){
		$numPaciente = $_POST['numPaciente3'];
		 } else if($_POST['numPaciente4']){
		$numPaciente = $_POST['numPaciente4'];
		} 


$hora = date("H:i a");


//********************CLIENTES AMBULATORIOS  A FARMACIA ***************************

$status='inactivo';
$sSQL1= "Select * From clientesAmbulatorios WHERE numeroE = '".$_POST['nCuenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$numeritoE=$_POST['numeroE'];


if($_POST['cargos'] and $numPaciente !=$myrow1['numeroE']
 and $_POST['seguro'] and $_POST['paciente']){
 $sSQL4= "Select max(keyClientesAmbulatorios) as final From clientesAmbulatorios";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$numPaciente = $myrow4['final']+1; 
$agrega = "INSERT INTO clientesAmbulatorios ( 
numeroE,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1
) values (
'".$numPaciente."',
'".$_POST['medico']."',
'".$_POST['paciente']."',
'".$_POST['seguro']."',
'".$_POST['autoriza']."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'".$status."',
'".$_POST['cita']."',
'".$ali."',
'".$usuario."',
'".$ip."',
'".$fecha1."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}


//**********************CIERRO CLIENTES AMBULATORIOS A FARMACIA*********************


	
if($_POST['insertarArticulos']){


$cantidade=$_POST['cantidad'];
if($agregar = $_POST["agregarA"]){
foreach($agregar as $i => $agregar_articulo){
$extension="0";


$sSQL11= "Select * From existencias WHERE codigo ='".$agregar[$i]."'
AND (almacen='hfar' or almacen='hfarvp')";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$articuloExistencia= $myrow11['existencia'];
$cantidadArticulos[0]=$articuloExistencia-$cantidade[$i];

$sSQL1= "Select * From cargosCuentaPaciente WHERE numeroE = '".$numPaciente."'
AND codProcedimiento='".$agregar[$i]."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if($articuloExistencia>$cantidade[$i]  and $cantidade[$i]> 0 and $cantidade[$i] <100){

$q22 = "UPDATE existencias set 
existencia='".$cantidadArticulos[0]."'
WHERE codigo ='".$agregar[$i]."'
AND almacen='".$traeteAlmacen."'";
mysql_db_query($basedatos,$q22);
echo mysql_error();
//***************************************grupo de producto
$sSQL12= "Select * From articulos WHERE 
codigo='".$agregar[$i]."'  ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
//*******************************************
$status="activo";
$tipoPaciente="interno";
$agrega = "INSERT INTO cargosCuentaPaciente ( 
numeroE,
almacen,cantidad,codProcedimiento,usuario,fecha1,ip,status,hora1,extension,nCuenta,gpoProducto
) values (
'".$numPaciente."',
'".$traeteAlmacen."',
'".$cantidade[$i]."',
'".$agregar[$i]."',
'".$usuario."',
'".$fecha1."',
'".$ip."',
'".$status."',
'".$hora1."',
'".$extension."',
'".$_POST['nCuenta']."',
'".$gpoProducto."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda="Se agregaron materiales";
$_POST['medico']="";
$_POST['paciente']="";
$_POST['seguro']=NULL;
$_POST['autoriza']="";
$_POST['credencial']="";
$_POST['cita']="";
$leyenda= "Se actualizaron las existencias ";
} //cierro existencias
}}

} //cierro insertar articulos
		



//***********************CAMBIAR ALMACEN****************************

if($_POST['cambiarAlmacen']){
$sSQL17= "Select * From sesionesAlmacen WHERE usuario = '".$usuario."' AND almacen = '".$_POST['almacen']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$ali=$myrow17['almacen'];
if($myrow1['almacen'] AND $myrow1['usuario']){
 $agrega = "INSERT INTO sesionesAlmacen ( usuario,almacen
) values (
'".$usuario."',
'".$_POST['almacen']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//paciente_agregado();
} else {
$q1 = "UPDATE sesionesAlmacen set 
almacen='".$_POST['almacen']."'
WHERE usuario = '".$usuario."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
//paciente_actualizado();
}
}
//**********************CIERRO CAMBIAR ALMACEN******************************








?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.catalogo {font-family: Verdana, Arial, Helvetica, sans-serif;  
    font-size: 9px;  
    color: #333333;  
}
.Estilo24 {font-size: 10px}
.style19 {color: #000000; font-weight: bold; }
.style20 {
	color: #FFFFFF;
	font-weight: bold;
}
.style22 {color: #330099}
-->
</style>
</head>
<body onLoad="setfocus('cbarra_valor');">

<h1 align="center">Departamento: <span class="style22">Farmacia venta al publico</span></h1>
<form id="form1" name="form1" method="post" action="">
  <table width="554" border="1" align="center" class="Estilo24">
    <tr>
      <th colspan="3" bgcolor="#660066" class="Estilo24 style20" scope="col">Captura a Cuenta Paciente Particular <?php echo $leyenda; ?></th>
    </tr>
    <tr>
      <th width="8" class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left">N&uacute;mero de Nota </div></th>
      <th class="Estilo24" scope="col"><label>
          <div align="left">
<input name="nPaciente1" type="text" class="Estilo24" id="nPaciente1" size="60" readonly="" 
		value="<?php echo $numPaciente; ?>"/>
        </div>
        </label></th>
    </tr>
    <tr>
      <th width="8" class="Estilo24" scope="col">&nbsp;</th>
      <th width="232" class="Estilo24" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="292" class="Estilo24" scope="col"><div align="left"><strong>
          <label> </label>
          </strong>
<input name="nombreDelPaciente1" type="text" class="Estilo24" id="nombreDelPaciente1" value="<?php echo $rNombre110['paciente']; ?>" size="60" 
readonly=""/>
      </div></th>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">M&eacute;dico</td>
      <td class="Estilo24"><input name="medico12" type="text" class="Estilo24" id="medico12" value="<?php echo $medico=$rNombre110['medico']; ?>" 
		  readonly=""/></td>
    </tr>
    <tr>
      <th width="8" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Seguro: </td>
      <td class="Estilo24"><label>
      <?php 
	 
$sSQL1= "Select distinct * From clientes ORDER BY nomCliente ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 

echo mysql_error();
	  ?>
      <select name="seguro" class="Estilo24" id="seguro" onchange="javascript:this.form.submit();"/>
  
      <?php 		if($_POST['seguro']!=null){ ?>
      <option value="<?php echo $_POST['seguro']; ?>"><?php echo $_POST['seguro']; ?></option>
      <?php } ?>
      <option value="0">PARTICULAR SIN DESCUENTO</option>
      <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
      <option value="<?php echo $myrow1['numCliente']; ?>"><?php echo $myrow1['nomCliente']; ?></option>
      <?php } ?>
      </select>
      <?php 
$sSQL23= "Select * From clientes WHERE numCliente ='".$_POST['seguro']."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'];
?>
      </label></td>
    </tr>
    <tr>
	<?php
$sSQL6= "Select * FROM usuarios Where usuario = '".$usuario."'";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
?>	
      <th width="8" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Autoriza:</td>
      <td class="Estilo24"><input name="autoriza3" type="text" class="Estilo24" id="autoriza3" 
value="<?php echo $myrow6['nombre']." ".$myrow6['aPaterno']." ".$myrow6['aMaterno']; ?>" size="60" readonly=""/></td>
    </tr>
    <tr>
      <th width="8" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Fecha: </td>
      <td class="Estilo24"><input name="fecha" type="text" class="Estilo24" id="fecha" 
	  value="<?php 
	   echo $fecha1;  ?>" size="9" readonly=""/>     </td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Hora:</td>
      <td class="Estilo24"><input name="hora" type="text" class="Estilo24" id="hora" value="<?php  
	  echo $hora1; 
	   ?>" size="9" maxlength="9" readonly=""/></td>
    </tr>
    <tr>
      <th width="8" class="Estilo24" scope="col">&nbsp;</th>
</tr>
  </table>
  <h5 align="center">
    <input name="cargos" type="hidden" id="cargos" />
    <input name="Alma1" type="hidden" id="Alma1" value="<?php echo $Alma; ?>" />
    <input name="Alma2" type="hidden" id="Alma2" value="<?php echo $Alma; ?>" />
    <input name="nPaciente2" type="hidden" id="nPaciente2" value="<?php echo $nPaciente; ?>" />
    <input name="autoriza2" type="hidden" id="autoriza2" value="<?php echo $autoriza; ?>" />
    <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nomPasiente; ?>" />
    <input name="credencial2" type="hidden" id="credencial2" value="<?php echo $credencial; ?>" />
    <input name="cita2" type="hidden" id="cita2" value="<?php echo $cita; ?>" />
  </h5>
  <hr />
  <h5 align="center">Busca los materiales para cargar </h5>
  <table width="729" border="1" align="center">
    <tr>
      <th scope="col">
	  <?php if($_POST['escoje']=="cbarra"){ ?>
	  <input name="escoje" type="radio" value="cbarra"  checked="checked"/>
	 <?PHP } else if($_POST['cargos']){ ?>
	 <input name="escoje" type="radio" value="cbarra"  checked="checked"/>
	 
	 <?php } else { ?>
	  <input name="escoje" type="radio" value="cbarra" />
	 <?php } ?>
	 </th>
	  <th class="style12" scope="col">Cargar Material x Codigo De Barras </th>
      <th scope="col"><label>
        <div align="left">


	      <?php if($_POST['escoje']=="cbarra"){ ?>
		  <input name="cbarra" type="text" class="style12" id="cbarra_valor" size="40"  checked="checked"/>
	 	  <?php } else { ?>
		  <input name="cbarra" type="text" class="style12" id="cbarra" size="40"  />
		  <?php } ?>
	    </div>
      </label></th>
    </tr>
    <tr>
      <th width="28" scope="col">
	  <?php if($_POST['escoje']=="porarticulo"){ ?>
	  <input name="escoje" type="radio" value="porarticulo" checked="checked" id="cbarra_valor"/>
	  <?php } else { ?>
	  <input name="escoje" type="radio" value="porarticulo" />
	  <?php } ?>
	  </th>
      <th width="208" scope="col"><div align="center"><span class="style12">Cargar Materiales  </span></div></th>
      <th width="471" scope="col"><div align="left"><span class="style12">
          <input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="60" />
      </span></div></th>
    </tr>

    <tr>
      <th height="43" scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col"><label>
        <div align="left">
          <input name="buscar" type="submit" class="style12" id="buscar" value="buscar" />
        
		</div>
      </label></th>
    </tr>
  </table>
  <p>
    <span class="Estilo24"><span class="style7">
    <input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
    </span></span>
    <input name="nombrePaciente3" type="hidden" id="nombrePaciente3" value="<?php 
echo $nombrePaciente1;
	 ?>" />
    <input name="medico1" type="hidden" id="medico1" value="<?php echo $medico1; ?>" />
    <input name="tipoSeguro1" type="hidden" id="tipoSeguro1" value="<?php echo $seguro; ?>" />
    <input name="almacenP1" type="hidden" id="almacenP1" value="<?php echo $almacenPrincipal; ?>" />
    <input name="numPoliza1" type="hidden" id="numPoliza1" value="<?php echo $numPoliza; ?>" />
    <input name="nCuenta1" type="hidden" id="nCuenta1" value="<?php echo $nCuenta; ?>" />
  </p>
        <?php	
	  
if(($_POST['buscar']) AND ($_POST['nomArticulo'] OR $_POST['cbarra'])){
if($_POST['escoje'] =="porarticulo" ){

$sSQL= "SELECT 
* 
FROM `articulos`,existencias 
WHERE
articulos.descripcion like '%$articulo%'
and
existencias.almacen='hfarvp'
and
existencias.existencia > '1'
and
articulos.codigo=existencias.codigo
";
 } 

if($_POST['nomArticulo']){
if($result=mysql_db_query($basedatos,$sSQL)){

?>
        <table width="879" border="1" align="center">
          <tr>
            <th width="77" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo Art&iacute;culo </span></div></th>
            <th width="516" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
            <th width="49" bgcolor="#660066" scope="col"><span class="style11">Existencias</span></th>
            <th width="37" bgcolor="#660066" scope="col"><span class="style11">Anaquel</span></th>
            <th width="37" bgcolor="#660066" scope="col"><span class="style11">Precio</span></th>
            <th width="37" bgcolor="#660066" scope="col"><span class="style11">%Seg.</span></th>
            <th width="37" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
            <th width="37" bgcolor="#660066" scope="col"><span class="style11">Agregar</span></th>
          </tr>
          <tr>
            <?php 

while($myrow = mysql_fetch_array($result)){ 

$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
$sSQL7= "
	SELECT 
  *
FROM
 precioArticulos
WHERE codigo = '".$code1."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

//traigo descuento

$sSQL11= "
	SELECT 
  *
FROM
 convenios
WHERE 
numCliente = '".$seguro."'
AND
articulo = '".$code1."'
";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
            <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
              <label></label>
              <?php echo $myrow['codigo']; ?>
              <input name="keyCAM[]" type="hidden" id="keyCAM[]" value="<?php  echo $myrow8['keyCAM']; ?>" />
            </span></td>
            <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['descripcion']; ?></span></td>
            <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
              <?php 
	  if($myrow['existencia']){
	  echo $myrow['existencia'];
	  } else {
	  echo "N/A";
	  }
	  ?>
            </span></td>
            <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
              <?php 
	  if($myrow['anaquel']){
	  echo $myrow['anaquel'];
	  } else {
	  echo "N/A";
	  }
	  ?>
            </span></td>
            <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
              <?php 
	if($myrow7['precio']){
	  echo number_format($myrow7['precio'],2);
	}else if($myrow7['pmax']){
	echo number_format($myrow7['pmax'],2);
	 }  else {
	echo "0.00";
	}
	
	  ?>
            </span></td>
            <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
              <?php 
		
		  if($myrow11['descuento']){
	echo $myrow11['descuento'];
	} else {
	echo "S/N";
	}
	  ?>
              <?php  
//echo $bandera;
if($myrow7['precio']){
$precio[$bandera] = $myrow7['precio'];
} else if($myrow7['pmax']){
$precio1[$bandera] = $myrow7['pmax'];
}



$d=substr($desc,0,1);
if($desc AND $d=='-'){ //checo si hay descuento

	  //$desc="-1.30";
	  $descuento = substr($desc,3,2);
	  $descuento *="0.01"; 
	  /* $desPrecio = $T[3]* $descuento;
	  $esSeguro = $T['3'] - $desPrecio;
	  $tSeguro = number_format($T['3'] - $desPrecio,2); */
	   } //cierro descuento



	  $T[0]=$precio[$bandera];
	  $T1[0]=$precio[$bandera];
	  $T[1]=$precio1[$bandera];
	  $T1[1]=$precio1[$bandera];
      $T[2]=$tPrecio[$bandera]+$tPrecio1[$bandera];
  	  $T[3]+=$T[2];
	  if($desc){
	  $tPrecio1[$bandera]*=$descuento;
	  $t1Precio1[0] = $tPrecio1[$bandera];
	  }
	?>
            </span></td>
            <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
			 <?php 		 if($myrow['existencia'] > 0){ ?>
              <input name="cantidad[]" type="text" id="cantidad" onKeyPress="return checkIt(event)" value="1" size="2" maxlength="2" /> 
              <?php } else {
	  echo "No Exist.";
	  } ?>
            </label></td>
            <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
	  <?php 		 if($myrow['existencia'] > 0){ ?>
	 <input name="agregarA[]" type="checkbox" id="agregarA[]" value="<?php echo $myrow['codigo']; ?>" />
	  <?php } else {
	  echo "No Exist.";
	  } ?>
             
            
			</label></td>
          </tr>
          <?php }}}?>
  </table>
        <p align="center">
    <label>
    <input name="insertarArticulos" type="submit" class="Estilo24" id="insertarArticulos" value="Agregar Art&iacute;culos" />
    </label>
  </p>
 
  <?php } ?>
  <input name="numPaciente2" type="hidden" id="numPaciente2" value="<?php echo $numPaciente; ?>" />
  <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
  <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
  <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
  <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
  <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
</form>


<?php //desde aqui ?>
<hr />
<th bgcolor="#000066" scope="col"><h6 align="center">Materiales Acumulados </h6>
<form id="form2" name="form2" method="post" action="">
    <span class="Estilo24"><span class="style7">
    <input name="medico222" type="hidden" id="medico222" value="<?php echo $medico; ?>" />
    <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $Almacen; ?>" />
    </span></span>
    <input name="nombrePaciente32" type="hidden" id="nombrePaciente32" value="<?php 
echo $nomPasiente;
	 ?>" />
    <input name="medico2" type="hidden" id="medico2" value="<?php echo $medico1; ?>" />
    <input name="tipoSeguro12" type="hidden" id="tipoSeguro12" value="<?php echo $seguro; ?>" />
    <input name="almacenP12" type="hidden" id="almacenP12" value="<?php echo $almacenPrincipal; ?>" />
    <input name="numPoliza3" type="hidden" id="numPoliza3" value="<?php echo $numPoliza; ?>" />
    <input name="numPaciente12" type="hidden" id="numPaciente12" value="<?php echo $numPaciente; ?>" />
    <table width="865" border="1" align="center">
      <tr>
        <th width="75" height="19" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo Art&iacute;culo </span></th>
        <th width="108" bgcolor="#660066" class="style11" scope="col">Fecha/Hora</th>
        <th width="519" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="41" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
        <th width="41" bgcolor="#660066" scope="col"><span class="style11">Costo </span></th>
        <th width="41" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
      </tr>
      <tr>
<?php //traigo agregados

$sSQL8= "
SELECT 
*
FROM
cargosCuentaPaciente
WHERE numeroE='".$numPaciente."' order by fecha1
";
$result8=mysql_db_query($basedatos,$sSQL8);
while($myrow8 = mysql_fetch_array($result8)){ 
$art = $myrow8['codProcedimiento'];

$sSQL7= "
SELECT 
*
FROM
cargosCuentaPaciente
WHERE numeroE = '".$nPaciente."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$myrow7['codProcedimiento'];
$a = $a + 1;
$art = $myrow8['codProcedimiento'];
$proc=$myrow8['codProcedimiento'];


//traigo descuento
$sSQL10= "
	SELECT 
  *
FROM
 convenios
WHERE 
numCliente = '".$seguro."'
AND
articulo = '".$art."'
";
$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
$sSQL18= "
	SELECT 
  *
FROM
 articulos
WHERE 
cbarra = '".$art."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);

$sSQL13= "
	SELECT 
  *
FROM
 articulos
WHERE 
codigo = '".$art."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
$gpoProducto = $myrow13['gpoProducto'];
$sSQL14= "
	SELECT 
  *
FROM
 procedimientos
WHERE 
codigoProcedimiento = '".$proc."'
";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);
$sSQL15= "
	SELECT 
  *
FROM
 medicosPrecios
WHERE 
codMedico = '".$medico."' AND codProcedimiento = '".$proc."'
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15);
echo mysql_error();
//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$sSQL17= "
	SELECT 
  *
FROM
gpoProductos
WHERE 
codigoGP = '".$gpoProducto."' 
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
echo mysql_error();

$sSQL9= "
SELECT 
*
FROM
 precioArticulos
WHERE codigo = '".$art."'";
$result9=mysql_db_query($basedatos,$sSQL9);
$myrow9 = mysql_fetch_array($result9);
?>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label>
          <?php 
		
		  if($myrow8['codProcedimiento']){
		  echo $myrow8['codProcedimiento']; 
		  } 
		  ?>
          </label>
		  
          <input name="codec[]" type="hidden" id="codec[]" value="<?php  echo $myrow8['codProcedimiento']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <?php 
	  if($myrow8['fecha1']){
	  echo $myrow8['fecha1'] ."--". $myrow8['hora1']; 
	  } else {
	  "N/A";
	  }
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <?php   
		if($myrow13['descripcion']){
		echo $myrow13['descripcion']; 
		} else if($myrow18['descripcion']){
		echo $myrow18['descripcion']; 
		}
		?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label>
          <?php 
	  echo $myrow8['cantidad'];
	  ?>
          </label>
          <input name="aFavor[]" type="hidden" id="aFavor[]" value="<?php echo $myrow8['cantidad']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <?php 
	
	  echo number_format($myrow9['precio'],2);
		$precio1=$myrow9['precio']*$myrow8['cantidad'];
	$precio[0]+=$precio1;
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><input name="keyCodigoArticulo[]" type="checkbox" id="keyCodigoArticulo[]" value="<?php  echo $myrow8['keyCAP'];   ?>" /></td>
      </tr>
      <?php } //cierra while?>
    </table>
    <p align="center">
      <input name="borrar2" type="submit" class="Estilo24" id="borrar2" value="Quitar Art&iacute;culos" />
    </p>
    <h2 align="center" class="style19"><?php $TOTAL= $costo[0]+$precio[0]; 
echo "$".number_format($TOTAL,2);
	?></h2>
    <div align="center">
      <label></label>
      <input name="cargos" type="hidden" id="cargos" />
      <input name="Alma" type="hidden" id="Alma" value="<?php echo $Alma; ?>" />
      <input name="nPaciente" type="hidden" id="nPaciente" value="<?php echo $nPaciente; ?>" />
      <input name="medico2" type="hidden" id="medico2" value="<?php echo $medico; ?>" />
      <input name="autoriza" type="hidden" id="autoriza" value="<?php echo $autoriza; ?>" />
      <input name="paciente" type="hidden" id="paciente" value="<?php echo $nomPasiente; ?>" />
      <input name="credencial" type="hidden" id="credencial" value="<?php echo $credencial; ?>" />
      <input name="cita" type="hidden" id="cita" value="<?php echo $cita; ?>" />
      <input name="numPaciente4" type="hidden" id="numPaciente4" value="<?php echo $numPaciente; ?>" />
      <input name="numeroMedico3" type="hidden" id="numeroMedico3" value="<?php echo $numeroMedico; ?>" />
      <input name="nombreDelPaciente4" type="hidden" id="nombreDelPaciente4" value="<?php echo $nombreDelPaciente; ?>" />
      <input name="extension4" type="hidden" id="extension4" value="<?php echo $extension; ?>" />
      <input name="segu3" type="hidden" id="segu3" value="<?php echo $segu; ?>" />
      <input name="nCuenta3" type="hidden" id="nCuenta3" value="<?php echo $nCuenta; ?>" />
    </div>
    <label>
    <div align="center">
    </label>
  </form></th>
</body>
</html>
<?php } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/menuPrincipal.php">';
exit;

}
?>