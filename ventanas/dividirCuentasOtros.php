<?php include("/configuracion/ventanasEmergentes.php"); ?>
<? 
$numCliente=$_GET['numCliente'];

$medico=$_GET['medico'];
?>

  <?php
$sql5= "
SELECT nomCliente,numCliente,clientePrincipal
FROM
clientes
WHERE
entidad='".$entidad."' AND
numCliente='".$_GET['numCliente']."'";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
$aseguradora=$myrow5['clientePrincipal'];
$seguro=$myrow5['numCliente'];
?>


<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language="Javascript" type="text/javascript">
function ir_al_final() {
        document.body.scrollTop = document.body.offsetHeight;
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
           
        if( vacio(F.escoje.value) == null ) {   
                alert("Por Favor, escoje como quieres agregar artículos!")   
                return false   
        }            
}   
  
  
  
  
</script> 


<?php 
if($_POST['actualizar']  and $_POST['folioVenta']){

$folioVenta=$_POST['folioVenta'];

for($i=0;$i<=$_POST['flag1'];$i++){
if($folioVenta[$i]){
$sql5= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$folioVenta[$i]."'
and
status='request'";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);



if(!$myrow5['folioVenta']){
$agrega = "INSERT INTO facturasAplicadas (
entidad,numFactura,nT,usuario,fecha,hora,keyMov,keyCF,importe,seguro,folioVenta,status) 
values ('".$entidad."','',
'','".$usuario."','".$fecha1."','".$hora1."','','','','".$seguro."',
'".$folioVenta[$i]."','request')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}
}
echo 'Se agregaron Folios de Venta';


}
?>





<?php 

