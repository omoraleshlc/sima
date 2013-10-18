<?php require("/configuracion/ventanasEmergentes.php");
require('/configuracion/funciones.php');

//$mostrarmenu=new menus();
//$mostrarmenu->menuTemplate($_GET['warehouse'],$_GET['datawarehouse'],$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,'principal',$rutaimagen,$basedatos);
$estilos=new muestraEstilosV2();
$estilos->styles();
$entidadMain=$entidad;
?>

        
<?php 


if($_POST['generaOrden']!=NULL){
    
    
    

    
if($_POST['entidad']!=NULL and $_POST['almacen']!=NULL and $_POST['keyTS']!=NULL and $_POST['registro']!=NULL and $_POST['nombre']!=NULL and $_POST['observaciones']){    
    
    
$q4 = "

    INSERT INTO sis_contadorOrdenesSOP(contador, usuario)
    SELECT(IFNULL((SELECT count(*)+1 from sis_contadorOrdenesSOP ), 1)), '".$usuario."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

$sSQL= "SELECT max(contador) as topeMaximo from sis_contadorOrdenesSOP where usuario='".$usuario."' order by keyConta DESC";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$solicitud= $myrow['topeMaximo'];       
    
    

$sSQL1da= "Select * From almacenes WHERE entidad='".$_POST['entidad']."' and almacen = '".$_POST['almacen']."'";
$result1da=mysql_db_query($basedatos,$sSQL1da);
$myrow1da = mysql_fetch_array($result1da); 

$sSQL1de= "Select * From sis_tipoSoporte WHERE keyTS = '".$_POST['keyTS']."'";
$result1de=mysql_db_query($basedatos,$sSQL1de);
$myrow1de = mysql_fetch_array($result1de); 

$agrega = "INSERT INTO sis_ordenesSOP (
solicitud,entidadSolicitud,almacen,keyTS,registro,nombre,usuario,fecha,hora,entidad,descripcionAlmacen,descripcionSoporte,status,observaciones
) values (
'".$solicitud."','".$_POST['entidad']."','".$_POST['almacen']."','".$_POST['keyTS']."',
'".$_POST['registro']."','".$_POST['nombre']."','".$usuario."','".$fecha1."',
'".$hora1."','".$entidad."','".$myrow1da['descripcion']."','".$myrow1de['descripcion']."','request',
    '".$_POST['observaciones']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$in="success";

 //echo '<a class="close" data-dismiss="success" href="#" aria-hidden="true">Solicitud recibida</a>';

}else{
$in="warning";
}    
}  else {
$in=null;    
}


?>



<?php  





if($_GET['keySOP'] AND $_GET['status']=='request'){

$sSQL= "SELECT *
FROM
sis_ordenesSOP
where
keySOP='".$_GET['keySOP']."'
    and
    status='request'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenesSOP set 
status='ontransit'
		WHERE keySOP='".$_GET['keySOP']."'";
//$q=mysql_real_escape_string($q);
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
	}



}


$date=$_GET['fecha1'];$entidad=$_GET['entidad'];?>







<?php 
if($_GET['keySOP'] AND $_GET['status']=='ontransit'){
//$q=mysql_real_escape_string($q);
$sSQL= "SELECT *
FROM
sis_ordenesSOP
where
keySOP='".$_GET['keySOP']."'
    and
    status='ontransit'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenesSOP set 
status='done'
		WHERE keySOP='".$_GET['keySOP']."'";
//$q=mysql_real_escape_string($_GET['keySOP']);
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                

}
}
?>




<?php 
if($_GET['keySOP']>0 AND $_GET['status']=='terminadas'){
//$q=mysql_real_escape_string($q);
$sSQL= "SELECT *
FROM
sis_ordenesSOP
where
keySOP='".$_GET['keySOP']."'
    and
    status='done'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keySOP']!=NULL and $myrow['status']){
$q = "UPDATE sis_ordenesSOP set 
status='ontransit'
		WHERE keySOP='".$_GET['keySOP']."'";
//$q=mysql_real_escape_string($_GET['keySOP']);
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                

}
}
?>

