<?PHP include("/configuracion/administracionhospitalaria/recursoshumanos/rrhhmenu.php"); ?>
<?php    require("tooltip.php"); // require("bd/conecta.php");
$tipemp = "Selecciona un Tipo de Empleado"; $ndepa = "Seleccion un Depa.";
$sqlidmax = "Select Max(id) As mid From empleados";
 $idmaxemp = mysql_db_query($basedatos, $sqlidmax);   $idmax = mysql_fetch_array($idmaxemp);
    $maxid = $idmax['mid'] + 1;
$sql = "Select descripcion From almacenes";
      $result = mysql_db_query($basedatos, $sql);
if ($_POST['btnguarda']) {  $vgen = $_POST['element_7'];  $maxid = $_POST['btnguarda'];
  if($vgen == "Femenino") { $v1 = "checked='checked'";} else {$v1 = "";}
  if($vgen == "Masculino") { $v2 = "checked='checked'";} else {$v2 = "";}
                           $vstat = $_POST['element_8'];
  if($vstat == "Activo") { $v3 = "checked='checked'";} else {$v3 = "";}
  if($vstat == "Inactivo") { $v4 = "checked='checked'";} else {$v4 = "";}  
  if($vstat == "Jubilado") { $v5 = "checked='checked'";} else {$v5 = "";}  
                           $vedc = $_POST['element_11'];
  if($vedc == "Soltero") { $v6 = "checked='checked'";} else {$v6 = "";}
  if($vedc == "Casado") { $v7 = "checked='checked'";} else {$v7 = "";}
  if($vedc == "Divorciado") { $v8 = "checked='checked'";} else {$v8 = "";}    
  if($vedc == "Viudo") { $v9 = "checked='checked'";} else {$v9 = "";}    
$nnomi = $_POST['txtnnomi']; $nomemp = $_POST['txtnomemp']; $apellemp = $_POST['txtapelli'];
$direc = $_POST['txtdirecc']; $nciu = $_POST['txtciudad']; $edpp = $_POST['txtedopp'];
$ncp = $_POST['txtcodpost']; 
$vfnd = $_POST['element_4_1']; $vfnm = $_POST['element_4_2']; $vfny = $_POST['element_4_3'];
$fanac = $vfnd."/".$vfnm."/".$vfny; 
$vdfa = $_POST['element_5_1']; $vmfa = $_POST['element_5_2']; $vyfa = $_POST['element_5_3'];
$faalt = $vdfa."/".$vmfa."/".$vyfa; 
$tipemp = $_POST['seltipemp']; $ndepa = $_POST['seldepa'];
$ncurp = $_POST['txtcurp']; $ntel = $_POST['txttel']; $nmail = $_POST['txtemail'];
  if ($tipemp == "Selecciona un Tipo de Empleado") {
 echo "<script language='JavaScript'>alert('Selecciona un Tipo de Empleado');</script>";  
                                                   } else {
    if ($ndepa == "Seleccion un Depa.") {
 echo "<script language='JavaScript'>alert('Selecciona un Departamento');</script>"; 	
										} else {												   
$sqlbd = "Select keyAlmacenes As idd From almacenes Where descripcion = '".$ndepa."'";
 $rsbd = mysql_db_query($basedatos, $sqlbd); $iddepas = mysql_fetch_array($rsbd); 
 $depaid = $iddepas['idd'];
$sqlbe = "Select * From empleados Where id = ".$maxid."";
    $rserr = mysql_db_query($basedatos, $sqlbe);
       if (mysql_fetch_array($rserr) != Null){
$sqlg = "Update empleados Set numnom = '".$nnomi."' ,nomemp = '".$nomemp."' ,apellidos = '".$apellemp."' ,callnumcol = '".$direc."' ,ciudad = '".$nciu."' ,edopais = '".$edpp."' ,cp = '".$ncp."' ,fechanac = '".$fanac."' ,genero = '".$vgen."' ,status = '".$vstat."' ,fechaalta = '".$faalt."' ,tipoemp = '".$tipemp."' ,iddepa = ".$depaid." ,edocivil = '".$vedc."' ,curp = '".$ncurp."' ,tel = '".$ntel."' ,mail = '".$nmail."' Where id = ".$maxid."";	  
 echo "<script language='JavaScript'>alert('LOS DATOS SE MODIFICARON CON EXITO');</script>";
		               						 } else {
$sqlg = "Insert Into empleados (numnom, nomemp, apellidos, callnumcol, ciudad, edopais, cp, fechanac, genero, status, fechaalta, tipoemp, iddepa, edocivil, curp, tel, mail) Values ('".$nnomi."' ,'".$nomemp."' ,'".$apellemp."' ,'".$direc."' ,'".$nciu."' ,'".$edpp."' ,'".$ncp."' ,'".$fanac."' ,'".$vgen."' ,'".$vstat."' ,'".$faalt."' ,'".$tipemp."' ,".$depaid." ,'".$vedc."' ,'".$ncurp."' , '".$ntel."' , '".$nmail."')";	
 echo "<script language='JavaScript'>alert('LOS DATOS SE GUARDARON CON EXITO');</script>";
										            }
		   mysql_db_query($basedatos, $sqlg);  echo mysql_error(); 											
                                                          }
											   }		   
                         }
