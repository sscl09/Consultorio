<?php
  session_start();
  if (isset($_POST['id-paciente'])){
    echo $_POST['id-paciente'];
  }
  $titulo = "Consultorio Pediátrico | Buscar paciente";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-buscar-paciente">
        <h3>Busqueda de paciente</h3>
        <hr>
        <p>Busque por nombre, apellido paterno, apellido materno o fecha de nacimiento, de click en el icono <i class="fa fa-edit"></i> para seleccionar el paciente</p>
        <hr>
        <br>
        <br>
 
        <div class="row justify-content-md-center">
              <div class="col-sm-3">
                <span> <i class="fa fa-search icono-izquierdo"></i>Busqueda de paciente</span>
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                        <input type="text" name="caja_busqueda" id="caja_busqueda"></input>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <br>
        <br>
        <br>
        
        <div class="row justify-content-md-center">
          <div class="col-sm-12" id="datos">

          </div>

        </div>
        
    </div>
<?php
  require_once('Parciales/abajoBuscar.php');
  require_once('Parciales/footer.php');

?>



 