<?PHP require("menuOperaciones.php"); ?>

<script language=javascript>
function ventanaSecundaria10 (URL){
   window.open(URL,"ventanaSecundaria10","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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





<?php  
if($_GET['keyCAP'] AND $_GET['accion']!=NULL and !$_POST['send']){


$sSQL= "
SELECT *
FROM
facturasAplicadas
WHERE
keyCAP='".$_GET['keyCAP']."'
    and
    statusPago!='pagado'
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result); 
    
if($myrow['keyCAP']!=NULL and $myrow['gpoProducto']=='' ){

	if($_GET['accion']=="enabled"){
         $q1 = "UPDATE facturasAplicadas set
statusPago='request',usuarioPago='".$usuario."'

		WHERE keyCAP='".$_GET['keyCAP']."'";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();

           
	} else if($_GET['accion']=="disabled"){

                
         $q1 = "UPDATE facturasAplicadas set
statusPago='',usuarioPago=''

		WHERE keyCAP='".$_GET['keyCAP']."'";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();
	}


}
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














if($_POST['seguro']!=NULL){
    $clientePrincipal=$_POST['seguro'];
}else{
    $clientePrincipal=$_GET['seguro'];
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
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<head>

    
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	</head>    
    
    
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

	


<body>

                
                
                
        <script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />       
                

<form id="form10" name="form1" method="POST" >
  <h1 align="center" >APLICAR PAGOS Y NOTAS DE CREDITO
    
  </h1>

    <h3>

   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>        
        
    </h3>
    
<table width="200" class="table-forma">
   <tr>
     <td>
       <tr></tr>
       <tr>
         <td scope="col"><div align="left">DESDE</div></td>
         <td scope="col"><div align="left">
           <input name="fechaInicial" type="text" class="camposmid" id="campo_fecha1" size="11" maxlength="11" readonly=""
		value="<?php
		 echo $date1;
		 ?>"  />
         </div></td>
         <td scope="col"><div align="center">
           <input name="button" type="button" src="../../imagenes/btns/fecha.png" id="lanzador1" value="..." />
         </div></td>
       </tr>
       <tr>
         <td><div align="left">HASTA</div></td>
         <td><div align="left">
           <input name="fechaFinal" type="text" class="camposmid" id="campo_fecha2" size="11" maxlength="11" readonly=""
		value="<?php
echo $date2;
		 ?>"  />
         </div></td>
         <td><div align="center">
           <input name="button1" type="button" src="../../imagenes/btns/fecha.png" id="lanzador2" value="..." />
         </div></td>
         
         
         
        
          
          
          
          
          
               <tr >
   <td><div align="left">Seguro</div></td>
        <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php 
		if($_POST['seguro']!='' ){ 
		echo $_POST['seguro'];
		}else{
                    echo $_GET['seguro'];
                }
		?>" 
		 />
      
        
 
        
        <td colspan="4"><input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php 
		if($_POST['seguro'] !=''){ 
		echo $_POST['nomSeguro'];
		}else{
                    echo $_GET['nomSeguro'];
                }
		?>"/>
        <span ></span></td>
      </tr>
         <td> <input name="send" type="Submit" src="../../imagenes/btns/fecha.png"  value="Buscar" /></td>
       </tr>
     </td>
   </tr>
   </table>    
    
    <br>
    <br>
    <?php 

    if(($_POST['send']!=NULL or $_GET['send']!=NULL)  and ($_POST['seguro']!=NULL or $_GET['seguro']!=NULL)){?>
    
    
    
    
    
    
    
    
<?php 

$sSQL7="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
            and
    statusPago='request'
and
transaccion='si'
and
(fecha>='".$date1."' and fecha<='".$date2."')
    and
      
clientePrincipal='".$clientePrincipal."'

  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  $importe=$myrow7['acumulado']+$myrow7['iva'];
  
  ?>
    
    <?php if($importe>0){?>
  <table>
        <tr>
        <th width="600">
        <div class="success" align="center">
            IMPORTE A APLICAR
  <?php 
  echo '$'.number_format($myrow7['acumulado']+$myrow7['iva'],2);
  ?>
        </div>
    </th>
    </tr>
    </table>
    <?php }?>
    
    
  <table width="562" class="table table-striped">
    <tr>
         <th width="10"  scope="col"><div align="left">#</div></th>
      <th width="74"  scope="col"><div align="left">Fecha</div></th>
      <th width= "270"  scope="col"><div align="left">Aseguradora</div></th>
	  
	 
          <th  scope="col">Tipo</th>
	  <th  scope="col"></th>
          <th  scope="col"></th>
	<th  scope="col"><div align="right">Importe</div></th>
    </tr>
    <tr>
      <?php	


 
$sSQL= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
and
(fecha>='".$date1."' and fecha<='".$date2."')
    and
      
clientePrincipal='".$clientePrincipal."'
    and
statusPago!='pagado'
and
transaccion='si'
";


if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


?>

          <td  ><?php echo $a;?></td>
      <td ><?php echo cambia_a_normal($myrow['fecha']);?></td>


      <td  ><?php 

		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$myrow['clientePrincipal']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];

?>


<br />

<span > Recibo: </span>
	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">

<?php echo 'Recibo: '.$myrow['numRecibo'];?>
              </a>
</span></td>


     
      
      
      
      
      
      
<td  >

    <?php 
    if( $myrow['notaCredito']=='si'){
    print 'NotaCredito';
    }else{
    print 'Abono';    
    }
    ?>

</td>
      
      
      
      
      <td   align="center">        <label>
                         
              
              
              
              
              
              <?php   if($myrow['naturaleza']=='A'){?>

    
    <?php 
    if($myrow['statusPago']=='request'){?>
    <?php echo '';?>
<?php }else{?>
<a href="<?php echo $_SERVER['PHP_SELF'];?>?fechaInicial=<?php echo $date1; ?>&fechaFinal=<?php if($_POST['fechaFinal']){ echo $_POST['fechaFinal'];}else{echo $_GET['fechaFinal'];} ?>&send=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&seguro=<?php if($_POST['seguro']){echo $_POST['seguro'];}else{echo $_GET['seguro'];}?>&escoje=<?php if($_POST['escoje']){echo $_POST['escoje'];}else{echo $_GET['escoje'];}?>&accion=<?php echo "enabled"; ?>&keyCAP=<?php echo $myrow['keyCAP'];?>&nomSeguro=<?php if($_POST['nomSeguro']){echo $_POST['nomSeguro'];}else{echo $_GET['nomSeguro'];}?>">
Escojer
</a>
<?php } ?>              
           <?php }else{ ?>
 Devolucion..
            <?php } ?>

          </label></td>
          
          
          
          
          
      <td   align="center">        <label>
                         
              
              
              
              
              
              <?php   if($myrow['naturaleza']=='A'){?>

    
    <?php 
    if($myrow['statusPago']!='request'){?>
    <?php echo '';?>
<?php }else{?>
<a href="<?php echo $_SERVER['PHP_SELF'];?>?fechaInicial=<?php if($_POST['fechaInicial']){ echo $_POST['fechaInicial'];}else{echo $_GET['fechaInicial'];} ?>&fechaFinal=<?php if($_POST['fechaFinal']){ echo $_POST['fechaFinal'];}else{echo $_GET['fechaFinal'];} ?>&send=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&seguro=<?php if($_POST['seguro']){echo $_POST['seguro'];}else{echo $_GET['seguro'];}?>&escoje=<?php if($_POST['escoje']){echo $_POST['escoje'];}else{echo $_GET['escoje'];}?>&accion=<?php echo "disabled"; ?>&keyCAP=<?php echo $myrow['keyCAP'];?>&nomSeguro=<?php if($_POST['nomSeguro']){echo $_POST['nomSeguro'];}else{echo $_GET['nomSeguro'];}?>">
Quitar
</a>
<?php } ?>              
           <?php }else{ ?>
 Devolucion..
            <?php } ?>

          </label></td>          
          
          
                <td align="right" ><?php
echo '$'.number_format( $myrow['importe']*$myrow['cantidad'],2);
$i=$myrow['importe']*$myrow['cantidad'];
?></td>
          
    
    </tr> 
    <?php  }}
    
    }
    ?>
    
    <tr>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
     <input name="registros" type="hidden" value="<?php echo $a;?>" />
        
  </tr>
  </table>

