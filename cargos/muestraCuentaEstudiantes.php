<?php 
$sSQL7= "Select * from clientes where entidad='".$entidad."' and numCliente='".$_GET['seguro']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


//echo $myrow7n['periodo'];
//echo $_GET['numeroE'];

$sSQL7a= "Select numMatricula from pacientes where entidad='".$entidad."'  and  numCliente='".$_GET['numeroE']."'     ";
$result7a=mysql_db_query($basedatos,$sSQL7a);
$myrow7a = mysql_fetch_array($result7a);


if($myrow7a['numMatricula']){
if(!$_POST['aceptar']){

$sSQL7c= "Select * from ALUMNOSINSCRITOS where ENTIDAD='".$entidad."'  and  MATRICULA='".$myrow7a['numMatricula']."'  and MODALIDAD='Presencial'  ";
$result7c=mysql_db_query($basedatos,$sSQL7c);
$myrow7c = mysql_fetch_array($result7c);
$alumno=$myrow7c['NOMBRE'].' '.$myrow7c['APATERNO'].' '.$myrow7c['AMATERNO'];

if($myrow7c['MATRICULA']){
$show->mostrarDatos($alumno,$fecha1,$entidad,$basedatos,$_GET['numeroE']);
}else{
$_POST['aceptar']=NULL;
$myrow7c['MATRICULA']=NULL;
}
}
}


?>