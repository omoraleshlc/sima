<?PHP require("menuOperaciones.php"); ?>
<?php
if($_POST['borrar'] AND $_POST['codigoAnaquel']){
$borrame = "DELETE FROM tipoAnaqueles WHERE entidad='".$entidad."' and  codigoAnaquel ='".$_POST['codigoAnaquel']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se elimino el anaquel!';
}


if($_POST['nuevo']){
$_POST['codigoAnaquel'] = "";
$_POST['codigoRazon'] ="";
}


if($_POST['actualizar'] AND $_POST['codigoAnaquel']){
$sSQL1= "Select * From tipoAnaqueles WHERE entidad='".$entidad."' and codigoAnaquel = '".$_POST['codigoAnaquel']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoAnaquel']){
if($_POST['codigoAnaquel']!=$myrow1['codigoAnaquel']){

$agrega = "INSERT INTO tipoAnaqueles (
codigoAnaquel,tipoAnaquel,entidad
) values ('".$_POST['codigoAnaquel']."','".$_POST['clasificaAnaquel']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Anaquel agregado!';
}} else {
 $q = "UPDATE tipoAnaqueles set 
codigoAnaquel= '".$_POST['codigoAnaquel']."', 
tipoAnaquel='".$_POST['clasificaAnaquel']."'
WHERE 
entidad='".$entidad."'
    and
codigoAnaquel='".$_POST['codigoAnaquel']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Anaquel actualizado!';
}
}




?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<p align="center">
   
       
   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>       
       
   
</p>
<form id="form1" name="form1" method="post" action="">

  <table width="545" height="189" class="table-forma">

    <tr>

      <th colspan="3" align="center" >                        
          <p align="center">Tipos de Anaqueles</p></th>
    </tr>
    <tr>
      <td width="1" height="28" ><div align="left"></div></td>
      <td width="118" ><div align="left"><span>C&oacute;digo del Anaquel</span> </div></td>
      <td width="412" ><div align="left">
          <label>
		  <?php $aCombo= "Select * From tipoAnaqueles where codigoAnaquel = '".$_POST['tipoAnaquel1']."'";
$rCombo=mysql_db_query($basedatos,$aCombo); 
$imprimeTipo = mysql_fetch_array($rCombo);

?></select>
          </label>
          <label>
<input name="codigoAnaquel" type="text"  size="3" value="
<?php if($_POST['tipoAnaquel1'] AND $imprimeTipo['codigoAnaquel']){
		  
		  echo $imprimeTipo['codigoAnaquel'];
		  }
		  ?>" />
          </label>
</div></td>
    </tr>
    <tr>
	
      <td height="33">&nbsp;</td>
      <td >Anaquel</td>
      <td ><input name="clasificaAnaquel" type="text"  id="clasificaAnaquel" value="<?php if($_POST['tipoAnaquel1'] AND $imprimeTipo['codigoAnaquel']){
		  echo "$paso";
		  echo $imprimeTipo['tipoAnaquel'];
		  }
		  ?>" size="60" /></td>
    </tr>
    <tr>
      <td height="74" ><div align="left"></div></td>
      <td ><div align="left"><span></span></div></td>
      <td ><div align="left">
          <label>
          <div align="right">
            <label>
            <input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
            <input name="borrar" type="submit"  id="borrar" value="Borrar" />
            </label>
            <input name="actualizar" type="submit"  id="actualizar" value="Actualizar/Grabar" />
          </div>
        </label>
      </div></td>
    </tr>
    <tr >
      <td colspan="3"><div align="center" >
          <label>
          <input name="atras" type="submit"  id="atras" value="&lt;&lt;" />
          </label>
          <label>
          <input name="siguiente" type="submit"  id="siguiente" value="&gt;&gt;"/>
          </label>
      </div></td>
    </tr>
  </table>

<p align="center" ><a href="anaquel.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">Regresar a Anaqueles</a></p>
  <p>&nbsp;</p>
</form>
<p align="center">&nbsp;</p>
<form id="form2" name="form2" method="post" action="">
 
<table width="384" class="table table-striped">
    <tr>
      <th width="130" ><span ># Codigo Anaquel </span></th>
      <th width="238" >Clasificaci&oacute;n de Anaquel </th>
    </tr>
    <tr>
      <?php	
	  


 $sSQL1= "Select * From tipoAnaqueles where entidad='".$entidad."'  ORDER BY (codigoAnaquel+0) ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 
echo mysql_error();
 

while($myrow1 = mysql_fetch_array($result1)){
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow1['codigoAnaquel'];
?>
      <td >
        <label>
        <input name="tipoAnaquel1" type="submit"  value="<?php echo $C?>" />
        </label>
      </td>
      <td  ><?php echo $myrow1['tipoAnaquel'];?></td>
    </tr>
    <?php }?>
  </table>
 
</form>
<p align="center">&nbsp;</p>
</body>
</html>
