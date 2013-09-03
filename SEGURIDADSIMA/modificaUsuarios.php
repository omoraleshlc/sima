<?php require("/configuracion/ventanasEmergentes.php"); ?>




<?php 









if($_POST['actualizar'] AND $_POST['pwd1'] AND $_POST['pwd2'] AND   $_POST['usuario']!=NULL AND $_POST['nombre']!=NULL ){ 

if(!$_GET['entidades']){ $_GET['entidades']=$_POST['entidad'];}
    
    
//verifico que no exista en el sistema eese usuario
$sSQL1= "Select * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);    




$sSQL1d= "Select * From cargosCuentaPaciente WHERE usuario = '".$_POST['usuario']."'";
$result1d=mysql_db_query($basedatos,$sSQL1d);
$myrow1d = mysql_fetch_array($result1d); 

    



if($_POST['pwd1']==$_POST['pwd2']){ //contrase�as iguales?
$password = $_POST['pwd2']; //asigno password
$password=md5($password);




//******************** INSERTAR Y ACTUALIZAR ************************************



if( $myrow1['usuario']){
//echo "actualiza";
$q = "UPDATE usuarios set 
email='".$_POST['email']."',
passwd='".$password."', 
nombre='".$_POST['nombre']."',
aPaterno='".$_POST['aPaterno']."', 
aMaterno='".$_POST['aMaterno']."',
ejercicio='".$_POST['ejercicio']."',
medico='".$_POST['medico']."',
fecha='".$fecha1."',
tipoUsuario='".$_POST['tipoUsuario']."',entidad='".$_GET['entidades']."'
WHERE entidad='".$_GET['entidades']."' AND
usuario='".$_POST['usuario']."' 
";
mysql_db_query($basedatos,$q);
echo mysql_error();

$agrega = "INSERT INTO usuariosUpdates (
usuario,passwd,nombre,aPaterno,aMaterno,ejercicio,medico,fecha,fechaIngreso,horaIngreso,status,tipoUsuario,entidad
) values (
'".$_POST['usuario']."','".$password."',
'".$_POST['nombre']."','".$_POST['aPaterno']."',
'".$_POST['aMaterno']."','".$_POST['ejercicio']."','".$_POST['medico']."','".$fecha1."',
'".$fecha1."','".$hora1."','inactivo','".$_POST['tipoUsuario']."','".$_GET['entidades']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$leyenda = "Ese Usuario: ".$_POST['usuario']." ya existe, se actualizo...";
} else {
//echo "inserta";
    if(!$myrow1['usuario'] and !$myrow1d['usuario']){
$agrega = "INSERT INTO usuarios (
usuario,passwd,nombre,aPaterno,aMaterno,ejercicio,medico,fecha,fechaIngreso,horaIngreso,status,tipoUsuario,entidad,email
) values (
'".$_POST['usuario']."','".$password."',
'".$_POST['nombre']."','".$_POST['aPaterno']."',
'".$_POST['aMaterno']."','".$_POST['ejercicio']."','".$_POST['medico']."','".$fecha1."',
'".$fecha1."','".$hora1."','inactivo','".$_POST['tipoUsuario']."','".$_GET['entidades']."','".$_POST['email']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se ingreso el usuario: ".$_POST['usuario']; 
echo '<script language="JavaScript" type="text/javascript">

window.opener.document.forms["form1"].submit();

    self.close();

</script>';
}else{
  echo '<script language="JavaScript" type="text/javascript">

window.alert("EL USUARIO YA EXISTE EN OTRA ENTIDAD");

  

</script>';  
}


 }





} else {
$leyenda="Tus contraseñas no coinciden!";
} //cierro verificacion de passwords iguales




}
//****************************************************************************************************************************










if($_POST['borrar'] AND $_POST['usuario'] AND $_POST['usuario']!="omorales"){

$borrame = "DELETE FROM usuarios
 WHERE
entidad='".$_GET['entidades']."'
    and
usuario ='".$_POST['usuario']."'";
mysql_db_query($basedatos,$borrame);
$borrame1 = "DELETE FROM usuariosAlmacen
 WHERE
entidad='".$_GET['entidades']."'
    and
usuario ='".$_POST['usuario']."'";
mysql_db_query($basedatos,$borrame1);
$borrame2 = "DELETE FROM usuariosModulos
 WHERE
entidad='".$_GET['entidades']."'
    and
usuario ='".$_POST['usuario']."'";
mysql_db_query($basedatos,$borrame2);
$borrame3 = "DELETE FROM usuariosIP
 WHERE
entidad='".$_GET['entidades']."'
    and
usuario ='".$_POST['usuario']."'";
mysql_db_query($basedatos,$borrame3);

echo mysql_error();
$leyenda = "Se elimino el usuario: ".$_POST['usuario'];
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
} else if($_POST['borrar'] AND !$_POST['nCliente']){
$leyenda = "Por favor, escoja el nombre de usuario que desee eliminar..!";
}











