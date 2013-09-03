<?php require("/configuracion/ventanasEmergentes.php"); ?>




<?php 


//actualizar ******************************************************************************************************
$_POST['usuario']=$usuario;
if(!$_POST['usuario']){
$_POST['usuario']=$_GET['us'];
}
$sSQL1= "Select * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if($_POST['actualizar'] AND $_POST['pwd1'] AND $_POST['pwd2'] AND 
$_POST['usuario'] AND $_POST['nombre'] ){ 

if($_POST['usuario']){ 

if($_POST['pwd1']==$_POST['pwd2']){ //contrase�as iguales?
$password = $_POST['pwd2']; //asigno password
$password=md5($password);




//******************** INSERTAR Y ACTUALIZAR ************************************




if($myrow1['usuario']== $_POST['usuario']){
//echo "actualiza";
$q = "UPDATE usuarios set 
passwd='".$password."', 
nombre='".$_POST['nombre']."',
aPaterno='".$_POST['aPaterno']."', 
aMaterno='".$_POST['aMaterno']."',
ejercicio='".$_POST['ejercicio']."',

fecha='".$fecha1."'

WHERE 
usuario='".$_POST['usuario']."' 
";
mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda = "El usuario [".$_POST['usuario']."]  se actualiz�...";
} else {
$leyenda="Tus contrase�as no coinciden!";
} //cierro verificacion de passwords iguales
}

} else {

$leyenda="Te faltan campos por rellenar";
}



}
//****************************************************************************************************************************












$sSQL1= "Select * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<p align="center">
  <label>Datos del Usuario <?php echo $usuario; ?></label>
</p>
<p align="center"><a href="/sima/MenuIndex.php">Regresar a Men&uacute; </a></p>
<form name="form1" id="form1" method="post" action="">
  <table width="519" >
    <tr>
      <th  scope="col">&nbsp;</th>
      <th  scope="col">&nbsp;</th>
    </tr>
    <tr>
      <td colspan="2" scope="col"><?php echo '<blink>'.$leyenda.'</blink>';?></td>
    </tr>
    <tr>
      <td width="152" scope="col"><div align="left">Nombre</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="nombre" type="text" class="style12" id="nombre" value="<?php echo $myrow1['nombre']; ?>" readonly=""/>
        </div></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Apellido Paterno </div></d>
      <td scope="col"><div align="left">
          <input name="aPaterno" type="text" class="style12" id="aPaterno" value="<?php echo $myrow1['aPaterno']; ?>" readonly=""/>
      </div></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Apellido Materno</div></td>
      <td scope="col"><div align="left">
          <input name="aMaterno" type="text" class="style12" id="aMaterno" value="<?php echo $myrow1['aMaterno']; ?>" readonly=""/>
      </div></td>
    </tr>
    <tr>
      <th  scope="col">&nbsp;</th>
      <th  scope="col">&nbsp;</th>
    </tr>
    <tr>
      <td scope="col"><div align="left">Passwd:</div></td>
      <td scope="col"><div align="left">
          <input name="pwd1" type="password" class="style12" id="pwd1" 
		value="<?php echo $myrow1['passwd']; ?>"/>
      </div></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Confirmar Passwd </div></th>
      <td scope="col"><div align="left">
          <input name="pwd2" type="password" class="style12" id="pwd2" value="<?php echo $myrow1['passwd']; ?>" />
      </div></td>
    </tr>
  </table>
  <p align="center">
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar Datos" />
    <label>    </label>
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
