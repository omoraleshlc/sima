<? require('../caja/fpdf153/fpdf.php'); 
define('FPDF_FONTPATH','font/'); 
ob_end_clean(); 

require("conexion.php");

class titulo extends FPDF 
{ 

function Header() 
{ 
$this->SetFont('Arial','B',13); 
$this->SetXY(85,8); 
$this->Image('ros.jpg',10,10,40,0,'',''); 
$this->Cell(45,10,'empresa',0,0,'C'); 
$this->SetXY(110,10); 
$this->Cell(1,35,'titulo de reporte',0,0,'C'); 
$this->Ln(20); 

} 
function Footer() 
{ 
$this->SetY(-16); 
$this->SetFont('Arial','',8); 
$this->SetY(-17); 
$this->Cell(0,2,'TEL: 51 8 6 01- 03, 01 800 5 70 16 60 Página '.$this->PageNo(),0,0,'C'); 
$this->SetY(-20); 
$this->Cell(1,1,'direccion'); 
$this->SetY(-24); 
$this->Cell(1,1,'______________________________________________________________________________________________________________________'); 
} 
} 

$pdf=new titulo(); 
$pdf->Open(); 
$pdf->SetDisplayMode(fullwidth); 
$pdf->SetAutoPageBreak(false); 
$pdf->AddPage(); 

// FECHA 

$FECHA=date("d/m/y"); 

//************************CONSULTA TU BASE DE DATOS***************************** 

$checaModuloScript= "Select all distinct * From usuariosModulos ";
$qry=mysql_db_query($basedatos,$checaModuloScript);


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 


$pdf->SetFont('Arial','B',9); 
$pdf->SetXY(20,35); 
$pdf->SetXY(165,45); 
$pdf->Cell(200,6,'Fecha: '.$FECHA,0,'L',1); 

//***************************************************** 
$pdf->SetFont('Arial','',12); 
$pdf->Ln(15); 
$pdf->SetXY(15,57); 

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
$y_axis_initial = 40; 
$row_height = 46; 
$pdf->SetFillColor(230,230,235); 
$pdf->SetTextColor(5); 
$pdf->SetDrawColor(0,0,0); 
$pdf->SetLineWidth(.3); 
$pdf->SetFont('Times','B','9'); 
$pdf->SetY($y_axis_initial); 
$pdf->Ln(15); 
$pdf->SetX(15); 
$y_axis = $y_axis + $row_height; 


//**********************columnas que comprondran tu reporte*********************** 

$pdf->SetFillColor(200,235,255); 
$pdf->SetTextColor(0); 
$pdf->SetFont('Arial','B','8'); 
$pdf->Cell(50,6,'columna1',1,0,'C',1); 
$pdf->Cell(30,6,'columna2',1,0,'C',1); 
$pdf->Cell(90,6,'columna3',1,0,'C',1); 


//********************campos de tu base de datos a utilizar************************ 
$i = 0; // contador en cero 
$max = 35; //filas maximas en la pagina 
$row_height = 6;// Altura de la fila 
$fill=0; 
$esp = ""; 

do{ 

$pdf->SetY($y_axis); 
$pdf->Ln(15); 
$pdf->SetX(15); 

if (i == $max) 
{ 
$pdf->SetFillColor(200,235,255); 
$pdf->SetTextColor(0); 
$pdf->AddPage(); 
$pdf->SetY(39); 
$pdf->SetX(15); 
$pdf->SetFont('Arial','B','8'); 
$pdf->Cell(50,6,'columna1',1,0,'C',1); 
$pdf->Cell(30,6,'columna2',1,0,'C',1); 
$pdf->Cell(90,6,'columna3',1,0,'C',1); 
$y_axis = $y_axis + $row_height; 
$pdf->SetY($y_axis); 
} 

if ($row[campo_id] == $esp) 
{ 
$pdf->SetX(15); 
$pdf->SetFont('Arial','','8'); 
$pdf->Cell(50,6,'',1,0,'C',1); 
$pdf->Cell(30,6,'',1,0,'C',1); 
$pdf->Cell(90,6,'',1,0,'C',1); 
$pdf->Cell(30,6,$row[campo_id],1,0,'L',0); 
$y_axis = $y_axis + $row_height; 
} 
else 
{ 
$pdf->SetX(15); 
$pdf->SetFont('Arial','','8'); 
$pdf->Cell(50,6,$row[campo1],1,0,'L',0); 
$pdf->Cell(30,6,$row[campo2],1,0,'L',0); 
$pdf->Cell(90,6,$row[campo3],1,0,'L',0); 

$y_axis = $y_axis + $row_height; 
$esp=$row[campo_id]; 
} 
$i = $i + 1; 
}while($row = mysql_fetch_array($qry)); 
//********************************************************** 
$pdf->Output(); 
?> 