if ($_POST['btnbusca']) { $maxid = $_POST['btnbusca'];
$sqlbe = "Select * From empleados Where id = ".$maxid."";
    $rsemp = mysql_db_query($basedatos, $sqlbe);  $datoemp = mysql_fetch_array($rsemp);
                           $vgen = $datoemp['genero'];
  if($vgen == "Femenino") { $v1 = "checked='checked'";} else {$v1 = "";}
  if($vgen == "Masculino") { $v2 = "checked='checked'";} else {$v2 = "";}
                           $vstat = $datoemp['status'];
  if($vstat == "Activo") { $v3 = "checked='checked'";} else {$v3 = "";}
  if($vstat == "Inactivo") { $v4 = "checked='checked'";} else {$v4 = "";}  
  if($vstat == "Jubilado") { $v5 = "checked='checked'";} else {$v5 = "";}  
                           $vedc = $datoemp['edocivil'];
  if($vedc == "Soltero") { $v6 = "checked='checked'";} else {$v6 = "";}
  if($vedc == "Casado") { $v7 = "checked='checked'";} else {$v7 = "";}
  if($vedc == "Divorciado") { $v8 = "checked='checked'";} else {$v8 = "";}    
  if($vedc == "Viudo") { $v9 = "checked='checked'";} else {$v9 = "";}    
$nnomi = $datoemp['numnom']; $nomemp = $datoemp['nomemp']; $apellemp = $datoemp['apellidos'];
$direc = $datoemp['callnumcol']; $nciu = $datoemp['ciudad']; $edpp = $datoemp['edopais'];
$ncp = $datoemp['cp']; 
$fanac = $datoemp['fechanac'];   $separ = explode('/', $fanac); 
$vfnd = $separ[0]; $vfnm = $separ[1]; $vfny = $separ[2];
$faalt = $datoemp['fechaalta'];  $separ2 = explode('/', $faalt); 
$vdfa = $separ2[0]; $vmfa = $separ2[1]; $vyfa = $separ2[2];
$tipemp = $datoemp['tipoemp']; $iddepa = $datoemp['iddepa'];
$ncurp = $datoemp['curp']; $ntel = $datoemp['tel']; $nmail = $datoemp['mail'];
$sqlal = "Select descripcion From almacenes Where keyAlmacenes = ".$iddepa."";
   $rsalm = mysql_db_query($basedatos, $sqlal);  $nalemp = mysql_fetch_array($rsalm);	
	                $ndepa = $nalemp['descripcion'];
                        }						 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Add. Empleados ::</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<style type="text/css">
