<?php require("menuOperaciones.php");
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
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
   window.open(URL,"ventanaSecundaria51","width=800,height=600,scrollbars=YES") 
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
$ALMACEN=$_GET['almacenDestino'];
 $random=rand(1,900000000);

$q = "insert into contador 
(
usuario,random)
values
('".$usuario."','".$random."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQL7ab="SELECT * 
FROM
contador
WHERE
usuario='".$usuario."'
and
random='".$random."'
order by keyConta DESC

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	
?>
<script>
javascript:ventanaSecundaria511('../cargos/generarReporte.php?almacen=<?php echo $ALMACEN;?>&year=<?php echo $_GET['year']; ?>&mes=<?php echo $_GET['mes']; ?>&random=<?php echo $random;?>');
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
   <div align="center"></div>
   <p align="center">
     <label></label></p>
   <h1 align="center" class="titulomedio">Estad&iacute;stica General, a&ntilde;o: 
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

</h1>
   <p align="center" class="titulomedio">Escoje el Mes:
     <label>
       <select name="mes" id="mes" onChange="javascript:this.form.submit();">
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
   </p>
   <p align="center">
<?php    
$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="" id="almacenDestino" />        
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_GET['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_GET['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
   </p>
   <p align="center">
     

     <label>
	 
     </label><?php if($random){ ?>
   </p>
   
   <table width="888" border="0" align="center">
     <tr>
       <th scope="col">&nbsp;</th>
       <th scope="col"></th>
       <th scope="col">&nbsp;</th>
       <th scope="col">
	   
	   
	   <a href="javascript:ventanaSecundaria51('../cargos/estadisticasxAseguradora.php?almacen=<?php echo $ALMACEN;?>&year=<?php echo $_GET['year']; ?>&mes=<?php echo $_GET['mes']; ?>&random=<?php echo $random;?>')">x Aseguradora </a></th>
       <th scope="col"><a href="javascript:ventanaSecundaria51('../cargos/estadisticasxMedico.php?almacen=<?php echo $ALMACEN;?>&amp;year=<?php echo $_GET['year']; ?>&amp;mes=<?php echo $_GET['mes']; ?>&amp;random=<?php echo $random;?>')">x Medico </a></th>
       <th scope="col">&nbsp;</th>
       <th scope="col">&nbsp;</th>
     </tr>
   </table>


     <p>&nbsp;   </p>
     <p>&nbsp;</p>
     <p>
       <input type="hidden" name="bandera" id="bandera" value="<?php echo $a;?>" />
       
       
       <input type="hidden" name="random" id="random" value="<?php echo $random;?>" />
       
       
       
       <?php } ?>
       
       <input type="submit" name="fv" id="fv" value="Generar Reporte" />
               </p>
 </form>
 
<p align="center">&nbsp;</p>

</body>
</html>