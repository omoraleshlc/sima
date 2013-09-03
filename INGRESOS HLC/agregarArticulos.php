<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php");
$numCliente=$_POST['seguro'];
$seguro=$_POST['nomSeguro'];
$medico=$_GET['medico'];

if(!$_POST['seguro']){
    $_POST['seguro']=$_GET['numCliente'];
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
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.escoje.value) == null ) {   
                alert("Por Favor, escoje como quieres agregar art�culos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 




if($_POST['actualizar']){

if( $_POST['fechaInicial'] and $_POST['fechaFinal']){
$costo=$_POST['costo'];
$code=$_POST['code'];
$keyConvenios=$_POST['keyConvenios'];

		for($i=0;$i<=$_POST['flag'];$i++){





if( $code[$i]){ 

 $sql5= "
SELECT codigo
FROM
convenios
WHERE
entidad='".$entidad."' AND
numCliente =  '".$_POST['seguro']."'
and
departamento='".$_POST['almacenDestino1']."'
AND 
codigo ='".$code[$i]."' 
AND
tipoConvenio='cantidad'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

if($myrow5['codigo']){
 $sql="Update convenios
set
tipoConvenio='cantidad',
departamento='".$_POST['almacenDestino1']."',
fechaInicial='".$_POST['fechaInicial']."',
fechaFinal='".$_POST['fechaFinal']."',
fechaModificacion='".$fecha1."',

usuario='".$usuario."'
where
entidad='".$entidad."'
    and
departamento='".$_POST['almacenDestino1']."'
and
codigo='".$code[$i]."' 
";
mysql_db_query($basedatos,$sql);
echo mysql_error();
$leyenda='Registro Actualizado';
} else {

$agrega = "INSERT INTO convenios (
numCliente,codigo,fechaInicial,fechaFinal,usuario,departamento,tipoConvenio,entidad,fechaCreacion) 
values ('".$_POST['seguro']."','".$code[$i]."',
'".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$usuario."','".$_POST['almacenDestino1']."','cantidad','".$entidad."','".$fecha1."')";
mysql_db_query($basedatos,$agrega);
$leyenda='Registro Agregado';
echo mysql_error();
}
			}//cierra if

		}//cierra for



} else {
echo '<blink>'.'Te falta poner las fechas'.'</blink>';
}

}
?>





<?php 

if(!$_POST['actualizar'] AND ($_POST['keyConvenios'] and $_POST['eliminar'])){

$keyConvenios=$_POST['keyConvenios'];


for($i=0;$i<$_POST['flag'];$i++){

if($keyConvenios[$i]){
$borrame = "DELETE FROM convenios WHERE keyConvenios='".$keyConvenios[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda= "Se eliminaron convenios";
}
}

}

?>



   <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />

  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 

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
$estilos= new muestraEstilos();
$estilos->styles();

?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

</head>

<body>
<p align="center">




<span >
<?php

$sSQL1= "Select * From clientes where entidad='".$entidad."'
 AND
numCliente='".$_POST['seguro']."'";



$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

?></span></p>
<p align="center"><span ><?php echo $myrow1['nomCliente']; ?></span></p>
<form id="form2" name="form2" method="post" action="" >
<table width="336" class="table-forma">





  <tr>
     
         <td>Seguro</td>

      <td  >
          <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
     </td>

      
        <td ><input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php
		if($_POST['nomSeguro']){
		echo $_POST['nomSeguro'];
		}else{
                    echo $myrow1['nomCliente'];
                }
		?>"/>
       </td>

 </tr>



          <tr>
      <td width="24" height="24" >&nbsp;</td>
    <td width="98"  >Departamento</td>
    <td width="478" >
    <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'style12',$almacenSolicitante,$almacenDestino,$basedatos);
?>
    
    </td>
  </tr>





  <tr>
    <td height="23" >&nbsp;</td>
    <?php if(!$_POST['gpoProducto']){ ?>
    <td  >Mini Almacen</td>
    <?php } ?>
    <td ><?php 
$comboAlmacen1=new comboAlmacen();
if(!$almacenDestino){
$almacenDestino=$_POST['almacenDestino'];
} 



$comboAlmacen1->despliegaMiniAlmacen($entidad,'style12',$almacenDestino,$almacenDestino,$basedatos);

?></td>
  </tr>
  <tr>
    <td height="24" >&nbsp;</td>
    <td  >Fecha desde</td>
    <td ><label>
      <input name="fechaInicial" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
    </label>
      <input name="button" type="image" src="../imagenes/calendario.png" id="lanzador" value="..." /></td>
  </tr>
  <tr>
    <td height="21" >&nbsp;</td>
    <td  >Hasta</td>
    <td ><label>
      <input name="fechaFinal" type="text"  id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
    </label>
      <input name="button1" type="image" src="../imagenes/calendario.png" id="lanzador1" value="..." /></td>
  </tr>
  <tr>
    <td height="34" >&nbsp;</td>
    <td  >&nbsp;</td>
    <td ><input name="buscar" type="submit"  id="actualizar" value="Buscar" /></td>
  </tr>
</table>

<p>
  <?php if($_POST['buscar'] or $i){ ?>
</p>
<table width="600" class="table table-striped">
  <tr>

    <th width="10"  >#</th>
    <th width="255"  >Descripcion</th>
    <th width="100"  >Duracion</th>
    <th width="70" align="center"  >P. Part</th>
    <th width="67" align="center"  >P. Aseg</th>
    <th width="49" align="center"  >Agregar</th>
    <th width="44" align="center"  > Quitar</th>

  </tr>
  <?php	
$sSQL= "SELECT 
articulos.gpoProducto as grupo,articulos.codigo as codigo1,articulos.descripcion
FROM
articulos,existencias
WHERE 
articulos.codigo=existencias.codigo
and
articulos.entidad='".$entidad."'
and
existencias.almacen='".$_POST['almacenDestino1']."' 
and
articulos.activo='A'

order by articulos.descripcion ASC
 ";
$result=mysql_db_query($basedatos,$sSQL);

if($result!=NULL){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
$C=$myrow['codigo1'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$gpoProducto=$myrow['grupo'];

$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

$sSQL3= "
	SELECT 
codigo,costo,keyConvenios,fechaInicial,fechaFinal
FROM
convenios
WHERE 
numCliente='".$_POST['seguro']."'
and
departamento='".$_POST['almacenDestino1']."'
and
entidad='".$entidad."'
and
codigo='".$myrow['codigo1']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$sSQL34= "
	SELECT 
nivel1,nivel3
FROM
articulosPrecioNivel
WHERE 

entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino1']."'
and
codigo='".$myrow['codigo1']."'";
$result34=mysql_db_query($basedatos,$sSQL34);
$myrow34 = mysql_fetch_array($result34);



if($myrow3['codigo']!=NULL){
$bg='#FFFF66';
}else{
$bg='#ffffff';
}
?>
  
  <tr  >




      
      <td bgcolor="<?php echo $bg;?>" height="5" bckgr ><?php  echo $a;?></td>



      <td height="50" bgcolor="<?php echo $bg;?>" >
      <?php 
					echo $myrow['descripcion'];
		?>

</td>




    <td bgcolor="<?php echo $bg;?>">

        <?php if($myrow3['fechaInicial']!=NULL ){ ?>


        <span >Desde el
      <?php 
	
		echo cambia_a_normal($myrow3['fechaInicial']);
         
		  ?>
      <br /></span>
     <span > Hasta el <?php
	
		echo cambia_a_normal($myrow3['fechaFinal']);
         
		  ?>
      <br />
    </span>

      
    <?php }else{

        echo '<span >'.'Sin Asignar'.'</span>';

}
    ?> 
    </td>







    <td bgcolor="<?php echo $bg;?>" align="right"><span ><?php echo "$".number_format($myrow34['nivel1'],2);
         
		  ?></span></td>
    <td bgcolor="<?php echo $bg;?>" align="right"><span >
      <?php 
		  
$sSQL18= "
SELECT costo
FROM
convenios
WHERE
numCliente='".$_GET['numCliente']."' 
and
codigo='".$myrow['codigo1']."'
and
(departamento='".$_POST['almacenDestino1']."' or departamento='*')
order by tipoConvenio ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
if($myrow18['costo']){

 echo "$".number_format($myrow18['costo'],2);
} else {
		  echo "---";
         }
		  ?>
    </span></td>


    <td bgcolor="<?php echo $bg;?>" align="center"><span >
      <?php if(!$myrow3['codigo']){ ?>
      <input name="code[]" type="checkbox"  value="<?php echo   $C; ?>" />
      <?php } else { echo '---';} ?>
    </span></td>



    <td bgcolor="<?php echo $bg;?>" align="center"><span >
      <?php if($myrow3['codigo']){ ?>
      <input name="keyConvenios[]" type="checkbox"  value="<?php echo $myrow3['keyConvenios']; ?>" />
      <?php } else { echo '---';} ?>
    </span></td>





  </tr>
   <?php  
	  $bandera+='1';
	  }  //cierra while?>

</table>
<p>&nbsp;</p>
     
     

    <span class="titulomedio"><p align="center"><em> <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros </em></p>
<p align="center"></p>
      <label>
      <input name="actualizar" type="submit" class="style12" id="actualiza" value="Agregar a <?php echo $nombreSeguro?>" />
      <input name="eliminar" type="submit"  id="eliminar" value="Eliminar articulos" />
      </label>
      <em>
      <?php }
	else {
	echo "No se encontraron registros..!";
	}
	?>
    </em></p>
<?php 
	
	
	} else {
	echo "No se encontraron convenios...";
	}
	
	?>

    <input name="flag" type="hidden"  value="<?php echo $bandera; ?>" />

    <input name="seguro" type="hidden" id="seguro"  value="<?php echo $numCliente; ?>" />

</form>
  <p></p>
  
  
</body>





 
	<?php } ?>




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
			return "/sima/cargos/clientesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});
	</script>
</html>
