<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php'); ?>




<?php  
if($_GET['keyMC'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
		
		
		$q = "DELETE  FROM medicosCitas 
		WHERE keyMC='".$_GET['keyMC']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
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
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>










<script type="text/javascript">
	function regresar(hora,fecha){
			self.opener.document.citas.codHora.value = hora;
				self.opener.document.citas.fechaSolicitud.value = fecha;
		close();
	}
</script>










<?php 
//***************LAS CITAS MENORES BORRAN******************
if($_POST['send'] and $_POST['dia'] and is_numeric($_POST['horaGuia']) and $_POST['hora']){


$sSQL101= "SELECT *
FROM
medicosCitas
WHERE 
id_medico='".trim($_GET['id_medico'])."'
and
almacen='".$_GET['almacen']."'
 and
guiaHora='".$_POST['horaGuia']."'
and
dia='".$_POST['dia']."'

";
$result101=mysql_db_query($basedatos,$sSQL101);
$myrow101= mysql_fetch_array($result101);

if(!$myrow101['miniAlmacen']){
$agrega = "INSERT INTO medicosCitas 
(codHora,miniAlmacen,entidad,almacen,guiaHora,dia,id_medico)
values
('".$_POST['hora']."','".$_GET['almacenDestino']."','".$entidad."','".$_GET['almacen']."','".$_POST['horaGuia']."',
'".$_POST['dia']."','".$_GET['id_medico']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}
//***************************************
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
 <h1 align="center" class="titulomedio">
<form id="form2" name="form2" method="post" >
  <p align="center">
<?php 
$sSQLd= "SELECT descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."' and
almacen='".$_GET['almacenDestino']."'";

 $resultd=mysql_db_query($basedatos,$sSQLd);
 $myrowd = mysql_fetch_array($resultd);
 echo $myrowd['descripcion'];
 ?></p>
 <br /><br />
<div align="center">Dia
  <label>
        
          <select name="dia" id="dia" onChange="javascript:this.form.submit();" >
          <option value="">Escoje el dia</option>
          <option
          <?php if($_POST['dia']=='*'){ echo 'selected="selected"';} ?>
           value="*">Todos</option>
            <option
            <?php if($_POST['dia']=='Sunday'){ echo 'selected="selected"';} ?>
             value="Sunday">Domingo </option>
            <option
            <?php if($_POST['dia']=='Monday'){ echo 'selected="selected"';} ?>
             value="Monday">Lunes</option>
            <option
            <?php if($_POST['dia']=='Tuesday'){ echo 'selected="selected"';} ?>
             value="Tuesday">Martes</option>
            <option
            <?php if($_POST['dia']=='Wednesday'){ echo 'selected="selected"';} ?>
             value="Wednesday">Miercoles</option>
            <option
            <?php if($_POST['dia']=='Thursday'){ echo 'selected="selected"';} ?>
             value="Thursday">Jueves</option>
            <option
            <?php if($_POST['dia']=='Friday'){ echo 'selected="selected"';} ?>
             value="Friday">Viernes</option>
            <option
            <?php if($_POST['dia']=='Saturday'){ echo 'selected="selected"';} ?>
             value="Saturday">Sabado</option>
            </select>
            
        </div>
      </label><br />
     <div align="center"> Guia
      <label>
        <input name="horaGuia" type="text" id="horaGuia" size="5" <?php if($_POST['dia']=='*'){ echo 'disabled="disabled"'; } ?> />
      </label></div>
<div align="center">Hora
     <label>
        <input name="hora" type="text" id="hora" size="10" <?php if($_POST['dia']=='*'){ echo 'disabled="disabled"'; } ?>/>
      </label>
<label></div><br />
      <div align="center">  <input type="submit" name="send" id="send" value="Agregar" <?php if($_POST['dia']=='*'){ echo 'disabled="disabled"'; } ?> />
      </label></div>
  </form>
<br /><br />
<table  class="table table-striped" align="center">
  <tr bgcolor="#FFFF00">
    <th width="55" class="Estilo24" scope="col"><div align="left"><span class="negromid">Guia</span></div></th>
    <th width="106" class="Estilo24" scope="col"><div align="left"><span class="negromid">Hora</span></div></th>
    <?php if($_POST['dia']){ ?>
    <th width="74" class="Estilo24" scope="col"><div align="left"><span class="negromid">Dia</span></div></th>
    <th width="40" class="Estilo24" scope="col"><div align="left"><span class="negromid">User</span></div></th>
    <?php } ?>
    <th width="40" class="Estilo24" scope="col"><div align="left"></div></th>
  </tr>
  <tr>
    
    <?php

if($_POST['dia']!=NULL){

if($_POST['dia']=='*'){
$sSQL= "
Select * From medicosCitas WHERE entidad='".$entidad."' 
and
id_medico='".$_GET['id_medico']."'
and
almacen='".$_GET['almacen']."'
order by guiaHora ASC
";
}else{
$sSQL= "
Select * From medicosCitas WHERE entidad='".$entidad."' 
and
almacen='".$_GET['almacen']."'
and
id_medico='".$_GET['id_medico']."'
and
dia='".$_POST['dia']."'
order by guiaHora ASC
";
}




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){

$codigo=$code = $myrow['codigo'];
//echo $myrow['folioVenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

  


?>


<td bgcolor="<?php echo $color;?>" class="normalmid"><?php print $myrow['guiaHora']; ?></td>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php print $myrow['codHora']; ?></td>
    
    
    <?php if($_POST['dia']){ ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php print $myrow['dia']; ?></td>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php print $myrow['usuario']; ?></td>
    <?php } ?>
    
    
    <td height="31" bgcolor="<?php echo $color;?>" class="normalmid"><div align="center"><a href="citasMedicos.php?keyClientesInternos=<?php echo $myrow11['keyClientesInternos']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;almacen=<?php echo $_GET['almacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacenDestino=<?php echo $_GET['almacenDestino'];?>&amp;keyMC=<?php echo $myrow['keyMC'];?>"><img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este registro?') == false){return false;}" /></a></div></td>
  </tr>
  <?php 
	 $al=$myrow['almacenSolicitante'];
	 }}}?>
</table>

</body>
</html>