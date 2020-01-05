<?php 
    //include "Recursos/conexion.php";
    //require_once("Recursos/conexion.php");

    $nombreServidor = "localhost";
    $UsuarioBD = "root";
    $PasswordDB = "";
    $NombreDB = "Consultorio";
    
    $link = mysqli_connect($nombreServidor,$UsuarioBD,$PasswordDB,$NombreDB); 
    $IDM = null;
    if (isset($_SESSION['id_medico'])){
        $IDM = (int)$_SESSION['id_medico'];
    }

    if(isset($_POST['insert'])){
    	global $IDM;
        $sqlAux = "INSERT INTO consultorio.horario VALUES ( DEFAULT, ".$IDM.", ".$_POST['insert']." );";

        mysqli_query($link, $sqlAux);
    }

?>