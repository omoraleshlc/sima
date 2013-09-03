<?php
   // include the PHPReports classes on the PHP path! configure your path 

   
ini_set("include_path",ini_get("include_path").":/var/www/html/medsys/caja/"); 
   include "PHPReportMaker.php";

   $sSQL = "select * from almacenes";
   $oRpt = new PHPReportMaker();

   $oRpt->setXML("sales.xml");
   $oRpt->setUser("omorales");
   $oRpt->setPassword("wolf3333");
   $oRpt->setConnection("localhost");
   $oRpt->setDatabaseInterface("mysql");
   $oRpt->setSQL($sSQL);
   $oRpt->setDatabase("medsys");
   $oRpt->run();
?>

