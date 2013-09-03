<?PHP include("/configuracion/administracionhospitalaria/recursoshumanos/rrhhmenu.php"); ?>
<?php    require("tooltip.php");  //  require("bd/conecta.php");
  $bnnom = $_POST['txtnomi'];   $bnnomem = $_POST['txtnemplea'];
if ($_POST['btnenv']) {   $varx = "";
  if ($bnnom == "" and $bnnomem == "") { $varx = "NO";
 echo "<script language='JavaScript'>alert('Editar Nomina o Empleado');</script>"; 
                                       } else { $varx = "SI";
     if ($bnnom != "") {	                                       
$sqlb = "Select * From empleados Where numnom = '".$bnnom."'";					
	    			   }
     if ($bnnomem != "") {
$sqlb = "Select * From empleados Where nomemp LIKE '%".$bnnomem."%'";  
                         }	
    $rsemp = mysql_db_query($basedatos, $sqlb);   $rserr = mysql_db_query($basedatos, $sqlb);										                                              }
	                  } 					   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Empleados ::</title>
<style type="text/css">
h1 {color: red}
h2 {color: rgb(160,82,45)}
p.blue {color: blue}
p.grey {color: #A9A9A9}
p.x-s {font-size: x-small}
p.s {font-size: small}
.fijo {position: fixed}
</style>
<style>
<!--
.style12 {font-size: 10px}
.style14 {font-size: 12px}
.style15 {color: #FF0000}
-->
</style>
</head>
<body onload="document.getElementById('txtnomi').focus();">
<center>
<form id="form1" name="form1" method="post" action="">
  <table width="220" border="0" class="style12">
    <tr>
      <td width="100" align="left">No. Nomina</td>
      <td width="120" align="left">
<input name="txtnomi" type="text" class="style12" id="txtnomi" size="8" />
      </td>
    </tr>
    <tr>
      <td width="100" align="left">Nom. Empleado</td>
      <td width="120" align="left">
<input name="txtnemplea" type="text" class="style12" id="txtnemplea" />
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="120" align="left">
<input name="btnenv" type="image" src="img/btnbuscar.png" class="style12" id="btnenv" value="Submit" onmouseover="ddrivetip('Buscar Empleado', 'GRID', 112)" onmouseout="hideddrivetip()"/>
      </td>
    </tr>
  </table>
</form>
<?php if ($_POST['btnenv'] and $varx == "SI") {
          if (mysql_fetch_array($rserr) != Null){   $ColorD = "#FFFFFF"; $VaB1 = 1;
 ?>  
<form id="form2" name="form2" method="post" action="addemplea.php">
  <table width="320" border="0" class="style12">
    <tr>
      <td width="50" align="center"># Nom.</td>
      <td width="200" align="center">Empleado</td>
      <td width="70" align="center">&nbsp;</td>
    </tr>
<?php
       while ($datose = mysql_fetch_array($rsemp)){
	    $nemp = $datose['nomemp']; $apll = $datose['apellidos'];
$varbtng = "Modificar Datos de :: ".$nemp." ".$apll." ".$amat;   $NumT = strlen($varbtng) * 7.4;
 ?>	
    <tr>
      <td align="center" bgcolor="<?php echo $ColorD;?>"><?php echo $datose['numnom'];?></td>
      <td align="left" bgcolor="<?php echo $ColorD;?>"><?php echo $nemp." ".$apll;?></td>
      <td align="center" bgcolor="<?php echo $ColorD;?>">
<input name="btnbusca" type="image" src="img/btnEDITA.png" class="style12" id="btnbusca" onmouseover="ddrivetip('<?php echo $varbtng;?>', 'GRID', <?php echo $NumT;?>)" onmouseout="hideddrivetip()" value="<?php echo $datose['id'];?>"/>
      </td>
    </tr>
<?php
		      if ($VaB1 == 1){
			      $VaB1 = 2; $ColorD = "#CCCCCC";
			                }else{
							$VaB1 = 1; $ColorD = "#FFFFFF";
							     }	  
                                                  }
?>	
  </table>
</form>
<?php
                                                } else {
							echo "<br><br>NO HAY DATOS";				   
											           }
		                                      } ?>  
</center>
</body>
</html>
