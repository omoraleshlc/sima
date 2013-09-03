<?php session_start();
$llavePrimaria = session_id();
?>
<?php require('basedatos.php'); ?>
<?php
$db_conn = ocilogon("system", "hospital","//127.0.0.1/XE");
?>
<?php 

//*****************************BANNERS***********************************/
$sqlNombre110 = "SELECT * From anuncios order by keyAnuncio DESC
";
$resultaNombre110=mysql_db_query($basedatos,$sqlNombre110);
$rNombre110=mysql_fetch_array($resultaNombre110);
$USER=$rNombre110['usuario'];
/* $cmdstr5 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$USER."' AND STATUS='A'
";
$parsed5 = ociparse($db_conn, $cmdstr5);
ociexecute($parsed5);	 
$nrows5 = ocifetchstatement($parsed5,$resulta5);
for ($i = 0; $i < $nrows5; $i++ ){
$persona = $resulta5['NOMBRE'][$i]." ".$resulta5['AP_PATERNO'][$i]." ".$resulta5['AP_MATERNO'][$i];
} */

echo '<marquee>';
echo $rNombre110['anuncio']." Lo envia: ".$USER;
echo '</marquee>'; 

//***********************************************************************

$dia=date("l");
$hora1 = date("H:i a");
$fecha1 = date("Y-m-d");
$ip3 = "SELECT *
FROM
  `sesiones`
 WHERE
llave = '".$llavePrimaria."'";
$resultIP3=mysql_db_query($basedatos,$ip3);
$ipRes3 = mysql_fetch_array($resultIP3);
echo mysql_error();
$usuario = $ipRes3['usuario'];
$llave = $ipRes3['llave'];
$ip=$_SERVER[REMOTE_ADDR];

$cmdstr4 = "select * from MATEO.CONT_FOLIO WHERE LOGIN = '".$usuario."' ORDER BY ID_EJERCICIO DESC";
$parsed4 = ociparse($db_conn, $cmdstr4);
ociexecute($parsed4);	 
$nrows4 = ocifetchstatement($parsed4,$resulta4);

for ($i = 0; $i < $nrows4; $i++ ){
$ID_EJERCICIOM = $resulta4['ID_EJERCICIO'][$i];
$ID_USUARIOM= $resulta4['USER_ID'][$i];
}
$ID_EJERCICIOM='001-2008';
$ID_CCOSTOM='4.01';
//********************COMIENZAN VALIDACIONES***********************************
if(!$usuario AND !isset($_POST['username']) AND !isset($_POST['password']) AND !isset($_POST['ingresar'])){
 echo '<META HTTP-EQUIV="Refresh"
     CONTENT="0; URL=/sima/index.php">';
exit;  

}

if(!$usuario){
//encriptar
$crypt=$_POST['password'];
$_POST['password'] = md5($_POST['password']);

if (isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['ingresar'])) {
$cmdstr3 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$_POST['username']."' AND PASSWORD1 = '".$_POST['password']."'
AND STATUS='A'
";
$parsed3 = ociparse($db_conn, $cmdstr3);
ociexecute($parsed3);	 
$nrows3 = ocifetchstatement($parsed3,$resulta3);
for ($i = 0; $i < $nrows3; $i++ ){
$user = $resulta3['LOGIN'][$i];
$passwd= $resulta3['PASSWORD1'][$i];
}




if($user ==$_POST['username'] AND $passwd==$_POST['password']){
//agregar sesiones
session_destroy();
session_start(); 
$llave = session_id(); 
$agregaIP = "INSERT INTO sesiones ( 
usuario,ip,llave
) values ('".$user."','".$ip."','".$llave."')";
mysql_db_query($basedatos,$agregaIP);
echo mysql_error();
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=">';
exit; 
} else {
$agregaIP = "INSERT INTO usuariosIntentando ( 
usuario,password,fecha,hora,ip
) values ('".$_POST['username']."','".$crypt."','".$fecha1."','".$hora1."','".$ip."')";
mysql_db_query($basedatos,$agregaIP);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "USUARIO NO VALIDO !" 
</script>'; 
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/index.php">';
exit; 
} 
} else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/index.php">';
exit;  
}}
//************************** TERMINAN LAS VALIDACIONES **************************************
?>
<?php
//***********************FUNCIONES********************************
function nivel($precio,$seguro){ //**saco clientes, abro funcion nivel
$level = "SELECT * 
FROM
clientes
 WHERE
numCliente = '".$seguro."'";
$levelArray=mysql_db_query('sima',$level);
$push = mysql_fetch_array($levelArray);
echo mysql_error();
$nivel=$push['nivel'];
//****************************************** Saco nivel
$level1 = "SELECT *
FROM
niveles
 WHERE
numNivel = '".$nivel."'";
$levelArray1=mysql_db_query('sima',$level1);
$push1 = mysql_fetch_array($levelArray1);
$porcentaje=$push1['porcentaje'];
$sacoPor=($porcentaje/100)*$precio;

if($push1['signo']=='-'){
$total=$precio-$sacoPor;
} else if($push1['signo']=='+'){
$total=$precio+$sacoPor;
}
return $total;
} //cierro funcion nivel

