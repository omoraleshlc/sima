<? include("/configuracion/conf.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html> 
<head> 
<title></title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
</head> 

<body> 
    <? 
    include_once("phpReportGen.php"); 
    $prg = new phpReportGenerator(); 
        $prg->width = "100%"; 
    $prg->cellpad = "0"; 
    $prg->cellspace = "0"; 
    $prg->border = "0"; 
    $prg->header_color = "#666666"; 
    $prg->header_textcolor="#FFFFFF"; 
    $prg->body_alignment = "left"; 
    $prg->body_color = "#CCCCCC"; 
    $prg->body_textcolor = "#800022"; 
    $prg->surrounded = '1'; 

    mysql_connect("localhost","omorales","wolf3333"); 
    mysql_select_db("medsys"); 
    $res = mysql_query("SELECT 
  `cargosCuentaPaciente`.`numArticulo`,
  `articulos`.`descripcion`,
  `pacientes`.`nombre1`,
  `pacientes`.`numPoliza`,
  `pacientes`.`nombre2`,
  `pacientes`.`apellido1`,
  `pacientes`.`apellido2`
FROM
  `pacientes`
  INNER JOIN `cargosCuentaPaciente` ON (`pacientes`.`numPoliza` = `cargosCuentaPaciente`.`numPoliza`)
  INNER JOIN `articulos` ON (`cargosCuentaPaciente`.`numArticulo` = `articulos`.`codigo`)

  WHERE 
 `cargosCuentaPaciente`.`numPoliza` = '".$_POST['numPolisa']."'
  "); 
    $prg->mysql_resource = $res; 
     
    $prg->title = "Test Table"; 
    $prg->generateReport(); 
     
    ?> 
</body> 
</html>