if($_POST['elimina'] and $_POST['keyAPF']){

$keyAPF=$_POST['keyAPF'];


for($i=0;$i<$_POST['flag2'];$i++){

if($keyAPF[$i]){
$borrame = "DELETE FROM facturasAplicadas WHERE keyAPF='".$keyAPF[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}

}
echo "Se desactivaron folios de venta";
}

?>




<script type="text/javascript">
function submitform()
{
    if(document.form2.onsubmit && 
    !document.form2.onsubmit())
    {
        return;
    }
 document.form2.submit();
}
</script> 


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>

<body>
<p align="center" >
  <label></label><label>
  </label>
  <?php
$sql5= "
SELECT nomCliente,numCliente,clientePrincipal
FROM
clientes
WHERE
entidad='".$entidad."' AND
clientePrincipal='".$_GET['numCliente']."'";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

?>
  Escoje los Folios de Venta que desees Facturar:<br />
  <label >Compania: <?php echo $_GET['nombreCliente'];?></label></p>
<form id="form2" name="form2" method="POST" action="<?php if($_POST['continue'] ){ echo 'escojerImporteOtros.php?'.'flag='.$_POST['flag'].'&'.'numCliente='.$_GET['numCliente'].'&'.'tipoPaciente='.$_POST['tipoPaciente'];}else{echo 'dividirCuentasOtros.php?'.'numCliente='.$_GET['numCliente'].'&'.'nombreCliente='.$_GET['nombreCliente'];}?>">
  
    
<p align="center" class="negromid">
  <label>
  Tipo de Paciente
  <select name="tipoPaciente"  id="tipoPaciente" onChange="javascript:this.form.submit();" >
  <option value="">Escojer</option>
    <option
    <?php if($_POST['tipoPaciente']=='Interno')echo 'selected=""';?>
     value="Interno">Interno</option>
    <option
        <?php if($_POST['tipoPaciente']=='Externo')echo 'selected=""';?>
     value="Externo">Externo</option>
  </select>
  </label>
</p>
<table width="235" class="table-forma">
  <tr>
    <td width="23" scope="col"><label>
      <div align="center">
        <input type="radio" name="radio" id="radio" value="fecha" <?php if($_POST['radio']=='fecha'){ echo ' checked="checked"';}?> />
        </div>
    </label></td>
    <td width="53" scope="col"><div align="left" >Fecha:</div></td>
    <td width="145" scope="col"> <div align="left">
      <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		echo $_POST['fechaInicial'];
		 ?>"/>
      <input name="button" type="button"  id="lanzador" value="..." />
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input name="radio" type="radio" id="radio2" value="todos" <?php if($_POST['radio']=='todos'){ echo ' checked="checked"';}?> />
    </div></td>
    <td><div align="left" >Todos</div></td>
    <td>&nbsp;</td>
  </tr>

</table><br />

<label>
      </label>
      <label>
      
        <div align="center">
          <input name="buscar" type="submit" src='../imagenes/btns/searcharticles.png' id="button2" value="Buscar" <?php //if(!$_POST['tipoPaciente'])echo 'disabled=""'; ?>/>
      </div>        </label><br />

<?php if($_POST['tipoPaciente'] and ($_POST['buscar'] or $_POST['continue'] or $_POST['actualizar'] or $_POST['eliminar'])){ ?>
<table width="642" class="table table-striped">
      <tr >
        <th width="75"  scope="col"><div align="left" >
          <div align="center">Folio Venta</div>
        </div></th>
        <th width="85"  scope="col"><div align="left" >
          <div align="center">Fecha</div>
        </div></th>
        <th width="255"  scope="col"><div align="left" >
          <div align="center">Paciente</div>
        </div></th>
        <th width="50"  scope="col"><div align="left" >
          <div align="center">Tipo px</div>
        </div></th>

        <th width="44"  scope="col"><div align="left" >
          <div align="center">Escoje</div>
        </div></th>
        <th width="50"  scope="col"><div align="left" >
          <div align="center">Elimina</div>
        </div></th>
    </tr>
      <tr >
<?php	
if($_POST['buscar'] or $_POST['tipoPaciente'] or $_POST['continue'] or $_POST['actualizar'] or $_POST['elimina'] ){

if($_POST['radio']=='todos' or $_POST['actualizar'] or $_POST['eliminar']){

if($_POST['tipoPaciente']=='Interno'){
 $sSQL= "SELECT 
 *
FROM
  clientesInternos
   WHERE 
   entidad='".$entidad."'
   and
   facturacionEspecial='si'
   and
   tipoPaciente='interno' and 
   (status='cerrada' and statusCuenta='cerrada')
   and
   statusFactura!='facturado'
  
order by paciente ASC
 ";
 } else {
 
 
$sSQL= "SELECT 
 *
FROM
  clientesInternos
   WHERE 
   entidad='".$entidad."'
   and
   facturacionEspecial='si'
   
   and
   statusCaja='pagado' and tipoPaciente!='interno'
   and
   statusFactura!='facturado'


order by paciente ASC
 ";
}

}else if($_POST['fechaInicial']){ 
if($_POST['tipoPaciente']=='Interno'){
 $sSQL= "SELECT 
 *
FROM
  clientesInternos
   WHERE 
   entidad='".$entidad."'
   and
   facturacionEspecial='si'
   and
   tipoPaciente='interno' 
   and 
   (status='cerrada' and statusCuenta='cerrada')
   and
   statusFactura!='facturado'
   and
   fechaCierre='".$_POST['fechaInicial']."'
order by paciente ASC
 ";
 } else {
 
$sSQL= "SELECT 
 *
FROM
  clientesInternos
   WHERE 
   entidad='".$entidad."'
   and
   facturacionEspecial='si'
   and
   statusCaja='pagado' and tipoPaciente!='interno'
   and
   statusFactura!='facturado'
	and
   fecha1='".$_POST['fechaInicial']."'

order by paciente ASC
 ";
}
 }
 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;





$sql5= "
SELECT status,keyAPF
FROM
facturasAplicadas
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$myrow['folioVenta']."'
and
status='request'

";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
?>
        <tr   > 
        <td height="24" >
          <label>
          <div align="center">
            <?php 
					echo $myrow['folioVenta'];
		?>
          </div>
          </label>
        </span></td>
      <td >
          <div align="center">
            <?php  
		  if($myrow['fechaSolicitud']){
		  echo cambia_a_normal($myrow['fechaSolicitud']);
		  }else{
		  echo cambia_a_normal($myrow['fecha']);
		  }
		?>
            </div>
        </span></td>
        <td >
                <?php  echo $myrow['paciente'];
		?>
        
        <?php if($myrow5['status']=='request'){ ?>
                <span > [en proceso para facturar..]</span>
                <?php }?>
                
        </span></td>
        <td >
          <div align="center">
            <?php  echo $myrow['tipoPaciente'];
		?>
            </div>
          </span></td>
      

        <td >
          <div align="center">
            <?php if($myrow5['status']==''){$flag1+=1;?>        
            <input name="folioVenta[]" type="checkbox" id="folioVenta[]" value="<?php echo $myrow['folioVenta']; ?>" <?php echo $mensaje;?> />
            <?php } else{ echo '---';}?>        
            </div></td>
        <td >
		  <div align="center">
		    <?php if($myrow5['status']=='request'){$teo+=1; ?>
		    <input name="foliosEscogidos[]" type="hidden" id="foliosEscogidos[]" value="<?php echo $myrow['folioVenta']; ?>"/>
		    <?php $flag2+=1;}?>
		    
		    
		    <input name="keyAPF[]" type="checkbox" id="keyAPF[]" value="<?php echo $myrow5['keyAPF']; ?>" <?php if($myrow5['status']==''){echo 'disabled=""';}?> />
	      </div></td>
      </tr>
      <?php  

	  }  //cierra while
	  ?>
  </table>
  <p align="center" ><em> 
	
	
  <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php 
	}else{
	echo "No se encontraron registros..!";
	}
	?></em></p>





  <div align="center">

      <input name="almacenDestino" type="hidden" id="almacenDestino"  value="<?php echo $_POST['almacenDestino']; ?>" />
	 
	  
	  

	  <input name="almacenDestino1" type="hidden" id="almacenDestino1"  value="<?php echo $_POST['almacenDestino1']; ?>" />

	  

	  <input name="search" type="hidden" id="search"  value="search" />


    <input name="flag" type="hidden"  value="<?php echo $flag2; ?>" />
      <?php if($bandera>=1){ ?>
      <input name="actualizar" type="image" src="../imagenes/btns/addregistro.png" id="actualiza" value="Seleccionar Registros" />
       <input name="elimina" type="image" src="../imagenes/btns/delregistro.png" id="actualiza2" value="Deseleccionar Registros" />
<input name="aseguradora" type="hidden"  value="<?php echo $seguro; ?>" />
      
    
      <?php }}} ?>
      <span >
      <input name="flag1" type="hidden" id="flag1"  value="<?php echo $bandera; ?>" />
  </span><span >
  <input name="flag2" type="hidden" id="flag2"  value="<?php echo $flag2; ?>" />
  </span><span >
  <input name="clientePrincipal" type="hidden" id="clientePrincipal"  value="<?php echo $_GET['clientePrincipal']; ?>" />
  </span></div>
    <div align="center">
    
  </div>
    
    
    <?php if($bandera>=1){ ?>
    <label>
    
<div align="center">
      <input type="image" src="../imagenes/btns/continuebtn.png" name="continue" id="button" value="continuar" <?php if($teo<1 and !$_POST['continue'] )echo 'disabled=""';?> />
  </div>
    </label>
    <?php } ?>
    
</form>
<p></p>
      
	  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
    </script> 

</body>
</html>
