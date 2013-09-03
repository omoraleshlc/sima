<?PHP require("menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<head>



	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
    <br>
    <br>
 <br>

<form name="form1" method="post">
  <h1 align="center" >
      
      Estado de Cuenta Aseguradoras
  
  </h1>
  
<?php
if(!$_POST['fechaInicial']){$_POST['fechaInicial']=$fecha1;}if(!$_POST['fechaFinal']){$_POST['fechaFinal']=$fecha1;}
?>
  
<?php /* ?>
    <table border="0" cellpadding="0" cellspacing="0" class="navigation">
<tr>
    <td class="navigation_separator"></td>
       <td>
        <form action="sql.php?db=sima&amp;table=almacenAlmacenes&amp;sql_query=SELECT+%2A+FROM+%60almacenAlmacenes%60&amp;goto=tbl_structure.php&amp;token=9ddf4e240bebda360314fd610124864f" method="post"> <select id="pageselector"  class="ajax" name="pos" >
                <option selected="selected" style="font-weight: bold" value="0">1</option>
                <option  value="30">2</option>
                <option  value="60">3</option>
                <option  value="90">4</option>
                <option  value="120">5</option>
 </select><noscript><input type="submit" value="Go" /></noscript>        </form>
    </td>
        
    <td>
        <form action="sql.php" method="post">
            <input type="hidden" name="db" value="sima" /><input type="hidden" name="table" value="almacenAlmacenes" /><input type="hidden" name="token" value="9ddf4e240bebda360314fd610124864f" />            <input type="hidden" name="sql_query" value="SELECT * FROM `almacenAlmacenes`" />
            <input type="hidden" name="pos" value="0" />
            <input type="hidden" name="session_max_rows" value="all" />
            <input type="hidden" name="goto" value="tbl_structure.php" />
            <input type="submit" name="navig" value="Show all" />
        </form>
    </td>
        <td>
    <form action="sql.php" method="post" >
        <input type="hidden" name="db" value="sima" /><input type="hidden" name="table" value="almacenAlmacenes" /><input type="hidden" name="token" value="9ddf4e240bebda360314fd610124864f" />        <input type="hidden" name="sql_query" value="SELECT * FROM `almacenAlmacenes`" />
        <input type="hidden" name="pos" value="30" />
        <input type="hidden" name="goto" value="tbl_structure.php" />
                <input type="submit" name="navig"  class="ajax"  value="&gt;" title="Next" />
    </form>
</td>
<td>
    <form action="sql.php" method="post" onsubmit="return true">
        <input type="hidden" name="db" value="sima" /><input type="hidden" name="table" value="almacenAlmacenes" /><input type="hidden" name="token" value="9ddf4e240bebda360314fd610124864f" />        <input type="hidden" name="sql_query" value="SELECT * FROM `almacenAlmacenes`" />
        <input type="hidden" name="pos" value="120" />
        <input type="hidden" name="goto" value="tbl_structure.php" />
                <input type="submit" name="navig"  class="ajax"  value="&gt;&gt;" title="End" />
    </form>
</td>
<td><div class="navigation_separator">|</div></td>    <td>
        <div class="save_edited hide">
            <input type="submit" value="Save edited data" />
            <div class="navigation_separator">|</div>
        </div>
    </td>
    <td>
        <div class="restore_column hide">
            <input type="submit" value="Restore column order" />
            <div class="navigation_separator">|</div>
        </div>
    </td>

    <td class="navigation_goto">
        <form action="sql.php" method="post"   onsubmit="return (checkFormElementInRange(this, 'session_max_rows', '%d is not valid row number.', 1) &amp;&amp; checkFormElementInRange(this, 'pos', '%d is not valid row number.', 0-1))">
            <input type="hidden" name="db" value="sima" /><input type="hidden" name="table" value="almacenAlmacenes" /><input type="hidden" name="token" value="9ddf4e240bebda360314fd610124864f" />            <input type="hidden" name="sql_query" value="SELECT * FROM `almacenAlmacenes`" />
            <input type="hidden" name="goto" value="tbl_structure.php" />
            <input type="submit" name="navig"  class="ajax" value="Show :" />
            Start row: 
            <input type="text" name="pos" size="3" value="30" class="textfield" onfocus="this.select()" />
            Number of rows: 
            <input type="text" name="session_max_rows" size="3" value="30" class="textfield" onfocus="this.select()" />
        Headers every <input type="text" size="3" name="repeat_cells" value="100" class="textfield" /> rows
        </form>
    </td>
    <td class="navigation_separator"></td>
</tr>
</table>
  <?php */?>  
    
    

  <table  width="522" class="table-forma" >
    <tr>
      <td >Fecha Inicial</td>
      <td><span >
        <label>
        <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php echo $_POST['fechaInicial'];?>"/>
        </label>
        <input name="button" type="button"  id="lanzador" value="..." />
      </span></td>
    </tr>
    
    
    <tr>
      <td>Fecha Final</td>
      <td><span >
        <label>
        <input  name="fechaFinal" type="text"  id="campo_fecha2" size="10" maxlength="9" readonly=""
		value="<?php echo $_POST['fechaFinal'];?>"/>
        </label>
        <input name="lanzador2" type="button"  id="lanzador2" value="..." />
      </span></td>
    </tr>
    
    
        <tr>
      <td>Cliente  Principal -Cuenta Mayor-</td>
      <td><span >
       <label>
       <input name="seguro" type="hidden"  id="seguro"   readonly="" />
		<input name="nomSeguro" type="text"  id="nomSeguro" size="60" />
        </label>
        
      </span></td>
    </tr>
    
    

  </table>
 
<br />
    <label>
        <input type="submit" name="buscar" id="button" value="Buscar" />
      </label>
        <input type="submit" name="nuevo" id="nuevo" value="Nueva Busqueda" />
    
    
    
    <br />
    

    
    
    
    
    
    
    

  <?php if($_POST['buscar'] ){ ?>

  <table  width="613" class="table table-striped">
    <tr>
     <th width="15"   ><div align="left">#</div></th>
       <th width="15"   ><div align="left">FechaCierre</div></th>
         <th width="50"   ><div align="left">Referencia</div></th>
      <th width= "181"   ><div align="left">Aseguradora</div></th>
      <th   ><div align="left">Tipo Px </div></th>
	  <th   ><div align="left">Usuario</div></th>
	  <th   ><div align="left">Importe</div></th>
	  <th   ><div align="left" class="none"><span >ECuenta</span></div></th>
    </tr>

<?php	

if($_POST['seguro']!=NULL){
 $sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'

AND
fechaCierre >= '".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."' 
and
clientePrincipal='".$_POST['seguro']."'
group by folioVenta
order by fechaCierre ASC ";   
}else{
  $sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'

AND
fechaCierre >= '".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."' 
and
seguro!='' and clientePrincipal!=''
group by folioVenta
order by fechaCierre ASC ";
}

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;





//*************CARGOS*************
$sc="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as cargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  ";
$rc=mysql_db_query($basedatos,$sc);
$mc = mysql_fetch_array($rc);
//**************************************

//****************ABONOS************

$sa="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A'  ";
$ra=mysql_db_query($basedatos,$sa);
$ma = mysql_fetch_array($ra);
//*************************************
$totales[0]+=(float) ($mc['cargos']-$mc['devoluciones']);
$tot=(float) ($mc['cargos']-$mc['devoluciones']);

?>
      
    <tr>
      
    <td height="24"  ><?php echo $a;?></td>
        
              <td height="24"  ><?php echo cambia_a_normal($myrow['fechaCierre']);?></td>
      <td height="24"  ><?php echo $myrow['folioVenta'];?></td>


      <td width="181"  >
<?php 
$sSQL17= "
SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);



if($_POST['seguro']!=NULL or $_POST['seguro']!=0){
$sSQL17c= "
	SELECT 
*
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente='".$_POST['seguro']."'
";
$result17c=mysql_db_query($basedatos,$sSQL17c);
$myrow17c = mysql_fetch_array($result17c);
}else{
 $sSQL17c= "
	SELECT 
*
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['clientePrincipal']."'
";
$result17c=mysql_db_query($basedatos,$sSQL17c);
$myrow17c = mysql_fetch_array($result17c);   
}   
    
    
 echo $myrow17c['nomCliente'];
 echo '<br>';
 echo $myrow17['paciente'];
 
 

 if($myrow17['statusDevolucion']=='si'){
     echo '<div class="error">[ Devolucion ]</div>';
 }
	  ?>
          	  
	  </td>

      <td width="143"  ><?php

echo $myrow['tipoPaciente'];
?></td>

      <td width="65"  ><?php
echo $myrow['usuario'];
?></td>
      <td width="65"  ><?php 

	  echo '$'.number_format($tot,2);
	  ?></td>
      <td width="59"  >
    <a href="javascript:ventanaSecundaria('../ventanas/imprimirEstadoCuenta.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')">
        <img src="../imagenes/printer.png" alt="" width="20" height="18" border="0" />
    </a>
      </td>
      
      
         
    </tr> 
     
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
    <?php echo '<br>';echo '<br>';?>
    
    <?php 
    if($_POST['buscar']!=NULL){
    if($totales[0]>0){?>
    <div class="success" align="center">Se encontraron <?php echo $a;?> registros, Total: <?php echo '$'.number_format($totales[0],2);?></div>
    <?php }else{?>
    <div class="error" align="center">No se encontraron registros!</div>
    <?php }} ?>
  </table>

  
  

  
    
    
    
  
</form>




    <?php } ?>

 
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
 
 
 
    
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
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