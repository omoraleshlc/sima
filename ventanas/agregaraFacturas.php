<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");

?>
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



<?php  


if($_GET['temp']=='si' and !$_POST['buscar']){
       $q = "UPDATE facturasAplicadas set
statusPago='',usuarioPago='',fechaPago=''

		WHERE 
entidad='".$entidad."'
    and
    clientePrincipal='".$_GET['seguro']."'
        and
        statusPago='step1'
        
";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
}













if($_POST['definitivo']!=NULL){

    //ACTUALIZA TRANSACCIONES
            $q = "UPDATE facturasAplicadas set
statusPago='pagado',usuarioPago='".$usuario."',fechaPago='".$fecha1."'

		WHERE 
entidad='".$entidad."'
    and
    statusPago='request'
    and
    transaccion='si'
";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
    
    
    
    
    //ACTUALIZA SOLO CARGOS
        $q = "UPDATE facturasAplicadas set
statusPago='pagado',usuarioPago='".$usuario."',fechaPago='".$fecha1."'

		WHERE 
entidad='".$entidad."'
    and
    statusPago='step1'
    and
    transaccion!='si'
";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
$definitivo='si';
                ?>
<script>
window.alert("PAGO APLICADO");
window.opener.document.forms["form1"].submit();
window.close();
</script>

<?php 
    
}














if($definitivo!='si' AND  ($_GET['keyCAP'] AND $_GET['accion']!=NULL and !$_POST['send'])){


 $sSQL= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
numFactura='".$_GET['numFactura']."'
    and
    statusPago!='pagado'
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result); 
    
if($myrow['numFactura']!=''){
	if($_GET['accion']=="enabled"){
       $q = "UPDATE facturasAplicadas set
statusPago='step1'

		WHERE 
entidad='".$entidad."'
    and
    numFactura='".$_GET['numFactura']."'
        and
        transaccion!='si'

";
		mysql_db_query($basedatos,$q);
		echo mysql_error();


           
	} else if($_GET['accion']=="disabled"){
                   $q = "UPDATE facturasAplicadas set
statusPago=''

		WHERE
                entidad='".$entidad."'
        
and
    numFactura='".$_GET['numFactura']."'    
        and
        transaccion!='si'

";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                
	}


}

    $_POST['buscar']=TRUE;
}
?>



<?php 
                 if($_POST['fechaInicial']){
		 $date1= $_POST['fechaInicial'];
                 }elseif($_GET['fechaInicial']){
                 $date1= $_GET['fechaInicial'];
		 } else {
		 $date1= $fecha1;
		 }

                 
                 if($_POST['fechaFinal']){
		 $date2= $_POST['fechaFinal'];
                 }elseif($_GET['fechaFinal']){
                 $date2=  $_GET['fechaFinal'];
                 } else {
		 $date2= $fecha1;
		 }
?>





 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

  
  
  
  
  
  
  

  
  
  
  
  
  
  
  
  
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
 <h1 align="center" class="titulos"><?php echo $_GET['nomSeguro'];?>
 </h1>
    
    <h4>
     <?php echo $_GET['nombre'];?>
    </h4>
    

 <form id="form1" name="form1" method="post" action="">


     
     
<table>
        <tr>
        <th width="600">
        <div class="success" align="center">
            IMPORTE A APLICAR
<?php 

  echo '$'.number_format($_GET['importe'],2);
  ?>
        </div>
    </th>
    </tr>
    </table>     
     
     
     

<?php 


$sSQL7="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
statusPago='step1'
and
naturaleza='C'
 and
 clientePrincipal='".$_GET['seguro']."'
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  
  $sSQL7d="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
statusPago='step1'
and
naturaleza='A'
    and
 clientePrincipal='".$_GET['seguro']."'
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
  
 $importe=($myrow7['acumulado']+$myrow7['ivaa'])-($myrow7d['acumulado']+$myrow7d['ivaa']);
 $importe=sprintf("%01.2f", $importe);
 ?>
     <?php if($importe>0){?>
     <table>
        <tr>
        <th width="600">
        <div class="success" align="center">
            IMPORTE DE FACTURAS
   <?php  echo '$'.number_format($importe,2);

  ?>  
        </div>
    </th>
    </tr>
    </table>        
     <?php } ?>
     
     
     
     
     
     

     
<?php 
  $_GET['importe']=sprintf("%01.2f", $_GET['importe']);
  $diff=$_GET['importe']-$importe; 

 ?>
     <?php if($importe>0){?>
     <table>
        <tr>
        <th width="600">
            
        <?php 
        if($diff==0){  ?>
            
            
        <div class="success" align="center">

            <input type="submit" name="definitivo" value="Aplicar Definitivo"  onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas aplicar este pago?') == false){return false;}">
        </div>
            <?php }else{ ?>
       <div class="error" align="center">
           DIFERENCIA
   <?php  echo '$'.number_format($diff,2);

  ?>  
        </div>
            
            <?php }?>
    </th>
    </tr>
    </table>        
     <?php } ?>     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
   <p align="center" >Fecha Inicial

     <label>
     <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		echo $date1;
		 
		 ?>" />
     </label>
     <input name="button" type="button"  id="lanzador" value="..." />
     <label></label>
  <span >
     a la fecha