h1 {color: red}
h2 {color: rgb(160,82,45)}
p.blue {color: blue}
p.grey {color: #A9A9A9}
p.x-s {font-size: x-small}
p.s {font-size: small}
.fijo {position: fixed}
</style>
<style>
<!--
.style12 {font-size: 10px}
.style14 {font-size: 12px}
.style15 {color: #FF0000}
-->
</style>
</head>
<body id="main_body" onload="document.getElementById('txtnnomi').focus();">	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
<form id="form_206988" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Add. Empleados</h2>
		</div>						
			<ul >			
					<li id="li_1" >
		<label class="description" for="element_1">No. Nomina </label>
		<div>
<input id="txtnnomi" name="txtnnomi" class="element text small" type="text" maxlength="255" value="<?php echo $nnomi;?>"/>
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Datos Empleado </label>
		<span>
<input id="txtnomemp" name= "txtnomemp" class="element text" maxlength="255" size="20" value="<?php echo $nomemp;?>"/>
			<label>Nombre</label>
		</span>
		<span>
<input id="txtapelli" name= "txtapelli" class="element text" maxlength="255" size="30" value="<?php echo $apellemp;?>"/>
			<label>Apellidos</label>
		</span> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Direccion </label>		
		<div>
<input id="txtdirecc" name="txtdirecc" class="element text large" value="<?php echo $direc;?>" type="text">
			<label for="element_3_1">Calle, No, Col.</label>
		</div>
	
		<div class="left">
<input id="txtciudad" name="txtciudad" class="element text medium" value="<?php echo $nciu;?>" type="text">
			<label for="element_3_3">Ciudad</label>
		</div>
	
		<div class="right">
<input id="txtedopp" name="txtedopp" class="element text medium" value="<?php echo $edpp;?>" type="text">
			<label for="element_3_4">Estado, Provincia y Pais</label>
		</div>	
		<div class="left">
<input name="txtcodpost" type="text" class="element text small" id="txtcodpost" value="<?php echo $ncp;?>" size="20" maxlength="15">
			<label for="element_3_5">Codigo Postal</label>
		</div>	
		<div class="right">
		<label for="element_3_6"></label>
	</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Fecha de Nacimiento </label>
		<span>
<input id="element_4_1" name="element_4_1" class="element text" size="2" maxlength="2" value="<?php echo $vfnd;?>" type="text"> 
			/
			<label for="element_4_1">DD</label>
		</span>
		<span>
<input id="element_4_2" name="element_4_2" class="element text" size="2" maxlength="2" value="<?php echo $vfnm;?>" type="text"> 
			/
			<label for="element_4_2">MM</label>
		</span>
		<span>
<input id="element_4_3" name="element_4_3" class="element text" size="4" maxlength="4" value="<?php echo $vfny;?>" type="text">
			<label for="element_4_3">YYYY</label>
		</span>	
		<span id="calendar_4">
			<img id="cal_img_4" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_4_3",
			baseField    : "element_4",
			displayArea  : "calendar_4",
			button		 : "cal_img_4",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectEuropeDate
			});
		</script>		 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Genéro </label>
		<span>
<input id="element_7_1" name="element_7" class="element radio" type="radio" value="Femenino" <?php echo $v1;?>/>
<label class="choice" for="element_7_1">Femenino</label>
<input id="element_7_2" name="element_7" class="element radio" type="radio" value="Masculino" <?php echo $v2;?>/>
<label class="choice" for="element_7_2">Masculino</label>
		</span> 
		</li>		<li id="li_8" >
		<label class="description" for="element_8">Estatus </label>
		<span>
<input id="element_8_1" name="element_8" class="element radio" type="radio" value="Activo" <?php echo $v3;?>/>
<label class="choice" for="element_8_1">Activo</label>
<input id="element_8_2" name="element_8" class="element radio" type="radio" value="Inactivo" <?php echo $v4;?>/>
<label class="choice" for="element_8_2">Inactivo</label>
<input id="element_8_3" name="element_8" class="element radio" type="radio" value="Jubilado" <?php echo $v5;?>/>
<label class="choice" for="element_8_3">Jubilado</label>
		</span> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Fecha de Alta </label>
		<span>
