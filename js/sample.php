<?
// **************************************************************************
// sample.php - sample script that demonstrates using as-diagrams.php,
// class for drawing gd-less bar diagrams.
//
// Written by Alexander Selifonov,  http://as-works.narod.ru
// Read "as-diagrams.htm" for how-to instructions
// **************************************************************************


require_once('as-diagrams.php');
?>
<HTML>
<HEAD><TITLE>Sample for using CAsBarDiagram class, defined in as-diagerams.php</TITLE>
<META http-equiv="Content-Type" Content="text/html; charset=windows-1251">
</HEAD>
<BODY>
<?

$data_title = 'as-diagrams demo barchart'; // title for the diagram

// sample data array
$data = array();
$data[] = array(900, 1300,1600);
$data[] = array(1200,1800,2500);
$data[] = array(1400,2000,2800);
$data[] = array(1900,2900,3900);
$data[] = array(2500,3500,4500);

$legend_x = array('Yan','Feb','March','April','May');
$legend_y = array('pens','pensils','staplers');

$graph = new CAsBarDiagram;
$graph->bwidth = 10; // set one bar width, pixels
$graph->bt_total = 'Summary'; // 'totals' column title, if other than 'Totals'
// $graph->showtotals = 0;  // uncomment it if You don't need 'totals' column
$graph->precision = 0;  // decimal precision
// call drawing function
$graph->DiagramBar($legend_x, $legend_y, $data, $data_title);

?>
<hr>
</BODY></HTML>
