<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "Consultorio";

	$conn = new mysqli($servername, $username, $password, $dbname, "8080");
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM Paciente";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM Paciente WHERE Nombre LIKE '%$q%' OR Apellido_paterno LIKE '%$q%' OR Apellido_materno LIKE '%$q%' OR Fecha_nacimiento LIKE '%$q%'";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
		$salida.="<form method=\"POST\" action=\"mostrarDatos.php\"><table class=\"table table-responsive tabla_datos \" >
    			<thead>
    				<tr id='titulo'>
    					<th>Nombre</th>
    					<th>Apellido paterno</th>
    					<th>Apellido materno</th>
    					<th>Fecha de nacimiento</th>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
			$salida.="<tr>
						<th style=\"display:none;\">".$fila['ID_Paciente']."</th>
    					<th>".$fila['Nombre']."</th>
    					<th>".$fila['Apellido_paterno']."</th>
						<th>".$fila['Apellido_materno']."</th>
						<th>".$fila['Fecha_nacimiento']."</th>
						<th><button class=\"obtener\"type=\"submit\"><i class=\"fa fa-edit edit\"></i></button></th>
						
						<th></th>
    				</tr>";

    	}
    	$salida.="</tbody></table> <input type=\"hidden\" name=\"id-paciente\" id=\"id-paciente\" value=\"\"></form>";
    }else{
    	$salida.="No hay datos";
    }
    echo $salida;
	$conn->close();
	

	// <th><input class=\"obtener\"type=\"submit\" value=\"Guardar\"></th>

?>
