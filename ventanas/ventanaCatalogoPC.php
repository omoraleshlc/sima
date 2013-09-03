<?php require("/configuracion/ventanasEmergentes.php"); ?>



<?php 
//EVENTOS













if($_POST['update'] ){ 

  
 
    

    
    
if($_POST['entidad']!=NULL and $_POST['almacen']!=NULL)    {
    
    
//verifico que no exista en el sistema eese usuario

$sSQL1= "Select * From inventarioEqComputo WHERE solicitud = '".$_GET['solicitud']."'";
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
$q = "UPDATE inventarioEqComputo set 
departamento='".$_POST['almacen']."',
keyTE='".$_POST['keyTE']."', 
keyMA='".$_POST['keyMA']."',
motherboard='".$_POST['motherboard']."', 
drives='".$_POST['drives']."',
harddisk='".$_POST['harddisk']."',
memoriaRam='".$_POST['memoriaRam']."',
keyMAM='".$_POST['memoriaRam']."',
descripcionUbicacion='".$_POST['descripcionUbicacion']."',
monitor='".$_POST['monitor']."',
usuario='".$usuario."',
fecha='".$fecha1."',
hora='".$hora1."',
entidad='".$entidad."',
    descripcionEntidad='".$myrow1a['descripcionEntidad']."',
        descripcionAlmacen='".$myrow1b['descripcion']."'


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

    INSERT INTO contadorEquipos(contador, usuario)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorEquipos ), 1)), '".$usuario."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT max(contador) as topeMaximo from contadorEquipos where usuario='".$usuario."' order by keyCExt DESC";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $registro =$myrow['topeMaximo']; 
    
    if($registro<1){$registro=1;}else{$registro+=1;}
    
    
    $agrega = "INSERT INTO inventarioEqComputo (
registro,departamento,keyTE,keyMA,motherboard,drives,harddisk,memoriaRam,keyMAM,descripcionUbicacion,monitor,
usuario,fecha,hora,entidad,solicitud,status,descripcionEntidad,descripcionAlmacen,tipoProcesador,velocidadProcesador
) values (
'".$registro."',
'".$_POST['almacen']."',
    '".$_POST['keyTE']."','".$_POST['keyMA']."','".$_POST['motherboard']."','".$_POST['drives']."','".$_POST['harddisk']."',
        '".$_POST['memoriaRam']."','".$_POST['keyMAM']."','".$_POST['descripcionUbicacion']."','".$_POST['monitor']."',
            '".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$_GET['solicitud']."','A',
                '".$myrow1a['descripcionEntidad']."','".$myrow1b['descripcion']."','".$_POST['tipoProcesador']."','".$_POST['velocidadProcesador']."'
)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
    
    
    
    
    
    
    
    
 $agrega = "INSERT INTO inventarioEqComputo (
