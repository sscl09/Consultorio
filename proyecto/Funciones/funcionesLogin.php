<?php
    require_once('funciones.php');

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
                if ($_POST[$campo] == $_POST['usuario']){
                    if (!ctype_digit ($_POST[$campo]) ){
                        if(!filter_var( $_POST[$campo] , FILTER_VALIDATE_EMAIL)){
                            $errores [] = 'El correo electrónico no es válido';
                        }
                    }
                    else{
                        if (!preg_match('/^[0-9]{10}/', $_POST[$campo])){
                            $errores [] = 'El número de teléfono no es válido';
                        }
                    }
                    
                }

                
            }
        }

        return $errores;
}

    /*
        Función de inicio de sesión
    */

    function login(){
        require_once("Recursos/conexion.php");

        $usuario = limpiarInformacion ($_POST['usuario']);
        $password = limpiarInformacion ($_POST['password']);

        $errores = [];
        $errores = inicioSesion ("Medico", $usuario, $password, $con);
        if (empty($errores)){
            $errores = inicioSesion ("Secretaria", $usuario, $password, $con);
        }
        if (empty($errores)){
            $errores = inicioSesion ("Administrador", $usuario, $password, $con);
        }
        if (empty($errores)){
            $errores [] = 'Usuario no registrado';
        } 
        $con -> close();
        return $errores;
    }

    function inicioSesion ($quien, $usuario, $password, $con){
        $errores = [];
        
        $sentencia = "SELECT * FROM `" .$quien. "` WHERE  `Correo` = ? OR `Telefono` = ?";
        $declaracion = $con -> prepare ($sentencia);
        $declaracion -> bind_param("ss", $usuario, $usuario);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();
        //$con -> close();
        
        if ($cantidad == 1){
            $errores = bloqueoCuenta($con, $linea['Intento'], $linea['ID_'.$quien], $linea['Tiempo'], $quien);

            if (!empty ($errores)){
                return $errores;
            }

            if (password_verify($password, $linea['Password'])){

                if ($quien == 'Medico'){
                    $_SESSION['medico'] = $linea['Nombre'] . " ".$linea['Apellido_paterno'];
                    $_SESSION['id'] = $linea['ID_'.$quien];
                }
                elseif ($quien == 'Secretaria') {
                    $_SESSION['secretaria'] = $linea['Nombre'] . " ". $linea['Apellido_paterno'];
                    $_SESSION['id'] = $linea['ID_'.$quien];
                }
                else{
                    $_SESSION['administrador'] = $linea['Nombre'] . " ". $linea['Apellido_paterno'];
                    $_SESSION['id'] = $linea['ID_'.$quien];
                }
            

                $id = $linea['ID_'.$quien];
                $intento = 0;
                $tiempo = NULL;
                $sentencia = "UPDATE `".$quien."` SET `Intento` = ?, `Tiempo` = ? WHERE `".$quien."`.`ID_".$quien."` = ?";
                $declaracion = $con -> prepare ($sentencia);
                $declaracion -> bind_param("isi", $intento, $tiempo, $id);
                $declaracion -> execute();
                $declaracion -> close();

                header('Location: index.php');
            }
            else{
                $errores [] = 'La combinación de correo electrónico o teléfono y contraseña no son válidos';
            }
            
        }
        return $errores;
    }

    function bloqueoCuenta ($con, $intento, $id, $tiempo, $quien){
        $errores = [];

        $intento = $intento + 1;
        echo $intento;
        $sentencia = "UPDATE `" .$quien. "` SET `Intento` = ? WHERE `" .$quien. "`.`ID_".$quien."`= ?";
        $declaracion = $con -> prepare ($sentencia);
        $declaracion -> bind_param("ii", $intento, $id);
        $declaracion -> execute();
        $declaracion -> close();

        if ($intento == 3){
            $tiempoActual = date('Y-m-d H:i:s');
            $sentencia="UPDATE `" .$quien. "` SET `Tiempo` = ? WHERE `" .$quien. "`.`ID_" .$quien. "` = ?";
            $declaracion = $con -> prepare ($sentencia);
            $declaracion -> bind_param("si", $tiempoActual, $id);
            $declaracion -> execute();
            $declaracion -> close();
            $errores [] = 'Esta cuenta ha sido bloqueada por 15 minutos';

        }
        elseif ($intento > 3) {
            $espera =strtotime(date('Y-m-d H:i:s'))- strtotime($tiempo);
            $minutos = 15 - ceil($espera/60);
            if ($espera < (15*60)){
                $errores [] = 'Esta cuenta ha sido bloqueada por ' .$minutos.' minutos';
            }else{
                $intento = 1;
                $tiempo = NULL;
                $sentencia = "UPDATE `" .$quien. "` SET `Intento` = ?, `Tiempo` = ? WHERE `" .$quien. "`.`ID_" .$quien. "` = ?";
                $declaracion = $con -> prepare ($sentencia);
                $declaracion -> bind_param("isi", $intento, $tiempo, $id);
                $declaracion -> execute();
                $declaracion -> close();
            }
        }

       
        return $errores;
    }
?>