<?php //require("/configuracion/ventanasEmergentes.php");require("/configuracion/funciones.php");






if($_POST['ADDOS']!=NULL and $_POST['keySOP']>0 ){
    
 
$des=$_POST['descripcion'];    
    
$sSQLr= "SELECT *
FROM
observacionesSOP
where descripcion = '".utf8_decode($des)."'

 ";




$resultr=mysql_db_query($basedatos,$sSQLr);
$myrowr = mysql_fetch_array($resultr);


    
 if( $_POST['descripcion']!=NULL){
     
     if(!$myrowr['descripcion']){
$agrega = "INSERT INTO observacionesSOP (
descripcion,keySOP,usuario,fecha,hora,entidad
) values (
'".utf8_encode($_POST['descripcion'])."','".$_POST['keySOP']."',
'".$usuario."','".$fecha1."','".$hora1."','".$_POST['entidad']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script>';
//echo 'window.opener.document.forms["form1"].submit();';
echo 'window.alert("Agregado!");';
echo '</script>';
     }else{
      //ya existe   
     }
     

 }else{
echo '<script>';
//echo 'window.opener.document.forms["form1"].submit();';
echo 'window.alert("No se agrego!");';
echo '</script>';
     
 }

}
               


?>




<?php //keyS
if($_GET['keyS']>0 AND $_GET['eliminarT']=='si'){
//$q=mysql_real_escape_string($q);
$sSQL= "SELECT *
FROM
observacionesSOP
where
constraint_type='".$_GET['keyS']."'
   
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['keyS']!=NULL ){
$q = "DELETE FROM observacionesSOP WHERE keyS='".$_GET['keyS']."'";
//$q=mysql_real_escape_string($_GET['keySOP']);
		mysql_db_query($basedatos,$q);
		echo mysql_error();
                

}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    

    
    
    
    
    
    
    
    
    
<?php 


//require("/configuracion/ventanasEmergentes.php");?>
<link rel="stylesheet" type="text/css" href="../bt/anylinkmenu.css" />

<!--<script type="text/javascript" src="../bt/menucontents.js"></script>-->

<script type="text/javascript" src="../bt/anylinkmenu.js">

/***********************************************
* AnyLink JS Drop Down Menu v2.0- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com/dynamicindex1/.anylinkclass.htm for full source code
***********************************************/

</script>

<script type="text/javascript">

//anylinkmenu.init("menu_anchors_class") //Pass in the CSS class of anchor links (that contain a sub menu)
anylinkmenu.init("menuanchorclass")

</script>


<script>
var anylinkmenu3={divclass:'anylinkmenucols', inlinestyle:'', linktarget:'secwin'} //Third menu variable. Same precaution.
anylinkmenu3.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
anylinkmenu3.items=[
            <?php	


            $sSQL= "Select * From usersmodules WHERE (entidad='".$entidadMain."' and usuario='".$usuario."'
    and
extension>0  
)
or
(usuario='".$usuario."'
    and
    global='si'
)
group by main  ";




            $result=mysql_db_query($basedatos,$sSQL);
            while($myrow = mysql_fetch_array($result)){ 
            $numeroE=$myrow['numeroE'];
            $nCuenta=$myrow['nCuenta'];
            $a4+=1;
                //TRAES EL USUARIO, ASIGNA MODULOS; AHORA DIME LA RUTA
            if($myrowmp['global']=='si'){
            $sSQLmu1= "Select * From mainmodules WHERE name='".$myrowmp['main']."'";
            $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
            $myrowmu1 = mysql_fetch_array($resultmu1);    
            }else{    
            $sSQLmu1= "Select * From mainmodules WHERE entidad='".$entidadMain."' AND name='".$myrowmp['main']."'";
            $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
            $myrowmu1 = mysql_fetch_array($resultmu1);
            }
            $nT=$myrow['keyClientesInternos'];
            echo '["'.$myrow['main'].'", "'.trim($myrowmu1['ruta']).'"],';
           ?>
	   
	
<?php } ?>
]
</script>




    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


