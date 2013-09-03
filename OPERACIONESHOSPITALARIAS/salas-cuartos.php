<?php require("menuOperaciones.php"); ?>

<?php 
if($_POST['nuevo']){
$_POST['sala']="";
$leyenda = "Ingrese los datos correctamente";
}
//actualizar ******************************************************************************************************
if($_POST['actualizar'] AND $_POST['sala'] ){ 
//********abro lista
//********cierro lista
//if($myrow1['usuario'] !=$_POST['usuario']){ //checo que no haya un usuario igual
//******************** INSERTAR Y ACTUALIZAR ************************************
if($agregar = $_POST["codSala"]){ //paso arreglo de agregar modulos a agregar

foreach($agregar as $i => $agregar_articulo){
$sSQL3= "Select * From SalasCuartos WHERE codSala = '".$_POST['sala']."'
AND codCuarto = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['codSala']!= $_POST['sala'] AND $agregar[$i] != $myrow3['codSala']){
$agrega = "INSERT INTO SalasCuartos (
codSala,codCuarto
) values (
'".$_POST['sala']."',
'".$agregar[$i]."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se agregó el cuarto: ".$_POST['codSala'];
}}
}
//*****************cierro INSERTAR Y ACTUALIZAR **********************************
/* } else {
ya_existe();
$leyenda = "EL  USUARIO QUE ESCOGISTE YA ESTA EN EXISTENCIA..!!!";
}  *///cierro verificacion de existencia de usuario
} else if($_POST['actualizar']){
$leyenda = "Te Faltan Campos por Rellenar..!!!";
}
//****************************************************************************************************************************

if($_POST['borrar'] AND $_POST['sala']){

if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM SalasCuartos WHERE codSala ='".$_POST['sala']."' 
AND codCuarto LIKE '%$quitar[$is]%' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda = "Se eliminó la cama del cuarto ".$quitar[$i];
/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
 */
}}} else if($_POST['borrar'] AND !$_POST['sala']){
$leyenda = "Por favor, escoja el cuarto que desee sacar de la sala..!";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<p align="center">
  <label></label> 
Relaci&oacute;n Salas &lt;--&gt;Cuartos</p>
<form id="form" name="form" method="post" action="" />
  <label>
  <div align="center">
    <input name="textfield" type="text"  size="60" value="<?php echo $leyenda; ?>" readonly=""/>
  </div>
  </label><br />
  
  <table width="323" class="table-forma">

    <tr>
      <td  colspan="2"  scope="col"><strong>Qu&eacute; sala quieres asignar</strong></td>
    </tr>
    <tr>
      <td  scope="col">Sala: </td>
      <td width="152"  scope="col"><label>
        <?php //*********ANAQUELES
	   $sSQL7= "Select * From salas ORDER BY codigoSala ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="sala"  id="sala" onChange="javascript:this.form.submit();">
          <?php if($_POST['sala']){ ?>
          <option value="<?php echo $_POST['sala']; ?>"><?php echo  $_POST['sala']; ?></option>
          <?php } else {?>
          <option></option>
          <?php } ?>
		   <option></option>
          <?php 		 
		   while($myrow7 = mysql_fetch_array($result7)){ 
		echo '<option>'.$myrow7['codigoSala']; 
		} 
		
		?>
      </select>
&nbsp;</label></td>
    </tr>
  </table>

<p>
  
</p>
  
  

  <table width="405" class="table table-striped">
    <tr>
      <th width="136"  scope="col"><span >C&oacute;digo del Cuarto </span></th>
      <th width="149"  scope="col"><span >Agregar Cuartos</span></th>
      <th width="98"  scope="col"><span >Agregar</span></th>
    </tr>
    <tr>
      <?php   
 $sSQL= "Select * From cuartos order by codigoCuarto ASC";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
	  
$bandera += 1;
$codigoModulo = $myrow['codigoCuarto'];
?>
      <td  bgcolor="<?php echo $color?>" ><div align="center"><span > </span></div>
          <span >
            <label></label>
          </span>
        <div align="center"><span ><?php echo $myrow['codigoCuarto'];?></span></div></td>
      <td bgcolor="<?php echo $color?>" ><span ><?php echo $myrow['descripcionCuarto'];?></span>
          <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
          <input name="tope" type="hidden" id="tope" value="<?php echo $nCliente; ?>" />
          <input name="modes[]" type="hidden" id="modes[]" value="<?php echo $myrow['modulos']; ?>" /></td>
      <td bgcolor="<?php echo $color?>" ><label>
          <div align="center">
            
        
            <input name="codSala[]" type="checkbox"  id="codSala[]" 
		value="<?php 
		echo $codigoModulo;
		?>" />
          </div>
        </label></td>
    </tr>
    <?php }?>
</table>
 
  <p align="center">
  
    <input name="actualizar" type="submit"  id="actualizar" value="Agregar Cuartos" />
    <label></label>
  </p>
  <p>
    <?php //*********ANAQUELES
	   $sSQL8= "Select * From SalasCuartos WHERE codSala ='".$_POST['sala']."' ORDER BY
	   codSala ASC";
$result8=mysql_db_query($basedatos,$sSQL8);
echo mysql_error();


	  ?>
  </p>
  <hr />
  <form id="form1" name="form1" method="post" action="">
    <table width="330" class="table table-striped" >
      <tr>
        <th width="257"  scope="col"><strong><span >Cuartos ya agregados </span></strong></th>
        <th width="73"  scope="col"><span >Quitar</span></th>
      </tr>
      
	  <tr>
	  <?php while($myrow8 = mysql_fetch_array($result8)){ 
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
	  ?>
        <td scope="col"><label><span ><?php echo $myrow8['codCuarto'];?></span></label></td>
        <td scope="col"><input name="quitar[]" type="checkbox"  id="quitar[]" 
		value="<?php 
		echo $myrow8['codCuarto'];
		?>" /></td>
      </tr>  <?php }?>
    </table>
    <div align="center">
    
      <input name="borrar" type="submit"  id="borrar" value="Eliminar/Borrar" />
    </div>
   
<p align="center">&nbsp;</p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
