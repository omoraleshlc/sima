<?php require("/configuracion/ventanasEmergentes.php");
/*
 * Another In Place Editor - a jQuery edit in place plugin
 *
 * Copyright (c) 2009 Dave Hauenstein
 *
 * License:
 * This source file is subject to the BSD license bundled with this package.
 * Available online: {@link http://www.opensource.org/licenses/bsd-license.php}
 * If you did not receive a copy of the license, and are unable to obtain it,
 * email davehauenstein@gmail.com,
 * and I will send you a copy.
 *
 * Project home:
 * http://code.google.com/p/jquery-in-place-editor/
 *
 */
 
// sleep for a half or a second
// for demonstrating the 'saving...' functionality on the front end
usleep(1000000 * .5);

/*
 * These are the default parameters that get to the server from the in place editor
 *
 * $_POST['update_value']
 * $_POST['element_id']
 * $_POST['original_html']
 *
*/

/*
 * since the in place editor will display whatever the server returns
 * we're just going to echo out what we recieved. In reality, we can 
 * do validation and filtering on this value to determine if it was valid
*/
//echo $_POST['update_value'];








$sSQL1a= "Select * From relacionClientesTipo where 
entidad='".$entidad."'
    and
descripcion='".$_POST['update_value']."' 


";
$result1a=mysql_db_query($basedatos,$sSQL1a); 
$myrow1a = mysql_fetch_array($result1a);





$sSQL1= "Select * From relacionCliente where 
entidad='".$entidad."'
    and
cliente='".$_POST['element_id']."' 


";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);






if(!$myrow1['tipo']){
 $agrega = "INSERT INTO relacionCliente (
cliente,tipo,entidad,tipoReporte
) values ('".$_POST['element_id']."','".$myrow1a['tipo']."','".$entidad."','estadisticasAseguradoras1')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}  else{          
         
   $agrega = "UPDATE
            relacionCliente
               set
               tipo='".$myrow1a['tipo']."'
           WHERE
           entidad='".$entidad."'
             and
               cliente='".$_POST['element_id']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}




           $q = "UPDATE
           cargosCuentaPaciente
           set
           statusPC='".$myrow1a['tipo']."'
           WHERE
           (
           entidad='".$entidad."'
           and
           clientePrincipal='".$_POST['element_id']."'
           and
           gpoProducto!=''
           and
           statusCargo='cargado'
           and
           (tipoPaciente='interno' or tipoPaciente='urgencias'))
           OR
                      (
           entidad='".$entidad."'
           and
           clientePrincipal='".$_POST['element_id']."'
           and
           gpoProducto!=''
           and
           statusCargo='cargado'
           and
           tipoPaciente='externo' and fechaCierre!='')
                         ";
                        mysql_db_query($basedatos,$q);
                        echo mysql_error();
                        
if($_POST['update_value']!=NULL){                        
echo '<div align="left" class="normal">';                        
echo trim($_POST['update_value']);
echo '</div>';
}else{
echo '<div align="left" class="normal">';     
echo 'Editar';
echo '</div>';    
}
?>