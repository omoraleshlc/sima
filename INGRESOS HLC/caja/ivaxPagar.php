<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); ?>
<?php include('/configuracion/funciones.php'); 
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el almacen/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripción de este almacen!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=600,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style15 {color: #FFCCFF}
.Estilo24 {font-size: 10px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style13 {color: #FFFFFF}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
</head>

<body>
 <h1 align="center">IVA x Pagar </h1>
 <form id="form2" name="form2" method="post" action="">
   <table width="317" border="0" align="center" class="style121">
     <tr>
       <td width="95" bgcolor="#660066"><div align="left" class="style13">Fecha Inicial </div></td>
       <td width="190"><div align="left">
           <label>
           <input name="fecha" type="text" class="style71" id="campo_fecha" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fecha']){
		 echo $_POST['fecha'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  onchange="javascript:this.form.submit();"/>
           </label>
           <input name="button" type="button" class="style121" id="lanzador" value="..." />
       </div></td>
     </tr>
   </table>
   
<?php if($_POST['fecha'] and $_POST['fecha']<$fecha1){	?>
   <table width="494" border="0" align="center" class="style71">
     <tr>
       <th width="63" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">C&oacute;digo</div></th>
       <th width="247" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">Descripci&oacute;n</div></th>
       <th width="83" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">Importe</div></th>
       <th width="83" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">IVA</div></th>
     </tr>
     <tr>
	 
	 
	 
<?php
 $sSQL= "
SELECT * FROM gpoProductos
WHERE 
entidad='".$entidad."' 
and
activo='activo'
";
 






if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$C=$myrow['codigoGP'];
$sSQL7="SELECT SUM(precioVenta) as acumulado,sum(iva) as iva
FROM
cargosCuentaPaciente
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 
and
cargosCuentaPaciente.gpoProducto='".$C."'
and
cargosCuentaPaciente.fecha1='".$_POST['fecha']."'
and
cargosCuentaPaciente.status!='transaccion'

  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


?>
       <td bgcolor="<?php echo $color;?>" ><label> <?php echo $C?> </label>       </td>
       <td  bgcolor="<?php echo $color;?>" >
	   <div align="left"><span class=""> <?php echo $myrow['descripcionGP']; ?></span></div></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
	   $cargos[0]+=$myrow7['acumulado'];
	  echo "$".number_format($myrow7['acumulado'],2);	  
	   ?></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
	   $iva[0]+=$myrow7['iva'];
	  echo "$".number_format($myrow7['iva'],2);	  
	   ?></td>
     </tr>
     <?php }}}?>
   </table>
   
   
   
   <p>&nbsp;</p>
 </form>
<p align="center">&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>