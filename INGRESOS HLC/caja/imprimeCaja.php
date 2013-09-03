<?php require('pdf/fpdf.php'); 
function numerotexto ($numero) {  
    // Primero tomamos el numero y le quitamos los caracteres especiales y extras  
    // Dejando solamente el punto "." que separa los decimales  
    // Si encuentra mas de un punto, devuelve error.  
    // NOTA: Para los paises en que el punto y la coma se usan de forma  
    // inversa, solo hay que cambiar la coma por punto en el array de "extras"  
    // y el punto por coma en el explode de $partes  
      
    $extras= array("/[\$]/","/ /","/,/","/-/");  
    $limpio=preg_replace($extras,"",$numero);  
    $partes=explode(".",$limpio);  
    if (count($partes)>2) {  
        return "Error, el n&uacute;mero no es correcto";  
        exit();  
    }  
      
    // Ahora explotamos la parte del numero en elementos de un array que  
    // llamaremos $digitos, y contamos los grupos de tres digitos  
    // resultantes  
      
    $digitos_piezas=chunk_split ($partes[0],1,"#");  
    $digitos_piezas=substr($digitos_piezas,0,strlen($digitos_piezas)-1);  
    $digitos=explode("#",$digitos_piezas);  
    $todos=count($digitos);  
    $grupos=ceil (count($digitos)/3);  
      
    // comenzamos a dar formato a cada grupo  
      
    $unidad = array   ('un','dos','tres','cuatro','cinco','seis','siete','ocho','nueve');  
    $decenas = array ('diez','once','doce', 'trece','catorce','quince');  
    $decena = array   ('dieci','veinti','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa');  
    $centena = array   ('ciento','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos');  
    $resto=$todos;  
      
    for ($i=1; $i<=$grupos; $i++) {  
          
        // Hacemos el grupo  
        if ($resto>=3) {  
            $corte=3; } else {  
            $corte=$resto;  
        }  
            $offset=(($i*3)-3)+$corte;  
            $offset=$offset*(-1);  
          
        // la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB  
          
        $num=implode("",array_slice ($digitos,$offset,$corte));  
        $resultado[$i] = "";  
        $cen = (int) ($num / 100);              //Cifra de las centenas  
        $doble = $num - ($cen*100);             //Cifras de las decenas y unidades  
        $dec = (int)($num / 10) - ($cen*10);    //Cifra de las decenas  
        $uni = $num - ($dec*10) - ($cen*100);   //Cifra de las unidades  
        if ($cen > 0) {  
           if ($num == 100) $resultado[$i] = "cien";  
           else $resultado[$i] = $centena[$cen-1].' ';  
        }//end if  
        if ($doble>0) {  
           if ($doble == 20) {  
              $resultado[$i] .= " veinte";  
           }elseif (($doble < 16) and ($doble>9)) {  
              $resultado[$i] .= $decenas[$doble-10];  
           }else {  
              $resultado[$i] .=' '. $decena[$dec-1];  
           }//end if  
           if ($dec>2 and $uni<>0) $resultado[$i] .=' y ';  
           if (($uni>0) and ($doble>15) or ($dec==0)) {  
              if ($i==1 && $uni == 1) $resultado[$i].="uno";  
              elseif ($i==2 && $num == 1) $resultado[$i].="";  
              else $resultado[$i].=$unidad[$uni-1];  
           }  
        }  

        // Le agregamos la terminacion del grupo  
        switch ($i) {  
            case 2:  
            $resultado[$i].= ($resultado[$i]=="") ? "" : " mil ";  
            break;  
            case 3:  
            $resultado[$i].= ($num==1) ? " millon " : " millones ";  
            break;  
        }  
        $resto-=$corte;  
    }  
      
    // Sacamos el resultado (primero invertimos el array)  
    $resultado_inv= array_reverse($resultado, TRUE);  
    $final="";  
    foreach ($resultado_inv as $parte){  
        $final.=$parte;  
    }  
    return $final;  
}  




$conexion=mysql_connect("localhost","omorales","wolf3333");
$basedatos="sima";
$pdf=new FPDF();
$pdf->AddPage();
function saca_iva($can,$por){
$cant=$can;
$can=($can/100)*$por;
$can+=$cant;
return $can;
}


