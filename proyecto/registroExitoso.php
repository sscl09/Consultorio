<?php
  session_start();
  $titulo = "Consultorio Pediátrico";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
  //require_once('Recursos/conexion.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-registro-exitoso">
      <h1>Registro exitoso</h1>
      <?php
        echo'
          <p>Se ha registrado a ' .$_SESSION['usuarioNuevo']. '</p> 
        ';
      ?>
    </div>

<?php
  require_once('Parciales/abajo.php');
  require_once('Parciales/footer.php');

?>



 