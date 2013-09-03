<?php require('/configuracion/baseDatos.php');?><?php require('/configuracion/clases/valida.php');?>
<?php require("/configuracion/clases/desbloquea.php"); ?>
<?php 
$servidor= $_SERVER['SERVER_NAME'];
?>
<?php 
$ip=$_SERVER["REMOTE_ADDR"];
$intranet=substr($ip, 0,2); 
//actualizar ******************************************************************************************************
$hora1=validator::hora1();
$fecha1=validator::fecha1();
$basedatos=MYSQL::basedatos();$conecta=MYSQL::conecta();
$sSQL1= "Select * From usuarios WHERE entidad='".$entidad."' and usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$agregaIP = "INSERT INTO usuariosIntentando ( 
usuario,password,fecha,hora,ip
) values ('".$username."','".$crypt."','".$fecha1."','".$hora1."','".$ip."')";
mysql_db_query($basedatos,$agregaIP);
echo mysql_error();




if($_POST['usuario'] AND $_POST['send']){

    $server=$_SERVER['HTTP_HOST'].'/sima/index.php';
    $unblock=new desbloquea();
$unblock->unblock($fecha1,$hora1,$_POST['usuario'],$basedatos);
echo "Se solicito desbloquear";





?>
<script>
window.location = "http://<?php echo $server;?>";
//window.close();
</script>
<?php 
}
?>


<script type="text/javascript">
  function validateCode(){
      var TCode = document.getElementById('usuario').value;
      for(var i=0; i<TCode.length; i++)
      {
        var char1 = TCode.charAt(i);
        var cc = char1.charCodeAt(0);

        if((cc>47 && cc<58) || (cc>64 && cc<91) || (cc>96 && cc<123))
        {

        }
         else {
         alert('Caracteres no permitidos!');
         return false;
         }
      }
     return true;     
   }
</script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.Estilo24 {font-size: 10px}
.style15 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #666666;
}
.style16 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style17 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #330066;
}
body {
	background-image: url(../imagenes/imagenesModulos/screen_unlock.jpg);
	background-repeat: no-repeat;
	background-attachment:fixed;
	background-position:center top;
}
-->
</style>
</head>

<body>
<p align="center">
  <label></label>
</p>

<form name="form1"  method="post" onSubmit="return validateCode(this);">
  <p>&nbsp;</p>
  <table width="309" border="0" align="center" class="style12">

    <tr>
      <th colspan="2" scope="col"><p><span class="style15">Escribe tu nombre de usuario para desbloquear</span></p>      </th>
    </tr>
    <tr>
      <th width="126" scope="col"><div align="left" class="style16">
        <div align="right">Usuario </div>
      </div></th>
      <th width="173" scope="col"><label> </label>
          <div align="left">
            <input name="usuario" type="password" class="style12" id="usuario"/>
      </div></th>
    </tr>
    <tr>
      <th colspan="2" scope="col"><img src="../imagenes/desbloqueo.png" width="81" height="82"></th>
    </tr>
  </table>
  <p align="center"><input name="send" type="submit" class="style12" id="send" value="Enviar Petici&oacute;n" />
    <label>    </label>
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