registro,departamento,keyTE,keyMA,motherboard,drives,harddisk,memoriaRam,keyMAM,descripcionUbicacion,monitor,
usuario,fecha,hora,entidad,solicitud,status,descripcionEntidad,descripcionAlmacen,tipoProcesador,velocidadProcesador
) values (
'".$registro."',
'".$_POST['almacen']."',
    '".$_POST['keyTE']."','".$_POST['keyMA']."','".$_POST['motherboard']."','".$_POST['drives']."','".$_POST['harddisk']."',
        '".$_POST['memoriaRam']."','".$_POST['keyMAM']."','".$_POST['descripcionUbicacion']."','".$_POST['monitor']."',
            '".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$_GET['solicitud']."','A',
                '".$myrow1a['descripcionEntidad']."','".$myrow1b['descripcion']."','".$_POST['tipoProcesador']."','".$_POST['velocidadProcesador']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se ingreso el usuario: ".$_POST['usuario']; 
echo '<script>
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
$sSQL1= "Select * From inventarioEqComputo WHERE solicitud='".$_GET['solicitud']."'  ";
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
    
    
    
  <table width="700" >
      
   
 
      
      
     <?php if($myrow1['registro']>0){?> 
           <tr  >
      <th colspan="2"><p align="center"># REGISTRO <?php echo $myrow1['registro'];?></p></th>
 
    </tr>
      <?php }?>
      
     <tr  >
      <th colspan="2"><p align="center">AREA DE TRABAJO</p></th>
 
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
		  <select name="almacen"  id="almacen"/>
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["almacen"]!=NULL AND ($_POST["almacen"]==$myrow1["medico"])){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["almacen"];?>"> <?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>
	            </div></td>
    </tr>
      
      
      
      
    <tr>
      
        
           <tr>
      <td width="152" ><div align="left">Ubicacion</div></td>
      <td width="451" >
          <div align="left">
            <input name="descripcionUbicacion" type="text" size="50" id="nombre" value="<?php 
            if($myrow1['descripcionUbicacion']){
            echo $myrow1['descripcionUbicacion'];
            }else{
            echo $_POST['descripcionUbicacion'];
            }
            ?>" placeholder="Descripcion de la Ubicacion"/>
        </div>
      
      </td>
          </tr>
        
        
        
        
        <td scope="col"><div align="left">Tipo Equipo</div></td>
        
        
        
        <td>
       <?php	 		
$sqlNombre11 = "SELECT * from tipoEquipo 

order by descripcion ASC
";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
                <div align="left">
		  <select name="keyTE"  />
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["keyTE"]==$rNombre11["keyTE"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["keyTE"];?>"> <?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>
                </td>
    </tr>
    
      <td></td>
       <td></td>
       
       
       
       <tr><th colspan="2"><p align="center">SISTEMA OPERATIVO</p></th></tr> 
      <td scope="col"><div align="left">Selecciona</div></td>
      <td scope="col"><div align="left">
<iframe src="fos.php?solicitud=<?php echo $_GET['solicitud'];?>" frameborder="0" width="100%" align="left">

Tu navegador no soporta frames!

</iframe>


       	            
      </div></td>
    </tr>
       
    



 





    
    
          <td></td>
       <td></td>   
       
       
       
       
       
       
       
       
       
             
          <tr><tr> <th colspan="2"><p align="center">SOFTWARE</p></th>
      
</tr> 
      <td scope="col"><div align="left">Selecciona</div></td>
      <td scope="col"><div align="left">

<iframe src="c1.php?solicitud=<?php echo $_GET['solicitud'];?>" frameborder="0" width="100%" align="left">

Tu navegador no soporta frames!

</iframe>
      </div></td>
    </tr>
      
       
       
       
       
       <td></td><td></td>
<tr> <th colspan="2"><p align="center">RED</p></th>
      
</tr>   
    <tr>
      <td width="152" ><div align="left">Tipo Conexion</div></td>
      <td width="451" ><label> </label>
          <div align="left">
<iframe src="ctipoConexion.php?solicitud=<?php echo $_GET['solicitud'];?>" frameborder="0" width="100%" align="left">

Tu navegador no soporta frames!

</iframe>
        </div></td>
          </tr>
    
       






       
       
       

  

       
       
       
           <td></td><td></td>
<tr> <th colspan="2"><p align="center">CARACTERISTICAS</p></th>
      
</tr>   
           
      
           
  <tr>
      <td width="152" scope="col"><div align="left">Marca</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
<?php	 		

               

                    $sqlNombre11 = "SELECT * from marcas

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
            </select>              
        </div></td>
          </tr>             
           
           

           
           
    
           
           
  <tr>
      <td width="152" scope="col"><div align="left">Tipo de Procesador</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
<?php	 		

               

                    $sqlNombre11 = "SELECT * from catTipoProcesador

ORDER BY descripcion ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
	    <select name="keyTP"  id="entidad">

          <option value="">---</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                  <?php   if($_POST["keyTP"]==$rNombre11['keyTP']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["keyTP"];?>"><?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>              
        </div></td>
          </tr>            
           
      
           
           
           
           
 <tr>
      <td width="152" scope="col"><div align="left">Velocidad Procesador</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
              <input name="velocidadProcesador" type="text" size="40" value="<?php 
              if($myrow1['velocidadProcesador']){
              echo $myrow1['velocidadProcesador'];
              }else{
              echo $_POST['velocidadProcesador'];    
              }    
              ?>" placeholder="2.4Gz"/><br>
        </div></td>
          </tr>           
           
           
           
           
           
           
    
           
           
  <tr>
      <td width="152" scope="col"><div align="left">Motherboard</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
              <input name="motherboard" type="text" size="40" value="<?php 
              if($myrow1['motherboard']){
              echo $myrow1['motherboard'];
              }else{
              echo $_POST['motherboard'];    
              }    
              ?>" placeholder="Ej. VIA Technologies, Inc. P4M266-8235"/><br>
        </div></td>
          </tr>           
           
           
     <tr>
      <td width="152" scope="col"><div align="left">Unidad (Drive)</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="drives" type="text" size="40" value="<?php 
           if($myrow1['drives']){
            echo $myrow1['drives'];
           }else{
           echo $_POST['drives'];    
           }
            ?>" placeholder="Ej. LITEON CD-ROM LTN525"/>
        </div></td>
          </tr>        
           
           
           
           
    <tr>
      <td width="152" scope="col"><div align="left">Disco Duro</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="harddisk" type="text" size="10" value="<?php 
            if($myrow1['harddisk']){
            echo $myrow1['harddisk'];
            }else{
                echo $_POST['harddisk'];
            }
            ?>" placeholder="Gygabytes"/>
        </div></td>
          </tr>
   
    
           
  <tr>
      <td width="152" scope="col"><div align="left">Memoria RAM</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="memoriaRam" type="text" size="10" value="<?php 
            if($myrow1['memoriaRam']){
            echo $myrow1['memoriaRam'];
            }else{
                echo $_POST['memoriaRam'];
            }
            ?>" onKeyPress="return checkIt(event)" placeholder="Gygabytes"/>
        </div></td>
          </tr>         
           
           
           
           
           
           
           
<tr>
      <td width="152" scope="col"><div align="left">Marca Monitor</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
<?php	 		

               

                    $sqlNombre11 = "SELECT * from marcasm

ORDER BY descripcion ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
	    <select name="keyMAM" onClick="this.form.submit();">

          <option value="">N/A</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                  <?php   if($_POST["keyMAM"]==$rNombre11['keyMAM']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["keyMAM"];?>"><?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>              
        </div></td>
          </tr>           
           
           
           <?php if($_POST['keyMAM']!=NULL){?>
            <tr>
                <td width="152" scope="col"><div align="left"><?php echo utf8_decode('Tamaño');?></div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="monitor" type="text" size="5" value="<?php 
            if($myrow1['monitor']){
            echo $myrow1['monitor'];
            }else{
                echo $_POST['monitor'];                
            }
            ?>"/>(Pulgadas)
        </div></td>
          </tr>    
           <?php }?>
           
           
           
           
           
           
           
           
           
           
           
           
           
           
        <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    
    
    
  </table>
    
    
    
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
</body>
</html>
