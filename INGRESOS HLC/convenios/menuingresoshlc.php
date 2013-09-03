<?php require("/configuracion/ventanasEmergentes.php"); ?>

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
$raiz='INGRESOS';
$secundario='CONVENIOS';
$checaModuloScript= "Select * From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
secundario='".$secundario."'
and
usuario = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i2","p0i1",[0,"Convenios","","",-1,-1,0,"","_self","","","icon_10a.gif","icon_10b.gif",7,13,0,"0604arroldw.gif","0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial"],70,30);
stm_bpx("p3","p2",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p3i0","p1i0",[6,1,"#50647f","",-1,-1,0]);


<?php 
$codModulo='CONVENIOS';
$codSM='CGP';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p3i6","p2i2",[0," Convenios x Grupo de Productos","","",-1,-1,0,"/sima/INGRESOS%20HLC/convenios/convenioxGP.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],178,22);
<?php } ?>

<?php 
$codModulo='CONVENIOS';
$codSM='CAP';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
and codSM = '".$codSM."' and 
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){ ?>
stm_aix("p3i6","p2i2",[0," Convenios x Articulos/Proc.","","",-1,-1,0,"/sima/INGRESOS%20HLC/convenios/convenioxArticulos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#7a8c9e",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],178,22);
<?php } ?>


stm_ep();<?php } ?>
//-**************FIN DE CONVENIOS*********************-



//----------CAJA-----------


<?php 
$codModulo='CAJA';
$codSM='Icaja';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE 
codModulo = '".$codModulo."'
and
codSM='".$codSM."'
and
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i9","p0i6",[0,"CAJA","","",-1,-1,0,"/sima/INGRESOS%20HLC/caja/","_self","","","icon_10a.gif","icon_10b.gif",7,13,0,"0604arroldw.gif","0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p9","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p9i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

//stm_aix("p9i1","p1i3",[0," Pacientes Ambulantorios","","",-1,-1,0,"resultadospacientesambulatorios.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);
//stm_aix("p9i2","p1i3",[0," Pacientes Internos","","",-1,-1,0,"resultadospacientesinternos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);
<!-------stm_aix("p2i3","p2i2",[0," Ajuste a Existencias"],158,22);

stm_ep();<?php } ?>
//----------CIERRA CAJA-----------



//-**************ABRE CXC*********************-


<?php 
$codModulo='CXC';
$codSM='ICxc';
$checaModuloScript= "Select * From usuariosSubmodulos WHERE 
codModulo = '".$codModulo."'
and
codSM='".$codSM."'
and
usuario1 = '".$usuario."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
stm_aix("p0i9","p0i6",[0," CXC","","",-1,-1,0,"/sima/INGRESOS%20HLC/cxc/","_self","","","icon_10a.gif","icon_10b.gif",7,13,0,"0604arroldw.gif","0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bpx("p9","p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_aix("p9i0","p1i0",[6,1,"#50647f","",-1,-1,0]);

//stm_aix("p9i1","p1i3",[0," Pacientes Ambulantorios","","",-1,-1,0,"resultadospacientesambulatorios.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);
//stm_aix("p9i2","p1i3",[0," Pacientes Internos","","",-1,-1,0,"resultadospacientesinternos.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],140,22);
<!-------stm_aix("p2i3","p2i2",[0," Ajuste a Existencias"],158,22);

stm_ep();<?php } ?>
//----------CIERRA CCXC-----------



//-**************FIN DE CCXC*********************-
//*************************************************SALIR***********************************
stm_ai("p0i9",[0,"SALIR","","",-1,-1,0,"","_self","","","icon_10a.gif","icon_10b.gif",7,13,0,"0604arroldw.gif","0604arroldw.gif",9,7,0,1,1,"#730270",0,"#730270",0,"","",0,0,0,0,"#009999","#50647f","#FFF480","#FFFF00","bold 8pt Arial","8pt Arial",0,0],52,30);
stm_bp("p1",[1,4,0,3,0,4,5,0,100,"",-2,"",-2,48,2,3,"#999999","transparent","",0,0,0,"#333333"]);
stm_ai("p1i0",[6,1,"#50647f","",-1,-1,0]);

stm_aix("p10i1","p6i0",[0," Menú principal","","",-1,-1,0,"/sima/MenuIndex.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);


stm_aix("p10i2","p2i2",[0," SALIR","","",-1,-1,0,"/sima/salir.php","_self","","","","",5,0,0,"","",0,0,0,0,1,"#FFD2FC",0,"#CCCCCC",1,"","fade.gif",3,3,0,0,"#7A8C9E","#CCCC00","#333333","#FFF480","7pt Verdana","7pt Verdana"],90,22);

//************************************************************ CErrar SalIr **************************
stm_ep();
stm_em();

//-->
</script>
</center>
</body>
</html>