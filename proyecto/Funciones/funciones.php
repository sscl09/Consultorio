<?php
    /*
        Función donde se especifica el formato de cada campo, así como el error a mostrar si es que no se cumple con el formato
     */

    function formatoCampos(){
        $formatoCampos = [
            'nombre' => [
                'patron' => '/^[a-z áéíóúÁÉÍÓÚñÑ\s]{3,128}$/i',
                'error' => 'Nombre(s) solo puede contener letras'
            ],
            'apellido_paterno' => [
                'patron' => '/^[a-z áéíóúÁÉÍÓÚñÑ\s]{3,128}$/i',
                'error' => 'El apellido paterno solo puede contener letras'
            ],
            'apellido_materno' => [
                'patron' => '/^[a-z áéíóúÁÉÍÓÚñÑ\s]{3,128}$/i',
                'error' => 'El apellido materno solo puede contener letras'
            ],
            'domicilio' => [
                'patron' => '/^[a-z0-9áéíóúÁÉÍÓÚñÑ.,\s]{40,256}$/i',
                'error' => 'El domicilio solo puede contener letras y/o es demasiado corto'
            ],
            'password' => [
                'patron' => '/(?=^[\w\!@#\$%\^&\*\?]{8,256}$)(?=(.*\d){2,})(?=(.*[a-z]){2,})(?=(.*[A-Z]){2,})(?=(.*[\!@#\$%\^&\*\?_]){2,})^.*/',
                'error' => 'La contraseña debe contener al menos 2 letras minúsculas, 2 letras mayúsculas, 2 números y 2 símbolos'
            ],
            'telefono' => [
                'patron' => '/^[0-9]{10}/',
                'error' => 'El número de teléfono solo puede contener dígitos y deben ser 10'
            ],
            'fecha_nacimiento' => [
                'patron' => '/^[0-9-]{10}/',
                'error' => 'El formato de la fecha de nacimiento es incorrecto'
            ]
        ];
        return $formatoCampos;
    }


    /*
        Función que limpia la información. Previene inyección de código.
        trim()              -> Quita espacios antes y despues del texto
        stripcslashes()     -> Quita diagonales del texto
        htmlspecialchars () -> Convierte caracteres especiales a codigo
    */
    function limpiarInformacion ($dato){
        $dato = trim($dato);
        $dato = stripcslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }


    /* 
        Función que genera código HTML que muestra los errores de alguna otra función 
    */
    function mostrarErrores ($errores){
        $resultado = '<div class="alert alert-danger "><ul class = "errores">';
        foreach($errores as $error){
            $resultado .= '<li>' . htmlspecialchars($error) . '</il>';
        }
        $resultado .= '</ul></div>';
        return $resultado;
    }


    /*
        Función que crea una ficha de CSRF
    */
    function fichaCSRF (){
        $ficha = bin2hex(random_bytes(32));
        return $_SESSION['ficha'] = $ficha;
    }

    /*
        Función que verifica la ficha CSRF 
        Si la ficha es válida entonces se dejará hacer el registro
     */
    function validarFicha ($ficha){
        if (isset($_SESSION['ficha']) && hash_equals($_SESSION['ficha'], $ficha)){
            unset($_SESSION['ficha']);
            return true;
        }
        return false;
    }
?>
