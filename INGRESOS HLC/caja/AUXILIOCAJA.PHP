<?php

$hora = date("H:i a");


if($_POST['actualizar'] AND $_POST['numeroPoliza']){
$sSQL1= "Select * From aperturaCaja ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['numeroPoliza']){
$caja="enable";
$agrega = "INSERT INTO aperturaCaja ( numeroPoliza,
usuario,fecha,hora
) values (
'".$_POST['numeroPoliza']."',
'".$_POST['usuario']."',
'".$_POST['fecha']."',
'".$_POST['hora']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
apertura_caja();
} else {
caja_abierta();
$caja="disable";
}
}

if($_POST['borrar'] AND $_POST['numeroPoliza']){
$sSQL1= "Select * From aperturaCaja ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($myrow1['diario']=="diario"){
$borrame = "DELETE FROM aperturaCaja ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "CAJA CERRADA!"
</script>';
} else {
echo '<script type="text/vbscript">
msgbox "NO HAS IMPRESO EL DIARIO, ES NECESARIO PARA PODER REALIZAR TU CORTE!"
</script>';
}
}


if($_POST['imprime']){
$diario="diario";
$q = "UPDATE aperturaCaja set 
diario='".$diario."',
consecutivo='0'
WHERE 
usuario='".$usuario."' 
";
//mysql_db_query($basedatos,$q);
echo mysql_error();
}

