<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?
$modulo = "INV";
$checaModuloScript= "Select all distinct * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo LIKE '%$modulo%'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>
<? 
if($_POST['escoje'] =="poranaquel")
$_POST['nomArticulo'] ="1";

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
-->
</style>
</head>

<body>
<p><span class="style12">
  <label></label>
</span></p>
<p align="center"><span class="style12"></span><span class="style12">CONSULTAS</span></p>
<form id="form2" name="form2" method="post" action="">
  <label> </label>
  <table width="626" border="1" align="center">
    <tr>
      <th width="28" scope="col"><div align="center">
        <label>
        <input name="escoje" type="radio" value="porarticulo" checked="checked"  />
        </label>
      </div></th>
      <th width="185" scope="col"><div align="center"><span class="style12">Escribe el nombre del art&iacute;culo </span></div></th>
      <th width="385" colspan="2" scope="col"><div align="left"><span class="style12">
        <input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="60" />
      </span></div></th>
    </tr>
    <tr>
      <th scope="col"><label>
      <input name="escoje" type="radio" value="porcodigo" />
      </label></th>
      <th scope="col"><span class="style12">Escribe el c&oacute;digo </span></th>
      <th colspan="2" scope="col"><label>
        <div align="left">
          <input name="porcodigo" type="text" class="style12" id="porcodigo" />        
        </div>
      </label></th>
    </tr>
    <tr>
      <th scope="col"><input name="escoje" type="radio" value="poranaquel" /></th>
      <th class="style12" scope="col">Escoge el Anaquel y Estaci&oacute;n </th>
      <th class="style12 " scope="col"><div align="left">Estaci&oacute;n
        <select name="estacion" class="style12"  />
        
        
          <?
			$sqlNombre = "SELECT all distinct estacion From almacenes ORDER BY estacion ASC";
$resultaNombre=mysql_db_query("medsys",$sqlNombre);

			 if($_POST['codigo'] AND $myrow5['almacen']){ 
			 echo '<option>'.$myrow5['almacen'];
			 }
			

  while ($rNombre=mysql_fetch_array($resultaNombre)){ ?>
          <? echo '<option>'.$rNombre["estacion"];?>
          <? } ?>
          </select>
      </div>        <label></label></th>
      <th class="style12" scope="col">
        <label>
        <div align="left">#Anaquel
         
		 <?
		 $sqlNombre = "SELECT all distinct * From anaqueles ORDER BY anaquel ASC";
$resultaNombre=mysql_db_query("medsys",$sqlNombre);?>
		 
		  <select name="anaquel" class="style12"  />
          

<?			 if($_POST['codigo'] AND $myrow5['almacen']){ 
			 echo '<option>'.$myrow5['almacen'];
			 }
			

  while ($rNombre=mysql_fetch_array($resultaNombre)){ ?>
          <? echo '<option>'.$rNombre["anaquel"];?>
          <? } ?>
          </select>
        </div>
        </label>      </th>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th colspan="2" scope="col"><span class="style12">
        <input name="buscar" type="submit" class="style7" id="buscar" value="Buscar" />
      </span></th>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="modificaA.php">
 <input name="articulo1" type="hidden" id="articulo1" value="<? echo $_POST['nomArticulo']; ?>" />
 <?   $articulo = $_POST['nomArticulo'];

if($_POST['escoje'] =="porarticulo" ){
 $sSQL= "Select all distinct * From articulos WHERE descripcion LIKE '%$articulo%' order by descripcion ASC";
$result=mysql_db_query($basedatos,$sSQL);
} else if($_POST['escoje'] =="porcodigo"){
$sSQL= "Select all distinct * From articulos WHERE codigo = '".$_POST['porcodigo']."' order by descripcion ASC";
$result=mysql_db_query($basedatos,$sSQL);
$sSQL2= "Select all distinct existencias From existencias WHERE codigo = '".$_POST['porcodigo']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
} else if($_POST['escoje'] =="poranaquel"){
$sSQL= "SELECT 
  `articulos`.`codigo`,
  `articulos`.`descripcion`,
  `articulos`.`um`,
  `articulos`.`costo`,
  `articulos`.`pmax`,
  `articulos`.`reorden`,
  `articulos`.`pmin`,
  `articulos`.`precio`,
  `articulos`.`iva`,
  `existencias`.`codigo` AS `codigo1`,
  `existencias`.`existencias`,
  `existencias`.`fechaAjuste`,
  `existencias`.`usuario`,
  `existencias`.`almacen`,
  `existencias`.`tipoAjuste`,
  `existencias`.`Anaquel`
FROM
  `existencias`
  INNER JOIN `articulos` ON (`existencias`.`codigo` = `articulos`.`codigo`)
 WHERE almacen = '".$_POST['estacion']."'
AND Anaquel = '".$_POST['anaquel']."'";
$result=mysql_db_query($basedatos,$sSQL);

}

?>
<table width="809" border="1" align="center">
    <tr>
      <th width="110" bgcolor="#333333" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="459" bgcolor="#333333" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="20" bgcolor="#333333" scope="col"><span class="style11">UM</span></th>
      <th width="20" bgcolor="#333333" scope="col"><span class="style11">Costo</span></th>
      <th width="21" bgcolor="#333333" scope="col"><span class="style11">PMax</span></th>
      <th width="30" bgcolor="#333333" scope="col"><span class="style11">Reorden</span></th>
      <th width="52" bgcolor="#333333" scope="col"><span class="style11">PMin</span></th>
      <th width="45" bgcolor="#333333" scope="col"><span class="style11">Precio</span></th>
      <th width="45" bgcolor="#333333" scope="col"><span class="style11">Existencias</span></th>
    </tr>
    <tr>

<?	while($myrow = mysql_fetch_array($result)){
if($_POST['escoje'] =="porarticulo"){
$codigo7 = $myrow['codigo'];
$sSQL2= "Select all distinct existencias From existencias WHERE codigo = '".$codigo7."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7">
        <label>
        <input name="codigo" type="Submit" class="style12" value="<? echo $myrow['codigo'];?>" />
        </label>
      </span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['descripcion'];?></span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['um'];?></span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['costo'];?></span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['pmax'];?></span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['reorden'];?></span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['pmin'];?></span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['precio'];?></span></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? 
	  if($myrow2['existencias']){
	  echo $myrow2['existencias'];
	  } else {
	  echo "0";
	  
	  }
	  ?></span></td>
    </tr>

  <? }?>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    <label>
    <div align="center">
  </label>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<? } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/medsys/menuPrincipal.php">';
exit;

}
?>