<?php if($importe>0){?>
 
    <table>
        <tr>
        <th width="600">
        <div class="success" align="center">
<a href="javascript:ventanaSecundaria('../ventanas/agregaraFacturas.php?temp=si&importe=<?php echo $importe;?>&fechaInicial=<?php if($_POST['fechaInicial']){ echo $_POST['fechaInicial'];}else{echo $_GET['fechaInicial'];} ?>&fechaFinal=<?php if($_POST['fechaFinal']){ echo $_POST['fechaFinal'];}else{echo $_GET['fechaFinal'];} ?>&send=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&seguro=<?php if($_POST['seguro']){echo $_POST['seguro'];}else{echo $_GET['seguro'];}?>&escoje=<?php if($_POST['escoje']){echo $_POST['escoje'];}else{echo $_GET['escoje'];}?>&accion=<?php echo "disabled"; ?>&keyCAP=<?php echo $myrow['keyCAP'];?>&nomSeguro=<?php if($_POST['nomSeguro']){echo $_POST['nomSeguro'];}else{echo $_GET['nomSeguro'];}?>')">
    <blink> Agregar a Factura</blink>
</a>    
        </div>
    </th>
    </tr>
    </table>
<?php }?>
</form>

  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipalesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
   
<p align="center">&nbsp;</p>
  <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
  <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha2",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario
});
</script>
</body>
</html>