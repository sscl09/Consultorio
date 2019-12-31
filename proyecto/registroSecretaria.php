<?php
  session_start();
  require_once("Funciones/funcionesRegistroSecretaria.php");
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

  $titulo = "Consultorio Pediátrico | Registro secretaria";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-registro">
      <div class="row">
        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3>Registro de secretarios</h3>
          <hr>

          <?php if(!empty($errores)){echo mostrarErrores($errores);} ?>

          <!-- Formulario de registro -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id = "registro-secretaria" >
            <input type="hidden" name="ficha" value="<?php echo fichaCSRF(); ?>">
            <input type="hidden" name="honey" value="">
            <p>Registro de secretarios para el consultorio pediátrico</p>
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

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="campo-contenedor tip">
                      <span> <i class="fa fa-lock icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="La contraseña debe contener al menos 2 letras minúsculas, 2 letras mayúsculas, 2 números y 2 de los siguientes simbolos !, @, #, $, %, ^, &, *, ?">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="password" class="form-control" name="password" placeholder="Contraseña" tabindex="7" id="password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-lock icono-izquierdo"></i></span>
                      <input type="password" class="form-control" name="passwordCopy" placeholder="Escribe de nuevo la contraseña" tabindex="8">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-3">
                <label class="btn btn-block btn-primary">
                  <input type="checkbox" name="terminos" tabindex="9" <?php if(isset($_POS['terminos'])){echo "'checked' = 'checked'";}?> >
                  Acepto
                </label>
              </div>
              <div class="col-sm-9">
                Al registrarte está aceptando los términos y condiciones acordados por esta página
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-success btn-block" name="btn-registro" tabindex="10">
                  Registrar
                </button>
              </div>
              <div class="col-sm-6">
                <a href="index.php" class="btn btn-danger btn-block" tabindex="11">Cancelar</a>
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
