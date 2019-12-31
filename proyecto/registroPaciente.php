<?php
  session_start();
  require_once("Funciones/funcionesRegistroPaciente.php");
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ficha']) && validarFicha($_POST['ficha'])){
    if (!empty($_POST['honey'])){
      return header ('Location: index.php');
    }
    if (!isset($_SESSION['medico'])){
        return header ('Location: index.php');
    }
    $camposObligatorios = [
      'nombre' => 'Nombre',
      'apellido_paterno' => 'Apellido paterno',
      'apellido_materno' => 'Apellido materno',
      'fecha_nacimiento' => 'Fecha de nacimiento',
      
    ];

    $camposOpcionales = [
        'alergias' => 'Alergias'
    ];
    
    $errores = validarCampos ($camposObligatorios, $camposOpcionales);

    if (empty($errores)){
      $errores = registro();
    }
  }

  $titulo = "Consultorio Pediátrico | Registro paciente";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-registro">
      <div class="row">
        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3>Registro de paciente</h3>
          <hr>

          <?php if(!empty($errores)){echo mostrarErrores($errores);} ?>

          <!-- Formulario de registro -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id = "registro-paciente" >
            <input type="hidden" name="ficha" value="<?php echo fichaCSRF(); ?>">
            <input type="hidden" name="honey" value="">
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
              <div class="col-sm-6">
                <span> <i class="fa fa-calendar icono-izquierdo"></i>Fecha de nacimiento</span>
                
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <input type="date" class="form-control" name="fecha_nacimiento" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 20 year")); ?>" max="<?php echo date("Y-m-d"); ?>" tabindex="5">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <textarea class="form-control" name="alergias" cols="30" rows="5" placeholder="Alergias"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-success btn-block" name="btn-registro" tabindex="12">
                  Registrar
                </button>
              </div>
              <div class="col-sm-6">
                <a href="index.php" class="btn btn-danger btn-block" tabindex="13">Cancelar</a>
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


