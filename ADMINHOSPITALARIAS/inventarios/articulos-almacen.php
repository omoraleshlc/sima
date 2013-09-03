<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
		alert("Sólo Se aceptan Números!")
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.nomArticulo.value) == false  && vacio(F.porCodigo.value) == false) {   
                alert("Escoje algún artículo a buscar!")   
                return false   
        } 
           
}   
  
  
  
  
</script> 
<?php $articulo = $_POST['nomArticulo']; ?>
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
.style13 {
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center">Asignar un almac&eacute;n al art&iacute;culo </p>
<form id="form2" name="form2" method="post" action="" onSubmit="return valida(this);"/>
  <table width="521" border="1" align="center">
    <tr>
      <th width="23" scope="col"><input name="escoje" type="radio" value="porarticulo" checked="checked" /></th>
      <th width="197" scope="col"><div align="center"><span class="style12">Escribe el nombre del art&iacute;culo </span></div></th>
      <th width="279" scope="col"><div align="left"><span class="style12">
          <input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="60" />
        </span></div>
          <span class="style12">
            </select>
          </span></th>
    </tr>
    <tr>
      <th scope="col"><input name="escoje" type="radio" value="porcodigo" /></th>
      <th scope="col"><span class="style12">Escribe el c&oacute;digo </span></th>
      <th scope="col"><div align="left">
          <input name="porcodigo" type="text" class="style12" id="porcodigo" />
        </div>
          </label></th>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col"><label>
          <div align="left">
            <input name="buscar" type="submit" class="style12" id="buscar" value="buscar" />
          </div>
        </label></th>
    </tr>
  </table>
</form><?php	
	  $articulo = $_POST['nomArticulo'];
if($_POST['buscar'] AND $_POST['nomArticulo']){
if($_POST['escoje'] =="porarticulo" ){
 
$sSQL= "
SELECT * FROM articulos

 WHERE descripcion LIKE '%$articulo%' 
 and
 um<>'s'
 order by descripcion ASC";

 } else if($_POST['escoje'] =="porcodigo"){
 $sSQL= "SELECT 
*
FROM
  `articulos`
  INNER JOIN `existencias` ON (`articulos`.`codigo` = `existencias`.`codigo`)

WHERE articulos.codigo = '".$_POST['porcodigo']."' 
 and
 um<>'s'
";
}
if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
<form id="form1" name="form1" method="post" action="articulos-almacen1.php">
  <p>&nbsp;</p>
  <table width="691" border="1" align="center">
    <tr>
      <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="317" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="46" bgcolor="#660066" scope="col"><span class="style11">Costo</span></th>
      <th width="49" bgcolor="#660066" scope="col"><span class="style11">M&iacute;nimos</span></th>
      <th width="49" bgcolor="#660066" scope="col"><span class="style11"> M&aacute;ximos</span></th>
      <th width="91" bgcolor="#660066" scope="col"><span class="style11">Precio al p&uacute;blico </span></th>
    </tr>
    <tr>

<?php
while($myrow = mysql_fetch_array($result)){
$code = $myrow['codigo'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);
  if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['codigo'];
?>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label>
        <input name="codigo" type="submit" class="style12" value="<?php echo $C?>" readonly=""/>
        </label>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descripcion']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow5['costo']){
	  echo number_format($myrow5['costo'],"2");
	  } else {
	  echo "N/A";
	  }
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow5['pmin']!=NULL){
	  echo number_format($myrow5['pmin'],"2");
	  } else {
	  echo "N/A";
	  }
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <label></label>
      
        <?php 
	  if($myrow5['pmax']){
	  echo number_format($myrow5['pmax'],"2");
	  } else {
	  echo "N/A";
	  }
	  ?>
</span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow5['precio']){
	  echo number_format($myrow5['precio'],"2");
	  } else {
	  echo "N/A";
	  }
	  ?>
      </span></td>
    </tr>
    <?php }}}?>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>