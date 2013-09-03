<?php require("/configuracion/ventanasEmergentes.php"); ?>



<?php 
//EVENTOS






 




















if($_POST['update'] ){ 

  
 
    

    
    
if($_POST['entidad']!=NULL and $_POST['almacen']!=NULL)    {

$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
$ruta=''.$_FILES["file"]["name"];

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/jpg"))
&& ($_FILES["file"]["size"] < 20000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("image/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " ya existe el archivo!. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "image/" . $_FILES["file"]["name"]);
      echo "Ruta: " . "image/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "No escogiste ninguna imagen!";
  }
    
    
//verifico que no exista en el sistema eese usuario

    $sSQL1= "Select * From sis_catTelefoniaCelular WHERE solicitud = '".$_GET['solicitud']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);    


    $sSQL1a= "Select * From entidades WHERE codigoEntidad = '".$entidad."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);    



    $sSQL1b= "Select * From almacenes WHERE entidad='".$entidad."' and almacen = '".$_POST['almacen']."'";
$result1b=mysql_db_query($basedatos,$sSQL1b);
$myrow1b = mysql_fetch_array($result1b);    
//******************** INSERTAR Y ACTUALIZAR ************************************







if( $myrow1['solicitud']){
//echo "actualiza";
$q = "UPDATE sis_catTelefoniaCelular set 
    company='".$_POST['company']."',
        minutos='".$_POST['minutos']."',
            red='".$_POST['red']."',
sms='".$_POST['red']."',
    internet='".$_POST['internet']."',
roaming='".$_POST['roaming']."',
    plan='".$_POST['plan']."',
moduloAdicional='".$_POST['moduloAdicional']."',
    fechaInicial='".$_POST['fechaFinal']."',
precioEquipo='".$_POST['precioEquipo']."',
cantidadAutorizada='".$_POST['cantidadAutorizada']."',
    costoRenta='".$_POST['costoRenta']."',
        fechaContratacion='".$_POST['fechaContratacion']."',
            plazoForzoso='".$_POST['plazoForzoso']."',
                keySW='".$_POST['keySW']."',
modelo='".$_POST['modelo']."',
    chip='".$_POST['chip']."',
        imei='".$_POST['imei']."',
            keyMA='".$_POST['keyMA']."',
            usuarioCelular='".$_POST['usuarioCelular']."',
            descripcionUbicacion='".$_POST['descripcionUbicacion']."',
                            almacen='".$_POST['almacen']."',
    codigoEntidad='".$_POST['codigoEntidad']."',
                    
usuario='".$usuario."',
fecha='".$fecha1."',
hora='".$hora1."',
entidad='".$entidad."',
    ruta='".$ruta."',
        nTelefonico='".$_POST['nTelefonico']."'


WHERE 
solicitud='".$_GET['solicitud']."'

";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script>
    window.alert("EQUIPO ACTUALIZADO!");
window.opener.document.forms["form1"].submit();    
</script>';

} else {
//echo "inserta";
  

        $q4 = "

    INSERT INTO sis_contadorEquipos(contador, usuario)
    SELECT(IFNULL((SELECT MAX(contador)+1 from sis_contadorEquipos ), 1)), '".$usuario."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT max(contador) as topeMaximo from sis_contadorEquipos where usuario='".$usuario."' order by keyCExt DESC";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $registro =$myrow['topeMaximo']; 
    
    if($registro<1){$registro=1;}else{$registro+=1;}
    
    
    
    
 $agrega = "INSERT INTO sis_catTelefoniaCelular (
cantidadAutorizada,costoRenta,fechaContratacion,plazoForzoso,keySW,modelo,chip,imei,keyMA,usuarioCelular,descripcionUbicacion,
almacen,codigoEntidad,usuario,fecha,hora,entidad,ruta,nTelefonico,registro,solicitud,precioEquipo,
company,minutos,red,sms,internet,roaming,plan,moduloAdicional,fechaInicial,fechaFinal
) values (

'".$_POST['cantidadAutorizada']."',
    '".$_POST['costoRenta']."','".$_POST['fechaContratacion']."','".$_POST['plazoForzoso']."','".$_POST['keySW']."','".$_POST['modelo']."',
        '".$_POST['chip']."','".$_POST['imei']."','".$_POST['keyMA']."','".$_POST['usuarioCelular']."','".$_POST['descripcionUbicacion']."',
            '".$_POST['almacen']."', '".$_POST['entidad']."','".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$ruta."',
                '".$_POST['nTelefonico']."','".$registro."','".$_GET['solicitud']."','".$_POST['precioEquipo']."',
'".$_POST['company']."','".$_POST['minutos']."','".$_POST['red']."','".$_POST['sms']."','".$_POST['internet']."','".$_POST['roaming']."',
    '".$_POST['plan']."','".$_POST['moduloAdicional']."','".$_POST['fechaInicial']."','".$_POST['fechaFinal']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

echo '<script>*/
    window.alert("EQUIPO AGREGADO!");
window.opener.document.forms["form1"].submit();    
</script>';
}


 }else{
     echo '<script>window.alert("TE FALTAN CAMPOS POR LLENAR!");';
 }
}















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