<div class="container">    

<div class="barra_separadora">
     
    <span ><a href="#" class="menuanchorclass myownclass" rel="anylinkmenu3">Menu Principal</a></span>
     
</div>


        
<?php 
//$menuPrimario=new menus();
//$menuPrimario->menuOperacionesBoot('../OPERACIONESHOSPITALARIAS/menuOperaciones.php?main=OPERACIONES&warehouse=sistemas&datawarehouse=','Menu Principal ','OPERACIONES','sistemas',$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos);

?>           
   



<?php if(isset($info)!=NULL){
  //echo $info;  
}
?>

    
  
    
    
<ul class="nav nav-tabs" id="myTab">

    <li><a href="#altaOrden" name="altaOrden">Nueva <span class="glyphicon glyphicon-plus"></span></a></li>
    <li><a href="#pendientes" name="pendientes">Pendientes</a></li>
    <li><a href="#enProceso" name="enProceso">En Proceso</a></li>
    <li><a href="#terminadas" name="terminadas">Terminadas</a></li>
    <li><a href="#resumen" name="resumen">Resumen</a></li>
</ul>

    
    
    
    
<div class="tab-content"  ><!--TAB CONTENT-->
    

    
    
    <div class="tab-pane" id="altaOrden"><!--TAB1 #altaOrden-->
            
        <br>
        <div class="panel panel-default">
            
                 
                 
                 


