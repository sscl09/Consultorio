<?php
  session_start();
   require_once("Funciones/funcionesRegistroAP.php");
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ficha']) && validarFicha($_POST['ficha'])){
    if (!empty($_POST['honey'])){
      return header ('Location: index.php');
    }
    if (!isset($_SESSION['medico'])){
      return header ('Location: index.php');
    }

    $campos = [
        'Peso' => 'Peso',
        'Talla' => 'Talla',
        'Edad_gestacional' => 'Edad gestacional',
        'Apgar' => 'Puntuación Apgar',
        'Via_Nacimiento' => 'Vía de nacimiento',
        'Silverman_Andersen' => 'Puntuación Silverma - Andersen',
        'Tipo_Anestesia' => 'Tipo de anestesia',
        'Nombre_Hospital' => 'Hospital de nacimiento',
        'Lugar_Nacimiento' => 'Lugar de nacimiento',
        'Complicaciones' => 'Complicaciones en el nacimiento'
    ];
    

    if ($_POST["btn"] == "Omitir"){
      $errores = crearTabla();
    }
    else{
      $errores = validarCampos ($campos);
      if (empty($errores)){
        $errores = registro();
      }
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
          <h3>Registro de antecedentes perinatales</h3>
          <hr>

          <?php if(!empty($errores)){echo mostrarErrores($errores);} ?>

          <!-- Formulario de registro -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id = "registro-ap" >
            <input type="hidden" name="ficha" value="<?php echo fichaCSRF(); ?>">
            <input type="hidden" name="honey" value="">
            <p>Registro de antecedentes perinatales de un paciente, este paso es opcional</p>
            <hr>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="campo-contenedor tip">
                      <span> <i class="fa fa-balance-scale icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="El peso del paciente debe estar en kilogramos, se permiten dos decimales">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Peso" value="<?php echo $_POST['Peso'] ?? '' ?>" placeholder=" Peso de nacimiento" tabindex="1">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="campo-contenedor tip">
                      <span> <i class="fa fa-arrows-v icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="La talla del paciente debe estar en centímetros">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Talla" value="<?php echo $_POST['Talla'] ?? '' ?>" placeholder="Talla de nacimiento" tabindex="2">
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
                      <span> <i class="fa fa-hourglass icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="Edad_gestacional" value="<?php echo $_POST['Edad_gestacional'] ?? '' ?>" placeholder="Edad gestacional" tabindex="3">
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-sm-4">
              <span> <i class="fa fa-list-alt icono-izquierdo"></i>Puntuación Apgar</span>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <select name="Apgar" class="form-control">
                          <option value="-">-</option>
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <span> <i class="fa fa-ambulance icono-izquierdo"></i>Vía de nacimiento</span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <select name="Via_Nacimiento" class="form-control">
                          <option value="-">-</option>
                          <option value="Cesárea">Cesárea</option>
                          <option value="Parto natural">Parto natural</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-4">
                <span> <i class="fa fa-list-alt icono-izquierdo"></i>Silverman-Andersen</span>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <select name="Silverman_Andersen" class="form-control" >
                          <option value="-">-</option>
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-sm-3">
                <span> <i class="fa fa-medkit icono-izquierdo"></i>Tipo de anestesia</span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <select name="Tipo_Anestesia" class="form-control">
                          <option value="-">-</option>
                          <option value="Ninguna">Ninguna</option>
                          <option value="Bloqueo peridural">Bloqueo peridural</option>
                          <option value="Anestesia general">Anestesia general</option>
                      </select>
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
                      <span> <i class="fa fa-hospital-o icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="Nombre_Hospital" value="<?php echo $_POST['Nombre_Hospital'] ?? '' ?>" placeholder="Hospital de nacimiento" tabindex="2">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-thumb-tack icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="Lugar_Nacimiento" value="<?php echo $_POST['Lugar_Nacimiento'] ?? '' ?>" placeholder="Lugar de nacimiento" tabindex="3">
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
                      <textarea class="form-control" name="Complicaciones" value="<?php echo $_POST['Complicaciones'] ?? '' ?>" cols="30" rows="5" placeholder="Complicaciones en el nacimiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <br>
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-success btn-block" name="btn" value="Registrar">
                  Registrar
                </button>
              </div>
              <div class="col-sm-6">
              <button type="submit" class="btn btn-primary btn-block" name="btn" value="Omitir">
                  Omitir
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

