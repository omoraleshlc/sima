<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language="javascript" type="text/javascript">

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
if(!$_GET['almacenDestino']){
$_GET['almacenDestino']=$_GET['almacenDestino'];
}
if(!$_GET['almacenDestino1']){
$_GET['almacenDestino1']=$_GET['almacenDestino1'];
}
?>



 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script>
  
  
  
  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>

<body>

  <h1 align="center" >Antibioticos</h1>

<form id="form2" name="form2" method="get" >

    
    
    
    
  <table width="300" class="table-forma">
    
          
    <tr>
      <td height="30" ><div align="left" >Fecha Inicial </div></td>
      <td ><div align="left">
          <label>
          <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_GET['fechaInicial']){
		 echo $_GET['fechaInicial'];
		 }
		 ?>"/>
          </label>
          <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" />
      </div></td>
    </tr>
    <tr>
      <td height="34" ><div align="left" >Fecha Final </div></td>
      <td ><div align="left">
        <label></label>
        <label></label>
        <label>
        <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_GET['fechaFinal']){
		 echo $_GET['fechaFinal'];
		 }
		 ?>"/>
        </label>
        <input name="button1" type="image"src="/sima/imagenes/btns/fecha.png" />
      </div></td>
    </tr>

  </table><br />
  
  <label>
        
        <div align="center">
          <input name="busca" type="submit"  id="button" value="Buscar" />
        </div>
      </label>
  <p>
    <?php if($_GET['busca'] and $_GET['fechaInicial'] and $_GET['fechaFinal']) { ?>
  </p>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <table width="900" class="table table-striped">
     
      

     
     
      <tr >
         
                <th  ><div align="left" >
        <div align="left">#</div>
      </div></th>

      <th  ><div align="left" >
        <div align="left">Fecha</div>
      </div></th>
      
      
          
      <th   ><div align="left" >
        Folio V
      </div></th>
      
      <th  ><div align="left" >
        <div align="left">Nombre del paciente</div>
      </div></th>
     
           <th  ><div align="left" >
        <div align="left">Antibiotico</div>
      </div></th>
      
            <th  ><div align="left" >
        <div align="left">Cantidad</div>
      </div></th>

      
            <th  ><div align="left" >
        <div align="left">Grupo</div>
      </div></th>
      
      
            <th  ><div align="left" >
        <div align="left">Medico</div>
      </div></th>
      
            <th  ><div align="left" >
        <div align="left">Cedula</div>
      </div></th>
      
      <th  ><div align="left" >
        <div align="left">Universidad</div>
      </div></th>

      


            <th  ><div align="left" >
        <div align="left">---</div>
      </div></th>
      
    </tr>
  
<?php	






 
$sSQL= "SELECT *
  FROM
  antibioticos
  Where 
  entidad='".$entidad."'
  and
  fechaCaptura >= '".$_GET['fechaInicial']."' and fechaCaptura<='".$_GET['fechaFinal']."'
  order by fechaCaptura ASC

 ";

 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){

$a+=1;



$sSQL7="SELECT sum(precioVenta*cantidad)+sum(iva*cantidad) as cargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
    and
keyClientesInternos='".$myrow['keyClientesInternos']."'
    and
    keyCAP='".$myrow['keyCAP']."'
and
naturaleza='C'
and gpoProducto!=''


  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);



$sSQL7b="SELECT sum(precioVenta*cantidad)+sum(iva*cantidad) as abonos
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
    and
keyClientesInternos='".$myrow['keyClientesInternos']."'
    and
    keyCAP='".$myrow['keyCAP']."'
and
naturaleza='A'
and
gpoProducto=''

  ";
  $result7b=mysql_db_query($basedatos,$sSQL7b);
  $myrow7b = mysql_fetch_array($result7b);

$sSQL7d="SELECT sum(precioVenta*cantidad)+sum(iva*cantidad) as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
    and
keyClientesInternos='".$myrow['keyClientesInternos']."'
    and
    keyCAP='".$myrow['keyCAP']."'
and
gpoProducto!='' and
statusDevolucion='si'
  ";
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
  
  $sSQL7p="SELECT paciente, folioDevolucion
FROM
clientesInternos
WHERE
keyClientesInternos='".$myrow['keyClientesInternos']."'


  ";
  $result7p=mysql_db_query($basedatos,$sSQL7p);
  $myrow7p = mysql_fetch_array($result7p);
  
  
  //print '$'.number_format(($myrow7['cargos']-$myrow7d['devoluciones'])-$myrow7a['abonos'],2);
          $totalAntibioticos[0]+=($myrow7['cargos']-$myrow7d['devoluciones'])-$myrow7a['abonos'];
          
          
$sSQL1= "Select * From clientesInternos WHERE  keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);  

$sSQL1a= "Select descripcionArticulo,folioVenta From cargosCuentaPaciente WHERE  fechaCierre!='' and  keyCAP='".$myrow['keyCAP']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);  


?>
    
    
  
<tr  > 
 
    
    
            <td width="10" bgcolor="<?php echo $color?>" >
       
        <?php
          echo $myrow['keyanti'];
         
          ?>
    </td>
    
    
    
        <td width="10" bgcolor="<?php echo $color?>" >
       
          <?php
           echo '</br>';
           echo cambia_a_normal($myrow['fechacaptura']);
           echo '</br>';echo '</br>';
          ?>
    </td>
    
    
    
    <td width="10" bgcolor="<?php echo $color?>" >
       
        <?php echo $myrow1a['folioVenta']; ?>
    </td>
      

      
    
    
    <td width="100" bgcolor="<?php echo $color?>" >
         
      
<?php print $myrow['paciente'];

if($myrow7p['folioDevolucion']!=NULL){
echo '</br>';

echo '<b> Devolucion: </b>'; print $myrow7p['folioDevolucion'];

}
?>

        
       <?php
       if($myrow1a['folioVenta']==''){
           echo '<div class="error">Cuenta Cancelada!</div>';
       } 
       ?>

      </td>
 
      



<td width="10" bgcolor="<?php echo $color?>" ><?php print $myrow1a['descripcionArticulo'];?></td>


      <td width="10" bgcolor="<?php echo $color?>" ><?php print $myrow['piezas'];?></td>
      
      
      <td width="10" bgcolor="<?php echo $color?>" ><?php print $myrow['grupo'];?></td>

            <td width="10" bgcolor="<?php echo $color?>" ><?php print $myrow['nombremedico'];?></td>
      
            
                  <td width="10" bgcolor="<?php echo $color?>" ><?php print $myrow['cedula'];?></td>
                  
                        <td width="10" bgcolor="<?php echo $color?>" ><?php print $myrow['universidad'];?></td>
       
             
    </tr>
     
      
    <?php  }?>

   
     
  </table>
  <p>&nbsp;</p>
  
  
  
  
  
  <table width="271" >
    <tr>
      <th width="126"  scope="col"><div align="left" >Total Antibioticos</div></th>
      <th width="135"  scope="col"><div align="left" >
    <?php print '$'.number_format($totalAntibioticos[0],2);?>
      </div></th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p align="center" >&nbsp;</p>
  <p align="center" ><em>Total de Ventas de Antibioticos <?php print $a;?></em></p>
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p>
    <?php  }?>
  </p>
  <p>&nbsp;</p>
  <input type="hidden" name="main"  value="<?php echo $_GET['main'];?>">
  <input type="hidden" name="warehouse"  value="<?php echo $_GET['warehouse'];?>">
  <input type="hidden" name="datawarehouse"  value="<?php echo $_GET['datawarehouse'];?>">
</form>
<p>&nbsp; </p>
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
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
</body>
</html>
