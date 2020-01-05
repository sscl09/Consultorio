<?php
  // session_start();
  // $_SESSION['usuario'] = 'Sofía Colín';

  session_start();
  require_once("Funciones/FuncionesHorario.php");
  if (!empty($_POST['honey'])){
    return header ('Location: index.php');
  }

  $titulo = "Consultorio Pediátrico | horario";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-horario">
      <h1>Registro Horario</h1>
        <div class="row">
          <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="alert alert-warning" role="alert" style="display:none" id="alerta_vacio">
              Se tiene que seleccionar al menos un día.
            </div>
          </div>
          <div class="col-md-1"></div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-2">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check1">
                <label class="form-check-label" for="exampleCheck1">Lunes</label>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check2">
                <label class="form-check-label" for="exampleCheck1">Martes</label>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check3">
                <label class="form-check-label" for="exampleCheck1">Miercoles</label>
              </div>
          </div>
          <div class="col-md-5"></div>
        </div>
        <div class="row">
          <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-2">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check4">
                <label class="form-check-label" for="exampleCheck1">Jueves</label>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check5">
                <label class="form-check-label" for="exampleCheck1">Viernes</label>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check6">
                <label class="form-check-label" for="exampleCheck1">Sabado</label>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check7">
                <label class="form-check-label" for="exampleCheck1">Domingo</label>
              </div>
          </div>
          <div class="col-md-3"></div>
        </div>
        <div class="row">
          <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="alert alert-warning" role="alert" style="display:none" id="alerta_horario_invalido">
              El rango de horario no es valido.
            </div>
          </div>
          <div class="col-md-1"></div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Hora Entrada:</label>
              <select class="form-control" id="horaEntrada">
                <?php 
                  for ($i=0; $i < 24; $i++) { 
                    echo "<option>".($i < 10 ? "0".$i : $i).":00</option>";
                  }
                 ?>
              </select>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Hora Salida:</label>
              <select class="form-control" id="horaSalida">
                <?php 
                  for ($i=0; $i < 24; $i++) { 
                    echo "<option>".($i < 10 ? "0".$i : $i).":00</option>";
                  }
                 ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <dir class="col-md-3">
            <button type="button" class="btn btn-success" id="Btn_Guarda_Horario">Guardar</button>
          </dir>
          <div class="col-md-8"></div>
        </div>
    </div>

<?php
  require_once('Parciales/footer.php');

?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="js/jquery.validate.min.js"></script>
    <script src="js/messages_es.min.js"></script>
    <script src="js/validacion.js"></script>
    <script src="js/principal.js"></script>
    
<script type="text/javascript" src="js/Horario.js"></script>


 