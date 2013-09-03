<?php include("/configuracion/ventanasEmergentes.php"); ?>





<?php 

if($_GET['usuario']){
$sSQL1= "delete From sesiones WHERE usuario='".$_GET['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
//echo mysql_error();
/* $sql= "update PEDRO.USUARIO 
set
status='I'
WHERE LOGIN = '".$_GET['usuario']."'";


$valida=ociparse($db_conn,$sql); // comprueba si el sql es valido
//OCIExecute ($valida); // ejecuta el sql validado 
OCICommit($db_conn); // hace commit */



echo "El usuario ".$_GET['usuario']." salió de sesión";
}
?>