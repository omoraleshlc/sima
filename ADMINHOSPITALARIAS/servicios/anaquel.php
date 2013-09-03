<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include('/configuracion/clases/validaModulos.php'); ?>
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
           
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, Escoje el Almacen!.")   
                return false   
        } else if(vacio(F.anaquel.value) == false ) {   
                alert("Por Favor, Escoje un Anaquel!.")   
                return false   
                 }   
           
}   
</script>
<?php

if($_POST['borrar'] AND $_POST['anaquel']){
$borrame = "DELETE FROM anaqueles WHERE
entidad='".$entidad."' AND
anaquel ='".$_POST['anaquel']."' AND almacen = '".$_POST['almacen']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">';?>
msgbox "SE ELIMINO EL ANAQUEL <?php echo $_POST['anaquel'];?>"
<?php echo '</script>';
}
if($_POST['nuevo']){
$_POST['anaquel'] = "";
$_POST['codigoRazon'] ="";
}
if($_POST['actualizar'] AND $_POST['almacen']){
$sSQL1= "Select * From anaqueles WHERE entidad='".$entidad."' AND anaquel = '".$_POST['anaquel']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['anaquel']){
if($_POST['anaquel']!=$myrow1['anaquel']){
$agrega = "INSERT INTO anaqueles (
almacen,anaquel,tipoAnaquel,activo,entidad
) values ('".$_POST['almacen']."','".$_POST['anaquel']."','".$_POST['tipoAnaquel']."',
'".$_POST['activo']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO EL ANAQUEL.."
</script>';
}} else {
 $q = "UPDATE anaqueles set 
almacen= '".$_POST['almacen']."', 
anaquel='".$_POST['anaquel']."', 
tipoAnaquel='".$_POST['tipoAnaquel']."'

WHERE entidad='".$entidad."'  AND
anaquel='".$_POST['anaquel']."' AND almacen= '".$_POST['almacen']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO EL ANAQUEL.."
</script>';
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>

</head>

<body>

<h1 align="center" class="titulos">Anaqueles</h1>
<form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);">
<table width="647" height="104" border="0" align="center" class="blanco">

    <tr>
      <td width="1" rowspan="4" bgcolor="#FFCCFF"><div align="left"></div>        
      <div align="left"></div>        <div align="left"></div></td>
      <td width="102" bgcolor="#660066"><div align="left" class="style13">Almac&eacute;n</div></td>
      <td colspan="2" bgcolor="#FFCCFF"><div align="left">
          <label><span class="style7">
          <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'combos',$almacen,$almacenDestino,$basedatos);
?>
          </span></label>
      </div></td>
    </tr>
    <tr>
	
	<?php 
	if($_POST['almacen1']){
	$sSQL= "SELECT 
*
FROM
  `anaqueles`
  INNER JOIN `tipoAnaqueles` ON (`anaqueles`.`tipoAnaquel` = `tipoAnaqueles`.`codigoAnaquel`)
 WHERE entidad='".$entidad."' and anaquel = '".$_POST['almacen1']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
	
	
	
	}
	?>
      <td bgcolor="#660066"><span class="blancos">Anaquel</span></td>
      <td colspan="2"><input name="anaquel" type="text" class="campos" id="anaquel" value="<?php 
	  if(!$_POST['borrar']){
	  if($myrow['anaquel']){
	  echo $myrow['anaquel']; 
	  } else {
	  echo $_POST['anaquel'];
	  }}else{
	  echo "";
	  }
	  ?>" />        <a href="tipoAnaquel.php"></a></td>
    </tr>
    <tr>
      <td bgcolor="#660066"><div align="left" class="style13">Tipo de Anaquel </div></td>
      <td width="431" bgcolor="#FFCCFF"><div align="left">

	  <?php
$aCombo3= "Select * From tipoAnaqueles where entidad='".$entidad."' ORDER BY tipoAnaquel ASC ";
$rCombo3=mysql_db_query($basedatos,$aCombo3); 
$anaquel=$myrow['anaquel'];
$sSQL11= "SELECT 
 *
FROM
  anaqueles
  WHERE 
  entidad='".$entidad."' 
  AND
  anaquel='".$anaquel."'
  ";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$tipoAnaquel=$myrow11['tipoAnaquel'];
$sSQL12= "SELECT 
 *
FROM
  tipoAnaqueles
  WHERE 
  codigoAnaquel='".$tipoAnaquel."'
  ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


?>
          <select name="tipoAnaquel" class="combos" id="tipoAnaquel" />          
       
			<option value="1">ESCOJE EL TIPO DE ANAQUEL</option>
           <?php while($resCombo3 = mysql_fetch_array($rCombo3)){ ?>
		    <option
			<?php if($myrow12['codigoAnaquel']==$resCombo3['codigoAnaquel']) { ?>
			selected="selected"
			<?php } ?>
			 value="<?php echo $resCombo3['codigoAnaquel']; ?>">
	<?php echo $resCombo3['tipoAnaquel']." || ".$resCombo3['codigoAnaquel']; ?></option>
          <?php } ?>
          </select>
	  
	  </div></td>
      <td width="85" bgcolor="#FFCCFF"><a href="tipoAnaquel.php">Editar Anaquel </a></td>
    </tr>
    <tr>
      <td height="14" colspan="3" bgcolor="#FFFFFF"><div align="left">
        <p>&nbsp;          </p>
          <p align="center">
            <input name="actualizar" type="submit" class="botones" id="actualizar" value="Grabar/Actualizar" />
            <input name="buscar" type="submit" class="botones" id="buscar" value="Buscar" />
            <input name="nuevo" type="submit" class="botones" id="nuevo" value="Nuevo" />
            <input name="borrar" type="submit" class="botones" id="borrar" value="Borrar" />
            </p>
      </div></td>
    </tr>
    <tr>
      <td height="14" colspan="4" bgcolor="#FFCCFF">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<form id="form2" name="form2" method="post" action="">
  <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen']; ?>" />
  <table width="351" border="0" align="center">
    <tr>
      <th width="99" bgcolor="#660066" scope="col"><span class="blanco"># Anaquel </span></th>
      <th width="188" bgcolor="#660066" scope="col"><span class="blanco">Tipo de Anaquel </span></th>
      <th width="42" bgcolor="#660066" scope="col"><span class="blanco">Activo</span></th>
    </tr>
    <tr>
      <?php	
	  


 $sSQL1= "Select * From anaqueles WHERE almacen = '".$_POST['almacen']."' order by almacen ASC";
$result1=mysql_db_query($basedatos,$sSQL1); 
echo mysql_error();
 

while($myrow1 = mysql_fetch_array($result1)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow1['anaquel'];
$tipoAnaquel=$myrow1['tipoAnaquel'];
$sSQL12= "SELECT 
 *
FROM
  tipoAnaqueles
  WHERE 
  codigoAnaquel='".$tipoAnaquel."'
  ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
?>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label>
        <input name="almacen1" type="submit" class="style12" value="<?php echo $A?>"/>
        </label>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php 
	  if($myrow12['tipoAnaquel']){
	  echo $myrow12['tipoAnaquel'];
	  } else {
	  echo "---";
	  }
	  ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <?php echo $myrow1['activo'];?></span></td>
    </tr>
    <?php }?>
  </table>
</form>
<p align="center">&nbsp;</p>
</body>
</html>