<?php
  session_start();
  require_once("Funciones/funcionesMostrarPaciente.php");
  require_once("Funciones/funcionesRegistroMedico.php");
    $info = obtenerInformacion ();



//   if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ficha']) && validarFicha($_POST['ficha'])){
//     if (!empty($_POST['honey'])){
//       return header ('Location: index.php');
//     }
//     if (!isset($_SESSION['administrador'])){
//       return header ('Location: index.php');
//     }
//     $campos = [
//       'nombre' => 'Nombre',
//       'apellido_paterno' => 'Apellido paterno',
//       'apellido_materno' => 'Apellido materno',
//       'domicilio' => 'Domicilio',
//       'cedula_profesional' => 'Cédula profesional',
//       'cedula_especialidad' => 'Cédula de especialidad',
//       'correo' => 'Correo electrónico',
//       'telefono' => 'Teléfono',
//       'password' => 'Contraseña',
//       'passwordCopy' => 'Copia de contraseña',
//       'terminos' => 'Terminos y condiciones'
//     ];
    
//     $errores = validarCampos ($campos);
//     $errores = array_merge($errores, compararPassword($_POST['password'],$_POST['passwordCopy']));

//     if (empty($errores)){
//       $errores = registro();
//     }
//   }

  $titulo = "Consultorio Pediátrico | Paciente";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-mostrar-datos">
      <div class="row">
        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
        <div id="marcoSuperior">
                <button class="pestana" id="P1" onclick="cambiarPestana(1)">
                    Datos Generales
                </button>
                <button class="pestana" id="P2" onclick="cambiarPestana(2)">
                    Antecedentes Perinatales
                </button>
                <button class="pestana" id="P3" onclick="cambiarPestana(3)">
                    Tutor
                </button>
                <button class="pestana" id="P4" onclick="cambiarPestana(4)">
                    Vacunas
                </button>
            </div>
            <div id="marcoInferior">
                <div class="contenidoPestana" id="DatosGenerales">
                    <?php echo $info ['datosGenerales'];?>
                </div>
                <div class="contenidoPestana" id="AntecedentesPerinatales">
                    <?php echo $info ['antecedentesPerinatales'];?>
                </div>
                <div class="contenidoPestana" id="AntecedentesPatologicos">
                    <?php echo $info ['tutor'] ;?>
                
                </div>
                <div class="contenidoPestana" id="Vacunas">
                
                </div>
            </div>
            
        </div>
      </div>
      <br><br><br>
      <div class="row">
        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id = "registro-medico" >
            <input type="hidden" name="ficha" value="<?php echo fichaCSRF(); ?>">
            <input type="hidden" name="honey" value="">
            <hr>
            <h4>Consulta</h4>
            <hr>
            <p> Fecha: <?php echo date("d-m-Y")?></p>


            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <textarea class="form-control" name="Sintomas" cols="30" rows="3" placeholder="Síntomas"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            

            <div class="row">
              <div class="col-sm-3">
                <span> <i class="fa fa-glass icono-izquierdo"></i>Alimentación</span>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="input-group">                  
                    <div class="campo-contenedor">
                      <select name="Leche_Formula" class="form-control">
                          <option value="-">-</option>
                          <option value="Leche">Leche</option>
                          <option value="Formula">Fórmula</option>
                      </select>
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
                      <textarea class="form-control" name="Alimentacion_Horario" cols="30" rows="3" placeholder="Horario de alimentación"></textarea>
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
                      <span> <i class="fa fa-balance-scale icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="El peso del paciente debe estar en kilogramos, se permiten dos decimales">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Peso" value="<?php echo $_POST['Peso'] ?? '' ?>" placeholder=" Peso actual" >
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
                      <input type="text" class="form-control" name="Talla" value="<?php echo $_POST['Talla'] ?? '' ?>" placeholder="Talla actual" >
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
                      <span> <i class="fa fa-thermometer-half icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="La temperatura del paciente debe estar en ºC">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Temperatura" value="<?php echo $_POST['Temperatura'] ?? '' ?>" placeholder=" Temperatura">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="campo-contenedor tip">
                      <span> <i class="fa fa-heartbeat icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="La frecuencia cardíaca debe ser medida en latidos por minuto">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Freq_Cardiaca" value="<?php echo $_POST['Freq_Cardiaca'] ?? '' ?>" placeholder="Frecuencia cardíaca" tabindex="2">
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
                      <span> <i class="fa  fa-stethoscope icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="La frecuencia respiratoria debe ser medida en respiraciones por minuto">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Freq_Respiratoria" value="<?php echo $_POST['Freq_Respiratoria'] ?? '' ?>" placeholder=" Frecuencia respiratoria">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="campo-contenedor tip">
                      <span> <i class="fa fa-arrows-v icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="El perímetro cefálico del paciente debe estar en centímetros">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Perimetro_cefalico" value="<?php echo $_POST['Perimetro_cefalico'] ?? '' ?>" placeholder="Perímetro cefálico" >
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
                      <span> <i class="fa fa-expand icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="El segmento superior del paciente debe estar en centímetros">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Segmento_Superior" value="<?php echo $_POST['Segmento_Superior'] ?? '' ?>" placeholder=" Segmento Superior">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="campo-contenedor tip">
                      <span> <i class="fa fa-expand icono-izquierdo"></i></span>
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="El segmento inferior del paciente debe estar en centímetros">
                        <span class="info"><i class="fa fa-info-circle icono-derecho"></i></i></span>
                      </div>
                      <input type="text" class="form-control" name="Segmento_Inferior" value="<?php echo $_POST['Segmento_Inferior'] ?? '' ?>" placeholder=" Segmento inferior" tabindex="2">
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
                      <textarea class="form-control" name="Estudios" cols="30" rows="3" placeholder="Estudios"></textarea>
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
                      <textarea class="form-control" name="Diagnostico" cols="30" rows="3" placeholder="Diagnóstico"></textarea>
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
                      <textarea class="form-control" name="Tratamiento" cols="30" rows="5" placeholder="Tratamiento"></textarea>
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
                      <textarea class="form-control" name="Referencias_Espacialidad" cols="30" rows="3" placeholder="Referencias a espacialidad"></textarea>
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