if($_GET['solicitud']>0){
$sSQL1= "Select * From sis_catTelefoniaCelular WHERE solicitud='".$_GET['solicitud']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
}
?>




<script type="text/javascript">
 
     //teststr="0a:1b:3c:4d:5e:6f";

    function validaMAC(){    
        
        $teststr=document.getElementById(mac);
    regex=/^([0-9a-f]{2}([:-]|$)){6}$|([0-9a-f]{4}([.]|$)){3}$/i;

 
    if (regex.test(teststr)){
        document.write("Valid mac address");
    }
    else{
        document.write("MAC no valida");

    }
    }
</script>
 
 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "This field accepts numbers only."
        return false
    }
    status = ""
    return true
}
</SCRIPT>









<link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
 







<?php

                    if(!$_POST['fechaInicial']){
                        if($_GET['dates']){    
                    $dates= $_GET['dates'];
                    }else{
		    $dates= $fecha1;
                    }
                    }else{
                    
                        $dates= $_POST['fechaInicial'];
                 
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

    
    
    
    

    
    
    
    
    
    
<form name="form1" method="post" enctype="multipart/form-data">
  



 


 
  


    
<div id="divContainer">    
<table class="formatHTML5" >
   
    
    <?php if($myrow1['registro']>0){?> 
    <tr  class="separator">
        
    <th colspan="4"><p align="center"># REGISTRO <?php echo $myrow1['registro'];?></p></th>
    
    </tr>
      <?php }?>
    
    
    
<!--bloque 1-->
<thead>
<tr class="separator">
<th colspan="4" style="text-align:center">ALTA DE CELULAR</th>
</tr>
</thead>    



 <tbody>
<tr >
  <td ># Celular</td>
  <td ><input name="nTelefonico" type="text"size="15" id="nombre" value="<?php 
            if($myrow1['nTelefonico']){
            echo $myrow1['nTelefonico'];
            }else{
            echo $_POST['nTelefonico'];
            }
            ?>" />
            
            
          
            
            
            
        </td>
  
  <td><?php echo utf8_decode("Compañia");?></td>
  <td><?php	 		

               

                    $sqlNombre11 = "SELECT * from sis_catCompany

ORDER BY descripcion ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
	    <select name="company"  id="entidad" >

          <option value="">---</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            
          <option
                  <?php   if($_POST["company"]==$rNombre11['keyTS'] ){echo 'selected=""';}?>
                value="<?php echo $rNombre11["keyTS"];?>"><?php echo $rNombre11["descripcion"];?></option>
          
            <?php } ?>
            </select></td>
</tr>
    
   




<!--bloque 2-->
  <tr >      
  <td>Entidad</td>
  <td><?php	 		

               

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
                  <?php   if($_POST["entidad"]==$rNombre11['codigoEntidad'] or $myrow1['codigoEntidad']==$rNombre11['codigoEntidad']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["codigoEntidad"];?>"><?php echo $rNombre11["descripcionEntidad"];?></option>
          
            <?php } ?>
            </select></td>
  <td>Departamento</td>
  <td><?php	 		
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
		  <select name="almacen"  id="almacen"/>
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["almacen"]!=NULL AND ($_POST["almacen"]==$myrow1["medico"])){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["almacen"];?>"> <?php echo strtolower($rNombre11["descripcion"]);?></option>
            <?php } ?>
            </select></td>
  </tr>
    






