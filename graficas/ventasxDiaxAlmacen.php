<?php

// conectamos a la base de datos
#conexión a la BD...
$usuario="omorales";
$passwd='wolf3333';
$servidor='localhost';
$basedatos='sima';
mysql_connect($servidor,$usuario,$passwd); 



 $sSQL= "
SELECT *
FROM
almacenes
WHERE
activo='A'
and
entidad='".$_GET['entidad']."' AND
medico =  'si'
and
almacenPadre='".$_GET['almacen']."'

order by descripcion ASC

";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){

$A=$myrow['almacen'];
 $sql1= "
SELECT count(*) as cantidadConsultas
FROM
clientesInternos
WHERE
entidad='".$_GET['entidad']."' AND
almacenSolicitud =  '".$A."'
and
fechaSolicitud between '".$_GET['fechaInicial']."' and '".$_GET['fechaFinal']."'
and
(statusExpediente='standby' or statusExpediente='recibido' or statusExpediente='cargado')
and
status!='cancelado'
";
$result1=mysql_db_query($basedatos,$sql1);
$myrow1 = mysql_fetch_array($result1);
$data[] = $myrow1[0]; // agregamos el dato, suponiendo que este en la primera posición del arreglo resultanteç

}




//if($myrow[0]){
include ("/var/www/html/sima/js/jpgraph-1.27/src/jpgraph.php");
include ("/var/www/html/sima/js/jpgraph-1.27/src/jpgraph_line.php");
// aquí ya tenemos el arreglo en $data, solo le agregamos al código anterior

$datay = $data;
// A nice graph with anti-aliasing
$graph = new Graph(1024,768);
$graph->img->SetMargin(30,50,30,30);
//$graph->SetBackgroundImage("tiger_bkg.png",BGIMG_FILLFRAME);

$graph->img->SetAntiAliasing("white");
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->title->Set("GRAFICA DE CITAS ATENDIDAS MEDICOS");

// Use built in font
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Slightly adjust the legend from it's default position in the
// top right corner.
$graph->legend->Pos(0.05,0.5,"right","center");

// Create the first line
$p1 = new LinePlot($datay);
//$p1->mark->SetType(MARK_FILLEDCIRCLE);
//$p1->mark->SetFillColor("red");
//$p1->mark->SetWidth(4);
$p1->SetColor("green");
$p1->SetCenter();
$p1->SetLegend("CONSULTAS MEDICOS"); // aqui va el nombre de la seal...
$graph->Add($p1);

// Output line
$graph->Stroke(); 
?> 