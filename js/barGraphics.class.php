<?php
/**
 * barGraphics.class.php
 * @author Emmanuel Arana Corzo <emmanuel.arana@gmail.com>
 * Description: Makes a bar graphic with stablished values
 * Plattform: PHP 5 or later 
 */
 
 if(!defined("__BARGRAPHICS_CLASS__")) {
   define("__BARGRAPHICS_CLASS__", "__BARGRAPHICS_CLASS__");
   
   class BarGraphicPercent {
     private $width;	             //This is the width of all the graphic
	 private $sum;                   //Es el total con el que va a sacar el promedio
	 private $headers = array();	 //Son las cabeceras de cada barra
	 private $barVals = array();     //Es el valor de cada barra, de aquí sacará los porcentajes
	 private $barPerc = array();     //Son los porcentajes por barra
	 private $widthVals = array();   //Es el ancho en pixeles de cada columna
	 private $colorBars = array();	 //Contiene los colores en RGB de cada barra	 
	 
	 public function __construct($w = 100) {
	   $this->width = (($w > 99) ? $w : 100);
	 }
	 /**
          * addColumn
          * This adds new values to the graphic
          * @params $hN This is the name of the column (string type)
          * @params $bV This is a number that specifies the value of the bar
          * @params $cB This is an string that specifies the color of the bar
          * @access public
          */
	 public function addColumn($hN, $bV, $cB) {
	   $this->headers[] = $hN;
	   $this->barVals[] = $bV;
	   $this->sum += $bV;
	   $this->colorBars[] = $cB;
	 }
	 /**
          * calcPercents
          * This calculates the percents of the total
          */
	 private function calcPercents() {
	   $numBars = count($this->barVals);
	   for($i = 0; $i < $numBars; $i++) {
	     $this->barPerc[] = ($this->barVals[$i] / $this->sum) * 100;
	   }
	 }
	 private function calcWidthVals() {
	   $numBars = count($this->barVals);
	   for($i = 0; $i < $numBars; $i++) {
	     $this->widthVals[] = abs(($this->barPerc[$i] / $this->width) * 1000);
	   }
	 }
	 public function drawGraph($cellClassName) {
	   $this->calcPercents();
	   $this->calcWidthVals();
	   $numBars = count($this->barVals);
	   echo "<table cellpadding='0' cellspacing='0' border='1'>" . chr(13);
	   for($i = 0; $i < $numBars; $i++) {
	     echo "<tr>" . chr(13);
		 echo "<td class='" . $cellClassName . "'>" . chr(13);
		 echo $this->headers[$i] . "</td>" . chr(13);
		 echo "<td class='" . $cellClassName . "'>" . chr(13);
		 echo $this->barVals[$i] . "</td>" . chr(13);
		 echo "<td class='" . $cellClassName . "'>" . chr(13);
		 echo $this->barPerc[$i] . "%</td>" . chr(13);
		 //Aquí dibuja la gráfica, primero los negativos, y después...
		 echo "<td align='right' width='" . ($this->width / 2) . "'><table cellpadding='0' cellspacing='0' width='" . (($this->barPerc[$i] < 0) ? $this->widthVals[$i] : 0) . "%' border='0'>" . chr(13);
		 echo "<tr height='20'><td width='100%' bgcolor='" . $this->colorBars[$i] . "'></td></tr>" . chr(13);
		 echo "</table></td>" . chr(13);
		 //...los positivos
		 echo "<td align='left' width='" . ($this->width / 2) . "'><table cellpadding='0' cellspacing='0' width='" . (($this->barPerc[$i] > 0) ? $this->widthVals[$i] : 0) . "%' border='0'>" . chr(13);
		 echo "<tr height='20'><td width='100%' bgcolor='" . $this->colorBars[$i] . "'></td></tr>" . chr(13);
		 echo "</table></td>" . chr(13);
		 echo "</tr>" . chr(13);
	   }
	   echo "</table>" . chr(13);
	 }
   }
 }         //__BARGRAPHICS_CLASS__

?>