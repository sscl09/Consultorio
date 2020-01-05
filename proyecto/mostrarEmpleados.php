<?php
  session_start();
  require_once("Recursos/conexion.php");
    if (!isset($_SESSION['administrador'])){
      return header ('Location: index.php');
    }

    $declaracion = $con -> prepare ("SELECT * FROM `Medico`");
    $declaracion -> execute();
    $resultado = $declaracion -> get_result();
    $cantidad = mysqli_num_rows($resultado);
    $declaracion -> close();
    $con -> close();

  $titulo = "Consultorio Pediátrico | Empleados";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-medicos">
      <h3>Médicos del consultorio pediátrico</h3>
      <hr>
      <p>Médicos que cuentan con una cuenta dentro del sistema del consultorio pediátrico</p>
      <hr>
      <br>
    <?php
        if ($cantidad > 0){
            echo '
            <table class="table table-responsive">
            <thead >
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Cédula profesional</th>
                    <th>Cédula de especialidad</th>
                    <th>Domicilio</th>
                    
                </tr>
            </thead>
            <tbody>';

            while ($linea = mysqli_fetch_array($resultado)){
                echo '<tr>
                      <th>'.$linea['Nombre']. ' '.$linea['Apellido_paterno']. ' '. $linea['Apellido_materno'] . '</th>
                      <th>'.$linea['Telefono'].'</th>
                      <th>'.$linea['Correo'].'</th> 
                      <th>'.$linea['Cedula_Profesional'].'</th>
                      <th>'.$linea['Cedula_Especialidad'].'</th> 
                      <th>'.$linea['Domicilio'].'</th>
                      </tr>';
            }

            echo '  </tbody>
                  </table>';
        }
        else{
          echo '<h1>No hay médicos registrados</h1>';
        }


    ?>

    </div>
<?php
  require_once('Parciales/abajo.php');
  require_once('Parciales/footer.php');

?>
