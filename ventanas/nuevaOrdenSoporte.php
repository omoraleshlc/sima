<?php require("/configuracion/ventanasEmergentes.php"); ?>




<?php 



if($_POST['generaOrden']!=NULL){
    
    
if($_POST['entidad']!=NULL and $_POST['almacen']!=NULL and $_POST['keyTS']!=NULL and $_POST['registro']!=NULL and $_POST['nombre']!=NULL){    
    
    
$q4 = "

    INSERT INTO contadorOrdenesSOP(contador, usuario)
    SELECT(IFNULL((SELECT count(*)+1 from contadorOrdenesSOP ), 1)), '".$usuario."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

$sSQL= "SELECT max(contador) as topeMaximo from contadorOrdenesSOP where usuario='".$usuario."' order by keyConta DESC";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$solicitud= $myrow['topeMaximo'];       
    
    

$sSQL1da= "Select * From almacenes WHERE entidad='".$_POST['entidad']."' and almacen = '".$_POST['almacen']."'";
$result1da=mysql_db_query($basedatos,$sSQL1da);
$myrow1da = mysql_fetch_array($result1da); 

$sSQL1de= "Select * From tipoSoporte WHERE keyTS = '".$_POST['keyTS']."'";
$result1de=mysql_db_query($basedatos,$sSQL1de);
$myrow1de = mysql_fetch_array($result1de); 

$agrega = "INSERT INTO ordenesSOP (
solicitud,entidadSolicitud,almacen,keyTS,registro,nombre,usuario,fecha,hora,entidad,descripcionAlmacen,descripcionSoporte,status
) values (
'".$solicitud."','".$_POST['entidad']."','".$_POST['almacen']."','".$_POST['keyTS']."',
'".$_POST['registro']."','".$_POST['nombre']."','".$usuario."','".$fecha1."',
'".$hora1."','".$entidad."','".$myrow1da['descripcion']."','".$myrow1de['descripcion']."','request'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script>
window.opener.document.forms["form1"].submit();
window.close();
</script>';   
}else{
    echo '<script>window.alert("Te faltan campos por llenar!");</script>';
}    
}

































if($_POST['actualizar'] AND $_POST['pwd1'] AND $_POST['pwd2'] AND   $_POST['usuario']!=NULL AND $_POST['nombre']!=NULL ){ 

if(!$_GET['entidades']){ $_GET['entidades']=$_POST['entidad'];}
    
    
//verifico que no exista en el sistema eese usuario
$sSQL1= "Select * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);    






    



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
echo '<script>

window.opener.document.forms["form1"].submit();

    window.close();

</script>';
}else{
  echo '<script>

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
  <table width="600" class="table-forma">
     <tr  >
      <th colspan="2"><p align="center">Generar #Orden Soporte</p></th>
 
    </tr>
    <tr>
      <td colspan="2" scope="col"><?php echo '<blink>'.$leyenda.'</blink>';?></td>
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
	    <select name="entidad"  id="entidad" onChange="this.form.submit();">

          <option value="">---</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                  <?php   if($_POST["entidad"]==$rNombre11['codigoEntidad']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["codigoEntidad"];?>"><?php echo $rNombre11["descripcionEntidad"];?></option>
            <?php } ?>
            </select>
      </div></td>
    </tr>  
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

    <tr>
      <td scope="col"><div align="left">Departamento</div></td>
      <td scope="col">
	            <?php	 		
$sqlNombre11 = "SELECT * from almacenes 
WHERE
entidad='".$_POST['entidad']."'
    and
    activo='A'
    and
    miniAlmacen='No'
order by descripcion ASC
";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
                <div align="left">
		  <select name="almacen" onChange="this.form.submit();"/>
                  <option value="">Escoje</option>
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["almacen"]==$rNombre11["almacen"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["almacen"];?>"> <?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>
	            </div></td>
    </tr>
      
      
      
      
      
      

      <tr>
      <td scope="col"><div align="left">Tipo Soporte</div></td>
      <td scope="col"><label>
        
        <div align="left">
<?php	
          
$sqlNombre11 = "SELECT * from tipoSoporte 
order by descripcion ASC
";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
             
	   <select name="keyTS"/>
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["keyTS"]==$rNombre11["keyTS"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["keyTS"];?>"><?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>
            
            
            
        </div>
      </label></td>
    </tr>

      
      
      
      
      
      
      
      
    <tr>
      <td scope="col"><div align="left">Registro </div></td>
      <td scope="col"><label>
        
        <div align="left">
            <?php	 		
$sqlNombre11 = "SELECT * from inventarioEqComputo 
WHERE
entidad='".$_POST['entidad']."'
    and
    departamento='".$_POST['almacen']."'
order by registro ASC
";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
                <div align="left">
		  <select name="registro" />
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["registro"]==$rNombre11["registro"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["registro"];?>"> <?php echo $rNombre11["registro"].'  '.$rNombre11["descripcionUbicacion"];?></option>
            <?php } ?>
            </select>
        </div>
      </label></td>
    </tr>
    
      

      
      <tr>
      <td scope="col"><div align="left">Extension</div></td>
      <td scope="col"><label>
        
        <div align="left">
            <input type="text" name="extension" value="<?php echo $_POST['extension'];?>"></input>
        </div>
      </label></td>
    </tr>
      
      
      
    <tr>
      <td width="152" scope="col"><div align="left">Usuario</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="nombre" type="text" size="40" id="nombre" value="<?php echo $_POST['nombre']; ?>"/>
        </div></td>
    </tr>
    

    
   
    
        <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    
    
    
  </table>
  <p align="center">
   
    <input name="generaOrden" type="submit"  id="actualizar" value="Generar Orden" />
  
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
