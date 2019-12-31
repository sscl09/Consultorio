<?php
    require_once('funciones.php');
    /* 
        Función que agrega un nuevo paciente en la base de datos 
    */
    function registro(){
        $errores = [];
        require_once("Recursos/conexion.php");
        
        verificaDuplicados($con);

        $nombre = limpiarInformacion ($_POST['nombre']);
        $apellido_paterno = limpiarInformacion ($_POST['apellido_paterno']);
        $apellido_materno = limpiarInformacion ($_POST['apellido_materno']);
        $fecha = $_POST['fecha_nacimiento'];
        $alergias= limpiarInformacion ($_POST['alergias']);

        $declaracion = $con -> prepare("INSERT INTO `Paciente` (`Nombre`, `Apellido_paterno`, `Apellido_materno`, `Fecha_nacimiento`, `Alergias`) VALUES ( ?, ?, ?, ?, ?)");

        $declaracion -> bind_param("sssss", $nombre, $apellido_paterno, $apellido_materno, $fecha, $alergias);
        $declaracion -> execute();
        $resultado = $declaracion -> affected_rows;
        //1 -> exitoso
        
        $declaracion -> free_result();
        $declaracion -> close();
        
        

        if($resultado == 1){

            $declaracion = $con -> prepare ("SELECT `ID_Paciente`  FROM `Paciente` WHERE  `Nombre` = ? AND `Apellido_paterno` = ? AND `Apellido_materno` = ? AND `Fecha_nacimiento` = ?");
            $declaracion -> bind_param("ssss", $nombre, $apellido_paterno, $apellido_materno, $fecha);
            $declaracion -> execute();
            $resultado = $declaracion -> get_result();
            $cantidad = mysqli_num_rows($resultado);
            $linea = $resultado -> fetch_assoc();
            $declaracion -> free_result();
            $declaracion -> close();

            $declaracion = $con -> prepare("INSERT INTO `Medico_Paciente` (`ID_Medico`, `ID_Paciente`) VALUES ( ?, ?)");
            $declaracion -> bind_param("ii", $_SESSION['id'], $linea['ID_Paciente']);
            $declaracion -> execute();
            $resultado = $declaracion -> affected_rows;
            $declaracion -> free_result();
            $declaracion -> close();

            $_SESSION['pacienteActual'] = $linea['ID_Paciente'];
            $con -> close();
            return header('Location: registroAntecedentesPerinatales.php');

            
        }
        else{
            $errores[] = 'Algo salió mal. Inténtelo más tarde';
        }

        $con -> close();
        return $errores;
    }


    /*
        Función que valida que los campos de formularios no estén vacios 
    */
    function validarCampos($camposObligatorios, $camposOpcionales){
        $errores = [];

        $campos = array_merge($camposObligatorios, $camposOpcionales);

        foreach ($camposObligatorios as $campo => $valor) {
            if (!isset($_POST[$campo]) || $_POST[$campo] == null){
                $errores [] = $valor . ' es un campo requerido';
            }
        }
        echo $_POST['fecha_nacimiento'];
        if (!empty($errores)){
            foreach ($camposOpcionales as $campo => $valor) {
                if (isset($_POST[$campo]) || $_POST[$campo] == null){
                    $camposValidacion = formatoCampos ();
                    foreach( $camposValidacion as $campoValidacion => $opcion ){
                        if ($campo == $campoValidacion){
                            if (!preg_match($opcion['patron'], $_POST[$campo])){
                                $errores [] = $opcion ['error'];
                            }
                        }
                    }
                }
            }

            return $errores;
        }

        foreach ($campos as $campo => $valor) {
            $camposValidacion = formatoCampos ();
            foreach( $camposValidacion as $campoValidacion => $opcion ){
                if ($campo == $campoValidacion){
                    if (!preg_match($opcion['patron'], $_POST[$campo])){
                        $errores [] = $opcion ['error'];
                    }
                }
            }

            if ($_POST[$campo] == $_POST['fecha_nacimiento']){
                $fecha_inicio = date("Y-m-d",strtotime(date("Y-m-d")."- 20 year"));
                $fecha_fin = date("Y-m-d");
                $fecha = $_POST[$campo];

                if($fecha < $fecha_inicio){
                    $errores [] = 'La fecha de nacimiento no es una fecha válida, el paciente debe tener menos de 20 años';
                }
                if ($fecha > $fecha_fin){
                    $errores [] = 'La fecha de nacimiento no es una fecha válida, es una fecha futura';
                }

            }
        }

        return $errores;
    }


    /*
        Función que verifica que no haya un usuario con el mismo correo electrónico o número de teléfono
     */
    function verificaDuplicados ($con){
        $errores = [];

        $nombre = limpiarInformacion ($_POST['nombre']);
        $apellido_paterno = limpiarInformacion ($_POST['apellido_paterno']);
        $apellido_materno = limpiarInformacion ($_POST['apellido_materno']);
        $fecha = $_POST['fecha_nacimiento'];

        $declaracion = $con -> prepare ("SELECT *  FROM `Paciente` WHERE  `Nombre` = ? AND `Apellido_paterno` = ? AND `Apellido_materno` = ? AND `Fecha_nacimiento` = ?");
        $declaracion -> bind_param("ssss", $nombre, $apellido_paterno, $apellido_materno, $fecha);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();

        if ($cantidad > 0){
            return header('Location: index.php');
        }
        

        return $errores;
    }

?>