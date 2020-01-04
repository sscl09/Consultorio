<?php
  session_start();
  require_once("Funciones/funcionesRegistroMedico.php");
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ficha']) && validarFicha($_POST['ficha'])){
    if (!empty($_POST['honey'])){
      return header ('Location: index.php');
    }
    if (!isset($_SESSION['administrador'])){
      return header ('Location: index.php');
    }
    $campos = [
      'nombre' => 'Nombre',
      'apellido_paterno' => 'Apellido paterno',
      'apellido_materno' => 'Apellido materno',
      'domicilio' => 'Domicilio',
      'cedula_profesional' => 'Cédula profesional',
      'cedula_especialidad' => 'Cédula de especialidad',
      'correo' => 'Correo electrónico',
      'telefono' => 'Teléfono',
      'password' => 'Contraseña',
      'passwordCopy' => 'Copia de contraseña',
      'terminos' => 'Terminos y condiciones'
    ];
    
    $errores = validarCampos ($campos);
    $errores = array_merge($errores, compararPassword($_POST['password'],$_POST['passwordCopy']));

    if (empty($errores)){
      $errores = registro();
    }
  }

  $titulo = "Consultorio Pediátrico | Registro médico";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-registro">
      <div class="row">
        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3>Registro de horario</h3>
          <hr>

          <?php if(!empty($errores)){echo mostrarErrores($errores);} ?>

          <!-- Formulario de registro -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id = "registro-medico" >
            <input type="hidden" name="ficha" value="<?php echo fichaCSRF(); ?>">
            <input type="hidden" name="honey" value="">
            <p>Registro de horario de médico</p>
            <hr>

            <div class="row">
              <div class="col-sm-3">
                <h5>Lunes</h5>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de entrada </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Lunes-entrada" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de salida </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Lunes-salida" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-3">
                <h5>Martes</h5>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de entrada </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Martes-entrada" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de salida </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Martes-salida" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-3">
                <h5>Miércoles</h5>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de entrada </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Miercoles-entrada" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de salida </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Miercoles-salida" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-3">
                <h5>Jueves</h5>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de entrada </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Jueves-entrada" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de salida </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Jueves-salida" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-3">
                <h5>Viernes</h5>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de entrada </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Viernes-entrada" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de salida </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Viernes-salida" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-3">
                <h5>Sábado</h5>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de entrada </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Sabado-entrada" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de salida </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Sabado-salida" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-3">
                <h5>Domingo</h5>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de entrada </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Domingo-entrada" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <span> <i class="fa fa-hourglass icono-izquierdo"></i>Hora de salida </span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="time" class="form-control" name="Domingo-salida" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <br>
            <div class="row justify-content-md-center">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-success btn-block" name="btn-registro" tabindex="12">
                  Registrar
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
<?php
  require_once('Parciales/abajo.php');
  require_once('Parciales/footer.php');

?>
