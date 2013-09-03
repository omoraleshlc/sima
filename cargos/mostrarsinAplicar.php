<?PHP include("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>
<script language=javascript>
function ventanaSecundaria2 (URL){
   window.open(URL,"ventanaSecundaria2","width=700,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria3 (URL){
   window.open(URL,"ventana3","width=400,height=400,scrollbars=YES")
}
</script>


<script language="javascript" type="text/javascript">

function vacio(q) {
        for ( i = 0; i < q.length; i++ ) {
                if ( q.charAt(i) != " " ) {
                        return true
                }
        }
        return false
}

//valida que el campo no este vacio y no tenga solo espacios en blanco
function valida(F) {

        if( vacio(F.medico.value) == false ) {
                alert("Por Favor, escoje un m�dico que va a atender a este paciente!")
                return false
        } else if( vacio(F.paciente.value) == false ) {
                alert("Por Favor, escribe el nombre del paciente!")
                return false
        } else if( vacio(F.seguro.value) == false ) {
                alert("Por Favor, escoje alg�n tipo de seguro, o tambi�n si es particular!")
                return false
        }
}
</script>


















<?php




?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();

?>

</head>

<body>
 <h1 align="center" class="titulos">Pagos No Aplicados
 </h1>
 <p align="center"><?php echo $_GET['nombreCliente'];?></p>
 <form id="form1" name="form1" method="post" action="">




</p>



   <table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
     <tr>
       <td colspan="7"><img src="/sima/imagenes/bordestablas/borde1.png" alt="" width="500" height="16" align="center"/></td>
     </tr>

     <tr bgcolor="#FFFF00">
       <td class="negromid" align="center">Mov</td>
       <td class="negromid" align="center">Fecha</td>
       <td class="negromid">Concepto</td>
       <td align="center" class="negromid">Debe</td>
          <td align="center" class="negromid">Haber</td>

     </tr>
     <tr bgcolor="#FFFF00">
       <td align="center" bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
       <td align="center" bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
       <td align="center" bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
       <td align="center" bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
     </tr>


 <?php
 $sSQL= "Select *
 from cargosCuentaPaciente
 where entidad='".$entidad."'
 AND

 clientePrincipal='".$_GET['seguro']."'
 and
statusFactura='standby'
and
 gpoProducto=''
 and
descripcionTransaccion='pagosCxC'
   ";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$N=$myrow['numCliente'];




$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];



//traigo descuento


//cierro descuento


if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}


  if($myrow['naturaleza']=='A'){
 $cargos[0]+=$myrow['precioVenta']*$myrow['cantidad'];}

   if($myrow['naturaleza']=='C'){
         $devoluciones[0]+=$myrow['precioVenta']*$myrow['cantidad'];
           
   }
?>
     <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
       <td class="codigos" align="center"><?php echo $myrow['numMovimiento'];?></td>
       <td height="55" class="normalmid" align="center"><?php echo cambia_a_normal($myrow['fecha1']);?></td>
       <td width="180" class="normalmid" ><span class="normal" >
	   <?php

	   echo $myrow['descripcionArticulo'];
	   echo '<br>';
	   echo 'Estado de Factura: ';?>

               <?php   if($myrow['naturaleza']=='A'){?>
<a href="javascript:ventanaSecundaria2('mostrarFacturas.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>&cantidad=<?php echo $cargos[0]-$devoluciones[0];?>&keyCAP=<?php echo $myrow['keyCAP'];?>')">
        <?php echo 'Status: '.$myrow['statusFactura'];?>

            </a>
           <?php }else{ ?>
 Devolucion..
            <?php } ?>
        	   
	   </span></td>

       <td class="precbluemid" align="right">
	   <div align="center">
	   <?php
           if($myrow['naturaleza']=='A'){
           echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
           }
	   ?>
	   </div></td>


              <td class="informativo" align="right">
	   <div align="center">
	   <?php
           if($myrow['naturaleza']=='C'){
           echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
           }
	   ?>
	   </div></td>

     </tr>
     <?php }?>
     <tr>
       <td colspan="7">&nbsp;</td>
     </tr>
   </table>
   <table width="500" border="0" align="center">

     <tr>
       <td>&nbsp;</td>
       <td class="normalmid">Saldo</td>
       <td colspan="2"><div align="center" class="normalmid"> <?php echo '$'.number_format($cargos[0]-$devoluciones[0],2);?> </div></td>
     </tr>
     <tr>
       <td colspan="4"><img src="/sima/imagenes/bordestablas/borde2.png" width="500" height="16" /></td>
     </tr>


       </div>
   </table>


          


 </form>




</body>
</html>