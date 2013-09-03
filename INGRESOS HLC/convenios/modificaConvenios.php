<? include("/configuracion/conf.php"); ?>
<?
$modulo = "CON";
$checaModuloScript= "Select all distinct * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo LIKE '%$modulo%'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>
<script>
function cForm(s){
if(s==2)
{
mywin=window.open('','myWin','');
document.forms[0].submit();
}else{
mywin="_self"
document.forms[0].submit();
}
}
</script>



<? include("menu.php"); ?>
<? require("conexion.php"); ?>

<?
$hoy = date("dmY");


/*
if($_POST['actualizar'] AND is_numeric($_POST['codigo']) AND $_POST['descripcion'] AND $_POST['precio']){
$sSQL1= "Select all distinct * From articulos WHERE codigo = '".$_POST['codigo']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigo']){
if($_POST['codigo']!=$myrow1['codigo']){
$agrega = "INSERT INTO articulos (
codigo,descripcion,um,estacion,cbarra,categoria,tipoE) 
values ('".$_POST['codigo']."','".$_POST['descripcion']."','".$_POST['um']."',
'".$_POST['estacion']."','".$_POST['cbarra']."','".$_POST['categoria']."',
'".$_POST['tipoE']."')";
mysql_db_query($basedatos,$agrega);
}} else {
$q = "UPDATE precioArticulos set 
costo='".$_POST['costo']."', 
pmin='".$_POST['pmin']."', 
reorden='".$_POST['reorden']."', 
pmin='".$_POST['pmin']."', 
precio='".$_POST['precio']."'
WHERE 
codigo='".$_POST['codigo']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
actualizado();
}
}

if($_POST['borrar'] AND $_POST['codigo']){
$borrame = "DELETE FROM articulos WHERE codigo ='".$_POST['codigo']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
borrado();
}*/

