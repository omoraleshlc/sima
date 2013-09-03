<? include("/configuracion/conf.php"); ?>
<?
$modulo = 'menu.inv';
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
    <th scope="col"><form id="form2" name="form2" method="post" action="catalogoAlmacen.php">
      <label>
        <input name="Submit2" type="submit" class="style12" value="Cat&aacute;logo de Almacenes" />
        </label>
    </form></th>
    <th width="56" scope="col"><form id="form3" name="form3" method="post" action="anaquel.php">
      <label>
      <input name="Submit4" type="submit" class="style12" value="Cat&aacute;logo de Anaqueles" />
      </label>
                </form>    </th>
    <th width="75" scope="col"><form id="form4" name="form4" method="post" action="existencias.php">
      <label>
      <input name="Submit3" type="submit" class="style12" value="Ajuste a Existencias" />
      </label>
        </form>    </th>
    <th width="75" scope="col"><form id="form5" name="form5" method="post" action="modificaA.php">
      <label>
      <input name="Submit5" type="submit" class="style12" value="Cat&aacute;logo de Art&iacute;culos" />
      </label>
        </form>    </th>
    <th width="75" scope="col"><form id="form11" name="form11" method="post" action="razones.php">
      <label>
      <input name="Submit10" type="submit" class="style12" value="Cat&aacute;logo de Razones" />
      </label>
        </form>    </th>
    <th width="75" scope="col"><form id="form8" name="form8" method="post" action="um.php">
      <label>
      <input name="Submit7" type="submit" class="style12" value="Cat&aacute;logo de Unidad Medida" />
      </label>
        </form>    </th>
    <th width="75" scope="col"><form id="form7" name="form7" method="post" action="gpoProductos.php">
      <label class="style12">
      <input name="Submit6" type="submit" class="style12" value="Cat&aacute;logo de Grupo Productos" />
      </label>
        </form>    </th>
    <th width="75" scope="col"><form id="form10" name="form10" method="post" action="articulos-anaquel.php">
      <label>
      <input name="Submit9" type="submit" class="style12" value="Art&iacute;culos&lt;-&gt;Anaquel" />
      </label>
        </form>    </th>
    <th width="75" scope="col"><form id="form9" name="form9" method="post" action="articulos-almacen.php">
      <label>
      <input name="Submit8" type="submit" class="style12" value="Articulos&lt;-&gt;Almac&eacute;n" />
      </label>
        </form>    </th>
    <th width="75" scope="col"><form id="form12" name="form12" method="post" action="aMasiva.php">
      <label>
      <input name="Submit11" type="submit" class="style12" value="Actualizaci&oacute;n masiva precios" />
      </label>
        </form>
    </th>
    <th width="75" scope="col"><form id="form6" name="form6" method="post" action="precios.php">
      <label>
      <input name="precios" type="submit" class="style12" id="precios" value="Lista de Precios" />
      </label>
        </form>    </th>
    <th width="75" scope="col"><form id="form1" name="form1" method="post" action="/medsys/menuPrincipal.php">
      <label>
      <input name="Submit" type="submit" class="style12" value="Men&uacute; Principal" />
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