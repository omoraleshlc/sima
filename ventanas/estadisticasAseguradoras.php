<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php 
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script> 
  
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el almacen/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este almacen!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=600,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=2024,height=1024,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria511 (URL){ 
   window.open(URL,"ventanaSecundaria511","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA (URL){ 
   window.open(URL,"ventanaSecundariaA","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA2 (URL){ 
   window.open(URL,"ventanaSecundariaA2","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA1 (URL){ 
   window.open(URL,"ventanaSecundariaA1","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria5111(URL){ 
   window.open(URL,"ventanaSecundaria5111","width=800,height=600,scrollbars=YES") 
} 
</script>






<?php 



if($_GET['fv'] and $_GET['mes'] ){
// $random=rand(1,900000000);
//
//$q = "insert into contador
//(
//usuario,random)
//values
//('".$usuario."','".$random."')";
//mysql_db_query($basedatos,$q);
//echo mysql_error();
//
//$sSQL7ab="SELECT *
//FROM
//contador
//WHERE
//usuario='".$usuario."'
//and
//random='".$random."'
//order by keyConta DESC
//
//";
//$result7ab=mysql_db_query($basedatos,$sSQL7ab);
//$myrow7ab = mysql_fetch_array($result7ab);
?>
<script>
//javascript:ventanaSecundaria511('/sima/cargos/generarReporte.php?almacen=<?php echo $_GET['datawarehouse'];?>&year=<?php echo $_GET['year']; ?>&mes=<?php echo $_GET['mes']; ?>&random=<?php echo $random;?>');
//window.alert("Se genero el numero de reporte: <?php print $myrow7ab['random'];?>");

</script>
<?php 
}
?>













<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
 <h1 align="center" class="titulos">REPORTES</h1>
 <form id="form2" name="form2" method="get" >
     
     
     
     <br>
     
     <table class="table-forma">     
  
  
   
   
   <tr>   

       
      <div align="center">Escoje la Entidad  
   <?php 
$sqlNombre11 = "SELECT * from entidades 

ORDER BY codigoEntidad ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
  <select name="entidades" class="normal" />
<option value="">Escoje la entidad</option>

  

  <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
  <option
    <?php   if($_GET['entidades']==$rNombre11["codigoEntidad"])echo 'selected'; ?>
   value="<?php echo $rNombre11["codigoEntidad"];?>"> <?php echo $rNombre11["descripcionEntidad"];?></option>
  <?php } ?>
</select>
</div>
   
   
   
   <br>
 <span class="precio1">Estad&iacute;stica General, a&ntilde;o:
           <?php 
$year= date(Y);

?>
 
  
     
      
      
      
     
     
     
     
     <select name="year" >
             <option value="">........</option>
             <option
<?php if(($year-2)==$_GET['year'])echo 'selected="selected"';?>
 value="<?php echo $year-2;?>"><?php echo $year-2;?></option>
             <option
<?php if(($year-1)==$_GET['year'])echo 'selected="selected"';?>
 value="<?php echo $year-1;?>"><?php echo $year-1;?></option>
             <option 
<?php if(($year)==$_GET['year'])echo	'selected="selected"';?>
value="<?php echo $year;?>"><?php echo $year;?></option>
           </select>
       </span>
       <span class="precio1">Escoje el Mes:
           <label>
             <select name="mes" id="mes" >
               <option value="">........</option>
               <option
       <?php if($_GET['mes']=='01'){ 
	   echo 'selected=""';
	   }
	   ?>
       value="01">Enero</option>
               <option
              <?php if($_GET['mes']=='02'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="02">Febrero</option>
               <option
              <?php if($_GET['mes']=='03'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="03">Marzo</option>
               <option
              <?php if($_GET['mes']=='04'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="04">Abril</option>
               <option
              <?php if($_GET['mes']=='05'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="05">Mayo</option>
               <option
           <?php if($_GET['mes']=='06'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="06">Junio</option>
               <option
              <?php if($_GET['mes']=='07'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="07">Julio</option>
               <option
              <?php if($_GET['mes']=='08'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="08">Agosto</option>
               <option
              <?php if($_GET['mes']=='09'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="09">Septiembre</option>
               <option
              <?php if($_GET['mes']=='10'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="10">Octubre</option>
               <option
              <?php if($_GET['mes']=='11'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="11">Noviembre</option>
               <option
              <?php if($_GET['mes']=='12'){ 
	   echo 'selected=""';
	   }
	   ?>
        value="12">Diciembre</option>
             </select>
           </label>
       </span>
       
       <br /> <br />
       <span class="precio1">Grupo de Producto</span>
         <?php //*********gpoProductos

 $sSQL7= "Select * From gpoProductos  ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7);
echo mysql_error();
	  ?>
         <select name="gpoProducto" class="normal" id="gpoProducto[]">
           <option value="">Escoje el Grupo</option>
           <?php
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
           <option
		   <?php if($myrow7['codigoGP']==$_GET['gpoProducto']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
           <?php }

		?>
       </select>
       
<br />
<br />


<div align="center">Departamento
                 <?php 
                 $aCombo= "Select * From almacenes where ventas='si' and
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') 
and
stock!='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacen" id="almacenDestino" class="normal" />

  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){


		?>
        <option
		<?php
		if($ALMACEN==$resCombo['almacen'] and !$_GET['almacen']){

		echo 'selected="selected"';
		} else if($_GET['almacen'] ==$resCombo['almacen']){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>

             </div>


</tr>

<br /><br />

     </table>



   <?php
   if($_GET['fv']!=NULL){
   if($_GET['entidades']!=NULL and $_GET['mes']!=NULL and $_GET['year']!=NULL and $_GET['gpoProducto']!=NULL and $_GET['almacen']!=NULL){ ?>
     <script>
     javascript:ventanaSecundaria51('../cargos/ReporteEstadisticaxAseguradora.php?entidades=<?php echo $_GET['entidades'];?>&tipoReporte=estadisticasAseguradoras1&almacen=<?php echo $_GET['almacen'];?>&year=<?php echo $_GET['year']; ?>&mes=<?php echo $_GET['mes']; ?>&random=<?php echo $random;?>&gpoProducto=<?php echo $_GET['gpoProducto'];?>');
    </script>
   
   

<?php }else{

$tipoMensaje='error';
$encabezado='Error';
$texto='Te faltan campos por llenar!';



}
?>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
<?php } ?>
     <p>&nbsp;   </p>
     <p>&nbsp;</p>
     <p>
       <input type="hidden" name="bandera" id="bandera" value="<?php echo $a;?>" />
       
       
       <input type="hidden" name="random" id="random" value="<?php echo $random;?>" />
       
       
       
  
       
       <input type="submit" name="fv" id="fv" value="Generar Reporte" />
               </p>
               
               
               
    
    <input name="main" type="hidden" value="<?php echo $_GET['main'];?>">
    <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>">
    <input name="datawarehouse" type="hidden" value="<?php echo $_GET['datawarehouse'];?>">               
 </form>
 
<p align="center">&nbsp;</p>

</body>
</html>