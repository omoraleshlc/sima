<? include("/configuracion/conf.php"); ?>
<?
$modulo = 'menu.cdc';
$checaModuloScript= "Select all distinct * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo LIKE '%$modulo%'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="250" border="1" align="center">
  <tr>
    <th scope="col"><form id="form3" name="form3" method="post" action="listaCitas.php">
      <label></label>
        <label>
        <input name="Submit2" type="submit" class="style12" value="Lista de Citas" />
        </label>
    </form>    </th>
    <th scope="col"><form id="form4" name="form4" method="post" action="catalogoCitas.php">
      <label>
      <input name="Submit4" type="submit" class="style12" value="Cat&aacute;logo Citas" />
      </label>
        </form>    </th>
    <th scope="col"><form id="form5" name="form5" method="post" action="medicosCitas.php">
      <label>
      <input name="Submit5" type="submit" class="style12" value="Relaci&oacute;n M&eacute;dicos&lt;-&gt;Citas" />
      </label>
        </form>
    </th>
    <th scope="col"><form id="form2" name="form2" method="post" action="modificaCitas.php">
      <label></label>
      <label></label>
      <label>
      <input name="Submit3" type="submit" class="style12" value="Alta de Citas" />
      </label>
    </form></th>
    <th scope="col"><form id="form1" name="form1" method="post" action="/medsys/menuPrincipal.php">
      <label>
      <input name="Submit" type="submit" class="style12" value="Menu Principal" />
      </label>
        </form>    </th>
  </tr>
</table>
<p align="center">&nbsp; </p>
</body>

</html>
<? } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/medsys/menuPrincipal.php">';
exit;

}
?>