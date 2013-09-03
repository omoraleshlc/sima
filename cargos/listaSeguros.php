<?php 
	// ---------------------------------------------------------------- // 
	// DATABASE CONNECTION PARAMETER 									// 
	// ---------------------------------------------------------------- // 
	// Modify config.php with your DB connection parameters or add them //
	// directly below insted of include('config.php'); 					//
	
	include('/configuracion/ventanasEmergentes.php'); 
	
	
	// ---------------------------------------------------------------- // 
	// SET PHP VAR - CHANGE THEM										// 
	// ---------------------------------------------------------------- // 
	// You can use these variables to define Query Search Parameters:	//
	
	// $SQL_FROM:	is the FROM clausule, you can add a TABLE or an 	//
	// 				expression: USER INNER JOIN DEPARTMENT...			//
	
	// $SQL_WHERE	is the WHER clausule, you can add an table 	 		//
	// 				attribute for ezample name or an 					//
	
	


?>
<?php

	$nombres        =   strip_tags($_GET['q']);
	$getRecord_sql	=	"
	SELECT * FROM 
clientes
where
nomCliente like '%$nombres%'
LIMIT 0,10

	";
	$getRecord		=	mysql_query($getRecord_sql);

	// ---------------------------------------------------------------- // 
	// AJAX Response													// 
	// ---------------------------------------------------------------- // 
	
	// Change php echo $row['name']; and $row['department']; with the	//
	// name of table attributes you want to return. For Example, if you //
	// want to return only the name, delete the following code			//
	// "<br /><?php echo $row['department'];></li>"//
	// You can modify the content of ID element how you prefer			//
	echo '<ul>';
	while ($row = mysql_fetch_array($getRecord)) {?>
		<li><a href="confirmarCita.php?numeroEx=<?php echo $row['numCliente']; ?>&paciente=<?php echo $row['nomCliente']; ?>&fechaSolicitud=<?php echo $_GET['fechaSolicitud'];?>&almacen=<?php echo $_GET['almacen'];?>&horaSolicitud=<?php echo $_GET['horaSolicitud'];?>&tipoCliente=<?php echo $_GET['tipoCliente'];?>&cargos=cargado&almacenSolicitud=<?php echo $_GET['almacenSolicitud'];?>&telefono=<?php echo $_GET['telefono'];?>"><?php echo $row['nombreCompleto']; ?> <small><?php echo $row['numCliente']; ?></small></a></li>
	<?php } 
	echo '</ul>';
	?>