<!--bloque 3-->
  <tr >      
  <td>Descripcion</td>
  <td><input name="descripcionUbicacion" type="text" size="20" id="nombre" value="<?php 
            if($myrow1['descripcionUbicacion']){
            echo $myrow1['descripcionUbicacion'];
            }else{
            echo $_POST['descripcionUbicacion'];
            }
            ?>" /></td>
  <td>Usuario</td>
  <td><input name="usuarioCelular" type="text" size="20" id="nombre" value="<?php 
            if($myrow1['usuarioCelular']){
            echo $myrow1['usuarioCelular'];
            }else{
            echo $_POST['usuarioCelular'];
            }
            ?>" /></td>
  </tr>






<!--bloque 4-->

  <tr >      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>

  <tr >      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>










<thead>
<tr class="separator">
<th colspan="4"><div align="center">CARACTERISTICAS</div></th>
</tr>
</thead>
<!--bloque 5-->

  <tr >      
  <td>Marca</td>
  <td><?php	 		

               

      $sqlNombre11 = "SELECT * from sis_marcasCell

ORDER BY descripcion ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
	    <select name="keyMA"  id="entidad">

          <option value="">---</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                  <?php   if($_POST["keyMA"]==$rNombre11['keyMA']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["keyMA"];?>"><?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select> </td>
  <td>Modelo</td>
  <td><input name="modelo" type="text" size="20" value="<?php 
            if($myrow1['modelo']){
            echo $myrow1['modelo'];
            }else{
                echo $_POST['modelo'];
            }
            ?>" /></td>
  </tr>





<!--bloque 6-->

  <tr >      
  <td>IMEI</td>
  <td><input name="imei" type="text" size="20" value="<?php 
              if($myrow1['imei']){
              echo $myrow1['imei'];
              }else{
              echo $_POST['imei'];    
              }    
              ?>" /></td>
  <td># CHIP</td>
  <td><input name="chip" type="text" size="20" value="<?php 
           if($myrow1['chip']){
            echo $myrow1['chip'];
           }else{
           echo $_POST['chip'];    
           }
            ?>" /></td>
  </tr>






<!--bloque 7-->


  <tr >      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>

  <tr >      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>



<thead>
<tr class="separator">
<th colspan="4"><div align="center">PLANES</div></th>
</tr>
</thead>








<!--bloque 8-->


  <tr >      
  <td>Tipo Plan</td>
  <td><?php	 		

               

                    $sqlNombre11 = "SELECT * from sis_catTipoPlanCell

ORDER BY descripcion ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
	    <select name="keySW"  id="entidad">

          <option value="">---</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                  <?php   if($_POST["keySW"]==$rNombre11['keySW']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["keySW"];?>"><?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select> </td>
  <td>Modalidad</td>
  <td><select name="plan">
                  <option value="Abierto">Abierto</option>
                  <option value="Cerrado">Cerrado</option>
              </select></td>
  </tr>







<!--bloque 9-->


  <tr >      
  <td>Minutos</td>
  <td><input name="minutos" type="text" size="4" m value="<?php 
            if($myrow1['minutos']){
            echo $myrow1['minutos'];
            }else{
                echo $_POST['minutos'];
            }
            ?>" onKeyPress="return checkIt(event)"/></td>
  <td>Internet</td>
  <td><input name="internet" type="text" size="4" m value="<?php 
            if($myrow1['internet']){
            echo $myrow1['internet'];
            }else{
                echo $_POST['internet'];
            }
            ?>" onKeyPress="return checkIt(event)"/>GB</td>
  </tr>




<!--bloque 10-->


  <tr >      
  <td>SMS</td>
  <td> <input name="sms" type="text" size="4" m value="<?php 
            if($myrow1['sms']){
            echo $myrow1['sms'];
            }else{
                echo $_POST['sms'];
            }
            ?>" onKeyPress="return checkIt(event)"/></td>
  <td>Roaming</td>
  <td><input type="checkbox" value="si" name="roaming" <?php if($myrow1['roaming']=='si'){echo 'checked=""';}?>></input></td>
  </tr>










<!--bloque 11-->


  <tr >      
  <td>Modulo Adicional</td>
  <td><input name="moduloAdicional" type="text" size="20"  value="<?php 
            if($myrow1['moduloAdicional']){
            echo $myrow1['moduloAdicional'];
            }else{
                echo $_POST['moduloAdicional'];
            }
            ?>" /></td>
  <td></td>
  <td></td>
  </tr>













<!--bloque 12-->


  <tr >      
  <td>Plazo Forzoso</td>
  <td><input name="plazoForzoso" type="text" size="2" maxlength="2" value="<?php 
            if($myrow1['plazoForzoso']){
            echo $myrow1['plazoForzoso'];
            }else{
                echo $_POST['plazoForzoso'];
            }
            ?>" onKeyPress="return checkIt(event)"/>Meses</td>
  <td></td>
  <td></td>
  </tr>




<!--bloque 13-->


  <tr>      
  <td>Fecha Inicial</td>
  <td><input name="fechaInicial" type="text"  id="campo_fecha1" size="10" maxlength="10" readonly=""
		value="<?php echo $dates; ?>"/>

    <input name="button" type="image" id="lanzador1" src="/sima/imagenes/btns/fecha.png" /></td>
  <td>Fecha Final</td>
  <td><input name="button" type="image" id="lanzador2" src="/sima/imagenes/btns/fecha.png" />
      <input  name="fechaFinal" type="text"  id="campo_fecha2" size="10" maxlength="10" readonly=""
		value="<?php echo $dates; ?>"/></td>
  </tr>







<!--bloque 14-->


  <tr>      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>

  <tr >      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>



<thead>
<tr class="separator">
<th colspan="4"><div align="center">COSTOS</div></th>
</tr>
</thead>



<!--bloque 15-->


  <tr>      
  <td>Costo Renta</td>
  <td><input name="costoRenta" type="text" size="5" value="<?php 
            if($myrow1['costoRenta']){
            echo $myrow1['costoRenta'];
            }else{
                echo $_POST['costoRenta'];
            }
            ?>" /></td>
  <td>Cantidad Autorizada</td>
  <td><input name="cantidadAutorizada" type="text" size="5" value="<?php 
            if($myrow1['cantidadAutorizada']){
            echo $myrow1['cantidadAutorizada'];
            }else{
                echo $_POST['cantidadAutorizada'];
            }
            ?>" /></td>
  </tr>





<!--bloque 16-->


  <tr>      
  <td>Precio Adicional</td>
  <td><input name="precioEquipo" type="text" size="10" value="<?php 
            if($myrow1['precioEquipo']){
            echo $myrow1['precioEquipo'];
            }else{
                echo $_POST['precioEquipo'];
            }
            ?>" /></td>
  <td></td>
  <td></td>
  </tr>






<!--bloque 17-->


  <tr>      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>

  <tr>      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>



<thead>
<tr class="separator">
<th colspan="4"><div align="center">EXTRAS</div></th>
</tr>
</thead>







<!--bloque 18-->


  <tr>      
  <td>Imagen Equipo</td>
  <td><input type="file" name="file" id="file"></td>
  <td></td>
  <td></td>
  </tr>



<!--bloque 19-->


  <tr>      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>

  <tr>      
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>




<tr>
<th colspan="4"><div align="center"><img src="<?php echo $myrow1['ruta'];?>" alt="" width="200" height="200"></div></th>
</tr>
 </tbody>


    
</table>    
</div>    
    
    
    <br></br>    
    
    
    
    
    
    
    
    
    
    
    
<?php


if($_POST['entidad']!=NULL ){?>    
  <p align="center">
   
    <input name="update" type="submit"  value="Guardar/Modificar" />
    
  </p>
    <?php }?>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>



    

<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
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


