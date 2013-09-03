<?php require("menuOperaciones.php"); ?>


<?php  
if($_GET['nRequisicion']>0 AND ($_GET['inactiva'] or $_GET['activa'])){

    
    
    
$sSQL12= "
	SELECT *
FROM
    listaRequisiciones

WHERE
entidad='".$entidad."'
    and

nRequisicion='".$_GET['nRequisicion']."'
    
and
status='standby' ";


$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);    
    
	if($_GET['inactiva']=="inactiva"){
            
            
if($myrow12['nRequisicion']!=NULL){            
$q = "delete from listaRequisiciones

		WHERE 
entidad='".$entidad."'
    and                
nRequisicion='".$_GET['nRequisicion']."' ";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                
                
                $q = "delete from contadorRequisiciones

		WHERE 
entidad='".$entidad."'
    and
contador='".$_GET['nRequisicion']."' ";
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
      
  LISTA DE REQUISICIONES DE COMPRAS      
      
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
    <th width="250" >Departamento</th>

      <th width="10" >Usuario</th>
            <th width="10" >Hora</th>
                  <th width="10" >Fecha</th>
      <th width="10" >Status</th>
   <th width="47" ></th>
             <th width="10" >Print</th>
  

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
	 echo $myrow['descripcionAlmacen'];
	  ?>
    </span></td>
              
              
              
              
      
      
      
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
      
      
      
      
      
      <td > 
 <?php if($myrow['status']=='enProceso' or $myrow['status']=='standby'){?>

          <?php echo $myrow['status'];?>
          

      <?php }else{
          
      echo $myrow['status'];
      }?>
      </td>
       
      
      

 <td >
 <a href="javascript:nueva('../ventanas/ventanaActivarArticulos.php?nRequisicion=<?php echo $myrow['contador'];?>','ventana7','800','600','yes');" />
Detalles
 </a>
          
      </td> 
       
       
 
 
 
      <td >
 <a href="javascript:nueva('../ventanas/ventanaMuestraRequisicion.php?nRequisicion=<?php echo $myrow['contador'];?>','ventana7','800','600','yes');" />
 <img src="/sima/imagenes/btns/printer.png" width="20" height="20" />
 </a>
          
      </td>  
 
 

   
 
 
    </tr>
    <?php  }?>
   </table>

<p>&nbsp;</p>

</form>


        
    
    
    
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script>     
    
</body>
</html>