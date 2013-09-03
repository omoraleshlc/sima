<?PHP include("/configuracion/expedientesclinicos/medicos/medicosmenu.php"); ?>
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
<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>
<?php
function saca_por($can,$por){
$can=($can/100)*$por;
$tPor=$can+$cant;
return $can;
}
function saca_pormas($can,$por){
$can=($can/100)*$por;
$tPor=$can-$cant;
return $can;
}
function saca_iva($can,$por){
$cant=$can;
$can=($can/100)*$por;
$can+=$cant;
return $can;
}

//onchange="javascript:this.form.submit();"

$sqlNombre12="SELECT * From sesionesAlmacen
			WHERE 
			usuario = '".$usuario."'
			ORDER BY almacen ASC";
$resultaNombre12=mysql_db_query($basedatos,$sqlNombre12);
$rNombre12=mysql_fetch_array($resultaNombre12);
$traeteAlmacen=$rNombre12['almacen'];
$articulo = $_POST['nomArticulo']; ?>
<?php 
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

$hoy = date("d/m/y");
$hora = date("H:i a");
	 
if($_POST['insertarArticulos'] and $_POST['escoje']==$_POST['porarticulo']){
$gpoProducto=$_POST['gpoProducto'];
$cantidade= $_POST["cantidad"];
if($agregar = $_POST["agregarA"]){
foreach($agregar as $i => $agregar_articulo){


$sSQL11= "Select * From existencias WHERE codigo ='".$agregar[$i]."'
AND almacen='".$traeteAlmacen."'";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$articuloExistencia= $myrow11['existencia'];
$cantidadArticulos[0]=$articuloExistencia-$cantidade[$i];

$sSQL1= "Select * From cargosCuentaPaciente WHERE numeroE = '".$numPaciente."'
AND codProcedimiento='".$agregar[$i]."' and nCuenta='".$_POST['nCuenta']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$extension="0";

//if($articuloExistencia>$cantidade[$i] and $cantidade[$i]> 0 and $cantidade[$i] <100){
//if($articuloExistencia>$cantidade[$i]  and $cantidade[$i]> 0 and $cantidade[$i] <100){
if(!$myrow1['numeroE']){
$q22 = "UPDATE existencias set 
existencia='".$cantidadArticulos[0]."'
WHERE codigo ='".$agregar[$i]."'
AND almacen='".$traeteAlmacen."'";
mysql_db_query($basedatos,$q22);
echo mysql_error();


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
}
/* } else {
//echo "actualiza";

$q22 = "UPDATE existencias set 
existencia='".$cantidadArticulos[0]."'
WHERE codigo ='".$agregar[$i]."'
AND almacen='".$traeteAlmacen."'";
mysql_db_query($basedatos,$q22);
echo mysql_error();
if($cantidade[$i]=="1"){
$cant+=$myrow1['cantidad'];
$cantidade[$i]=$cant+'1';
} else if($cantidade[$i]>1){
$sSQL13= "Select * From cargosCuentaPaciente WHERE numeroE = '".$numPaciente."'
AND codArticulo='".$agregar[$i]."' and nCuenta='".$_POST['nCuenta']."'";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
$cantidadArticulos[1]=$myrow13['cantidad'];
$cantidade[$i]+=$cantidadArticulos[1];
}
$q = "UPDATE cargosCuentaPaciente set 
cantidad= '".$cantidade[$i]."',usuario = '".$usuario."',fecha1='".$fecha1."',ip='".$ip."',hora1='".$hora1."',
extension='".$extension."'
WHERE numeroE = '".$numPaciente."' AND codArticulo = '".$agregar[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
} //cierro insert */
//} //cierro existencias
}}

} //cierro insertar articulos
		


//$_POST['nuevo']=1;
$hoy = date("m/d/Y");
$hora = date("H:i a");

