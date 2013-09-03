<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php');
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>




<script language=javascript>
function ventanaSecundaria6 (URL){
   window.open(URL,"ventana6","width=600,height=300,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventana1","width=600,height=400,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria5 (URL){
   window.open(URL,"ventana5","width=700,height=600,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria51 (URL){
   window.open(URL,"ventanaSecundaria51","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria511 (URL){
   window.open(URL,"ventanaSecundaria511","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA (URL){
   window.open(URL,"ventanaSecundariaA","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA2 (URL){
   window.open(URL,"ventanaSecundariaA2","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA1 (URL){
   window.open(URL,"ventanaSecundariaA1","width=800,height=600,scrollbars=YES")
}
</script>


<script language=javascript>
function ventanaSecundaria5111(URL){
   window.open(URL,"ventanaSecundaria5111","width=800,height=600,scrollbars=YES")
}
</script>






<?php
if($_POST['aplicar']){
$numFactura=$_POST['numFactura'];

for($i=0;$i<=$_POST['bandera'];$i++){

    if($numFactura[$i]){
$q = "UPDATE facturasAplicadas set
statusPago='standby',usuario='".$usuario."'
	
		WHERE entidad='".$entidad."' and numFactura='".$numFactura[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
    }
}

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Registro Preparado para Aplicarse';
}
?>
















<?php
if($_POST['delete']){
$numFactura=$_POST['numFactura'];

for($i=0;$i<=$_POST['bandera'];$i++){

    if($numFactura[$i]){
$q = "UPDATE facturasAplicadas set
statusPago=''

		WHERE entidad='".$entidad."' and numFactura='".$numFactura[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
    }
}

$tipoMensaje='error';
$encabezado='Exitoso';
$texto='Se desactivaron facturas para aplicar!';

}
?>


  







<?php
if($_POST['aplicarDefinitivo'] and $_POST['numFactura']){
$numFactura=$_POST['numFactura'];

for($i=0;$i<=$_POST['bandera'];$i++){

    if($numFactura[$i]){
$q = "UPDATE facturasAplicadas set
statusPago='pagado'

		WHERE entidad='".$entidad."' and numFactura='".$numFactura[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();


                $q1 = "UPDATE cargosCuentaPaciente set
statusFactura='pagado',pagoCxCKeyCAP='".$_GET['keyCAP']."',fechaPagoCxC='".$fecha1."'

		WHERE keyCAP='".$_GET['keyCAP']."'";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();


                }
}


$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Registro Aplicado Definitivo';

echo '
<script>
//window.alert("PAGO APLICADO!");
//window.close();
window.opener.document.forms["form1"].submit();
</script>';
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>

<body>


   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>


 <h1 align="center" class="titulos">Facturas sin Aplicar</h1>
 <form id="form2" name="form2" method="post" action="">


     
     
     
   </p>
   <img src="/sima/imagenes/bordestablas/borde1.png" alt="" width="278" height="24" align="center"/>
   <table width="278" border="0" align="center" cellpadding="4" cellspacing="0" class="style12">
     <tr bgcolor="#330099">
       <th width="40" bgcolor="#FFFF00" scope="col"><div align="left" class="normal">
         <div align="left">#</div>
       </div></th>
       <th width="71" bgcolor="#FFFF00" scope="col"><div align="left" class="normal">
         <div align="left"># Folios</div>
       </div></th>
       <th width="24" bgcolor="#FFFF00" scope="col"><div align="left" class="normal">
         <div align="left"></div>
       </div></th>

     <th width="67" bgcolor="#FFFF00" scope="col"><div align="left" class="normal">
         <div align="left">Facturado</div>
       </div></th>

          <th width="54" bgcolor="#FFFF00" scope="col"><div align="left" class="normal">
         <div align="left"></div>
       </div></th>
    </tr>




<?php
   $sSQLp= "Select fechaApertura from entidades
WHERE
codigoEntidad='".$entidad."'


";


$resultp=mysql_db_query($basedatos,$sSQLp);
$myrowp = mysql_fetch_array($resultp);

$sSQL= "

Select *
FROM    
facturaGrupos
WHERE
entidad='".$entidad."'
AND
numFactura='".$_GET['numFactura']."'
    and
    folioVenta!=''
   
    group by folioVenta
    order by folioVenta ASC

";



$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$bandera+=1;



 $sSQLa= "
Select sum(importe+iva) as acumulado 
FROM    
facturaGrupos
WHERE
entidad='".$entidad."'
AND
numFactura='".$_GET['numFactura']."'
    and
    folioVenta='".$myrow['folioVenta']."'
and
status='facturado'
and

naturaleza='C'

";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);

$sSQLad= "
Select sum(importe+iva) as dev 
FROM    
facturaGrupos
WHERE
entidad='".$entidad."'
AND
numFactura='".$_GET['numFactura']."'
    and
    folioVenta='".$myrow['folioVenta']."'
and
status='facturado'
and
naturaleza='A'

";
$resultad=mysql_db_query($basedatos,$sSQLad);
$myrowad = mysql_fetch_array($resultad);




$facturado[0]+=$myrowa['acumulado']-$myrowad['dev'];

?>
<tr bgcolor="#FFFFFF"  >

<td class="normal">

<?php echo $bandera;?>
	
	 

	   </td>
       <td class="normal">

<?php echo $myrow['folioVenta'];?>
	
	 

	   </td>
       <td height="29" class="normal">



       </td>

    <td height="29" class="normal">
        <?php echo '$'.number_format($myrowa['acumulado']-$myrowad['dev'],2);?>
    </td>

       <td height="29" class="normal">
       
    </td>
</tr>
     <?php }?>
  </table>
   <img src="/sima/imagenes/bordestablas/borde2.png" alt="" width="278" height="24" align="center"/>
   <div align="center" class="titulomedio">
<?php echo 'Totales: $'.number_format($facturado[0],2);?>       
       
   </div>









</form>
 <br>
 <br>

</body>
</html>