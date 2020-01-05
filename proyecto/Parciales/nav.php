<!-- Barra de navegación -->
<nav class="navbar fixed-top navbar-expand-lg nav-color">
      <div class="container">

        <!-- Logo y boton de expander y colapsar los enlaces -->
        <a class="navbar-brand" href="index.php">Consultorio pediátrico</a>
        <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#enlaces" aria-controls="enlaces" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        </div>

        <!-- Enlaces de navegacion -->
        <div class="collapse navbar-collapse" id="enlaces">
          <ul class="nav navbar-nav ml-auto">
            <li><a class="nav-item nav-link" href="index.php">Inicio</a></li>
            <li><a class="nav-item nav-link" href="contacto.php">Contacto</a></li>
            
            
            <!-- Vericar si hay una sesion activa -->
            <?php
              if (isset($_SESSION['medico'])){
                echo'
                    <li><a class="nav-item nav-link" href="agenda.php">Agenda</a></li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pacientes 
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="registroPaciente.php">Registrar paciente</a>
                        <a class="dropdown-item" href="buscarPaciente.php">Buscar paciente</a>
                      </div>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.$_SESSION['medico'].' 
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="#">Cuenta</a>
                        <a class="dropdown-item" href="#">Preferencias</a>
                        <hr></hr>
                        <a class="dropdown-item" href="logout.php">Log out</a>
                      </div>
                    </li>
                ';
              }
              elseif (isset($_SESSION['administrador'])){
                echo'
                      <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Registro 
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="registroMedico.php">Registrar médico</a>
                        <a class="dropdown-item" href="registroSecretaria.php">Registrar secretario</a>
                      </div>
                    </li>

                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.$_SESSION['administrador'].' 
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="#">Cuenta</a>
                        <a class="dropdown-item" href="#">Preferencias</a>
                        <hr></hr>
                        <a class="dropdown-item" href="logout.php">Log out</a>
                      </div>
                    </li>
                ';
                
              }
              elseif (isset($_SESSION['secretaria'])){
                echo'
                    <li><a class="nav-item nav-link" href="#">Agenda</a></li>
                    
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.$_SESSION['secretaria'].' 
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="#">Cuenta</a>
                        <a class="dropdown-item" href="#">Preferencias</a>
                        <hr></hr>
                        <a class="dropdown-item" href="logout.php">Log out</a>
                      </div>
                    </li>
                ';
              }
              else{
                echo'
                    <li><a class="nav-item nav-link" href="login.php">Inicio de sesión</a></li>

                ';
              }
            
            ?>

          </ul>  
        </div>
      </div>
    </nav>