$medico=$_POST['medico']; 
$ali = $_POST['ali'];
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
if($_POST['borrar1'] AND $numPaciente){
if($agregar = $_POST["quitarP"]){
foreach($agregar as $i => $agregar_articulo){
$borrame = "DELETE FROM cargosAmbulatoriosP WHERE numeroE ='".$numPaciente."' AND codProcedimiento = '".$agregar[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda ="se quito el procedimiento";
}}}

if($_POST['borrar2'] AND $numPaciente){
if($agregar = $_POST["quitarM"]){
foreach($agregar as $i => $agregar_articulo){
$borrame = "DELETE FROM cargosCuentaPaciente WHERE numeroE ='".$numPaciente."' AND codArticulo = '".$agregar[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda ="se quito materiales o artículos";
}}}

if($_POST['nuevo']){
$_POST['medico']="";
$_POST['paciente']="";
$_POST['seguro']=NULL;
$_POST['autoriza']="";
$_POST['credencial']="";
$_POST['cita']="";
}
?>
<?php
if($_POST['escoje']=="cbarra" and $_POST['cbarraI']){
//*******************************************************
$sSQL= "SELECT *
FROM
articulos
WHERE 
cbarra = '".$_POST['cbarraI']."'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$codigo=$myrow['codigo'];
if($codigo){
//*************************************************************
$sSQL11= "Select * From existencias WHERE codigo ='".$codigo."'
AND almacen='".$traeteAlmacen."'";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$articuloExistencia= $myrow11['existencia'];
$cantidadArticulos[0]=$articuloExistencia-$cantidade[$i];

$q22 = "UPDATE existencias set 
existencia='".$cantidadArticulos[0]."'
WHERE codigo ='".$codigo."'
AND almacen='".$traeteAlmacen."'";
mysql_db_query($basedatos,$q22);
echo mysql_error();
//*********************************************************************
$agrega = "INSERT INTO cargosCuentaPaciente ( 
numeroE,
almacen,cantidad,codProcedimiento,usuario,fecha1,ip,status,hora1,extension,nCuenta,gpoProducto
) values (
'".$_POST['nPaciente1']."',
'".$Alma."',
'1',
'".$codigo."',
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
} else {

echo '<script type="text/vbscript">
msgbox "NO SE ENCONTRO EL ARTICULO!"
</script>';
}
}
?>
<?php 

$sqlNombre110 = "SELECT * From clientesInternos WHERE 
numeroE='".$numPaciente."'
and
status='activa'
";
$resultaNombre110=mysql_db_query($basedatos,$sqlNombre110);
$rNombre110=mysql_fetch_array($resultaNombre110);

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
.style13 {color: #FFFFFF}
-->
</style>
</head>
<body onLoad="setfocus('cbarra_valores');">
  <form id="form4" name="form4" method="post" action="">
    <table width="708" border="1" align="center">
      <tr>
        <th width="28" scope="col">&nbsp;</th>
        <th width="182" scope="col">DEPARTAMENTO:</th>
        <th width="476" scope="col"><div align="left"><span class="Estilo24">
            <?php
		  	$sqlNombre16= "SELECT * From sesionesAlmacen
			WHERE 
			usuario = '".$usuario."'
			ORDER BY almacen ASC";
$resultaNombre16=mysql_db_query($basedatos,$sqlNombre16);
$rNombre16=mysql_fetch_array($resultaNombre16);
$ali = $rNombre16['almacen'];
$sqlNombre17= "SELECT * From almacenes
			WHERE 
			almacen = '".$ali."'
			ORDER BY almacen ASC";
$resultaNombre17=mysql_db_query($basedatos,$sqlNombre17);
$rNombre17=mysql_fetch_array($resultaNombre17);

?>
            <select name="almacen" class="Estilo24" id="almacen"  onchange="javascript:this.form.submit();"/>
        
            <option value="<?php echo $ali;?>"><?php echo $rNombre17['descripcion'];?></option>
            <option value="">---</option>
            <?php
		    $sqlNombre1= "SELECT almacen From usuariosAlmacenes 
			WHERE 
			usuario = '".$usuario."'
			ORDER BY almacen ASC";
			$resultaNombre1=mysql_db_query($basedatos,$sqlNombre1);
            while ($rNombre1=mysql_fetch_array($resultaNombre1)){ 
			$ali18 = $rNombre1['almacen'];
   			$sqlNombre18= "SELECT * From almacenes
			WHERE 
			almacen = '".$ali18."'
			ORDER BY almacen ASC";
$resultaNombre18=mysql_db_query($basedatos,$sqlNombre18);
$rNombre18=mysql_fetch_array($resultaNombre18);

  ?>
            <option value="<?php echo $rNombre1['almacen'];?>"><?php echo $rNombre18['descripcion'];?></option>
            <?php } ?>
            </select>
            </span>
                <label></label>
        </div></th>
      </tr>
    </table>
  </form>
  <h1 align="center">Departamento:
  <?php echo $Alma=$ali; 
  
  ?></h1>
<form id="form1" name="form1" method="post" action="">
  <table width="627" border="1" align="center" class="style12">
    <tr>
      <th colspan="4" bgcolor="#660066" class="Estilo24 style20" scope="col">Diagn&oacute;sticos <?php echo $leyenda; ?></th>
    </tr>
    <tr>
      <th width="5" class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left">N&uacute;mero de Expediente: </div></th>
      <th colspan="2" class="Estilo24" scope="col"><label>
          <div align="left">
<input name="nPaciente1" type="text" class="Estilo24" id="nPaciente1" size="60" readonly="" 
		value="<?php echo $numPaciente; ?>"/>
        </div>
        </label></th>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left">N&uacute;mero de Cuenta: </div></th>
      <th colspan="2" class="Estilo24" scope="col"><label>
        <div align="left">
          <input name="nCuenta" type="text" class="style12" id="nCuenta" value="<?php echo $nCuenta=$rNombre110['nCuenta']; ?>" 
		  readonly=""/>
        </div>
      </label></th>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left">M&eacute;dico que solicit&oacute; internamiento: </div></th>
      <th colspan="2" class="Estilo24" scope="col"><div align="left">
        <input name="medico1" type="text" class="Estilo24" id="medico1" value="<?php echo $medico=$rNombre110['medico']; ?>" 
		  readonly=""/>
      </div></th>
    </tr>
    <tr>
      <th width="5" class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left"><strong>Agregar Procedimientos de un M&eacute;dico: </strong></div></th>
      <th width="191" class="Estilo24" scope="col"><div align="left">
        <label>        </label>
		
        <select name="medico" class="Estilo24" id="medico" onChange="javascript:this.form.submit();" 
		/>   
        
	   <?php 
		if($numeroMedico){ ?>
        <option value="<?php echo $numeroMedico; ?>"><?php echo $numeroMedico; ?></option>
        <?php }?>
		<option value="">Escoje un Médico</option>
		<?php
			$sqlNombre11 = "SELECT * From medicos ORDER BY apellido1 ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);

			
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
        <option value="<?php echo $rNombre11["numMedico"];?>"> <?php echo 
	 
	  $rNombre11["apellido1"]." ".$rNombre11["apellido2"]." ".$rNombre11["apellido3"]. $rNombre11["nombre1"]." ".$rNombre11["nombre2"];?></option>
        <?php } ?>
        </select>
</div></th>
      <th width="206" class="Estilo24" scope="col"><?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$_POST['medico']."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
        <input name="textfield" type="text" class="Estilo24" size="40" value="<?php echo $dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?>" readonly=""/></th>
    </tr>
    <tr>
      <th width="5" class="Estilo24" scope="col">&nbsp;</th>
      <th width="169" class="Estilo24" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th colspan="2" class="Estilo24" scope="col"><div align="left"><strong>
          <label> </label>
          </strong>
<?php		  
$sSQL21= "SELECT *
FROM
pacientes
WHERE 
numCliente='".$numPaciente."'
 ";
 $result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);
$nombrePaciente = $myrow21['nombre1']." ".$myrow21['nombre2']
	  ." ".$myrow21['apellido1']." ".$myrow21['apellido2']." ".$myrow21['apellido3'];
	  ?>		  
<input name="nombreDelPaciente1" type="text" class="Estilo24" id="nombreDelPaciente1" value="<?php echo $nombrePaciente; ?>" size="60" 
readonly=""/>
      </div></th>
    </tr>
    <tr>
      <th width="5" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Seguro: </td>
      <td colspan="2" class="Estilo24"><label>
        <input name="seguro" type="text" class="Estilo24" id="seguro" value="<?php echo $segu; ?>" readonly=""/>
      </label></td>
    </tr>
    <tr>
      <th width="5" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Autoriza:</td>
      <td colspan="2" class="Estilo24"><input name="autoriza1" type="text" class="Estilo24" id="autoriza1" 
value="<?php echo $usuario; ?>" size="60" readonly=""/></td>
    </tr>
    <tr>
      <th width="5" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Fecha: </td>
      <td colspan="2" class="Estilo24"><input name="fecha" type="text" class="Estilo24" id="fecha" 
	  value="<?php 
	   echo $fecha1;  ?>" size="9" readonly=""/>     </td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Hora:</td>
      <td colspan="2" class="Estilo24"><input name="hora" type="text" class="Estilo24" id="hora" value="<?php  
	  echo $hora1; 
	   ?>" size="9" maxlength="9" readonly=""/></td>
    </tr>
    <tr>
      <th width="5" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Extensi&oacute;n:</td>
      <td colspan="2" class="Estilo24">
 <select name="extension" class="Estilo24" id="extension" onChange="javascript:this.form.submit();" disabled="disabled"/>            
<option value="0">0</option>
      </select></td>
    </tr>
    <tr>
      
  </table>
  <h5 align="center">
    <label>
    <input name="Submit" type="submit" class="style12" value="Agregar" />
    </label>
  </h5>
</form>


  <th bgcolor="#000066" scope="col"><h6 align="center">&nbsp;</h6>
</th>
</body>
</html>