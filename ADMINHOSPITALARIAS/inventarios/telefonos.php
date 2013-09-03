<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
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
.style7 {font-size: 9px}
-->
</style>
</head>

<body>
<div align="center">HOSPITAL LA CARLOTA <br />
  TELEFONOS 
</div>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <p align="center">&nbsp;</p>
  <table width="493" border="1" align="center" class="style12">
    <tr>
      <th width="5" scope="col">&nbsp;</th>
      <th width="42" scope="col">Nombre:</th>
      <th width="424" scope="col"><label>
        <div align="left">
          <input name="buscador" type="text" id="buscador" size="60" />
        </div>
      </label></th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Entidad</td>
      <td><label>
        <select name="entidad" class="style12" id="entidad">
          <option value="tbl_departamentos">Extensiones Hospital</option>
          <option value="tbl_deparum">Extensiones UM</option>
          <option value="tbl_empleadoshlc">Empleados Hospital</option>
          <option value="tbl_empleadum">Empleados UM</option>
          <option value="tbl_medforaneos">M&eacute;dicos For&aacute;neos</option>
          <option value="tbl_medicoshlc">M&eacute;dicos Hospital</option>
          <option value="tbl_varios">Varios</option>
        </select>
      </label></td>
    </tr>
    
	
	
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label class="style12">
        <input name="Submit" type="submit" class="style12" value="Buscar" />
      </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<table width="585" border="1" align="center">
  <tr>
    <th width="110" bgcolor="#333333" scope="col"><span class="style11">Tel&eacute;fonos</span></th>
    <th width="459" bgcolor="#333333" scope="col"><span class="style11">Nombre</span></th>
  </tr>
  <tr>
    <?	

	$tabla = $_POST['entidad'];
	$buscador = $_POST['buscador'];
    if($tabla == "tbl_departamentos"){
	$sSQL= "Select all distinct * From tbl_departamentos WHERE nom_departamento LIKE '%$buscador%' order by nom_departamento ASC";
	$result=mysql_db_query("medsys",$sSQL); 
	$myrow1 = mysql_fetch_array($result);
	}else if($tabla == "tbl_deparum"){
	 $sSQL= "Select all distinct * From tbl_deparum WHERE NomDepa LIKE '%$buscador%' order by NomDepa ASC";
	 $result=mysql_db_query("medsys",$sSQL); 
	}else if($tabla == "tbl_empleadoshlc"){
	$sSQL= "Select all distinct * From tbl_empleadoshlc WHERE nom_empleadohlc LIKE '%$buscador%' order by nom_empleadohlc ASC";
	$result=mysql_db_query("medsys",$sSQL); 
	}else if($tabla == "tbl_empleadum"){
	$sSQL= "Select all distinct * From tbl_empleadum WHERE NomEmpleado LIKE '%$buscador%' order by NomEmpleado ASC";$result=	     mysql_db_query("medsys",$sSQL); 
	}else if($tabla == "tbl_medforaneos"){
	$sSQL= "Select all distinct * From tbl_medforaneos WHERE nom_medico LIKE '%$buscador%' order by nom_medico ASC";
	$result=mysql_db_query("medsys",$sSQL); 
	}else if($tabla == "tbl_medicoshlc"){
	$sSQL= "Select all distinct * From tbl_medicoshlc WHERE nom_Medicoshlc LIKE '%$buscador%' order by nom_Medicoshlc ASC";
	$result=mysql_db_query("medsys",$sSQL); 
	}else if($tabla == "tbl_varios"){
	$sSQL= "Select all distinct * From tbl_varios WHERE nombre LIKE '%$buscador%' order by nombre ASC";
	$result=mysql_db_query("medsys",$sSQL); 
	}


 




//echo $myrow['nom_departamento'];

?>
    <td bgcolor="#FFFFFF" class="style12"><span class="style7">
      <label></label>
    </span></td>
    <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? ?></span></td>
  </tr>
  <? ?>
</table>
<p>&nbsp;</p>
</body>
</html>