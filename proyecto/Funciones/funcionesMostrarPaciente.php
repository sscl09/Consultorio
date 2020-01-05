<?php
if (!isset($_SESSION['pacienteActual'])){
    $_SESSION['pacienteActual'] = (int)$_POST['id-paciente'];
}

    
    function obtenerDatosGenerales (){
        require_once("Recursos/conexion.php");
        $declaracion = $con -> prepare ("SELECT `Fecha_nacimiento`  FROM `Paciente` WHERE  `ID_Paciente` = ?");
        $declaracion -> bind_param("i", $_SESSION['pacienteActual']);
        $declaracion -> execute();
        $resultado = $declaracion -> get_result();
        $cantidad = mysqli_num_rows($resultado);
        $linea = $resultado -> fetch_assoc();
        $declaracion -> free_result();
        $declaracion -> close();


    }
?>