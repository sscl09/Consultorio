<?php
    require_once('funciones.php');
    /* 
        Función que agrega un nuevo médico en la base de datos 
    */
    function registro(){
        require_once("Recursos/conexion.php");
        $errores = verificaDuplicados($con);

        if (!empty($errores)){
            return $errores;
        }

        $nombre = limpiarInformacion ($_POST['nombre']);
        $apellido_paterno = limpiarInformacion ($_POST['apellido_paterno']);
        $apellido_materno = limpiarInformacion ($_POST['apellido_materno']);
        $domicilio = limpiarInformacion ($_POST['domicilio']);
        $especialidad = "Pediatria";
        $cedula_profesional = limpiarInformacion ($_POST['cedula_profesional']);
        $cedula_especialidad = limpiarInformacion ($_POST['cedula_especialidad']);
        $correo = limpiarInformacion ($_POST['correo']);
        $telefono = limpiarInformacion ($_POST['telefono']);
        $password = limpiarInformacion ($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $declaracion = $con -> prepare("INSERT INTO `Medico` (`Nombre`, `Apellido_paterno`, `Apellido_materno`, `Domicilio`, `Especialidad`, `Telefono`, `Correo`, `Cedula_Profesional`, `Cedula_Especialidad`,`Password`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $declaracion -> bind_param("ssssssssss", $nombre, $apellido_paterno, $apellido_materno, $domicilio, $especialidad, $telefono, $correo,$cedula_profesional, $cedula_especialidad,$password);
        $declaracion -> execute();

        $resultado = $declaracion -> affected_rows;
        //1 -> exitoso

        $declaracion -> free_result();
        $declaracion -> close();
        $con -> close();

        if($resultado == 1){
            $_SESSION['usuarioNuevo'] = $nombre . " " . $apellido_paterno;
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

        foreach ($campos as $campo => $valor) {
            if (!isset($_POST[$campo]) || $_POST[$campo] == null){
                $errores [] = $valor . ' es un campo requerido';
            }
            else {
                $camposValidacion = formatoCampos ();
                foreach( $camposValidacion as $campoValidacion => $opcion ){
                    if ($campo == $campoValidacion){
                        if (!preg_match($opcion['patron'], $_POST[$campo])){
                            $errores [] = $opcion ['error'];
                        }
                    }
                }

                if ($_POST[$campo] == $_POST['correo']){
                    if(!filter_var( $_POST['correo'] , FILTER_VALIDATE_EMAIL)){
                        $errores [] = 'El correo electrónico no es válido';
                    }
                }
            }
        }

        return $errores;
    }

    /*
        Función que verifica que la contraseña introducida es la deseada. 
        Compara el campo password con el campo passwordcopy
    */
    function compararPassword ($password, $passwordCopy){
        $errores = [];
        if($password !== $passwordCopy){
            $errores[] = 'Las contraseñas no coinciden';
        }
        return $errores;
    }

    /*
        Función que verifica que no haya un usuario con el mismo correo electrónico o número de teléfono
     */
    function verificaDuplicados ($con){
        $errores = [];

        $correo = limpiarInformacion ($_POST['correo']);
        $telefono = limpiarInformacion ($_POST['telefono']);
        $cedula_profesional = limpiarInformacion ($_POST['cedula_profesional']);
        $cedula_especialidad = limpiarInformacion ($_POST['cedula_especialidad']);

        $declaracion = $con -> prepare ("SELECT `Correo`, `Telefono`, `Cedula_Especialidad`, `Cedula_Profesional`  FROM `Medico` WHERE  `Correo` = ? OR `Telefono` = ? OR `Cedula_Profesional` = ? OR `Cedula_Especialidad` = ?");
        $declaracion -> bind_param("ssss", $correo, $telefono,$cedula_profesional,$cedula_especialidad);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();

        if ($cantidad > 0){
            if ($_POST['correo'] == $linea['Correo']){
                $errores [] = 'El correo electrónico ya está registrado, introduzca uno diferente';
            }
            if ($_POST['telefono'] == $linea['Telefono']){
                $errores [] = 'El teléfono ya está registrado, introduzca uno diferente';
            }
            if ($_POST['cedula_profesional'] == $linea['Cedula_Profesional']){
                $errores [] = 'La cédula profesional ya está registrada, introduzca uno diferente';
            }
            if ($_POST['cedula_especialidad'] == $linea['Cedula_Especialidad']){
                $errores [] = 'La cédula de especialidad ya está registrado, introduzca uno diferente';
            }
        }
        else{
            
            $declaracion = $con -> prepare ("SELECT `Correo`, `Telefono` FROM `Secretaria` WHERE  `Correo` = ? OR `Telefono` = ?");
            $declaracion -> bind_param("ss", $correo, $telefono);
            $declaracion -> execute();
            $resultado = $declaracion -> get_result();
            $cantidad = mysqli_num_rows($resultado);
            $linea = $resultado -> fetch_assoc();
            $declaracion -> free_result();
            $declaracion -> close();
            if ($cantidad > 0){
                if ($_POST['correo'] == $linea['Correo']){
                    $errores [] = 'El correo electrónico ya está registrado, introduzca uno diferente';
                }
                if ($_POST['telefono'] == $linea['Telefono']){
                    $errores [] = 'El teléfono ya está registrado, introduzca uno diferente';
                }
            }
            else{
                $declaracion = $con -> prepare ("SELECT `Correo`, `Telefono` FROM `Administrador` WHERE  `Correo` = ? OR `Telefono` = ?");
                $declaracion -> bind_param("ss", $correo, $telefono);
                $declaracion -> execute();
                $resultado = $declaracion -> get_result();
                $cantidad = mysqli_num_rows($resultado);
                $linea = $resultado -> fetch_assoc();
                $declaracion -> free_result();
                $declaracion -> close();
                if ($cantidad > 0){
                    if ($_POST['correo'] == $linea['Correo']){
                        $errores [] = 'El correo electrónico ya está registrado, introduzca uno diferente';
                    }
                    if ($_POST['telefono'] == $linea['Telefono']){
                        $errores [] = 'El teléfono ya está registrado, introduzca uno diferente';
                    }
                }   
            }
        }

        return $errores;
    }

?>