<?php
        
        if (!isset($_SESSION['pacienteActual'])){
            $_SESSION['pacienteActual'] = (int)$_POST['id-paciente'];
        }

    function obtenerInformacion (){
        require_once("Recursos/conexion.php");

        $info = [];

        $info ['datosGenerales'] = obtenerDatosGenerales ($con);
        $info ['antecedentesPerinatales'] = obtenerAntecedentesPerinatales($con);

        return $info;
    }

    
    function obtenerDatosGenerales($con){
        $declaracion = $con -> prepare ("SELECT *  FROM `Paciente` WHERE  `ID_Paciente` = ?");
        $declaracion -> bind_param("i", $_SESSION['pacienteActual']);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();

        $fechaActual = new DateTime();
        $fechaNacimiento =  new DateTime($linea['Fecha_nacimiento']);
        $edad = $fechaActual->diff($fechaNacimiento);
        $edad = get_format($edad);

        if ($linea['Alergias'] == null){
            $alergias = 'Ninguna';
        }
        else{
            $alergias = $linea['Alergias'];
        }


        $datosGenerales = 
            '<div class="row justify-content-md-center">
                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Nombre</h5>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Edad</h5>
                    </div>
                    </div>
                </div>
                </div>
            </div> 

            <div class="row justify-content-md-center">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-user icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="nombre" value=" '.$linea['Nombre'].' '. $linea['Apellido_paterno']. ' ' . $linea['Apellido_materno'] .'"disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-calendar icono-izquierdo"></i></span>
                      <input type="text" class="form-control" name="nombre" value="'.$edad.'" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row justify-content-md-center">
                <div class="col-sm-12">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Alergias</h5>
                    </div>
                    </div>
                </div>
                </div>
            </div> 
            <div class="row justify-content-md-center">
                <div class="col-sm-12">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                        <textarea class="form-control" name="alergias" cols="30" rows="5" disabled>'.$alergias.'</textarea>
                    </div>
                    </div>
                </div>
                </div>
            </div> 
            ';
            

        return $datosGenerales;

    }

    function obtenerTutor ($con){
        $declaracion = $con -> prepare ("SELECT * FROM `Antecedentes_Perinatales` WHERE  `ID_Paciente` = ?");
        $declaracion -> bind_param("i", $_SESSION['pacienteActual']);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();
    }

    function obtenerAntecedentesPerinatales($con){
        $declaracion = $con -> prepare ("SELECT * FROM `Antecedentes_Perinatales` WHERE  `ID_Paciente` = ?");
        $declaracion -> bind_param("i", $_SESSION['pacienteActual']);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();

        if ($cantidad == 0){
            $linea = [];
            $linea['Peso'] = '-';
            $linea['Talla'] = '-';
            $linea['Edad_gestacional'] = '-';
            $linea['Apgar'] = '-';
            $linea['Silverman_Andersen'] = '-';
            $linea['Via_Nacimiento'] = '-';
            $linea['Tipo_Anestesia'] = '-';
            $linea['Complicaciones'] = '-';
            $linea['Lugar_Nacimiento'] = '-';
            $linea['Nombre_Hospital'] = '-';

        }
        else{
            if ($linea['Peso'] == null) {
                $linea['Peso'] = '-';
            }
            if ($linea['Talla'] == null) {
                $linea['Talla'] = '-';
            }
            if ($linea['Edad_gestacional'] == null) {
                $linea['Edad_gestacional'] = '-';
            }
            if ($linea['Apgar'] == null) {
                $linea['Apgar'] = '-';
            }
            if ($linea['Silverman_Andersen'] == null) {
                $linea['Silverman_Andersen'] = '-';
            }
            if ($linea['Via_Nacimiento'] == null) {
                $linea['Via_Nacimiento'] = '-';
            }
            if ($linea['Tipo_Anestesia'] == null) {
                $linea['Tipo_Anestesia'] = '-';
            }
            if ($linea['Complicaciones'] == null) {
                $linea['Complicaciones'] = '-';
            }
            if ($linea['Lugar_Nacimiento'] == null) {
                $linea['Lugar_Nacimiento'] = '-';
            }
            if ($linea['Nombre_Hospital'] == null) {
                $linea['Nombre_Hospital'] = '-';
            }
        }

        $info = '
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Peso de nacimiento</h5>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Talla de nacimiento</h5>
                    </div>
                    </div>
                </div>
                </div>
            </div> 

            <div class="row justify-content-md-center">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-balance-scale icono-izquierdo"></i></span>
                      <input type="text" class="form-control " value=" '.$linea['Peso'].' kg"disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-arrows-v icono-izquierdo"></i></span>
                      <input type="text" class="form-control" value="'.$linea['Talla'].' cm" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="row ">
                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Edad gestacional</h5>
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
                      <input type="text" class="form-control" value="'.$linea['Edad_gestacional'].' semanas" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Puntuación Apgar</h5>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Vía de nacimiento</h5>
                    </div>
                    </div>
                </div>
                </div>
            </div> 

            <div class="row justify-content-md-center">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-list-alt icono-izquierdo"></i></span>
                      <input type="text" class="form-control " value=" '.$linea['Apgar'].'"disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-ambulance icono-izquierdo"></i></span>
                      <input type="text" class="form-control"  value="'.$linea['Via_Nacimiento'].'" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Silverman-Andersen</h5>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Tipo de anestesia</h5>
                    </div>
                    </div>
                </div>
                </div>
            </div> 

            <div class="row justify-content-md-center">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-list-alt icono-izquierdo"></i></span>
                      <input type="text" class="form-control " value=" '.$linea['Silverman_Andersen'].'"disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-medkit icono-izquierdo"></i></span>
                      <input type="text" class="form-control" value="'.$linea['Tipo_Anestesia'].'" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Hospital de nacimiento</h5>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group"> 
                    <div class="campo-contenedor">
                    <h5>Lugar de nacimiento</h5>
                    </div>
                    </div>
                </div>
                </div>
            </div> 

            <div class="row justify-content-md-center">
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-hospital-o icono-izquierdo"></i></span>
                      <input type="text" class="form-control " value=" '.$linea['Nombre_Hospital'].'"disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <div class="input-group"> 
                    <div class="campo-contenedor">
                      <span> <i class="fa fa-thumb-tack icono-izquierdo"></i></span>
                      <input type="text" class="form-control" value="'.$linea['Lugar_Nacimiento'].'" disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
        ';

        return $info;

    }

    function get_format($df) {

        $str = '';
        $str .= ($df->invert == 1) ? '  ' : '';
        if ($df->y > 0) {
            // years
            $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
        } if ($df->m > 0) {
            // month
            $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
        } if ($df->d > 0) {
            // days
            $str .= ($df->d > 1) ? $df->d . ' Días ' : $df->d . ' Día ';
        }
    
        return $str;
    }
?>