<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?PHP require("/configuracion/funciones.php"); ?>
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
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
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

<?php


if($_POST['del']!=NULL){
  $q = "DELETE FROM cargosCuentaPaciente
 WHERE entidad='".$entidad."'
 and
folioVenta='".$_GET['folioVenta']."' and statusCargo='standbyR'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();

echo '<script>
window.alert( "ARTICULOS/SERVICIOS ELIMINADOS CORRECTAMENTE!");
window.opener.document.forms["form1"].submit();
window.close();
</script>';


}






$sSQL7= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$NUMEROE=$myrow7['numeroE'];

 $sSQL32= "Select * From pacientes WHERE entidad='".$entidad."' and numCliente = '".$NUMEROE."'";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);

$nombrePaciente = $myrow32['nombre1']." ".$myrow32['nombre2']." ".$myrow32['apellido1']." ".
$myrow32['apellido2']." ".$myrow32['apellido3'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>


<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>

<h1 align="center">Articulos Pendientes de Enviar</h1>

<?php echo $leyenda; ?>
<form id="form1" name="form1" method="post" action="#" >
<table width="367" class="table-forma">
	  
	 
      <tr valign="middle"  >
        <th colspan="2" ><div align="center"><span ></span></div></th>
      </tr>
      

	  
	  
	  
	  
	  
	  
	  
	  
	
      <tr valign="middle" >
        <td></td>
        <td><label>
                <div align="center">
          <input name="del" type="submit"  id="transferir" value="Eliminar Articulos/Servicios pendientes" />
          </div>
          <br />
        <br />
        </label></td>
		
		
      </tr>
    </table>
    
    
    <br>
    
    
    
<table width="646s" class="table table-striped">

    <tr>
        <th width="10"  align="left">#</th>
         <th width="30"  align="left">Fecha</th>
      <th width="100"  align="left">Hora</th>
      <th width="30"  align="left">Mov</th>
      <th width="100"  align="left">Descripcion</th>
      <th width="30"  align="left">Usuario</th>

     
      
    </tr>
      <?php	
if(!$_POST['almacenDestino1']){
$_POST['almacenDestino1']=$ALMACEN;
}



$sSQL= "SELECT *
FROM
cargosCuentaPaciente 
WHERE entidad='".$entidad."' 
and
folioVenta='".$_GET['folioVenta']."'
    and
    statusCargo='standbyR'
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$guia+=1;







//************VERIFICO SI PERMITE VENTAS***************

?>    
    
    <tr >
        <td  align="center" ><?php echo $guia;?></td>
      
         <td  align="left">
       <?php echo cambia_a_normal($myrow['fecha1']);?>
          
   </td>
        
           <td  align="left">
       <?php echo $myrow['hora1'];?>
          
   </td>
      
      <td  align="left">
       <?php echo $myrow['keyCAP'];?>
          
   </td>
   
   
      
      <td  align="left">
          
           <?php echo $myrow['descripcionArticulo'];?>      
              
              </td>      
      
   
      <td  align="left">
          
                 <?php echo $myrow['usuario'];?>       
              </td>
              
              
         
      
          <?php  }}?>
      
    </tr>
    

  </table>    
    
    
    
    
    
</form>
  <p align="left" >&nbsp;</p>
<p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>

</body>
</html>