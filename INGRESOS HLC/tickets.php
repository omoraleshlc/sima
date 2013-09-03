<?php require("menuOperaciones.php"); ?>
<?php 
      

if($_GET['update']=='yes' and $_GET['ticket']>0){
    
      $q = "UPDATE rutaTickets set 
status='standby'

 WHERE 
entidad='".$entidad."'
    and
ticket='".$_GET['ticket']."'
";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
echo '<div align="center">Se actualizo el ticket: '.$_GET['ticket'];
    
}




?>
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



<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>



<?php
		 if($_POST['fechaInicial']){
		 $date=$_POST['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
                 
                 
                 if($_POST['fechaFinal']){
		 $date1=$_POST['fechaFinal'];
		 } else {
		 $date1= $fecha1;
		 }
		 
?>
    <br>
<form id="form10" name="form10" method="post" action="#">
  <h1 align="center" >TICKETS EMITIDOS</h1>
  <table width="400" class="table-forma">

    <tr>
      <td width="90"> Fecha Inicial</td>
  
      <td width="126"><label>
          <label>
            <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php echo $date;?>" />
   </label>
   <input name="button" type="button"  id="lanzador" value="..." />
   </label></td>
    </tr>


          <tr>
            <td><label>
            <label>Fecha Final</label></td>
            <td><label>
              <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly="readonly"
		value="<?php echo $date1;?>" />
            </label>
              <input name="lanzador" type="button"  id="lanzador1" value="..." />
            </label></td>
          </tr>


  </table><br />
  <input name="buscar" type="submit"  id="button" value="Buscar" />
  <?php if($_POST['buscar'] or $_GET['update']=='yes'){ ?>
  <p align="center" >&nbsp;</p>

  <table width="716" class="table table-striped">
    <tr >
      <th width="67"   scope="col"><div align="left">Fecha</div></th>
      <th width= "70"   scope="col"><div align="left">Ticket</div></th>
  
	  <th   scope="col"><div align="left" >
        <div align="left">Usuario </div>
      </div></th>
	  <th   scope="col"><div align="left" >
        <div align="left">Status</div>
      </div></th>
	  
      
       <th   scope="col"><div align="left" >
        <div align="left">---</div>
      </div></th>
    </tr>
    <tr>



<?php	


$sSQL= "SELECT *
FROM
rutaTickets
where
entidad='".$entidad."'
and
fecha>='".$date."' and fecha<='".$date1."'

order by ticket ASC
 ";

 
 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$nT=$myrow['keyClientesInternos'];





//*************************OPERACIONES*****************************
/*
 $sSQL7="SELECT 
 SUM(importe) as acumulado,sum(iva) as ivaa
  FROM
facturaGrupos
  WHERE
entidad='".$entidad."'
and
  numFactura='".$myrow['numFactura']."'
and
  naturaleza='C'
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




 $sSQL7d="SELECT 
 SUM(importe) as acumulado,sum(iva) as ivaa
  FROM
facturaGrupos
  WHERE
  entidad='".$entidad."'
  and
  numFactura='".$myrow['numFactura']."'
  and
  naturaleza='A'
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
//********************************************************************
*/	  ?>
      <td height="24" bgcolor="<?php echo $color?>" >
          <div align="left">
              <?php echo cambia_a_normal($myrow['fecha']);
?></div></td>

 <td width="91" bgcolor="<?php echo $color?>" >

<div align="center" >
  <div align="left">
    <?php
echo $myrow['ticket'];
?>
  </div>
</div></td>













<td width="89" bgcolor="<?php echo $color?>" ><div align="left">
  <?php 

	echo $myrow['usuario'];
	
;?>
</div></td>
<td width="77" bgcolor="<?php echo $color?>" >

		  
<?php echo $myrow['status'];?>


</td>


<td width="77" bgcolor="<?php echo $color?>" >
<?php if($myrow['status']=='done'){?>
<a href="tickets.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>&ticket=<?php echo $myrow['ticket'];?>&update=yes&main=<?php echo $_GET['ingresos'];?>&warehouse=<?php echo $_GET['warehouse'];?>" />        
Reenviar
</a>
<?php }else{
   echo 'Request';
}?>
</td>
    </tr> 
    <?php  }}}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
  <br>
<p>&nbsp;</p>
</form>


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