<?PHP require("menuOperaciones.php"); ?>





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
           
        if( vacio(F.nombrePaciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.deposito.value) == false ) {   
                alert("Por Favor, escribe el dep�sito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el m�dico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el l�mite que desees asignar!")   
                return false   
        }   
}   
  
  
  
  
</script>

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=220,height=250,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=1024,height=1118,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Est� Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>


</head>

<body>
<h1 align="center" >Facturar x Extensiones Grupos </h1>
<?php echo $leyenda; ?>
<form id="form1" name="form1" method="post" action="#" >
<?php


$sSQL= "
SELECT * FROM 
clientesInternos 
where 
entidad='".$entidad."'
and
statusFactura='extensionGrupos'
";



$result=mysql_db_query($basedatos,$sSQL);

?>
<p>&nbsp;</p>

<table width="385" class="table table-striped">
  <tr>
        <th width="96" height="19"  scope="col"><div align="left" >Folio Venta </div></th>
      <th width="234"  scope="col"><div align="left" >Paciente</div></th>
      <th width="41"  scope="col" >Editar</th>
    </tr>
      <tr>
        <?php 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 

$bandera+="1";


//cierro descuento

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL1= "
SELECT * FROM 
clientesInternos 
where 
folioVenta='".$myrow['folioVenta']."'
";



$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>


        <td height="24" bgcolor="<?php echo $color;?>" ><?php echo $myrow['folioVenta'];?></td>
		  
		  <td bgcolor="<?php echo $color;?>" >
		<?php echo $myrow1['paciente'];?>
		</td>
        <td bgcolor="<?php echo $color;?>" ><div align="center"><span >
          

          <a href="javascript:ventanaSecundaria20('../ventanas/ventanaFacturaExtensionesGrupos.php?keyClientesInternos=<?php echo $myrow1['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&entidad=<?php echo $entidad;?>&rfc=<?php echo $_POST['rfc'];?>&razonSocial=<?php echo $_POST['razonSocial'];?>&calle=<?php echo $_POST['calle'];?>&colonia=<?php echo $_POST['colonia'];?>&ciudad=<?php echo $_POST['ciudad'];?>&estado=<?php echo $_POST['estado'];?>&cp=<?php echo $_POST['cp'];?>&pais=<?php echo $_POST['pais'];?>&delegacion=<?php echo $_POST['delegacion'];?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $_GET['numCliente'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>');">
		  <img src="../imagenes/btns/addbtn.png" alt="Datos Generales del Paciente" width="24" height="24" border="0" />          
		  </a>
          
          
          
        </span></div></td>
    </tr>

      <?php }?>
    </table>

<p>&nbsp;    </p>
	<p>
	  <input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    </p>
  </form>
  <p>&nbsp;</p>

</body>
</html>