<div class="panel panel-primary">
      <div class="panel-heading"></div>   












                <form class="form" method="post"  >

        <?php if($in=='success'){?>   

          <div class="panel-default">
        <div class="alert alert-success">Orden generada correctamente!

        </div>
                  <br>
        <input type="Submit" name="aceptar" value="Aceptar" class="btn btn-primary btn-small"></input>  
          </div>


        <?php }else{ ?>


        <?php if($in=='warning'){ ?>

        <div class="alert alert-warning">
            Te faltan campos por llenar!!

            </div>
        <?php }?>           




          <table width="600" class="table-striped">












        <tr>
              <td scope="col"><div align="left"><small>Entidad</small></div></td>
              <td scope="col"><div align="left">



                            <?php	 		



                            $sqlNombre11 = "SELECT * from entidades
        WHERE
        status='A'
        ORDER BY descripcionEntidad ASC";
        $resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


        ?>          <small>
                    <select name="entidad"  class="form-controlsmall" onChange="this.form.submit();">

                  <option value="">---</option>
                                                      <?php
          while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
          echo mysql_error();?>
                    <option
                          <?php   if($_POST["entidad"]==$rNombre11['codigoEntidad']){echo 'selected=""';}?>
                        value="<?php echo $rNombre11["codigoEntidad"];?>"><?php echo utf8_decode($rNombre11["descripcionEntidad"]);?></option>
                    <?php } ?>
                    </select>
        </small>
              </div></td>
        </tr>  


















            <tr>
              <td ><div align="left"><small>Departamento</small></div></td>
              <td >
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
                          <small>  
                          <select name="almacen" class="form-controlsmall" onChange="this.form.submit();"/>
                          <option value="">Escoje</option>


                    <?php
          while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
          echo mysql_error();?>
                    <option
                           <?php   if($_POST["almacen"]==$rNombre11["almacen"]){ echo 'selected=""';}?>
                        value="<?php echo $rNombre11["almacen"];?>"><?php echo $rNombre11["descripcion"];?></option>
                    <?php } ?>
                    </select>
                            </small>
                            </div></td>
            </tr>







              <tr>
              <td ><div  align="left"><small>Tipo Soporte</small></div></td>
              <td >
                <div align="left">
        <?php	

        $sqlNombre11 = "SELECT * from sis_tipoSoporte 
        order by descripcion ASC
        ";
        $resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


        ?>
                    <small>  
                   <select name="keyTS" class="form-controlsmall"/>



                    <?php
          while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
          echo mysql_error();?>
                    <option
                           <?php   if($_POST["keyTS"]==$rNombre11["keyTS"]){ echo 'selected=""';}?>
                        value="<?php echo $rNombre11["keyTS"];?>"><?php echo $rNombre11["descripcion"];?></option>
                    <?php } ?>
                    </select>
                    </small>
                </div>
             </td>
            </tr>









            <tr>
              <td scope="col"><div align="left"><small>Registro</small></div></td>
              <td scope="col"><label>

                <div align="left">
                    <?php	 		
        $sqlNombre11 = "SELECT * from sis_inventarioEqComputo 
        WHERE
        entidad='".$_POST['entidad']."'
            and
            departamento='".$_POST['almacen']."'
        order by registro ASC
        ";
        $resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


        ?>
                        <div align="left">
                            <small>
                          <select name="registro" class="form-controlsmall" />



                    <?php
          while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
          echo mysql_error();?>
                    <option
                           <?php   if($_POST["registro"]==$rNombre11["registro"]){ echo 'selected=""';}?>
                        value="<?php echo $rNombre11["registro"];?>"> <?php echo $rNombre11["registro"].'  '.$rNombre11["descripcionUbicacion"];?></option>
                    <?php } ?>
                    </select>
                            </small>     
                </div>
              </label></td>
            </tr>



              <tr>

              <td scope="col"><div align="left"><small>Extension</small></div></td>
              <td scope="col">

                <small>

                <input class="form-control" placeholder="Extensión telefónica" id="focusedInput" type="text" name="extension" value="<?php echo $_POST['extension'];?>"></input>

                </small>

              </label></td>
            </tr>



            <tr>
              <td width="152" scope="col"><div align="left"><small>Usuario</small></div></td>
              <td width="451" scope="col"><label> </label>
                  <div align="left">
                    <input class="form-control" placeholder="Usuario Solicitante" id="focusedInput" type="text" name="nombre" value="<?php echo $_POST['nombre']; ?>"/>
                </div></td>
            </tr>


            <tr>
              <td width="152" scope="col"><div align="left"><small>Usuario Ejecutor</small></div></td>
              <td width="451" scope="col"><label> </label>
                  <div align="left">
                    <input class="form-control" placeholder="Usuario quien hará el trabajo" id="focusedInput" type="text" name="usuarioAplicacion" value="<?php echo $_POST['nombre']; ?>"/>
                </div></td>
            </tr>      



              <tr>
              <td width="152" scope="col"><div align="left"><small>Observaciones</small></div></td>
              <td width="451" >
                  <div align="left">
                    <textarea class="form-control" placeholder="Es el servicio que se ofrecerá a éste usuario" name="observaciones" cols="50" rows="5"  /><?php echo $_POST['observaciones']; ?></textarea>
                </div></td>
            </tr> 

                <tr>
              <td  >&nbsp;</td>
              <td >&nbsp;</td>
            </tr>

               <tr>
              <td  >&nbsp;</td>
              <td ><input class="btn btn-primary btn-xs" name="generaOrden" type="submit"  id="actualizar" value="Generar Orden" /></td>
            </tr>    

          </table>





        </form>
        <?php }?>    







        </div>
                      </div>   
    </div>
    
    
    

        
        
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        
    <div class="tab-pane" id="pendientes"><!--TAB2 #pendientes-->
        <br>



             <!--pendientes-->    
         <div class="panel panel-primary">
                <div class="panel-heading">
                 
                </div>     


          <table width="800"  class="table table-condensed" >

              <form>
                <th ><small>#</small></th>
                <th ><small>Fecha/Hora <span class="glyphicon glyphicon-time"></span>
        </small></th>
              <th ><small>TipoSoporte <span class="glyphicon glyphicon-wrench"></span>
        </small></th>
              <th ><small>Departamento <span class="glyphicon glyphicon-home"></span>
        </small></th>
              <th ><small>Usuario <span class="glyphicon glyphicon-user"></span>
        </small></th>
              

        <th ></th>        

        <th ></th>
