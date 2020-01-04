<?php
    require_once('funciones.php');

    /* 
        Función que agrega un nuevo médico en la base de datos 
    */
    function registro(){
        require_once("Recursos/conexion.php");

        $errores = [];


        $padecimiento = limpiarInformacion ($_POST['padecimiento']);
        $duracion = limpiarInformacion ($_POST['duracion']);
        $tratamiento = limpiarInformacion ($_POST['tratamiento']);
        $fecha = limpiarInformacion ($_POST['fecha']);
        $descripcion = (!isset($_POST['descripcion']) || $_POST['descripcion'] == null) ? null : limpiarInformacion ($_POST['descripcion']);
        

        $declaracion = $con -> prepare("INSERT INTO `Antecedentes_Patologicos`(`ID_Paciente`, `Padecimiento`, `Duracion`, `Tratamiento`, `Fecha`, `Descripcion`) VALUES (?,?,?,?,?,?)");

        $declaracion -> bind_param("isssss", $_SESSION['pacienteActual'], $padecimiento, $duracion, $tratamiento, $fecha, $descripcion);
        $declaracion -> execute();

        $resultado = $declaracion -> affected_rows;
        //1 -> exitoso

        $declaracion -> free_result();
        $declaracion -> close();
        $con -> close();

        if($resultado == 1){
            return header('Location:registoAntecedentesPatologicos.php');
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
        require_once("Recursos/conexion.php");
        $errores = [];

        foreach ($campos as $campo => $valor) {
            if (!isset($_POST[$campo]) || $_POST[$campo] == null ){
                if ($campo != 'descripcion'){
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

                if ($campo == 'fecha'){

                    $declaracion = $con -> prepare ("SELECT `Fecha_nacimiento`  FROM `Paciente` WHERE  `ID_Paciente` = ?");
                    $declaracion -> bind_param("i", $_SESSION['pacienteActual']);
                    $declaracion -> execute();
                    $resultado = $declaracion -> get_result();
                    $cantidad = mysqli_num_rows($resultado);
                    $linea = $resultado -> fetch_assoc();
                    $declaracion -> free_result();
                    $declaracion -> close();


                    $fecha_inicio = $linea['Fecha_nacimiento'];
                    $fecha_fin = date("Y-m-d");
                    $fecha = $_POST[$campo];

                    if($fecha < $fecha_inicio){
                    $errores [] = 'La fecha de nacimiento no es una fecha válida, ya que la fecha de nacimiento es: '.$fecha_inicio;
                    }
                    if ($fecha > $fecha_fin){
                        $errores [] = 'La fecha de nacimiento no es una fecha válida, ya que la fecha actual es: '.$fecha_fin;
                    }
                }
            }
        }

        return $errores;
    }
?>