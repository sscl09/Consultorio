<?php
  session_start();
  require_once("Funciones/funcionesAgenda.php");
  if (!empty($_POST['honey'])){
    return header ('Location: index.php');
  }

  $titulo = "Consultorio Pediátrico | Agenda";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-registro">
      <div id="superior">
        <p id="titulo">AGENDA SEMANAL</p>
        
        <div id="tabla">
            <img src="Btn_editar.png" id="img/Btn_editar">
            <div class="row">
                <div class="col-md-2" id="mes_actual">Diciembre</div>
                <div class="col-md-7">
                    <div id="control">
                        <button type="button" id="btn1" class="btn btn-default btn-sm sec"  >|<</button>
                        <button type="button" id="btn2" class="btn btn-default btn-sm prin" >< Anterior</button>

                        <button type="button" id="btn4" class="btn btn-default btn-sm prin" >Siguiente ></button>
                        <button type="button" id="btn5" class="btn btn-default btn-sm sec"  >>|</button>
                    </div>
                </div>
                <div class="col-md-2" id="mes_sig">Enero</div>
            </div>
            <?php  

            iniciar();

            ?>
        </div>

    </div>
    <div id="formulario">
        <input type="hidden" name="honey" value="">
        
        <div id="contenedor">
            <dir class="row">
                <div class="col-md-1"></div>
                <div class="col-md-8" id="Cita_tit">hola</div>
                <div class="col-md-2">
                    <button type="submit" class="btn-default" id="Btn_cerrar"><img src="img/Btn_cerrar.png" id="Img_cerrar"></button>
                </div>
                <div class="col-md-1"></div>
            </dir>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Nombre(s):</label>
                        <input type="text" class="form-control" placeholder="Nombre" id="nombre">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Apellido paterno:</label>
                        <input type="text" class="form-control" placeholder="Apellido" id="ApellidoPaterno">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Apellido materno:</label>
                        <input type="text" class="form-control" placeholder="Apellido" id="ApellidoMaterno">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <input type="text" class="form-control" placeholder="Descripcion" id="Descripcion">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-2" id="boton">
                    <button type="submit" class="btn btn-danger" id="Btn_Eliminar">Eliminar</button>
                </div>
                <div class="col-md-6"></div>
                <div id="ContenedorID"></div>
                <div class="col-md-2" id="boton">
                    <button type="submit" class="btn btn-success" id="Btn_Guardar">Guardar</button>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>

    </div>
    </div>
<?php
  require_once('Parciales/abajo.php');
  require_once('Parciales/footer.php');

?>
