<?php
  session_start();
  $titulo = "Consultorio Pediátrico";
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
?>

    <!-- Contenedor principal : Cuerpo de la página -->
    <div class="container" id="pagina-principal">
     	<center>
     	<h1>Consultorio pediátrico</h1>
     	<br><br>
      	<div id="demo" class="carousel slide" data-ride="carousel">

       <!-- Indicators -->
	        <ul class="carousel-indicators">
		        <li data-target="#demo" data-slide-to="0" class="active"></li>
		        <li data-target="#demo" data-slide-to="1"></li>
		        <li data-target="#demo" data-slide-to="2"></li>
	        </ul>
	       
	        <!-- The slideshow -->
	        <div class="carousel-inner">
	          	<div class="carousel-item active">
	           		<img src="img/H1.jpg" alt="H1">
	          	</div>
	          	<div class="carousel-item ">
	            	<img src="img/H2.jpg" alt="H2"">
	          	</div>
	          	<div class="carousel-item ">
	            	<img src="img/H3.jpg" alt="H3"">
	          	</div>
	        </div>
	       
	         <!-- Left and right controls -->
	        <a class="carousel-control-prev" href="#demo" data-slide="prev">
	           	<span class="carousel-control-prev-icon"></span>
	        </a>
	        <a class="carousel-control-next" href="#demo" data-slide="next">
	        	<span class="carousel-control-next-icon"></span>
	        </a>
      	</div>
      	</center>
    </div>

<?php
  require_once('Parciales/abajo.php');
  require_once('Parciales/footer.php');

?>



 