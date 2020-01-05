<?php
  session_start();
  require_once("Funciones/funcionesMostrarPaciente.php");
  obtenerDatosGenerales ();
//   if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ficha']) && validarFicha($_POST['ficha'])){
//     if (!empty($_POST['honey'])){
//       return header ('Location: index.php');
//     }
//     if (!isset($_SESSION['administrador'])){
//       return header ('Location: index.php');
//     }
//     $campos = [
//       'nombre' => 'Nombre',
//       'apellido_paterno' => 'Apellido paterno',
//       'apellido_materno' => 'Apellido materno',
//       'domicilio' => 'Domicilio',
//       'cedula_profesional' => 'Cédula profesional',
//       'cedula_especialidad' => 'Cédula de especialidad',
//       'correo' => 'Correo electrónico',
//       'telefono' => 'Teléfono',
//       'password' => 'Contraseña',
//       'passwordCopy' => 'Copia de contraseña',
//       'terminos' => 'Terminos y condiciones'
//     ];
    
//     $errores = validarCampos ($campos);
//     $errores = array_merge($errores, compararPassword($_POST['password'],$_POST['passwordCopy']));

//     if (empty($errores)){
//       $errores = registro();
//     }
//   }

  $titulo = "Consultorio Pediátrico | Paciente";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-mostrar-datos">
        <div id="marcoSuperior">
            <button class="pestana" id="P1" onclick="cambiarPestana(1)">
                Datos Generales
            </button>
            <button class="pestana" id="P2" onclick="cambiarPestana(2)">
                Antecedentes Perinatales
            </button>
            <button class="pestana" id="P3" onclick="cambiarPestana(3)">
                Antecedentes Patologicos
            </button>
            <button class="pestana" id="P4" onclick="cambiarPestana(4)">
                Vacunas
            </button>
                <div id="reloj"></div>
         </div>
         <div id="marcoInferior">
            <div class="contenidoPestana" id="DatosGenerales">
                primero<br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="contenidoPestana" id="AntecedentesPerinatales">
                segundo<br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="contenidoPestana" id="AntecedentesPatologicos">
                tercero<br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="contenidoPestana" id="Vacunas">
                cuarto<br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
         </div>
      
    </div>
<?php
  require_once('Parciales/abajoBuscar.php');
  require_once('Parciales/footer.php');

?>

