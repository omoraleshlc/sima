<?php require("/configuracion/ventanasEmergentes.php"); ?>

<?php 






$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('ACCESANDO EL SISTEMA','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

if(eregi('Blackberry',$_SERVER["HTTP_USER_AGENT"])){
$url='http://hlc.um.edu.mx/sima/movil/principal.php/';
	return header("location: $url");
	//require("/configuracion/MenuPrincipal/menup.php"); 
	} else {
	//require("/configuracion/MenuPrincipal/menup.php");
        require("/configuracion/MenuPrincipal/menuPrincipal.php");    
	require("/configuracion/MenuPrincipal/menuAyuda.php");

}
//***************************************************
?>
<link rel="shortcut icon" type="imagenes/x-icon" href="imagenes/favicon.ico">


<style type="text/css">
<!--

body {
	background-attachment: fixed;
	background-repeat: no-repeat;
	background-position: center center;
}
-->
</style>