//$pdf->Cell(0,10,"Hospital La Carlota",0,0,C);
//ENCABEZADOS
//$pdf->Ln(9); //salto de linea
$sSQL1= "SELECT *
FROM
cargosCuentaPaciente
WHERE numeroE ='".$_POST['numeroE']."' 
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if($myro21['tipoPaciente']=="interno"){
$sSQL1= "SELECT *
FROM
clientesInternos
WHERE numeroE ='".$_POST['numeroE']."' and nCuenta='".$_POST['nCuenta']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$paciente=$myrow1['nombre1']." ".$myrow1['nombre2']." ".$myrow1['apellido1']." ".$myrow1['apellido2']." ".$myrow1['apellido3'];
$sSQL2= "
SELECT 
sum(iva) as totalIva
FROM
cargosCuentaPaciente
WHERE numeroE = '".$nPaciente."' and nCuenta='".$nCuenta."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$tiva=$myrow2['totalIva'];
} else {
$sSQL1= "SELECT *
FROM
clientesAmbulatorios
WHERE numeroE ='".$_POST['numeroE']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$paciente=$myrow1['paciente'];
$sSQL2= "
SELECT 
sum(iva) as totalIva
FROM
cargosCuentaPaciente
WHERE numeroE = '".$nPaciente."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$tiva=$myrow2['totalIva'];
}

$pdf->SetFont('Arial','',8);
$pdf->SetXY(30,33);
$pdf->Cell(0,0,$paciente,0,0,L);
$pdf->Cell(0,0,$_POST['numeroE'],0,0,R);
//Imprimo con salto de pagina
$pdf->Ln(49); //salto de linea



$pdf->SetFont('Arial','',8);
$pdf->SetXY(30,48);
$pdf->Cell(0,0,$myrow1['fecha1'],0,0,R);
$pdf->Ln(60); //salto de linea




	  $sSQL13= "
	SELECT 
  sum(iva) as sumaiva
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$_POST['numeroE']."'
 
 and status='pendiente'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  $iva=$myrow13['sumaiva'];


$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE numeroE ='".$_POST['numeroE']."' and nCuenta='".$_POST['nCuenta']."' 
group by codProcedimiento
 ";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){
$codProcedimiento=$myrow['codProcedimiento'];
$sSQL6= "
	SELECT 
count(*) as cantidades
FROM
cargosCuentaPaciente
WHERE numeroE = '".$nPaciente."' and nCuenta='".$nCuenta."' and codProcedimiento='".$codProcedimiento."'";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
$pdf->Ln(1); //salto de linea
$cantidades=$myrow['cantidad'];
$importe[0]+=$myrow['costo'];

//$pdf->SetXY(1,60);
$sSQL3= "SELECT *
FROM
articulos
WHERE codigo ='".$codProcedimiento."' 
 ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$importe=$myrow['cantidad']*$myrow['costo'];
$can="$".number_format($myrow['cantidad'],2);
$cos="$".number_format($myrow['costo'],2);
$imp="$".number_format($importe,2);
$cadena=$can.'  '.$cos.'  '.$imp;
$importes[0]+=$importe;
$pdf->Cell(0,0,$myrow3['descripcion'],0,0,L);
$pdf->Cell(0,0,$cadena,0,0,R);
$pdf->Ln(6); //salto de linea
//$pdf->Ln(1); //salto de linea

}

$TOTAL=$importes[0]+$iva;

$centavos=strstr($TOTAL,'.');
$centavos=substr($centavos,'1');
$resultado= numerotexto($TOTAL); 
$totalCaracteres=strlen($centavos);
if($totalCaracteres=='1'){
$centavos=$centavos.'0';
}

$formula= 'pesos '.$centavos.'/100 M.N.';
$formula=trim($formula);

$pdf->SetFont('Arial','',8);
$pdf->SetY('220');
$pdf->Cell(0,0,"$".number_format($importes[0],2),0,0,R);
$pdf->SetY('230');
$pdf->Cell(0,0,"$".number_format($iva,2),0,0,R);
$pdf->SetY('236');
$pdf->Cell(0,0,"$".number_format($TOTAL,2),0,0,R);
$pdf->SetY('236');
$pdf->Cell(0,0,'( '.$resultado.' '.$formula.' )',0,0,L);
$pdf->Output();
?>