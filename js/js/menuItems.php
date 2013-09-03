<script>
/***********************************************
* Omni Slide Menu script - © John Davenport Scheuer
* very freely adapted from Dynamic-FX Slide-In Menu (v 6.5) script- by maXimus
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full original source code
* as first mentioned in http://www.dynamicdrive.com/forums
* username:jscheuer1
***********************************************/

//One global variable to set, use true if you want the menus to reinit when the user changes text size (recommended):
resizereinit=true;

menu[1] = {
id:'menu1', //use unique quoted id (quoted) REQUIRED!!
fontsize:'100%', // express as percentage with the % sign
linkheight:22 ,  // linked horizontal cells height
hdingwidth:210 ,  // heading - non linked horizontal cells width
// Finished configuration. Use default values for all other settings for this particular menu (menu[1]) ///

menuItems:[ // REQUIRED!!
//[name, link, target, colspan, endrow?] - leave 'link' and 'target' blank to make a header
["OPERACIONES"], //create header


<?php //ingresos
$raiz='INGRESOS';
$checaModuloScript= "Select * From ModulosUsuarios1 WHERE 
raiz = '".$raiz."'
and
usuario = '".$usuario."'";
$resScript=pg_query($basedatos,$checaModuloScript);
$resulScripModulo = pg_fetch_array($resScript);
echo mysql_error();
if($resulScripModulo['usuario']){?>
["Ingresos", "http://www.dynamicdrive.com", ""],<?php } ?>
["Admin Hospitalaria", "http://www.dynamicdrive.com/new.htm",""],
["Departamentos", "http://www.dynamicdrive.com/hot.htm", ""],
["Expediente Clínico", "http://www.dynamicdrive.com/forums", ""],
["Reportes Financieros", "http://www.dynamicdrive.com/submitscript.htm", ""],
["Configuraciones", "http://www.dynamicdrive.com/submitscript.htm", ""]




]}; // REQUIRED!! do not edit or remove





////////////////////Stop Editing/////////////////

make_menus();
</script>