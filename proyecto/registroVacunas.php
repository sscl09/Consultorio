<?php
  session_start();
  require_once("Recursos/conexion.php");
  require_once("Funciones/funcionesRegistroVacunas.php");
      $edad = obtenerEdadMeses($con);

      $declaracion = $con -> prepare("SELECT * FROM `Vacuna` WHERE `Edad_Recomendada` <= $edad");
      $declaracion -> execute();
      $resultado = $declaracion -> get_result();
      $cantidad = mysqli_num_rows($resultado);
      $declaracion -> close();

  if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ficha']) && validarFicha($_POST['ficha'])) {
      if (!empty($_POST['honey'])) {
          return header('Location: index.php');
      }
      if (!isset($_SESSION['medico'])) {
          return header('Location: index.php');
      }

      echo 'hoa';
      //registro ($con, $edad);

      $con -> close();
  }

  $titulo = "Consultorio Pediátrico | Empleados";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

  <!-- Contenedor principal : Cuerpo de la página -->
  <div class="container" id="pagina-registro">
      <div class="row">
        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3>Registro de pediatras</h3>
          <hr>

          <!-- Formulario de registro -->
            <?php
                  if ($cantidad > 0){
                      echo '
                      <form  method="POST" id = "registro-vacunas" >
                        <input type="hidden" name="ficha" value="<?php echo fichaCSRF(); ?>">
                        <input type="hidden" name="honey" value="">
                        <p>Registro de médicos para el consultorio pediátrico</p>
                        <hr>
                      <table class="table table-responsive">
                      <thead >
                          <tr>
                              <th>Nombre</th>
                              <th>Endermadad</th>
                              <th>Dosis</th>
                              <th>Edad recomendada</th>
                              <th>Fecha de aplicación</th>
                          </tr>
                      </thead>
                      <tbody>';

                      while ($linea = mysqli_fetch_array($resultado)){
                          echo '<tr>
                                <th>'.$linea['Nombre']. '</th>
                                <th>'.$linea['Endermadad'].'</th>
                                <th>'.$linea['Dosis'].'</th> 
                                <th>'.$linea['Edad_Recomendada'].'</th>
                                <th><label><input type="checkbox" value="true" name="'.$linea['ID_Vacuna'].'"></label></th> 
                                <th></th>
                                </tr>';
                      }

                      echo '  </tbody>
                            </table>
                            <div class="row justify-content-md-center">
                              <div class="col-sm-6">
                                <button type="submit" class="btn btn-success btn-block" name="btn-registro">
                                  Registrar
                                </button>
                              </div>
                            </div>
                            </form>
                            ';
                  }
                  else{
                    echo '<h1>No hay vacunas registrados</h1>';
                  }
              ?>
        </div>
      </div>
    </div>
<?php
  require_once('Parciales/abajo.php');
  require_once('Parciales/footer.php');

?>