if($_POST['nuevo']){
$_POST['codigo'] = "";
}



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
.style15 {
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center">Convenios <?
  if($_POST['siguiente'] AND $_POST['codigo']){
  $_POST['codigo'] =$_POST['codigo']+1;
  } 
  if($_POST['atras'] AND $_POST['codigo']){
  $_POST['codigo'] =$_POST['codigo']-1;
  }


if(is_numeric($_POST['codigo'])){ // solo si es numerico
 $sSQL= "SELECT 
*
FROM
  `articulos`
   WHERE codigo = '".$_POST['codigo']."'
  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$sSQL1= "SELECT 
*
FROM
  `convenios`
   WHERE articulo = '".$_POST['codigo']."'
 AND numCliente = '".$_POST['numCliente1']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); //cierro si es numerico
} else {
$sSQL= "SELECT 
*
FROM
  `articulos`
   WHERE gpoProducto = '".$_POST['codigo']."'
  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$sSQL1= "SELECT 
*
FROM
  `convenios`
   WHERE articulo = '".$_POST['codigo']."'
 AND numCliente = '".$_POST['numCliente1']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); //cierro si es numerico
}



?></p>
<form id="form1" name="form1" method="post" action="listaConvenios.php" target="mywin">
  <table width="318" border="1" align="center" class="style12">
    <tr>
      <th width="1" rowspan="7" scope="col">&nbsp;</th>
      <th width="66" bgcolor="#333333" scope="col"><div align="left" class="style13"><? if(!$_POST['nuevo']){ ?>C&oacute;digo: 
	  <? } ?>
	  </div></th>
      <th colspan="2" scope="col"><label>
        <div align="left">
        
		
				  <input name="codigo" type="text" class="style12" id="codigo" value="<? 
				  if($myrow['codigo']){
				  echo $myrow['codigo'];
				  } else {
				  echo $_POST['codigo'];
				  }
				  ?>" readonly="" />
		
	
		</div>
      </label></th>
    </tr>
    <tr>
      <td bgcolor="#333333"><span class="style13">
        <label>
        
        <div align="left" class="style13">Descripci&oacute;n:</div>
        <span class="style13">
        </label>
      </span></td>
      <td width="222"><label>
        <div align="left">
<?

if($descripcion = $myrow['descripcion']){
$describe = $descripcion;
} else {
$describe = $myrow['gpoProducto'];
}
?>		
		
<textarea name="descripcion" cols="40" rows="6" class="style12" id="descripcion"><? echo $describe;?>
</textarea>
        </div>
      </label></td>
      <td width="1">&nbsp;</td>
    </tr>
    
    <tr>
      <td bgcolor="#333333"><span class="style13">Cantidad</span></td>
	  <?
	  if(!$_POST['nuevo']){
	  $descuento = $myrow1['descuento'];
	   $valor = $descuento{2};
	   if($valor=="."){
	  $por = $descuento;
	 $activo = 'readonly=""';
	  } else {
	   $desc = $descuento;
       $activo1 = 'readonly=""';
	  }}
	  ?>
      <td colspan="2"><input name="cantidad" type="text" class="style12" id="cantidad" value="<? echo $desc;?>" <? echo $activo ?>/></td>
    </tr>
    <tr>
      <td bgcolor="#333333"><div align="left" class="style13">Porecentaje:</div></td>
      <td colspan="2"><label>
        <div align="left">
          <input name="porcentaje" type="text" class="style12" id="porcentaje" value="<? echo $por;?>" <? echo $activo1 ?>/>
        </div>
      </label></td>
    </tr>
    
    <tr>
      <td bgcolor="#333333"><div align="left" class="style13">Fecha Inicial :</div></td>
      <td colspan="2"><div align="left">
	  <? 
	
	  $fechaInicialdia = trim(substr($myrow1['fechaInicial'],0,2));
	  $fechaInicialMes = trim(substr($myrow1['fechaInicial'],3,2));
	  $fechaInicialAno = trim(substr($myrow1['fechaInicial'],6,8));
	  $fechaFinaldia = trim(substr($myrow1['fechaFinal'],0,2));
	  $fechaFinalMes = trim(substr($myrow1['fechaFinal'],3,2));
	  $fechaFinalAno = trim(substr($myrow1['fechaFinal'],6,8));
	  

	  $fechaFinal1 = $myrow1['fechaFinal'];
	  $fechaFinal = str_replace('/','',$fechaFinal1);
	  
	  //echo "fechaFinal".$fechaFinal;
	  //echo "hoy".$hoy;
	  if(!$_POST['nuevo']){
	  if($fechaFinal<$hoy ){
	  $valor = "caducado";
	  } else {
	 $valor = "vigente";
	  }}
	  ?>
        <label>
        <select name="fechaInicial1" class="style12" id="fechaInicial1">
		<? if($myrow1['fechaInicial'] AND !$_POST['nuevo']){ ?>
		<option value="<? echo $fechaInicialdia;?>"><? echo $fechaInicialdia;?></option> 
		<? } else { ?>
		<option value="<? echo date("d");?>"><? echo date("d");?></option> 
		<? } ?>
		<option></option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
        </label>
      /
      <select name="fechaInicial2" class="style12" id="fechaInicial2">
	  <? if($myrow1['fechaInicial'] AND !$_POST['nuevo']){ ?>
		<option value="<? echo $fechaInicialMes;?>"><? echo $fechaInicialMes;?></option> 
		<? } else { ?>
		<option value="<? echo date("m");?>"><? echo date("m");?></option> 
		<? } ?>
	  <option></option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
          </select>
      /
      <select name="fechaInicial3" class="style12" id="fechaInicial3">
	 <? if($myrow1['fechaInicial'] AND !$_POST['nuevo']){ ?>
		<option value="<? echo $fechaInicialAno;?>"><? echo $fechaInicialAno;?></option> 
		<? } else { ?>
		<option value="<? echo date("Y");?>"><? echo date("Y");?></option> 
		<? } ?>
	  <option></option>
        <option value="2007">2007</option>
        <option value="2008">2008</option>
        <option value="2009">2009</option>
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
          </select>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#333333"><div align="left" class="style13">Fecha Final </div></td>
      <td colspan="2"><div align="left">
        <label></label>
        <label></label>
        <label>
        <select name="fechaFinal1" class="style12" id="fechaFinal1">
		<? if($myrow1['fechaFinal'] AND !$_POST['nuevo']){ ?>
		<option value="<? echo $fechaFinaldia;?>"><? echo $fechaFinaldia;?></option> 
		<? } else { ?>
		<option value="<? echo date("d");?>"><? echo date("d");?></option> 
		<? } ?>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
        </label>
/
<select name="fechaFinal2" class="style12" id="select2">
<? if($myrow1['fechaFinal'] AND !$_POST['nuevo']){ ?>
		<option value="<? echo $fechaFinalMes;?>"><? echo $fechaFinalMes;?></option> 
		<? } else { ?>
		<option value="<? echo date("m");?>"><? echo date("m");?></option> 
		<? } ?>
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
</select>
/
<select name="fechaFinal3" class="style12" id="select3">
<? if($myrow1['fechaFinal'] AND !$_POST['nuevo']){ ?>
		<option value="<? echo $fechaFinalAno;?>"><? echo $fechaFinalAno;?></option> 
		<? } else { ?>
		<option value="<? echo date("Y");?>"><? echo date("Y");?></option> 
		<? } ?>
  <option value="2007">2007</option>
  <option value="2008">2008</option>
  <option value="2009">2009</option>
  <option value="2010">2010</option>
  <option value="2011">2011</option>
  <option value="2012">2012</option>
  <option value="2013">2013</option>
  <option value="2014">2014</option>
  <option value="2015">2015</option>
</select>
      
	  
	  <? if($valor =="vigente"){ 
	   $clase = "style15";
	  } else {
	   $clase = "style14";
	  }?>
	 <span class="<? echo $clase; ?>"> <? echo $valor; ?> </span></div></td>
    </tr>
    
    <tr>
      <td bgcolor="#333333"><div align="left"><span class="style13"></span></div></td>
      <td colspan="2"><div align="left">
        <label>
        
          <div align="right">
            <label>
            <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" onClick="cForm(1)"/>
            <input name="borrar" type="submit" class="style12" id="borrar" value="Borrar" />
            </label>
            <input name="actualizar" type="submit" class="style12" id="actualizar" value="Actualizar/Grabar" />
          </div>
        </label>
      </div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center" class="style12"> 
        <label>
        <input name="atras" type="submit" class="style12" id="atras" value="&lt;&lt;" />
        </label>
        <label>
        <input name="siguiente" type="Submit" class="style12" id="siguiente" value="&gt;&gt;"/>
        </label>
        <p><label></label></p>
      </div></td>
    </tr>
  </table>
</form>


<form >
URL <input type="text" name="URL" value="listaConvenios.php">
Name <input type="text" name="windowName" value="myWindow">
Width <input type="text" name="width" value="500">
Height <input type="text" name="height" value="800">
<input type="checkbox" name="directories"> Directories
<input type="checkbox" name="location"> Location
<input type="checkbox" name="menubar"> Menubar
<input type="checkbox" name="scrollbars"> Scrollbars
<input type="checkbox" name="status"> Status
<input type="checkbox" name="toolbar"> Toolbar
<input type="checkbox" name="resizable"> Resizable
<input type="button" value="Create It"
    onClick="createWindow(this.form)">
</form>
</body>
</html>
<? } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/medsys/menuPrincipal.php">';
exit;

}
?>