if($_GET['usuario']!=NULL){
$sSQL1= "Select * From usuarios WHERE entidad='".$_GET['entidades']."'
    and usuario = '".$_GET['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
}
?>





<script>
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\
".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA
-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 
</script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<body>
<p align="center">
  <label>&nbsp;</label>
</p>

<form name="form1" method="post" >
  <table width="519" class="table-forma">
     <tr  >
      <th colspan="2"><p align="center"> Datos del Usuario</p></th>
 
    </tr>
    <tr>
      <td colspan="2" scope="col"><?php echo '<blink>'.$leyenda.'</blink>';?></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">En caso de ser Medico </div></td>
      <td scope="col">
	            <?php	 		
$sqlNombre11 = "SELECT * from medicos 
WHERE
status='A'
ORDER BY apellido1 ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
                <div align="left">
		  <select name="medico"  id="medico"/>
		    
		  <?php   if($myrow1["medico"]){ ?>
          <option value="<?php echo $myrow1["medico"];?>"><?php echo $myrow1["medico"];?></option>
          <option value="">...</option>
		  <?php   } else { ?>
		  <option value=""></option>
		  <?php } ?>
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option value="<?php echo $rNombre11["numMedico"];?>"> <?php echo 
	  $rNombre11["apellido1"]." ".$rNombre11["apellido2"]
	  ." ".$rNombre11["apellido3"]." ".$rNombre11["nombre1"]." ".$rNombre11["nombre2"]." || ".$rNombre11["numMedico"];?></option>
            <?php } ?>
            </select>
	            </div></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Tipo de Usuario </div></td>
      <td scope="col"><label>
        
        <div align="left">
            <select name="tipoUsuario" >
				  <?php   if($myrow1["tipoUsuario"]){ ?>
          <option value="<?php echo $myrow1["tipoUsuario"];?>"><?php echo $myrow1["tipoUsuario"];?></option>
		  <?php   } ?>
		  <option value="">---</option>
		  <option value="usuario">cajero</option>
              <option value="usuario">usuario</option>
              <option value="administrador">administrador</option>
            </select>
        </div>
      </label></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Entidad</div></td>
      <td scope="col"><div align="left">



       	            <?php	 		

               

                    $sqlNombre11 = "SELECT * from entidades
WHERE
status='A'
ORDER BY descripcionEntidad ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
	    <select name="entidad"  id="entidad">

          <option value="">---</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                  <?php   if($myrow1["entidad"]==$rNombre11['codigoEntidad']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["codigoEntidad"];?>"><?php echo $rNombre11["descripcionEntidad"];?></option>
            <?php } ?>
            </select>
      </div></td>
    </tr>
    <tr>
      <td width="152" scope="col"><div align="left">Nombre</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="nombre" type="text" class="style12" id="nombre" value="<?php echo $myrow1['nombre']; ?>"/>
        </div></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Apellido Paterno </div></td>
      <td scope="col"><div align="left">
          <input name="aPaterno" type="text" class="style12" id="aPaterno" value="<?php echo $myrow1['aPaterno']; ?>"/>
      </div></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Apellido Materno</div></td>
      <td scope="col"><div align="left">
          <input name="aMaterno" type="text" class="style12" id="aMaterno" value="<?php echo $myrow1['aMaterno']; ?>"/>
      </div></td>
    </tr>

    
        <tr>
      <td scope="col"><div align="left">Email</div></td>
      <td scope="col"><div align="left">
          <input name="email" type="text"  id="validate" size="50" value="<?php echo $myrow1['email']; ?>"/>
      </div></td>
    </tr>
    
        <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    
    <tr>
      <td scope="col"><div align="left">Usuario: </div></td>
      <td scope="col">
        <div align="left">
          <input name="usuario" type="text"  id="usuario" value="<?php echo $myrow1['usuario']; ?>"
		  <?php if($myrow1['usuario']){
		  echo 'readonly=""';}
		   ?> />
      </div></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Passwd:</div></td>
      <td scope="col"><div align="left">
          <input name="pwd1" type="password"  id="pwd1"
		value="<?php echo $myrow1['passwd']; ?>"/>
      </div></td>
    </tr>
    <tr>
      <td scope="col"><div align="left">Confirmar Passwd </div></td>
      <td scope="col"><div align="left">
          <input name="pwd2" type="password"  id="pwd2" value="<?php echo $myrow1['passwd']; ?>" />
      </div></td>
    </tr>
  </table>
  <p align="center">
   
    <input name="actualizar" type="submit"  id="actualizar" value="Guardar/Modificar" />
    <label>
    <input name="borrar" type="submit"  id="borrar" value="Eliminar/Borrar" />
    </label>
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