<th ></th>






        <?php	


        $sSQL= "SELECT *
        FROM
        sis_ordenesSOP
        where

        status='request'

        order by keySOP ASC
         ";




        $result=mysql_db_query($basedatos,$sSQL);
        while($myrow = mysql_fetch_array($result)){ 
        $numeroE=$myrow['numeroE'];
        $nCuenta=$myrow['nCuenta'];
        $a2+=1;

        $nT=$myrow['keyClientesInternos'];


        /*
        $sSQL17d= "
        SELECT 
        *
        FROM
        clientesInternos
        WHERE 
        entidad='".$entidad."'
        and
        folioDevolucion = '".$myrow['folioVenta']."'
        ";
        $result17d=mysql_db_query($basedatos,$sSQL17d);
        $myrow17d = mysql_fetch_array($result17d);*/
                  ?>


              <tr>
              <td >
                  <small>
                  <?php 


                        echo $myrow['keySOP'];;
                ?></small>
              </td>
                  
                  
                  
           <td  ><small>
               <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora'];
                     //echo '</br>';

               //echo $myrow['hora'];
               ?></small>


           </td>  





          <td ><small><?php echo ucfirst(strtolower($myrow['descripcionSoporte']));

        ?></small>
              </td>





              <td >
        <small> 
        <?php


         echo ucfirst(strtolower($myrow['descripcionAlmacen']));
        ?>
        </small>



              </td>


                    <td >
        <small> 
        <?php


         echo $myrow['nombre'];
        ?>
        </small>



              </td>






          <td>



          <?php 
               //echo '<br>';

               $fActual=str_replace('-',' ',$fecha1);
               $fActual=str_replace(' ','',$fActual);
               $fActual=(int) ($fActual);

               $fReg=str_replace('-',' ',$myrow['fecha']);
               $fReg=str_replace(' ','',$fReg);

               $fReg=(int) ($fReg);
               $diff=$fActual-$fReg;
               if($diff>=3){
               echo '<a href="#pendientes" data-toggle="tooltip" title="Ya pasaron mas de 2 dias!"><img src="../bt/img/warning.jpeg" height="14" width="14"></img></a>';    
               }
               ?>    
          </td>



              <td >



              <small>    
        <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request#pendientes"> 

            <span class="glyphicon glyphicon-hand-right" data-toggle="tooltip" title="Enviar a En Proceso!"></span>

        </a>      
              </small>
              </td>


                <td >



              <small>    
        <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request#pendientes"> 

            <span class="glyphicon glyphicon-remove"></span>

        </a>      
              </small>
              </td>



              </tr> 
        <?php }?>

          </table>
            
       
</form>
            
            
            
            
            
        </div>
    </div>
    
    
    
    
    
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="tab-pane" id="enProceso"><!--TAB3 #enProceso-->
                 
                



                 <!--pendientes-->    
            <div class="panel-body">     

