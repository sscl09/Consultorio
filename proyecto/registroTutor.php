<?php
  session_start();
  require_once("Funciones/funcionesRegistroTutor.php");
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ficha']) && validarFicha($_POST['ficha'])){
    if (!empty($_POST['honey'])){
      return header ('Location: index.php');
    }
    if (!isset($_SESSION['medico'])){
      return header ('Location: index.php');
    }
    $campos = [
      'nombre' => 'Nombre',
      'apellido_paterno' => 'Apellido paterno',
      'apellido_materno' => 'Apellido materno',
      'domicilio' => 'Domicilio',
      'correo' => 'Correo electrónico',
      'telefono' => 'Teléfono'
    ];
    
    $errores = validarCampos ($campos);

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
          <h3>Registro de tutor</h3>
          <hr>

          <?php if(!empty($errores)){echo mostrarErrores($errores);} ?>

          <!-- Formulario de registro -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id = "registro-tutor" >
            <input type="hidden" name="ficha" value="<?php echo fichaCSRF(); ?>">
            <input type="hidden" name="honey" value="">
            <p>Registro de tutor para un paciente</p>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-user icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="nombre" value="<?php echo $_POST['nombre'] ?? '' ?>" placeholder="Nombre(s)" tabindex="1" autofocus>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-user icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="apellido_paterno" value="<?php echo $_POST['apellido_paterno'] ?? '' ?>" placeholder="Apellido paterno" tabindex="2">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-user icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="apellido_materno" value="<?php echo $_POST['apellido_materno'] ?? '' ?>" placeholder="Apellido materno" tabindex="3">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">
                    <div class="campo-contenedor tip">
                      <span> <i class="fa fa-home icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="El domicilio debe incluir calle, número, colonia, alcaldía, ciudad y código postal">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="domicilio" value="<?php echo $_POST['domicilio'] ?? '' ?>" placeholder="Domicilio" tabindex="4">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-envelope icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="correo" value="<?php echo $_POST['correo'] ?? '' ?>" placeholder="Correo electrónico" tabindex="5">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-phone icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="telefono" value="<?php echo $_POST['telefono'] ?? '' ?>" placeholder="Teléfono" tabindex="6">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-success btn-block" name="btn-registro" tabindex="7">
                  Registrar
                </button>
              </div>
              <div class="col-sm-6">
                <a href="index.php" class="btn btn-primary btn-block" tabindex="8">Omitir</a>
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
