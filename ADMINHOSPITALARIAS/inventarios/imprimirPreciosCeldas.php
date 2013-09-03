<?php
//require('/sima/js/pdf/mysql_table.php');

require('/var/www/html/sima/js/pdf/mysql_table.php');
class PDF extends PDF_MySQL_Table
{
function Header()
{
    //Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,$_GET['titulo'],0,1,'C');
    $this->Ln(10);
    //Ensure table header is output
    parent::Header();
}
}

//Connect to database
mysql_connect('localhost','omorales','wolf3333');
mysql_select_db('sima');

$pdf=new PDF();
$pdf->AddPage();

//First table: put all columns automatically


$porcentaje=$_GET['porcentaje']*0.01;

$sSQL="SELECT articulos.descripcion as Descripción,concat('$',format(articulosPrecioNivel.nivel3-(articulosPrecioNivel.nivel3*('".$porcentaje."')),2)) as Precios
FROM
articulos,articulosPrecioNivel

WHERE
articulosPrecioNivel.codigo=articulos.codigo
and
articulos.codigo=articulosPrecioNivel.codigo
and
articulos.um='s'
and
articulosPrecioNivel.almacen='".$_GET['almacen']."'
order by 
articulos.descripcion ASC
 ";
 

$prop=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
			
$pdf->Table($sSQL,$prop);
$pdf->AddPage();


			

$pdf->Output();
?>