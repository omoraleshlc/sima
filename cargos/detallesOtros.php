<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=700,height=600,scrollbars=YES") 
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


<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
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
 <h1 align="center" class="titulos">Estado de Cuenta<label></label>
 Otros</h1>
 <p align="center">
  <a href="#" onClick="javascript:ventanaSecundaria('../cargos/despliegaCargos.php?folioVenta=<?php echo $_GET['folioVenta']; ?>')">
 <?php echo $_GET['paciente'];?>
 </a>
 </p>
 <form id="form1" name="form1" method="post" action="">

   <p align="center" >&nbsp;</p>
   <table width="500" class="table table-striped">

     <tr >
       <th width="82"  align="center">#Recibo</th>
       <th width="82"  align="center">Fecha  </th>
       <th width="385" >Concepto</th>
       <th width="118" align="center" >Debe</th>
       <th width="106" align="center" >Haber</th>
     </tr>
	 
 <?php   
 
 

  $sSQL= "Select *
 from cargosCuentaPaciente
 where entidad='".$entidad."' 
 AND 
(folioVenta='".$_GET['folioVenta']."' or folioVentaOtros='".$_GET['folioVenta']."')
AND
( tipoTransaccion='totros' or tipoTransaccion='abotros' or tipoTransaccion='devotr'
or
tipoTransaccion='HLCAJOTR' or tipoTransaccion='AJOXINCDEV'
)
  
 and
 gpoProducto=''
 order by fecha1 ASC
   ";

$result=mysql_db_query($basedatos,$sSQL); 



while($myrow = mysql_fetch_array($result)){







if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}





?>
     <tr  >
       <td  align="center">
<?php           
if($myrow['numRecibo']){ ?>

	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>

<?php 
}  ?>         
           
       </td>

       <td height="55"  align="center"><?php echo cambia_a_normal($myrow['fecha1']);?></td>
       <td ><span ><?php echo $myrow['descripcionArticulo'];?></span></td>
       
       
       
       <td  align="right">
	   <div align="center">
	   
	   
	   <?php //DEBE
           if($myrow['tipoTransaccion']=='totros' or $myrow['tipoTransaccion']=='devotr' or $myrow['tipoTransaccion']=='AJOXINCDEV'){ 
               
           echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
	   $debe[0]+=$myrow['precioVenta']*$myrow['cantidad'];
	   }else{
               //echo '$ 0.00';
           }
           
           ?>
	   </div></td>
       
       
       
       
       <td  align="right">
	   <div align="center">
	   <?php //HABER
           
        
           if($myrow['tipoTransaccion']=='HLCAJOTR' or $myrow['tipoTransaccion']=='abotros' ){ 


               
	   $haber[0]+=$myrow['precioVenta']*$myrow['cantidad'];$signo=NULL;
           echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
           }else{
               //echo '$ 0.00';
           }
           
           
	   
        
           ?>
	   </div>	   </td>
     </tr>
     <?php }?>

   </table>
   <table width="500" >
     <tr>
       <td width="76">&nbsp;</td>
       <td width="377">&nbsp;</td>
       <td width="114" ><div align="center" ><?php echo '$'.number_format($debe[0],2);?></div></td>
       <td width="96" ><div align="center" ><?php echo '$'.number_format($haber[0]-$dev[0],2);?></div></td>
     </tr>
     <tr>
       <th>&nbsp;</th>
       <th >Totales</th>
       <th colspan="2"><?php 
       $opera=$debe[0]-($haber[0]-$dev[0]);
       
       if($opera==0){
       echo '<div align="center" class="success">'; 
       echo '$'.number_format($opera,2);
       echo '</div>';
       }else{
       echo '<div align="center" class="error">'; 
       echo '$'.number_format($opera,2);    
       echo '</div>';
       }
       ?> </div></th>
     </tr>

   </table>
   <p align="center">&nbsp;</p>
 </form>
 <p align="center">&nbsp;</p>



</body>
</html>