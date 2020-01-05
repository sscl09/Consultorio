<?php
    require_once('funciones.php');
    /* 
        Función que agrega un nuevo médico en la base de datos 
    */
    function registro(){
        require_once("Recursos/conexion.php");

        $errores = [];

        $ID = verificaDuplicados ($con);

        if ($ID == -1){

            $nombre = limpiarInformacion ($_POST['nombre']);
            $apellido_paterno = limpiarInformacion ($_POST['apellido_paterno']);
            $apellido_materno = limpiarInformacion ($_POST['apellido_materno']);
            $domicilio = limpiarInformacion ($_POST['domicilio']);
            $correo = limpiarInformacion ($_POST['correo']);
            $telefono = limpiarInformacion ($_POST['telefono']);

            $declaracion = $con -> prepare("INSERT INTO `Tutor`(`Nombre`, `Apellido_paterno`, `Apellido_materno`, `Telefono`, `Correo`, `Domicilio`) VALUES (?,?,?,?,?,?)");

            $declaracion -> bind_param("ssssss", $nombre, $apellido_paterno, $apellido_materno, $telefono, $correo, $domicilio);
            $declaracion -> execute();

            $resultado = $declaracion -> affected_rows;
            //1 -> exitoso

            $declaracion -> free_result();
            $declaracion -> close();
            $con -> close();

            if($resultado == 1){
                $ID = verificaDuplicados ($con);
            }
            else{
                return $errores[] = 'Algo salió mal. Inténtelo más tarde';
            }
        }

        $declaracion = $con -> prepare("INSERT INTO `Paciente_Tutor`(`ID_Paciente`, `ID_Tutor`) VALUES (?,?)");

        $declaracion -> bind_param("ii", $_SESSION['pacienteActual'], $ID);
        $declaracion -> execute();

        $resultado = $declaracion -> affected_rows;

        $declaracion -> free_result();
        $declaracion -> close();
        $con -> close();

        if($resultado == 1){
            $_SESSION['usuarioNuevo'] = " un paciente";
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
                if ($campo == "nombre" || $campo == "apellido_paterno" || $campo == "apellido_materno"){
                    $errores [] = $valor . ' es un campo requerido';
                }
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

                if ($campo == 'correo'){
                    if(!filter_var( $_POST['correo'] , FILTER_VALIDATE_EMAIL)){
                        $errores [] = 'El correo electrónico no es válido';
                    }
                }
            }
        }

        return $errores;
    }

    /*
        Función que verifica que no haya un usuario con el mismo correo electrónico o número de teléfono
     */
    function verificaDuplicados ($con){
        $ID = -1;

        $nombre = limpiarInformacion ($_POST['nombre']);
        $apellido_paterno = limpiarInformacion ($_POST['apellido_paterno']);
        $apellido_materno = limpiarInformacion ($_POST['apellido_materno']);

        $declaracion = $con -> prepare ("SELECT `ID_Tutor` FROM `Tutor` WHERE  `Nombre` = ? AND `Apellido_paterno` = ? AND `Apellido_materno` = ?");
        $declaracion -> bind_param("sss", $nombre, $apellido_paterno, $apellido_materno);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();

        if ($cantidad > 0){ 
            $ID = $linea['ID_Tutor'];
        }

        return $ID;
    }

?>