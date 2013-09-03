<?php require("menuOperaciones.php"); ?>


<?php  
if($_GET['numSolicitud']>0 AND ($_GET['inactiva'] or $_GET['activa'])){

    
    
    
$sSQL12= "
	SELECT *
FROM
    listaRequisiciones

WHERE
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."' 
    
and
status='standby' ";


$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);    
    
	if($_GET['inactiva']=="inactiva"){
            
            
if($myrow12['nRequisicion']){            
$q = "delete from listaRequisiciones

		WHERE 
entidad='".$entidad."'
    and                
numSolicitud='".$_GET['numSolicitud']."' ";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                
                
                $q = "delete from contadorRequisiciones

		WHERE 
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."' ";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                 echo '<div class="error">Se elimino la solicitud!</div>';   
	}

        }

}
?>


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





  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<META HTTP-EQUIV="Refresh"
CONTENT="123"> 
<body>




 <form id="form1" name="form1" method="post" action="#">
  <h1 align="center">
      
  REQUISICIONES DE COMPRAS      
      
  </h1>

  
      <p align="center" >
    <span >Escoge la Fecha </span>
      <input onChange="this.form.submit();" name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
                if(!$_POST['fechaInicial']){
		 echo $fecha1;
                }else{
                    echo $_POST['fechaInicial'];
                }
		 ?>"/>
    </label>
    <input name="button" type="image"  id="lanzador" value="cargar"  src="../imagenes/btns/fechadate.png" />
</p>
  




  
  
   <table width="700" class="table table-striped">
    <tr >

      
      <th width="37" >#Req</th>
   

      <th width="47" >Usuario</th>
            <th width="47" >Hora</th>
                  <th width="47" >Fecha</th>
           
      <th width="54" >Status</th>
        <th width="47" >FechaStatus</th>
     
             <th width="45" >Print</th>
                 <th width="45" ></th>
             <th width="150">Observaciones</th>

    </tr>
    
    
    
    
<?php	
if(!$_POST['fechaInicial']){$_POST['fechaInicial']=$fecha1;}

$cendis=new whoisCendis();




 $sSQL= "
SELECT *
FROM
contadorRequisiciones 
where

entidad='".$entidad."'
and
fecha='".$_POST['fechaInicial']."'
and
id_almacen='".$_GET['datawarehouse']."'

order by fecha DESC";




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$a+=1;



$sSQL8ab= "
SELECT descripcion
FROM
almacenes

WHERE
entidad='".$entidad."'
and
almacen='".$myrow8a['almacen']."'";
$result8ab=mysql_db_query($basedatos,$sSQL8ab);
$myrow8ab = mysql_fetch_array($result8ab);




?>
	  
	  <tr  >
  
  <td  >
  	
  	<?php echo $myrow['contador'];?>
  	
  </td>      
  
  
  
          
  
      
      
      
      
      <td >
          



              <span >
      <?php 
	 echo $myrow['usuario'];
	  ?>
    </span></td>
              
              
              
              
              
              
              
              
      <td ><?php 
echo $myrow['hora'];
?></td>
              
              
              
      <td ><?php echo cambia_a_normal($myrow['fecha']);?></td>
    
       
      
  
       
        <td ><?php echo $myrow['status'];?></td>
       
             <td ><?php 
        if($myrow['fechaRecepcion']!=NULL){
        echo cambia_a_normal($myrow['fechaRecepcion']);
        }else{
            echo '---';
        }
        
        ?></td>

 
 
 
      <td >
 <a href="javascript:ventanaSecundaria('../ventanas/ventanaMuestraRequisicion.php?nRequisicion=<?php echo $myrow['contador'];?>','ventana7','800','600','yes');" />
 <img src="/sima/imagenes/btns/printer.png" width="20" height="20" />
 </a>
          
      </td>  
 
 

   
        
        
        
        
        
        <td  ><div align="left">
                
       <?php if($myrow['status']=='standby'){?>    
           <a href="<?php echo $_SERVER['PHP_SELF'];?>?nRequisicion=<?php echo $myrow['contador']; ?>&datawarehouse=<?php echo $_GET['datawarehouse']; ?>&warehouse=<?php echo $_GET['warehouse']; ?>&main=<?php echo $_GET['main']; ?>&inactiva=<?php echo'inactiva'; ?>&almacen=<?php echo $_GET['almacen'];?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>"> 
                    <img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar esta solicitud?') == false){return false;}" />
                </a>
       <?php }else{ echo '---';}?>
       </div>
               <input name="keyReq[]" type="hidden" value="<?php echo $myrow18['keyReq'];?>" />
        </td>
 
 
      
         
        
        
        <td  ><div align="left">
                
       <?php print $myrow['observaciones'];?>    
           
       </div>
               <input name="keyReq[]" type="hidden" value="<?php echo $myrow18['keyReq'];?>" />
        </td>
      
      
    </tr>
    <?php  }?>
   </table>

<p>&nbsp;</p>

</form>


         <table width="37%" class="table-forma">
      <br></br>
    <tr valign="middle">
      <td width="34%"><div align="center">
              
        <?php 

$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
contadorCompras
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}



$agrega = "INSERT INTO contadorCompras (
usuario,contador,entidad
) values (
'".$usuario."','".$n."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>
        <input onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona aqui para generar una Devolucion';?></div>')" onMouseOut="UnTip()" name="nuevo" 
		type="button"   id="nuevo" value="NUEVA SOLICITUD DE COMPRA" src="/sima/imagenes/btns/genorden.png"
	  onclick="nueva('../ventanas/generaOrdenCompra.php?cargos=cargos&almacen=<?php echo $_GET['datawarehouse'];?>&solicitud=<?php echo $n;?>','ventana7','800','500','yes')" />
      </div></td>


    </tr>
  </table> 
    
    
    
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script>     
    
</body>
</html>