<div class="panel panel-primary">
      <div class="panel-heading"></div>     
    
    
              <table width="800"  class="table table-condensed" >


                    <th ><small>#</small></th>
                    <th ><small>Fecha/Hora <span class="glyphicon glyphicon-time"></span>
            </small></th>
                  <th ><small>TipoSoporte <span class="glyphicon glyphicon-wrench"></span>
            </small></th>
                  <th ><small>Departamento <span class="glyphicon glyphicon-home"></span>
            </small></th>
                  <th ><small>Usuario <span class="glyphicon glyphicon-user"></span>
            </small></th>
            

            <th ></th>        

            <th ><small>
            </small></th>

  <th ><small>
            </small></th>





            <?php	


            $sSQL= "SELECT *
            FROM
            sis_ordenesSOP
            where

            status='ontransit'

            order by keySOP ASC
             ";




            $result=mysql_db_query($basedatos,$sSQL);
            while($myrow = mysql_fetch_array($result)){ 
            $numeroE=$myrow['numeroE'];
            $nCuenta=$myrow['nCuenta'];
            $a3+=1;

            $nT=$myrow['keyClientesInternos'];


            /*
            $sSQL17d= "
            SELECT 
            *
            FROM
            clientesInternos
            WHERE 
            entidad='".$entidad."'
            and
            folioDevolucion = '".$myrow['folioVenta']."'
            ";
            $result17d=mysql_db_query($basedatos,$sSQL17d);
            $myrow17d = mysql_fetch_array($result17d);*/
                      ?>


                  <tr>
              <td  ><small><?php echo $myrow['keySOP'];?></small></td>    
               <td  ><small>
                   <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora'];
                         //echo '</br>';

                   //echo $myrow['hora'];
                   ?></small>


               </td>  





                  <td ><small><?php echo ucfirst(strtolower($myrow['descripcionSoporte']));

            ?></small>
                  </td>





                  <td >
            <small> 
            <?php


             echo ucfirst(strtolower($myrow['descripcionAlmacen']));
            ?>
            </small>



                  </td>


                        <td >
            <small> 
            <?php


             echo ucfirst(strtolower($myrow['nombre']));
            ?>
            </small>



                  </td>





              <td>



              <?php 
                   //echo '<br>';

                   $fActual=str_replace('-',' ',$fecha1);
                   $fActual=str_replace(' ','',$fActual);
                   $fActual=(int) ($fActual);

                   $fReg=str_replace('-',' ',$myrow['fecha']);
                   $fReg=str_replace(' ','',$fReg);

                   $fReg=(int) ($fReg);
                   $diff=$fActual-$fReg;
                   if($diff>=3){
                   echo '<a href="#" data-toggle="tooltip" title="Ya pasaron mas de 2 dias!"><img src="../bt/img/warning.jpeg" height="14" width="14"></img></a>';    
                   }
                   ?>    
              </td>


              
           <td id="tab3<?php echo $a3;?>">
            <small>   
            <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=ontransit#enProceso"> 
            <span class="glyphicon glyphicon-hand-left" data-toggle="tooltip" title="Terminar orden.."></span>
            </a>      
            </small>
                  </td>                 
              
              
              
              

                  <td id="tab3<?php echo $a3;?>">



            <small>   
            <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=ontransit#enProceso"> 
            <span class="glyphicon glyphicon-hand-right" data-toggle="tooltip" title="Terminar orden.."></span>
            </a>      
            </small>
                  </td>          




            <td>
  <!-- Button trigger modal -->
  <a data-toggle="modal" href="#myModal" >
    <span class="glyphicon glyphicon-book" data-toggle="tooltip" title="Agregar observaciones..">
        </span>
  </a>
  
  
  
  
  
  
<!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Observaciones</h4>
        </div>
        <div class="modal-body">
            
<form name="forma1" method="post">

<table  width="400" class="table table-striped"  align="center">
    
<tr>      
 

    
     <td scope="col"><div align="center">
<input type="hidden" value="<?php echo $myrow['keySOP'];?>" name="keySOP">
    <input type="hidden" value="<?php echo $myrow['entidad'];?>" name="entidad">
<textarea name="descripcion" cols="50" rows="5"></textarea>
              
     
    </div></td>
    
    

    
</tr>
    <tr>
         <td>
    <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="ADDOS" value="Guardar"></input>
        </div>        
        
    </td>   
    </tr>      
      
  
            
                  
      
      

              
              
              <?php 


if(!$_POST['update'] and !$_POST['ADDOS'] and $_GET['keyO']>0 and $_GET['del']=='si'){


$q = "DELETE FROM observacionesSOP
		
		WHERE 
 keyO='".$_GET['keyO']."'                

";
		//mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}


?>


    
    
<tr>    
<?php	



$sSQLr= "SELECT *
FROM
observacionesSOP
where keySOP='".$_GET['keySOP']."'
order by descripcion ASC
 ";




if($resultr=mysql_db_query($basedatos,$sSQLr)){
while($myrowr = mysql_fetch_array($resultr)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$r+=1;


	  ?>
    
    
   
   
   <td >
       <?php 
            echo ucfirst(strtolower($myrowr['descripcion']));
       ?>
  
   </td>   
  
 
  
  
  
     <td >
 
       <a href="soporte.php?keyS=<?php echo $myrowr['keyS'];?>&eliminarT=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=#enProceso"> 
 <span class="glyphicon glyphicon-remove"></span>

          </a>
   </td>
  
    
      
      
      
      
      
      
    </tr><?php  }}?>
    </table>
    


</form>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->    
                
            </td>


                    <td >




                  </td>



                  </tr> 
            <?php }?>

              </table>
</div>
                
                
                
                
             </div>
           
    </div>
    
    
    
    
     
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="tab-pane" id="terminadas"><!--TAB4 #terminadas-->
                
         



                 <!--pendientes-->    
            <div class="panel-body">     


                
                
                <form name="formaTerminada" method="post">                
                
                
<?php

$encabezadoFecha=new encabezadoFechas();
$encabezadoFecha->headDate($fecha1);
    


?>                
                
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
                </form>
                
                
                  <div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading"></div>     
               
                
                
              <table width="1000"  class="table table-condensed" >


                    <th ><small>#</small></th>
                    <th ><small>Fecha/Hora <span class="glyphicon glyphicon-time"></span>
            </small></th>
                  <th ><small>TipoSoporte <span class="glyphicon glyphicon-wrench"></span>
            </small></th>
                  <th ><small>Departamento <span class="glyphicon glyphicon-home"></span>
            </small></th>
                  <th ><small>Usuario <span class="glyphicon glyphicon-user"></span>
            </small></th>
                 

            <th ></th>        

            <th ></th>
  <th ></th>
              <th ></th>






            <?php	


            $sSQL= "SELECT *
            FROM
            sis_ordenesSOP
            where

            status='done'
            and
            fecha>='".$_POST['fechaInicial']."'
                and
            fecha<='".$_POST['fechaFinal']."' ";




            $result=mysql_db_query($basedatos,$sSQL);
            while($myrow = mysql_fetch_array($result)){ 
            $numeroE=$myrow['numeroE'];
            $nCuenta=$myrow['nCuenta'];
            $a4+=1;

            $nT=$myrow['keyClientesInternos'];


            /*
            $sSQL17d= "
            SELECT 
            *
            FROM
            clientesInternos
            WHERE 
            entidad='".$entidad."'
            and
            folioDevolucion = '".$myrow['folioVenta']."'
            ";
            $result17d=mysql_db_query($basedatos,$sSQL17d);
            $myrow17d = mysql_fetch_array($result17d);*/
                      ?>


                  <tr>

                  <td >
                      <small>
                      <?php 


                            echo $myrow['keySOP'];;
                    ?></small>
                  </td>
                      
               <td  ><small>
                   <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora'];
                         //echo '</br>';

                   //echo $myrow['hora'];
                   ?></small>


               </td>  





              <td ><small><?php echo ucwords(strtolower($myrow['descripcionSoporte']));

            ?></small>
                  </td>





                  <td >
            <small> 
            <?php


             echo ucwords(strtolower($myrow['descripcionAlmacen']));
            ?>
            </small>



                  </td>


                        <td >
            <small> 
            <?php


             echo $myrow['nombre'];
            ?>
            </small>



                  </td>





              <td>



              <?php 
                   //echo '<br>';

                   $fActual=str_replace('-',' ',$fecha1);
                   $fActual=str_replace(' ','',$fActual);
                   $fActual=(int) ($fActual);

                   $fReg=str_replace('-',' ',$myrow['fecha']);
                   $fReg=str_replace(' ','',$fReg);

                   $fReg=(int) ($fReg);
                   $diff=$fActual-$fReg;
                   if($diff>=3){
                   echo '<a href="#" data-toggle="tooltip" title="Ya pasaron mas de 2 dias!"><img src="../bt/img/warning.jpeg" height="14" width="14"></img></a>';    
                   }
                   ?>    
              </td>




                  <td >



            <small>   
            <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=terminadas#terminadas"> 
            <span class="glyphicon glyphicon-hand-left" data-toggle="tooltip" title="Regresar a orden pendiente.."></span>
            </a>      
            </small>
                  </td>  





                  <td >



            <small>   
            <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=terminadas#terminadas"> 
            <span class="glyphicon glyphicon-hand-right" data-toggle="tooltip" title="Terminar orden.."></span>
            </a>      
            </small>
                  </td>          




            <td>  
            <small>          
            <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=terminadas#terminadas"> 
            <span class="glyphicon glyphicon-list" data-toggle="tooltip" title="Agregar observaciones.."></span>
            </a>      
            </small>
                  </td>


                    <td >




                  </td>



                  </tr> 
            <?php }?>

              </table>
 </div>
             </div>
             
    </div>
    
    




    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<div class="tab-pane" id="resumen"><!--TAB5 #altaOrden-->
    <br>
       


       
    
    
    
                <form name="formaResumen" method="post">                
                
                


  <!-- Default panel contents -->
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading"></div>    
     
<table class="table"> 
    
    <th><div class="col-lg-6"><small>Fecha Inicial</small></div></th>    
    <th><div class="col-lg-6"><small>Fecha Final</small></div></th>
    
    
<tr> 
    
<td>    


  <div class="col-lg-6">
  <div class="input-group">
      <input  type="text" name="fechaInicial" id="campo_fecha3" value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" class="form-control" ></input>
         <span class="input-group-btn">
<button class="btn btn-default btn-link btn-lg" type="button" id="lanzador3"><span class="glyphicon glyphicon-calendar"></span></button>
         </span>
  </div>
   
  </div><!-- /.col-lg-6 -->
 
</td>  

  
    

<td> 
    
 
  <div class="col-lg-6">
       <div class="input-group">
      <input id="campo_fecha4" name="fechaFinal" type="text" value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" class="form-control" >
         <span class="input-group-btn">
        <button class="btn btn-default btn-link btn-lg" type="button" id="lanzador4"><span class="glyphicon glyphicon-calendar"></span></button>
      </span>
              
          </div>
  </div>



</td>

    
    <td>
        <div class="col-lg-6">            
<input data-loading-text="Cargando..." class="btn btn-primary" type="submit" name="generarReporte"  value="Generar Reporte" />
</div>  
    </td>

</tr>
    
    
    
     
</table>     
  
  
  
  
  

<?php if($POST['generarReporte']!=NULL AND $_POST['fechaFinal']>=$_POST['fechaFinial']){?>
<iframe src="grafica1.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>" name="frame1" id="frame1" 
        width="1000" height="500px" align="center" scrolling="no" frameborder="0">
    
</iframe>
<?php } ?>
  
</div>                
  </div>                
   
  
  
  
  
  
  
  
    




   
</div>    <!--div de container tabs-->
</div>    <!--div de container-->






















<script>
    //$("#nav nav-tabs").tabs("div.tab-pane", {event:'mouseover'});
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');
    $("#myTab").tabs("div.description", {event:'mouseover'});
</script>
    
    
    
    
    
    
    
    
    
    
    
  <script src="../bt/js/jquery-1.8.3.min.js"></script>
<script>
    var $j = jQuery.noConflict();
$j(document).ready(function() {
    $j("#content div").hide(); // Initially hide all content
    $j("#tabs li:first").attr("id","current"); // Activate first tab
    $j("#content div:first").fadeIn(); // Show first tab content
    
    $j('#tabs a').mouseover(function(e) {
        e.preventDefault();
        if ($j(this).closest("li").attr("id") == "current"){ //detection for current tab
         return       
        }
        else{             
        $j("#content div").hide(); //Hide all content
        $j("#tabs li").attr("id",""); //Reset id's
        $j(this).parent().attr("id","current"); // Activate this
        $j('#' + $j(this).attr('name')).fadeIn(); // Show content for current tab
        }
    });
});
</script>        
    
    
    
    
    
  
  
  
  
  
  



