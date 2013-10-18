<?php require("/configuracion/ventanasEmergentes.php");
//include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
//     DIRECTORY_SEPARATOR . 'Highchart.php';
include_once("../bt/Highchart.php");


//echo __DIR__;
$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->chart->margin = array(
    50,
    50,
    100,
    80
);
$chart->title->text = "Cantidad de órdenes terminadas por departamento";

$chart->xAxis->categories = array(
    'Tokyo',
    'Jakarta',
    'New York',
    'Seoul',
    'Manila',
    'Mumbai',
    'Sao Paulo',
    'Mexico City',
    'Dehli',
    'Osaka',
    'Cairo',
    'Kolkata',
    'Los Angeles',
    'Shanghai',
    'Moscow',
    'Beijing',
    'Buenos Aires',
    'Guangzhou',
    'Shenzhen',
    'Istanbul'
);





            $sSQL= "SELECT *
            FROM
            sis_ordenesSOP
            where
            
            status='done'
            and
            fecha>='".$_GET['fechaInicial']."'
                and
            fecha<='".$_GET['fechaFinal']."'
            group by almacen 
            order by descripcionAlmacen ASC
";
            $result=mysql_db_query($basedatos,$sSQL);
            while($myrow = mysql_fetch_array($result)){ 
            $numeroE=$myrow['numeroE'];
            $nCuenta=$myrow['nCuenta'];
            $ali[]+=1;
            $almacenes[]= ucfirst(strtolower($myrow['descripcionAlmacen']));
            $nT=$myrow['keyClientesInternos'];
            

    $sSQLf= "
    SELECT count(*) as cantidadTotalOrdenes
    FROM
    sis_ordenesSOP
WHERE
almacen='".$myrow['almacen']."'
    and
    status='done'
            and
            fecha>='".$_GET['fechaInicial']."'
                and
            fecha<='".$_GET['fechaFinal']."'


";


$resultf=mysql_db_query($basedatos,$sSQLf);
$myrowf = mysql_fetch_array($resultf);
$data[]+=$myrowf['cantidadTotalOrdenes'];
            }
                     
            
            



$chart->xAxis->categories=  $almacenes;











$chart->xAxis->labels->rotation = - 45;
$chart->xAxis->labels->align = "right";
$chart->xAxis->labels->style->font = "normal 10px Verdana, sans-serif";
$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Cantidad";
$chart->legend->enabled = false;

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.x +'</b><br/>'+
    'Ordenes Terminadas: '+ Highcharts.numberFormat(this.y, 1) +
    ' ';}");

$chart->series[] = array(
    'name' => 'Population',
    'data' => $data,
    'dataLabels' => array(
        'enabled' => true,
        'rotation' => - 90,
        'color' => '#FFFFFF',
        'align' => 'right',
        'x' => - 3,
        'y' => 10,
        'formatter' => new HighchartJsExpr(
            "function() {
                                                  return this.y;}"),
        'style' => array(
            'font' => 'normal 13px Verdana, sans-serif'
        )
    )
);
?>



        <?php $chart->printScripts(); ?>
 
        <div id="container"></div>
        <script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>
   