<?php 	$hostname = "localhost";
	$username = "omorales";
	$password = "wolf3333";
	$basedatos = "sima";

	mysql_connect($hostname, $username, $password);
	mysql_select_db($database);
	

# PHPlot Example: Pie/text-data-single
require_once 'phplot.php';

# The data labels aren't used directly by PHPlot. They are here for our
# reference, and we copy them to the legend below.
/*
$data = array(
  array('Australia', 7849),
  array('Dem Rep Congo', 299),
  array('Canada', 5447),
  array('Columbia', 944),
  array('Ghana', 541),
  array('China', 3215),
  array('Philippines', 791),
  array('South Africa', 19454),
  array('Mexico', 311),
  array('United States', 9458),
  array('USSR', 9710),
);
*/


//VARIABLES
$entidad='01';
$almacenIngreso='HCEX';
$mes='06';
$year='2012';
$gpoProducto='HONMED';
//**********************************



$sSQL2= "Select 
   
* 
FROM
relacionClientesTipo
      where
      entidad='".$entidad."'
order by descripcion ASC
 ";
$result2=mysql_db_query($basedatos,$sSQL2); 
while($myrow2 = mysql_fetch_array($result2)){
  	
    
    
//*******************************    
$sSQL6a= "Select sum(cantidad) as c  From cargosCuentaPaciente where
    entidad='".$entidad."'
                and
almacenIngreso='".$almacenIngreso."'
and


mes='".$mes."'
and
year='".$year."'
and
naturaleza='C'
and
gpoProducto='".$gpoProducto."'
and

statusPC='".$myrow2['tipo']."'
";
$result6a=mysql_db_query($basedatos,$sSQL6a); 
$myrow6a = mysql_fetch_array($result6a);		 



$sSQL6ad= "Select sum(cantidad) as c  From cargosCuentaPaciente where

entidad='".$entidad."'
            and
almacenIngreso='".$almacenIngreso."'
and

mes='".$mes."'
and
year='".$year."'
and
naturaleza='A'
and
gpoProducto='".$gpoProducto."'
and

statusPC='".$myrow2['tipo']."'
";
$result6ad=mysql_db_query($basedatos,$sSQL6ad); 
$myrow6ad = mysql_fetch_array($result6ad);
echo mysql_error();
//*******************************************  
$total=$myrow6a['c']-$myrow6ad['c'];
$data[] = array($myrow2['descripcion'],$total);

}



$plot = new PHPlot(800,600);
$plot->SetImageBorderType('plain');

$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetDataValues($data);

# Set enough different colors;
$plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'cyan',
                        'magenta', 'brown', 'lavender', 'pink',
                        'gray', 'orange'));

# Main plot title:
$plot->SetTitle("ESTADISTICA DE PORCENTAJE Y TIPOS");

# Build a legend from our data array.
# Each call to SetLegend makes one line as "label: value".
foreach ($data as $row)
  $plot->SetLegend(implode(': ', $row));
# Place the legend in the upper left corner:
$plot->SetLegendPixels(5, 5);

$plot->DrawGraph();










?>

