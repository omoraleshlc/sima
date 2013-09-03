<?php include("/configuracion/conf.php"); ?>

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
<table width="544" border="1" align="center">
  <tr>
    <th width="91" scope="col"><form id="form3" name="form3" method="post" action="listaUsuarios.php">
      <label></label>
        <label>
        <input name="Submit2" type="submit" class="style12" value="Lista de Usuarios" />
        </label>
    </form>    </th>
    <th width="89" scope="col"><form id="form2" name="form2" method="post" action="modificaUsuarios.php">
      <label></label>
      <label></label>
      <label>
      <input name="Submit3" type="submit" class="style12" value="Alta de Usuarios" />
      </label>
    </form></th>
    <th width="59" scope="col"><form id="form7" name="form7" method="post" action="usuariosIP.php">
      <label>
      <input name="Submit7" type="submit" class="style12" value="Usuarios&lt;-&gt;IP" />
      </label>
        </form>
    </th>
    <th width="59" scope="col"><form id="form6" name="form6" method="post" action="usuariosAlmacen.php">
      <label>
      <input name="Submit6" type="submit" class="style12" value="Usuarios&lt;-&gt;Almac&eacute;n" />
      </label>
        </form>    </th>
    <th width="59" scope="col"><form id="form5" name="form5" method="post" action="usuariosModulos.php">
      <label>
      <input name="Submit5" type="submit" class="style12" value="Usuarios&lt;-&gt;M&oacute;dulos" />
      </label>
        </form>    </th>
    <th width="59" scope="col"><form id="form4" name="form4" method="post" action="catModulos.php">
      <label>
      <input name="Submit4" type="submit" class="style12" value="M&oacute;dulos" />
      </label>
        </form>    </th>
    <th width="82" scope="col"><form id="form1" name="form1" method="post" action="/medsys/menuPrincipal.php">
      <label>
      <input name="Submit" type="submit" class="style12" value="Menu Principal" />
      </label>
        </form>    </th>
  </tr>
</table>
<p align="center">&nbsp; </p>
</body>

</html>