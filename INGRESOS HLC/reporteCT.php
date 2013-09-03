<?PHP require("menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 
<?php
$numeroE=$_GET['numeroE'];
$nCuenta=$_GET['nCuenta'];
?>


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
<title></title>

<?php
$estilo= new muestraEstilos();
$estilo-> styles();
?>
</head>

<body>
 <h1 align="center" >Folios Transferidos CxC</h1>
 <form id="form2" name="form2" method="post" >
 <p align="center">
   <?php   
$sSQL= "Select * From clientesInternos where entidad='".$entidad."'
and
fecha='".$_POST['fechaInicial']."'
and
seguro!=''
and
statusCaja='pagado'
order by folioVenta,almacen ASC

;
";
$result=mysql_db_query($basedatos,$sSQL); 

?>
   <label>
   <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
   </label>
   <input name="button" type="button"  id="lanzador" value="..." />
   <label>
   <input name="search" type="submit"  id="button" value="Buscar" />
   </label>
 </p>

 <table width="756" class="table table-striped" >
     <tr >
       <th width="59"   scope="col"><div align="left" >
         <div align="center">Folio</div>
       </div></th>
       <th width="225"   scope="col"><div align="left" >
         <div align="center">Paciente</div>
       </div></th>
       <th width="195"   scope="col"><div align="left" >
         <div align="center">Seguro</div>
       </div></th>
       <th width="179"   scope="col"><div align="left" >
         <div align="center">Departamento</div>
       </div></th>
       <th width="76"   scope="col"><div align="left" >
         <div align="center">Importe</div>
       </div></th>
     </tr>
     
     <tr >
      
       <?php	while($myrow = mysql_fetch_array($result)){


$N=$myrow['segu'];
$sSQL22= "Select sum(precioVenta) as acumulado From cargosCuentaPaciente WHERE 
naturaleza='A'
and
folioVenta='".$myrow['folioVenta']."'

";
$result22=mysql_db_query($basedatos,$sSQL22);
$myrow22 = mysql_fetch_array($result22);



$sSQL22a= "Select descripcion From almacenes WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['almacen']."'

";
$result22a=mysql_db_query($basedatos,$sSQL22a);
$myrow22a = mysql_fetch_array($result22a);

$sSQL22b= "Select nomCliente From clientes WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['seguro']."'

";
$result22b=mysql_db_query($basedatos,$sSQL22b);
$myrow22b = mysql_fetch_array($result22b);
?>
<tr  > 
 <td bgcolor="<?php echo $color;?>" ><?php echo $myrow['folioVenta']?></td>
       <td bgcolor="<?php echo $color;?>" >
	   
	   <?php echo $myrow['paciente'];?>
	   
	   </span></td>
       <td bgcolor="<?php echo $color;?>" ><div align="center"><?php echo $myrow22b['nomCliente'];?></div>
       <div align="center"></div></td>
       <td bgcolor="<?php echo $color;?>" ><div align="center"><?php echo $myrow22a['descripcion'];?></div></td>
       <td bgcolor="<?php echo $color;?>" ><div align="right">
         <?php 
	 
	   echo "$".number_format($myrow22['acumulado'],2);
	 
	   ?>
       </span></span></div></td>
     </tr>
     <?php }?>
   </table>

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