<?php
    require_once('funciones.php');

    function obtenerEdadMeses ($con){

        $declaracion = $con -> prepare ("SELECT `Fecha_nacimiento`  FROM `Paciente` WHERE  `ID_Paciente` = ?");
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

        $meses = 0;

        if ($edad->y > 0){
            $meses = ((int)$edad->y)*12;
        } 
        $meses += (int)$edad->m;

        return $meses;

    }

    function registro ($con, $edad){
        $edad = obtenerEdadMeses($con);

        $declaracion = $con -> prepare("SELECT * FROM `Vacuna` WHERE `Edad_Recomendada` < $edad");
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $declaracion -> close();


        while ($linea = mysqli_fetch_array($resultado)){
            echo 'Hola';
            if ($_POST[''.$linea['ID_Vacuna'].''] == "true"){
                $declaracion = $con -> prepare("INSERT INTO `Vacuna_Paciente`(`ID_Vacuna`, `ID_Paciente`) VALUES (?,?)");
                $declaracion -> bind_param("ii",$linea['ID_Vacuna'],$_SESSION['pacienteActual']);
                $declaracion -> execute();
                $resultado = $declaracion -> affected_rows;
                $declaracion -> free_result();
                $declaracion -> close();
                
            }
        }
    }

?>