</span>
     <label>
     <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly=""
		value="<?php
		echo $date2;
		 ?>" />
     </label>
     <input name="button2" type="button"  id="lanzador1" value="..." />
     <label> <br />
     <br />
     <input name="buscar" type="submit"  id="search" value="Buscar" />
     </label>

</p>


<?php if($_POST['buscar']){



?>



   <table width="500" class="table table-striped">


     <tr >
       <th  align="center"><p align="center">#</p></th>         
       <th  align="center"><p align="center">Factura</p></th>
         <th  align="center"><p align="center">Importe</p></th>
       <th  align="center"><p align="center">Fecha</p></th>
       
       <th align="center" ><p align="center">Escoje</p></th>

     </tr>



<?php
$sSQL= "Select 
*
from facturasAplicadas
where 

entidad='".$entidad."'
and
clientePrincipal='".$_GET['seguro']."'
and
(fecha>='".$date1."' and fecha<='".$date2."')

and
status='facturado'
and
transaccion!='si'
and
statusPago!='aplicado'
group  by numFactura
order by keyAPF ASC

   ";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$bandera+=1;















/*
echo 'cargos: '.$cargos[0].' saldo inicial'.$myrowcp['saldoInicial'].'  devolucion'.$devoluciones[0].' abonos'.$abonos[0];
echo  '<br>';
*/
?>

       
     <tr  >
       <td  align="center"><?php echo $bandera;?></td>
       <td  align="center"><?php echo $myrow['numFactura'];?></td>
       
       <td align="center">
           <?php 
           if($myrow['numFactura']!=NULL){
$sSQL7="SELECT
sum((importe*cantidad)+(iva*cantidad)) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
    numFactura='".$myrow['numFactura']."'
  and
  naturaleza='C'
  and
  transaccion!='si'
  
  
  ";

  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);



  $sSQL7d="SELECT
sum((importe*cantidad)+(iva*cantidad)) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
    numFactura='".$myrow['numFactura']."'
  and
  naturaleza='A'
  and
  transaccion!='si'
  ";

  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
echo '$'.number_format($myrow7['totalCuenta']-$myrow7d['totalCuenta'],2);
  $cargos[0]+=$myrow7['totalCuenta']-$myrow7d['totalCuenta'];
	   }
           ?>
       </td>
       
       
       <td height="55"  align="center">
       <?php 
       
       echo cambia_a_normal($myrow['fecha']);

       ?>
       </td>
       
       
   
 


       
     <td   align="center">        <label>
                         
              
              
              
              
              
    
    <?php 
     if($myrow['statusPago']=='pagado'){
         echo 'Aplicado';
     }else{
    if($myrow['statusPago']=='step1'  ){?>
    <?php echo '---';?>
<?php }else{?>
<a  href="<?php echo $_SERVER['PHP_SELF'];?>?fechaInicial=<?php if($_POST['fechaInicial']){ echo $_POST['fechaInicial'];}else{echo $_GET['fechaInicial'];} ?>&fechaFinal=<?php if($_POST['fechaFinal']){ echo $_POST['fechaFinal'];}else{echo $_GET['fechaFinal'];} ?>&send=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&seguro=<?php if($_POST['seguro']){echo $_POST['seguro'];}else{echo $_GET['seguro'];}?>&escoje=<?php if($_POST['escoje']){echo $_POST['escoje'];}else{echo $_GET['escoje'];}?>&accion=<?php echo "enabled"; ?>&keyCAP=<?php echo $myrow['keyCAP'];?>&nomSeguro=<?php if($_POST['nomSeguro']){echo $_POST['nomSeguro'];}else{echo $_GET['nomSeguro'];}?>&numFactura=<?php echo $myrow['numFactura'];?>&importe=<?php echo $_GET['importe'];?>">
Escojer
</a>
<?php }} ?>              
       

          </label></td>
          
          
          
          
          
      <td   align="center">        <label>
                         
              
              
              
              
           
    
    <?php 
    if($myrow['statusPago']!='step1'){?>
    <?php echo '---';?>
<?php }else{?>
<a href="<?php echo $_SERVER['PHP_SELF'];?>?fechaInicial=<?php if($_POST['fechaInicial']){ echo $_POST['fechaInicial'];}else{echo $_GET['fechaInicial'];} ?>&fechaFinal=<?php if($_POST['fechaFinal']){ echo $_POST['fechaFinal'];}else{echo $_GET['fechaFinal'];} ?>&send=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&seguro=<?php if($_POST['seguro']){echo $_POST['seguro'];}else{echo $_GET['seguro'];}?>&escoje=<?php if($_POST['escoje']){echo $_POST['escoje'];}else{echo $_GET['escoje'];}?>&accion=<?php echo "disabled"; ?>&keyCAP=<?php echo $myrow['keyCAP'];?>&nomSeguro=<?php if($_POST['nomSeguro']){echo $_POST['nomSeguro'];}else{echo $_GET['nomSeguro'];}?>&numFactura=<?php echo $myrow['numFactura'];?>&importe=<?php echo $_GET['importe'];?>">
Quitar
</a>
<?php } ?>              


          </label></td>  




     </tr>
     <?php }?>

     
     
      
     
     
     
     
       
     
     
     
   </table>







   <?php } ?>
<input name="flag" type="hidden" value="<?php echo $bandera;?>" />
   <p align="center">&nbsp;</p>
 </form>
 <p align="center">&nbsp;</p>

<script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario
});
</script>

<script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>

</body>
</html>
