<?php
  session_start();
  require_once("Funciones/funcionesLogin.php");
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ficha']) && validarFicha($_POST['ficha'])){
    if (!empty($_POST['honey'])){
      return header ('Location: index.php');
    }
    $campos = [
      'usuario' => 'Correo electrónico o teléfono',
      'password' => 'Contraseña'
    ];
    
    $errores = validarCampos ($campos);

    if (empty($errores)){
      $errores = login();
    }
  }
  $titulo = "Consultorio Pediátrico | Inicio de sesión ";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-login">
    <div class="row">
        <div class="col-sm-10 offset-sm-1 col-md-6 offset-md-3">
          <h1>Inicio de sesión</h1>
          <hr>

          <?php if(!empty($errores)){echo mostrarErrores($errores);} ?>

          <!-- Formulario de incio de sesión -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="login">
            <input type="hidden" name="ficha" value="<?php echo fichaCSRF(); ?>">
            <input type="hidden" name="honey" value="">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-user icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="usuario" placeholder="Correo o teléfono" value="<?php echo $_POST['usuario'] ?? '' ?>" tabindex="1">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-lock icono-izquierdo"></i></span>
                      <input type="password" class="form-control" name="password" placeholder="Contraseña" tabindex="2">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-success btn-block" name="btn-registro" tabindex="3">
                  Iniciar sesión
                </button>
              </div>
              <div class="col-sm-6">
                <a href="index.php" class="btn btn-danger btn-block" tabindex="4">Cancelar</a>
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



 