<?php
/**
 * testGraphs.php
 * @author Emmanuel Arana Corzo <emmanuel.arana@gmail.com>
 */
 
 include("/var/www/html/sima/js/barGraphics.class.php");
              //Es el ancho de la gr�fica
 $externos = new BarGraphicPercent(1000);

//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************
 $year=$_GET['year'];
 $almacenIngreso=$_GET['almacenIngreso'];
 $entidad=$_GET['entidad'];






// $graphic->addColumn("Columna 1", 25.2, "#CCCCCC");     //Agrega la columna 1
// $graphic->addColumn("Columna 2", -25.2, "#AAAAAA");    //Agrega la columna 2
// $graphic->addColumn("Columna 3", 100.32, "#999999");	//...
// $graphic->addColumn("Columna 4", 88.236, "#777777");
// $graphic->addColumn("Columna 5", 111.236, "#555555");

//ENERO*******
$fechaInicial[0]=$year.'-01-01';
$fechaFinal[0]=$year.'-01-31';
$mes[0]='Enero';
$color[0]='#CCCCCC';
//*************


//FEBRERO*******
$fechaInicial[1]=$year.'-02-01';
$fechaFinal[1]=$year.'-02-31';
$mes[1]='Febrero';
$color[1]='#AAAAAA';
//************


//MARZO*******
$fechaInicial[2]=$year.'-03-01';
$fechaFinal[2]=$year.'-03-31';
$mes[2]='Marzo';
$color[2]='#999999';
//************


//ABRIL******
$fechaInicial[3]=$year.'-04-01';
$fechaFinal[3]=$year.'-04-31';
$mes[3]='Abril';
$color[3]='#777777';
//*************


//MAYO******
$fechaInicial[4]=$year.'-05-01';
$fechaFinal[4]=$year.'-05-31';
$mes[4]='Mayo';
$color[4]='#555555';
//************



//JUNIO******
$fechaInicial[5]=$year.'-06-01';
$fechaFinal[5]=$year.'-06-31';
$mes[5]='Junio';
$color[5]='#555555';
//************

//JULIO******
$fechaInicial[6]=$year.'-07-01';
$fechaFinal[6]=$year.'-07-31';
$mes[6]='Julio';
$color[6]='#555555';
//************

//AGOSTO******
$fechaInicial[7]=$year.'-08-01';
$fechaFinal[7]=$year.'-08-31';
$mes[7]='Agosto';
$color[7]='#555555';
//************


//SEPTIEMBRE******
$fechaInicial[8]=$year.'-09-01';
$fechaFinal[8]=$year.'-09-31';
$mes[8]='Septiembre';
$color[8]='#555555';
//************


//OCTUBRE******
$fechaInicial[9]=$year.'-10-01';
$fechaFinal[9]=$year.'-10-31';
$mes[9]='Octubre';
$color[9]='#555555';
//************

//NOVIEMBRE******
$fechaInicial[10]=$year.'-11-01';
$fechaFinal[10]=$year.'-11-31';
$mes[10]='Noviembre';
$color[10]='#555555';
//************



//DICIEMBRE******
$fechaInicial[11]=$year.'-12-01';
$fechaFinal[11]=$year.'-12-31';
$mes[11]='Diciembre';
$color[11]='#555555';
//************




for($i=$_GET['inicio']; $i<=$_GET['fin']; $i++) {
    $sSQL7="SELECT
sum((precioVenta*cantidad)+(iva*cantidad))as total


FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre >='".$fechaInicial[$i]."' and fechaCierre<='".$fechaFinal[$i]."')
and
almacenIngreso='".$almacenIngreso."'

and
naturaleza='C'
and
gpoProducto!=''
and
ventasDirectas!='si'

";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);




$sSQL7d="SELECT
sum((precioVenta*cantidad)+(iva*cantidad))as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre >='".$fechaInicial[$i]."' and fechaCierre<='".$fechaFinal[$i]."')
and
almacenIngreso='".$almacenIngreso."'

and
naturaleza='A'
and
gpoProducto!=''
and

ventasDirectas!='si'

";


$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);
$ventas = number_format($myrow7['total']-$myrow7d['devoluciones'],2);


$externos->addColumn($mes[$i], $ventas, $color[$i]);


}

// $graphic->addColumn("Columna 1", 25.2, "#CCCCCC");     //Agrega la columna 1
// $graphic->addColumn("Columna 2", -25.2, "#AAAAAA");    //Agrega la columna 2
// $graphic->addColumn("Columna 3", 100.32, "#999999");	//...
// $graphic->addColumn("Columna 4", 88.236, "#777777");
// $graphic->addColumn("Columna 5", 111.236, "#555555");





?>
<html>
<head>
<title>VENTAS POR ALMACEN</title>



<style>
<!--

.cell_header {
	font-family: "Arial Narrow";
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: uppercase;
	color: #E0E0E0;
	text-decoration: none;
	background-color: #4E4E4E;
}
.cell_shaded {
	font-family: "Arial Narrow";
	font-size: 10px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	color: #333333;
	text-decoration: none;
	background-color: #9DBAD7;
}
.cell_normal {
	font-family: "Arial Narrow";
	font-size: 10px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	color: #333333;
	text-decoration: none;
	background-color: #FFFFFF;
}
.button {
	font-family: "Arial Narrow";
	cursor: hand;
	color: #666666;
	background-image: url(img/FairytaleWorld/22x22/actions/viewmag.png);
	background-repeat: no-repeat;
}
.icon_links_off {
	font-family: "Arial Narrow";
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: lowercase;
	color: #333333;
	text-decoration: none;
}
.icon_links_on {
	font-family: "Arial Narrow";
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: lowercase;
	color: #F3F3F3;
	text-decoration: none;
	background-color: #1F4A76;
}
-->
</style>
</head>




<body>

<h1>
<?php 
$sSQL7al= "Select descripcion From almacenes where entidad='".$entidad."'
and
almacen='".$almacenIngreso."'
";
$result7al=mysql_db_query($basedatos,$sSQL7al);
$myrow7al = mysql_fetch_array($result7al);
echo mysql_error();

echo $myrow7al['descripcion'];

?>
    </h1>

    <br>


    


<?php
$externos->drawGraph("cell_normal");  //Simplemente dibujo la gr�fica
unset($externos);
?>

</body>
</html>