<input id="element_5_1" name="element_5_1" class="element text" size="2" maxlength="2" value="<?php echo $vdfa;?>" type="text">
			/
			<label for="element_5_1">DD</label>
		</span>
		<span>
<input id="element_5_2" name="element_5_2" class="element text" size="2" maxlength="2" value="<?php echo $vmfa;?>" type="text">
			/
			<label for="element_5_2">MM</label>
		</span>
		<span>
<input id="element_5_3" name="element_5_3" class="element text" size="4" maxlength="4" value="<?php echo $vyfa;?>" type="text">
			<label for="element_5_3">YYYY</label>
		</span>	
		<span id="calendar_5">
			<img id="cal_img_5" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_5_3",
			baseField    : "element_5",
			displayArea  : "calendar_5",
			button		 : "cal_img_5",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectEuropeDate
			});
		</script>		 
		</li>		<li id="li_9" >
		<label class="description" for="element_9">Tipo de Empleado </label>
		<div>
<select class="element select medium" id="seltipemp" name="seltipemp"> 
<option><?php echo $tipemp;?></option>
<option>CONTRATO</option>
<option>DENOMINACIONAL</option>
<option>EXTRANJERO</option>
<option>INTER-DIVICION</option>
<option>INTER-UNION</option>
<option>SERV. OBRERO JUBILADO</option>
<option>SERV. MISIONERO</option>
<option>SERV. ADVENTISTA VOLUNTARIO</option>
</select>
		</div> 
		</li>		<li id="li_10" >
		<label class="description" for="element_10">Departamento </label>
		<div>
		<select class="element select medium" id="seldepa" name="seldepa"> 
		<option><?php echo $ndepa;?></option>
		<?php   while ($Datos = mysql_fetch_array($result)){ ?>
        <option
	 <?php if($nomdep==$Datos['descripcion']){?> 
	  selected="selected"
	                      <?php         } ?>
	   value="<?php echo $Datos['descripcion']; ?>"><?php echo $Datos['descripcion']; ?></option>
            <?php                                          } //LLAVE Q CIERRA EL WHILE ?>
		</select>
		</div> 
		</li>		<li id="li_11" >
		<label class="description" for="element_11">Estado Civil </label>
		<span>
<input id="element_11_1" name="element_11" class="element radio" type="radio" value="Soltero" <?php echo $v6;?>/>
<label class="choice" for="element_11_1">Soltero</label>
<input id="element_11_2" name="element_11" class="element radio" type="radio" value="Casado" <?php echo $v7;?>/>
<label class="choice" for="element_11_2">Casado</label>
<input id="element_11_3" name="element_11" class="element radio" type="radio" value="Divorciado" <?php echo $v8;?>/>
<label class="choice" for="element_11_3">Divorciado</label>
<input id="element_11_4" name="element_11" class="element radio" type="radio" value="Viudo" <?php echo $v9;?>/>
<label class="choice" for="element_11_4">Viudo</label>
		</span> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">CURP</label>
		<div>
<input id="txtcurp" name="txtcurp" class="element text small" type="text" maxlength="255" value="<?php echo $ncurp;?>"/> 
		</div> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Telefono</label>
		<div>
<input id="txttel" name="txttel" class="element text medium" type="text" maxlength="255" value="<?php echo $ntel;?>"/> 
		</div> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Em@il</label>
		<div>
<input id="txtemail" name="txtemail" class="element text small" type="text" maxlength="255" value="<?php echo $nmail;?>"/> 
		</div> 
		</li>
					<li class="buttons">
			    <center>
<input id="btnguarda" type="image" src="img/btnguardar.png" name="btnguarda" value="<?php echo $maxid;?>" onmouseover="ddrivetip('Add. Empleado', 'GRID', 92)" onmouseout="hideddrivetip()"/>
<input name="btn" type="image" src="img/btncancel.png" id="btn" value="Submit" onmouseover="ddrivetip('Cancelar', 'GRID', 52)" onmouseout="hideddrivetip()"/>
			    </center></li>
			</ul>
		</form>	
	</div>
	<img id="bottom" src="bottom.png" alt="">
</body>
</html>
