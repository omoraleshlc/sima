<?PHP require("menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
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
 <h1 align="center" >Cuentas Transferidas Otros<label></label></h1>
 <form id="form1" name="form1" method="post" action="">

   <table width="829" height="57" class="table table-striped">
     <tr >
       <th width="74"  scope="col"><div align="left" >
         <div align="center">Folio</div>
       </div></th>
       <th width="374"  scope="col"><div align="left" >
         <div align="center">Nombre del Cliente</div>
       </div></th>
       <th width="99"  scope="col"><div align="left" >
         <div align="center">Fecha</div>
       </div></th>
       <th width="63"  scope="col"><div align="left" >
         <div align="center">Cargos</div>
       </div></th>
       <th width="63"  scope="col"><div align="left" >
         <div align="center">Abonos</div>
       </div></th>
       <th width="63"  scope="col"><div align="left" >
         <div align="center">Total</div>
       </div></th>
       <th width="63"  scope="col"><div align="left" >
         <div align="center"></div>
       </div></th>
    </tr>
     <tr >

<?php   






$sSQL= "Select * From clientesInternos
where
entidad='".$entidad."'
and
statusOtros='standby'
and
responsableCuenta!=''
order by fecha ASC
";


$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$b+=1;
$N=$myrow['numCliente'];




?>
<tr  > 
       <td ><a href="#" onClick="javascript:ventanaSecundaria('/sima/cargos/despliegaCargos.php?almacen=<?php echo $bali; ?>&seguro=<?php echo $myrow['maguila']; ?>&numCliente=<?php echo $myrow['numCliente'];?>&nombreCliente=<?php echo $myrow['nomCliente'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>')"><?php echo $myrow['folioVenta'];?></a></td>
        
        
       <td ><a href="#" onClick="javascript:ventanaSecundaria('../ventanas/dividirCuentasOtros.php?almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $myrowa['nomCliente']; ?>&amp;numCliente=<?php echo $myrow['numCliente'];?>&amp;nombreCliente=<?php echo $myrow['nomCliente'];?>&amp;clientePrincipal=<?php echo $myrow['numCliente'];?>')"><?php echo $myrow['responsableCuenta'];?></a></td>
       <td ><?php echo cambia_a_normal($myrow['fecha']);?></td>
       <td >
<?php 
$sSQLc="SELECT 
sum(precioVenta*cantidad) as efectivo

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."'
and
tipoPago='Otros'
and
naturaleza='A'
";


$resultc=mysql_db_query($basedatos,$sSQLc);
$myrowc = mysql_fetch_array($resultc);
echo '$'.number_format($myrowc['efectivo'],2);
?>	   </td>
       <td >
	   <?php 
	   
	   $sSQLa="SELECT 
sum(precioVenta*cantidad) as efectivo

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVentaOtros='".$myrow['folioVenta']."'
and
naturaleza='A'
and
folioVentaOtros!=''
";


$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);
echo '$'.number_format($myrowa['efectivo'],2);
	   
	   
	   ?>	   </td>
       <td >
	   <?php
	   echo '$'.number_format($myrowc['efectivo']-$myrowa['efectivo'],2);
	   ?>

	   </td>
       <td height="29" ><div align="center"><span class="">
       
       <a  href="javascript:ventanaSecundaria('../ventanas/impresionSFV.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow['keyPA']; ?>&numCliente=<?php echo $N; ?>')"> 
       <img src="/sima/imagenes/edit.png" alt="Almacenes" width="20" height="20" border="0" />       </a>

       
       </span></div></td>
     </tr>
     <?php }?>
  </table>

<p align="center"><?php 
if($b>0)
echo 'Se encontraron '.$b.' registros...!';?></p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>