//**********************MANDAMOS TODO A ORACLE
if($_POST['generaPoliza'] ){

function cambia_a_mysql($fecha){ 
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
    return $lafecha; 
} 
$fecha=$_POST['fecha'];


//********traigo centro de costos y libro*********
//********* traigo poliza
$sSQLC= "Select * From aperturaCaja ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

$polizaActual=$myrowC['numeroPoliza'];
//*********************************
//********traigo centro de costos y libro*********
//********* traigo poliza
$sSQLC= "Select * From aperturaCaja ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

$polizaActual=$myrowC['numeroPoliza'];
//*********************************

 
$sSQL19= "SELECT *
  FROM
almacenes 
WHERE almacen ='".$_POST['almacen']."'
 ";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19 = mysql_fetch_array($result19);

$sSQL19= "SELECT *
  FROM
almacenes 
WHERE almacen ='".$_POST['almacen']."'
 ";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19 = mysql_fetch_array($result19);

//****************cierro centro de costos y libro**
//***********************traigo todos los centros de costos
$cmdstr4 = "select * from MATEO.CONT_CCOSTO WHERE ID_EJERCICIO = '".$ID_EJERCICIOM."' 
AND DETALLE='S'
AND ID_CCOSTO LIKE '$ID_CCOSTOM%'

ORDER BY NOMBRE ASC";
$parsed4 = ociparse($db_conn, $cmdstr4);
ociexecute($parsed4);	 
$nrows4 = ocifetchstatement($parsed4,$resulta4);

for ($i = 0; $i < $nrows4; $i++ ){
$ID_CCOSTO = $resulta4['ID_CCOSTO'][$i];
$DESCRIPCION=$resulta4['NOMBRE'][$i];
$sSQL200= "SELECT *
  FROM
clientesAmbulatorios 
WHERE ID_CCOSTO ='".$ID_CCOSTO."'
 ";
$result200=mysql_db_query($basedatos,$sSQL200);
$myrow200 = mysql_fetch_array($result200);

if($myrow200['ID_CCOSTO']){
$ID_CCOSTO1=$myrow200['ID_CCOSTO'];
//******************************************SACAR MAXIMOS99999999999999999999
$sSQL2= "SELECT SUM(abonos) AS TOTAL
  FROM
clientesAmbulatorios 
WHERE ID_CCOSTO ='".$ID_CCOSTO1."'
and
poliza ='".$polizaActual."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
 echo '<br>';
echo "Centro de Costo: ".$ID_CCOSTO1." ".$DESCRIPCION." -> Total: ".$myrow2['TOTAL'];
echo '<br>';

//CIERRO SACAR MAXIMO

 


$sSQL201= "SELECT *
  FROM
clientesAmbulatorios,cargosAmbulatoriosP 
WHERE 

clientesAmbulatorios.poliza ='".$polizaActual."' AND
clientesAmbulatorios.numeroE=cargosAmbulatoriosP.numeroE

 ";
$result201=mysql_db_query($basedatos,$sSQL201);
while($myrow201 = mysql_fetch_array($result201)){
$ctaMayor=$myrow201['ctaMayor'];
//************************SACO CTA MAYOR Y DESCRIPCION
$cmdstr5 = "select * from MATEO.CONT_CTAMAYOR WHERE ID_EJERCICIO = '".$ID_EJERCICIOM."' 
AND ID_CTAMAYOR ='".$ctaMayor."' AND TIPO_CUENTA='R'

ORDER BY NOMBRE ASC";
$parsed5 = ociparse($db_conn, $cmdstr5);
ociexecute($parsed5);	 
$nrows5 = ocifetchstatement($parsed5,$resulta5);

for ($ir = 0; $ir < $nrows5; $ir++ ){
$ID_CTAMAYOR = $resulta5['ID_CTAMAYOR'][$ir];
$DESCRIBE=$resulta5['NOMBRE'][$ir];
//echo $ID_CTAMAYOR." ".$DESCRIBE.'<br>';
}
//*/**************************CIERRO**********************
$ID_CCOSTO=$myrow201['ID_CCOSTO'];
if($myrow201['ID_CCOSTO']){
 $inserta = "insert into mateo.cont_movimiento
(id_ejercicio, id_libro, id_ccosto, folio, nummovto, fecha, descripcion,
importe, naturaleza, referencia, referencia2, id_Ctamayorm, id_ccostom,
id_auxiliarm, status, id_ejerciciom, id_ejerciciom2, id_ejerciciom3, 
tipo_cuenta, id_ejercicio2) 
values 
('".$ID_EJERCICIOM."', '20','".$ID_CCOSTO1."', '".$polizaActual."',
'12', to_date('18/01/2008','dd/mm/yy'), 
'".$DESCRIBE."', '".$IMPORTE."', 'C', null, null, 
'2.1.01.08', '4.01', '9810120', 'A', '".$ID_EJERCICIOM."', 
'".$ID_EJERCICIOM."', '".$ID_EJERCICIOM."', 'R', '".$ID_EJERCICIOM."')";
}}
//OCIExecute($inserta, OCI_DEFAULT);

//echo $inserta.'<br>';
}
}
/*$s = OCIParse($db_conn, "insert into mateo.cont_movimiento
(id_ejercicio, id_libro, id_ccosto, folio, nummovto, fecha, descripcion, importe, naturaleza, referencia, referencia2, id_Ctamayorm, id_ccostom, id_auxiliarm, status, id_ejerciciom, id_ejerciciom2, id_ejerciciom3, tipo_cuenta, id_ejercicio2)
values
('001-2007', '20', '4.01', '88888', '7', to_date('01/12/2007','dd/mm/yy'), 'hospital', 200, 'C', null, null, '2.1.01.08', '4.01', '9810120', 'A', '001-2007', '001-2007', '001-2007', 'B', '001-2007')");
//OCIExecute($s, OCI_DEFAULT);*/

//OCICommit($db_conn);
/*$inserta ="insert into mateo.cont_movimiento
(id_ejercicio, id_libro, id_ccosto, folio, nummovto, fecha, descripcion,
importe, naturaleza, referencia, referencia2, id_Ctamayorm, id_ccostom,
id_auxiliarm, status, id_ejerciciom, id_ejerciciom2, id_ejerciciom3, 
tipo_cuenta, id_ejercicio2) 
values 
('".$ID_EJERCICIO."', '".$ID_LIBRO."', '".$ID_CCOSTO."', '".$_POST['poliza']."',
'".$_POST['numeroPoliza']."', to_date('01/12/2007','dd/mm/yy'), 
'".$DESCRIPCION."', '".$IMPORTE."', 'C', null, null, 
'2.1.01.08', '".$ID_CCOSTO."', '".$ID_EJERCICIO."', 'A', '".$ID_EJERCICIO."', 
'".$ID_EJERCICIO."', '".$ID_EJERCICIO."', 'B', '".$ID_EJERCICIO."')"; */





}
//*********************CERRAMOS ENVIO A ORACLE






$sSQL2= "Select * From aperturaCaja ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$poliza = $myrow2['numeroPoliza'];
$fechac= $myrow2['fecha'];

$sSQL3= "Select sum(abonos) as TOTAL From clientesAmbulatorios 
WHERE fecha between  '".$fechac."' and '".$fecha1."'  AND POLIZA='".$poliza."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
echo mysql_error();
$acumulado=$myrow3['TOTAL']; 
?>