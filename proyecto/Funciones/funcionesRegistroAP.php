<?php
    require_once('funciones.php');

    function crearTabla (){
        require_once("Recursos/conexion.php");
        $errores = verificaDuplicados($con);

        if (!empty($errores)){
            return header('Location: index.php');
        }

        $aux = null;

        $declaracion = $con -> prepare("INSERT INTO `Antecedentes_Perinatales`(`ID_Paciente`, `Peso`, `Talla`, `Edad_gestacional`, `Apgar`, `Silverman_Andersen`, `Via_Nacimiento`, `Tipo_Anestesia`, `Complicaciones`, `Lugar_Nacimiento`, `Nombre_Hospital`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        $declaracion -> bind_param("iddiiisssss", $_SESSION['pacienteActual'],$aux, $aux, $aux, $aux, $aux, $aux, $aux, $aux, $aux, $aux);
        $declaracion -> execute();

        $resultado = $declaracion -> affected_rows;
        //1 -> exitoso

        $declaracion -> free_result();
        $declaracion -> close();
        $con -> close();

        if($resultado == 1){
            $_SESSION['usuarioNuevo'] = "Listo";
            header('Location: registroExitoso.php');
        }
        else{
            $errores[] = 'Algo salió mal. Inténtelo más tarde';
        }
    
        return $errores;


    }


    /* 
        Función que agrega los antecedentes perinatales de un paciente 
    */
    function registro(){
        require_once("Recursos/conexion.php");
        $errores = verificaDuplicados($con);

        if (!empty($errores)){
            return $errores;
        }

        $Peso = (!isset($_POST['Peso']) || $_POST['Peso'] == null) ? null : $_POST['Peso'];
        $Talla = (!isset($_POST['Talla']) || $_POST['Talla'] == null) ? null : $_POST['Talla'];
        $Edad_gestacional = (!isset($_POST['Edad_gestacional']) ||$_POST['Edad_gestacional'] == null) ? null : $_POST['Edad_gestacional'];
        $Apgar = (!isset($_POST['Apgar']) ||$_POST['Apgar'] == null ||  $_POST['Apgar'] == "-") ? null : $_POST['Apgar'];
        $Silverman_Andersen = (!isset($_POST['Silverman_Andersen']) ||$_POST['Silverman_Andersen'] == null || $_POST['Silverman_Andersen'] == "-") ? null : $_POST['Silverman_Andersen'];
        $Via_Nacimiento = (!isset($_POST['Via_Nacimiento']) ||$_POST['Via_Nacimiento'] == null || $_POST['Via_Nacimiento'] == "-") ? null : $_POST['Via_Nacimiento'];
        $Tipo_Anestesia = (!isset($_POST['Tipo_Anestesia']) ||$_POST['Tipo_Anestesia'] == null || $_POST['Tipo_Anestesia'] == "-") ? null : $_POST['Tipo_Anestesia'];
        $Complicaciones = (!isset($_POST['Complicaciones']) || $_POST['Complicaciones'] == null) ? null :limpiarInformacion ($_POST['Complicaciones']);
        $Lugar_Nacimiento = (!isset($_POST['Lugar_Nacimiento']) || $_POST['Lugar_Nacimiento'] == null) ? null :limpiarInformacion ($_POST['Lugar_Nacimiento']);
        $Nombre_Hospital = (!isset($_POST['Nombre_Hospital']) || $_POST['Nombre_Hospital'] == null) ? null :limpiarInformacion ($_POST['Nombre_Hospital']);


        $declaracion = $con -> prepare("INSERT INTO `Antecedentes_Perinatales`(`ID_Paciente`, `Peso`, `Talla`, `Edad_gestacional`, `Apgar`, `Silverman_Andersen`, `Via_Nacimiento`, `Tipo_Anestesia`, `Complicaciones`, `Lugar_Nacimiento`, `Nombre_Hospital`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        $declaracion -> bind_param("iddiiisssss", $_SESSION['pacienteActual'],$Peso, $Talla, $Edad_gestacional, $Apgar, $Silverman_Andersen, $Via_Nacimiento, $Tipo_Anestesia,$Complicaciones, $Lugar_Nacimiento,$Nombre_Hospital);
        $declaracion -> execute();

        $resultado = $declaracion -> affected_rows;
        //1 -> exitoso

        $declaracion -> free_result();
        $declaracion -> close();
        $con -> close();

        if($resultado == 1){
            $_SESSION['usuarioNuevo'] = "Listo";
            header('Location: registroExitoso.php');
        }
        else{
            $errores[] = 'Algo salió mal. Inténtelo más tarde';
        }
    
        return $errores;
    }


    /*
        Función que valida que los campos de formularios no estén vacios 
    */
    function validarCampos($campos){
        $errores = [];
        $contador = 0;

        foreach ($campos as $campo => $valor) {
            if (!isset($_POST[$campo]) || $_POST[$campo] == null){
                $contador = $contador + 1;
            }
            else {
                if ($campo == 'Apgar' || $campo == 'Via_Nacimiento' || $campo == 'Silverman_Andersen' ||  $campo =='Tipo_Anestesia'){
                    if ($_POST[$campo] == "-"){
                        $contador = $contador + 1;
                    }
                }

            }
        }


        if ($contador == sizeof($campos)){
            $errores [] = 'Todos los campos están vacios';
            return $errores;
        }

        foreach ($campos as $campo => $valor) {
            if (!isset($_POST[$campo]) || $_POST[$campo] == null || $_POST[$campo] == "-"){
                
            }
            else{
                if ($campo == 'Apgar' || $campo == 'Silverman_Andersen'){
                    if (!is_numeric($_POST[$campo])){
                        $errores [] = $valor . ' debe se un número entero';
                    }
                    else{
                        $_POST[$campo] = (int)$_POST[$campo];
                        if ($_POST[$campo] < 0 || $_POST[$campo] > 10){
                            $errores [] = $valor . ' debe ser un número entero entre 0 y 10';
                        }
                    }
                }
                if($campo == 'Via_Nacimiento'){
                    if (strcmp($_POST[$campo], 'Cesárea') == 0  || strcmp($_POST[$campo], 'Parto natural') == 0   ){
                        
                    }
                    else{
                        $errores [] = $valor . ' solo puede ser Cesárea o Parto natural';
                    }
                }
                if($campo == 'Tipo_Anestesia'){
                    if ($_POST[$campo] == 'Ninguna' || $_POST[$campo] ==  'Bloqueo peridural' || $_POST[$campo] ==  'Anestesia general'){
                        
                    }
                    else{
                        $errores [] = $valor . ' solo puede ser Ninguna, Bloqueo peridural o Anestesia general';
                    }
                }
                if ($campo == 'Edad_gestacional'){
                    if (!is_numeric($_POST[$campo])){
                        $errores [] = $valor . ' debe ser un número entero';
                    }
                    else{
                        $_POST[$campo] = (int)$_POST[$campo];
                        if ($_POST[$campo] < 30 || $_POST[$campo] > 41){
                            $errores [] = $valor . ' debe ser un número entero entre 30 y 41';
                        }
            
                    }
                }
                if ($campo == 'Peso'){
                    if (!is_numeric($_POST[$campo])){
                        $errores [] = $valor . ' debe ser un número';
                    }
                    else{
                        $_POST[$campo] = (float)$_POST[$campo];
                        if ($_POST[$campo] < 0.5 || $_POST[$campo] > 6){
                            $errores [] = $valor . ' debe ser un número entre 0.500 y 6.00';
                        }
            
                    }
                }
            
                if ($campo == 'Talla') {
                    if (!is_numeric($_POST[$campo])) {
                        $errores [] = $valor . ' debe ser un número';
                    } else {
                        $_POST[$campo] = (float)$_POST[$campo];
                        if ($_POST[$campo] < 35 || $_POST[$campo] > 60) {
                            $errores [] = $valor . ' debe ser un número entre 35.0 y 60.0';
                        }
                    }
                }
            }
        }

        return $errores;
    }

    /*
        Función que verifica que no haya un registro con el id del paciente actual 
     */
    function verificaDuplicados ($con){
        $errores = [];

        $declaracion = $con -> prepare ("SELECT `ID_Paciente` FROM `Antecedentes_Perinatales` WHERE  `ID_Paciente` = ?");
        $declaracion -> bind_param("i", $_SESSION['pacienteActual']);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();

        if ($cantidad > 0){
            $errores [] = 'El paciente ya cuenta con un registro de antecedentes perinatales, dirigase a la ventana correspondiente para modificar el registro';
            
        }

        return $errores;
    }

?>