//****************************************************************
?>
<script type="text/javascript"  src="stmenu.js"></script>
<script type="text/javascript">
<!--
window.onerror=function(m,u,l)
{
	window.status = "Java Script Error: "+m;
	return true;
}
//-->
</script>
<style type="text/css">
<!--
.style2 {
	color: #0000FF;
	font-weight: bold;
	font-size: 9px;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="5" topmargin="5">
<center>
<p>

  <script type="text/javascript">
<!--
stm_bm(["menu0129",810,"","blank.gif",0,"","",0,0,0,0,1000,1,0,0,"","",0,0,1,1,"default","hand","/Menu2"],this);
stm_bp("p0",[0,4,0,0,3,3,7,9,100,"",-2,"",-2,90,0,0,"#000000","#7a8c9e","",0,0,0,"#CCCCCC"]);
//----------CONVENIOS-----------
<?php
$modulo1b = 'menu.conv';
$checaModuloScript1b= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo1b."'";
$resScript1b=mysql_db_query($basedatos,$checaModuloScript1b);
$resulScripModulo1b = mysql_fetch_array($resScript1b);
echo mysql_error();
$modulo1x=$resulScripModulo1b['modulo'];
if(trim($modulo1x)==$modulo1b){
?>
stm_aix("p0i2","p0i1",[0,"Convenios","","",-1,-1,0,"","_self","","","icon_10a.gif","icon_10b.gif",7,13,0,"0604arroldw.gif","0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial"],70,30);
stm_bpx("p3","p2",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p3i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

<?php /* 
$modulo19 = 'listaConvenios.conv';
$checaModuloScript19= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo19."'";
$resScript19=mysql_db_query($basedatos,$checaModuloScript19);
$resulScripModulo19 = mysql_fetch_array($resScript19);
echo mysql_error();
$modulo39=$resulScripModulo19['modulo'];
if(trim($modulo39)==$modulo19){
?>
stm_aix("p3i5","p2i2",[0," Convenios Globales","","",-1,-1,0,"/sima/convenios/conveniosGenerales.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],178,22);
<?php }  */?>
<?php /* 
$modulo19 = 'listaConvenios.conv';
$checaModuloScript19= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo19."'";
$resScript19=mysql_db_query($basedatos,$checaModuloScript19);
$resulScripModulo19 = mysql_fetch_array($resScript19);
echo mysql_error();
$modulo39=$resulScripModulo19['modulo'];
if(trim($modulo39)==$modulo19){
?>
stm_aix("p3i6","p2i2",[0," Convenios x GP","","",-1,-1,0,"/sima/convenios/altaConvenios2.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],178,22);
<?php } */ ?>

<?php
$modulo19 = 'listaConvenios.conv';
$checaModuloScript19= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo19."'";
$resScript19=mysql_db_query($basedatos,$checaModuloScript19);
$resulScripModulo19 = mysql_fetch_array($resScript19);
echo mysql_error();
$modulo39=$resulScripModulo19['modulo'];
if(trim($modulo39)==$modulo19){
?>
stm_aix("p3i6","p2i2",[0," Convenios x GP","","",-1,-1,0,"/sima/convenios/convenioxGP.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],178,22);

stm_aix("p3i6","p2i2",[0," Convenios x Art","","",-1,-1,0,"/sima/convenios/convenioxArticulos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],178,22);

<?php } ?>


<?php /* 
$modulo19 = 'listaConvenios.conv';
$checaModuloScript19= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo19."'";
$resScript19=mysql_db_query($basedatos,$checaModuloScript19);
$resulScripModulo19 = mysql_fetch_array($resScript19);
echo mysql_error();
$modulo39=$resulScripModulo19['modulo'];
if(trim($modulo39)==$modulo19){
?>
stm_aix("p3i7","p2i2",[0," Clientes <-> Precios","","",-1,-1,0,"/sima/convenios/clientesPrecios.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],178,22);
<?php } */ ?>


stm_ep();
<?php } ?>
//-**************FIN DE CONVENIOS*********************-
//----------CAJA-----------
<?php
$modulo2b = 'menu.caja';
$checaModuloScript2b= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo2b."'";
$resScript2b=mysql_db_query($basedatos,$checaModuloScript2b);
$resulScripModulo2b = mysql_fetch_array($resScript2b);
echo mysql_error();
$modulo2x=$resulScripModulo2b['modulo'];
if(trim($modulo2x)==$modulo2b){
?>
stm_aix("p0i3","p0i1",[0,"Caja","","",-1,-1,0,"","_self","","","icon_10a.gif","icon_10b.gif",7,13,0,"0604arroldw.gif","0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial"],52,30);
stm_bpx("p4","p2",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p4i0","p1i0",[6,1,"#50647f","",-1,-1,0]);
<?php
$modulo1a = 'listaOrdenes.caja';
$checaModuloScript1a= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo1a."'";
$resScript1a=mysql_db_query($basedatos,$checaModuloScript1a);
$resulScripModulo1a = mysql_fetch_array($resScript1a);
echo mysql_error();
$modulo40=$resulScripModulo1a['modulo'];
if(trim($modulo40)==$modulo1a){
?>
stm_aix("p4i1","p2i2",[0," Listado de Ordenes (P. Internos)","","",-1,-1,0,"/sima/caja/listaOrdenesInternos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],199,22);
stm_aix("p4i2","p2i2",[0," Listado de Ordenes (P.Ambulatorios)","","",-1,-1,0,"/sima/caja/listaOrdenes.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],199,22);
stm_aix("p4i3","p2i2",[0," Pagos, Anticipos,etc.","","",-1,-1,0,"/sima/caja/pagosAnticipos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],199,22);
<?php } ?>
<?php
$modulo3a = 'CrgCnPac.caja';
$checaModuloScript3a= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo3a."'";
$resScript3a=mysql_db_query($basedatos,$checaModuloScript3a);
$resulScripModulo3a = mysql_fetch_array($resScript3a);
echo mysql_error();
$modulo42=$resulScripModulo3a['modulo'];
if(trim($modulo42)==$modulo3a){
?>
stm_aix("p4i3","p2i2",[0," Corte de Caja","","",-1,-1,0,"/sima/caja/corteCaja.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],199,22);
<?php } ?>
<?php
$modulo4a = 'AplicPag.caja';
$checaModuloScript4a= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo ='".$modulo4a."'";
$resScript4a=mysql_db_query($basedatos,$checaModuloScript4a);
$resulScripModulo4a = mysql_fetch_array($resScript4a);
echo mysql_error();
$modulo43=$resulScripModulo4a['modulo'];
if(trim($modulo43)==$modulo4a){
?>
stm_aix("p4i4","p2i2",[0," Apertura de Caja","","",-1,-1,0,"/sima/caja/aperturaCaja.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],199,22);
<?php } ?>
stm_ep();
<?php } ?>

//-**************FIN DE CAJA*********************-
//*************************************************SALIR***********************************
stm_ai("p0i9",[0,"SALIR","","",-1,-1,0,"","_self","","","icon_10a.gif","icon_10b.gif",7,13,0,"0604arroldw.gif","0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bp("p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_ai("p1i0",[6,1,"#50647f","",-1,-1,0]);
stm_aix("p10i1","p6i0",[0," Menú principal","","",-1,-1,0,"/sima/menuPrincipal2.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);
stm_aix("p10i2","p2i2",[0," SALIR","","",-1,-1,0,"/sima/salir.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

//************************************************************ CErrar SalIr **************************
stm_ep();
stm_em();

//-->
</script>
</center>
</body>
</html>