<?php
    //Conexión con la base de datos 
    
    $nombreServidor = "localhost";
    $UsuarioBD = "root";
    $PasswordDB = "";
    $NombreDB = "Consultorio";
    $PuertoDB = "8080";

    $con = @new mysqli($nombreServidor,$UsuarioBD,$PasswordDB,$NombreDB);
    if ($con -> connect_error){
        die('Conexión no establecida: ' .$con -> connect_error);
    }
    // else {
    //     echo 'Conexión exitosa';
    // }
?> 